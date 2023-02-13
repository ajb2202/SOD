<html>
<head>
 <title>UNIX SOD Portal</title>
<meta http-equiv="refresh" content="300" >
<script src="jquery-3.1.1.min.js"></script>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
<body>
  <?php
        include('DbCon.php');
        echo "<table class='table table-sm table-striped table-bordered table-hover table-sm'>
        <tr class=success><td><a href='http://website1/sod/index.php'>Site 1</a></td><td><a href='http://website2:8080/sod/index.php'>Site 2</a></td><td><a href='http://website3/sod/index.php'>Site 3</a></td><th class=text-center>UNIX SOD Portal - </th> </td> ";
        echo "</table>";
        function time_diff($dt1,$dt2){
        $y1 = substr($dt1,0,4);
        $m1 = substr($dt1,5,2);
        $d1 = substr($dt1,8,2);
        $h1 = substr($dt1,11,2);
        $i1 = substr($dt1,14,2);
        $s1 = substr($dt1,17,2);
        $y2 = substr($dt2,0,4);
        $m2 = substr($dt2,5,2);
        $d2 = substr($dt2,8,2);
        $h2 = substr($dt2,11,2);
        $i2 = substr($dt2,14,2);
        $s2 = substr($dt2,17,2);
        $r1=date('U',mktime($h1,$i1,$s1,$m1,$d1,$y1));
        $r2=date('U',mktime($h2,$i2,$s2,$m2,$d2,$y2));
        return ($r1-$r2);
        }
//        $sql = "SELECT * FROM sod where date in (SELECT max(date) FROM sod GROUP BY host ) order by date desc;";
        $result = pg_query($conn, "SELECT * FROM sod where date in (SELECT max(date) FROM sod GROUP BY host ) order by date desc");
//        $echo "$result";
//        $result = $conn->query($sql);
//        $result = $conn->pg_query($sql);
        echo "<table class='table table-striped table-bordered table-hover'>
        <tr class=success>
        <th class=text-nowrap >Host</th>
        <th class=text-nowrap >Uptime Compliance</th>
        <th class=text-nowrap >NIC Status</th>
        <th class=text-nowrap >Bond Status</th>
        <th class=text-nowrap >NicDuplex</th>
        <th class=text-nowrap >CPU</th>
        <th class=text-nowrap >Mem</th>
        <th class=text-nowrap >Disk</th>
        <th class=text-nowrap >Power</th>
        <th class=text-nowrap >Hardware</th>
        <th class=text-nowrap >Fans</th>
        <th class=text-nowrap >Crond</th>
        <th class=text-nowrap >Time Sync</th>
        <th class=text-nowrap >Time Status</th>
        <th class=text-nowrap >HBA</th>
        <th class=text-nowrap >LUNS</th>
        <th class=text-nowrap >Battery</th>
        <th class=text-nowrap >Lock File</th>
        <th class=text-nowrap >NicSwitch</th>
        <th class=text-nowrap >PercBattery</th>
        <th class=text-nowrap >Stale</th>
        <th class=text-nowrap >Date</th>
        </tr>";

