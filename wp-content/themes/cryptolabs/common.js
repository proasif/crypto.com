function detectIE() {
    var a = window.navigator.userAgent,
        b = a.indexOf("MSIE ");
    if (b > 0) return parseInt(a.substring(b + 5, a.indexOf(".", b)), 10);
    var c = a.indexOf("Trident/");
    if (c > 0) {
        var d = a.indexOf("rv:");
        return parseInt(a.substring(d + 3, a.indexOf(".", d)), 10)
    }
    var e = a.indexOf("Edge/");
    return e > 0 && parseInt(a.substring(e + 5, a.indexOf(".", e)), 10)
}

function setNavigationHeight() {
    var a = $(window).width(),
        b = $(window).height();
    b -= a > 769 ? 60 : 40, $("header").css("height", b)
}

function setupVideos() {
    $(window).width() > 721 && ($("video source").each(function() {
        $(this).data("src") && ($(this).attr("src", $(this).data("src")), $(this).removeAttr("data-src"))
    }), $("video").each(function() {
        $(this).load();
        $(this)[0].play()
    }))
}

function animateBackground() {
    $("footer .clouds").velocity({
        backgroundPositionX: "10000%"
    }, {
        duration: 6e6,
        easing: "linear",
        loop: !0
    }), $("footer .background").velocity({
        backgroundPositionX: "10000%"
    }, {
        duration: 45e5,
        easing: "linear",
        loop: !0
    }), $("footer .foreground").velocity({
        backgroundPositionX: "10000%"
    }, {
        duration: 3e6,
        easing: "linear",
        loop: !0
    })
}

function footerParallax() {
    if ($(window).width() > 721) {
        var a = $(document).height(),
            b = $(window).height(),
            c = $("body").scrollTop(),
            d = a - 2 * b;
        if (c >= d) {
            var e = c + b - a,
                f = e / 2.2,
                g = e / 2,
                h = e / 4;
            $(".clouds").css({
                transform: "translate(0px, " + f + "px)"
            }), $(".background").css({
                transform: "translate(0px, " + g + "px)"
            }), $(".foreground").css({
                transform: "translate(0px, " + h + "px)"
            })
        } else $(".clouds").css({
            transform: ""
        }), $(".background").css({
            transform: ""
        }), $(".foreground").css({
            transform: ""
        })
    }
}

function autoplayVideos() {
    $(window).width() > 721 && $("video-wrapper.autoplay").each(function() {
        $(this).is(":in-viewport") ? $(this).find("video") && $(this).find("video").get(0).play() : $(this).find("video") && $(this).find("video").get(0).pause()
    })
}

function animateAboutMain() {
    var a = $(window).width();
    a > 720 ? $("#about").is(":in-viewport") && ($("#about .part1").velocity({
        top: 0
    }, {
        duration: 600,
        delay: 200,
        easing: "ease",
        loop: !1
    }), $("#about .part2").velocity({
        top: 0
    }, {
        duration: 600,
        delay: 400,
        easing: "ease",
        loop: !1
    }), $("#about .part3").velocity({
        top: 0
    }, {
        duration: 600,
        delay: 600,
        easing: "ease",
        loop: !1
    }), $("#about .part4").velocity({
        top: 0
    }, {
        duration: 600,
        delay: 800,
        easing: "ease",
        loop: !1
    }), $("#about .part5").velocity({
        top: 0
    }, {
        duration: 600,
        delay: 1e3,
        easing: "ease",
        loop: !1
    }), $("#about video-wrapper div").velocity({
        opacity: 0
    }, {
        duration: 800,
        delay: 0,
        easing: "ease",
        loop: !1
    }), $("#about video").velocity({
        opacity: 1
    }, {
        duration: 800,
        delay: 1200,
        easing: "ease",
        loop: !1
    }), $("#about .videoOverlay").velocity({
        opacity: 1
    }, {
        duration: 1e3,
        delay: 1800,
        easing: "ease",
        loop: !1
    })) : $("#about video").css("opacity", 1), $("#about").find("video").queue(function(a) {
        $(window).width() > 721 && $(this).get(0).play(), a()
    })
}

function animateAboutSS() {
    var a = $(window).width();
    a > 720 ? $("#about").is(":in-viewport") && ($("#about .part1").velocity({
        top: 0
    }, {
        duration: 200,
        delay: 200,
        easing: "ease",
        loop: !1
    }), $("#about .videoOverlay").velocity({
        opacity: 1
    }, {
        duration: 1e3,
        delay: 600,
        easing: "ease",
        loop: !1
    })) : $("#about video").css("opacity", 1), $("#about").find("video").queue(function(a) {
        $(window).width() > 721 && $(this).get(0).play(), a()
    })
}

