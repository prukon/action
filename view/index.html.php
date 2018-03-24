<?php
$pagetitle = "CMS";
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/includes/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/view/header.html.php';
?>
<table class="tftable" border="1">
    <tr>
        <th>SEO</th>
        <th>Отсутствует title</th>
        <th>Отсутствует description</th>
    </tr>
    <tr>
        <td>Товары</td>
        <td><a href="/action/view/goods1.html.php"><?php echo colorcount($countgoodstitle) ?></a></td>
        <td><a href="/action/view/goods2.html.php"><?php echo colorcount($countgoodsdescription) ?></td>
    </tr>
    <tr>
        <td>Категории</td>
        <td><a href="/action/view/category1.html.php"><?php echo colorcount($countcategorytitle) ?></a></td>
        <td><a href="/action/view/category2.html.php"><?php echo colorcount($countcategorydescription) ?></a></td>
    </tr>
</table>
<br>
<table class="tftable" border="1">
    <tr>
        <th colspan="2">Товары</th>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <th colspan="2">
            <label><input type="radio" name="image" value="hide" <?= ($check[0]['id'] == 0) ? 'checked' : '' ?>>
                 Только с фото
            </label>
            <label>
                <input type="radio" name="image" value="show" <?= ($check[0]['id'] == 1) ? 'checked' : '' ?>>
                Без фото
            </label>

            <form  class ="change-images" action="" method="post">
                <input type="submit" name="deletedoubles" value="Применить"/>
            </form>
        </form>
        </th>
        <th></th>
    </tr>
    <tr>
        <td></td>
        <td>Всего</td>
        <td>C фото</td>
        <td>Без фото</td>
        <td>С несколькими опциями</td>
    </tr>
    <tr>
        <td>Активные</td>
        <td><a href="/action/view/active.html.php"><?php echo colorcount2($countallgoods) ?></a></td>
        <td> <a href="/action/view/haveimages.html.php"><?php echo colorcount2($counthaveimages) ?></a> </td>
        <td> <a href="/action/view/notimages.html.php"><?php echo colorcount($countnotimages) ?></a></td>
        <td> <a href="/action/view/option.html.php"><?php echo colorcount($countoptions)  ?></a></td>
    </tr>
    <tr>
        <td>Неактивные</td>
        <td><a href="/action/view/notactive.html.php"><?php echo colorcount2($countnotactive) ?></a></td>
        <td> <a href="/action/view/haveimagesnotactive.html.php"><?php echo colorcount2($countimagenotactive) ?></a> </td>
        <td> <a href="/action/view/notimagesnotactive.html.php"><?php echo colorcount2($countnotimagenotactive) ?></a></td>
        <td> <a href="/action/view/optionnotactive.html.php"><?php echo colorcount($countoptionsnotactive)  ?></a></td>
    </tr>
</table>
<br>
<table class="tftable" border="1">
    <tr>
        <th>Категории</th>
        <th>Всего</th>
        <th>С несколькими опциями</th>
    </tr>
    <tr>
        <td>Категории</td>
        <td><a href="/action/view/category.html.php"><?php echo colorcount2($countcategory) ?></a>
            <form action="" method="post" class="countcategory">
                <input type="submit" name="countcategory" value="Рассчитать" >
            </form>
        </td>
        <td><a href="/action/view/doublecategoryoption.html.php"><?php echo colorcount($councategorydoubleoption) ?></a></td>
    </tr>
</table>
<br>
<table class="tftable" border="1">
    <tr>
        <th>Производители</th>
        <th>Всего</th>
        <th>С фото</th>
        <th>Без фото</th>
        <th>Товаров</th>

    </tr>
    <tr>
        <td>Активные</td>
        <td>Неактивные</td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
</table>
</body>
</html>