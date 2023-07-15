<?php

function knew($array){
    $status = true;
    $err = array();
    if(!isset($array['u'])){$status = false; array_push($err,'User empty!');}
    if(!isset($array['p'])){$status = false; array_push($err,'Password empty!');}
    if(!isset($array['db'])){$status = false; array_push($err,'BD empty!');}
    if($status == true){
        if((isset($_SESSION['kamaraDB_'.$array['db']])) OR (file_exists(('data/'.$array['db'])))) {$status = false; array_push($err,'BD Duplicate!');}else
        {mkdir('data/'.$array['db']); $auth = fopen('data/'.$array['db'].'/auth.kaa','w'); fwrite($auth,
            '⌦'.md5($array['u']).'⌦'.md5($array['p']).'⌦'.date('d-M-Y-H:i')); fclose($auth);}
    }
    return array('status'=>$status,'err'=>$err);
}

function kin($array){
    $status = true;
    $err = array();
    if(!isset($array['u'])){$status = false; array_push($err,'User empty!');}
    if(!isset($array['p'])){$status = false; array_push($err,'Password empty!');}
    if(!isset($array['db'])){$status = false; array_push($err,'BD empty!');}
    if($status = true){
        if(isset($_SESSION['kamaraDB_'.$array['db']])){$status = false; array_push($err,'BD already active!');}else{
            if(!file_exists('data/'.$array['db'])){$status = false; array_push($err,'BD not exist!');}else{
                $auth = file('data/'.$array['db']); $lnauth = explode('⌦',$auth[0]);
                if(!$lnauth[1] == md5($array['u'])){$status = false; array_push($err,'User invalid!');}else{
                    if(!$lnauth[2] == md5($array['p'])){$status = false; array_push($err,'Password invalid!');}
                        else{
                            $_SESSION['kamaraDB_'.$array['db']] = true;
                            $_SESSION['kamaraDB_'.$array['db'].'_user'] = $array['u'];
                            $_SESSION['kamaraDB_'.$array['db'].'_pass'] = $array['p'];
                        }
                }
            }
        }
    }
    return array('status'=>$status,'err'=>$err);
}

?>