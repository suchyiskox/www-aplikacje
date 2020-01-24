<?php
session_start();
$_SESSION['haslo'] = 'root';
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
    <div class="item logo bg-dark text-white"><p class="text-white h1 text-center font-weight-bold mt-3">PROJEKT 4 WWW - PHP I RAPORTOWANIE</p></div>

    <nav class='item nawigacja bg-primary'>
        <ul class='menu'>
            <li><a class='btn btn-primary btn-lg' href='schronisko.php?pokaz=1'> Create</a></li>
            <li><a class='btn btn-primary btn-lg' href='schronisko.php?pokaz=2'> Read</a></li>
            <li><a class="btn btn-primary btn-lg" href="schronisko.php?pokaz=3"> Update</a></li>
            <li><a class="btn btn-primary btn-lg" href="schronisko.php?pokaz=4">Delete</a></li>
        </ul>
    </nav>
    <nav class='item nawigacja2 bg-primary'>
        <ul class='menu2'>
            <li><a class='btn btn-primary btn-lg' href='schronisko.php?pokaz=5'>Tabela</a></li>
            <li><a class='btn btn-primary btn-lg disabled' href='schronisko.php?pokaz=6'>Raport1</a></li>
            <li><a class="btn btn-primary btn-lg disabled" href="schronisko.php?pokaz=7">Raport2</a></li>
        </ul>
    </nav>
    <main class="meni bg-secondary text-dark mt-2 mb-2">
        <?php
        //start
        if(!isset($_GET['pokaz'])){
            echo "<div class='form-group text-center h2'>
                  Witaj na mojej stronie: <br />Jesteś w Panelu Schronisko!
                  <a href='index.php' class='btn btn-primary btn-lg btn-block mt-5'>Wróc do wyboru tabel</a>
                  </div>";
        }

        //create.php
        if ($_GET['pokaz'] == "1") {
            echo "<form method='post' action='createSchronisko.php'>";
            echo "<div class='text-center text-white h2'>Dodaj Schronisko do Bazy</div>";
            echo "<div class='form-group text-center h4'><label for='s_nazwa'>Podaj nazwę schroniska</label><br />";
            echo "<input type='text' name='nazwa' id='s_nazwa'>";
            echo "</div>";
            echo "<div class='form-group text-center h4'><label for='s_miasto'>Podaj miasto schroniska</label><br />";
            echo "<input type='text' name='miasto' id='s_miasto'>";
            echo "</div>";
            echo "<div class='form-group text-center h4'><label for='s_email'>Podaj email schroniska</label><br />";
            echo "<input type='email' name='email' id='s_email'>";
            echo "</div>";
            echo "<div class='form-group text-center h4'><label for='s_telefon'>Podaj telefon schroniska</label><br />";
            echo "<input type='number' name='telefon' id='s_telefon'>";
            echo "</div>";
            echo "<div class='form-group text-center h4'><label for='s_schronisko'>Podaj ilość kotów w schronisku</label><br />";
            echo "<input type='number' name='ilosc' id='s_schronisko'>";
            echo "</div>";
            echo "<div class='form-action text-center'><input class='btn btn-primary btn-lg ' type='submit' value='Dodaj schronisko'>
                  <a class='btn btn-secondary text-center btn-lg' href='schronisko.php'>Cofnij</a></div></form>";
            if (isset($_SESSION['podana_nazwa'])) {
                echo '<p class="text-center h4 text-warning">To nie jest poprawna nazwa schroniska!</p>';
                unset($_SESSION['podana_nazwa']);
            }
            if (isset($_SESSION['podane_miasto'])) {
                echo '<p class="text-center h4 text-warning">To nie jest poprawne miasto dla schroniska!</p>';
                unset($_SESSION['podane_miasto']);
            }
            if (isset($_SESSION['podany_email'])) {
                echo '<p class="text-center h4 text-warning">To nie jest poprawny email!</p>';
                unset($_SESSION['podany_email']);
            }
            if (isset($_SESSION['podany_telefon'])) {
                echo '<p class="text-center h4 text-warning">To nie jest poprawny telefon!</p>';
                unset($_SESSION['podany_telefon']);
            }
            if (isset($_SESSION['podana_ilosc'])) {
                echo '<p class="text-center h4 text-warning">To nie jest poprawna ilość kotów!</p>';
                unset($_SESSION['podana_ilosc']);
            }
            if (isset($_SESSION['poprawnie'])) {
                echo '<p class="text-center h4 text-warning">OK! Dodano nowe Schronisko!</p>';
                unset($_SESSION['poprawnie']);
            }
        }

        //Read.php
        if ($_GET['pokaz'] == "2") {
            echo "<form method='post' action='readSchronisko.php'>";
            echo "<div class='container'><div class='row h2 text-center text-white'>Dane Schroniska</div>              
                  <div class='form-group row'>
                  <label class='col-lg-4 control-label font-weight-bold h4'>Podaj numer ID</label>
                  <div class='col-lg-4'>
                  <input type='number' name='SchroniskoID' id='s_read' class='mb-1'>";
            echo "</div></div>
                  <div class='control-group row'>
                  <label class='col-lg-4 control-label h4'>Nazwa Schroniska</label>
                  <div class='col-lg-4'>
                  <label class='form-control'>";
            echo $_SESSION['Nazwa'];
            unset($_SESSION['Nazwa']);
            echo "</label></div></div>
                  <div class='control-group row'>
                  <label class='col-lg-4 control-label h4'>Miasto</label>
                  <div class='col-lg-4'>
                  <label class='form-control'>";
            echo $_SESSION['Miasto'];
            unset($_SESSION['Miasto']);
            echo "</label></div></div>
                  <div class='control-group row'>
                  <label class='col-lg-4 control-label h4'>Email</label>
                  <div class='col-lg-4'>
                  <label class='form-control'>";
            echo $_SESSION['Email'];
            unset($_SESSION['Email']);
            echo "</label></div></div>
                  <div class='control-group row'>
                  <label class='col-lg-4 control-label h4'>Telefon</label>
                  <div class='col-lg-4'>
                  <label class='form-control'>";
            echo $_SESSION['Telefon'];
            unset($_SESSION['Telefon']);
            echo "</label></div></div>
                  <div class='control-group row'>
                  <label class='col-lg-4 control-label h4'>Ilość Kotów</label>
                  <div class='col-lg-4'>
                  <label class='form-control'>";
            echo $_SESSION['Ilosc_kotow'];
            unset($_SESSION['Ilosc_kotow']);
            echo "</label></div></div>
                  <div class='form-actions'>
                  <input type='submit' class='btn btn-primary btn-lg' value='Szukaj'>
                  <a class='btn btn-secondary btn-lg' href='schronisko.php'>Cofnij</a>
                  </div>";
            if (isset($_SESSION['blad'])) {
                echo "<p class='text-center h4 text-warning'>Nie ma takiego numeru ID Schroniska w Bazie Danych!</p>";
                unset($_SESSION['blad']);
            }
            echo "</div></form>";
        }

        //Update.php
        if ($_GET['pokaz'] == "3") {
            echo "<form method='post' action='read_updateSchronisko.php'> ";
            echo "<div class='container'><div class='row h2 text-white'>Aktualizuj dane Kota</div>     
                  <div class='form-group row'>
                  <label class='col-lg-4 control-label font-weight-bold h4' for='s_read'>Podaj numer ID</label>
                  <div class='col-lg-6'>
                  <input type='number' name='SchroniskoID' id='s_read' class='mb-1' />
                  <input type='submit' class='btn btn-primary btn-lg ml-2' value='Szukaj' />";
            echo "</div></div></div></form>
                  <form method='post' action='updateSchronisko.php'>
                  <div class='container'>
                  <div class='control-group row'>
                  <label class='col-lg-4 control-label h4'>Nazwa Schroniska</label>
                  <div class='col-lg-4'>
                  <input name='Nazwa' type='text'  class=\"form-control\" placeholder=\"Nazwa Schroniska\" value='";
            echo $_SESSION['Nazwa'];
            unset($_SESSION['Nazwa']);
            echo "'>";
            if (isset($_SESSION['nazwa_Error'])) {
                echo "<p class='text-warning h5'>Niepoprawna nazwa schroniska!</p>";
                unset($_SESSION['nazwa_Error']);
            }
            echo "</div></div>
                  <div class='control-group row'>
                  <label class='col-lg-4 control-label h4'>Email</label>
                  <div class='col-lg-4'>
                  <input name='Email' type='email'  class='form-control' placeholder='Email' value='";
            echo $_SESSION['Email'];
            unset($_SESSION['Email']);
            echo "'>";
            if (isset($_SESSION['emailError'])) {
                echo '<p class="text-warning h5">Niepoprawny email!</p>';
                unset($_SESSION['emailError']);
            }
            echo "</div></div>
                  <div class='control-group row'>
                  <label class='col-lg-4 control-label h4'>Miasto</label>
                  <div class='col-lg-4'>
                  <input name='Miasto' type='text'  class='form-control' placeholder='Miasto' value='";
            echo $_SESSION['Miasto'];
            unset($_SESSION['Miasto']);
            echo "'>";
            if (isset($_SESSION['miastoError'])) {
                echo '<p class="text-warning h5">Niepoprawne miasto!</p>';
                unset($_SESSION['miastoError']);
            }
            echo "</div></div>
                  <div class='control-group row'>
                  <label class='col-lg-4 control-label h4'>Telefon</label>
                  <div class='col-lg-4'>
                  <input name='Telefon' type='number'  class='form-control' placeholder='Telefon' value='";
            echo $_SESSION['Telefon'];
            unset($_SESSION['Telefon']);
            echo "'>";
            if (isset($_SESSION['telefonError'])) {
                echo '<p class="text-warning h5">Niepoprawny telefon!</p>';
                unset($_SESSION['telefonError']);
            }
            echo "</div></div>
                  <div class='control-group row'>
                  <label class='col-lg-4 control-label h4'>Ilość kotów</label>
                  <div class='col-lg-4'>
                  <input name='Ilosc_kotow' type='number'  class='form-control' placeholder='Ilość Kotów' value='";
            echo $_SESSION['Ilosc_kotow'];
            unset($_SESSION['Ilosc_kotow']);
            echo "'>";
            if (isset($_SESSION['ilosc_kotowError'])) {
                echo '<p class="text-warning h5">Niepoprawna ilość kotów!</p>';
                unset($_SESSION['ilosc_kotowError']);
            }
            echo "</div></div>
                  <div class='form-action'><input type='submit' class='btn btn-primary btn-lg' value='Aktualizuj'>
                  <a class='btn btn-secondary btn-lg' href='schronisko.php'>Cofnij</a></div></div></form>";
            if (isset($_SESSION['poprawnie_u'])) {
                echo '<p class="text-warning h5 text-center">Zaktualizowano schronisko w Bazie Danych!</p>';
                unset($_SESSION['poprawnie_u']);
                unset($_SESSION['Nazwa']);
                unset($_SESSION['Email']);
                unset($_SESSION['Telefon']);
                unset($_SESSION['Miasto']);
                unset($_SESSION['Ilosc_kotow']);
            }
        }

        //delete.php
        if ($_GET['pokaz'] == "4") {
            echo "<form method='post' action='deleteSchronisko.php'>";
            echo "<div class='text-center text-white h2'>Usuń Schronisko z Bazy</div>";
            echo "<div class='form-group text-center h3'>
                  <label for='s_nazwa'>Podaj ID Schroniska do usunięcia</label><br />";
            echo "<input type='number' name='IDSchronisko_Delete' id='s_nazwa'></div>";
            if (isset($_SESSION['blad_id'])) {
                echo '<p class="text-center text-warning h5">Niepoprawne ID Schroniska do usunięcia!</p>';
                unset($_SESSION['blad_id']);
            }
            echo "<div class='form-group text-center h3'><label for='h_nazwa'>Podaj hasło do bazy danych</label><br />";
            echo "<input type='password' name='haslo' id='h_nazwa'></div>";
            if (isset($_SESSION['b_haslo'])) {
                echo '<p class="text-center text-warning h5">Błędne hasło dostępu!</p>';
                unset($_SESSION['b_haslo']);
            }
            echo "<div class='form-action text-center'><input type='submit' class='btn btn-primary btn-lg' value='Usuń'>
                  <a class='btn btn-secondary btn-lg' href='schronisko.php'>Cofnij</a></div>";
            echo "</form>";
            if(isset($_SESSION['usuniety'])){
                echo '<p class="text-center">Usunięto Schronisko z Bazy Danych!</p>';
                unset($_SESSION['usuniety']);
            }
        }

        //tabela
        if($_GET['pokaz'] == "5"){
            require 'database.php';
            $sql = 'SELECT SchroniskoID, Nazwa, Miasto, Email, Telefon, Ilosc_kotow
                    FROM Schronisko';
            echo "<table class=\"table table-lg table-bordered table-dark text-dark text-center\">";
            echo "<thead>
                  <tr class='bg-primary text-white h5'>
                  <th scope=\"col\">SchroniskoID</th>
                  <th scope=\"col\">Nazwa Schroniska</th>
                  <th scope=\"col\">Miasto</th>
                  <th scope=\"col\">Email</th>
                  <th scope=\"col\">Telefon</th>
                  <th scope=\"col\">Ilość Kotów</th>
                  </tr>
                  </thead><tbody>";
            foreach ($db->query($sql) as $row) {
                echo "<tr class='bg-white h5'>";
                echo '<td>'. $row['SchroniskoID'] . '</td>';
                echo '<td>'. $row['Nazwa'] . '</td>';
                echo '<td>'. $row['Miasto'] . '</td>';
                echo '<td>'. $row['Email'] . '</td>';
                echo '<td>'. $row['Telefon'] . '</td>';
                echo '<td>'. $row['Ilosc_kotow'] . '</td>';
                echo '</tr>';
            }
            echo "</tbody></table>";
        }
        ?>
    </main>
    <footer class="stopka text-white text-center"><p class="mt-2 h5">Autor: Adrian Piwnicki</p></footer>
</div>
</body>
</html>
