<?php

/**
 * @package Wooalert
 */

/**
 * Plugin Name: Wooalert
 * Description: Wooalert plugin
 * Version: 1.0.0
 * Author: Lupievent
 * License: GPLv2 or later
 * Text Domian: wooalert-plugin
 */

if (!defined('ABSPATH')) {
    die;
}

class Wooalert
{
    function __construct()
    {   
        add_filter('woocommerce_add_to_cart_validation', [$this,'alert_on_add_to_cart'], 100, 0);
    }
    function activate()
    {
       flush_rewrite_rules();
    }

    function deactivate()
    {
    }

    function uninstall()
    {
    }

    function alert_on_add_to_cart(){
        if(isset($_POST))
        {
        print_r($_POST);
           $quantity = $_POST['quantity'];
           $productId = $_POST['add-to-cart'];
           $message = "You just changed the quantity of Product ID $productId to $quantity";
            // die;
            ?>
         <script>
             alert("<?=$message;?>");
        </script>
        <?php
         return true;
        }
        return false;
    }

}

if (class_exists(('Wooalert'))) {
    $wooalert = new Wooalert();
}


//activation 
register_activation_hook('__FILE__', array($wooalert,'activate'));

//deactivation
register_deactivation_hook('__FILE__', array($wooalert,'deactivate'));

//uninstall