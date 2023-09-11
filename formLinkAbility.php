<html>
    <head>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <!-- Icono de la página -->
		<link rel="shortcut icon" href="images/iconoPokemon.png">
        
        <title>Link Move</title>
    </head>
    <body>
        <?php
            include("conexion.php");
            // Consulta para leer los datos de la tabla 'pokemon' 
            $sql="SELECT * FROM pokemon ORDER BY pok_name";
            $registros=mysqli_query($conexion,$sql) or die ("Error en la consulta $sql");
        ?>

    <div class="container">
        <div class="row">
            <div class="container col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <br><center><h1>Link an ability to a pokemon</h1></center><br>
                <form name="datos" id="datos" action="addLinkAbility.php" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <?php
                                $sql2="SELECT a.* FROM abilities as a WHERE a.abil_id=$_GET[id]";
                                $registros2=mysqli_query($conexion,$sql2) or die ("Error en la consulta $sql2");
                                $fila=mysqli_fetch_array($registros2);
                            ?>
                            <label for="abil_id">Ability</label>
                            <input type="text" class="form-control" id="abil_id" name="abil_id" value="<?php echo $fila['abil_id'] ?>" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="is_hidden">is hidden</label>
                            <select id="is_hidden" name="is_hidden" class="form-control" required>
                                <option value="0" selected>No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>  
                        <div class="form-group col-md-6">
                            <label for="slot">Slot</label>
                            <select id="slot" name="slot" class="form-control" required>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3" selected>3</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="pok_id">Pokemon</label>
                            <select id="pok_id" name="pok_id" class="form-control" required>
                                <?php
                                    while($fila=mysqli_fetch_array($registros)) { 
                                        echo "<option value='$fila[pok_id]'>$fila[pok_name]</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Enviar</button>
                    
                    <br><a href="adminAbilities.php?limite=0">Back to Abilities List</a>
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