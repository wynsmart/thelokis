<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="description" content="洛基家族官方主页，THE LOKIs' OFFICIAL">
	<meta name="keywords" content="CoC, Clash of Clans, 部落冲突, The Lokis, 洛基家族,">
	<meta name="author" content="iSMart_cn">
	<title>洛基家族官方主页 - 战术指导</title>
	<link rel="Shortcut Icon" href="favicon.ico">
	<link rel="apple-touch-icon-precomposed" href="apple-touch-icon-precomposed.png">
	<link rel="stylesheet" href="style.css">
	<script src="jquery-3.1.0.min.js"></script>
	<style>
	.part1{
		margin-top: 50px;
	}
	.tech_spec{
		border: 2px solid #92897A;
	}
	.tech_spec td{
		border: 1px solid #92897A;
		padding: 2px 5px;
		font-size: 16px;
	}
	.tech_spec th{
		border: 1px solid #92897A;
		padding: 2px 5px;
		background-color:#B4AB9C;
		font-weight:bold;
	}
	.tech_spec td:first-child {
		text-align: center;
		vertical-align: middle;
	}
	.tech_spec tr:hover {
		background-color: #FDB;
	}
	</style>
</head>
<body>
	<header></header>
	<div class="main">
		<div class="container">
			<div class="contents">
				<article class="title">
					<section>战术指导</section>
					<section class="subtitle">TECHNIQUES</section>
				</article>
				<?php
				// read in techniques
				$filename = './clanwar/techniques.csv';
				$file = fopen($filename, "r");
				if ($file) {
					$techniques = array();
					while ($line = fgetcsv($file)) {
						array_push($techniques, $line);
					}
					fclose($file);
				}
				// write out item
				$titles = $techniques[0];
				$id = $_GET['id'];
				$tech = $techniques[$id];
				?>
				<article class="part1">
				<table width="100%" class="tech_spec">
					<tr>
						<th width="30%"><?php echo $titles[1]; ?></th>
						<th><?php echo $tech[1]; ?></th>
					</tr>
					<tr>
						<td><?php echo $titles[2]; ?></td>
						<td><?php echo $tech[2]; ?></td>
					</tr>
					<tr>
						<td><?php echo $titles[3]; ?></td>
						<td><?php echo $tech[3]; ?></td>
					</tr>
					<tr>
						<td><?php echo $titles[4]; ?></td>
						<td><?php echo $tech[4]; ?></td>
					</tr>
					<tr>
						<td><?php echo $titles[5]; ?></td>
						<td><?php echo $tech[5]; ?></td>
					</tr>
					<tr>
						<td><?php echo $titles[6]; ?></td>
						<td><?php echo $tech[6]; ?></td>
					</tr>
				</table>
				</article>
			</div>
		</div>
	</div>
	<footer></footer>
	<script>
		$('header').load('_header.html');
		$('footer').load('_footer.html');
	</script>
</body>
</html>
