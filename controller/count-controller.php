<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/includes/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/includes/function.php';

//Категории без дескрипшина (сервер)
$result = $pdo->query("SELECT COUNT(*)
FROM oc_category_description
LEFT JOIN oc_category on oc_category_description.category_id = oc_category.category_id
WHERE (`meta_description` ='' OR `meta_description` IS NULL) and oc_category.status = '1'");
$data = $result->fetch();
$countcategorydescription = $data['0'];

//Категории с повторяющимися опциями (сервер)  (выдает 2 вместо на 1)
$result = $pdo->query("SELECT DISTINCT COUNT(*)
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
$result = $pdo->query("SELECT COUNT(*)
FROM oc_category_description
LEFT JOIN oc_category on oc_category_description.category_id = oc_category.category_id
WHERE (`meta_title` ='' OR `meta_title` IS NULL) and oc_category.status = '1'");
$data = $result->fetch();
$countcategorytitle = $data['0'];

//товары без тайтла (сервер)
$result = $pdo->query("SELECT COUNT(*)
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
$result = $pdo->query("SELECT COUNT(*)
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
$result = $pdo->query("SELECT COUNT(*)
FROM oc_product
WHERE oc_product.image is null and oc_product.status= 1");
$data = $result->fetch();
$countnotimages = $data['0'];

//Товары c изображениями неактивные (сервер)
$result = $pdo->query("SELECT COUNT(*)
FROM oc_product
WHERE oc_product.image is not null and oc_product.status= 0");
$data = $result->fetch();
$countimagenotactive = $data['0'];

//Товары с несколькими опциями активные (сервер) (выдает 2 вместо на 1)
$result = $pdo->query("SELECT COUNT(*)
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
$result = $pdo->query("SELECT COUNT(*)
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