<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/includes/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/includes/function.php';

//управление включением отображения изображений
if ((isset($_POST['image'])) and ($_POST['image'] == "show")) {
    //включаем активность товаров с фото
    $sql = "UPDATE oc_product SET status = 1 WHERE oc_product.image is null";
    $s = $pdo->prepare($sql);
    $s->execute();
    //включаем флаг активности радиокнопки в БД
    $sql = "UPDATE control set id = 1";
    $s = $pdo->prepare($sql);
    $s->execute();
    header('Location: .');
} elseif ($_POST['image'] == "hide") {
    //выключаем активность товаров без фото
    $sql = "UPDATE oc_product SET status=0 WHERE oc_product.image is null";
    $s = $pdo->prepare($sql);
    $s->execute();

    //выключаем флаг активности радиокнопки в БД
    $sql = "UPDATE control set id = 0";
    $s = $pdo->prepare($sql);
    $s->execute();
    header('Location: .');
}
//удаление одной опции у товара
if (isset($_POST['product_option_id'])) {

    $sql = 'DELETE FROM oc_product_option WHERE product_option_id = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $_POST['product_option_id']);
    $s->execute();
    header('Location: .');
}
//удаление дубля опции во всей категории
if (isset($_POST['product_option_category'])) {
    $sql = 'DELETE  FROM oc_product_option WHERE option_id = :id_option and  product_id IN (
SELECT product_id FROM oc_product_to_category WHERE category_id = :id_category)';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id_option', $_POST['product_option_category']);
    $s->bindValue(':id_category', $_POST['product_category']);
    $s->execute();
    header('Location: .');
}
// обработка кнопки удаление вторичных опций
if (isset($_POST['deletedoubles'])) {
    $sql = "
    DELETE
FROM oc_product_option
WHERE  `oc_product_option`.`option_id` = '4' and oc_product_option.product_id IN (SELECT  oc_product_to_category.product_id
FROM oc_product_to_category
where oc_product_to_category.category_id in ('137', '142'));

DELETE FROM oc_product_option
 WHERE  `oc_product_option`.`option_id` = '1' and oc_product_option.product_id IN (SELECT  oc_product_to_category.product_id
 FROM oc_product_to_category
 where oc_product_to_category.category_id IN ('103', '129', '130', '131','133','134','135','136','137','138','141','142','143','144'));

 DELETE
 FROM oc_product_option
 WHERE  `oc_product_option`.`option_id` = '6' and oc_product_option.product_id IN (SELECT  oc_product_to_category.product_id
 FROM oc_product_to_category
 where oc_product_to_category.category_id = '133');
";
    $s = $pdo->prepare($sql);
    $s->execute();
    header('Location: .');
}
// обработка кнопки удаление вторичных опций (версия 2)
if (isset($_POST['deletedoubles'])) {
    $sql = " DELETE
FROM oc_product_option
WHERE  `oc_product_option`.`option_id` = '1' and oc_product_option.product_id IN (SELECT  oc_product_to_category.product_id
FROM oc_product_to_category
where oc_product_to_category.category_id IN ('103', '129', '130', '131','132','133','134','135','136','137','138','141','142','143','144'))
";
    $s = $pdo->prepare($sql);
    $s->execute();
    header('Location: .');
}
//включаем флаг активности радиокнопки в БД
$sql = "SELECT `id` FROM `control`";
$result = $pdo->query($sql);
while ($row = $result->fetch()) {
    $check[] = $row['id'];
}

//ПОДСЧЕТ КАТЕГОРИЙ (Облегченный) (сервер)
if (isset($_POST['countcategory'])) {
    $result = $pdo->query("SELECT COUNT(*)
FROM `oc_category`
WHERE `status` = 1 ");
    $data = $result->fetch();
    $countcategory = $data['0'];
}