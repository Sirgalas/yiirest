<?php


if ($_SERVER['SERVER_NAME'] == "yii2promo.herokuapp.com") {
    $host = 'ec2-23-23-92-179.compute-1.amazonaws.com port=5432';
    $username = 'jnnbiayopidmsm';
    $password = '35e144d16b2d0348d1c6eff69f3b3f3d320c95a75a9d08a02b278d69cd0fd710';
    $dbname = 'd84g9naft02ago';
    $nameHost = 'pgsql';
}else{
    $host = 'localhost;';
    $username = 'root';
    $password = '1';
    $dbname = 'yii2catalog';
    $nameHost = 'mysql';
}

return [
    'class' => 'yii\db\Connection',
    'dsn' => $nameHost.':host='.$host.' dbname='.$dbname,
    'username' => $username,
    'password' => $password,
    'charset' => 'utf8',
    'enableSchemaCache' => true,
    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
