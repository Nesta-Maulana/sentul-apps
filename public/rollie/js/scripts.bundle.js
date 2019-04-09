var mApp = function() {
    var t = {
            brand: "#716aca",
            metal: "#c4c5d6",
            light: "#ffffff",
            accent: "#00c5dc",
            primary: "#5867dd",
            success: "#34bfa3",
            info: "#36a3f7",
            warning: "#ffb822",
            danger: "#f4516c",
            focus: "#9816f4"
        },
        a = function(e) {
            var t = e.data("skin") ? "m-tooltip--skin-" + e.data("skin") : "",
                a = "auto" == e.data("width") ? "m-tooltop--auto-width" : "",
                n = e.data("trigger") ? e.data("trigger") : "hover";
            e.tooltip({
                trigger: n,
                template: '<div class="m-tooltip ' + t + " " + a + ' tooltip" role="tooltip">                <div class="arrow"></div>                <div class="tooltip-inner"></div>            </div>'
            })
        },
        e = function() {
            $('[data-toggle="m-tooltip"]').each(function() {
                a($(this))
            })
        },
        n = function(e) {
            var t = e.data("skin") ? "m-popover--skin-" + e.data("skin") : "",
                a = e.data("trigger") ? e.data("trigger") : "hover";
            e.popover({
                trigger: a,
                template: '            <div class="m-popover ' + t + ' popover" role="tooltip">                <div class="arrow"></div>                <h3 class="popover-header"></h3>                <div class="popover-body"></div>            </div>'
            })
        },
        o = function() {
            $('[data-toggle="m-popover"]').each(function() {
                n($(this))
            })
        },
        i = function(e, t) {
            e = $(e), new mPortlet(e[0], t)
        },
        l = function() {
            $('[m-portlet="true"]').each(function() {
                var e = $(this);
                !0 !== e.data("portlet-initialized") && (i(e, {}), e.data("portlet-initialized", !0))
            })
        },
        r = function() {
            $("[data-tab-target]").each(function() {
                1 != $(this).data("tabs-initialized") && ($(this).click(function(e) {
                    e.preventDefault();
                    var t = $(this),
                        a = t.closest('[data-tabs="true"]'),
                        n = $(a.data("tabs-contents")),
                        o = $(t.data("tab-target"));
                    a.find(".m-tabs__item.m-tabs__item--active").removeClass("m-tabs__item--active"), t.addClass("m-tabs__item--active"), n.find(".m-tabs-content__item.m-tabs-content__item--active").removeClass("m-tabs-content__item--active"), o.addClass("m-tabs-content__item--active")
                }), $(this).data("tabs-initialized", !0))
            })
        };
    return {
        init: function(e) {
            e && e.colors && (t = e.colors), mApp.initComponents()
        },
        initComponents: function() {
            jQuery.event.special.touchstart = {
                setup: function(e, t, a) {
                    "function" == typeof this && (t.includes("noPreventDefault") ? this.addEventListener("touchstart", a, {
                        passive: !1
                    }) : this.addEventListener("touchstart", a, {
                        passive: !0
                    }))
                }
            }, jQuery.event.special.touchmove = {
                setup: function(e, t, a) {
                    "function" == typeof this && (t.includes("noPreventDefault") ? this.addEventListener("touchmove", a, {
                        passive: !1
                    }) : this.addEventListener("touchmove", a, {
                        passive: !0
                    }))
                }
            }, jQuery.event.special.wheel = {
                setup: function(e, t, a) {
                    "function" == typeof this && (t.includes("noPreventDefault") ? this.addEventListener("wheel", a, {
                        passive: !1
                    }) : this.addEventListener("wheel", a, {
                        passive: !0
                    }))
                }
            }, $('[data-scrollable="true"]').each(function() {
                var e, t, a = $(this);
                mUtil.isInResponsiveRange("tablet-and-mobile") ? (e = a.data("mobile-max-height") ? a.data("mobile-max-height") : a.data("max-height"), t = a.data("mobile-height") ? a.data("mobile-height") : a.data("height")) : (e = a.data("max-height"), t = a.data("max-height")), e && a.css("max-height", e), t && a.css("height", t), mApp.initScroller(a, {})
            }), e(), o(), $("body").on("click", "[data-close=alert]", function() {
                $(this).closest(".alert").hide()
            }), l(), $(".custom-file-input").on("change", function() {
                var e = $(this).val();
                $(this).next(".custom-file-label").addClass("selected").html(e)
            }), r()
        },
        initCustomTabs: function() {
            r()
        },
        initTooltips: function() {
            e()
        },
        initTooltip: function(e) {
            a(e)
        },
        initPopovers: function() {
            o()
        },
        initPopover: function(e) {
            n(e)
        },
        initPortlet: function(e, t) {
            i(e, t)
        },
        initPortlets: function() {
            l()
        },
        scrollTo: function(e, t) {
            el = $(e);
            var a = el && 0 < el.length ? el.offset().top : 0;
            a += t || 0, jQuery("html,body").animate({
                scrollTop: a
            }, "slow")
        },
        scrollToViewport: function(e) {
            var t = $(e).offset().top,
                a = e.height(),
                n = t - (mUtil.getViewPort().height / 2 - a / 2);
            jQuery("html,body").animate({
                scrollTop: n
            }, "slow")
        },
        scrollTop: function() {
            mApp.scrollTo()
        },
        initScroller: function(e, t, a) {
            mUtil.isMobileDevice() ? e.css("overflow", "auto") : (!0 !== a && mApp.destroyScroller(e), e.mCustomScrollbar({
                scrollInertia: 0,
                autoDraggerLength: !0,
                autoHideScrollbar: !0,
                autoExpandScrollbar: !1,
                alwaysShowScrollbar: 0,
                axis: e.data("axis") ? e.data("axis") : "y",
                mouseWheel: {
                    scrollAmount: 120,
                    preventDefault: !0
                },
                setHeight: t.height ? t.height : "",
                theme: "minimal-dark"
            }))
        },
        destroyScroller: function(e) {
            e.mCustomScrollbar("destroy"), e.removeClass("mCS_destroyed")
        },
        alert: function(e) {
            e = $.extend(!0, {
                container: "",
                place: "append",
                type: "success",
                message: "",
                close: !0,
                reset: !0,
                focus: !0,
                closeInSeconds: 0,
                icon: ""
            }, e);
            var t = mUtil.getUniqueID("App_alert"),
                a = '<div id="' + t + '" class="custom-alerts alert alert-' + e.type + ' fade in">' + (e.close ? '<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>' : "") + ("" !== e.icon ? '<i class="fa-lg fa fa-' + e.icon + '"></i>  ' : "") + e.message + "</div>";
            return e.reset && $(".custom-alerts").remove(), e.container ? "append" == e.place ? $(e.container).append(a) : $(e.container).prepend(a) : 1 === $(".page-fixed-main-content").size() ? $(".page-fixed-main-content").prepend(a) : ($("body").hasClass("page-container-bg-solid") || $("body").hasClass("page-content-white")) && 0 === $(".page-head").size() ? $(".page-title").after(a) : 0 < $(".page-bar").size() ? $(".page-bar").after(a) : $(".page-breadcrumb, .breadcrumbs").after(a), e.focus && mApp.scrollTo($("#" + t)), 0 < e.closeInSeconds && setTimeout(function() {
                $("#" + t).remove()
            }, 1e3 * e.closeInSeconds), t
        },
        block: function(e, t) {
            var a, n, o, i = $(e);
            if ("spinner" == (t = $.extend(!0, {
                    opacity: .03,
                    overlayColor: "#000000",
                    state: "brand",
                    type: "loader",
                    size: "lg",
                    centerX: !0,
                    centerY: !0,
                    message: "",
                    shadow: !0,
                    width: "auto"
                }, t)).type ? o = '<div class="m-spinner ' + (a = t.skin ? "m-spinner--skin-" + t.skin : "") + " " + (n = t.state ? "m-spinner--" + t.state : "") + '"></div' : (a = t.skin ? "m-loader--skin-" + t.skin : "", n = t.state ? "m-loader--" + t.state : "", size = t.size ? "m-loader--" + t.size : "", o = '<div class="m-loader ' + a + " " + n + " " + size + '"></div'), t.message && 0 < t.message.length) {
                var l = "m-blockui " + (!1 === t.shadow ? "m-blockui-no-shadow" : "");
                html = '<div class="' + l + '"><span>' + t.message + "</span><span>" + o + "</span></div>";
                i = document.createElement("div");
                mUtil.get("body").prepend(i), mUtil.addClass(i, l), i.innerHTML = "<span>" + t.message + "</span><span>" + o + "</span>", t.width = mUtil.actualWidth(i) + 10, mUtil.remove(i), "body" == e && (html = '<div class="' + l + '" style="margin-left:-' + t.width / 2 + 'px;"><span>' + t.message + "</span><span>" + o + "</span></div>")
            } else html = o;
            var r = {
                message: html,
                centerY: t.centerY,
                centerX: t.centerX,
                css: {
                    top: "30%",
                    left: "50%",
                    border: "0",
                    padding: "0",
                    backgroundColor: "none",
                    width: t.width
                },
                overlayCSS: {
                    backgroundColor: t.overlayColor,
                    opacity: t.opacity,
                    cursor: "wait",
                    zIndex: "10"
                },
                onUnblock: function() {
                    i && (i.css("position", ""), i.css("zoom", ""))
                }
            };
            "body" == e ? (r.css.top = "50%", $.blockUI(r)) : (i = $(e)).block(r)
        },
        unblock: function(e) {
            e && "body" != e ? $(e).unblock() : $.unblockUI()
        },
        blockPage: function(e) {
            return mApp.block("body", e)
        },
        unblockPage: function() {
            return mApp.unblock("body")
        },
        progress: function(e, t) {
            var a = "m-loader m-loader--" + (t && t.skin ? t.skin : "light") + " m-loader--" + (t && t.alignment ? t.alignment : "right") + " m-loader--" + (t && t.size ? "m-spinner--" + t.size : "");
            mApp.unprogress(e), $(e).addClass(a), $(e).data("progress-classes", a)
        },
        unprogress: function(e) {
            $(e).removeClass($(e).data("progress-classes"))
        },
        getColor: function(e) {
            return t[e]
        }
    }
}();
$(document).ready(function() {
        mApp.init({})
    }), this.Element && function(e) {
        e.matches = e.matches || e.matchesSelector || e.webkitMatchesSelector || e.msMatchesSelector || function(e) {
            for (var t = (this.parentNode || this.document).querySelectorAll(e), a = -1; t[++a] && t[a] != this;);
            return !!t[a]
        }
    }(Element.prototype), this.Element && function(e) {
        e.closest = e.closest || function(e) {
            for (var t = this; t.matches && !t.matches(e);) t = t.parentNode;
            return t.matches ? t : null
        }
    }(Element.prototype), this.Element && function(e) {
        e.matches = e.matches || e.matchesSelector || e.webkitMatchesSelector || e.msMatchesSelector || function(e) {
            for (var t = (this.parentNode || this.document).querySelectorAll(e), a = -1; t[++a] && t[a] != this;);
            return !!t[a]
        }
    }(Element.prototype),
    function() {
        for (var o = 0, e = ["webkit", "moz"], t = 0; t < e.length && !window.requestAnimationFrame; ++t) window.requestAnimationFrame = window[e[t] + "RequestAnimationFrame"], window.cancelAnimationFrame = window[e[t] + "CancelAnimationFrame"] || window[e[t] + "CancelRequestAnimationFrame"];
        window.requestAnimationFrame || (window.requestAnimationFrame = function(e) {
            var t = (new Date).getTime(),
                a = Math.max(0, 16 - (t - o)),
                n = window.setTimeout(function() {
                    e(t + a)
                }, a);
            return o = t + a, n
        }), window.cancelAnimationFrame || (window.cancelAnimationFrame = function(e) {
            clearTimeout(e)
        })
    }(), [Element.prototype, Document.prototype, DocumentFragment.prototype].forEach(function(e) {
        e.hasOwnProperty("prepend") || Object.defineProperty(e, "prepend", {
            configurable: !0,
            enumerable: !0,
            writable: !0,
            value: function() {
                var e = Array.prototype.slice.call(arguments),
                    a = document.createDocumentFragment();
                e.forEach(function(e) {
                    var t = e instanceof Node;
                    a.appendChild(t ? e : document.createTextNode(String(e)))
                }), this.insertBefore(a, this.firstChild)
            }
        })
    }), window.mUtilElementDataStore = {}, window.mUtilElementDataStoreID = 0, window.mUtilDelegatedEventHandlers = {}, window.noZensmooth = !0;
