<?php
$pagetitle = "CMS";
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/includes/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/view/header.html.php';
?>

<!--<h2>--><?php //echo $pagetitle ?><!--</h2>-->
<h3>Тестовое сообщение</h3>
<table class="tftable" border="1">
    <tr>
        <th colspan="2">SEO</th>
    </tr>
    <tr>
        <td><a href="/action/view/category1.html.php">Категории без title</a></td>
        <td><?php echo colorcount($countcategorytitle) ?></td>
    </tr>
    <tr>
        <td><a href="/action/view/category2.html.php">Категории без description</a></td>
        <td><?php echo colorcount($countcategorydescription) ?></td>
    </tr>
    <tr>
        <td><a href="/action/view/goods1.html.php">Товары без title</a></td>
        <td> <?php echo colorcount($countgoodstitle) ?></td>
    </tr>
    <tr>
        <td><a href="/action/view/goods2.html.php">Товары без description</a></td>
        <td> <?php echo colorcount($countgoodsdescription) ?></td>
    </tr>
</table>
<br>
<table class="tftable" border="1">
    <tr>
        <th colspan="2">Контент</th>
    </tr>
    <tr>
        <td><a href="/action/view/notactive.html.php">Активные товары </a></td>
        <td><?php echo colorcount2($countallgoods) ?></td>
    </tr>
    <tr>
        <td><a href="/action/view/notactive.html.php">Неактивные товары </a></td>
        <td><?php echo colorcount2($countnotactive) ?></td>
    </tr>
    <tr>
        <td><a href="/action/view/notimages.html.php">Товары без фото </a></td>
        <td><?php echo colorcount($countnotimages) ?></td>
    </tr>
    <tr>
        <td><a href="/action/view/haveimages.html.php">Товары с фото</a></td>
        <td><?php echo colorcount2($counthaveimages) ?></td>
    </tr>
    <tr>
        <td><a href="/action/view/option.html.php">Товары с несколькими опциями</a></td>
        <td><?php echo colorcount($countoptions) ?></td>
    </tr>
    <tr>
        <td><a href="/action/view/category.html.php">Категории на сайте</a></td>
        <td><?php echo colorcount2($countcategory) ?>
            <form action="" method="post" class="countcategory">
            <input type="submit" name="countcategory" value="Рассчитать" >
</form>
        </td>
    </tr>
    <tr>
        <td><a href="/action/view/doublecategoryoption.html.php">Категории с несколькими опциями </a></td>
        <td><?php echo colorcount($councategorydoubleoption) ?></td>
    </tr>
</table>
<h2>Управление отображением</h2>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <table class="tftable" border="1">
        <tr>
            <th colspan="2">Товары без фото</th>
        </tr>
        <tr>
            <td><label>
                    <input type="radio" name="image" value="show" <?= ($check[0]['id'] == 1) ? 'checked' : '' ?>>
                    Да
                </label></td>
            <td><label><input type="radio" name="image" value="hide" <?= ($check[0]['id'] == 0) ? 'checked' : '' ?>>
                    Нет
                </label></td>
        </tr>
    </table>
    <br>
    <input type="submit" value="Применить"/>
</form>
<h3>Удаление вторичных опций у товаров</h3>
<form action="" method="post">
    <input type="submit" name="deletedoubles" value="Удалить"/>
    </form>
</body>
</html>