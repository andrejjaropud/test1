# test1
The task is to generate list with users/clients, generate random fake information to simulate the real clients and calculate the rating of each of them based on some criteria’s.
The tasks are easy and its made in a way which will show best of your PHP coding knowledge. If you want you can use several classes or just one.
If you want you can use your own or external libraries like fzaninotto/Faker


Write a script which will create 1000 users and generate following data:
Username
Password (hint: do not use MD5/SHA1) (should be min 6 char, should contains: small and big letters, numbers, special symbols)
Country (Hungary, Germany, France, Russia, Ukraine, Bulgaria, Austria)
Email (there should be validation for correct email)
First name
Last name
ZIP Code
Date and time of registration (between: 2016-01-01 and 2016-12-31)
Active/Not active (all should be active)
Rating (integer, but NULL by default)

Class/Classes:
- To loop all users and calculate the “Rating” by follow parameters:
1) If the user is from:
Hungary: 2 points
Germany: 3 points
France: 4 points
Russia: 5 points
Ukraine: 6 points
Bulgaria: 7 points

2) If generated ID of the user is even 
if is even to 3, add(plus) 1 point to the rating
if is even to 4, add(plus) 2 points to the rating


3)  If is registered in the first quarter of the year, multiply by 1, if is the second one, multiply by 2, if is the third one multiple by 3, if is the last one multiply by 4

4) If the rating of someone is higher than the average of the people registered before him (you should calculate the rating by registration date) – then subtract (take out) 5 points from his rating points.



Requirements:
Security – let’s think that all information is entered by human
Speed – optimization for more speed calculation
PHP OOP
Each class should be able to be called just once (one instance)
Correct structuring of the MYSQL database (InnoDB)
Prepared Statements for all queries
Usage of  mysql transactions
HTML, CSS, JS – are not important – you can skip them or minimize usage.
Do NOT use any Framework’s like Symfony, Laravel, Zend, Yii…
