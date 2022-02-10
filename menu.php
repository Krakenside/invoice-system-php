<ul class="nav navbar-nav flex-row">
<li class="dropdown">
	<button class="btn2 btn-primary dropdown-toggle border-0" type="button" data-toggle="dropdown">Factures
	<span class="caret"></span></button>
	<ul class="dropdown-menu">
		<li><a class="dropdown-item" href="invoice_list.php">Liste des Factures </a></li>
		<li><a class="dropdown-item" href="create_invoice.php">Creer une facture</a></li>				  
	</ul>
</li>
<?php 
if($_SESSION['userid']) { ?>
	<li class="dropdown">
		<button class="btn2 btn-secondary dropdown-toggle border-0" type="button" data-toggle="dropdown">Connecté en tant que : <?php echo $_SESSION['user']; ?>
		<span class="caret"></span></button>
		<ul class="dropdown-menu">
			<li><a class="dropdown-item" href="#">Compte</a></li>
			<li><a class="dropdown-item" href="action.php?action=logout">Deconnexion</a></li>		  
		</ul>
	</li>
<?php } ?>
</ul>
<br /><br /><br /><br />