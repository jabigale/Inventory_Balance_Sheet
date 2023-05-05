<?php
include('scripts/mysql.php');
date_default_timezone_set('America/new_york');
$currentdate = date('Y-m-d');
if(isset($_POST['formsubmit']))
{
    $sql1 = 'SELECT `id` FROM `items` WHERE `inactive` IS NULL';
    $sth1 = $pdocxn->prepare($sql1);
    $sth1->execute();
    while($row1 = $sth1->fetch(PDO::FETCH_ASSOC))
    {
        $itemid = $row1['id'];
        $posteditemcost = $_POST[$itemid];
        $sth2 = $pdocxn->prepare('UPDATE `items` SET `cost` = :newcost WHERE `id` = :id');
        $sth2->bindParam(':newcost',$posteditemcost);
        $sth2->bindParam(':id',$itemid);
        $sth2->execute();
    }
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
	</head>
	<body class="is-loading">
		<div id="wrapper">
			<div id="main">
				<div class="inner">
					<h1 id="text01"><strong>Change item cost below</strong></h1>
					<form enctype="multipart/form-data" id="form02" method="post" action="#">

							<div class="field">
                                <table>
								<?php
								$sql1 = 'SELECT `id`,`name`,`cost` FROM `items` ORDER BY `name` ASC';
								$sth1 = $pdocxn->prepare($sql1);
								$sth1->execute();
								while($row1 = $sth1->fetch(PDO::FETCH_ASSOC))
								{
									$itemid = $row1['id'];
									$itemname = $row1['name'];
									$itemcost = $row1['cost'];
                                    echo '<tr><td><br /><br /><p>'.$itemname.'</p></td><td><br /><input type="number" name="'.$itemid.'" id="'.$itemname.'" value="'.$itemcost.'" maxlength="128" data-category="integer" step="any" required /></td></tr>';
								}
								?>
							</div>
                            <tr><td colspan="2"><br /><br />
							<div class="actions">
								<button type="submit">Save</button>
							</div>
                            </td></tr></table>
                            <input type="hidden" name="formsubmit" value="1">
					</form>
				</div>
			</div>
		</div>
		<script src="assets/main2.js"></script>
	</body>
</html>