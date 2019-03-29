<?php

use Kreait\Firebase\Configuration;
use Kreait\Firebase\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Query;


/**
 * This is a base class that handle firebase connection
 * Created At: 28 March, 2019
 */

class SBFirebase
{
	//Declare connection string
	public $database;

	//Connect with database for mysql database
	public function __construct()
	{		
		$serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/firebase.json');
		$firebase = (new Factory)->withServiceAccount($serviceAccount)
		->withDatabaseUri('https://demofirebase-2eb21.firebaseio.com')
		->create();
		$this->database = $firebase->getDatabase();
		
	}

	
	
	//fetch records	
	public function selectRecds($arr)
	{
		$resultObject = array();
		$reference = $this->database->getReference($arr['table']);
		
		$results = 	$reference->orderByChild($arr['field'])
					->equalTo($arr['value'])
					->getValue();
		if(isset($results) && !empty($results)){
			$resultObject = (object) $results;
		}
		return $resultObject;
	
	}
	
	public function selectAllRecds($table)
	{
		$resultObject = array();
		$reference = $this->database->getReference($table);
		
		$results = 	$reference->getValue();
		if(isset($results) && !empty($results)){
			$resultObject = (object) $results;
		}
		return (array)$resultObject;
	
	}
	
	public function getValueByRef($arr)
	{	
		/*this function is not working yet*/
		$resp = $this->database->getReference($arr['table']."/".$arr['node']); // this is the root reference
		return $resp->getSnapshot();

	}

	public function getChildsByKey($arr)
	{	
		$resp = $this->database->getReference($arr['table']); // this is the root reference
		return $resp->orderByKey()->getSnapshot()->getChild($arr['node'])->getValue();

	}

	public function selectRecd($arr)
	{
		$resultObject = array();
		$reference = $this->database->getReference($arr['table']);

		$results = 	$reference->orderByChild($arr['field'])
					->equalTo($arr['value'])
					->getValue();
		if(isset($results) && !empty($results)){
			$result  = array_values($results);
			$resultObject = (object) $result[0];
		}
		return $resultObject;
		
	}
	
	public function getLastInstertedId($arr)
	{
		$lastInstertedId = "1";
		$reference = $this->database->getReference($arr['table']);

		$results = 	$reference->orderByChild("id")->getValue();
		if(isset($results) && !empty($results)){
			$lastArray = end($results);
			$lastKey = key($results);
			$lastInstertedId = $results[$lastKey]['id'];
		}
		return (string) $lastInstertedId;
	}
		
	//Insert Data within table by accepting TableName and Table column
	public function insert($table,$data)
	{


		if(isset($data['phone']) && $data['phone']!=''){
			$newKey = $data['phone'];
		}else{
			// Create a key for a new post
			$newKey = $this->database->getReference($table)->push()->getKey();
		}

		$updates = [
		    $table."/".$newKey => $data,
		];

		$resp = $this->database->getReference() // this is the root reference
		   ->update($updates);
		//return $resp;
		return $newKey;
		
	}
	public function insertWithKey($table,$data)
	{


		$newKey = $this->database->getReference($table)->push()->getKey();
		$updates = [
		    $table."/".$newKey => $data,
		];

		$resp = $this->database->getReference() // this is the root reference
		   ->update($updates);
		return $resp;
	}

	
	//Delete data form table; Accepting Table Name and Keys=>Values as associative array
	public function deleteRec($arr)
	{
		$updates = [
		    $arr['table']."/".$arr['node'] => null,
		];

		$this->database->getReference() // this is the root reference
		   ->update($updates);

		$resp = $this->database->getReference($arr['table']."/".$arr['node']) // this is the root reference
		   ->remove($updates);		
		return $resp;

	}

	//Update data within table; Accepting Table Name and Keys=>Values as associative array
	public function updateRec($node,$data)
	{
		$updates = [
		    $node => $data,
		];
		$resp = $this->database->getReference() // this is the root reference
		   ->update($updates);
		return $resp;

	}
	
	function last_insert_id($table)
	{
		$res = $this->connection->query("SELECT MAX(id) as maxid from $table");
		$result = $res->fetch_object();
		if ( !empty($result) ) {
			return $result->maxid;
		}
	}
	
	

}