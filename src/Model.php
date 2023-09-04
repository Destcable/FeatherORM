<?php

namespace FeatherOrm;

use PDO;

abstract class Model
{
    private PDO $db;
    protected string $table;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function find(int $id)
    {
        $query = "SELECT * FROM $this->table WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create(array $data, )
    {
        foreach ($data as $nestedData) {
            if (is_array($nestedData)) {
                $this->createQuery($nestedData);
            } else {
                $this->createQuery($data);
            }
        }
    }

    public function update($id, array $data)
    {
        $updateData = [];
        foreach ($data as $key => $value) {
            $updateData[] = "$key = :$key";
        }
        $updateString = implode(", ", $updateData);
        $query = "UPDATE $this->table SET $updateString WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id", $id);
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        return $stmt->execute();
    }

    public function delete(int $id)
    {
        $query = "DELETE FROM $this->table WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }

    private function createQuery(array $data)
    {
        $columns = implode(", ", array_keys($data));
        $values = ":" . implode(", :", array_keys($data));
        $query = "INSERT INTO $this->table ($columns) VALUES ($values)";
        $stmt = $this->db->prepare($query);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        $stmt->execute();
    }

    public function createTable(array $data = null)
    {
        // echo '<pre>';
        // $tablename = $this->getFields()['table'];
        // $fields = $this->getFields();
        // unset($fields['table']);

        // print_r($fields);
        // $query = "CREATE TABLE $tablename ( id int )";
        // $stmt = $this->db->prepare($query);
        // return $stmt->execute();
    }
}
