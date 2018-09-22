function slideshowParallax() {
    if ($(window).width() > 721) {
        var a = $(window).height(),
            b = $("body").scrollTop(),
            c = b / 1.5;
        b <= 1.25 * a && $("#landingArea video, #landingArea figure").css("transform", "translateX(-50%) translateY(" + c + "px) translate3d(0,0,0)")
    }
}

function setContentHeight() {
    $("project-wrapper").each(function() {
        var a = $(this).find("h3").css("margin-bottom"),
            b = $(this).find("project-details").outerHeight(),
            c = parseInt(b) + parseInt(a);
        c = -Math.abs(c), $(this).find("project-details").css("margin-bottom", c)
    })
}

function revealContent() {
    $("#introduction").is(":in-viewport") && $("#introduction").removeClass("hidden"), $("#projects .project").each(function() {
        $(this).is(":in-viewport") && $(this).removeClass("hidden")
    }), $("#about > grid-container").is(":in-viewport") && $("#about > grid-container").removeClass("hidden"), $("#photos img").each(function() {
        $(this).is(":in-viewport") && $(this).removeClass("hidden")
    }), $("#articles .article").each(function() {
        $(this).is(":in-viewport") && $(this).removeClass("hidden")
    }), $("#subscribe").is(":in-viewport") && $("#subscribe").removeClass("hidden")
}

function wheel(a) {
    var b = 0;
    a.wheelDelta ? b = a.wheelDelta / 120 : a.detail && (b = -a.detail / 3), handle(b), a.preventDefault && a.preventDefault(), a.returnValue = !1
}

function handle(a) {
    var b = 15,
        c = 15;
    null == end && (end = $(window).scrollTop()), end -= 70 * a, goUp = a > 0, null == interval && (interval = setInterval(function() {
        var a = $(window).scrollTop(),
            b = Math.round((end - a) / c);
        (a <= 0 || a >= $(window).prop("scrollHeight") - $(window).height() || goUp && b > -1 || !goUp && b < 1) && (clearInterval(interval), interval = null, end = null), $(window).scrollTop(a + b)
    }, b))
}
