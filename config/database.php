<?php
// die('database');
$connection = [
    'host' => '31.22.4.60',
    'user' => 'saudme_saud',
    'password' => 'j$+n_Aw4^)+$',
    'database' => 'saudme_hatm',
];
$mysqli = new mysqli($connection['host'], $connection['user'], $connection['password'], $connection['database']);

if ($mysqli->connect_error) {
    die("error connecting to database" . $mysqli->connect_error);
} else {
    // $mysqli->close();
    echo "connect";

}