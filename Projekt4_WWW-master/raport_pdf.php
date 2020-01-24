<?php
session_start();
$schronisko = $_POST['schronisko'];
require_once 'database.php';
$query = $db->prepare('SELECT Nazwa FROM Schronisko WHERE Nazwa = :id');
$query->bindValue(':id',$schronisko, PDO::PARAM_INT);
$query->execute();
$dat = $query->fetch();

if(empty($schronisko)){
    $_SESSION['blad_pdf']=$schronisko;
    header('Location: koty.php?pokaz=6');
    exit();
}elseif($schronisko != $dat['Nazwa']){
    $_SESSION['blad_pdf']=$schronisko;
    header('Location: koty.php?pokaz=6');
    exit();
}

require "fpdf.php";

class myPDF extends FPDF{
    function header(){
        $schron=$_POST['schronisko'];
        $this->SetFont('Arial','B',14);
        $this->Cell(200,5,'Raport kotow ze schroniska: '.$schron,0,0,'C');
        $this->Ln(20);
    }
    function footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','',8);
        $this->Cell(0,10,'Page'.$this->PageNo().'/{nb}',0,0,'C');
    }
    function headerTable(){
        $this->Cell(25,10,'ID Kota','1',0,'C');
        $this->Cell(30,10,'Nazwa Kota','1',0,'C');
        $this->Cell(20,10,'Wiek','1',0,'C');
        $this->Cell(30,10,'Rasa','1',0,'C');
        $this->Cell(20,10,'Plec','1',0,'C');
        $this->Ln();
    }
    function viewTable($db){
        $this->SetFont('Times','',12);
        require_once 'database.php';
        $query = $db->prepare('SELECT SchroniskoID FROM Schronisko WHERE Nazwa = :id');
        $query->bindValue(':id',$_POST['schronisko'], PDO::PARAM_INT);
        $query->execute();
        $dat = $query->fetch();

        $stmt = $db->prepare('SELECT Koty.KotyID, Koty.Nazwa_kota, Koty.Wiek, Koty.Rasa, Koty.Plec FROM Koty, Schronisko WHERE Koty.SchroniskoID= :id AND Koty.SchroniskoID=Schronisko.SchroniskoID');
        $stmt->bindValue(':id',$dat['SchroniskoID'], PDO::PARAM_INT);
        $stmt->execute();
        $liczba=0;
        while($data= $stmt->fetch(PDO::FETCH_OBJ)){
            $this->Cell(25,10,$data->KotyID,'1',0,'C');
            $this->Cell(30,10,$data->Nazwa_kota,'1',0,'C');
            $this->Cell(20,10,$data->Wiek,'1',0,'C');
            $this->Cell(30,10,$data->Rasa,'1',0,'C');
            $this->Cell(20,10,$data->Plec,'1',0,'C');
            $this->Ln();
            $liczba++;
        }
        $this->SetFont('Arial','B',14);
        $this->Ln();
        $this->Cell(25,10, 'RAZEM:','0',0,'C');
        $this->SetFont('Arial','',14);
        $this->Cell(25,10,$liczba.' koty','0',0,'C');
    }
}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('P','A4',0);
$pdf->headerTable();
$pdf->viewTable($db);
$pdf->Output('raportPDF.pdf','D');