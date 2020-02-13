# App test with manage tasks with CakePHP

## Install

> $ composer install

## Config

### Create MySql database

```
CREATE DATABASE TaskManager;

CREATE TABLE users
(
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,    
name varchar(100) NOT NULL,
username varchar(100) NOT NULL,
password varchar(100) NOT NULL
);

CREATE TABLE tasks
(
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,  
title varchar(50) NOT NULL,
description text,
fkuser INT,
datecreate datetime not null,
datedone datetime,    
done boolean not null DEFAULT false
);
```
