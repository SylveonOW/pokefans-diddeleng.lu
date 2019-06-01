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
    <div style="text-align: center;">
        <a href="index.php"> <img src="img/btn_pic/back.png"> </a>
    </div>
    <?php
            if(isset($_GET["redirect"])){
                if($_GET["redirect"] == "raidinfo"){
                    echo"
                    Sorry but the Raid you were searching doesn't exist! <br>
                    But dont worry, you can create one <br>
                    <a href='create_raid.php'> here </a>                
                    ";
                    }else if ($_GET["redirect"] == "recentraid"){
                    echo"
                    At the moment there is no Raid running! <br>
                    But dont worry, you can create one <br>
                    <a href='create_raid.php'> here </a>                
                    ";
                }
            }
    ?>
</body>
</html>