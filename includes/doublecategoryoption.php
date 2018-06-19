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
$row[2] = $sql2 = 'SELECT oc_product_option.option_id as optionid
, oc_attribute_description.name as nameoption,
oc_option_description.name as nameoption2
FROM oc_product_option
INNER JOIN oc_product_to_category on oc_product_to_category.product_id = oc_product_option.product_id
LEFT JOIN oc_attribute_description on oc_attribute_description.attribute_id = oc_product_option.option_id
LEFT  JOIN oc_option_description ON oc_option_description.option_id = oc_product_option.option_id
-- LEFT JOIN oc_product on oc_product.product_id = oc_product_option.product_id
WHERE oc_product_to_category.category_id = :id
-- and oc_product.status= 1
GROUP BY oc_product_option.option_id';
$s2 = $pdo->prepare($sql2);
$s2->bindValue(':id', $row['category_id']);
$s2->execute();
while ($row2 = $s2->fetch()) {
    $havecategory[] = [
        "optionid" => $row2['optionid']
        , "nameoption" => $row2['nameoption']
        , "nameoption2" => $row2['nameoption2']
    ];
}
foreach ($havecategory as $row2):; ?>
    <form action="" method="post">
        <input type="hidden" name="product_option_category" value="<?php echo $row2['optionid']; ?>">
        <input type="hidden" name="product_category" value="<?php echo $row['category_id']; ?>">
        <input type="submit" value="<?php
        htmlout($row2['nameoption']);
        echo "-";
        htmlout($row2['nameoption2']);
        echo "-";
        htmlout($row2['optionid']);
        ?>">
    </form>
<?php endforeach; ?>;



echo json_encode($data);



