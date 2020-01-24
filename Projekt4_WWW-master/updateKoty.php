<?php
session_start();

if (!empty($_POST)) {
    $nazwa_kota = $_POST['nazwa_kota'];
    $plec = $_POST['plec'];
    $rasa = $_POST['rasa'];
    $wiek = $_POST['wiek'];
    $schronisko = $_POST['schronisko'];

    require_once 'database.php';
    $schron = $db->prepare('SELECT SchroniskoID FROM Schronisko WHERE Nazwa = ?');
    $schron->execute(array($schronisko));
    $SchroniskoID = $schron->fetch();

    $valid = true;
    if (empty($nazwa_kota)) {
        $_SESSION['nazwa_kotaError'] = 'wprowadź nazwę kota';
        $valid = false;
        header('Location: koty.php?pokaz=3');
    }

    if (empty($plec)) {
        $_SESSION['plecError'] = 'wprowadź nazwę kota';
        $valid = false;
        header('Location: koty.php?pokaz=3');
    } else if ($plec != "Samiec" AND $plec != "Samica") {
        $_SESSION['plecError'] = 'Tylko Samiec/Samica';
        $valid = false;
        header('Location: koty.php?pokaz=3');
    }

    if (empty($rasa)) {
        $_SESSION['rasaError'] = 'wprowadź rasę kota';
        $valid = false;
        header('Location: koty.php?pokaz=3');
    }

    if (empty($wiek)) {
        $_SESSION['wiekError'] = 'wprowadź wiek kota';
        $valid = false;
        header('Location: koty.php?pokaz=3');
    }

    if (empty($schronisko)) {
        $_SESSION['schroniskoError'] = $_POST['schronisko'];
        $valid = false;
        header('Location: koty.php?pokaz=3');
    } else if ($SchroniskoID['SchroniskoID'] == 0) {
        $_SESSION['schroniskoError'] = $_POST['schronisko'];
        $valid = false;
        header('Location: koty.php?pokaz=3');
    }

    if ($valid) {
        require_once 'database.php';
        $query = $db->prepare('UPDATE Koty SET Nazwa_kota = ?, Plec = ?, Rasa = ?, Wiek = ?, SchroniskoID = ? WHERE KotyID = ?');
        $query->execute(array($nazwa_kota, $plec, $rasa, $wiek, $SchroniskoID['SchroniskoID'], $_SESSION['ID']));
        $_SESSION['poprawnie_u']=$valid;
        header("Location: koty.php?pokaz=3");
    }
}
?>