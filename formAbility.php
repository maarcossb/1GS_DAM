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
            // Consulta para leer los datos de la tabla 'pokemon' 
            $sql1="SELECT * FROM abilities ORDER BY abil_name";
            $registros1=mysqli_query($conexion,$sql1) or die ("Error en la consulta $sql1");
        ?>

    <div class="container">
        <div class="row">
            <div class="container col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <br><center><h1>Add a new Ability</h1></center><br>
                <form name="datos" id="datos" action="addAbility.php" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <?php
                                $sql2="SELECT MAX(abil_id) AS abil_id FROM abilities";
                                $registros2=mysqli_query($conexion,$sql2) or die ("Error en la consulta $sql2");
                                $abil_id=mysqli_fetch_array($registros2);
                                $abil_id=$abil_id['abil_id']+1;
                            ?>
                            <label for="abil_id">ID</label>
                            <input type="number" class="form-control" id="abil_id" name="abil_id" value="<?php echo $abil_id ?>" readonly>
                        </div>
                        <div class="form-group col-md-10">
                            <label for="abil_name">Name</label>
                            <input type="text" class="form-control" id="abil_name" maxlegnth="25" name="abil_name" autofocus required> 
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Enviar</button>
                    
                    <br><a href="adminAbilities.php?limite=0">Back to Move List</a>
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