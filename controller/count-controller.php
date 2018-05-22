<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/includes/config.php';
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
//Категории без тайтла
$sql = 'SELECT name
FROM oc_category_description
LEFT JOIN oc_category on oc_category_description.category_id = oc_category.category_id
WHERE (`meta_title` ="" OR `meta_title` IS NULL) and oc_category.status = "1"';
$result2 = $pdo->query($sql);
while ($row2 = $result2->fetch()) {
    $categorytitle[] = $row2['name'];
}
//Категории без дескрипшина
try {
    $sql = 'SELECT name
FROM oc_category_description
LEFT JOIN oc_category on oc_category_description.category_id = oc_category.category_id
WHERE (`meta_description` ="" OR `meta_description` IS NULL) and oc_category.status = "1"';
    $result2 = $pdo->query($sql);
} catch (PDOException $e) {
    $error = 'Ошибка при извлечении данных: ' . $e->getMessage();
    include 'error.html.php';
    exit();
}
while ($row2 = $result2->fetch()) {
    $categorydescription[] = $row['name'];
}
//товары без тайтла
$sql = 'SELECT oc_product.product_id, sku as artukul, price, oc_manufacturer.name as brand, oc_product_description.name as h1, oc_product_description.meta_title as title, oc_product_description.description as description, oc_category_description.name AS category
FROM oc_product
LEFT JOIN oc_manufacturer ON oc_manufacturer.manufacturer_id = oc_product.manufacturer_id
LEFT JOIN oc_product_description ON oc_product_description.product_id = oc_product.product_id
LEFT JOIN oc_product_to_category ON oc_product.product_id = oc_product_to_category.product_id
LEFT JOIN oc_category_description ON oc_category_description.category_id = oc_product_to_category.category_id
WHERE (oc_product_description.meta_title ="" OR oc_product_description.meta_title IS NULL) and oc_product.status = 1';
$result = $pdo->query($sql);
while ($row = $result->fetch()) {
    $goodstitle[] = [
        "product_id" => $row['product_id']
        , "artukul" => $row['artukul']
        , "price" => $row['price']
        , "brand" => $row['brand']
        , "h1" => $row['h1']
        , "title" => $row['title']
        , "description" => $row['description']
        , "category" => $row['category']
    ];
}
//Товары без дескрипшина
$sql = 'SELECT sku as artukul, price, oc_manufacturer.name as brand, oc_product_description.name as h1, oc_product_description.meta_title as title, oc_product_description.description as description, oc_category_description.name AS category
FROM oc_product
LEFT JOIN oc_manufacturer ON oc_manufacturer.manufacturer_id = oc_product.manufacturer_id
LEFT JOIN oc_product_description ON oc_product_description.product_id = oc_product.product_id
LEFT JOIN oc_product_to_category ON oc_product.product_id = oc_product_to_category.product_id
LEFT JOIN oc_category_description ON oc_category_description.category_id = oc_product_to_category.category_id
WHERE (oc_product_description.meta_description ="" OR oc_product_description.meta_description =" " OR oc_product_description.meta_description IS NULL) and oc_product.status = 1';
$result = $pdo->query($sql);
while ($row = $result->fetch()) {
    $goodsdescription[] = [
        "artukul" => $row['artukul']
        , "price" => $row['price']
        , "brand" => $row['brand']
        , "h1" => $row['h1']
        , "title" => $row['title']
        , "description" => $row['description']
        , "category" => $row['category']
    ];
}
//Категории с повторяющимися опциями
$sql = '
SELECT DISTINCT
oc_product_to_category.category_id,
oc_category_description.meta_title AS title
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
  HAVING count(oc_product_option.product_id) > 1)';
$result = $pdo->query($sql);
while ($row = $result->fetch()) {
    $categorydoubleoption[] = [
        "category_id" => $row['category_id']
        , "title" => $row['title']
        , "count" => $row['count']
    ];
}
//Товары неактивные
$sql = 'SELECT sku as artukul, price, oc_manufacturer.name as brand, oc_product_description.name as h1, oc_product_description.name as title, oc_product_description.description as description, oc_category_description.name AS category
FROM oc_product
LEFT JOIN oc_manufacturer ON oc_manufacturer.manufacturer_id = oc_product.manufacturer_id
LEFT JOIN oc_product_description ON oc_product_description.product_id = oc_product.product_id
LEFT JOIN oc_product_to_category ON oc_product.product_id = oc_product_to_category.product_id
LEFT JOIN oc_category_description ON oc_category_description.category_id = oc_product_to_category.category_id
WHERE oc_product.status = 0';

