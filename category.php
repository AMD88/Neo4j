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
		
		
	
	
	
	
	$customer=$client->makeNode();
	$customer->setProperty('CategoryName',$CategoryName)
		
		->save();
		$Label = $client->makeLabel('Category');
		$labels = $customer->addLabels(array($Label));	
	
	$CheckIndex = new Everyman\Neo4j\Index\NodeIndex($client, 'customer');
	$match=$CheckIndex->findOne('CategoryName',$CategoryName);
	//echo "dddd";
//	echo $match;
	if($match){
//		echo "oooooo";
		$customerID = $customer->getId();
		$wrong = $client->getNode($customerID);
		$wrong->delete();
		$match->relateTo($invoice, 'PURCHASE')
				 ->save();
	}
	else{
				 
	$Index = new Everyman\Neo4j\Index\NodeIndex($client, 'customer');
	$Index->save();
//	echo $customer->getProperty('CustomerCode');
	$Index->add($customer, 'CustomerCode', $customer->getProperty('CategoryName'));

	$customer->relateTo($invoice, 'BELONG')
				 ->save();
	}
}}
