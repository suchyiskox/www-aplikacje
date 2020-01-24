<?php
session_start();
$start = null;
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Projekt 4 - CRUD PHP</title>
    <link rel="stylesheet" href="css/styl.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<div class="grid-container bg-secondary">
    <div class="item logo bg-dark"><p class="text-white h1 text-center font-weight-bold mt-3">
            PROJEKT 4 WWW - PHP I RAPORTOWANIE</p></div>
    <main class="meni">
        <div class='h1 text-center text-white mb-5'>Wybierz tabelę aby<br/>przejść do jej panelu</div>
        <div class='text-center'><a class='btn btn-primary btn-lg btn-block mb-4' href='koty.php'>Tabela Koty</a></div>
        <div class='text-center'><a class='btn btn-primary btn-lg btn-block' href='schronisko.php'>Tabela Schronisko</a>
        </div>
    </main>
    <footer class="stopka text-white text-center"><p class="mt-2 h5">Autor: Adrian Piwnicki</p></footer>
</div>
</body>
</html>
