<?php

namespace App\Models\Contracts;

abstract class MysqlBaseModel extends BaseModel
{
    private string $dbConfigs;
    protected function __construct()
    {
        $this->dbConfigs = [
            'dsn' => "{$_ENV['DB']}:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']}",
            'password' => $_ENV['DB_PASS'],
            'username' => $_ENV['DB_USER']
        ];

        try {
            $this->connection = new \PDO($this->dbConfigs['dsn'], $this->dbConfigs['username'], $this->dbConfigs['password']);
            $this->connection->exec('set names utf8;');
        } catch (\PDOException $th) {
            throw new \PDOException("{$th->getMessage()} in line : {$th->getLine()} in file: {$th->getFile()}");
        }
    }
}
