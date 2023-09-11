<?php

    include 'conexion.php';

    $sql="INSERT INTO pokemon_abilities (pok_id, abil_id, is_hidden, slot) VALUES ($_POST[pok_id], $_POST[abil_id], $_POST[is_hidden], $_POST[slot])";
    
    mysqli_query($conexion,$sql) or die ("Error en la consulta de inserción $sql");

    mysqli_close($conexion);

    header('Location: adminAbilities.php?limite=0');

?>