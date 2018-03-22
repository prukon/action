<?php
$pagetitle = "Категории без дискришина";
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/includes/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/view/header.html.php'; ?>
<h2><?php echo $pagetitle ?></h2>
<b>Всего: <?php echo $countcategorydescription ?></b>




<?php foreach ($categorydescription as $row): ?>
    <blockquote>
        <p>
            <?php echo htmlspecialchars($row, ENT_QUOTES, 'UTF-8'); ?>
        </p>
    </blockquote>
<?php endforeach; ?> <br>
<a href="/action">Назад</a>
</body>
</html>