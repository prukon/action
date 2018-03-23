<?php
$pagetitle = "Категории на сайте";
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/includes/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/view/header.html.php'; ?>
<h2><?php echo $pagetitle ?></h2>
<b>Всего: <?php echo $countnotactive ?></b>

<table id="data" class="display" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>№</th>
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
                <?php
                echo $i; ?>
            </td>
            <td>
                <?php htmlout($row['name']); ?>
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