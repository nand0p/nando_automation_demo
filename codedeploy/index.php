<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	date_default_timezone_set('America/New_York');
	$dbName = trim(file_get_contents('/etc/cfn/NandoDemoDBName'));
	$dbUser = trim(file_get_contents('/etc/cfn/NandoDemoDBUser'));
	$dbPass = trim(file_get_contents('/etc/cfn/NandoDemoDBPass'));
	$dbHost = trim(file_get_contents('/etc/cfn/NandoDemoDBHost'));
	$placeImage1 = rand(1,12);
	$placeImage2 = rand(1,12);
	if ($placeImage1 == $placeImage2) { $placeImage2++; }
	echo "<html><body bgcolor=white>";
        echo date(DATE_RFC2822);
        echo "<p>Connecting to <b>" . $dbHost . "</b><br>";
	$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
	if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); } 
        if (! $result = $conn->query("show databases")) { printf("Error: %s\n", $mysqli->error); }
	while ($row = mysqli_fetch_row($result)) { echo $row[0] . " : "; }
  	mysqli_free_result($result);
	mysqli_close($conn);
        echo "<p>Application running on <b>";
        echo exec('curl http://169.254.169.254/latest/meta-data/public-hostname');
        echo "</b> AMI: <b>";
        echo exec('curl http://169.254.169.254/latest/meta-data/ami-id');
        echo "</b> Hostname: <b>";
        echo exec('curl http://169.254.169.254/latest/meta-data/hostname');
        echo exec('curl http://169.254.169.254/latest/meta-data/instance-id');
        echo exec('curl http://169.254.169.254/latest/meta-data/instance-type');
        echo exec('curl http://169.254.169.254/latest/meta-data/kernel-id');
        echo exec('curl http://169.254.169.254/latest/meta-data/local-hostname');
        echo exec('curl http://169.254.169.254/latest/meta-data/local-ipv4');
        echo exec('curl http://169.254.169.254/latest/meta-data/mac');
        echo exec('curl http://169.254.169.254/latest/meta-data/public-ipv4');
        echo exec('curl http://169.254.169.254/latest/meta-data/public-keys');
        echo exec('curl http://169.254.169.254/latest/meta-data/security-groups');
 	echo "<p><table border=0 width=100%><tr>";
	for ($placeHolder = 0; $placeHolder < 12; $placeHolder++) { 
		if ($placeHolder % 4 == 0) { echo "</tr><tr>"; }
		if ($placeHolder == $placeImage1) { echo "<td width=20% align=center><img src=image1.jpg></td>"; }
    		elseif ($placeHolder == $placeImage2) { echo "<td width=20% align=center><img src=image2.jpg></td>"; }
		else { 
			echo "<td width=20% align=center>"; 
    			for ($tddata = 0; $tddata < 8; $tddata++) {
        			echo rand(0,1) . rand(0,1) . rand(0,1) . rand(0,1) . rand(0,1) . rand(0,1) . rand(0,1) . rand(0,1) . " " . rand(0,1) . rand(0,1) . rand(0,1) . rand(0,1) . rand(0,1) . rand(0,1) . rand(0,1) . rand(0,1) . "<br>"; 
			}
       			echo rand(0,1) . rand(0,1) . rand(0,1) . rand(0,1) . rand(0,1) . rand(0,1) . rand(0,1) . rand(0,1) . " " . rand(0,1) . rand(0,1) . rand(0,1) . rand(0,1) . rand(0,1) . rand(0,1) . rand(0,1) . rand(0,1) . "</td>"; 
		}
	}
	echo "</tr></table><p>";
        echo "<img src=http://nando-automation-demo.s3.amazonaws.com/public/stelligent.gif width=65% align=right>";
	echo "</body></html>";
?>
