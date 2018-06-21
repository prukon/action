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


//if (isset($_POST['countcategory'])) {
//    $sql = 'SELECT oc_product_to_category.category_id AS CATEGORY,
//oc_product_to_category.category_id,
//oc_category_description.name as name,
//oc_category_description.meta_title as title,
//oc_category_description.meta_description as description,
//oc_product.`status`,
//count(oc_product_to_category.category_id) as counter
//FROM oc_product_to_category
//LEFT JOIN oc_product on oc_product_to_category.product_id = oc_product.product_id
//LEFT JOIN oc_category_description ON oc_product_to_category.category_id=oc_category_description.category_id
//WHERE oc_product.`status` = 1
//GROUP BY oc_product_to_category.category_id
//ORDER BY `counter`  DESC';
//    $result = $pdo->query($sql);
//    header('Location: .');
//}
//while ($row = $result->fetch()) {
//    $category[] = [
//        "category_id" => $row['CATEGORY']
//        , "name" => $row['name']
//        , "title" => $row['title']
//        , "description" => $row['description']
//        , "count" => $row['counter']
//    ];
//}
//ПОДСЧЕТ КАТЕГОРИЙ (Облегченный) (сервер)
if (isset($_POST['countcategory'])) {
$result = $pdo->query("SELECT COUNT(*)
FROM `oc_category`
WHERE `status` = 1 ");
$data = $result->fetch();
$countcategory = $data['0'];
}
//Категории без дескрипшина (сервер)
$result = $pdo->query("SELECT COUNT(*)
FROM oc_category_description
LEFT JOIN oc_category on oc_category_description.category_id = oc_category.category_id
WHERE (`meta_description` ='' OR `meta_description` IS NULL) and oc_category.status = '1'");
$data = $result->fetch();
$countcategorydescription = $data['0'];

//Категории с повторяющимися опциями (сервер)  (выдает 2 вместо на 1)
$result = $pdo->query("SELECT DISTINCT
COUNT(*)
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
  HAVING count(oc_product_option.product_id) > 1)");
$data = $result->fetch();
$councategorydoubleoption = $data['0'];

//Категории без тайтла (сервер)
$result = $pdo->query("SELECT count(*)
FROM oc_category_description
LEFT JOIN oc_category on oc_category_description.category_id = oc_category.category_id
WHERE (`meta_title` ='' OR `meta_title` IS NULL) and oc_category.status = '1'");
$data = $result->fetch();
$countcategorytitle = $data['0'];

//товары без тайтла (сервер)
$result = $pdo->query("SELECT count(*)
FROM oc_product
LEFT JOIN oc_product_description ON oc_product_description.product_id = oc_product.product_id
WHERE (oc_product_description.meta_title ='' OR oc_product_description.meta_title IS NULL)
and oc_product.status = 1");
$data = $result->fetch();
$countgoodstitle = $data['0'];

//Товары без дескрипшина (сервер)
$result = $pdo->query("SELECT COUNT(*)
FROM oc_product
LEFT JOIN oc_product_description ON oc_product_description.product_id = oc_product.product_id
WHERE (oc_product_description.meta_description ='' OR oc_product_description.meta_description =' '  OR oc_product_description.meta_description IS NULL) and oc_product.status = 1");
$data = $result->fetch();
$countgoodsdescription = $data['0'];

//Товары неактивные (сервер)
$result = $pdo->query("SELECT COUNT(*)
FROM oc_product
WHERE oc_product.status = 0");
$data = $result->fetch();
$countnotactive = $data['0'];

//Расчет всех товаров на сайте активных (сервер)
$result = $pdo->query("SELECT
    COUNT(*)
FROM oc_product
WHERE oc_product.status = 1");
$data = $result->fetch();
$countallgoods = $data['0'];

//Товары c изображениями активные (сервер)
$result = $pdo->query("SELECT  COUNT(*)
FROM oc_product
WHERE oc_product.image is not null and oc_product.status= 1");
$data = $result->fetch();
$counthaveimages = $data['0'];

//Товары без изображений активные (сервер)
$result = $pdo->query("SELECT count(*)
FROM oc_product
WHERE oc_product.image is null and oc_product.status= 1");
$data = $result->fetch();
$countnotimages = $data['0'];

//Товары c изображениями неактивные (сервер)
$result = $pdo->query("SELECT count(*)
FROM oc_product
WHERE oc_product.image is not null and oc_product.status= 0");
$data = $result->fetch();
$countimagenotactive = $data['0'];

//Товары с несколькими опциями активные (сервер) (выдает 2 вместо на 1)
$result = $pdo->query("SELECT
COUNT(*)
FROM oc_product_option
    LEFT JOIN oc_product ON oc_product.product_id = oc_product_option.product_id
	WHERE 	oc_product_option.product_id IN (
        	SELECT oc_product_option.product_id
        	FROM oc_product_option
        	LEFT  JOIN oc_product on oc_product.product_id = oc_product_option.product_id
        	WHERE oc_product.status= 1
        	GROUP BY oc_product_option.product_id
        	HAVING count(oc_product_option.product_id) > 1
        	)
    	and oc_product.status= 1
    GROUP BY oc_product_option.product_id");
$data = $result->fetch();
$countoptions = $data['0'];

//Товары без изображениями неактивные (сервер)
$result = $pdo->query("SELECT COUNT(*)
FROM oc_product
LEFT JOIN oc_manufacturer ON oc_manufacturer.manufacturer_id = oc_product.manufacturer_id
LEFT JOIN oc_product_description ON oc_product_description.product_id = oc_product.product_id
LEFT JOIN oc_product_to_category ON oc_product.product_id = oc_product_to_category.product_id
LEFT JOIN oc_category_description ON oc_category_description.category_id = oc_product_to_category.category_id
WHERE oc_product.image is null and oc_product.status= 0");
$data = $result->fetch();
$countnotimagenotactive = $data['0'];

//Товары с несколькими опциями неактивные (сервер)
$result = $pdo->query("SELECT
COUNT(*)
FROM oc_product_option
LEFT JOIN oc_product ON oc_product.product_id = oc_product_option.product_id
WHERE oc_product_option.product_id IN (
    SELECT oc_product_option.product_id
  FROM oc_product_option
   LEFT  JOIN oc_product on oc_product.product_id = oc_product_option.product_id
   WHERE oc_product.status= 1
  GROUP BY oc_product_option.product_id
  HAVING count(oc_product_option.product_id) > 1
)
 and oc_product.status= 0
  GROUP BY oc_product_option.product_id");
$data = $result->fetch();
$countoptionsnotactive = $data['0'];

//Производители, с каунтеррами активных и неактивных товаров (сервер)
$result = $pdo->query("SELECT COUNT(*)
FROM `oc_manufacturer`");
$data = $result->fetch();
$countmanufacture = $data['0'];