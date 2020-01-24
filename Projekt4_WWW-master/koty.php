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
    <div class="item logo bg-dark"><p class="text-white h1 text-center font-weight-bold mt-3">PROJEKT 4 WWW - PHP I
            RAPORTOWANIE</p></div>

    <nav class='item nawigacja bg-primary'>
        <ul class='menu'>
            <li><a class='btn btn-primary btn-lg' href='koty.php?pokaz=1'> Create</a></li>
            <li><a class='btn btn-primary btn-lg' href='koty.php?pokaz=2'> Read</a></li>
            <li><a class="btn btn-primary btn-lg" href="koty.php?pokaz=3"> Update</a></li>
            <li><a class="btn btn-primary btn-lg" href="koty.php?pokaz=4">Delete</a></li>
        </ul>
    </nav>
    <nav class='item nawigacja2 bg-primary'>
        <ul class='menu2'>
            <li><a class='btn btn-primary btn-lg' href='koty.php?pokaz=5'>Tabela</a></li>
            <li><a class='btn btn-primary btn-lg' href='koty.php?pokaz=6'>RaportPDF</a></li>
            <li><a class="btn btn-primary btn-lg" href="koty.php?pokaz=7">Wykresy</a></li>
        </ul>
    </nav>
    <main class="meni bg-secondary text-dark mt-2 mb-2">
        <?php
        //start
        if (!isset($_GET['pokaz'])) {
            echo "<div class='form-group text-center h2'>
                  Witaj na mojej stronie: <br />Jesteś w Panelu Koty!
                  <a href='index.php' class='btn btn-primary btn-lg btn-block mt-5'>Wróc do wyboru tabel</a>
                  </div>";
        }

        //create.php
        if ($_GET['pokaz'] == "1") {
            echo "<form method='post' action='create.php'>";
            echo "<div class='text-center text-white h2'>Dodaj Kota do Bazy</div>";
            echo "<div class='form-group text-center h4'><label for='s_nazwa'>Podaj nazwę kota</label><br />";
            echo "<input type='text' name='nazwa' id='s_nazwa'>";
            echo "</div>";
            echo "<div class='form-group text-center h4'><label for='s_plec'>Podaj płeć kota</label><br />";
            echo "<input type='text' name='plec' id='s_plec'>";
            echo "</div>";
            echo "<div class='form-group text-center h4'><label for='s_rasa'>Podaj rasę kota</label><br />";
            echo "<input type='text' name='rasa' id='s_rasa'>";
            echo "</div>";
            echo "<div class='form-group text-center h4'><label for='s_wiek'>Podaj wiek kota</label><br />";
            echo "<input type='number' name='wiek' id='s_wiek'>";
            echo "</div>";
            echo "<div class='form-group text-center h4'><label for='s_schronisko'>Podaj nazwę schroniska</label><br />";
            echo "<input type='text' name='schronisko' id='s_schronisko'>";
            echo "</div>";
            echo "<div class='form-action text-center'><input class='btn btn-primary btn-lg ' type='submit' value='Dodaj kota'>
                  <a class='btn btn-secondary text-center btn-lg' href='koty.php'>Cofnij</a></div></form>";
            if (isset($_SESSION['podana_nazwa'])) {
                echo '<p class="text-center h4 text-warning">To nie jest poprawna nazwa kota!</p>';
                unset($_SESSION['podana_nazwa']);
            }
            if (isset($_SESSION['podana_plec'])) {
                echo '<p class="text-center h4 text-warning">To nie jest poprawna płeć kota! Tylko: Samiec/Samica</p>';
                unset($_SESSION['podana_plec']);
            }
            if (isset($_SESSION['podana_rasa'])) {
                echo '<p class="text-center h4 text-warning">To nie jest poprawna rasa kota!</p>';
                unset($_SESSION['podana_rasa']);
            }
            if (isset($_SESSION['podany_wiek'])) {
                echo '<p class="text-center h4 text-warning">To nie jest poprawny wiek kota!</p>';
                unset($_SESSION['podany_wiek']);
            }
            if (isset($_SESSION['podane_schronisko'])) {
                echo '<p class="text-center h4 text-warning">Takie schronisko nie istnieje! Przykładowe: Schronisko1, Schronisko2</p>';
                unset($_SESSION['podane_schronisko']);
            }
            if (isset($_SESSION['poprawnie'])) {
                echo '<p class="text-center h4 text-warning">OK! Dodano nowego kota!</p>';
                unset($_SESSION['poprawnie']);
            }
        }
        //Read.php
        if ($_GET['pokaz'] == "2") {
            echo "<form method='post' action='read.php'>";
            echo "<div class='container'><div class='row h2 text-center text-white'>Dane Kota</div>              
                  <div class='form-group row'>
                  <label class='col-lg-4 control-label font-weight-bold h4'>Podaj numer ID</label>
                  <div class='col-lg-4'>
                  <input type='number' name='KotyID' id='s_read' class='mb-1'>";
            echo "</div></div>
                  <div class='control-group row'>
                  <label class='col-lg-4 control-label h4'>Nazwa Kota</label>
                  <div class='col-lg-4'>
                  <label class='form-control'>";
            echo $_SESSION['Nazwa_kota'];
            unset($_SESSION['Nazwa_kota']);
            echo "</label></div></div>
                  <div class='control-group row'>
                  <label class='col-lg-4 control-label h4'>Płeć</label>
                  <div class='col-lg-4'>
                  <label class='form-control'>";
            echo $_SESSION['Plec'];
            unset($_SESSION['Plec']);
            echo "</label></div></div>
                  <div class='control-group row'>
                  <label class='col-lg-4 control-label h4'>Rasa</label>
                  <div class='col-lg-4'>
                  <label class='form-control'>";
            echo $_SESSION['Rasa'];
            unset($_SESSION['Rasa']);
            echo "</label></div></div>
                  <div class='control-group row'>
                  <label class='col-lg-4 control-label h4'>Wiek</label>
                  <div class='col-lg-4'>
                  <label class='form-control'>";
            echo $_SESSION['Wiek'];
            unset($_SESSION['Wiek']);
            echo "</label></div></div>
                  <div class='control-group row'>
                  <label class='col-lg-4 control-label h4'>Nazwa Schroniska</label>
                  <div class='col-lg-4'>
                  <label class='form-control'>";
            echo $_SESSION['Nazwa'];
            unset($_SESSION['Nazwa']);
            echo "</label></div></div>
                  <div class='control-group row'>
                  <label class='col-lg-4 control-label h4'>Nazwa Miasta</label>
                  <div class='col-lg-4'>
                  <label class='form-control'>";
            echo $_SESSION['Miasto'];
            unset($_SESSION['Miasto']);
            echo "</label></div></div>
                  <div class='control-group row'>
                  <label class='col-lg-4 control-label h4'>Numer Telefonu Schroniska</label>
                  <div class='col-lg-4'>
                  <label class='form-control'>";
            echo $_SESSION['Telefon'];
            unset($_SESSION['Telefon']);
            echo "</label></div></div>
                  <div class='control-group row'>
                  <label class='col-lg-4 control-label h4'>Adres Email Schroniska</label>
                  <div class='col-lg-4'>
                  <label class='form-control'>";
            echo $_SESSION['Email'];
            unset($_SESSION['Email']);
            echo "</label></div></div>
                  <div class='form-actions'>
                  <input type='submit' class='btn btn-primary btn-lg' value='Szukaj'>
                  <a class='btn btn-secondary btn-lg' href='koty.php'>Cofnij</a>
                  </div>";
            if (isset($_SESSION['blad'])) {
                echo "<p class='text-center h4 text-warning'>Nie ma takiego numeru ID Kota w Bazie Danych!</p>";
                unset($_SESSION['blad']);
            }
            echo "</div></form>";
        }

        //Update.php
        if ($_GET['pokaz'] == "3") {
            echo "<form method='post' action='read_updateKoty.php'> ";
            echo "<div class='container'><div class='row h2 text-white'>Aktualizuj dane Kota</div>     
                  <div class='form-group row'>
                  <label class='col-lg-4 control-label font-weight-bold h4' for='s_read'>Podaj numer ID</label>
                  <div class='col-lg-6'>
                  <input type='number' name='kot' id='s_read' class='mb-1' />
                  <input type='submit' class='btn btn-primary btn-lg ml-2' value='Szukaj' />";
            echo " value='";
            echo $_SESSION['Nazwa_kota_u'];
            unset($_SESSION['Nazwa_kota_u']);
            echo "'>";
            if (isset($_SESSION['nazwa_kotaError'])) {
                echo "<p class='text-warning h5'>Niepoprawna nazwa kota!</p>";
                unset($_SESSION['nazwa_kotaError']);
            }
            echo "</div></div>
                  <div class='control-group row'>
                  <label class='col-lg-4 control-label h4'>Płeć Kota</label>
                  <div class='col-lg-4'>
                  <input name='plec' type='text'  class='form-control' placeholder='Płeć Kota' value='";
            echo $_SESSION['Plec_u'];
            unset($_SESSION['Plec_u']);
            echo "'>";
            if (isset($_SESSION['plecError'])) {
                echo '<p class="text-warning h5">Tylko Samiec/Samica!</p>';
                unset($_SESSION['plecError']);
            }
            echo "</div></div>
                  <div class='control-group row'>
                  <label class='col-lg-4 control-label h4'>Rasa Kota</label>
                  <div class='col-lg-4'>
                  <input name='rasa' type='text'  class='form-control' placeholder='Rasa Kota' value='";
            echo $_SESSION['Rasa_u'];
            unset($_SESSION['Rasa_u']);
            echo "'>";
            if (isset($_SESSION['rasaError'])) {
                echo '<p class="text-warning h5">Niepoprawna rasa kota!</p>';
                unset($_SESSION['rasaError']);
            }
            echo "</div></div>
                  <div class='control-group row'>
                  <label class='col-lg-4 control-label h4'>Wiek Kota</label>
                  <div class='col-lg-4'>
                  <input name='wiek' type='number'  class='form-control' placeholder='Wiek Kota' value='";
            echo $_SESSION['Wiek_u'];
            unset($_SESSION['Wiek_u']);
            echo "'>";
            if (isset($_SESSION['wiekError'])) {
                echo '<p class="text-warning h5">Niepoprawny wiek kota!</p>';
                unset($_SESSION['wiekError']);
            }
            echo "</div></div>
                  <div class='control-group row'>
                  <label class='col-lg-4 control-label h4'>Nazwa Schroniska Kota</label>
                  <div class='col-lg-4'>
                  <input name='schronisko' type='text'  class='form-control' placeholder='Nazwa Schroniska' value='";
            echo $_SESSION['Nazwa_u'];
            unset($_SESSION['Nazwa_u']);
            echo "'>";
            if (isset($_SESSION['schroniskoError'])) {
                echo '<p class="text-warning h5">Niepoprawna nazwa schroniska kota! (Przykład: Schronisko1)</p>';
                unset($_SESSION['schroniskoError']);
            }
            echo "</div></div>
                  <div class='form-action'><input type='submit' class='btn btn-primary btn-lg' value='Aktualizuj'>
                  <a class='btn btn-secondary btn-lg' href='koty.php'>Cofnij</a></div></div></form>";
            if (isset($_SESSION['poprawnie_u'])) {
                echo '<p class="text-warning h5 text-center">Zaktualizowano kota w Bazie Danych!</p>';
                unset($_SESSION['poprawnie_u']);
                unset($_SESSION['Nazwa_kota_u']);
                unset($_SESSION['Rasa_u']);
                unset($_SESSION['Plec_u']);
                unset($_SESSION['Wiek_u']);
                unset($_SESSION['Nazwa_u']);
            }
        }

        //delete.php
        if ($_GET['pokaz'] == "4") {
            echo "<form method='post' action='delete.php'>";
            echo "<div class='text-center text-white h2'>Usuń Kota z Bazy</div>";
            echo "<div class='form-group text-center h3'>
                  <label for='s_nazwa'>Podaj ID Kota do usunięcia</label><br />";
            echo "<input type='number' name='IDKot_Delete' id='s_nazwa'></div>";
            if (isset($_SESSION['blad_id'])) {
                echo '<p class="text-center text-warning h5">Niepoprawne ID Kota do usunięcia!</p>';
                unset($_SESSION['blad_id']);
            }
            echo "<div class='form-group text-center h3'><label for='h_nazwa'>Podaj hasło do bazy danych</label><br />";
            echo "<input type='password' name='haslo' id='h_nazwa'></div>";
            if (isset($_SESSION['b_haslo'])) {
                echo '<p class="text-center text-warning h5">Błędne hasło dostępu!</p>';
                unset($_SESSION['b_haslo']);
            }
            echo "<div class='form-action text-center'><input type='submit' class='btn btn-primary btn-lg' value='Usuń'>
                  <a class='btn btn-secondary btn-lg' href='koty.php'>Cofnij</a></div>";
            echo "</form>";
            if (isset($_SESSION['usuniety'])) {
                echo '<p class="text-center">Usunięto Kota z Bazy Danych!</p>';
                unset($_SESSION['usuniety']);
            }
        }

        //tabela
        if ($_GET['pokaz'] == "5") {
            require 'database.php';
            $sql = 'SELECT Koty.KotyID, Koty.Nazwa_kota, Koty.Plec, Koty.Wiek, Koty.Rasa, Schronisko.Nazwa
                    FROM Koty, Schronisko WHERE Koty.SchroniskoID=Schronisko.SchroniskoID';
            echo "<table class=\"table table-lg table-bordered table-dark text-dark text-center\">";
            echo "<thead>
                  <tr class='bg-primary text-white h5'>
                  <th scope=\"col\">KotyID</th>
                  <th scope=\"col\">Nazwa Kota</th>
                  <th scope=\"col\">Płeć Kota</th>
                  <th scope=\"col\">Rasa Kota</th>
                  <th scope=\"col\">Wiek Kota</th>
                  <th scope=\"col\">Nazwa Schroniska</th>
                  </tr>
                  </thead><tbody>";
            foreach ($db->query($sql) as $row) {
                echo "<tr class='bg-white h5'>";
                echo '<td>' . $row['KotyID'] . '</td>';
                echo '<td>' . $row['Nazwa_kota'] . '</td>';
                echo '<td>' . $row['Plec'] . '</td>';
                echo '<td>' . $row['Rasa'] . '</td>';
                echo '<td>' . $row['Wiek'] . '</td>';
                echo '<td>' . $row['Nazwa'] . '</td>';
                echo '</tr>';
            }
            echo "</tbody></table>";
        }

        if ($_GET['pokaz'] == "6") {
            echo "<form action='raport_pdf.php' method='post'>
                  <div class='h1 text-center text-white'>Raport w formie PDF</div>
                  <div class='h2 text-center'>Raport zestawienia kotów znajdujących<br /> się w podanym schronisku.</div>
                  <div class='h4 text-center mt-5'>
                  <label for='schronisko2'>Podaj nazwę schroniska
                  </label>
                  <input type='text' name='schronisko' id='schronisko2'>
                  <input class='btn btn-danger btn-lg ml-1' type='submit' value='Pobierz PDF'>
                  <a class='btn btn-secondary btn-lg' href='koty.php'>Cofnij</a></div></form>";
            if (isset($_SESSION['blad_pdf'])) {
                echo "<p class='text-warning h4 text-center'>Takie schronisko nie isnieje!</p>";
                unset($_SESSION['blad_pdf']);
            }
        }

        if ($_GET['pokaz'] == "7") {
            echo "
                  <div class='h1 text-center text-white'>Raporty Wykresowe</div>
                  <div class='h2 text-center mb-5'>Wybierz rodzaj wykresu opisujący<br /> ilość kotów w danych schroniskach.</div>
                  <div class='text-center'><a class='btn btn-primary btn-lg mb-4' href='diagram_kolowy.php'>Kołowy</a>
                  <a class='btn btn-primary btn-lg mb-4' href='diagram_slupkowy.php'>Słupkowy</a>
                  <a class='btn btn-secondary btn-lg mb-4' href='koty.php'>Cofnij</a></div>";
        }
        ?>
    </main>
    <footer class="stopka text-white text-center"><p class="mt-2 h5">Autor: Adrian Piwnicki</p></footer>
</div>
</body>
</html>