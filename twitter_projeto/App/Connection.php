<?php

namespace App;

class Connection {

	public static function getDb()
    {
		try {
            return new \PDO(
                "mysql:host=localhost;dbname=twitter_clone;charset=utf8",
                "diego",
                "root@123"
            );

		} catch (\PDOException $e) {
			//.. tratar de alguma forma ..//
		}
	}
}
