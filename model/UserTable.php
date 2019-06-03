<?php


namespace Model;


class UserTable
{
	public $connection;

	public function __construct($connection)
	{
		$this->connection = $connection;
	}

	public function create($user)
	{
		$sql = "INSERT INTO users(email,password,name,job) VALUES (?,?,?,?)";
		$statement = $this->connection->prepare($sql);
		$statement->bindParam(1, $user->email);
		$statement->bindParam(2, $user->password);
		$statement->bindParam(3, $user->name);
		$statement->bindParam(4, $user->job);
		return $statement->execute();
	}

	public function getAll()
	{
		$sql = "SELECT * FROM users";
		$statement = $this->connection->prepare($sql);
		$statement->execute();

	}
	public function login($email, $password){
		$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
		$statement = $this->connection->prepare($sql);
		$statement->execute();
		$result = $statement->fetch();
		return $result;
	}
	public function find($email){
		$sql = "SELECT * FROM users WHERE email = '$email'";
		$statement = $this->connection->prepare($sql);
		$statement->execute();
		$result = $statement->fetch();
		$user = new User($result['email'], $result['password'], $result['name'],$result['job']);
		$user->id = $result['id'];
		return $user;
	}
	public function findById($id){
		$sql = "SELECT * FROM users WHERE id = '$id'";
		$statement = $this->connection->prepare($sql);
		$statement->execute();
		$result = $statement->fetch();
		$user = new User($result['email'], $result['password'], $result['name'],$result['job']);
		$user->id = $result['id'];
		return $user;
	}
	public function update($id, $editName, $editJob){
	    $sql = "UPDATE users SET name = '$editName', job = '$editJob' WHERE id = '$id'";
        $statement = $this->connection->prepare($sql);
        $statement->execute();

    }
    public function delete($id){
	    $sql = "DELETE FROM users WHERE id = '$id'";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
    }
}
