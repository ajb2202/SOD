<html>
<head>
 <title>UNIX SOD Portal</title>
<meta http-equiv="refresh" content="10" >
<script src="jquery-3.1.1.min.js"></script>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
<body>
  <?php
        include('DbConld5.php');
        echo "<table  border=1 align=center cellpadding=20px>
        <tr ><th  align=center cellpadding=20px>UNIX SOD Status Report - LD5</th> </td> ";
        echo "</table>";
        $sql1 = "CREATE TEMPORARY TABLE IF NOT EXISTS report_sod AS (SELECT * FROM sod where date in (SELECT max(date) FROM sod GROUP BY host ) order by date desc)";
        $result1 = $conn->query($sql1);
        $sql2 = "select count(*) as crits  from report_sod where 'Fail' in (Stale,NicDown,NicBond,NicDuplex,cpu,disk,power,hardware,fans,memory,cron,time,timestat,hba,luns,battery)";
        $result2 = $conn->query($sql2);
        $cri=mysqli_fetch_array($result2);
        $sql3 = "select * from report_sod where 'Fail' in (Stale,NicDown,NicBond,NicDuplex,cpu,disk,power,hardware,fans,memory,cron,time,timestat,hba,luns,battery)";
        $result3 = $conn->query($sql3);
        $sql4 = "select count(*) as lows  from report_sod where 'Fail' in (uptime,NicSwitch,PercBattery,LockFile)";
        $result4 = $conn->query($sql4);
        $low=mysqli_fetch_array($result4);
        $sql5 = "select * from report_sod where 'Fail' in (uptime,NicSwitch,PercBattery,LockFile)";
        $result5 = $conn->query($sql5);
        $sql6 = "select count(*) as stales  from report_sod where 'Fail' in (Stale)";
        $result6 = $conn->query($sql6);
        $stale=mysqli_fetch_array($result6);

        echo "<table border=1 align=center cellpadding=20px> ";
        echo "<tr >";
        echo "<th width=30% align=center >Overall LD5 SOD Status </th>";
        if ( $cri['crits']  > 0 && $cri['crits'] < 3 )
        {
              echo "<th bgcolor=#F5B041 width=20% align=center > Amber </th>";
        } elseif ( $cri['crits'] >= 3 )
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
        echo "<tr>";
        echo "<th width=30% align=center > Total number Stale Records </th>";
        echo "<td class=danger >". $stale['stales'] ."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<th width=30% align=center > Details </th>";
        echo "<td class=danger ><a href='http://website2/sod/sod_summ.php'>LD5</a></td>";
        echo "</tr>";
        echo "</table>";



?>
