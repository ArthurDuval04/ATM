<?php

if(!isset($_GET['action'])){
	$_GET['action'] = 'consulter';
}
$action = $_GET['action'];

switch($action){
    case 'consulter':{
        include('vues/v_visiopasse.php');

    }
    
    break;
}
    
