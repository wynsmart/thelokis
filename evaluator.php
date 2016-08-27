<?php
	// fake detection
	$refURL = @$_SERVER["HTTP_REFERER"];
	$host = preg_replace("/^[a-z\\d]+\\:\\/\\/([^\\/\\:]+).*/ui", "$1", $refURL);
	$host = strtolower($host);
	$valid = false;
	
	if ($host == "localhost") $valid = true;
	if ($host == "127.0.0.1") $valid = true;
	if ($host == "www.thelokis.com" ) $valid = true;
	if ($host == "thelokis.sinaapp.com" ) $valid = true;
	if (preg_replace("/^(\\d+\\.\\d+)(\\.\\d+){2}/uis", "$1", $host) == "192.168" ) $valid = true;
	
	if (!$valid){
		echo "<body style='text-align:center; color:#bc2436'>";
		echo "<h2>You are viewing a fake site, please visit our official site. </h2>";
		echo "<h1>>>> <a href='http://www.thelokis.com'>THE LOKIs' OFFICIAL</a> <<<</h1>";
		echo "</body>";
		die();
	}

	// get parameters
	$level 	 = @(int)$_POST["level"];
	$wins 	 = @(int)$_POST["wins"];
	$donate  = @(int)$_POST["donate"];
	$receive = @(int)$_POST["receive"];
	$clan 	 = @$_POST["clan"];

	// respective index calculator
	function indexLevel($level,$clan){
		$x = $level;
		if ($clan == "develop"){
			//favor for all levels
			$fav = 1.0;
			if ($x<=75){
				$a = 7e-4;
				$b = 0.0168;
				return ($x>0)?round($a*pow($x,2)+$b*pow($x,1)+$fav, 2):0;
			}
			if ($x>75){
				$a = -7.3e-3;
				$b = 1.0799;
				$c = -35.002;
				return ($x<100)?round($a*pow($x,2)+$b*pow($x,1)+$c+$fav, 2):0;
			}
		}
		if ($clan == "elite"){
			// favor for all levels
			$fav = 1.5;
			$a = 1.152e-5;
			$b = -0.0014;
			$c = 0.0699;
			return ($x>0)?round($a*pow($x,3)+$b*pow($x,2)+$c*pow($x,1)+$fav, 2):0;
		}
		if ($clan == "master"){
			// favor for all levels
			$fav = 1.5;
			$a = 1e-5;
			$b = -0.0016;
			$c = 0.0917;
			return ($x>0)?round($a*pow($x,3)+$b*pow($x,2)+$c*pow($x,1)+$fav, 2):0;
		}
		return 0;
	}

	function indexWins($wins){
		$x = $wins;
		/*
		$a = 1.101e-6;
		$b = -0.0004;
		$c = 0.0583;
		*/
		$a = 4.233e-7;
		$b = -0.0002;
		$c = 0.0395;
		return ($x>0)?round($a*pow($x,3)+$b*pow($x,2)+$c*pow($x,1), 2):0;
	}

	function indexDonate($donate){
		$x = $donate;
		/*
		$a = 1.25e-10;
		$b = -1E-6;
		$c = 0.0029;
		*/
		$a = 1.397e-10;
		$b = -1.022e-6;
		$c = 0.0029;
		return ($x>0)?round($a*pow($x,3)+$b*pow($x,2)+$c*pow($x,1), 2):0;
	}

	function indexReceive($receive){
		$x = $receive;
		/*
		$a = 5.787e-10;
		$b = -2.778e-6;
		$c = 0.0048;
		*/
		$a = 4.115e-10;
		$b = -2.377e-6;
		$c = 0.0046;
		return ($x>0)?round($a*pow($x,3)+$b*pow($x,2)+$c*pow($x,1), 2):0;
	}

	function indexFinal($indLevel,$indWins,$indDonate,$indReceive){
		$f = array($indWins,$indDonate,$indReceive);
		sort($f);
		return round($f[0]*0.1+$f[1]*0.25+$f[2]*0.35+$indLevel*0.3, 2);
	}

	// main procedure
	$indLevel = indexLevel($level,$clan);
	$indWins = indexWins($wins);
	$indDonate = indexDonate($donate);
	$indReceive = indexReceive($receive);
	$indFinal = indexFinal($indLevel,$indWins,$indDonate,$indReceive);

	// echo "$level, $clan, $wins, $donate, $receive \n";

	// return JSON
	echo "{";
	echo "\"indLevel\": $indLevel, ";
	echo "\"indWins\": $indWins, ";
	echo "\"indDonate\": $indDonate, ";
	echo "\"indReceive\": $indReceive, ";
	echo "\"indFinal\": $indFinal";
	echo "}";
?>

