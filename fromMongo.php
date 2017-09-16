<?php
   require('vendor/autoload.php');
   
class CustomerInvoice{
	   

	

//   print_r($client->getServerInfo());


	
	
function mapInvoice($InvoiceDate,$Category,$Qty,$NetAmt,$BookName,$CustomerCode){
$client = new Everyman\Neo4j\Client(
            (new Everyman\Neo4j\Transport\Curl('localhost',7474))
                ->setAuth('neo4j','1234')
   );
	
	$invoice = $client->makeNode();
	$invoice->setProperty('InvoiceDate', $InvoiceDate)
						->setProperty('Category', $Category)
						->setProperty('Qty', $Qty)
						->setProperty('NetAmt', $NetAmt)
						->setProperty('BookName', $BookName)
						->save();
			 
		$Label = $client->makeLabel('Invoice');
		$labels  = $invoice->addLabels(array($Label));
		
		
	
	
	
	
	$customer=$client->makeNode();
	$customer->setProperty('CustomerCode',$CustomerCode)
		
		
		->save();
		$Label = $client->makeLabel('Customer');
		$labels = $customer->addLabels(array($Label));	
	
	$CheckIndex = new Everyman\Neo4j\Index\NodeIndex($client, 'customer');
	$match=$CheckIndex->findOne('CustomerCode',$CustomerCode);
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
	$Index->add($customer, 'CustomerCode', $customer->getProperty('CustomerCode'));

	$customer->relateTo($invoice, 'PURCHASE')
				 ->save();
	}
	
   }
   }