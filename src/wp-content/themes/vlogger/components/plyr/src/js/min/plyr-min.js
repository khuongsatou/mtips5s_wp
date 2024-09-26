// ==========================================================================
// Plyr
// plyr.js v2.0.13
// https://github.com/sampotts/plyr
// License: The MIT License (MIT)
// ==========================================================================
// Credits: http://paypal.github.io/accessible-html5-video-player/
// ==========================================================================
/**
 * 
 *
 *
 *	Custom version for Themes2Go Vlogger: icon play modified HTML (search for Igor)
 *
 *
 * 
 */
!function(e,t){"use strict";
/*global define,module*/"object"==typeof module&&"object"==typeof module.exports?
// Node, CommonJS-like
module.exports=t(e,document):"function"==typeof define&&define.amd?
// AMD
define([],function(){return t(e,document)}):
// Browser globals (root is window)
e.plyr=t(e,document)}("undefined"!=typeof window?window:this,function(ve,ge){"use strict";
// Globals
// Credits: http://paypal.github.io/accessible-html5-video-player/
// Unfortunately, due to mixed support, UA sniffing is required
function he(){var e=navigator.userAgent,t=navigator.appName,n=""+parseFloat(navigator.appVersion),r=parseInt(navigator.appVersion,10),a,s,o,i=!1,l=!1,u=!1,c=!1;
// Return data
return-1!==navigator.appVersion.indexOf("Windows NT")&&-1!==navigator.appVersion.indexOf("rv:11")?(
// MSIE 11
i=!0,t="IE",n="11"):-1!==(s=e.indexOf("MSIE"))?(
// MSIE
i=!0,t="IE",n=e.substring(s+5)):-1!==(s=e.indexOf("Chrome"))?(
// Chrome
u=!0,t="Chrome",n=e.substring(s+7)):-1!==(s=e.indexOf("Safari"))?(
// Safari
c=!0,t="Safari",n=e.substring(s+7),-1!==(s=e.indexOf("Version"))&&(n=e.substring(s+8))):-1!==(s=e.indexOf("Firefox"))?(
// Firefox
l=!0,t="Firefox",n=e.substring(s+8)):(a=e.lastIndexOf(" ")+1)<(s=e.lastIndexOf("/"))&&(
// In most other browsers, 'name/version' is at the end of userAgent
t=e.substring(a,s),n=e.substring(s+1),t.toLowerCase()===t.toUpperCase()&&(t=navigator.appName)),
// Trim the fullVersion string at semicolon/space if present
-1!==(o=n.indexOf(";"))&&(n=n.substring(0,o)),-1!==(o=n.indexOf(" "))&&(n=n.substring(0,o)),
// Get major version
r=parseInt(""+n,10),isNaN(r)&&(n=""+parseFloat(navigator.appVersion),r=parseInt(navigator.appVersion,10)),{name:t,version:r,isIE:i,isFirefox:l,isChrome:u,isSafari:c,isIos:/(iPad|iPhone|iPod)/g.test(navigator.platform),isIphone:/(iPhone|iPod)/g.test(navigator.userAgent),isTouch:"ontouchstart"in ge.documentElement}}
// Check for mime type support against a player instance
// Credits: http://diveintohtml5.info/everything.html
// Related: http://www.leanbackplyr.com/test/h5mt.html
function ke(e,t){var n=e.media;if("video"===e.type)
// Check type
switch(t){case"video/webm":return!(!n.canPlayType||!n.canPlayType('video/webm; codecs="vp8, vorbis"').replace(/no/,""));case"video/mp4":return!(!n.canPlayType||!n.canPlayType('video/mp4; codecs="avc1.42E01E, mp4a.40.2"').replace(/no/,""));case"video/ogg":return!(!n.canPlayType||!n.canPlayType('video/ogg; codecs="theora"').replace(/no/,""))}else if("audio"===e.type)
// Check type
switch(t){case"audio/mpeg":return!(!n.canPlayType||!n.canPlayType("audio/mpeg;").replace(/no/,""));case"audio/ogg":return!(!n.canPlayType||!n.canPlayType('audio/ogg; codecs="vorbis"').replace(/no/,""));case"audio/wav":return!(!n.canPlayType||!n.canPlayType('audio/wav; codecs="1"').replace(/no/,""))}
// If we got this far, we're stuffed
return!1}
// Inject a script
function we(e){if(!ge.querySelectorAll('script[src="'+e+'"]').length){var t=ge.createElement("script");t.src=e;var n=ge.getElementsByTagName("script")[0];n.parentNode.insertBefore(t,n)}}
// Element exists in an array
function xe(e,t){return Array.prototype.indexOf&&-1!==e.indexOf(t)}
// Replace all
function Te(e,t,n){return e.replace(new RegExp(t.replace(/([.*+?\^=!:${}()|\[\]\/\\])/g,"\\$1"),"g"),n)}
// Wrap an element
function Se(e,t){
// Convert `elements` to an array, if necessary.
e.length||(e=[e]);
// Loops backwards to prevent having to clone the wrapper on the
// first element (see `child` below).
for(var n=e.length-1;0<=n;n--){var r=0<n?t.cloneNode(!0):t,a=e[n],s=a.parentNode,o=a.nextSibling;
// Wrap the element (is automatically removed from its current
// parent).
return r.appendChild(a),
// If the element had a sibling, insert the wrapper before
// the sibling to maintain the HTML structure; otherwise, just
// append it to the parent.
o?s.insertBefore(r,o):s.appendChild(r),r}}
// Unwrap an element
// http://plainjs.com/javascript/manipulation/unwrap-a-dom-element-35/
/*function _unwrap(wrapper) {
		// Get the element's parent node
		var parent = wrapper.parentNode;

		// Move all children out of the element
		while (wrapper.firstChild) {
			parent.insertBefore(wrapper.firstChild, wrapper);
		}

		// Remove the empty element
		parent.removeChild(wrapper);
	}*/
// Remove an element
function Ee(e){e&&e.parentNode.removeChild(e)}
// Prepend child
function _e(e,t){e.insertBefore(t,e.firstChild)}
// Set attributes
function Ce(e,t){for(var n in t)e.setAttribute(n,Je.boolean(t[n])&&t[n]?"":t[n])}
// Insert a HTML element
function Fe(e,t,n){
// Create a new <element>
var r=ge.createElement(e);
// Set all passed attributes
Ce(r,n),
// Inject the new element
_e(t,r)}
// Get a classname from selector
function Ae(e){return e.replace(".","")}
// Toggle class on an element
function Ie(e,t,n){if(e)if(e.classList)e.classList[n?"add":"remove"](t);else{var r=(" "+e.className+" ").replace(/\s+/g," ").replace(" "+t+" ","");e.className=r+(n?" "+t:"")}}
// Has class name
function Ne(e,t){return!!e&&(e.classList?e.classList.contains(t):new RegExp("(\\s|^)"+t+"(\\s|$)").test(e.className))}
// Element matches selector
function Pe(e,t){var n=Element.prototype,r;return(n.matches||n.webkitMatchesSelector||n.mozMatchesSelector||n.msMatchesSelector||function(e){return-1!==[].indexOf.call(ge.querySelectorAll(e),this)}).call(e,t)}
// Bind along with custom handler
function Me(t,e,n,r,a){Oe(t,e,function(e){n&&n.apply(t,[e]),r.apply(t,[e])},a)}
// Toggle event listener
function l(e,t,n,r,a){var s=t.split(" ");
// Whether the listener is a capturing listener or not
// Default to false
// If a nodelist is passed, call itself on each node
if(Je.boolean(a)||(a=!1),e instanceof NodeList)for(var o=0;o<e.length;o++)e[o]instanceof Node&&l(e[o],t,n,r);else
// If a single node is passed, bind the event listener
for(var i=0;i<s.length;i++)e[r?"addEventListener":"removeEventListener"](s[i],n,a)}
// Bind event
function Oe(e,t,n,r){e&&l(e,t,n,!0,r)}
// Unbind event
/*function _off(element, events, callback, useCapture) {
		if (element) {
			_toggleListener(element, events, callback, false, useCapture);
		}
	}*/
// Trigger event
function Le(e,t,n,r){
// Bail if no element
if(e&&t){
// Default bubbles to false
Je.boolean(n)||(n=!1);
// Create and dispatch the event
var a=new CustomEvent(t,{bubbles:n,detail:r});
// Dispatch the event
e.dispatchEvent(a)}}
// Toggle aria-pressed state on a toggle button
// http://www.ssbbartgroup.com/blog/how-not-to-misuse-aria-states-properties-and-roles
function je(e,t){
// Bail if no target
if(e)
// Get state
return t=Je.boolean(t)?t:!e.getAttribute("aria-pressed"),
// Set the attribute on target
e.setAttribute("aria-pressed",t),t}
// Get percentage
function Ve(e,t){return 0===e||0===t||isNaN(e)||isNaN(t)?0:(e/t*100).toFixed(2)}
// Deep extend/merge destination object with N more objects
// http://andrewdupont.net/2009/08/28/deep-extending-objects-in-javascript/
// Removed call to arguments.callee (used explicit function name instead)
function qe(){
// Get arguments
var e=arguments;
// Bail if nothing to merge
if(e.length){
// Return first if specified but nothing to merge
if(1===e.length)return e[0];
// First object is the destination
// Loop through all objects to merge
for(var t=Array.prototype.shift.call(e),n=e.length,r=0;r<n;r++){var a=e[r];for(var s in a)a[s]&&a[s].constructor&&a[s].constructor===Object?(t[s]=t[s]||{},qe(t[s],a[s])):t[s]=a[s]}return t}}
// Check variable types
// Parse YouTube ID from url
function Re(e){var t=/^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;return e.match(t)?RegExp.$2:e}
// Parse Vimeo ID from url
function De(e){var t=/^.*(vimeo.com\/|video\/)(\d+).*/;return e.match(t)?RegExp.$2:e}
// Fullscreen API
function He(){var e={supportsFullScreen:!1,isFullScreen:function(){return!1},requestFullScreen:function(){},cancelFullScreen:function(){},fullScreenEventName:"",element:null,prefix:""},t="webkit o moz ms khtml".split(" ");
// Check for native support
if(Je.undefined(ge.cancelFullScreen))
// Check for fullscreen support by vendor prefix
for(var n=0,r=t.length;n<r;n++){if(e.prefix=t[n],!Je.undefined(ge[e.prefix+"CancelFullScreen"])){e.supportsFullScreen=!0;break}if(!Je.undefined(ge.msExitFullscreen)&&ge.msFullscreenEnabled){
// Special case for MS (when isn't it?)
e.prefix="ms",e.supportsFullScreen=!0;break}}else e.supportsFullScreen=!0;
// Update methods to do something useful
return e.supportsFullScreen&&(
// Yet again Microsoft awesomeness,
// Sometimes the prefix is 'ms', sometimes 'MS' to keep you on your toes
e.fullScreenEventName="ms"===e.prefix?"MSFullscreenChange":e.prefix+"fullscreenchange",e.isFullScreen=function(e){switch(Je.undefined(e)&&(e=ge.body),this.prefix){case"":return ge.fullscreenElement===e;case"moz":return ge.mozFullScreenElement===e;default:return ge[this.prefix+"FullscreenElement"]===e}},e.requestFullScreen=function(e){return Je.undefined(e)&&(e=ge.body),""===this.prefix?e.requestFullScreen():e[this.prefix+("ms"===this.prefix?"RequestFullscreen":"RequestFullScreen")]()},e.cancelFullScreen=function(){return""===this.prefix?ge.cancelFullScreen():ge[this.prefix+("ms"===this.prefix?"ExitFullscreen":"CancelFullScreen")]()},e.element=function(){return""===this.prefix?ge.fullscreenElement:ge[this.prefix+"FullscreenElement"]}),e}
// Local storage
// Player instance
function c(t,u){
// Trigger events, with plyr instance passed
function a(e,t,n,r){Le(e,t,n,qe({},r,{plyr:me}))}
// Debugging
function e(e,t){u.debug&&ve.console&&(t=Array.prototype.slice.call(t),Je.string(u.logPrefix)&&u.logPrefix.length&&t.unshift(u.logPrefix),console[e].apply(console,t))}
// Get icon URL
function o(){return{url:u.iconUrl,absolute:0===u.iconUrl.indexOf("http")||de.browser.isIE}}
// Build the default HTML
function i(){
// Create html array
var e=[],t=o(),n=(t.absolute?"":t.url)+"#"+u.iconPrefix;
// Larger overlaid play button
return xe(u.controls,"play-large")&&
/*html.push(
					'<button type="button" data-plyr="play" class="plyr__play-large">',
						'<svg><use xlink:href="' + iconPath + '-play" /></svg>',
						'<span class="plyr__sr-only">' + config.i18n.play + '</span>',
					'</button>'
				);*/
// igor
e.push('<span class="qt-playbtn plyr__play-large" data-plyr="play"><i class="dripicons-media-play"></i></span>'),e.push('<div class="plyr__controls">'),
// Restart button
xe(u.controls,"restart")&&e.push('<button type="button" data-plyr="restart">','<svg><use xlink:href="'+n+'-restart" /></svg>','<span class="plyr__sr-only">'+u.i18n.restart+"</span>","</button>"),
// Rewind button
xe(u.controls,"rewind")&&e.push('<button type="button" data-plyr="rewind">','<svg><use xlink:href="'+n+'-rewind" /></svg>','<span class="plyr__sr-only">'+u.i18n.rewind+"</span>","</button>"),
// Play Pause button
// TODO: This should be a toggle button really?
xe(u.controls,"play")&&e.push('<button type="button" data-plyr="play">','<svg><use xlink:href="'+n+'-play" /></svg>','<span class="plyr__sr-only">'+u.i18n.play+"</span>","</button>",'<button type="button" data-plyr="pause">','<svg><use xlink:href="'+n+'-pause" /></svg>','<span class="plyr__sr-only">'+u.i18n.pause+"</span>","</button>"),
// Fast forward button
xe(u.controls,"fast-forward")&&e.push('<button type="button" data-plyr="fast-forward">','<svg><use xlink:href="'+n+'-fast-forward" /></svg>','<span class="plyr__sr-only">'+u.i18n.forward+"</span>","</button>"),
// Progress
xe(u.controls,"progress")&&(
// Create progress
e.push('<span class="plyr__progress">','<label for="seek{id}" class="plyr__sr-only">Seek</label>','<input id="seek{id}" class="plyr__progress--seek" type="range" min="0" max="100" step="0.1" value="0" data-plyr="seek">','<progress class="plyr__progress--played" max="100" value="0" role="presentation"></progress>','<progress class="plyr__progress--buffer" max="100" value="0">',"<span>0</span>% "+u.i18n.buffered,"</progress>"),
// Seek tooltip
u.tooltips.seek&&e.push('<span class="plyr__tooltip">00:00</span>'),
// Close
e.push("</span>")),
// Media current time display
xe(u.controls,"current-time")&&e.push('<span class="plyr__time">','<span class="plyr__sr-only">'+u.i18n.currentTime+"</span>",'<span class="plyr__time--current">00:00</span>',"</span>"),
// Media duration display
xe(u.controls,"duration")&&e.push('<span class="plyr__time">','<span class="plyr__sr-only">'+u.i18n.duration+"</span>",'<span class="plyr__time--duration">00:00</span>',"</span>"),
// Toggle mute button
xe(u.controls,"mute")&&e.push('<button type="button" data-plyr="mute">','<svg class="icon--muted"><use xlink:href="'+n+'-muted" /></svg>','<svg><use xlink:href="'+n+'-volume" /></svg>','<span class="plyr__sr-only">'+u.i18n.toggleMute+"</span>","</button>"),
// Volume range control
xe(u.controls,"volume")&&e.push('<span class="plyr__volume">','<label for="volume{id}" class="plyr__sr-only">'+u.i18n.volume+"</label>",'<input id="volume{id}" class="plyr__volume--input" type="range" min="'+u.volumeMin+'" max="'+u.volumeMax+'" value="'+u.volume+'" data-plyr="volume">','<progress class="plyr__volume--display" max="'+u.volumeMax+'" value="'+u.volumeMin+'" role="presentation"></progress>',"</span>"),
// Toggle captions button
xe(u.controls,"captions")&&e.push('<button type="button" data-plyr="captions">','<svg class="icon--captions-on"><use xlink:href="'+n+'-captions-on" /></svg>','<svg><use xlink:href="'+n+'-captions-off" /></svg>','<span class="plyr__sr-only">'+u.i18n.toggleCaptions+"</span>","</button>"),
// Toggle fullscreen button
xe(u.controls,"fullscreen")&&e.push('<button type="button" data-plyr="fullscreen">','<svg class="icon--exit-fullscreen"><use xlink:href="'+n+'-exit-fullscreen" /></svg>','<svg><use xlink:href="'+n+'-enter-fullscreen" /></svg>','<span class="plyr__sr-only">'+u.i18n.toggleFullscreen+"</span>","</button>"),
// Close everything
e.push("</div>"),e.join("")}
// Setup fullscreen
function n(){if(de.supported.full&&("audio"!==de.type||u.fullscreen.allowAudio)&&u.fullscreen.enabled){
// Check for native support
var e=Be.supportsFullScreen;e||u.fullscreen.fallback&&!m()?(be((e?"Native":"Fallback")+" fullscreen enabled"),
// Add styling hook
Ie(de.container,u.classes.fullscreen.enabled,!0)):be("Fullscreen not supported and fallback disabled"),
// Toggle state
de.buttons&&de.buttons.fullscreen&&je(de.buttons.fullscreen,!1),
// Setup focus trap
f()}}
// Setup captions
function r(){
// Bail if not HTML5 video
if("video"===de.type){
// Inject the container
p(u.selectors.captions)||de.videoContainer.insertAdjacentHTML("afterbegin",'<div class="'+Ae(u.selectors.captions)+'"></div>'),
// Determine if HTML5 textTracks is supported
de.usingTextTracks=!1,de.media.textTracks&&(de.usingTextTracks=!0);for(
// Get URL of caption file if exists
var e="",t,n=de.media.childNodes,r=0;r<n.length;r++)"track"===n[r].nodeName.toLowerCase()&&("captions"!==(t=n[r].kind)&&"subtitles"!==t||(e=n[r].getAttribute("src")));
// Record if caption file exists or not
// If no caption file exists, hide container for caption text
if(de.captionExists=!0,""===e?(de.captionExists=!1,be("No caption track found")):be("Caption track found; URI: "+e),de.captionExists){for(
// Turn off native caption rendering to avoid double captions
// This doesn't seem to work in Safari 7+, so the <track> elements are removed from the dom below
var a=de.media.textTracks,s=0;s<a.length;s++)a[s].mode="hidden";
// Enable UI
// Rendering caption tracks
// Native support required - http://caniuse.com/webvtt
if(d(de),
// Disable unsupported browsers than report false positive
// Firefox bug: https://bugzilla.mozilla.org/show_bug.cgi?id=1033144
(de.browser.isIE&&10<=de.browser.version||de.browser.isFirefox&&31<=de.browser.version)&&(
// Debugging
be("Detected browser with known TextTrack issues - using manual fallback"),
// Set to false so skips to 'manual' captioning
de.usingTextTracks=!1),de.usingTextTracks){be("TextTracks supported");for(var o=0;o<a.length;o++){var i=a[o];"captions"!==i.kind&&"subtitles"!==i.kind||Oe(i,"cuechange",function(){
// Display a cue, if there is one
this.activeCues[0]&&"text"in this.activeCues[0]?c(this.activeCues[0].getCueAsHTML()):c()})}}else if(
// Caption tracks not natively supported
be("TextTracks not supported so rendering captions manually"),
// Render captions from array at appropriate time
de.currentCaption="",de.captions=[],""!==e){
// Create XMLHttpRequest Object
var l=new XMLHttpRequest;l.onreadystatechange=function(){if(4===l.readyState)if(200===l.status){var e=[],t,n=l.responseText,r="\r\n";
//According to webvtt spec, line terminator consists of one of the following
// CRLF (U+000D U+000A), LF (U+000A) or CR (U+000D)
-1===n.indexOf(r+r)&&(r=-1!==n.indexOf("\r\r")?"\r":"\n"),e=n.split(r+r);for(var a=0;a<e.length;a++){t=e[a],de.captions[a]=[];
// Get the parts of the captions
var s=t.split(r),o=0;
// Incase caption numbers are added
-1===s[o].indexOf(":")&&(o=1),de.captions[a]=[s[o],s[o+1]]}
// Remove first element ('VTT')
de.captions.shift(),be("Successfully loaded the caption file via AJAX")}else ye(u.logPrefix+"There was a problem loading the caption file via AJAX")},l.open("get",e,!0),l.send()}}else Ie(de.container,u.classes.captions.enabled)}}
// Set the current caption
function c(e){
/* jshint unused:false */
var t=p(u.selectors.captions),n=ge.createElement("span");
// Empty the container
t.innerHTML="",
// Default to empty
Je.undefined(e)&&(e=""),
// Set the span content
Je.string(e)?n.innerHTML=e.trim():n.appendChild(e),
// Set new caption text
t.appendChild(n);
// Force redraw (for Safari)
var r=t.offsetHeight}
// Captions functions
// Seek the manual caption time and update UI
function s(e){
// Utilities for caption time codes
function t(e,t){var n=[];n=e.split(" --\x3e ");for(var r=0;r<n.length;r++)
// WebVTT allows for extra meta data after the timestamp line
// So get rid of this if it exists
n[r]=n[r].replace(/(\d+:\d+:\d+\.\d+).*/,"$1");return a(n[t])}function n(e){return t(e,0)}function r(e){return t(e,1)}function a(e){if(null==e)return 0;var t=[],n=[],r;return n=(t=e.split(","))[0].split(":"),r=Math.floor(60*n[0]*60)+Math.floor(60*n[1])+Math.floor(n[2])}
// If it's not video, or we're using textTracks, bail.
if(!de.usingTextTracks&&"video"===de.type&&de.supported.full&&(
// Reset subcount
de.subcount=0,
// Check time is a number, if not use currentTime
// IE has a bug where currentTime doesn't go to 0
// https://twitter.com/Sam_Potts/status/573715746506731521
e=Je.number(e)?e:de.media.currentTime,de.captions[de.subcount]))
// If there's no subs available, bail
{for(;r(de.captions[de.subcount][0])<e.toFixed(1);)if(de.subcount++,de.subcount>de.captions.length-1){de.subcount=de.captions.length-1;break}
// Check if the next caption is in the current time range
de.media.currentTime.toFixed(1)>=n(de.captions[de.subcount][0])&&de.media.currentTime.toFixed(1)<=r(de.captions[de.subcount][0])?(de.currentCaption=de.captions[de.subcount][1],
// Render the caption
c(de.currentCaption)):c()}}
// Display captions container and button (for initialization)
function d(){
// If there's no caption toggle, bail
if(de.buttons.captions){Ie(de.container,u.classes.captions.enabled,!0);
// Try to load the value from storage
var e=de.storage.captionsEnabled;
// Otherwise fall back to the default config
Je.boolean(e)||(e=u.captions.defaultActive),e&&(Ie(de.container,u.classes.captions.active,!0),je(de.buttons.captions,!0))}}
// Find all elements
function l(e){return de.container.querySelectorAll(e)}
// Find a single element
function p(e){return l(e)[0]}
// Determine if we're in an iframe
function m(){try{return ve.self!==ve.top}catch(e){return!0}}
// Trap focus inside container
function f(){function e(e){
// If it is TAB
9===e.which&&de.isFullscreen&&(e.target!==r||e.shiftKey?e.target===n&&e.shiftKey&&(
// Move focus to last element that can be tabbed if Shift is used
e.preventDefault(),r.focus()):(
// Move focus to first element that can be tabbed if Shift isn't used
e.preventDefault(),n.focus()))}
// Bind the handler
var t=l("input:not([disabled]), button:not([disabled])"),n=t[0],r=t[t.length-1];Oe(de.container,"keydown",e)}
// Add elements to HTML5 media (source, tracks, etc)
function b(e,t){if(Je.string(t))Fe(e,de.media,{src:t});else if(t.constructor===Array)for(var n=t.length-1;0<=n;n--)Fe(e,de.media,t[n])}
// Insert controls
function y(){
// Sprite
if(u.loadSprite){var e=o();
// Only load external sprite using AJAX
e.absolute?(be("AJAX loading absolute SVG sprite"+(de.browser.isIE?" (due to IE)":"")),We(e.url,"sprite-plyr")):be("Sprite will be used as external resource directly")}
// Make a copy of the html
var t=u.html,n;
// Insert custom video controls
// Setup tooltips
if(be("Injecting custom controls"),
// If no controls are specified, create default
t||(t=i()),
// Replace all id references with random numbers
t=Te(
// Replace seek time instances
t=Te(t,"{seektime}",u.seekTime),"{id}",Math.floor(1e4*Math.random())),
// Inject to custom location
Je.string(u.selectors.controls.container)&&(n=ge.querySelector(u.selectors.controls.container)),
// Inject into the container by default
Je.htmlElement(n)||(n=de.container),
// Inject controls HTML
n.insertAdjacentHTML("beforeend",t),u.tooltips.controls)for(var r=l([u.selectors.controls.wrapper," ",u.selectors.labels," .",u.classes.hidden].join("")),a=r.length-1;0<=a;a--){var s=r[a];Ie(s,u.classes.hidden,!1),Ie(s,u.classes.tooltip,!0)}}
// Find the UI controls and store references
function v(){try{return de.controls=p(u.selectors.controls.wrapper),
// Buttons
de.buttons={},de.buttons.seek=p(u.selectors.buttons.seek),de.buttons.play=l(u.selectors.buttons.play),de.buttons.pause=p(u.selectors.buttons.pause),de.buttons.restart=p(u.selectors.buttons.restart),de.buttons.rewind=p(u.selectors.buttons.rewind),de.buttons.forward=p(u.selectors.buttons.forward),de.buttons.fullscreen=p(u.selectors.buttons.fullscreen),
// Inputs
de.buttons.mute=p(u.selectors.buttons.mute),de.buttons.captions=p(u.selectors.buttons.captions),
// Progress
de.progress={},de.progress.container=p(u.selectors.progress.container),
// Progress - Buffering
de.progress.buffer={},de.progress.buffer.bar=p(u.selectors.progress.buffer),de.progress.buffer.text=de.progress.buffer.bar&&de.progress.buffer.bar.getElementsByTagName("span")[0],
// Progress - Played
de.progress.played=p(u.selectors.progress.played),
// Seek tooltip
de.progress.tooltip=de.progress.container&&de.progress.container.querySelector("."+u.classes.tooltip),
// Volume
de.volume={},de.volume.input=p(u.selectors.volume.input),de.volume.display=p(u.selectors.volume.display),
// Timing
de.duration=p(u.selectors.duration),de.currentTime=p(u.selectors.currentTime),de.seekTime=l(u.selectors.seekTime),!0}catch(e){return ye("It looks like there is a problem with your controls HTML"),
// Restore native video controls
h(!0),!1}}
// Toggle style hook
function g(){Ie(de.container,u.selectors.container.replace(".",""),de.supported.full)}
// Toggle native controls
function h(e){e&&xe(u.types.html5,de.type)?de.media.setAttribute("controls",""):de.media.removeAttribute("controls")}
// Setup aria attribute for play and iframe title
function k(e){
// Find the current text
var t=u.i18n.play;
// If there's a media title set, use that for the label
// If there's a play button, set label
if(Je.string(u.title)&&u.title.length&&(t+=", "+u.title,
// Set container label
de.container.setAttribute("aria-label",u.title)),de.supported.full&&de.buttons.play)for(var n=de.buttons.play.length-1;0<=n;n--)de.buttons.play[n].setAttribute("aria-label",t);
// Set iframe title
// https://github.com/sampotts/plyr/issues/124
Je.htmlElement(e)&&e.setAttribute("title",u.i18n.frameTitle.replace("{title}",u.title))}
// Setup localStorage
function w(){var e=null;de.storage={},
// Bail if we don't have localStorage support or it's disabled
ze.supported&&u.storage.enabled&&(
// Clean up old volume
// https://github.com/sampotts/plyr/issues/171
ve.localStorage.removeItem("plyr-volume"),(
// load value from the current key
e=ve.localStorage.getItem(u.storage.key))&&(/^\d+(\.\d+)?$/.test(e)?
// If value is a number, it's probably volume from an older
// version of plyr. See: https://github.com/sampotts/plyr/pull/313
// Update the key to be JSON
x({volume:parseFloat(e)}):
// Assume it's JSON from this or a later version of plyr
de.storage=JSON.parse(e)))}
// Save a value back to local storage
function x(e){
// Bail if we don't have localStorage support or it's disabled
ze.supported&&u.storage.enabled&&(
// Update the working copy of the values
qe(de.storage,e),
// Update storage
ve.localStorage.setItem(u.storage.key,JSON.stringify(de.storage)))}
// Setup media
function T(){
// If there's no media, bail
if(de.media){if(de.supported.full&&(
// Add type class
Ie(de.container,u.classes.type.replace("{0}",de.type),!0),
// Add video class for embeds
// This will require changes if audio embeds are added
xe(u.types.embed,de.type)&&Ie(de.container,u.classes.type.replace("{0}","video"),!0),
// If there's no autoplay attribute, assume the video is stopped and add state class
Ie(de.container,u.classes.stopped,u.autoplay),
// Add iOS class
Ie(de.container,u.classes.isIos,de.browser.isIos),
// Add touch class
Ie(de.container,u.classes.isTouch,de.browser.isTouch),"video"===de.type)){
// Create the wrapper div
var e=ge.createElement("div");e.setAttribute("class",u.classes.videoWrapper),
// Wrap the video in a container
Se(de.media,e),
// Cache the container
de.videoContainer=e}
// Embeds
xe(u.types.embed,de.type)&&S()}else ye("No media element found!")}
// Setup YouTube/Vimeo
function S(){var e=ge.createElement("div"),t,n=de.type+"-"+Math.floor(1e4*Math.random());
// Parse IDs from URLs if supplied
switch(de.type){case"youtube":t=Re(de.embedId);break;case"vimeo":t=De(de.embedId);break;default:t=de.embedId}
// Remove old containers
for(var r=l('[id^="'+de.type+'-"]'),a=r.length-1;0<=a;a--)Ee(r[a]);
// Add embed class for responsive
if(Ie(de.media,u.classes.videoWrapper,!0),Ie(de.media,u.classes.embedWrapper,!0),"youtube"===de.type)
// Create the YouTube container
de.media.appendChild(e),
// Set ID
e.setAttribute("id",n),
// Setup API
Je.object(ve.YT)?_(t,e):(
// Load the API
we(u.urls.youtube.api),
// Setup callback for the API
ve.onYouTubeReadyCallbacks=ve.onYouTubeReadyCallbacks||[],
// Add to queue
ve.onYouTubeReadyCallbacks.push(function(){_(t,e)}),
// Set callback to process queue
ve.onYouTubeIframeAPIReady=function(){ve.onYouTubeReadyCallbacks.forEach(function(e){e()})});else if("vimeo"===de.type)
// Load the API if not already
if(
// Vimeo needs an extra div to hide controls on desktop (which has full support)
de.supported.full?de.media.appendChild(e):e=de.media,
// Set ID
e.setAttribute("id",n),Je.object(ve.Vimeo))C(t,e);else{we(u.urls.vimeo.api);
// Wait for fragaloop load
var s=ve.setInterval(function(){Je.object(ve.Vimeo)&&(ve.clearInterval(s),C(t,e))},50)}else if("soundcloud"===de.type){
// TODO: Currently unsupported and undocumented
// Inject the iframe
var o=ge.createElement("iframe");
// Watch for iframe load
o.loaded=!1,Oe(o,"load",function(){o.loaded=!0}),Ce(o,{src:"https://w.soundcloud.com/player/?url=https://api.soundcloud.com/tracks/"+t,id:n}),e.appendChild(o),de.media.appendChild(e),
// Load the API if not already
ve.SC||we(u.urls.soundcloud.api);
// Wait for SC load
var i=ve.setInterval(function(){ve.SC&&o.loaded&&(ve.clearInterval(i),F.call(o))},50)}}
// When embeds are ready
function E(){
// Setup the UI and call ready if full support
de.supported.full&&(ue(),ce()),
// Set title
k(p("iframe"))}
// Handle YouTube API ready
function _(e,t){
// Setup instance
// https://developers.google.com/youtube/iframe_api_reference
de.embed=new ve.YT.Player(t.id,{videoId:e,playerVars:{autoplay:u.autoplay?1:0,controls:de.supported.full?0:1,rel:0,showinfo:0,iv_load_policy:3,cc_load_policy:u.captions.defaultActive?1:0,cc_lang_pref:"en",wmode:"transparent",modestbranding:1,disablekb:1,origin:"*"},events:{onError:function(e){a(de.container,"error",!0,{code:e.data,embed:e.target})},onReady:function(e){
// Get the instance
var t=e.target;
// Create a faux HTML5 API using the YouTube API
de.media.play=function(){t.playVideo(),de.media.paused=!1},de.media.pause=function(){t.pauseVideo(),de.media.paused=!0},de.media.stop=function(){t.stopVideo(),de.media.paused=!0},de.media.duration=t.getDuration(),de.media.paused=!0,de.media.currentTime=0,de.media.muted=t.isMuted(),
// Set title
u.title=t.getVideoData().title,
// Set the tabindex
de.supported.full&&de.media.querySelector("iframe").setAttribute("tabindex","-1"),
// Update UI
E(),
// Trigger timeupdate
a(de.media,"timeupdate"),
// Trigger timeupdate
a(de.media,"durationchange"),
// Reset timer
ve.clearInterval(pe.buffering),
// Setup buffering
pe.buffering=ve.setInterval(function(){
// Get loaded % from YouTube
de.media.buffered=t.getVideoLoadedFraction(),
// Trigger progress only when we actually buffer something
(null===de.media.lastBuffered||de.media.lastBuffered<de.media.buffered)&&a(de.media,"progress"),
// Set last buffer point
de.media.lastBuffered=de.media.buffered,
// Bail if we're at 100%
1===de.media.buffered&&(ve.clearInterval(pe.buffering),
// Trigger event
a(de.media,"canplaythrough"))},200)},onStateChange:function(e){
// Get the instance
var t=e.target;
// Reset timer
// Handle events
// -1   Unstarted
// 0    Ended
// 1    Playing
// 2    Paused
// 3    Buffering
// 5    Video cued
switch(ve.clearInterval(pe.playing),e.data){case 0:de.media.paused=!0,a(de.media,"ended");break;case 1:de.media.paused=!1,
// If we were seeking, fire seeked event
de.media.seeking&&a(de.media,"seeked"),de.media.seeking=!1,a(de.media,"play"),a(de.media,"playing"),
// Poll to get playback progress
pe.playing=ve.setInterval(function(){
// Set the current time
de.media.currentTime=t.getCurrentTime(),
// Trigger timeupdate
a(de.media,"timeupdate")},100),
// Check duration again due to YouTube bug
// https://github.com/sampotts/plyr/issues/374
// https://code.google.com/p/gdata-issues/issues/detail?id=8690
de.media.duration!==t.getDuration()&&(de.media.duration=t.getDuration(),a(de.media,"durationchange"));break;case 2:de.media.paused=!0,a(de.media,"pause");break}a(de.container,"statechange",!1,{code:e.data})}}})}
// Vimeo ready
function C(e,t){
// Setup instance
// https://github.com/vimeo/player.js
de.embed=new ve.Vimeo.Player(t,{id:parseInt(e),loop:u.loop,autoplay:u.autoplay,byline:!1,portrait:!1,title:!1}),
// Create a faux HTML5 API using the Vimeo API
de.media.play=function(){de.embed.play(),de.media.paused=!1},de.media.pause=function(){de.embed.pause(),de.media.paused=!0},de.media.stop=function(){de.embed.stop(),de.media.paused=!0},de.media.paused=!0,de.media.currentTime=0,
// Update UI
E(),de.embed.getCurrentTime().then(function(e){de.media.currentTime=e,
// Trigger timeupdate
a(de.media,"timeupdate")}),de.embed.getDuration().then(function(e){de.media.duration=e,
// Trigger timeupdate
a(de.media,"durationchange")}),
// TODO: Captions
/*if (config.captions.defaultActive) {
				plyr.embed.enableTextTrack('en');
			}*/
de.embed.on("loaded",function(){
// Fix keyboard focus issues
// https://github.com/sampotts/plyr/issues/317
Je.htmlElement(de.embed.element)&&de.supported.full&&de.embed.element.setAttribute("tabindex","-1")}),de.embed.on("play",function(){de.media.paused=!1,a(de.media,"play"),a(de.media,"playing")}),de.embed.on("pause",function(){de.media.paused=!0,a(de.media,"pause")}),de.embed.on("timeupdate",function(e){de.media.seeking=!1,de.media.currentTime=e.seconds,a(de.media,"timeupdate")}),de.embed.on("progress",function(e){de.media.buffered=e.percent,a(de.media,"progress"),1===parseInt(e.percent)&&
// Trigger event
a(de.media,"canplaythrough")}),de.embed.on("seeked",function(){de.media.seeking=!1,a(de.media,"seeked"),a(de.media,"play")}),de.embed.on("ended",function(){de.media.paused=!0,a(de.media,"ended")})}
// Soundcloud ready
function F(){
/* jshint validthis: true */
de.embed=ve.SC.Widget(this),
// Setup on ready
de.embed.bind(ve.SC.Widget.Events.READY,function(){
// Create a faux HTML5 API using the Soundcloud API
de.media.play=function(){de.embed.play(),de.media.paused=!1},de.media.pause=function(){de.embed.pause(),de.media.paused=!0},de.media.stop=function(){de.embed.seekTo(0),de.embed.pause(),de.media.paused=!0},de.media.paused=!0,de.media.currentTime=0,de.embed.getDuration(function(e){de.media.duration=e/1e3,
// Update UI
E()}),de.embed.getPosition(function(e){de.media.currentTime=e,
// Trigger timeupdate
a(de.media,"timeupdate")}),de.embed.bind(ve.SC.Widget.Events.PLAY,function(){de.media.paused=!1,a(de.media,"play"),a(de.media,"playing")}),de.embed.bind(ve.SC.Widget.Events.PAUSE,function(){de.media.paused=!0,a(de.media,"pause")}),de.embed.bind(ve.SC.Widget.Events.PLAY_PROGRESS,function(e){de.media.seeking=!1,de.media.currentTime=e.currentPosition/1e3,a(de.media,"timeupdate")}),de.embed.bind(ve.SC.Widget.Events.LOAD_PROGRESS,function(e){de.media.buffered=e.loadProgress,a(de.media,"progress"),1===parseInt(e.loadProgress)&&
// Trigger event
a(de.media,"canplaythrough")}),de.embed.bind(ve.SC.Widget.Events.FINISH,function(){de.media.paused=!0,a(de.media,"ended")})})}
// Play media
function A(){"play"in de.media&&de.media.play()}
// Pause media
function I(){"pause"in de.media&&de.media.pause()}
// Toggle playback
function N(e){
// True toggle
return Je.boolean(e)||(e=de.media.paused),e?A():I(),e}
// Rewind
function P(e){
// Use default if needed
Je.number(e)||(e=u.seekTime),O(de.media.currentTime-e)}
// Fast forward
function M(e){
// Use default if needed
Je.number(e)||(e=u.seekTime),O(de.media.currentTime+e)}
// Seek to time
// The input parameter can be an event or a number
function O(e){var t=0,n=de.media.paused,r=L();Je.number(e)?t=e:Je.object(e)&&xe(["input","change"],e.type)&&(
// It's the seek slider
// Seek to the selected time
t=e.target.value/e.target.max*r),
// Normalise targetTime
t<0?t=0:r<t&&(t=r),
// Update seek range and progress
Q(t);
// Set the current time
// Try/catch incase the media isn't set and we're calling seek() from source() and IE moans
try{de.media.currentTime=t.toFixed(4)}catch(e){}
// Embeds
if(xe(u.types.embed,de.type)){switch(de.type){case"youtube":de.embed.seekTo(t);break;case"vimeo":
// Round to nearest second for vimeo
de.embed.setCurrentTime(t.toFixed(0));break;case"soundcloud":de.embed.seekTo(1e3*t);break}n&&I(),
// Trigger timeupdate
a(de.media,"timeupdate"),
// Set seeking flag
de.media.seeking=!0,
// Trigger seeking
a(de.media,"seeking")}
// Logging
be("Seeking to "+de.media.currentTime+" seconds"),
// Special handling for 'manual' captions
s(t)}
// Get the duration (or custom if set)
function L(){
// It should be a number, but parse it just incase
var e=parseInt(u.duration),
// True duration
t=0;
// Only if duration available
// If custom duration is funky, use regular duration
return null===de.media.duration||isNaN(de.media.duration)||(t=de.media.duration),isNaN(e)?t:e}
// Check playing state
function j(){Ie(de.container,u.classes.playing,!de.media.paused),Ie(de.container,u.classes.stopped,de.media.paused),ee(de.media.paused)}
// Save scroll position
function V(){Xe={x:ve.pageXOffset||0,y:ve.pageYOffset||0}}
// Restore scroll position
function q(){ve.scrollTo(Xe.x,Xe.y)}
// Toggle fullscreen
function R(e){
// Check for native support
var t=Be.supportsFullScreen;if(t){
// If it's a fullscreen change event, update the UI
if(!e||e.type!==Be.fullScreenEventName)
// Else it's a user request to enter or exit
return Be.isFullScreen(de.container)?
// Bail from fullscreen
Be.cancelFullScreen():(
// Save scroll position
V(),
// Request full screen
Be.requestFullScreen(de.container)),void(
// Check if we're actually full screen (it could fail)
de.isFullscreen=Be.isFullScreen(de.container));de.isFullscreen=Be.isFullScreen(de.container)}else
// Otherwise, it's a simple toggle
de.isFullscreen=!de.isFullscreen,
// Bind/unbind escape key
ge.body.style.overflow=de.isFullscreen?"hidden":"";
// Set class hook
Ie(de.container,u.classes.fullscreen.active,de.isFullscreen),
// Trap focus
f(de.isFullscreen),
// Set button state
de.buttons&&de.buttons.fullscreen&&je(de.buttons.fullscreen,de.isFullscreen),
// Trigger an event
a(de.container,de.isFullscreen?"enterfullscreen":"exitfullscreen",!0),
// Restore scroll position
!de.isFullscreen&&t&&q()}
// Mute
function D(e){
// Embeds
if(
// If the method is called without parameter, toggle based on current value
Je.boolean(e)||(e=!de.media.muted),
// Set button state
je(de.buttons.mute,e),
// Set mute on the player
de.media.muted=e,
// If volume is 0 after unmuting, set to default
0===de.media.volume&&H(u.volume),xe(u.types.embed,de.type)){
// YouTube
switch(de.type){case"youtube":de.embed[de.media.muted?"mute":"unMute"]();break;case"vimeo":case"soundcloud":de.embed.setVolume(de.media.muted?0:parseFloat(u.volume/u.volumeMax));break}
// Trigger volumechange for embeds
a(de.media,"volumechange")}}
// Set volume
function H(e){var t=u.volumeMax,n=u.volumeMin;
// Load volume from storage if no value specified
// Embeds
if(Je.undefined(e)&&(e=de.storage.volume),
// Use config if all else fails
(null===e||isNaN(e))&&(e=u.volume),
// Maximum is volumeMax
t<e&&(e=t),
// Minimum is volumeMin
e<n&&(e=n),
// Set the player volume
de.media.volume=parseFloat(e/t),
// Set the display
de.volume.display&&(de.volume.display.value=e),xe(u.types.embed,de.type)){switch(de.type){case"youtube":de.embed.setVolume(100*de.media.volume);break;case"vimeo":case"soundcloud":de.embed.setVolume(de.media.volume);break}
// Trigger volumechange for embeds
a(de.media,"volumechange")}
// Toggle muted state
0===e?de.media.muted=!0:de.media.muted&&0<e&&D()}
// Increase volume
function W(e){var t=de.media.muted?0:de.media.volume*u.volumeMax;Je.number(e)||(e=u.volumeStep),H(t+e)}
// Decrease volume
function Y(e){var t=de.media.muted?0:de.media.volume*u.volumeMax;Je.number(e)||(e=u.volumeStep),H(t-e)}
// Update volume UI and storage
function U(){
// Get the current volume
var e=de.media.muted?0:de.media.volume*u.volumeMax;
// Update the <input type="range"> if present
de.supported.full&&(de.volume.input&&(de.volume.input.value=e),de.volume.display&&(de.volume.display.value=e)),
// Update the volume in storage
x({volume:e}),
// Toggle class if muted
Ie(de.container,u.classes.muted,0===e),
// Update checkbox for mute state
de.supported.full&&de.buttons.mute&&je(de.buttons.mute,0===e)}
// Toggle captions
function B(e){
// If there's no full support, or there's no caption toggle
de.supported.full&&de.buttons.captions&&(
// If the method is called without parameter, toggle based on current value
Je.boolean(e)||(e=-1===de.container.className.indexOf(u.classes.captions.active)),
// Set global
de.captionsEnabled=e,
// Toggle state
je(de.buttons.captions,de.captionsEnabled),
// Add class hook
Ie(de.container,u.classes.captions.active,de.captionsEnabled),
// Trigger an event
a(de.container,de.captionsEnabled?"captionsenabled":"captionsdisabled",!0),
// Save captions state to localStorage
x({captionsEnabled:de.captionsEnabled}))}
// Check if media is loading
function X(e){var t="waiting"===e.type;
// Clear timer
clearTimeout(pe.loading),
// Timer to prevent flicker when seeking
pe.loading=setTimeout(function(){
// Toggle container class hook
Ie(de.container,u.classes.loading,t),
// Show controls if loading, hide if done
ee(t)},t?250:0)}
// Update <progress> elements
function $(e){if(de.supported.full){var t=de.progress.played,n=0,r=L(),a;if(e)switch(e.type){
// Video playing
case"timeupdate":case"seeking":if(de.controls.pressed)return;n=Ve(de.media.currentTime,r),
// Set seek range value only if it's a 'natural' time event
"timeupdate"===e.type&&de.buttons.seek&&(de.buttons.seek.value=n);break;
// Check buffer status
case"playing":case"progress":t=de.progress.buffer,n=(a=de.media.buffered)&&a.length?Ve(a.end(0),r):Je.number(a)?100*a:0;break}
// Set values
J(t,n)}}
// Set <progress> value
function J(e,t){if(de.supported.full){
// Default to buffer or bail
if(
// Default to 0
Je.undefined(t)&&(t=0),Je.undefined(e)){if(!de.progress||!de.progress.buffer)return;e=de.progress.buffer}
// One progress element passed
Je.htmlElement(e)?e.value=t:e&&(
// Object of progress + text element
e.bar&&(e.bar.value=t),e.text&&(e.text.innerHTML=t))}}
// Update the displayed time
function z(e,t){
// Bail if there's no duration display
if(t){
// Fallback to 0
isNaN(e)&&(e=0),de.secs=parseInt(e%60),de.mins=parseInt(e/60%60),de.hours=parseInt(e/60/60%60);
// Do we need to display hours?
var n=0<parseInt(L()/60/60%60);
// Ensure it's two digits. For example, 03 rather than 3.
de.secs=("0"+de.secs).slice(-2),de.mins=("0"+de.mins).slice(-2),
// Render
t.innerHTML=(n?de.hours+":":"")+de.mins+":"+de.secs}}
// Show the duration on metadataloaded
function G(){if(de.supported.full){
// Determine duration
var e=L()||0;
// If there's only one time display, display duration there
!de.duration&&u.displayDuration&&de.media.paused&&z(e,de.currentTime),
// If there's a duration element, update content
de.duration&&z(e,de.duration),
// Update the tooltip (if visible)
Z()}}
// Handle time change event
function K(e){
// Duration
z(de.media.currentTime,de.currentTime),
// Ignore updates while seeking
e&&"timeupdate"===e.type&&de.media.seeking||
// Playing progress
$(e)}
// Update seek range and progress
function Q(e){
// Default to 0
Je.number(e)||(e=0);var t,n=Ve(e,L());
// Update progress
de.progress&&de.progress.played&&(de.progress.played.value=n),
// Update seek range input
de.buttons&&de.buttons.seek&&(de.buttons.seek.value=n)}
// Update hover tooltip for seeking
function Z(e){var t=L();
// Bail if setting not true
if(u.tooltips.seek&&de.progress.container&&0!==t){
// Calculate percentage
var n=de.progress.container.getBoundingClientRect(),r=0,a=u.classes.tooltip+"--visible";
// Determine percentage, if already visible
if(e)r=100/n.width*(e.pageX-n.left);else{if(!Ne(de.progress.tooltip,a))return;r=de.progress.tooltip.style.left.replace("%","")}
// Set bounds
r<0?r=0:100<r&&(r=100),
// Display the time a click would seek to
z(t/100*r,de.progress.tooltip),
// Set position
de.progress.tooltip.style.left=r+"%",
// Show/hide the tooltip
// If the event is a moues in/out and percentage is inside bounds
e&&xe(["mouseenter","mouseleave"],e.type)&&Ie(de.progress.tooltip,a,"mouseenter"===e.type)}}
// Show the player controls in fullscreen mode
function ee(e){
// Don't hide if config says not to, it's audio, or not ready or loading
if(u.hideControls&&"audio"!==de.type){var t=0,n=!1,r=e,a=Ne(de.container,u.classes.loading);
// Default to false if no boolean
// If the mouse is not over the controls, set a timeout to hide them
if(Je.boolean(e)||(e&&e.type?(
// Is the enter fullscreen event
n="enterfullscreen"===e.type,
// Whether to show controls
r=xe(["mousemove","touchstart","mouseenter","focus"],e.type),
// Delay hiding on move events
xe(["mousemove","touchmove"],e.type)&&(t=2e3),
// Delay a little more for keyboard users
"focus"===e.type&&(t=3e3)):r=Ne(de.container,u.classes.hideControls)),
// Clear timer every movement
ve.clearTimeout(pe.hover),r||de.media.paused||a){
// Always show controls when paused or if touch
if(Ie(de.container,u.classes.hideControls,!1),de.media.paused||a)return;
// Delay for hiding on touch
de.browser.isTouch&&(t=3e3)}
// If toggle is false or if we're playing (regardless of toggle),
// then set the timer to hide the controls
r&&de.media.paused||(pe.hover=ve.setTimeout(function(){
// If the mouse is over the controls (and not entering fullscreen), bail
(!de.controls.pressed&&!de.controls.hover||n)&&Ie(de.container,u.classes.hideControls,!0)},t))}}
// Add common function to retrieve media source
function te(e){
// If not null or undefined, parse it
if(Je.undefined(e)){
// Return the current source
var t;switch(de.type){case"youtube":t=de.embed.getVideoUrl();break;case"vimeo":de.embed.getVideoUrl.then(function(e){t=e});break;case"soundcloud":de.embed.getCurrentSound(function(e){t=e.permalink_url});break;default:t=de.media.currentSrc;break}return t||""}ne(e)}
// Update source
// Sources are not checked for support so be careful
function ne(t){
// Setup new source
function e(){
// Set the type
if(
// Remove embed object
de.embed=null,
// Remove the old media
Ee(de.media),
// Remove video container
"video"===de.type&&de.videoContainer&&Ee(de.videoContainer),
// Reset class name
de.container&&de.container.removeAttribute("class"),"type"in t&&(de.type=t.type,"video"===de.type)){var e=t.sources[0];"type"in e&&xe(u.types.embed,e.type)&&(de.type=e.type)}
// Check for support
// Create new markup
switch(de.supported=Ye(de.type),de.type){case"video":de.media=ge.createElement("video");break;case"audio":de.media=ge.createElement("audio");break;case"youtube":case"vimeo":case"soundcloud":de.media=ge.createElement("div"),de.embedId=t.sources[0].src;break}
// Inject the new element
_e(de.container,de.media),
// Autoplay the new source?
Je.boolean(t.autoplay)&&(u.autoplay=t.autoplay),
// Set attributes for audio and video
xe(u.types.html5,de.type)&&(u.crossorigin&&de.media.setAttribute("crossorigin",""),u.autoplay&&de.media.setAttribute("autoplay",""),"poster"in t&&de.media.setAttribute("poster",t.poster),u.loop&&de.media.setAttribute("loop","")),
// Restore class hooks
Ie(de.container,u.classes.fullscreen.active,de.isFullscreen),Ie(de.container,u.classes.captions.active,de.captionsEnabled),g(),
// Set new sources for html5
xe(u.types.html5,de.type)&&b("source",t.sources),
// Set up from scratch
T(),
// HTML5 stuff
xe(u.types.html5,de.type)&&(
// Setup captions
"tracks"in t&&b("track",t.tracks),
// Load HTML5 sources
de.media.load()),
// If HTML5 or embed but not fully supported, setupInterface and call ready now
(xe(u.types.html5,de.type)||xe(u.types.embed,de.type)&&!de.supported.full)&&(
// Setup interface
ue(),
// Call ready
ce()),
// Set aria title and iframe title
u.title=t.title,k()}
// Destroy instance adn wait for callback
// Vimeo throws a wobbly if you don't wait
Je.object(t)&&"sources"in t&&t.sources.length?(
// Remove ready class hook
Ie(de.container,u.classes.ready,!1),
// Pause playback
I(),
// Update seek range and progress
Q(),
// Reset buffer progress
J(),
// Cancel current network requests
oe(),ie(e,!1)):ye("Invalid source format")}
// Update poster
function re(e){"video"===de.type&&de.media.setAttribute("poster",e)}
// Listen for control events
function ae(){
// Click play/pause helper
function e(){var e=N(),t=de.buttons[e?"play":"pause"],n=de.buttons[e?"pause":"play"];
// Determine which buttons
// Setup focus and tab focus
if(
// Get the last play button to account for the large play button
n=n&&1<n.length?n[n.length-1]:n[0]){var r=Ne(t,u.classes.tabFocus);setTimeout(function(){n.focus(),r&&(Ie(t,u.classes.tabFocus,!1),Ie(n,u.classes.tabFocus,!0))},100)}}
// Get the focused element
function s(){var e=ge.activeElement;return e=e&&e!==ge.body?ge.querySelector(":focus"):null}
// Get the key code for an event
function o(e){return e.keyCode?e.keyCode:e.which}
// Detect tab focus
function r(e){for(var t in de.buttons){var n=de.buttons[t];if(Je.nodeList(n))for(var r=0;r<n.length;r++)Ie(n[r],u.classes.tabFocus,n[r]===e);else Ie(n,u.classes.tabFocus,n===e)}}
// Keyboard shortcuts
function i(e){
// Seek by the number keys
function t(){
// Get current duration
var e=de.media.duration;
// Bail if we have no duration set
Je.number(e)&&
// Divide the max duration into 10th's and times by the number value
O(e/10*(n-48))}
// Handle the key on keydown
// Reset on keyup
var n=o(e),r="keydown"===e.type,a=r&&n===l;
// If the event is bubbled from the media element
// Firefox doesn't get the keycode for whatever reason
if(Je.number(n))if(r){
// Which keycodes should we prevent default
var s;
// If the code is found prevent default (e.g. prevent scrolling for arrows)
switch(xe([48,49,50,51,52,53,54,56,57,32,75,38,40,77,39,37,70,67],n)&&(e.preventDefault(),e.stopPropagation()),n){
// 0-9
case 48:case 49:case 50:case 51:case 52:case 53:case 54:case 55:case 56:case 57:a||t();break;
// Space and K key
case 32:case 75:a||N();break;
// Arrow up
case 38:W();break;
// Arrow down
case 40:Y();break;
// M key
case 77:a||D();break;
// Arrow forward
case 39:M();break;
// Arrow back
case 37:P();break;
// F key
case 70:R();break;
// C key
case 67:a||B();break}
// Escape is handle natively when in full screen
// So we only need to worry about non native
!Be.supportsFullScreen&&de.isFullscreen&&27===n&&R(),
// Store last code for next cycle
l=n}else l=null}
// Focus/tab management
// IE doesn't support input event, so we fallback to change
var t=de.browser.isIE?"change":"input";if(u.keyboardShorcuts.focused){var l=null;
// Handle global presses
u.keyboardShorcuts.global&&Oe(ve,"keydown keyup",function(e){var t=o(e),n=s(),r=[48,49,50,51,52,53,54,56,57,75,77,70,67],a;
// Only handle global key press if there's only one player
// and the key is in the allowed keys
// and if the focused element is not editable (e.g. text input)
// and any that accept key input http://webaim.org/techniques/keyboard/
1!==Ue().length||!xe(r,t)||Je.htmlElement(n)&&Pe(n,u.selectors.editable)||i(e)}),
// Handle presses on focused
Oe(de.container,"keydown keyup",i)}for(var n in Oe(ve,"keyup",function(e){var t=o(e),n=s();9===t&&r(n)}),Oe(ge.body,"click",function(){Ie(p("."+u.classes.tabFocus),u.classes.tabFocus,!1)}),de.buttons){var a=de.buttons[n];Oe(a,"blur",function(){Ie(a,"tab-focus",!1)})}
// Play
Me(de.buttons.play,"click",u.listeners.play,e),
// Pause
Me(de.buttons.pause,"click",u.listeners.pause,e),
// Restart
Me(de.buttons.restart,"click",u.listeners.restart,O),
// Rewind
Me(de.buttons.rewind,"click",u.listeners.rewind,P),
// Fast forward
Me(de.buttons.forward,"click",u.listeners.forward,M),
// Seek
Me(de.buttons.seek,t,u.listeners.seek,O),
// Set volume
Me(de.volume.input,t,u.listeners.volume,function(){H(de.volume.input.value)}),
// Mute
Me(de.buttons.mute,"click",u.listeners.mute,D),
// Fullscreen
Me(de.buttons.fullscreen,"click",u.listeners.fullscreen,R),
// Handle user exiting fullscreen by escaping etc
Be.supportsFullScreen&&Oe(ge,Be.fullScreenEventName,R),
// Captions
Me(de.buttons.captions,"click",u.listeners.captions,B),
// Seek tooltip
Oe(de.progress.container,"mouseenter mouseleave mousemove",Z),
// Toggle controls visibility based on mouse movement
u.hideControls&&(
// Toggle controls on mouse events and entering fullscreen
Oe(de.container,"mouseenter mouseleave mousemove touchstart touchend touchcancel touchmove enterfullscreen",ee),
// Watch for cursor over controls so they don't hide when trying to interact
Oe(de.controls,"mouseenter mouseleave",function(e){de.controls.hover="mouseenter"===e.type}),
// Watch for cursor over controls so they don't hide when trying to interact
Oe(de.controls,"mousedown mouseup touchstart touchend touchcancel",function(e){de.controls.pressed=xe(["mousedown","touchstart"],e.type)}),
// Focus in/out on controls
Oe(de.controls,"focus blur",ee,!0)),
// Adjust volume on scroll
Oe(de.volume.input,"wheel",function(e){e.preventDefault();
// Detect "natural" scroll - suppored on OS X Safari only
// Other browsers on OS X will be inverted until support improves
var t=e.webkitDirectionInvertedFromDevice,n=u.volumeStep/5;
// Scroll down (or up on natural) to decrease
(e.deltaY<0||0<e.deltaX)&&(t?Y(n):W(n)),
// Scroll up (or down on natural) to increase
(0<e.deltaY||e.deltaX<0)&&(t?W(n):Y(n))})}
// Listen for media events
function se(){
// Click video
if(
// Time change on media
Oe(de.media,"timeupdate seeking",K),
// Update manual captions
Oe(de.media,"timeupdate",s),
// Display duration
Oe(de.media,"durationchange loadedmetadata",G),
// Handle the media finishing
Oe(de.media,"ended",function(){
// Show poster on end
"video"===de.type&&u.showPosterOnEnd&&(
// Clear
"video"===de.type&&c(),
// Restart
O(),
// Re-load media
de.media.load())}),
// Check for buffer progress
Oe(de.media,"progress playing",$),
// Handle native mute
Oe(de.media,"volumechange",U),
// Handle native play/pause
Oe(de.media,"play pause ended",j),
// Loading
Oe(de.media,"waiting canplay seeked",X),u.clickToPlay&&"audio"!==de.type){
// Re-fetch the wrapper
var e=p("."+u.classes.videoWrapper);
// Bail if there's no wrapper (this should never happen)
if(!e)return;
// Set cursor
e.style.cursor="pointer",
// On click play, pause ore restart
Oe(e,"click",function(){
// Touch devices will just show controls (if we're hiding controls)
u.hideControls&&de.browser.isTouch&&!de.media.paused||(de.media.paused?A():de.media.ended?(O(),A()):I())})}
// Disable right click
u.disableContextMenu&&Oe(de.media,"contextmenu",function(e){e.preventDefault()}),
// Proxy events to container
// Bubble up key events for Edge
Oe(de.media,u.events.concat(["keyup","keydown"]).join(" "),function(e){a(de.container,e.type,!0)})}
// Cancel current network requests
// See https://github.com/sampotts/plyr/issues/174
function oe(){if(xe(u.types.html5,de.type)){for(
// Remove child sources
var e=de.media.querySelectorAll("source"),t=0;t<e.length;t++)Ee(e[t]);
// Set blank video src attribute
// This is to prevent a MEDIA_ERR_SRC_NOT_SUPPORTED error
// Info: http://stackoverflow.com/questions/32231579/how-to-properly-dispose-of-an-html5-video-and-close-socket-or-connection
de.media.setAttribute("src",u.blankUrl),
// Load the new empty source
// This will cancel existing requests
// See https://github.com/sampotts/plyr/issues/174
de.media.load(),
// Debugging
be("Cancelled network requests")}}
// Destroy an instance
// Event listeners are removed when elements are removed
// http://stackoverflow.com/questions/12528049/if-a-dom-element-is-removed-are-its-listeners-also-removed-from-memory
function ie(e,t){function n(){clearTimeout(pe.cleanUp),
// Default to restore original element
Je.boolean(t)||(t=!0),
// Callback
Je.function(e)&&e.call(fe),
// Bail if we don't need to restore the original element
t&&(
// Remove init flag
de.init=!1,
// Replace the container with the original element provided
de.container.parentNode.replaceChild(fe,de.container),
// Allow overflow (set on fullscreen)
ge.body.style.overflow="",
// Event
a(fe,"destroyed",!0))}
// Bail if the element is not initialized
if(!de.init)return null;
// Type specific stuff
switch(de.type){case"youtube":
// Clear timers
ve.clearInterval(pe.buffering),ve.clearInterval(pe.playing),
// Destroy YouTube API
de.embed.destroy(),
// Clean up
n();break;case"vimeo":
// Destroy Vimeo API
// then clean up (wait, to prevent postmessage errors)
de.embed.unload().then(n),
// Vimeo does not always return
pe.cleanUp=ve.setTimeout(n,200);break;case"video":case"audio":
// Restore native video controls
h(!0),
// Clean up
n();break}}
// Setup a player
function le(){
// Bail if the element is initialized
if(de.init)return null;
// Setup the fullscreen api
// Bail if nothing to setup
if(Be=He(),
// Sniff out the browser
de.browser=he(),Je.htmlElement(de.media)){
// Load saved settings from localStorage
w();
// Set media type based on tag or data attribute
// Supported: video, audio, vimeo, youtube
var e=t.tagName.toLowerCase();"div"===e?(de.type=t.getAttribute("data-type"),de.embedId=t.getAttribute("data-video-id"),
// Clean up
t.removeAttribute("data-type"),t.removeAttribute("data-video-id")):(de.type=e,u.crossorigin=null!==t.getAttribute("crossorigin"),u.autoplay=u.autoplay||null!==t.getAttribute("autoplay"),u.loop=u.loop||null!==t.getAttribute("loop")),
// Check for support
de.supported=Ye(de.type),
// If no native support, bail
de.supported.basic&&(
// Wrap media
de.container=Se(t,ge.createElement("div")),
// Allow focus to be captured
de.container.setAttribute("tabindex",0),
// Add style hook
g(),
// Debug info
be(de.browser.name+" "+de.browser.version),
// Setup media
T(),
// Setup interface
// If embed but not fully supported, setupInterface (to avoid flash of controls) and call ready now
(xe(u.types.html5,de.type)||xe(u.types.embed,de.type)&&!de.supported.full)&&(
// Setup UI
ue(),
// Call ready
ce(),
// Set title on button and frame
k()),
// Successful setup
de.init=!0)}}
// Setup the UI
function ue(){
// Don't setup interface if no support
if(!de.supported.full)
// Bail
return ye("Basic support only",de.type),
// Remove controls
Ee(p(u.selectors.controls.wrapper)),
// Remove large play
Ee(p(u.selectors.buttons.play)),void
// Restore native controls
h(!0);
// Inject custom controls if not present
var e=!l(u.selectors.controls.wrapper).length;e&&
// Inject custom controls
y(),
// Find the elements
v()&&(
// If the controls are injected, re-bind listeners for controls
e&&ae(),
// Media element listeners
se(),
// Remove native controls
h(),
// Setup fullscreen
n(),
// Captions
r(),
// Set volume
H(),U(),
// Reset time display
K(),
// Update the UI
j())}
// Everything done
function ce(){
// Ready event at end of execution stack
ve.setTimeout(function(){a(de.media,"ready")},0),
// Set class hook on media element
Ie(de.media,$e.classes.setup,!0),
// Set container class for ready
Ie(de.container,u.classes.ready,!0),
// Store a refernce to instance
de.media.plyr=me,
// Autoplay
u.autoplay&&A()}
// Initialize instance
var de=this,pe={},me,fe=(
// Set media
de.media=t).cloneNode(!0),be=function(){e("log",arguments)},ye=function(){e("warn",arguments)};
// If init failed, return null
// Log config options
return be("Config",u),me={getOriginal:function(){return fe},getContainer:function(){return de.container},getEmbed:function(){return de.embed},getMedia:function(){return de.media},getType:function(){return de.type},getDuration:L,getCurrentTime:function(){return de.media.currentTime},getVolume:function(){return de.media.volume},isMuted:function(){return de.media.muted},isReady:function(){return Ne(de.container,u.classes.ready)},isLoading:function(){return Ne(de.container,u.classes.loading)},isPaused:function(){return de.media.paused},on:function(e,t){return Oe(de.container,e,t),this},play:A,pause:I,stop:function(){I(),O()},restart:O,rewind:P,forward:M,seek:O,source:te,poster:re,setVolume:H,togglePlay:N,toggleMute:D,toggleCaptions:B,toggleFullscreen:R,toggleControls:ee,isFullscreen:function(){return de.isFullscreen||!1},support:function(e){return ke(de,e)},destroy:ie},le(),de.init?me:null}
// Load a sprite
function We(e,t){var n=new XMLHttpRequest;
// If the id is set and sprite exists, bail
if(!Je.string(t)||!Je.htmlElement(ge.querySelector("#"+t))){
// Create placeholder (to prevent loading twice)
var r=ge.createElement("div");r.setAttribute("hidden",""),Je.string(t)&&r.setAttribute("id",t),ge.body.insertBefore(r,ge.body.childNodes[0]),
// Check for CORS support
"withCredentials"in n&&(n.open("GET",e,!0),
// Inject hidden div with sprite on load
n.onload=function(){r.innerHTML=n.responseText},n.send())}}
// Check for support
function Ye(e){var t=he(),n=t.isIE&&t.version<=9,r=t.isIos,a=t.isIphone,s=!!ge.createElement("audio").canPlayType,o=!!ge.createElement("video").canPlayType,i=!1,l=!1;switch(e){case"video":l=(i=o)&&!n&&!a;break;case"audio":l=(i=s)&&!n;break;
// Vimeo does not seem to be supported on iOS via API
// Issue raised https://github.com/vimeo/player.js/issues/87
case"vimeo":i=!0,l=!n&&!r;break;case"youtube":i=!0,l=!n&&!r,
// YouTube seems to work on iOS 10+ on iPad
r&&!a&&10<=t.version&&(l=!0);break;case"soundcloud":i=!0,l=!n&&!a;break;default:l=(i=s&&o)&&!n}return{basic:i,full:l}}
// Setup function
function e(e,l){
// Add to container list
function t(e,t){Ne(t,$e.classes.hook)||n.push({
// Always wrap in a <div> for styling
//container:  _wrap(media, document.createElement('div')),
// Could be a container or the media itself
target:e,
// This should be the <video>, <audio> or <div> (YouTube/Vimeo)
media:t})}
// Check if the targets have multiple media elements
// Get the players
var n=[],u=[],r=[$e.selectors.html5,$e.selectors.embed].join(",");
// Select the elements
// Bail if disabled or no basic support
// You may want to disable certain UAs etc
if(Je.string(e)?
// String selector passed
e=ge.querySelectorAll(e):Je.htmlElement(e)?
// Single HTMLElement passed
e=[e]:Je.nodeList(e)||Je.array(e)||Je.string(e)||(
// No selector passed, possibly options as first argument
// If options are the first argument
Je.undefined(l)&&Je.object(e)&&(l=e),
// Use default selector
e=ge.querySelectorAll(r)),
// Convert NodeList to array
Je.nodeList(e)&&(e=Array.prototype.slice.call(e)),!Ye().basic||!e.length)return!1;for(var a=0;a<e.length;a++){var s=e[a],o=s.querySelectorAll(r);
// Get children
// If there's more than one media element child, wrap them
if(o.length)for(var i=0;i<o.length;i++)t(s,o[i]);else Pe(s,r)&&
// Target is media element
t(s,s)}
// Create a player instance for each element
return n.forEach(function(e){var t=e.target,n=e.media,r=!1;
// The target element can also be the media element
n===t&&(r=!0);
// Setup a player instance and add to the element
// Create instance-specific config
var a={};
// Try parsing data attribute config
try{a=JSON.parse(t.getAttribute("data-plyr"))}catch(e){}var s=qe({},$e,l,a);
// Bail if not enabled
if(!s.enabled)return null;
// Create new instance
var o=new c(n,s);
// Go to next if setup failed
if(Je.object(o)){
// Listen for events if debugging
if(s.debug){var i=s.events.concat(["setup","statechange","enterfullscreen","exitfullscreen","captionsenabled","captionsdisabled"]);Oe(o.getContainer(),i.join(" "),function(e){console.log([s.logPrefix,"event:",e.type].join(" "),e.detail.plyr)})}
// Callback
Le(o.getContainer(),"setup",!0,{plyr:o}),
// Add to return array even if it's already setup
u.push(o)}}),u}
// Get all instances within a provided container
function Ue(e){
// If we have a HTML element
if(Je.string(e)?
// Get selector if string passed
e=ge.querySelector(e):Je.undefined(e)&&(
// Use body by default to get all on page
e=ge.body),Je.htmlElement(e)){var t=e.querySelectorAll("."+$e.classes.setup),n=[];return Array.prototype.slice.call(t).forEach(function(e){Je.object(e.plyr)&&n.push(e.plyr)}),n}return[]}var Be,Xe={x:0,y:0},
// Default config
$e={enabled:!0,debug:!1,autoplay:!1,loop:!1,seekTime:10,volume:10,volumeMin:0,volumeMax:10,volumeStep:1,duration:null,displayDuration:!0,loadSprite:!0,iconPrefix:"plyr",iconUrl:"https://cdn.plyr.io/2.0.13/plyr.svg",blankUrl:"https://cdn.selz.com/plyr/blank.mp4",clickToPlay:!0,hideControls:!0,showPosterOnEnd:!1,disableContextMenu:!0,keyboardShorcuts:{focused:!0,global:!1},tooltips:{controls:!1,seek:!0},selectors:{html5:"video, audio",embed:"[data-type]",editable:"input, textarea, select, [contenteditable]",container:".plyr",controls:{container:null,wrapper:".plyr__controls"},labels:"[data-plyr]",buttons:{seek:'[data-plyr="seek"]',play:'[data-plyr="play"]',pause:'[data-plyr="pause"]',restart:'[data-plyr="restart"]',rewind:'[data-plyr="rewind"]',forward:'[data-plyr="fast-forward"]',mute:'[data-plyr="mute"]',captions:'[data-plyr="captions"]',fullscreen:'[data-plyr="fullscreen"]'},volume:{input:'[data-plyr="volume"]',display:".plyr__volume--display"},progress:{container:".plyr__progress",buffer:".plyr__progress--buffer",played:".plyr__progress--played"},captions:".plyr__captions",currentTime:".plyr__time--current",duration:".plyr__time--duration"},classes:{setup:"plyr--setup",ready:"plyr--ready",videoWrapper:"plyr__video-wrapper",embedWrapper:"plyr__video-embed",type:"plyr--{0}",stopped:"plyr--stopped",playing:"plyr--playing",muted:"plyr--muted",loading:"plyr--loading",hover:"plyr--hover",tooltip:"plyr__tooltip",hidden:"plyr__sr-only",hideControls:"plyr--hide-controls",isIos:"plyr--is-ios",isTouch:"plyr--is-touch",captions:{enabled:"plyr--captions-enabled",active:"plyr--captions-active"},fullscreen:{enabled:"plyr--fullscreen-enabled",active:"plyr--fullscreen-active"},tabFocus:"tab-focus"},captions:{defaultActive:!1},fullscreen:{enabled:!0,fallback:!0,allowAudio:!1},storage:{enabled:!0,key:"plyr"},controls:["play-large","play","progress","current-time","mute","volume","captions","fullscreen"],i18n:{restart:"Restart",rewind:"Rewind {seektime} secs",play:"Play",pause:"Pause",forward:"Forward {seektime} secs",played:"played",buffered:"buffered",currentTime:"Current time",duration:"Duration",volume:"Volume",toggleMute:"Toggle Mute",toggleCaptions:"Toggle Captions",toggleFullscreen:"Toggle Fullscreen",frameTitle:"Player for {title}"},types:{embed:["youtube","vimeo","soundcloud"],html5:["video","audio"]},
// URLs
urls:{vimeo:{api:"https://player.vimeo.com/api/player.js"},youtube:{api:"https://www.youtube.com/iframe_api"},soundcloud:{api:"https://w.soundcloud.com/player/api.js"}},
// Custom control listeners
listeners:{seek:null,play:null,pause:null,restart:null,rewind:null,forward:null,mute:null,volume:null,captions:null,fullscreen:null},
// Events to watch on HTML5 media elements
events:["ready","ended","progress","stalled","playing","waiting","canplay","canplaythrough","loadstart","loadeddata","loadedmetadata","timeupdate","volumechange","play","pause","error","seeking","seeked","emptied"],
// Logging
logPrefix:"[Plyr]"},Je={object:function(e){return null!==e&&"object"==typeof e},array:function(e){return null!==e&&"object"==typeof e&&e.constructor===Array},number:function(e){return null!==e&&("number"==typeof e&&!isNaN(e-0)||"object"==typeof e&&e.constructor===Number)},string:function(e){return null!==e&&("string"==typeof e||"object"==typeof e&&e.constructor===String)},boolean:function(e){return null!==e&&"boolean"==typeof e},nodeList:function(e){return null!==e&&e instanceof NodeList},htmlElement:function(e){return null!==e&&e instanceof HTMLElement},function:function(e){return null!==e&&"function"==typeof e},undefined:function(e){return null!==e&&void 0===e}},ze={supported:function(){if(!("localStorage"in ve))return!1;
// Try to use it (it might be disabled, e.g. user is in private/porn mode)
// see: https://github.com/sampotts/plyr/issues/131
try{
// Add test item
ve.localStorage.setItem("___test","OK");
// Get the test item
var e=ve.localStorage.getItem("___test");
// Clean up
// Check if value matches
return ve.localStorage.removeItem("___test"),"OK"===e}catch(e){return!1}return!1}()};return{setup:e,supported:Ye,loadSprite:We,get:Ue}}),
// Custom event polyfill
// https://developer.mozilla.org/en-US/docs/Web/API/CustomEvent/CustomEvent
function(){function e(e,t){t=t||{bubbles:!1,cancelable:!1,detail:void 0};var n=document.createEvent("CustomEvent");return n.initCustomEvent(e,t.bubbles,t.cancelable,t.detail),n}"function"!=typeof window.CustomEvent&&(e.prototype=window.Event.prototype,window.CustomEvent=e)}();