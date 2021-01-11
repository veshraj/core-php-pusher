<?php

namespace Classes;

use Exception;
use PDO;

class DB
{
	private $connection;

	public function __construct()
	{

	}

	public function __call($method, $parameters)
	{
		if (method_exists($this, $method)) {
			return $this->$method(...$parameters);
		}
		throw  new Exception("Method does not exists", 500);

	}

	public function insert($table, $values)
	{
		$pdoConn = self::connect();
		$sql     = "INSERT INTO {$table} (" . implode(", ", array_keys($values)) . ") 
				VALUES (" . implode(",", array_fill(0, count($values), "?"))
				   . ")";

		try {
			$stmt = $pdoConn->prepare($sql);
			return $stmt->execute(array_values($values));
		}
		catch (Exception $e) {
			die($e->getMessage());
		}


	}

	public function select($query, $params = []) {
		$pdoConn = self::connect();
		try {
			$stmt = $pdoConn->prepare($query);
			$stmt->execute(array_values($params));
			return $stmt->fetchAll(\PDO::FETCH_OBJ);
		}
		catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function connect()
	{
		$databaseConfig = config('database');
		try {
			$pdoConnection = new PDO('mysql:host=' . $databaseConfig['host'] . ':' . $databaseConfig['port'] . ';
				dbname=' . $databaseConfig['dbname'] . '', $databaseConfig['username'], $databaseConfig['password']);
			$pdoConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $pdoConnection;
		}
		catch (Exception $e) {
			die($e->getMessage());
		}

	}
}