<?php

$host = $username = $password = $dbname = '';
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
if (if ($_SERVER['SERVER_NAME'] == "yii2promo.herokuapp.com") {) {
    $host = 'ec2-23-23-92-179.compute-1.amazonaws.com';
    $username = 'jnnbiayopidmsm';
    $password = '35e144d16b2d0348d1c6eff69f3b3f3d320c95a75a9d08a02b278d69cd0fd710';
    $dbname = 'd84g9naft02ago';
}else{
    $host = 'localhost';
    $username = 'root';
    $password = '1';
    $dbname = 'yii2catalog';
}

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host='.$host.';dbname='.$dbname,
    'username' => $username,
    'password' => $password,
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
