<?php

try {
	$m = new Mongo();
	$db = $m->mydb;
	$collection = $db->mycollection;
	$id = uniqid();

	if(isset($_POST['data']))
		addToMongo(array('data'=>$_POST['data']), $id);
	else
		error_log("No data received");

} catch(MongoConnectionException $e){
	echo "Error Cannot connect to MongoDB.";
}

function addToMongo($document, $id){
	global $collection;

	$idQuery = array('id' => $id);
	if($collection->find($idQuery)->count() == 0){
		error_log("Added data");
		$collection->insert($document);
	}
	else
		error_log("Data already exists");
}

?>
