<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
<div id="index_menu">



<?php
    require("ajax/sqlconnect.inc.php");
    // Create connection
    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $date = date('Y-m-d H:i:s');
    $sql = "SELECT * FROM `raid` WHERE start < '$date' and end > '$date'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $raid = $row["id_raid"];
    }else if(mysqli_num_rows($result) == 0){
        $raid = "404_raid";
    }else{
        $raid = $row["mult"];
    }
    echo "<a href='raidinfo.php?raid=$raid'><img src='img/btn_pic/recent_raids.png'></a>"
?>

<a href="create_raid.php"><img src="img/btn_pic/create_raid.png"></a>
<a href="all_raids.php"><img src="img/btn_pic/all_raids.png"></a>
</div>


</body>
</html>