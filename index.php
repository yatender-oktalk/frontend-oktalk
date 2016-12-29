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
$played = $msg['played'];
$likes = $msg['likes'];

$newstr = file_get_contents($handurl);
$newmsg = json_decode($newstr, true);
$handlename = $newmsg['name'];
$banner = $newmsg['banner'];
//$desc = urldecode($newmsg['desc']);
$desc = "Click to Listen";

$glink = 'https://play.google.com/store/apps/details?id=com.oktalk.app&amp;referrer=utm_source%3DWebsite%26utm_campaign%3DCP_'.$handle.'%26utm_content%3D'.$content_id;
$twittertitle = $title.' by '.$handlename;

$playurl = 'http://api.oktalk.com/web/channel/handle/'.$handle.'/content/'.$content_id.'/played'; 
$banner = $banner==""?"http://s3-ap-southeast-1.amazonaws.com/ok.talk.images/user_1/1_76452_img.jpg":$banner;
$fbbanner = $banner==""?"http://getvokal.com/img/BG.png":$banner;
$fbimg = $img_url==""?$fbbanner:$img_url;
$img_url = $img_url==""?"http://getvokal.com/img/BG.png":$img_url;

$origurl='android-app://com.oktalk/http/vkl.fm/ch/'.$handle.'/'.$content_id;
$iosurl='vokal://com.vokal/play?contentID='.$content_id;
?>

<!Doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=9" />
    <title><?php echo $twittertitle?></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css" />
    <link href="assets/favicon.ico" rel="shortcut icon">
    <link href="assets/apple-touch-icon.png" rel="apple-touch-icon">
    <link rel="alternate" hreflang="en" href="http://getvokal.com/app">

    <link rel="alternate" href="<?php echo $origurl; ?>">
    <link rel="alternate" href="<?php echo $iosurl; ?>">
    
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@getvokal">
    <meta name="twitter:title" content="<?php echo $twittertitle; ?>">
    <meta name="twitter:image" content="<?php echo $banner; ?>">
    <meta name="twitter:description" content="<?php echo $desc; ?>">

    <meta property="fb:app_id" content="1715260478754437">
    <meta property="og:site_name" content="Vokal">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo $fburl; ?>">
    <meta property="og:title" content="<?php echo $twittertitle; ?>">
    <meta property="og:image" content="<?php echo $fbimg; ?>">
    <meta property="og:image:width" content="250">
    <meta property="og:image:height" content="500">
    <meta property="og:description" content="<?php echo $desc; ?>">

<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '139995879754749', {
em: 'insert_email_variable,'
});
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=139995879754749&ev=PageView&noscript=1"
/></noscript>
<!-- DO NOT MODIFY -->
<!-- End Facebook Pixel Code -->

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-4">
		<a href="http://getvokal.com/app" onclick="sendGA('Top Bar','Home')" target="_blank">
                <img class="companyLogo" src="assets/images/logo.png" />
		</a>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-8">
                <div class="socialHandle">
                    <span>Follow us</span>
                    <li>
			<a href="https://www.facebook.com/getvokal" onclick="sendGA('Top Bar','Facebook')"  target="_blank">
                        <img src="./img/Fb_icon.svg" />
                        <span class="hidden-xs">
                        Facebook
                        </span>
			</a>
                    </li>
                    <li>
			<a href="http://twitter.com/getvokal" onclick="sendGA('Top Bar','Twitter')" target="blank">
                        <img src="./img/twitter.svg" />
                        <span class="hidden-xs">
                        Twitter
                        </span>
			</a>
                    </li>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-offset-4 col-lg-4 col-md-offset-4 col-md-4 visible-col-sm-offset-4 visible-col-sm-4 col-xs-12">
                <div class="row baseBox">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            <img class="userImg" src="<?php echo $banner; ?>" />
                            <div class="userName">
                                <?php echo $handlename?>
                                <div class="userTimeLapse">
<!--                                    4 minutes ago-->
                                    @<?php echo $handle?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <h1 class="heading">
				<p><span>
                                <?php echo $title; ?>
				</span></p>
                            </h1>
                        </div>
                        <div class="row">
                            <img class="showImg" src="<?php echo $img_url; ?>" />
                        </div>
                        <div class="row">
                            <div class="col-xs-12 soundBoxRow">
                                <audio preload="auto" controls>
                                    <source src="<?php echo $payload; ?>" type="audio/mp4">
                                    <source src="<?php echo $payload; ?>" type="audio/mpeg">
                                    fallback 
                                    <p>Your browser does not support HTML5 audio.</p>
                                </audio>

                            </div>

                            <div class="soundBoxRow">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 soundBoxColumn metaInfoColumn row">
                                    <span class="metaInfo">
                                <img src="./img/icon-plays.svg"/>
                                <?php echo $played?>
                            </span>
                                    <span class="metaInfo">
                                <img src="./img/icon-likes.svg"/>
                                <?php echo $likes?>
                            </span>
                                </div>
                            </div>
                       </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h1 class="downloadInfo">
                            Download Vokal to <br/> listen to more amazing audio
                        </h1>
                    </div>
                    <div class="row downloadSrcButtons" style="text-align:center">
                        <div id="android" class="col-lg-6 col-md-6  col-sm-6 col-xs-12 custom">
                            <a href="<?php echo $glink; ?>" onclick="sendGA('Download App','Google')" target="_blank">
                                <img class="downloadSrc" src="./img/downloadSrcAndroid.svg" />
                            </a>
                        </div>
                        <div id="apple" class="col-lg-6 col-md-6  col-sm-6 col-xs-12 custom">
                          <a href="https://itunes.apple.com/in/app/oktalk/id1113364367?mt=8" onclick="sendGA('Download App','Apple')" target="_blank">
                                <img class="downloadSrc" src="./img/downloadSrcApple.svg" />
                            </a>
                            
                        </div>
                    </div>
                </div>

                <div class="row copyRightBox">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <img class="copyRightLogo" src="./img/logo.png" />
                        <div class="copyRightTagLine">
                            Your Voice Entertainment
                        </div>
                        <div class="copyRightInfo">
                            Copyright © 2016. All rights reserved.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.slim.js"></script>
    
    <script type="text/javascript" src="main.js"></script>
       <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-70921665-3', 'auto');
      ga('send', 'pageview');
	    var x = 0;
        var aud = document.getElementsByTagName('audio')[0];
        window.onload = function(){
            aud.play();
        };
        aud.onplay = function() {
	    console.log("audio played.");
            if(x==0){
		console.log("inside x == 0");
                x = 1;
                var b = '<?php echo $handlename;?>'+' '+escape("<?php echo $title;?>");
                sendGA('Play voke',b);
		        sendplayed("");	
            }
         };
        function sendGA(a,b){
            console.log(a +' '+b);
            ga('send', 'event', {
                eventCategory: 'ContentPage',
                eventAction: a,
                eventLabel: b
            });
        }
	function sendplayed(txt) {
  	  var xhr = new XMLHttpRequest();
  	  xhr.open('PUT', '<?php echo $playurl;?>', true);
  	  xhr.onload = function(e) {
    	  if (this.status == 200) {
      		console.log(this.responseText);
    	  }
  	};
  	xhr.send(txt);
	}
   </script>

</body>

</html>
