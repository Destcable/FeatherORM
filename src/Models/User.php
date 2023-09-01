<?php
namespace FeatherOrm\Models;
use FeatherOrm\Model;
Class User extends Model {
protected string $table = "user";
public $id;
public $name;
}
