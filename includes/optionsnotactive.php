<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/includes/config.php';
$table = <<<EOT
    (SELECT
product_option_id,
oc_product_option.product_id,
oc_product_option.option_id,
oc_product_option.value,
oc_product.model AS model,
oc_product_description.name AS h1,
oc_product_description.meta_title AS title,
oc_product_description.description as description,
oc_manufacturer.name as brand,
oc_category_description.name AS category,
oc_attribute_description.name AS attribute_name
FROM oc_product_option
LEFT JOIN oc_product ON oc_product.product_id = oc_product_option.product_id
LEFT JOIN oc_product_description ON oc_product_description.product_id = oc_product_option.product_id
LEFT JOIN oc_manufacturer ON oc_manufacturer.manufacturer_id = oc_product.manufacturer_id
LEFT JOIN oc_product_to_category ON oc_product.product_id = oc_product_to_category.product_id
LEFT JOIN oc_category_description ON oc_category_description.category_id = oc_product_to_category.category_id
LEFT JOIN oc_attribute_description ON oc_attribute_description.attribute_id = oc_product_option.option_id
LEFT JOIN oc_option_value_description ON oc_option_value_description.option_value_id = oc_product_option.option_id
WHERE oc_product_option.product_id IN (
    SELECT oc_product_option.product_id
  FROM oc_product_option
   LEFT  JOIN oc_product on oc_product.product_id = oc_product_option.product_id
   WHERE oc_product.status= 1
  GROUP BY oc_product_option.product_id
  HAVING count(oc_product_option.product_id) > 1
)
 and oc_product.status= 0
  GROUP BY oc_product_option.product_id
     ) temp
EOT;
$primaryKey = 'product_id';
$columns = array(
    array('db' => 'product_option_id', 'dt' => 0),
    array('db' => 'product_id', 'dt' => 1),
    array('db' => 'option_id', 'dt' => 2),
    array('db' => 'value', 'dt' => 3),
    array('db' => 'model', 'dt' => 4),
    array('db' => 'h1', 'dt' => 5),
    array('db' => 'title', 'dt' => 6),
    array('db' => 'description', 'dt' => 7),
    array('db' => 'brand', 'dt' => 8),
    array('db' => 'category', 'dt' => 9),
    array('db' => 'attribute_name', 'dt' => 10)
);
$data = SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns);
foreach ($data["data"] as &$row) {
    $row[1] = "<a href='https://pinkpet.ru/category_id=" . $row[0] . '\' target="_blank"> ' . $row[1] . "</a>";
};
echo json_encode($data);


