<?php

namespace FeatherOrm;

use PDO;
use FeatherOrm\Generator;
use FeatherOrm\Converter;

class Feather
{
    private array $models = [];
    private Database $db;

    public function __construct(array $models, Database $db)
    {
        $this->models = $models;
        $this->db = $db;
        $this->generateModels();
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    private function generateModels()
    {
        $generator = new Generator();
        $converter = new Converter();

        spl_autoload_register(function ($className) {
            $baseDir = __DIR__ . '/src/';
            $classFile = $baseDir . str_replace('\\', '/', $className) . '.php';
            if (file_exists($classFile)) {
                require_once $classFile;
            }
        });
        
        for ($i=0; $i < count($this->models); $i++) { 

            $phpModel = $converter->convertFeatherToModel(
                file_get_contents($this->models[$i])
            );

            $generator->generateModel($phpModel);
            
            $class = "FeatherOrm\\Models\\{$phpModel['modelname']}";
            
            $this->__set(strtolower($phpModel['modelname']), new $class($this->connectDatabase($this->db)) );
        } 
    }


    private function connectDatabase(Database $database): PDO
    { 
        return new PDO("mysql:host={$this->db->host};dbname={$this->db->dbname}", $this->db->username, $this->db->password);
    }
}
