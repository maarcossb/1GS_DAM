<html>
	<head>
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<!-- Icono de la página -->
		<link rel="shortcut icon" href="images/iconoPokemon.png">

		<title>Moves List</title>

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
			<h1>Moves List</h1><br><br>
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<a class="navbar-brand" href="index.php">Home</a>
				<form class="form-inline my-2 my-lg-0" action="adminMoves.php" method="get"> 
					<input class="form-control mr-sm-2" type="text" name="buscar" placeholder="Search Move" aria-label="Search">
					<input type="hidden" name="campo" value="move_name">
					<button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
				</form>
				<a href="formMove.php" class="btn btn-primary">Add Move</a>
				<!-- Paginación -->
				<nav class="navbar navbar-expand-lg navbar-light bg-light">
					<div id="pag">
						<ul class="pagination">
							<li class="page-item"><a class="page-link" href="adminMoves.php?limite=0">1</a></li>
							<li class="page-item"><a class="page-link" href="adminMoves.php?limite=100">2</a></li>
							<li class="page-item"><a class="page-link" href="adminMoves.php?limite=200">3</a></li>
							<li class="page-item"><a class="page-link" href="adminMoves.php?limite=300">4</a></li>
							<li class="page-item"><a class="page-link" href="adminMoves.php?limite=400">5</a></li>
							<li class="page-item"><a class="page-link" href="adminMoves.php?limite=500">6</a></li>
							<li class="page-item"><a class="page-link" href="adminMoves.php?limite=600">7</a></li>
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
										<a href="adminMoves.php?ord=0a"><img class="flecha1" src="images/flecha1.png"></a>
										<a href="adminMoves.php?ord=0b"><img class="flecha2" src="images/flecha2.png"></a>
									</th>
									<th scope="col">Name
										<a href="adminMoves.php?ord=1a"><img class="flecha1" src="images/flecha1.png"></a>
										<a href="adminMoves.php?ord=1b"><img class="flecha2" src="images/flecha2.png"></a>
									</th>
									<th scope="col">Type
										<a href="adminMoves.php?ord=2a"><img class="flecha1" src="images/flecha1.png"></a>
										<a href="adminMoves.php?ord=3b"><img class="flecha2" src="images/flecha2.png"></a>
									</th>
									<th scope="col">Power
										<a href="adminMoves.php?ord=3a"><img class="flecha1" src="images/flecha1.png"></a>
										<a href="adminMoves.php?ord=3b"><img class="flecha2" src="images/flecha2.png"></a>
									</th>
									<th scope="col">PP
										<a href="adminMoves.php?ord=4a"><img class="flecha1" src="images/flecha1.png"></a>
										<a href="adminMoves.php?ord=4b"><img class="flecha2" src="images/flecha2.png"></a>
									</th>
									<th scope="col">Accuracy
										<a href="adminMoves.php?ord=5a"><img class="flecha1" src="images/flecha1.png"></a>
										<a href="adminMoves.php?ord=5b"><img class="flecha2" src="images/flecha2.png"></a>
									</th>
									<th scope="col">Links</th>	
									<th scope="col">Add</th>
									<th scope="col">Delete</th>
								</tr>
							</thead>
							<tbody>
								<?php
									include("conexion.php");

									// Consulta para obtener los movimientos de los pokemon
									$sql="SELECT DISTINCT m.*, t.type_name FROM moves as m, types as t WHERE m.type_id=t.type_id";

									// Establecer límite de datos
									if(isset($_GET['limite'])) { // Si se ha seleccionado un límite
										$limite=" LIMIT ".$_GET['limite'].", 100;";
									} else { // Si no se ha seleccionado un límite
										$limite=" LIMIT 0, 100;";
									}

									if(isset($_GET['ord'])) {
										switch ($_GET['ord']) {
											case '0a':
												$sql=$sql." ORDER BY m.move_id ASC";	
												break;
											case '0b':
												$sql=$sql." ORDER BY m.move_id DESC";	
												break;
											case '1a':
												$sql=$sql." ORDER BY m.move_name ASC";	
												break;
											case '1b':
												$sql=$sql." ORDER BY m.move_name DESC";	
												break;
											case '2a':
												$sql=$sql." ORDER BY t.type_name ASC";	
												break;
											case '2b':
												$sql=$sql." ORDER BY t.type_name DESC";	
												break;
											case '3a':
												$sql=$sql." ORDER BY m.move_power ASC";	
												break;
											case '3b':
												$sql=$sql." ORDER BY m.move_power DESC";	
												break;
											case '4a':
												$sql=$sql." ORDER BY m.move_pp ASC";	
												break;
											case '4b':
												$sql=$sql." ORDER BY m.move_pp DESC";	
												break;
											case '5a':
												$sql=$sql." ORDER BY m.move_accuracy ASC";	
												break;
											case '5b':
												$sql=$sql." ORDER BY m.move_accuracy DESC";	
												break;
										}
									} else if (isset($_GET['buscar'])) {
										if($_GET['campo']=="move_name") {
											if($_GET['buscar']=="") {
												$sql=$sql." ORDER BY m.move_id";
											} else {
												$sql=$sql." AND m.move_name LIKE '%$_GET[buscar]%' ORDER BY SOUNDEX(m.move_name)";
											}
										}
									} else {
										$sql=$sql." ORDER BY m.move_id".$limite;
									}

									
									// Ejecución de la consulta
									$registros=mysqli_query($conexion, $sql) or die ("Error en la consulta $sql");
									
									while($fila=mysqli_fetch_array($registros)) {
										$id=$fila['move_id'];
										echo "
										<tr>
											<td>$fila[move_id]</td>
											<td>$fila[move_name]</td>
											<td>$fila[type_name]</td>
											<td>$fila[move_power]</td>
											<td>$fila[move_pp]</td>
											<td>$fila[move_accuracy]</td>
											<td><a style='cursor:pointer' data-toggle='modal' data-target='#ventanapokemon$id'><img width='35' src='images/info.png'></a></td>
											<td><a href='formLinkMove.php?id=$fila[move_id]'><img src='images/añadir.png' width='35'></a></td>
											<td><a style='cursor:pointer' data-toggle='modal' data-target='#ventanaborrar$id'><img width='35' src='images/borrar.png'></a></td>
										</tr>";
								?>
								
								<!-- Ventana modal para confirmar el borrado -->
								<div class="modal" id="ventanaborrar<?php echo $id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalCenterTitle">Delete Move</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body" align='left'>
												You are deleting <b><?php echo $fila['move_name']?></b> from de database and the changes will be irreversible.<br>
												To confirm, press the button <a href="deleteMove.php?id=<?php echo $fila['move_id']?>"><button type="button" class="btn btn-danger">Delete permanently</button></a>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>

								<!-- Ventana modal para mostrar los pokemon asociados a ese movimiento -->
								<div class="modal" id="ventanapokemon<?php echo $id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalCenterTitle"><?php echo $fila['move_name']?></h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<?php
													$sql2="SELECT DISTINCT p.pok_name FROM pokemon as p, pokemon_moves as pm, moves as m WHERE p.pok_id=pm.pok_id AND m.move_id=pm.move_id AND m.move_id=$id";
													$registros2=mysqli_query($conexion, $sql2);
												?>
												<?php
													while($fila2=mysqli_fetch_array($registros2)) {
												?>
												<h4 style="display:inline"><span class="badge badge-primary"><?php echo $fila2['pok_name']?></span></h4>
												<?php										
													}
												?>
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
