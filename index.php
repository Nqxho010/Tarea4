<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="css/styles.css">
</head>

<?php
include "C:\xampp\htdocs\Tarea4\db.php"
include "C:\xampp\htdocs\Tarea4\model.php"
?>

<body>

    <form id="formulario">
        <input class="nombre" type="text" id="nombre" placeholder="Nombre" required>
        <input class="email" type="email" id="email" placeholder="Email" required>
        <button class="btn_add" type="submit">Agregar Usuario</button>
    </form>

    <h2>Lista de Usuarios</h2>
    <ul id="usuarios"></ul>

    <script>
        function cargarUsuarios() {
            $.ajax({
                url: 'acciones.php',
                method: 'POST',
                data: {accion: 'leer'},
                success: function(data) {
                    const usuarios = JSON.parse(data);
                    let html = '';
                    usuarios.forEach(function(usuario) {
                        html += `<li>${usuario.nombre} (${usuario.email}) 
                                  <button onclick="editarUsuario(${usuario.id}, '${usuario.nombre}', '${usuario.email}')">Editar</button>
                                  <button onclick="eliminarUsuario(${usuario.id})">Eliminar</button></li>`;
                    });
                    $('#usuarios').html(html);
                }
            });
        }


        $('#formulario').submit(function(e) {
            e.preventDefault();
            const nombre = $('#nombre').val();
            const email = $('#email').val();
            
            $.ajax({
                url: 'acciones.php',
                method: 'POST',
                data: {
                    accion: 'crear',
                    nombre: nombre,
                    email: email
                },
                success: function(response) {
                    alert(response);
                    cargarUsuarios();
                    $('#nombre').val('');
                    $('#email').val('');
                }
            });
        });

        function editarUsuario(id, nombre, email) {
            const nuevoNombre = prompt('Nuevo nombre', nombre);
            const nuevoEmail = prompt('Nuevo email', email);
            
            if (nuevoNombre && nuevoEmail) {
                $.ajax({
                    url: 'acciones.php',
                    method: 'POST',
                    data: {
                        accion: 'actualizar',
                        id: id,
                        nombre: nuevoNombre,
                        email: nuevoEmail
                    },
                    success: function(response) {
                        alert(response);
                        cargarUsuarios();
                    }
                });
            }
        }
        function eliminarUsuario(id) {
            if (confirm('¿Estás seguro de eliminar este usuario?')) {
                $.ajax({
                    url: 'acciones.php',
                    method: 'POST',
                    data: {
                        accion: 'eliminar',
                        id: id
                    },
                    success: function(response) {
                        alert(response);
                        cargarUsuarios();
                    }
                });
            }
        }

        // Cargar la lista de usuarios al inicio
        $(document).ready(function() {
            cargarUsuarios();
        });
    </script>

</body>

