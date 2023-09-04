<?php 

namespace FeatherOrm;

use FeatherOrm\TemplateModel;

class Generator
{
    public function generateModel(array $data) 
    {
        $templateModel = new TemplateModel();
        $templateModel->generate($data);
    }
}