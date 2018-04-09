<?php
$pagetitle = "Производители товаров";
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/includes/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/view/header.html.php'; ?>
<h2><?php echo $pagetitle ?></h2>
<b>Всего: <?php echo $countmanufacture ?></b>



    <?php

    $arr = array(1, 2, 3, 4);
print_r($arr);


    foreach ($arr as &$row)
    {
        $row=$row*2;
    }



    echo "<br><br><br>________________________1<br><br><br>";
    print_r($arr);






    //    echo $manufacture[0]["all_goods"];
    echo "<br><br><br>________________________2<br><br><br>";
//    print_r($manufacture);
?>



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

                <a href="<?php echo 'https://pinkpet.ru' . '/manufacturer_id=' . $row['oc_manufacturerid'] ;
                ?>" target="_blank"> <?php htmlout($row['name']); ?></a>

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