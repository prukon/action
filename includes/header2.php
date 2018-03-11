<?php
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

// SQL server connection information
$sql_details = array(
    'user' => 'prukon_pinkpet',
    'pass' => '7Vw]**KX',
    'db'   => 'prukon_pinkpet',
    'host' => 'localhost'
);


require( 'ssp.class.php' );

echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);

?>
