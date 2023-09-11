<html>
    <head>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<!-- Icono de la página -->
		<link rel="shortcut icon" href="images/iconoPokemon.png">

        <title>Pokemon List</title>

		<!-- Estilos de pokemon -->
		<style type="text/css">
            @font-face {
                font-family: pokemon_hollow;
                src: url(fonts/pokemon_hollow.ttf);
            }
			@font-face {
                font-family: pokemon_solid;
                src: url(fonts/pokemon_solid.ttf);
            }
			.imgPokemon{
				height: 30%;
			}
			.imgPokemon:hover{
				border-radius:50%;
				box-shadow: 0px 0px 15px 15px #d96459;
				transform: scale(1.1);
				rotate: 360deg;
				transition: all 0.7s;
			}
			table {
				border-collapse: collapse;
				width: 100%;
				color: #d96459;
				font-family: monospace;
				font-size: 18px;
				text-align: left;
			}
			th {
				background-color: #d96459;
				color: white;
			}
			tr:nth-child(even) {
				background-color: #f2f2f2
			}
			
		</style>	
	</head>
	
    <body>
        <?php
			// Llamada a la conexión de la base de datos
            include("conexion.php");

            // Consulta para leer datos en la tabla 'types'
			$sql1="SELECT * FROM types";
			$registros1=mysqli_query($conexion,$sql1) or die ("Error en la consulta $sql1");

            // Consulta para leer datos en la tabla 'pokemon_habitats'
			$sql2="SELECT * FROM pokemon_habitats";
			$registros2=mysqli_query($conexion,$sql2) or die ("Error en la consulta $sql2");

			// Establecer límite de datos
			if(isset($_GET['limite'])) { // Si se ha seleccionado un límite
				$limite=" LIMIT ".$_GET['limite'].", 100;";
			} else { // Si no se ha seleccionado un límite
				$limite=" LIMIT 0, 100;";
			}

			// Consulta para leer datos en la tabla 'pokemon'
			$sql0="SELECT p.*, t.type_name, ph.hab_name, p2.pok_name as pok_evolved FROM pokemon as p INNER JOIN pokemon_types as pt ON p.pok_id=pt.pok_id INNER JOIN types as t ON pt.type_id=t.type_id INNER JOIN pokemon_evolution_matchup as pem ON p.pok_id=pem.pok_id LEFT JOIN pokemon_habitats as ph ON pem.hab_id=ph.hab_id LEFT JOIN pokemon as p2 ON p2.pok_id=pem.evolves_from_species_id LEFT JOIN pokemon_evolution as pe ON pem.pok_id=pe.evol_id";

			if(isset($_GET['campo'])) { // Si se ha seleccionado un campo para buscar
				if($_GET['campo']=='types') { // Buscar por tipo
					if($_GET['buscar']==1) { // Si se ha seleccionado el tipo 'All'
						$sql0=$sql0." WHERE pt.slot=1 ORDER BY p.pok_id".$limite;
                    } else { // Si se ha seleccionado un tipo concreto
                        $sql0=$sql0." WHERE t.type_id=$_GET[buscar] ORDER BY p.pok_id";
                    } 
                } else if ($_GET['campo']=='pokemon_habitats'){ // Buscar por hábitat
                    if($_GET['buscar']==1) {  // Si se ha seleccionado el hábitat 'All'
						$sql0=$sql0." WHERE pt.slot=1 ORDER BY p.pok_id".$limite;
                    } else { // Si se ha seleccionado un hábitat concreto
						$sql0=$sql0." WHERE pt.slot=1 and ph.hab_id=$_GET[buscar] ORDER BY p.pok_id";
                    } 
				} else if ($_GET['campo']=='pok_name'){ // Buscar por nombre de pokemon
					// Consulta para buscar por nombre de pokemon
					if($_GET['buscar']==''){ // Si no se ha introducido nada en el campo de búsqueda
						$sql0=$sql0." WHERE pt.s	lot=1 ORDER BY p.pok_id".$limite;
					} else { // Si se ha introducido algo en el campo de búsqueda
						$sql0=$sql0." WHERE pt.slot=1 and p.pok_name LIKE '%$_GET[buscar]%' ORDER BY SOUNDEX(p.pok_name)";
					} 
				}
            } else { // Si no se ha seleccionado ningún tipo ni hábitat
				$sql0=$sql0." WHERE pt.slot=1 ORDER BY p.pok_id".$limite;
            }
            // Ejecución de la consulta
			$registros0=mysqli_query($conexion,$sql0) or die ("Error en la consulta $sql0");
        ?>

		<!-- Contenido de la página -->
		<div class="container"> 
			<!-- Imagen de cabecera -->
			<div class="form-group col-lg-10 offset-1">
				<img src="images/pokemon.png" class="img-fluid">
			</div>
			<br><br>

			<!-- Barra de navegación -->
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<a class="navbar-brand" href="index.php">Home</a>
				<div class="collapse navbar-collapse" id="navbar01">
					<ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Types
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<?php 
									// Consulta para mostrar los tipos en el menú desplegable
									while($fila1=mysqli_fetch_array($registros1)) { 
										if($fila1['type_id']==1) { // Si se selecciona la opción de todos los tipos
											echo "<a class='dropdown-item' href='pokedex.php?buscar=$fila1[type_id]&campo=types'>All types</a>";
										} else { // Si se selecciona cualquier otro tipo
											echo "<a class='dropdown-item' href='pokedex.php?buscar=$fila1[type_id]&campo=types'>$fila1[type_name]</a>";
										}
									}
								?>			
							</div>
						</li>	
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Habitats
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<?php 
									// Consulta para mostrar los hábitats en el menú desplegable
									while($fila2=mysqli_fetch_array($registros2)) { 
										if($fila2['hab_id']==1) { // Si se selecciona la opción de todos los hábitats
											echo "<a class='dropdown-item' href='pokedex.php?buscar=$fila2[hab_id]&campo=pokemon_habitats'>All habitats</a>";
										} else { // Si se selecciona cualquier otro hábitat
											echo "<a class='dropdown-item' href='pokedex.php?buscar=$fila2[hab_id]&campo=pokemon_habitats'>$fila2[hab_name]</a>";
										}
									}
								?>			
							</div>
						</li>	
						
						<!-- Formulario de búsqueda por nombre de pokemon -->
						<form class="form-inline my-2 my-lg-0" action="pokedex.php" method="get"> 
							<input class="form-control mr-sm-2" type="text" name="buscar" placeholder="Search Pokemon" aria-label="Search">
							<input type="hidden" name="campo" value="pok_name">
							<button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Search</button>
						</form>
					</ul>

					<!-- Paginación -->
					<nav class="navbar navbar-expand-lg navbar-light bg-light">
						<div id="pag">
							<ul class="pagination">
								<li class="page-item"><a class="page-link" href="pokedex.php?limite=0">1</a></li>
								<li class="page-item"><a class="page-link" href="pokedex.php?limite=100">2</a></li>
								<li class="page-item"><a class="page-link" href="pokedex.php?limite=200">3</a></li>
								<li class="page-item"><a class="page-link" href="pokedex.php?limite=300">4</a></li>
								<li class="page-item"><a class="page-link" href="pokedex.php?limite=400">5</a></li>
								<li class="page-item"><a class="page-link" href="pokedex.php?limite=500">6</a></li>
								<li class="page-item"><a class="page-link" href="pokedex.php?limite=600">7</a></li>
								<li class="page-item"><a class="page-link" href="pokedex.php?limite=700">8</a></li>
							</ul>
						</div>
					</nav>
				</div>
			</nav>
			<br>

			<!-- Presentación de los pokemon -->
			<div class="row">
				<?php
					// Consulta para mostrar los pokemon
					while($fila0=mysqli_fetch_array($registros0)) {				
						$id=$fila0['pok_id']; // Variable para guardar el id del pokemon y asi diferenciarlos en la url de la página de detalles del pokemon 
				?>
					<!-- Separación entre tarjetas -->
					<div class="col-sm-3">
						<div class="card h-100">
							<div class="card-body">
								<!-- Contenido de la tarjeta -->
								<h6 class="card-text" style="margin-top: -20px; font-family: pokemon_solid">
									<br><?php echo $fila0['pok_id']?></h6> 
								<!-- Imagen del pokemon -->
								<h6 class="card-image">
									<center>
									<?php
										if($fila0['pok_image'] == null) {
											echo "<img class='imgPokemon' src='images/sin_foto.png'>";
										} else {
											echo "<img class='imgPokemon' src='$fila0[pok_image]'>"; 
										}
									?>
									<center>									
								</h6><br>
								<!-- Nombre del pokemon -->
								<br>
								<h2 class="card-title" style="margin-top: -20px; font-family: pokemon_hollow ">
									<center><b><?php echo $fila0['pok_name']?></b>
								</h2><br>
								<!-- Datos del pokemon -->
								<table class="table table-borderless">
									<tbody>
										<tr>
											<td>Alias: <?php echo $fila0['alias']?></td>
										</tr>
										<tr>
											<td>Type: <?php echo $fila0['type_name']?></td>	
										</tr>
										<tr>		
											<td>Height: <?php echo $fila0['pok_height']?></td>
										</tr>
										<tr>
											<td>Weight: <?php echo $fila0['pok_weight']?></td>
										</tr>
										<tr>
											<td>Base exp: <?php echo $fila0['pok_base_experience']?></td>
										</tr>
										<tr>
											<td>Habitat: <?php echo $fila0['hab_name']?></td>
										</tr>
										<tr>
											<td>Evolved from: <?php echo $fila0['pok_evolved']?></td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="card-footer">
								<!-- Botones para mostrar los detalles del pokemon -->
								<center>
									<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ventanamodal1<?php echo $id?>">
										Base Stats
									</button> 
									<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ventanamodal2<?php echo $id?>">
										Evolution
									</button>
									<button type="button" class="btn btn-info" data-toggle="modal" data-target="#ventanamodal3<?php echo $id?>">
										Moves
									</button>
									<button type="button" class="btn btn-info" data-toggle="modal" data-target="#ventanamodal4<?php echo $id?>">
										Abilities
									</button>
								</center>
							
								<!-- Ventana modal para mostrar las estadísticas base del pokemon -->
								<div class="modal fade" id="ventanamodal1<?php echo $id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalCenterTitle">Base stats of <?php echo $fila0['pok_name']?></h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<?php
													// Consulta para mostrar las estadísticas base del pokemon 
													$sql_v1="SELECT * FROM base_stats WHERE pok_id=$id";
													$registros_v1=mysqli_query($conexion, $sql_v1);
												?>
												<!-- Tabla para mostrar los datos de la tabla 'base_stats' -->
												<table class="table table-striped">
													<thead>
														<tr> 
															<th scope="col">Health</th>
															<th scope="col">Atk</th>
															<th scope="col">Def</th>
															<th scope="col">Sp Atk</th>
															<th scope="col">Sp Def</th>
															<th scope="col">Speed</th>
														</tr>
													</thead>
													<tbody>
														<?php
															// Ciclo para mostrar los datos de la tabla 'base_stats'
															while($fila_v1=mysqli_fetch_array($registros_v1)) {
														?>
														<tr> 
															<td><?php echo $fila_v1['b_hp']?></td>
															<td><?php echo $fila_v1['b_atk']?></td>
															<td><?php echo $fila_v1['b_def']?></td>
															<td><?php echo $fila_v1['b_sp_atk']?></td>
															<td><?php echo $fila_v1['b_sp_def']?></td>
															<td><?php echo $fila_v1['b_speed']?></td>
														</tr>
														<?php
															}
														?>
													</tbody>
												</table>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>
								<!-- Ventana modal para mostrar la evolución del pokemon -->
								<div class="modal fade" id="ventanamodal2<?php echo $id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalCenterTitle">Evolution of <?php echo $fila0['pok_name']?></h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<?php
													// Consulta para mostrar la evolución del pokemon
													$sql_v2="SELECT p.*, p2.pok_name as pok_evolved, t.type_name FROM pokemon as p LEFT JOIN pokemon_evolution_matchup as pem ON p.pok_id=pem.pok_id LEFT JOIN pokemon as p2 ON p2.pok_id=pem.evolves_from_species_id INNER JOIN pokemon_types as pt ON pt.pok_id=p.pok_id INNER JOIN types as t ON t.type_id=pt.type_id WHERE pt.slot=1 and p2.pok_id=$id";
													$registros_v2=mysqli_query($conexion, $sql_v2);
												?>
												<?php
													// Ciclo para mostrar los datos de la tabla 'pokemon'
													while($fila_v2=mysqli_fetch_array($registros_v2)) {
												?>
												<!-- Tarjeta para mostrar los datos de la tabla 'pokemon' (del pokemon al que evoluciona) -->
												<div class="card-body">
													<h6 class="card-image">
														<?php 
															if ($fila_v2['pok_image'] == NULL) {
																echo "<img src='images/sin_foto.png' style='height: 220px; position: absolute; right: 20px'>";
															} else {
																echo "<img src='$fila_v2[pok_image]' style='height: 220px; position: absolute; right: 20px'>";
															}
														?>
													</h6>
													<h2 class="card-title" style="margin-top: -20px">
														<?php echo $fila_v2['pok_name']?>
													</h2><br>
													<h6 class="card-text" style="margin-top: -20px">
														ID: <?php echo $fila_v2['pok_id']?></h6><br>
													<h6 class="card-text" style="margin-top: -20px">
														Type: <?php echo $fila_v2['type_name']?></h6><br>
													<h6 class="card-text"style="margin-top: -20px">
														Height: <?php echo $fila_v2['pok_height']?></h6><br>
													<h6 class="card-text"style="margin-top: -20px">
														Weight: <?php echo $fila_v2['pok_weight']?></h6><br>
													<h6 class="card-text"style="margin-top: -20px">
														Base experience: <?php echo $fila_v2['pok_base_experience']?></h6><br>
													<h6 class="card-text"style="margin-top: -20px">
														Evolved from: <?php echo $fila_v2['pok_evolved']?></h6><br>
												</div>
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

								<!-- Ventana modal para mostrar los movimientos del pokemon -->
								<div class="modal fade" id="ventanamodal3<?php echo $id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalCenterTitle">Moves of <?php echo $fila0['pok_name']?></h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<?php
													// Consulta para mostrar los movimientos del pokemon 
													$sql_v3="SELECT DISTINCT m.*, t.type_name FROM pokemon_moves as pm, moves as m, types as t, version_groups as vg WHERE pm.move_id=m.move_id and m.type_id=t.type_id  and pm.version_group_id=vg.version_id and vg.version_id=16 and pm.pok_id=$id ORDER BY m.move_name";
													$registros_v3=mysqli_query($conexion, $sql_v3);
												?>
												<!-- Tabla para mostrar los datos de la tabla 'moves' -->
												<table class="table table-striped">
													<thead>
														<tr>
															<th scope="col">Name</th>
															<th scope="col">Type</th>
															<th scope="col">Power</th>
															<th scope="col">PP</th>
															<th scope="col">Accuracy</th>
														</tr>
													</thead>
													<tbody>
														<?php
															// Ciclo para mostrar los datos de la tabla 'moves'
															while($fila_v3=mysqli_fetch_array($registros_v3)) {
														?>
														<tr>
															<td><?php echo $fila_v3['move_name']?></td>
															<td><?php echo $fila_v3['type_name']?></td>
															<td><?php echo $fila_v3['move_power']?></td>
															<td><?php echo $fila_v3['move_pp']?></td>
															<td><?php echo $fila_v3['move_accuracy']?></td>
														</tr>
														<?php
															}
														?>
													</tbody>
												</table>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>

								<!-- Ventana modal para mostrar las habilidades del pokemon -->
								<div class="modal fade" id="ventanamodal4<?php echo $id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalCenterTitle">Habilities of <?php echo $fila0['pok_name']?></h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<?php
													// Consulta para mostrar las habilidades del pokemon 
													$sql_v4="SELECT a.*, pa.* FROM abilities as a, pokemon_abilities as pa WHERE pa.pok_id=$id and pa.abil_id=a.abil_id";
													$registros_v4=mysqli_query($conexion, $sql_v4);
												?>
												<!-- Tabla para mostrar los datos de la tabla 'abilities' -->
												<table class="table table-striped">
													<thead>
														<tr>
															<th scope="col">Name</th>
															<th scope="col">Hidden</th>
															<th scope="col">Slot</th>
														</tr>
													</thead>
													<tbody>
														<?php
															// Ciclo para mostrar los datos de la tabla 'abilities'
															while($fila_v4=mysqli_fetch_array($registros_v4)) {
														?>
														<tr>
															<td><?php echo $fila_v4['abil_name']?></td>
															<td><?php echo $fila_v4['is_hidden']?></td>
															<td><?php echo $fila_v4['slot']?></td>
														</tr>
														<?php
															}
														?>
													</tbody>
												</table>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>
								
							</div>
						</div>
					</div>
				<?php
				}
				?>				
			</div>
		</div>       
        
		<!-- jQuery, Popper JS, Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>  
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>