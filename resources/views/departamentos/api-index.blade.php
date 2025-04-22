@extends('layout')

@section('content')
    <h1>Departamentos (desde API)</h1>

    <table border="1" id="tabla-departamentos">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Ubicación</th>
                <th>Creado</th>
            </tr>
        </thead>
        <tbody>
            <!-- Los datos se cargarán dinámicamente -->
        </tbody>
    </table>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            fetch('/api/v1/departamentos')
                .then(response => response.json())
                .then(data => {
                    const tbody = document.querySelector('#tabla-departamentos tbody');
                    data.forEach(depto => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${depto.id}</td>
                            <td>${depto.nombre_departamento}</td>
                            <td>${depto.ubicacion}</td>
                            <td>${new Date(depto.created_at).toLocaleString()}</td>
                        `;
                        tbody.appendChild(row);
                    });
                })
                .catch(error => {
                    console.error('Error al obtener los departamentos:', error);
                });
        });
    </script>
@endsection
