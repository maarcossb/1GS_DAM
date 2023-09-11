<?php

    include 'conexion.php';

    $sql1="DELETE FROM abilities WHERE abil_id=$_GET[id]";

    mysqli_query($conexion,$sql1) or die ("Error en la consulta de borrado $sql1");

    mysqli_close($conexion);

    header('Location: adminAbilities.php?limite=0');
?>