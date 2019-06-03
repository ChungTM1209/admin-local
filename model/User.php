<?php


namespace Model;


class User
{
	public $id;
	public $email;
	public $password;
	public $name;
	public $job;
	public function __construct($email, $password, $name, $job)
	{
		$this->email = $email;
		$this->password = $password;
		$this->name = $name;
		$this->job = $job;
	}
}
