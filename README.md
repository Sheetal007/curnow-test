# Getting started

## Installation

Please check the official cakephp installation guide for server requirements before you start. [Official Documentation](https://book.cakephp.org/4/en/installation.html)

Clone the repository

    git clone git@github.com:Sheetal007/curnow-test.git/

Switch to the repo folder

    cd crud-contact

Install all the dependencies using composer

    composer install

Configure your database settings in the `config/app.php` file(See: Datasource/default)

    vi config/app.php

Run the database migrations (**Set the database connection in app.php**)

    bin/cake migrations migrate
	
Start the local development server

    bin/cake server

You can now access the server at http://localhost:8765

## Database seeding

Run the database seeder and you're done

    bin/cake migrations seed
	

## Folders

- `src` - Contains all the application logic.
- `config` - Contains all the application configuration files.
- `src/Model/Entity` - Contains all cakephp ORM entites.
- `src/Model/Table` - Contains all cakephp ORM tables.
- `/config/Migrations` - Contains all the database migrations.

## Environment configuration

- `config/app.php` - Configuration settings can be set in this file

***Note*** : You can quickly set the database information and other variables in this file and have the application fully working.

----------

# Testing API

Run the cakephp development server

    bin/cake server


Request headers

| **Required** 	| **Key**              	| **Value**            	|
|----------	|------------------	|------------------	|
| Yes      	| Content-Type     	| application/json 	|


Insert data

URL = http://localhost:8765/api/contact
Method = POST
data = 
	{
	"first_name":"test first name",
	"last_name":"test last name",
	"company":"test company",
	"address":"testaddress ",
	"city":"test city",
	"county":"test country ",
	"state_province":"state or province",
	"zip":"123456",
	"phone_1":"123456789",
	"phone_2":"32654987",
	"email":"test@test.com",
	"web":"www.google.com"
	}


Get record by ID

URL = http://localhost:8765/api/contact/{record_id_here}
Method = get


Update record in Contact table

URL = http://localhost:8765/api/contact/{record_id_here}
Method = PUT
data = 
	{
	"first_name":"test first name",
	"last_name":"test last name",
	"company":"test company",
	"address":"testaddress ",
	"city":"test city",
	"county":"test country ",
	"state_province":"state or province",
	"zip":"123456",
	"phone_1":"123456789",
	"phone_2":"32654987",
	"email":"test@test.com",
	"web":"www.google.com"
	}


Delete record by ID

URL = http://localhost:8765/api/contact/{record_id_here}
Method = DELETE


Get record's

URL = http://localhost:8765/api/contact?page=1
Method = GET

----------
 
