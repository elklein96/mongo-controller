<?php

try {
	$m = new Mongo();
	$db = $m->mydb;
	$collection = $db->mycollection;
	$cursor = $collection->find();

	if(isset($_POST['data']))
		retrieveDocs();
	else
		error_log("No data received");

} catch(MongoConnectionException $e){
	echo "Error Cannot connect to MongoDB.";
}

function retrieveDocs(){
	global $collection;
	$output = array();

	$cursor = $collection->find();
	$cursor->sort(array('path' => 1));

	$i=0;
   	foreach($cursor as $item){
       	$output[$i] = array(
           	'_id'=>$item['_id'],
           	'data'=>$item['data'],
           	'counter' => $i
        );
       	$i++;
    }
	echo json_encode($output);
}

?>