var mUtil = function() {
    var t = [],
        a = {
            sm: 544,
            md: 768,
            lg: 1024,
            xl: 1200
        },
        n = function() {
            var e = !1;
            window.addEventListener("resize", function() {
                clearTimeout(e), e = setTimeout(function() {
                    ! function() {
                        for (var e = 0; e < t.length; e++) t[e].call()
                    }()
                }, 250)
            })
        };
    return {
        init: function(e) {
            e && e.breakpoints && (a = e.breakpoints), n()
        },
        addResizeHandler: function(e) {
            t.push(e)
        },
        runResizeHandlers: function() {
            _runResizeHandlers()
        },
        getURLParam: function(e) {
            var t, a, n = window.location.search.substring(1).split("&");
            for (t = 0; t < n.length; t++)
                if ((a = n[t].split("="))[0] == e) return unescape(a[1]);
            return null
        },
        isMobileDevice: function() {
            return this.getViewPort().width < this.getBreakpoint("lg")
        },
        isDesktopDevice: function() {
            return !mUtil.isMobileDevice()
        },
        getViewPort: function() {
            var e = window,
                t = "inner";
            return "innerWidth" in window || (t = "client", e = document.documentElement || document.body), {
                width: e[t + "Width"],
                height: e[t + "Height"]
            }
        },
        isInResponsiveRange: function(e) {
            var t = this.getViewPort().width;
            return "general" == e || ("desktop" == e && t >= this.getBreakpoint("lg") + 1 || ("tablet" == e && t >= this.getBreakpoint("md") + 1 && t < this.getBreakpoint("lg") || ("mobile" == e && t <= this.getBreakpoint("md") || ("desktop-and-tablet" == e && t >= this.getBreakpoint("md") + 1 || ("tablet-and-mobile" == e && t <= this.getBreakpoint("lg") || "minimal-desktop-and-below" == e && t <= this.getBreakpoint("xl"))))))
        },
        getUniqueID: function(e) {
            return e + Math.floor(Math.random() * (new Date).getTime())
        },
        getBreakpoint: function(e) {
            return a[e]
        },
        isset: function(e, t) {
            var a;
            if (-1 !== (t = t || "").indexOf("[")) throw new Error("Unsupported object path notation.");
            t = t.split(".");
            do {
                if (void 0 === e) return !1;
                if (a = t.shift(), !e.hasOwnProperty(a)) return !1;
                e = e[a]
            } while (t.length);
            return !0
        },
        getHighestZindex: function(e) {
            for (var t, a, n = mUtil.get(e); n && n !== document;) {
                if (("absolute" === (t = mUtil.css(n, "position")) || "relative" === t || "fixed" === t) && (a = parseInt(mUtil.css(n, "z-index")), !isNaN(a) && 0 !== a)) return a;
                n = n.parentNode
            }
            return null
        },
        hasFixedPositionedParent: function(e) {
            for (; e && e !== document;) {
                if (position = mUtil.css(e, "position"), "fixed" === position) return !0;
                e = e.parentNode
            }
            return !1
        },
        sleep: function(e) {
            for (var t = (new Date).getTime(), a = 0; a < 1e7 && !((new Date).getTime() - t > e); a++);
        },
        getRandomInt: function(e, t) {
            return Math.floor(Math.random() * (t - e + 1)) + e
        },
        isAngularVersion: function() {
            return void 0 !== window.Zone
        },
        deepExtend: function(e) {
            e = e || {};
            for (var t = 1; t < arguments.length; t++) {
                var a = arguments[t];
                if (a)
                    for (var n in a) a.hasOwnProperty(n) && ("object" == typeof a[n] ? e[n] = mUtil.deepExtend(e[n], a[n]) : e[n] = a[n])
            }
            return e
        },
        extend: function(e) {
            e = e || {};
            for (var t = 1; t < arguments.length; t++)
                if (arguments[t])
                    for (var a in arguments[t]) arguments[t].hasOwnProperty(a) && (e[a] = arguments[t][a]);
            return e
        },
        get: function(e) {
            var t;
            return e === document ? document : e && 1 === e.nodeType ? e : (t = document.getElementById(e)) ? t : (t = document.getElementsByTagName(e)) ? t[0] : (t = document.getElementsByClassName(e)) ? t[0] : null
        },
        hasClasses: function(e, t) {
            if (e) {
                for (var a = t.split(" "), n = 0; n < a.length; n++)
                    if (0 == mUtil.hasClass(e, mUtil.trim(a[n]))) return !1;
                return !0
            }
        },
        hasClass: function(e, t) {
            if (e) return e.classList ? e.classList.contains(t) : new RegExp("\\b" + t + "\\b").test(e.className)
        },
        addClass: function(e, t) {
            if (e && void 0 !== t) {
                var a = t.split(" ");
                if (e.classList)
                    for (var n = 0; n < a.length; n++) a[n] && 0 < a[n].length && e.classList.add(mUtil.trim(a[n]));
                else if (!mUtil.hasClass(e, t))
                    for (n = 0; n < a.length; n++) e.className += " " + mUtil.trim(a[n])
            }
        },
        removeClass: function(e, t) {
            if (e) {
                var a = t.split(" ");
                if (e.classList)
                    for (var n = 0; n < a.length; n++) e.classList.remove(mUtil.trim(a[n]));
                else if (mUtil.hasClass(e, t))
                    for (n = 0; n < a.length; n++) e.className = e.className.replace(new RegExp("\\b" + mUtil.trim(a[n]) + "\\b", "g"), "")
            }
        },
        triggerCustomEvent: function(e, t, a) {
            if (window.CustomEvent) var n = new CustomEvent(t, {
                detail: a
            });
            else(n = document.createEvent("CustomEvent")).initCustomEvent(t, !0, !0, a);
            e.dispatchEvent(n)
        },
        trim: function(e) {
            return e.trim()
        },
        eventTriggered: function(e) {
            return !!e.currentTarget.dataset.triggered || !(e.currentTarget.dataset.triggered = !0)
        },
        remove: function(e) {
            e && e.parentNode && e.parentNode.removeChild(e)
        },
        find: function(e, t) {
            return e.querySelector(t)
        },
        findAll: function(e, t) {
            return e.querySelectorAll(t)
        },
        insertAfter: function(e, t) {
            return t.parentNode.insertBefore(e, t.nextSibling)
        },
        parents: function(e, t) {
            function o(e, t) {
                for (var a = 0, n = e.length; a < n; a++)
                    if (e[a] == t) return !0;
                return !1
            }
            return function(e, t) {
                for (var a = document.querySelectorAll(t), n = e.parentNode; n && !o(a, n);) n = n.parentNode;
                return n
            }(e, t)
        },
        children: function(e, t, a) {
            if (e && e.childNodes) {
                for (var n = [], o = 0, i = e.childNodes.length; o < i; ++o) 1 == e.childNodes[o].nodeType && mUtil.matches(e.childNodes[o], t, a) && n.push(e.childNodes[o]);
                return n
            }
        },
        child: function(e, t, a) {
            var n = mUtil.children(e, t, a);
            return n ? n[0] : null
        },
        matches: function(e, t, a) {
            var n = Element.prototype,
                o = n.matches || n.webkitMatchesSelector || n.mozMatchesSelector || n.msMatchesSelector || function(e) {
                    return -1 !== [].indexOf.call(document.querySelectorAll(e), this)
                };
            return !(!e || !e.tagName) && o.call(e, t)
        },
        data: function(a) {
            return a = mUtil.get(a), {
                set: function(e, t) {
                    void 0 === a.customDataTag && (mUtilElementDataStoreID++, a.customDataTag = mUtilElementDataStoreID), void 0 === mUtilElementDataStore[a.customDataTag] && (mUtilElementDataStore[a.customDataTag] = {}), mUtilElementDataStore[a.customDataTag][e] = t
                },
                get: function(e) {
                    return this.has(e) ? mUtilElementDataStore[a.customDataTag][e] : null
                },
                has: function(e) {
                    return !(!mUtilElementDataStore[a.customDataTag] || !mUtilElementDataStore[a.customDataTag][e])
                },
                remove: function(e) {
                    this.has(e) && delete mUtilElementDataStore[a.customDataTag][e]
                }
            }
        },
        outerWidth: function(e, t) {
            if (!0 === t) {
                var a = parseFloat(e.offsetWidth);
                return a += parseFloat(mUtil.css(e, "margin-left")) + parseFloat(mUtil.css(e, "margin-right")), parseFloat(a)
            }
            return a = parseFloat(e.offsetWidth)
        },
        offset: function(e) {
            var t = e.getBoundingClientRect();
            return {
                top: t.top + document.body.scrollTop,
                left: t.left + document.body.scrollLeft
            }
        },
        height: function(e) {
            return mUtil.css(e, "height")
        },
        visible: function(e) {
            return !(0 === e.offsetWidth && 0 === e.offsetHeight)
        },
        attr: function(e, t, a) {
            if (null != (e = mUtil.get(e))) return void 0 === a ? e.getAttribute(t) : void e.setAttribute(t, a)
        },
        hasAttr: function(e, t) {
            if (null != (e = mUtil.get(e))) return !!e.getAttribute(t)
        },
        removeAttr: function(e, t) {
            null != (e = mUtil.get(e)) && e.removeAttribute(t)
        },
        animate: function(n, o, i, l, r, s) {
            var e = {
                linear: function(e, t, a, n) {
                    return a * e / n + t
                }
            };
            if ("number" == typeof n && "number" == typeof o && "number" == typeof i && "function" == typeof l) {
                "string" == typeof r && e[r] && (r = e[r]), "function" != typeof r && (r = e.linear), "function" != typeof s && (s = function() {});
                var d = window.requestAnimationFrame || function(e) {
                        window.setTimeout(e, 1e3 / 60)
                    },
                    c = o - n;
                l(n);
                var m = window.performance && window.performance.now ? window.performance.now() : +new Date;
                d(function e(t) {
                    var a = (t || +new Date) - m;
                    0 <= a && l(r(a, n, c, i)), 0 <= a && i <= a ? (l(o), s()) : d(e)
                })
            }
        },
        actualCss: function(e, t, a) {
            var n;
            if (e instanceof HTMLElement != !1) return e.getAttribute("m-hidden-" + t) && !1 !== a ? parseFloat(e.getAttribute("m-hidden-" + t)) : (e.style.cssText = "position: absolute; visibility: hidden; display: block;", "width" == t ? n = e.offsetWidth : "height" == t && (n = e.offsetHeight), e.style.cssText = "", e.setAttribute("m-hidden-" + t, n), parseFloat(n))
        },
        actualHeight: function(e, t) {
            return mUtil.actualCss(e, "height", t)
        },
        actualWidth: function(e, t) {
            return mUtil.actualCss(e, "width", t)
        },
        getScroll: function(e, t) {
            return t = "scroll" + t, e == window || e == document ? self["scrollTop" == t ? "pageYOffset" : "pageXOffset"] || browserSupportsBoxModel && document.documentElement[t] || document.body[t] : e[t]
        },
        css: function(e, t, a) {
            if (e = mUtil.get(e), void 0 !== a) e.style[t] = a;
            else {
                var n = (e.ownerDocument || document).defaultView;
                if (n && n.getComputedStyle) return t = t.replace(/([A-Z])/g, "-$1").toLowerCase(), n.getComputedStyle(e, null).getPropertyValue(t);
                if (e.currentStyle) return t = t.replace(/\-(\w)/g, function(e, t) {
                    return t.toUpperCase()
                }), a = e.currentStyle[t], /^\d+(em|pt|%|ex)?$/i.test(a) ? (o = a, i = e.style.left, l = e.runtimeStyle.left, e.runtimeStyle.left = e.currentStyle.left, e.style.left = o || 0, o = e.style.pixelLeft + "px", e.style.left = i, e.runtimeStyle.left = l, o) : a
            }
            var o, i, l
        },
        slide: function(t, e, a, n, o) {
            if (!(!t || "up" == e && !1 === mUtil.visible(t) || "down" == e && !0 === mUtil.visible(t))) {
                a = a || 600;
                var i = mUtil.actualHeight(t),
                    l = !1,
                    r = !1;
                mUtil.css(t, "padding-top") && !0 !== mUtil.data(t).has("slide-padding-top") && mUtil.data(t).set("slide-padding-top", mUtil.css(t, "padding-top")), mUtil.css(t, "padding-bottom") && !0 !== mUtil.data(t).has("slide-padding-bottom") && mUtil.data(t).set("slide-padding-bottom", mUtil.css(t, "padding-bottom")), mUtil.data(t).has("slide-padding-top") && (l = parseInt(mUtil.data(t).get("slide-padding-top"))), mUtil.data(t).has("slide-padding-bottom") && (r = parseInt(mUtil.data(t).get("slide-padding-bottom"))), "up" == e ? (t.style.cssText = "display: block; overflow: hidden;", l && mUtil.animate(0, l, a, function(e) {
                    t.style.paddingTop = l - e + "px"
                }, "linear"), r && mUtil.animate(0, r, a, function(e) {
                    t.style.paddingBottom = r - e + "px"
                }, "linear"), mUtil.animate(0, i, a, function(e) {
                    t.style.height = i - e + "px"
                }, "linear", function() {
                    n(), t.style.height = "", t.style.display = "none"
                })) : "down" == e && (t.style.cssText = "display: block; overflow: hidden;", l && mUtil.animate(0, l, a, function(e) {
                    t.style.paddingTop = e + "px"
                }, "linear", function() {
                    t.style.paddingTop = ""
                }), r && mUtil.animate(0, r, a, function(e) {
                    t.style.paddingBottom = e + "px"
                }, "linear", function() {
                    t.style.paddingBottom = ""
                }), mUtil.animate(0, i, a, function(e) {
                    t.style.height = e + "px"
                }, "linear", function() {
                    n(), t.style.height = "", t.style.display = "", t.style.overflow = ""
                }))
            }
        },
        slideUp: function(e, t, a) {
            mUtil.slide(e, "up", t, a)
        },
        slideDown: function(e, t, a) {
            mUtil.slide(e, "down", t, a)
        },
        show: function(e, t) {
            e.style.display = t || "block"
        },
        hide: function(e) {
            e.style.display = "none"
        },
        addEvent: function(e, t, a, n) {
            void 0 !== (e = mUtil.get(e)) && e.addEventListener(t, a)
        },
        removeEvent: function(e, t, a) {
            (e = mUtil.get(e)).removeEventListener(t, a)
        },
        on: function(i, l, e, r) {
            if (l) {
                var t = mUtil.getUniqueID("event");
                return mUtilDelegatedEventHandlers[t] = function(e) {
                    for (var t = i.querySelectorAll(l), a = e.target; a && a !== i;) {
                        for (var n = 0, o = t.length; n < o; n++) a === t[n] && r.call(a, e);
                        a = a.parentNode
                    }
                }, mUtil.addEvent(i, e, mUtilDelegatedEventHandlers[t]), t
            }
        },
        off: function(e, t, a) {
            e && mUtilDelegatedEventHandlers[a] && (mUtil.removeEvent(e, t, mUtilDelegatedEventHandlers[a]), delete mUtilDelegatedEventHandlers[a])
        },
        one: function(e, t, a) {
            (e = mUtil.get(e)).addEventListener(t, function(e) {
                return e.target.removeEventListener(e.type, arguments.callee), a(e)
            })
        },
        hash: function(e) {
            var t, a = 0;
            if (0 === e.length) return a;
            for (t = 0; t < e.length; t++) a = (a << 5) - a + e.charCodeAt(t), a |= 0;
            return a
        },
        animateClass: function(e, t, a) {
            mUtil.addClass(e, "animated " + t), mUtil.one(e, "webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function() {
                mUtil.removeClass(e, "animated " + t)
            }), a && mUtil.one(e.animationEnd, a)
        },
        animateDelay: function(e, t) {
            for (var a = ["webkit-", "moz-", "ms-", "o-", ""], n = 0; n < a.length; n++) mUtil.css(e, a[n] + "animation-delay", t)
        },
        animateDuration: function(e, t) {
            for (var a = ["webkit-", "moz-", "ms-", "o-", ""], n = 0; n < a.length; n++) mUtil.css(e, a[n] + "animation-duration", t)
        },
        scrollTo: function(e, t, a) {
            a || (a = 600), zenscroll.toY(e, a)
        },
        scrollToViewport: function(e, t) {
            t || (t = 1200), zenscroll.intoView(e, t)
        },
        scrollToCenter: function(e, t) {
            t || (t = 1200), zenscroll.center(e, t)
        },
        scrollTop: function(e) {
            e || (e = 600), zenscroll.toY(0, e)
        },
        isArray: function(e) {
            return e && Array.isArray(e)
        },
        ready: function(e) {
            (document.attachEvent ? "complete" === document.readyState : "loading" !== document.readyState) ? e(): document.addEventListener("DOMContentLoaded", e)
        },
        isEmpty: function(e) {
            for (var t in e)
                if (e.hasOwnProperty(t)) return !1;
            return !0
        }
    }
}();
mUtil.ready(function() {
        mUtil.init()
    }),
    function(g) {
        if (void 0 === mUtil) throw new Error("mUtil is required and must be included before mDatatable.");
        g.fn.mDatatable = function(u) {
            if (0 !== g(this).length) {
                var p = this;
                p.debug = !1;
                var f = {
                    isInit: !(p.API = {
                        record: null,
                        value: null,
                        params: null
                    }),
                    offset: 110,
                    stateId: "meta",
                    ajaxParams: {},
                    init: function(e) {
                        var t = !1;
                        return null === e.data.source && (f.extractTable(), t = !0), f.setupBaseDOM.call(), f.setupDOM(p.table), f.spinnerCallback(!0), f.setDataSourceQuery(f.getOption("data.source.read.params.query")), g(p).on("m-datatable--on-layout-updated", f.afterRender), p.debug && f.stateRemove(f.stateId), g.each(f.getOption("extensions"), function(e, t) {
                            "function" == typeof g.fn.mDatatable[e] && new g.fn.mDatatable[e](p, t)
                        }), "remote" !== e.data.type && "local" !== e.data.type || ((!1 === e.data.saveState || !1 === e.data.saveState.cookie && !1 === e.data.saveState.webstorage) && f.stateRemove(f.stateId), "local" === e.data.type && "object" == typeof e.data.source && (p.dataSet = p.originalDataSet = f.dataMapCallback(e.data.source)), f.dataRender()), t || (f.setHeadTitle(), f.getOption("layout.footer") && f.setHeadTitle(p.tableFoot)), void 0 !== e.layout.header && !1 === e.layout.header && g(p.table).find("thead").remove(), void 0 !== e.layout.footer && !1 === e.layout.footer && g(p.table).find("tfoot").remove(), null !== e.data.type && "local" !== e.data.type || (f.setupCellField.call(), f.setupTemplateCell.call(), f.setupSubDatatable.call(), f.setupSystemColumn.call(), f.redraw()), g(window).resize(f.fullRender), g(p).height(""), g(f.getOption("search.input")).on("keyup", function(e) {
                            f.getOption("search.onEnter") && 13 !== e.which || f.search(g(this).val())
                        }), p
                    },
                    extractTable: function() {
                        var i = [],
                            n = g(p).find("tr:first-child th").get().map(function(e, t) {
                                var a = g(e).data("field");
                                void 0 === a && (a = g(e).text().trim());
                                var n = {
                                    field: a,
                                    title: a
                                };
                                for (var o in u.columns) u.columns[o].field === a && (n = g.extend(!0, {}, u.columns[o], n));
                                return i.push(n), a
                            });
                        u.columns = i;
                        var e = [],
                            t = [];
                        g(p).find("tr").each(function() {
                            g(this).find("td").length && e.push(g(this).prop("attributes"));
                            var a = {};
                            g(this).find("td").each(function(e, t) {
                                a[n[e]] = t.innerHTML.trim()
                            }), mUtil.isEmpty(a) || t.push(a)
                        }), u.data.attr.rowProps = e, u.data.source = t
                    },
                    layoutUpdate: function() {
                        f.setupSubDatatable.call(), f.setupSystemColumn.call(), f.setupHover.call(), void 0 === u.detail && 1 === f.getDepth() && f.lockTable.call(), f.columnHide.call(), f.resetScroll(), f.isInit || (g(p).trigger("m-datatable--on-init", {
                            table: g(p.wrap).attr("id"),
                            options: u
                        }), f.isInit = !0), g(p).trigger("m-datatable--on-layout-updated", {
                            table: g(p.wrap).attr("id")
                        })
                    },
                    lockTable: function() {
                        var t = {
                            lockEnabled: !1,
                            init: function() {
                                t.lockEnabled = f.lockEnabledColumns(), 0 === t.lockEnabled.left.length && 0 === t.lockEnabled.right.length || t.enable()
                            },
                            enable: function() {
                                g(p.table).find("thead,tbody,tfoot").each(function() {
                                    var e = this;
                                    0 === g(this).find(".m-datatable__lock").length && g(this).ready(function() {
                                        ! function(e) {
                                            if (0 < g(e).find(".m-datatable__lock").length) f.log("Locked container already exist in: ", e);
                                            else if (0 !== g(e).find(".m-datatable__row").length) {
                                                var o = g("<div/>").addClass("m-datatable__lock m-datatable__lock--left"),
                                                    i = g("<div/>").addClass("m-datatable__lock m-datatable__lock--scroll"),
                                                    l = g("<div/>").addClass("m-datatable__lock m-datatable__lock--right");
                                                g(e).find(".m-datatable__row").each(function() {
                                                    var t = g("<tr/>").addClass("m-datatable__row").appendTo(o),
                                                        a = g("<tr/>").addClass("m-datatable__row").appendTo(i),
                                                        n = g("<tr/>").addClass("m-datatable__row").appendTo(l);
                                                    g(this).find(".m-datatable__cell").each(function() {
                                                        var e = g(this).data("locked");
                                                        void 0 !== e ? (void 0 === e.left && !0 !== e || g(this).appendTo(t), void 0 !== e.right && g(this).appendTo(n)) : g(this).appendTo(a)
                                                    }), g(this).remove()
                                                }), 0 < t.lockEnabled.left.length && (g(p.wrap).addClass("m-datatable--lock"), g(o).appendTo(e)), (0 < t.lockEnabled.left.length || 0 < t.lockEnabled.right.length) && g(i).appendTo(e), 0 < t.lockEnabled.right.length && (g(p.wrap).addClass("m-datatable--lock"), g(l).appendTo(e))
                                            } else f.log("No row exist in: ", e)
                                        }(e)
                                    })
                                })
                            }
                        };
                        return t.init(), t
                    },
                    fullRender: function() {
                        f.spinnerCallback(!0), g(p.wrap).removeClass("m-datatable--loaded"), f.insertData()
                    },
                    lockEnabledColumns: function() {
                        var a = g(window).width(),
                            e = u.columns,
                            n = {
                                left: [],
                                right: []
                            };
                        return g.each(e, function(e, t) {
                            void 0 !== t.locked && (void 0 !== t.locked.left && mUtil.getBreakpoint(t.locked.left) <= a && n.left.push(t.locked.left), void 0 !== t.locked.right && mUtil.getBreakpoint(t.locked.right) <= a && n.right.push(t.locked.right))
                        }), n
                    },
                    afterRender: function(e, t) {
                        t.table == g(p.wrap).attr("id") && g(p).ready(function() {
                            f.isLocked() || (f.redraw(), f.getOption("rows.autoHide") && (f.autoHide(), g(p.table).find(".m-datatable__row").css("height", ""))), g(p.tableBody).find(".m-datatable__row").removeClass("m-datatable__row--even"), g(p.wrap).hasClass("m-datatable--subtable") ? g(p.tableBody).find(".m-datatable__row:not(.m-datatable__row-detail):even").addClass("m-datatable__row--even") : g(p.tableBody).find(".m-datatable__row:nth-child(even)").addClass("m-datatable__row--even"), f.isLocked() && f.redraw(), g(p.tableBody).css("visibility", ""), g(p.wrap).addClass("m-datatable--loaded"), f.scrollbar.call(), f.sorting.call(), f.spinnerCallback(!1)
                        })
                    },
                    hoverTimer: 0,
                    isScrolling: !1,
                    setupHover: function() {
                        g(window).scroll(function(e) {
                            clearTimeout(f.hoverTimer), f.isScrolling = !0
                        }), g(p.tableBody).find(".m-datatable__cell").off("mouseenter", "mouseleave").on("mouseenter", function() {
                            if (f.hoverTimer = setTimeout(function() {
                                    f.isScrolling = !1
                                }, 200), !f.isScrolling) {
                                var e = g(this).closest(".m-datatable__row").addClass("m-datatable__row--hover"),
                                    t = g(e).index() + 1;
                                g(e).closest(".m-datatable__lock").parent().find(".m-datatable__row:nth-child(" + t + ")").addClass("m-datatable__row--hover")
                            }
                        }).on("mouseleave", function() {
                            var e = g(this).closest(".m-datatable__row").removeClass("m-datatable__row--hover"),
                                t = g(e).index() + 1;
                            g(e).closest(".m-datatable__lock").parent().find(".m-datatable__row:nth-child(" + t + ")").removeClass("m-datatable__row--hover")
                        })
                    },
                    adjustLockContainer: function() {
                        if (!f.isLocked()) return 0;
                        var e = g(p.tableHead).width(),
                            t = g(p.tableHead).find(".m-datatable__lock--left").width(),
                            a = g(p.tableHead).find(".m-datatable__lock--right").width();
                        void 0 === t && (t = 0), void 0 === a && (a = 0);
                        var n = Math.floor(e - t - a);
                        return g(p.table).find(".m-datatable__lock--scroll").css("width", n), n
                    },
                    dragResize: function() {
                        var i, l, r = !1,
                            s = void 0;
                        g(p.tableHead).find(".m-datatable__cell").mousedown(function(e) {
                            s = g(this), r = !0, i = e.pageX, l = g(this).width(), g(s).addClass("m-datatable__cell--resizing")
                        }).mousemove(function(a) {
                            if (r) {
                                var n = g(s).index(),
                                    e = g(p.tableBody),
                                    t = g(s).closest(".m-datatable__lock");
                                if (t) {
                                    var o = g(t).index();
                                    e = g(p.tableBody).find(".m-datatable__lock").eq(o)
                                }
                                g(e).find(".m-datatable__row").each(function(e, t) {
                                    g(t).find(".m-datatable__cell").eq(n).width(l + (a.pageX - i)).children().width(l + (a.pageX - i))
                                }), g(s).children().css("width", l + (a.pageX - i))
                            }
                        }).mouseup(function() {
                            g(s).removeClass("m-datatable__cell--resizing"), r = !1
                        }), g(document).mouseup(function() {
                            g(s).removeClass("m-datatable__cell--resizing"), r = !1
                        })
                    },
                    initHeight: function() {
                        if (u.layout.height && u.layout.scroll) {
                            var e = g(p.tableHead).find(".m-datatable__row").height(),
                                t = g(p.tableFoot).find(".m-datatable__row").height(),
                                a = u.layout.height;
                            0 < e && (a -= e), 0 < t && (a -= t), g(p.tableBody).css("max-height", a)
                        }
                    },
                    setupBaseDOM: function() {
                        p.initialDatatable = g(p).clone(), "TABLE" === g(p).prop("tagName") ? (p.table = g(p).removeClass("m-datatable").addClass("m-datatable__table"), 0 === g(p.table).parents(".m-datatable").length && (p.table.wrap(g("<div/>").addClass("m-datatable").addClass("m-datatable--" + u.layout.theme)), p.wrap = g(p.table).parent())) : (p.wrap = g(p).addClass("m-datatable").addClass("m-datatable--" + u.layout.theme), p.table = g("<table/>").addClass("m-datatable__table").appendTo(p)), void 0 !== u.layout.class && g(p.wrap).addClass(u.layout.class), g(p.table).removeClass("m-datatable--destroyed").css("display", "block"), void 0 === g(p).attr("id") && (f.setOption("data.saveState", !1), g(p.table).attr("id", mUtil.getUniqueID("m-datatable--"))), f.getOption("layout.minHeight") && g(p.table).css("min-height", f.getOption("layout.minHeight")), f.getOption("layout.height") && g(p.table).css("max-height", f.getOption("layout.height")), null === u.data.type && g(p.table).css("width", "").css("display", ""), p.tableHead = g(p.table).find("thead"), 0 === g(p.tableHead).length && (p.tableHead = g("<thead/>").prependTo(p.table)), p.tableBody = g(p.table).find("tbody"), 0 === g(p.tableBody).length && (p.tableBody = g("<tbody/>").appendTo(p.table)), void 0 !== u.layout.footer && u.layout.footer && (p.tableFoot = g(p.table).find("tfoot"), 0 === g(p.tableFoot).length && (p.tableFoot = g("<tfoot/>").appendTo(p.table)))
                    },
                    setupCellField: function(e) {
                        void 0 === e && (e = g(p.table).children());
                        var a = u.columns;
                        g.each(e, function(e, t) {
                            g(t).find(".m-datatable__row").each(function(e, t) {
                                g(t).find(".m-datatable__cell").each(function(e, t) {
                                    void 0 !== a[e] && g(t).data(a[e])
                                })
                            })
                        })
                    },
                    setupTemplateCell: function(e) {
                        void 0 === e && (e = p.tableBody);
                        var r = u.columns;
                        g(e).find(".m-datatable__row").each(function(i, e) {
                            var l = g(e).data("obj") || {},
                                t = f.getOption("rows.callback");
                            "function" == typeof t && t(g(e), l, i);
                            var a = f.getOption("rows.beforeTemplate");
                            "function" == typeof a && a(g(e), l, i), void 0 === l && (l = {}, g(e).find(".m-datatable__cell").each(function(e, a) {
                                var t = g.grep(r, function(e, t) {
                                    return g(a).data("field") === e.field
                                })[0];
                                void 0 !== t && (l[t.field] = g(a).text())
                            })), g(e).find(".m-datatable__cell").each(function(e, a) {
                                var t = g.grep(r, function(e, t) {
                                    return g(a).data("field") === e.field
                                })[0];
                                if (void 0 !== t && void 0 !== t.template) {
                                    var n = "";
                                    "string" == typeof t.template && (n = f.dataPlaceholder(t.template, l)), "function" == typeof t.template && (n = t.template(l, i, p));
                                    var o = document.createElement("span");
                                    o.innerHTML = n, g(a).html(o), void 0 !== t.overflow && (g(o).css("overflow", t.overflow), g(o).css("position", "relative"))
                                }
                            });
                            var n = f.getOption("rows.afterTemplate");
                            "function" == typeof n && n(g(e), l, i)
                        })
                    },
                    setupSystemColumn: function() {
                        if (p.dataSet = p.dataSet || [], 0 !== p.dataSet.length) {
                            var i = u.columns;
                            g(p.tableBody).find(".m-datatable__row").each(function(e, t) {
                                g(t).find(".m-datatable__cell").each(function(e, a) {
                                    var t = g.grep(i, function(e, t) {
                                        return g(a).data("field") === e.field
                                    })[0];
                                    if (void 0 !== t) {
                                        var n = g(a).text();
                                        if (void 0 !== t.selector && !1 !== t.selector) {
                                            if (0 < g(a).find('.m-checkbox [type="checkbox"]').length) return;
                                            g(a).addClass("m-datatable__cell--check");
                                            var o = g("<label/>").addClass("m-checkbox m-checkbox--single").append(g("<input/>").attr("type", "checkbox").attr("value", n).on("click", function() {
                                                g(this).is(":checked") ? f.setActive(this) : f.setInactive(this)
                                            })).append(g("<span/>"));
                                            void 0 !== t.selector.class && g(o).addClass(t.selector.class), g(a).children().html(o)
                                        }
                                        if (void 0 !== t.subtable && t.subtable) {
                                            if (0 < g(a).find(".m-datatable__toggle-subtable").length) return;
                                            g(a).children().html(g("<a/>").addClass("m-datatable__toggle-subtable").attr("href", "#").attr("data-value", n).append(g("<i/>").addClass(f.getOption("layout.icons.rowDetail.collapse"))))
                                        }
                                    }
                                })
                            });
                            var e = function(e) {
                                var t = g.grep(i, function(e, t) {
                                    return void 0 !== e.selector && !1 !== e.selector
                                })[0];
                                if (void 0 !== t && void 0 !== t.selector && !1 !== t.selector) {
                                    var a = g(e).find('[data-field="' + t.field + '"]');
                                    if (0 < g(a).find('.m-checkbox [type="checkbox"]').length) return;
                                    g(a).addClass("m-datatable__cell--check");
                                    var n = g("<label/>").addClass("m-checkbox m-checkbox--single m-checkbox--all").append(g("<input/>").attr("type", "checkbox").on("click", function() {
                                        g(this).is(":checked") ? f.setActiveAll(!0) : f.setActiveAll(!1)
                                    })).append(g("<span/>"));
                                    void 0 !== t.selector.class && g(n).addClass(t.selector.class), g(a).children().html(n)
                                }
                            };
                            u.layout.header && e(g(p.tableHead).find(".m-datatable__row").first()), u.layout.footer && e(g(p.tableFoot).find(".m-datatable__row").first())
                        }
                    },
                    adjustCellsWidth: function() {
                        var e = g(p.tableHead).width(),
                            t = g(p.tableHead).find(".m-datatable__row:first-child").find(".m-datatable__cell:visible").length;
                        if (0 < t) {
                            e -= 20 * t;
                            var o = Math.floor(e / t);
                            o <= f.offset && (o = f.offset), g(p.table).find(".m-datatable__row").find(".m-datatable__cell:visible").each(function(e, t) {
                                var a = o,
                                    n = g(t).data("width");
                                void 0 !== n && (a = n), g(t).children().css("width", parseInt(a))
                            })
                        }
                        return p
                    },
                    adjustCellsHeight: function() {
                        g.each(g(p.table).children(), function(e, t) {
                            for (var a = g(t).find(".m-datatable__row").first().parent().find(".m-datatable__row").length, n = 1; n <= a; n++) {
                                var o = g(t).find(".m-datatable__row:nth-child(" + n + ")");
                                if (0 < g(o).length) {
                                    var i = Math.max.apply(null, g(o).map(function() {
                                        return g(this).height()
                                    }).get());
                                    g(o).css("height", Math.ceil(parseInt(i)))
                                }
                            }
                        })
                    },
                    setupDOM: function(e) {
                        g(e).find("> thead").addClass("m-datatable__head"), g(e).find("> tbody").addClass("m-datatable__body"), g(e).find("> tfoot").addClass("m-datatable__foot"), g(e).find("tr").addClass("m-datatable__row"), g(e).find("tr > th, tr > td").addClass("m-datatable__cell"), g(e).find("tr > th, tr > td").each(function(e, t) {
                            0 === g(t).find("span").length && g(t).wrapInner(g("<span/>").css("width", f.offset))
                        })
                    },
                    scrollbar: function() {
                        var n = {
                            scrollable: null,
                            tableLocked: null,
                            mcsOptions: {
                                scrollInertia: 0,
                                autoDraggerLength: !0,
                                autoHideScrollbar: !0,
                                autoExpandScrollbar: !1,
                                alwaysShowScrollbar: 0,
                                mouseWheel: {
                                    scrollAmount: 120,
                                    preventDefault: !1
                                },
                                advanced: {
                                    updateOnContentResize: !0,
                                    autoExpandHorizontalScroll: !0
                                },
                                theme: "minimal-dark"
                            },
                            init: function() {
                                f.destroyScroller(n.scrollable);
                                var e = mUtil.getViewPort().width;
                                if (u.layout.scroll) {
                                    g(p.wrap).addClass("m-datatable--scroll");
                                    var t = g(p.tableBody).find(".m-datatable__lock--scroll");
                                    0 < g(t).find(".m-datatable__row").length && 0 < g(t).length ? (n.scrollHead = g(p.tableHead).find("> .m-datatable__lock--scroll > .m-datatable__row"), n.scrollFoot = g(p.tableFoot).find("> .m-datatable__lock--scroll > .m-datatable__row"), n.tableLocked = g(p.tableBody).find(".m-datatable__lock:not(.m-datatable__lock--scroll)"), e > mUtil.getBreakpoint("lg") ? n.mCustomScrollbar(t) : n.defaultScrollbar(t)) : 0 < g(p.tableBody).find(".m-datatable__row").length && (n.scrollHead = g(p.tableHead).find("> .m-datatable__row"), n.scrollFoot = g(p.tableFoot).find("> .m-datatable__row"), e > mUtil.getBreakpoint("lg") ? n.mCustomScrollbar(p.tableBody) : n.defaultScrollbar(p.tableBody))
                                } else g(p.table).css("overflow-x", "auto")
                            },
                            defaultScrollbar: function(e) {
                                g(e).css("overflow", "auto").css("max-height", f.getOption("layout.height")).on("scroll", n.onScrolling)
                            },
                            onScrolling: function(e) {
                                var t = g(this).scrollLeft(),
                                    a = g(this).scrollTop();
                                g(n.scrollHead).css("left", -t), g(n.scrollFoot).css("left", -t), g(n.tableLocked).each(function(e, t) {
                                    g(t).css("top", -a)
                                })
                            },
                            mCustomScrollbar: function(e) {
                                n.scrollable = e;
                                var t = "xy";
                                null === f.getOption("layout.height") && (t = "x");
                                var a = g.extend({}, n.mcsOptions, {
                                    axis: t,
                                    setHeight: g(p.tableBody).height(),
                                    callbacks: {
                                        whileScrolling: function() {
                                            var a = this.mcs;
                                            g(n.scrollHead).css("left", a.left), g(n.scrollFoot).css("left", a.left), g(n.tableLocked).each(function(e, t) {
                                                g(t).css("top", a.top)
                                            }), clearTimeout(f.hoverTimer), f.isScrolling = !0
                                        }
                                    }
                                });
                                !0 === f.getOption("layout.smoothScroll.scrollbarShown") && g(e).attr("data-scrollbar-shown", "true"), f.mCustomScrollbar(e, a)
                            }
                        };
                        return n.init(), n
                    },
                    mCustomScrollbar: function(e, t) {
                        g(p.tableBody).css("overflow", ""), f.destroyScroller(g(p.table).find(".mCustomScrollbar")), g(e).mCustomScrollbar(t)
                    },
                    setHeadTitle: function(e) {
                        void 0 === e && (e = p.tableHead), e = g(e)[0];
                        var t = u.columns,
                            o = e.getElementsByTagName("tr")[0],
                            i = e.getElementsByTagName("td");
                        void 0 === o && (o = document.createElement("tr"), e.appendChild(o)), g.each(t, function(e, t) {
                            var a = i[e];
                            if (void 0 === a && (a = document.createElement("th"), o.appendChild(a)), void 0 !== t.title && (a.innerHTML = t.title, a.setAttribute("data-field", t.field), mUtil.addClass(a, t.class), g(a).data(t)), void 0 !== t.attr && g.each(t.attr, function(e, t) {
                                    a.setAttribute(e, t)
                                }), void 0 !== t.textAlign) {
                                var n = void 0 !== p.textAlign[t.textAlign] ? p.textAlign[t.textAlign] : "";
                                mUtil.addClass(a, n)
                            }
                        }), f.setupDOM(e)
                    },
                    dataRender: function(e) {
                        g(p.table).siblings(".m-datatable__pager").removeClass("m-datatable--paging-loaded");
                        var n = function() {
                                p.dataSet = p.dataSet || [], f.localDataUpdate();
                                var e = f.getDataSourceParam("pagination");
                                0 === e.perpage && (e.perpage = u.data.pageSize || 10), e.total = p.dataSet.length;
                                var t = Math.max(e.perpage * (e.page - 1), 0),
                                    a = Math.min(t + e.perpage, e.total);
                                return p.dataSet = g(p.dataSet).slice(t, a), e
                            },
                            t = function(e) {
                                var t = function(t, a) {
                                    g(t.pager).hasClass("m-datatable--paging-loaded") || (g(t.pager).remove(), t.init(a)), g(t.pager).off().on("m-datatable--on-goto-page", function(e) {
                                        g(t.pager).remove(), t.init(a)
                                    });
                                    var e = Math.max(a.perpage * (a.page - 1), 0),
                                        n = Math.min(e + a.perpage, a.total);
                                    f.localDataUpdate(), p.dataSet = g(p.dataSet).slice(e, n), f.insertData()
                                };
                                if (g(p.wrap).removeClass("m-datatable--error"), u.pagination)
                                    if (u.data.serverPaging && "local" !== u.data.type) {
                                        var a = f.getObject("meta", e || null);
                                        null !== a ? f.paging(a) : f.paging(n(), t)
                                    } else f.paging(n(), t);
                                else f.localDataUpdate();
                                f.insertData()
                            };
                        "local" === u.data.type || void 0 === u.data.source.read && null !== p.dataSet || !1 === u.data.serverSorting && "sort" === e || !1 === u.data.serverFiltering && "search" === e ? t() : f.getData().done(t)
                    },
                    insertData: function() {
                        p.dataSet = p.dataSet || [];
                        var s = f.getDataSourceParam(),
                            e = s.pagination,
                            t = (Math.max(e.page, 1) - 1) * e.perpage,
                            a = Math.min(e.page, e.pages) * e.perpage,
                            d = {};
                        void 0 !== u.data.attr.rowProps && u.data.attr.rowProps.length && (d = u.data.attr.rowProps.slice(t, a));
                        var c = document.createElement("tbody");
                        c.style.visibility = "hidden";
                        var m = u.columns.length;
                        if (g.each(p.dataSet, function(e, t) {
                                var a = document.createElement("tr");
                                a.setAttribute("data-row", e), g(a).data("obj", t), void 0 !== d[e] && g.each(d[e], function() {
                                    a.setAttribute(this.name, this.value)
                                });
                                for (var n = 0; n < m; n += 1) {
                                    var o = u.columns[n],
                                        i = [];
                                    if (f.getObject("sort.field", s) === o.field && i.push("m-datatable__cell--sorted"), void 0 !== o.textAlign) {
                                        var l = void 0 !== p.textAlign[o.textAlign] ? p.textAlign[o.textAlign] : "";
                                        i.push(l)
                                    }
                                    void 0 !== o.class && i.push(o.class);
                                    var r = document.createElement("td");
                                    mUtil.addClass(r, i.join(" ")), r.setAttribute("data-field", o.field), r.innerHTML = f.getObject(o.field, t), a.appendChild(r)
                                }
                                c.appendChild(a)
                            }), 0 === p.dataSet.length) {
                            f.destroyScroller(g(p.table).find(".mCustomScrollbar"));
                            var n = document.createElement("span");
                            mUtil.addClass(n, "m-datatable--error"), n.innerHTML = f.getOption("translate.records.noRecords"), c.appendChild(n), g(p.wrap).addClass("m-datatable--error m-datatable--loaded"), f.spinnerCallback(!1)
                        }
                        g(p.tableBody).replaceWith(c), p.tableBody = c, f.setupDOM(p.table), f.setupCellField([p.tableBody]), f.setupTemplateCell(p.tableBody), f.layoutUpdate()
                    },
                    updateTableComponents: function() {
                        p.tableHead = g(p.table).children("thead"), p.tableBody = g(p.table).children("tbody"), p.tableFoot = g(p.table).children("tfoot")
                    },
                    getData: function() {
                        f.spinnerCallback(!0);
                        var e = {
                            dataType: "json",
                            method: "GET",
                            data: {},
                            timeout: f.getOption("data.source.read.timeout") || 3e4
                        };
                        if ("local" === u.data.type && (e.url = u.data.source), "remote" === u.data.type) {
                            e.url = f.getOption("data.source.read.url"), "string" != typeof e.url && (e.url = f.getOption("data.source.read")), "string" != typeof e.url && (e.url = f.getOption("data.source")), e.headers = f.getOption("data.source.read.headers"), e.method = f.getOption("data.source.read.method") || "POST";
                            var t = f.getDataSourceParam();
                            f.getOption("data.serverPaging") || delete t.pagination, f.getOption("data.serverSorting") || delete t.sort, e.data = g.extend(!0, e.data, t, f.getOption("data.source.read.params"))
                        }
                        return g.ajax(e).done(function(e, t, a) {
                            p.lastResponse = e, p.dataSet = p.originalDataSet = f.dataMapCallback(e), f.setAutoColumns(), g(p).trigger("m-datatable--on-ajax-done", [p.dataSet])
                        }).fail(function(e, t, a) {
                            f.destroyScroller(g(p.table).find(".mCustomScrollbar")), g(p).trigger("m-datatable--on-ajax-fail", [e]), g(p.tableBody).html(g("<span/>").addClass("m-datatable--error").html(f.getOption("translate.records.noRecords"))), g(p.wrap).addClass("m-datatable--error m-datatable--loaded"), f.spinnerCallback(!1)
                        }).always(function() {})
                    },
                    paging: function(e, t) {
                        var m = {
                            meta: null,
                            pager: null,
                            paginateEvent: null,
                            pagerLayout: {
                                pagination: null,
                                info: null
                            },
                            callback: null,
                            init: function(e) {
                                m.meta = e, m.meta.pages = Math.max(Math.ceil(m.meta.total / m.meta.perpage), 1), m.meta.page > m.meta.pages && (m.meta.page = m.meta.pages), m.paginateEvent = f.getTablePrefix(), m.pager = g(p.table).siblings(".m-datatable__pager"), g(m.pager).hasClass("m-datatable--paging-loaded") || (g(m.pager).remove(), 0 !== m.meta.pages && (f.setDataSourceParam("pagination", {
                                    page: m.meta.page,
                                    pages: m.meta.pages,
                                    perpage: m.meta.perpage,
                                    total: m.meta.total
                                }), m.callback = m.serverCallback, "function" == typeof t && (m.callback = t), m.addPaginateEvent(), m.populate(), m.meta.page = Math.max(m.meta.page || 1, m.meta.page), g(p).trigger(m.paginateEvent, m.meta), m.pagingBreakpoint.call(), g(window).resize(m.pagingBreakpoint)))
                            },
                            serverCallback: function(e, t) {
                                f.dataRender()
                            },
                            populate: function() {
                                var e = f.getOption("layout.icons.pagination"),
                                    t = f.getOption("translate.toolbar.pagination.items.default");
                                m.pager = g("<div/>").addClass("m-datatable__pager m-datatable--paging-loaded clearfix");
                                var a = g("<ul/>").addClass("m-datatable__pager-nav");
                                m.pagerLayout.pagination = a, g("<li/>").append(g("<a/>").attr("title", t.first).addClass("m-datatable__pager-link m-datatable__pager-link--first").append(g("<i/>").addClass(e.first)).on("click", m.gotoMorePage).attr("data-page", 1)).appendTo(a), g("<li/>").append(g("<a/>").attr("title", t.prev).addClass("m-datatable__pager-link m-datatable__pager-link--prev").append(g("<i/>").addClass(e.prev)).on("click", m.gotoMorePage)).appendTo(a), g("<li/>").append(g("<a/>").attr("title", t.more).addClass("m-datatable__pager-link m-datatable__pager-link--more-prev").html(g("<i/>").addClass(e.more)).on("click", m.gotoMorePage)).appendTo(a), g("<li/>").append(g("<input/>").attr("type", "text").addClass("m-pager-input form-control").attr("title", t.input).on("keyup", function() {
                                    g(this).attr("data-page", Math.abs(g(this).val()))
                                }).on("keypress", function(e) {
                                    13 === e.which && m.gotoMorePage(e)
                                })).appendTo(a);
                                var n = f.getOption("toolbar.items.pagination.pages.desktop.pagesNumber"),
                                    o = Math.ceil(m.meta.page / n) * n,
                                    i = o - n;
                                o > m.meta.pages && (o = m.meta.pages);
                                for (var l = i; l < o; l++) {
                                    var r = l + 1;
                                    g("<li/>").append(g("<a/>").addClass("m-datatable__pager-link m-datatable__pager-link-number").text(r).attr("data-page", r).attr("title", r).on("click", m.gotoPage)).appendTo(a)
                                }
                                g("<li/>").append(g("<a/>").attr("title", t.more).addClass("m-datatable__pager-link m-datatable__pager-link--more-next").html(g("<i/>").addClass(e.more)).on("click", m.gotoMorePage)).appendTo(a), g("<li/>").append(g("<a/>").attr("title", t.next).addClass("m-datatable__pager-link m-datatable__pager-link--next").append(g("<i/>").addClass(e.next)).on("click", m.gotoMorePage)).appendTo(a), g("<li/>").append(g("<a/>").attr("title", t.last).addClass("m-datatable__pager-link m-datatable__pager-link--last").append(g("<i/>").addClass(e.last)).on("click", m.gotoMorePage).attr("data-page", m.meta.pages)).appendTo(a), f.getOption("toolbar.items.info") && (m.pagerLayout.info = g("<div/>").addClass("m-datatable__pager-info").append(g("<span/>").addClass("m-datatable__pager-detail"))), g.each(f.getOption("toolbar.layout"), function(e, t) {
                                    g(m.pagerLayout[t]).appendTo(m.pager)
                                });
                                var s = g("<select/>").addClass("selectpicker m-datatable__pager-size").attr("title", f.getOption("translate.toolbar.pagination.items.default.select")).attr("data-width", "70px").val(m.meta.perpage).on("change", m.updatePerpage).prependTo(m.pagerLayout.info),
                                    d = f.getOption("toolbar.items.pagination.pageSizeSelect");
                                0 == d.length && (d = [10, 20, 30, 50, 100]), g.each(d, function(e, t) {
                                    var a = t; - 1 === t && (a = "All"), g("<option/>").attr("value", t).html(a).appendTo(s)
                                }), g(p).ready(function() {
                                    g(".selectpicker").selectpicker().siblings(".dropdown-toggle").attr("title", f.getOption("translate.toolbar.pagination.items.default.select"))
                                }), m.paste()
                            },
                            paste: function() {
                                g.each(g.unique(f.getOption("toolbar.placement")), function(e, t) {
                                    "bottom" === t && g(m.pager).clone(!0).insertAfter(p.table), "top" === t && g(m.pager).clone(!0).addClass("m-datatable__pager--top").insertBefore(p.table)
                                })
                            },
                            gotoMorePage: function(e) {
                                if (e.preventDefault(), "disabled" === g(this).attr("disabled")) return !1;
                                var t = g(this).attr("data-page");
                                return void 0 === t && (t = g(e.target).attr("data-page")), m.openPage(parseInt(t)), !1
                            },
                            gotoPage: function(e) {
                                e.preventDefault(), g(this).hasClass("m-datatable__pager-link--active") || m.openPage(parseInt(g(this).data("page")))
                            },
                            openPage: function(e) {
                                m.meta.page = parseInt(e), g(p).trigger(m.paginateEvent, m.meta), m.callback(m, m.meta), g(m.pager).trigger("m-datatable--on-goto-page", m.meta)
                            },
                            updatePerpage: function(e) {
                                e.preventDefault(), null === f.getOption("layout.height") && g("html, body").animate({
                                    scrollTop: g(p).position().top
                                }), m.pager = g(p.table).siblings(".m-datatable__pager").removeClass("m-datatable--paging-loaded"), e.originalEvent && (m.meta.perpage = parseInt(g(this).val())), g(m.pager).find("select.m-datatable__pager-size").val(m.meta.perpage).attr("data-selected", m.meta.perpage), f.setDataSourceParam("pagination", {
                                    page: m.meta.page,
                                    pages: m.meta.pages,
                                    perpage: m.meta.perpage,
                                    total: m.meta.total
                                }), g(m.pager).trigger("m-datatable--on-update-perpage", m.meta), g(p).trigger(m.paginateEvent, m.meta), m.callback(m, m.meta), m.updateInfo.call()
                            },
                            addPaginateEvent: function(e) {
                                g(p).off(m.paginateEvent).on(m.paginateEvent, function(e, t) {
                                    f.spinnerCallback(!0), m.pager = g(p.table).siblings(".m-datatable__pager");
                                    var a = g(m.pager).find(".m-datatable__pager-nav");
                                    g(a).find(".m-datatable__pager-link--active").removeClass("m-datatable__pager-link--active"), g(a).find('.m-datatable__pager-link-number[data-page="' + t.page + '"]').addClass("m-datatable__pager-link--active"), g(a).find(".m-datatable__pager-link--prev").attr("data-page", Math.max(t.page - 1, 1)), g(a).find(".m-datatable__pager-link--next").attr("data-page", Math.min(t.page + 1, t.pages)), g(m.pager).each(function() {
                                        g(this).find('.m-pager-input[type="text"]').prop("value", t.page)
                                    }), g(m.pager).find(".m-datatable__pager-nav").show(), t.pages <= 1 && g(m.pager).find(".m-datatable__pager-nav").hide(), f.setDataSourceParam("pagination", {
                                        page: m.meta.page,
                                        pages: m.meta.pages,
                                        perpage: m.meta.perpage,
                                        total: m.meta.total
                                    }), g(m.pager).find("select.m-datatable__pager-size").val(t.perpage).attr("data-selected", t.perpage), g(p.table).find('.m-checkbox > [type="checkbox"]').prop("checked", !1), g(p.table).find(".m-datatable__row--active").removeClass("m-datatable__row--active"), m.updateInfo.call(), m.pagingBreakpoint.call()
                                })
                            },
                            updateInfo: function() {
                                var e = Math.max(m.meta.perpage * (m.meta.page - 1) + 1, 1),
                                    t = Math.min(e + m.meta.perpage - 1, m.meta.total);
                                g(m.pager).find(".m-datatable__pager-info").find(".m-datatable__pager-detail").html(f.dataPlaceholder(f.getOption("translate.toolbar.pagination.items.info"), {
                                    start: e,
                                    end: -1 === m.meta.perpage ? m.meta.total : t,
                                    pageSize: -1 === m.meta.perpage || m.meta.perpage >= m.meta.total ? m.meta.total : m.meta.perpage,
                                    total: m.meta.total
                                }))
                            },
                            pagingBreakpoint: function() {
                                var a = g(p.table).siblings(".m-datatable__pager").find(".m-datatable__pager-nav");
                                if (0 !== g(a).length) {
                                    var n = f.getCurrentPage(),
                                        o = g(a).find(".m-pager-input").closest("li");
                                    g(a).find("li").show(), g.each(f.getOption("toolbar.items.pagination.pages"), function(e, t) {
                                        if (mUtil.isInResponsiveRange(e)) {
                                            switch (e) {
                                                case "desktop":
                                                case "tablet":
                                                    Math.ceil(n / t.pagesNumber), t.pagesNumber, t.pagesNumber;
                                                    g(o).hide(), m.meta = f.getDataSourceParam("pagination"), m.paginationUpdate();
                                                    break;
                                                case "mobile":
                                                    g(o).show(), g(a).find(".m-datatable__pager-link--more-prev").closest("li").hide(), g(a).find(".m-datatable__pager-link--more-next").closest("li").hide(), g(a).find(".m-datatable__pager-link-number").closest("li").hide()
                                            }
                                            return !1
                                        }
                                    })
                                }
                            },
                            paginationUpdate: function() {
                                var e = g(p.table).siblings(".m-datatable__pager").find(".m-datatable__pager-nav"),
                                    t = g(e).find(".m-datatable__pager-link--more-prev"),
                                    a = g(e).find(".m-datatable__pager-link--more-next"),
                                    n = g(e).find(".m-datatable__pager-link--first"),
                                    o = g(e).find(".m-datatable__pager-link--prev"),
                                    i = g(e).find(".m-datatable__pager-link--next"),
                                    l = g(e).find(".m-datatable__pager-link--last"),
                                    r = g(e).find(".m-datatable__pager-link-number"),
                                    s = Math.max(g(r).first().data("page") - 1, 1);
                                g(t).each(function(e, t) {
                                    g(t).attr("data-page", s)
                                }), 1 === s ? g(t).parent().hide() : g(t).parent().show();
                                var d = Math.min(g(r).last().data("page") + 1, m.meta.pages);
                                g(a).each(function(e, t) {
                                    g(a).attr("data-page", d).show()
                                }), d === m.meta.pages && d === g(r).last().data("page") ? g(a).parent().hide() : g(a).parent().show(), 1 === m.meta.page ? (g(n).attr("disabled", !0).addClass("m-datatable__pager-link--disabled"), g(o).attr("disabled", !0).addClass("m-datatable__pager-link--disabled")) : (g(n).removeAttr("disabled").removeClass("m-datatable__pager-link--disabled"), g(o).removeAttr("disabled").removeClass("m-datatable__pager-link--disabled")), m.meta.page === m.meta.pages ? (g(i).attr("disabled", !0).addClass("m-datatable__pager-link--disabled"), g(l).attr("disabled", !0).addClass("m-datatable__pager-link--disabled")) : (g(i).removeAttr("disabled").removeClass("m-datatable__pager-link--disabled"), g(l).removeAttr("disabled").removeClass("m-datatable__pager-link--disabled"));
                                var c = f.getOption("toolbar.items.pagination.navigation");
                                c.first || g(n).remove(), c.prev || g(o).remove(), c.next || g(i).remove(), c.last || g(l).remove()
                            }
                        };
                        return m.init(e), m
                    },
                    columnHide: function() {
                        var o = mUtil.getViewPort().width;
                        g.each(u.columns, function(e, t) {
                            if (void 0 !== t.responsive) {
                                var a = t.field,
                                    n = g.grep(g(p.table).find(".m-datatable__cell"), function(e, t) {
                                        return a === g(e).data("field")
                                    });
                                mUtil.getBreakpoint(t.responsive.hidden) >= o ? g(n).hide() : g(n).show(), mUtil.getBreakpoint(t.responsive.visible) <= o ? g(n).show() : g(n).hide()
                            }
                        })
                    },
                    setupSubDatatable: function() {
                        var l = f.getOption("detail.content");
                        if ("function" == typeof l && !(0 < g(p.table).find(".m-datatable__subtable").length)) {
                            g(p.wrap).addClass("m-datatable--subtable"), u.columns[0].subtable = !0;
                            var o = function(a) {
                                    a.preventDefault();
                                    var e = g(this).closest(".m-datatable__row"),
                                        t = g(e).next(".m-datatable__row-subtable");
                                    0 === g(t).length && (t = g("<tr/>").addClass("m-datatable__row-subtable m-datatable__row-loading").hide().append(g("<td/>").addClass("m-datatable__subtable").attr("colspan", f.getTotalColumns())), g(e).after(t), g(e).hasClass("m-datatable__row--even") && g(t).addClass("m-datatable__row-subtable--even")), g(t).toggle();
                                    var n = g(t).find(".m-datatable__subtable"),
                                        o = g(this).closest("[data-field]:first-child").find(".m-datatable__toggle-subtable").data("value"),
                                        i = g(this).find("i").removeAttr("class");
                                    g(e).hasClass("m-datatable__row--subtable-expanded") ? (g(i).addClass(f.getOption("layout.icons.rowDetail.collapse")), g(e).removeClass("m-datatable__row--subtable-expanded"), g(p).trigger("m-datatable--on-collapse-subtable", [e])) : (g(i).addClass(f.getOption("layout.icons.rowDetail.expand")), g(e).addClass("m-datatable__row--subtable-expanded"), g(p).trigger("m-datatable--on-expand-subtable", [e])), 0 === g(n).find(".m-datatable").length && (g.map(p.dataSet, function(e, t) {
                                        return o === e[u.columns[0].field] && (a.data = e, !0)
                                    }), a.detailCell = n, a.parentRow = e, a.subTable = n, l(a), g(n).children(".m-datatable").on("m-datatable--on-init", function(e) {
                                        g(t).removeClass("m-datatable__row-loading")
                                    }), "local" === f.getOption("data.type") && g(t).removeClass("m-datatable__row-loading"))
                                },
                                i = u.columns;
                            g(p.tableBody).find(".m-datatable__row").each(function(e, t) {
                                g(t).find(".m-datatable__cell").each(function(e, a) {
                                    var t = g.grep(i, function(e, t) {
                                        return g(a).data("field") === e.field
                                    })[0];
                                    if (void 0 !== t) {
                                        var n = g(a).text();
                                        if (void 0 !== t.subtable && t.subtable) {
                                            if (0 < g(a).find(".m-datatable__toggle-subtable").length) return;
                                            g(a).html(g("<a/>").addClass("m-datatable__toggle-subtable").attr("href", "#").attr("data-value", n).attr("title", f.getOption("detail.title")).on("click", o).append(g("<i/>").css("width", g(a).data("width")).addClass(f.getOption("layout.icons.rowDetail.collapse"))))
                                        }
                                    }
                                })
                            })
                        }
                    },
                    dataMapCallback: function(e) {
                        var t = e;
                        return "function" == typeof f.getOption("data.source.read.map") ? f.getOption("data.source.read.map")(e) : (void 0 !== e && void 0 !== e.data && (t = e.data), t)
                    },
                    isSpinning: !1,
                    spinnerCallback: function(e) {
                        if (e) {
                            if (!f.isSpinning) {
                                var t = f.getOption("layout.spinner");
                                !0 === t.message && (t.message = f.getOption("translate.records.processing")), f.isSpinning = !0, void 0 !== mApp && mApp.block(p, t)
                            }
                        } else f.isSpinning = !1, void 0 !== mApp && mApp.unblock(p)
                    },
                    sortCallback: function(e, i, t) {
                        var l = t.type || "string",
                            r = t.format || "",
                            s = t.field;
                        return g(e).sort(function(e, t) {
                            var a = e[s],
                                n = t[s];
                            switch (l) {
                                case "date":
                                    if ("undefined" == typeof moment) throw new Error("Moment.js is required.");
                                    var o = moment(a, r).diff(moment(n, r));
                                    return "asc" === i ? 0 < o ? 1 : o < 0 ? -1 : 0 : o < 0 ? 1 : 0 < o ? -1 : 0;
                                case "number":
                                    return isNaN(parseFloat(a)) && null != a && (a = Number(a.replace(/[^0-9\.-]+/g, ""))), isNaN(parseFloat(n)) && null != n && (n = Number(n.replace(/[^0-9\.-]+/g, ""))), a = parseFloat(a), n = parseFloat(n), "asc" === i ? n < a ? 1 : a < n ? -1 : 0 : a < n ? 1 : n < a ? -1 : 0;
                                case "string":
                                default:
                                    return "asc" === i ? n < a ? 1 : a < n ? -1 : 0 : a < n ? 1 : n < a ? -1 : 0
                            }
                        })
                    },
                    log: function(e, t) {
                        void 0 === t && (t = ""), p.debug && console.log(e, t)
                    },
                    autoHide: function() {
                        g(p.table).find(".m-datatable__cell").show(), g(p.tableBody).each(function() {
                            for (; g(this)[0].offsetWidth < g(this)[0].scrollWidth;) g(p.table).find(".m-datatable__row").each(function(e) {
                                var t = g(this).find(".m-datatable__cell").not(":hidden").last();
                                g(t).hide()
                            }), f.adjustCellsWidth.call()
                        });
                        var e = function(e) {
                            e.preventDefault();
                            var t = g(this).closest(".m-datatable__row"),
                                a = g(t).next();
                            if (g(a).hasClass("m-datatable__row-detail")) g(this).find("i").removeClass(f.getOption("layout.icons.rowDetail.expand")).addClass(f.getOption("layout.icons.rowDetail.collapse")), g(a).remove();
                            else {
                                g(this).find("i").removeClass(f.getOption("layout.icons.rowDetail.collapse")).addClass(f.getOption("layout.icons.rowDetail.expand"));
                                var n = g(t).find(".m-datatable__cell:hidden").clone().show();
                                a = g("<tr/>").addClass("m-datatable__row-detail").insertAfter(t);
                                var o = g("<td/>").addClass("m-datatable__detail").attr("colspan", f.getTotalColumns()).appendTo(a),
                                    i = g("<table/>");
                                g(n).each(function() {
                                    var a = g(this).data("field"),
                                        e = g.grep(u.columns, function(e, t) {
                                            return a === e.field
                                        })[0];
                                    g(i).append(g('<tr class="m-datatable__row"></tr>').append(g('<td class="m-datatable__cell"></td>').append(g("<span/>").css("width", f.offset).append(e.title))).append(this))
                                }), g(o).append(i)
                            }
                        };
                        g(p.tableBody).find(".m-datatable__row").each(function() {
                            g(this).prepend(g("<td/>").addClass("m-datatable__cell m-datatable__toggle--detail").append(g("<a/>").addClass("m-datatable__toggle-detail").attr("href", "#").on("click", e).append(g("<i/>").css("width", "21px").addClass(f.getOption("layout.icons.rowDetail.collapse"))))), 0 === g(p.tableHead).find(".m-datatable__toggle-detail").length ? (g(p.tableHead).find(".m-datatable__row").first().prepend('<th class="m-datatable__cell m-datatable__toggle-detail"><span style="width: 21px"></span></th>'), g(p.tableFoot).find(".m-datatable__row").first().prepend('<th class="m-datatable__cell m-datatable__toggle-detail"><span style="width: 21px"></span></th>')) : g(p.tableHead).find(".m-datatable__toggle-detail").find("span").css("width", "21px")
                        })
                    },
                    hoverColumn: function() {
                        g(p.tableBody).on("mouseenter", ".m-datatable__cell", function() {
                            var e = g(f.cell(this).nodes()).index();
                            g(f.cells().nodes()).removeClass("m-datatable__cell--hover"), g(f.column(e).nodes()).addClass("m-datatable__cell--hover")
                        })
                    },
                    setAutoColumns: function() {
                        f.getOption("data.autoColumns") && (g.each(p.dataSet[0], function(a, e) {
                            0 === g.grep(u.columns, function(e, t) {
                                return a === e.field
                            }).length && u.columns.push({
                                field: a,
                                title: a
                            })
                        }), g(p.tableHead).find(".m-datatable__row").remove(), f.setHeadTitle(), f.getOption("layout.footer") && (g(p.tableFoot).find(".m-datatable__row").remove(), f.setHeadTitle(p.tableFoot)))
                    },
                    isLocked: function() {
                        return g(p.wrap).hasClass("m-datatable--lock") || !1
                    },
                    replaceTableContent: function(e, t) {
                        void 0 === t && (t = p.tableBody), g(t).hasClass("mCustomScrollbar") ? g(t).find(".mCSB_container").html(e) : g(t).html(e)
                    },
                    getExtraSpace: function(e) {
                        return parseInt(g(e).css("paddingRight")) + parseInt(g(e).css("paddingLeft")) + (parseInt(g(e).css("marginRight")) + parseInt(g(e).css("marginLeft"))) + Math.ceil(g(e).css("border-right-width").replace("px", ""))
                    },
                    dataPlaceholder: function(e, t) {
                        var a = e;
                        return g.each(t, function(e, t) {
                            a = a.replace("{{" + e + "}}", t)
                        }), a
                    },
                    getTableId: function(e) {
                        void 0 === e && (e = "");
                        var t = g(p).attr("id");
                        return void 0 === t && (t = g(p).attr("class").split(" ")[0]), t + e
                    },
                    getTablePrefix: function(e) {
                        return void 0 !== e && (e = "-" + e), f.getTableId() + "-" + f.getDepth() + e
                    },
                    getDepth: function() {
                        for (var e = 0, t = p.table; t = g(t).parents(".m-datatable__table"), e++, 0 < g(t).length;);
                        return e
                    },
                    stateKeep: function(e, t) {
                        e = f.getTablePrefix(e), !1 !== f.getOption("data.saveState") && (f.getOption("data.saveState.webstorage") && localStorage && localStorage.setItem(e, JSON.stringify(t)), f.getOption("data.saveState.cookie") && Cookies.set(e, JSON.stringify(t)))
                    },
                    stateGet: function(e, t) {
                        if (e = f.getTablePrefix(e), !1 !== f.getOption("data.saveState")) {
                            var a = null;
                            return null != (a = f.getOption("data.saveState.webstorage") && localStorage ? localStorage.getItem(e) : Cookies.get(e)) ? JSON.parse(a) : void 0
                        }
                    },
                    stateUpdate: function(e, t) {
                        var a = f.stateGet(e);
                        null == a && (a = {}), f.stateKeep(e, g.extend({}, a, t))
                    },
                    stateRemove: function(e) {
                        e = f.getTablePrefix(e), localStorage && localStorage.removeItem(e), Cookies.remove(e)
                    },
                    getTotalColumns: function(e) {
                        return void 0 === e && (e = p.tableBody), g(e).find(".m-datatable__row").first().find(".m-datatable__cell").length
                    },
                    getOneRow: function(e, t, a) {
                        void 0 === a && (a = !0);
                        var n = g(e).find(".m-datatable__row:not(.m-datatable__row-detail):nth-child(" + t + ")");
                        return a && (n = n.find(".m-datatable__cell")), n
                    },
                    hasOverflowY: function(e) {
                        var t = g(e).find(".m-datatable__row"),
                            a = 0;
                        return 0 < t.length && (g(t).each(function(e, t) {
                            a += Math.floor(g(t).innerHeight())
                        }), a > g(e).innerHeight())
                    },
                    sortColumn: function(e, o, i) {
                        void 0 === o && (o = "asc"), void 0 === i && (i = !1);
                        var l = g(e).index(),
                            t = g(p.tableBody).find(".m-datatable__row"),
                            a = g(e).closest(".m-datatable__lock").index(); - 1 !== a && (t = g(p.tableBody).find(".m-datatable__lock:nth-child(" + (a + 1) + ")").find(".m-datatable__row"));
                        var n = g(t).parent();
                        g(t).sort(function(e, t) {
                            var a = g(e).find("td:nth-child(" + l + ")").text(),
                                n = g(t).find("td:nth-child(" + l + ")").text();
                            return i && (a = parseInt(a), n = parseInt(n)), "asc" === o ? n < a ? 1 : a < n ? -1 : 0 : a < n ? 1 : n < a ? -1 : 0
                        }).appendTo(n)
                    },
                    sorting: function() {
                        var i = {
                            init: function() {
                                u.sortable && (g(p.tableHead).find(".m-datatable__cell:not(.m-datatable__cell--check)").addClass("m-datatable__cell--sort").off("click").on("click", i.sortClick), i.setIcon())
                            },
                            setIcon: function() {
                                var e = f.getDataSourceParam("sort");
                                if (!g.isEmptyObject(e)) {
                                    var t = g(p.tableHead).find('.m-datatable__cell[data-field="' + e.field + '"]').attr("data-sort", e.sort),
                                        a = g(t).find("span"),
                                        n = g(a).find("i"),
                                        o = f.getOption("layout.icons.sort");
                                    0 < g(n).length ? g(n).removeAttr("class").addClass(o[e.sort]) : g(a).append(g("<i/>").addClass(o[e.sort]))
                                }
                            },
                            sortClick: function(e) {
                                var t = f.getDataSourceParam("sort"),
                                    a = g(this).data("field"),
                                    n = f.getColumnByField(a);
                                if ((void 0 === n.sortable || !1 !== n.sortable) && (g(p.tableHead).find(".m-datatable__cell > span > i").remove(), u.sortable)) {
                                    f.spinnerCallback(!0);
                                    var o = "desc";
                                    f.getObject("field", t) === a && (o = f.getObject("sort", t)), t = {
                                        field: a,
                                        sort: o = void 0 === o || "desc" === o ? "asc" : "desc"
                                    }, f.setDataSourceParam("sort", t), i.setIcon(), setTimeout(function() {
                                        f.dataRender("sort"), g(p).trigger("m-datatable--on-sort", t)
                                    }, 300)
                                }
                            }
                        };
                        i.init()
                    },
                    localDataUpdate: function() {
                        var a = f.getDataSourceParam();
                        void 0 === p.originalDataSet && (p.originalDataSet = p.dataSet);
                        var e = f.getObject("sort.field", a),
                            t = f.getObject("sort.sort", a),
                            n = f.getColumnByField(e);
                        if (void 0 !== n && !0 !== f.getOption("data.serverSorting") ? "function" == typeof n.sortCallback ? p.dataSet = n.sortCallback(p.originalDataSet, t, n) : p.dataSet = f.sortCallback(p.originalDataSet, t, n) : p.dataSet = p.originalDataSet, "object" == typeof a.query && !f.getOption("data.serverFiltering")) {
                            a.query = a.query || {};
                            var o = function(e) {
                                    for (var t in e)
                                        if (e.hasOwnProperty(t))
                                            if ("string" == typeof e[t]) {
                                                if (e[t].toLowerCase() == i || -1 !== e[t].toLowerCase().indexOf(i)) return !0
                                            } else if ("object" == typeof e[t]) return o(e[t]);
                                    return !1
                                },
                                i = g(f.getOption("search.input")).val();
                            void 0 !== i && "" !== i && (i = i.toLowerCase(), p.dataSet = g.grep(p.dataSet, o), delete a.query[f.getGeneralSearchKey()]), g.each(a.query, function(e, t) {
                                "" === t && delete a.query[e]
                            }), p.dataSet = f.filterArray(p.dataSet, a.query), p.dataSet = p.dataSet.filter(function() {
                                return !0
                            })
                        }
                        return p.dataSet
                    },
                    filterArray: function(e, a, i) {
                        if ("object" != typeof e) return [];
                        if (void 0 === i && (i = "AND"), "object" != typeof a) return e;
                        if (i = i.toUpperCase(), -1 === g.inArray(i, ["AND", "OR", "NOT"])) return [];
                        var l = Object.keys(a).length,
                            r = [];
                        return g.each(e, function(e, t) {
                            var n = t,
                                o = 0;
                            g.each(a, function(e, t) {
                                if (t = t instanceof Array ? t : [t], n.hasOwnProperty(e)) {
                                    var a = n[e].toString().toLowerCase();
                                    t.forEach(function(e, t) {
                                        e.toString().toLowerCase() != a && -1 === a.indexOf(e.toString().toLowerCase()) || o++
                                    })
                                }
                            }), ("AND" == i && o == l || "OR" == i && 0 < o || "NOT" == i && 0 == o) && (r[e] = t)
                        }), e = r
                    },
                    resetScroll: function() {
                        void 0 === u.detail && 1 === f.getDepth() && (g(p.table).find(".m-datatable__row").css("left", 0), g(p.table).find(".m-datatable__lock").css("top", 0), g(p.tableBody).scrollTop(0))
                    },
                    getColumnByField: function(a) {
                        var n;
                        if (void 0 !== a) return g.each(u.columns, function(e, t) {
                            if (a === t.field) return n = t, !1
                        }), n
                    },
                    getDefaultSortColumn: function() {
                        var a;
                        return g.each(u.columns, function(e, t) {
                            if (void 0 !== t.sortable && -1 !== g.inArray(t.sortable, ["asc", "desc"])) return !(a = {
                                sort: t.sortable,
                                field: t.field
                            })
                        }), a
                    },
                    getHiddenDimensions: function(e, t) {
                        var n = {
                                position: "absolute",
                                visibility: "hidden",
                                display: "block"
                            },
                            a = {
                                width: 0,
                                height: 0,
                                innerWidth: 0,
                                innerHeight: 0,
                                outerWidth: 0,
                                outerHeight: 0
                            },
                            o = g(e).parents().addBack().not(":visible");
                        t = "boolean" == typeof t && t;
                        var i = [];
                        return o.each(function() {
                            var e = {};
                            for (var t in n) e[t] = this.style[t], this.style[t] = n[t];
                            i.push(e)
                        }), a.width = g(e).width(), a.outerWidth = g(e).outerWidth(t), a.innerWidth = g(e).innerWidth(), a.height = g(e).height(), a.innerHeight = g(e).innerHeight(), a.outerHeight = g(e).outerHeight(t), o.each(function(e) {
                            var t = i[e];
                            for (var a in n) this.style[a] = t[a]
                        }), a
                    },
                    getGeneralSearchKey: function() {
                        var e = g(f.getOption("search.input"));
                        return g(e).prop("name") || g(e).prop("id")
                    },
                    getObject: function(e, t) {
                        return e.split(".").reduce(function(e, t) {
                            return null !== e && void 0 !== e[t] ? e[t] : null
                        }, t)
                    },
                    extendObj: function(e, t, n) {
                        var o = t.split("."),
                            i = 0;
                        return function e(t) {
                            var a = o[i++];
                            void 0 !== t[a] && null !== t[a] ? "object" != typeof t[a] && "function" != typeof t[a] && (t[a] = {}) : t[a] = {}, i === o.length ? t[a] = n : e(t[a])
                        }(e), e
                    },
                    timer: 0,
                    redraw: function() {
                        return f.adjustCellsWidth.call(), f.isLocked() && (f.scrollbar(), f.resetScroll(), f.adjustCellsHeight.call()), f.adjustLockContainer.call(), f.initHeight.call(), p
                    },
                    load: function() {
                        return f.reload(), p
                    },
                    reload: function() {
                        return function(e, t) {
                            clearTimeout(f.timer), f.timer = setTimeout(e, t)
                        }(function() {
                            u.data.serverFiltering || f.localDataUpdate(), f.dataRender(), g(p).trigger("m-datatable--on-reloaded")
                        }, f.getOption("search.delay")), p
                    },
                    getRecord: function(n) {
                        return void 0 === p.tableBody && (p.tableBody = g(p.table).children("tbody")), g(p.tableBody).find(".m-datatable__cell:first-child").each(function(e, t) {
                            if (n == g(t).text()) {
                                var a = g(t).closest(".m-datatable__row").index() + 1;
                                return p.API.record = p.API.value = f.getOneRow(p.tableBody, a), p
                            }
                        }), p
                    },
                    getColumn: function(e) {
                        return f.setSelectedRecords(), p.API.value = g(p.API.record).find('[data-field="' + e + '"]'), p
                    },
                    destroy: function() {
                        g(p).parent().find(".m-datatable__pager").remove();
                        var e = g(p.initialDatatable).addClass("m-datatable--destroyed").show();
                        return g(p).replaceWith(e), g(p = e).trigger("m-datatable--on-destroy"), f.isInit = !1, e = null
                    },
                    sort: function(e, t) {
                        t = void 0 === t ? "asc" : t, f.spinnerCallback(!0);
                        var a = {
                            field: e,
                            sort: t
                        };
                        return f.setDataSourceParam("sort", a), setTimeout(function() {
                            f.dataRender("sort"), g(p).trigger("m-datatable--on-sort", a), g(p.tableHead).find(".m-datatable__cell > span > i").remove()
                        }, 300), p
                    },
                    getValue: function() {
                        return g(p.API.value).text()
                    },
                    setActive: function(e) {
                        "string" == typeof e && (e = g(p.tableBody).find('.m-checkbox--single > [type="checkbox"][value="' + e + '"]')), g(e).prop("checked", !0);
                        var t = g(e).closest(".m-datatable__row").addClass("m-datatable__row--active"),
                            a = g(t).index() + 1;
                        g(t).closest(".m-datatable__lock").parent().find(".m-datatable__row:nth-child(" + a + ")").addClass("m-datatable__row--active");
                        var n = [];
                        g(t).each(function(e, t) {
                            var a = g(t).find('.m-checkbox--single:not(.m-checkbox--all) > [type="checkbox"]').val();
                            void 0 !== a && n.push(a)
                        }), g(p).trigger("m-datatable--on-check", [n])
                    },
                    setInactive: function(e) {
                        "string" == typeof e && (e = g(p.tableBody).find('.m-checkbox--single > [type="checkbox"][value="' + e + '"]')), g(e).prop("checked", !1);
                        var t = g(e).closest(".m-datatable__row").removeClass("m-datatable__row--active"),
                            a = g(t).index() + 1;
                        g(t).closest(".m-datatable__lock").parent().find(".m-datatable__row:nth-child(" + a + ")").removeClass("m-datatable__row--active");
                        var n = [];
                        g(t).each(function(e, t) {
                            var a = g(t).find('.m-checkbox--single:not(.m-checkbox--all) > [type="checkbox"]').val();
                            void 0 !== a && n.push(a)
                        }), g(p).trigger("m-datatable--on-uncheck", [n])
                    },
                    setActiveAll: function(e) {
                        var t = g(p.table).find(".m-datatable__body .m-datatable__row").find('.m-datatable__cell--check .m-checkbox [type="checkbox"]');
                        e ? f.setActive(t) : f.setInactive(t)
                    },
                    setSelectedRecords: function() {
                        return p.API.record = g(p.tableBody).find(".m-datatable__row--active"), p
                    },
                    getSelectedRecords: function() {
                        return f.setSelectedRecords(), p.API.record = p.rows(".m-datatable__row--active").nodes(), p.API.record
                    },
                    getOption: function(e) {
                        return f.getObject(e, u)
                    },
                    setOption: function(e, t) {
                        u = f.extendObj(u, e, t)
                    },
                    search: function(n, t) {
                        void 0 !== t && (t = g.makeArray(t)), e = function() {
                            var a = f.getDataSourceQuery();
                            if (void 0 === t && void 0 !== n) {
                                var e = f.getGeneralSearchKey();
                                a[e] = n
                            }
                            "object" == typeof t && (g.each(t, function(e, t) {
                                a[t] = n
                            }), g.each(a, function(e, t) {
                                ("" === t || g.isEmptyObject(t)) && delete a[e]
                            })), f.setDataSourceQuery(a), u.data.serverFiltering || f.localDataUpdate(), f.dataRender("search")
                        }, a = f.getOption("search.delay"), clearTimeout(f.timer), f.timer = setTimeout(e, a);
                        var e, a
                    },
                    setDataSourceParam: function(e, t) {
                        p.API.params = g.extend({}, {
                            pagination: {
                                page: 1,
                                perpage: f.getOption("data.pageSize")
                            },
                            sort: f.getDefaultSortColumn(),
                            query: {}
                        }, p.API.params, f.stateGet(f.stateId)), p.API.params = f.extendObj(p.API.params, e, t), f.stateKeep(f.stateId, p.API.params)
                    },
                    getDataSourceParam: function(e) {
                        return p.API.params = g.extend({}, {
                            pagination: {
                                page: 1,
                                perpage: f.getOption("data.pageSize")
                            },
                            sort: f.getDefaultSortColumn(),
                            query: {}
                        }, p.API.params, f.stateGet(f.stateId)), "string" == typeof e ? f.getObject(e, p.API.params) : p.API.params
                    },
                    getDataSourceQuery: function() {
                        return f.getDataSourceParam("query") || {}
                    },
                    setDataSourceQuery: function(e) {
                        f.setDataSourceParam("query", e)
                    },
                    getCurrentPage: function() {
                        return g(p.table).siblings(".m-datatable__pager").last().find(".m-datatable__pager-nav").find(".m-datatable__pager-link.m-datatable__pager-link--active").data("page") || 1
                    },
                    getPageSize: function() {
                        return g(p.table).siblings(".m-datatable__pager").last().find("select.m-datatable__pager-size").val() || 10
                    },
                    getTotalRows: function() {
                        return p.API.params.pagination.total
                    },
                    getDataSet: function() {
                        return p.originalDataSet
                    },
                    hideColumn: function(a) {
                        g.map(u.columns, function(e) {
                            return a === e.field && (e.responsive = {
                                hidden: "xl"
                            }), e
                        });
                        var e = g.grep(g(p.table).find(".m-datatable__cell"), function(e, t) {
                            return a === g(e).data("field")
                        });
                        g(e).hide()
                    },
                    showColumn: function(a) {
                        g.map(u.columns, function(e) {
                            return a === e.field && delete e.responsive, e
                        });
                        var e = g.grep(g(p.table).find(".m-datatable__cell"), function(e, t) {
                            return a === g(e).data("field")
                        });
                        g(e).show()
                    },
                    destroyScroller: function(e) {
                        void 0 === e && (e = p.tableBody), g(e).each(function() {
                            if (g(this).hasClass("mCustomScrollbar")) try {
                                mApp.destroyScroller(g(this))
                            } catch (e) {
                                console.log(e)
                            }
                        })
                    },
                    nodeTr: [],
                    nodeTd: [],
                    nodeCols: [],
                    recentNode: [],
                    table: function() {
                        return p.table
                    },
                    row: function(e) {
                        return f.rows(e), f.nodeTr = f.recentNode = g(f.nodeTr).first(), p
                    },
                    rows: function(e) {
                        return f.nodeTr = f.recentNode = g(p.tableBody).find(e).filter(".m-datatable__row"), p
                    },
                    column: function(e) {
                        return f.nodeCols = f.recentNode = g(p.tableBody).find(".m-datatable__cell:nth-child(" + (e + 1) + ")"), p
                    },
                    columns: function(e) {
                        var t = p.table;
                        f.nodeTr === f.recentNode && (t = f.nodeTr);
                        var a = g(t).find('.m-datatable__cell[data-field="' + e + '"]');
                        return 0 < a.length ? f.nodeCols = f.recentNode = a : f.nodeCols = f.recentNode = g(t).find(e).filter(".m-datatable__cell"), p
                    },
                    cell: function(e) {
                        return f.cells(e), f.nodeTd = f.recentNode = g(f.nodeTd).first(), p
                    },
                    cells: function(e) {
                        var t = g(p.tableBody).find(".m-datatable__cell");
                        return void 0 !== e && (t = g(t).filter(e)), f.nodeTd = f.recentNode = t, p
                    },
                    remove: function() {
                        return g(f.nodeTr.length) && f.nodeTr === f.recentNode && g(f.nodeTr).remove(), f.layoutUpdate(), p
                    },
                    visible: function(e) {
                        if (g(f.recentNode.length)) {
                            var t = f.lockEnabledColumns();
                            if (f.recentNode === f.nodeCols) {
                                var a = f.recentNode.index();
                                if (f.isLocked()) {
                                    var n = g(f.recentNode).closest(".m-datatable__lock--scroll").length;
                                    n ? a += t.left.length + 1 : g(f.recentNode).closest(".m-datatable__lock--right").length && (a += t.left.length + n + 1)
                                }
                            }
                            e ? (f.recentNode === f.nodeCols && delete u.columns[a].responsive, g(f.recentNode).show()) : (f.recentNode === f.nodeCols && f.setOption("columns." + a + ".responsive", {
                                hidden: "xl"
                            }), g(f.recentNode).hide()), f.redraw()
                        }
                    },
                    nodes: function() {
                        return f.recentNode
                    },
                    dataset: function() {
                        return p
                    }
                };
                if (g.each(f, function(e, t) {
                        p[e] = t
                    }), void 0 !== u)
                    if ("string" == typeof u) {
                        var e = u;
                        void 0 !== (p = g(this).data("mDatatable")) && (u = p.options, f[e].apply(this, Array.prototype.slice.call(arguments, 1)))
                    } else p.data("mDatatable") || g(this).hasClass("m-datatable--loaded") || (p.dataSet = null, p.textAlign = {
                        left: "m-datatable__cell--left",
                        center: "m-datatable__cell--center",
                        right: "m-datatable__cell--right"
                    }, u = g.extend(!0, {}, g.fn.mDatatable.defaults, u), p.options = u, f.init.apply(this, [u]), g(p.wrap).data("mDatatable", p));
                else void 0 === (p = g(this).data("mDatatable")) && g.error("mDatatable not initialized"), u = p.options;
                return p
            }
            console.log("No mDatatable element exist.")
        }, g.fn.mDatatable.defaults = {
            data: {
                type: "local",
                source: null,
                pageSize: 10,
                saveState: {
                    cookie: !1,
                    webstorage: !0
                },
                serverPaging: !1,
                serverFiltering: !1,
                serverSorting: !1,
                autoColumns: !1,
                attr: {
                    rowProps: []
                }
            },
            layout: {
                theme: "default",
                class: "m-datatable--brand",
                scroll: !1,
                height: null,
                minHeight: 300,
                footer: !1,
                header: !0,
                smoothScroll: {
                    scrollbarShown: !0
                },
                spinner: {
                    overlayColor: "#000000",
                    opacity: 0,
                    type: "loader",
                    state: "brand",
                    message: !0
                },
                icons: {
                    sort: {
                        asc: "la la-arrow-up",
                        desc: "la la-arrow-down"
                    },
                    pagination: {
                        next: "la la-angle-right",
                        prev: "la la-angle-left",
                        first: "la la-angle-double-left",
                        last: "la la-angle-double-right",
                        more: "la la-ellipsis-h"
                    },
                    rowDetail: {
                        expand: "fa fa-caret-down",
                        collapse: "fa fa-caret-right"
                    }
                }
            },
            sortable: !0,
            resizable: !1,
            filterable: !1,
            pagination: !0,
            editable: !1,
            columns: [],
            search: {
                onEnter: !1,
                input: null,
                delay: 400
            },
            rows: {
                callback: function() {},
                beforeTemplate: function() {},
                afterTemplate: function() {},
                autoHide: !1
            },
            toolbar: {
                layout: ["pagination", "info"],
                placement: ["bottom"],
                items: {
                    pagination: {
                        type: "default",
                        pages: {
                            desktop: {
                                layout: "default",
                                pagesNumber: 6
                            },
                            tablet: {
                                layout: "default",
                                pagesNumber: 3
                            },
                            mobile: {
                                layout: "compact"
                            }
                        },
                        navigation: {
                            prev: !0,
                            next: !0,
                            first: !0,
                            last: !0
                        },
                        pageSizeSelect: []
                    },
                    info: !0
                }
            },
            translate: {
                records: {
                    processing: "Please wait...",
                    noRecords: "No records found"
                },
                toolbar: {
                    pagination: {
                        items: {
                            default: {
                                first: "First",
                                prev: "Previous",
                                next: "Next",
                                last: "Last",
                                more: "More pages",
                                input: "Page number",
                                select: "Select page size"
                            },
                            info: "Displaying {{start}} - {{end}} of {{total}} records"
                        }
                    }
                }
            },
            extensions: {}
        }
    }(jQuery);
