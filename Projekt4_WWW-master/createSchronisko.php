<?php
session_start();
if (!empty($_POST)) {
    require_once 'database.php';
    $nazwa = $_POST['nazwa'];
    $miasto = $_POST['miasto'];
    $email = $_POST['email'];
    $telefon = $_POST['telefon'];
    $ilosc = $_POST['ilosc'];
    $valid=true;

    if (empty($nazwa)) {
        $_SESSION['podana_nazwa'] = $_POST['nazwa'];
        $valid=false;
        header('Location: schronisko.php?pokaz=1');
    }
    if (empty($miasto)) {
        $_SESSION['podane_miasto'] = $_POST['miasto'];
        $valid=false;
        header('Location: schronisko.php?pokaz=1');
    }
    if (empty($email)) {
        $_SESSION['podany_email'] = $_POST['email'];
        $valid=false;
        header('Location: schronisko.php?pokaz=1');
    }else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
        $_SESSION['podany_email'] = $_POST['email'];
        $valid=false;
        header('Location: schronisko.php?pokaz=1');
    }
    if (empty($telefon)) {
        $_SESSION['podany_telefon'] = $_POST['telefon'];
        $valid=false;
        header('Location: schronisko.php?pokaz=1');
    }
    if (empty($ilosc)) {
        $_SESSION['podana_ilosc'] = $_POST['ilosc'];
        $valid=false;
        header('Location: schronisko.php?pokaz=1');
    }

    if ($valid) {
        require_once 'database.php';
        $query = $db->prepare('INSERT INTO Schronisko VALUES (:Email,:Ilosc_kotow,:Miasto,:Nazwa,:Telefon,NULL)');
        $query->bindValue(':Email', $email, PDO::PARAM_STR);
        $query->bindValue(':Ilosc_kotow', $ilosc, PDO::PARAM_INT);
        $query->bindValue(':Miasto', $miasto, PDO::PARAM_STR);
        $query->bindValue(':Nazwa', $nazwa, PDO::PARAM_STR);
        $query->bindValue(':Telefon', $telefon, PDO::PARAM_INT);
        $query->execute();
        $_SESSION['poprawnie']=$valid;
        header("Location: schronisko.php?pokaz=1");
    }
}
?>
