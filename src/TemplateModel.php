<?php

namespace FeatherOrm;

class TemplateModel
{ 
    public function generate(array $data)
    { 
        $modelname = $data['modelname'];
        $file = fopen('./src/Models/' . $modelname . '.php', 'w');

        $buffer = "<?php";
        fwrite($file, $buffer."\r\n");
        
        $buffer = "namespace FeatherOrm\Models;";
        fwrite($file, $buffer."\r\n");

        $buffer = "use FeatherOrm\Model;";
        fwrite($file, $buffer."\r\n");

        $buffer = "Class {$modelname} extends Model {";
        fwrite($file, $buffer."\r\n");

        echo '<pre>';

        foreach ($data['data'] as $value) {
            print_r($value['name']);

            $buffer = "public $" . $value['name'] . ";";
            fwrite($file, $buffer."\r\n");
        }

        $buffer = "}";
        fwrite($file, $buffer."\r\n");

        fclose($file);
    }
}