##siguanet-slimRest

RESTful (Representational State Transfer) API service for SIGUANET development with Slim PHP Framework (http://www.slimframework.com).
Slim is a PHP micro framework that helps you quickly write simple yet powerful web applications and APIs.

###What's SIGUANET?

SIGUANET is a free software project that aims to share the University of Alicante's corporate built asset management technology (SIGUA) with the developers community. In this sense, SIGUANET will hopefully be useful for other universities and academic organizations.

###What's siguanet-slimRest?

This is a light RESTful service, easy to use and install, that makes use of a SIGUANET database for providing a 
tool that helps developers to offer a wide range of solutions less restrictive than SOAP protocol. It's not a 
full service, and only a few methods have been created for evaluation purposes. It could be viewed as a bridge between 
the SIGUANET database and any kind of client apps.

###Database requirements

PostgreSQL 9.2 database, with PostGIS 2.0 or greater extension, created with siguanet-dbsetup tools.

###Web requirements

- Apache2 web server
- PHP 5.3 or greater
- Slim PHP framework
- PHP PDO extension

###Instalation and deployment

For installing Slim PHP framework visit their website: http://www.slimframework.com/install. We recomend creating a 
directory for Apache2 (ex. "/var/www/siguapi" ) and copying all Slim files
For siguanet-slimRest  use the folder where Slim Framework is installed and copy all this files:
- restGis.php: is the API RESTful begin point
- config.php: database connection parameters
- test (folder): HTML examples files for test this service.
- template/doc.php: documentation template
Finally execute this sql script: ws_schema.sql

###Demo

For testing purposes, open this URL with a browser:

*http://[your hostname]/[RESTful folder]/test/index.html*

Change path on html files if is required.

###Documentation (in spanish):

Built-in documentation can be browsed through a request to the API. Point to this url:

*http://[your hostname]/[RESTful folder]/restGis.php/doc*
