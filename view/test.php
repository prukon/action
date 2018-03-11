<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <title>Категории на сайте</title>

    <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
            crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
    <script> $(document).ready( function () { $('#data').DataTable(); } ); </script>
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/action/controller/count.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/action/includes/header23.php';
    ?>
</head>
<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/action/view/header.html.php'; ?>
<h2>Все товары без фото:</h2>

<script>
    $(document).ready(function() {
    $('#example').DataTable( {
"processing": true,
"serverSide": true,
"ajax": "../server_side/scripts/server_processing.php"
} );
} );
</script>



<script type="text/javascript">
    $(document).ready(function () {
        $('#datatable').DataTable({
            columns: [
                { 'data': 'FirstName' },
                { 'data': 'LastName' },
                { 'data': 'Gender' },
                { 'data': 'JobTitle' }
            ],
            bServerSide: true,
            sAjaxSource: 'EmployeeDataHandler.ashx'
        });
    });
</script>




<table id="datatable" class="display" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>First name</th>
        <th>Last name</th>
        <th>Position</th>
        <th>Office</th>
        <th>Start date</th>
        <th>Salary</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th>First name</th>
        <th>Last name</th>
        <th>Position</th>
        <th>Office</th>
        <th>Start date</th>
        <th>Salary</th>
    </tr>
    </tfoot>
</table>

</body>
</html>