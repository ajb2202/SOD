<html>
<head>
 <title>Weekly Reboot Checkout Portal</title>
<meta http-equiv="refresh" content="10" > 
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
<body>
  <?php 
	include('DbCon.php'); 
        $host1=$_POST['host'];
        echo $host1;
        $SA=$_POST['SA'];
        echo $SA;
        $sql = "update sysboot set cpu= CASE when cpu='Fail' then 'Force OK' else cpu end, mem= CASE when mem='Fail' then 'Force OK' else mem end, swap= CASE when swap='Fail' then 'Force OK' else swap end, pci= CASE when pci='Fail' then 'Force OK' else pci end, disk= CASE when disk='Fail' then 'Force OK' else disk end, netstat= CASE when netstat='Fail' then 'Force OK' else netstat end, kernel= CASE when kernel='Fail' then 'Force OK' else kernel end, kernelboot= CASE when kernelboot='Fail' then 'Force OK' else kernelboot end, mount= CASE when mount='Fail' then 'Force OK' else mount end, nic= CASE when nic='Fail' then 'Force OK' else nic end , ntpoffset= CASE when ntpoffset='Fail' then 'Force OK' else ntpoffset end , ntppeer= CASE when ntppeer='Fail' then 'Force OK' else ntppeer end, sa='$SA'  where host like '$host1'";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
header("Location: index.php");

?>
