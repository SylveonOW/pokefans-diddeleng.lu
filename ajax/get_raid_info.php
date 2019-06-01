<?php

if(isset($_GET["raid"])){
    $id = $_GET["raid"];
}
    header("Content-Type: application/json");
    require("sqlconnect.inc.php");
    // Create connection
    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $sql = "select * from raid , pokemon, arena where fi_pokemon = id_pokemon and fi_arena = id_arena and id_raid = $id";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $row = mysqli_fetch_assoc($result);
        $output=$row;
        
    } else {
        $output="raid:404";
    }
    
    echo json_encode($output);

    mysqli_close($conn);
?>