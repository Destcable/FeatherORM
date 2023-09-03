<?php
namespace FeatherOrm\Models;
use FeatherOrm\Model;
Class Users extends Model {
protected string $table = "users";
public array $fields = [
'id' => 'INT',
'name' => 'VARCHAR',
];
}
