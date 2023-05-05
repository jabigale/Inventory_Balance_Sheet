<?php
include('scripts/mysql.php');
date_default_timezone_set('America/new_york');
$currentdate = date('Y-m-d');
if(isset($_POST['formsubmit']))
{
	$date1 = $_POST['date1'];
	$date2 = $_POST['date2'];
	$ddate1 = date('m/d/Y', strtotime($date1));
	$ddate2 = date('m/d/Y', strtotime($date2));
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
		<link rel="stylesheet" href="assets/main2.css" />
		<noscript><link rel="stylesheet" href="assets/noscript2.css" /></noscript>
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
				    <a href="index.php"><h1 id="text01"><strong>Home</strong></h1></a>
					<h1 id="text01"><strong>Inventory transfer total amounts for <?php echo $ddate1.' - '.$ddate2; ?></strong></h1>
					<table class="center">
					<?php
								$sql1 = 'SELECT `fromstore`,`tostore`,`qty`,`itemid` FROM `inventory-transfer` WHERE `tdate` > :date1 AND `tdate` <= :date2';
								$sth1 = $pdocxn->prepare($sql1);
								$sth1->bindParam(':date1',$date1);
								$sth1->bindParam(':date2',$date2);
								$sth1->execute();
								while($row1 = $sth1->fetch(PDO::FETCH_ASSOC))
								{
									$itemid = $row1['itemid'];
									$fromstore = $row1['fromstore'];
									$tostore = $row1['tostore'];
									$qty = $row1['qty'];

									$sql2 = 'SELECT `cost` FROM `items` WHERE `id` = :itemid';
								$sth2 = $pdocxn->prepare($sql2);
								$sth2->bindParam(':itemid',$itemid);
								$sth2->execute();
								while($row2 = $sth2->fetch(PDO::FETCH_ASSOC))
								{
									$itemcost = $row2['cost'];
									$tcost = $itemcost * $qty;
								}
								if($fromstore=='1'&$tostore=='2')
								{
									$t1 = $t1+$tcost;
								}
								if($fromstore=='1'&$tostore=='3')
								{
									$t2 = $t2+$tcost;
								}
								if($fromstore=='2'&$tostore=='1')
								{
									$t3 = $t3+$tcost;
								}
								if($fromstore=='2'&$tostore=='3')
								{
									$t4 = $t4+$tcost;
								}
								if($fromstore=='3'&$tostore=='1')
								{
									$t5 = $t5+$tcost;
								}
								if($fromstore=='3'&$tostore=='2')
								{
									$t6 = $t6+$tcost;
								}
								}
								if($t1 > '0')
								{
									$dt1 = number_format($t1,2);
									echo '<tr><td><p id="text01"><strong>State Street to East Boston</strong></p></td><td>$'.$dt1.'</td></tr>';
								}
								if($t2 > '0')
								{
									$dt2 = number_format($t2,2);
									echo '<tr><td><p id="text01"><strong>State Street to Everett</strong></p></td><td>$'.$dt2.'</td></tr>';
								}
								if($t3 > '0')
								{
									$dt3 = number_format($t3,2);
									echo '<tr><td><p id="text01"><strong>East Boston to State Street</strong></p></td><td>$'.$dt3.'</td></tr>';
								}
								if($t4 > '0')
								{
									$dt4 = number_format($t4,2);
									echo '<tr><td><p id="text01"><strong>East Boston to Everett</strong></p></td><td>$'.$dt4.'</td></tr>';
								}
								if($t5 > '0')
								{
									$dt5 = number_format($t5,2);
									echo '<tr><td><p id="text01"><strong>Everett to State Street</strong></p></td><td>$'.$dt5.'</td></tr>';
								}
								if($t6 > '0')
								{
									$dt6 = number_format($t6,2);
									echo '<tr><td><p id="text01"><strong>Everett to East Boston</strong></p></td><td>$'.$dt6.'</td></tr>';
								}
					?>
					<tr><td colspan="2"><form id="form02" action="reports.php"><div class="actions" id="form02"><button type="submit">Change Dates</button></form></div></td></tr>
					</table>
				</div>
			</div>
		</div>
		<script src="assets/main2.js"></script>
	</body>
</html>