<?php

// API
$handle= $_GET["hn"];

$reference= $_GET["cn"];

$refurl='http://api.oktalk.com/web/content/'.$reference;
$refstr = file_get_contents($refurl);
$refmsg = json_decode($refstr, true);
$content_id = $refmsg['content_id'];
$realurl='https://api.oktalk.com/web2/channel/handle/'.$handle.'/'.$content_id;
$requrl='http://api.oktalk.com/ver2/channels/user/1/handle/'.$handle.'/content/'.$content_id;
$handurl = 'http://api.oktalk.com/web/channel/handle/'.$handle;
$str = file_get_contents($requrl);
$msg = json_decode($str, true);
$json = $msg['data'];
$type = $msg['type'];
$payload = $json['payload'];
$img_url = $json['img'];
$title = $msg['title'];
$played = $msg['played'];
$likes = $msg['likes'];
$newstr = file_get_contents($handurl);
$newmsg = json_decode($newstr, true);
$handlename = $newmsg['name'];
$banner = $newmsg['banner'];
$desc = $newmsg['desc'];
$glink = 'https://play.google.com/store/apps/details?id=com.oktalk.app&amp;referrer=utm_source%3DWebsite%26utm_campaign%3DContentPage%26utm_medium%3D'.$handle.'%26utm_content%3D'.$content_id;
$twittertitle = $title.' by '.$handlename;
$img_url = $img_url==""?"./img/picture-not-available.jpg":$img_url;
$banner = $banner==""?"./img/images.png":$banner;
$origurl='android-app://com.oktalk/http/oktk.io/ch/'.$handle.'/'.$content_id;
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
    
    <link rel="alternate" hreflang="en" href="http://getvokal.com/app"/>
    <link rel="alternate" href=<?php echo $origurl; ?>/>
    <style>
*,
html,
body {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}

html,
body {
    width: 100%;
    height: 100%;
}

html * {
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

*, *:after, *:before {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}

body {
    font-family: 'Open Sans', sans-serif;
    margin: 0;
    color: #000;
    font-size: 14px;
    background-color: #eaedf0;
    -webkit-font-smoothing: antialiased;
}

a {
    text-decoration: none;
    color: #333333;
}

a:hover {
    text-decoration: none;
    color: #000000;
}

ul {
    list-style: none;
}

h1 {
    font-size: 20px;
}

.container {
    margin: 15px auto;
}

.companyLogo {
    height: 30px;
    width: 90px;
}

.companyName {
    color: #1caefa;
    font-weight: 600;
    font-size: 20px;
    padding-left: 10px;
}

.socialHandle {
    text-align: right;
}

.socialHandle span {
    color: #bec2c7;
    font-size: 14px;
    font-weight: 600;
    display: inline-block;
    text-transform: uppercase;
    padding: 0px 10px;
}

.socialHandle li {
    display: inline-block;
    color: #555555;
    padding-left: 10px;
}

.socialHandle li span{
    color: #555555;
    font-size: 14px;
    font-weight: 400;
    text-transform: none;
    padding: 0px;
}

.socialHandle li img {
    height: 20px;
    width: 20px;
}

.baseBox {
    border-radius: 2px;
    background-color: #ffffff;
    border: solid 0.3px #e0e5eb;
    margin: 10px auto;
    padding: 15px;
}

.baseBox .userImg {
    height: 75px;
    width: auto;
    /*border-radius: 50%;*/
    display: inline-block;
}

.baseBox .userName {
    color: #333333;
    font-weight: 600;
    font-size: 12px;
    line-height: .5;
    display: inline-block;
    margin-left: 90px;
    width: 120px;
    margin-top: 23px;
}

.baseBox .userName .userTimeLapse {
    position: relative;
    top: 10px;
    font-size: 11px;
    color: #999999;
}

.baseBox h1.heading {
	font-size: 15px;
	font-weight: 300;
/*	color: #222222;*/
    color: #222222;
}

.baseBox .showImg {
    width: 100%;
    max-height: 350px;
}

.baseBox .soundBoxImg {
    margin-top: 15px;
    width: 100%;
}

.baseBox .soundBoxRow {
    padding: 8px 0px;
    margin:auto;
}

.baseBox .soundBoxRow .soundBoxColumn {
    padding: 0px;
}

.baseBox .soundBoxRow .soundBoxColumn .time {
    color: #7a7878;
    font-size: 12px;
    font-weight: 600;
}

.baseBox .soundBoxRow .soundBoxColumn.metaInfoColumn {
    color: #999999;
    font-size: 10px;
    font-weight: 600;
    text-align: right;
    margin-left: 2px;
}

.baseBox .soundBoxRow .soundBoxColumn.metaInfoColumn .metaInfo {
    padding-left: 10px;
}

.baseBox .soundBoxRow .soundBoxColumn.metaInfoColumn .metaInfo img{
    height: 12px;
    width: 12px;
}

h1.downloadInfo {
    color: #555555;
    text-align: center;
    margin-top: 15px;
}

.downloadSrcButtons {
    margin: 15px 0px 40px;
}
.copyRightBox {
    color: #555555;
    text-align: center;
}

.copyRightBox .copyRightLogo {
    height: 25px;
    width: 25px;
    -webkit-filter: grayscale(100%);
    filter: grayscale(100%);
}

.copyRightBox .copyRightTagLine {
    font-size: 15px;
}

.copyRightBox .copyRightInfo {
    font-size: 12px;
}
audio {
    display: block;
    width: 100%;
}

@media (max-width: 1024) {
  .downloadSrc{
    width: 100%;
/*    margin-left:5%;*/
  }
  .downloadSrcButtons{
    width: 60%;
    margin-left: 30%;
  }
}

	font-weight: 300;
    color: #222222;
}

