<?php


require('pdf/pdf.php');

if (isset($_GET['id'])) {
	$id = $_GET['id'];

	$query = mysqli_query($db,"SELECT * FROM rent_details WHERE id = '$id'");
	$data = mysqli_fetch_array($query);

	$transaction = $data['transaction'];
	$rentpaid = $data['rent_paid'];
	$datepaid = date("F d, Y H:i:s",$data['datepaid']);
	$tenantno = $data['tenant_no'];
	$houseno = $data['houseno'];
	$plotno = $data['plotno'];

	$query = mysqli_query($db,"SELECT * FROM tenant_details WHERE id = '$tenantno'");
	$tenant = mysqli_fetch_array($query);

	$query = mysqli_query($db,"SELECT * FROM house_details WHERE id = '$houseno'");
	$house = mysqli_fetch_array($query);

	$query = mysqli_query($db,"SELECT * FROM plots WHERE id = '$plotno'");
	$plot = mysqli_fetch_array($query);
}


$pdf->cell(45,10,'Transaction Number:',0,0);
$pdf->cell(50,10,$transaction,0,0);
$pdf->cell(45,10,'Tenant Name:',0,0);
$pdf->cell(50,10,$tenant['othername'],0,1);

$pdf->cell(45,10,'Plot Number:',0,0);
$pdf->cell(50,10,$plot['plotnumber'],0,0);
$pdf->cell(45,10,'House Number:',0,0);
$pdf->cell(50,10,$house['houseno'],0,1);

$pdf->cell(45,10,'Amount:',0,0);
$pdf->cell(50,10,'Ksh.'.$rentpaid,0,0);
$pdf->cell(45,10,'Date:',0,0);
$pdf->cell(50,10,$datepaid,0,1);

$pdf->Output();

?>