function revealFooter() {
    $(window).width() > 721 ? $("footer").is(":in-viewport") && $("footer").addClass("visible") : $("footer").addClass("visible")
}

function runStagCam() {
    var a = $("input[name=sc]").val();
    1 == a && (stagParticles(), $(".stagCam").addClass("visible"))
}

function setupVideoFeed() {
    var a = new Date,
        b = a.getHours(),
        c = a.getMinutes();
    c < 10 && (c = "0" + c);
    var d = Math.floor(3 * Math.random()) + 1;
    b > 0 && b <= 6 && (videoFeed480 = "templates/blue_stag/video/stagCam/cam_night_" + d + "_480.mp4", videoFeed1080 = "templates/blue_stag/video/stagCam/cam_night_" + d + "_1080.mp4"), b > 6 && b <= 9 ? (videoFeed480 = "templates/blue_stag/video/stagCam/cam_morning_" + d + "_480.mp4", videoFeed1080 = "templates/blue_stag/video/stagCam/cam_morning_" + d + "_1080.mp4") : b > 9 && b <= 15 ? (videoFeed480 = "templates/blue_stag/video/stagCam/cam_midday_" + d + "_480.mp4", videoFeed1080 = "templates/blue_stag/video/stagCam/cam_midday_" + d + "_1080.mp4") : b > 15 && b <= 17 ? (videoFeed480 = "templates/blue_stag/video/stagCam/cam_evening_" + d + "_480.mp4", videoFeed1080 = "templates/blue_stag/video/stagCam/cam_evening_" + d + "_1080.mp4") : b > 17 && (videoFeed480 = "templates/blue_stag/video/stagCam/cam_night_" + d + "_480.mp4", videoFeed1080 = "templates/blue_stag/video/stagCam/cam_night_" + d + "_1080.mp4"), $(window).width() > 820 ? $("#videoSource").attr("src", videoFeed1080) : $("#videoSource").attr("src", videoFeed480);
    var e = $("#videoFeed");
    e.load(), $("#videoFeed")[0].play()
}

