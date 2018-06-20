<?php
$pagetitle = "Категории с повторяющими опциями";
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/includes/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/view/header.html.php'; ?>
<h2><?php echo $pagetitle ?></h2>
<b>Всего: <?php echo $councategorydoubleoption ?></b>


<table id="doublecategoryoption" class="display" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>id</th>
        <th>Название</th>
<!--        <th>Удаление опций</th>-->
    </tr>
    </thead>
    <tbody>
    </tbody>
</table>
</body>
</html>