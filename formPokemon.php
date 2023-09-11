<html>
    <head>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <!-- Icono de la página -->
		<link rel="shortcut icon" href="images/iconoPokemon.png">
        
        <title>Add Pokemon</title>
    </head>
    <body>
        <?php
            include("conexion.php");
            // Consulta para leer los datos de la tabla 'types'
            $sql1="SELECT * FROM types";
            $registros1=mysqli_query($conexion,$sql1) or die ("Error en la consulta $sql1");

            // Consulta para leer los datos de la tabla 'pokemon_habitats'
            $sql2="SELECT * FROM pokemon_habitats";
            $registros2=mysqli_query($conexion,$sql2) or die ("Error en la consulta $sql2");

            // Consulta para leer los datos de la tabla 'pokemon' 
            $sql3="SELECT * FROM pokemon ORDER BY pok_name";
            $registros3=mysqli_query($conexion,$sql3) or die ("Error en la consulta $sql3");
        ?>

    <div class="container">
        <div class="row">
            <div class="container col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <br><center><h1>Add a new Pokemon</h1></center><br>
                <form name="datos" id="datos" action="addPokemon.php" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <?php
                                $sql4="SELECT MAX(pok_id) AS pok_id FROM pokemon";
                                $registros4=mysqli_query($conexion,$sql4) or die ("Error en la consulta $sql4");
                                $pok_id=mysqli_fetch_array($registros4);
                                $pok_id=$pok_id['pok_id']+1;
                            ?>
                            <label for="pok_id">Id</label>
                            <input type="number" class="form-control" id="pok_id" name="pok_id" value="<?php echo $pok_id ?>" readonly>
                        </div>
                        <div class="form-group col-md-10">
                            <label for="pok_name">Name</label>
                            <input type="text" class="form-control" id="pok_name" maxlegnth="25" name="pok_name" autofocus required> 
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="pok_height">Height</label>
                            <input type="number" class="form-control" id="pok_height" name="pok_height" min="0" max="50" step="0.1" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="pok_weight">Weight</label>
                            <input type="number" class="form-control" id="pok_weight" name="pok_weight" min="0" max="1500" step="0.1" required> 
                        </div>
                        <div class="form-group col-md-4">
                            <label for="pok_base_experience">Base experience</label>
                            <input type="number" class="form-control" id="pok_base_experience" name="pok_base_experience" min="0" max="1000" required> 
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="b_hp">Health Points</label>
                            <input type="number" class="form-control" id="b_hp" name="b_hp" min="0" max="500" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="b_atk">Attack</label>
                            <input type="number" class="form-control" id="b_atk" name="b_atk" min="0" max="500" required> 
                        </div>
                        <div class="form-group col-md-2">
                            <label for="b_def">Defense</label>
                            <input type="number" class="form-control" id="b_def" name="b_def" min="0" max="500" required> 
                        </div>
                        <div class="form-group col-md-2">
                            <label for="b_sp_atk">Special Attack</label>
                            <input type="number" class="form-control" id="b_sp_atk" name="b_sp_atk" min="0" max="500" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="b_sp_def">Special Defense</label>
                            <input type="number" class="form-control" id="b_sp_def" name="b_sp_def" min="0" max="500" required> 
                        </div>
                        <div class="form-group col-md-2">
                            <label for="b_speed">Speed</label>
                            <input type="number" class="form-control" id="b_speed" name="b_speed" min="0" max="500" required> 
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-1">
                            <label for="slot">Slot</label>
                            <input type="slot" class="form-control" id="slot" name="slot" value="1" readonly> 
                        </div>
                        <div class="form-group col-md-6">
                            <label for="type_id">Type</label>
                            <select id="type_id" name="type_id" class="form-control" required>
                                <?php
                                    while($fila=mysqli_fetch_array($registros1)) { 
                                        echo "<option value='$fila[type_id]'>$fila[type_name]</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="hab_id">Habitat</label>
                            <select id="hab_id" name="hab_id" class="form-control" required>
                                <?php
                                    while($fila=mysqli_fetch_array($registros2)) { 
                                        echo "<option value='$fila[hab_id]'>$fila[hab_name]</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="gender_rate">Gender rate</label>
                            <input type="number" class="form-control" id="gender_rate" name="gender_rate" min="-1" max="10" required> 
                        </div>
                        <div class="form-group col-md-4">
                            <label for="capture_rate">Capture rate</label>
                            <input type="number" class="form-control" id="capture_rate" name="capture_rate" min="0" max="500" required> 
                        </div>
                        <div class="form-group col-md-4">
                            <label for="base_happiness">Base happiness</label>
                            <input type="number" class="form-control" id="base_happiness" name="base_happiness" min="0" max="200" required> 
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Enviar</button>
                    
                    <br><a href="adminPokemon.php?limite=0">Back to Pokemon List</a>
                </form>
            </div>
        </div> 
    </div> 

        <!-- jQuery, Popper JS, Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>  
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>