<?php 


$table = <<<EOT
(SELECT oc_product.product_id, sku as artukul, price, oc_manufacturer.name as brand, oc_product_description.name as h1, oc_product_description.meta_title as title,
 oc_product_description.description as description, oc_category_description.name AS category
FROM oc_product
LEFT JOIN oc_manufacturer ON oc_manufacturer.manufacturer_id = oc_product.manufacturer_id
LEFT JOIN oc_product_description ON oc_product_description.product_id = oc_product.product_id
LEFT JOIN oc_product_to_category ON oc_product.product_id = oc_product_to_category.product_id
LEFT JOIN oc_category_description ON oc_category_description.category_id = oc_product_to_category.category_id
WHERE (oc_product_description.meta_title ="" OR oc_product_description.meta_title IS NULL) and oc_product.status = 1

 ) temp

EOT;

$primaryKey = 'product_id';

$columns = array(
   array( 'db' => 'product_id',  'dt' => 0 ),
   array( 'db' => 'artukul',     'dt' => 1 ),
   array( 'db' => 'price',       'dt' => 2 ),
   array( 'db' => 'brand',       'dt' => 3 ),
   array( 'db' => 'h1',          'dt' => 4 ),
   array( 'db' => 'title',       'dt' => 5 ),
   array( 'db' => 'description', 'dt' => 6 ),
   array( 'db' => 'category',    'dt' => 7 )
);

// SQL server connection information
$sql_details = array(
    'user' => 'prukon_pinkpet',
    'pass' => '7Vw]**KX',
    'db'   => 'prukon_pinkpet',
    'host' => 'localhost',
    'charset' => 'utf8'
);



require( 'ssp.class.php' );
$data = SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns );




$i = 1;
foreach ($data["data"] as &$row) {
  $row[4] = "<a href='https://pinkpet.ru/product_id=" . $row[0] . '\' target="_blank"> '. $row[4] . "</a>";
  $row[0] = $i;
  $i++;
};



echo json_encode($data);

?>
