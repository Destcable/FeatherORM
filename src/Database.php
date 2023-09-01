<?php

namespace FeatherOrm;

use PDO;

class Database extends PDO
{
    public string $host;
    public string $username;
    public string $password;
    public string $dbname;
    
    public function __construct(string $host, string $username, string $password, string $dbname)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
    }
}