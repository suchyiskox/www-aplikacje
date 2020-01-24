<?php
session_start();
$_SESSION['haslo'] = 'root';
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Projekt 4 - CRUD PHP</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        #chart_wrap {
            position: relative;
            padding-bottom: 100%;
            height: 0;
            overflow:hidden;
        }

        #piechart {
            position: absolute;
            top: 0;
            left: 0;
            width:100%;
            height:400px;
        }
    </style>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Schronisko', 'Ilość Kotów'],
            <?php
            require 'database.php';
            $sql = 'SELECT Nazwa, Ilosc_kotow FROM Schronisko';
            foreach ($db->query($sql) as $row) {
                echo "['" . $row['Nazwa'] . "'," . $row['Ilosc_kotow'] . "],";
            }
            ?>
        ]);
        var options = {
            title: 'Ilość kotów w Schroniskach',
            width: '100%',
            height: '200px'
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);

    }
</script>
</head>
<body class="bg-white">
<a class='btn btn-secondary btn-lg ml-5 mt-2' href='koty.php?pokaz=7'>Wróć</a>
<div id="chart_wrap">
<div id="piechart" class="chart"></div>
</div>
</body>
</html>