$result = $pdo->query($sql);
while ($row = $result->fetch()) {
    $notactive[] = [
        "artukul" => $row['artukul']
        , "price" => $row['price']
        , "brand" => $row['brand']
        , "h1" => $row['h1']
        , "title" => $row['title']
        , "description" => $row['description']
        , "category" => $row['category']
    ];
}
//ПОДСЧЕТ КАТЕГОРИЙ (Облегченный)
if (isset($_POST['countcategory'])) {
    $sql = 'SELECT oc_product_to_category.category_id AS CATEGORY,
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
ORDER BY `counter`  DESC';
    $result = $pdo->query($sql);
    header('Location: .');
}
while ($row = $result->fetch()) {
    $category[] = [
        "category_id" => $row['CATEGORY']
        , "name" => $row['name']
        , "title" => $row['title']
        , "description" => $row['description']
        , "count" => $row['counter']
    ];
}
//Расчет всех товаров на сайте активных
$sql = 'SELECT sku as artukul, price, oc_manufacturer.name as brand, oc_product_description.name as h1, oc_product_description.name as title, oc_product_description.description as description, oc_category_description.name AS category
FROM oc_product
LEFT JOIN oc_manufacturer ON oc_manufacturer.manufacturer_id = oc_product.manufacturer_id
LEFT JOIN oc_product_description ON oc_product_description.product_id = oc_product.product_id
LEFT JOIN oc_product_to_category ON oc_product.product_id = oc_product_to_category.product_id
LEFT JOIN oc_category_description ON oc_category_description.category_id = oc_product_to_category.category_id
WHERE oc_product.status = 1';

$result = $pdo->query($sql);
while ($row = $result->fetch()) {
    $allgoods[] = [
        "artukul" => $row['artukul']
        , "price" => $row['price']
        , "brand" => $row['brand']
        , "h1" => $row['h1']
        , "title" => $row['title']
        , "description" => $row['description']
        , "category" => $row['category']
    ];
}
//Товары c изображениями активные
$sql = 'SELECT oc_product.product_id as product_id,
sku as artukul, price, oc_manufacturer.name as brand, oc_product_description.name as h1, oc_product_description.name as title, oc_product_description.description as description, oc_category_description.name AS category
FROM oc_product
LEFT JOIN oc_manufacturer ON oc_manufacturer.manufacturer_id = oc_product.manufacturer_id
LEFT JOIN oc_product_description ON oc_product_description.product_id = oc_product.product_id
LEFT JOIN oc_product_to_category ON oc_product.product_id = oc_product_to_category.product_id
LEFT JOIN oc_category_description ON oc_category_description.category_id = oc_product_to_category.category_id
WHERE oc_product.image is not null and oc_product.status= 1';
//WHERE oc_product.image is null AND oc_product.sku LIKE "%o%"';
$result = $pdo->query($sql);
while ($row = $result->fetch()) {
    $haveimage[] = [
        "artukul" => $row['artukul']
        , "product_id" => $row['product_id']
        , "price" => $row['price']
        , "brand" => $row['brand']
        , "h1" => $row['h1']
        , "title" => $row['title']
        , "description" => $row['description']
        , "category" => $row['category']
    ];
}
//Товары без изображений активные
$sql = 'SELECT sku as artukul,
price, oc_manufacturer.name as brand,
oc_product_description.name as h1,
oc_product_description.name as title,
oc_product_description.description as description,
oc_category_description.name AS category
FROM oc_product
LEFT JOIN oc_manufacturer ON oc_manufacturer.manufacturer_id = oc_product.manufacturer_id
LEFT JOIN oc_product_description ON oc_product_description.product_id = oc_product.product_id
LEFT JOIN oc_product_to_category ON oc_product.product_id = oc_product_to_category.product_id
LEFT JOIN oc_category_description ON oc_category_description.category_id = oc_product_to_category.category_id
WHERE oc_product.image is null and oc_product.status= 1';
$result = $pdo->query($sql);
while ($row = $result->fetch()) {
    $notimage[] = [
        "artukul" => $row['artukul']
        , "price" => $row['price']
        , "brand" => $row['brand']
        , "h1" => $row['h1']
        , "title" => $row['title']
        , "description" => $row['description']
        , "category" => $row['category']
    ];
}
//Товары с несколькими опциями активные
$sql = 'SELECT
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
';
$result = $pdo->query($sql);
while ($row = $result->fetch()) {
    $options[] = [
        "product_id" => $row['product_id']
        , "model" => $row['model']
        , "brand" => $row['brand']
        , "h1" => $row['h1']
        , "title" => $row['title']
        , "description" => $row['description']
        , "category" => $row['category']
        , "option_id" => $row['option_id']
        , "attribute_name" => $row['attribute_name']
        , "value" => $row['value']
        , "product_option_id" => $row['product_option_id']
    ];
}
//Товары c изображениями неактивные
$sql = 'SELECT oc_product.product_id as product_id,
sku as artukul, price, oc_manufacturer.name as brand, oc_product_description.name as h1, oc_product_description.name as title, oc_product_description.description as description, oc_category_description.name AS category
FROM oc_product
LEFT JOIN oc_manufacturer ON oc_manufacturer.manufacturer_id = oc_product.manufacturer_id
LEFT JOIN oc_product_description ON oc_product_description.product_id = oc_product.product_id
LEFT JOIN oc_product_to_category ON oc_product.product_id = oc_product_to_category.product_id
LEFT JOIN oc_category_description ON oc_category_description.category_id = oc_product_to_category.category_id
WHERE oc_product.image is not null and oc_product.status= 0';
$result = $pdo->query($sql);
while ($row = $result->fetch()) {
    $imagenotactive[] = [
        "artukul" => $row['artukul']
        , "product_id" => $row['product_id']
        , "price" => $row['price']
        , "brand" => $row['brand']
        , "h1" => $row['h1']
        , "title" => $row['title']
        , "description" => $row['description']
        , "category" => $row['category']
    ];
}

