<?php

    include 'conexion.php';

    $sql="INSERT INTO abilities (abil_id, abil_name) VALUES ($_POST[abil_id], '$_POST[abil_name]')";

    mysqli_query($conexion,$sql) or die ("Error en la consulta de inserción $sql");

    mysqli_close($conexion);

    header('Location: adminAbilities.php?limite=0');

?>