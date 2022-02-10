<?php 
session_start();
include('header.php');
include 'Invoice.php';
$invoice = new Invoice();
$invoice->checkLoggedIn();
?>
<title>OKASSA Invoice System </title>
<script src="js/invoice.js"></script>
<link href="css/style.css" rel="stylesheet">
<?php include('container.php');?>
	<div class="container">		
	  <h2 class="title mt-5">Gestion des Factures </h2>
	  <?php include('menu.php');?>			  
      <table id="data-table" class="table table-condensed table-hover table-striped">
        <thead>
          <tr>
            <th>FACTURE No.</th>
            <th>CLIENT </th>
            <th> DATE</th>
            <th>TOTAL</th>
            <th>IMPRIMER  </th>
            <th>EDITER</th>
            <th>EFFACER</th>
          </tr>
        </thead>
        <?php		
	    	$invoiceList = $invoice->getInvoiceList();
        foreach($invoiceList as $invoiceDetails){
			$invoiceDate = date("d/M/Y, H:i:s", strtotime($invoiceDetails["order_date"]));
            echo '
              <tr>
                <td>'.$invoiceDetails["order_id"].'</td>0
                <td>'.$invoiceDetails["order_receiver_name"].'</td>
                <td>'.$invoiceDate.'</td>
                <td>'.$invoiceDetails["order_total_after_tax"].' FCFA</td>
                <td><a href="print_invoice.php?invoice_id='.$invoiceDetails["order_id"].'" title="Print Invoice"><button class="btn btn-primary btn-sm"><i class="fa fa-print"></i></button></a></td>
                <td><a href="edit_invoice.php?update_id='.$invoiceDetails["order_id"].'"  title="Edit Invoice"><button class="btn btn-success btn-sm"><i class="fa fa-edit"></i></button></a></td>
                <td><a href="delete-invoice.php?order_id='.$invoiceDetails['order_id'].'" title="Delete Invoice"><button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></a></td>
              </tr>
            ';
        }       
        ?>
      </table>	
</div>	
<?php include('footer.php');?>