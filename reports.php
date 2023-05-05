<?php
include('scripts/mysql.php');
date_default_timezone_set('America/new_york');
$currentdate = date('Y-m-d');
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
		<link rel="stylesheet" href="assets/main2.css" />
		<noscript><link rel="stylesheet" href="assets/noscript2.css" /></noscript>
	</head>
	<body class="is-loading">
		<div id="wrapper">
			<div id="main">
				<div class="inner">
				    	<ul id="links01" class="links">
						<li class="n01">
							<a href="index.php">Home</a>
						</li>
						<li class="n02">
							<a href="items.php">Add/edit Item</a>
						</li>
					</ul>
				<h1 id="text01"><strong>Select dates below</strong></h1>
					<h1 id="text01"><strong>Begining Date:</strong></h1>
					<form enctype="multipart/form-data" id="form02" method="post" action="reports2.php">
						<div class="inner">
							<div class="field">
								<input type="date" name="date1" id="untitled" maxlength="256" required />
							</div>
							<h1 id="text01"><strong>End Date:</strong></h1>
							<div class="field">
								<input type="date" name="date2" id="untitled" maxlength="256" required />
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
		<script src="assets/main2.js"></script>
	</body>
</html>
