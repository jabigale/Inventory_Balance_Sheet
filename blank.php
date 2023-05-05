<?php
include('scripts/mysql.php');
date_default_timezone_set('America/new_york');
$currentdate = date('Y-m-d');
if(isset($_POST['formsubmit']))
{
    
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
	</head>
	<body class="is-loading">
		<div id="wrapper">
			<div id="main">
				<div class="inner">
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
                                    $sql2 = 'SELECT `id`,`name` FROM `items` ORDER BY `name` ASC';
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
								<input type="text" name="other-item" id="other-item" placeholder="Other item (optional)" maxlength="256" />
							</div>
							<div class="field">
								<div class="number">
								<input type="number" name="qty" id="qty" placeholder="Qty" maxlength="128" data-category="integer" step="1" min="0" required />
								<button tabindex="-1" type="button" class="decrement" data-id="qty"><svg><use xlink:href="assets/icons.svg#minus-light"></use></svg></button>
								<button tabindex="-1" type="button" class="increment" data-id="qty"><svg><use xlink:href="assets/icons.svg#plus-light"></use></svg></button>
							</div>
							</div>
							<div class="field">
								<input type="date" name="untitled" id="untitled" value="<?php echo $currentdate; ?>" maxlength="256" required />
							</div>
							<div class="actions">
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