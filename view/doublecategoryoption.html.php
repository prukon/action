<?php
$pagetitle = "Категории с повторяющими опциями";
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/includes/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/view/header.html.php'; ?>
<h2><?php echo $pagetitle ?></h2>
<!--<b>Всего: --><?php //echo $countnotactive ?><!--</b>-->

<h3>Обозначания опций</h3>



<table id="data" class="display" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>№</th>
        <th>id</th>
        <th>Название</th>
        <th>Удаление опций</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $i = 1;
    ?>
    <?php foreach ($categorydoubleoption as $row):; ?>
        <tr>
            <td>
                <?php echo $i; ?>
            </td>
            <td>
                <?php htmlout($row['category_id']); ?>
            </td>
            <td>
                <a  href="<?php echo 'https://pinkpet.ru' . '/category_id=' . $row['category_id'] ;
                ?>" target="_blank"> <?php htmlout($row['title']); ?></a>
            </td>
            <td>
                <?php
                $sql2 = 'SELECT oc_product_option.option_id as optionid
, oc_attribute_description.name as nameoption,
oc_option_description.name as nameoption2
FROM oc_product_option
INNER JOIN oc_product_to_category on oc_product_to_category.product_id = oc_product_option.product_id
LEFT JOIN oc_attribute_description on oc_attribute_description.attribute_id = oc_product_option.option_id
LEFT  JOIN oc_option_description ON oc_option_description.option_id = oc_product_option.option_id
-- LEFT JOIN oc_product on oc_product.product_id = oc_product_option.product_id
WHERE oc_product_to_category.category_id = :id
-- and oc_product.status= 1
GROUP BY oc_product_option.option_id';
                $s2 = $pdo->prepare($sql2);
                $s2->bindValue(':id', $row['category_id']);
                $s2->execute();
                while ($row2 = $s2->fetch()) {
                    $havecategory[] = [
                        "optionid" => $row2['optionid']
                        , "nameoption" => $row2['nameoption']
                        , "nameoption2" => $row2['nameoption2']
                    ];
                }
                foreach ($havecategory as $row2):; ?>
                    <form action="" method="post">
                        <input type="hidden" name="product_option_category" value="<?php echo $row2['optionid']; ?>">
                        <input type="hidden" name="product_category" value="<?php echo $row['category_id']; ?>">
                        <input type="submit" value="<?php
                        htmlout($row2['nameoption']);
                        echo "-";
                        htmlout($row2['nameoption2']);
                        echo "-";
                        htmlout($row2['optionid']);


                        ?>">
                    </form>
                <?php endforeach; ?>
            </td>
        </tr>
        <?php $i++;
    endforeach; ?>
    </tbody>
</table>
</body>
</html>