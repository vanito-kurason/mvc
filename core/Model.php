<?php
namespace Core;
use PDO;

class Model
{
	public static $link;

	public function __construct()
	{
		if (self::$link === NULL) {
			try {
				$dns = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
				self::$link = new PDO($dns, DB_USER, DB_PASS);
				self::$link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				self::$link->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES DB_CHARSET");
			}
			catch (\PDOException $e) {
				print "Error: " . $e->getMessage(). "<br/>";
				die();
			}
		}
	}

	protected function findOne(string $query, string $name): array
	{
		$stmt = self::$link->prepare($query);
		$stmt->execute([$name]);
		return $stmt->fetch();
	}

	protected function findMany(string $query): array
	{
		$stmt = self::$link->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll();
	}
}