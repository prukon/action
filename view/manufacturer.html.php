<?php
$pagetitle = "Производители товаров";
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/includes/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/view/header.html.php'; ?>
<h2><?php echo $pagetitle ?></h2>
<b>Всего: <?php echo $countmanufacture ?></b>

<table id ="manufacture" class="display" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>Артикул</th>
        <th>Название</th>
        <th>Всего товаров</th>
        <th>Активных товаров</th>
        <th>Неактивных товаров</th>
    </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<a href="/action">Назад</a>
</body>
</html>