//Товары без изображениями неактивные
$sql = 'SELECT oc_product.product_id as product_id,
sku as artukul, price, oc_manufacturer.name as brand, oc_product_description.name as h1, oc_product_description.name as title, oc_product_description.description as description, oc_category_description.name AS category
FROM oc_product
LEFT JOIN oc_manufacturer ON oc_manufacturer.manufacturer_id = oc_product.manufacturer_id
LEFT JOIN oc_product_description ON oc_product_description.product_id = oc_product.product_id
LEFT JOIN oc_product_to_category ON oc_product.product_id = oc_product_to_category.product_id
LEFT JOIN oc_category_description ON oc_category_description.category_id = oc_product_to_category.category_id
WHERE oc_product.image is null and oc_product.status= 0';
$result = $pdo->query($sql);
while ($row = $result->fetch()) {
    $notimagenotactive[] = [
        "artukul" => $row['artukul']
        , "product_id" => $row['product_id']
        , "price" => $row['price']
        , "brand" => $row['brand']
        , "h1" => $row['h1']
        , "title" => $row['title']
        , "description" => $row['description']
        , "category" => $row['category']
    ];
}
//Товары с несколькими опциями неактивные
$sql = 'SELECT
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
';
$result = $pdo->query($sql);
while ($row = $result->fetch()) {
    $optionsnotactive[] = [
        "product_id" => $row['product_id']
        , "model" => $row['model']
        , "brand" => $row['brand']
        , "h1" => $row['h1']
        , "title" => $row['title']
        , "description" => $row['description']
        , "category" => $row['category']
        , "option_id" => $row['option_id']
        , "attribute_name" => $row['attribute_name']
        , "value" => $row['value']
        , "product_option_id" => $row['product_option_id']
    ];
}
//Производители, с каунтеррами активных и неактивных товаров
$sql = 'SELECT oc_manufacturer.`manufacturer_id` as oc_manufacturerid, oc_manufacturer.name
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
 -- ORDER by  all_goods DESC
';
$result = $pdo->query($sql);
while ($row = $result->fetch()) {
    $manufacture[] = [
        "oc_manufacturerid" => $row['oc_manufacturerid']
        , "name" => $row['name']
        , "all_goods" => $row['all_goods']
        , "active_goods" => $row['active_goods']
        , "notactive_goods" => $row['notactive_goods']
    ];
}
$countcategorytitle = count($categorytitle);
$countcategorydescription = count($categorydescription);
$countgoodstitle = count($goodstitle);
$countgoodsdescription = count($goodsdescription);
$countnotimages = count($notimage);
$countnotactive = count($notactive);
$counthaveimages = count($haveimage);
$countoptions = count($options);
$countcategory = count($category);
$countallgoods = count($allgoods);
$councategorydoubleoption = count($categorydoubleoption);
$countimagenotactive = count($imagenotactive);
$countnotimagenotactive = count($notimagenotactive);
$countoptionsnotactive = count($optionsnotactive);
$countmanufacture = count($manufacture);








