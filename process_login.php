<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST["login"];
    $pwd = $_POST["pwd"];

    $query = "SELECT * FROM user WHERE NOMBRE = :login AND CONTRASEÑA = :pwd";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':login', $login);
    $stmt->bindParam(':pwd', $pwd);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if (isset($usuario['ROL']) && $usuario['ROL'] == 'admin') {
            session_start();
            $_SESSION['user'] = array(
                'rol' => $usuario['ROL'],
                'nombre' => $usuario['NOMBRE'],
            );
            header("Location: dashboard_admin.php");
            exit();
        } else {
            echo "Acceso no autorizado.";
        }
    } else {
        echo "Credenciales incorrectas. Por favor, inténtalo de nuevo.";
    }
} else {
    header("Location: login.php");
    exit();
}
?>
