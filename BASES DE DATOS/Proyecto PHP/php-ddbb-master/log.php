<html>
	<head>
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<!-- Icono de la página -->
		<link rel="shortcut icon" href="images/iconoPokemon.png">

		<title>Log</title>

        <style type="text/css">
			@font-face {
                font-family: pokemon_hollow;
                src: url(fonts/pokemon_hollow.ttf);
            }
			@font-face {
                font-family: pokemon_solid;
                src: url(fonts/pokemon_solid.ttf);
            }
        
            h2{
                font-family: pokemon_solid;
                color: #ffcb05;
            }
            
        </style>   
    </head>
    <body>
        
		<div class="container"> 
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="index.php">Home</a>
                <a href="adminPokemon.php?limite=0">Back to Pokemon List</a>
            </nav>
			<center><h2>Pokemon Created</h2><center>
            <br>
			<!-- Tabla con el historial de los pokemon creados -->
			<div class="container">
				<div class="row">
					<div class="container col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<table class="table table-striped">
							<thead>
								<tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">ID Pokemon</th>
                                    <th scope="col">Name</th>
								</tr>
							</thead>
							<tbody>
								<?php
									include("conexion.php");
									
									// Consulta para leer datos de la tabla pokemon_created
									$sql="SELECT * FROM pokemon_created";
									
									// Ejecución de la consulta
									$registros=mysqli_query($conexion, $sql) or die ("Error en la consulta $sql");
									
									while($fila=mysqli_fetch_array($registros)) {
										echo "
										<tr>
											<td>$fila[id]</td>
											<td>$fila[created_at]</td>
											<td>$fila[pokemon_id]</td>
											<td>$fila[pokemon_name]</td>
										<tr>";
								?>
								<?php
									}
								?>
							</tbody>
						</table>
					</div>
				</div> 
			</div>  
            <br><br>
			<center><h2>Pokemon Deleted</h2><center>
            <br>
			<!-- Tabla con el historial de los pokemon eliminados -->
			<div class="container">
				<div class="row">
					<div class="container col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<table class="table table-striped">
							<thead>
								<tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">ID Pokemon</th>
                                    <th scope="col">Name</th>
								</tr>
							</thead>
							<tbody>
								<?php
									include("conexion.php");
									
									// Consulta para leer datos de la tabla pokemon_deleted
									$sql="SELECT * FROM pokemon_deleted";
									
									// Ejecución de la consulta
									$registros=mysqli_query($conexion, $sql) or die ("Error en la consulta $sql");
									
									while($fila=mysqli_fetch_array($registros)) {
										echo "
										<tr>
											<td>$fila[id]</td>
											<td>$fila[deleted_at]</td>
											<td>$fila[pokemon_id]</td>
											<td>$fila[pokemon_name]</td>
										<tr>";
								?>
								<?php
									}
								?>
							</tbody>
						</table>
					</div>
				</div> 
			</div>  
		</div>

		<!-- jQuery, Popper JS, Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>  
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	</body>
</html>