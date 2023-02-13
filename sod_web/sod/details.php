<html>
<head>
 <title>Weekly Reboot Checkout Portal</title>
<meta http-equiv="refresh" content="10" > 
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
<body>
  <?php 
	include('DbCon.php'); 
        echo "<table class='table table-sm table-striped table-bordered table-hover table-sm'>
        <tr class=success><td><a href='http://webserver/rbtmgmt/index.php'>NY4</a></td><td><a href='http://webserver:8080/rbtmgmt/index.php'>TY3</a></td><td><a href='http://webserver/rbtmgmt/index.php'>LD5</a></td><th class=text-center>Weekly Reboot Checkout Portal - Site 2 </th> <td><a href='http://webserver/history'>History</a></td> ";
        echo "</table>"; 
        function time_diff($dt1,$dt2){
        $y1 = substr($dt1,6,4);
        $m1 = substr($dt1,3,2);
        $d1 = substr($dt1,0,2);
        $h1 = substr($dt1,11,2);
        $i1 = substr($dt1,14,2);
        $s1 = substr($dt1,17,2);    
        $y2 = substr($dt2,6,4);
        $m2 = substr($dt2,3,2);
        $d2 = substr($dt2,0,2);
        $h2 = substr($dt2,11,2);
        $i2 = substr($dt2,14,2);
        $s2 = substr($dt2,17,2);    
        $r1=date('U',mktime($h1,$i1,$s1,$m1,$d1,$y1));
        $r2=date('U',mktime($h2,$i2,$s2,$m2,$d2,$y2));
        return ($r1-$r2);
        }

        $sql = "SELECT * FROM sysboot order by Status";
	$result = $conn->query($sql);	
	echo "<table class='table table-striped table-bordered table-hover'>
	<tr class=success>
	<th class=text-nowrap >Host</th>
	<th class=text-nowrap >Reboot Schedule</th>
	<th class=text-nowrap >Boot Start</th>
	<th class=text-nowrap >Status</th>
	<th class=text-nowrap >Uptime</th>
	<th class=text-nowrap >D-CPU</th>
	<th class=text-nowrap >D-Mem</th>
	<th class=text-nowrap >D-Swap</th>
	<th class=text-nowrap >D-NIC</th>
	<th class=text-nowrap >D-Disk</th>
	<th class=text-nowrap >D-PCI</th>
	<th class=text-nowrap >D-Netstat</th>
	<th class=text-nowrap >D-Mounts</th>
	<th class=text-nowrap >D-Kernel</th>
	<th class=text-nowrap >D-KernelBoot</th>
        <th class=text-nowrap >D-NTPoffset</th>
        <th class=text-nowrap >D-NTPpeer</th>
        <th class=text-nowrap >D-CStates</th>
        <th class=text-nowrap >D-HT</th>
	</tr>";

	while($row = mysqli_fetch_array($result))
	{
	if ( $row['Status'] == 'Rebooting' )
        {
          $bt = $row['bootstart'];
          $nt = date("m/d/Y H:i:s");
          $diff1 = time_diff($nt,$bt); 
          if ( $diff1 > 1800 )
	  {
             $h=$row['host'];
	     echo yes;
	     $update = "update sysboot set Status='Struck' where host like '$h'";
	     $conn->query($update);
          }
        }
	echo "<tr>";
	echo "<td class=text-nowrap >" . $row['host'] . "</td>";
        echo "<td >" . $row['schd'] . "</td>";
        echo "<td >" . $row['bootstart'] . "</td>";
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
        elseif (  $row['Status'] == "Struck" )
        {
                echo "<td class=bg-danger>" . $row['Status'] . "</td>";

        }
        elseif ( $row['Status'] == "Cancelled_lock" )
        {
                echo "<td class=bg-inverse>" . $row['Status'] . "</td>";
        }
        elseif ( $row['Status'] == "Cancelled_Hardware_issue" )
        {
                echo "<td class=bg-inverse>" . $row['Status'] . "</td>";
        }
        echo "<td>" . $row['uptime'] . "</td>";
        if ( $row['cpu'] == "Fail" )
        {
               echo "<td class=bg-danger>" . $row['cpuout'] . "</td>";
        } else {
               echo "<td>" . $row['cpuout'] . "</td>";
        }
        if ( $row['mem'] == "Fail" )
        {
               echo "<td class=bg-danger>" . $row['memout'] . "</td>";
        } else {
               echo "<td>" . $row['memout'] . "</td>";
        }
        if ( $row['swap'] == "Fail" )
        {
               echo "<td class=bg-danger>" . $row['swapout'] . "</td>";
        } else {
               echo "<td>" . $row['swapout'] . "</td>";
        }
        if ( $row['nic'] == "Fail" )
        {
               echo "<td class=bg-danger>" . $row['nicout'] . "</td>";
        } else {
               echo "<td>" . $row['nicout'] . "</td>";
        }
        if ( $row['disk'] == "Fail" )
        {
               echo "<td class=bg-danger>" . $row['diskout'] . "</td>";
        } else {
               echo "<td>" . $row['diskout'] . "</td>";
        }
        if ( $row['pci'] == "Fail" )
        {
               echo "<td class=bg-danger>" . $row['pciout'] . "</td>";
        } else {
               echo "<td>" . $row['pciout'] . "</td>";
        }
        if ( $row['netstat'] == "Fail" )
        {
               echo "<td class=bg-danger>" . $row['netstatout'] . "</td>";
        } else {
               echo "<td>" . $row['netstatout'] . "</td>";
        }
        if ( $row['mount'] == "Fail" )
        {
               echo "<td class=bg-danger>" . $row['mountout'] . "</td>";
        } else {
               echo "<td>" . $row['mountout'] . "</td>";
        }
        if ( $row['kernel'] == "Fail" )
        {
	       echo "<td class=bg-danger>" . $row['kernelout'] . "</td>";
        } else {
               echo "<td>" . $row['kernelout'] . "</td>";
        } 
        if ( $row['kernelboot'] == "Fail" )
        {
              echo "<td class=bg-danger>" . $row['kernelbootout'] . "</td>";
        } else {
              echo "<td>" . $row['kernelbootout'] . "</td>";
        } 
        if ( $row['ntpoffset'] == "Fail" )
        {
              echo "<td class=bg-danger>" . $row['ntpoffsetout'] . "</td>";
        } else {
              echo "<td>" . $row['ntpoffsetout'] . "</td>";
        }
        if ( $row['ntppeer'] == "Fail" )
        {
              echo "<td class=bg-danger>" . $row['ntppeerout'] . "</td>";
        } else {
              echo "<td>" . $row['ntppeerout'] . "</td>";
        }
        if ( $row['CStates'] == "Fail" )
        {
               echo "<td class=bg-danger>" . $row['powerout'] . "</td>";
        } else {
               echo "<td>" . $row['powerout'] . "</td>";
        }
        if ( $row['HT'] == "Fail" )
        {
               echo "<td class=bg-danger>" . $row['HTout'] . "</td>";
        } else {
               echo "<td>" . $row['HTout'] . "</td>";
        }
	echo "</tr>";
	}
	echo "</table>";
?>
