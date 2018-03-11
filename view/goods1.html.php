<?php
$pagetitle = "Товары без title";
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/includes/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/view/header.html.php'; ?>
<h2><?php echo $pagetitle ?></h2>
<b>Всего: <?php echo $countnotactive ?></b>

<table id ="data" class="display" cellspacing="0" width="100%">
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

    <?php $i=1; foreach ($goodstitle as $row):;
        ?>
        <tr>
            <td>
<?php
echo $i;
?>            </td>
            <td>
                <?php htmlout($row['artukul']); ?>
            <td>
                <?php htmlout($row['price']); ?>
            </td>
            <td>
                <?php htmlout($row['brand']); ?>
            </td>
            <td>
                <?php htmlout($row['h1']); ?>
            </td>
            <td>
                <?php htmlout($row['title']); ?>
            </td>
            <td>
                <?php htmlout($row['description']); ?>
            </td>
            <td>
                <?php htmlout($row['category']); ?>
            </td>

        </tr>
    <?php $i++; endforeach; ?>
    </tbody>
</table>
<a href="/action">Назад</a>
</body>
</html>