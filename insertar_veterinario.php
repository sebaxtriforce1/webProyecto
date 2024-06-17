<?php
include 'crud.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
 
    if (isset($_POST['especialidad'], $_POST['nombres'], $_POST['apellidos'], $_POST['consultorio'], $_POST['cedula'])) {
   
        $especialidad = $_POST['especialidad']; 
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $consultorio = $_POST['consultorio']; 
        $cedula = $_POST['cedula'];


        $veterinario_existente = getVeterinarioByCedula($cedula);
        if ($veterinario_existente) {
            
            echo '<div style="font-size: 20px; color: #ff0000; text-align: center;">';
            echo 'Advertencia: La cédula ya existe. No se agregó un nuevo veterinario.<br>';
            echo 'Redirigiendo al formulario...';
            echo '</div>';
            echo '<style>body { background-color: #f9f9f9; }</style>';
            echo '<p style="text-align: center;">Por favor, espere un momento...</p>';
            echo '<script>window.setTimeout(function(){ window.location.href = "dashboard_admin.php"; }, 4000);</script>'; 
            exit(); 
        } else {
            
            $result = addVeterinario($nombres, $apellidos, $especialidad, $consultorio, $cedula);

            if ($result) {
               
                header("Location: dashboard_admin.php");
                exit();
            } else {
            
                echo 'Error al agregar veterinario.';
            }
        }
    } else {
       
        echo 'Faltan datos del formulario.';
    }
} else {
   
    header("Location: dashboard_admin.php");
    exit();
}
?>
