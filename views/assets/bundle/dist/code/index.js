!function(e){var t={};function n(o){if(t[o])return t[o].exports;var r=t[o]={i:o,l:!1,exports:{}};return e[o].call(r.exports,r,r.exports,n),r.l=!0,r.exports}n.m=e,n.c=t,n.d=function(e,t,o){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:o})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var o=Object.create(null);if(n.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)n.d(o,r,function(t){return e[t]}.bind(null,r));return o},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=0)}([function(e,t,n){"use strict";n.r(t);n(1);window.addEventListener("load",(function(){document.querySelectorAll(".block.project .slide-down").forEach((function(e){e.addEventListener("click",(function(t){!function(e){e.classList.toggle("open");var t=e.nextElementSibling;t.classList.toggle("open"),t.style.height="".concat(t.scrollHeight,"px")}(e)}))})),document.querySelectorAll(".block.project > .main .list.bullets a[href]").forEach((function(e){e.setAttribute("target","_blank")}));var e=new URLSearchParams(window.location.search).get("p");if(e){var t=document.querySelector('.block.project[data-project-name="'.concat(e,'"]'));if(t){var n=t.getBoundingClientRect().top+window.scrollY,o=document.querySelector("body>nav").getBoundingClientRect().height;setTimeout((function(){window.scroll({top:n-o-10,behavior:"smooth"})}),0)}}}))},function(e,t,n){}]);