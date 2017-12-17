# test1
The task is to generate list with users/clients, generate random fake information to simulate the real clients and calculate the rating of each of them based on some criteria’s.
The tasks are easy and its made in a way which will show best of your PHP coding knowledge. If you want you can use several classes or just one.
If you want you can use your own or external libraries like fzaninotto/Faker


Write a script which will create 1000 users and generate following data:
<li>Username</li>
<li>Password (hint: do not use MD5/SHA1) (should be min 6 char, should contains: small and big letters, numbers, special symbols)</li>
<li>Country (Hungary, Germany, France, Russia, Ukraine, Bulgaria, Austria)</li>
<li>Email (there should be validation for correct email)</li>
<li>First name</li>
<li>Last name</li>
<li>ZIP Code</li>
<li>Date and time of registration (between: 2016-01-01 and 2016-12-31)</li>
<li>Active/Not active (all should be active)</li>
<li>Rating (integer, but NULL by default)</li>

Class/Classes:
- To loop all users and calculate the “Rating” by follow parameters:
1) If the user is from:

  <li>Hungary: 2 points</li>
  <li>Germany: 3 points</li>
  <li>France: 4 points</li>
  <li>Russia: 5 points</li>
  <li>Ukraine: 6 points</li>
  <li>Bulgaria: 7 points</li>


2) If generated ID of the user is even 
if is even to 3, add(plus) 1 point to the rating
if is even to 4, add(plus) 2 points to the rating


3)  If is registered in the first quarter of the year, multiply by 1, if is the second one, multiply by 2, if is the third one multiple by 3, if is the last one multiply by 4

4) If the rating of someone is higher than the average of the people registered before him (you should calculate the rating by registration date) – then subtract (take out) 5 points from his rating points.



Requirements:
<ul>
<li>Security – let’s think that all information is entered by human</li>
<li>Speed – optimization for more speed calculation</li>
<li>PHP OOP</li>
<li>Each class should be able to be called just once (one instance)</li>
<li>Correct structuring of the MYSQL database (InnoDB)</li>
<li>Prepared Statements for all queries</li>
<li>Usage of  mysql transactions</li>
<li>HTML, CSS, JS – are not important – you can skip them or minimize usage.</li>
<li>Do NOT use any Framework’s like Symfony, Laravel, Zend, Yii…</li>
</ul>
