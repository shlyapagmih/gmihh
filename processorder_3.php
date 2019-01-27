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

include_once("db.php");
?>
<html>
<head>
    <title>Автозапчасти от Боба - Результаты заказа</title>
</head>
<body>
<h1>Лабораторная работа № 3 по теме сохранение и востановление данных посредством СУРБД - MySQL</h1>
<h2>Автозапчасти от Боба</h2>
<h3>Результаты заказа</h3>
<?php
$totalqty = 0;
$totalqty += $tireqty;
$totalqty += $oilqty;
$totalqty += $sparkqty;
$totalamount = 0.00;
define('TIREPRICE', 100);
define('OILPRICE', 10);
define('SPARKPRICE', 4);
$date = date('H:i, jS F');
echo '<p>Заказ обработан в ';
echo $date;
echo '<br />';
echo '<p>Список вашего заказа:';
echo '<br />';
if( $totalqty == 0 )
{
    echo 'Вы ничего не заказали на предыдущей странице!<br />';
}
else
{
    if ( $tireqty>0 )
        echo $tireqty.' автопокрышек<br />';
    if ( $oilqty>0 )
        echo $oilqty.' бутылок с маслом<br />';
    if ( $sparkqty>0 )
        echo $sparkqty.' свечей зажигания<br />';
}
$total = $tireqty * TIREPRICE + $oilqty * OILPRICE + $sparkqty * SPARKPRICE;
$total=number_format($total, 2, '.', ' ');
echo '<P>Итого по заказу: '.$total.'</p>';
echo '<P>ФИО клиента: '.$fio.'</p>';
echo '<P>Адрес доставки: '.$address.'<br />';
$outputstring = $date."\t".$tireqty." автопокрышек \t".$oilqty." масла\t"
    .$sparkqty." свечей\t\$".$total
    ."\t Адрес доставки товара\t ". $address."\t ФИО клиента:".$fio." \n";
// Открыть файл для добавления
$date_1=date ( "Y-m-d H:i:s",mktime ());
$query = "INSERT INTO zakaz (fio, adress, data) VALUES ('$fio', '$address', '$date_1')";
mysqli_query($connect, $query);
$query_1="SELECT zakaz.id  FROM zakaz WHERE  zakaz.fio='$fio' ";
$query_1_res = mysqli_query ($connect, $query_1);
while ($row = mysqli_fetch_array ($query_1_res)) {
    $id=$row['id'];
}
$query_2="INSERT INTO tovar (tiregty,oilgty,sparkgty) VALUES ('$tireqty','$oilqty','$sparkqty')";
mysqli_query ($connect, $query_2);
echo '<p>Заказ сохранен.</p>';
?>
<a href="vieworders_3.php"> Интерфейс персонала для просмотра файла заказов </a>
</body>
</html>
<?php
require('footer.inc');
?>