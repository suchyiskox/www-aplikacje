<?php
session_start();

if (!empty($_POST)) {
    $nazwa = $_POST['Nazwa'];
    $miasto = $_POST['Miasto'];
    $email = $_POST['Email'];
    $telefon = $_POST['Telefon'];
    $ilosc_kotow = $_POST['Ilosc_kotow'];

    require_once 'database.php';
    $schron = $db->prepare('SELECT SchroniskoID FROM Schronisko WHERE Nazwa = ?');
    $schron->execute(array($nazwa));
    $SchroniskoID = $schron->fetch();

    $valid = true;
    if (empty($nazwa)) {
        $_SESSION['nazwaError'] = '1';
        $valid = false;
        header('Location: schronisko.php?pokaz=3');
    }

    if (empty($miasto)) {
        $_SESSION['miastoError'] = '1';
        $valid = false;
        header('Location: schronisko.php?pokaz=3');
    }

    if (empty($email)) {
        $_SESSION['emailaError'] = '1';
        $valid = false;
        header('Location: schronisko.php?pokaz=3');
    }else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
        $_SESSION['emailaError'] = '1';
        $valid = false;
        header('Location: schronisko.php?pokaz=3');
    }

    if (empty($telefon)) {
        $_SESSION['telefonError'] = '1';
        $valid = false;
        header('Location: schronisko.php?pokaz=3');
    }

    if (empty($ilosc_kotow)) {
        $_SESSION['ilosc_kotowError'] = '1';
        $valid = false;
        header('Location: schronisko.php?pokaz=3');
    }

    if ($valid) {
        require_once 'database.php';
        $query = $db->prepare('UPDATE Schronisko SET Email = ?, Ilosc_kotow = ?, Miasto = ?, Nazwa  = ?, Telefon = ? WHERE SchroniskoID = ?');
        $query->execute(array($email, $ilosc_kotow, $miasto, $nazwa, $telefon, $SchroniskoID['SchroniskoID']));
        $_SESSION['poprawnie_u']=$valid;
        header("Location: schronisko.php?pokaz=3");
    }
}
?>