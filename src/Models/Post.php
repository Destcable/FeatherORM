<?php
namespace FeatherOrm\Models;
use FeatherOrm\Model;
Class Post extends Model {
protected string $table = "post";
public array $fields = [
'id' => 'INT',
'createdAt' => 'DateTime',
'updatedAt' => 'DateTime',
'title' => 'VARCHAR',
'content' => 'VARCHAR',
'published' => 'Boolean',
'author' => 'VARCHAR',
'authorId' => 'INT',
];
}
