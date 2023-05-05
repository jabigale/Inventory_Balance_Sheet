<?php
include('scripts/mysql.php');
date_default_timezone_set('America/new_york');
$currentdate = date('Y-m-d');
$submitted = '0';
if(isset($_POST['formsubmit']))
{
    $itemname = $_POST['itemname'];
	$itemcost = $_POST['itemcost'];

	$sql1 = 'INSERT INTO `items` (`name`,`cost`) VALUES (:itemname,:itemcost)';
	$sth1 = $pdocxn->prepare($sql1);
	$sth1->bindParam(':itemname',$itemname);
	$sth1->bindParam(':itemcost',$itemcost);
	$sth1->execute();
    $submitted = '1';
}
?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title>TWCH - Inventory Transfer</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width,initial-scale=1" />
		<meta name="color-scheme" content="light only" />
		<meta name="description" content="Transfer Inventory for The Well Coffee House" />
		<meta property="og:site_name" content="TWCH - Inventory Transfer" />
		<meta property="og:title" content="TWCH - Inventory Transfer" />
		<meta property="og:type" content="website" />
		<meta property="og:description" content="Transfer Inventory for The Well Coffee House" />
		<link href="https://fonts.googleapis.com/css?display=swap&family=Open+Sans:300,300italic,400,400italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="assets/main.css" />
		<noscript><link rel="stylesheet" href="assets/noscript.css" /></noscript>
				<style>
table, th, td {
  border: 0px solid black;
  border-collapse: collapse;
  align: center;
}
th, td {
  padding: 15px;
}
.center {
  margin-left: auto;
  margin-right: auto;
}
</style>
	</head>
	<body class="is-loading">
		<div id="wrapper">
			<div id="main">
				<div class="inner">
				    					<ul id="links01" class="links">
						<li class="n01">
							<a href="index.php">Home</a>
						</li><li class="n02">
							<a href="reports.php">Reports</a>
						</li>
						<li class="n02">
							<a href="items.php">Edit Item</a>
						</li>
					</ul>
				    
					<?php if($submitted == '1')
					{
						echo '<h1 id="text01"><strong>Item was entered</strong></h1>';
					}
					?>
					<h1 id="text01"><strong>Add a new item below</strong></h1>
					<form enctype="multipart/form-data" id="form02" method="post" action="newitem.php">
						<div class="inner">
                        <div class="field">
								<div class="text">
								<input type="text" name="itemname" id="itemname" placeholder="Item Name" maxlength="128" required />
								<br /><br />
							</div>
							<div class="field">
								<input type="number" name="itemcost" id="itemcost" placeholder="cost" maxlength="128" data-category="currency" step="any" min="0" required />
								<br /><br />
							</div>
							<div class="actions">
								<input type="hidden" name="formsubmit" value="1">
								<button type="submit">Submit</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<script src="assets/main.js"></script>
	</body>
</html>
