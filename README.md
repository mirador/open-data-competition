#Mirador Competition Server

##Part 1: Ubuntu Server setup

1) Install [Ubuntu Server 14.04](https://help.ubuntu.com/14.04/).

2) Install the OpenSSH and LAMPS tasks using aptitude.

3) [Configure network](https://help.ubuntu.com/14.04/serverguide/network-configuration.html) (static IP, domain name, etc).

4) Install and configure [fail2ban]
(https://www.digitalocean.com/community/tutorials/how-to-install-and-use-fail2ban-on-ubuntu-14-04) to lock out users repeatedly trying to login

5) Install and configure [logwatch](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-logwatch-log-analyzer-and-reporter-on-a-vps) to get daily reports of system logs

6) Install [avahi](https://wiki.debian.org/ZeroConf) to use mirador.local from internal network

7) set [unattended upgrades](https://help.ubuntu.com/community/AutomaticSecurityUpdates) to automatically install security updates nightly and reboot if necessary.

##Part 2: Local test

1) Run any local AMP server, for example [AMPPS](http://www.ampps.com/)
In what follows, the instructions assume that you are using AMMPPS on MacOSX. Open AMMPPS 
up and start  Apache and mySQL, [phpMyAdmin](http://localhost/phpmyadmin) should work in the browser.

2) Copy the contents of www/html into /Applications/AMPPS/www. A better alternative to copy the files 
is to create a symbolic link /Applications/AMPPS/www (delete the original www folder in AMPPS first) to 
the html folder inside the local repo, in this way any changes can be tested immediately and keep under 
revision control:

```bash
ln -s <path_to_local_repo>/www/html /Applications/AMPPS/www
```


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

##Part 3: Website setup

General Information is available in the Apache2 Web Server chapter from the 
Ubuntu Server Guide:

https://help.ubuntu.com/14.04/serverguide/httpd.html

1) Create a webmasters group, add users to it, and grant shared write permission to 
/var/www/ for webmasters:

```bash
sudo addgroup webmasters
sudo adduser <user_name> webmasters
sudo chgrp -R webmasters /var/www
sudo find /var/www -type d -exec chmod g=rwxs "{}" \;
sudo find /var/www -type f -exec chmod g=rws  "{}" \;
```

https://help.ubuntu.com/14.04/serverguide/user-management.html

2) Copy static content to /var/www/html using sftp

3) Copy all php scripts to /var/www/html/classes, configure classes/db.php with appropriate parameters:

```php
<?php
define("DB_SERVER", "localhost");
define("DB_NAME", "access_user_db");
define ("DB_USER", "root");
define ("DB_PASSWORD", "password");
?>
```

DB_SERVER should remain as localhost, even for the live version of the server, the only 
change needed is for DB_PASSWORD, which should be the root password of MySQL. 

4) Change to folder containing the mySQL scripts, which should be /var/www/classes/sql_scripts

5) run mysql as root:

```bash
mysql -u root -p
```

6) create the "access_user_db" database:

```mysql
create database access_user_db;
use access_user_db;
```

7) Create all required databases by running the sql scripts:

```mysql
source users_table.sql;
source users_profile_table.sql;
source submissions.sql;
source sessions.sql;
source countries_table.sql;
```

Or create all the above tables by running the conglomerated sql script:

```mysql
source tables.sql;
```

##Acknowledgments

PHP scripts for user registration Copyright (c) 2004 - 2008, Olaf Lederer
http://www.finalwebsites.com/snippets.php?id=10

Java class for HTTP connection Copyright (c) 2008 - 2014 MK Yong 
http://www.mkyong.com/java/apache-httpclient-examples/




