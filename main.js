$(document).ready(function () {
    // var isMobile = _isMobile();
    

//      
//    audiojs.events.ready(function() {
//        var as = audiojs.createAll();
//    });
    
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
            console.log('mobile is ios');
            $('#android').hide();
            $('#apple').show();

        }
        if (isMobile.Android()) {
            console.log('mobile is android');
            $('#apple').hide();
            $('#android').show();
        }
    } else {
        console.log('user is using Desktop');
        $('#android').show();
        $('#apple').show();
    }

});