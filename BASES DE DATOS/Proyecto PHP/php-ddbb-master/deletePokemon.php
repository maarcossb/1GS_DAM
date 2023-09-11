<?php

    include 'conexion.php';

    $sql0="SET FOREIGN_KEY_CHECKS=0";
    $sql1="DELETE FROM pokemon WHERE pok_id=$_GET[id]";
    $sql2="DELETE FROM base_stats WHERE pok_id=$_GET[id]";
    $sql3="DELETE FROM pokemon_types WHERE pok_id=$_GET[id]";
    $sql4="DELETE FROM pokemon_evolution_matchup WHERE pok_id=$_GET[id]";

    mysqli_query($conexion,$sql0) or die ("Error en la consulta de borrado $sql0");
    mysqli_query($conexion,$sql1) or die ("Error en la consulta de borrado $sql1");
    mysqli_query($conexion,$sql2) or die ("Error en la consulta de borrado $sql2");
    mysqli_query($conexion,$sql3) or die ("Error en la consulta de borrado $sql3");
    mysqli_query($conexion,$sql4) or die ("Error en la consulta de borrado $sql4");

    mysqli_close($conexion);

    header('Location: adminPokemon.php?limite=0');
?>