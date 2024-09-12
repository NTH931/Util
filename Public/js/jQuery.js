"use strict";
function jQueryVar(varName, ImplicitReturnFunction) {
    Object.defineProperty($.fn, varName, {
        get: ImplicitReturnFunction
    });
}
function jQueryFunct(functionName, funct) {
    $.fn[functionName] = funct;
}
// JQuery functions
jQueryFunct('in', function (time) {
    setTimeout(() => { }, time);
    return this;
});
jQueryFunct('scrollTo', function (offset = 0) {
    $('html, body').animate({
        scrollTop: this.offset()?.top + offset
    }, 400);
    return this;
});
jQueryFunct('isVisible', function () {
    const element = this.get(0);
    // If the element doesn't exist, return false
    if (!element)
        return false;
    const rect = element.getBoundingClientRect();
    return rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth);
});
