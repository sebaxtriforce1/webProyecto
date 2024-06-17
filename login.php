<?php
session_start();

$host = "localhost";
$user = "Sebastian";
$password = "123456";
$database = "usuweb";

$conexion = mysqli_connect($host, $user, $password, $database);
if (!$conexion) {
    die("No se realizó la conexión a la base de datos, el error fue: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Consulta para verificar las credenciales y obtener el rol
    $query = "SELECT * FROM user WHERE CORREO = '$email' AND CONTRASEÑA = '$password'";
    $result = mysqli_query($conexion, $query);

    if (mysqli_num_rows($result) == 1) {
        // Obtener el rol del usuario
        $row = mysqli_fetch_assoc($result);
        $rol = $row['ROL'];

        // Guardar el email en la sesión
        $_SESSION['email'] = $email;

        // Redirigir según el rol
        if ($rol == 'usuario') {
            header("Location: inicio.php");
            exit();
        } elseif ($rol == 'admin') {
            header("Location: dashboard_admin.php");
            exit();
        } else {
            echo "Rol desconocido";
        }
    } else {
        echo "Credenciales incorrectas";
    }
}
?>
