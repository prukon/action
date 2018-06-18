<?php
$pdo = new PDO('mysql:host=localhost;dbname=prukon_pinkpet', 'prukon_pinkpet', '7Vw]**KX');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->exec('SET NAMES "utf8"');


$sql_details = array(
    'user' => 'prukon_pinkpet',
    'pass' => '7Vw]**KX',
    'db'   => 'prukon_pinkpet',
    'host' => 'localhost',
    'charset' => 'utf8'
);

require( 'ssp.class.php' );
