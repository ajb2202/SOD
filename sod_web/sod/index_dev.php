<html>
<head>
 <title>Weekly Reboot Checkout Portal</title>
<meta http-equiv="refresh" content="10" > 
<script src="jquery-3.1.1.min.js"></script>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
<body>
  <?php 
	include('DbCon.php'); 
        echo "<table class='table table-sm table-striped table-bordered table-hover table-sm'>
        <tr class=success><td><a href='http://webserver1/rbtmgmt/index.php'>Site 1</a></td><td><a href='http://webserver2:8080/rbtmgmt/index.php'>Site 2</a></td><td><a href='http://webserver3/rbtmgmt/index.php'>Site 3</a></td><th class=text-center>Weekly Reboot Checkout Portal - Dev </th> <td><a href='http://webserver/history'>History</a></td><td><a href='http://webserver/rbtmgmt/details.php'>Details</a></td> ";
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
	<th class=text-nowrap >H-CPU</th>
	<th class=text-nowrap >H-Mem</th>
	<th class=text-nowrap >H-Swap</th>
	<th class=text-nowrap >H-NIC</th>
	<th class=text-nowrap >H-Disk</th>
	<th class=text-nowrap >H-PCI</th>
	<th class=text-nowrap >H-Netstat</th>
	<th class=text-nowrap >H-Mounts</th>
	<th class=text-nowrap >H-Kernel</th>
	<th class=text-nowrap >H-KernelBoot</th>
        <th class=text-nowrap >H-NTPoffset</th>
        <th class=text-nowrap >H-NTPpeer</th>
        <th class=text-nowrap >Checked by</th>
        <th class=text-nowrap >ACK</th>
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
        elseif ( $row['Status'] == "Cancelled_Hardware_i" )
        {
                echo "<td class=bg-inverse>" . $row['Status'] . "</td>";
        }
        echo "<td>" . $row['uptime'] . "</td>";
        if ( $row['cpu'] == "Fail" )
        {
               echo "<td class=bg-danger>" . $row['cpu'] . "</td>";
        } else {
               echo "<td>" . $row['cpu'] . "</td>";
        }
        if ( $row['mem'] == "Fail" )
        {
               echo "<td class=bg-danger>" . $row['mem'] . "</td>";
        } else {
               echo "<td>" . $row['mem'] . "</td>";
        }
        if ( $row['swap'] == "Fail" )
        {
               echo "<td class=bg-danger>" . $row['swap'] . "</td>";
        } else {
               echo "<td>" . $row['swap'] . "</td>";
        }
        if ( $row['nic'] == "Fail" )
        {
               echo "<td class=bg-danger>" . $row['nic'] . "</td>";
        } else {
               echo "<td>" . $row['nic'] . "</td>";
        }
        if ( $row['disk'] == "Fail" )
        {
               echo "<td class=bg-danger>" . $row['disk'] . "</td>";
        } else {
               echo "<td>" . $row['disk'] . "</td>";
        }
        if ( $row['pci'] == "Fail" )
        {
               echo "<td class=bg-danger>" . $row['pci'] . "</td>";
        } else {
               echo "<td>" . $row['pci'] . "</td>";
        }
        if ( $row['netstat'] == "Fail" )
        {
               echo "<td class=bg-danger>" . $row['netstat'] . "</td>";
        } else {
               echo "<td>" . $row['netstat'] . "</td>";
        }
        if ( $row['mount'] == "Fail" )
        {
               echo "<td class=bg-danger>" . $row['mount'] . "</td>";
        } else {
               echo "<td>" . $row['mount'] . "</td>";
        }
        if ( $row['kernel'] == "Fail" )
        {
	       echo "<td class=bg-danger>" . $row['kernel'] . "</td>";
        } else {
               echo "<td>" . $row['kernel'] . "</td>";
        } 
        if ( $row['kernelboot'] == "Fail" )
        {
              echo "<td class=bg-danger>" . $row['kernelboot'] . "</td>";
        } else {
              echo "<td>" . $row['kernelboot'] . "</td>";
        } 
        if ( $row['ntpoffset'] == "Fail" )
        {
              echo "<td class=bg-danger>" . $row['ntpoffset'] . "</td>";
        } else {
              echo "<td>" . $row['ntpoffset'] . "</td>";
        }
        if ( $row['ntppeer'] == "Fail" )
        {
              echo "<td class=bg-danger>" . $row['ntppeer'] . "</td>";
        } else {
              echo "<td>" . $row['ntppeer'] . "</td>";
        }
        echo "<td>" . $row['sa'] . "</td>";
        echo "<td> <a href=\"checkout.php?host=".$row['host']."\" >Ack</a></td>";
	echo "</tr>";
	}
	echo "</table>";
?>
