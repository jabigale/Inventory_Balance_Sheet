<?php
include('scripts/mysql.php');
date_default_timezone_set('America/new_york');
$currentdate = date('Y-m-d');
$submitted = '0';
if(isset($_POST['formsubmit']))
{
    $fromstore = $_POST['fromstore'];
	$tostore = $_POST['tostore'];
	$itemid = $_POST['item'];
	$qty = $_POST['qty'];
	$tdate = $_POST['tdate'];

	$sql1 = 'INSERT INTO `inventory-transfer` (`fromstore`,`tostore`,`itemid`,`qty`,`tdate`) VALUES (:fromstore,:tostore,:itemid,:qty,:tdate)';
	$sth1 = $pdocxn->prepare($sql1);
	$sth1->bindParam(':fromstore',$fromstore);
	$sth1->bindParam(':tostore',$tostore);
	$sth1->bindParam(':itemid',$itemid);
	$sth1->bindParam(':qty',$qty);
	$sth1->bindParam(':tdate',$tdate);
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
				    	    <li class="n02">
							<a href="reports.php">Reports</a>
						</li>
						<li class="n02">
							<a href="items.php">Add/edit Item</a>
						</li>
					</ul>
					<?php if($submitted == '1')
					{
						echo '<h1 id="text01"><strong>Transfer was submitted</strong></h1>';
					}
					?>
					<h1 id="text01"><strong>Transfer inventory below</strong></h1>
					<form enctype="multipart/form-data" id="form02" method="post" action="index.php">
						<div class="inner">
							<div class="field">
								<select name="fromstore" id="fromstore" required>
									<option value="">&ndash; Transfer From &ndash;</option>
									<?php
                                    $sql1 = 'SELECT `siteid`,`name` FROM `locations` ORDER BY `name` ASC';
                                    $sth1 = $pdocxn->prepare($sql1);
                                    $sth1->execute();
                                    while($row1 = $sth1->fetch(PDO::FETCH_ASSOC))
                                    {
                                        $siteid = $row1['siteid'];
                                        $sitename = $row1['name'];
                                        echo '<option value="'.$siteid.'">'.$sitename.'</option>';
                                    }
                                    ?>
								</select>
							</div>
							<div class="field">
								<select name="tostore" id="tostore" required>
									<option value="">&ndash; Transfer To &ndash;</option>
                                    <?php
                                    $sql1 = 'SELECT `siteid`,`name` FROM `locations` ORDER BY `name` ASC';
                                    $sth1 = $pdocxn->prepare($sql1);
                                    $sth1->execute();
                                    while($row1 = $sth1->fetch(PDO::FETCH_ASSOC))
                                    {
                                        $siteid = $row1['siteid'];
                                        $sitename = $row1['name'];
                                        echo '<option value="'.$siteid.'">'.$sitename.'</option>';
                                    }
                                    ?>
								</select>
							</div>
							<div class="field">
								<select name="item" id="item" required>
									<option value="">&ndash; Item &ndash;</option>
                                    <?php
                                    $sql2 = 'SELECT `id`,`name` FROM `items` WHERE `inactive` IS NULL ORDER BY `name` ASC';
                                    $sth2 = $pdocxn->prepare($sql2);
                                    $sth2->execute();
                                    while($row2 = $sth2->fetch(PDO::FETCH_ASSOC))
                                    {
                                        $itemid = $row2['id'];
                                        $itemname = $row2['name'];
                                        echo '<option value="'.$itemid.'">'.$itemname.'</option>';
                                    }
                                    ?>
								</select>
							</div>
							<div class="field">
								<div class="number">
								<input type="number" name="qty" id="qty" placeholder="Qty" maxlength="128" data-category="integer" step="1" min="0" required />
								<button tabindex="-1" type="button" class="decrement" data-id="qty"><svg><use xlink:href="assets/icons.svg#minus-light"></use></svg></button>
								<button tabindex="-1" type="button" class="increment" data-id="qty"><svg><use xlink:href="assets/icons.svg#plus-light"></use></svg></button>
							</div>
							</div>
							<div class="field">
								<input type="date" name="tdate" id="tdate" value="<?php echo $currentdate; ?>" maxlength="256" required />
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
