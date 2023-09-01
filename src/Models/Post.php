<?php
namespace FeatherOrm\Models;
use FeatherOrm\Model;
Class Post extends Model {
public $id;
public $createdAt;
public $updatedAt;
public $title;
public $content;
public $published;
public $author;
public $authorId;
}
