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
$title = str_replace("%20", " ",$title);
$title = str_replace("%23","#",$title);
$played = $msg['played'];
$likes = $msg['likes'];

$newstr = file_get_contents($handurl);
$newmsg = json_decode($newstr, true);
$handlename = $newmsg['name'];
$banner = $newmsg['banner'];
//$desc = urldecode($newmsg['desc']);
// $desc = "Tap to Listen";

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


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/style4.css" />


     <link rel="alternate" href="<?php echo $origurl; ?>">
    <link rel="alternate" href="<?php echo $iosurl; ?>">
    
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@getvokal">
    <meta name="twitter:title" content="<?php echo $twittertitle; ?>">
    <meta name="twitter:image" content="<?php echo $banner; ?>">
    <meta name="twitter:description" content="Tap to listen">

    <meta property="fb:app_id" content="1715260478754437">
    <meta property="og:site_name" content="Vokal">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo $fburl; ?>">
    <meta property="og:title" content="<?php echo $twittertitle; ?>">
    <meta property="og:image" content="<?php echo $fbimg; ?>">
    <meta property="og:image:width" content="250">
    <meta property="og:image:height" content="500">
    <meta property="og:description" content="Tap to listen">

    <title>vokal</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/2.0.0/handlebars.js"></script>
<!-- Facebook Pixel Code -->
<!--<script>
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
/></noscript>-->
<!-- DO NOT MODIFY -->
<!-- End Facebook Pixel Code -->

</head>

<body>
    <div class="content-placeholder"></div>


    <script type="text/javascript" src="./node_modules/aplayer/dist/APlayer.min.js?v=3"></script>


    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="./js/contentnew.js?v=4"></script>
        <script id="address-template" type="text/x-handlebars-template">
        <div>
            <div class="row headerBox">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-4  borderBlack">
                    <a href="http://getvokal.com/" onclick="sendGA('Top Bar','Home')" target="_blank">
                        <img class="companyLogo" src="img/logo.png" />
                    </a>
                </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-8 borderRed headerRow">
                <a href="{{urls.glink}}" onclick="sendGA('Download App','Google')" target="_blank">
                    <img class="downloadSrc" src="./img/downloadSrcAndroid.svg" />
                </a>
                <a href="https://itunes.apple.com/in/app/oktalk/id1113364367?mt=8" onclick="sendGA('Download App','Apple')" target="_blank">
                    <img class="downloadSrc" src="./img/downloadSrcApple.svg" />
                </a>
            </div>
        </div>
