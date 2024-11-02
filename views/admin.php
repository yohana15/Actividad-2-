<?php
session_start();
require_once '../inc/funciones.php';
require_once '../inc/conexion.php'; // Asegúrate de tener la conexión configurada en este archivo

// Verificar si el usuario tiene el rol de administrador
if (!verificar_rol('administrador')) {
    echo "Acceso denegado.";
    exit;
}

$errores = []; // Array para almacenar los mensajes de error

$titulo = "";
$descripcion = "";
$imagen = "";
$usuario_id = 19; // ID del usuario asociado; en este caso, está configurado como 19

// Comprobar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar el campo de título
    if (empty($_POST['titulo'])) {
        $errores['titulo'] = 'Ingrese un título.';
    } else {
        $titulo = $_POST['titulo'];
    }

    // Validar el campo de descripción
    if (empty($_POST['descripcion'])) {
        $errores['descripcion'] = 'Ingrese una descripción.';
    } else {
        $descripcion = $_POST['descripcion'];
    }

    // Validar la subida de la imagen
    if (empty($_FILES['archivo']['name'])) {
        $errores['foto'] = 'Seleccione una imagen para subir.';
    } else {
        $archivo = $_FILES['archivo'];
        $tipos_permitidos = ['image/jpeg', 'image/png', 'image/gif'];

        if (!in_array($archivo['type'], $tipos_permitidos)) {
            $errores['foto'] = 'Error en la subida de la imagen. Formato no permitido.';
        } elseif ($archivo['size'] > 2000000) { // Limitar el tamaño del archivo a 2MB
            $errores['foto'] = 'Error en la subida de la imagen. Tamaño máximo 2MB.';
        } else {
            $rutaArchivo = '../uploads/' . basename($archivo['name']);
            if (!move_uploaded_file($archivo['tmp_name'], $rutaArchivo)) {
                $errores['foto'] = 'Error al mover el archivo subido.';
            } else {
                $imagen = $rutaArchivo;
            }
        }
    }

    // Procesar el formulario si no hay errores
    if (empty($errores)) {
        try {
            $sql = "INSERT INTO post (usuario_id, titulo, descripcion, imagen) VALUES (:usuario_id, :titulo, :descripcion, :imagen)";
            $stmt = $conexion->prepare($sql);
            
            $stmt->bindParam(':id', $usuario_id, PDO::PARAM_INT);
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':imagen', $imagen);

            $stmt->execute();
            echo "Formulario procesado con éxito y datos guardados en la base de datos.";

            // Redirigir o realizar más procesamiento si es necesario
        } catch (PDOException $e) {
            echo "Error al guardar en la base de datos: " . $e->getMessage();
        }
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración</title>
    <link rel="stylesheet" href="../css/estilos.css">
    <style>
        body {
            margin: 0;
        }
        .caja {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f0f0f0;
        }
        header {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            height: 50px;
            background-color: #eaeaea;
            padding-right: 20px;
        }
        header a {
            text-decoration: none;
            color: black;
            font-size: 20px;
            margin: 0 15px;
        }
        .formulario h2 {
            margin-bottom: 20px;
        }
        .formulario label {
            display: block;
            margin-top: 10px;
        }
        .formulario input[type="text"],
        .formulario input[type="file"] {
            width: 86%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
        }
        .formulario button {
            margin-top: 20px;
            width: 92%;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            cursor: pointer;
        }
        .formulario button:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }

        .text{
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <a href="dashboard.php">Volver al Dashboard</a>
        <a href="#">Post creados</a>
    </header>
            
    <div class="caja">
        <form method="post" enctype="multipart/form-data" class="formulario">
            <h2>Área de Administración</h2>
            <p class="texto">Formulario para la creación de un post asociado al ID: 19 con conexión activa.</p>

            <label for="titulo">Título:</label>
            <input type="text" name="titulo" id="titulo" value="<?php echo isset($_POST['titulo']) ? htmlspecialchars($_POST['titulo']) : ''; ?>">
            <?php if (!empty($errores['titulo'])): ?>
                <p class="error"><?php echo $errores['titulo']; ?></p>
            <?php endif; ?>

            <label for="descripcion">Descripción:</label>
            <input type="text" name="descripcion" id="descripcion" value="<?php echo isset($_POST['descripcion']) ? htmlspecialchars($_POST['descripcion']) : ''; ?>">
            <?php if (!empty($errores['descripcion'])): ?>
                <p class="error"><?php echo $errores['descripcion']; ?></p>
            <?php endif; ?>

            <div class="rol">
                <label for="archivo">Imagen:</label>
                <input type="file" name="archivo" id="archivo" accept="image/*">
                <?php if (!empty($errores['foto'])): ?>
                    <p class="error"><?php echo $errores['foto']; ?></p>
                <?php endif; ?>
            </div>

            <button type="submit">Crear</button>
        </form>
    </div>
</body>
</html>
