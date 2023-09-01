# FeatherOrm

##### Model (Post.feather)
```
model Post {
    id        INT
    createdAt DateTime
    updatedAt DateTime
    title     VARCHAR
    content   VARCHAR
    published Boolean 
    author    VARCHAR
    authorId  INT
}
```

#### Example use
```php 
use FeatherOrm\Database;
use FeatherOrm\Feather;

$database = new Database(
    host: 'host',
    username: 'user',
    password: 'password',
    dbname: 'database'
);

$feather = new Feather([
    'Post.feather'
]);

$feather->database($database);
```
