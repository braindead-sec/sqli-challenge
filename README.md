# sqli-challenge
A simple challenge used to teach SQL injection.

## Prerequisites
* apache
* mod_php
* mysql

## Setup
Start the mysql service and load sqlidemo.sql into it. This will create a database named "sqlidemo" with a user named "demo" and password "youllneverguessmypassword" (which you may want to change, in both the database and index.php).

Put index.php and hackerman.jpg into the apache webroot, then start the apache service. Make sure permissions are set appropriately for apache to serve the files.

SQL-Injection.pdf provides a handy single-page reference to teach people the basics of SQL injection (content from https://www.w3schools.com/sql/sql_injection.asp).

Hack away! There are multiple ways to solve the challenge, some of which will result in dumping of the database contents. Only set up this challenge on a host that contains no sensitive information.
