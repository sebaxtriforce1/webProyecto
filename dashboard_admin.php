<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panel de Administrador</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- Enlace a tu archivo de estilos personalizado -->
    <link rel="stylesheet" href="styles.css">
</head>
<style>

    body {
        font-family: Arial, sans-serif;
    }

    .dropdown-container {
        position: relative;
        display: inline-block;
    }

    .dropdown-button {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
        border-radius: 5px;
    }

    .dropdown-button:hover {
        background-color: #0056b3;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        background-color: white;
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
        border-radius: 5px;
        margin-top: 5px;
        min-width: 160px;
        z-index: 1;
    }

    .dropdown-item {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-item:hover {
        background-color: #ddd;
    }

    body {
        background-color:#ffffff; 
    }

    .container {
        text-align: center; 
        margin-top:50px; 
    }
        
    .nav {
        text-align: center; 
        margin-top:50px; 
        background-color:#0080c0 ;
    }

    h2 {
        color: white; 
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        text-align: center;
        font-size: 54px;   
    }

    .container, .modal-content {
        text-align: center; 
        margin-top: 5px; 
    }
    .container, .mt-4{
        text-align: left; 
        margin-top: 5px; 
    }
    .table {
        width: 90%; 
        margin: 10px auto; 
    }
    .table th, .table td {
        text-align: center;  
    }
    .table thead {
        background-color: #ffffff !important;
        color: white; 
    }
    .dropdown-menu {
        text-align: center; 
        margin-top: 5px; 
    }
    .table tbody tr:nth-child() {
        background-color: #804000; 
    }
    form {
        margin-top: 20px; 
        margin-right: 20px; 
        text-align: left;
    }

    input[type="submit"] {
        background-color: #4CAF50; 
        color: white; 
        padding: 10px 20px; 
        font-size: 16px; 
        border: none; 
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }
   .conte{ 
        text-align: center; 
        margin-top:50px; 
        background-color:  #0080c0;
    } 
    .navbar {
        background-color:#0080c0; 
    }
    .navbar-text {
        color: white; 
    }
</style>

<body>

<?php

include 'database.php';
$database = new Database();

$datosAdmin = $database->obtenerNombreAdmin();
$nombreAdmin = $datosAdmin['Nombre'];
$rolAdmin = $datosAdmin['Rol'];
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['agregar_doctor'])) {
    header("Location: formu.html");
    exit();
    }
?>

<nav class="navbar">
    <div class="container">
       
        <a class="navbar-brand" href="#">
            <img src="img/logo.jpg" alt="Logo" height="70">
        </a>

        <span class="navbar-text">
            Programación Web
        </span>

        <div class="dropdown-section">
            <div class="dropdown-container">
                <div class="dropdown">
                    <button class="dropdown-button" id="dropdownMenuButton">
                        <?php echo "Bienvenido " .' ' . $rolAdmin . ' ' . $nombreAdmin; ?>
                    </button>
                        <ul class="dropdown-menu" id="dropdownMenu">
                            <li><a class="dropdown-item" href="cerrar_sesion.php">Cerrar Sesión</a></li>
                        </ul>
                </div>
            </div>
        </div>
        <script src="script.js"></script>
    </div>
</nav>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>




<div class="conte">
    <h2> Doctores</h2>
</div>
    