function stagParticles() {
    particlesJS("cam", {
        particles: {
            number: {
                value: 180,
                density: {
                    enable: !0,
                    value_area: 800
                }
            },
            color: {
                value: "#ffffff"
            },
            shape: {
                type: "circle",
                stroke: {
                    width: 0,
                    color: "#000000"
                },
                polygon: {
                    nb_sides: 5
                },
                image: {
                    src: "img/github.svg",
                    width: 100,
                    height: 100
                }
            },
            opacity: {
                value: .5,
                random: !0,
                anim: {
                    enable: !0,
                    speed: 1,
                    opacity_min: .1,
                    sync: !1
                }
            },
            size: {
                value: 3,
                random: !0,
                anim: {
                    enable: !1,
                    speed: 40,
                    size_min: .1,
                    sync: !1
                }
            },
            line_linked: {
                enable: !1,
                distance: 150,
                color: "#ffffff",
                opacity: .4,
                width: 1
            },
            move: {
                enable: !0,
                speed: 50,
                direction: "right",
                random: !0,
                straight: !1,
                out_mode: "out",
                bounce: !1,
                attract: {
                    enable: !0,
                    rotateX: 600,
                    rotateY: 1200
                }
            }
        },
        interactivity: {
            detect_on: "canvas",
            events: {
                onhover: {
                    enable: !1,
                    mode: "repulse"
                },
                onclick: {
                    enable: !1,
                    mode: "push"
                },
                resize: !0
            },
            modes: {
                grab: {
                    distance: 400,
                    line_linked: {
                        opacity: 1
                    }
                },
                bubble: {
                    distance: 400,
                    size: 40,
                    duration: 2,
                    opacity: 8,
                    speed: 3
                },
                repulse: {
                    distance: 200,
                    duration: .4
                },
                push: {
                    particles_nb: 4
                },
                remove: {
                    particles_nb: 2
                }
            }
        },
        retina_detect: !0
    })
}
if ($(window).width() > 720) {
    setInterval(function() {
        var a = new Date,
            b = a.getDay(),
            c = a.getDate(),
            d = a.getMonth(),
            e = a.getFullYear(),
            f = a.getHours(),
            g = a.getMinutes();
        g < 10 && (g = "0" + g);
        var h = a.getTimezoneOffset();
        h = Math.abs(h / 60);
        var i = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
            j = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        $(".dotw").text(i[b]), $(".day").text(c), $(".month").text(j[d]), $(".year").text(e), $(".hours").text(f), $(".minutes").text(g), $(".offset").text("GMT+" + h)
    }, 1e3), $("footer .stag").click(function() {
        stagParticles();
        var a = window.location.href;
        window.history.pushState("", "Blue Stag", a + "?stagcam"), $("footer .poof").addClass("go").delay(800).queue(function(a) {
            $("footer .poof").removeClass("go"), a()
        }), $(this).addClass("offRight").delay(1500).queue(function(a) {
            $(this).removeClass("offRight"), $(this).addClass("offLeft"), a()
        }), $(".stagCam").addClass("visible")
    }), $(".stagCam .message a").click(function() {
        $(".stagCam").addClass("play"), $("#cam video").animate({
            volume: 1
        }, 1e3), setupVideoFeed()
    }), $(".closeVideo").click(function() {
        var a = window.location.href,
            a = a.replace("?stagcam", "");
        window.history.pushState("", "Blue Stag", a), $(".stagCam").removeClass("play"), $(".stagCam").removeClass("visible"), $("footer .stag").removeClass("offLeft"), $("video").animate({
            volume: 0
        }, 1e3), $("#videoFeed")[0].pause()
    }), setInterval(function() {
        $(".live").toggleClass("v")
    }, 1e3);
    var audio = 1;
    $("#toggleAudio").click(function() {
        1 == audio ? ($("#state1").attr("class", "hidden"), $("#state2").attr("class", "visible"), $("video").animate({
            volume: 0
        }, 1e3), audio = 0) : ($("#state1").attr("class", "visible"), $("#state2").attr("class", "hidden"), $("#cam video").animate({
            volume: 1
        }, 1e3), audio = 1)
    }), $(".soundOn").click(function() {
        $(".soundOn").attr("class", "soundOn active"), $(".soundOff").attr("class", "soundOff"), $("#cam video").animate({
            volume: 1
        }, 1e3)
    })
}
var version = detectIE();
version === !1 || (version >= 12 ? $("body").addClass("edge") : $("body").addClass("ie" + version)), $(window).load(function() {
    var a = $(window).width();
    a += 250, $(".loading img").delay(1e3).queue(function(b) {
        $(this).velocity({
            left: a
        }, {
            duration: 1500,
            easing: "ease",
            loop: !1
        }), b()
    }).queue(function(a) {
        $(".loading").addClass("hidden"), a()
    })
}), $(window).scroll(function() {
    $("#heading grid-container").css("opacity", 1 - $(window).scrollTop() / 500)
}), $(".navTrigger").click(function() {
    $("body").toggleClass("noScroll"), $("header").toggleClass("expanded")
}), $("share-icon").click(function(a) {
    a.preventDefault(), $(this).toggleClass("active")
}), $("a:not(.fancybox)").click(function(a) {
    var b = $(this).attr("href");
    if (a.preventDefault(), b)
        if ("_blank" == $(this).attr("target")) {
            var c = window.open(b, "_blank");
            c ? c.focus() : alert("Your browser is preventing this link from opening. Please allow popups to view this link")
        } else b.search("tel:") > -1 || b.search("mailto:") > -1 ? window.location.href = b : $("loading-mask").addClass("animated").delay(750).queue(function(a) {
            window.location.href = b, a()
        })
}), $("#mainNavigation a").hover(function() {
    if ($(window).width() > 720) {
        var a = $(this).data("section");
        $("ul.images ." + a).stop().css("opacity", .25)
    }
}, function() {
    if ($(window).width() > 720) {
        var a = $(this).data("section");
        $("ul.images ." + a).stop().css("opacity", 0)
    }
}), $("#subscribe form input").focus(function() {
    $(this).addClass("focus")
}), $("#subscribe form input").blur(function() {
    "" !== $(this).val() ? $(this).addClass("focus") : $(this).removeClass("focus")
}), window.setInterval(function() {
    if ($(window).width() > 721) {
        var a = Math.ceil(2 * Math.random());
        $("footer .stag img.quote#q-" + a).addClass("visible"), $("footer .stag img.quote").delay(3e3).queue(function(a) {
            $("footer .stag img.quote").removeClass("visible"), a()
        })
    }
}, 1e4), $(window).scroll(function() {
    var a = $(window).scrollTop(),
        b = $(window).height(),
        c = $(".scrollIndicator").height(),
        d = a / 10 - c / 2 + 1;
    a <= b && $(".scrollIndicator").css("transform", "translateX(-50%) translateY(" + d + "px)")
}), $(document).ready(function() {
    $("body").removeClass("noJS")
}), $(window).load(function() {
    setupVideos(), $("share-icon").addClass("visible"), animateBackground(), revealFooter(), runStagCam(), setNavigationHeight(), $("loading-mask").removeClass("animated")
}), $(window).resize(function() {
    setNavigationHeight()
}), $(window).scroll(function() {
    revealFooter()
});