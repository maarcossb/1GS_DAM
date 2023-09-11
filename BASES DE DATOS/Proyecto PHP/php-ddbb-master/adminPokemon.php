<html>
	<head>
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<!-- Icono de la página -->
		<link rel="shortcut icon" href="images/iconoPokemon.png">

		<title>Pokemon List</title>

		<!-- Estilos -->
		<style type="text/css">
			@font-face {
                font-family: pokemon_hollow;
                src: url(fonts/pokemon_hollow.ttf);
            }
			@font-face {
                font-family: pokemon_solid;
                src: url(fonts/pokemon_solid.ttf);
            }
			.container {
			margin-top: 20px;
			}
			td {
				vertical-align: middle !important;
				text-align: center !important;
			}
			th {
				text-align: center !important;
			}
			.btn {
				margin: 5px;
			}
			h1 {
				font-family: pokemon_solid;
				font-size: 8em;
				text-align: center;
			}
			.flecha1 {
				width: 1.5%;
				position: absolute;
				margin-left: 2px;
				top: 16px;
			}
			.flecha2 {
				width: 1.5%;
				position: absolute;
				margin-left: 2px;
				top: 24px;
			}
			img:hover {
				transform: scale(1.1);
			}
			tbody tr:hover {
				transform: scale(1.02);
			}
		</style>
	</head>
	
	<body>
		<div class="container"> 
			<h1>Pokemon List</h1><br><br>
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<a class="navbar-brand" href="index.php">Home</a>
				<form class="form-inline my-2 my-lg-0" action="adminPokemon.php" method="get"> 
					<input class="form-control mr-sm-2" type="text" name="buscar" placeholder="Search Pokemon" aria-label="Search">
					<input type="hidden" name="campo" value="pok_name">
					<button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
				</form>
				<a href="formPokemon.php" class="btn btn-primary">Add Pokemon</a>
				<a href="log.php" class="btn btn-danger">Log</a>
				<!-- Paginación -->
				<nav class="navbar navbar-expand-lg navbar-light bg-light">
					<div id="pag">
						<ul class="pagination">
							<li class="page-item"><a class="page-link" href="adminPokemon.php?limite=0">1</a></li>
							<li class="page-item"><a class="page-link" href="adminPokemon.php?limite=100">2</a></li>
							<li class="page-item"><a class="page-link" href="adminPokemon.php?limite=200">3</a></li>
							<li class="page-item"><a class="page-link" href="adminPokemon.php?limite=300">4</a></li>
							<li class="page-item"><a class="page-link" href="adminPokemon.php?limite=400">5</a></li>
							<li class="page-item"><a class="page-link" href="adminPokemon.php?limite=500">6</a></li>
							<li class="page-item"><a class="page-link" href="adminPokemon.php?limite=600">7</a></li>
							<li class="page-item"><a class="page-link" href="adminPokemon.php?limite=700">8</a></li>
						</ul>
					</div>
				</nav>
			</nav>

			<!-- Tabla con la lista de pokemon -->
			<div class="container">
				<div class="row">
					<div class="container col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<table class="table table-striped">
							<thead>
								<tr>
									<th scope="col">ID
										<a href="adminPokemon.php?ord=1a"><img class="flecha1" src="images/flecha1.png"></a>
										<a href="adminPokemon.php?ord=1b"><img class="flecha2" src="images/flecha2.png"></a>
									</th>
									<th scope="col">Name
										<a href="adminPokemon.php?ord=2a"><img class="flecha1" src="images/flecha1.png"></a>
										<a href="adminPokemon.php?ord=2b"><img class="flecha2" src="images/flecha2.png"></a>
									</th>
									<th scope="col">Height
										<a href="adminPokemon.php?ord=3a"><img class="flecha1" src="images/flecha1.png"></a>
										<a href="adminPokemon.php?ord=3b"><img class="flecha2" src="images/flecha2.png"></a>
									</th>
									<th scope="col">Weight
										<a href="adminPokemon.php?ord=4a"><img class="flecha1" src="images/flecha1.png"></a>
										<a href="adminPokemon.php?ord=4b"><img class="flecha2" src="images/flecha2.png"></a>
									</th>
									<th scope="col">Base Exp
										<a href="adminPokemon.php?ord=5a"><img class="flecha1" src="images/flecha1.png"></a>
										<a href="adminPokemon.php?ord=5b"><img class="flecha2" src="images/flecha2.png"></a>
									</th>
									<th scope="col">HP
										<a href="adminPokemon.php?ord=6a"><img class="flecha1" src="images/flecha1.png"></a>
										<a href="adminPokemon.php?ord=6b"><img class="flecha2" src="images/flecha2.png"></a>
									</th>
									<th scope="col">Atk
										<a href="adminPokemon.php?ord=7a"><img class="flecha1" src="images/flecha1.png"></a>
										<a href="adminPokemon.php?ord=7b"><img class="flecha2" src="images/flecha2.png"></a>
									</th>
									<th scope="col">Def
										<a href="adminPokemon.php?ord=8a"><img class="flecha1" src="images/flecha1.png"></a>
										<a href="adminPokemon.php?ord=8b"><img class="flecha2" src="images/flecha2.png"></a>
									</th>
									<th scope="col">Sp Atk
										<a href="adminPokemon.php?ord=9a"><img class="flecha1" src="images/flecha1.png"></a>
										<a href="adminPokemon.php?ord=9b"><img class="flecha2" src="images/flecha2.png"></a>
									</th>
									<th scope="col">Sp Def
										<a href="adminPokemon.php?ord=10a"><img class="flecha1" src="images/flecha1.png"></a>
										<a href="adminPokemon.php?ord=10b"><img class="flecha2" src="images/flecha2.png"></a>
									</th>
									<th scope="col">Speed
										<a href="adminPokemon.php?ord=11a"><img class="flecha1" src="images/flecha1.png"></a>
										<a href="adminPokemon.php?ord=11b"><img class="flecha2" src="images/flecha2.png"></a>
									</th>
									<th scope="col">Image</th>
									<th scope="col">Delete</th>
								</tr>
							</thead>
							<tbody>
								<?php
									include("conexion.php");
									
									// Consulta para leer datos en la tabla de libros
									$sql="SELECT p.*, bs.* FROM pokemon as p INNER JOIN base_stats as bs ON p.pok_id=bs.pok_id";
									
									// Establecer límite de datos
									if(isset($_GET['limite'])) { // Si se ha seleccionado un límite
										$limite=" LIMIT ".$_GET['limite'].", 100;";
									} else { // Si no se ha seleccionado un límite
										$limite=" LIMIT 0, 100;";
									}

									if(isset($_GET['ord'])) {
										switch ($_GET['ord']) {
											case '1a':
												$sql=$sql." ORDER BY p.pok_id ASC";	
												break;
											case '1b':
												$sql=$sql." ORDER BY p.pok_id DESC";	
												break;
											case '2a':
												$sql=$sql." ORDER BY p.pok_name ASC";	
												break;
											case '2b':
												$sql=$sql." ORDER BY p.pok_name DESC";	
												break;
											case '3a':
												$sql=$sql." ORDER BY p.pok_height ASC";	
												break;
											case '3b':
												$sql=$sql." ORDER BY p.pok_height DESC";	
												break;
											case '4a':
												$sql=$sql." ORDER BY p.pok_weight ASC";	
												break;
											case '4b':
												$sql=$sql." ORDER BY p.pok_weight DESC";	
												break;
											case '5a':
												$sql=$sql." ORDER BY bs.pok_base_exp ASC";	
												break;
											case '5b':
												$sql=$sql." ORDER BY bs.pok_base_exp DESC";	
												break;
											case '6a':
												$sql=$sql." ORDER BY bs.b_hp ASC";	
												break;
											case '6b':
												$sql=$sql." ORDER BY bs.b_hp DESC";	
												break;
											case '7a':
												$sql=$sql." ORDER BY bs.b_atk ASC";	
												break;
											case '7b':
												$sql=$sql." ORDER BY bs.b_atk DESC";	
												break;
											case '8a':
												$sql=$sql." ORDER BY bs.b_def ASC";	
												break;
											case '8b':
												$sql=$sql." ORDER BY bs.b_def DESC";	
												break;
											case '9a':
												$sql=$sql." ORDER BY bs.b_sp_atk ASC";	
												break;
											case '9b':
												$sql=$sql." ORDER BY bs.b_sp_atk DESC";	
												break;
											case '10a':
												$sql=$sql." ORDER BY bs.b_sp_def ASC";	
												break;
											case '10b':
												$sql=$sql." ORDER BY bs.b_sp_def DESC";	
												break;
											case '11a':
												$sql=$sql." ORDER BY bs.b_speed ASC";	
												break;
											case '11b':
												$sql=$sql." ORDER BY bs.b_speed DESC";	
												break;
										}
									} else if (isset($_GET['buscar'])) {
										if($_GET['campo']=="pok_name") {
											if($_GET['buscar']=="") {
												$sql=$sql." ORDER BY p.pok_id";
											} else {
												$sql=$sql." WHERE p.pok_name LIKE '%$_GET[buscar]%' ORDER BY SOUNDEX(p.pok_name)";
											}
										}
									} else {
										$sql=$sql." ORDER BY p.pok_id".$limite;
									}
									// Ejecución de la consulta
									$registros=mysqli_query($conexion, $sql) or die ("Error en la consulta $sql");
									
									while($fila=mysqli_fetch_array($registros)) {
										echo "
										<tr>
											<td>$fila[pok_id]</td>
											<td>$fila[pok_name]</td>
											<td>$fila[pok_height]</td>
											<td>$fila[pok_weight]</td>
											<td>$fila[pok_base_experience]</td>
											<td>$fila[b_hp]</td>
											<td>$fila[b_atk]</td>
											<td>$fila[b_def]</td>
											<td>$fila[b_sp_atk]</td>
											<td>$fila[b_sp_def]</td>
											<td>$fila[b_speed]</td> ";
											if($fila['pok_image'] == NULL) {
												echo "<td><img src='images/sin_foto.png' style='height: 50px'></td>";
											} else {
												echo "<td><img src='$fila[pok_image]' style='height: 50px'</td>";
											}
											echo "<td><a style='cursor:pointer' data-toggle='modal' data-target='#ventanaborrar$fila[pok_id]'><img width='35' src='images/borrar.png'></a></td>
										</tr>";
								?>
								
								<!-- Ventana modal para confirmar el borrado del pokemon -->
								<div class="modal" id="ventanaborrar<?php echo $fila['pok_id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalCenterTitle">Delete Pokemon</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body" align='left'>
												You are deleting <b><?php echo $fila['pok_name']?></b> from de database and the changes will be irreversible.<br>
												To confirm, press the button <a href="deletePokemon.php?id=<?php echo $fila['pok_id']?>"><button type="button" class="btn btn-danger">Delete permanently</button></a>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>
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
