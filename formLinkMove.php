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
                <br><center><h1>Link a move to a pokemon</h1></center><br>
                <form name="datos" id="datos" action="addLinkMove.php" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <?php
                                $sql2="SELECT m.* FROM moves as m WHERE m.move_id=$_GET[id]";
                                $registros2=mysqli_query($conexion,$sql2) or die ("Error en la consulta $sql2");
                                $fila=mysqli_fetch_array($registros2);
                            ?>
                            <label for="move_id">Move</label>
                            <input type="text" class="form-control" id="move_id" name="move_id" value="<?php echo $fila['move_id'] ?>" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <?php
                                $sql3="SELECT vg.* FROM version_groups as vg WHERE vg.version_id=16";
                                $registros3=mysqli_query($conexion,$sql3) or die ("Error en la consulta $sql3");
                                $fila=mysqli_fetch_array($registros3);
                            ?>
                            <label for="version_id">Version Group</label>
                            <input type="text" class="form-control" id="version_id" name="version_id" value="<?php echo $fila['version_id'] ?>" readonly>
                        </div>  
                        <div class="form-group col-md-6">
                            <?php
                                $sql4="SELECT pmm.* FROM pokemon_move_methods as pmm";
                                $registros4=mysqli_query($conexion,$sql4) or die ("Error en la consulta $sql4");
                            ?>
                            <label for="method_id">Method</label>
                            <select id="method_id" name="method_id" class="form-control" required>
                                <?php
                                    while($fila=mysqli_fetch_array($registros4)) { 
                                        echo "<option value='$fila[method_id]'>$fila[method_name]</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="level">Level</label>
                            <input type="number" class="form-control" id="level" name="level" value="0" readonly>
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
                    
                    <br><a href="adminMoves.php?limite=0">Back to Moves List</a>
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