.baseBox .showImg {
    width: 100%;
}

.baseBox .soundBoxImg {
    margin-top: 15px;
    width: 100%;
}

.baseBox .soundBoxRow {
    padding: 8px 0px;
    margin:auto;
}

.baseBox .soundBoxRow .soundBoxColumn {
    padding: 0px;
}

.baseBox .soundBoxRow .soundBoxColumn .time {
    color: #7a7878;
    font-size: 12px;
    font-weight: 600;
}

.baseBox .soundBoxRow .soundBoxColumn.metaInfoColumn {
    color: #999999;
    font-size: 10px;
    font-weight: 600;
    text-align: right;
    margin-left: 2px;
}

.baseBox .soundBoxRow .soundBoxColumn.metaInfoColumn .metaInfo {
    padding-left: 10px;
}

.baseBox .soundBoxRow .soundBoxColumn.metaInfoColumn .metaInfo img{
    height: 12px;
    width: 12px;
}

h1.downloadInfo {
    color: #555555;
    text-align: center;
    margin-top: 15px;
}
.marginBottom{
    margin-bottom: 10px;
}
.downloadSrcButtons {
    margin: 15px 0px 40px;
}
.copyRightBox {
    color: #555555;
    text-align: center;
}

.copyRightBox .copyRightLogo {
    height: 25px;
    width: 25px;
    -webkit-filter: grayscale(100%);
    filter: grayscale(100%);
}

.copyRightBox .copyRightTagLine {
    font-size: 15px;
}

.copyRightBox .copyRightInfo {
    font-size: 12px;
}
audio {
    display: block;
    width: 100%;
}
.with-bg-size {
            background-image: url("<?php echo $banner; ?>");
                width: 75px;
        height: 75px;
            background-position: center center;
            border-radius:50%;
            /* Make the background image cover the area of the <div>, and clip the excess */
            background-size: cover;
        }Ï
@media (max-width: 1024) {
  .downloadSrc{
    width: 100%;
/*    margin-left:5%;*/
  }
  .downloadSrcButtons{
    width: 60%;
    margin-left: 30%;
  }
}
    </style>

  
</head>
 
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-4">
		<a href="http://getvokal.com/app" target="_blank">
                <img class="companyLogo" src="assets/images/logo.png" />
		</a>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-8">
                <div class="socialHandle">
                    <span>Follow us</span>
                    <li>
			<a href="https://www.facebook.com/getvokal" target="_blank">
                        <img src="./img/Fb_icon.svg" />
                        <span class="hidden-xs">
                        Facebook
                        </span>
			</a>
                    </li>
                    <li>
			<a href="http://twitter.com/getvokal" target="blank">
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
                            <!--<img class="userImg" src="<?php echo $banner; ?>" />-->
                            <div class="with-bg-size">
                            <div class="userName">
                                <?php echo $handlename?>
                                <div class="userTimeLapse">
<!--                                    4 minutes ago-->
                                    @<?php echo $handle?>
                                </div>
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
                            <a href="<?php echo $glink; ?>"  target="_blank">
                                <img class="downloadSrc" src="./img/downloadSrcAndroid.svg" />
                            </a>
                        </div>
                        <div id="apple" class="col-lg-6 col-md-6  col-sm-6 col-xs-12 custom">
                          <a href="https://itunes.apple.com/in/app/oktalk/id1113364367?mt=8" target="_blank">
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
    
    <script type="text/javascript">
    $(document).ready(function () {
    $('#android').hide();
    $('#apple').hide();
    var isMobile = {
        Android: function () {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function () {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function () {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function () {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function () {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function () {
            return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
        }
    }

    function _isMobile() {
        var isMobile = (/iphone|ipod|android|ie|blackberry|fennec|ipad/).test
            (navigator.userAgent.toLowerCase());
        return isMobile;
    }
    
     function playPause() {
            var myVideo = document.getElementsByTagName('audio')[0];
            if (myVideo.paused)
                myVideo.play();
            else
                myVideo.pause();
        }

    if (_isMobile()) {
        if (isMobile.iOS()) {
            // console.log('mobile is ios');
            $('#android').hide();
            $('#apple').show();

        }
        if (isMobile.Android()) {
            // console.log('mobile is android');
            $('#apple').hide();
            $('#android').show();
          
            
        }
    } else {
        // console.log('user is using Desktop');
        $('#android').show();
        $('#apple').show();
    }

});
    </script>
       <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-70921665-3', 'auto');
      ga('send', 'pageview');
   </script>

</body>


</html>