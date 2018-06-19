<?php
$pagetitle = "Товары с несколькими опциями";
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/includes/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/view/header.html.php'; ?>
<h2><?php echo $pagetitle ?></h2>
<b>Всего: <?php echo $countoptions ?></b>

<table id="options" class="display" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>0id</th>
        <th>1Артикул</th>
        <th>2Производитель</th>
        <th>3title</th>
        <th>4Description</th>
        <th>5Категория</th>
        <th>6Опции</th>
        <th>7Название опции</th>
        <th>8Управление</th>
    </tr>
    </thead>
 <tbody>
<?php
//    $i = 1;
//    ?>
<!--    --><?php //foreach ($options as $row):;
//        ?>
<!--        <tr>-->
<!--            <td>-->
<!--                --><?php
//                echo $i; ?>
<!--            </td>-->
<!--            <td>-->
<!--                --><?php //htmlout($row['product_id']); ?>
<!--            </td>-->
<!--            <td>-->
<!--                --><?php //htmlout($row['model']); ?>
<!--            <td>-->
<!--                --><?php //htmlout($row['brand']); ?>
<!--            </td>-->
<!--            <td>-->
<!--                <a href="--><?php //echo 'https://pinkpet.ru' . '/product_id=' . $row['product_id'] ;
//                ?><!--" target="_blank"> --><?php //htmlout($row['h1']); ?><!--</a>-->
<!--            </td>-->
<!--            <td>-->
<!--                --><?php //htmlout($row['title']); ?>
<!--            </td>-->
<!--            <td>-->
<!--                --><?php //htmlout($row['description']); ?>
<!--            </td>-->
<!--            <td>-->
<!--                --><?php //htmlout($row['category']); ?>
<!--            </td>-->
<!--            <td>-->
<!--                --><?php //htmlout($row['option_id']); ?>
<!--            </td>-->
<!--            <td>-->
<!--                --><?php //htmlout($row['attribute_name']); ?><!-- - --><?php //htmlout($row['value']); ?>
<!--            </td>-->
<!--            <td>-->
                <form action="" method="post">
                    <input type="hidden" name="product_option_id" value="<?php echo $row['product_option_id']; ?>">


                    <input type="submit" value="Удалить">
                </form>
<!--            </td>-->
<!--        </tr>-->
<!--        --><?php
//        $i++;
//        ?>
<!--    --><?php //endforeach; ?>
    </tbody>
</table>


<a href="/action">Назад</a>
</body>
</html>