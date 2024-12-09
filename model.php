<?php
include "C:\xampp\htdocs\Tarea4\db.php"

// Crear
if (isset($_POST['accion']) && $_POST['accion'] == 'crear') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    
    $sql = "INSERT INTO usuarios (nombre, email) VALUES ('$nombre', '$email')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Nuevo registro creado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Leer
if (isset($_POST['accion']) && $_POST['accion'] == 'leer') {
    $sql = "SELECT * FROM usuarios";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $usuarios = [];
        while($row = $result->fetch_assoc()) {
            $usuarios[] = $row;
        }
        echo json_encode($usuarios);
    } else {
        echo json_encode([]);
    }
}

// Actualizar
if (isset($_POST['accion']) && $_POST['accion'] == 'actualizar') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    
    $sql = "UPDATE usuarios SET nombre='$nombre', email='$email' WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Registro actualizado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Eliminar
if (isset($_POST['accion']) && $_POST['accion'] == 'eliminar') {
    $id = $_POST['id'];
    
    $sql = "DELETE FROM usuarios WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Registro eliminado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
