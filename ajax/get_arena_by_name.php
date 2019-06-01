<?php
    require("sqlconnect.inc.php");
    // Create connection
    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if(isset($_GET["search"])){
        $search = mysqli_real_escape_string($conn, $_GET["search"]);
        if(is_numeric($_GET["search"])){
            $sql = "SELECT id_arena , name_arena , picture_arena FROM arena WHERE id_arena = $search ORDER BY name_arena ASC";
        }else{
            $search = "%".$search."%";
            $sql = "SELECT id_arena , name_arena , picture_arena FROM arena WHERE name_arena LIKE '$search' ORDER BY name_arena ASC";
        }

    }else{
        $sql = "SELECT id_arena , name_arena , picture_arena FROM arena ORDER BY name_arena ASC";
    }
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $output = array();
        while ($row = mysqli_fetch_assoc($result)){
            array_push($output, $row);
        }
    }else{
        $output = NULL;
    }
    echo json_encode($output);
    ?>