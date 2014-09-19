MODA
====

Repository holding the site for MODA

PHP scripts for user registration Copyright (c) 2004 - 2008, Olaf Lederer
http://www.finalwebsites.com/snippets.php?id=10

Java class for HTTP connection Copyright (c) 2008 - 2014 MK Yong 
http://www.mkyong.com/java/apache-httpclient-examples/

Local testing
====

1) Run any local AMP server, for example [AMPPS](http://www.ampps.com/)
In what follows, the instructions assume that you are using AMMPPS on MacOSX. Open AMMPPS 
up and start  Apache and mySQL, [phpMyAdmin](http://localhost/phpmyadmin) should work in the browser.

2) Clone this repo into the www classes directory within the AMPPS application

3) Open a terminal and set the path to the mySQL binary distribution inside AMPPS:

```bash
export PATH=$PATH:/Applications/AMPPS/mysql/bin
```
    
4) Change to folder containing the mySQL scripts, which should be /Applications/AMPPS/www/classes/sql_scripts

5) run mysql as root:

```bash
mysql -u root -p
```    

and enter "mysql" as the password
    
4) create the "access_user_db" database:

```bash
create database access_user_db;
use access_user_db;
```

5) Create all required databases by running the sql scripts:

```bash
source users_table.sql;
source users_profile_table.sql;
source submissions.sql;
source sessions.sql;
source countries_table.sql;
```

Or create all the above tables by running the conglomerated sql script:
```bash
source tables.sql;
```

6) The PHP pages should work now by going to localhost, for example the registration page:

[http://localhost/classes/access_user/register.php](http://localhost/classes/access_user/register.php)
