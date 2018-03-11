<?php
$pagetitle = "Неактивные товары";
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/includes/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/view/header.html.php'; ?>
<h2><?php echo $pagetitle ?></h2>


<?php
$sql = 'SELECT DISTINCT oc_product_to_category.category_id AS CATEGORY,
oc_product_to_category.category_id,
oc_category_description.name as name,
oc_category_description.meta_title as title,
oc_category_description.meta_description as description,
oc_product.`status`,
  (SELECT COUNT(*) FROM oc_product_to_category
   LEFT JOIN oc_product on oc_product.product_id = oc_product_to_category.product_id
WHERE oc_product_to_category.`category_id` = CATEGORY and oc_product.`status` = 1) as counter
FROM oc_product_to_category
LEFT JOIN oc_product on oc_product_to_category.product_id = oc_product.product_id
LEFT JOIN oc_category_description ON oc_product_to_category.category_id=oc_category_description.category_id
WHERE oc_product.`status` = 1
ORDER BY `counter`  DESC';
$result = $pdo->query($sql);


while ($row = $result->fetch()) {
    $category[] = [
        "category_id" => $row['CATEGORY']
        , "name" => $row['name']
        , "title" => $row['title']
        , "description" => $row['description']
        , "count" => $row['counter']
    ];
}
?>

<b>Всего: <?php echo $countcategory ?></b>
<table id="data" class="display" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>№</th>
        <th>id</th>
        <th>Название</th>
        <th>title</th>
        <th>description</th>
        <th>Товаров в категории</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $i = 1;
    ?>
    <?php foreach ($category as $row):;
        ?>
        <tr>
            <td>
                <?php echo $i; ?>
            </td>
            <td>
                <?php htmlout($row['category_id']); ?>

            </td>
            <td>
                <a href="<?php echo 'https://pinkpet.ru' . '/category_id=' . $row['category_id'];
                ?>" target="_blank"> <?php htmlout($row['name']); ?></a>
            </td>
            <td>
                <?php htmlout($row['title']); ?>
            </td>
            <td>
                <?php htmlout($row['description']); ?>
            </td>
            <td>
                <?php htmlout($row['count']); ?>
            </td>
        </tr>
        <?php
        $i++;
        ?>
    <?php endforeach; ?>
    </tbody>
</table>
<a href="/action">Назад</a>
</body>
</html>