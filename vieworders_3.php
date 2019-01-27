<?php
require('header.inc');
?>
<?php
// Создать короткие имена переменных
$tireqty = $_POST['tireqty'];
$oilqty = $_POST['oilqty'];
$sparkqty = $_POST['sparkqty'];
$fio = $_POST['fio'];
$address = $_POST['address'];
$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
?>
<html>
<head>
    <title>Автозапчасти от Боба - Заказы клиентов</title>
</head>
<body>
<h1>Лабораторная работа № 2 по теме сохранение и востановление данных посредством текстовых файлов</h1>
<h2>Автозапчасти от Боба</h2>
<h3>Заказы клиентов</h3>
<?php
include_once("db.php");

$query_1="SELECT zakaz.id, zakaz.fio, zakaz.adress, zakaz.data, tovar.id, tovar.tiregty, tovar.oilgty, tovar.sparkgty FROM zakaz, tovar WHERE  zakaz.id=tovar.id ORDER BY zakaz.data";
$result_1=mysqli_query ($connect, $query_1);
?>
<table border=1 color=black width=100% height=100%>
    <tr>
        <td>
            <b>№</b>
        </td>
        <td>
            <b>ФИО</b>
        </td>
        <td>
            <b>Адрес</b>
        </td>
        <td>
            <b>Дата заказа</b>
        </td>
        <td>
            <b>покрышки</b>
        </td>
        <td>
            <b>масла</b>
        </td>
        <td>
            <b>свечи</b>
        </td>
    <?
        while ($row_1 = mysqli_fetch_array ($result_1)) {
        $id = $row_1["id"];
        $fio = $row_1["fio"];
        $adress = $row_1["adress"];
        $data = $row_1["data"];
        $tireqty = $row_1["tiregty"];
        $oilqty = $row_1["oilgty"];
        $sparkqty =$row_1["sparkgty"];
        ?>
    <tr>
        <td> <? echo $id ?> </td>
        <td> <? echo $fio ?> </td>
        <td> <? echo $adress ?> </td>
        <td> <? echo $data ?> </td>
        <td> <? echo $tireqty ?> </td>
        <td> <? echo $oilqty ?> </td>
        <td> <? echo $sparkqty ?> </td>
    </tr>
    <?
    }
    ?> </table> <?
?>
</body>
</html>
<?php
require('footer.inc');
?>