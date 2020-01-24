<?php
session_start();
$IDSchronisko_Delete = $_POST['IDSchronisko_Delete'];
$haslo = $_POST['haslo'];

require_once 'database.php';
$query = $db->prepare('SELECT SchroniskoID FROM Schronisko WHERE SchroniskoID = :id');
$query->bindValue(':id',$IDSchronisko_Delete, PDO::PARAM_INT);
$query->execute();
$data = $query->fetch();

if (empty($IDSchronisko_Delete)) {
    header('Location: schronisko.php?pokaz=4');
    exit();
}elseif($IDSchronisko_Delete != $data['SchroniskoID']){
    $_SESSION['blad_id']="1";
    header('Location: schronisko.php?pokaz=4');
    exit();
}
if(empty($haslo)){
    $_SESSION['b_haslo']="1";
    header('Location: schronisko.php?pokaz=4');
    exit();
}elseif($haslo != $_SESSION['haslo']){
    $_SESSION['b_haslo']="1";
    header('Location: schronisko.php?pokaz=4');
    exit();
}else{
    require_once 'database.php';
    $query = $db->prepare('DELETE FROM Schronisko WHERE SchroniskoID = :id');
    $query->bindValue(':id', $IDSchronisko_Delete, PDO::PARAM_INT);
    $query->execute();
    $_SESSION['usuniety']="1";
    header('Location: schronisko.php?pokaz=4');
}

