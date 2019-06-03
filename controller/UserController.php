<?php

namespace Controller;

use Model\DBConnection;

use Model\User;
use Model\UserTable;


class UserController
{
	public $userTable;

	public function __construct()
	{
		$connection = new DBConnection("mysql:host=localhost;dbname=ecommage", "ChungTM1209", "Vod@nh1209");
		$this->userTable = new UserTable($connection->connect());
	}

	public function register()
	{
		$email = $_POST['email'];
		$password = md5($_POST['password']);
		$name = $_POST['name'];
		$job = $_POST['job'];
		$user = new User($email, $password, $name, $job);
		return $this->userTable->create($user);
	}
	public function login($email,$password){
//		$email = $_POST['email'];
		$password = md5($password);
		return $this->userTable->login($email, $password);
	}
	public function findByEmail($email){
		return $this->userTable->find($email);
	}
	public function logout(){
		session_destroy();
	}
	public function update($id,$editName, $editJob){
        return $this->userTable->update($id,$editName,$editJob);
    }
    public function findById($id){
        return $this->userTable->findById($id);
    }
    public function delete($id){
	    return $this->userTable->delete($id);
    }
}
