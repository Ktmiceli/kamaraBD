<?php

function knew($array){
    $status = true;
    $err = array();
    if(!isset($array['u'])){$status = false; array_push($err,'User empty!');}
    if(!isset($array['p'])){$status = false; array_push($err,'Password empty!');}
    if(!isset($array['db'])){$status = false; array_push($err,'BD empty!');}
    if($status == true){
        if((isset($_SESSION['kamaraDB_'.$array['bd']])) OR (file_exists(('../data/'.$array['db'])))) {$status = false; array_push($err,'BD Duplicate!');}else
        {mkdir('../data/'.$array['db']); $auth = fopen('../data/'.$array['db'].'/auth.kaa','w'); fwrite($auth,
            '⌦'.md5($array['u'].'⌦'.md5($array['p'].'⌦'.date('d-M-Y-H:i'))));}
    }
    return array('status'=>$status,'err'=>$err);

}

?>