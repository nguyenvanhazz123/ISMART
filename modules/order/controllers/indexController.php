<?php

function construct(){
    load_model('index');
}
function indexAction(){
    load_view('index');
}
function updateAction(){
    $id = $_POST['id'];
    echo $id;
}
?>
