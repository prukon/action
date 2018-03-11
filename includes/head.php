<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
<meta charset="UTF-8">
<title><?php echo $pagetitle ?></title>
<!--    Подлкючаем css-->
    <link href="/action/includes/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">

    <!--    Подлкючаем js-->
    <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
            crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
    <script> $(document).ready(function () {
                $('#data').DataTable();
            }
        ); </script>
<?php
//include_once $_SERVER['DOCUMENT_ROOT'] . '/action/controller/main-controller.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/controller/count-controller.php';
//include_once $_SERVER['DOCUMENT_ROOT'] . '/action/controller/count.php';


    include_once $_SERVER['DOCUMENT_ROOT'] . '/action/includes/function.php';
    ?>
</head>