/**
 * SmoothScroll
 * 
 * 1.4.0 | Balazs Galambosi | http://www.smoothscroll.net/
 */

(function(){var e={frameRate:150,animationTime:400,stepSize:100,pulseAlgorithm:true,pulseScale:4,pulseNormalize:1,accelerationDelta:0,accelerationMax:3,keyboardSupport:true,arrowScroll:50,touchpadSupport:false,fixedBackground:true,excluded:""}
var t=e
var o=false
var n=false
var r={x:0,y:0}
var a=false
var i=document.documentElement
var l
var c
var u
var d=[]
var s=/^Mac/.test(navigator.platform)
var f={left:37,up:38,right:39,down:40,spacebar:32,pageup:33,pagedown:34,end:35,home:36}
function m(){if(t.keyboardSupport){X("keydown",S)}}function h(){if(a||!document.body)return
a=true
var e=document.body
var r=document.documentElement
var d=window.innerHeight
var s=e.scrollHeight
i=document.compatMode.indexOf("CSS")>=0?r:e
l=e
m()
if(top!=self){n=true}else if(s>d&&(e.offsetHeight<=d||r.offsetHeight<=d)){var f=document.createElement("div")
f.style.cssText="position:absolute; z-index:-10000; "+"top:0; left:0; right:0; height:"+i.scrollHeight+"px"
document.body.appendChild(f)
var h
u=function(){if(h)return
h=setTimeout(function(){if(o)return
f.style.height="0"
f.style.height=i.scrollHeight+"px"
h=null},500)}
setTimeout(u,10)
X("resize",u)
var w={attributes:true,childList:true,characterData:false}
c=new j(u)
c.observe(e,w)
if(i.offsetHeight<=d){var p=document.createElement("div")
p.style.clear="both"
e.appendChild(p)}}if(!t.fixedBackground&&!o){e.style.backgroundAttachment="scroll"
r.style.backgroundAttachment="scroll"}}function w(){c&&c.disconnect()
Y(Q,y)
Y("mousedown",x)
Y("keydown",S)
Y("resize",u)
Y("load",h)}var p=[]
var v=false
var b=Date.now()
function g(e,o,n){B(o,n)
if(t.accelerationMax!=1){var r=Date.now()
var a=r-b
if(a<t.accelerationDelta){var i=(1+50/a)/2
if(i>1){i=Math.min(i,t.accelerationMax)
o*=i
n*=i}}b=Date.now()}p.push({x:o,y:n,lastX:o<0?.99:-.99,lastY:n<0?.99:-.99,start:Date.now()})
if(v){return}var l=e===document.body
var c=function(r){var a=Date.now()
var i=0
var u=0
for(var d=0;d<p.length;d++){var s=p[d]
var f=a-s.start
var m=f>=t.animationTime
var h=m?1:f/t.animationTime
if(t.pulseAlgorithm){h=_(h)}var w=s.x*h-s.lastX>>0
var b=s.y*h-s.lastY>>0
i+=w
u+=b
s.lastX+=w
s.lastY+=b
if(m){p.splice(d,1)
d--}}if(l){window.scrollBy(i,u)}else{if(i)e.scrollLeft+=i
if(u)e.scrollTop+=u}if(!o&&!n){p=[]}if(p.length){R(c,e,1e3/t.frameRate+1)}else{v=false}}
R(c,e,0)
v=true}function y(e){if(!a){h()}var o=e.target
var n=H(o)
if(!n||e.defaultPrevented||e.ctrlKey){return true}if(A(l,"embed")||A(o,"embed")&&/\.pdf/i.test(o.src)||A(l,"object")){return true}var r=-e.wheelDeltaX||e.deltaX||0
var i=-e.wheelDeltaY||e.deltaY||0
if(s){if(e.wheelDeltaX&&N(e.wheelDeltaX,120)){r=-120*(e.wheelDeltaX/Math.abs(e.wheelDeltaX))}if(e.wheelDeltaY&&N(e.wheelDeltaY,120)){i=-120*(e.wheelDeltaY/Math.abs(e.wheelDeltaY))}}if(!r&&!i){i=-e.wheelDelta||0}if(e.deltaMode===1){r*=40
i*=40}if(!t.touchpadSupport&&K(i)){return true}if(Math.abs(r)>1.2){r*=t.stepSize/120}if(Math.abs(i)>1.2){i*=t.stepSize/120}g(n,r,i)
e.preventDefault()
T()}function S(e){var o=e.target
var n=e.ctrlKey||e.altKey||e.metaKey||e.shiftKey&&e.keyCode!==f.spacebar
if(!document.contains(l)){l=document.activeElement}var r=/^(textarea|select|embed|object)$/i
var a=/^(button|submit|radio|checkbox|file|color|image)$/i
if(r.test(o.nodeName)||A(o,"input")&&!a.test(o.type)||A(l,"video")||P(e)||o.isContentEditable||e.defaultPrevented||n){return true}if((A(o,"button")||A(o,"input")&&a.test(o.type))&&e.keyCode===f.spacebar){return true}var i,c=0,u=0
var d=H(l)
var s=d.clientHeight
if(d==document.body){s=window.innerHeight}switch(e.keyCode){case f.up:u=-t.arrowScroll
break
case f.down:u=t.arrowScroll
break
case f.spacebar:i=e.shiftKey?1:-1
u=-i*s*.9
break
case f.pageup:u=-s*.9
break
case f.pagedown:u=s*.9
break
case f.home:u=-d.scrollTop
break
case f.end:var m=d.scrollHeight-d.scrollTop-s
u=m>0?m+10:0
break
case f.left:c=-t.arrowScroll
break
case f.right:c=t.arrowScroll
break
default:return true}g(d,c,u)
e.preventDefault()
T()}function x(e){l=e.target}var k=function(){var e=0
return function(t){return t.uniqueID||(t.uniqueID=e++)}}()
var D={}
var M
function T(){clearTimeout(M)
M=setInterval(function(){D={}},1*1e3)}function E(e,t){for(var o=e.length;o--;)D[k(e[o])]=t
return t}function H(e){var t=[]
var o=document.body
var r=i.scrollHeight
do{var a=D[k(e)]
if(a){return E(t,a)}t.push(e)
if(r===e.scrollHeight){var l=z(i)&&z(o)
var c=l||L(i)
if(n&&C(i)||!n&&c){return E(t,F())}}else if(C(e)&&L(e)){return E(t,e)}}while(e=e.parentElement)}function C(e){return e.clientHeight+10<e.scrollHeight}function z(e){var t=getComputedStyle(e,"").getPropertyValue("overflow-y")
return t!=="hidden"}function L(e){var t=getComputedStyle(e,"").getPropertyValue("overflow-y")
return t==="scroll"||t==="auto"}function X(e,t){window.addEventListener(e,t,false)}function Y(e,t){window.removeEventListener(e,t,false)}function A(e,t){return(e.nodeName||"").toLowerCase()===t.toLowerCase()}function B(e,t){e=e>0?1:-1
t=t>0?1:-1
if(r.x!==e||r.y!==t){r.x=e
r.y=t
p=[]
b=0}}var O
if(window.localStorage&&localStorage.SS_deltaBuffer){d=localStorage.SS_deltaBuffer.split(",")}function K(e){if(!e)return
if(!d.length){d=[e,e,e]}e=Math.abs(e)
d.push(e)
d.shift()
clearTimeout(O)
O=setTimeout(function(){if(window.localStorage){localStorage.SS_deltaBuffer=d.join(",")}},1e3)
return!q(120)&&!q(100)}function N(e,t){return Math.floor(e/t)==e/t}function q(e){return N(d[0],e)&&N(d[1],e)&&N(d[2],e)}function P(e){var t=e.target
var o=false
if(document.URL.indexOf("www.youtube.com/watch")!=-1){do{o=t.classList&&t.classList.contains("html5-video-controls")
if(o)break}while(t=t.parentNode)}return o}var R=function(){return window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame||function(e,t,o){window.setTimeout(e,o||1e3/60)}}()
var j=window.MutationObserver||window.WebKitMutationObserver||window.MozMutationObserver
var F=function(){var e
return function(){if(!e){var t=document.createElement("div")
t.style.cssText="height:10000px;width:1px;"
document.body.appendChild(t)
var o=document.body.scrollTop
var n=document.documentElement.scrollTop
window.scrollBy(0,1)
if(document.body.scrollTop!=o)e=document.body
else e=document.documentElement
window.scrollBy(0,-1)
document.body.removeChild(t)}return e}}()
function I(e){var o,n,r
e=e*t.pulseScale
if(e<1){o=e-(1-Math.exp(-e))}else{n=Math.exp(-1)
e-=1
r=1-Math.exp(-e)
o=n+r*(1-n)}return o*t.pulseNormalize}function _(e){if(e>=1)return 1
if(e<=0)return 0
if(t.pulseNormalize==1){t.pulseNormalize/=I(1)}return I(e)}var V=window.navigator.userAgent
var $=/Edge/.test(V)
var U=/chrome/i.test(V)&&!$
var W=/safari/i.test(V)&&!$
var G=/mobile/i.test(V)
var J=(U||W)&&!G
var Q
if("onwheel"in document.createElement("div"))Q="wheel"
else if("onmousewheel"in document.createElement("div"))Q="mousewheel"
if(Q&&J){X(Q,y)
X("mousedown",x)
X("load",h)}function Z(o){for(var n in o)if(e.hasOwnProperty(n))t[n]=o[n]}Z.destroy=w
if(window.SmoothScrollOptions)Z(window.SmoothScrollOptions)
if(typeof define==="function"&&define.amd)define(function(){return Z})
else if("object"==typeof exports)module.exports=Z
else window.SmoothScroll=Z})()
