<?php
$pagetitle = "Товары без description";
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/includes/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/view/header.html.php'; ?>

<h2><?php echo $pagetitle ?></h2>
<b>Всего: <?php echo $countgoodsdescription ?></b>

<table id ="good2" class="display" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>№</th>
        <th>Артикул</th>
        <th>Цена</th>
        <th>Производитель</th>
        <th>H1</th>
        <th>title</th>
        <th>Description</th>
        <th>Категория</th>
    </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<a href="/action">Назад</a>
</body>
</html>