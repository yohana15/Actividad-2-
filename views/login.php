<?php
session_start();
require_once '../inc/conexion.php';
require_once '../inc/funciones.php';

$errores = [
    'error' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = limpiar_dato($_POST['email']);
    $password = $_POST['password'];

    // Consultamos si el email existe
    $sql = "SELECT * FROM usuarios WHERE email = :email";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($password, $usuario['password'])) {
        $_SESSION['user_id'] = $usuario['id'];
        $_SESSION['user_name'] = $usuario['nombre'];
        $_SESSION['user_role'] = $usuario['rol'];
        $_SESSION['user_email'] = $usuario['email'];
        // Reto imagen
        $_SESSION['user_imagen'] = $usuario['foto'];
        
        header("Location: dashboard.php");
        exit;
    } else {
        // echo "Email o contraseña incorrectos.";
        $errores['error'] = 'Email o contraseña incorrectos.';

    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="../css/estilos.css">
    <style>
        body{
            margin: 0; /* Elimina márgenes por defecto */
            
        }
        .caja{
            display: grid; /* Activa el modo de grid */
            place-items: center; /* Centra el contenido horizontal y verticalmente */
            min-height: 100vh; /* Asegura que el body tenga al menos la altura completa de la pantalla */
            background-color: #f0f0f0; /* Color de fondo opcional */
            background-image: url('1.gif');
            background-size: cover; /* Ajusta el tamaño de la imagen para que cubra toda la pantalla */
            background-repeat: no-repeat; /* Evita que la imagen se repita */
            background-position: center;
            align-content: center;
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
        
        form{
            width: 100%;
            background-color: rgba(255, 255, 255, 0.5);
            padding-top: 30px;
            padding-bottom: 30px;
            padding-right: 20px;
            padding-left: 20px;
            margin-top: 40px;
            border: solid 1px gray;
            border-radius: 0px 20px 0px 10px;

        }

        h2{
            text-align: center;
        }

        input{
            width: -webkit-fill-available;
        }

        .error {
            text-align: center;
            color: red;
            font-weight: bold;
            font-size: 0.9em;
        }
        .perfil{
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>
<body>

    <header>
        <a href="../index.php">Index</a>
        <a href="Registro.php">Registrar</a>
    </header>

    <div class="caja">

    <div>
        <img class="perfil" src="2.gif" alt="pato caminando">
    </div>
        <form method="post">
            <h2>Inicio de Sesión</h2>
    
            <?php if (!empty($errores['error'])): ?>
                <p class="error"><?php echo $errores['error']; ?></p>
            <?php endif; ?>
    
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" >
    
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" >
    
            <button type="submit">Iniciar Sesión</button>
        </form>
    </div>
</body>
</html>