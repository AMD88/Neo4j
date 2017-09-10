# Neo4j-book-connections

* To use mongodb with php you need to use mongodb php driver. Download the driver from the url(https://s3.amazonaws.com/drivers.mongodb.org/php/index.html) Download PHP Driver. Make sure to download latest release of it. Now unzip the archive and put php_mongo.dll in your PHP extension directory ("ext" by default) and add the following line to your php.ini file:
extension=php_mongo.dll
Run the mongodb database  (mongod.exe) 

* Install neo4j by downloading from neo4j.com/download
* To establish the connection on neo4j using php we used php library downloaded from here  https://github.com/jadell/neo4jphp
* Composer was run to adjust dependencies relevant to neoclient using
  
  ````
  composer require "everyman/neo4jphp" "dev-master" 
  
  
* This was a helpful tutorial for that https://github.com/jadell/neo4jphp/wiki

Create Database
=================

1. Create the database named  “repo”
2. Create collection inside that repo named “invoices”
3. Copy the csv file to working folder and set the file path of “index.php”
4. Then run “ABC/index.php”

When it is run,
    
   * an API object would be created 
   * Since insertion is fast at mongodb,we first insert data to mongodb and then later input those data to graph database from where we access data
   * So in index.php, insertdb function would be run -  that would send all the data from the csv file to mongo db
   * getdb() function would call mapInvoice() of CustomerInvoice class and CategoryBook classes 
   * Then the graph database would be created with 274 nodes and 157 relationships as following 
            
