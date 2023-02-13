<html>
<head>
<meta http-equiv="refresh" content="10" > 
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
<body>
  <?php 
	include('DbCon.php'); 
        $sql = "SELECT * FROM sysboot order by Status";
	$result = $conn->query($sql);	
	echo "<table class='table table-striped table-bordered table-hover'>
	<tr class=success>
	<th>Host</th>
	<th>Reboot Schedule</th>
	<th>Boot Start</th>
	<th>Status</th>
	<th>Uptime</th>
	<th>H-CPU</th>
	<th>H-Mem</th>
	<th>H-Swap</th>
	<th>H-NIC</th>
	<th>H-Disk</th>
	<th>H-PCI</th>
	<th>H-Netstat</th>
	<th>H-Mounts</th>
	<th>H-Kernel</th>
	<th>H-KernelBoot</th>
	</tr>";

	while($row = mysqli_fetch_array($result))
	{
        if ( $row['host'] == 'jplpapeci22a' )
	{
	$d2 = $row['schd'];
        $d3 = $row['bootstart'];
	$dc = date("d-m-y h:i");
        $d1 = strtotime("$d3");
	$d4 = strtotime("now");
	$d6 = '29/09/2016 00:01';
	$d7 = '01/10/2016 14:05';
        $d5 = $d4 - $d1;
	echo $d5;
	}
	echo "<tr>";
	echo "<td>" . $row['host'] . "</td>";
        echo "<td>" . $row['schd'] . "</td>";
        echo "<td>" . $row['bootstart'] . "</td>";
	if ( $row['Status'] == "Scheduled" )
	{
       		 echo "<td class=info>" . $row['Status'] . "</td>";
	}
	elseif ( $row['Status'] == "Rebooting" )
	{
		echo "<td class=warning>" . $row['Status'] . "</td>";
	}
	elseif (  $row['Status'] == "Rebooted" )
	{
		echo "<td class=success>" . $row['Status'] . "</td>";
		
	}
	
        echo "<td>" . $row['uptime'] . "</td>";
        echo "<td>" . $row['cpu'] . "</td>";
        echo "<td>" . $row['mem'] . "</td>";
        echo "<td>" . $row['swap'] . "</td>";
        echo "<td>" . $row['nic'] . "</td>";
        echo "<td>" . $row['disk'] . "</td>";
        echo "<td>" . $row['pci'] . "</td>";
        echo "<td>" . $row['netstat'] . "</td>";
        echo "<td>" . $row['mount'] . "</td>";
	echo "<td>" . $row['kernel'] . "</td>";
        echo "<td>" . $row['kernelboot'] . "</td>";
	echo "</tr>";
	}
	echo "</table>";
?>
