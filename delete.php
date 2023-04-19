<?php
session_start();
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=bmv_res', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt=$pdo->prepare("select * from cart where item_id=:item_id and user_id=:user_id");
$stmt->execute(array(':item_id'=>$_GET['item_id'],':user_id'=>$_SESSION['user_id']));
$row=$stmt->fetch(PDO::FETCH_ASSOC);
$_SESSION['totalcost']=$_SESSION['totalcost']-($row['Quantity']*$row['item_cost']);
$stmt=$pdo->prepare("delete from cart where item_id=:item_id and user_id=:user_id");
$stmt->execute(array(':item_id'=>$_GET['item_id'],':user_id'=>$_SESSION['user_id']));

header("Location:cart.php");
return;
?>