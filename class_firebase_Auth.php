<?php

use Kreait\Firebase\Configuration;
use Kreait\Firebase\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Query;


/**
 * This is a base class that handle firebase User Authentication
 * Created At: 28 March, 2019
 */

class AuthFirebase
{
	//Declare authentication string
	public $auth;

	
	public function __construct()
	{		
		$serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/firebase.json');
		$firebase = (new Factory)->withServiceAccount($serviceAccount)
		->withDatabaseUri('https://demofirebase-2eb21.firebaseio.com')
		->create();
		$this->auth = $firebase->getAuth();
		
	}
	
	function ValidateUser($email,$password)
	{
		try {
			$user = $this->auth->verifyPassword($email, $password);
			return $user;
		}catch (Kreait\Firebase\Exception\Auth\CredentialsMismatch $e) {
			return $e->getMessage();
		}catch (Kreait\Firebase\Exception\Auth\EmailExists $e) {
			return $e->getMessage();
		}catch (Kreait\Firebase\Exception\Auth\InvalidCustomToken $e) {
			return $e->getMessage();
		}catch (Kreait\Firebase\Exception\Auth\InvalidPassword $e) {
			return $e->getMessage();
		}catch (Kreait\Firebase\Exception\Auth\MissingPassword $e) {
			return $e->getMessage();
		}catch (Kreait\Firebase\Exception\Auth\OperationNotAllowed $e) {
			return $e->getMessage();
		}catch (Kreait\Firebase\Exception\Auth\PhoneNumberExists $e) {
			return $e->getMessage();
		}catch (Kreait\Firebase\Exception\Auth\UserDisabled $e) {
			return $e->getMessage();
		}catch (Kreait\Firebase\Exception\Auth\UserNotFound $e) {
			return $e->getMessage();
		}catch (Kreait\Firebase\Exception\Auth\WeakPassword $e) {
			return $e->getMessage();
		}
		
	}
	
	
	function getUserData($uid)
	{
		try {
			$user = $this->auth->getUser($uid);
			return $user;
		}catch (Kreait\Firebase\Exception\AuthException $e) {
			return $e->getMessage();
		}
	}
	
	function addUser($email,$phone,$password,$name)
	{
		try{
			$userProperties = [
					'email' => $email,
					'emailVerified' => false,
					'phoneNumber' => $phone,
					'password' => $password,
					'displayName' => $name,
					'photoUrl' => '',
					'disabled' => false,
				];

			$createdUser = $this->auth->createUser($userProperties);
			return $createdUser;
		} catch (Kreait\Firebase\Exception\Auth\EmailExists $e) {
			return $e->getMessage();
		}catch (Kreait\Firebase\Exception\Auth\InvalidCustomToken $e) {
			return $e->getMessage();
		}catch (Kreait\Firebase\Exception\Auth\InvalidPassword $e) {
			return $e->getMessage();
		}catch (Kreait\Firebase\Exception\Auth\MissingPassword $e) {
			return $e->getMessage();
		}catch (Kreait\Firebase\Exception\Auth\OperationNotAllowed $e) {
			return $e->getMessage();
		}catch (Kreait\Firebase\Exception\Auth\PhoneNumberExists $e) {
			return $e->getMessage();
		}catch (Kreait\Firebase\Exception\Auth\UserDisabled $e) {
			return $e->getMessage();
		}catch (Kreait\Firebase\Exception\Auth\UserNotFound $e) {
			return $e->getMessage();
		}catch (Kreait\Firebase\Exception\Auth\WeakPassword $e) {
			return $e->getMessage();
		}
		
		
	}
	
	public function listUsers()
	{
		$users = $this->auth->listUsers($defaultMaxResults = 1000, $defaultBatchSize = 1000);
		$usersData=array();
		foreach ($users as $user) {
			/** @var \Kreait\Firebase\Auth\UserRecord $user */
			// ...
			$usersData[]=(array)$user;
		}
		return $usersData;
	}
	
	public function removeUser($userId)
	{
		try
		{
			$this->auth->deleteUser($userId);
			return "true";
		}catch (Kreait\Firebase\Exception\Auth\UserNotFound $e) {
			return $e->getMessage();
		}
	}
}