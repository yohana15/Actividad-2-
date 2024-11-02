<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// // Ruta absoluta
$ruta_absoluta = $_SESSION['user_imagen'];
// echo ($ruta_absoluta);
// echo '<br>';
// // Convertir a ruta relativa
$ruta_relativa = str_replace('C:\xampp\htdocs\mi-proyecto\views/', '', $ruta_absoluta);
// echo ($ruta_relativa);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<style>
    header{
            display: flex; /* Activa el modo flexbox */
            justify-content: flex-end; /* Alinea horizontalmente el contenido a la derecha */
            align-items: center; /* Centra verticalmente el contenido dentro del header */
            height: 50px;
            background-color: white;
        }

        a{
            padding-right: 20px;
            text-decoration: none; /* Elimina el subrayado del enlace */ 
            color: black;
            font-size: 27px;
        }

        .perfil{
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
        }
        .contenido{
            display: flex;
            align-items: center;
            flex-direction: column;
            margin-top: 150px;
        }
        body{
            background-color: #F0F0F0;
            margin: 0px;
        }
</style>
    <header>
    <a href="admin.php">Administración</a>
    <a href="../logout.php">Cerrar Sesión</a>
    </header>
<body>


    <div class="contenido">
<p>Bienvenido, <?php echo htmlspecialchars($_SESSION['user_name']); ?></p>
    <p>Tu rol es: <?php echo htmlspecialchars($_SESSION['user_role']); ?></p>

    <img class="perfil" src="<?php echo htmlspecialchars($ruta_relativa); ?>" alt="Imagen de usuario no funciona">
    
    <br>

</div>
    
</body>
</html>