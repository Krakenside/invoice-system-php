 <?php
	session_start();
	include 'Invoice.php';
	$invoice = new Invoice();
	$invoice->checkLoggedIn();
	if (!empty($_GET['invoice_id']) && $_GET['invoice_id']) {
		echo $_GET['invoice_id'];
		$invoiceValues = $invoice->getInvoice($_GET['invoice_id']);
		$invoiceItems = $invoice->getInvoiceItems($_GET['invoice_id']);
	}
	$invoiceDate = date("d/M/Y, H:i:s", strtotime($invoiceValues['order_date']));
	$output = '';
	$output .= '<table style="height:5%;position: relative;top:0;">
	<tbody>
	
	<tr>
	<td style="width: 15%;height:5px;"><img src="logook.jpg" alt="logo" style="height:60px;"></td>
	<td>
	<p align="center" >D&eacute;veloppement de Solutions Informatiques - Maintenance - R&eacute;seaux - Telecom Administration Windows Server - Installation de la Fibre Optique - Vente des ordinateurs Consommables Fourniture Bureautiques - Formation - R&eacute;paration d&rsquo;Imprimante et Photocopieur - Imprimerie - Climatisation</p>
	</td>
	</tr>
	</tbody>
	</table>';
	$output .= '

<table width="100%" border="0" cellpadding="5" cellspacing="0">
	<tr>
	<td colspan="2" align="center" style="font-size:18px"><b>Facture Proforma</b></td>
	</tr>
	<tr>
	<td colspan="2">
	<table width="100%" cellpadding="5">
	<tr>
	
	<td width="65%">         
	FACTURE PROFORMA N°: ' . $invoiceValues['numero_facture'] . '<br />
	 Date : ' . $invoiceDate . '<br />
	</td>
	<td width="35%">
	<br />
	<b></b><br />
	Client : ' . $invoiceValues['order_receiver_name'] . '<br /> 
	 Addresse : ' . $invoiceValues['order_receiver_address'] . '<br />
	 Tel : ' . $invoiceValues['order_reveiver_phone'] . '<br>
	</td>
	</tr>
	</table>
	<br />
	<table width="100%" border="1" cellpadding="5" cellspacing="0">
	<thead style=" background: #2592DA;">
	<tr>
	<th align="left">No.</th>
	<th align="left"> Ref</th>
	<th align="left">Designation</th>
	<th align="left">Quantité</th>
	<th align="left">Prix</th>
	<th align="left">Montant TTC</th> 
	</tr>
	</thead>';
	$count = 0;
	foreach ($invoiceItems as $invoiceItem) {
		$count++;
		$output .= '
	<tr>
	<td align="left">' . $count . '</td>
	<td align="left">' . $invoiceItem["item_code"] . '</td>
	<td align="left">' . $invoiceItem["item_name"] . '</td>
	<td align="left">' . $invoiceItem["order_item_quantity"] . '</td>
	<td align="left">' . $invoiceItem["order_item_price"] . '</td>
	<td align="left">' . $invoiceItem["order_item_final_amount"] . '</td>   
	</tr>';
	}
	$output .= '
	
	
	<tr>
	<td align="right" colspan="5"><b>Total TTC:</b></td>
	<td align="left">' . $invoiceValues['order_total_amount_due'] . '</td>
	</tr>';
	$output .= '
	</table>
	</td>
	</tr>
	</table>';
	$output .= " 
	 
	<br> 
	<br> 
	<br> 
	
	NB : Pour tout règlement par chèque, veuillez libeller le chèque à l’ordre de OKASSA
	<br> 
	<br> 
	
	 ";
	$output .= '<div>  <span style="color: red"> Validité de la proforma : 2 semaines </span></div>
	 <div style="margin-left:60%; text-decoration:underline"> <h3>LE SERVICE COMMERCIAL</h3>  <br> <img width="70%" src="CACHET-OKASSA.png"></div>';
	$output .= '
	
	<footer><p align="center" style="position: absolute;
	bottom: 0px;" >
	OKASSA - Siège Social : Abidjan Cocody Riviéra 3 Cité Les Lauriers 1 - 21 BP 1467 Abidjan 21
	Tél : (+225) 25 22 00 75 35 / 22 47 89 18 / 27 22 54 29 87 - Cel : (+225) 07 07 28 14 19 - Email : info@okassatechnology.net
	info@okassatechnology.com / info@okassatechnology-ci.com- Site Web : www.okassatechnology.net /.com / ci.com
	RCCM N° CI-ABJ-2013-A-10307 - Compte Bancaire SIB N° : CI007 01059 900003417200 10 </p>
	
	</footer>';
	// create pdf of invoice	
	$invoiceFileName = 'AstroInvoice_' . $invoiceValues['order_id'] . '.pdf';
	require_once 'dompdf/src/Autoloader.php';
	Dompdf\Autoloader::register();

	use Dompdf\Dompdf;

	$dompdf = new Dompdf();
	$dompdf->loadHtml(html_entity_decode($output));
	$dompdf->setPaper('A4', 'portrait');
	$dompdf->render();
	$dompdf->stream($invoiceFileName, array("Attachment" => false));
	?>   
   