var mDropdown = function(e, t) {
    var o = this,
        n = mUtil.get(e),
        i = mUtil.get("body");
    if (n) {
        var a = {
                toggle: "click",
                hoverTimeout: 300,
                skin: "light",
                height: "auto",
                maxHeight: !1,
                minHeight: !1,
                persistent: !1,
                mobileOverlay: !0
            },
            l = {
                construct: function(e) {
                    return mUtil.data(n).has("dropdown") ? o = mUtil.data(n).get("dropdown") : (l.init(e), l.setup(), mUtil.data(n).set("dropdown", o)), o
                },
                init: function(e) {
                    o.options = mUtil.deepExtend({}, a, e), o.events = [], o.eventHandlers = {}, o.open = !1, o.layout = {}, o.layout.close = mUtil.find(n, ".m-dropdown__close"), o.layout.toggle = mUtil.find(n, ".m-dropdown__toggle"), o.layout.arrow = mUtil.find(n, ".m-dropdown__arrow"), o.layout.wrapper = mUtil.find(n, ".m-dropdown__wrapper"), o.layout.defaultDropPos = mUtil.hasClass(n, "m-dropdown--up") ? "up" : "down", o.layout.currentDropPos = o.layout.defaultDropPos, "hover" == mUtil.attr(n, "m-dropdown-toggle") && (o.options.toggle = "hover")
                },
                setup: function() {
                    o.options.placement && mUtil.addClass(n, "m-dropdown--" + o.options.placement), o.options.align && mUtil.addClass(n, "m-dropdown--align-" + o.options.align), o.options.width && mUtil.css(o.layout.wrapper, "width", o.options.width + "px"), "1" == mUtil.attr(n, "m-dropdown-persistent") && (o.options.persistent = !0), "hover" == o.options.toggle && mUtil.addEvent(n, "mouseout", l.hideMouseout), l.setZindex()
                },
                toggle: function() {
                    return o.open ? l.hide() : l.show()
                },
                setContent: function(e) {
                    e = mUtil.find(n, ".m-dropdown__content").innerHTML = e;
                    return o
                },
                show: function() {
                    if ("hover" == o.options.toggle && mUtil.hasAttr(n, "hover")) return l.clearHovered(), o;
                    if (o.open) return o;
                    if (o.layout.arrow && l.adjustArrowPos(), l.eventTrigger("beforeShow"), l.hideOpened(), mUtil.addClass(n, "m-dropdown--open"), mUtil.isMobileDevice() && o.options.mobileOverlay) {
                        var e = mUtil.css(n, "z-index") - 1,
                            t = mUtil.insertAfter(document.createElement("DIV"), n);
                        mUtil.addClass(t, "m-dropdown__dropoff"), mUtil.css(t, "z-index", e), mUtil.data(t).set("dropdown", n), mUtil.data(n).set("dropoff", t), mUtil.addEvent(t, "click", function(e) {
                            l.hide(), mUtil.remove(this), e.preventDefault()
                        })
                    }
                    return n.focus(), n.setAttribute("aria-expanded", "true"), o.open = !0, l.eventTrigger("afterShow"), o
                },
                clearHovered: function() {
                    var e = mUtil.attr(n, "timeout");
                    mUtil.removeAttr(n, "hover"), mUtil.removeAttr(n, "timeout"), clearTimeout(e)
                },
                hideHovered: function(e) {
                    if (!0 === e) {
                        if (!1 === l.eventTrigger("beforeHide")) return;
                        l.clearHovered(), mUtil.removeClass(n, "m-dropdown--open"), o.open = !1, l.eventTrigger("afterHide")
                    } else {
                        if (!0 === mUtil.hasAttr(n, "hover")) return;
                        if (!1 === l.eventTrigger("beforeHide")) return;
                        var t = setTimeout(function() {
                            mUtil.attr(n, "hover") && (l.clearHovered(), mUtil.removeClass(n, "m-dropdown--open"), o.open = !1, l.eventTrigger("afterHide"))
                        }, o.options.hoverTimeout);
                        mUtil.attr(n, "hover", "1"), mUtil.attr(n, "timeout", t)
                    }
                },
                hideClicked: function() {
                    !1 !== l.eventTrigger("beforeHide") && (mUtil.removeClass(n, "m-dropdown--open"), mUtil.data(n).remove("dropoff"), o.open = !1, l.eventTrigger("afterHide"))
                },
                hide: function(e) {
                    return !1 === o.open || (mUtil.isDesktopDevice() && "hover" == o.options.toggle ? l.hideHovered(e) : l.hideClicked(), "down" == o.layout.defaultDropPos && "up" == o.layout.currentDropPos && (mUtil.removeClass(n, "m-dropdown--up"), o.layout.arrow.prependTo(o.layout.wrapper), o.layout.currentDropPos = "down")), o
                },
                hideMouseout: function() {
                    mUtil.isDesktopDevice() && l.hide()
                },
                hideOpened: function() {
                    for (var e = mUtil.findAll(i, ".m-dropdown.m-dropdown--open"), t = 0, a = e.length; t < a; t++) {
                        var n = e[t];
                        mUtil.data(n).get("dropdown").hide(!0)
                    }
                },
                adjustArrowPos: function() {
                    var e = mUtil.outerWidth(n),
                        t = mUtil.hasClass(o.layout.arrow, "m-dropdown__arrow--right") ? "right" : "left",
                        a = 0;
                    o.layout.arrow && (mUtil.isInResponsiveRange("mobile") && mUtil.hasClass(n, "m-dropdown--mobile-full-width") ? (a = mUtil.offset(n).left + e / 2 - Math.abs(parseInt(mUtil.css(o.layout.arrow, "width")) / 2) - parseInt(mUtil.css(o.layout.wrapper, "left")), mUtil.css(o.layout.arrow, "right", "auto"), mUtil.css(o.layout.arrow, "left", a + "px"), mUtil.css(o.layout.arrow, "margin-left", "auto"), mUtil.css(o.layout.arrow, "margin-right", "auto")) : mUtil.hasClass(o.layout.arrow, "m-dropdown__arrow--adjust") && (a = e / 2 - Math.abs(parseInt(mUtil.css(o.layout.arrow, "width")) / 2), mUtil.hasClass(n, "m-dropdown--align-push") && (a += 20), "right" == t ? (mUtil.css(o.layout.arrow, "left", "auto"), mUtil.css(o.layout.arrow, "right", a + "px")) : (mUtil.css(o.layout.arrow, "right", "auto"), mUtil.css(o.layout.arrow, "left", a + "px"))))
                },
                setZindex: function() {
                    var e = 101,
                        t = mUtil.getHighestZindex(n);
                    e <= t && (e = t + 1), mUtil.css(o.layout.wrapper, "z-index", e)
                },
                isPersistent: function() {
                    return o.options.persistent
                },
                isShown: function() {
                    return o.open
                },
                eventTrigger: function(e, t) {
                    for (var a = 0; a < o.events.length; a++) {
                        var n = o.events[a];
                        n.name == e && (1 == n.one ? 0 == n.fired && (o.events[a].fired = !0, n.handler.call(this, o, t)) : n.handler.call(this, o, t))
                    }
                },
                addEvent: function(e, t, a) {
                    o.events.push({
                        name: e,
                        handler: t,
                        one: a,
                        fired: !1
                    })
                }
            };
        return o.setDefaults = function(e) {
            a = e
        }, o.show = function() {
            return l.show()
        }, o.hide = function() {
            return l.hide()
        }, o.toggle = function() {
            return l.toggle()
        }, o.isPersistent = function() {
            return l.isPersistent()
        }, o.isShown = function() {
            return l.isShown()
        }, o.setContent = function(e) {
            return l.setContent(e)
        }, o.on = function(e, t) {
            return l.addEvent(e, t)
        }, o.one = function(e, t) {
            return l.addEvent(e, t, !0)
        }, l.construct.apply(o, [t]), !0, o
    }
};
mUtil.on(document, '[m-dropdown-toggle="click"] .m-dropdown__toggle', "click", function(e) {
    var t = this.closest(".m-dropdown");
    t && ((mUtil.data(t).has("dropdown") ? mUtil.data(t).get("dropdown") : new mDropdown(t)).toggle(), e.preventDefault())
}), mUtil.on(document, '[m-dropdown-toggle="hover"] .m-dropdown__toggle', "click", function(e) {
    if (mUtil.isDesktopDevice()) "#" == mUtil.attr(this, "href") && e.preventDefault();
    else if (mUtil.isMobileDevice()) {
        var t = this.closest(".m-dropdown");
        t && ((mUtil.data(t).has("dropdown") ? mUtil.data(t).get("dropdown") : new mDropdown(t)).toggle(), e.preventDefault())
    }
}), mUtil.on(document, '[m-dropdown-toggle="hover"]', "mouseover", function(e) {
    if (mUtil.isDesktopDevice()) {
        this && ((mUtil.data(this).has("dropdown") ? mUtil.data(this).get("dropdown") : new mDropdown(this)).show(), e.preventDefault())
    }
}), document.addEventListener("click", function(e) {
    var t, a = mUtil.get("body"),
        n = e.target;
    if (t = a.querySelectorAll(".m-dropdown.m-dropdown--open"))
        for (var o = 0, i = t.length; o < i; o++) {
            var l = t[o];
            if (!1 === mUtil.data(l).has("dropdown")) return;
            var r = mUtil.data(l).get("dropdown"),
                s = mUtil.find(l, ".m-dropdown__toggle");
            mUtil.hasClass(l, "m-dropdown--disable-close") && (e.preventDefault(), e.stopPropagation()), s && n !== s && !1 === s.contains(n) && !1 === n.contains(s) ? !0 === r.isPersistent() ? !1 === l.contains(n) && r.hide() : r.hide() : !1 === l.contains(n) && r.hide()
        }
});
var mHeader = function(e, t) {
        var i = this,
            a = mUtil.get(e),
            l = mUtil.get("body");
        if (void 0 !== a) {
            var n = {
                    classic: !1,
                    offset: {
                        mobile: 150,
                        desktop: 200
                    },
                    minimize: {
                        mobile: !1,
                        desktop: !1
                    }
                },
                o = {
                    construct: function(e) {
                        return mUtil.data(a).has("header") ? i = mUtil.data(a).get("header") : (o.init(e), o.build(), mUtil.data(a).set("header", i)), i
                    },
                    init: function(e) {
                        i.events = [], i.options = mUtil.deepExtend({}, n, e)
                    },
                    build: function() {
                        var o = 0;
                        !1 === i.options.minimize.mobile && !1 === i.options.minimize.desktop || window.addEventListener("scroll", function() {
                            var e, t, a, n = 0;
                            mUtil.isInResponsiveRange("desktop") ? (n = i.options.offset.desktop, e = i.options.minimize.desktop.on, t = i.options.minimize.desktop.off) : mUtil.isInResponsiveRange("tablet-and-mobile") && (n = i.options.offset.mobile, e = i.options.minimize.mobile.on, t = i.options.minimize.mobile.off), a = window.pageYOffset, mUtil.isInResponsiveRange("tablet-and-mobile") && i.options.classic && i.options.classic.mobile || mUtil.isInResponsiveRange("desktop") && i.options.classic && i.options.classic.desktop ? n < a ? (mUtil.addClass(l, e), mUtil.removeClass(l, t)) : (mUtil.addClass(l, t), mUtil.removeClass(l, e)) : (n < a && o < a ? (mUtil.addClass(l, e), mUtil.removeClass(l, t)) : (mUtil.addClass(l, t), mUtil.removeClass(l, e)), o = a)
                        })
                    },
                    eventTrigger: function(e, t) {
                        for (var a = 0; a < i.events.length; a++) {
                            var n = i.events[a];
                            n.name == e && (1 == n.one ? 0 == n.fired && (i.events[a].fired = !0, n.handler.call(this, i, t)) : n.handler.call(this, i, t))
                        }
                    },
                    addEvent: function(e, t, a) {
                        i.events.push({
                            name: e,
                            handler: t,
                            one: a,
                            fired: !1
                        })
                    }
                };
            return i.setDefaults = function(e) {
                n = e
            }, i.on = function(e, t) {
                return o.addEvent(e, t)
            }, o.construct.apply(i, [t]), !0, i
        }
    },
    mMenu = function(e, t) {
        var p = this,
            a = !1,
            d = mUtil.get(e),
            i = mUtil.get("body");
        if (d) {
            var n = {
                    autoscroll: {
                        speed: 1200
                    },
                    accordion: {
                        slideSpeed: 200,
                        autoScroll: !0,
                        autoScrollSpeed: 1200,
                        expandAll: !0
                    },
                    dropdown: {
                        timeout: 500
                    }
                },
                f = {
                    construct: function(e) {
                        return mUtil.data(d).has("menu") ? p = mUtil.data(d).get("menu") : (f.init(e), f.reset(), f.build(), mUtil.data(d).set("menu", p)), p
                    },
                    init: function(e) {
                        p.events = [], p.eventHandlers = {}, p.options = mUtil.deepExtend({}, n, e), p.pauseDropdownHoverTime = 0, p.uid = mUtil.getUniqueID()
                    },
                    reload: function() {
                        f.reset(), f.build()
                    },
                    build: function() {
                        p.eventHandlers.event_1 = mUtil.on(d, ".m-menu__toggle", "click", f.handleSubmenuAccordion), ("dropdown" === f.getSubmenuMode() || f.isConditionalSubmenuDropdown()) && (p.eventHandlers.event_2 = mUtil.on(d, '[m-menu-submenu-toggle="hover"]', "mouseover", f.handleSubmenuDrodownHoverEnter), p.eventHandlers.event_3 = mUtil.on(d, '[m-menu-submenu-toggle="hover"]', "mouseout", f.handleSubmenuDrodownHoverExit), p.eventHandlers.event_4 = mUtil.on(d, '[m-menu-submenu-toggle="click"] > .m-menu__toggle, [m-menu-submenu-toggle="click"] > .m-menu__link .m-menu__toggle', "click", f.handleSubmenuDropdownClick), p.eventHandlers.event_5 = mUtil.on(d, '[m-menu-submenu-toggle="tab"] > .m-menu__toggle, [m-menu-submenu-toggle="tab"] > .m-menu__link .m-menu__toggle', "click", f.handleSubmenuDropdownTabClick)), p.eventHandlers.event_6 = mUtil.on(d, ".m-menu__item:not(.m-menu__item--submenu) > .m-menu__link:not(.m-menu__toggle):not(.m-menu__link--toggle-skip)", "click", f.handleLinkClick)
                    },
                    reset: function() {
                        mUtil.off(d, "click", p.eventHandlers.event_1), mUtil.off(d, "mouseover", p.eventHandlers.event_2), mUtil.off(d, "mouseout", p.eventHandlers.event_3), mUtil.off(d, "click", p.eventHandlers.event_4), mUtil.off(d, "click", p.eventHandlers.event_5), mUtil.off(d, "click", p.eventHandlers.event_6)
                    },
                    getSubmenuMode: function() {
                        return mUtil.isInResponsiveRange("desktop") ? mUtil.isset(p.options.submenu, "desktop.state.body") ? mUtil.hasClass(i, p.options.submenu.desktop.state.body) ? p.options.submenu.desktop.state.mode : p.options.submenu.desktop.default : mUtil.isset(p.options.submenu, "desktop") ? p.options.submenu.desktop : void 0 : mUtil.isInResponsiveRange("tablet") && mUtil.isset(p.options.submenu, "tablet") ? p.options.submenu.tablet : !(!mUtil.isInResponsiveRange("mobile") || !mUtil.isset(p.options.submenu, "mobile")) && p.options.submenu.mobile
                    },
                    isConditionalSubmenuDropdown: function() {
                        return !(!mUtil.isInResponsiveRange("desktop") || !mUtil.isset(p.options.submenu, "desktop.state.body"))
                    },
                    handleLinkClick: function(e) {
                        !1 === f.eventTrigger("linkClick", this) && e.preventDefault(), ("dropdown" === f.getSubmenuMode() || f.isConditionalSubmenuDropdown()) && f.handleSubmenuDropdownClose(e, this)
                    },
                    handleSubmenuDrodownHoverEnter: function(e) {
                        if ("accordion" !== f.getSubmenuMode() && !1 !== p.resumeDropdownHover()) {
                            var t = this;
                            "1" == t.getAttribute("data-hover") && (t.removeAttribute("data-hover"), clearTimeout(t.getAttribute("data-timeout")), t.removeAttribute("data-timeout")), f.showSubmenuDropdown(t)
                        }
                    },
                    handleSubmenuDrodownHoverExit: function(e) {
                        if (!1 !== p.resumeDropdownHover() && "accordion" !== f.getSubmenuMode()) {
                            var t = this,
                                a = p.options.dropdown.timeout,
                                n = setTimeout(function() {
                                    "1" == t.getAttribute("data-hover") && f.hideSubmenuDropdown(t, !0)
                                }, a);
                            t.setAttribute("data-hover", "1"), t.setAttribute("data-timeout", n)
                        }
                    },
                    handleSubmenuDropdownClick: function(e) {
                        if ("accordion" !== f.getSubmenuMode()) {
                            var t = this.closest(".m-menu__item");
                            "accordion" != t.getAttribute("m-menu-submenu-mode") && (!1 === mUtil.hasClass(t, "m-menu__item--hover") ? (mUtil.addClass(t, "m-menu__item--open-dropdown"), f.showSubmenuDropdown(t)) : (mUtil.removeClass(t, "m-menu__item--open-dropdown"), f.hideSubmenuDropdown(t, !0)), e.preventDefault())
                        }
                    },
                    handleSubmenuDropdownTabClick: function(e) {
                        if ("accordion" !== f.getSubmenuMode()) {
                            var t = this.closest(".m-menu__item");
                            "accordion" != t.getAttribute("m-menu-submenu-mode") && (0 == mUtil.hasClass(t, "m-menu__item--hover") && (mUtil.addClass(t, "m-menu__item--open-dropdown"), f.showSubmenuDropdown(t)), e.preventDefault())
                        }
                    },
                    handleSubmenuDropdownClose: function(e, t) {
                        if ("accordion" !== f.getSubmenuMode()) {
                            var a = d.querySelectorAll(".m-menu__item.m-menu__item--submenu.m-menu__item--hover:not(.m-menu__item--tabs)");
                            if (0 < a.length && !1 === mUtil.hasClass(t, "m-menu__toggle") && 0 === t.querySelectorAll(".m-menu__toggle").length)
                                for (var n = 0, o = a.length; n < o; n++) f.hideSubmenuDropdown(a[0], !0)
                        }
                    },
                    handleSubmenuAccordion: function(e, t) {
                        var a, n = t || this;
                        if ("dropdown" === f.getSubmenuMode() && (a = n.closest(".m-menu__item")) && "accordion" != a.getAttribute("m-menu-submenu-mode")) e.preventDefault();
                        else {
                            var o = n.closest(".m-menu__item"),
                                i = mUtil.child(o, ".m-menu__submenu, .m-menu__inner");
                            if (!mUtil.hasClass(n.closest(".m-menu__item"), "m-menu__item--open-always") && o && i) {
                                e.preventDefault();
                                var l = p.options.accordion.slideSpeed;
                                if (!1 === mUtil.hasClass(o, "m-menu__item--open")) {
                                    if (!1 === p.options.accordion.expandAll) {
                                        var r = n.closest(".m-menu__nav, .m-menu__subnav"),
                                            s = mUtil.children(r, ".m-menu__item.m-menu__item--open.m-menu__item--submenu:not(.m-menu__item--expanded):not(.m-menu__item--open-always)");
                                        if (r && s)
                                            for (var d = 0, c = s.length; d < c; d++) {
                                                var m = s[0],
                                                    u = mUtil.child(m, ".m-menu__submenu");
                                                u && mUtil.slideUp(u, l, function() {
                                                    mUtil.removeClass(m, "m-menu__item--open")
                                                })
                                            }
                                    }
                                    mUtil.slideDown(i, l, function() {
                                        f.scrollToItem(n)
                                    }), mUtil.addClass(o, "m-menu__item--open")
                                } else mUtil.slideUp(i, l, function() {
                                    f.scrollToItem(n)
                                }), mUtil.removeClass(o, "m-menu__item--open")
                            }
                        }
                    },
                    scrollToItem: function(e) {
                        mUtil.isInResponsiveRange("desktop") && p.options.accordion.autoScroll && "1" !== d.getAttribute("m-menu-scrollable") && mUtil.scrollToCenter(e, p.options.accordion.autoScrollSpeed)
                    },
                    hideSubmenuDropdown: function(e, t) {
                        t && (mUtil.removeClass(e, "m-menu__item--hover"), mUtil.removeClass(e, "m-menu__item--active-tab")), e.removeAttribute("data-hover"), e.getAttribute("m-menu-dropdown-toggle-class") && mUtil.removeClass(i, e.getAttribute("m-menu-dropdown-toggle-class"));
                        var a = e.getAttribute("data-timeout");
                        e.removeAttribute("data-timeout"), clearTimeout(a)
                    },
                    showSubmenuDropdown: function(e) {
                        var t = d.querySelectorAll(".m-menu__item--submenu.m-menu__item--hover, .m-menu__item--submenu.m-menu__item--active-tab");
                        if (t)
                            for (var a = 0, n = t.length; a < n; a++) {
                                var o = t[a];
                                e !== o && !1 === o.contains(e) && !1 === e.contains(o) && f.hideSubmenuDropdown(o, !0)
                            }
                        f.adjustSubmenuDropdownArrowPos(e), mUtil.addClass(e, "m-menu__item--hover"), e.getAttribute("m-menu-dropdown-toggle-class") && mUtil.addClass(i, e.getAttribute("m-menu-dropdown-toggle-class"))
                    },
                    createSubmenuDropdownClickDropoff: function(t) {
                        var e, a = (e = mUtil.child(t, ".m-menu__submenu") ? mUtil.css(e, "z-index") : 0) - 1,
                            n = document.createElement('<div class="m-menu__dropoff" style="background: transparent; position: fixed; top: 0; bottom: 0; left: 0; right: 0; z-index: ' + a + '"></div>');
                        i.appendChild(n), mUtil.addEvent(n, "click", function(e) {
                            e.stopPropagation(), e.preventDefault(), mUtil.remove(this), f.hideSubmenuDropdown(t, !0)
                        })
                    },
                    adjustSubmenuDropdownArrowPos: function(e) {
                        var t = mUtil.child(e, ".m-menu__submenu"),
                            a = mUtil.child(t, ".m-menu__arrow.m-menu__arrow--adjust");
                        mUtil.child(t, ".m-menu__subnav");
                        if (a) {
                            var n = 0;
                            mUtil.child(e, ".m-menu__link");
                            mUtil.hasClass(t, "m-menu__submenu--classic") || mUtil.hasClass(t, "m-menu__submenu--fixed") ? mUtil.hasClass(t, "m-menu__submenu--right") ? (n = mUtil.outerWidth(e) / 2, mUtil.hasClass(t, "m-menu__submenu--pull") && (n += Math.abs(parseFloat(mUtil.css(t, "margin-right")))), n = parseInt(mUtil.css(t, "width")) - n) : mUtil.hasClass(t, "m-menu__submenu--left") && (n = mUtil.outerWidth(e) / 2, mUtil.hasClass(t, "m-menu__submenu--pull") && (n += Math.abs(parseFloat(mUtil.css(t, "margin-left"))))) : (mUtil.hasClass(t, "m-menu__submenu--center") || mUtil.hasClass(t, "m-menu__submenu--full")) && (n = mUtil.offset(e).left - (mUtil.getViewPort().width - parseInt(mUtil.css(t, "width"))) / 2, n += mUtil.outerWidth(e) / 2), mUtil.css(a, "left", n + "px")
                        }
                    },
                    pauseDropdownHover: function(e) {
                        var t = new Date;
                        p.pauseDropdownHoverTime = t.getTime() + e
                    },
                    resumeDropdownHover: function() {
                        return (new Date).getTime() > p.pauseDropdownHoverTime
                    },
                    resetActiveItem: function(e) {
                        for (var t, a, n = 0, o = (t = d.querySelectorAll(".m-menu__item--active")).length; n < o; n++) {
                            var i = t[0];
                            mUtil.removeClass(i, "m-menu__item--active"), mUtil.hide(mUtil.child(i, ".m-menu__submenu"));
                            for (var l = 0, r = (a = mUtil.parents(i, ".m-menu__item--submenu")).length; l < r; l++) {
                                var s = a[n];
                                mUtil.removeClass(s, "m-menu__item--open"), mUtil.hide(mUtil.child(s, ".m-menu__submenu"))
                            }
                        }
                        if (!1 === p.options.accordion.expandAll && (t = d.querySelectorAll(".m-menu__item--open")))
                            for (n = 0, o = t.length; n < o; n++) mUtil.removeClass(a[0], "m-menu__item--open")
                    },
                    setActiveItem: function(e) {
                        f.resetActiveItem(), mUtil.addClass(e, "m-menu__item--active");
                        for (var t = mUtil.parents(e, ".m-menu__item--submenu"), a = 0, n = t.length; a < n; a++) mUtil.addClass(t[a], "m-menu__item--open")
                    },
                    getBreadcrumbs: function(e) {
                        var t, a = [],
                            n = mUtil.child(e, ".m-menu__link");
                        a.push({
                            text: t = mUtil.child(n, ".m-menu__link-text") ? t.innerHTML : "",
                            title: n.getAttribute("title"),
                            href: n.getAttribute("href")
                        });
                        for (var o = mUtil.parents(e, ".m-menu__item--submenu"), i = 0, l = o.length; i < l; i++) {
                            var r = mUtil.child(o[i], ".m-menu__link");
                            a.push({
                                text: t = mUtil.child(r, ".m-menu__link-text") ? t.innerHTML : "",
                                title: r.getAttribute("title"),
                                href: r.getAttribute("href")
                            })
                        }
                        return a.reverse()
                    },
                    getPageTitle: function(e) {
                        var t;
                        return mUtil.child(e, ".m-menu__link-text") ? t.innerHTML : ""
                    },
                    eventTrigger: function(e, t) {
                        for (var a = 0; a < p.events.length; a++) {
                            var n = p.events[a];
                            n.name == e && (1 == n.one ? 0 == n.fired && (p.events[a].fired = !0, n.handler.call(this, p, t)) : n.handler.call(this, p, t))
                        }
                    },
                    addEvent: function(e, t, a) {
                        p.events.push({
                            name: e,
                            handler: t,
                            one: a,
                            fired: !1
                        })
                    }
                };
            return p.setDefaults = function(e) {
                n = e
            }, p.setActiveItem = function(e) {
                return f.setActiveItem(e)
            }, p.reload = function() {
                return f.reload()
            }, p.getBreadcrumbs = function(e) {
                return f.getBreadcrumbs(e)
            }, p.getPageTitle = function(e) {
                return f.getPageTitle(e)
            }, p.getSubmenuMode = function() {
                return f.getSubmenuMode()
            }, p.hideDropdown = function(e) {
                f.hideSubmenuDropdown(e, !0)
            }, p.pauseDropdownHover = function(e) {
                f.pauseDropdownHover(e)
            }, p.resumeDropdownHover = function() {
                return f.resumeDropdownHover()
            }, p.on = function(e, t) {
                return f.addEvent(e, t)
            }, p.one = function(e, t) {
                return f.addEvent(e, t, !0)
            }, f.construct.apply(p, [t]), mUtil.addResizeHandler(function() {
                a && p.reload()
            }), a = !0, p
        }
    };
