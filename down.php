<?php
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf();
//$dompdf->loadHtml('<h1>Welcome to CodexWorld.com</h1>');
$dompdf->set_paper(array(0, 0, 715, 405));
$id= trim($_GET['certificate']);
$event2=trim($_GET['attend']);
require_once 'app/dbfile.php';
$obj = new Database();
$obj->connect();
$table = "data";
$where = "id='$id'";
$obj->select($table, "name,clgname,branch,dates,year,purpose", $where);
$res = $obj->getResult();

$name = ucwords(strtolower(($res[0]['name'])));
$clgname = ($res[0]['clgname']);
$event=ucwords(strtolower($event2));
$branch=strtoupper(strtolower(($res[0]['branch'])));
$dates=($res[0]['dates']);
$year=($res[0]['year']);
$purpose=ucwords(strtolower($res[0]['purpose']));
/*$n = rand(1, 4);
if($n==1)
$img='bhaskar';
if($n==2)
$img='harika';
if($n==3)
$img='samar';
if($n==4)
$img='sasi';*/
/*if($course=='Yuvatarang')
	$img='samar';
if($course=='Vista')
	$img='harika';*/
if($purpose=="Vista")
	$img='vista';
if($purpose=="Yuvatarang")
	$img='yuva';



// Load content from html file
if($img=='vista'){
$html = '<!doctype html>
<html lang="en">
<head>
<center>
    <meta charset="UTF-8">
    <title>Certificate</title>

    <style type="text/css">
    @page{
    margin: 0px;}
    body{
    margin: 0px;
     background-image: url("images/'.$img.'.jpg");
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
  color: white;
    }
    @font-face {
    font-family: "Segoe UI";
    font-weight: 700;
    src: local("Segoe UI Bold Italic");
}
    </style>
	</center>
	</head>
<body>
<center>
    <div style="color: black;padding-top:277px;font-family: helvetica;font-size:25px;padding-left:5px">Mr./Ms  <B><u>  '.$name.'  </u></B> from <B><u> '.$clgname.' </u></B> has <br> participated in the event <B><u> '.$event.' </u></B> organised by <br><B><u>  '.$branch.' </u></B> on  '.$dates.'  as a part of <B><u> VISTA-'.$year.' </u>.</B></div>
</center>
</body>
</html>';
}
if($img=='yuva'){
	$html = '<!doctype html>
<html lang="en">
<head>
<center>
    <meta charset="UTF-8">
    <title>Certificate</title>

    <style type="text/css">
    @page{
    margin: 0px;}
    body{
    margin: 0px;
     background-image: url("images/'.$img.'.jpg");
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
  color: white;
    }
    @font-face {
    font-family: "Segoe UI";
    font-weight: 700;
    src: local("Segoe UI Bold Italic");
}
    </style>
	</center>
	</head>
<body>
<center>
    <div style="color: black;padding-top:277px;font-family: helvetica;font-size:25px;padding-left:5px">Mr./Ms  <B><u>  '.$name.'  </u></B> from <B><u> '.$clgname.' </u></B> has <br> participated in the event <B><u> '.$event.' </u></B> organised by <br><B><u>  '.$branch.' </u></B> on  '.$dates.'  as a part of <B><u> YUVATARANG-'.$year.' </u>.</B></div>
</center>
</body>
</html>';
	
}
$dompdf->loadHtml(html_entity_decode($html));

// (Optional) Setup the paper size and orientation
//$dompdf->setPaper('A4', 'landscape');
// Render the HTML as PD
$dompdf->render();

// Output the generated PDF (1 = download and 0 = preview)
ob_end_clean();

$dompdf->stream(" '$name' ", array("Attachment" => 0));

    