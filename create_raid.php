<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script>

    $(document).ready(function () {
        $.getJSON("ajax/get_arena_by_name.php",
                function (data) {
                    var htmlString
                    for (let i = 0; i < data.length; i++) {
                        htmlString += "<option value="+data[i].id_arena+">" + data[i].name_arena +"</option>";
                    }
                    $("#arena_selection").html(htmlString);
                    $("#arena_count").html(data.length);
                }
            );

        $("#arena_search").on('keypress input', function (e) { 
            if (e.keyCode === 13) {
                e.preventDefault();
            }else{
                $(this).keyup(function (e) { 
                    var input = $("#arena_search").val();
                    $.getJSON("http://192.168.178.31/pogo/ajax/get_arena_by_name.php", {search : input},
                        function (data) {
                            if (data != null) {
                                var htmlString;
                                for (let i = 0; i < data.length; i++) {
                                    htmlString += "<option value="+data[i].id_arena+">" + data[i].name_arena +"</option>";
                                }
                                $("#arena_selection").html(htmlString);
                                $("#arena_count").html(data.length);
                            }
                        }
                    ); 
                }); 
            }
        });

        $.urlParam = function(name){
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
        return results[1] || 0;
        }
        var selectedArena = $.urlParam('selected_arena');

        if (selectedArena > 0) {
            $.getJSON("ajax/get_arena_by_name.php", {search : input},
                    function (data) {
                        var htmlString
                        for (let i = 0; i < data.length; i++) {
                            htmlString += "<option value="+data[i].id_arena+">" + data[i].name_arena +"</option>";
                        }
                        $("#arena_selection").html(htmlString);
                        $("#arena_count").html(data.length);
                    }
                );
        }

    });

    </script>

</head>
<body>
    <div >
        create Raid:

            <form>
                Search Arena:
                <input type="text" id="arena_search">
                <select name="selected_arena" id="arena_selection">
                </select>
                Arena available: <span id="arena_count">0</span>
                <img id="arena_image">
            </form>

    </div>
</body>
</html>