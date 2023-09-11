<?php

    include 'conexion.php';

    $sql="INSERT INTO moves (move_id, move_name, type_id, move_power, move_pp, move_accuracy) VALUES ($_POST[move_id], '$_POST[move_name]', $_POST[type_id], $_POST[move_power], $_POST[move_pp], $_POST[move_accuracy])";

    mysqli_query($conexion,$sql) or die ("Error en la consulta de inserción $sql");

    mysqli_close($conexion);

    header('Location: adminMoves.php?limite=0');

?>