# FeatherOrm

##### Model Feather files
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

model User { 
    id   INT
    name VARCHAR
}
```

#### Example use
```php 
use FeatherOrm\Database;
use FeatherOrm\Feather;
use FeatherOrm\Models\Post;
use FeatherOrm\Models\User;

$database = new Database(
    host: 'host',
    username: 'user',
    password: 'password',
    dbname: 'database'
);

$feather = new Feather([
    'schemes/Post.feather',
    'schemes/User.feather'
]);

$feather->generateModels();

$post = new Post($database);
$user = new User($database);
```
