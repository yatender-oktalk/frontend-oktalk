<?php

// API
$handle= $_GET["hn"];
$reference= $_GET["cn"];
$refurl='http://api.oktalk.com/web/content/'.$reference;

$refstr = file_get_contents($refurl);
$refmsg = json_decode($refstr, true);
$content_id = $refmsg['content_id'];

$realurl='https://api.oktalk.com/web3/channel/handle/'.$handle.'/'.$content_id;

$requrl='http://api.oktalk.com/ver2/channels/user/1/handle/'.$handle.'/content/'.$content_id;

$handurl = 'http://api.oktalk.com/web/channel/handle/'.$handle;
$fburl = 'http://getvokal.com/content.php?hn='.$handle.'&cn='.$reference;
$str = file_get_contents($requrl);

//echo $str;

$msg = json_decode($str, true);
$json = $msg['data'];
$type = $msg['type'];

$payload = $json['payload'];
$img_url = $json['img'];
$title = urldecode($msg['title']);
$title = urldecode($title); // outputs Hello Dolly!
// $title = str_replace("%23","#",$title);
// $title = str_replace("%2C",",",$title);
$played = $msg['played'];
$likes = $msg['likes'];

$newstr = file_get_contents($handurl);
$newmsg = json_decode($newstr, true);
$handlename = $newmsg['name'];
$banner = $newmsg['banner'];
//$desc = urldecode($newmsg['desc']);
// $desc = "Click to Listen";

// $glink = 'https://play.google.com/store/apps/details?id=com.oktalk.app&amp;referrer=utm_source%3DWebsite%26utm_campaign%3DCP_'.$handle.'%26utm_content%3D'.$content_id;
// $twittertitle = $title.' by '.$handlename;

// $playurl = 'http://api.oktalk.com/web/channel/handle/'.$handle.'/content/'.$content_id.'/played'; 
// $banner = $banner==""?"http://s3-ap-southeast-1.amazonaws.com/ok.talk.images/user_1/1_76452_img.jpg":$banner;
// $fbbanner = $banner==""?"http://getvokal.com/img/BG.png":$banner;
// $fbimg = $img_url==""?$fbbanner:$img_url;
// $img_url = $img_url==""?"http://getvokal.com/img/BG.png":$img_url;

// $origurl='android-app://com.oktalk/http/vkl.fm/ch/'.$handle.'/'.$content_id;
// $iosurl='vokal://com.vokal/play?contentID='.$content_id;
?>

<!DOCTYPE html>
<html>
  <head>

  </head>
      <body>
          <?php echo $title?>
      </body>
 </html>