document.addEventListener("click", function(e) {
    var t;
    if (t = mUtil.get("body").querySelectorAll('.m-menu__nav .m-menu__item.m-menu__item--submenu.m-menu__item--hover:not(.m-menu__item--tabs)[m-menu-submenu-toggle="click"]'))
        for (var a = 0, n = t.length; a < n; a++) {
            var o = t[a].closest(".m-menu__nav").parentNode;
            if (o) {
                var i, l = mUtil.data(o).get("menu");
                if (!l) break;
                if (!l || "dropdown" !== l.getSubmenuMode()) break;
                if (e.target !== o && !1 === o.contains(e.target))
                    if (i = o.querySelectorAll('.m-menu__item--submenu.m-menu__item--hover:not(.m-menu__item--tabs)[m-menu-submenu-toggle="click"]'))
                        for (var r = 0, s = i.length; r < s; r++) l.hideDropdown(i[r])
            }
        }
});
var mOffcanvas = function(e, t) {
        var l = this,
            a = mUtil.get(e),
            n = mUtil.get("body");
        if (a) {
            var o = {},
                i = {
                    construct: function(e) {
                        return mUtil.data(a).has("offcanvas") ? l = mUtil.data(a).get("offcanvas") : (i.init(e), i.build(), mUtil.data(a).set("offcanvas", l)), l
                    },
                    init: function(e) {
                        l.events = [], l.options = mUtil.deepExtend({}, o, e), l.overlay, l.classBase = l.options.baseClass, l.classShown = l.classBase + "--on", l.classOverlay = l.classBase + "-overlay", l.state = mUtil.hasClass(a, l.classShown) ? "shown" : "hidden"
                    },
                    build: function() {
                        if (l.options.toggleBy)
                            if ("string" == typeof l.options.toggleBy) mUtil.addEvent(l.options.toggleBy, "click", i.toggle);
                            else if (l.options.toggleBy && l.options.toggleBy[0] && l.options.toggleBy[0].target)
                            for (var e in l.options.toggleBy) mUtil.addEvent(l.options.toggleBy[e].target, "click", i.toggle);
                        else l.options.toggleBy && l.options.toggleBy.target && mUtil.addEvent(l.options.toggleBy.target, "click", i.toggle);
                        var t = mUtil.get(l.options.closeBy);
                        t && mUtil.addEvent(t, "click", i.hide)
                    },
                    toggle: function() {
                        i.eventTrigger("toggle"), "shown" == l.state ? i.hide(this) : i.show(this)
                    },
                    show: function(t) {
                        "shown" != l.state && (i.eventTrigger("beforeShow"), i.togglerClass(t, "show"), mUtil.addClass(n, l.classShown), mUtil.addClass(a, l.classShown), l.state = "shown", l.options.overlay && (l.overlay = mUtil.insertAfter(document.createElement("DIV"), a), mUtil.addClass(l.overlay, l.classOverlay), mUtil.addEvent(l.overlay, "click", function(e) {
                            e.stopPropagation(), e.preventDefault(), i.hide(t)
                        })), i.eventTrigger("afterShow"))
                    },
                    hide: function(e) {
                        "hidden" != l.state && (i.eventTrigger("beforeHide"), i.togglerClass(e, "hide"), mUtil.removeClass(n, l.classShown), mUtil.removeClass(a, l.classShown), l.state = "hidden", l.options.overlay && l.overlay && mUtil.remove(l.overlay), i.eventTrigger("afterHide"))
                    },
                    togglerClass: function(e, t) {
                        var a, n = mUtil.attr(e, "id");
                        if (l.options.toggleBy && l.options.toggleBy[0] && l.options.toggleBy[0].target)
                            for (var o in l.options.toggleBy) l.options.toggleBy[o].target === n && (a = l.options.toggleBy[o]);
                        else l.options.toggleBy && l.options.toggleBy.target && (a = l.options.toggleBy);
                        if (a) {
                            var i = mUtil.get(a.target);
                            "show" === t && mUtil.addClass(i, a.state), "hide" === t && mUtil.removeClass(i, a.state)
                        }
                    },
                    eventTrigger: function(e, t) {
                        for (var a = 0; a < l.events.length; a++) {
                            var n = l.events[a];
                            n.name == e && (1 == n.one ? 0 == n.fired && (l.events[a].fired = !0, n.handler.call(this, l, t)) : n.handler.call(this, l, t))
                        }
                    },
                    addEvent: function(e, t, a) {
                        l.events.push({
                            name: e,
                            handler: t,
                            one: a,
                            fired: !1
                        })
                    }
                };
            return l.setDefaults = function(e) {
                o = e
            }, l.hide = function() {
                return i.hide()
            }, l.show = function() {
                return i.show()
            }, l.on = function(e, t) {
                return i.addEvent(e, t)
            }, l.one = function(e, t) {
                return i.addEvent(e, t, !0)
            }, i.construct.apply(l, [t]), !0, l
        }
    },
    mPortlet = function(e, t) {
        var s = this,
            d = mUtil.get(e),
            c = mUtil.get("body");
        if (d) {
            var a = {
                    bodyToggleSpeed: 400,
                    tooltips: !0,
                    tools: {
                        toggle: {
                            collapse: "Collapse",
                            expand: "Expand"
                        },
                        reload: "Reload",
                        remove: "Remove",
                        fullscreen: {
                            on: "Fullscreen",
                            off: "Exit Fullscreen"
                        }
                    }
                },
                o = {
                    construct: function(e) {
                        return mUtil.data(d).has("portlet") ? s = mUtil.data(d).get("portlet") : (o.init(e), o.build(), mUtil.data(d).set("portlet", s)), s
                    },
                    init: function(e) {
                        s.element = d, s.events = [], s.options = mUtil.deepExtend({}, a, e), s.head = mUtil.child(d, ".m-portlet__head"), s.foot = mUtil.child(d, ".m-portlet__foot"), mUtil.child(d, ".m-portlet__body") ? s.body = mUtil.child(d, ".m-portlet__body") : 0 !== mUtil.child(d, ".m-form").length && (s.body = mUtil.child(d, ".m-form"))
                    },
                    build: function() {
                        var e = mUtil.find(s.head, "[m-portlet-tool=remove]");
                        e && mUtil.addEvent(e, "click", function(e) {
                            e.preventDefault(), o.remove()
                        });
                        var t = mUtil.find(s.head, "[m-portlet-tool=reload]");
                        t && mUtil.addEvent(t, "click", function(e) {
                            e.preventDefault(), o.reload()
                        });
                        var a = mUtil.find(s.head, "[m-portlet-tool=toggle]");
                        a && mUtil.addEvent(a, "click", function(e) {
                            e.preventDefault(), o.toggle()
                        });
                        var n = mUtil.find(s.head, "[m-portlet-tool=fullscreen]");
                        n && mUtil.addEvent(n, "click", function(e) {
                            e.preventDefault(), o.fullscreen()
                        }), o.setupTooltips()
                    },
                    remove: function() {
                        !1 !== o.eventTrigger("beforeRemove") && (mUtil.hasClass(c, "m-portlet--fullscreen") && mUtil.hasClass(d, "m-portlet--fullscreen") && o.fullscreen("off"), o.removeTooltips(), mUtil.remove(d), o.eventTrigger("afterRemove"))
                    },
                    setContent: function(e) {
                        e && (s.body.innerHTML = e)
                    },
                    getBody: function() {
                        return s.body
                    },
                    getSelf: function() {
                        return d
                    },
                    setupTooltips: function() {
                        if (s.options.tooltips) {
                            var e = mUtil.hasClass(d, "m-portlet--collapse") || mUtil.hasClass(d, "m-portlet--collapsed"),
                                t = mUtil.hasClass(c, "m-portlet--fullscreen") && mUtil.hasClass(d, "m-portlet--fullscreen"),
                                a = mUtil.find(s.head, "[m-portlet-tool=remove]");
                            if (a) {
                                var n = t ? "bottom" : "top",
                                    o = new Tooltip(a, {
                                        title: s.options.tools.remove,
                                        placement: n,
                                        offset: t ? "0,10px,0,0" : "0,5px",
                                        trigger: "hover",
                                        template: '<div class="m-tooltip m-tooltip--portlet tooltip bs-tooltip-' + n + '" role="tooltip">                            <div class="tooltip-arrow arrow"></div>                            <div class="tooltip-inner"></div>                        </div>'
                                    });
                                mUtil.data(a).set("tooltip", o)
                            }
                            var i = mUtil.find(s.head, "[m-portlet-tool=reload]");
                            if (i) {
                                n = t ? "bottom" : "top", o = new Tooltip(i, {
                                    title: s.options.tools.reload,
                                    placement: n,
                                    offset: t ? "0,10px,0,0" : "0,5px",
                                    trigger: "hover",
                                    template: '<div class="m-tooltip m-tooltip--portlet tooltip bs-tooltip-' + n + '" role="tooltip">                            <div class="tooltip-arrow arrow"></div>                            <div class="tooltip-inner"></div>                        </div>'
                                });
                                mUtil.data(i).set("tooltip", o)
                            }
                            var l = mUtil.find(s.head, "[m-portlet-tool=toggle]");
                            if (l) {
                                n = t ? "bottom" : "top", o = new Tooltip(l, {
                                    title: e ? s.options.tools.toggle.expand : s.options.tools.toggle.collapse,
                                    placement: n,
                                    offset: t ? "0,10px,0,0" : "0,5px",
                                    trigger: "hover",
                                    template: '<div class="m-tooltip m-tooltip--portlet tooltip bs-tooltip-' + n + '" role="tooltip">                            <div class="tooltip-arrow arrow"></div>                            <div class="tooltip-inner"></div>                        </div>'
                                });
                                mUtil.data(l).set("tooltip", o)
                            }
                            var r = mUtil.find(s.head, "[m-portlet-tool=fullscreen]");
                            if (r) {
                                n = t ? "bottom" : "top", o = new Tooltip(r, {
                                    title: t ? s.options.tools.fullscreen.off : s.options.tools.fullscreen.on,
                                    placement: n,
                                    offset: t ? "0,10px,0,0" : "0,5px",
                                    trigger: "hover",
                                    template: '<div class="m-tooltip m-tooltip--portlet tooltip bs-tooltip-' + n + '" role="tooltip">                            <div class="tooltip-arrow arrow"></div>                            <div class="tooltip-inner"></div>                        </div>'
                                });
                                mUtil.data(r).set("tooltip", o)
                            }
                        }
                    },
                    removeTooltips: function() {
                        if (s.options.tooltips) {
                            var e = mUtil.find(s.head, "[m-portlet-tool=remove]");
                            e && mUtil.data(e).has("tooltip") && mUtil.data(e).get("tooltip").dispose();
                            var t = mUtil.find(s.head, "[m-portlet-tool=reload]");
                            t && mUtil.data(t).has("tooltip") && mUtil.data(t).get("tooltip").dispose();
                            var a = mUtil.find(s.head, "[m-portlet-tool=toggle]");
                            a && mUtil.data(a).has("tooltip") && mUtil.data(a).get("tooltip").dispose();
                            var n = mUtil.find(s.head, "[m-portlet-tool=fullscreen]");
                            n && mUtil.data(n).has("tooltip") && mUtil.data(n).get("tooltip").dispose()
                        }
                    },
                    reload: function() {
                        o.eventTrigger("reload")
                    },
                    toggle: function() {
                        mUtil.hasClass(d, "m-portlet--collapse") || mUtil.hasClass(d, "m-portlet--collapsed") ? o.expand() : o.collapse()
                    },
                    collapse: function() {
                        if (!1 !== o.eventTrigger("beforeCollapse")) {
                            mUtil.slideUp(s.body, s.options.bodyToggleSpeed, function() {
                                o.eventTrigger("afterCollapse")
                            }), mUtil.addClass(d, "m-portlet--collapse");
                            var e = mUtil.find(s.head, "[m-portlet-tool=toggle]");
                            e && mUtil.data(e).has("tooltip") && mUtil.data(e).get("tooltip").updateTitleContent(s.options.tools.toggle.expand)
                        }
                    },
                    expand: function() {
                        if (!1 !== o.eventTrigger("beforeExpand")) {
                            mUtil.slideDown(s.body, s.options.bodyToggleSpeed, function() {
                                o.eventTrigger("afterExpand")
                            }), mUtil.removeClass(d, "m-portlet--collapse"), mUtil.removeClass(d, "m-portlet--collapsed");
                            var e = mUtil.find(s.head, "[m-portlet-tool=toggle]");
                            e && mUtil.data(e).has("tooltip") && mUtil.data(e).get("tooltip").updateTitleContent(s.options.tools.toggle.collapse)
                        }
                    },
                    fullscreen: function(e) {
                        if ("off" === e || mUtil.hasClass(c, "m-portlet--fullscreen") && mUtil.hasClass(d, "m-portlet--fullscreen")) o.eventTrigger("beforeFullscreenOff"), mUtil.removeClass(c, "m-portlet--fullscreen"), mUtil.removeClass(d, "m-portlet--fullscreen"), o.removeTooltips(), o.setupTooltips(), s.foot && (mUtil.css(s.body, "margin-bottom", ""), mUtil.css(s.foot, "margin-top", "")), o.eventTrigger("afterFullscreenOff");
                        else {
                            if (o.eventTrigger("beforeFullscreenOn"), mUtil.addClass(d, "m-portlet--fullscreen"), mUtil.addClass(c, "m-portlet--fullscreen"), o.removeTooltips(), o.setupTooltips(), s.foot) {
                                var t = parseInt(mUtil.css(s.foot, "height")),
                                    a = parseInt(mUtil.css(s.foot, "height")) + parseInt(mUtil.css(s.head, "height"));
                                mUtil.css(s.body, "margin-bottom", t + "px"), mUtil.css(s.foot, "margin-top", "-" + a + "px")
                            }
                            o.eventTrigger("afterFullscreenOn")
                        }
                    },
                    eventTrigger: function(e) {
                        for (i = 0; i < s.events.length; i++) {
                            var t = s.events[i];
                            t.name == e && (1 == t.one ? 0 == t.fired && (s.events[i].fired = !0, t.handler.call(this, s)) : t.handler.call(this, s))
                        }
                    },
                    addEvent: function(e, t, a) {
                        return s.events.push({
                            name: e,
                            handler: t,
                            one: a,
                            fired: !1
                        }), s
                    }
                };
            return s.setDefaults = function(e) {
                a = e
            }, s.remove = function() {
                return o.remove(html)
            }, s.reload = function() {
                return o.reload()
            }, s.setContent = function(e) {
                return o.setContent(e)
            }, s.toggle = function() {
                return o.toggle()
            }, s.collapse = function() {
                return o.collapse()
            }, s.expand = function() {
                return o.expand()
            }, s.fullscreen = function() {
                return o.fullscreen("on")
            }, s.unFullscreen = function() {
                return o.fullscreen("off")
            }, s.getBody = function() {
                return o.getBody()
            }, s.getSelf = function() {
                return o.getSelf()
            }, s.on = function(e, t) {
                return o.addEvent(e, t)
            }, s.one = function(e, t) {
                return o.addEvent(e, t, !0)
            }, o.construct.apply(s, [t]), s
        }
    },
    mQuicksearch = function(e, t) {
        var n = this,
            a = mUtil.get(e),
            o = mUtil.get("body");
        if (a) {
            var l = {
                    mode: "default",
                    minLength: 1,
                    maxHeight: 300,
                    requestTimeout: 200,
                    inputTarget: "m_quicksearch_input",
                    iconCloseTarget: "m_quicksearch_close",
                    iconCancelTarget: "m_quicksearch_cancel",
                    iconSearchTarget: "m_quicksearch_search",
                    spinnerClass: "m-loader m-loader--skin-light m-loader--right",
                    hasResultClass: "m-list-search--has-result",
                    templates: {
                        error: '<div class="m-search-results m-search-results--skin-light"><span class="m-search-result__message">{{message}}</div></div>'
                    }
                },
                r = {
                    construct: function(e) {
                        return mUtil.data(a).has("quicksearch") ? n = mUtil.data(a).get("quicksearch") : (r.init(e), r.build(), mUtil.data(a).set("quicksearch", n)), n
                    },
                    init: function(e) {
                        n.element = a, n.events = [], n.options = mUtil.deepExtend({}, l, e), n.query = "", n.form = mUtil.find(a, "form"), n.input = mUtil.get(n.options.inputTarget), n.iconClose = mUtil.get(n.options.iconCloseTarget), "default" == n.options.mode && (n.iconSearch = mUtil.get(n.options.iconSearchTarget), n.iconCancel = mUtil.get(n.options.iconCancelTarget)), n.dropdown = new mDropdown(a, {
                            mobileOverlay: !1
                        }), n.cancelTimeout, n.processing = !1, n.requestTimeout = !1
                    },
                    build: function() {
                        mUtil.addEvent(n.input, "keyup", r.search), "default" == n.options.mode ? (mUtil.addEvent(n.input, "focus", r.showDropdown), mUtil.addEvent(n.iconCancel, "click", r.handleCancel), mUtil.addEvent(n.iconSearch, "click", function() {
                            mUtil.isInResponsiveRange("tablet-and-mobile") && (mUtil.addClass(o, "m-header-search--mobile-expanded"), n.input.focus())
                        }), mUtil.addEvent(n.iconClose, "click", function() {
                            mUtil.isInResponsiveRange("tablet-and-mobile") && (mUtil.removeClass(o, "m-header-search--mobile-expanded"), r.closeDropdown())
                        })) : "dropdown" == n.options.mode && (n.dropdown.on("afterShow", function() {
                            n.input.focus()
                        }), mUtil.addEvent(n.iconClose, "click", r.closeDropdown))
                    },
                    showProgress: function() {
                        return n.processing = !0, mUtil.addClass(n.form, n.options.spinnerClass), r.handleCancelIconVisibility("off"), n
                    },
                    hideProgress: function() {
                        return n.processing = !1, mUtil.removeClass(n.form, n.options.spinnerClass), r.handleCancelIconVisibility("on"), mUtil.addClass(a, n.options.hasResultClass), n
                    },
                    search: function(e) {
                        if (n.query = n.input.value, 0 === n.query.length && (r.handleCancelIconVisibility("on"), mUtil.removeClass(a, n.options.hasResultClass), mUtil.removeClass(n.form, n.options.spinnerClass)), !(n.query.length < n.options.minLength || 1 == n.processing)) return n.requestTimeout && clearTimeout(n.requestTimeout), n.requestTimeout = !1, n.requestTimeout = setTimeout(function() {
                            r.eventTrigger("search")
                        }, n.options.requestTimeout), n
                    },
                    handleCancelIconVisibility: function(e) {
                        "on" == e ? 0 === n.input.value.length ? (n.iconCancel && mUtil.css(n.iconCancel, "visibility", "hidden"), n.iconClose && mUtil.css(n.iconClose, "visibility", "visible")) : (clearTimeout(n.cancelTimeout), n.cancelTimeout = setTimeout(function() {
                            n.iconCancel && mUtil.css(n.iconCancel, "visibility", "visible"), n.iconClose && mUtil.css(n.iconClose, "visibility", "visible")
                        }, 500)) : (n.iconCancel && mUtil.css(n.iconCancel, "visibility", "hidden"), n.iconClose && mUtil.css(n.iconClose, "visibility", "hidden"))
                    },
                    handleCancel: function(e) {
                        n.input.value = "", mUtil.css(n.iconCancel, "visibility", "hidden"), mUtil.removeClass(a, n.options.hasResultClass), r.closeDropdown()
                    },
                    closeDropdown: function() {
                        n.dropdown.hide()
                    },
                    showDropdown: function(e) {
                        0 == n.dropdown.isShown() && n.input.value.length > n.options.minLength && 0 == n.processing && (console.log("show!!!"), n.dropdown.show(), e && (e.preventDefault(), e.stopPropagation()))
                    },
                    eventTrigger: function(e) {
                        for (i = 0; i < n.events.length; i++) {
                            var t = n.events[i];
                            t.name == e && (1 == t.one ? 0 == t.fired && (n.events[i].fired = !0, t.handler.call(this, n)) : t.handler.call(this, n))
                        }
                    },
                    addEvent: function(e, t, a) {
                        return n.events.push({
                            name: e,
                            handler: t,
                            one: a,
                            fired: !1
                        }), n
                    }
                };
            return n.setDefaults = function(e) {
                l = e
            }, n.search = function() {
                return r.handleSearch()
            }, n.showResult = function(e) {
                return n.dropdown.setContent(e), r.showDropdown(), n
            }, n.showError = function(e) {
                var t = n.options.templates.error.replace("{{message}}", e);
                return n.dropdown.setContent(t), r.showDropdown(), n
            }, n.showProgress = function() {
                return r.showProgress()
            }, n.hideProgress = function() {
                return r.hideProgress()
            }, n.search = function() {
                return r.search()
            }, n.on = function(e, t) {
                return r.addEvent(e, t)
            }, n.one = function(e, t) {
                return r.addEvent(e, t, !0)
            }, r.construct.apply(n, [t]), n
        }
    },
    mScrollTop = function(e, t) {
        var o = this,
            a = mUtil.get(e),
            n = mUtil.get("body");
        if (a) {
            var i = {
                    offset: 300,
                    speed: 600
                },
                l = {
                    construct: function(e) {
                        return mUtil.data(a).has("scrolltop") ? o = mUtil.data(a).get("scrolltop") : (l.init(e), l.build(), mUtil.data(a).set("scrolltop", o)), o
                    },
                    init: function(e) {
                        o.events = [], o.options = mUtil.deepExtend({}, i, e)
                    },
                    build: function() {
                        navigator.userAgent.match(/iPhone|iPad|iPod/i) ? (window.addEventListener("touchend", function() {
                            l.handle()
                        }), window.addEventListener("touchcancel", function() {
                            l.handle()
                        }), window.addEventListener("touchleave", function() {
                            l.handle()
                        })) : window.addEventListener("scroll", function() {
                            l.handle()
                        }), mUtil.addEvent(a, "click", l.scroll)
                    },
                    handle: function() {
                        window.pageYOffset > o.options.offset ? mUtil.addClass(n, "m-scroll-top--shown") : mUtil.removeClass(n, "m-scroll-top--shown")
                    },
                    scroll: function(e) {
                        e.preventDefault(), mUtil.scrollTop(o.options.speed)
                    },
                    eventTrigger: function(e, t) {
                        for (var a = 0; a < o.events.length; a++) {
                            var n = o.events[a];
                            n.name == e && (1 == n.one ? 0 == n.fired && (o.events[a].fired = !0, n.handler.call(this, o, t)) : n.handler.call(this, o, t))
                        }
                    },
                    addEvent: function(e, t, a) {
                        o.events.push({
                            name: e,
                            handler: t,
                            one: a,
                            fired: !1
                        })
                    }
                };
            return o.setDefaults = function(e) {
                i = e
            }, o.on = function(e, t) {
                return l.addEvent(e, t)
            }, o.one = function(e, t) {
                return l.addEvent(e, t, !0)
            }, l.construct.apply(o, [t]), !0, o
        }
    },
    mToggle = function(e, t) {
        var n = this,
            a = mUtil.get(e);
        mUtil.get("body");
        if (a) {
            var o = {
                    togglerState: "",
                    targetState: ""
                },
                l = {
                    construct: function(e) {
                        return mUtil.data(a).has("toggle") ? n = mUtil.data(a).get("toggle") : (l.init(e), l.build(), mUtil.data(a).set("toggle", n)), n
                    },
                    init: function(e) {
                        n.element = a, n.events = [], n.options = mUtil.deepExtend({}, o, e), n.target = mUtil.get(n.options.target), n.targetState = n.options.targetState, n.togglerState = n.options.togglerState, n.state = mUtil.hasClasses(n.target, n.targetState) ? "on" : "off"
                    },
                    build: function() {
                        mUtil.addEvent(a, "mouseup", l.toggle)
                    },
                    toggle: function() {
                        return "off" == n.state ? l.toggleOn() : l.toggleOff(), n
                    },
                    toggleOn: function() {
                        return l.eventTrigger("beforeOn"), mUtil.addClass(n.target, n.targetState), n.togglerState && mUtil.addClass(a, n.togglerState), n.state = "on", l.eventTrigger("afterOn"), l.eventTrigger("toggle"), n
                    },
                    toggleOff: function() {
                        return l.eventTrigger("beforeOff"), mUtil.removeClass(n.target, n.targetState), n.togglerState && mUtil.removeClass(a, n.togglerState), n.state = "off", l.eventTrigger("afterOff"), l.eventTrigger("toggle"), n
                    },
                    eventTrigger: function(e) {
                        for (i = 0; i < n.events.length; i++) {
                            var t = n.events[i];
                            t.name == e && (1 == t.one ? 0 == t.fired && (n.events[i].fired = !0, t.handler.call(this, n)) : t.handler.call(this, n))
                        }
                    },
                    addEvent: function(e, t, a) {
                        return n.events.push({
                            name: e,
                            handler: t,
                            one: a,
                            fired: !1
                        }), n
                    }
                };
            return n.setDefaults = function(e) {
                o = e
            }, n.getState = function() {
                return n.state
            }, n.toggle = function() {
                return l.toggle()
            }, n.toggleOn = function() {
                return l.toggleOn()
            }, n.toggle = function() {
                return l.toggleOff()
            }, n.on = function(e, t) {
                return l.addEvent(e, t)
            }, n.one = function(e, t) {
                return l.addEvent(e, t, !0)
            }, l.construct.apply(n, [t]), n
        }
    },
    mWizard = function(e, t) {
        var l = this,
            o = mUtil.get(e);
        mUtil.get("body");
        if (o) {
            var a = {
                    startStep: 1,
                    manualStepForward: !1
                },
                r = {
                    construct: function(e) {
                        return mUtil.data(o).has("wizard") ? l = mUtil.data(o).get("wizard") : (r.init(e), r.build(), mUtil.data(o).set("wizard", l)), l
                    },
                    init: function(e) {
                        l.element = o, l.events = [], l.options = mUtil.deepExtend({}, a, e), l.steps = mUtil.findAll(o, ".m-wizard__step"), l.progress = mUtil.find(o, ".m-wizard__progress .progress-bar"), l.btnSubmit = mUtil.find(o, '[data-wizard-action="submit"]'), l.btnNext = mUtil.find(o, '[data-wizard-action="next"]'), l.btnPrev = mUtil.find(o, '[data-wizard-action="prev"]'), l.btnLast = mUtil.find(o, '[data-wizard-action="last"]'), l.btnFirst = mUtil.find(o, '[data-wizard-action="first"]'), l.events = [], l.currentStep = 1, l.stop = !1, l.totalSteps = l.steps.length, 1 < l.options.startStep && r.goTo(l.options.startStep), r.updateUI()
                    },
                    build: function() {
                        mUtil.addEvent(l.btnNext, "click", function(e) {
                            e.preventDefault(), r.goNext()
                        }), mUtil.addEvent(l.btnPrev, "click", function(e) {
                            e.preventDefault(), r.goPrev()
                        }), mUtil.addEvent(l.btnFirst, "click", function(e) {
                            e.preventDefault(), r.goFirst()
                        }), mUtil.addEvent(l.btnLast, "click", function(e) {
                            e.preventDefault(), r.goLast()
                        }), mUtil.on(o, ".m-wizard__step a.m-wizard__step-number", "click", function() {
                            for (var e, t = this.closest(".m-wizard__step"), a = mUtil.parents(this, ".m-wizard__steps"), n = mUtil.findAll(a, ".m-wizard__step"), o = 0, i = n.length; o < i; o++)
                                if (t === n[o]) {
                                    e = o + 1;
                                    break
                                }
                            e && (!1 === l.options.manualStepForward ? e < l.currentStep && r.goTo(e) : r.goTo(e))
                        })
                    },
                    goTo: function(e) {
                        if (e !== l.currentStep) {
                            var t;
                            if (t = (e = e ? parseInt(e) : r.getNextStep()) > l.currentStep ? r.eventTrigger("beforeNext") : r.eventTrigger("beforePrev"), !0 !== l.stop) return !1 !== t && (l.currentStep = e, r.updateUI(), r.eventTrigger("change")), e > l.startStep ? r.eventTrigger("afterNext") : r.eventTrigger("afterPrev"), l;
                            l.stop = !1
                        }
                    },
                    setStepClass: function() {
                        r.isLastStep() ? mUtil.addClass(o, "m-wizard--step-last") : mUtil.removeClass(o, "m-wizard--step-last"), r.isFirstStep() ? mUtil.addClass(o, "m-wizard--step-first") : mUtil.removeClass(o, "m-wizard--step-first"), r.isBetweenStep() ? mUtil.addClass(o, "m-wizard--step-between") : mUtil.removeClass(o, "m-wizard--step-between")
                    },
                    updateUI: function(e) {
                        r.updateProgress(), r.handleTarget(), r.setStepClass();
                        for (var t = 0, a = l.steps.length; t < a; t++) mUtil.removeClass(l.steps[t], "m-wizard__step--current m-wizard__step--done");
                        for (t = 1; t < l.currentStep; t++) mUtil.addClass(l.steps[t - 1], "m-wizard__step--done");
                        mUtil.addClass(l.steps[l.currentStep - 1], "m-wizard__step--current")
                    },
                    stop: function() {
                        l.stop = !0
                    },
                    start: function() {
                        l.stop = !1
                    },
                    isLastStep: function() {
                        return l.currentStep === l.totalSteps
                    },
                    isFirstStep: function() {
                        return 1 === l.currentStep
                    },
                    isBetweenStep: function() {
                        return !1 === r.isLastStep() && !1 === r.isFirstStep()
                    },
                    goNext: function() {
                        return r.goTo(r.getNextStep())
                    },
                    goPrev: function() {
                        return r.goTo(r.getPrevStep())
                    },
                    goLast: function() {
                        return r.goTo(l.totalSteps)
                    },
                    goFirst: function() {
                        return r.goTo(1)
                    },
                    updateProgress: function() {
                        if (l.progress)
                            if (mUtil.hasClass(o, "m-wizard--1")) {
                                var e = l.currentStep / l.totalSteps * 100,
                                    t = mUtil.find(o, ".m-wizard__step-number"),
                                    a = parseInt(mUtil.css(t, "width"));
                                mUtil.css(l.progress, "width", "calc(" + e + "% + " + a / 2 + "px)")
                            } else if (mUtil.hasClass(o, "m-wizard--2")) {
                            l.currentStep;
                            var n = (l.currentStep - 1) * (1 / (l.totalSteps - 1) * 100);
                            mUtil.isInResponsiveRange("minimal-desktop-and-below") ? mUtil.css(l.progress, "height", n + "%") : mUtil.css(l.progress, "width", n + "%")
                        } else {
                            e = l.currentStep / l.totalSteps * 100;
                            mUtil.css(l.progress, "width", e + "%")
                        }
                    },
                    handleTarget: function() {
                        var e = l.steps[l.currentStep - 1],
                            t = mUtil.get(mUtil.attr(e, "m-wizard-target")),
                            a = mUtil.find(o, ".m-wizard__form-step--current");
                        mUtil.removeClass(a, "m-wizard__form-step--current"), mUtil.addClass(t, "m-wizard__form-step--current")
                    },
                    getNextStep: function() {
                        return l.totalSteps >= l.currentStep + 1 ? l.currentStep + 1 : l.totalSteps
                    },
                    getPrevStep: function() {
                        return 1 <= l.currentStep - 1 ? l.currentStep - 1 : 1
                    },
                    eventTrigger: function(e) {
                        for (i = 0; i < l.events.length; i++) {
                            var t = l.events[i];
                            t.name == e && (1 == t.one ? 0 == t.fired && (l.events[i].fired = !0, t.handler.call(this, l)) : t.handler.call(this, l))
                        }
                    },
                    addEvent: function(e, t, a) {
                        return l.events.push({
                            name: e,
                            handler: t,
                            one: a,
                            fired: !1
                        }), l
                    }
                };
            return l.setDefaults = function(e) {
                a = e
            }, l.goNext = function() {
                return r.goNext()
            }, l.goPrev = function() {
                return r.goPrev()
            }, l.goLast = function() {
                return r.goLast()
            }, l.stop = function() {
                return r.stop()
            }, l.start = function() {
                return r.start()
            }, l.goFirst = function() {
                return r.goFirst()
            }, l.goTo = function(e) {
                return r.goTo(e)
            }, l.getStep = function() {
                return l.currentStep
            }, l.isLastStep = function() {
                return r.isLastStep()
            }, l.isFirstStep = function() {
                return r.isFirstStep()
            }, l.on = function(e, t) {
                return r.addEvent(e, t)
            }, l.one = function(e, t) {
                return r.addEvent(e, t, !0)
            }, r.construct.apply(l, [t]), l
        }
    };
