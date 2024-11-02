<?php
    
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="../css/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body{
            margin: 0; /* Elimina márgenes por defecto */
            
        }
        .caja {
            display: flex;
    place-items: center;
    min-height: 100vh;
    background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(_3.jpg);
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    align-content: center;
    justify-content: space-around;
    align-items: center;
    flex-wrap: nowrap;
    flex-direction: row;
}

        header{
            display: flex; /* Activa el modo flexbox */
            justify-content: flex-end; /* Alinea horizontalmente el contenido a la derecha */
            align-items: center; /* Centra verticalmente el contenido dentro del header */
            height: 50px;
        }

        a{
            padding-right: 20px;
            text-decoration: none; /* Elimina el subrayado del enlace */ 
            color: black;
            font-size: 27px;
        }
        
        h2{
            text-align: center;
        }

        h1{
            font-size: 5em;
            color: #FFC0CB;
            font-family: cursive;
        }



    </style>
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <header>
        <a href="./views/login.php">Login</a>
        <a href="./views/Registro.php">Registrar</a>
    </header>

    <div class="caja">
        <h1>Bienvenido a mi pagina</h1>
        <div class="card" style="width: 18rem;">
  <img src="4.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Poema</h5>
    <p class="card-text">Bajo el cerezo,  
                        susurros de viento,  
                        pétalos caen,  
                        el tiempo se detiene,  
                        belleza efímera.</p>
  </div>
    </div>

    <div class="card" style="width: 18rem;">
  <img src="5.jpeg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Poema</h5>
    <p class="card-text">Montañas lejanas,
nubes que danzan,
el sol se oculta,
sombras se alargan,
silencio eterno.</p>
  </div>
    </div>

    <div class="card" style="width: 18rem;">
  <img src="6.jpeg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Poema</h5>
    <p class="card-text">En la calma,
un estanque brilla,
la luna asoma,
reflejos de paz,
susurros de vida.</p>
  </div>
    </div>

    
</div>
</body>
</html>
