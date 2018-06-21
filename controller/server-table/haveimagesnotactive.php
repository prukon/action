<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/includes/config.php';
//товары без title
$table = <<<EOT
    (SELECT
    oc_product.product_id as product_id,
    sku as artukul, price,
    oc_manufacturer.name as brand,
    oc_product_description.name as h1,
    oc_product_description.name as title,
    oc_product_description.description as description,
    oc_category_description.name AS category
FROM oc_product
    LEFT JOIN oc_manufacturer ON oc_manufacturer.manufacturer_id = oc_product.manufacturer_id
    LEFT JOIN oc_product_description ON oc_product_description.product_id = oc_product.product_id
    LEFT JOIN oc_product_to_category ON oc_product.product_id = oc_product_to_category.product_id
    LEFT JOIN oc_category_description ON oc_category_description.category_id = oc_product_to_category.category_id
WHERE oc_product.image is not null and oc_product.status= 0
     ) temp
EOT;
$primaryKey = 'product_id';
$columns = array(
    array('db' => 'product_id', 'dt' => 0),
    array('db' => 'artukul', 'dt' => 1),
    array('db' => 'price', 'dt' => 2),
    array('db' => 'brand', 'dt' => 3),
    array('db' => 'h1', 'dt' => 4),
    array('db' => 'title', 'dt' => 5),
    array('db' => 'description', 'dt' => 6),
    array('db' => 'category', 'dt' => 7)
);
$data = SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns);
foreach ($data["data"] as &$row) {
    $row[4] = "<a href='https://pinkpet.ru/product_id=" . $row[0] . '\' target="_blank"> ' . $row[4] . "</a>";
};
echo json_encode($data);

