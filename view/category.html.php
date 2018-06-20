<?php
$pagetitle = "Категории на сайте";
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/includes/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/view/header.html.php'; ?>
<h2><?php echo $pagetitle ?></h2>
<b>Всего: <?php
    $result = $pdo->query("SELECT COUNT(*)
    FROM `oc_category`
    WHERE `status` = 1 ");
    $data = $result->fetch();
    $countcategory = $data['0'];
    echo $countcategory ?></b>
<table id="category" class="display" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>id</th>
        <th>Название</th>
        <th>title</th>
        <th>description</th>
        <th>Товаров в категории</th>
    </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<a href="/action">Назад</a>
</body>
</html>