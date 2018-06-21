<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/includes/config.php';
$table = <<<EOT
    (SELECT oc_manufacturer.`manufacturer_id` as oc_manufacturerid, oc_manufacturer.name
    ,(SELECT
          COUNT(oc_product.product_id)
    FROM oc_product
     WHERE oc_manufacturerid = oc_product.manufacturer_id
    ) as all_goods
    ,(SELECT
          COUNT(oc_product.product_id)
    FROM oc_product
     WHERE oc_manufacturerid = oc_product.manufacturer_id
      and oc_product.status = 1
    ) as active_goods
        ,(SELECT
          COUNT(oc_product.product_id)
    FROM oc_product
     WHERE oc_manufacturerid = oc_product.manufacturer_id
      and oc_product.status = 0
    ) as notactive_goods
FROM `oc_manufacturer`
     ) temp
EOT;
$primaryKey = 'oc_manufacturerid';
$columns = array(
    array('db' => 'oc_manufacturerid', 'dt' => 0),
    array('db' => 'name', 'dt' => 1),
    array('db' => 'all_goods', 'dt' => 2),
    array('db' => 'active_goods', 'dt' => 3),
    array('db' => 'notactive_goods', 'dt' => 4)
);
$data = SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns);
foreach ($data["data"] as &$row) {
    $row[1] = "<a href='https://pinkpet.ru/category_id=" . $row[0] . '\' target="_blank"> ' . $row[1] . "</a>";
};
echo json_encode($data);
