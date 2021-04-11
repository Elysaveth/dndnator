<?php
session_start();
if(isset($_SESSION['name'])){
    $mood = $_POST['mood'];
    $capname = $_SESSION['name'];
    $name = strtolower($capname);
    $capmood = ucwords($mood);
    $div = substr($mood,0,3).substr($name,0,3);
     
    $text_message = "<img class='char $mood $name' src='characters/$capname/$capmood.png' alt='$capname' id='$div'>";
    file_put_contents("logs/$capname.html", $text_message, LOCK_EX);
}
?>