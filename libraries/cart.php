<?php

function get_num_order_cart(){
    if(isset($_SESSION['cart']['info'])){
        return  $_SESSION['cart']['info']['num_order'];
    }
}

?>