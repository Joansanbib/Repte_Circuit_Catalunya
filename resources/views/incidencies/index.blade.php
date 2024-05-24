<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Index Incidències</title>
  <script src="https://unpkg.com/gridjs/dist/gridjs.umd.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://unpkg.com/gridjs/dist/theme/mermaid.min.css">
  <link rel="stylesheet" href="{{ asset('css/styles_navbar.css') }}">
</head>
<body>
<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <header id="header">
        <ul>
           <!--  <li><a href="/users">Usuaris</a></li>
            <li><a href="/incidences/create">+ Incidència</a></li>
            <li><a href="/zones">Zones</a></li>
            <li><a href="/logout">Tancar sessió</a></li>
            <li><a href="/">Home</a></li> -->

            <li><a href="/">Home</a></li>
            <li><a href="/incidences/create">+ Incidència</a></li>
            <li><a href="/zones/create">+ Zona</a></li>
            <li><a href="/users">Usuaris</a></li>
           <!--  <li><a href="/incidences">Incidències</a></li>
            <li><a href="/zones">Zones</a></li> -->
            <li><a href="/logout">Tancar sessió</a></li>
        </ul>
    </header>
</nav>

<style>
    #table_div{
        display:flex;
        justify-content:center;
        
    }
    #table_div td{
        text-align: center;
    }
    #table_div tr{
        text-align : center;
    }
</style>
<?php
    $arr = [];
    foreach ($incidencies as $row) {
        $arr[] = array(
            'id' => $row->id,
            'Nom' => $row->Nom,
            'Descripcio' => $row->Descripcio,
            'Data' => date('Y-m-d', strtotime($row->Data)),
            'Estat' => $row->Estat,
            'Prioritat' => $row->Prioritat,
            'Rol_assignat' => $row->Rol_assignat,
            'Imatge' => asset('img/' . $row->Ruta_img), 
        );
    }

    $grid_data = [];
    foreach ($arr as $row) {
        $grid_data[] = [
            $row['id'],
            $row['Nom'],
            $row['Descripcio'],
            $row['Data'],
            $row['Estat'],
            $row['Prioritat'],
            $row['Rol_assignat'],
            $row['Imatge'],
        ];
    }

    $grid_data_json = json_encode($grid_data);
?>
<div id="grafic">
    <div id="table_div"></div>
</div>
<script type="module">
    document.addEventListener("DOMContentLoaded", function() {
        const grid = new gridjs.Grid({
            columns: [
              { 
                name: 'id',
                hidden: true
              },
               'Nom',
               'Descripcio',
               'Data',
               'Estat',
               'Prioritat',
               'Rol_assignat',
                {
                    name: 'Imatge',
                    formatter: (cell) => {
                        return gridjs.h('img', {
                            src: cell,
                            width: 100, // Adjust as needed
                            height: 100, 
                        });
                    }
                },
               {
                formatter: (cell, row) => {
                    const editarButton = gridjs.h('button', {
                        className: 'py-2 mb-4 px-4 border rounded-md text-white bg-blue-600',
                        onClick: () => {
                            window.location.href = `/incidences/${row.cells[0].data}/edit`;
                        }
                    }, 'Editar');

                    const eliminarButton = gridjs.h('button', {
                        className: 'py-2 mb-4 px-4 border rounded-md text-white bg-red-600',
                        onClick: () => {
                          var resultado = window.confirm("Segur que vols borrar aquesta incidència?");
                            if(resultado){
                              window.location.href = `/incidences/delete/${row.cells[0].data}`;
                            }
                        }

                    }, 'Eliminar');

                    return [editarButton, eliminarButton];
                }
               },

            ],
            sort: true,
            pagination: true,
            search: true,
            width : '90%',
            data: <?php echo $grid_data_json; ?>
        }).render(document.getElementById('table_div'));;
    });
</script>
</body>
</html>