//        while($row = mysqli_fetch_array($result))
        while($row = pg_fetch_array($result))

        {
        echo "<tr>";
        echo "<td class=text-nowrap >" . $row['host'] . "</td>";
               $bt = $row['date'];
               $nt=date('Y-m-d H:i:s');
               $diff1 = time_diff($nt,$bt);
               if ( $diff1 > 46800 )
               {
                    $h= $row['host'];
//                    $update = "update sod set Stale='Fail' where host like '$h' and date='$bt'";
//                    $conn->query($update);
//                    $conn->pg_query($update);
                      pg_query($conn, "UPDATE sod set Stale='Fail' where host like '$h' and date='$bt'");
               } else {

                    $h= $row['host'];
//                    $update = "update sod set Stale='Pass' where host like '$h' and date='$bt'";
//                    $conn->query($update);
//                    $conn->pg_query($update);
	              pg_query($conn, "update sod set Stale='Pass' where host like '$h' and date='$bt'");	
               }
        if ( $row['uptime'] == "Fail" )
        {
               echo "<td class=bg-danger>" . $row['uptime'] . "</td>";
        } else {
               echo "<td>" . $row['uptime'] . "</td>";
        }
        if ( $row['NicDown'] == "Fail" )
        {
               echo "<td class=bg-danger>" . $row['NicDown'] . "</td>";
        } else {
               echo "<td>" . $row['NicDown'] . "</td>";
        }
        if ( $row['NicBond'] == "Fail" )
        {
               echo "<td class=bg-danger>" . $row['NicBond'] . "</td>";
        } else {
               echo "<td>" . $row['NicBond'] . "</td>";
        }
        if ( $row['NicDuplex'] == "Fail" )
        {
               echo "<td class=bg-danger>" . $row['NicDuplex'] . "</td>";
        } else {
               echo "<td>" . $row['NicDuplex'] . "</td>";
        }
        if ( $row['cpu'] == "Fail" )
        {
               echo "<td class=bg-danger>" . $row['cpu'] . "</td>";
        } else {
               echo "<td>" . $row['cpu'] . "</td>";
        }
        if ( $row['memory'] == "Fail" )
        {
               echo "<td class=bg-danger>" . $row['memory'] . "</td>";
        } else {
               echo "<td>" . $row['memory'] . "</td>";
        }
        if ( $row['disk'] == "Fail" )
        {
               echo "<td class=bg-danger>" . $row['disk'] . "</td>";
        } else {
               echo "<td>" . $row['disk'] . "</td>";
        }
        if ( $row['power'] == "Fail" )
        {
               echo "<td class=bg-danger>" . $row['power'] . "</td>";
        } else {
               echo "<td>" . $row['power'] . "</td>";
        }
        if ( $row['hardware'] == "Fail" )
        {
               echo "<td class=bg-danger>" . $row['hardware'] . "</td>";
        } else {
               echo "<td>" . $row['hardware'] . "</td>";
        }
        if ( $row['fans'] == "Fail" )
        {
               echo "<td class=bg-danger>" . $row['fans'] . "</td>";
        } else {
               echo "<td>" . $row['fans'] . "</td>";
        }
        if ( $row['cron'] == "Fail" )
        {
               echo "<td class=bg-danger>" . $row['cron'] . "</td>";
        } else {
               echo "<td>" . $row['cron'] . "</td>";
        }
        if ( $row['time'] == "Fail" )
        {
               echo "<td class=bg-danger>" . $row['time'] . "</td>";
        } else {
               echo "<td>" . $row['time'] . "</td>";
        }
        if ( $row['timestat'] == "Fail" )
        {
               echo "<td class=bg-danger>" . $row['timestat'] . "</td>";
        } else {
               echo "<td>" . $row['timestat'] . "</td>";
        }
        if ( $row['hba'] == "Fail" )
        {
              echo "<td class=bg-danger>" . $row['hba'] . "</td>";
        } else {
              echo "<td>" . $row['hba'] . "</td>";
        }
        if ( $row['luns'] == "Fail" )
        {
              echo "<td class=bg-danger>" . $row['luns'] . "</td>";
        } else {
              echo "<td>" . $row['luns'] . "</td>";
        }
        if ( $row['battery'] == "Fail" )
        {
              echo "<td class=bg-danger>" . $row['battery'] . "</td>";
        } else {
              echo "<td>" . $row['battery'] . "</td>";
        }
        if ( $row['LockFile'] == "Fail" )
        {
              echo "<td class=bg-danger>" . $row['LockFile'] . "</td>";
        } else {
              echo "<td>" . $row['LockFile'] . "</td>";
        }
        if ( $row['NicSwitch'] == "Fail" )
        {
              echo "<td class=bg-danger>" . $row['NicSwitch'] . "</td>";
        } else {
              echo "<td>" . $row['NicSwitch'] . "</td>";
        }
        if ( $row['PercBattery'] == "Fail" )
        {
              echo "<td class=bg-danger>" . $row['PercBattery'] . "</td>";
        } else {
              echo "<td>" . $row['PercBattery'] . "</td>";
        }
        if ( $row['Stale'] == "Fail" )
        {
              echo "<td class=bg-danger>" . $row['Stale'] . "</td>";
        } else {
              echo "<td>" . $row['Stale'] . "</td>";
        }
        echo "<td>" . $row['date'] . "</td>";
        echo "</tr>";
        }
        echo "</table>";
?>
