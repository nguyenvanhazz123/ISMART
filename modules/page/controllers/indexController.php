<?php

function construct(){
    load_model('index');
}
function indexAction(){     
    $list_page = get_list_page();    
    $data['list_page'] = $list_page;
    load_view('index', $data);
}



?>
