<?php

require_once __DIR__ . '/../.conf.php';

class DatabaseManager {

    private $pdo;
    private static $manager;

    private function __construct() {
        // default 3306
        $this->pdo = new PDO('mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME, DB_LOGIN, DB_PSSWD);
    }

    // Singleton: 1 instance de la classe maximum
    public static function getManager(): DatabaseManager {
        if (!isset(self::$manager)) {
            self::$manager = new DatabaseManager();
        }
        return self::$manager;
    }

    private function internalExec(string $sql, array $params = []): ?PDOStatement {
        $statement = $this->pdo->prepare($sql);
        if ($statement !== false) {
            if ($statement->execute($params)) {
                return $statement;
            }
            print_r($statement->errorInfo());
        }
        return NULL;
    }

    public function exec(string $sql, array $params = []): int {
        $statement = $this->internalExec($sql, $params);
        if ($statement) {
            return $statement->rowCount();
        }
        return 0;
    }

    public function getAll(string $sql, array $params = []): array {
        $statement = $this->internalExec($sql, $params);
        if ($statement) {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return [];
    }

    public function findOne(string $sql, array $params = []): ?array {
        $statement = $this->internalExec($sql, $params);
        if ($statement) {
            $res = $statement->fetch(PDO::FETCH_ASSOC);
            $statement->closeCursor();
            if ($res !== false) {
                return $res;
            }
        }
        return NULL;
    }

    public function lastInsertId(): int {
        return intval($this->pdo->lastInsertId());
    }

}

