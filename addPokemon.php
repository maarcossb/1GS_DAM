<?php

    include 'conexion.php';

    $sql1="INSERT INTO pokemon (pok_id, pok_name, pok_height, pok_weight, pok_base_experience) VALUES ($_POST[pok_id], '$_POST[pok_name]', $_POST[pok_height], $_POST[pok_weight], $_POST[pok_base_experience])";
    $sql2="INSERT INTO base_stats (pok_id, b_hp, b_atk, b_def, b_sp_atk, b_sp_def, b_speed) VALUES ($_POST[pok_id], $_POST[b_hp], $_POST[b_atk], $_POST[b_def], $_POST[b_sp_atk], $_POST[b_sp_def], $_POST[b_speed])";
    $sql3="INSERT INTO pokemon_types (pok_id, type_id, slot) VALUES ($_POST[pok_id], $_POST[type_id], $_POST[slot])";
    $sql4="INSERT INTO pokemon_evolution_matchup (pok_id, hab_id, gender_rate, capture_rate, base_happiness) VALUES ($_POST[pok_id], $_POST[hab_id], $_POST[gender_rate], $_POST[capture_rate], $_POST[base_happiness])";

    mysqli_query($conexion,$sql1) or die ("Error en la consulta de inserción $sql1");
    mysqli_query($conexion,$sql2) or die ("Error en la consulta de inserción $sql2");
    mysqli_query($conexion,$sql3) or die ("Error en la consulta de inserción $sql3");
    mysqli_query($conexion,$sql4) or die ("Error en la consulta de inserción $sql4");

    mysqli_close($conexion);

    header('Location: adminPokemon.php?limite=0');

?>