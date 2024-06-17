<?php
include 'config.php';

function getVeterinarios() {
    global $conn;
    $query = "SELECT * FROM veterinario";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function addVeterinario($nombre, $apellido, $especialidad, $consultorio, $cedula) {
    global $conn;
    $query = "INSERT INTO veterinario (Nombre, Apellido, Especialidad, Consultorio, Cedula) VALUES (:nombre, :apellido, :especialidad, :consultorio, :cedula)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellido', $apellido);
    $stmt->bindParam(':especialidad', $especialidad);
    $stmt->bindParam(':consultorio', $consultorio);
    $stmt->bindParam(':cedula', $cedula);
    return $stmt->execute();
}
function getVeterinarioByCedula($cedula) {
    global $conn;
    $query = "SELECT * FROM veterinario WHERE Cedula = :cedula";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':cedula', $cedula);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateVeterinario($id, $especialidad, $consultorio) {
    global $conn;
    $query = "UPDATE veterinario SET Especialidad = :especialidad, Consultorio = :consultorio WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':especialidad', $especialidad);
    $stmt->bindParam(':consultorio', $consultorio);
    return $stmt->execute();
}



function getVeterinarioById($id) {
    global $conn;
    $query = "SELECT * FROM veterinario WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>