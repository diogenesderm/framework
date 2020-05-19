<?php

namespace Core;

use PDO;

abstract class BaseModel
{
    private $pdo;
    protected $table;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function all()
    {
        $query = "SELECT * FROM {$this->table}";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();
        return $result;
    }

    public function find($id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch();
        $stmt->closeCursor();
        return $result;
    }

    public function create(array $data)
    {
        $dados = $this->prepareDataInsert($data);

        $query = "INSERT INTO {$this->table} ({$dados[0]}) VALUES ({$dados[1]}) ";
        $stmt = $this->pdo->prepare($query);
        for ($i = 0; $i < count($dados[2]); $i++) {
            $stmt->bindValue("{$dados[2][$i]}", $dados[3][$i]);
        }

        $result = $stmt->execute();
        $stmt->closeCursor();
        return $result;
    }

    private function prepareDataInsert(array $data)
    {
        $strKeys = "";
        $strBinds = "";
        $binds = [];
        $values = [];

        foreach ($data as $key => $value) {
            $strKeys = "{$strKeys},{$key}";
            $strBinds = "{$strBinds},:{$key}";
            $binds[] = ":{$key}";
            $values[] = $value;
        }
        $strKeys = substr($strKeys, 1);
        $strBinds = substr($strBinds, 1);

        return [$strKeys, $strBinds, $binds, $values];
    }

    private function prepareDataUpdate(array $data)
    {
        $strKeysBinds = "";
        $binds = [];
        $values = [];

        foreach ($data as $key => $value) {

            $strBinds = "{$strKeysBinds},{$key}=:{$key}";
            $binds[] = ":{$key}";
            $values[] = $value;
        }
        $strKeysBinds = substr($strKeysBinds, 1);

        return [$strKeysBinds, $binds, $values];
    }

    public function update(array $data, $id)
    {
        $data = $this->prepareDataUpdate($data);
        $query = "UPDATE {$this->table} set {$data[0]} WHERE id=:id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":id", $id);
        for ($i = 0; $i < count($data); $i++) {
            $stmt->bindValue(":{$data[1][$i]}", $data[2][$i]);
        }
        $result = $stmt->execute();
        $stmt->closeCursor();

        return $result;
    }
}
