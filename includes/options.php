<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/includes/config.php';
//товары без title
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
    and oc_product.status= 1
    GROUP BY oc_product_option.product_id
     ) temp
EOT;
$primaryKey = 'product_id';
$columns = array(
    array('db' => 'product_id', 'dt' => 0),
    array('db' => 'model', 'dt' => 1),
    array('db' => 'brand', 'dt' => 2),
    array('db' => 'title', 'dt' => 3),
    array('db' => 'description', 'dt' => 4),
    array('db' => 'category', 'dt' => 5),
    array('db' => 'option_id', 'dt' => 6),
    array('db' => 'attribute_name', 'dt' => 7),
    array('db' => 'attribute_name', 'dt' => 8)

);
$data = SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns);
foreach ($data["data"] as &$row) {
    $row[4] = "<a href='https://pinkpet.ru/product_id=" . $row[0] . '\' target="_blank"> ' . $row[4] . "</a>";
};

foreach ($data["data"] as &$row) {
    $row[8] = "<form action='' method='post'>
<input type='submit' value='Удалить'>
</form>";
};

echo json_encode($data);



//старый вывод
//while ($row = $result->fetch()) {
//    $options[] = [
//        "product_id" => $row['product_id']
//        , "model" => $row['model']
//        , "brand" => $row['brand']
//        , "h1" => $row['h1']
//        , "title" => $row['title']
//        , "description" => $row['description']
//        , "category" => $row['category']
//        , "option_id" => $row['option_id']
//        , "attribute_name" => $row['attribute_name']
//        , "value" => $row['value']
//        , "product_option_id" => $row['product_option_id']
//    ];
//}