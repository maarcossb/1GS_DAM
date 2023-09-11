<html>
    <head>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <!-- Icono de la página -->
		<link rel="shortcut icon" href="images/iconoPokemon.png">
        
        <title>Add Move</title>
    </head>
    <body>
        <?php
            include("conexion.php");
            // Consulta para leer los datos de la tabla 'types'
            $sql1="SELECT * FROM types";
            $registros1=mysqli_query($conexion,$sql1) or die ("Error en la consulta $sql1");

            // Consulta para leer los datos de la tabla 'pokemon' 
            $sql3="SELECT * FROM moves ORDER BY move_name";
            $registros3=mysqli_query($conexion,$sql3) or die ("Error en la consulta $sql3");
        ?>

    <div class="container">
        <div class="row">
            <div class="container col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <br><center><h1>Add a new Move</h1></center><br>
                <form name="datos" id="datos" action="addMove.php" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <?php
                                $sql4="SELECT MAX(move_id) AS move_id FROM moves";
                                $registros4=mysqli_query($conexion,$sql4) or die ("Error en la consulta $sql4");
                                $move_id=mysqli_fetch_array($registros4);
                                $move_id=$move_id['move_id']+1;
                            ?>
                            <label for="move_id">ID</label>
                            <input type="number" class="form-control" id="move_id" name="move_id" value="<?php echo $move_id ?>" readonly>
                        </div>
                        <div class="form-group col-md-10">
                            <label for="move_name">Name</label>
                            <input type="text" class="form-control" id="move_name" maxlegnth="25" name="move_name" autofocus required> 
                        </div>
                    </div>
                    <div class="form-row">
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
                        <div class="form-group col-md-2">
                            <label for="move_power">Power</label>
                            <input type="number" class="form-control" id="move_power" name="move_power" min="0" max="400" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="move_pp">PP</label>
                            <input type="number" class="form-control" id="move_pp" name="move_pp" min="0" max="100" required> 
                        </div>
                        <div class="form-group col-md-2">
                            <label for="move_accuracy">Accuracy</label>
                            <input type="number" class="form-control" id="move_accuracy" name="move_accuracy" min="0" max="100" required> 
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Enviar</button>
                    
                    <br><a href="adminMoves.php?limite=0">Back to Move List</a>
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