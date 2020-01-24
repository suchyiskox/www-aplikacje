<?php
session_start();
require 'database.php';
$SchroniskoID = $_POST['SchroniskoID'];
if (empty($SchroniskoID)) {
    header('Location: schronisko.php?pokaz=2');
    exit();
} else {
    require_once 'database.php';
    $query = $db->prepare('SELECT SchroniskoID, Schronisko.Nazwa, Schronisko.Miasto, Schronisko.Email, Schronisko.Telefon, Ilosc_kotow
    FROM Schronisko WHERE SchroniskoID = :id');
    $query->bindValue(':id', $SchroniskoID, PDO::PARAM_INT);
    $query->execute();
    $schronisko = $query->fetch();

    $_SESSION['SchroniskoID'] = $schronisko['SchroniskoID'];
    $_SESSION['Nazwa'] = $schronisko['Nazwa'];
    $_SESSION['Miasto'] = $schronisko['Miasto'];
    $_SESSION['Email'] = $schronisko['Email'];
    $_SESSION['Telefon'] = $schronisko['Telefon'];
    $_SESSION['Ilosc_kotow'] = $schronisko['Ilosc_kotow'];
    if ($SchroniskoID > $schronisko['SchroniskoID'])
        $_SESSION['blad'] = $SchroniskoID;
    header("Location: schronisko.php?pokaz=2");
}
