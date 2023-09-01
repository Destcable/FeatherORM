<?php

namespace FeatherOrm;

use PDO;
use FeatherOrm\TemplateModel;

class Feather
{
    private array $models = [];
    private PDO $db;

    public function __construct(array $models)
    {
        $this->models = $models;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function database(PDO $database)
    {
        return $this->db = $database;
    }

    public function generateModels()
    {
        spl_autoload_register(function ($className) {
            $baseDir = __DIR__ . '/src/';
            $classFile = $baseDir . str_replace('\\', '/', $className) . '.php';
            if (file_exists($classFile)) {
                require_once $classFile;
            }
        });

        for ($i=0; $i < count($this->models); $i++) { 
            
            $phpModel = $this->convertFeather(
                file_get_contents($this->models[$i])
            );

            $this->generateModel($phpModel);
            
            $class = "FeatherOrm\\Models\\{$phpModel['modelname']}";
            
            $this->__set(strtolower($phpModel['modelname']), new $class($this->db) );
        } 
    }

    private function generateModel(array $data)
    {
        $templateModel = new TemplateModel();
        $templateModel->generate($data);
    }

    private function convertFeather($file)
    {
        $modelname = null;

        $pattern_modelname = '/model\s+([A-Za-z_][A-Za-z0-9_]*)\s+\{/';
        if (preg_match($pattern_modelname, $file, $matches)) {
            $modelname = $matches[1];
        }

        $pattern2 = '/([A-Za-z_][A-Za-z0-9_]*)\s+([A-Za-z_][A-Za-z0-9_]*)/';

        if (preg_match_all($pattern2, $file, $matches, PREG_SET_ORDER)) {
            $field_data = [];

            foreach ($matches as $match) {

                if (trim($match[0]) == "model {$modelname}") {
                    continue;
                };

                $field_name = $match[1];
                $field_type = $match[2];

                $field_data[] = [
                    'name' => $field_name,
                    'type' => $field_type,
                ];
            }
        }

        return [
            'modelname' => $modelname,
            'data' => $field_data,
        ];
    }
}
