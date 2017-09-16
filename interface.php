<?php
require_once("fromMongo.php");
require_once("category.php");

class API{
	public $collection;

	function __construct(){
		$m = new MongoClient();
		// select a database
		$db = $m->repo;

		$this->collection = $db->invoices;
	}

	public function insertdb($CustomerCode, $CustomerName, $InvoiceDate, $BookCode, $BookName, $BookCategoryCode,$BookCategoryName, $Quantity, $Price, $Amount, $GrossTotal, $Discount, $NetTotal){

		$document = array(
			"CustomerCode" => $CustomerCode,
			"CustomerName" => $CustomerName,
			"InvoiceDate" => (strtotime($InvoiceDate)*1000),  //Convert date into time from 01/01/1970 to given date and convert to milliseconds
			"BookCode" => $BookCode,
			"BookName" => $BookName,
			"BookCategoryCode" => $BookCategoryCode,
			"BookCategoryName" => $BookCategoryName,
			"Quantity" => $Quantity,
			"Price" => $Price,
			"Amount" => $Amount,
			"GrossTotal" => $GrossTotal,
			"Discount" => $Discount,
			"NetTotal" => $NetTotal
		);

		$this->collection->insert($document);
		echo "Document inserted successfully";

	}

	public function getdb(){
		$cursor = $this->collection->find();
		$s=new CustomerInvoice();
		$s1=new CategoryBook();
		
		foreach ($cursor as $document) {
			/*echo $document["CustomerCode"] . "\n";
			echo $document["CustomerName"] . "\n";
			echo $document["BookName"] . "\n";
			echo $document["BookCategoryCode"] . "\n";
			echo $document["Discount"] . "\n";
			echo $document["NetTotal"] . "\n";
			$arr = array($document["CustomerCode"], $document["CustomerName"], $document["BookName"], $document["BookCategoryCode"], $document["Discount"], $document["NetTotal"]);

			*/
			
			echo $document["InvoiceDate"];
			$s->mapInvoice($document["InvoiceDate"],$document["BookCategoryCode"],$document["Quantity"],$document["NetTotal"],$document["BookName"],$document["CustomerCode"]);


$s1->mapInvoice($document["BookName"],$document["BookCategoryCode"]);

			
		}
	}

}

?>