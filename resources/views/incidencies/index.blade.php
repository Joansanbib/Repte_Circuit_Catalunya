<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Index Incidències</title>
  <script src="https://unpkg.com/gridjs/dist/gridjs.umd.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://unpkg.com/gridjs/dist/theme/mermaid.min.css">
<style>
    #table_div{
        display:flex;
        justify-content:center; 
        font-family: Arial, sans-serif !important;
        font-weight: 100 !important;
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
