function parallaxHeading() {
    var a = $(window).height(),
        b = $("body").scrollTop(),
        c = b / 1.5;
    b <= 1.25 * a && $("#heading video").velocity({
        top: c
    }, {
        duration: 10,
        easing: "linear",
        loop: !1
    })
}

function displayNoteStory() {
    var a = $("input[name=note]").val();
    if ("" !== a) {
        var b = $("life-note[data-note=" + a + "]").offset().top;
        $(window).scrollTop(b), $("life-note[data-note=" + a + "]").trigger("click")
    }
    var c = $("input[name=story]").val();
    "" !== c && $("life-story[data-story=" + c + "]").trigger("click")
}

function setExtrasHeight() {
    $("story-content h3 + div").each(function() {
        $(this).css("margin-bottom", "");
        var a = $(this).height();
        a = -Math.abs(a), $(this).css("margin-bottom", a).delay(800).queue(function(a) {
            $(this).removeClass("noTrans"), a()
        })
    })
}

function appendNote(a) {
    $("note-container").html(""), $("note-fill").css({
        top: "",
        left: ""
    }), $(".closeLifeOverlay").velocity({
        opacity: "1"
    }, {
        duration: 250,
        easing: "ease",
        loop: !1
    });
    var b = a.article;
    if ("" !== b) {
        var c = $("life-note[data-note=" + a.source + "]"),
            d = c.offset(),
            e = c.width(),
            f = c.outerHeight(),
            g = d.left + e / 2,
            h = d.top + f / 2;
        $("note-fill").stop().css({
            top: h,
            left: g
        }).addClass("animated"), $("note-container").stop().delay(500).queue(function(a) {
            $(this).append(b), $(this).show(), $("body").addClass("noScrollAlt"), a()
        }).delay(50).queue(function(a) {
            $(this).addClass("visible"), a()
        })
    }
}

function appendStory(a) {
    $("story-container").html(""), $(".closeLifeOverlay").addClass("dark").velocity({
        opacity: "1"
    }, {
        duration: 250,
        easing: "ease",
        loop: !1
    });
    var b = a.article;
    if ("" !== b) {
        var c = $("life-story[data-story=" + a.source + "]"),
            d = c.offset(),
            e = c.width(),
            f = c.outerHeight(),
            g = d.left + e / 2,
            h = d.top + f / 2;
        $("story-fill").css({
            top: h,
            left: g
        }).addClass("animated"), $("story-container").delay(500).queue(function(a) {
            $(this).append(b), $(this).show(), $("body").addClass("noScrollAlt"), a()
        }).delay(50).queue(function(a) {
            $(this).addClass("visible"), $(this).find("grid-row[data-count=1] > grid-column > *").removeClass("hidden"), a()
        }).queue(function(a) {
            $("story-fill").css({
                top: "",
                left: ""
            }).removeClass("animated"), a()
        })
    }
}
$(document).ready(function() {
    $("life-note, life-instagram, life-story, life-twitter").addClass("hidden")
}), $("story-container").scroll("life-story-full", function() {
    $(this).find("life-note, life-instagram, life-story, life-twitter").each(function() {
        $(this).is(":in-viewport") && $(this).removeClass("hidden")
    })
}), $("life-note").click(function(a) {
    a.preventDefault();
    var b = $(this).data("note"),
        c = $(this).data("url"),
        d = $(this).data("count"),
        e = {
            target: b,
            count: d
        };
    e = $(this).serialize() + "&" + $.param(e), $.ajax({
        type: "POST",
        dataType: "json",
        url: "load-note.php",
        data: e,
        success: function(a) {
            appendNote(a), window.history.pushState("", "Life", "https://bluestag.co.uk/life?note=" + c)
        },
        error: function(a, b, c) {
            console.log(c)
        }
    })
}), $("life-story").click(function(a) {
    a.preventDefault();
    var b = $(this).data("story"),
        c = $(this).data("url"),
        d = {
            target: b
        };
    d = $(this).serialize() + "&" + $.param(d), $.ajax({
        type: "POST",
        dataType: "json",
        url: "load-story.php",
        data: d,
        success: function(a) {
            appendStory(a), window.history.pushState("", "Life", "https://bluestag.co.uk/life?story=" + c)
        },
        error: function(a, b, c) {
            console.log(c)
        }
    })
}), $(".closeLifeOverlay").click(function() {
    window.history.pushState("", "Life", "https://bluestag.co.uk/life"), $("note-container").removeClass("visible").delay(500).queue(function(a) {
        $(this).fadeOut(350), $(".closeLifeOverlay").velocity({
            opacity: "0"
        }, {
            duration: 250,
            easing: "ease",
            loop: !1
        }), a()
    }).queue(function(a) {
        $(this).html("").stop(), $("body").removeClass("noScrollAlt"), a()
    }).delay(250).queue(function(a) {
        $("note-fill").removeClass("animated"), a()
    }), $("story-container").removeClass("visible").delay(500).queue(function(a) {
        $(this).fadeOut(350), $(".closeLifeOverlay").velocity({
            opacity: "0"
        }, {
            duration: 250,
            easing: "ease",
            loop: !1
        }), a()
    }).queue(function(a) {
        $(this).html("").stop(), $("body").removeClass("noScrollAlt"), $(".closeLifeOverlay").removeClass("dark"), a()
    })
}), $(window).load(function() {
    displayNoteStory(), setExtrasHeight(), autoplayVideos(), parallaxHeading(), $("loading-animation").hide(), $("life-note, life-instagram, life-story, life-twitter").each(function() {
        $(this).is(":in-viewport") && $(this).removeClass("hidden")
    })
}), $(window).resize(function() {
    setExtrasHeight(), autoplayVideos(), parallaxHeading()
}), $(window).scroll(function() {
    autoplayVideos(), parallaxHeading(), $("life-note, life-instagram, life-story, life-twitter").each(function() {
        $(this).is(":in-viewport") && $(this).removeClass("hidden")
    })
});

$(window).load(function() {
    $("life-instagram figure").each(function() {
        var imageURL = $(this).data("src");
        $(this).css("background", "url('" + imageURL + "') center no-repeat");
    })
});