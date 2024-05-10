<?php

namespace App\Config;

use PDO;
use PDOException;
use PDOStatement;

class DataBase {
    private static PDO|null $pdo = null;
    private static PDOStatement $statement;

    public static function connect() {
        try {
            if (is_null(self::$pdo)) {
                $config = Config::$info;
                self::$pdo = new PDO($config['DB_DSN'], $config['DB_USER'], $config['DB_PASSWORD']);
            }
        } catch (PDOException $except) {
            echo $except->getMessage();
            exit('database error');
        }
    }

    public static function query(string $sql, array $binds, bool $execute = true): bool {
        static::$statement = static::$pdo->prepare($sql);

        foreach ($binds as $key => $value) {
            static::$statement->bindValue($key, $value);
        }

        if ($execute) {
            return static::$statement->execute();
        }

        return true;
    }

    public static function rowCount(): int {
        return static::$statement->rowCount();
    }

    public static function fetch($param) {
        return static::$statement->fetch($param);
    }

    public static function fetchAll($param): ?array {
        return static::$statement->fetchAll($param) ?? null;
    }

    public static function lastInsertId(): string|bool {
        return static::$pdo->lastInsertId();
    }
}
