<?php
session_start();
$KotyID = $_POST['kot'];
if (empty($KotyID)) {
    header('Location: koty.php?pokaz=3');
    exit();
}else {
    require_once 'database.php';
    $query = $db->prepare('SELECT Koty.KotyID, Koty.Nazwa_kota, Koty.Plec, 
    Koty.Rasa, Koty.Wiek, Schronisko.Nazwa
    FROM Koty, Schronisko WHERE KotyID = :id');
    $query->bindValue(':id', $KotyID, PDO::PARAM_INT);
    $query->execute();
    $kotek = $query->fetch();
    $_SESSION['ID'] = $kotek['KotyID'];
    $_SESSION['Nazwa_kota_u'] = $kotek['Nazwa_kota'];
    $_SESSION['Plec_u'] = $kotek['Plec'];
    $_SESSION['Rasa_u'] = $kotek['Rasa'];
    $_SESSION['Wiek_u'] = $kotek['Wiek'];
    $_SESSION['Nazwa_u'] = $kotek['Nazwa'];
    header("Location: koty.php?pokaz=3");
}