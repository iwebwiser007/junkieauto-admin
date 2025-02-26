<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

function user(){
   return Auth::user();
   ucwords(str_replace('_',' ',$fl->type));
}


function notification_web($user_msg,$user, $user_title)
{
    $server_key2 = "AAAAXlPljWY:APA91bGorXGaOykTxuPSYNMhcehxje-WsIewIGltNA9YxdBxDL6uKDfyK2B7wnnbWxlVrO-QVYq67HfY7iirinu_qkg1VnKaoYhaZW-DPuWpNSRGZWqi2OnDEx8GBITKtAWZZAGQjYNy";
    $path_to_firebase_cm2 = 'https://fcm.googleapis.com/fcm/send';
    
        $data = array(
            'sound' => 'default',
            'body' => $user_msg,
            'gcm.notification.subType'=>'message',
            'title' => $user_title
        );
        
        $notification = array(
            'title' => $user_title,
            'body' => $user_msg,
            );
        
        $field = array(
        'to' => $user->device_token,
        'data' => $data,
        'notification'=>$notification,
        'message' => "Message Send Successfully",
        'priority' => 'high',
        'content_available' => true,
        );
        
   

    $headers2 = array(
        'Authorization:key=' . $server_key2,
        'Content-Type:application/json'
    );
    // Open connection  
    $ch2 = curl_init();
    // Set the url, number of POST vars, POST data
    curl_setopt($ch2, CURLOPT_URL, $path_to_firebase_cm2);
    curl_setopt($ch2, CURLOPT_POST, true);
    curl_setopt($ch2, CURLOPT_HTTPHEADER, $headers2);
    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch2, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
    curl_setopt($ch2, CURLOPT_POSTFIELDS, json_encode($field));
    // Execute post   

    $result= curl_exec($ch2);

    curl_close($ch2);


    return  $result;
    
}


function notification_app($user_msg,$user, $user_title,$type,$id,$image)
{
    $server_key2 = "AAAAo9mRI28:APA91bHFt9XSLrV5YzGUoqbEb_b8e3r_Z-JwOyq3FGQzFmrYAm52nMUblCD-vmupBc028yHSSLjtR-FIwkwZo7KdW0hjtGR2VeAaubXbNuarCynDdyPXEH49JOH-u4Ko_2yNUnE3bgYF";
    $path_to_firebase_cm2 = 'https://fcm.googleapis.com/fcm/send';


    if ($user->device_type == 'ios') {
        // return 'enter';
        $notification = array(
            'title' => $user_title,
            'message' => $user_msg,
            'sound' => 'default',
            'type' => $type,
            'id'=>$id,
            'image'=>$image,
            'icon' => ''
        );
        $field = array(
            'to' => $user->device_token,
            'data' => $notification,
            'message' => "Message Send Successfully",
            'priority' => 'high',
            'content_available' => true,
        );
        
    } else {
        $notification = array(
            'title' => $user_title,
            'body' => $user_msg,
            'sound' => 'default',
            'type' => $type,
            'image'=>$image,
            'id'=>$id,
            'icon' => ''
        );
        $field = array(
            'to' => $user->device_token,
            'data' => $notification,
            'message' => "Message Send Successfully",
            'priority' => 'high',
            'content_available' => true,
        );
    }

   



    $headers2 = array(
        'Authorization:key=' . $server_key2,
        'Content-Type:application/json'
    );
    // Open connection  
    $ch2 = curl_init();
    // Set the url, number of POST vars, POST data
    curl_setopt($ch2, CURLOPT_URL, $path_to_firebase_cm2);
    curl_setopt($ch2, CURLOPT_POST, true);
    curl_setopt($ch2, CURLOPT_HTTPHEADER, $headers2);
    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch2, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
    curl_setopt($ch2, CURLOPT_POSTFIELDS, json_encode($field));
    // Execute post   

    $result= curl_exec($ch2);

    curl_close($ch2);


    return  $result;
    
}


?>