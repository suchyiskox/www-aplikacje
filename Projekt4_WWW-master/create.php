<?php
session_start();
if (!empty($_POST)) {
    require_once 'database.php';
    $nazwa = $_POST['nazwa'];
    $plec = $_POST['plec'];
    $rasa = $_POST['rasa'];
    $wiek = $_POST['wiek'];
    $schronisko = $_POST['schronisko'];
    $valid=true;
    $query = $db->prepare('SELECT SchroniskoID FROM Schronisko WHERE Nazwa = ?');
    $query->execute(array($schronisko));
    $SchroniskoID = $query->fetch();
    if (empty($nazwa)) {
        $_SESSION['podana_nazwa'] = $_POST['nazwa'];
        $valid=false;
        header('Location: koty.php?pokaz=1');
    }
    if (empty($plec)) {
        $_SESSION['podana_plec'] = $_POST['plec'];
        $valid=false;
        header('Location: koty.php?pokaz=1');
    } else if ($_POST['plec'] != "Samiec" AND $_POST['plec'] != "Samica"){
        $_SESSION['podana_plec'] = $_POST['plec'];
        $valid=false;
        header('Location: koty.php?pokaz=1');
    }
    if (empty($rasa)) {
        $_SESSION['podana_rasa'] = $_POST['rasa'];
        $valid=false;
        header('Location: koty.php?pokaz=1');
    }
    if (empty($wiek)) {
        $_SESSION['podany_wiek'] = $_POST['wiek'];
        $valid=false;
        header('Location: koty.php?pokaz=1');
    }
    if (empty($schronisko)) {
        $_SESSION['podane_schronisko'] = $_POST['schronisko'];
        $valid=false;
        header('Location: koty.php?pokaz=1');
    }else if($SchroniskoID['SchroniskoID'] == 0){
        $_SESSION['podane_schronisko'] = $_POST['schronisko'];
        $valid=false;
        header('Location: koty.php?pokaz=1');
    }

    if ($valid) {
        require_once 'database.php';
        $query = $db->prepare('INSERT INTO Koty VALUES (:Nazwa_kota,:Plec,:Rasa,:Wiek,NULL,:SchroniskoID)');
        $query->bindValue(':Nazwa_kota', $nazwa, PDO::PARAM_STR);
        $query->bindValue(':Plec', $plec, PDO::PARAM_STR);
        $query->bindValue(':Rasa', $rasa, PDO::PARAM_STR);
        $query->bindValue(':Wiek', $wiek, PDO::PARAM_INT);
        $query->bindValue(':SchroniskoID', $SchroniskoID['SchroniskoID'], PDO::PARAM_INT);
        $query->execute();
        $_SESSION['poprawnie']=$valid;
        header("Location: koty.php?pokaz=1");
    }
}
?>
