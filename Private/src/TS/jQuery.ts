function jQueryVar(varName: string, ImplicitReturnFunction: (this: any, ...args: any) => any) {
  Object.defineProperty($.fn, varName, {
    get: ImplicitReturnFunction
  });
}

function jQueryFunct(functionName: string, funct: (this: any, ...args: any) => any) {
  ($.fn as any)[functionName] = funct;
}


// JQuery functions

jQueryFunct('in', function(this: JQuery, time: number): JQuery {
  setTimeout(() => null, time);
  return this;
});

jQueryFunct('scrollTo', function(this: JQuery, offset: number = 0): JQuery {
  $('html, body').animate({
    scrollTop: this.offset()?.top! + offset
  }, 400);
  return this;
});

jQueryFunct('isVisible', function(this: JQuery): boolean {
  const element = this.get(0);
  
  // If the element doesn't exist, return false
  if (!element) return false;

  const rect = element.getBoundingClientRect();

  return rect.top >= 0 &&
         rect.left >= 0 &&
         rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
         rect.right <= (window.innerWidth || document.documentElement.clientWidth);
});

jQueryVar("id", function (this: JQuery<HTMLElement>) { return this.attr("id"); });
jQueryVar("class", function(this: JQuery<HTMLElement>) { return this.attr("class"); });
jQueryVar("exists", function(this: JQuery<HTMLElement>): bool { 
  const element = this.get(0);
  if (!element) return false; // If no element exists in the jQuery object, return false

  // Check by ID if available, otherwise use the element itself
  return !!document.getElementById(element.id) || document.body.contains(element);
});