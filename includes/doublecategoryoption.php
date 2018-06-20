<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/includes/config.php';
//товары без title
$table = <<<EOT
    (SELECT DISTINCT
oc_product_to_category.category_id,
oc_category_description.meta_title
FROM oc_product_option
LEFT JOIN oc_product_to_category on oc_product_to_category.product_id = oc_product_option.product_id
LEFT JOIN oc_product on oc_product.product_id = oc_product_to_category.product_id
LEFT JOIN oc_category_description on oc_category_description.category_id =oc_product_to_category.category_id
WHERE oc_product_option.product_id IN (
  SELECT oc_product_option.product_id
  FROM oc_product_option
  LEFT  JOIN oc_product on oc_product.product_id = oc_product_option.product_id
   WHERE oc_product.status= 1
  GROUP BY oc_product_option.product_id
  HAVING count(oc_product_option.product_id) > 1)
     ) temp
EOT;
$primaryKey = 'category_id';
$columns = array(
    array('db' => 'category_id', 'dt' => 0),
    array('db' => 'meta_title', 'dt' => 1)
);
$data = SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns);
foreach ($data["data"] as &$row) {
    $row[1] = "<a href='https://pinkpet.ru/category_id=" . $row[0] . '\' target="_blank"> ' . $row[1] . "</a>";
};







echo json_encode($data);



