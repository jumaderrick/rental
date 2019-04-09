<?php


require('pdf/pdf.php');

if (isset($_GET['id'])) {
	$id = $_GET['id'];

	$query = mysqli_query($db,"SELECT * FROM landlord_disbursement WHERE id = '$id'");
	$data = mysqli_fetch_array($query);

	$transaction = $data['transaction'];
	$amount = $data['amount'];
	$disdate = date("F d, Y H:i:s",$data['disdate']);
	$tenantno = $data['tenantno'];
	$houseno = $data['hseno'];
	$plotno = $data['plotno'];
	$landlordno = $data['landlordno'];

	$query = mysqli_query($db,"SELECT * FROM tenant_details WHERE id = '$tenantno'");
	$tenant = mysqli_fetch_array($query);

	$query = mysqli_query($db,"SELECT * FROM house_details WHERE id = '$houseno'");
	$house = mysqli_fetch_array($query);

	$query = mysqli_query($db,"SELECT * FROM plots WHERE id = '$plotno'");
	$plot = mysqli_fetch_array($query);

	$query = mysqli_query($db,"SELECT * FROM landlord_details WHERE id = '$landlordno'");
	$landlord = mysqli_fetch_array($query);

}

$pdf->cell(45,10,'Landlord Name:',0,0);
$pdf->cell(50,10,$landlord['othername'],0,0);
$pdf->cell(45,10,'Landlord Number:',0,0);
$pdf->cell(50,10,$landlord['landlordno'],0,1);


$pdf->cell(45,10,'Transaction Number:',0,0);
$pdf->cell(50,10,$transaction,0,0);
$pdf->cell(45,10,'Tenant Name:',0,0);
$pdf->cell(50,10,$tenant['othername'],0,1);

$pdf->cell(45,10,'Plot Number:',0,0);
$pdf->cell(50,10,$plot['plotnumber'],0,0);
$pdf->cell(45,10,'House Number:',0,0);
$pdf->cell(50,10,$house['houseno'],0,1);

$pdf->cell(45,10,'Amount:',0,0);
$pdf->cell(50,10,'Ksh.'.$amount,0,0);
$pdf->cell(45,10,'Date:',0,0);
$pdf->cell(50,10,$disdate,0,1);

$pdf->cell(45,10,'Fee Deduction:',0,0);
$pdf->cell(50,10,$transaction,0,0);
$pdf->cell(45,10,'Tax:',0,0);
$pdf->cell(50,10,$tenant['othername'],0,1);

$pdf->Output();

?>
