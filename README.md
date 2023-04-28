# Share_Class_Info_PHP_MySQL
Created to exchange class information under the COVID19 epidemic

# Getting Start

1. Prepare core dir and config.php

For Example 
~~~ PHP
$host = "localhost";
$user = "user";
$password = "password";
$dbname = "database_name";
~~~


2. Prepare PHP server
3. Make database tables
~~~ SQL
CREATE TABLE class (class_id int not null auto_increment primary key, classname varchar(100) not null);
CREATE TABLE content (content_id int not null auto_increment primary key, class_id int not null, content varchar(300) not null);
~~~
