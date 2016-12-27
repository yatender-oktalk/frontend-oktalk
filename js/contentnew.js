
var ap = '';
var apv = ['0', '1'];
var start = function (context, urls, hideMoreVoke) {
    // $(function () {
    var DURATION_IN_SECONDS = {
        epochs: ['year', 'month', 'day', 'hour', 'minute'],
        year: 31536000,
        month: 2592000,
        day: 86400,
        hour: 3600,
        minute: 60
    };

    function getDuration(seconds) {
        var epoch, apierval;
        for (var i = 0; i < DURATION_IN_SECONDS.epochs.length; i++) {
            epoch = DURATION_IN_SECONDS.epochs[i];
            apierval = Math.floor(seconds / DURATION_IN_SECONDS[epoch]);
            if (apierval >= 1) {
                return { apierval: apierval, epoch: epoch };
            }
        }
    };

    function timeSince(date) {
        var seconds = Math.floor((new Date() - new Date(date)) / 1000);
        var duration = getDuration(seconds);
        var suffix = (duration.apierval > 1 || duration.apierval === 0) ? 's' : '';
        return duration.apierval + ' ' + duration.epoch + suffix + ' ago';
    };

    context['urls'] = urls;

    Handlebars.registerHelper("formatDate", function (date) {
        if (typeof (date) == "undefined") {
            return "Unknown";
        }
        return timeSince(date);
    });

    Handlebars.registerHelper("formatComment", function (comment) {
        try {
            // console.log(comment);
            if (comment.indexOf('%20') >= 0) {
                comment = decodeURIComponent(comment);
                // console.log('decoded');
                // console.log(comment);
            }
        } catch (ex) {

        }
        return comment;
    });

    Handlebars.registerHelper("handleComments", function (count) {
        if (count) {
            if (count <= 1) {
                return count + ' comment';
            }
            if (count > 1) {
                return count + ' comments';
            }
        } else {
            return "0 comment";
        }
    });
    var theTemplateScript = '';
    var theTemplate = '';
    var theCompiledHtml = '';

    theTemplateScript = $("#address-template").html();
    theTemplate = Handlebars.compile(theTemplateScript);
    theCompiledHtml = theTemplate(context);

    // Add the compiled html to the page
    $('.content-placeholder').html(theCompiledHtml);

    $('meta[name="twitter:title"]').attr('content', urls.twittertitle || 'voke');
    $('meta[name="twitter:image"]').attr('content', context.content.img || context.content.banner || "http://s3-ap-southeast-1.amazonaws.com/ok.talk.images/user_1/1_76452_img.jpg");

    $('meta[property="og:title"]').attr('content', urls.twittertitle);
    $('meta[property="og:image"]').attr('content', context.content.img || 'http://getvokal.com/img/BG.png');
    $('meta[property="og:url"]').attr('content', urls.fburl);

    var link = document.createElement('link');
    link.rel = 'alternate';
    link.href = urls.origurl;
    document.head.appendChild(link);

    var link = document.createElement('link');
    link.rel = 'alternate';
    link.href = urls.iosurl;
    document.head.appendChild(link);

    var moreV = context.moreVokes === undefined ? [] : context.moreVokes;
    for (var i = 0; i < moreV.length; i++) {
        apv[i] = new APlayer({
            element: document.getElementById('player' + i),                       // Optional, player element
            narrow: false,                                                     // Optional, narrow style
            autoplay: false,                                                    // Optional, autoplay song(s), not supported by mobile browsers
            showlrc: 0,                                                        // Optional, show lrc, can be 0, 1, 2, see: ###With lrc
            mutex: true,                                                       // Optional, pause other players when this player playing
            theme: '#e6d0b2',                                                  // Optional, theme color, default: #b7daff
            mode: 'random',
            repeat: false,                                                  // Optional, play mode, can be `random` `single` `circulation`(loop) `order`(no loop), default: `circulation`
            preload: 'metadata',                                               // Optional, the way to load music, can be 'none' 'metadata' 'auto', default: 'auto'
            listmaxheight: '513px',                                             // Optional, max height of play list
            music: {                                                           // Required, music info, see: ###With playlist
                title: moreV[i].title,                                          // Required, music title
                author: moreV[i].name,                          // Required, music author
                url: moreV[i].payload
            }
        });
    }

    ap = new APlayer({
        element: document.getElementById('player'),                       // Optional, player element
        narrow: false,                                                     // Optional, narrow style
        autoplay: true,                                                    // Optional, autoplay song(s), not supported by mobile browsers
        showlrc: 0,                                                        // Optional, show lrc, can be 0, 1, 2, see: ###With lrc
        mutex: true,                                                       // Optional, pause other players when this player playing
        theme: '#e6d0b2',                                                  // Optional, theme color, default: #b7daff
        mode: 'random',                                                    // Optional, play mode, can be `random` `single` `circulation`(loop) `order`(no loop), default: `circulation`
        preload: 'metadata',                                               // Optional, the way to load music, can be 'none' 'metadata' 'auto', default: 'auto'
        listmaxheight: '513px',                                             // Optional, max height of play list
        music: {                                                           // Required, music info, see: ###With playlist
            title: context.content.title,                                  // Required, music title
            author: context.content.name,                                  // Required, music author
            url: context.content.payload
        }
    });

    var isMobile = /mobile/i.test(window.navigator.userAgent);

    var x = 0;
    ap.on('play', function () {
        if (isMobile) {
            if ((navigator.userAgent.indexOf("Opera") || navigator.userAgent.indexOf('OPR')) != -1) {
                //do nothing already incresed from other module
            } else {
                if (x === 0) {
                    increaseOne();
                }
            }

        }
    });

    ap.on('pause', function () {
        if (isMobile) {
            x = 1;
            console.log('pause');
        }

    });

    var imgMain = $('.img-circular');
    var imgPc = '';
    for (var i = 0; i < imgMain.length; i++) {
        imgPc = context.content.banner === null ? [] : context.content.banner;
        imgMain[i].style.backgroundImage = (imgPc.length) ? 'url(' + imgPc + ')' : 'url(' + urls.avtar + ')';
    }

    //setting voke background image
    var imgMainBannerOtherVokes = $('.imageDiv');//banner is profile image and img is voke image
    var bannerImg = urls.vokeImg;
    imgBc = context.content.img === null ? [] : context.content.img;
    imgMainBannerOtherVokes[0].style.backgroundImage = (imgBc.length) ? "url(" + imgBc + ")" : "url(" + bannerImg + ")";
    for (i = 0; i < moreV.length; i++) {
        imgBc = moreV[i].img === null ? [] : moreV[i].img;
        imgMainBannerOtherVokes[i + 1].style.backgroundImage = (imgBc.length) ? "url(" + imgBc + ")" : "url(" + bannerImg + ")";
    }

    var imgUserComments = $('.img-circular-2');
    var comments = context.comments === undefined ? [] : context.comments;
    var cm = '';
    for (i = 0; i < comments.length; i++) {
        cm = comments[i].profile_image;
        if (!cm) {
            cm = comments[i].banner === null ? [] : comments[i].banner;
        }

        imgUserComments[i].style.backgroundImage = (cm.length) ? 'url(' + cm + ')' : 'url(' + urls.avtar + ')';
    }

    var imgSuggestions = $('.img-circular-suggestions');
    var suggestions = context.suggestions === undefined ? [] : context.suggestions;
    var sg = '';
    for (i = 0; i < suggestions.length; i++) {
        sg = suggestions[i].img === null ? [] : suggestions[i].img;
        imgSuggestions[i].style.backgroundImage = (sg.length) ? 'url(' + sg + ')' : 'url(' + urls.avtar + ')';
    }
    try {
        if (context.content.no_of_comments < 3) {
            $('.baseBoxLoadMore').hide();
        } else {
            $('.baseBoxLoadMore').show();
        }
    } catch (ex) {

    }
    if (context.content.name === null) {
        $('.listen-to-box').hide();
        $('.more-vokes-by').hide();
    }


    if (hideMoreVoke) {
        $('.baseBoxLoadMore').hide();
        ap.pause();
    } else {
        if (isMobile) {
            if ((navigator.userAgent.indexOf("Opera") || navigator.userAgent.indexOf('OPR')) != -1) {
                increaseOne();
            }
        }

        if (!isMobile) {
            increaseOne();
        }
    }

    function increaseOne() {
        var playurl = 'http://api.oktalk.com/web/channel/handle/' + handle + '/content/' + context.content.content_id + '/played';
        $.ajax({
            url: playurl,
            error: function (err) {
                console.log(err);
                return null;
            },
            success: function (data) {

            },
            type: 'PUT',
        });
        sendGA('Play voke', context.content.handle + '/' + universalData.content.title);
    }




    $("audio").on("play", function () {
        var _this = $(this);
        $("audio").each(function (i, el) {
            if (!$(el).is(_this))
                $(el).get(0).pause();
        });
    });

    // });
}
var universalData = '';
function getParameterByName(name, url) {
    if (!url) {
        url = window.location.href;
    }
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}


