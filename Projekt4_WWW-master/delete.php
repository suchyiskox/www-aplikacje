<?php
session_start();
$IDKot_Delete = $_POST['IDKot_Delete'];
$haslo = $_POST['haslo'];

require_once 'database.php';
$query = $db->prepare('SELECT KotyID FROM Koty WHERE KotyID = :id');
$query->bindValue(':id',$IDKot_Delete, PDO::PARAM_INT);
$query->execute();
$data = $query->fetch();

if (empty($IDKot_Delete)) {
    header('Location: koty.php?pokaz=4');
    exit();
}elseif($IDKot_Delete != $data['KotyID']){
    $_SESSION['blad_id']="1";
    header('Location: koty.php?pokaz=4');
    exit();
}
if(empty($haslo)){
    $_SESSION['b_haslo']="1";
    header('Location: koty.php?pokaz=4');
    exit();
}elseif($haslo != $_SESSION['haslo']){
    $_SESSION['b_haslo']="1";
    header('Location: koty.php?pokaz=4');
    exit();
}else{
    require_once 'database.php';
    $query = $db->prepare('DELETE FROM Koty WHERE KotyID = :id');
    $query->bindValue(':id', $IDKot_Delete, PDO::PARAM_INT);
    $query->execute();
    $_SESSION['usuniety']="1";
    header('Location: koty.php?pokaz=4');
}
