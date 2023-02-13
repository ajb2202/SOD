<html>
<head>
 <title>UNIX SOD Portal</title>
<meta http-equiv="refresh" content="10" >
<script src="jquery-3.1.1.min.js"></script>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
<body>
  <?php
        include('DbCon.php');
        echo "<table  border=1 align=center cellpadding=20px>
        <tr ><th  align=center cellpadding=20px>UNIX SOD Status Report - DEV</th> </td> ";
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
        $result1 = pg_query($conn, "CREATE TEMPORARY TABLE IF NOT EXISTS report_sod AS (SELECT * FROM sod where date in (SELECT max(date) FROM sod GROUP BY host )order by date desc)");

        $result2 = pg_query($conn, "SELECT count(*) as crits FROM report_sod where 'Fail' in (Stale,NicDown,NicBond,NicDuplex,cpu,disk,power,hardware,fans,memory,cron,ntp,ntpstat,hba,luns,battery)");
        $cri=pg_fetch_array($result2);

        $result3 = pg_query($conn, "SELECT * from report_sod where 'Fail' in (Stale,NicDown,NicBond,NicDuplex,cpu,disk,power,hardware,fans,memory,cron,ntp,ntpstat,hba,luns,battery)");

        $result4 = pg_query($conn, "SELECT count(*) as lows  from report_sod where 'Fail' in (uptime,NicSwitch,PercBattery,LockFile)");
        $low=pg_fetch_array($result4);

        $result5 = pg_query($conn, "SELECT * FROM report_sod WHERE 'Fail' in (uptime,NicSwitch,PercBattery,LockFile)");

        $result6 = pg_query($conn, "SELECT count(*) as stales FROM report_sod where 'Fail' in (Stale)");
        $stale=pg_fetch_array($result6);

        echo "<table border=1 align=center cellpadding=20px> ";
        echo "<tr >";
        echo "<th width=30% align=center >Overall DEV SOD Status </th>";
        if ( $cri['crits']  > 0 && $cri['crits'] < 3 )
        {
              echo "<th bgcolor=#F5B041 width=20% align=center > Amber </th>";
        } elseif ( $cri['crits'] > 4 )
        {
              echo "<th bgcolor=#EC7063 width=20% align=center > Red </td>";
        } elseif ( $cri['crits']  == 0 && $cri['crits'] < 2 )
        {
              echo "<th bgcolor=#D5F5E3 width=20% align=center > Green </th>";
        }
        echo "</tr>";
        echo "<th width=30% align=center > Total number of Crits </th>";
        echo "<td class=danger >". $cri['crits'] ."</td>";
        echo "</tr>";
        echo "<th width=30% align=center > Total number of low alarms </th>";
        echo "<td class=danger >". $low['lows'] ."</td>";
        echo "</tr>";
        echo "</tr>";
        echo "<th width=30% align=center > Total number Stale Records </th>";
        echo "<td class=danger >". $stale['stales'] ."</td>";
        echo "</tr>";
        echo "</table>";


        echo "Details About Critical Alarms:";
        echo "<table border=1 align=center cellpadding=20px'>
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
        <th class=text-nowrap >NTPD</th>
        <th class=text-nowrap >NTPStat</th>
        <th class=text-nowrap >HBA</th>
        <th class=text-nowrap >LUNS</th>
        <th class=text-nowrap >Battery</th>
        <th class=text-nowrap >Lock File</th>
        <th class=text-nowrap >NicSwitch</th>
        <th class=text-nowrap >PercBattery</th>
        <th class=text-nowrap >Stale</th>
        <th class=text-nowrap >Date</th>
        </tr>";
        display_table($result3);


        echo "Details About Non-Critical Alarms:";
        echo "<table border=1 align=center cellpadding=20px>
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
        <th class=text-nowrap >NTPD</th>
        <th class=text-nowrap >NTPStat</th>
        <th class=text-nowrap >HBA</th>
        <th class=text-nowrap >LUNS</th>
        <th class=text-nowrap >Battery</th>
        <th class=text-nowrap >Lock File</th>
        <th class=text-nowrap >NicSwitch</th>
        <th class=text-nowrap >PercBattery</th>
        <th class=text-nowrap >Stale</th>
        <th class=text-nowrap >Date</th>
        </tr>";
        display_table($result5);


function display_table($array)
{
#        while($row = mysqli_fetch_array($array))
        while($row = pg_fetch_array($array))
        {
        echo "<tr>";
        echo "<td class=text-nowrap >" . $row['host'] . "</td>";
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
        if ( $row['ntp'] == "Fail" )
        {
               echo "<td class=bg-danger>" . $row['ntp'] . "</td>";
        } else {
               echo "<td>" . $row['ntp'] . "</td>";
        }
        if ( $row['ntpstat'] == "Fail" )
        {
               echo "<td class=bg-danger>" . $row['ntpstat'] . "</td>";
        } else {
               echo "<td>" . $row['ntpstat'] . "</td>";
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
}
?>

