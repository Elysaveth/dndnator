<?php

$dir = 'background/';
// capture the image files in an array
$bg = glob($dir . '*.jpeg');

$i = rand(0, count($bg)-1);
$selectedBg = "$bg[$i]";

session_start();
 
if(isset($_GET['logout'])){    

    session_destroy();
    header("Location: index.php"); //Redirect the user
}
 
if(isset($_POST['enter'])){
    if($_POST['name'] == "Mummy"){
        $_SESSION['name'] = stripslashes(htmlspecialchars($_POST['name']));
    }
    else{
        echo '<span class="error">Incorrect password</span>';
    }
}

if(isset($_POST['character'])){
    $_SESSION['name'] = stripslashes(htmlspecialchars($_POST['character']));
}

 
function loginForm(){
    echo
    '<style>body{background: #cccccc}</style><div id="loginform">
    <p>Enter DM password or select character</p>
    <form action="index.php" method="post">
    <input type="text" name="name" id="name" />
        <input type="submit" name="enter" id="enter" value="Log In" />
    </form>
    <form action="index.php" method="post">
        <input type="submit" name="character" id="enter" value="Belrral" />
        <input type="submit" name="character" id="enter" value="Jakka" />
        <input type="submit" name="character" id="enter" value="Ostara" />
        <input type="submit" name="character" id="enter" value="Yasek" />
    </form>
  </div>';
}
 
?>
 
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
 
        <title>D&D</title>
        <meta name="description" content="Partida de D&D" />
        <link rel="stylesheet" href="style.css" />
        <style type="text/css">
            body {
                background-image:url('<?php echo $selectedBg ?>');
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: 100%;
            }
        </style>
    </head>
    <body>
    <?php
    if(!isset($_SESSION['name'])){
        loginForm();
    }
    else {
    ?>
        <div id="wrapper">
            <div id="menu">
                <button class="button" id="normal">Normal</button>
                <button class="button" id="happy">Feliz</button>
                <button class="button" id="chat">Hablando</button>
                <button class="button" id="fight">Pelea</button>
                <button class="button" id="sneaky">Sigilo</button>
                <button class="button" id="special">Especial</button>
                <button class="button" id="dead">KO</button>
                <p class="welcome"><b> </b></p>
                <p class="logout"><a id="exit" href="#">Salir</a></p>
            </div>

            <div id="personajes">
                <div id="Jakka">

                </div>
                <div id="Belrral">

                </div>
                <div id="Yasek">

                </div>
                <div id="Ostara">

                </div>
            </div>
        </div>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript">
            // jQuery Document
            $(document).ready(function () {
                $.post("post.php", { mood: "normal" });
                $("#normal").click(function() {
                    $.post("post.php", { mood: "normal" });
                });
                $("#happy").click(function() {
                    $.post("post.php", { mood: "happy" });
                });
                $("#chat").click(function() {
                    $.post("post.php", { mood: "chatting" });
                });
                $("#fight").click(function() {
                    $.post("post.php", { mood: "fight" });
                });
                $("#sneaky").click(function() {
                    $.post("post.php", { mood: "sneaky" });
                });
                $("#special").click(function() {
                    $.post("post.php", { mood: "special" });
                });
                $("#dead").click(function() {
                    $.post("post.php", { mood: "dead" });
                });
 
                function loadLog() {
                    $.ajax({
                        url: "logs/Belrral.html",
                        cache: false,
                        success: function (html) {
                            $("#Belrral").html(html);
                        }
                    });
                    $.ajax({
                        url: "logs/Jakka.html",
                        cache: false,
                        success: function (html) {
                            $("#Jakka").html(html);
                        }
                    });
                    $.ajax({
                        url: "logs/Ostara.html",
                        cache: false,
                        success: function (html) {
                            $("#Ostara").html(html);
                        }
                    });
                    $.ajax({
                        url: "logs/Yasek.html",
                        cache: false,
                        success: function (html) {
                            $("#Yasek").html(html);
                        }
                    });
                }
 
                setInterval (loadLog, 25);

                $("#exit").click(function () {
                    var exit = confirm("¿Salir del grupo?");
                    if (exit == true) {
                    <?php file_put_contents("logs/".$_SESSION['name'].".html", "", LOCK_EX); ?>;
                    window.location = "index.php?logout=true";
                    }
                });
            });
        </script>
    </body>
</html>
<?php
}
?>