$.notifyDefaults({
        template: '<div data-notify="container" class="alert alert-{0} m-alert" role="alert"><button type="button" aria-hidden="true" class="close" data-notify="dismiss"></button><span data-notify="icon"></span><span data-notify="title">{1}</span><span data-notify="message">{2}</span><div class="progress" data-notify="progressbar"><div class="progress-bar progress-bar-animated bg-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div></div><a href="{3}" target="{4}" data-notify="url"></a></div>'
    }), swal.setDefaults({
        width: 400,
        padding: "2.5rem",
        buttonsStyling: !1,
        confirmButtonClass: "btn btn-success m-btn m-btn--custom",
        confirmButtonColor: null,
        cancelButtonClass: "btn btn-secondary m-btn m-btn--custom",
        cancelButtonColor: null
    }), Chart.elements.Rectangle.prototype.draw = function() {
        var e, t, a, n, o, i, l, r = this._chart.ctx,
            s = this._view,
            d = s.borderWidth,
            c = this._chart.options.barRadius ? this._chart.options.barRadius : 0;
        if (s.horizontal ? (e = s.base, t = s.x, a = s.y - s.height / 2, n = s.y + s.height / 2, o = e < t ? 1 : -1, i = 1, l = s.borderSkipped || "left") : (e = s.x - s.width / 2, t = s.x + s.width / 2, o = 1, i = (a = s.y > 2 * c ? s.y - c : s.y) < (n = s.base) ? 1 : -1, l = s.borderSkipped || "bottom"), d) {
            var m = Math.min(Math.abs(e - t), Math.abs(a - n)),
                u = (d = m < d ? m : d) / 2,
                p = e + ("left" !== l ? u * o : 0),
                f = t + ("right" !== l ? -u * o : 0),
                g = a + ("top" !== l ? u * i : 0),
                h = n + ("bottom" !== l ? -u * i : 0);
            p !== f && (a = g, n = h), g !== h && (e = p, t = f)
        }
        r.beginPath(), r.fillStyle = s.backgroundColor, r.strokeStyle = s.borderColor, r.lineWidth = d;
        var b = [
                [e, n],
                [e, a],
                [t, a],
                [t, n]
            ],
            v = ["bottom", "left", "top", "right"].indexOf(l, 0);

        function _(e) {
            return b[(v + e) % 4]
        } - 1 === v && (v = 0);
        var w = _(0);
        r.moveTo(w[0], w[1]);
        for (var U = 1; U < 4; U++) {
            var C;
            w = _(U), nextCornerId = U + 1, 4 == nextCornerId && (nextCornerId = 0), nextCorner = _(nextCornerId), width = b[2][0] - b[1][0], height = b[0][1] - b[1][1], x = b[1][0], y = b[1][1], (C = c) > height / 2 && (C = height / 2), C > width / 2 && (C = width / 2), r.moveTo(x + C, y), r.lineTo(x + width - C, y), r.quadraticCurveTo(x + width, y, x + width, y + C), r.lineTo(x + width, y + height - C), r.quadraticCurveTo(x + width, y + height, x + width - C, y + height), r.lineTo(x + C, y + height), r.quadraticCurveTo(x, y + height, x, y + height - C), r.lineTo(x, y + C), r.quadraticCurveTo(x, y, x + C, y)
        }
        r.fill(), d && r.stroke()
    }, $.fn.markdown.defaults.iconlibrary = "fa", $.fn.timepicker.defaults = $.extend(!0, {}, $.fn.timepicker.defaults, {
        icons: {
            up: "la la-angle-up",
            down: "la la-angle-down"
        }
    }), jQuery.validator.setDefaults({
        errorElement: "div",
        errorClass: "form-control-feedback",
        focusInvalid: !1,
        ignore: "",
        errorPlacement: function(e, t) {
            var a = 0 < $(t).closest(".m-form__group-sub").length ? $(t).closest(".m-form__group-sub") : $(t).closest(".m-form__group"),
                n = a.find(".m-form__help");
            0 === a.find(".form-control-feedback").length && (0 < n.length ? n.before(e) : 0 < $(t).closest(".input-group").length ? $(t).closest(".input-group").after(e) : $(t).is(":checkbox") ? $(t).closest(".m-checkbox").find(">span").after(e) : $(t).after(e))
        },
        highlight: function(e) {
            (0 < $(e).closest(".m-form__group-sub").length ? $(e).closest(".m-form__group-sub") : $(e).closest(".m-form__group")).addClass("has-danger")
        },
        unhighlight: function(e) {
            (0 < $(e).closest(".m-form__group-sub").length ? $(e).closest(".m-form__group-sub") : $(e).closest(".m-form__group")).removeClass("has-danger")
        },
        success: function(e, t) {
            var a = 0 < $(e).closest(".m-form__group-sub").length ? $(e).closest(".m-form__group-sub") : $(e).closest(".m-form__group");
            a.removeClass("has-danger"), a.find(".form-control-feedback").remove()
        }
    }), jQuery.validator.addMethod("email", function(e, t) {
        return !!/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(e)
    }, "Please enter a valid Email."),
    function(l) {
        l.fn.mDatatable = l.fn.mDatatable || {}, l.fn.mDatatable.checkbox = function(n, o) {
            var i = {
                selectedAllRows: !1,
                selectedRows: [],
                unselectedRows: [],
                init: function() {
                    i.selectorEnabled() && (o.vars.requestIds && n.setDataSourceParam(o.vars.requestIds, !0), i.selectedAllRows = n.getDataSourceParam(o.vars.selectedAllRows), l(n).on("m-datatable--on-layout-updated", function(e, t) {
                        t.table == l(n.wrap).attr("id") && n.ready(function() {
                            i.initVars(), i.initEvent(), i.initSelect()
                        })
                    }))
                },
                initEvent: function() {
                    l(n.tableHead).find('.m-checkbox--all > [type="checkbox"]').click(function(e) {
                        if (i.selectedRows = i.unselectedRows = [], n.stateRemove("checkbox"), l(this).is(":checked") ? i.selectedAllRows = !0 : i.selectedAllRows = !1, !o.vars.requestIds) {
                            l(this).is(":checked") && (i.selectedRows = l.makeArray(l(n.tableBody).find('.m-checkbox--single > [type="checkbox"]').map(function(e, t) {
                                return l(t).val()
                            })));
                            var t = {};
                            t.selectedRows = l.unique(i.selectedRows), n.stateKeep("checkbox", t)
                        }
                        n.setDataSourceParam(o.vars.selectedAllRows, i.selectedAllRows), l(n).trigger("m-datatable--on-click-checkbox", [l(this)])
                    }), l(n.tableBody).find('.m-checkbox--single > [type="checkbox"]').click(function(e) {
                        var t = l(this).val();
                        l(this).is(":checked") ? (i.selectedRows.push(t), i.unselectedRows = i.remove(i.unselectedRows, t)) : (i.unselectedRows.push(t), i.selectedRows = i.remove(i.selectedRows, t)), !o.vars.requestIds && i.selectedRows.length < 1 && l(n.tableHead).find('.m-checkbox--all > [type="checkbox"]').prop("checked", !1);
                        var a = {};
                        a.selectedRows = l.unique(i.selectedRows), a.unselectedRows = l.unique(i.unselectedRows), n.stateKeep("checkbox", a), l(n).trigger("m-datatable--on-click-checkbox", [l(this)])
                    })
                },
                initSelect: function() {
                    i.selectedAllRows && o.vars.requestIds ? (n.hasClass("m-datatable--error") || l(n.tableHead).find('.m-checkbox--all > [type="checkbox"]').prop("checked", !0), n.setActiveAll(!0), i.unselectedRows.forEach(function(e) {
                        n.setInactive(e)
                    })) : (i.selectedRows.forEach(function(e) {
                        n.setActive(e)
                    }), !n.hasClass("m-datatable--error") && l(n.tableBody).find('.m-checkbox--single > [type="checkbox"]').not(":checked").length < 1 && l(n.tableHead).find('.m-checkbox--all > [type="checkbox"]').prop("checked", !0))
                },
                selectorEnabled: function() {
                    return l.grep(n.options.columns, function(e, t) {
                        return e.selector || !1
                    })[0]
                },
                initVars: function() {
                    var e = n.stateGet("checkbox");
                    void 0 !== e && (i.selectedRows = e.selectedRows || [], i.unselectedRows = e.unselectedRows || [])
                },
                getSelectedId: function(e) {
                    if (i.initVars(), i.selectedAllRows && o.vars.requestIds) {
                        void 0 === e && (e = o.vars.rowIds);
                        var t = n.getObject(e, n.lastResponse) || [];
                        return 0 < t.length && i.unselectedRows.forEach(function(e) {
                            t = i.remove(t, parseInt(e))
                        }), t
                    }
                    return i.selectedRows
                },
                remove: function(e, t) {
                    return e.filter(function(e) {
                        return e !== t
                    })
                }
            };
            return n.checkbox = function() {
                return i
            }, "object" == typeof o && (o = l.extend(!0, {}, l.fn.mDatatable.checkbox.default, o), i.init.apply(this, [o])), n
        }, l.fn.mDatatable.checkbox.default = {
            vars: {
                selectedAllRows: "selectedAllRows",
                requestIds: "requestIds",
                rowIds: "meta.rowIds"
            }
        }
    }(jQuery);
