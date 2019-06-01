<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css">

    <script>
        $(document).ready(function () {

            $.urlParam = function(name){
            var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
            return results[1] || 0;
            }

            var raid = $.urlParam('raid');

            $.getJSON("http://192.168.178.31/pogo/ajax/get_raid_info.php", {raid : raid},
                function (data) {
                    if(data == "raid:404"){
                        <?php
                        //header("LOCATION: 404_raid.php?redirect=raidinfo");
                        ?>
                    }
                    var i = 0;
                    var fadeInt = 350;
                    var dataArray=new Array();
                        dataArray[0]="img/pkm/"+data.picture_pokemon;
                        dataArray[1]="img/pkm/"+data.picture_pokemon_shiny;

                    //Get the Picture
                    $("#img_pokemon").attr('src', dataArray[0]);
                    if(data.picture_pokemon_shiny != null){

                        var i = 0;
                        var fadeInt = 250;
                        setInterval(fadeDivs, 10000);

                        function fadeDivs() {
                            i = i < dataArray.length ? i : 0;
                            $('#img_pokemon').fadeOut(fadeInt, function(){
                                $(this).attr('src', dataArray[i]).fadeIn(fadeInt);
                            })
                            i++;
                            if (i == dataArray.length) i = 0
                        }
                    }

                    $("#name").html(data.name_pokemon);
                    $("#dexNr").html(data.id_pokemon);
                    $("#cp").html(data.cp);
                    $("#location_name").html(data.name_arena);


                    $("#date").html(Date.sYear);
                    $("#startTime").html(data.start);
                    $("#endTime").html(data.end);
                    

                    $("#img_arena").attr('src', "img/arena/" + data.picture_arena).fadeIn(fadeInt);
                    if(data.meeting != null){
                        $("#meeting").html(data.meeting);
                    }else{
                        $("#meeting").html("unknown time");
                    }
                }
            );

        });
    </script>


</head>
<body>
    <?php
        if(isset($_GET["raid"])){
            if ($_GET["raid"] == "mult"){
                header("LOCATION: select_raids.php");
            }else if($_GET["raid"] == "404_raid"){
                header("LOCATION: 404_raid.php?redirect=recentraid");
            }
        }
    ?>
    <div style="text-align: center;">
    <a href="index.php"> <img src="img/btn_pic/back.png"> </a>
    </div>
    <div id="main">
    <div id="pkm">
        <img id="img_pokemon" src="">
            <span id="name"></span>
            (#<span id="dexNr"></span>)
        <div id="cpHTML">
            <span id="cp"></span> CP
        </div>
        </div>

        <div style="clear:both">
        at
        </div>

        <div id="location">
            <div id="location_info">
                <div id="location_name"></div>
                <div id="time">
                    <span id="date"></span>
                    <span id="startTime"></span> - <span id="endTime"></span>
                </div>
            </div>

        <img id="img_arena">

        </div>

        Meeting at: <span id="meeting"></span>

    </div>
</body>
</html>