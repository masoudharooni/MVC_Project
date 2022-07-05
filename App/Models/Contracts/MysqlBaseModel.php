<?php

namespace App\Models\Contracts;

use App\Exceptions\MedooException;
use Medoo\Medoo;
use PDO;

abstract class MysqlBaseModel extends BaseModel
{
    /**
     * Medoo connection
     */
    public function __construct()
    {
        try {
            $this->connection = new Medoo([
                'type' => $_ENV['DB'],
                'host' => $_ENV['DB_HOST'],
                'database' => $_ENV['DB_NAME'],
                'username' => $_ENV['DB_USER'],
                'password' => $_ENV['DB_PASS'],

                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'port' => 3306,

                'logging' => true,

                'error' => PDO::ERRMODE_EXCEPTION,

                'command' => [
                    'SET SQL_MODE=ANSI_QUOTES'
                ]
            ]);
        } catch (MedooException $th) {
            throw new MedooException("Medoo Connection faied: {$th->getMessage()}, in File: {$th->getFile()}, in Line: {$th->getLine()}");
        }
    }

    /**
     * it is used, to insert one or more columns into the database.
     *
     * @param array $data
     * @return integer: will return the last record id that has been added.
     */
    public function create(array $data): int
    {
        $this->connection->insert($this->table, $data);
        return $this->connection->id();
    }
    /**
     * it is used, to get one specific row of the database 
     *
     * @param integer $id
     * @param string $columns: if this parameter doesn't complete, all of the columns will return.
     * @return object
     */
    public function find(int $id, string|array $columns = '*'): object
    {
        return (object)($this->connection
            ->select($this->table, $columns, ["{$this->primaryKey}[=]" => $id])
        );
    }
    /**
     * it is used, to get a lot of rows of the database, but you can use it to get one specific row of the database too.
     *
     * @param array $where: if this parameter doesn't complete, all of the rows will return.
     * @param string $columns: if this parameter doesn't complete, all of the columns will return.
     * @return array
     */
    public function get(array $where = [], string|array $columns = '*'): array
    {
        return ($this->connection
            ->select($this->table, $columns, $where)
        );
    }
    /**
     * it is used, to update one or more row 
     *
     * @param array $data
     * @param array $where
     * @return integer: will return the number of all of the rows that have been changed
     */
    public function update(array $data, array $where): int
    {
        $result = $this->connection->update($this->table, $data, $where);
        return $result->rowCount();
    }
    /**
     * it is used, to delete one or more row
     *
     * @param array $where
     * @return integer: will return all of the rows that have been deleted
     */
    public function delete(array $where): int
    {
        $result = $this->connection->delete($this->table, $where);
        return $result->rowCount();
    }

    # Aggregation methods
    /**
     * it is used, to count number of rows of the database with a condition
     *
     * @param array $where
     * @return integer
     */
    public function count(array $where): int
    {
        return $this->connection->count($this->table, $where);
    }
    /**
     * it is used, to sure that a row is there or not
     *
     * @param array $where
     * @return boolean
     */
    public function exist(array $where): bool
    {
        return $this->connection->has($this->table, $where);
    }
    public function avg(string $column, array $where = []): int
    {
        return $this->connection->avg($this->table, $column, $where);
    }
    public function sum(string $column, array $where = []): int
    {
        return $this->connection->sum($this->table, $column, $where);
    }
}