var mLayout = function() {
    var n, o, a, i;
    return {
        init: function() {
            this.initHeader(), this.initAside()
        },
        initHeader: function() {
            var e, t, a;
            t = mUtil.get("m_header"), a = {
                offset: {},
                minimize: {}
            }, "hide" == mUtil.attr(t, "m-minimize") ? (a.minimize.mobile = {}, a.minimize.mobile.on = "m-header--hide", a.minimize.mobile.off = "m-header--show") : a.minimize.mobile = !1, "minimize" == mUtil.attr(t, "m-minimize") ? (a.minimize.desktop = {}, a.minimize.desktop.on = "m-header--minimize-on", a.minimize.desktop.off = "m-header--minimize-off") : "hide" == mUtil.attr(t, "m-minimize") ? (a.minimize.desktop = {}, a.minimize.desktop.on = "m-header--hide", a.minimize.desktop.off = "m-header--show") : a.minimize.desktop = !1, (e = mUtil.attr(t, "m-minimize-offset")) && (a.offset.desktop = e), (e = mUtil.attr(t, "m-minimize-mobile-offset")) && (a.offset.mobile = e), header = new mHeader("m_header", a), i = new mOffcanvas("m_header_menu", {
                overlay: !0,
                baseClass: "m-aside-header-menu-mobile",
                closeBy: "m_aside_header_menu_mobile_close_btn",
                toggleBy: {
                    target: "m_aside_header_menu_mobile_toggle",
                    state: "m-brand__toggler--active"
                }
            }), n = new mMenu("m_header_menu", {
                submenu: {
                    desktop: "dropdown",
                    tablet: "accordion",
                    mobile: "accordion"
                },
                accordion: {
                    slideSpeed: 200,
                    autoScroll: !0,
                    expandAll: !1
                }
            }), $("#m_aside_header_topbar_mobile_toggle").click(function() {
                $("body").toggleClass("m-topbar--on")
            }), setInterval(function() {
                $("#m_topbar_notification_icon .m-nav__link-icon").addClass("m-animate-shake"), $("#m_topbar_notification_icon .m-nav__link-badge").addClass("m-animate-blink")
            }, 3e3), setInterval(function() {
                $("#m_topbar_notification_icon .m-nav__link-icon").removeClass("m-animate-shake"), $("#m_topbar_notification_icon .m-nav__link-badge").removeClass("m-animate-blink")
            }, 6e3), 0 !== $("#m_quicksearch").length && (quicksearch = new mQuicksearch("m_quicksearch", {
                mode: mUtil.attr("m_quicksearch", "m-quicksearch-mode"),
                minLength: 1
            }), quicksearch.on("search", function(t) {
                t.showProgress(), $.ajax({
                    url: "https://keenthemes.com/metronic/preview/inc/api/quick_search.php",
                    data: {
                        query: t.query
                    },
                    dataType: "html",
                    success: function(e) {
                        t.hideProgress(), t.showResult(e)
                    },
                    error: function(e) {
                        t.hideProgress(), t.showError("Connection error. Pleae try again later.")
                    }
                })
            })), new mScrollTop("m_scroll_top", {
                offset: 300,
                speed: 600
            })
        },
        initAside: function() {
            var e, t;
            e = mUtil.get("m_aside_left"), t = mUtil.hasClass(e, "m-aside-left--offcanvas-default") ? "m-aside-left--offcanvas-default" : "m-aside-left", a = new mOffcanvas("m_aside_left", {
                    baseClass: t,
                    overlay: !0,
                    closeBy: "m_aside_left_close_btn",
                    toggleBy: {
                        target: "m_aside_left_offcanvas_toggle",
                        state: "m-brand__toggler--active"
                    }
                }), 0 !== $("#m_aside_left_minimize_toggle").length && (asideLeftToggle = new mToggle("m_aside_left_minimize_toggle", {
                    target: "body",
                    targetState: "m-brand--minimize m-aside-left--minimize",
                    togglerState: "m-brand__toggler--active"
                }), asideLeftToggle.on("toggle", function(e) {
                    n.pauseDropdownHover(800), o.pauseDropdownHover(800), Cookies.set("sidebar_toggle_state", e.getState())
                })),
                function() {
                    var e = $("#m_ver_menu"),
                        t = "1" === e.data("m-menu-dropdown") ? "dropdown" : "accordion";
                    if (o = new mMenu("m_ver_menu", {
                            submenu: {
                                desktop: {
                                    default: t,
                                    state: {
                                        body: "m-aside-left--minimize",
                                        mode: "dropdown"
                                    }
                                },
                                tablet: "accordion",
                                mobile: "accordion"
                            },
                            accordion: {
                                autoScroll: !0,
                                expandAll: !1
                            }
                        }), "1" === e.attr("m-menu-scrollable")) {
                        function a(e) {
                            if (mUtil.isInResponsiveRange("tablet-and-mobile")) mApp.destroyScroller(e);
                            else {
                                var t = mUtil.getViewPort().height - parseInt(mUtil.css("m_header", "height"));
                                mApp.initScroller(e, {
                                    height: t
                                })
                            }
                        }
                        a(e), mUtil.addResizeHandler(function() {
                            a(e)
                        })
                    }
                }()
        },
        getAsideMenu: function() {
            return o
        },
        closeMobileAsideMenuOffcanvas: function() {
            mUtil.isMobileDevice() && a.hide()
        },
        closeMobileHorMenuOffcanvas: function() {
            mUtil.isMobileDevice() && i.hide()
        }
    }
}();
$(document).ready(function() {
    !1 === mUtil.isAngularVersion() && mLayout.init()
});
var mQuickSidebar = function() {
    var n = $("#m_quick_sidebar"),
        o = $("#m_quick_sidebar_tabs"),
        e = n.find(".m-quick-sidebar__content"),
        t = function() {
            ! function() {
                var t = $("#m_quick_sidebar_tabs_messenger");
                if (0 !== t.length) {
                    var a = t.find(".m-messenger__messages"),
                        e = function() {
                            var e = n.outerHeight(!0) - o.outerHeight(!0) - t.find(".m-messenger__form").outerHeight(!0) - 120;
                            a.css("height", e), mApp.initScroller(a, {})
                        };
                    e(), mUtil.addResizeHandler(e)
                }
            }(),
            function() {
                var t = $("#m_quick_sidebar_tabs_settings");
                if (0 !== t.length) {
                    var e = function() {
                        var e = mUtil.getViewPort().height - o.outerHeight(!0) - 60;
                        t.css("height", e), mApp.initScroller(t, {})
                    };
                    e(), mUtil.addResizeHandler(e)
                }
            }(),
            function() {
                var t = $("#m_quick_sidebar_tabs_logs");
                if (0 !== t.length) {
                    var e = function() {
                        var e = mUtil.getViewPort().height - o.outerHeight(!0) - 60;
                        t.css("height", e), mApp.initScroller(t, {})
                    };
                    e(), mUtil.addResizeHandler(e)
                }
            }()
        };
    return {
        init: function() {
            0 !== n.length && new mOffcanvas("m_quick_sidebar", {
                overlay: !0,
                baseClass: "m-quick-sidebar",
                closeBy: "m_quick_sidebar_close",
                toggleBy: "m_quick_sidebar_toggle"
            }).one("afterShow", function() {
                mApp.block(n), setTimeout(function() {
                    mApp.unblock(n), e.removeClass("m--hide"), t()
                }, 1e3)
            })
        }
    }
}();
$(document).ready(function() {
    mQuickSidebar.init()
});