var handle = getParameterByName('hn');
var reference = getParameterByName('cn');

var urls = {
    realurl: '',
    requrl: '',
    origurl: '',
    twittertitle: '',
    title: '',
    glink: '',
    fburl: '',
    iosurl: '',
    handurl: '',
    playurl: '',
    vokeImg: 'http://getvokal.com/img/BG.png',
    avtar: 'img/Profile1x.png'
}

var refurl = 'http://api.oktalk.com/web/content/' + reference;

function doGetCall(url, isPause) {
    // url = "http://localhost:8080/ver3/channels/user/1/handle/vokalani/content/53cea730-b88d-11e6-9444-06385b7e79c1";
    $.ajax({
        url: url,
        error: function (err) {
            console.log(err);
            return null;
        },
        success: function (dataU) {
            doTemplating(dataU, isPause);
        },
        type: 'GET',
    });
}

function doTemplating(data, isPause) {
    if (data) {
        urls.title = data.content.title || 'Voke';
        urls.twittertitle = urls.title + ' by ' + handle;
        universalData = data;
        start(data, urls, isPause);
    } else {
        console.log('data unavailabe');
    }

}
function successContentId(data) {
    urls.realurl = 'https://api.oktalk.com/web2/channel/handle/' + handle + '/' + data.content_id;
    urls.requrl = 'http://api.oktalk.com/ver3/channels/user/1/handle/' + handle + '/content/' + data.content_id;
    urls.origurl = 'android-app://com.oktalk/http/vkl.fm/ch/' + handle + '/' + data.content_id;
    urls.glink = 'https://play.google.com/store/apps/details?id=com.oktalk.app&amp;referrer=utm_source%3DWebsite%26utm_campaign%3DContentPage%26utm_medium%3D' + handle + '%26utm_content%3D' + data.content_id;
    urls.iosurl = 'vokal://com.vokal/play?contentID=' + data.content_id;
    urls.fburl = 'http://getvokal.com/content.php?hn=' + handle + '&cn=' + data.content_id;
    urls.handurl = 'http://api.oktalk.com/web/channel/handle/' + handle;
    urls.playurl = 'http://api.oktalk.com/web/channel/handle/' + handle + '/content/' + data.content_id + '/played';
    doGetCall(urls.requrl, 0);
}
function startCall(refurl) {
    $.ajax({
        url: refurl,
        error: function (err) {
            console.log(err);
        },
        success: function (data) {
            successContentId(data)
        },
        type: 'GET',
    });
}
var playedItems = [];
startCall(refurl);
var updatePlay = function (content_id, isMoreVokes) {
    var id = universalData.moreVokes[content_id].content_id;
    if (playedItems.indexOf(content_id) === -1) {
        playedItems.push(content_id);
        var playurl = 'http://api.oktalk.com/web/channel/handle/' + handle + '/content/' + id + '/played';
        console.log(playurl);
        sendGA('Play voke', universalData.moreVokes[content_id].handle + '/' + universalData.moreVokes[content_id].title);
        $.ajax({
            url: playurl,
            error: function (err) {
                console.log(err);
                return null;
            },
            success: function (data) {
                // console.log('count updated');
                // console.log(data);
            },
            type: 'PUT',
        });
    }

}


var getMoreComments = function () {
    pauseAllAudios();

    var handle = getParameterByName('hn');
    var reference = getParameterByName('cn');
    doGetCall(urls.requrl + '?limit=100', 1);
}

function pauseAllAudios() {
    try {
        ap.pause();
        if (universalData.moreVokes) {
            for (var i = 0; i < universalData.moreVokes.length; i++) {
                console.log('content paused --');
                apv[i].pause();
                console.log('content paused');
            }
        }
    } catch (e) {
        console.log('erorr')
    }
}