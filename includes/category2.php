<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/includes/config.php';
//товары без title
$table = <<<EOT
    (SELECT
    oc_category_description.category_id,
    meta_title,
    meta_description,
    image
FROM oc_category_description
LEFT JOIN oc_category on oc_category_description.category_id = oc_category.category_id
WHERE (`meta_description` ="" OR `meta_description` IS NULL) and oc_category.status = "1"
     ) temp
EOT;
$primaryKey = 'category_id';
$columns = array(
    array('db' => 'category_id', 'dt' => 0),
    array('db' => 'meta_title', 'dt' => 1),
    array('db' => 'meta_description', 'dt' => 2),
    array('db' => 'image', 'dt' => 3)
);
$data = SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns);
//foreach ($data["data"] as &$row) {
//    $row[4] = "<a href='https://pinkpet.ru/product_id=" . $row[0] . '\' target="_blank"> ' . $row[4] . "</a>";
//};
echo json_encode($data);

