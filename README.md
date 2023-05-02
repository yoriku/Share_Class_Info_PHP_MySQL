# Share_Class_Info_PHP_MySQL

## Appendix.

This program was created with the goal of smoothly sharing class information under the influence of COVID19 in the spring of 2020. The concept of the service is based on a web application with a member registration function created the previous year. Since the development was completed in the summer of the same year, the UI has been cleaned up and released to the public this time.  
（このプログラムは，2020年の春にCOVID19の影響下で円滑に授業情報を共有することを目的に作成したものです．サービスの構想は前年に作成した会員登録機能を備えたWebアプリを基にしています．開発自体は同年夏ごろに終了したため，今回はUIをきれいにして公開しています．）

# Getting Start

1. Prepare core dir and config.php. Have to set on core/config.php and core/.htaccess

For Example config.php
~~~ PHP
$host = "localhost";
$user = "user";
$password = "password";
$dbname = "database_name";
~~~
For Example .htaccess
~~~ .htaccess
<Files ~ ".(dwt|php)$">
Deny from all
</Files>
~~~

2. Prepare PHP and MySQL server
3. Make database tables
~~~ SQL
CREATE TABLE class (class_id int not null auto_increment primary key, classname varchar(100) not null);
CREATE TABLE content (content_id int not null auto_increment primary key, class_id int not null, content varchar(300) not null);
~~~
4. Upload these programs
