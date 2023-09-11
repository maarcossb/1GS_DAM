<?php

    include 'conexion.php';

    $sql="INSERT INTO pokemon_moves (pok_id, version_group_id, move_id, method_id, level) VALUES ($_POST[pok_id], $_POST[version_id], $_POST[move_id], $_POST[method_id], $_POST[level])";
    
    mysqli_query($conexion,$sql) or die ("Error en la consulta de inserción $sql");

    mysqli_close($conexion);

    header('Location: adminMoves.php?limite=0');

?>