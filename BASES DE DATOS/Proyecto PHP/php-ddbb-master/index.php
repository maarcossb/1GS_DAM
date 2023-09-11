<html>
    <head>
        <title>POKEMON DB</title>
        <link rel="shortcut icon" href="images/iconoPokemon.png">
        <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
        <script language="JavaScript">
            $(document).ready(function() {
                $('.circulo').click(function() {
                    window.location = $(this).data('enlace');
                });
            });
        </script>
        <style type="text/css">
            @font-face {
                font-family: pokemon_solid;
                src: url(fonts/pokemon_solid.ttf);
            }

            @font-face {
                font-family: pokemon_hollow;
                src: url(fonts/pokemon_hollow.ttf);
            }
            
            body{
                background: url("images/fondo_pikachu.jpg") no-repeat;
                background-size: cover;
                margin: 0;
                padding: 0;
            }

            #secciones {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                font-family: pokemon_hollow;
                font-style: bold;
            }
            
            .circulo {
                width: 200px;
                height: 200px;
                border-radius: 50%;
                background-color: #ffcb05;
                color: #521500;
                font-size: 2.5em;
                display: flex;
                justify-content: center;
                align-items: center;
                margin: 20px;
                cursor: pointer;
                position: absolute;
                transition: all 0.7s;
                box-shadow: 0px 0px 10px 0px #521500;
                line-height: 1.2em;

            }

            .circulo:hover {
                background-color: #9f2c18;
                color: #fff;
                transform: scale(1.15);
                font-family: pokemon_hollow;
            }

            #seccion1:hover {
                background-color: #521500;
                color: #fff;
                transform: scale(1.15);
            }

            #nombre_pagina {
                position: absolute;
                top: 10%;
                left: 50%;
                transform: translate(-50%, -50%);
                font-size: 6em;
                font-weight: bold;
                font-family: pokemon_solid;
                color: #521500;
            }

            #seccion1{
                width: 300px;
                height: 300px;
                font-size: 4em;
            }

            #seccion2{
                left: 340px;
                top: 190px;
            }

            #seccion3{
                right: 340px;
                top: 190px;
            }

            #seccion4{
                border-radius: 20px;
                width: 200px;
                height: 140px;
                bottom: 10px;
            }

            
        </style>
    </head>
    <body>
        <div id="secciones">
            <div class="circulo" id="seccion1" data-enlace="pokedex.php?limite=0"><b><center>Pokedex</center></b></div>
            <div class="circulo" id="seccion2" data-enlace="adminMoves.php?limite=0"><b><center>Moves</center></b></div>
            <div class="circulo" id="seccion3" data-enlace="adminAbilities.php?limite=0"><b><center>Habilities</center></b></div>
            <div class="circulo" id="seccion4" data-enlace="adminPokemon.php"><b><center>Admin Pokemon</center></b></div>
        </div>
        <div id="nombre_pagina">PoKeMoN DB</div>
    </body>
</html>