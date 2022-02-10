<?php 
   session_start();
   include('header.php');
   include 'Invoice.php';
   $invoice = new Invoice();
   $invoice->checkLoggedIn();
   if(!empty($_POST['companyName']) && $_POST['companyName']) {	
   	$invoice->saveInvoice($_POST);
   	header("Location:invoice_list.php");	
   }
   ?>
<title> OKASSA Invoice System</title>
<script src="js/invoice.js"></script>
<link href="css/style.css" rel="stylesheet">
<?php include('container.php');?>
<div class="container content-invoice">
   <div class="cards">
     <div class="card-bodys">
       <form action="" id="invoice-form" method="post" class="invoice-form" role="form" novalidate="">
      <div class="load-animate animated fadeInUp">
         <div class="row">
            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
               <h2 class="title">Edition de Facture Proforma</h2>
               <?php include('menu.php');?> 
            </div>
         </div>
         <input id="currency" type="hidden" value="FCFA">
         <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
               <h3>De,</h3>
               <?php echo $_SESSION['user']; ?><br> 
               <?php echo $_SESSION['address']; ?><br>  
               <?php echo $_SESSION['mobile']; ?><br>
               <?php echo $_SESSION['email']; ?><br>  
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
               <h3>A,</h3>
               <div class="form-group">
                  <input type="text" class="form-control" name="Numero_Facture" id="Numero_Facture" placeholder="Numero de la facture " autocomplete="off">
               </div>
               <div class="form-group">
                  <input type="text" class="form-control" name="companyName" id="companyName" placeholder="Client" autocomplete="off">
               </div>
               <div class="form-group">
                  <input type="text" class="form-control" name="companyPhone" id="companyPhone" placeholder="Numero de telephone " autocomplete="off">
               </div>
               <div class="form-group">
                  <textarea class="form-control" rows="3" name="address" id="address" placeholder=" Addresse"></textarea>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
               <table class="table table-condensed table-striped" id="invoiceItem">
                  <tr>
                     <th width="2%">
                      <div class="custom-control custom-checkbox mb-3">
                        <input type="checkbox" class="custom-control-input" id="checkAll" name="checkAll">
                        <label class="custom-control-label" for="checkAll"></label>
                        </div>
                    </th>
                     <th width="15%">Ref</th>
                     <th width="38%">Designation</th>
                     <th width="15%">Quantité</th>
                     <th width="15%">Prix</th>
                     <th width="15%">Total</th>
                  </tr>
                  <tr>
                     <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="itemRow custom-control-input" id="itemRow_1">
                        <label class="custom-control-label" for="itemRow_1"></label>
                        </div></td>
                     <td><input type="text" name="productCode[]" id="productCode_1" class="form-control" autocomplete="off"></td>
                     <td><input type="text" name="productName[]" id="productName_1" class="form-control" autocomplete="off"></td>
                     <td><input type="number" name="quantity[]" id="quantity_1" class="form-control quantity" autocomplete="off"></td>
                     <td><input type="number" name="price[]" id="price_1" class="form-control price" autocomplete="off"></td>
                     <td><input type="number" name="total[]" id="total_1" class="form-control total" autocomplete="off"></td>
                  </tr>
               </table>
            </div>
         </div>
         <div class="row">
            <div class="col-xs-12">
               <button class="btn btn-danger delete" id="removeRows" type="button">- Supprimer</button>
               <button class="btn btn-success" id="addRows" type="button">+ Ajouter</button>
            </div>
         </div>
         <div class="row">
          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group mt-3 mb-3 ">
              <label>Sous-Total: &nbsp;</label>
                 <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text currency">FCFA</span>
            </div>
            <input value="" type="number" class="form-control" name="subTotal" id="subTotal" placeholder="Sous-Total">
          </div>
              </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group mt-3 mb-3 ">
              <label>Taux TVA: &nbsp;</label>
                 <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text currency">%</span>
            </div>
           <input value="" type="number" class="form-control" name="taxRate" id="taxRate" placeholder="Taux TVA">
          </div>
              </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group mt-3 mb-3 ">
              <label>Montant TVA: &nbsp;</label>
                 <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text currency">FCFA</span>
            </div>
            <input value="" type="number" class="form-control" name="taxAmount" id="taxAmount" placeholder="Montant TVA">
          </div>
              </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group mt-3 mb-3 ">
              <label>Total: &nbsp;</label>
                 <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text currency">FCFA</span>
            </div>
             <input value="" type="number" class="form-control" name="totalAftertax" id="totalAftertax" placeholder="Total">
          </div>
              </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group mt-3 mb-3 ">
              <label>Montant Payé: &nbsp;</label>
                 <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text currency">FCFA</span>
            </div>
            <input value="" type="number" class="form-control" name="amountPaid" id="amountPaid" placeholder="Montant Payé:">
          </div>
              </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group mt-3 mb-3 ">
              <label>Montant Dû: &nbsp;</label>
                 <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text currency">FCFA</span>
            </div>
             <input value="" type="number" class="form-control" name="amountDue" id="amountDue" placeholder="Montant dû">
          </div>
              </div>
          </div>
            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
               <h3>Notes: </h3>
               <div class="form-group">
                  <textarea class="form-control txt" rows="5" name="notes" id="notes" placeholder="Vos notes"></textarea>
               </div>
               <br>
               <div class="form-group">
                  <input type="hidden" value="<?php echo $_SESSION['userid']; ?>" class="form-control" name="userId">
                  <input data-loading-text="Sauvegarde en cours ..." type="submit" name="invoice_btn" value="Sauvegarder " class="btn btn-success submit_btn invoice-save-btm">           
               </div>
            </div>
         </div>
         <div class="clearfix"></div>
      </div>
   </form>
     </div>
   </div>
</div>
</div>	
<?php include('footer.php');?>