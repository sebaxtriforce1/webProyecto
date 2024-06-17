<?php
include 'crud.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $id = $_POST["id"];
    $especialidad = $_POST["especialidad"];
    $consultorio = $_POST["consultorio"];

    // Llamar a la función de actualización
    if (updateVeterinario($id, $especialidad, $consultorio)) {
        // Redirigir a la página principal después de la actualización exitosa
        header("Location: dashboard_admin.php");
        exit();
    } else {
        // Mostrar un mensaje de error si la actualización falla
        echo "Error al actualizar el veterinario.";
    }
} else {
    // Redirigir si no se accedió mediante POST
    header("Location: dashboard_admin.php");
    exit();
}
?>
