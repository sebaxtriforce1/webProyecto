<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}

$host = "localhost";
$user = "Sebastian";
$password = "123456";
$database = "usuweb";

$conexion = mysqli_connect($host, $user, $password, $database);
if (!$conexion) {
    die("No se realizó la conexión a la base de datos, el error fue: " . mysqli_connect_error());
}

// Obtener el nombre del usuario desde la base de datos
$email = $_SESSION['email'];
$query = "SELECT NOMBRE FROM user WHERE CORREO = '$email'";
$result = mysqli_query($conexion, $query);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $nombreUsuario = $row['NOMBRE'];
} else {
    $nombreUsuario = "Usuario Desconocido";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('https://www.shutterstock.com/image-vector/colorful-beautiful-colors-seamless-fabric-600nw-2294151819.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: white;
            font-family: 'Arial', sans-serif;
            padding-top: 5rem; 
        }

        .dropdown-section {
            background-color: white;
            padding: 1rem; 
            border-radius: 10px; 
            margin-bottom: 1rem; 
            text-align: right;
        }

        .dropdown-bar {
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: #007BFF; 
            z-index: -1;
        }

        .dropdown-toggle {
            background-color: #87CEEB;
            color: black !important;
            border: none;
        }

        .dropdown-menu {
            background-color: rgba(255, 255, 255, 0.9); 
            border: 1px solid rgba(0, 0, 0, 0.15);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            margin-top: 5px;
        }

        .dropdown-menu .dropdown-item {
            color: #007BFF;
        }

        .welcome-text {
            text-align: center;
            margin-bottom: 1rem;
            font-size: 2rem;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="dropdown-section">
            <div class="dropdown-container">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo "Bienvenido " . $nombreUsuario; ?>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="#">Áreas de Interés</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="cerrar_sesion.php">Cerrar Sesión</a></li>
                    </ul>
                    <div class="dropdown-bar"></div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <h1 class="welcome-text">¡Bienvenido!</h1>
           
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
