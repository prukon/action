<?php
$pagetitle = "Активные товары";
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/includes/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/view/header.html.php'; ?>
<h2><?php echo $pagetitle ?></h2>
<b>Всего: <?php
    echo $countallgoods ?></b>

<table id="category1" class="display" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>id</th>
        <th>title</th>
        <th>description</th>
        <th>Изображение</th>
    </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<a href="/action">Назад</a>
</body>
</html>