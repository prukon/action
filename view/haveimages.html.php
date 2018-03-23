<?php
$pagetitle = "Товары с фото";
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
    <?php
    $i=1;
    ?>
    <?php foreach ($haveimage as $row):;
        ?>
        <tr>
            <td>
                <?php
                echo $i; ?>
            </td>
            <td>
                <?php htmlout($row['artukul']); ?>
            <td>
                <?php htmlout($row['price']); ?>
            </td>
            <td>
                <?php htmlout($row['brand']); ?>
            </td>
            <td>

                <a href="<?php echo 'https://pinkpet.ru' . '/product_id=' . $row['product_id'] ;
                ?>" target="_blank"> <?php htmlout($row['h1']); ?></a>
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
        <?php
        $i++;
        ?>
    <?php endforeach; ?>
    </tbody>
</table>


<a href="/action">Назад</a>
</body>
</html>