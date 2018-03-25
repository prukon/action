<?php
$pagetitle = "Товары без title";
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/includes/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/view/header.html.php'; ?>
<h2><?php echo $pagetitle ?></h2>
<b>Всего: <?php echo $countmanufacture ?></b>

<table id ="data" class="display" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>№</th>
        <th>Артикул</th>
        <th>Название</th>
        <th>Всего товаров</th>
        <th>Активных товаров</th>
        <th>Неактивных товаров</th>
    </tr>
    </thead>
    <tbody>

    <?php $i=1; foreach ($manufacture as $row):;
        ?>
        <tr>
            <td>
<?php
echo $i;
?>            </td>
            <td>
                <?php htmlout($row['oc_manufacturerid']); ?>
            <td>
                <?php htmlout($row['name']); ?>
            </td>
            <td>
                <?php htmlout($row['all_goods']); ?>
            </td>
            <td>
                <?php htmlout($row['active_goods']); ?>

            </td>
            <td>
                <?php htmlout($row['notactive_goods']); ?>
            </td>
        </tr>
    <?php $i++; endforeach; ?>
    </tbody>
</table>
<a href="/action">Назад</a>
</body>
</html>