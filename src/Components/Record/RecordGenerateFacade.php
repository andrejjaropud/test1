<?php

namespace Components\Record;

use \Faker\Factory;
use \Faker\Generator;
use \Components\Base\Cipher;
use \Components\Base\Validation;
use \Components\Base\ErrorValidationException;
use \Components\Base\DataRegistry;
use \Components\Rate\CountryRate;
use \Components\Rate\AverageAdditionalRate;
use \Components\Rate\QuarterAdditionalRate;
use \Components\Rate\Multiple3AdditionalRate;
use \Components\Rate\Multiple4AdditionalRate;
use \Components\Base\AdapterDB;
use \Components\Base\Mapper;

/**
 * Class RecordGenerateFacade
 *
 * @package Components\Record
 */
class RecordGenerateFacade
{
    const RECORD_COUNT = 1000;

    /**
     * @var RecordCollection
     */
    private $recordCollection;

    /**
     * @var integer
     */
    private $averageValue = 0;

    /**
     * @var \PDO
     */
    private $dbAdapter;

    /**
     * @var Mapper\RecordMapper
     */
    private $mapper;


    public function __construct()
    {
        $this->setDbAdapter();
        $this->setMapper();
        $this->setRecordCollection(new RecordCollection());
    }

    /**
     * Generate record array
     *
     * @return void
     */
    public function recordsGenerate()
    {
        $faker = Factory::create();
        $i = 0;

        while ($i < self::RECORD_COUNT) {
            try {
                $newRecord = $this->recordGenerate($faker);
                Validation::instance()->run($newRecord);

                if (Validation::instance()->isErrors()) {
                    throw new ErrorValidationException(Validation::instance()->getErrors());
                }

                $newRecord['password'] = Cipher::passwordCrypt($newRecord['password']);
                $arrayRecord[$i] = $newRecord;
                $i++;
            } catch (ErrorValidationException $e) {
                echo $e->getErrors();
            }
        }

        usort($arrayRecord, 'self::date_compare');
        $this->createRecordCollection($arrayRecord);
    }

    /**
     * Create data collection
     *
     * @param array $data Data
     */
    private function createRecordCollection($data)
    {
        $mapper = $this->getMapper();

        for ($i = 0; $i < count($data); $i++) {
            $this->getRecordCollection()->addItem($mapper->createObject($data[$i]));
        }

    }

    /**
     *Insert data to DB
     */
    public function insertRecordToDb()
    {
        $keys = $this->recordCollection->keys();
        $mapper = $this->getMapper();

        foreach ($keys as $key) {
            $record = $this->recordCollection->getItem($key);
            $mapper->insert($record);
        }

        $this->calculateRating($keys);
    }

    /**
     * Set adapter for DB proccess
     */
    private function setDbAdapter()
    {
        $dbConfigFile = $_SERVER['DOCUMENT_ROOT'] . '/src/Config/db.ini';
        $iniArray = parse_ini_file($dbConfigFile);
        $this->dbAdapter = AdapterDB::getDbConn(
            $iniArray['hostname'],
            $iniArray['username'],
            $iniArray['password'],
            $iniArray['database']
        );
    }

    private function getDbAdapter()
    {
        return $this->dbAdapter;
    }

    private function setMapper()
    {
        $this->mapper = new Mapper\RecordMapper($this->getDbAdapter());
    }

    private function getMapper()
    {
        return $this->mapper;
    }

    public function getRecordCollection()
    {
        return $this->recordCollection;
    }

    private function setRecordCollection(RecordCollection $recordCollection)
    {
        $this->recordCollection = $recordCollection;
    }

    /**
     * Calculate rating
     *
     * @param array $keys Keys of collection
     */
    private function calculateRating($keys)
    {
        $mapper = $this->getMapper();

        foreach ($keys as $key) {
            $record = $this->recordCollection->getItem($key);
            $currDt = $record->getDt();
            $average = $mapper->getAvg($currDt);
            $currId = $record->getId();
            $quarter = self::getQuarterByMonth(date(('n'), strtotime($currDt)));
            DataRegistry::setId($currId);
            DataRegistry::setAverage($average);
            DataRegistry::setQuarter($quarter);
            $basicRate = new CountryRate($record->getCountryname());
            $totalRate =
                new AverageAdditionalRate(
                    new QuarterAdditionalRate(
                        new Multiple4AdditionalRate(
                            new Multiple3AdditionalRate($basicRate)
                        )
                    )
                );
            $record->setRating($totalRate->cost());
            $mapper->update($record);
        }
    }

    /**
     * Generate one record
     *
     * @param Generator $faker Generator
     * @return array
     */
    protected function recordGenerate(Generator $faker)
    {
        $data = array();

        $data['id'] = 0;
        $data['username'] = $faker->userName;
        $data['password'] = $faker->password;
        $data['firstname'] = $faker->firstName();
        $data['lastname'] = $faker->lastName;
        $data['countryname'] = $faker->country;
        $data['email'] = $faker->email;
        $data['zip'] = $faker->postCode;
        $data['dt'] = $faker->dateTimeThisYear(strtotime('31-12-2016'))->format('Y-m-d H:i:s');
        $data['rate'] = 0;

        return $data;
    }

    /**
     * Prepare data to view
     *
     * @return array
     */
    public function getDataForView()
    {
        $recordCollection = $this->getRecordCollection();
        $keys = $recordCollection->keys();
        $arrReturn = [];

        foreach ($keys as $key) {
            $oneRecord = [];
            $record = $recordCollection->getItem($key);
            $oneRecord['id'] = $record->getId();
            $oneRecord['username'] = $record->getUsername();
            $oneRecord['firstname'] = $record->getFirstname();
            $oneRecord['lastname'] = $record->getLastname();
            $oneRecord['country'] = $record->getCountryname();
            $oneRecord['rate'] = $record->getRating();
            $oneRecord['dataregistration'] = $record->getDt();
            $arrReturn[] = $oneRecord;
        }

        return $arrReturn;
    }

    /**
     * Sort muldidimentional array by datetime type column
     *
     * @param array $a Array
     * @param array $b Array
     *
     * @return boolean
     */
    public static function date_compare($a, $b)
    {
        $t1 = strtotime($a['dt']);
        $t2 = strtotime($b['dt']);

        return $t1 > $t2;
    }

    /**
     * Return quarter by month number
     *
     * @param $monthNumber
     *
     * @return float
     */
    public static function getQuarterByMonth($monthNumber) {
        return floor(($monthNumber - 1) / 3) + 1;
    }
}
