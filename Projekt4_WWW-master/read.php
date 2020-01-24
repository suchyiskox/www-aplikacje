<?php
session_start();
require 'database.php';
$KotyID = $_POST['KotyID'];
if (empty($KotyID)) {
    header('Location: koty.php?pokaz=2');
    exit();
} else {
    require_once 'database.php';
    $query = $db->prepare('SELECT Koty.KotyID, Koty.Nazwa_kota, Koty.Plec, 
    Koty.Rasa, Koty.Wiek, Schronisko.Nazwa, Schronisko.Miasto, Schronisko.Email, Schronisko.Telefon
    FROM Koty, Schronisko WHERE KotyID = :id');
    $query->bindValue(':id', $KotyID, PDO::PARAM_INT);
    $query->execute();
    $kot = $query->fetch();

    $_SESSION['KotyID'] = $kot['KotyID'];
    $_SESSION['Nazwa_kota'] = $kot['Nazwa_kota'];
    $_SESSION['Plec'] = $kot['Plec'];
    $_SESSION['Rasa'] = $kot['Rasa'];
    $_SESSION['Wiek'] = $kot['Wiek'];
    $_SESSION['Nazwa'] = $kot['Nazwa'];
    $_SESSION['Miasto'] = $kot['Miasto'];
    $_SESSION['Email'] = $kot['Email'];
    $_SESSION['Telefon'] = $kot['Telefon'];
    if ($KotyID > $kot['KotyID'])
        $_SESSION['blad'] = $KotyID;
    header("Location: koty.php?pokaz=2");
}
?>