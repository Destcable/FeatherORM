<?php

namespace FeatherOrm;

use PDO;

class Database extends PDO
{
    public function __construct(string $host, string $username, string $password, string $dbname)
    {
        return new PDO("mysql:host={$host};dbname={$dbname}", $username, $password);
    }
}