<div class="container">
   
    <form method="post">
    <input type="submit" name="agregar_doctor" value="Agregar nuevo doctor">
    </form>



    <!-- Tabla de es -->
    <table class="table mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Especialidad</th>
            <th>Consultorio</th>
            <th>Cédula</th>
            <th>Detalles</th>
            <th>Editar</th>
            
        </tr>
    </thead>
    <tbody>
        <?php
        include 'crud.php';

        $veterinarios = getVeterinarios(); 
        foreach ($veterinarios as $veterinario) {
            echo "<tr>";
            echo "<td>{$veterinario['id']}</td>";
            echo "<td>{$veterinario['nombre']}</td>";
            echo "<td>{$veterinario['apellido']}</td>";
            echo "<td>{$veterinario['especialidad']}</td>";
            echo "<td>{$veterinario['consultorio']}</td>";
            echo "<td>{$veterinario['cedula']}</td>";
            echo "<td><a href='detalles_veterinario.php?id={$veterinario['id']}'><img src='img/detalles.png' alt='Detalles' width='40' height='auto'></a></td>";
            echo "<td><a href='#' class='btn btn-primary btn-edit' data-toggle='modal' data-target='#editVeterinarioModal' data-id='{$veterinario['id']}' data-nombre='{$veterinario['nombre']}' data-apellido='{$veterinario['apellido']}' data-especialidad='{$veterinario['especialidad']}' data-consultorio='{$veterinario['consultorio']}' data-cedula='{$veterinario['cedula']}'><img src='img/editar.png' alt='Editar' width='40' height='auto'></a></td>";
           
            echo "</tr>";
        }?>
    </tbody>
</table>
</div>

 

<!-- Modal para editar veterinario -->
<div class="modal fade" id="editVeterinarioModal" tabindex="-1" aria-labelledby="editVeterinarioModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editVeterinarioModalLabel">Editar Veterinario</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario para editar veterinario -->
                <form id="editVeterinarioForm" method="post" action="editar_veterinario.php">
                    <input type="hidden" id="editVeterinarioId" name="id">
                    <div class="mb-3">
                        <label for="editNombre" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="editNombre" name="nombre" required autocomplete="off" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="editApellido" class="form-label">Apellido:</label>
                        <input type="text" class="form-control" id="editApellido" name="apellido" required autocomplete="off" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="editEspecialidad" class="form-label">Nueva Especialidad:</label>
                        <input type="text" class="form-control" id="editEspecialidad" name="especialidad" required>
                    </div>
                    <div class="mb-3">
                        <label for="editConsultorio" class="form-label">Nuevo Consultorio:</label>
                        <input type="text" class="form-control" id="editConsultorio" name="consultorio" required>
                    </div>
                    <div class="mb-3">
                        <label for="editCedula" class="form-label">Cédula:</label>
                        <input type="text" class="form-control" id="editCedula" name="cedula" required autocomplete="off" readonly>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>
   

            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function () {
        $('.btn-edit').click(function () {
            var id = $(this).data('id');
            var nombre = $(this).data('nombre');
            var apellido = $(this).data('apellido');
            var especialidad = $(this).data('especialidad');
            var consultorio = $(this).data('consultorio');
            var cedula = $(this).data('cedula');

            // Asignar los valores a los campos del formulario modal de edición
            $('#editVeterinarioModal #editVeterinarioId').val(id);
            $('#editVeterinarioModal #editNombre').val(nombre);
            $('#editVeterinarioModal #editApellido').val(apellido);
            $('#editVeterinarioModal #editEspecialidad').val(especialidad);
            $('#editVeterinarioModal #editConsultorio').val(consultorio);
            $('#editVeterinarioModal #editCedula').val(cedula);

            // Mostrar el formulario modal de edición
            $('#editVeterinarioModal').modal('show');
        });

       // Manejar el envío del formulario de edición a través de AJAX
$('#editVeterinarioForm').submit(function (event) {
    event.preventDefault();

    // Construir formData con los campos modificados y no modificados
    var formData = $('#editVeterinarioForm').serializeArray();
    formData.push({ name: 'id', value: $('#editVeterinarioId').val() });

    $.ajax({
        type: 'POST',
        url: 'editar_veterinario.php',
        data: formData,
        success: function (response) {
            alert(response);
            $('#editVeterinarioModal').modal('hide');
            location.reload();
        }
    });
});


      
    });
</script>

<!-- Footer -->
<footer>
        <!-- Texto de derechos de autor -->
        <p>&copy; 2024 Veterinaria. Todos los derechos reservados.</p>
        <!-- Enlaces de contacto y términos y condiciones -->
        <p><a>Sebastian Ocampo Carmona</a> | <a>Equipo 2</a></p>
    </footer>
    
</body>
</html>
