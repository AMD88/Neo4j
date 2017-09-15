<?php
   require('vendor/autoload.php');
   
 class CategoryBook{
	   

	

//   print_r($client->getServerInfo());


	
	
function mapInvoice($BookName,$CategoryName){

   $client = new Everyman\Neo4j\Client(
            (new Everyman\Neo4j\Transport\Curl('localhost',7474))
                ->setAuth('neo4j','1234')
   );
	

//   print_r($client->getServerInfo());


	
	
	
	$invoice = $client->makeNode();
	$invoice->setProperty('BookName', $BookName)
						
						
						->save();
			 
		$Label = $client->makeLabel('Book');
		$labels  = $invoice->addLabels(array($Label));
		
		
	
	
	
	

}}
