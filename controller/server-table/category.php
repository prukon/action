<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/includes/config.php';
$table = <<<EOT
    (SELECT oc_product_to_category.category_id AS CATEGORY,
oc_product_to_category.category_id,
oc_category_description.name as name,
oc_category_description.meta_title as title,
oc_category_description.meta_description as description,
oc_product.`status`,
count(oc_product_to_category.category_id) as counter
FROM oc_product_to_category
LEFT JOIN oc_product on oc_product_to_category.product_id = oc_product.product_id
LEFT JOIN oc_category_description ON oc_product_to_category.category_id=oc_category_description.category_id
WHERE oc_product.`status` = 1
GROUP BY oc_product_to_category.category_id
ORDER BY `counter`  DESC
     ) temp
EOT;
$primaryKey = 'CATEGORY';
$columns = array(
    array('db' => 'CATEGORY', 'dt' => 0),
    array('db' => 'name', 'dt' => 1),
    array('db' => 'title', 'dt' => 2),
    array('db' => 'description', 'dt' => 3),
    array('db' => 'counter', 'dt' => 4)
);
$data = SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns);
foreach ($data["data"] as &$row) {
    $row[1] = "<a href='https://pinkpet.ru/category_id=" . $row[0] . '\' target="_blank"> ' . $row[1] . "</a>";
};
echo json_encode($data);



//$sql = 'SELECT DISTINCT oc_product_to_category.category_id AS CATEGORY,
//oc_product_to_category.category_id,
//oc_category_description.name as name,
//oc_category_description.meta_title as title,
//oc_category_description.meta_description as description,
//oc_product.`status`,
//  (SELECT COUNT(*) FROM oc_product_to_category
//   LEFT JOIN oc_product on oc_product.product_id = oc_product_to_category.product_id
//WHERE oc_product_to_category.`category_id` = CATEGORY and oc_product.`status` = 1) as counter
//FROM oc_product_to_category
//LEFT JOIN oc_product on oc_product_to_category.product_id = oc_product.product_id
//LEFT JOIN oc_category_description ON oc_product_to_category.category_id=oc_category_description.category_id
//WHERE oc_product.`status` = 1
//ORDER BY `counter`  DESC';