<div class="row">
    <div class="col-lg-offset-4 col-lg-4 col-md-offset-4 col-md-4 col-sm-offset-3 col-sm-6 col-xs-12  borderBlack content-bodyWrapper">
        <div class="row baseBox">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-xs-2 img-circular">
                    </div>
                    <div class="col-xs-8">
                        <div class="userName">
                            {{content.name}}
                            <div class="userTimeLapse">
                                @{{content.handle}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
            </div>
            <div class="row imageDiv borderBlack">
                <div class="layer">
                    <div class="soundBoxRow">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 soundBoxColumn metaInfoColumn row">
                            <span class="metaInfo">
                                    <img src="./img/icon-plays.svg"/>
                                    {{content.played}} Listens
                                </span>
                        </div>
                    </div>
                    <div class="row alignBottom40">
                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 soundBoxColumn metaInfoColumn desc-row row">
                            <span class="metaInfo">
                                        {{formatComment content.title}}
                                    </span>
                        </div>
                    </div>
                    <div class="layer2">
                        <div id="player" class="aplayer">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="baseBoxMicrophone">
                    <i class="fa fa-microphone" aria-hidden="true"></i>
                    <span>{{handleComments content.no_of_comments}}</span>
                </div>
            </div>
            {{#if comments.length}} {{#each comments}}
            <div class="row baseBoxUserComment">
                <div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 img-circular-2">
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                        <div class="userName">
                            {{name}}
                            <div class="userTimeLapse">
                                {{formatDate created_at}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row hrLine">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <hr/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 soundBoxRow marginSoundRow">
                        <audio preload="auto" controls class="audioBox">
                            <source src={{payload}} type="audio/mp4">
                            <source src={{payload}} type="audio/mpeg"> fallback
                            <p>Your browser does not support HTML5 audio.</p>
                        </audio>
                    </div>
                </div>
            </div>
            {{/each}}
            <div class="row baseBoxLoadMore" onclick="getMoreComments()">
<span>Load More Comments</span>
</div>
{{/if}}
</div>
<div class="row moreVokes">
    <p class="more-vokes-by">More vokes by</p>
    <p class="more-vokes-by-artist">{{content.name}}</p>
</div>
{{#each moreVokes}}
<div class="row baseBoxDown">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="row">
            <div class="col-xs-2 img-circular">
            </div>
            <div class="col-xs-8">
                <div class="userName">
                    {{name}}
                    <div class="userTimeLapse">
                        @{{handle}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

    </div>
    <div class="row imageDiv borderBlack">
        <div class="layer">
            <div class="soundBoxRow">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 soundBoxColumn metaInfoColumn row">
                    <span class="metaInfo">
                                    <img src="./img/icon-plays.svg"/>
                                    {{played}} Listens
                                </span>
                </div>
            </div>
            <div class="row alignBottom40">
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 soundBoxColumn metaInfoColumn desc-row row">
                    <span class="metaInfo">
                                        {{formatComment title}}
                                    </span>
                </div>
            </div>
            <div class="layer2">
                <div id="player{{@index}}" class="aplayer" onclick="updatePlay({{@index}}, 1)">
</div>
</div>
</div>
</div>
<div class="row">
    <div class="baseBoxMicrophone">
        <i class="fa fa-microphone" aria-hidden="true"></i>
        <span>{{handleComments no_of_comments}}</span>
    </div>
</div>
</div>
{{/each}}
<div class="row listen-to-box">
    <p>Listen to <span>{{content.name}}</span></p>
    <p>and more on <span>Vokal</span></p>
</div>
{{#each suggestions}}
<div class="row ">
    <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-sm-offset-2 col-sm-8 col-xs-offset-2 col-xs-8 align-suggestions-center">
        <div class="row">
            <div class="col-lg-offset-5 col-lg-4 col-md-offset-4 col-md-4 col-sm-offset-4 col-sm-4 col-xs-offset-4 col-xs-4">
                <div class="img-circular-suggestions">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-sug-name">
                <p class="suggestions-name">{{name}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-sug-name-desc ">
                <p class="one-man-many-voices">{{about}} </p>
            </div>
        </div>
        <div class="row">
            <a href="{{pageurl}}">
                <div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8 col-xs-offset-2 col-xs-8 listen-now">
                    Listen now
                </div>
            </a>
        </div>
    </div>
</div>
{{/each}}

</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mask">
    <div class="col-lg-offset-4 col-lg-4 col-md-offset-4 col-md-4 col-sm-offset-3 col-sm-6 col-xs-12">
        <div class="download-app">
            <p>Download the Vokal App</p>
        </div>
        <div class="listen-to-funniest">
            <p>
                Listen to the funniest voices in India only on the Vokal App
            </p>
        </div>
        <div class="download-app-btn">
            <a href="{{urls.glink}}" onclick="sendGA('Download App','Google')" target="_blank">
<img class="downloadSrcBottom" src="./img/downloadSrcAndroid.svg" />
</a>
</div>
<div class="download-app-btn">
    <a href="https://itunes.apple.com/in/app/oktalk/id1113364367?mt=8" onclick="sendGA('Download App','Apple')" target="_blank">
<img class="downloadSrcBottom" src="./img/downloadSrcApple.svg" />
</a>
</div>
<div>
    <img class="bottom-phone" src="./img/deviceNew@3x.png" />
</div>
</div>
</div>
</div>
<div class="row footer">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <p>
                <a href="http://getvokal.com/app" target="_blank">
                    <img class="companyLogo" src="img/logo.png" />
                </a>
            </p>
            <p class="vokal-is-a-audio-only">Vokal is a audio only app for India’s best entertainers.</p>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 terms-policy">
            <div class="min-width"><a href="http://getvokal.com">ABOUT</a></div>
            <div class="min-width"><a href="http://getvokal.com">FAQ</a></div>
            <div class="min-width"><a href="http://getvokal.com">ARTISTS</a></div>
            <div class="min-width"><a href="http://getvokal.com">PRIVACY POLICY</a></div>
            <div class="min-width"><a href="http://getvokal.com">TERMS & CONDITIONS</a></div>
            <div class="min-width">
                <a href="http://getvokal.com" onclick="sendGA('Top Bar','Facebook')">FACEBOOK</a>
</div>
<div class="min-width">
    <a href="http://getvokal.com" onclick="sendGA('Top Bar','Twitter')">TWITTER</a>
</div>
</div>
</div>
</div>

</div>
</script>



    <script>
                                           (function (i, s, o, g, r, a, m) {
                                               i['GoogleAnalyticsObject'] = r; i[r] = i[r] || function () {
                                                   (i[r].q = i[r].q || []).push(arguments)
                                               }, i[r].l = 1 * new Date(); a = s.createElement(o),
                                                   m = s.getElementsByTagName(o)[0]; a.async = 1; a.src = g; m.parentNode.insertBefore(a, m)
                                           })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
                                           ga('create', 'UA-70921665-3', 'auto');
                                           //   ga('send', 'pageview');

                                           function sendGA(a, b) {
                                               console.log(a + ' ' + b);
                                               // ga('send', 'event', {
                                               //     eventCategory: 'ContentPage',
                                               //     eventAction: a,
                                               //     eventLabel: b
                                               // });
                                           }
    </script>
</body>

</html>