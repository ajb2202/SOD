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
        <tr ><th  align=center cellpadding=20px>UNIX SOD Status Report - PR/WF</th> </td> ";
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
//        $sql1 = "CREATE TEMPORARY TABLE IF NOT EXISTS report_sod AS (SELECT * FROM  (SELECT * FROM sod ORDER BY date DESC) as tmpsod GROUP BY host)";
//        $result1 = $conn->query($sql1);
//        $result1 = pg_query($conn, "CREATE TEMPORARY TABLE IF NOT EXISTS report_sod AS (SELECT * FROM  (SELECT * FROM sod ORDER BY date DESC) as tmpsod GROUP BY host)");
        $result1 = pg_query($conn, "CREATE TEMPORARY TABLE IF NOT EXISTS report_sod AS SELECT * FROM sod ORDER BY date DESC");

//        $sql2 = "select count(*) as crits  from report_sod where 'Fail' in (Stale,NicDown,NicBond,NicDuplex,cpu,disk,power,hardware,fans,memory,cron,time,timestat,hba,luns,battery)";
//        $result2 = $conn->query($sql2);

        $result2 = pg_query($conn, "select count(*) as crits  from report_sod where 'Fail' in (Stale,NicDown,NicBond,NicDuplex,cpu,disk,power,hardware,fans,memory,cron,time,timestat,hba,luns,battery)");
//        $cri=mysqli_fetch_array($result2);
        $cri=pg_fetch_array($result2);

//        $sql3 = "select * from report_sod where 'Fail' in (Stale,NicDown,NicBond,NicDuplex,cpu,disk,power,hardware,fans,memory,cron,time,timestat,hba,luns,battery)";
//        $result3 = $conn->query($sql3);
        $result3 = pg_query($conn, "select * from report_sod where 'Fail' in (Stale,NicDown,NicBond,NicDuplex,cpu,disk,power,hardware,fans,memory,cron,time,timestat,hba,luns,battery)");

//        $sql4 = "select count(*) as lows  from report_sod where 'Fail' in (uptime,NicSwitch,PercBattery,LockFile)";
//        $result4 = $conn->query($sql4);
        $result4 = pg_query($conn, "select count(*) as lows  from report_sod where 'Fail' in (uptime,NicSwitch,PercBattery,LockFile)");
//        $low=mysqli_fetch_array($result4);
        $low=pg_fetch_array($result4);

//        $sql5 = "select * from report_sod where 'Fail' in (uptime,NicSwitch,PercBattery,LockFile)";
//        $result5 = $conn->query($sql5);
        $result5 = pg_query($conn, "select * from report_sod where 'Fail' in (uptime,NicSwitch,PercBattery,LockFile)");

//        $sql6 = "select count(*) as stales  from report_sod where 'Fail' in (Stale)";
//        $result6 = $conn->query($sql6);
        $result6 = pg_query($conn, "select count(*) as stales  from report_sod where 'Fail' in (Stale)");
//        $stale=mysqli_fetch_array($result6);
        $stale=pg_fetch_array($result6);

        echo "<table border=1 align=center cellpadding=20px> ";
        echo "<tr >";
        echo "<th width=30% align=center >Overall PR/WF SOD Status </th>";
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
        echo "<td class=danger ><a href='http://website/sod/sod_summ.php'>PR/WF</a></td>";
        echo "</tr>";
        echo "</table>";



?>
