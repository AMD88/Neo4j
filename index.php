<?php
	ini_set('max_execution_time', 120);
   include 'interface.php';
   
   
   $api = new API();
   //$api->insertdb(5, "Anjana","The sky is falling",1, "ghjk", 4, 25, 100, 100, 10, 90);
   $file=fopen("data.csv","r");
   while(! feof($file))
   {
      $record=fgetcsv($file);
      $api->insertdb($record[0],$record[1],$record[2],$record[3],$record[4],$record[5],$record[6],$record[7],$record[8],$record[9],$record[10],$record[11],$record[12]);
  }
   fclose($file);
   
   $api->getdb();
?>