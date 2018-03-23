<?php

$pdo = new PDO('mysql:host=localhost;dbname=prukon_pinkpet', 'prukon_pinkpet', '7Vw]**KX');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->exec('SET NAMES "utf8"');

$table = 'datatables_demo';
$primaryKey = 'id';


$columns = array(
    array( 'prukon_pinkpet' => 'first_name', 'dt' => 0 ),
    array( 'prukon_pinkpet' => 'last_name',  'dt' => 1 ),
    array( 'prukon_pinkpet' => 'position',   'dt' => 2 ),
    array( 'prukon_pinkpet' => 'office',     'dt' => 3 ),
    array(
        'prukon_pinkpet'        => 'start_date',
        'dt'        => 4,
        'formatter' => function( $d, $row ) {
            return date( 'jS M y', strtotime($d));
        }
    ),
    array(
        'db'        => 'salary',
        'dt'        => 5,
        'formatter' => function( $d, $row ) {
            return '$'.number_format($d);
        }
    )
);



