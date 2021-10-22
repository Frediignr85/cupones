<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>REPORTE COMPRA</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
    table th {
        background: #0c1c60 !important;
        color: #fff !important;
        border: 1px solid #ddd !important;
        line-height: 15px !important;
        text-align: center !important;
        vertical-align: middle !important;

    }

    table td {
        line-height: 15px !important;
        text-align: center !important;
    }
    </style>
</head>

<body>
    <div class="container">

        <h2>INFORMACION DE LA COMPRA</h2>

        <table class="table table-striped" border='1'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>TOTAL</th>
                    <th>CLIENTE</th>
                    <th>DUI CLIENTE</th>
                    <th>FECHA</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $id_compra_general; ?></td>
                    <td><?php echo $total_compra; ?></td>
                    <td><?php echo $nombre; ?></td>
                    <td><?php echo $dui; ?></td>
                    <td><?php echo $created_at; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>