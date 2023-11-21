<?php
$link = mysqli_connect("localhost", "root", "") or die ("No se logro la conexion ..."); // utlizar mysqli_connect
$db = mysqli_select_db($link,"jiza-are"); // mysqli_select_db - primero la conexi贸n, despu茅s el nombre de la BD.
?>