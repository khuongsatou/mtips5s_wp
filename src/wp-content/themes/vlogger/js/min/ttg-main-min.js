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
var jQuery;
/*!
 * Materialize v0.98.2 (http://materializecss.com)
 * Copyright 2014-2015 Materialize
 * MIT License (https://raw.githubusercontent.com/Dogfalo/materialize/master/LICENSE)
 */
(function(e,t){"use strict";
/*global define,module*/"object"==typeof module&&"object"==typeof module.exports?
// Node, CommonJS-like
module.exports=t(e,document):"function"==typeof define&&define.amd?
// AMD
define([],function(){return t(e,document)}):
// Browser globals (root is window)
e.plyr=t(e,document)}("undefined"!=typeof window?window:this,function(ge,ye){"use strict";
// Globals
// Credits: http://paypal.github.io/accessible-html5-video-player/
// Unfortunately, due to mixed support, UA sniffing is required
function be(){var e=navigator.userAgent,t=navigator.appName,i=""+parseFloat(navigator.appVersion),n=parseInt(navigator.appVersion,10),o,r,a,s=!1,l=!1,c=!1,d=!1;
// Return data
return-1!==navigator.appVersion.indexOf("Windows NT")&&-1!==navigator.appVersion.indexOf("rv:11")?(
// MSIE 11
s=!0,t="IE",i="11"):-1!==(r=e.indexOf("MSIE"))?(
// MSIE
s=!0,t="IE",i=e.substring(r+5)):-1!==(r=e.indexOf("Chrome"))?(
// Chrome
c=!0,t="Chrome",i=e.substring(r+7)):-1!==(r=e.indexOf("Safari"))?(
// Safari
d=!0,t="Safari",i=e.substring(r+7),-1!==(r=e.indexOf("Version"))&&(i=e.substring(r+8))):-1!==(r=e.indexOf("Firefox"))?(
// Firefox
l=!0,t="Firefox",i=e.substring(r+8)):(o=e.lastIndexOf(" ")+1)<(r=e.lastIndexOf("/"))&&(
// In most other browsers, 'name/version' is at the end of userAgent
t=e.substring(o,r),i=e.substring(r+1),t.toLowerCase()===t.toUpperCase()&&(t=navigator.appName)),
// Trim the fullVersion string at semicolon/space if present
-1!==(a=i.indexOf(";"))&&(i=i.substring(0,a)),-1!==(a=i.indexOf(" "))&&(i=i.substring(0,a)),
// Get major version
n=parseInt(""+i,10),isNaN(n)&&(i=""+parseFloat(navigator.appVersion),n=parseInt(navigator.appVersion,10)),{name:t,version:n,isIE:s,isFirefox:l,isChrome:c,isSafari:d,isIos:/(iPad|iPhone|iPod)/g.test(navigator.platform),isIphone:/(iPhone|iPod)/g.test(navigator.userAgent),isTouch:"ontouchstart"in ye.documentElement}}
// Check for mime type support against a player instance
// Credits: http://diveintohtml5.info/everything.html
// Related: http://www.leanbackplyr.com/test/h5mt.html
function we(e,t){var i=e.media;if("video"===e.type)
// Check type
switch(t){case"video/webm":return!(!i.canPlayType||!i.canPlayType('video/webm; codecs="vp8, vorbis"').replace(/no/,""));case"video/mp4":return!(!i.canPlayType||!i.canPlayType('video/mp4; codecs="avc1.42E01E, mp4a.40.2"').replace(/no/,""));case"video/ogg":return!(!i.canPlayType||!i.canPlayType('video/ogg; codecs="theora"').replace(/no/,""))}else if("audio"===e.type)
// Check type
switch(t){case"audio/mpeg":return!(!i.canPlayType||!i.canPlayType("audio/mpeg;").replace(/no/,""));case"audio/ogg":return!(!i.canPlayType||!i.canPlayType('audio/ogg; codecs="vorbis"').replace(/no/,""));case"audio/wav":return!(!i.canPlayType||!i.canPlayType('audio/wav; codecs="1"').replace(/no/,""))}
// If we got this far, we're stuffed
return!1}
// Inject a script
function ke(e){if(!ye.querySelectorAll('script[src="'+e+'"]').length){var t=ye.createElement("script");t.src=e;var i=ye.getElementsByTagName("script")[0];i.parentNode.insertBefore(t,i)}}
// Element exists in an array
function xe(e,t){return Array.prototype.indexOf&&-1!==e.indexOf(t)}
// Replace all
function Te(e,t,i){return e.replace(new RegExp(t.replace(/([.*+?\^=!:${}()|\[\]\/\\])/g,"\\$1"),"g"),i)}
// Wrap an element
function Se(e,t){
// Convert `elements` to an array, if necessary.
e.length||(e=[e]);
// Loops backwards to prevent having to clone the wrapper on the
// first element (see `child` below).
for(var i=e.length-1;0<=i;i--){var n=0<i?t.cloneNode(!0):t,o=e[i],r=o.parentNode,a=o.nextSibling;
// Wrap the element (is automatically removed from its current
// parent).
return n.appendChild(o),
// If the element had a sibling, insert the wrapper before
// the sibling to maintain the HTML structure; otherwise, just
// append it to the parent.
a?r.insertBefore(n,a):r.appendChild(n),n}}
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
function Ce(e){e&&e.parentNode.removeChild(e)}
// Prepend child
function Pe(e,t){e.insertBefore(t,e.firstChild)}
// Set attributes
function Ae(e,t){for(var i in t)e.setAttribute(i,Be.boolean(t[i])&&t[i]?"":t[i])}
// Insert a HTML element
function qe(e,t,i){
// Create a new <element>
var n=ye.createElement(e);
// Set all passed attributes
Ae(n,i),
// Inject the new element
Pe(t,n)}
// Get a classname from selector
function Oe(e){return e.replace(".","")}
// Toggle class on an element
function Ee(e,t,i){if(e)if(e.classList)e.classList[i?"add":"remove"](t);else{var n=(" "+e.className+" ").replace(/\s+/g," ").replace(" "+t+" ","");e.className=n+(i?" "+t:"")}}
// Has class name
function $e(e,t){return!!e&&(e.classList?e.classList.contains(t):new RegExp("(\\s|^)"+t+"(\\s|$)").test(e.className))}
// Element matches selector
function Ie(e,t){var i=Element.prototype,n;return(i.matches||i.webkitMatchesSelector||i.mozMatchesSelector||i.msMatchesSelector||function(e){return-1!==[].indexOf.call(ye.querySelectorAll(e),this)}).call(e,t)}
// Bind along with custom handler
function Me(t,e,i,n,o){je(t,e,function(e){i&&i.apply(t,[e]),n.apply(t,[e])},o)}
// Toggle event listener
function l(e,t,i,n,o){var r=t.split(" ");
// Whether the listener is a capturing listener or not
// Default to false
// If a nodelist is passed, call itself on each node
if(Be.boolean(o)||(o=!1),e instanceof NodeList)for(var a=0;a<e.length;a++)e[a]instanceof Node&&l(e[a],t,i,n);else
// If a single node is passed, bind the event listener
for(var s=0;s<r.length;s++)e[n?"addEventListener":"removeEventListener"](r[s],i,o)}
// Bind event
function je(e,t,i,n){e&&l(e,t,i,!0,n)}
// Unbind event
/*function _off(element, events, callback, useCapture) {
		if (element) {
			_toggleListener(element, events, callback, false, useCapture);
		}
	}*/
// Trigger event
function ze(e,t,i,n){
// Bail if no element
if(e&&t){
// Default bubbles to false
Be.boolean(i)||(i=!1);
// Create and dispatch the event
var o=new CustomEvent(t,{bubbles:i,detail:n});
// Dispatch the event
e.dispatchEvent(o)}}
// Toggle aria-pressed state on a toggle button
// http://www.ssbbartgroup.com/blog/how-not-to-misuse-aria-states-properties-and-roles
function Fe(e,t){
// Bail if no target
if(e)
// Get state
return t=Be.boolean(t)?t:!e.getAttribute("aria-pressed"),
// Set the attribute on target
e.setAttribute("aria-pressed",t),t}
// Get percentage
function De(e,t){return 0===e||0===t||isNaN(e)||isNaN(t)?0:(e/t*100).toFixed(2)}
// Deep extend/merge destination object with N more objects
// http://andrewdupont.net/2009/08/28/deep-extending-objects-in-javascript/
// Removed call to arguments.callee (used explicit function name instead)
function We(){
// Get arguments
var e=arguments;
// Bail if nothing to merge
if(e.length){
// Return first if specified but nothing to merge
if(1===e.length)return e[0];
// First object is the destination
// Loop through all objects to merge
for(var t=Array.prototype.shift.call(e),i=e.length,n=0;n<i;n++){var o=e[n];for(var r in o)o[r]&&o[r].constructor&&o[r].constructor===Object?(t[r]=t[r]||{},We(t[r],o[r])):t[r]=o[r]}return t}}
// Check variable types
// Parse YouTube ID from url
function He(e){var t=/^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;return e.match(t)?RegExp.$2:e}
// Parse Vimeo ID from url
function _e(e){var t=/^.*(vimeo.com\/|video\/)(\d+).*/;return e.match(t)?RegExp.$2:e}
// Fullscreen API
function Le(){var e={supportsFullScreen:!1,isFullScreen:function(){return!1},requestFullScreen:function(){},cancelFullScreen:function(){},fullScreenEventName:"",element:null,prefix:""},t="webkit o moz ms khtml".split(" ");
// Check for native support
if(Be.undefined(ye.cancelFullScreen))
// Check for fullscreen support by vendor prefix
for(var i=0,n=t.length;i<n;i++){if(e.prefix=t[i],!Be.undefined(ye[e.prefix+"CancelFullScreen"])){e.supportsFullScreen=!0;break}if(!Be.undefined(ye.msExitFullscreen)&&ye.msFullscreenEnabled){
// Special case for MS (when isn't it?)
e.prefix="ms",e.supportsFullScreen=!0;break}}else e.supportsFullScreen=!0;
// Update methods to do something useful
return e.supportsFullScreen&&(
// Yet again Microsoft awesomeness,
// Sometimes the prefix is 'ms', sometimes 'MS' to keep you on your toes
e.fullScreenEventName="ms"===e.prefix?"MSFullscreenChange":e.prefix+"fullscreenchange",e.isFullScreen=function(e){switch(Be.undefined(e)&&(e=ye.body),this.prefix){case"":return ye.fullscreenElement===e;case"moz":return ye.mozFullScreenElement===e;default:return ye[this.prefix+"FullscreenElement"]===e}},e.requestFullScreen=function(e){return Be.undefined(e)&&(e=ye.body),""===this.prefix?e.requestFullScreen():e[this.prefix+("ms"===this.prefix?"RequestFullscreen":"RequestFullScreen")]()},e.cancelFullScreen=function(){return""===this.prefix?ye.cancelFullScreen():ye[this.prefix+("ms"===this.prefix?"ExitFullscreen":"CancelFullScreen")]()},e.element=function(){return""===this.prefix?ye.fullscreenElement:ye[this.prefix+"FullscreenElement"]}),e}
// Local storage
// Player instance
function d(t,c){
// Trigger events, with plyr instance passed
function o(e,t,i,n){ze(e,t,i,We({},n,{plyr:fe}))}
// Debugging
function e(e,t){c.debug&&ge.console&&(t=Array.prototype.slice.call(t),Be.string(c.logPrefix)&&c.logPrefix.length&&t.unshift(c.logPrefix),console[e].apply(console,t))}
// Get icon URL
function a(){return{url:c.iconUrl,absolute:0===c.iconUrl.indexOf("http")||ue.browser.isIE}}
// Build the default HTML
function s(){
// Create html array
var e=[],t=a(),i=(t.absolute?"":t.url)+"#"+c.iconPrefix;
// Larger overlaid play button
return xe(c.controls,"play-large")&&
/*html.push(
					'<button type="button" data-plyr="play" class="plyr__play-large">',
						'<svg><use xlink:href="' + iconPath + '-play" /></svg>',
						'<span class="plyr__sr-only">' + config.i18n.play + '</span>',
					'</button>'
				);*/
// igor
e.push('<span class="qt-playbtn plyr__play-large" data-plyr="play"><i class="dripicons-media-play"></i></span>'),e.push('<div class="plyr__controls">'),
// Restart button
xe(c.controls,"restart")&&e.push('<button type="button" data-plyr="restart">','<svg><use xlink:href="'+i+'-restart" /></svg>','<span class="plyr__sr-only">'+c.i18n.restart+"</span>","</button>"),
// Rewind button
xe(c.controls,"rewind")&&e.push('<button type="button" data-plyr="rewind">','<svg><use xlink:href="'+i+'-rewind" /></svg>','<span class="plyr__sr-only">'+c.i18n.rewind+"</span>","</button>"),
// Play Pause button
// TODO: This should be a toggle button really?
xe(c.controls,"play")&&e.push('<button type="button" data-plyr="play">','<svg><use xlink:href="'+i+'-play" /></svg>','<span class="plyr__sr-only">'+c.i18n.play+"</span>","</button>",'<button type="button" data-plyr="pause">','<svg><use xlink:href="'+i+'-pause" /></svg>','<span class="plyr__sr-only">'+c.i18n.pause+"</span>","</button>"),
// Fast forward button
xe(c.controls,"fast-forward")&&e.push('<button type="button" data-plyr="fast-forward">','<svg><use xlink:href="'+i+'-fast-forward" /></svg>','<span class="plyr__sr-only">'+c.i18n.forward+"</span>","</button>"),
// Progress
xe(c.controls,"progress")&&(
// Create progress
e.push('<span class="plyr__progress">','<label for="seek{id}" class="plyr__sr-only">Seek</label>','<input id="seek{id}" class="plyr__progress--seek" type="range" min="0" max="100" step="0.1" value="0" data-plyr="seek">','<progress class="plyr__progress--played" max="100" value="0" role="presentation"></progress>','<progress class="plyr__progress--buffer" max="100" value="0">',"<span>0</span>% "+c.i18n.buffered,"</progress>"),
// Seek tooltip
c.tooltips.seek&&e.push('<span class="plyr__tooltip">00:00</span>'),
// Close
e.push("</span>")),
// Media current time display
xe(c.controls,"current-time")&&e.push('<span class="plyr__time">','<span class="plyr__sr-only">'+c.i18n.currentTime+"</span>",'<span class="plyr__time--current">00:00</span>',"</span>"),
// Media duration display
xe(c.controls,"duration")&&e.push('<span class="plyr__time">','<span class="plyr__sr-only">'+c.i18n.duration+"</span>",'<span class="plyr__time--duration">00:00</span>',"</span>"),
// Toggle mute button
xe(c.controls,"mute")&&e.push('<button type="button" data-plyr="mute">','<svg class="icon--muted"><use xlink:href="'+i+'-muted" /></svg>','<svg><use xlink:href="'+i+'-volume" /></svg>','<span class="plyr__sr-only">'+c.i18n.toggleMute+"</span>","</button>"),
// Volume range control
xe(c.controls,"volume")&&e.push('<span class="plyr__volume">','<label for="volume{id}" class="plyr__sr-only">'+c.i18n.volume+"</label>",'<input id="volume{id}" class="plyr__volume--input" type="range" min="'+c.volumeMin+'" max="'+c.volumeMax+'" value="'+c.volume+'" data-plyr="volume">','<progress class="plyr__volume--display" max="'+c.volumeMax+'" value="'+c.volumeMin+'" role="presentation"></progress>',"</span>"),
// Toggle captions button
xe(c.controls,"captions")&&e.push('<button type="button" data-plyr="captions">','<svg class="icon--captions-on"><use xlink:href="'+i+'-captions-on" /></svg>','<svg><use xlink:href="'+i+'-captions-off" /></svg>','<span class="plyr__sr-only">'+c.i18n.toggleCaptions+"</span>","</button>"),
// Toggle fullscreen button
xe(c.controls,"fullscreen")&&e.push('<button type="button" data-plyr="fullscreen">','<svg class="icon--exit-fullscreen"><use xlink:href="'+i+'-exit-fullscreen" /></svg>','<svg><use xlink:href="'+i+'-enter-fullscreen" /></svg>','<span class="plyr__sr-only">'+c.i18n.toggleFullscreen+"</span>","</button>"),
// Close everything
e.push("</div>"),e.join("")}
// Setup fullscreen
function i(){if(ue.supported.full&&("audio"!==ue.type||c.fullscreen.allowAudio)&&c.fullscreen.enabled){
// Check for native support
var e=Qe.supportsFullScreen;e||c.fullscreen.fallback&&!f()?(ve((e?"Native":"Fallback")+" fullscreen enabled"),
// Add styling hook
Ee(ue.container,c.classes.fullscreen.enabled,!0)):ve("Fullscreen not supported and fallback disabled"),
// Toggle state
ue.buttons&&ue.buttons.fullscreen&&Fe(ue.buttons.fullscreen,!1),
// Setup focus trap
h()}}
// Setup captions
function n(){
// Bail if not HTML5 video
if("video"===ue.type){
// Inject the container
p(c.selectors.captions)||ue.videoContainer.insertAdjacentHTML("afterbegin",'<div class="'+Oe(c.selectors.captions)+'"></div>'),
// Determine if HTML5 textTracks is supported
ue.usingTextTracks=!1,ue.media.textTracks&&(ue.usingTextTracks=!0);for(
// Get URL of caption file if exists
var e="",t,i=ue.media.childNodes,n=0;n<i.length;n++)"track"===i[n].nodeName.toLowerCase()&&("captions"!==(t=i[n].kind)&&"subtitles"!==t||(e=i[n].getAttribute("src")));
// Record if caption file exists or not
// If no caption file exists, hide container for caption text
if(ue.captionExists=!0,""===e?(ue.captionExists=!1,ve("No caption track found")):ve("Caption track found; URI: "+e),ue.captionExists){for(
// Turn off native caption rendering to avoid double captions
// This doesn't seem to work in Safari 7+, so the <track> elements are removed from the dom below
var o=ue.media.textTracks,r=0;r<o.length;r++)o[r].mode="hidden";
// Enable UI
// Rendering caption tracks
// Native support required - http://caniuse.com/webvtt
if(u(ue),
// Disable unsupported browsers than report false positive
// Firefox bug: https://bugzilla.mozilla.org/show_bug.cgi?id=1033144
(ue.browser.isIE&&10<=ue.browser.version||ue.browser.isFirefox&&31<=ue.browser.version)&&(
// Debugging
ve("Detected browser with known TextTrack issues - using manual fallback"),
// Set to false so skips to 'manual' captioning
ue.usingTextTracks=!1),ue.usingTextTracks){ve("TextTracks supported");for(var a=0;a<o.length;a++){var s=o[a];"captions"!==s.kind&&"subtitles"!==s.kind||je(s,"cuechange",function(){
// Display a cue, if there is one
this.activeCues[0]&&"text"in this.activeCues[0]?d(this.activeCues[0].getCueAsHTML()):d()})}}else if(
// Caption tracks not natively supported
ve("TextTracks not supported so rendering captions manually"),
// Render captions from array at appropriate time
ue.currentCaption="",ue.captions=[],""!==e){
// Create XMLHttpRequest Object
var l=new XMLHttpRequest;l.onreadystatechange=function(){if(4===l.readyState)if(200===l.status){var e=[],t,i=l.responseText,n="\r\n";
//According to webvtt spec, line terminator consists of one of the following
// CRLF (U+000D U+000A), LF (U+000A) or CR (U+000D)
-1===i.indexOf(n+n)&&(n=-1!==i.indexOf("\r\r")?"\r":"\n"),e=i.split(n+n);for(var o=0;o<e.length;o++){t=e[o],ue.captions[o]=[];
// Get the parts of the captions
var r=t.split(n),a=0;
// Incase caption numbers are added
-1===r[a].indexOf(":")&&(a=1),ue.captions[o]=[r[a],r[a+1]]}
// Remove first element ('VTT')
ue.captions.shift(),ve("Successfully loaded the caption file via AJAX")}else me(c.logPrefix+"There was a problem loading the caption file via AJAX")},l.open("get",e,!0),l.send()}}else Ee(ue.container,c.classes.captions.enabled)}}
// Set the current caption
function d(e){
/* jshint unused:false */
var t=p(c.selectors.captions),i=ye.createElement("span");
// Empty the container
t.innerHTML="",
// Default to empty
Be.undefined(e)&&(e=""),
// Set the span content
Be.string(e)?i.innerHTML=e.trim():i.appendChild(e),
// Set new caption text
t.appendChild(i);
// Force redraw (for Safari)
var n=t.offsetHeight}
// Captions functions
// Seek the manual caption time and update UI
function r(e){
// Utilities for caption time codes
function t(e,t){var i=[];i=e.split(" --\x3e ");for(var n=0;n<i.length;n++)
// WebVTT allows for extra meta data after the timestamp line
// So get rid of this if it exists
i[n]=i[n].replace(/(\d+:\d+:\d+\.\d+).*/,"$1");return o(i[t])}function i(e){return t(e,0)}function n(e){return t(e,1)}function o(e){if(null==e)return 0;var t=[],i=[],n;return i=(t=e.split(","))[0].split(":"),n=Math.floor(60*i[0]*60)+Math.floor(60*i[1])+Math.floor(i[2])}
// If it's not video, or we're using textTracks, bail.
if(!ue.usingTextTracks&&"video"===ue.type&&ue.supported.full&&(
// Reset subcount
ue.subcount=0,
// Check time is a number, if not use currentTime
// IE has a bug where currentTime doesn't go to 0
// https://twitter.com/Sam_Potts/status/573715746506731521
e=Be.number(e)?e:ue.media.currentTime,ue.captions[ue.subcount]))
// If there's no subs available, bail
{for(;n(ue.captions[ue.subcount][0])<e.toFixed(1);)if(ue.subcount++,ue.subcount>ue.captions.length-1){ue.subcount=ue.captions.length-1;break}
// Check if the next caption is in the current time range
ue.media.currentTime.toFixed(1)>=i(ue.captions[ue.subcount][0])&&ue.media.currentTime.toFixed(1)<=n(ue.captions[ue.subcount][0])?(ue.currentCaption=ue.captions[ue.subcount][1],
// Render the caption
d(ue.currentCaption)):d()}}
// Display captions container and button (for initialization)
function u(){
// If there's no caption toggle, bail
if(ue.buttons.captions){Ee(ue.container,c.classes.captions.enabled,!0);
// Try to load the value from storage
var e=ue.storage.captionsEnabled;
// Otherwise fall back to the default config
Be.boolean(e)||(e=c.captions.defaultActive),e&&(Ee(ue.container,c.classes.captions.active,!0),Fe(ue.buttons.captions,!0))}}
// Find all elements
function l(e){return ue.container.querySelectorAll(e)}
// Find a single element
function p(e){return l(e)[0]}
// Determine if we're in an iframe
function f(){try{return ge.self!==ge.top}catch(e){return!0}}
// Trap focus inside container
function h(){function e(e){
// If it is TAB
9===e.which&&ue.isFullscreen&&(e.target!==n||e.shiftKey?e.target===i&&e.shiftKey&&(
// Move focus to last element that can be tabbed if Shift is used
e.preventDefault(),n.focus()):(
// Move focus to first element that can be tabbed if Shift isn't used
e.preventDefault(),i.focus()))}
// Bind the handler
var t=l("input:not([disabled]), button:not([disabled])"),i=t[0],n=t[t.length-1];je(ue.container,"keydown",e)}
// Add elements to HTML5 media (source, tracks, etc)
function v(e,t){if(Be.string(t))qe(e,ue.media,{src:t});else if(t.constructor===Array)for(var i=t.length-1;0<=i;i--)qe(e,ue.media,t[i])}
// Insert controls
function m(){
// Sprite
if(c.loadSprite){var e=a();
// Only load external sprite using AJAX
e.absolute?(ve("AJAX loading absolute SVG sprite"+(ue.browser.isIE?" (due to IE)":"")),Ne(e.url,"sprite-plyr")):ve("Sprite will be used as external resource directly")}
// Make a copy of the html
var t=c.html,i;
// Insert custom video controls
// Setup tooltips
if(ve("Injecting custom controls"),
// If no controls are specified, create default
t||(t=s()),
// Replace all id references with random numbers
t=Te(
// Replace seek time instances
t=Te(t,"{seektime}",c.seekTime),"{id}",Math.floor(1e4*Math.random())),
// Inject to custom location
Be.string(c.selectors.controls.container)&&(i=ye.querySelector(c.selectors.controls.container)),
// Inject into the container by default
Be.htmlElement(i)||(i=ue.container),
// Inject controls HTML
i.insertAdjacentHTML("beforeend",t),c.tooltips.controls)for(var n=l([c.selectors.controls.wrapper," ",c.selectors.labels," .",c.classes.hidden].join("")),o=n.length-1;0<=o;o--){var r=n[o];Ee(r,c.classes.hidden,!1),Ee(r,c.classes.tooltip,!0)}}
// Find the UI controls and store references
function g(){try{return ue.controls=p(c.selectors.controls.wrapper),
// Buttons
ue.buttons={},ue.buttons.seek=p(c.selectors.buttons.seek),ue.buttons.play=l(c.selectors.buttons.play),ue.buttons.pause=p(c.selectors.buttons.pause),ue.buttons.restart=p(c.selectors.buttons.restart),ue.buttons.rewind=p(c.selectors.buttons.rewind),ue.buttons.forward=p(c.selectors.buttons.forward),ue.buttons.fullscreen=p(c.selectors.buttons.fullscreen),
// Inputs
ue.buttons.mute=p(c.selectors.buttons.mute),ue.buttons.captions=p(c.selectors.buttons.captions),
// Progress
ue.progress={},ue.progress.container=p(c.selectors.progress.container),
// Progress - Buffering
ue.progress.buffer={},ue.progress.buffer.bar=p(c.selectors.progress.buffer),ue.progress.buffer.text=ue.progress.buffer.bar&&ue.progress.buffer.bar.getElementsByTagName("span")[0],
// Progress - Played
ue.progress.played=p(c.selectors.progress.played),
// Seek tooltip
ue.progress.tooltip=ue.progress.container&&ue.progress.container.querySelector("."+c.classes.tooltip),
// Volume
ue.volume={},ue.volume.input=p(c.selectors.volume.input),ue.volume.display=p(c.selectors.volume.display),
// Timing
ue.duration=p(c.selectors.duration),ue.currentTime=p(c.selectors.currentTime),ue.seekTime=l(c.selectors.seekTime),!0}catch(e){return me("It looks like there is a problem with your controls HTML"),
// Restore native video controls
b(!0),!1}}
// Toggle style hook
function y(){Ee(ue.container,c.selectors.container.replace(".",""),ue.supported.full)}
// Toggle native controls
function b(e){e&&xe(c.types.html5,ue.type)?ue.media.setAttribute("controls",""):ue.media.removeAttribute("controls")}
// Setup aria attribute for play and iframe title
function w(e){
// Find the current text
var t=c.i18n.play;
// If there's a media title set, use that for the label
// If there's a play button, set label
if(Be.string(c.title)&&c.title.length&&(t+=", "+c.title,
// Set container label
ue.container.setAttribute("aria-label",c.title)),ue.supported.full&&ue.buttons.play)for(var i=ue.buttons.play.length-1;0<=i;i--)ue.buttons.play[i].setAttribute("aria-label",t);
// Set iframe title
// https://github.com/sampotts/plyr/issues/124
Be.htmlElement(e)&&e.setAttribute("title",c.i18n.frameTitle.replace("{title}",c.title))}
// Setup localStorage
function k(){var e=null;ue.storage={},
// Bail if we don't have localStorage support or it's disabled
Ue.supported&&c.storage.enabled&&(
// Clean up old volume
// https://github.com/sampotts/plyr/issues/171
ge.localStorage.removeItem("plyr-volume"),(
// load value from the current key
e=ge.localStorage.getItem(c.storage.key))&&(/^\d+(\.\d+)?$/.test(e)?
// If value is a number, it's probably volume from an older
// version of plyr. See: https://github.com/sampotts/plyr/pull/313
// Update the key to be JSON
x({volume:parseFloat(e)}):
// Assume it's JSON from this or a later version of plyr
ue.storage=JSON.parse(e)))}
// Save a value back to local storage
function x(e){
// Bail if we don't have localStorage support or it's disabled
Ue.supported&&c.storage.enabled&&(
// Update the working copy of the values
We(ue.storage,e),
// Update storage
ge.localStorage.setItem(c.storage.key,JSON.stringify(ue.storage)))}
// Setup media
function T(){
// If there's no media, bail
if(ue.media){if(ue.supported.full&&(
// Add type class
Ee(ue.container,c.classes.type.replace("{0}",ue.type),!0),
// Add video class for embeds
// This will require changes if audio embeds are added
xe(c.types.embed,ue.type)&&Ee(ue.container,c.classes.type.replace("{0}","video"),!0),
// If there's no autoplay attribute, assume the video is stopped and add state class
Ee(ue.container,c.classes.stopped,c.autoplay),
// Add iOS class
Ee(ue.container,c.classes.isIos,ue.browser.isIos),
// Add touch class
Ee(ue.container,c.classes.isTouch,ue.browser.isTouch),"video"===ue.type)){
// Create the wrapper div
var e=ye.createElement("div");e.setAttribute("class",c.classes.videoWrapper),
// Wrap the video in a container
Se(ue.media,e),
// Cache the container
ue.videoContainer=e}
// Embeds
xe(c.types.embed,ue.type)&&S()}else me("No media element found!")}
// Setup YouTube/Vimeo
function S(){var e=ye.createElement("div"),t,i=ue.type+"-"+Math.floor(1e4*Math.random());
// Parse IDs from URLs if supplied
switch(ue.type){case"youtube":t=He(ue.embedId);break;case"vimeo":t=_e(ue.embedId);break;default:t=ue.embedId}
// Remove old containers
for(var n=l('[id^="'+ue.type+'-"]'),o=n.length-1;0<=o;o--)Ce(n[o]);
// Add embed class for responsive
if(Ee(ue.media,c.classes.videoWrapper,!0),Ee(ue.media,c.classes.embedWrapper,!0),"youtube"===ue.type)
// Create the YouTube container
ue.media.appendChild(e),
// Set ID
e.setAttribute("id",i),
// Setup API
Be.object(ge.YT)?P(t,e):(
// Load the API
ke(c.urls.youtube.api),
// Setup callback for the API
ge.onYouTubeReadyCallbacks=ge.onYouTubeReadyCallbacks||[],
// Add to queue
ge.onYouTubeReadyCallbacks.push(function(){P(t,e)}),
// Set callback to process queue
ge.onYouTubeIframeAPIReady=function(){ge.onYouTubeReadyCallbacks.forEach(function(e){e()})});else if("vimeo"===ue.type)
// Load the API if not already
if(
// Vimeo needs an extra div to hide controls on desktop (which has full support)
ue.supported.full?ue.media.appendChild(e):e=ue.media,
// Set ID
e.setAttribute("id",i),Be.object(ge.Vimeo))A(t,e);else{ke(c.urls.vimeo.api);
// Wait for fragaloop load
var r=ge.setInterval(function(){Be.object(ge.Vimeo)&&(ge.clearInterval(r),A(t,e))},50)}else if("soundcloud"===ue.type){
// TODO: Currently unsupported and undocumented
// Inject the iframe
var a=ye.createElement("iframe");
// Watch for iframe load
a.loaded=!1,je(a,"load",function(){a.loaded=!0}),Ae(a,{src:"https://w.soundcloud.com/player/?url=https://api.soundcloud.com/tracks/"+t,id:i}),e.appendChild(a),ue.media.appendChild(e),
// Load the API if not already
ge.SC||ke(c.urls.soundcloud.api);
// Wait for SC load
var s=ge.setInterval(function(){ge.SC&&a.loaded&&(ge.clearInterval(s),q.call(a))},50)}}
// When embeds are ready
function C(){
// Setup the UI and call ready if full support
ue.supported.full&&(ce(),de()),
// Set title
w(p("iframe"))}
// Handle YouTube API ready
function P(e,t){
// Setup instance
// https://developers.google.com/youtube/iframe_api_reference
ue.embed=new ge.YT.Player(t.id,{videoId:e,playerVars:{autoplay:c.autoplay?1:0,controls:ue.supported.full?0:1,rel:0,showinfo:0,iv_load_policy:3,cc_load_policy:c.captions.defaultActive?1:0,cc_lang_pref:"en",wmode:"transparent",modestbranding:1,disablekb:1,origin:"*"},events:{onError:function(e){o(ue.container,"error",!0,{code:e.data,embed:e.target})},onReady:function(e){
// Get the instance
var t=e.target;
// Create a faux HTML5 API using the YouTube API
ue.media.play=function(){t.playVideo(),ue.media.paused=!1},ue.media.pause=function(){t.pauseVideo(),ue.media.paused=!0},ue.media.stop=function(){t.stopVideo(),ue.media.paused=!0},ue.media.duration=t.getDuration(),ue.media.paused=!0,ue.media.currentTime=0,ue.media.muted=t.isMuted(),
// Set title
c.title=t.getVideoData().title,
// Set the tabindex
ue.supported.full&&ue.media.querySelector("iframe").setAttribute("tabindex","-1"),
// Update UI
C(),
// Trigger timeupdate
o(ue.media,"timeupdate"),
// Trigger timeupdate
o(ue.media,"durationchange"),
// Reset timer
ge.clearInterval(pe.buffering),
// Setup buffering
pe.buffering=ge.setInterval(function(){
// Get loaded % from YouTube
ue.media.buffered=t.getVideoLoadedFraction(),
// Trigger progress only when we actually buffer something
(null===ue.media.lastBuffered||ue.media.lastBuffered<ue.media.buffered)&&o(ue.media,"progress"),
// Set last buffer point
ue.media.lastBuffered=ue.media.buffered,
// Bail if we're at 100%
1===ue.media.buffered&&(ge.clearInterval(pe.buffering),
// Trigger event
o(ue.media,"canplaythrough"))},200)},onStateChange:function(e){
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
switch(ge.clearInterval(pe.playing),e.data){case 0:ue.media.paused=!0,o(ue.media,"ended");break;case 1:ue.media.paused=!1,
// If we were seeking, fire seeked event
ue.media.seeking&&o(ue.media,"seeked"),ue.media.seeking=!1,o(ue.media,"play"),o(ue.media,"playing"),
// Poll to get playback progress
pe.playing=ge.setInterval(function(){
// Set the current time
ue.media.currentTime=t.getCurrentTime(),
// Trigger timeupdate
o(ue.media,"timeupdate")},100),
// Check duration again due to YouTube bug
// https://github.com/sampotts/plyr/issues/374
// https://code.google.com/p/gdata-issues/issues/detail?id=8690
ue.media.duration!==t.getDuration()&&(ue.media.duration=t.getDuration(),o(ue.media,"durationchange"));break;case 2:ue.media.paused=!0,o(ue.media,"pause");break}o(ue.container,"statechange",!1,{code:e.data})}}})}
// Vimeo ready
function A(e,t){
// Setup instance
// https://github.com/vimeo/player.js
ue.embed=new ge.Vimeo.Player(t,{id:parseInt(e),loop:c.loop,autoplay:c.autoplay,byline:!1,portrait:!1,title:!1}),
// Create a faux HTML5 API using the Vimeo API
ue.media.play=function(){ue.embed.play(),ue.media.paused=!1},ue.media.pause=function(){ue.embed.pause(),ue.media.paused=!0},ue.media.stop=function(){ue.embed.stop(),ue.media.paused=!0},ue.media.paused=!0,ue.media.currentTime=0,
// Update UI
C(),ue.embed.getCurrentTime().then(function(e){ue.media.currentTime=e,
// Trigger timeupdate
o(ue.media,"timeupdate")}),ue.embed.getDuration().then(function(e){ue.media.duration=e,
// Trigger timeupdate
o(ue.media,"durationchange")}),
// TODO: Captions
/*if (config.captions.defaultActive) {
				plyr.embed.enableTextTrack('en');
			}*/
ue.embed.on("loaded",function(){
// Fix keyboard focus issues
// https://github.com/sampotts/plyr/issues/317
Be.htmlElement(ue.embed.element)&&ue.supported.full&&ue.embed.element.setAttribute("tabindex","-1")}),ue.embed.on("play",function(){ue.media.paused=!1,o(ue.media,"play"),o(ue.media,"playing")}),ue.embed.on("pause",function(){ue.media.paused=!0,o(ue.media,"pause")}),ue.embed.on("timeupdate",function(e){ue.media.seeking=!1,ue.media.currentTime=e.seconds,o(ue.media,"timeupdate")}),ue.embed.on("progress",function(e){ue.media.buffered=e.percent,o(ue.media,"progress"),1===parseInt(e.percent)&&
// Trigger event
o(ue.media,"canplaythrough")}),ue.embed.on("seeked",function(){ue.media.seeking=!1,o(ue.media,"seeked"),o(ue.media,"play")}),ue.embed.on("ended",function(){ue.media.paused=!0,o(ue.media,"ended")})}
// Soundcloud ready
function q(){
/* jshint validthis: true */
ue.embed=ge.SC.Widget(this),
// Setup on ready
ue.embed.bind(ge.SC.Widget.Events.READY,function(){
// Create a faux HTML5 API using the Soundcloud API
ue.media.play=function(){ue.embed.play(),ue.media.paused=!1},ue.media.pause=function(){ue.embed.pause(),ue.media.paused=!0},ue.media.stop=function(){ue.embed.seekTo(0),ue.embed.pause(),ue.media.paused=!0},ue.media.paused=!0,ue.media.currentTime=0,ue.embed.getDuration(function(e){ue.media.duration=e/1e3,
// Update UI
C()}),ue.embed.getPosition(function(e){ue.media.currentTime=e,
// Trigger timeupdate
o(ue.media,"timeupdate")}),ue.embed.bind(ge.SC.Widget.Events.PLAY,function(){ue.media.paused=!1,o(ue.media,"play"),o(ue.media,"playing")}),ue.embed.bind(ge.SC.Widget.Events.PAUSE,function(){ue.media.paused=!0,o(ue.media,"pause")}),ue.embed.bind(ge.SC.Widget.Events.PLAY_PROGRESS,function(e){ue.media.seeking=!1,ue.media.currentTime=e.currentPosition/1e3,o(ue.media,"timeupdate")}),ue.embed.bind(ge.SC.Widget.Events.LOAD_PROGRESS,function(e){ue.media.buffered=e.loadProgress,o(ue.media,"progress"),1===parseInt(e.loadProgress)&&
// Trigger event
o(ue.media,"canplaythrough")}),ue.embed.bind(ge.SC.Widget.Events.FINISH,function(){ue.media.paused=!0,o(ue.media,"ended")})})}
// Play media
function O(){"play"in ue.media&&ue.media.play()}
// Pause media
function E(){"pause"in ue.media&&ue.media.pause()}
// Toggle playback
function $(e){
// True toggle
return Be.boolean(e)||(e=ue.media.paused),e?O():E(),e}
// Rewind
function I(e){
// Use default if needed
Be.number(e)||(e=c.seekTime),j(ue.media.currentTime-e)}
// Fast forward
function M(e){
// Use default if needed
Be.number(e)||(e=c.seekTime),j(ue.media.currentTime+e)}
// Seek to time
// The input parameter can be an event or a number
function j(e){var t=0,i=ue.media.paused,n=z();Be.number(e)?t=e:Be.object(e)&&xe(["input","change"],e.type)&&(
// It's the seek slider
// Seek to the selected time
t=e.target.value/e.target.max*n),
// Normalise targetTime
t<0?t=0:n<t&&(t=n),
// Update seek range and progress
J(t);
// Set the current time
// Try/catch incase the media isn't set and we're calling seek() from source() and IE moans
try{ue.media.currentTime=t.toFixed(4)}catch(e){}
// Embeds
if(xe(c.types.embed,ue.type)){switch(ue.type){case"youtube":ue.embed.seekTo(t);break;case"vimeo":
// Round to nearest second for vimeo
ue.embed.setCurrentTime(t.toFixed(0));break;case"soundcloud":ue.embed.seekTo(1e3*t);break}i&&E(),
// Trigger timeupdate
o(ue.media,"timeupdate"),
// Set seeking flag
ue.media.seeking=!0,
// Trigger seeking
o(ue.media,"seeking")}
// Logging
ve("Seeking to "+ue.media.currentTime+" seconds"),
// Special handling for 'manual' captions
r(t)}
// Get the duration (or custom if set)
function z(){
// It should be a number, but parse it just incase
var e=parseInt(c.duration),
// True duration
t=0;
// Only if duration available
// If custom duration is funky, use regular duration
return null===ue.media.duration||isNaN(ue.media.duration)||(t=ue.media.duration),isNaN(e)?t:e}
// Check playing state
function F(){Ee(ue.container,c.classes.playing,!ue.media.paused),Ee(ue.container,c.classes.stopped,ue.media.paused),ee(ue.media.paused)}
// Save scroll position
function D(){Xe={x:ge.pageXOffset||0,y:ge.pageYOffset||0}}
// Restore scroll position
function W(){ge.scrollTo(Xe.x,Xe.y)}
// Toggle fullscreen
function H(e){
// Check for native support
var t=Qe.supportsFullScreen;if(t){
// If it's a fullscreen change event, update the UI
if(!e||e.type!==Qe.fullScreenEventName)
// Else it's a user request to enter or exit
return Qe.isFullScreen(ue.container)?
// Bail from fullscreen
Qe.cancelFullScreen():(
// Save scroll position
D(),
// Request full screen
Qe.requestFullScreen(ue.container)),void(
// Check if we're actually full screen (it could fail)
ue.isFullscreen=Qe.isFullScreen(ue.container));ue.isFullscreen=Qe.isFullScreen(ue.container)}else
// Otherwise, it's a simple toggle
ue.isFullscreen=!ue.isFullscreen,
// Bind/unbind escape key
ye.body.style.overflow=ue.isFullscreen?"hidden":"";
// Set class hook
Ee(ue.container,c.classes.fullscreen.active,ue.isFullscreen),
// Trap focus
h(ue.isFullscreen),
// Set button state
ue.buttons&&ue.buttons.fullscreen&&Fe(ue.buttons.fullscreen,ue.isFullscreen),
// Trigger an event
o(ue.container,ue.isFullscreen?"enterfullscreen":"exitfullscreen",!0),
// Restore scroll position
!ue.isFullscreen&&t&&W()}
// Mute
function _(e){
// Embeds
if(
// If the method is called without parameter, toggle based on current value
Be.boolean(e)||(e=!ue.media.muted),
// Set button state
Fe(ue.buttons.mute,e),
// Set mute on the player
ue.media.muted=e,
// If volume is 0 after unmuting, set to default
0===ue.media.volume&&L(c.volume),xe(c.types.embed,ue.type)){
// YouTube
switch(ue.type){case"youtube":ue.embed[ue.media.muted?"mute":"unMute"]();break;case"vimeo":case"soundcloud":ue.embed.setVolume(ue.media.muted?0:parseFloat(c.volume/c.volumeMax));break}
// Trigger volumechange for embeds
o(ue.media,"volumechange")}}
// Set volume
function L(e){var t=c.volumeMax,i=c.volumeMin;
// Load volume from storage if no value specified
// Embeds
if(Be.undefined(e)&&(e=ue.storage.volume),
// Use config if all else fails
(null===e||isNaN(e))&&(e=c.volume),
// Maximum is volumeMax
t<e&&(e=t),
// Minimum is volumeMin
e<i&&(e=i),
// Set the player volume
ue.media.volume=parseFloat(e/t),
// Set the display
ue.volume.display&&(ue.volume.display.value=e),xe(c.types.embed,ue.type)){switch(ue.type){case"youtube":ue.embed.setVolume(100*ue.media.volume);break;case"vimeo":case"soundcloud":ue.embed.setVolume(ue.media.volume);break}
// Trigger volumechange for embeds
o(ue.media,"volumechange")}
// Toggle muted state
0===e?ue.media.muted=!0:ue.media.muted&&0<e&&_()}
// Increase volume
function N(e){var t=ue.media.muted?0:ue.media.volume*c.volumeMax;Be.number(e)||(e=c.volumeStep),L(t+e)}
// Decrease volume
function V(e){var t=ue.media.muted?0:ue.media.volume*c.volumeMax;Be.number(e)||(e=c.volumeStep),L(t-e)}
// Update volume UI and storage
function R(){
// Get the current volume
var e=ue.media.muted?0:ue.media.volume*c.volumeMax;
// Update the <input type="range"> if present
ue.supported.full&&(ue.volume.input&&(ue.volume.input.value=e),ue.volume.display&&(ue.volume.display.value=e)),
// Update the volume in storage
x({volume:e}),
// Toggle class if muted
Ee(ue.container,c.classes.muted,0===e),
// Update checkbox for mute state
ue.supported.full&&ue.buttons.mute&&Fe(ue.buttons.mute,0===e)}
// Toggle captions
function Q(e){
// If there's no full support, or there's no caption toggle
ue.supported.full&&ue.buttons.captions&&(
// If the method is called without parameter, toggle based on current value
Be.boolean(e)||(e=-1===ue.container.className.indexOf(c.classes.captions.active)),
// Set global
ue.captionsEnabled=e,
// Toggle state
Fe(ue.buttons.captions,ue.captionsEnabled),
// Add class hook
Ee(ue.container,c.classes.captions.active,ue.captionsEnabled),
// Trigger an event
o(ue.container,ue.captionsEnabled?"captionsenabled":"captionsdisabled",!0),
// Save captions state to localStorage
x({captionsEnabled:ue.captionsEnabled}))}
// Check if media is loading
function X(e){var t="waiting"===e.type;
// Clear timer
clearTimeout(pe.loading),
// Timer to prevent flicker when seeking
pe.loading=setTimeout(function(){
// Toggle container class hook
Ee(ue.container,c.classes.loading,t),
// Show controls if loading, hide if done
ee(t)},t?250:0)}
// Update <progress> elements
function Y(e){if(ue.supported.full){var t=ue.progress.played,i=0,n=z(),o;if(e)switch(e.type){
// Video playing
case"timeupdate":case"seeking":if(ue.controls.pressed)return;i=De(ue.media.currentTime,n),
// Set seek range value only if it's a 'natural' time event
"timeupdate"===e.type&&ue.buttons.seek&&(ue.buttons.seek.value=i);break;
// Check buffer status
case"playing":case"progress":t=ue.progress.buffer,i=(o=ue.media.buffered)&&o.length?De(o.end(0),n):Be.number(o)?100*o:0;break}
// Set values
B(t,i)}}
// Set <progress> value
function B(e,t){if(ue.supported.full){
// Default to buffer or bail
if(
// Default to 0
Be.undefined(t)&&(t=0),Be.undefined(e)){if(!ue.progress||!ue.progress.buffer)return;e=ue.progress.buffer}
// One progress element passed
Be.htmlElement(e)?e.value=t:e&&(
// Object of progress + text element
e.bar&&(e.bar.value=t),e.text&&(e.text.innerHTML=t))}}
// Update the displayed time
function U(e,t){
// Bail if there's no duration display
if(t){
// Fallback to 0
isNaN(e)&&(e=0),ue.secs=parseInt(e%60),ue.mins=parseInt(e/60%60),ue.hours=parseInt(e/60/60%60);
// Do we need to display hours?
var i=0<parseInt(z()/60/60%60);
// Ensure it's two digits. For example, 03 rather than 3.
ue.secs=("0"+ue.secs).slice(-2),ue.mins=("0"+ue.mins).slice(-2),
// Render
t.innerHTML=(i?ue.hours+":":"")+ue.mins+":"+ue.secs}}
// Show the duration on metadataloaded
function G(){if(ue.supported.full){
// Determine duration
var e=z()||0;
// If there's only one time display, display duration there
!ue.duration&&c.displayDuration&&ue.media.paused&&U(e,ue.currentTime),
// If there's a duration element, update content
ue.duration&&U(e,ue.duration),
// Update the tooltip (if visible)
K()}}
// Handle time change event
function Z(e){
// Duration
U(ue.media.currentTime,ue.currentTime),
// Ignore updates while seeking
e&&"timeupdate"===e.type&&ue.media.seeking||
// Playing progress
Y(e)}
// Update seek range and progress
function J(e){
// Default to 0
Be.number(e)||(e=0);var t,i=De(e,z());
// Update progress
ue.progress&&ue.progress.played&&(ue.progress.played.value=i),
// Update seek range input
ue.buttons&&ue.buttons.seek&&(ue.buttons.seek.value=i)}
// Update hover tooltip for seeking
function K(e){var t=z();
// Bail if setting not true
if(c.tooltips.seek&&ue.progress.container&&0!==t){
// Calculate percentage
var i=ue.progress.container.getBoundingClientRect(),n=0,o=c.classes.tooltip+"--visible";
// Determine percentage, if already visible
if(e)n=100/i.width*(e.pageX-i.left);else{if(!$e(ue.progress.tooltip,o))return;n=ue.progress.tooltip.style.left.replace("%","")}
// Set bounds
n<0?n=0:100<n&&(n=100),
// Display the time a click would seek to
U(t/100*n,ue.progress.tooltip),
// Set position
ue.progress.tooltip.style.left=n+"%",
// Show/hide the tooltip
// If the event is a moues in/out and percentage is inside bounds
e&&xe(["mouseenter","mouseleave"],e.type)&&Ee(ue.progress.tooltip,o,"mouseenter"===e.type)}}
// Show the player controls in fullscreen mode
function ee(e){
// Don't hide if config says not to, it's audio, or not ready or loading
if(c.hideControls&&"audio"!==ue.type){var t=0,i=!1,n=e,o=$e(ue.container,c.classes.loading);
// Default to false if no boolean
// If the mouse is not over the controls, set a timeout to hide them
if(Be.boolean(e)||(e&&e.type?(
// Is the enter fullscreen event
i="enterfullscreen"===e.type,
// Whether to show controls
n=xe(["mousemove","touchstart","mouseenter","focus"],e.type),
// Delay hiding on move events
xe(["mousemove","touchmove"],e.type)&&(t=2e3),
// Delay a little more for keyboard users
"focus"===e.type&&(t=3e3)):n=$e(ue.container,c.classes.hideControls)),
// Clear timer every movement
ge.clearTimeout(pe.hover),n||ue.media.paused||o){
// Always show controls when paused or if touch
if(Ee(ue.container,c.classes.hideControls,!1),ue.media.paused||o)return;
// Delay for hiding on touch
ue.browser.isTouch&&(t=3e3)}
// If toggle is false or if we're playing (regardless of toggle),
// then set the timer to hide the controls
n&&ue.media.paused||(pe.hover=ge.setTimeout(function(){
// If the mouse is over the controls (and not entering fullscreen), bail
(!ue.controls.pressed&&!ue.controls.hover||i)&&Ee(ue.container,c.classes.hideControls,!0)},t))}}
// Add common function to retrieve media source
function te(e){
// If not null or undefined, parse it
if(Be.undefined(e)){
// Return the current source
var t;switch(ue.type){case"youtube":t=ue.embed.getVideoUrl();break;case"vimeo":ue.embed.getVideoUrl.then(function(e){t=e});break;case"soundcloud":ue.embed.getCurrentSound(function(e){t=e.permalink_url});break;default:t=ue.media.currentSrc;break}return t||""}ie(e)}
// Update source
// Sources are not checked for support so be careful
function ie(t){
// Setup new source
function e(){
// Set the type
if(
// Remove embed object
ue.embed=null,
// Remove the old media
Ce(ue.media),
// Remove video container
"video"===ue.type&&ue.videoContainer&&Ce(ue.videoContainer),
// Reset class name
ue.container&&ue.container.removeAttribute("class"),"type"in t&&(ue.type=t.type,"video"===ue.type)){var e=t.sources[0];"type"in e&&xe(c.types.embed,e.type)&&(ue.type=e.type)}
// Check for support
// Create new markup
switch(ue.supported=Ve(ue.type),ue.type){case"video":ue.media=ye.createElement("video");break;case"audio":ue.media=ye.createElement("audio");break;case"youtube":case"vimeo":case"soundcloud":ue.media=ye.createElement("div"),ue.embedId=t.sources[0].src;break}
// Inject the new element
Pe(ue.container,ue.media),
// Autoplay the new source?
Be.boolean(t.autoplay)&&(c.autoplay=t.autoplay),
// Set attributes for audio and video
xe(c.types.html5,ue.type)&&(c.crossorigin&&ue.media.setAttribute("crossorigin",""),c.autoplay&&ue.media.setAttribute("autoplay",""),"poster"in t&&ue.media.setAttribute("poster",t.poster),c.loop&&ue.media.setAttribute("loop","")),
// Restore class hooks
Ee(ue.container,c.classes.fullscreen.active,ue.isFullscreen),Ee(ue.container,c.classes.captions.active,ue.captionsEnabled),y(),
// Set new sources for html5
xe(c.types.html5,ue.type)&&v("source",t.sources),
// Set up from scratch
T(),
// HTML5 stuff
xe(c.types.html5,ue.type)&&(
// Setup captions
"tracks"in t&&v("track",t.tracks),
// Load HTML5 sources
ue.media.load()),
// If HTML5 or embed but not fully supported, setupInterface and call ready now
(xe(c.types.html5,ue.type)||xe(c.types.embed,ue.type)&&!ue.supported.full)&&(
// Setup interface
ce(),
// Call ready
de()),
// Set aria title and iframe title
c.title=t.title,w()}
// Destroy instance adn wait for callback
// Vimeo throws a wobbly if you don't wait
Be.object(t)&&"sources"in t&&t.sources.length?(
// Remove ready class hook
Ee(ue.container,c.classes.ready,!1),
// Pause playback
E(),
// Update seek range and progress
J(),
// Reset buffer progress
B(),
// Cancel current network requests
ae(),se(e,!1)):me("Invalid source format")}
// Update poster
function ne(e){"video"===ue.type&&ue.media.setAttribute("poster",e)}
// Listen for control events
function oe(){
// Click play/pause helper
function e(){var e=$(),t=ue.buttons[e?"play":"pause"],i=ue.buttons[e?"pause":"play"];
// Determine which buttons
// Setup focus and tab focus
if(
// Get the last play button to account for the large play button
i=i&&1<i.length?i[i.length-1]:i[0]){var n=$e(t,c.classes.tabFocus);setTimeout(function(){i.focus(),n&&(Ee(t,c.classes.tabFocus,!1),Ee(i,c.classes.tabFocus,!0))},100)}}
// Get the focused element
function r(){var e=ye.activeElement;return e=e&&e!==ye.body?ye.querySelector(":focus"):null}
// Get the key code for an event
function a(e){return e.keyCode?e.keyCode:e.which}
// Detect tab focus
function n(e){for(var t in ue.buttons){var i=ue.buttons[t];if(Be.nodeList(i))for(var n=0;n<i.length;n++)Ee(i[n],c.classes.tabFocus,i[n]===e);else Ee(i,c.classes.tabFocus,i===e)}}
// Keyboard shortcuts
function s(e){
// Seek by the number keys
function t(){
// Get current duration
var e=ue.media.duration;
// Bail if we have no duration set
Be.number(e)&&
// Divide the max duration into 10th's and times by the number value
j(e/10*(i-48))}
// Handle the key on keydown
// Reset on keyup
var i=a(e),n="keydown"===e.type,o=n&&i===l;
// If the event is bubbled from the media element
// Firefox doesn't get the keycode for whatever reason
if(Be.number(i))if(n){
// Which keycodes should we prevent default
var r;
// If the code is found prevent default (e.g. prevent scrolling for arrows)
switch(xe([48,49,50,51,52,53,54,56,57,32,75,38,40,77,39,37,70,67],i)&&(e.preventDefault(),e.stopPropagation()),i){
// 0-9
case 48:case 49:case 50:case 51:case 52:case 53:case 54:case 55:case 56:case 57:o||t();break;
// Space and K key
case 32:case 75:o||$();break;
// Arrow up
case 38:N();break;
// Arrow down
case 40:V();break;
// M key
case 77:o||_();break;
// Arrow forward
case 39:M();break;
// Arrow back
case 37:I();break;
// F key
case 70:H();break;
// C key
case 67:o||Q();break}
// Escape is handle natively when in full screen
// So we only need to worry about non native
!Qe.supportsFullScreen&&ue.isFullscreen&&27===i&&H(),
// Store last code for next cycle
l=i}else l=null}
// Focus/tab management
// IE doesn't support input event, so we fallback to change
var t=ue.browser.isIE?"change":"input";if(c.keyboardShorcuts.focused){var l=null;
// Handle global presses
c.keyboardShorcuts.global&&je(ge,"keydown keyup",function(e){var t=a(e),i=r(),n=[48,49,50,51,52,53,54,56,57,75,77,70,67],o;
// Only handle global key press if there's only one player
// and the key is in the allowed keys
// and if the focused element is not editable (e.g. text input)
// and any that accept key input http://webaim.org/techniques/keyboard/
1!==Re().length||!xe(n,t)||Be.htmlElement(i)&&Ie(i,c.selectors.editable)||s(e)}),
// Handle presses on focused
je(ue.container,"keydown keyup",s)}for(var i in je(ge,"keyup",function(e){var t=a(e),i=r();9===t&&n(i)}),je(ye.body,"click",function(){Ee(p("."+c.classes.tabFocus),c.classes.tabFocus,!1)}),ue.buttons){var o=ue.buttons[i];je(o,"blur",function(){Ee(o,"tab-focus",!1)})}
// Play
Me(ue.buttons.play,"click",c.listeners.play,e),
// Pause
Me(ue.buttons.pause,"click",c.listeners.pause,e),
// Restart
Me(ue.buttons.restart,"click",c.listeners.restart,j),
// Rewind
Me(ue.buttons.rewind,"click",c.listeners.rewind,I),
// Fast forward
Me(ue.buttons.forward,"click",c.listeners.forward,M),
// Seek
Me(ue.buttons.seek,t,c.listeners.seek,j),
// Set volume
Me(ue.volume.input,t,c.listeners.volume,function(){L(ue.volume.input.value)}),
// Mute
Me(ue.buttons.mute,"click",c.listeners.mute,_),
// Fullscreen
Me(ue.buttons.fullscreen,"click",c.listeners.fullscreen,H),
// Handle user exiting fullscreen by escaping etc
Qe.supportsFullScreen&&je(ye,Qe.fullScreenEventName,H),
// Captions
Me(ue.buttons.captions,"click",c.listeners.captions,Q),
// Seek tooltip
je(ue.progress.container,"mouseenter mouseleave mousemove",K),
// Toggle controls visibility based on mouse movement
c.hideControls&&(
// Toggle controls on mouse events and entering fullscreen
je(ue.container,"mouseenter mouseleave mousemove touchstart touchend touchcancel touchmove enterfullscreen",ee),
// Watch for cursor over controls so they don't hide when trying to interact
je(ue.controls,"mouseenter mouseleave",function(e){ue.controls.hover="mouseenter"===e.type}),
// Watch for cursor over controls so they don't hide when trying to interact
je(ue.controls,"mousedown mouseup touchstart touchend touchcancel",function(e){ue.controls.pressed=xe(["mousedown","touchstart"],e.type)}),
// Focus in/out on controls
je(ue.controls,"focus blur",ee,!0)),
// Adjust volume on scroll
je(ue.volume.input,"wheel",function(e){e.preventDefault();
// Detect "natural" scroll - suppored on OS X Safari only
// Other browsers on OS X will be inverted until support improves
var t=e.webkitDirectionInvertedFromDevice,i=c.volumeStep/5;
// Scroll down (or up on natural) to decrease
(e.deltaY<0||0<e.deltaX)&&(t?V(i):N(i)),
// Scroll up (or down on natural) to increase
(0<e.deltaY||e.deltaX<0)&&(t?N(i):V(i))})}
// Listen for media events
function re(){
// Click video
if(
// Time change on media
je(ue.media,"timeupdate seeking",Z),
// Update manual captions
je(ue.media,"timeupdate",r),
// Display duration
je(ue.media,"durationchange loadedmetadata",G),
// Handle the media finishing
je(ue.media,"ended",function(){
// Show poster on end
"video"===ue.type&&c.showPosterOnEnd&&(
// Clear
"video"===ue.type&&d(),
// Restart
j(),
// Re-load media
ue.media.load())}),
// Check for buffer progress
je(ue.media,"progress playing",Y),
// Handle native mute
je(ue.media,"volumechange",R),
// Handle native play/pause
je(ue.media,"play pause ended",F),
// Loading
je(ue.media,"waiting canplay seeked",X),c.clickToPlay&&"audio"!==ue.type){
// Re-fetch the wrapper
var e=p("."+c.classes.videoWrapper);
// Bail if there's no wrapper (this should never happen)
if(!e)return;
// Set cursor
e.style.cursor="pointer",
// On click play, pause ore restart
je(e,"click",function(){
// Touch devices will just show controls (if we're hiding controls)
c.hideControls&&ue.browser.isTouch&&!ue.media.paused||(ue.media.paused?O():ue.media.ended?(j(),O()):E())})}
// Disable right click
c.disableContextMenu&&je(ue.media,"contextmenu",function(e){e.preventDefault()}),
// Proxy events to container
// Bubble up key events for Edge
je(ue.media,c.events.concat(["keyup","keydown"]).join(" "),function(e){o(ue.container,e.type,!0)})}
// Cancel current network requests
// See https://github.com/sampotts/plyr/issues/174
function ae(){if(xe(c.types.html5,ue.type)){for(
// Remove child sources
var e=ue.media.querySelectorAll("source"),t=0;t<e.length;t++)Ce(e[t]);
// Set blank video src attribute
// This is to prevent a MEDIA_ERR_SRC_NOT_SUPPORTED error
// Info: http://stackoverflow.com/questions/32231579/how-to-properly-dispose-of-an-html5-video-and-close-socket-or-connection
ue.media.setAttribute("src",c.blankUrl),
// Load the new empty source
// This will cancel existing requests
// See https://github.com/sampotts/plyr/issues/174
ue.media.load(),
// Debugging
ve("Cancelled network requests")}}
// Destroy an instance
// Event listeners are removed when elements are removed
// http://stackoverflow.com/questions/12528049/if-a-dom-element-is-removed-are-its-listeners-also-removed-from-memory
function se(e,t){function i(){clearTimeout(pe.cleanUp),
// Default to restore original element
Be.boolean(t)||(t=!0),
// Callback
Be.function(e)&&e.call(he),
// Bail if we don't need to restore the original element
t&&(
// Remove init flag
ue.init=!1,
// Replace the container with the original element provided
ue.container.parentNode.replaceChild(he,ue.container),
// Allow overflow (set on fullscreen)
ye.body.style.overflow="",
// Event
o(he,"destroyed",!0))}
// Bail if the element is not initialized
if(!ue.init)return null;
// Type specific stuff
switch(ue.type){case"youtube":
// Clear timers
ge.clearInterval(pe.buffering),ge.clearInterval(pe.playing),
// Destroy YouTube API
ue.embed.destroy(),
// Clean up
i();break;case"vimeo":
// Destroy Vimeo API
// then clean up (wait, to prevent postmessage errors)
ue.embed.unload().then(i),
// Vimeo does not always return
pe.cleanUp=ge.setTimeout(i,200);break;case"video":case"audio":
// Restore native video controls
b(!0),
// Clean up
i();break}}
// Setup a player
function le(){
// Bail if the element is initialized
if(ue.init)return null;
// Setup the fullscreen api
// Bail if nothing to setup
if(Qe=Le(),
// Sniff out the browser
ue.browser=be(),Be.htmlElement(ue.media)){
// Load saved settings from localStorage
k();
// Set media type based on tag or data attribute
// Supported: video, audio, vimeo, youtube
var e=t.tagName.toLowerCase();"div"===e?(ue.type=t.getAttribute("data-type"),ue.embedId=t.getAttribute("data-video-id"),
// Clean up
t.removeAttribute("data-type"),t.removeAttribute("data-video-id")):(ue.type=e,c.crossorigin=null!==t.getAttribute("crossorigin"),c.autoplay=c.autoplay||null!==t.getAttribute("autoplay"),c.loop=c.loop||null!==t.getAttribute("loop")),
// Check for support
ue.supported=Ve(ue.type),
// If no native support, bail
ue.supported.basic&&(
// Wrap media
ue.container=Se(t,ye.createElement("div")),
// Allow focus to be captured
ue.container.setAttribute("tabindex",0),
// Add style hook
y(),
// Debug info
ve(ue.browser.name+" "+ue.browser.version),
// Setup media
T(),
// Setup interface
// If embed but not fully supported, setupInterface (to avoid flash of controls) and call ready now
(xe(c.types.html5,ue.type)||xe(c.types.embed,ue.type)&&!ue.supported.full)&&(
// Setup UI
ce(),
// Call ready
de(),
// Set title on button and frame
w()),
// Successful setup
ue.init=!0)}}
// Setup the UI
function ce(){
// Don't setup interface if no support
if(!ue.supported.full)
// Bail
return me("Basic support only",ue.type),
// Remove controls
Ce(p(c.selectors.controls.wrapper)),
// Remove large play
Ce(p(c.selectors.buttons.play)),void
// Restore native controls
b(!0);
// Inject custom controls if not present
var e=!l(c.selectors.controls.wrapper).length;e&&
// Inject custom controls
m(),
// Find the elements
g()&&(
// If the controls are injected, re-bind listeners for controls
e&&oe(),
// Media element listeners
re(),
// Remove native controls
b(),
// Setup fullscreen
i(),
// Captions
n(),
// Set volume
L(),R(),
// Reset time display
Z(),
// Update the UI
F())}
// Everything done
function de(){
// Ready event at end of execution stack
ge.setTimeout(function(){o(ue.media,"ready")},0),
// Set class hook on media element
Ee(ue.media,Ye.classes.setup,!0),
// Set container class for ready
Ee(ue.container,c.classes.ready,!0),
// Store a refernce to instance
ue.media.plyr=fe,
// Autoplay
c.autoplay&&O()}
// Initialize instance
var ue=this,pe={},fe,he=(
// Set media
ue.media=t).cloneNode(!0),ve=function(){e("log",arguments)},me=function(){e("warn",arguments)};
// If init failed, return null
// Log config options
return ve("Config",c),fe={getOriginal:function(){return he},getContainer:function(){return ue.container},getEmbed:function(){return ue.embed},getMedia:function(){return ue.media},getType:function(){return ue.type},getDuration:z,getCurrentTime:function(){return ue.media.currentTime},getVolume:function(){return ue.media.volume},isMuted:function(){return ue.media.muted},isReady:function(){return $e(ue.container,c.classes.ready)},isLoading:function(){return $e(ue.container,c.classes.loading)},isPaused:function(){return ue.media.paused},on:function(e,t){return je(ue.container,e,t),this},play:O,pause:E,stop:function(){E(),j()},restart:j,rewind:I,forward:M,seek:j,source:te,poster:ne,setVolume:L,togglePlay:$,toggleMute:_,toggleCaptions:Q,toggleFullscreen:H,toggleControls:ee,isFullscreen:function(){return ue.isFullscreen||!1},support:function(e){return we(ue,e)},destroy:se},le(),ue.init?fe:null}
// Load a sprite
function Ne(e,t){var i=new XMLHttpRequest;
// If the id is set and sprite exists, bail
if(!Be.string(t)||!Be.htmlElement(ye.querySelector("#"+t))){
// Create placeholder (to prevent loading twice)
var n=ye.createElement("div");n.setAttribute("hidden",""),Be.string(t)&&n.setAttribute("id",t),ye.body.insertBefore(n,ye.body.childNodes[0]),
// Check for CORS support
"withCredentials"in i&&(i.open("GET",e,!0),
// Inject hidden div with sprite on load
i.onload=function(){n.innerHTML=i.responseText},i.send())}}
// Check for support
function Ve(e){var t=be(),i=t.isIE&&t.version<=9,n=t.isIos,o=t.isIphone,r=!!ye.createElement("audio").canPlayType,a=!!ye.createElement("video").canPlayType,s=!1,l=!1;switch(e){case"video":l=(s=a)&&!i&&!o;break;case"audio":l=(s=r)&&!i;break;
// Vimeo does not seem to be supported on iOS via API
// Issue raised https://github.com/vimeo/player.js/issues/87
case"vimeo":s=!0,l=!i&&!n;break;case"youtube":s=!0,l=!i&&!n,
// YouTube seems to work on iOS 10+ on iPad
n&&!o&&10<=t.version&&(l=!0);break;case"soundcloud":s=!0,l=!i&&!o;break;default:l=(s=r&&a)&&!i}return{basic:s,full:l}}
// Setup function
function e(e,l){
// Add to container list
function t(e,t){$e(t,Ye.classes.hook)||i.push({
// Always wrap in a <div> for styling
//container:  _wrap(media, document.createElement('div')),
// Could be a container or the media itself
target:e,
// This should be the <video>, <audio> or <div> (YouTube/Vimeo)
media:t})}
// Check if the targets have multiple media elements
// Get the players
var i=[],c=[],n=[Ye.selectors.html5,Ye.selectors.embed].join(",");
// Select the elements
// Bail if disabled or no basic support
// You may want to disable certain UAs etc
if(Be.string(e)?
// String selector passed
e=ye.querySelectorAll(e):Be.htmlElement(e)?
// Single HTMLElement passed
e=[e]:Be.nodeList(e)||Be.array(e)||Be.string(e)||(
// No selector passed, possibly options as first argument
// If options are the first argument
Be.undefined(l)&&Be.object(e)&&(l=e),
// Use default selector
e=ye.querySelectorAll(n)),
// Convert NodeList to array
Be.nodeList(e)&&(e=Array.prototype.slice.call(e)),!Ve().basic||!e.length)return!1;for(var o=0;o<e.length;o++){var r=e[o],a=r.querySelectorAll(n);
// Get children
// If there's more than one media element child, wrap them
if(a.length)for(var s=0;s<a.length;s++)t(r,a[s]);else Ie(r,n)&&
// Target is media element
t(r,r)}
// Create a player instance for each element
return i.forEach(function(e){var t=e.target,i=e.media,n=!1;
// The target element can also be the media element
i===t&&(n=!0);
// Setup a player instance and add to the element
// Create instance-specific config
var o={};
// Try parsing data attribute config
try{o=JSON.parse(t.getAttribute("data-plyr"))}catch(e){}var r=We({},Ye,l,o);
// Bail if not enabled
if(!r.enabled)return null;
// Create new instance
var a=new d(i,r);
// Go to next if setup failed
if(Be.object(a)){
// Listen for events if debugging
if(r.debug){var s=r.events.concat(["setup","statechange","enterfullscreen","exitfullscreen","captionsenabled","captionsdisabled"]);je(a.getContainer(),s.join(" "),function(e){console.log([r.logPrefix,"event:",e.type].join(" "),e.detail.plyr)})}
// Callback
ze(a.getContainer(),"setup",!0,{plyr:a}),
// Add to return array even if it's already setup
c.push(a)}}),c}
// Get all instances within a provided container
function Re(e){
// If we have a HTML element
if(Be.string(e)?
// Get selector if string passed
e=ye.querySelector(e):Be.undefined(e)&&(
// Use body by default to get all on page
e=ye.body),Be.htmlElement(e)){var t=e.querySelectorAll("."+Ye.classes.setup),i=[];return Array.prototype.slice.call(t).forEach(function(e){Be.object(e.plyr)&&i.push(e.plyr)}),i}return[]}var Qe,Xe={x:0,y:0},
// Default config
Ye={enabled:!0,debug:!1,autoplay:!1,loop:!1,seekTime:10,volume:10,volumeMin:0,volumeMax:10,volumeStep:1,duration:null,displayDuration:!0,loadSprite:!0,iconPrefix:"plyr",iconUrl:"https://cdn.plyr.io/2.0.13/plyr.svg",blankUrl:"https://cdn.selz.com/plyr/blank.mp4",clickToPlay:!0,hideControls:!0,showPosterOnEnd:!1,disableContextMenu:!0,keyboardShorcuts:{focused:!0,global:!1},tooltips:{controls:!1,seek:!0},selectors:{html5:"video, audio",embed:"[data-type]",editable:"input, textarea, select, [contenteditable]",container:".plyr",controls:{container:null,wrapper:".plyr__controls"},labels:"[data-plyr]",buttons:{seek:'[data-plyr="seek"]',play:'[data-plyr="play"]',pause:'[data-plyr="pause"]',restart:'[data-plyr="restart"]',rewind:'[data-plyr="rewind"]',forward:'[data-plyr="fast-forward"]',mute:'[data-plyr="mute"]',captions:'[data-plyr="captions"]',fullscreen:'[data-plyr="fullscreen"]'},volume:{input:'[data-plyr="volume"]',display:".plyr__volume--display"},progress:{container:".plyr__progress",buffer:".plyr__progress--buffer",played:".plyr__progress--played"},captions:".plyr__captions",currentTime:".plyr__time--current",duration:".plyr__time--duration"},classes:{setup:"plyr--setup",ready:"plyr--ready",videoWrapper:"plyr__video-wrapper",embedWrapper:"plyr__video-embed",type:"plyr--{0}",stopped:"plyr--stopped",playing:"plyr--playing",muted:"plyr--muted",loading:"plyr--loading",hover:"plyr--hover",tooltip:"plyr__tooltip",hidden:"plyr__sr-only",hideControls:"plyr--hide-controls",isIos:"plyr--is-ios",isTouch:"plyr--is-touch",captions:{enabled:"plyr--captions-enabled",active:"plyr--captions-active"},fullscreen:{enabled:"plyr--fullscreen-enabled",active:"plyr--fullscreen-active"},tabFocus:"tab-focus"},captions:{defaultActive:!1},fullscreen:{enabled:!0,fallback:!0,allowAudio:!1},storage:{enabled:!0,key:"plyr"},controls:["play-large","play","progress","current-time","mute","volume","captions","fullscreen"],i18n:{restart:"Restart",rewind:"Rewind {seektime} secs",play:"Play",pause:"Pause",forward:"Forward {seektime} secs",played:"played",buffered:"buffered",currentTime:"Current time",duration:"Duration",volume:"Volume",toggleMute:"Toggle Mute",toggleCaptions:"Toggle Captions",toggleFullscreen:"Toggle Fullscreen",frameTitle:"Player for {title}"},types:{embed:["youtube","vimeo","soundcloud"],html5:["video","audio"]},
// URLs
urls:{vimeo:{api:"https://player.vimeo.com/api/player.js"},youtube:{api:"https://www.youtube.com/iframe_api"},soundcloud:{api:"https://w.soundcloud.com/player/api.js"}},
// Custom control listeners
listeners:{seek:null,play:null,pause:null,restart:null,rewind:null,forward:null,mute:null,volume:null,captions:null,fullscreen:null},
// Events to watch on HTML5 media elements
events:["ready","ended","progress","stalled","playing","waiting","canplay","canplaythrough","loadstart","loadeddata","loadedmetadata","timeupdate","volumechange","play","pause","error","seeking","seeked","emptied"],
// Logging
logPrefix:"[Plyr]"},Be={object:function(e){return null!==e&&"object"==typeof e},array:function(e){return null!==e&&"object"==typeof e&&e.constructor===Array},number:function(e){return null!==e&&("number"==typeof e&&!isNaN(e-0)||"object"==typeof e&&e.constructor===Number)},string:function(e){return null!==e&&("string"==typeof e||"object"==typeof e&&e.constructor===String)},boolean:function(e){return null!==e&&"boolean"==typeof e},nodeList:function(e){return null!==e&&e instanceof NodeList},htmlElement:function(e){return null!==e&&e instanceof HTMLElement},function:function(e){return null!==e&&"function"==typeof e},undefined:function(e){return null!==e&&void 0===e}},Ue={supported:function(){if(!("localStorage"in ge))return!1;
// Try to use it (it might be disabled, e.g. user is in private/porn mode)
// see: https://github.com/sampotts/plyr/issues/131
try{
// Add test item
ge.localStorage.setItem("___test","OK");
// Get the test item
var e=ge.localStorage.getItem("___test");
// Clean up
// Check if value matches
return ge.localStorage.removeItem("___test"),"OK"===e}catch(e){return!1}return!1}()};return{setup:e,supported:Ve,loadSprite:Ne,get:Re}}),
// Custom event polyfill
// https://developer.mozilla.org/en-US/docs/Web/API/CustomEvent/CustomEvent
function(){function e(e,t){t=t||{bubbles:!1,cancelable:!1,detail:void 0};var i=document.createEvent("CustomEvent");return i.initCustomEvent(e,t.bubbles,t.cancelable,t.detail),i}"function"!=typeof window.CustomEvent&&(e.prototype=window.Event.prototype,window.CustomEvent=e)}(),void 0===jQuery)&&(jQuery="function"==typeof require?$=require("jquery"):$);jQuery.easing.jswing=jQuery.easing.swing,jQuery.extend(jQuery.easing,{def:"easeOutQuad",swing:function(e,t,i,n,o){return jQuery.easing[jQuery.easing.def](e,t,i,n,o)},easeInQuad:function(e,t,i,n,o){return n*(t/=o)*t+i},easeOutQuad:function(e,t,i,n,o){return-n*(t/=o)*(t-2)+i},easeInOutQuad:function(e,t,i,n,o){return(t/=o/2)<1?n/2*t*t+i:-n/2*(--t*(t-2)-1)+i},easeInCubic:function(e,t,i,n,o){return n*(t/=o)*t*t+i},easeOutCubic:function(e,t,i,n,o){return n*((t=t/o-1)*t*t+1)+i},easeInOutCubic:function(e,t,i,n,o){return(t/=o/2)<1?n/2*t*t*t+i:n/2*((t-=2)*t*t+2)+i},easeInQuart:function(e,t,i,n,o){return n*(t/=o)*t*t*t+i},easeOutQuart:function(e,t,i,n,o){return-n*((t=t/o-1)*t*t*t-1)+i},easeInOutQuart:function(e,t,i,n,o){return(t/=o/2)<1?n/2*t*t*t*t+i:-n/2*((t-=2)*t*t*t-2)+i},easeInQuint:function(e,t,i,n,o){return n*(t/=o)*t*t*t*t+i},easeOutQuint:function(e,t,i,n,o){return n*((t=t/o-1)*t*t*t*t+1)+i},easeInOutQuint:function(e,t,i,n,o){return(t/=o/2)<1?n/2*t*t*t*t*t+i:n/2*((t-=2)*t*t*t*t+2)+i},easeInSine:function(e,t,i,n,o){return-n*Math.cos(t/o*(Math.PI/2))+n+i},easeOutSine:function(e,t,i,n,o){return n*Math.sin(t/o*(Math.PI/2))+i},easeInOutSine:function(e,t,i,n,o){return-n/2*(Math.cos(Math.PI*t/o)-1)+i},easeInExpo:function(e,t,i,n,o){return 0==t?i:n*Math.pow(2,10*(t/o-1))+i},easeOutExpo:function(e,t,i,n,o){return t==o?i+n:n*(1-Math.pow(2,-10*t/o))+i},easeInOutExpo:function(e,t,i,n,o){return 0==t?i:t==o?i+n:(t/=o/2)<1?n/2*Math.pow(2,10*(t-1))+i:n/2*(2-Math.pow(2,-10*--t))+i},easeInCirc:function(e,t,i,n,o){return-n*(Math.sqrt(1-(t/=o)*t)-1)+i},easeOutCirc:function(e,t,i,n,o){return n*Math.sqrt(1-(t=t/o-1)*t)+i},easeInOutCirc:function(e,t,i,n,o){return(t/=o/2)<1?-n/2*(Math.sqrt(1-t*t)-1)+i:n/2*(Math.sqrt(1-(t-=2)*t)+1)+i},easeInElastic:function(e,t,i,n,o){var r=1.70158,a=0,s=n;if(0==t)return i;if(1==(t/=o))return i+n;if(a||(a=.3*o),s<Math.abs(n)){s=n;var r=a/4}else var r=a/(2*Math.PI)*Math.asin(n/s);return-s*Math.pow(2,10*(t-=1))*Math.sin((t*o-r)*(2*Math.PI)/a)+i},easeOutElastic:function(e,t,i,n,o){var r=1.70158,a=0,s=n;if(0==t)return i;if(1==(t/=o))return i+n;if(a||(a=.3*o),s<Math.abs(n)){s=n;var r=a/4}else var r=a/(2*Math.PI)*Math.asin(n/s);return s*Math.pow(2,-10*t)*Math.sin((t*o-r)*(2*Math.PI)/a)+n+i},easeInOutElastic:function(e,t,i,n,o){var r=1.70158,a=0,s=n;if(0==t)return i;if(2==(t/=o/2))return i+n;if(a||(a=o*(.3*1.5)),s<Math.abs(n)){s=n;var r=a/4}else var r=a/(2*Math.PI)*Math.asin(n/s);return t<1?s*Math.pow(2,10*(t-=1))*Math.sin((t*o-r)*(2*Math.PI)/a)*-.5+i:s*Math.pow(2,-10*(t-=1))*Math.sin((t*o-r)*(2*Math.PI)/a)*.5+n+i},easeInBack:function(e,t,i,n,o,r){return null==r&&(r=1.70158),n*(t/=o)*t*((r+1)*t-r)+i},easeOutBack:function(e,t,i,n,o,r){return null==r&&(r=1.70158),n*((t=t/o-1)*t*((r+1)*t+r)+1)+i},easeInOutBack:function(e,t,i,n,o,r){return null==r&&(r=1.70158),(t/=o/2)<1?n/2*(t*t*((1+(r*=1.525))*t-r))+i:n/2*((t-=2)*t*((1+(r*=1.525))*t+r)+2)+i},easeInBounce:function(e,t,i,n,o){return n-jQuery.easing.easeOutBounce(e,o-t,0,n,o)+i},easeOutBounce:function(e,t,i,n,o){return(t/=o)<1/2.75?n*(7.5625*t*t)+i:t<2/2.75?n*(7.5625*(t-=1.5/2.75)*t+.75)+i:t<2.5/2.75?n*(7.5625*(t-=2.25/2.75)*t+.9375)+i:n*(7.5625*(t-=2.625/2.75)*t+.984375)+i},easeInOutBounce:function(e,t,i,n,o){return t<o/2?.5*jQuery.easing.easeInBounce(e,2*t,0,n,o)+i:.5*jQuery.easing.easeOutBounce(e,2*t-o,0,n,o)+.5*n+i}}),jQuery.extend(jQuery.easing,{easeInOutMaterial:function(e,t,i,n,o){return(t/=o/2)<1?n/2*t*t+i:n/4*((t-=2)*t*t+2)+i}}),jQuery.Velocity?console.log("Velocity is already loaded. You may be needlessly importing Velocity again; note that Materialize includes Velocity."):(function(t){function s(e){var t=e.length,i=u.type(e);return"function"!==i&&!u.isWindow(e)&&(!(1!==e.nodeType||!t)||"array"===i||0===t||"number"==typeof t&&0<t&&t-1 in e)}if(!t.jQuery){var u=function(e,t){return new u.fn.init(e,t)};u.isWindow=function(e){return null!=e&&e==e.window},u.type=function(e){return null==e?e+"":"object"==typeof e||"function"==typeof e?i[o.call(e)]||"object":typeof e},u.isArray=Array.isArray||function(e){return"array"===u.type(e)},u.isPlainObject=function(e){var t;if(!e||"object"!==u.type(e)||e.nodeType||u.isWindow(e))return!1;try{if(e.constructor&&!n.call(e,"constructor")&&!n.call(e.constructor.prototype,"isPrototypeOf"))return!1}catch(e){return!1}for(t in e);return void 0===t||n.call(e,t)},u.each=function(e,t,i){var n,o=0,r=e.length,a=s(e);if(i){if(a)for(;o<r&&!1!==(n=t.apply(e[o],i));o++);else for(o in e)if(!1===(n=t.apply(e[o],i)))break}else if(a)for(;o<r&&!1!==(n=t.call(e[o],o,e[o]));o++);else for(o in e)if(!1===(n=t.call(e[o],o,e[o])))break;return e},u.data=function(e,t,i){if(void 0===i){var n,o=(n=e[u.expando])&&r[n];if(void 0===t)return o;if(o&&t in o)return o[t]}else if(void 0!==t){var n=e[u.expando]||(e[u.expando]=++u.uuid);return r[n]=r[n]||{},r[n][t]=i}},u.removeData=function(e,t){var i=e[u.expando],n=i&&r[i];n&&u.each(t,function(e,t){delete n[t]})},u.extend=function(e){var t,i,n,o,r,a,s=e||{},l=1,c=arguments.length,d=!1;for("boolean"==typeof s&&(d=s,s=arguments[l]||{},l++),"object"!=typeof s&&"function"!==u.type(s)&&(s={}),l===c&&(s=this,l--);l<c;l++)if(null!=(r=arguments[l]))for(o in r)t=s[o],s!==(n=r[o])&&(d&&n&&(u.isPlainObject(n)||(i=u.isArray(n)))?(a=i?(i=!1,t&&u.isArray(t)?t:[]):t&&u.isPlainObject(t)?t:{},s[o]=u.extend(d,a,n)):void 0!==n&&(s[o]=n));return s},u.queue=function(e,t,i){function n(e,t){var i=t||[];return null!=e&&(s(Object(e))?function(e,t){for(var i=+t.length,n=0,o=e.length;n<i;)e[o++]=t[n++];if(i!=i)for(;void 0!==t[n];)e[o++]=t[n++];e.length=o}(i,"string"==typeof e?[e]:e):[].push.call(i,e)),i}if(e){t=(t||"fx")+"queue";var o=u.data(e,t);return i?(!o||u.isArray(i)?o=u.data(e,t,n(i)):o.push(i),o):o||[]}},u.dequeue=function(e,o){u.each(e.nodeType?[e]:e,function(e,t){o=o||"fx";var i=u.queue(t,o),n=i.shift();"inprogress"===n&&(n=i.shift()),n&&("fx"===o&&i.unshift("inprogress"),n.call(t,function(){u.dequeue(t,o)}))})},u.fn=u.prototype={init:function(e){if(e.nodeType)return this[0]=e,this;throw new Error("Not a DOM node.")},offset:function(){var e=this[0].getBoundingClientRect?this[0].getBoundingClientRect():{top:0,left:0};return{top:e.top+(t.pageYOffset||document.scrollTop||0)-(document.clientTop||0),left:e.left+(t.pageXOffset||document.scrollLeft||0)-(document.clientLeft||0)}},position:function(){function e(){for(var e=this.offsetParent||document;e&&"html"===!e.nodeType.toLowerCase&&"static"===e.style.position;)e=e.offsetParent;return e||document}var t=this[0],e=e.apply(t),i=this.offset(),n=/^(?:body|html)$/i.test(e.nodeName)?{top:0,left:0}:u(e).offset();return i.top-=parseFloat(t.style.marginTop)||0,i.left-=parseFloat(t.style.marginLeft)||0,e.style&&(n.top+=parseFloat(e.style.borderTopWidth)||0,n.left+=parseFloat(e.style.borderLeftWidth)||0),{top:i.top-n.top,left:i.left-n.left}}};var r={};u.expando="velocity"+(new Date).getTime(),u.uuid=0;for(var i={},n=i.hasOwnProperty,o=i.toString,e="Boolean Number String Function Array Date RegExp Object Error".split(" "),a=0;a<e.length;a++)i["[object "+e[a]+"]"]=e[a].toLowerCase();u.fn.init.prototype=u.fn,t.Velocity={Utilities:u}}}(window),function(e){"object"==typeof module&&"object"==typeof module.exports?module.exports=e():"function"==typeof define&&define.amd?define(e):e()}(function(){return function(e,D,W,H){function C(e){for(var t=-1,i=e?e.length:0,n=[];++t<i;){var o=e[t];o&&n.push(o)}return n}function g(e){return R.isWrapped(e)?e=[].slice.call(e):R.isNode(e)&&(e=[e]),e}function _(e){var t=V.data(e,"velocity");return null===t?H:t}function n(t){return function(e){return Math.round(e*t)*(1/t)}}function o(s,t,l,i){function n(e,t){return 1-3*t+3*e}function o(e,t){return 3*t-6*e}function r(e){return 3*e}function a(e,t,i){return((n(t,i)*e+o(t,i))*e+r(t))*e}function c(e,t,i){return 3*n(t,i)*e*e+2*o(t,i)*e+r(t)}function d(e,t){for(var i=0;i<h;++i){var n=c(t,s,l),o;if(0===n)return t;t-=(a(t,s,l)-e)/n}return t}function e(){for(var e=0;e<y;++e)x[e]=a(e*b,s,l)}function u(e,t,i){for(var n,o,r=0;0<(n=a(o=t+(i-t)/2,s,l)-e)?i=o:t=o,Math.abs(n)>m&&++r<g;);return o}function p(e){for(var t=0,i=1,n=y-1;i!=n&&x[i]<=e;++i)t+=b;var o,r=t+(e-x[--i])/(x[i+1]-x[i])*b,a=c(r,s,l);return v<=a?d(e,r):0==a?r:u(e,t,t+b)}function f(){T=!0,(s!=t||l!=i)&&e()}var h=4,v=.001,m=1e-7,g=10,y=11,b=1/(y-1),w="Float32Array"in D;if(4!==arguments.length)return!1;for(var k=0;k<4;++k)if("number"!=typeof arguments[k]||isNaN(arguments[k])||!isFinite(arguments[k]))return!1;s=Math.min(s,1),l=Math.min(l,1),s=Math.max(s,0),l=Math.max(l,0);var x=w?new Float32Array(y):new Array(y),T=!1,S=function(e){return T||f(),s===t&&l===i?e:0===e?0:1===e?1:a(p(e),t,i)};S.getControlPoints=function(){return[{x:s,y:t},{x:l,y:i}]};var C="generateBezier("+[s,t,l,i]+")";return S.toString=function(){return C},S}function L(e,t){var i=e;return R.isString(e)?Q.Easings[e]||(i=!1):i=R.isArray(e)&&1===e.length?n.apply(null,e):R.isArray(e)&&2===e.length?s.apply(null,e.concat([t])):!(!R.isArray(e)||4!==e.length)&&o.apply(null,e),!1===i&&(i=Q.Easings[Q.defaults.easing]?Q.defaults.easing:a),i}function N(e){if(e){var t=(new Date).getTime(),i=Q.State.calls.length;1e4<i&&(Q.State.calls=C(Q.State.calls));for(var n=0;n<i;n++)if(Q.State.calls[n]){var o=Q.State.calls[n],r=o[0],a=o[2],s=o[3],l=!!s,c=null;s||(s=Q.State.calls[n][3]=t-16);for(var d=Math.min((t-s)/a.duration,1),u=0,p=r.length;u<p;u++){var f=r[u],h=f.element;if(_(h)){var v=!1;if(a.display!==H&&null!==a.display&&"none"!==a.display){if("flex"===a.display){var m=["-webkit-box","-moz-box","-ms-flexbox","-webkit-flex"];V.each(m,function(e,t){X.setPropertyValue(h,"display",t)})}X.setPropertyValue(h,"display",a.display)}for(var g in a.visibility!==H&&"hidden"!==a.visibility&&X.setPropertyValue(h,"visibility",a.visibility),f)if("element"!==g){var y,b=f[g],w=R.isString(b.easing)?Q.Easings[b.easing]:b.easing;if(1===d)y=b.endValue;else{var k=b.endValue-b.startValue;if(y=b.startValue+k*w(d,a,k),!l&&y===b.currentValue)continue}if(b.currentValue=y,"tween"===g)c=y;else{if(X.Hooks.registered[g]){var x=X.Hooks.getRoot(g),T=_(h).rootPropertyValueCache[x];T&&(b.rootPropertyValue=T)}var S=X.setPropertyValue(h,g,b.currentValue+(0===parseFloat(y)?"":b.unitType),b.rootPropertyValue,b.scrollData);X.Hooks.registered[g]&&(_(h).rootPropertyValueCache[x]=X.Normalizations.registered[x]?X.Normalizations.registered[x]("extract",null,S[1]):S[1]),"transform"===S[0]&&(v=!0)}}a.mobileHA&&_(h).transformCache.translate3d===H&&(_(h).transformCache.translate3d="(0px, 0px, 0px)",v=!0),v&&X.flushTransformCache(h)}}a.display!==H&&"none"!==a.display&&(Q.State.calls[n][2].display=!1),a.visibility!==H&&"hidden"!==a.visibility&&(Q.State.calls[n][2].visibility=!1),a.progress&&a.progress.call(o[1],o[1],d,Math.max(0,s+a.duration-t),s,c),1===d&&P(n)}}Q.State.isTicking&&A(N)}function P(e,t){if(!Q.State.calls[e])return!1;for(var i=Q.State.calls[e][0],n=Q.State.calls[e][1],o=Q.State.calls[e][2],r=Q.State.calls[e][4],a=!1,s=0,l=i.length;s<l;s++){var c=i[s].element;if(t||o.loop||("none"===o.display&&X.setPropertyValue(c,"display",o.display),"hidden"===o.visibility&&X.setPropertyValue(c,"visibility",o.visibility)),!0!==o.loop&&(V.queue(c)[1]===H||!/\.velocityQueueEntryFlag/i.test(V.queue(c)[1]))&&_(c)){_(c).isAnimating=!1;var d=!(_(c).rootPropertyValueCache={});V.each(X.Lists.transforms3D,function(e,t){var i=/^scale/.test(t)?1:0,n=_(c).transformCache[t];_(c).transformCache[t]!==H&&new RegExp("^\\("+i+"[^.]").test(n)&&(d=!0,delete _(c).transformCache[t])}),o.mobileHA&&(d=!0,delete _(c).transformCache.translate3d),d&&X.flushTransformCache(c),X.Values.removeClass(c,"velocity-animating")}if(!t&&o.complete&&!o.loop&&s===l-1)try{o.complete.call(n,n)}catch(e){setTimeout(function(){throw e},1)}r&&!0!==o.loop&&r(n),_(c)&&!0===o.loop&&!t&&(V.each(_(c).tweensContainer,function(e,t){/^rotate/.test(e)&&360===parseFloat(t.endValue)&&(t.endValue=0,t.startValue=360),/^backgroundPosition/.test(e)&&100===parseFloat(t.endValue)&&"%"===t.unitType&&(t.endValue=0,t.startValue=100)}),Q(c,"reverse",{loop:!0,delay:o.delay})),!1!==o.queue&&V.dequeue(c,o.queue)}Q.State.calls[e]=!1;for(var u=0,p=Q.State.calls.length;u<p;u++)if(!1!==Q.State.calls[u]){a=!0;break}!1===a&&(Q.State.isTicking=!1,delete Q.State.calls,Q.State.calls=[])}var V,u=function(){if(W.documentMode)return W.documentMode;for(var e=7;4<e;e--){var t=W.createElement("div");if(t.innerHTML="\x3c!--[if IE "+e+"]><span></span><![endif]--\x3e",t.getElementsByTagName("span").length)return t=null,e}return H}(),t=(r=0,D.webkitRequestAnimationFrame||D.mozRequestAnimationFrame||function(e){var t,i=(new Date).getTime();return t=Math.max(0,16-(i-r)),r=i+t,setTimeout(function(){e(i+t)},t)}),R={isString:function(e){return"string"==typeof e},isArray:Array.isArray||function(e){return"[object Array]"===Object.prototype.toString.call(e)},isFunction:function(e){return"[object Function]"===Object.prototype.toString.call(e)},isNode:function(e){return e&&e.nodeType},isNodeList:function(e){return"object"==typeof e&&/^\[object (HTMLCollection|NodeList|Object)\]$/.test(Object.prototype.toString.call(e))&&e.length!==H&&(0===e.length||"object"==typeof e[0]&&0<e[0].nodeType)},isWrapped:function(e){return e&&(e.jquery||D.Zepto&&D.Zepto.zepto.isZ(e))},isSVG:function(e){return D.SVGElement&&e instanceof D.SVGElement},isEmptyObject:function(e){for(var t in e)return!1;return!0}},i=!1,r;if(e.fn&&e.fn.jquery?(V=e,i=!0):V=D.Velocity.Utilities,u<=8&&!i)throw new Error("Velocity: IE8 and below require jQuery to be loaded before Velocity.");if(!(u<=7)){var y=400,a="swing",Q={State:{isMobile:/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent),isAndroid:/Android/i.test(navigator.userAgent),isGingerbread:/Android 2\.3\.[3-7]/i.test(navigator.userAgent),isChrome:D.chrome,isFirefox:/Firefox/i.test(navigator.userAgent),prefixElement:W.createElement("div"),prefixMatches:{},scrollAnchor:null,scrollPropertyLeft:null,scrollPropertyTop:null,isTicking:!1,calls:[]},CSS:{},Utilities:V,Redirects:{},Easings:{},Promise:D.Promise,defaults:{queue:"",duration:y,easing:a,begin:H,complete:H,progress:H,display:H,visibility:H,loop:!1,delay:!1,mobileHA:!0,_cacheValues:!0},init:function(e){V.data(e,"velocity",{isSVG:R.isSVG(e),isAnimating:!1,computedStyle:null,tweensContainer:null,rootPropertyValueCache:{},transformCache:{}})},hook:null,mock:!1,version:{major:1,minor:2,patch:2},debug:!1};D.pageYOffset!==H?(Q.State.scrollAnchor=D,Q.State.scrollPropertyLeft="pageXOffset",Q.State.scrollPropertyTop="pageYOffset"):(Q.State.scrollAnchor=W.documentElement||W.body.parentNode||W.body,Q.State.scrollPropertyLeft="scrollLeft",Q.State.scrollPropertyTop="scrollTop");var s=function(){function l(e){return-e.tension*e.x-e.friction*e.v}function c(e,t,i){var n={x:e.x+i.dx*t,v:e.v+i.dv*t,tension:e.tension,friction:e.friction};return{dx:n.v,dv:l(n)}}function p(e,t){var i={dx:e.v,dv:l(e)},n=c(e,.5*t,i),o=c(e,.5*t,n),r=c(e,t,o),a=1/6*(i.dx+2*(n.dx+o.dx)+r.dx),s=1/6*(i.dv+2*(n.dv+o.dv)+r.dv);return e.x=e.x+a*t,e.v=e.v+s*t,e}return function e(t,i,n){var o,r,a,s={x:-1,v:0,tension:null,friction:null},l=[0],c=0,d=1e-4,u=.016;for(t=parseFloat(t)||500,i=parseFloat(i)||20,n=n||null,s.tension=t,s.friction=i,r=(o=null!==n)?(c=e(t,i))/n*u:u;a=p(a||s,r),l.push(1+a.x),c+=16,Math.abs(a.x)>d&&Math.abs(a.v)>d;);return o?function(e){return l[e*(l.length-1)|0]}:c}}();Q.Easings={linear:function(e){return e},swing:function(e){return.5-Math.cos(e*Math.PI)/2},spring:function(e){return 1-Math.cos(4.5*e*Math.PI)*Math.exp(6*-e)}},V.each([["ease",[.25,.1,.25,1]],["ease-in",[.42,0,1,1]],["ease-out",[0,0,.58,1]],["ease-in-out",[.42,0,.58,1]],["easeInSine",[.47,0,.745,.715]],["easeOutSine",[.39,.575,.565,1]],["easeInOutSine",[.445,.05,.55,.95]],["easeInQuad",[.55,.085,.68,.53]],["easeOutQuad",[.25,.46,.45,.94]],["easeInOutQuad",[.455,.03,.515,.955]],["easeInCubic",[.55,.055,.675,.19]],["easeOutCubic",[.215,.61,.355,1]],["easeInOutCubic",[.645,.045,.355,1]],["easeInQuart",[.895,.03,.685,.22]],["easeOutQuart",[.165,.84,.44,1]],["easeInOutQuart",[.77,0,.175,1]],["easeInQuint",[.755,.05,.855,.06]],["easeOutQuint",[.23,1,.32,1]],["easeInOutQuint",[.86,0,.07,1]],["easeInExpo",[.95,.05,.795,.035]],["easeOutExpo",[.19,1,.22,1]],["easeInOutExpo",[1,0,0,1]],["easeInCirc",[.6,.04,.98,.335]],["easeOutCirc",[.075,.82,.165,1]],["easeInOutCirc",[.785,.135,.15,.86]]],function(e,t){Q.Easings[t[0]]=o.apply(null,t[1])});var X=Q.CSS={RegEx:{isHex:/^#([A-f\d]{3}){1,2}$/i,valueUnwrap:/^[A-z]+\((.*)\)$/i,wrappedValueAlreadyExtracted:/[0-9.]+ [0-9.]+ [0-9.]+( [0-9.]+)?/,valueSplit:/([A-z]+\(.+\))|(([A-z0-9#-.]+?)(?=\s|$))/gi},Lists:{colors:["fill","stroke","stopColor","color","backgroundColor","borderColor","borderTopColor","borderRightColor","borderBottomColor","borderLeftColor","outlineColor"],transformsBase:["translateX","translateY","scale","scaleX","scaleY","skewX","skewY","rotateZ"],transforms3D:["transformPerspective","translateZ","scaleZ","rotateX","rotateY"]},Hooks:{templates:{textShadow:["Color X Y Blur","black 0px 0px 0px"],boxShadow:["Color X Y Blur Spread","black 0px 0px 0px 0px"],clip:["Top Right Bottom Left","0px 0px 0px 0px"],backgroundPosition:["X Y","0% 0%"],transformOrigin:["X Y Z","50% 50% 0px"],perspectiveOrigin:["X Y","50% 50%"]},registered:{},register:function(){for(var e=0;e<X.Lists.colors.length;e++){var t="color"===X.Lists.colors[e]?"0 0 0 1":"255 255 255 1";X.Hooks.templates[X.Lists.colors[e]]=["Red Green Blue Alpha",t]}var i,n,o;if(u)for(i in X.Hooks.templates){o=(n=X.Hooks.templates[i])[0].split(" ");var r=n[1].match(X.RegEx.valueSplit);"Color"===o[0]&&(o.push(o.shift()),r.push(r.shift()),X.Hooks.templates[i]=[o.join(" "),r.join(" ")])}for(i in X.Hooks.templates)for(var e in o=(n=X.Hooks.templates[i])[0].split(" ")){var a=i+o[e],s=e;X.Hooks.registered[a]=[i,s]}},getRoot:function(e){var t=X.Hooks.registered[e];return t?t[0]:e},cleanRootPropertyValue:function(e,t){return X.RegEx.valueUnwrap.test(t)&&(t=t.match(X.RegEx.valueUnwrap)[1]),X.Values.isCSSNullValue(t)&&(t=X.Hooks.templates[e][1]),t},extractValue:function(e,t){var i=X.Hooks.registered[e];if(i){var n=i[0],o=i[1];return(t=X.Hooks.cleanRootPropertyValue(n,t)).toString().match(X.RegEx.valueSplit)[o]}return t},injectValue:function(e,t,i){var n=X.Hooks.registered[e];if(n){var o,r,a=n[0],s=n[1];return(o=(i=X.Hooks.cleanRootPropertyValue(a,i)).toString().match(X.RegEx.valueSplit))[s]=t,r=o.join(" ")}return i}},Normalizations:{registered:{clip:function(e,t,i){switch(e){case"name":return"clip";case"extract":var n;return n=X.RegEx.wrappedValueAlreadyExtracted.test(i)?i:(n=i.toString().match(X.RegEx.valueUnwrap))?n[1].replace(/,(\s+)?/g," "):i;case"inject":return"rect("+i+")"}},blur:function(e,t,i){switch(e){case"name":return Q.State.isFirefox?"filter":"-webkit-filter";case"extract":var n=parseFloat(i);if(!n&&0!==n){var o=i.toString().match(/blur\(([0-9]+[A-z]+)\)/i);n=o?o[1]:0}return n;case"inject":return parseFloat(i)?"blur("+i+")":"none"}},opacity:function(e,t,i){if(u<=8)switch(e){case"name":return"filter";case"extract":var n=i.toString().match(/alpha\(opacity=(.*)\)/i);return i=n?n[1]/100:1;case"inject":return(t.style.zoom=1)<=parseFloat(i)?"":"alpha(opacity="+parseInt(100*parseFloat(i),10)+")"}else switch(e){case"name":return"opacity";case"extract":return i;case"inject":return i}}},register:function(){u<=9||Q.State.isGingerbread||(X.Lists.transformsBase=X.Lists.transformsBase.concat(X.Lists.transforms3D));for(var e=0;e<X.Lists.transformsBase.length;e++)!function(){var o=X.Lists.transformsBase[e];X.Normalizations.registered[o]=function(e,t,i){switch(e){case"name":return"transform";case"extract":return _(t)===H||_(t).transformCache[o]===H?/^scale/i.test(o)?1:0:_(t).transformCache[o].replace(/[()]/g,"");case"inject":var n=!1;switch(o.substr(0,o.length-1)){case"translate":n=!/(%|px|em|rem|vw|vh|\d)$/i.test(i);break;case"scal":case"scale":Q.State.isAndroid&&_(t).transformCache[o]===H&&i<1&&(i=1),n=!/(\d)$/i.test(i);break;case"skew":n=!/(deg|\d)$/i.test(i);break;case"rotate":n=!/(deg|\d)$/i.test(i)}return n||(_(t).transformCache[o]="("+i+")"),_(t).transformCache[o]}}}();for(var e=0;e<X.Lists.colors.length;e++)!function(){var a=X.Lists.colors[e];X.Normalizations.registered[a]=function(e,t,i){switch(e){case"name":return a;case"extract":var n;if(X.RegEx.wrappedValueAlreadyExtracted.test(i))n=i;else{var o,r={black:"rgb(0, 0, 0)",blue:"rgb(0, 0, 255)",gray:"rgb(128, 128, 128)",green:"rgb(0, 128, 0)",red:"rgb(255, 0, 0)",white:"rgb(255, 255, 255)"};/^[A-z]+$/i.test(i)?o=r[i]!==H?r[i]:r.black:X.RegEx.isHex.test(i)?o="rgb("+X.Values.hexToRgb(i).join(" ")+")":/^rgba?\(/i.test(i)||(o=r.black),n=(o||i).toString().match(X.RegEx.valueUnwrap)[1].replace(/,(\s+)?/g," ")}return u<=8||3!==n.split(" ").length||(n+=" 1"),n;case"inject":return u<=8?4===i.split(" ").length&&(i=i.split(/\s+/).slice(0,3).join(" ")):3===i.split(" ").length&&(i+=" 1"),(u<=8?"rgb":"rgba")+"("+i.replace(/\s+/g,",").replace(/\.(\d)+(?=,)/g,"")+")"}}}()}},Names:{camelCase:function(e){return e.replace(/-(\w)/g,function(e,t){return t.toUpperCase()})},SVGAttribute:function(e){var t="width|height|x|y|cx|cy|r|rx|ry|x1|x2|y1|y2";return(u||Q.State.isAndroid&&!Q.State.isChrome)&&(t+="|transform"),new RegExp("^("+t+")$","i").test(e)},prefixCheck:function(e){if(Q.State.prefixMatches[e])return[Q.State.prefixMatches[e],!0];for(var t=["","Webkit","Moz","ms","O"],i=0,n=t.length;i<n;i++){var o;if(o=0===i?e:t[i]+e.replace(/^\w/,function(e){return e.toUpperCase()}),R.isString(Q.State.prefixElement.style[o]))return[Q.State.prefixMatches[e]=o,!0]}return[e,!1]}},Values:{hexToRgb:function(e){var t,i=/^#?([a-f\d])([a-f\d])([a-f\d])$/i,n=/^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i;return e=e.replace(i,function(e,t,i,n){return t+t+i+i+n+n}),(t=n.exec(e))?[parseInt(t[1],16),parseInt(t[2],16),parseInt(t[3],16)]:[0,0,0]},isCSSNullValue:function(e){return 0==e||/^(none|auto|transparent|(rgba\(0, ?0, ?0, ?0\)))$/i.test(e)},getUnitType:function(e){return/^(rotate|skew)/i.test(e)?"deg":/(^(scale|scaleX|scaleY|scaleZ|alpha|flexGrow|flexHeight|zIndex|fontWeight)$)|((opacity|red|green|blue|alpha)$)/i.test(e)?"":"px"},getDisplayType:function(e){var t=e&&e.tagName.toString().toLowerCase();return/^(b|big|i|small|tt|abbr|acronym|cite|code|dfn|em|kbd|strong|samp|var|a|bdo|br|img|map|object|q|script|span|sub|sup|button|input|label|select|textarea)$/i.test(t)?"inline":/^(li)$/i.test(t)?"list-item":/^(tr)$/i.test(t)?"table-row":/^(table)$/i.test(t)?"table":/^(tbody)$/i.test(t)?"table-row-group":"block"},addClass:function(e,t){e.classList?e.classList.add(t):e.className+=(e.className.length?" ":"")+t},removeClass:function(e,t){e.classList?e.classList.remove(t):e.className=e.className.toString().replace(new RegExp("(^|\\s)"+t.split(" ").join("|")+"(\\s|$)","gi")," ")}},getPropertyValue:function(e,t,i,c){function d(e,t){function i(){o&&X.setPropertyValue(e,"display","none")}var n=0;if(u<=8)n=V.css(e,t);else{var o=!1,r;if(/^(width|height)$/.test(t)&&0===X.getPropertyValue(e,"display")&&(o=!0,X.setPropertyValue(e,"display",X.Values.getDisplayType(e))),!c){if("height"===t&&"border-box"!==X.getPropertyValue(e,"boxSizing").toString().toLowerCase()){var a=e.offsetHeight-(parseFloat(X.getPropertyValue(e,"borderTopWidth"))||0)-(parseFloat(X.getPropertyValue(e,"borderBottomWidth"))||0)-(parseFloat(X.getPropertyValue(e,"paddingTop"))||0)-(parseFloat(X.getPropertyValue(e,"paddingBottom"))||0);return i(),a}if("width"===t&&"border-box"!==X.getPropertyValue(e,"boxSizing").toString().toLowerCase()){var s=e.offsetWidth-(parseFloat(X.getPropertyValue(e,"borderLeftWidth"))||0)-(parseFloat(X.getPropertyValue(e,"borderRightWidth"))||0)-(parseFloat(X.getPropertyValue(e,"paddingLeft"))||0)-(parseFloat(X.getPropertyValue(e,"paddingRight"))||0);return i(),s}}r=_(e)===H?D.getComputedStyle(e,null):_(e).computedStyle?_(e).computedStyle:_(e).computedStyle=D.getComputedStyle(e,null),"borderColor"===t&&(t="borderTopColor"),(""===(n=9===u&&"filter"===t?r.getPropertyValue(t):r[t])||null===n)&&(n=e.style[t]),i()}if("auto"===n&&/^(top|right|bottom|left)$/i.test(t)){var l=d(e,"position");("fixed"===l||"absolute"===l&&/top|left/i.test(t))&&(n=V(e).position()[t]+"px")}return n}var n;if(X.Hooks.registered[t]){var o=t,r=X.Hooks.getRoot(o);i===H&&(i=X.getPropertyValue(e,X.Names.prefixCheck(r)[0])),X.Normalizations.registered[r]&&(i=X.Normalizations.registered[r]("extract",e,i)),n=X.Hooks.extractValue(o,i)}else if(X.Normalizations.registered[t]){var a,s;"transform"!==(a=X.Normalizations.registered[t]("name",e))&&(s=d(e,X.Names.prefixCheck(a)[0]),X.Values.isCSSNullValue(s)&&X.Hooks.templates[t]&&(s=X.Hooks.templates[t][1])),n=X.Normalizations.registered[t]("extract",e,s)}if(!/^[\d-]/.test(n))if(_(e)&&_(e).isSVG&&X.Names.SVGAttribute(t))if(/^(height|width)$/i.test(t))try{n=e.getBBox()[t]}catch(e){n=0}else n=e.getAttribute(t);else n=d(e,X.Names.prefixCheck(t)[0]);return X.Values.isCSSNullValue(n)&&(n=0),2<=Q.debug&&console.log("Get "+t+": "+n),n},setPropertyValue:function(e,t,i,n,o){var r=t;if("scroll"===t)o.container?o.container["scroll"+o.direction]=i:"Left"===o.direction?D.scrollTo(i,o.alternateValue):D.scrollTo(o.alternateValue,i);else if(X.Normalizations.registered[t]&&"transform"===X.Normalizations.registered[t]("name",e))X.Normalizations.registered[t]("inject",e,i),r="transform",i=_(e).transformCache[t];else{if(X.Hooks.registered[t]){var a=t,s=X.Hooks.getRoot(t);n=n||X.getPropertyValue(e,s),i=X.Hooks.injectValue(a,i,n),t=s}if(X.Normalizations.registered[t]&&(i=X.Normalizations.registered[t]("inject",e,i),t=X.Normalizations.registered[t]("name",e)),r=X.Names.prefixCheck(t)[0],u<=8)try{e.style[r]=i}catch(e){Q.debug&&console.log("Browser does not support ["+i+"] for ["+r+"]")}else _(e)&&_(e).isSVG&&X.Names.SVGAttribute(t)?e.setAttribute(t,i):e.style[r]=i;2<=Q.debug&&console.log("Set "+t+" ("+r+"): "+i)}return[r,i]},flushTransformCache:function(t){function e(e){return parseFloat(X.getPropertyValue(t,e))}var i="";if((u||Q.State.isAndroid&&!Q.State.isChrome)&&_(t).isSVG){var n={translate:[e("translateX"),e("translateY")],skewX:[e("skewX")],skewY:[e("skewY")],scale:1!==e("scale")?[e("scale"),e("scale")]:[e("scaleX"),e("scaleY")],rotate:[e("rotateZ"),0,0]};V.each(_(t).transformCache,function(e){/^translate/i.test(e)?e="translate":/^scale/i.test(e)?e="scale":/^rotate/i.test(e)&&(e="rotate"),n[e]&&(i+=e+"("+n[e].join(" ")+") ",delete n[e])})}else{var o,r;V.each(_(t).transformCache,function(e){return o=_(t).transformCache[e],"transformPerspective"===e?(r=o,!0):(9===u&&"rotateZ"===e&&(e="rotate"),void(i+=e+o+" "))}),r&&(i="perspective"+r+" "+i)}X.setPropertyValue(t,"transform",i)}};X.Hooks.register(),X.Normalizations.register(),Q.hook=function(e,n,o){var r=H;return e=g(e),V.each(e,function(e,t){if(_(t)===H&&Q.init(t),o===H)r===H&&(r=Q.CSS.getPropertyValue(t,n));else{var i=Q.CSS.setPropertyValue(t,n,o);"transform"===i[0]&&Q.CSS.flushTransformCache(t),r=i}}),r};var b=function(e){function t(){return n?M.promise||null:o}function i(){function i(e){function u(e,t){var i=H,n=H,o=H;return R.isArray(e)?(i=e[0],!R.isArray(e[1])&&/^[\d-]/.test(e[1])||R.isFunction(e[1])||X.RegEx.isHex.test(e[1])?o=e[1]:(R.isString(e[1])&&!X.RegEx.isHex.test(e[1])||R.isArray(e[1]))&&(n=t?e[1]:L(e[1],P.duration),e[2]!==H&&(o=e[2]))):i=e,t||(n=n||P.easing),R.isFunction(i)&&(i=i.call(C,I,$)),R.isFunction(o)&&(o=o.call(C,I,$)),[i||0,n,o]}function t(e,t){var i,n;return n=(t||"0").toString().toLowerCase().replace(/[%A-z]+$/,function(e){return i=e,""}),i||(i=X.Values.getUnitType(e)),[n,i]}function i(){var e={myParent:C.parentNode||W.body,position:X.getPropertyValue(C,"position"),fontSize:X.getPropertyValue(C,"fontSize")},t=e.position===z.lastPosition&&e.myParent===z.lastParent,i=e.fontSize===z.lastFontSize;z.lastParent=e.myParent,z.lastPosition=e.position,z.lastFontSize=e.fontSize;var n=100,o={};if(i&&t)o.emToPx=z.lastEmToPx,o.percentToPxWidth=z.lastPercentToPxWidth,o.percentToPxHeight=z.lastPercentToPxHeight;else{var r=_(C).isSVG?W.createElementNS("http://www.w3.org/2000/svg","rect"):W.createElement("div");Q.init(r),e.myParent.appendChild(r),V.each(["overflow","overflowX","overflowY"],function(e,t){Q.CSS.setPropertyValue(r,t,"hidden")}),Q.CSS.setPropertyValue(r,"position",e.position),Q.CSS.setPropertyValue(r,"fontSize",e.fontSize),Q.CSS.setPropertyValue(r,"boxSizing","content-box"),V.each(["minWidth","maxWidth","width","minHeight","maxHeight","height"],function(e,t){Q.CSS.setPropertyValue(r,t,"100%")}),Q.CSS.setPropertyValue(r,"paddingLeft","100em"),o.percentToPxWidth=z.lastPercentToPxWidth=(parseFloat(X.getPropertyValue(r,"width",null,!0))||1)/n,o.percentToPxHeight=z.lastPercentToPxHeight=(parseFloat(X.getPropertyValue(r,"height",null,!0))||1)/n,o.emToPx=z.lastEmToPx=(parseFloat(X.getPropertyValue(r,"paddingLeft"))||1)/n,e.myParent.removeChild(r)}return null===z.remToPx&&(z.remToPx=parseFloat(X.getPropertyValue(W.body,"fontSize"))||16),null===z.vwToPx&&(z.vwToPx=parseFloat(D.innerWidth)/100,z.vhToPx=parseFloat(D.innerHeight)/100),o.remToPx=z.remToPx,o.vwToPx=z.vwToPx,o.vhToPx=z.vhToPx,1<=Q.debug&&console.log("Unit ratios: "+JSON.stringify(o),C),o}if(P.begin&&0===I)try{P.begin.call(q,q)}catch(e){setTimeout(function(){throw e},1)}if("scroll"===j){var n,o,r,a=/^x$/i.test(P.axis)?"Left":"Top",s=parseFloat(P.offset)||0;P.container?R.isWrapped(P.container)||R.isNode(P.container)?(P.container=P.container[0]||P.container,r=(n=P.container["scroll"+a])+V(C).position()[a.toLowerCase()]+s):P.container=null:(n=Q.State.scrollAnchor[Q.State["scrollProperty"+a]],o=Q.State.scrollAnchor[Q.State["scrollProperty"+("Left"===a?"Top":"Left")]],r=V(C).offset()[a.toLowerCase()]+s),A={scroll:{rootPropertyValue:!1,startValue:n,currentValue:n,endValue:r,unitType:"",easing:P.easing,scrollData:{container:P.container,direction:a,alternateValue:o}},element:C},Q.debug&&console.log("tweensContainer (scroll): ",A.scroll,C)}else if("reverse"===j){if(!_(C).tweensContainer)return void V.dequeue(C,P.queue);"none"===_(C).opts.display&&(_(C).opts.display="auto"),"hidden"===_(C).opts.visibility&&(_(C).opts.visibility="visible"),_(C).opts.loop=!1,_(C).opts.begin=null,_(C).opts.complete=null,E.easing||delete P.easing,E.duration||delete P.duration,P=V.extend({},_(C).opts,P);var l=V.extend(!0,{},_(C).tweensContainer);for(var c in l)if("element"!==c){var d=l[c].startValue;l[c].startValue=l[c].currentValue=l[c].endValue,l[c].endValue=d,R.isEmptyObject(E)||(l[c].easing=P.easing),Q.debug&&console.log("reverse tweensContainer ("+c+"): "+JSON.stringify(l[c]),C)}A=l}else if("start"===j){var l;for(var p in _(C).tweensContainer&&!0===_(C).isAnimating&&(l=_(C).tweensContainer),V.each(O,function(e,t){if(RegExp("^"+X.Lists.colors.join("$|^")+"$").test(e)){var i=u(t,!0),n=i[0],o=i[1],r=i[2];if(X.RegEx.isHex.test(n)){for(var a=["Red","Green","Blue"],s=X.Values.hexToRgb(n),l=r?X.Values.hexToRgb(r):H,c=0;c<a.length;c++){var d=[s[c]];o&&d.push(o),l!==H&&d.push(l[c]),O[e+a[c]]=d}delete O[e]}}}),O){var f=u(O[p]),h=f[0],v=f[1],m=f[2];p=X.Names.camelCase(p);var g=X.Hooks.getRoot(p),y=!1;if(_(C).isSVG||"tween"===g||!1!==X.Names.prefixCheck(g)[1]||X.Normalizations.registered[g]!==H){(P.display!==H&&null!==P.display&&"none"!==P.display||P.visibility!==H&&"hidden"!==P.visibility)&&/opacity|filter/.test(p)&&!m&&0!==h&&(m=0),P._cacheValues&&l&&l[p]?(m===H&&(m=l[p].endValue+l[p].unitType),y=_(C).rootPropertyValueCache[g]):X.Hooks.registered[p]?m===H?(y=X.getPropertyValue(C,g),m=X.getPropertyValue(C,p,y)):y=X.Hooks.templates[g][1]:m===H&&(m=X.getPropertyValue(C,p));var b,w,k,x=!1;if(m=(b=t(p,m))[0],k=b[1],h=(b=t(p,h))[0].replace(/^([+-\/*])=/,function(e,t){return x=t,""}),w=b[1],m=parseFloat(m)||0,h=parseFloat(h)||0,"%"===w&&(/^(fontSize|lineHeight)$/.test(p)?(h/=100,w="em"):/^scale/.test(p)?(h/=100,w=""):/(Red|Green|Blue)$/i.test(p)&&(
h=h/100*255,w="")),/[\/*]/.test(x))w=k;else if(k!==w&&0!==m)if(0===h)w=k;else{S=S||i();var T=/margin|padding|left|right|width|text|word|letter/i.test(p)||/X$/.test(p)||"x"===p?"x":"y";switch(k){case"%":m*="x"===T?S.percentToPxWidth:S.percentToPxHeight;break;case"px":break;default:m*=S[k+"ToPx"]}switch(w){case"%":m*=1/("x"===T?S.percentToPxWidth:S.percentToPxHeight);break;case"px":break;default:m*=1/S[w+"ToPx"]}}switch(x){case"+":h=m+h;break;case"-":h=m-h;break;case"*":h*=m;break;case"/":h=m/h}A[p]={rootPropertyValue:y,startValue:m,currentValue:m,endValue:h,unitType:w,easing:v},Q.debug&&console.log("tweensContainer ("+p+"): "+JSON.stringify(A[p]),C)}else Q.debug&&console.log("Skipping ["+g+"] due to a lack of browser support.")}A.element=C}A.element&&(X.Values.addClass(C,"velocity-animating"),F.push(A),""===P.queue&&(_(C).tweensContainer=A,_(C).opts=P),_(C).isAnimating=!0,I===$-1?(Q.State.calls.push([F,q,P,null,M.resolver]),!1===Q.State.isTicking&&(Q.State.isTicking=!0,N())):I++)}var S,C=this,P=V.extend({},Q.defaults,E),A={};switch(_(C)===H&&Q.init(C),parseFloat(P.delay)&&!1!==P.queue&&V.queue(C,P.queue,function(e){Q.velocityQueueEntryFlag=!0,_(C).delayTimer={setTimeout:setTimeout(e,parseFloat(P.delay)),next:e}}),P.duration.toString().toLowerCase()){case"fast":P.duration=200;break;case"normal":P.duration=y;break;case"slow":P.duration=600;break;default:P.duration=parseFloat(P.duration)||1}!1!==Q.mock&&(!0===Q.mock?P.duration=P.delay=1:(P.duration*=parseFloat(Q.mock)||1,P.delay*=parseFloat(Q.mock)||1)),P.easing=L(P.easing,P.duration),P.begin&&!R.isFunction(P.begin)&&(P.begin=null),P.progress&&!R.isFunction(P.progress)&&(P.progress=null),P.complete&&!R.isFunction(P.complete)&&(P.complete=null),P.display!==H&&null!==P.display&&(P.display=P.display.toString().toLowerCase(),"auto"===P.display&&(P.display=Q.CSS.Values.getDisplayType(C))),P.visibility!==H&&null!==P.visibility&&(P.visibility=P.visibility.toString().toLowerCase()),P.mobileHA=P.mobileHA&&Q.State.isMobile&&!Q.State.isGingerbread,!1===P.queue?P.delay?setTimeout(i,P.delay):i():V.queue(C,P.queue,function(e,t){return!0===t?(M.promise&&M.resolver(q),!0):(Q.velocityQueueEntryFlag=!0,void i(e))}),""!==P.queue&&"fx"!==P.queue||"inprogress"===V.queue(C)[0]||V.dequeue(C)}var n,o,r,q,O,E,a=e&&(e.p||V.isPlainObject(e.properties)&&!e.properties.names||R.isString(e.properties));if(R.isWrapped(this)?(n=!1,r=0,o=q=this):(n=!0,r=1,q=a?e.elements||e.e:e),q=g(q)){E=a?(O=e.properties||e.p,e.options||e.o):(O=arguments[r],arguments[r+1]);var $=q.length,I=0;if(!/^(stop|finish)$/i.test(O)&&!V.isPlainObject(E)){var s;E={};for(var l=r+1;l<arguments.length;l++)R.isArray(arguments[l])||!/^(fast|normal|slow)$/i.test(arguments[l])&&!/^\d/.test(arguments[l])?R.isString(arguments[l])||R.isArray(arguments[l])?E.easing=arguments[l]:R.isFunction(arguments[l])&&(E.complete=arguments[l]):E.duration=arguments[l]}var M={promise:null,resolver:null,rejecter:null},j;switch(n&&Q.Promise&&(M.promise=new Q.Promise(function(e,t){M.resolver=e,M.rejecter=t})),O){case"scroll":j="scroll";break;case"reverse":j="reverse";break;case"finish":case"stop":V.each(q,function(e,t){_(t)&&_(t).delayTimer&&(clearTimeout(_(t).delayTimer.setTimeout),_(t).delayTimer.next&&_(t).delayTimer.next(),delete _(t).delayTimer)});var c=[];return V.each(Q.State.calls,function(o,r){r&&V.each(r[1],function(e,i){var n=E===H?"":E;return!0!==n&&r[2].queue!==n&&(E!==H||!1!==r[2].queue)||void V.each(q,function(e,t){t===i&&((!0===E||R.isString(E))&&(V.each(V.queue(t,R.isString(E)?E:""),function(e,t){R.isFunction(t)&&t(null,!0)}),V.queue(t,R.isString(E)?E:"",[])),"stop"===O?(_(t)&&_(t).tweensContainer&&!1!==n&&V.each(_(t).tweensContainer,function(e,t){t.endValue=t.currentValue}),c.push(o)):"finish"===O&&(r[2].duration=1))})})}),"stop"===O&&(V.each(c,function(e,t){P(t,!0)}),M.promise&&M.resolver(q)),t();default:if(!V.isPlainObject(O)||R.isEmptyObject(O)){if(R.isString(O)&&Q.Redirects[O]){var d,u=(d=V.extend({},E)).duration,p=d.delay||0;return!0===d.backwards&&(q=V.extend(!0,[],q).reverse()),V.each(q,function(e,t){parseFloat(d.stagger)?d.delay=p+parseFloat(d.stagger)*e:R.isFunction(d.stagger)&&(d.delay=p+d.stagger.call(t,e,$)),d.drag&&(d.duration=parseFloat(u)||(/^(callout|transition)/.test(O)?1e3:y),d.duration=Math.max(d.duration*(d.backwards?1-e/$:(e+1)/$),.75*d.duration,200)),Q.Redirects[O].call(t,t,d||{},e,$,q,M.promise?M:H)}),t()}var f="Velocity: First argument ("+O+") was not a property map, a known action, or a registered redirect. Aborting.";return M.promise?M.rejecter(new Error(f)):console.log(f),t()}j="start"}var z={lastParent:null,lastPosition:null,lastFontSize:null,lastPercentToPxWidth:null,lastPercentToPxHeight:null,lastEmToPx:null,remToPx:null,vwToPx:null,vhToPx:null},F=[],h,d;if(V.each(q,function(e,t){R.isNode(t)&&i.call(t)}),(d=V.extend({},Q.defaults,E)).loop=parseInt(d.loop),h=2*d.loop-1,d.loop)for(var v=0;v<h;v++){var m={delay:d.delay,progress:d.progress};v===h-1&&(m.display=d.display,m.visibility=d.visibility,m.complete=d.complete),b(q,"reverse",m)}return t()}};(Q=V.extend(b,Q)).animate=b;var A=D.requestAnimationFrame||t;return Q.State.isMobile||W.hidden===H||W.addEventListener("visibilitychange",function(){W.hidden?(A=function(e){return setTimeout(function(){e(!0)},16)},N()):A=D.requestAnimationFrame||t}),e.Velocity=Q,e!==D&&(e.fn.velocity=b,e.fn.velocity.defaults=Q.defaults),V.each(["Down","Up"],function(e,u){Q.Redirects["slide"+u]=function(i,e,t,n,o,r){var a=V.extend({},e),s=a.begin,l=a.complete,c={height:"",marginTop:"",marginBottom:"",paddingTop:"",paddingBottom:""},d={};a.display===H&&(a.display="Down"===u?"inline"===Q.CSS.Values.getDisplayType(i)?"inline-block":"block":"none"),a.begin=function(){for(var e in s&&s.call(o,o),c){d[e]=i.style[e];var t=Q.CSS.getPropertyValue(i,e);c[e]="Down"===u?[t,0]:[0,t]}d.overflow=i.style.overflow,i.style.overflow="hidden"},a.complete=function(){for(var e in d)i.style[e]=d[e];l&&l.call(o,o),r&&r.resolver(o)},Q(i,c,a)}}),V.each(["In","Out"],function(e,c){Q.Redirects["fade"+c]=function(e,t,i,n,o,r){var a=V.extend({},t),s={opacity:"In"===c?1:0},l=a.complete;a.complete=i!==n-1?a.begin=null:function(){l&&l.call(o,o),r&&r.resolver(o)},a.display===H&&(a.display="In"===c?"auto":"none"),Q(this,s,a)}}),Q}jQuery.fn.velocity=jQuery.fn.animate}(window.jQuery||window.Zepto||window,window,document)})),function(e,n,t,u){"use strict";function l(e,t,i){return setTimeout(c(e,i),t)}function i(e,t,i){return!!Array.isArray(e)&&(o(e,i[t],i),!0)}function o(e,t,i){var n;if(e)if(e.forEach)e.forEach(t,i);else if(e.length!==u)for(n=0;n<e.length;)t.call(i,e[n],n,e),n++;else for(n in e)e.hasOwnProperty(n)&&t.call(i,e[n],n,e)}function r(e,t,i){for(var n=Object.keys(t),o=0;o<n.length;)(!i||i&&e[n[o]]===u)&&(e[n[o]]=t[n[o]]),o++;return e}function a(e,t){return r(e,t,!0)}function s(e,t,i){var n,o=t.prototype;(n=e.prototype=Object.create(o)).constructor=e,n._super=o,i&&r(n,i)}function c(e,t){return function(){return e.apply(t,arguments)}}function d(e,t){return typeof e==de?e.apply(t&&t[0]||u,t):e}function p(e,t){return e===u?t:e}function f(t,e,i){o(g(e),function(e){t.addEventListener(e,i,!1)})}function h(t,e,i){o(g(e),function(e){t.removeEventListener(e,i,!1)})}function v(e,t){for(;e;){if(e==t)return!0;e=e.parentNode}return!1}function m(e,t){return-1<e.indexOf(t)}function g(e){return e.trim().split(/\s+/g)}function y(e,t,i){if(e.indexOf&&!i)return e.indexOf(t);for(var n=0;n<e.length;){if(i&&e[n][i]==t||!i&&e[n]===t)return n;n++}return-1}function b(e){return Array.prototype.slice.call(e,0)}function w(e,i,t){for(var n=[],o=[],r=0;r<e.length;){var a=i?e[r][i]:e[r];y(o,a)<0&&n.push(e[r]),o[r]=a,r++}return t&&(n=i?n.sort(function(e,t){return e[i]>t[i]}):n.sort()),n}function k(e,t){for(var i,n,o=t[0].toUpperCase()+t.slice(1),r=0;r<le.length;){if((n=(i=le[r])?i+o:t)in e)return n;r++}return u}function x(){return he++}function T(e){var t=e.ownerDocument;return t.defaultView||t.parentWindow}function S(t,e){var i=this;this.manager=t,this.callback=e,this.element=t.element,this.target=t.options.inputTarget,this.domHandler=function(e){d(t.options.enable,[t])&&i.handler(e)},this.init()}function C(e){var t,i=e.options.inputClass;return new(t=i||(ge?H:ye?N:me?R:W))(e,P)}function P(e,t,i){var n=i.pointers.length,o=i.changedPointers.length,r=t&Se&&0==n-o,a=t&(Pe|Ae)&&0==n-o;i.isFirst=!!r,i.isFinal=!!a,r&&(e.session={}),i.eventType=t,A(e,i),e.emit("hammer.input",i),e.recognize(i),e.session.prevInput=i}function A(e,t){var i=e.session,n=t.pointers,o=n.length;i.firstInput||(i.firstInput=E(t)),1<o&&!i.firstMultiple?i.firstMultiple=E(t):1===o&&(i.firstMultiple=!1);var r=i.firstInput,a=i.firstMultiple,s=a?a.center:r.center,l=t.center=$(n);t.timeStamp=fe(),t.deltaTime=t.timeStamp-r.timeStamp,t.angle=z(s,l),t.distance=j(s,l),q(i,t),t.offsetDirection=M(t.deltaX,t.deltaY),t.scale=a?D(a.pointers,n):1,t.rotation=a?F(a.pointers,n):0,O(i,t);var c=e.element;v(t.srcEvent.target,c)&&(c=t.srcEvent.target),t.target=c}function q(e,t){var i=t.center,n=e.offsetDelta||{},o=e.prevDelta||{},r=e.prevInput||{};(t.eventType===Se||r.eventType===Pe)&&(o=e.prevDelta={x:r.deltaX||0,y:r.deltaY||0},n=e.offsetDelta={x:i.x,y:i.y}),t.deltaX=o.x+(i.x-n.x),t.deltaY=o.y+(i.y-n.y)}function O(e,t){var i,n,o,r,a=e.lastInterval||t,s=t.timeStamp-a.timeStamp;if(t.eventType!=Ae&&(Te<s||a.velocity===u)){var l=a.deltaX-t.deltaX,c=a.deltaY-t.deltaY,d=I(s,l,c);n=d.x,o=d.y,i=pe(d.x)>pe(d.y)?d.x:d.y,r=M(l,c),e.lastInterval=t}else i=a.velocity,n=a.velocityX,o=a.velocityY,r=a.direction;t.velocity=i,t.velocityX=n,t.velocityY=o,t.direction=r}function E(e){for(var t=[],i=0;i<e.pointers.length;)t[i]={clientX:ue(e.pointers[i].clientX),clientY:ue(e.pointers[i].clientY)},i++;return{timeStamp:fe(),pointers:t,center:$(t),deltaX:e.deltaX,deltaY:e.deltaY}}function $(e){var t=e.length;if(1===t)return{x:ue(e[0].clientX),y:ue(e[0].clientY)};for(var i=0,n=0,o=0;o<t;)i+=e[o].clientX,n+=e[o].clientY,o++;return{x:ue(i/t),y:ue(n/t)}}function I(e,t,i){return{x:t/e||0,y:i/e||0}}function M(e,t){return e===t?qe:pe(e)>=pe(t)?0<e?Oe:Ee:0<t?$e:Ie}function j(e,t,i){i||(i=Fe);var n=t[i[0]]-e[i[0]],o=t[i[1]]-e[i[1]];return Math.sqrt(n*n+o*o)}function z(e,t,i){i||(i=Fe);var n=t[i[0]]-e[i[0]],o=t[i[1]]-e[i[1]];return 180*Math.atan2(o,n)/Math.PI}function F(e,t){return z(t[1],t[0],De)-z(e[1],e[0],De)}function D(e,t){return j(t[0],t[1],De)/j(e[0],e[1],De)}function W(){this.evEl=He,this.evWin=_e,this.allow=!0,this.pressed=!1,S.apply(this,arguments)}function H(){this.evEl=Ve,this.evWin=Re,S.apply(this,arguments),this.store=this.manager.session.pointerEvents=[]}function _(){this.evTarget=Xe,this.evWin=Ye,this.started=!1,S.apply(this,arguments)}function L(e,t){var i=b(e.touches),n=b(e.changedTouches);return t&(Pe|Ae)&&(i=w(i.concat(n),"identifier",!0)),[i,n]}function N(){this.evTarget=Ue,this.targetIds={},S.apply(this,arguments)}function V(e,t){var i=b(e.touches),n=this.targetIds;if(t&(2|Se)&&1===i.length)return n[i[0].identifier]=!0,[i,i];var o,r,a=b(e.changedTouches),s=[],l=this.target;if(r=i.filter(function(e){return v(e.target,l)}),t===Se)for(o=0;o<r.length;)n[r[o].identifier]=!0,o++;for(o=0;o<a.length;)n[a[o].identifier]&&s.push(a[o]),t&(Pe|Ae)&&delete n[a[o].identifier],o++;return s.length?[w(r.concat(s),"identifier",!0),s]:void 0}function R(){S.apply(this,arguments);var e=c(this.handler,this);this.touch=new N(this.manager,e),this.mouse=new W(this.manager,e)}function Q(e,t){this.manager=e,this.set(t)}function X(e){if(m(e,tt))return tt;var t=m(e,it),i=m(e,nt);return t&&i?it+" "+nt:t||i?t?it:nt:m(e,et)?et:Ke}function Y(e){this.id=x(),this.manager=null,this.options=a(e||{},this.defaults),this.options.enable=p(this.options.enable,!0),this.state=ot,this.simultaneous={},this.requireFail=[]}function B(e){return e&ct?"cancel":e&st?"end":e&at?"move":e&rt?"start":""}function U(e){return e==Ie?"down":e==$e?"up":e==Oe?"left":e==Ee?"right":""}function G(e,t){var i=t.manager;return i?i.get(e):e}function Z(){Y.apply(this,arguments)}function J(){Z.apply(this,arguments),this.pX=null,this.pY=null}function K(){Z.apply(this,arguments)}function ee(){Y.apply(this,arguments),this._timer=null,this._input=null}function te(){Z.apply(this,arguments)}function ie(){Z.apply(this,arguments)}function ne(){Y.apply(this,arguments),this.pTime=!1,this.pCenter=!1,this._timer=null,this._input=null,this.count=0}function oe(e,t){return(t=t||{}).recognizers=p(t.recognizers,oe.defaults.preset),new re(e,t)}function re(e,t){t=t||{},this.options=a(t,oe.defaults),this.options.inputTarget=this.options.inputTarget||e,this.handlers={},this.session={},this.recognizers=[],this.element=e,this.input=C(this),this.touchAction=new Q(this,this.options.touchAction),ae(this,!0),o(t.recognizers,function(e){var t=this.add(new e[0](e[1]));e[2]&&t.recognizeWith(e[2]),e[3]&&t.requireFailure(e[3])},this)}function ae(e,i){var n=e.element;o(e.options.cssProps,function(e,t){n.style[k(n.style,t)]=i?e:""})}function se(e,t){var i=n.createEvent("Event");i.initEvent(e,!0,!0),(i.gesture=t).target.dispatchEvent(i)}var le=["","webkit","moz","MS","ms","o"],ce=n.createElement("div"),de="function",ue=Math.round,pe=Math.abs,fe=Date.now,he=1,ve=/mobile|tablet|ip(ad|hone|od)|android/i,me="ontouchstart"in e,ge=k(e,"PointerEvent")!==u,ye=me&&ve.test(navigator.userAgent),be="touch",we="pen",ke="mouse",xe="kinect",Te=25,Se=1,Ce=2,Pe=4,Ae=8,qe=1,Oe=2,Ee=4,$e=8,Ie=16,Me=Oe|Ee,je=$e|Ie,ze=Me|je,Fe=["x","y"],De=["clientX","clientY"];S.prototype={handler:function(){},init:function(){this.evEl&&f(this.element,this.evEl,this.domHandler),this.evTarget&&f(this.target,this.evTarget,this.domHandler),this.evWin&&f(T(this.element),this.evWin,this.domHandler)},destroy:function(){this.evEl&&h(this.element,this.evEl,this.domHandler),this.evTarget&&h(this.target,this.evTarget,this.domHandler),this.evWin&&h(T(this.element),this.evWin,this.domHandler)}};var We={mousedown:Se,mousemove:2,mouseup:Pe},He="mousedown",_e="mousemove mouseup";s(W,S,{handler:function(e){var t=We[e.type];t&Se&&0===e.button&&(this.pressed=!0),2&t&&1!==e.which&&(t=Pe),this.pressed&&this.allow&&(t&Pe&&(this.pressed=!1),this.callback(this.manager,t,{pointers:[e],changedPointers:[e],pointerType:ke,srcEvent:e}))}});var Le={pointerdown:Se,pointermove:2,pointerup:Pe,pointercancel:Ae,pointerout:Ae},Ne={2:be,3:we,4:ke,5:xe},Ve="pointerdown",Re="pointermove pointerup pointercancel";e.MSPointerEvent&&(Ve="MSPointerDown",Re="MSPointerMove MSPointerUp MSPointerCancel"),s(H,S,{handler:function(e){var t=this.store,i=!1,n=e.type.toLowerCase().replace("ms",""),o=Le[n],r=Ne[e.pointerType]||e.pointerType,a=r==be,s=y(t,e.pointerId,"pointerId");o&Se&&(0===e.button||a)?s<0&&(t.push(e),s=t.length-1):o&(Pe|Ae)&&(i=!0),s<0||(t[s]=e,this.callback(this.manager,o,{pointers:t,changedPointers:[e],pointerType:r,srcEvent:e}),i&&t.splice(s,1))}});var Qe={touchstart:Se,touchmove:2,touchend:Pe,touchcancel:Ae},Xe="touchstart",Ye="touchstart touchmove touchend touchcancel";s(_,S,{handler:function(e){var t=Qe[e.type];if(t===Se&&(this.started=!0),this.started){var i=L.call(this,e,t);t&(Pe|Ae)&&0==i[0].length-i[1].length&&(this.started=!1),this.callback(this.manager,t,{pointers:i[0],changedPointers:i[1],pointerType:be,srcEvent:e})}}});var Be={touchstart:Se,touchmove:2,touchend:Pe,touchcancel:Ae},Ue="touchstart touchmove touchend touchcancel";s(N,S,{handler:function(e){var t=Be[e.type],i=V.call(this,e,t);i&&this.callback(this.manager,t,{pointers:i[0],changedPointers:i[1],pointerType:be,srcEvent:e})}}),s(R,S,{handler:function(e,t,i){var n=i.pointerType==be,o=i.pointerType==ke;if(n)this.mouse.allow=!1;else if(o&&!this.mouse.allow)return;t&(Pe|Ae)&&(this.mouse.allow=!0),this.callback(e,t,i)},destroy:function(){this.touch.destroy(),this.mouse.destroy()}});var Ge=k(ce.style,"touchAction"),Ze=Ge!==u,Je="compute",Ke="auto",et="manipulation",tt="none",it="pan-x",nt="pan-y";Q.prototype={set:function(e){e==Je&&(e=this.compute()),Ze&&(this.manager.element.style[Ge]=e),this.actions=e.toLowerCase().trim()},update:function(){this.set(this.manager.options.touchAction)},compute:function(){var t=[];return o(this.manager.recognizers,function(e){d(e.options.enable,[e])&&(t=t.concat(e.getTouchAction()))}),X(t.join(" "))},preventDefaults:function(e){if(!Ze){var t=e.srcEvent,i=e.offsetDirection;if(this.manager.session.prevented)return void t.preventDefault();var n=this.actions,o=m(n,tt),r=m(n,nt),a=m(n,it);return o||r&&i&Me||a&&i&je?this.preventSrc(t):void 0}},preventSrc:function(e){this.manager.session.prevented=!0,e.preventDefault()}};var ot=1,rt=2,at=4,st=8,lt=st,ct=16,dt=32;Y.prototype={defaults:{},set:function(e){return r(this.options,e),this.manager&&this.manager.touchAction.update(),this},recognizeWith:function(e){if(i(e,"recognizeWith",this))return this;var t=this.simultaneous;return t[(e=G(e,this)).id]||(t[e.id]=e).recognizeWith(this),this},dropRecognizeWith:function(e){return i(e,"dropRecognizeWith",this)||(e=G(e,this),delete this.simultaneous[e.id]),this},requireFailure:function(e){if(i(e,"requireFailure",this))return this;var t=this.requireFail;return-1===y(t,e=G(e,this))&&(t.push(e),e.requireFailure(this)),this},dropRequireFailure:function(e){if(i(e,"dropRequireFailure",this))return this;e=G(e,this);var t=y(this.requireFail,e);return-1<t&&this.requireFail.splice(t,1),this},hasRequireFailures:function(){return 0<this.requireFail.length},canRecognizeWith:function(e){return!!this.simultaneous[e.id]},emit:function(t){function e(e){i.manager.emit(i.options.event+(e?B(n):""),t)}var i=this,n=this.state;n<st&&e(!0),e(),st<=n&&e(!0)},tryEmit:function(e){return this.canEmit()?this.emit(e):void(this.state=32)},canEmit:function(){for(var e=0;e<this.requireFail.length;){if(!(this.requireFail[e].state&(32|ot)))return!1;e++}return!0},recognize:function(e){var t=r({},e);return d(this.options.enable,[this,t])?(this.state&(lt|ct|32)&&(this.state=ot),this.state=this.process(t),void(this.state&(rt|at|st|ct)&&this.tryEmit(t))):(this.reset(),void(this.state=32))},process:function(){},getTouchAction:function(){},reset:function(){}},s(Z,Y,{defaults:{pointers:1},attrTest:function(e){var t=this.options.pointers;return 0===t||e.pointers.length===t},process:function(e){var t=this.state,i=e.eventType,n=t&(rt|at),o=this.attrTest(e);return n&&(i&Ae||!o)?t|ct:n||o?i&Pe?t|st:t&rt?t|at:rt:32}}),s(J,Z,{defaults:{event:"pan",threshold:10,pointers:1,direction:ze},getTouchAction:function(){var e=this.options.direction,t=[];return e&Me&&t.push(nt),e&je&&t.push(it),t},directionTest:function(e){var t=this.options,i=!0,n=e.distance,o=e.direction,r=e.deltaX,a=e.deltaY;return o&t.direction||(n=t.direction&Me?(o=0===r?qe:r<0?Oe:Ee,i=r!=this.pX,Math.abs(e.deltaX)):(o=0===a?qe:a<0?$e:Ie,i=a!=this.pY,Math.abs(e.deltaY))),e.direction=o,i&&n>t.threshold&&o&t.direction},attrTest:function(e){return Z.prototype.attrTest.call(this,e)&&(this.state&rt||!(this.state&rt)&&this.directionTest(e))},emit:function(e){this.pX=e.deltaX,this.pY=e.deltaY;var t=U(e.direction);t&&this.manager.emit(this.options.event+t,e),this._super.emit.call(this,e)}}),s(K,Z,{defaults:{event:"pinch",threshold:0,pointers:2},getTouchAction:function(){return[tt]},attrTest:function(e){return this._super.attrTest.call(this,e)&&(Math.abs(e.scale-1)>this.options.threshold||this.state&rt)},emit:function(e){if(this._super.emit.call(this,e),1!==e.scale){var t=e.scale<1?"in":"out";this.manager.emit(this.options.event+t,e)}}}),s(ee,Y,{defaults:{event:"press",pointers:1,time:500,threshold:5},getTouchAction:function(){return[Ke]},process:function(e){var t=this.options,i=e.pointers.length===t.pointers,n=e.distance<t.threshold,o=e.deltaTime>t.time;if(this._input=e,!n||!i||e.eventType&(Pe|Ae)&&!o)this.reset();else if(e.eventType&Se)this.reset(),this._timer=l(function(){this.state=lt,this.tryEmit()},t.time,this);else if(e.eventType&Pe)return lt;return 32},reset:function(){clearTimeout(this._timer)},emit:function(e){this.state===lt&&(e&&e.eventType&Pe?this.manager.emit(this.options.event+"up",e):(this._input.timeStamp=fe(),this.manager.emit(this.options.event,this._input)))}}),s(te,Z,{defaults:{event:"rotate",threshold:0,pointers:2},getTouchAction:function(){return[tt]},attrTest:function(e){return this._super.attrTest.call(this,e)&&(Math.abs(e.rotation)>this.options.threshold||this.state&rt)}}),s(ie,Z,{defaults:{event:"swipe",threshold:10,velocity:.65,direction:Me|je,pointers:1},getTouchAction:function(){return J.prototype.getTouchAction.call(this)},attrTest:function(e){var t,i=this.options.direction;return i&(Me|je)?t=e.velocity:i&Me?t=e.velocityX:i&je&&(t=e.velocityY),this._super.attrTest.call(this,e)&&i&e.direction&&e.distance>this.options.threshold&&pe(t)>this.options.velocity&&e.eventType&Pe},emit:function(e){var t=U(e.direction);t&&this.manager.emit(this.options.event+t,e),this.manager.emit(this.options.event,e)}}),s(ne,Y,{defaults:{event:"tap",pointers:1,taps:1,interval:300,time:250,threshold:2,posThreshold:10},getTouchAction:function(){return[et]},process:function(e){var t=this.options,i=e.pointers.length===t.pointers,n=e.distance<t.threshold,o=e.deltaTime<t.time;if(this.reset(),e.eventType&Se&&0===this.count)return this.failTimeout();if(n&&o&&i){if(e.eventType!=Pe)return this.failTimeout();var r=!this.pTime||e.timeStamp-this.pTime<t.interval,a=!this.pCenter||j(this.pCenter,e.center)<t.posThreshold,s;if(this.pTime=e.timeStamp,this.pCenter=e.center,a&&r?this.count+=1:this.count=1,this._input=e,0===this.count%t.taps)return this.hasRequireFailures()?(this._timer=l(function(){this.state=lt,this.tryEmit()},t.interval,this),rt):lt}return 32},failTimeout:function(){return this._timer=l(function(){this.state=32},this.options.interval,this),32},reset:function(){clearTimeout(this._timer)},emit:function(){this.state==lt&&(this._input.tapCount=this.count,this.manager.emit(this.options.event,this._input))}}),oe.VERSION="2.0.4",oe.defaults={domEvents:!1,touchAction:Je,enable:!0,inputTarget:null,inputClass:null,preset:[[te,{enable:!1}],[K,{enable:!1},["rotate"]],[ie,{direction:Me}],[J,{direction:Me},["swipe"]],[ne],[ne,{event:"doubletap",taps:2},["tap"]],[ee]],cssProps:{userSelect:"default",touchSelect:"none",touchCallout:"none",contentZooming:"none",userDrag:"none",tapHighlightColor:"rgba(0,0,0,0)"}};var ut=1,pt=2;re.prototype={set:function(e){return r(this.options,e),e.touchAction&&this.touchAction.update(),e.inputTarget&&(this.input.destroy(),this.input.target=e.inputTarget,this.input.init()),this},stop:function(e){this.session.stopped=e?2:1},recognize:function(e){var t=this.session;if(!t.stopped){this.touchAction.preventDefaults(e);var i,n=this.recognizers,o=t.curRecognizer;(!o||o&&o.state&lt)&&(o=t.curRecognizer=null);for(var r=0;r<n.length;)i=n[r],2===t.stopped||o&&i!=o&&!i.canRecognizeWith(o)?i.reset():i.recognize(e),!o&&i.state&(rt|at|st)&&(o=t.curRecognizer=i),r++}},get:function(e){if(e instanceof Y)return e;for(var t=this.recognizers,i=0;i<t.length;i++)if(t[i].options.event==e)return t[i];return null},add:function(e){if(i(e,"add",this))return this;var t=this.get(e.options.event);return t&&this.remove(t),this.recognizers.push(e),(e.manager=this).touchAction.update(),e},remove:function(e){if(i(e,"remove",this))return this;var t=this.recognizers;return e=this.get(e),t.splice(y(t,e),1),this.touchAction.update(),this},on:function(e,t){var i=this.handlers;return o(g(e),function(e){i[e]=i[e]||[],i[e].push(t)}),this},off:function(e,t){var i=this.handlers;return o(g(e),function(e){t?i[e].splice(y(i[e],t),1):delete i[e]}),this},emit:function(e,t){this.options.domEvents&&se(e,t);var i=this.handlers[e]&&this.handlers[e].slice();if(i&&i.length){t.type=e,t.preventDefault=function(){t.srcEvent.preventDefault()};for(var n=0;n<i.length;)i[n](t),n++}},destroy:function(){this.element&&ae(this,!1),this.handlers={},this.session={},this.input.destroy(),this.element=null}},r(oe,{INPUT_START:Se,INPUT_MOVE:2,INPUT_END:Pe,INPUT_CANCEL:Ae,STATE_POSSIBLE:ot,STATE_BEGAN:rt,STATE_CHANGED:at,STATE_ENDED:st,STATE_RECOGNIZED:lt,STATE_CANCELLED:ct,STATE_FAILED:32,DIRECTION_NONE:qe,DIRECTION_LEFT:Oe,DIRECTION_RIGHT:Ee,DIRECTION_UP:$e,DIRECTION_DOWN:Ie,DIRECTION_HORIZONTAL:Me,DIRECTION_VERTICAL:je,DIRECTION_ALL:ze,Manager:re,Input:S,TouchAction:Q,TouchInput:N,MouseInput:W,PointerEventInput:H,TouchMouseInput:R,SingleTouchInput:_,Recognizer:Y,AttrRecognizer:Z,Tap:ne,Pan:J,Swipe:ie,Pinch:K,Rotate:te,Press:ee,on:f,off:h,each:o,merge:a,extend:r,inherit:s,bindFn:c,prefixed:k}),typeof define==de&&define.amd?define(function(){return oe}):"undefined"!=typeof module&&module.exports?module.exports=oe:e[t]=oe}(window,document,"Hammer"),function(e){"function"==typeof define&&define.amd?define(["jquery","hammerjs"],e):"object"==typeof exports?e(require("jquery"),require("hammerjs")):e(jQuery,Hammer)}(function(n,o){function t(e,t){var i=n(e);i.data("hammer")||i.data("hammer",new o(i[0],t))}var i;n.fn.hammer=function(e){return this.each(function(){t(this,e)})},o.Manager.prototype.emit=(i=o.Manager.prototype.emit,function(e,t){i.call(this,e,t),n(this.element).trigger({type:e,gesture:t})})}),function(e){e.Package?Materialize={}:e.Materialize={}}(window),function(e){for(var n=0,t=["webkit","moz"],i=e.requestAnimationFrame,o=e.cancelAnimationFrame,r=t.length;0<=--r&&!i;)i=e[t[r]+"RequestAnimationFrame"],o=e[t[r]+"CancelRequestAnimationFrame"];i&&o||(i=function(e){var t=+Date.now(),i=Math.max(n+16,t);return setTimeout(function(){e(n=i)},i-t)},o=clearTimeout),e.requestAnimationFrame=i,e.cancelAnimationFrame=o}(window),Materialize.objectSelectorString=function(e){var t,i,n;return((e.prop("tagName")||"")+(e.attr("id")||"")+(e.attr("class")||"")).replace(/\s/g,"")},Materialize.guid=function(){function e(){return Math.floor(65536*(1+Math.random())).toString(16).substring(1)}return function(){return e()+e()+"-"+e()+"-"+e()+"-"+e()+"-"+e()+e()+e()}}(),Materialize.escapeHash=function(e){return e.replace(/(:|\.|\[|\]|,|=)/g,"\\$1")},Materialize.elementOrParentIsFixed=function(e){var t=$(e),i=t.add(t.parents()),n=!1;return i.each(function(){if("fixed"===$(this).css("position"))return!(n=!0)}),n};var getTime=Date.now||function(){return(new Date).getTime()},Vel;Materialize.throttle=function(i,n,o){var r,a,s,l=null,c=0;o||(o={});var d=function(){c=!1===o.leading?0:getTime(),l=null,s=i.apply(r,a),r=a=null};return function(){var e=getTime();c||!1!==o.leading||(c=e);var t=n-(e-c);return r=this,a=arguments,t<=0?(clearTimeout(l),l=null,c=e,s=i.apply(r,a),r=a=null):l||!1===o.trailing||(l=setTimeout(d,t)),s}},Vel=jQuery?jQuery.Velocity:$?$.Velocity:Velocity,function(h){h.fn.collapsible=function(u,p){var e={accordion:void 0,onOpen:void 0,onClose:void 0},f=u;return u=h.extend(e,u),this.each(function(){function i(e){l=t.find("> li > .collapsible-header"),e.hasClass("active")?e.parent().addClass("active"):e.parent().removeClass("active"),e.parent().hasClass("active")?e.siblings(".collapsible-body").stop(!0,!1).slideDown({duration:350,easing:"easeOutQuart",queue:!1,complete:function(){h(this).css("height","")}}):e.siblings(".collapsible-body").stop(!0,!1).slideUp({duration:350,easing:"easeOutQuart",queue:!1,complete:function(){h(this).css("height","")}}),l.not(e).removeClass("active").parent().removeClass("active"),l.not(e).parent().children(".collapsible-body").stop(!0,!1).each(function(){h(this).is(":visible")&&h(this).slideUp({duration:350,easing:"easeOutQuart",queue:!1,complete:function(){h(this).css("height",""),r(h(this).siblings(".collapsible-header"))}})})}function n(e){e.hasClass("active")?e.parent().addClass("active"):e.parent().removeClass("active"),e.parent().hasClass("active")?e.siblings(".collapsible-body").stop(!0,!1).slideDown({duration:350,easing:"easeOutQuart",queue:!1,complete:function(){h(this).css("height","")}}):e.siblings(".collapsible-body").stop(!0,!1).slideUp({duration:350,easing:"easeOutQuart",queue:!1,complete:function(){h(this).css("height","")}})}function o(e,t){t||e.toggleClass("active"),u.accordion||"accordion"===c||void 0===c?i(e):n(e),r(e)}function r(e){e.hasClass("active")?"function"==typeof u.onOpen&&u.onOpen.call(this,e.parent()):"function"==typeof u.onClose&&u.onClose.call(this,e.parent())}function a(e){var t;return 0<s(e).length}function s(e){return e.closest("li > .collapsible-header")}function e(){t.off("click.collapse","> li > .collapsible-header")}var t=h(this),l=h(this).find("> li > .collapsible-header"),c=t.data("collapsible");if("destroy"!==f)if(0<=p&&p<l.length){var d=l.eq(p);d.length&&("open"===f||"close"===f&&d.hasClass("active"))&&o(d)}else e(),t.on("click.collapse","> li > .collapsible-header",function(e){var t=h(e.target);a(t)&&(t=s(t)),o(t)}),u.accordion||"accordion"===c||void 0===c?o(l.filter(".active").first(),!0):l.filter(".active").each(function(){o(h(this),!0)});else e()})},h(document).ready(function(){h(".collapsible").collapsible()})}(jQuery),function(w){w.fn.scrollTo=function(e){return w(this).scrollTop(w(this).scrollTop()-w(this).offset().top+w(e).offset().top),this},w.fn.dropdown=function(e){var t={inDuration:300,outDuration:225,constrainWidth:!0,hover:!1,gutter:0,belowOrigin:!1,alignment:"left",stopPropagation:!1};return"open"===e?(this.each(function(){w(this).trigger("open")}),!1):"close"===e?(this.each(function(){w(this).trigger("close")}),!1):void this.each(function(){function h(){void 0!==m.data("induration")&&(g.inDuration=m.data("induration")),void 0!==m.data("outduration")&&(g.outDuration=m.data("outduration")),void 0!==m.data("constrainwidth")&&(g.constrainWidth=m.data("constrainwidth")),void 0!==m.data("hover")&&(g.hover=m.data("hover")),void 0!==m.data("gutter")&&(g.gutter=m.data("gutter")),void 0!==m.data("beloworigin")&&(g.belowOrigin=m.data("beloworigin")),void 0!==m.data("alignment")&&(g.alignment=m.data("alignment")),void 0!==m.data("stoppropagation")&&(g.stopPropagation=m.data("stoppropagation"))}function i(e){"focus"===e&&(y=!0),h(),b.addClass("active"),m.addClass("active"),!0===g.constrainWidth?b.css("width",m.outerWidth()):b.css("white-space","nowrap");var t=window.innerHeight,i=m.innerHeight(),n=m.offset().left,o=m.offset().top-w(window).scrollTop(),r=g.alignment,a=0,s=0,l=0;!0===g.belowOrigin&&(l=i);var c=0,d=0,u=m.parent();if(u.is("body")||(u[0].scrollHeight>u[0].clientHeight&&(c=u[0].scrollTop),u[0].scrollWidth>u[0].clientWidth&&(d=u[0].scrollLeft)),n+b.innerWidth()>w(window).width()?r="right":n-b.innerWidth()+m.innerWidth()<0&&(r="left"),o+b.innerHeight()>t)if(o+i-b.innerHeight()<0){var p=t-o-l;b.css("max-height",p)}else l||(l+=i),l-=b.innerHeight();if("left"===r)a=g.gutter,s=m.position().left+a;else if("right"===r){var f;s=m.position().left+m.outerWidth()-b.outerWidth()+(a=-g.gutter)}b.css({position:"absolute",top:m.position().top+l+c,left:s+d}),b.stop(!0,!0).css("opacity",0).slideDown({queue:!1,duration:g.inDuration,easing:"easeOutCubic",complete:function(){w(this).css("height","")}}).animate({opacity:1},{queue:!1,duration:g.inDuration,easing:"easeOutSine"}),setTimeout(function(){w(document).bind("click."+b.attr("id"),function(e){v(),w(document).unbind("click."+b.attr("id"))})},0)}function v(){y=!1,b.fadeOut(g.outDuration),b.removeClass("active"),m.removeClass("active"),w(document).unbind("click."+b.attr("id")),setTimeout(function(){b.css("max-height","")},g.outDuration)}var m=w(this),g=w.extend({},t,e),y=!1,b=w("#"+m.attr("data-activates"));if(h(),m.after(b),g.hover){var n=!1;m.unbind("click."+m.attr("id")),m.on("mouseenter",function(e){!1===n&&(i(),n=!0)}),m.on("mouseleave",function(e){var t=e.toElement||e.relatedTarget;w(t).closest(".dropdown-content").is(b)||(b.stop(!0,!0),v(),n=!1)}),b.on("mouseleave",function(e){var t=e.toElement||e.relatedTarget;w(t).closest(".dropdown-button").is(m)||(b.stop(!0,!0),v(),n=!1)})}else m.unbind("click."+m.attr("id")),m.bind("click."+m.attr("id"),function(e){y||(m[0]!=e.currentTarget||m.hasClass("active")||0!==w(e.target).closest(".dropdown-content").length?m.hasClass("active")&&(v(),w(document).unbind("click."+b.attr("id"))):(e.preventDefault(),g.stopPropagation&&e.stopPropagation(),i("click")))});m.on("open",function(e,t){i(t)}),m.on("close",v)})},w(document).ready(function(){w(".dropdown-button").dropdown()})}(jQuery),
function(c){var d=0,e=0,u=function(){return"materialize-modal-overlay-"+ ++e},t={init:function(l){var e={opacity:.5,inDuration:350,outDuration:250,ready:void 0,complete:void 0,dismissible:!0,startingTop:"4%",endingTop:"10%"};return l=c.extend(e,l),this.each(function(){var a=c(this),e=c(this).attr("id")||"#"+c(this).data("target"),s=function(){var e=a.data("overlay-id"),t=c("#"+e);a.removeClass("open"),c("body").css({overflow:"",width:""}),a.find(".modal-close").off("click.close"),c(document).off("keyup.modal"+e),t.velocity({opacity:0},{duration:l.outDuration,queue:!1,ease:"easeOutQuart"});var i={duration:l.outDuration,queue:!1,ease:"easeOutCubic",complete:function(){c(this).css({display:"none"}),"function"==typeof l.complete&&l.complete.call(this,a),t.remove(),d--}};a.hasClass("bottom-sheet")?a.velocity({bottom:"-100%",opacity:0},i):a.velocity({top:l.startingTop,opacity:0,scaleX:.7},i)},t=function(e){var t=c("body"),i=t.innerWidth();if(t.css("overflow","hidden"),t.width(i),!a.hasClass("open")){var n=u(),o=c('<div class="modal-overlay"></div>');lStack=++d,o.attr("id",n).css("z-index",1e3+2*lStack),a.data("overlay-id",n).css("z-index",1e3+2*lStack+1),a.addClass("open"),c("body").append(o),l.dismissible&&(o.click(function(){s()}),c(document).on("keyup.modal"+n,function(e){27===e.keyCode&&s()})),a.find(".modal-close").on("click.close",function(e){s()}),o.css({display:"block",opacity:0}),a.css({display:"block",opacity:0}),o.velocity({opacity:l.opacity},{duration:l.inDuration,queue:!1,ease:"easeOutCubic"}),a.data("associated-overlay",o[0]);var r={duration:l.inDuration,queue:!1,ease:"easeOutCubic",complete:function(){"function"==typeof l.ready&&l.ready.call(this,a,e)}};a.hasClass("bottom-sheet")?a.velocity({bottom:"0",opacity:1},r):(c.Velocity.hook(a,"scaleX",.7),a.css({top:l.startingTop}),a.velocity({top:l.endingTop,opacity:1,scaleX:"1"},r))}};c(document).off("click.modalTrigger",'a[href="#'+e+'"], [data-target="'+e+'"]'),c(this).off("openModal"),c(this).off("closeModal"),c(document).on("click.modalTrigger",'a[href="#'+e+'"], [data-target="'+e+'"]',function(e){l.startingTop=(c(this).offset().top-c(window).scrollTop())/1.15,t(c(this)),e.preventDefault()}),c(this).on("openModal",function(){c(this).attr("href")||c(this).data("target"),t()}),c(this).on("closeModal",function(){s()})})},open:function(){c(this).trigger("openModal")},close:function(){c(this).trigger("closeModal")}};c.fn.modal=function(e){return t[e]?t[e].apply(this,Array.prototype.slice.call(arguments,1)):"object"!=typeof e&&e?void c.error("Method "+e+" does not exist on jQuery.modal"):t.init.apply(this,arguments)}}(jQuery),function(k){k.fn.materialbox=function(){return this.each(function(){function h(){y=!1;var e=w.parent(".material-placeholder"),t=(window.innerWidth,window.innerHeight,w.data("width")),i=w.data("height");w.velocity("stop",!0),k("#materialbox-overlay").velocity("stop",!0),k(".materialbox-caption").velocity("stop",!0),k("#materialbox-overlay").velocity({opacity:0},{duration:n,queue:!1,easing:"easeOutQuad",complete:function(){g=!1,k(this).remove()}}),w.velocity({width:t,height:i,left:0,top:0},{duration:n,queue:!1,easing:"easeOutQuad",complete:function(){e.css({height:"",width:"",position:"",top:"",left:""}),w.removeAttr("style"),w.attr("style",o),w.removeClass("active"),y=!0,v&&v.css("overflow","")}}),k(".materialbox-caption").velocity({opacity:0},{duration:n,queue:!1,easing:"easeOutQuad",complete:function(){k(this).remove()}})}if(!k(this).hasClass("initialized")){k(this).addClass("initialized");var v,m,g=!1,y=!0,b=275,n=200,w=k(this),e=k("<div></div>").addClass("material-placeholder"),o=w.attr("style");w.wrap(e),w.on("click",function(){var e=w.parent(".material-placeholder"),t=window.innerWidth,i=window.innerHeight,n=w.width(),o=w.height();if(!1===y)return h(),!1;if(g&&!0===y)return h(),!1;for(y=!1,w.addClass("active"),g=!0,e.css({width:e[0].getBoundingClientRect().width,height:e[0].getBoundingClientRect().height,position:"relative",top:0,left:0}),v=void 0,m=e[0].parentNode;null!==m&&!k(m).is(document);){var r=k(m);"visible"!==r.css("overflow")&&(r.css("overflow","visible"),v=void 0===v?r:v.add(r)),m=m.parentNode}w.css({position:"absolute","z-index":1e3,"will-change":"left, top, width, height"}).data("width",n).data("height",o);var a=k('<div id="materialbox-overlay"></div>').css({opacity:0}).click(function(){!0===y&&h()});w.before(a);var s=a[0].getBoundingClientRect();if(a.css({width:t,height:i,left:-1*s.left,top:-1*s.top}),a.velocity({opacity:1},{duration:b,queue:!1,easing:"easeOutQuad"}),""!==w.data("caption")){var l=k('<div class="materialbox-caption"></div>');l.text(w.data("caption")),k("body").append(l),l.css({display:"inline"}),l.velocity({opacity:1},{duration:b,queue:!1,easing:"easeOutQuad"})}var c=0,d,u,p=0,f=0;f=o/i<n/t?(p=.9*t)*(c=o/n):(p=.9*i*(c=n/o),.9*i),w.hasClass("responsive-img")?w.velocity({"max-width":p,width:n},{duration:0,queue:!1,complete:function(){w.css({left:0,top:0}).velocity({height:f,width:p,left:k(document).scrollLeft()+t/2-w.parent(".material-placeholder").offset().left-p/2,top:k(document).scrollTop()+i/2-w.parent(".material-placeholder").offset().top-f/2},{duration:b,queue:!1,easing:"easeOutQuad",complete:function(){y=!0}})}}):w.css("left",0).css("top",0).velocity({height:f,width:p,left:k(document).scrollLeft()+t/2-w.parent(".material-placeholder").offset().left-p/2,top:k(document).scrollTop()+i/2-w.parent(".material-placeholder").offset().top-f/2},{duration:b,queue:!1,easing:"easeOutQuad",complete:function(){y=!0}})}),k(window).scroll(function(){g&&h()}),k(document).keyup(function(e){27===e.keyCode&&!0===y&&g&&h()})}})},k(document).ready(function(){k(".materialboxed").materialbox()})}(jQuery),function(h){h.fn.parallax=function(){var f=h(window).width();return this.each(function(e){function t(e){var t;t=f<601?0<p.height()?p.height():p.children("img").height():0<p.height()?p.height():500;var i=p.children("img").first(),n,o=i.height()-t,r=p.offset().top+t,a=p.offset().top,s=h(window).scrollTop(),l=window.innerHeight,c,d=(s+l-a)/(t+l),u=Math.round(o*d);e&&i.css("display","block"),s<r&&a<s+l&&i.css("transform","translate3D(-50%,"+u+"px, 0)")}var p=h(this);p.addClass("parallax"),p.children("img").one("load",function(){t(!0)}).each(function(){this.complete&&h(this).trigger("load")}),h(window).scroll(function(){f=h(window).width(),t(!1)}),h(window).resize(function(){f=h(window).width(),t(!1)})})}}(jQuery),function(k){var t={init:function(b){var e={onShow:null,swipeable:!1,responsiveThreshold:1/0};b=k.extend(e,b);var w=Materialize.objectSelectorString(k(this));return this.each(function(e){var i,n,o,t,r,a=w+e,s=k(this),l=k(window).width(),c=s.find("li.tab a"),d=s.width(),u=k(),p=Math.max(d,s[0].scrollWidth)/c.length,f=prev_index=0,h=!1,v=300,m=function(e){return Math.ceil(d-e.position().left-e.outerWidth()-s.scrollLeft())},g=function(e){return Math.floor(e.position().left+s.scrollLeft())},y=function(e){0<=f-e?(t.velocity({right:m(i)},{duration:v,queue:!1,easing:"easeOutQuad"}),t.velocity({left:g(i)},{duration:v,queue:!1,easing:"easeOutQuad",delay:90})):(t.velocity({left:g(i)},{duration:v,queue:!1,easing:"easeOutQuad"}),t.velocity({right:m(i)},{duration:v,queue:!1,easing:"easeOutQuad",delay:90}))};b.swipeable&&l>b.responsiveThreshold&&(b.swipeable=!1),0===(i=k(c.filter('[href="'+location.hash+'"]'))).length&&(i=k(this).find("li.tab a.active").first()),0===i.length&&(i=k(this).find("li.tab a").first()),i.addClass("active"),(f=c.index(i))<0&&(f=0),void 0!==i[0]&&(n=k(i[0].hash)).addClass("active"),s.find(".indicator").length||s.append('<div class="indicator"></div>'),t=s.find(".indicator"),s.append(t),s.is(":visible")&&setTimeout(function(){t.css({right:m(i)}),t.css({left:g(i)})},0),k(window).off("resize.tabs-"+a).on("resize.tabs-"+a,function(){d=s.width(),p=Math.max(d,s[0].scrollWidth)/c.length,f<0&&(f=0),0!==p&&0!==d&&(t.css({right:m(i)}),t.css({left:g(i)}))}),b.swipeable?(c.each(function(){var e=k(Materialize.escapeHash(this.hash));e.addClass("carousel-item"),u=u.add(e)}),o=u.wrapAll('<div class="tabs-content carousel"></div>'),u.css("display",""),k(".tabs-content.carousel").carousel({fullWidth:!0,noWrap:!0,onCycleTo:function(e){if(!h){var t=f;f=o.index(e),i=c.eq(f),y(t)}}})):c.not(i).each(function(){k(Materialize.escapeHash(this.hash)).hide()}),s.off("click.tabs").on("click.tabs","a",function(e){if(k(this).parent().hasClass("disabled"))e.preventDefault();else if(!k(this).attr("target")){h=!0,d=s.width(),p=Math.max(d,s[0].scrollWidth)/c.length,i.removeClass("active");var t=n;i=k(this),n=k(Materialize.escapeHash(this.hash)),c=s.find("li.tab a"),i.position(),i.addClass("active"),prev_index=f,(f=c.index(k(this)))<0&&(f=0),b.swipeable?u.length&&u.carousel("set",f):(void 0!==n&&(n.show(),n.addClass("active"),"function"==typeof b.onShow&&b.onShow.call(this,n)),void 0===t||t.is(n)||(t.hide(),t.removeClass("active"))),r=setTimeout(function(){h=!1},v),y(prev_index),e.preventDefault()}})})},select_tab:function(e){this.find('a[href="#'+e+'"]').trigger("click")}};k.fn.tabs=function(e){return t[e]?t[e].apply(this,Array.prototype.slice.call(arguments,1)):"object"!=typeof e&&e?void k.error("Method "+e+" does not exist on jQuery.tabs"):t.init.apply(this,arguments)},k(document).ready(function(){k("ul.tabs").tabs()})}(jQuery),function(s){s.fn.tooltip=function(a){var e=5,t={delay:350,tooltip:"",position:"bottom",html:!1};return"remove"===a?(this.each(function(){s("#"+s(this).attr("data-tooltip-id")).remove(),s(this).off("mouseenter.tooltip mouseleave.tooltip")}),!1):(a=s.extend(t,a),this.each(function(){var t=Materialize.guid(),h=s(this);h.attr("data-tooltip-id")&&s("#"+h.attr("data-tooltip-id")).remove(),h.attr("data-tooltip-id",t);var i,n,v,o,m,g,y=function(){i=h.attr("data-html")?"true"===h.attr("data-html"):a.html,n=void 0===(n=h.attr("data-delay"))||""===n?a.delay:n,v=void 0===(v=h.attr("data-position"))||""===v?a.position:v,o=void 0===(o=h.attr("data-tooltip"))||""===o?a.tooltip:o},e;y(),m=function(){var e=s('<div class="material-tooltip"></div>');return o=i?s("<span></span>").html(o):s("<span></span>").text(o),e.append(o).appendTo(s("body")).attr("id",t),(g=s('<div class="backdrop"></div>')).appendTo(e),e}(),h.off("mouseenter.tooltip mouseleave.tooltip");var r,b=!1;h.on({"mouseenter.tooltip":function(e){var t;r=setTimeout(function(){y(),b=!0,m.velocity("stop"),g.velocity("stop"),m.css({visibility:"visible",left:"0px",top:"0px"});var e,t,i,n=h.outerWidth(),o=h.outerHeight(),r=m.outerHeight(),a=m.outerWidth(),s="0px",l="0px",c=g[0].offsetWidth,d=g[0].offsetHeight,u=8,p=8,f=0;"top"===v?(e=h.offset().top-r-5,t=h.offset().left+n/2-a/2,i=w(t,e,a,r),s="-10px",g.css({bottom:0,left:0,borderRadius:"14px 14px 0 0",transformOrigin:"50% 100%",marginTop:r,marginLeft:a/2-c/2})):"left"===v?(e=h.offset().top+o/2-r/2,t=h.offset().left-a-5,i=w(t,e,a,r),l="-10px",g.css({top:"-7px",right:0,width:"14px",height:"14px",borderRadius:"14px 0 0 14px",transformOrigin:"95% 50%",marginTop:r/2,marginLeft:a})):"right"===v?(e=h.offset().top+o/2-r/2,t=h.offset().left+n+5,i=w(t,e,a,r),l="+10px",g.css({top:"-7px",left:0,width:"14px",height:"14px",borderRadius:"0 14px 14px 0",transformOrigin:"5% 50%",marginTop:r/2,marginLeft:"0px"})):(e=h.offset().top+h.outerHeight()+5,t=h.offset().left+n/2-a/2,i=w(t,e,a,r),s="+10px",g.css({top:0,left:0,marginLeft:a/2-c/2})),m.css({top:i.y,left:i.x}),u=Math.SQRT2*a/parseInt(c),p=Math.SQRT2*r/parseInt(d),f=Math.max(u,p),m.velocity({translateY:s,translateX:l},{duration:350,queue:!1}).velocity({opacity:1},{duration:300,delay:50,queue:!1}),g.css({visibility:"visible"}).velocity({opacity:1},{duration:55,delay:0,queue:!1}).velocity({scaleX:f,scaleY:f},{duration:300,delay:0,queue:!1,easing:"easeInOutQuad"})},n)},"mouseleave.tooltip":function(){b=!1,clearTimeout(r),setTimeout(function(){!0!==b&&(m.velocity({opacity:0,translateY:0,translateX:0},{duration:225,queue:!1}),g.velocity({opacity:0,scaleX:1,scaleY:1},{duration:225,queue:!1,complete:function(){g.css({visibility:"hidden"}),m.css({visibility:"hidden"}),b=!1}}))},225)}})}))};var w=function(e,t,i,n){var o=e,r=t;return o<0?o=4:o+i>window.innerWidth&&(o-=o+i-window.innerWidth),r<0?r=4:r+n>window.innerHeight+s(window).scrollTop&&(r-=r+n-window.innerHeight),{x:o,y:r}};s(document).ready(function(){s(".tooltipped").tooltip()})}(jQuery),function(i){"use strict";function t(e){return null!==e&&e===e.window}function r(e){return t(e)?e:9===e.nodeType&&e.defaultView}function c(e){var t,i,n={top:0,left:0},o=e&&e.ownerDocument;return t=o.documentElement,void 0!==e.getBoundingClientRect&&(n=e.getBoundingClientRect()),i=r(o),{top:n.top+i.pageYOffset-t.clientTop,left:n.left+i.pageXOffset-t.clientLeft}}function d(e){var t="";for(var i in e)e.hasOwnProperty(i)&&(t+=i+":"+e[i]+";");return t}function n(e){if(!1===p.allowEvent(e))return null;for(var t=null,i=e.target||e.srcElement;null!==i.parentElement;){if(!(i instanceof SVGElement||-1===i.className.indexOf("waves-effect"))){t=i;break}if(i.classList.contains("waves-effect")){t=i;break}i=i.parentElement}return t}function o(e){var t=n(e);null!==t&&(u.show(e,t),"ontouchstart"in i&&(t.addEventListener("touchend",u.hide,!1),t.addEventListener("touchcancel",u.hide,!1)),t.addEventListener("mouseup",u.hide,!1),t.addEventListener("mouseleave",u.hide,!1))}var e=e||{},a=document.querySelectorAll.bind(document),u={duration:750,show:function(e,t){if(2===e.button)return!1;var i=t||this,n=document.createElement("div");n.className="waves-ripple",i.appendChild(n);var o=c(i),r=e.pageY-o.top,a=e.pageX-o.left,s="scale("+i.clientWidth/100*10+")";"touches"in e&&(r=e.touches[0].pageY-o.top,a=e.touches[0].pageX-o.left),n.setAttribute("data-hold",Date.now()),n.setAttribute("data-scale",s),n.setAttribute("data-x",a),n.setAttribute("data-y",r);var l={top:r+"px",left:a+"px"};n.className=n.className+" waves-notransition",n.setAttribute("style",d(l)),n.className=n.className.replace("waves-notransition",""),l["-webkit-transform"]=s,l["-moz-transform"]=s,l["-ms-transform"]=s,l["-o-transform"]=s,l.transform=s,l.opacity="1",l["-webkit-transition-duration"]=u.duration+"ms",l["-moz-transition-duration"]=u.duration+"ms",l["-o-transition-duration"]=u.duration+"ms",l["transition-duration"]=u.duration+"ms",l["-webkit-transition-timing-function"]="cubic-bezier(0.250, 0.460, 0.450, 0.940)",l["-moz-transition-timing-function"]="cubic-bezier(0.250, 0.460, 0.450, 0.940)",l["-o-transition-timing-function"]="cubic-bezier(0.250, 0.460, 0.450, 0.940)",l["transition-timing-function"]="cubic-bezier(0.250, 0.460, 0.450, 0.940)",n.setAttribute("style",d(l))},hide:function(e){p.touchup(e);var t=this,i=(t.clientWidth,null),n=t.getElementsByClassName("waves-ripple");if(!(0<n.length))return!1;var o=(i=n[n.length-1]).getAttribute("data-x"),r=i.getAttribute("data-y"),a=i.getAttribute("data-scale"),s,l=350-(Date.now()-Number(i.getAttribute("data-hold")));l<0&&(l=0),setTimeout(function(){var e={top:r+"px",left:o+"px",opacity:"0","-webkit-transition-duration":u.duration+"ms","-moz-transition-duration":u.duration+"ms","-o-transition-duration":u.duration+"ms","transition-duration":u.duration+"ms","-webkit-transform":a,"-moz-transform":a,"-ms-transform":a,"-o-transform":a,transform:a};i.setAttribute("style",d(e)),setTimeout(function(){try{t.removeChild(i)}catch(e){return!1}},u.duration)},l)},wrapInput:function(e){for(var t=0;t<e.length;t++){var i=e[t];if("input"===i.tagName.toLowerCase()){var n=i.parentNode;if("i"===n.tagName.toLowerCase()&&-1!==n.className.indexOf("waves-effect"))continue;var o=document.createElement("i");o.className=i.className+" waves-input-wrapper";var r=i.getAttribute("style");r||(r=""),o.setAttribute("style",r),i.className="waves-button-input",i.removeAttribute("style"),n.replaceChild(o,i),o.appendChild(i)}}}},p={touches:0,allowEvent:function(e){var t=!0;return"touchstart"===e.type?p.touches+=1:"touchend"===e.type||"touchcancel"===e.type?setTimeout(function(){0<p.touches&&(p.touches-=1)},500):"mousedown"===e.type&&0<p.touches&&(t=!1),t},touchup:function(e){p.allowEvent(e)}};e.displayEffect=function(e){"duration"in(e=e||{})&&(u.duration=e.duration),u.wrapInput(a(".waves-effect")),"ontouchstart"in i&&document.body.addEventListener("touchstart",o,!1),document.body.addEventListener("mousedown",o,!1)},e.attach=function(e){"input"===e.tagName.toLowerCase()&&(u.wrapInput([e]),e=e.parentElement),"ontouchstart"in i&&e.addEventListener("touchstart",o,!1),e.addEventListener("mousedown",o,!1)},i.Waves=e,document.addEventListener("DOMContentLoaded",function(){e.displayEffect()},!1)}(window),Materialize.toast=function(e,t,a,s){function i(e){var o=document.createElement("div");if(o.classList.add("toast"),a)for(var t=a.split(" "),i=0,n=t.length;i<n;i++)o.classList.add(t[i]);("object"==typeof HTMLElement?e instanceof HTMLElement:e&&"object"==typeof e&&null!==e&&1===e.nodeType&&"string"==typeof e.nodeName)?o.appendChild(e):e instanceof jQuery?o.appendChild(e[0]):o.innerHTML=e;var r=new Hammer(o,{prevent_default:!1});return r.on("pan",function(e){var t=e.deltaX,i=80;o.classList.contains("panning")||o.classList.add("panning");var n=1-Math.abs(t/80);n<0&&(n=0),Vel(o,{left:t,opacity:n},{duration:50,queue:!1,easing:"easeOutQuad"})}),r.on("panend",function(e){var t=e.deltaX,i=80;80<Math.abs(t)?Vel(o,{marginTop:"-40px"},{duration:375,easing:"easeOutExpo",queue:!1,complete:function(){"function"==typeof s&&s(),o.parentNode.removeChild(o)}}):(o.classList.remove("panning"),Vel(o,{left:0,opacity:1},{duration:300,easing:"easeOutExpo",queue:!1}))}),o}a=a||"";var n=document.getElementById("toast-container");null===n&&((n=document.createElement("div")).id="toast-container",document.body.appendChild(n));var o=i(e);e&&n.appendChild(o),o.style.opacity=0,Vel(o,{translateY:"-35px",opacity:1},{duration:300,easing:"easeOutCubic",queue:!1});var r,l=t;null!=l&&(r=setInterval(function(){null===o.parentNode&&window.clearInterval(r),o.classList.contains("panning")||(l-=20),l<=0&&(Vel(o,{opacity:0,marginTop:"-40px"},{duration:375,easing:"easeOutExpo",queue:!1,complete:function(){"function"==typeof s&&s(),this[0].parentNode.removeChild(this[0])}}),window.clearInterval(r))},20))},function(p){var t={init:function(u){var e={menuWidth:300,edge:"left",closeOnClick:!1,draggable:!0};u=p.extend(e,u),p(this).each(function(){var e=p(this),t=e.attr("data-activates"),s=p("#"+t);300!=u.menuWidth&&s.css("width",u.menuWidth);var a=p('.drag-target[data-sidenav="'+t+'"]');u.draggable?(a.length&&a.remove(),a=p('<div class="drag-target"></div>').attr("data-sidenav",t),p("body").append(a)):a=p(),"left"==u.edge?(s.css("transform","translateX(-100%)"),a.css({left:0})):(s.addClass("right-aligned").css("transform","translateX(100%)"),a.css({right:0})),s.hasClass("fixed")&&992<window.innerWidth&&s.css("transform","translateX(0)"),s.hasClass("fixed")&&p(window).resize(function(){992<window.innerWidth?0!==p("#sidenav-overlay").length&&d?l(!0):s.css("transform","translateX(0%)"):!1===d&&("left"===u.edge?s.css("transform","translateX(-100%)"):s.css("transform","translateX(100%)"))}),!0===u.closeOnClick&&s.on("click.itemclick","a:not(.collapsible-header)",function(){l()});var l=function(e){d=c=!1,p("body").css({overflow:"",width:""}),p("#sidenav-overlay").velocity({opacity:0},{duration:200,queue:!1,easing:"easeOutQuad",complete:function(){p(this).remove()}}),"left"===u.edge?(a.css({width:"",right:"",left:"0"}),s.velocity({translateX:"-100%"},{duration:200,queue:!1,easing:"easeOutCubic",complete:function(){!0===e&&(s.removeAttr("style"),s.css("width",u.menuWidth))}})):(a.css({width:"",right:"0",left:""}),s.velocity({translateX:"100%"},{duration:200,queue:!1,easing:"easeOutCubic",complete:function(){!0===e&&(s.removeAttr("style"),s.css("width",u.menuWidth))}}))},c=!1,d=!1;u.draggable&&(a.on("click",function(){d&&l()}),a.hammer({prevent_default:!1}).bind("pan",function(e){if("touch"==e.gesture.pointerType){var t=(e.gesture.direction,e.gesture.center.x),i=(e.gesture.center.y,e.gesture.velocityX,p("body")),n=p("#sidenav-overlay"),o=i.innerWidth(),r;if(i.css("overflow","hidden"),i.width(o),0===n.length&&((n=p('<div id="sidenav-overlay"></div>')).css("opacity",0).click(function(){l()}),p("body").append(n)),"left"===u.edge&&(t>u.menuWidth?t=u.menuWidth:t<0&&(t=0)),"left"===u.edge)t<u.menuWidth/2?d=!1:t>=u.menuWidth/2&&(d=!0),s.css("transform","translateX("+(t-u.menuWidth)+"px)");else{t<window.innerWidth-u.menuWidth/2?d=!0:t>=window.innerWidth-u.menuWidth/2&&(d=!1);var a=t-u.menuWidth/2;a<0&&(a=0),s.css("transform","translateX("+a+"px)")}r="left"===u.edge?t/u.menuWidth:Math.abs((t-window.innerWidth)/u.menuWidth),n.velocity({opacity:r},{duration:10,queue:!1,easing:"easeOutQuad"})}}).bind("panend",function(e){if("touch"==e.gesture.pointerType){var t=p("#sidenav-overlay"),i=e.gesture.velocityX,n=e.gesture.center.x,o=n-u.menuWidth,r=n-u.menuWidth/2;0<o&&(o=0),r<0&&(r=0),c=!1,"left"===u.edge?d&&i<=.3||i<-.5?(0!==o&&s.velocity({translateX:[0,o]},{duration:300,queue:!1,easing:"easeOutQuad"}),t.velocity({opacity:1},{duration:50,queue:!1,easing:"easeOutQuad"}),a.css({width:"50%",right:0,left:""}),d=!0):(!d||.3<i)&&(p("body").css({overflow:"",width:""}),s.velocity({translateX:[-1*u.menuWidth-10,o]},{duration:200,queue:!1,easing:"easeOutQuad"}),t.velocity({opacity:0},{duration:200,queue:!1,easing:"easeOutQuad",complete:function(){p(this).remove()}}),a.css({width:"10px",right:"",left:0})):d&&-.3<=i||.5<i?(0!==r&&s.velocity({translateX:[0,r]},{duration:300,queue:!1,easing:"easeOutQuad"}),t.velocity({opacity:1},{duration:50,queue:!1,easing:"easeOutQuad"}),a.css({width:"50%",right:"",left:0}),d=!0):(!d||i<-.3)&&(p("body").css({overflow:"",width:""}),s.velocity({translateX:[u.menuWidth+10,r]},{duration:200,queue:!1,easing:"easeOutQuad"}),t.velocity({opacity:0},{duration:200,queue:!1,easing:"easeOutQuad",complete:function(){p(this).remove()}}),a.css({width:"10px",right:0,left:""}))}})),e.off("click.sidenav").on("click.sidenav",function(){if(!0===d)c=d=!1,l();else{var e=p("body"),t=p('<div id="sidenav-overlay"></div>'),i=e.innerWidth();e.css("overflow","hidden"),e.width(i),p("body").append(a),"left"===u.edge?(a.css({width:"50%",right:0,left:""}),s.velocity({translateX:[0,-1*u.menuWidth]},{duration:300,queue:!1,easing:"easeOutQuad"})):(a.css({width:"50%",right:"",left:0}),s.velocity({translateX:[0,u.menuWidth]},{duration:300,queue:!1,easing:"easeOutQuad"})),t.css("opacity",0).click(function(){c=d=!1,l(),t.velocity({opacity:0},{duration:300,queue:!1,easing:"easeOutQuad",complete:function(){p(this).remove()}})}),p("body").append(t),t.velocity({opacity:1},{duration:300,queue:!1,easing:"easeOutQuad",complete:function(){c=!(d=!0)}})}return!1})})},destroy:function(){var e=p("#sidenav-overlay"),t=p('.drag-target[data-sidenav="'+p(this).attr("data-activates")+'"]');e.trigger("click"),t.remove(),p(this).off("click"),e.remove()},show:function(){this.trigger("click")},hide:function(){p("#sidenav-overlay").trigger("click")}};p.fn.sideNav=function(e){return t[e]?t[e].apply(this,Array.prototype.slice.call(arguments,1)):"object"!=typeof e&&e?void p.error("Method "+e+" does not exist on jQuery.sideNav"):t.init.apply(this,arguments)}}(jQuery),function(a){function s(s,l,c,d){var u=a();return a.each(p,function(e,t){if(0<t.height()){var i=t.offset().top,n=t.offset().left,o=n+t.width(),r=i+t.height(),a;!(l<n||o<d||c<i||r<s)&&u.push(t)}}),u}function l(e){++f;var t=c.scrollTop(),i=c.scrollLeft(),n=i+c.width(),o=t+c.height(),r=s(t+h.top+e||200,n+h.right,o+h.bottom,i+h.left);a.each(r,function(e,t){var i;"number"!=typeof t.data("scrollSpy:ticks")&&t.triggerHandler("scrollSpy:enter"),t.data("scrollSpy:ticks",f)}),a.each(d,function(e,t){var i=t.data("scrollSpy:ticks");"number"==typeof i&&i!==f&&(t.triggerHandler("scrollSpy:exit"),t.data("scrollSpy:ticks",null))}),d=r}function t(){c.trigger("scrollSpy:winSize")}var c=a(window),p=[],d=[],u=!1,f=0,h={top:0,right:0,bottom:0,left:0};a.scrollSpy=function(e,i){var t={throttle:100,scrollOffset:200};i=a.extend(t,i);var n=[];(e=a(e)).each(function(e,t){p.push(a(t)),a(t).data("scrollSpy:id",e),a('a[href="#'+a(t).attr("id")+'"]').click(function(e){e.preventDefault();var t=a(Materialize.escapeHash(this.hash)).offset().top+1;a("html, body").animate({scrollTop:t-i.scrollOffset},{duration:400,queue:!1,easing:"easeOutCubic"})})}),h.top=i.offsetTop||0,h.right=i.offsetRight||0,h.bottom=i.offsetBottom||0,h.left=i.offsetLeft||0;var o=Materialize.throttle(function(){l(i.scrollOffset)},i.throttle||100),r=function(){a(document).ready(o)};return u||(c.on("scroll",r),c.on("resize",r),u=!0),setTimeout(r,0),e.on("scrollSpy:enter",function(){n=a.grep(n,function(e){return 0!=e.height()});var e=a(this);n[0]?(a('a[href="#'+n[0].attr("id")+'"]').removeClass("active"),e.data("scrollSpy:id")<n[0].data("scrollSpy:id")?n.unshift(a(this)):n.push(a(this))):n.push(a(this)),a('a[href="#'+n[0].attr("id")+'"]').addClass("active")}),e.on("scrollSpy:exit",function(){if((n=a.grep(n,function(e){return 0!=e.height()}))[0]){a('a[href="#'+n[0].attr("id")+'"]').removeClass("active");var t=a(this);(n=a.grep(n,function(e){return e.attr("id")!=t.attr("id")}))[0]&&a('a[href="#'+n[0].attr("id")+'"]').addClass("active")}}),e},a.winSizeSpy=function(e){return a.winSizeSpy=function(){return c},e=e||{throttle:100},c.on("resize",Materialize.throttle(t,e.throttle||100))},a.fn.scrollSpy=function(e){return a.scrollSpy(a(this),e)}}(jQuery),function(b){b(document).ready(function(){function e(e){var t=e.css("font-family"),i=e.css("font-size"),n=e.css("line-height");i&&r.css("font-size",i),t&&r.css("font-family",t),n&&r.css("line-height",n),"off"===e.attr("wrap")&&r.css("overflow-wrap","normal").css("white-space","pre"),r.text(e.val()+"\n");var o=r.html().replace(/\n/g,"<br>");r.html(o),e.is(":visible")?r.css("width",e.width()):r.css("width",b(window).width()/2),e.data("original-height")<=r.height()?e.css("height",r.height()):e.val().length<e.data("previous-length")&&e.css("height",e.data("original-height")),e.data("previous-length",e.val().length)}Materialize.updateTextFields=function(){var e;b("input[type=text], input[type=password], input[type=email], input[type=url], input[type=tel], input[type=number], input[type=search], textarea").each(function(e,t){var i=b(this);0<b(t).val().length||t.autofocus||void 0!==i.attr("placeholder")?i.siblings("label").addClass("active"):b(t)[0].validity?i.siblings("label").toggleClass("active",!0===b(t)[0].validity.badInput):i.siblings("label").removeClass("active")})};var i="input[type=text], input[type=password], input[type=email], input[type=url], input[type=tel], input[type=number], input[type=search], textarea";b(document).on("change",i,function(){0===b(this).val().length&&void 0===b(this).attr("placeholder")||b(this).siblings("label").addClass("active"),validate_field(b(this))}),b(document).ready(function(){Materialize.updateTextFields()}),b(document).on("reset",function(e){var t=b(e.target);t.is("form")&&(t.find(i).removeClass("valid").removeClass("invalid"),t.find(i).each(function(){""===b(this).attr("value")&&b(this).siblings("label").removeClass("active")}),t.find("select.initialized").each(function(){var e=t.find("option[selected]").text();t.siblings("input.select-dropdown").val(e)}))}),b(document).on("focus",i,function(){b(this).siblings("label, .prefix").addClass("active")}),b(document).on("blur",i,function(){var e=b(this),t=".prefix";0===e.val().length&&!0!==e[0].validity.badInput&&void 0===e.attr("placeholder")&&(t+=", label"),e.siblings(t).removeClass("active"),validate_field(e)}),window.validate_field=function(e){var t=void 0!==e.attr("data-length"),i=parseInt(e.attr("data-length")),n=e.val().length;0===e.val().length&&!1===e[0].validity.badInput?e.hasClass("validate")&&(e.removeClass("valid"),e.removeClass("invalid")):e.hasClass("validate")&&(e.is(":valid")&&t&&n<=i||e.is(":valid")&&!t?(e.removeClass("invalid"),e.addClass("valid")):(e.removeClass("valid"),e.addClass("invalid")))};var t="input[type=radio], input[type=checkbox]";b(document).on("keyup.radio",t,function(e){var t;if(9===e.which)return b(this).addClass("tabbed"),void b(this).one("blur",function(e){b(this).removeClass("tabbed")})});var r=b(".hiddendiv").first();r.length||(r=b('<div class="hiddendiv common"></div>'),b("body").append(r));var n=".materialize-textarea";b(n).each(function(){var e=b(this);e.data("original-height",e.height()),e.data("previous-length",e.val().length)}),b("body").on("keyup keydown autoresize",n,function(){e(b(this))}),b(document).on("change",'.file-field input[type="file"]',function(){for(var e,t=b(this).closest(".file-field").find("input.file-path"),i=b(this)[0].files,n=[],o=0;o<i.length;o++)n.push(i[o].name);t.val(n.join(", ")),t.trigger("change")});var o="input[type=range]",a=!1;b(o).each(function(){var e=b('<span class="thumb"><span class="value"></span></span>');b(this).after(e)});var s=function(e){var t,i=-7+parseInt(e.parent().css("padding-left"))+"px";e.velocity({height:"30px",width:"30px",top:"-30px",marginLeft:i},{duration:300,easing:"easeOutExpo"})},l=function(e){var t=e.width()-15,i=parseFloat(e.attr("max")),n=parseFloat(e.attr("min")),o;return(parseFloat(e.val())-n)/(i-n)*t},c=".range-field";b(document).on("change",o,function(e){var t=b(this).siblings(".thumb");t.find(".value").html(b(this).val()),t.hasClass("active")||s(t);var i=l(b(this));t.addClass("active").css("left",i)}),b(document).on("mousedown touchstart",o,function(e){var t=b(this).siblings(".thumb");if(t.length<=0&&(t=b('<span class="thumb"><span class="value"></span></span>'),b(this).after(t)),t.find(".value").html(b(this).val()),a=!0,b(this).addClass("active"),t.hasClass("active")||s(t),"input"!==e.type){var i=l(b(this));t.addClass("active").css("left",i)}}),b(document).on("mouseup touchend",c,function(){a=!1,b(this).removeClass("active")}),b(document).on("input mousemove touchmove",c,function(e){var t=b(this).children(".thumb"),i=b(this).find(o);if(a){t.hasClass("active")||s(t);var n=l(i);t.addClass("active").css("left",n),t.find(".value").html(t.siblings(o).val())}}),b(document).on("mouseout touchleave",c,function(){if(!a){var e=b(this).children(".thumb"),t,i=7+parseInt(b(this).css("padding-left"))+"px";e.hasClass("active")&&e.velocity({height:"0",width:"0",top:"10px",marginLeft:i},{duration:100}),e.removeClass("active")}}),b.fn.autocomplete=function(p){var e={data:{},limit:1/0,onAutocomplete:null,minLength:1};return p=b.extend(e,p),this.each(function(){var o,r=b(this),a=p.data,s=0,l=-1,e=r.closest(".input-field");if(!b.isEmptyObject(a)){var t,c=b('<ul class="autocomplete-content dropdown-content"></ul>');e.length?(t=e.children(".autocomplete-content.dropdown-content").first()).length||e.append(c):(t=r.next(".autocomplete-content.dropdown-content")).length||r.after(c),t.length&&(c=t);var d=function(e,t){var i=t.find("img"),n=t.text().toLowerCase().indexOf(""+e.toLowerCase()),o=n+e.length-1,r=t.text().slice(0,n),a=t.text().slice(n,o+1),s=t.text().slice(o+1);t.html("<span>"+r+"<span class='highlight'>"+a+"</span>"+s+"</span>"),i.length&&t.prepend(i)},i=function(){l=-1,c.find(".active").removeClass("active")},u=function(){c.empty(),i(),o=void 0};r.off("blur.autocomplete").on("blur.autocomplete",function(){u()}),r.off("keyup.autocomplete focus.autocomplete").on("keyup.autocomplete focus.autocomplete",function(e){s=0;var t=r.val().toLowerCase();if(13!==e.which&&38!==e.which&&40!==e.which){if(o!==t&&(u(),t.length>=p.minLength))for(var i in a)if(a.hasOwnProperty(i)&&-1!==i.toLowerCase().indexOf(t)&&i.toLowerCase()!==t){if(s>=p.limit)break;var n=b("<li></li>");a[i]?n.append('<img src="'+a[i]+'" class="right circle"><span>'+i+"</span>"):n.append("<span>"+i+"</span>"),c.append(n),d(t,n),s++}o=t}}),r.off("keydown.autocomplete").on("keydown.autocomplete",function(e){var t,i=e.which,n=c.children("li").length,o=c.children(".active").first();return 13===i&&0<=l?void((t=c.children("li").eq(l)).length&&(t.trigger("mousedown.autocomplete"),e.preventDefault())):void(38!==i&&40!==i||(e.preventDefault(),38===i&&0<l&&l--,40===i&&l<n-1&&l++,o.removeClass("active"),0<=l&&c.children("li").eq(l).addClass("active")))}),c.on(
"mousedown.autocomplete touchstart.autocomplete","li",function(){var e=b(this).text().trim();r.val(e),r.trigger("change"),u(),"function"==typeof p.onAutocomplete&&p.onAutocomplete.call(this,e)})}})}}),b.fn.material_select=function(g){function y(e,t,i){var n=e.indexOf(t),o=-1===n;return o?e.push(t):e.splice(n,1),i.siblings("ul.dropdown-content").find("li:not(.optgroup)").eq(t).toggleClass("active"),i.find("option").eq(t).prop("selected",o),r(e,i),o}function r(e,t){for(var i="",n=0,o=e.length;n<o;n++){var r=t.find("option").eq(e[n]).text();i+=0===n?r:", "+r}""===i&&(i=t.find("option:disabled").eq(0).text()),t.siblings("input.select-dropdown").val(i)}b(this).each(function(){var n=b(this);if(!n.hasClass("browser-default")){var c=!!n.attr("multiple"),e=n.data("select-id");if(e&&(n.parent().find("span.caret").remove(),n.parent().find("input").remove(),n.unwrap(),b("ul#select-options-"+e).remove()),"destroy"===g)return void n.data("select-id",null).removeClass("initialized");var t=Materialize.guid();n.data("select-id",t);var i=b('<div class="select-wrapper"></div>');i.addClass(n.attr("class"));var d=b('<ul id="select-options-'+t+'" class="dropdown-content select-dropdown '+(c?"multiple-select-dropdown":"")+'"></ul>'),o=n.children("option, optgroup"),r=[],a=!1,s=n.find("option:selected").html()||n.find("option:first").html()||"",l=function(e,t,i){var n=t.is(":disabled")?"disabled ":"",o="optgroup-option"===i?"optgroup-option ":"",r=c?'<input type="checkbox"'+n+"/><label></label>":"",a=t.data("icon"),s=t.attr("class");if(a){var l="";return s&&(l=' class="'+s+'"'),d.append(b('<li class="'+n+o+'"><img alt="" src="'+a+'"'+l+"><span>"+r+t.html()+"</span></li>")),!0}d.append(b('<li class="'+n+o+'"><span>'+r+t.html()+"</span></li>"))};o.length&&o.each(function(){if(b(this).is("option"))c?l(n,b(this),"multiple"):l(n,b(this));else if(b(this).is("optgroup")){var e=b(this).children("option");d.append(b('<li class="optgroup"><span>'+b(this).attr("label")+"</span></li>")),e.each(function(){l(n,b(this),"optgroup-option")})}}),d.find("li:not(.optgroup)").each(function(i){b(this).click(function(e){if(!b(this).hasClass("disabled")&&!b(this).hasClass("optgroup")){var t=!0;c?(b('input[type="checkbox"]',this).prop("checked",function(e,t){return!t}),t=y(r,i,n),f.trigger("focus")):(d.find("li").removeClass("active"),b(this).toggleClass("active"),f.val(b(this).text())),h(d,b(this)),n.find("option").eq(i).prop("selected",t),n.trigger("change"),void 0!==g&&g()}e.stopPropagation()})}),n.wrap(i);var u=b('<span class="caret">&#9660;</span>');n.is(":disabled")&&u.addClass("disabled");var p=s.replace(/"/g,"&quot;"),f=b('<input type="text" class="select-dropdown" readonly="true" '+(n.is(":disabled")?"disabled":"")+' data-activates="select-options-'+t+'" value="'+p+'"/>');n.before(f),f.before(u),f.after(d),n.is(":disabled")||f.dropdown({hover:!1}),n.attr("tabindex")&&b(f[0]).attr("tabindex",n.attr("tabindex")),n.addClass("initialized"),f.on({focus:function(){if(b("ul.select-dropdown").not(d[0]).is(":visible")&&b("input.select-dropdown").trigger("close"),!d.is(":visible")){b(this).trigger("open",["focus"]);var e=b(this).val();c&&0<=e.indexOf(",")&&(e=e.split(",")[0]);var t=d.find("li").filter(function(){return b(this).text().toLowerCase()===e.toLowerCase()})[0];h(d,t,!0)}},click:function(e){e.stopPropagation()}}),f.on("blur",function(){c||b(this).trigger("close"),d.find("li.selected").removeClass("selected")}),d.hover(function(){a=!0},function(){a=!1}),b(window).on({click:function(){c&&(a||f.trigger("close"))}}),c&&n.find("option:selected:not(:disabled)").each(function(){var e=b(this).index();y(r,e,n),d.find("li").eq(e).find(":checkbox").prop("checked",!0)});var h=function(e,t,i){if(t){e.find("li.selected").removeClass("selected");var n=b(t);n.addClass("selected"),c&&!i||d.scrollTo(n)}},v=[],m=function(e){if(9!=e.which)if(40!=e.which||d.is(":visible")){if(13!=e.which||d.is(":visible")){e.preventDefault();var t=String.fromCharCode(e.which).toLowerCase(),i;if(t&&-1===[9,13,27,38,40].indexOf(e.which)){v.push(t);var n=v.join(""),o=d.find("li").filter(function(){return 0===b(this).text().toLowerCase().indexOf(n)})[0];o&&h(d,o)}if(13==e.which){var r=d.find("li.selected:not(.disabled)")[0];r&&(b(r).trigger("click"),c||f.trigger("close"))}40==e.which&&(o=d.find("li.selected").length?d.find("li.selected").next("li:not(.disabled)")[0]:d.find("li:not(.disabled)")[0],h(d,o)),27==e.which&&f.trigger("close"),38==e.which&&((o=d.find("li.selected").prev("li:not(.disabled)")[0])&&h(d,o)),setTimeout(function(){v=[]},1e3)}}else f.trigger("open");else f.trigger("close")};f.on("keydown",m)}})}}(jQuery),function(h){var t={init:function(f){var e={indicators:!0,height:400,transition:500,interval:6e3};return f=h.extend(e,f),this.each(function(){function t(e,t){e.hasClass("center-align")?e.velocity({opacity:0,translateY:-100},{duration:t,queue:!1}):e.hasClass("right-align")?e.velocity({opacity:0,translateX:100},{duration:t,queue:!1}):e.hasClass("left-align")&&e.velocity({opacity:0,translateX:-100},{duration:t,queue:!1})}function i(e){e>=c.length?e=0:e<0&&(e=c.length-1),(r=l.find(".active").index())!=e&&(n=c.eq(r),$caption=n.find(".caption"),n.removeClass("active"),n.velocity({opacity:0},{duration:f.transition,queue:!1,easing:"easeOutQuad",complete:function(){c.not(".active").velocity({opacity:0,translateX:0,translateY:0},{duration:0,queue:!1})}}),t($caption,f.transition),f.indicators&&o.eq(r).removeClass("active"),c.eq(e).velocity({opacity:1},{duration:f.transition,queue:!1,easing:"easeOutQuad"}),c.eq(e).find(".caption").velocity({opacity:1,translateX:0,translateY:0},{duration:f.transition,delay:f.transition,queue:!1,easing:"easeOutQuad"}),c.eq(e).addClass("active"),f.indicators&&o.eq(e).addClass("active"))}var n,o,a,s=h(this),l=s.find("ul.slides").first(),c=l.find("> li"),r=l.find(".active").index();-1!=r&&(n=c.eq(r)),s.hasClass("fullscreen")||(f.indicators?s.height(f.height+40):s.height(f.height),l.height(f.height)),c.find(".caption").each(function(){t(h(this),0)}),c.find("img").each(function(){var e="data:image/gif;base64,R0lGODlhAQABAIABAP///wAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==";h(this).attr("src")!==e&&(h(this).css("background-image","url("+h(this).attr("src")+")"),h(this).attr("src",e))}),f.indicators&&(o=h('<ul class="indicators"></ul>'),c.each(function(e){var t=h('<li class="indicator-item"></li>');t.click(function(){var e,t;i(l.parent().find(h(this)).index()),clearInterval(a),a=setInterval(function(){r=l.find(".active").index(),c.length==r+1?r=0:r+=1,i(r)},f.transition+f.interval)}),o.append(t)}),s.append(o),o=s.find("ul.indicators").find("li.indicator-item")),n?n.show():(c.first().addClass("active").velocity({opacity:1},{duration:f.transition,queue:!1,easing:"easeOutQuad"}),r=0,n=c.eq(r),f.indicators&&o.eq(r).addClass("active")),n.find("img").each(function(){n.find(".caption").velocity({opacity:1,translateX:0,translateY:0},{duration:f.transition,queue:!1,easing:"easeOutQuad"})}),a=setInterval(function(){i((r=l.find(".active").index())+1)},f.transition+f.interval);var d=!1,u=!1,p=!1;s.hammer({prevent_default:!1}).bind("pan",function(e){if("touch"===e.gesture.pointerType){clearInterval(a);var t=e.gesture.direction,i=e.gesture.deltaX,n=e.gesture.velocityX,o=e.gesture.velocityY,r;$curr_slide=l.find(".active"),Math.abs(n)>Math.abs(o)&&$curr_slide.velocity({translateX:i},{duration:50,queue:!1,easing:"easeOutQuad"}),4===t&&(i>s.innerWidth()/2||n<-.65)?p=!0:2===t&&(i<-1*s.innerWidth()/2||.65<n)&&(u=!0),u&&(0===(r=$curr_slide.next()).length&&(r=c.first()),r.velocity({opacity:1},{duration:300,queue:!1,easing:"easeOutQuad"})),p&&(0===(r=$curr_slide.prev()).length&&(r=c.last()),r.velocity({opacity:1},{duration:300,queue:!1,easing:"easeOutQuad"}))}}).bind("panend",function(e){"touch"===e.gesture.pointerType&&($curr_slide=l.find(".active"),d=!1,curr_index=l.find(".active").index(),!p&&!u||c.length<=1?$curr_slide.velocity({translateX:0},{duration:300,queue:!1,easing:"easeOutQuad"}):u?(i(curr_index+1),$curr_slide.velocity({translateX:-1*s.innerWidth()},{duration:300,queue:!1,easing:"easeOutQuad",complete:function(){$curr_slide.velocity({opacity:0,translateX:0},{duration:0,queue:!1})}})):p&&(i(curr_index-1),$curr_slide.velocity({translateX:s.innerWidth()},{duration:300,queue:!1,easing:"easeOutQuad",complete:function(){$curr_slide.velocity({opacity:0,translateX:0},{duration:0,queue:!1})}})),p=u=!1,clearInterval(a),a=setInterval(function(){r=l.find(".active").index(),c.length==r+1?r=0:r+=1,i(r)},f.transition+f.interval))}),s.on("sliderPause",function(){clearInterval(a)}),s.on("sliderStart",function(){clearInterval(a),a=setInterval(function(){r=l.find(".active").index(),c.length==r+1?r=0:r+=1,i(r)},f.transition+f.interval)}),s.on("sliderNext",function(){i((r=l.find(".active").index())+1)}),s.on("sliderPrev",function(){i((r=l.find(".active").index())-1)})})},pause:function(){h(this).trigger("sliderPause")},start:function(){h(this).trigger("sliderStart")},next:function(){h(this).trigger("sliderNext")},prev:function(){h(this).trigger("sliderPrev")}};h.fn.slider=function(e){return t[e]?t[e].apply(this,Array.prototype.slice.call(arguments,1)):"object"!=typeof e&&e?void h.error("Method "+e+" does not exist on jQuery.tooltip"):t.init.apply(this,arguments)}}(jQuery),function(t){t(document).ready(function(){t(document).on("click.card",".card",function(e){t(this).find("> .card-reveal").length&&(t(e.target).is(t(".card-reveal .card-title"))||t(e.target).is(t(".card-reveal .card-title i"))?t(this).find(".card-reveal").velocity({translateY:0},{duration:225,queue:!1,easing:"easeInOutQuad",complete:function(){t(this).css({display:"none"})}}):(t(e.target).is(t(".card .activator"))||t(e.target).is(t(".card .activator i")))&&(t(e.target).closest(".card").css("overflow","hidden"),t(this).find(".card-reveal").css({display:"block"}).velocity("stop",!1).velocity({translateY:"-100%"},{duration:300,queue:!1,easing:"easeInOutQuad"})))})})}(jQuery),function(l){var t={data:[],placeholder:"",secondaryPlaceholder:"",autocompleteOptions:{}};l(document).ready(function(){l(document).on("click",".chip .close",function(e){var t;l(this).closest(".chips").attr("data-initialized")||l(this).closest(".chip").remove()})}),l.fn.material_chip=function(e){var s=this;if(this.$el=l(this),this.$document=l(document),this.SELS={CHIPS:".chips",CHIP:".chip",INPUT:"input",DELETE:".material-icons",SELECTED_CHIP:".selected"},"data"===e)return this.$el.data("chips");var o=l.extend({},t,e);s.hasAutocomplete=!l.isEmptyObject(o.autocompleteOptions.data),this.init=function(){var i=0;s.$el.each(function(){var e=l(this),t=Materialize.guid();s.chipId=t,o.data&&o.data instanceof Array||(o.data=[]),e.data("chips",o.data),e.attr("data-index",i),e.attr("data-initialized",!0),e.hasClass(s.SELS.CHIPS)||e.addClass("chips"),s.chips(e,t),i++})},this.handleEvents=function(){var a=s.SELS;s.$document.off("click.chips-focus",a.CHIPS).on("click.chips-focus",a.CHIPS,function(e){l(e.target).find(a.INPUT).focus()}),s.$document.off("click.chips-select",a.CHIP).on("click.chips-select",a.CHIP,function(e){var t=l(e.target);if(t.length){var i=t.hasClass("selected"),n=t.closest(a.CHIPS);l(a.CHIP).removeClass("selected"),i||s.selectChip(t.index(),n)}}),s.$document.off("keydown.chips").on("keydown.chips",function(e){if(!l(e.target).is("input, textarea")){var t,i=s.$document.find(a.CHIP+a.SELECTED_CHIP),n=i.closest(a.CHIPS),o=i.siblings(a.CHIP).length;if(i.length)if(8===e.which||46===e.which){e.preventDefault(),t=i.index(),s.deleteChip(t,n);var r=null;t+1<o?r=t:t!==o&&t+1!==o||(r=o-1),r<0&&(r=null),null!==r&&s.selectChip(r,n),o||n.find("input").focus()}else if(37===e.which){if((t=i.index()-1)<0)return;l(a.CHIP).removeClass("selected"),s.selectChip(t,n)}else if(39===e.which){if(t=i.index()+1,l(a.CHIP).removeClass("selected"),o<t)return void n.find("input").focus();s.selectChip(t,n)}}}),s.$document.off("focusin.chips",a.CHIPS+" "+a.INPUT).on("focusin.chips",a.CHIPS+" "+a.INPUT,function(e){var t=l(e.target).closest(a.CHIPS);t.addClass("focus"),t.siblings("label, .prefix").addClass("active"),l(a.CHIP).removeClass("selected")}),s.$document.off("focusout.chips",a.CHIPS+" "+a.INPUT).on("focusout.chips",a.CHIPS+" "+a.INPUT,function(e){var t=l(e.target).closest(a.CHIPS);t.removeClass("focus"),t.data("chips").length||t.siblings("label").removeClass("active"),t.siblings(".prefix").removeClass("active")}),s.$document.off("keydown.chips-add",a.CHIPS+" "+a.INPUT).on("keydown.chips-add",a.CHIPS+" "+a.INPUT,function(e){var t=l(e.target),i=t.closest(a.CHIPS),n=i.children(a.CHIP).length;if(13===e.which){if(s.hasAutocomplete&&i.find(".autocomplete-content.dropdown-content").length&&i.find(".autocomplete-content.dropdown-content").children().length)return;return e.preventDefault(),s.addChip({tag:t.val()},i),void t.val("")}if((8===e.keyCode||37===e.keyCode)&&""===t.val()&&n)return e.preventDefault(),s.selectChip(n-1,i),void t.blur()}),s.$document.off("click.chips-delete",a.CHIPS+" "+a.DELETE).on("click.chips-delete",a.CHIPS+" "+a.DELETE,function(e){var t=l(e.target),i=t.closest(a.CHIPS),n=t.closest(a.CHIP);e.stopPropagation(),s.deleteChip(n.index(),i),i.find("input").focus()})},this.chips=function(t,e){t.empty(),t.data("chips").forEach(function(e){t.append(s.renderChip(e))}),t.append(l('<input id="'+e+'" class="input" placeholder="">')),s.setPlaceholder(t);var i=t.next("label");i.length&&(i.attr("for",e),t.data("chips").length&&i.addClass("active"));var n=l("#"+e);s.hasAutocomplete&&(o.autocompleteOptions.onAutocomplete=function(e){s.addChip({tag:e},t),n.val(""),n.focus()},n.autocomplete(o.autocompleteOptions))},this.renderChip=function(e){if(e.tag){var t=l('<div class="chip"></div>');return t.text(e.tag),t.append(l('<i class="material-icons close">close</i>')),t}},this.setPlaceholder=function(e){e.data("chips").length&&o.placeholder?e.find("input").prop("placeholder",o.placeholder):!e.data("chips").length&&o.secondaryPlaceholder&&e.find("input").prop("placeholder",o.secondaryPlaceholder)},this.isValid=function(e,t){for(var i=e.data("chips"),n=!1,o=0;o<i.length;o++)if(i[o].tag===t.tag)return void(n=!0);return""!==t.tag&&!n},this.addChip=function(e,t){if(s.isValid(t,e)){for(var i=s.renderChip(e),n=[],o=t.data("chips"),r=0;r<o.length;r++)n.push(o[r]);n.push(e),t.data("chips",n),i.insertBefore(t.find("input")),t.trigger("chip.add",e),s.setPlaceholder(t)}},this.deleteChip=function(e,t){var i=t.data("chips")[e];t.find(".chip").eq(e).remove();for(var n=[],o=t.data("chips"),r=0;r<o.length;r++)r!==e&&n.push(o[r]);t.data("chips",n),t.trigger("chip.delete",i),s.setPlaceholder(t)},this.selectChip=function(e,t){var i=t.find(".chip").eq(e);i&&!1===i.hasClass("selected")&&(i.addClass("selected"),t.trigger("chip.select",t.data("chips")[e]))},this.getChipsElement=function(e,t){return t.eq(e)},this.init(),this.handleEvents()}}(jQuery),function(a){a.fn.pushpin=function(r){var e={top:0,bottom:1/0,offset:0};return"remove"===r?(this.each(function(){(id=a(this).data("pushpin-id"))&&(a(window).off("scroll."+id),a(this).removeData("pushpin-id").removeClass("pin-top pinned pin-bottom").removeAttr("style"))}),!1):(r=a.extend(e,r),$index=0,this.each(function(){function i(e){e.removeClass("pin-top"),e.removeClass("pinned"),e.removeClass("pin-bottom")}function t(e,t){e.each(function(){r.top<=t&&r.bottom>=t&&!a(this).hasClass("pinned")&&(i(a(this)),a(this).css("top",r.offset),a(this).addClass("pinned")),t<r.top&&!a(this).hasClass("pin-top")&&(i(a(this)),a(this).css("top",0),a(this).addClass("pin-top")),t>r.bottom&&!a(this).hasClass("pin-bottom")&&(i(a(this)),a(this).addClass("pin-bottom"),a(this).css("top",r.bottom-o))})}var e=Materialize.guid(),n=a(this),o=a(this).offset().top;a(this).data("pushpin-id",e),t(n,a(window).scrollTop()),a(window).on("scroll."+e,function(){var e=a(window).scrollTop()+r.offset;t(n,e)})}))}}(jQuery),function(u){u(document).ready(function(){u.fn.reverse=[].reverse,u(document).on("mouseenter.fixedActionBtn",".fixed-action-btn:not(.click-to-toggle):not(.toolbar)",function(e){var t=u(this);n(t)}),u(document).on("mouseleave.fixedActionBtn",".fixed-action-btn:not(.click-to-toggle):not(.toolbar)",function(e){var t=u(this);o(t)}),u(document).on("click.fabClickToggle",".fixed-action-btn.click-to-toggle > a",function(e){var t,i=u(this).parent();i.hasClass("active")?o(i):n(i)}),u(document).on("click.fabToolbar",".fixed-action-btn.toolbar > a",function(e){var t,i=u(this).parent();r(i)})}),u.fn.extend({openFAB:function(){n(u(this))},closeFAB:function(){o(u(this))},openToolbar:function(){r(u(this))},closeToolbar:function(){p(u(this))}});var n=function(e){var t=e;if(!1===t.hasClass("active")){var i,n,o;!0===t.hasClass("horizontal")?n=40:i=40,t.addClass("active"),t.find("ul .btn-floating").velocity({scaleY:".4",scaleX:".4",translateY:i+"px",translateX:n+"px"},{duration:0});var r=0;t.find("ul .btn-floating").reverse().each(function(){u(this).velocity({opacity:"1",scaleX:"1",scaleY:"1",translateY:"0",translateX:"0"},{duration:80,delay:r}),r+=40})}},o=function(e){var t,i,n=e,o;!0===n.hasClass("horizontal")?i=40:t=40,n.removeClass("active"),n.find("ul .btn-floating").velocity("stop",!0),n.find("ul .btn-floating").velocity({opacity:"0",scaleX:".4",scaleY:".4",translateY:t+"px",translateX:i+"px"},{duration:80})},r=function(t){if("true"!==t.attr("data-open")){var e,i,n,o=window.innerWidth,r=window.innerHeight,a=t[0].getBoundingClientRect(),s=t.find("> a").first(),l=t.find("> ul").first(),c=u('<div class="fab-backdrop"></div>'),d=s.css("background-color");s.append(c),e=a.left-o/2+a.width/2,i=r-a.bottom,n=o/c.width(),t.attr("data-origin-bottom",a.bottom),t.attr("data-origin-left",a.left),t.attr("data-origin-width",a.width),t.addClass("active"),t.attr("data-open",!0),t.css({"text-align":"center",width:"100%",bottom:0,left:0,transform:"translateX("+e+"px)",transition:"none"}),s.css({transform:"translateY("+-i+"px)",transition:"none"}),c.css({"background-color":d}),setTimeout(function(){t.css({transform:"",transition:"transform .2s cubic-bezier(0.550, 0.085, 0.680, 0.530), background-color 0s linear .2s"}),s.css({overflow:"visible",transform:"",transition:"transform .2s"}),setTimeout(function(){t.css({overflow:"hidden","background-color":d}),c.css({transform:"scale("+n+")",transition:"transform .2s cubic-bezier(0.550, 0.055, 0.675, 0.190)"}),l.find("> li > a").css({opacity:1}),u(window).on("scroll.fabToolbarClose",function(){p(t),u(window).off("scroll.fabToolbarClose"),u(document).off("click.fabToolbarClose")}),u(document).on("click.fabToolbarClose",function(e){u(e.target).closest(l).length||(p(t),u(window).off("scroll.fabToolbarClose"),u(document).off("click.fabToolbarClose"))})},100)},0)}},p=function(e){if("true"===e.attr("data-open")){var t,i,n,o=window.innerWidth,r=window.innerHeight,a=e.attr("data-origin-width"),s=e.attr("data-origin-bottom"),l=e.attr("data-origin-left"),c=e.find("> .btn-floating").first(),d=e.find("> ul").first(),u=e.find(".fab-backdrop"),p=c.css("background-color");t=l-o/2+a/2,i=r-s,n=o/u.width(),e.removeClass("active"),e.attr("data-open",!1),e.css({"background-color":"transparent",transition:"none"}),c.css({transition:"none"}),u.css({transform:"scale(0)","background-color":p}),d.find("> li > a").css({opacity:""}),setTimeout(function(){u.remove(),e.css({"text-align":"",width:"",bottom:"",left:"",overflow:"","background-color":"",transform:"translate3d("+-t+"px,0,0)"}),c.css({overflow:"",transform:"translate3d(0,"+i+"px,0)"}),setTimeout(function(){e.css({transform:"translate3d(0,0,0)",transition:"transform .2s"}),c.css({transform:"translate3d(0,0,0)",transition:"transform .2s cubic-bezier(0.550, 0.055, 0.675, 0.190)"})},20)},200)}}}(jQuery),function(s){Materialize.fadeInImage=function(e){var t;if("string"==typeof e)t=s(e);else{if("object"!=typeof e)return;t=e}t.css({opacity:0}),s(t).velocity({opacity:1},{duration:650,queue:!1,easing:"easeOutSine"}),s(t).velocity({opacity:1},{duration:1300,queue:!1,easing:"swing",step:function(e,t){var i=e/(t.start=100),n=150-(100-e)/1.75;n<100&&(n=100),0<=e&&s(this).css({"-webkit-filter":"grayscale("+i+")brightness("+n+"%)",filter:"grayscale("+i+")brightness("+n+"%)"})}})},Materialize.showStaggeredList=function(e){var t;if("string"==typeof e)t=s(e);else{if("object"!=typeof e)return;t=e}var i=0;t.find("li").velocity({translateX:"-100px"},{duration:0}),t.find("li").each(function(){s(this).velocity({opacity:"1",translateX:"0"},{duration:800,delay:i,easing:[60,10]}),i+=120})},s(document).ready(function(){var r=!1,a=!1;s(".dismissable").each(function(){s(this).hammer({prevent_default:!1}).bind("pan",function(e){if("touch"===e.gesture.pointerType){var t=s(this),i=e.gesture.direction,n=e.gesture.deltaX,o=e.gesture.velocityX;t.velocity({translateX:n},{duration:50,queue:!1,easing:"easeOutQuad"}),4===i&&(n>t.innerWidth()/2||o<-.75)&&(r=!0),2===i&&(n<-1*t.innerWidth()/2||.75<o)&&(a=!0)}}).bind("panend",function(e){if(Math.abs(e.gesture.deltaX)<s(this).innerWidth()/2&&(r=a=!1),"touch"===e.gesture.pointerType){var t=s(this),i;if(r||a)i=r?t.innerWidth():-1*t.innerWidth(),t.velocity({translateX:i},{duration:100,queue:!1,easing:"easeOutQuad",complete:function(){t.css("border","none"),t.velocity({height:0,padding:0},{duration:200,queue:!1,easing:"easeOutQuad",complete:function(){t.remove()}})}});else t.velocity({translateX:0},{duration:100,queue:!1,easing:"easeOutQuad"});a=r=!1}})})})}(jQuery),function(e){var i=!1;Materialize.scrollFire=function(c){var e=function(){for(var e=window.pageYOffset+window.innerHeight,t=0;t<c.length;t++){var i=c[t],n=i.selector,o=i.offset,r=i.callback,a=document.querySelector(n),s;if(null!==a)if(a.getBoundingClientRect().top+window.pageYOffset+o<e&&!0!==i.done){if("function"==typeof r)r.call(this,a);else if("string"==typeof r){var l;new Function(r)(a)}i.done=!0}}},t=Materialize.throttle(function(){e()},c.throttle||100);i||(window.addEventListener("scroll",t),window.addEventListener("resize",t),i=!0),setTimeout(t,0)}}(jQuery),function(e){"function"==typeof define&&define.amd?define("picker",["jquery"],e):"object"==typeof exports?module.exports=e(require("jquery")):this.Picker=e(jQuery)}(function(g){function y(n,e,t,i){function o(){return y._.node("div",y._.node("div",y._.node("div",y._.node("div",m.component.nodes(u.open),f.box),f.wrap),f.frame),f.holder)}function r(){h.data(e,m).addClass(f.input).attr("tabindex",-1).val(h.data("value")?m.get("select",p.format):n.value),p.editable||h.on("focus."+u.id+" click."+u.id,function(e){e.preventDefault(),m.$root.eq(0).focus()}).on("keydown."+u.id,l),k(n,{haspopup:!0,expanded:!1,readonly:!1,owns:n.id+"_root"})}function a(){m.$root.on({keydown:l,focusin:function(e){m.$root.removeClass(f.focused),e.stopPropagation()},"mousedown click":function(e){var t=e.target;t!=m.$root.children()[0]&&(e.stopPropagation(),"mousedown"!=e.type||g(t).is("input, select, textarea, button, option")||(e.preventDefault(),m.$root.eq(0).focus()))}}).on({focus:function(){h.addClass(f.target)},blur:function(){h.removeClass(f.target)}}).on("focus.toOpen",c).on("click","[data-pick], [data-nav], [data-clear], [data-close]",function(){var e=g(this),t=e.data(),i=e.hasClass(f.navDisabled)||e.hasClass(f.disabled),n=x();n=n&&(n.type||n.href),(i||n&&!g.contains(m.$root[0],n))&&m.$root.eq(0).focus(),!i&&t.nav?m.set("highlight",m.component.item.highlight,{nav:t.nav}):!i&&"pick"in t?m.set("select",t.pick):t.clear?m.clear().close(!0):t.close&&m.close(!0)}),k(m.$root[0],"hidden",!0)}function s(){var e;!0===p.hiddenName?(e=n.name,n.name=""):e=(e=["string"==typeof p.hiddenPrefix?p.hiddenPrefix:"","string"==typeof p.hiddenSuffix?p.hiddenSuffix:"_submit"])[0]+n.name+e[1],m._hidden=g('<input type=hidden name="'+e+'"'+(h.data("value")||n.value?' value="'+m.get("select",p.formatSubmit)+'"':"")+">")[0],h.on("change."+u.id,function(){m._hidden.value=n.value?m.get("select",p.formatSubmit):""}),p.container?g(p.container).append(m._hidden):h.after(m._hidden)}function l(e){var t=e.keyCode,i=/^(8|46)$/.test(t);return 27==t?(m.close(),!1):void((32==t||i||!u.open&&m.component.key[t])&&(e.preventDefault(),e.stopPropagation(),i?m.clear().close():m.open()))}function c(e){e.stopPropagation(),"focus"==e.type&&m.$root.addClass(f.focused),m.open()}if(!n)return y;var d=!1,u={id:n.id||"P"+Math.abs(~~(Math.random()*new Date))},p=t?g.extend(!0,{},t.defaults,i):i||{},f=g.extend({},y.klasses(),p.klass),h=g(n),v=function(){return this.start()},m=v.prototype={constructor:v,$node:h,start:function(){return u&&u.start?m:(u.methods={},u.start=!0,u.open=!1,u.type=n.type,n.autofocus=n==x(),n.readOnly=!p.editable,n.id=n.id||u.id,"text"!=n.type&&(n.type="text"),m.component=new t(m,p),m.$root=g(y._.node("div",o(),f.picker,'id="'+n.id+'_root" tabindex="0"')),a(),p.formatSubmit&&s(),r(),p.container?g(p.container).append(m.$root):h.after(m.$root),m.on({start:m.component.onStart,render:m.component.onRender,stop:m.component.onStop,open:m.component.onOpen,close:m.component.onClose,set:m.component.onSet}).on({start:p.onStart,render:p.onRender,stop:p.onStop,open:p.onOpen,close:p.onClose,set:p.onSet}),d=b(m.$root.children()[0]),n.autofocus&&m.open(),m.trigger("start").trigger("render"))},render:function(e){return e?m.$root.html(o()):m.$root.find("."+f.box).html(m.component.nodes(u.open)),m.trigger("render")},stop:function(){return u.start&&(m.close(),m._hidden&&m._hidden.parentNode.removeChild(m._hidden),m.$root.remove(),h.removeClass(f.input).removeData(e),setTimeout(function(){h.off("."+u.id)},0),n.type=u.type,n.readOnly=!1,m.trigger("stop"),u.methods={},u.start=!1),m},open:function(e){return u.open?m:(h.addClass(f.active),k(n,"expanded",!0),setTimeout(function(){m.$root.addClass(f.opened),k(m.$root[0],"hidden",!1)},0),!1!==e&&(u.open=!0,d&&S.css("overflow","hidden").css("padding-right","+="+w()),m.$root.eq(0).focus(),T.on("click."+u.id+" focusin."+u.id,function(e){var t=e.target;t!=n&&t!=document&&3!=e.which&&m.close(t===m.$root.children()[0])}).on("keydown."+u.id,function(e){var t=e.keyCode,i=m.component.key[t],n=e.target;27==t?m.close(!0):n!=m.$root[0]||!i&&13!=t?g.contains(m.$root[0],n)&&13==t&&(e.preventDefault(),n.click()):(e.preventDefault(),i?y._.trigger(m.component.key.go,m,[y._.trigger(i)]):m.$root.find("."+f.highlighted).hasClass(f.disabled)||m.set("select",m.component.item.highlight).close())})),m.trigger("open"))},close:function(e){return e&&(m.$root.off("focus.toOpen").eq(0).focus(),setTimeout(function(){m.$root.on("focus.toOpen",c)},0)),h.removeClass(f.active),k(n,"expanded",!1),setTimeout(function(){m.$root.removeClass(f.opened+" "+f.focused),k(m.$root[0],"hidden",!0)},0),u.open?(u.open=!1,d&&S.css("overflow","").css("padding-right","-="+w()),T.off("."+u.id),m.trigger("close")):m},clear:function(e){return m.set("clear",null,e)},set:function(e,t,i){var n,o,r=g.isPlainObject(e),a=r?e:{};if(i=r&&g.isPlainObject(t)?t:i||{},e){for(n in r||(a[e]=t),a)o=a[n],n in m.component.item&&(void 0===o&&(o=null),m.component.set(n,o,i)),"select"!=n&&"clear"!=n||h.val("clear"==n?"":m.get(n,p.format)).trigger("change");m.render()}return i.muted?m:m.trigger("set",a)},get:function(e,t){if(null!=u[e=e||"value"])return u[e];if("valueSubmit"==e){if(m._hidden)return m._hidden.value;e="value"}if("value"==e)return n.value;if(e in m.component.item){if("string"!=typeof t)return m.component.get(e);var i=m.component.get(e);return i?y._.trigger(m.component.formats.toString,m.component,[t,i]):""}},on:function(e,t,i){var n,o,r=g.isPlainObject(e),a=r?e:{};if(e)for(n in r||(a[e]=t),a)o=a[n],i&&(n="_"+n),u.methods[n]=u.methods[n]||[],u.methods[n].push(o);return m},off:function(){var e,t,i=arguments;for(e=0,namesCount=i.length;e<namesCount;e+=1)(t=i[e])in u.methods&&delete u.methods[t];return m},trigger:function(e,i){var t=function(e){var t=u.methods[e];t&&t.map(function(e){y._.trigger(e,m,[i])})};return t("_"+e),t(e),m}};return new v}function b(e){var t,i="position";return e.currentStyle?t=e.currentStyle[i]:window.getComputedStyle&&(t=getComputedStyle(e)[i]),"fixed"==t}function w(){if(S.height()<=r.height())return 0;var e=g('<div style="visibility:hidden;width:100px" />').appendTo("body"),t=e[0].offsetWidth;e.css("overflow","scroll");var i,n=g('<div style="width:100%" />').appendTo(e)[0].offsetWidth;return e.remove(),t-n}function k(e,t,i){if(g.isPlainObject(t))for(var n in t)o(e,n,t[n]);else o(e,t,i)}function o(e,t,i){e.setAttribute(("role"==t?"":"aria-")+t,i)}function e(e,t){for(var i in g.isPlainObject(e)||(e={attribute:t}),t="",e){var n=("role"==i?"":"aria-")+i,o;t+=null==e[i]?"":n+'="'+e[i]+'"'}return t}function x(){try{return document.activeElement}catch(e){}}var r=g(window),T=g(document),S=g(document.documentElement);return y.klasses=function(e){return{picker:e=e||"picker",opened:e+"--opened",focused:e+"--focused",input:e+"__input",active:e+"__input--active",target:e+"__input--target",holder:e+"__holder",frame:e+"__frame",wrap:e+"__wrap",box:e+"__box"}},y._={group:function(e){for(var t,i="",n=y._.trigger(e.min,e);n<=y._.trigger(e.max,e,[n]);n+=e.i)t=y._.trigger(e.item,e,[n]),i+=y._.node(e.node,t[0],t[1],t[2]);return i},node:function(e,t,i,n){return t?"<"+e+(i=i?' class="'+i+'"':"")+(n=n?" "+n:"")+">"+(t=g.isArray(t)?t.join(""):t)+"</"+e+">":""},lead:function(e){return(e<10?"0":"")+e},trigger:function(e,t,i){return"function"==typeof e?e.apply(t,i||[]):e},digits:function(e){return/\d/.test(e[1])?2:1},isDate:function(e){return-1<{}.toString.call(e).indexOf("Date")&&this.isInteger(e.getDate())},isInteger:function(e){return-1<{}.toString.call(e).indexOf("Number")&&e%1==0},ariaAttr:e},y.extend=function(n,o){g.fn[n]=function(t,e){var i=this.data(n);return"picker"==t?i:i&&"string"==typeof t?y._.trigger(i[t],i,[e]):this.each(function(){var e;g(this).data(n)||new y(this,n,o,t)})},g.fn[n].defaults=o.defaults},y}),function(e){"function"==typeof define&&define.amd?define(["picker","jquery"],e):"object"==typeof exports?module.exports=e(require("./picker.js"),require("jquery")):e(Picker,jQuery)}(function(e,h){function t(t,i){var n=this,e=t.$node[0],o=e.value,r=t.$node.data("value"),a=r||o,s=r?i.formatSubmit:i.format,l=function(){return e.currentStyle?"rtl"==e.currentStyle.direction:"rtl"==getComputedStyle(t.$root[0]).direction},c;n.settings=i,n.$node=t.$node,n.queue={min:"measure create",max:"measure create",now:"now create",select:"parse create validate",highlight:"parse navigate create validate",view:"parse create validate viewset",disable:"deactivate",enable:"activate"},n.item={},n.item.clear=null,n.item.disable=(i.disable||[]).slice(0),n.item.enable=-(!0===(c=n.item.disable)[0]?c.shift():-1),n.set("min",i.min).set("max",i.max).set("now"),a?n.set("select",a,{format:s}):n.set("select",null).set("highlight",n.item.now),n.key={40:7,38:-7,39:function(){return l()?-1:1},37:function(){return l()?1:-1},go:function(e){var t=n.item.highlight,i=new Date(t.year,t.month,t.date+e);n.set("highlight",i,{interval:e}),this.render()}},t.on("render",function(){t.$root.find("."+i.klass.selectMonth).on("change",function(){var e=this.value;e&&(t.set("highlight",[t.get("view").year,e,t.get("highlight").date]),t.$root.find("."+i.klass.selectMonth).trigger("focus"))}),t.$root.find("."+i.klass.selectYear).on("change",function(){var e=this.value;e&&(t.set("highlight",[e,t.get("view").month,t.get("highlight").date]),t.$root.find("."+i.klass.selectYear).trigger("focus"))})},1).on("open",function(){var e="";n.disabled(n.get("now"))&&(e=":not(."+i.klass.buttonToday+")"),t.$root.find("button"+e+", select").attr("disabled",!1)},1).on("close",function(){t.$root.find("button, select").attr("disabled",!0)},1)}var i=7,n=6,g=e._,o;t.prototype.set=function(t,i,n){var o=this,e=o.item;return null===i?("clear"==t&&(t="select"),e[t]=i):(e["enable"==t?"disable":"flip"==t?"enable":t]=o.queue[t].split(" ").map(function(e){return i=o[e](t,i,n)}).pop(),"select"==t?o.set("highlight",e.select,n):"highlight"==t?o.set("view",e.highlight,n):t.match(/^(flip|min|max|disable|enable)$/)&&(e.select&&o.disabled(e.select)&&o.set("select",e.select,n),e.highlight&&o.disabled(e.highlight)&&o.set("highlight",e.highlight,n))),o},t.prototype.get=function(e){
return this.item[e]},t.prototype.create=function(e,t,i){var n,o=this;return(t=void 0===t?e:t)==-1/0||t==1/0?n=t:t=h.isPlainObject(t)&&g.isInteger(t.pick)?t.obj:h.isArray(t)?(t=new Date(t[0],t[1],t[2]),g.isDate(t)?t:o.create().obj):g.isInteger(t)||g.isDate(t)?o.normalize(new Date(t),i):o.now(e,t,i),{year:n||t.getFullYear(),month:n||t.getMonth(),date:n||t.getDate(),day:n||t.getDay(),obj:n||t,pick:n||t.getTime()}},t.prototype.createRange=function(e,t){var i=this,n=function(e){return!0===e||h.isArray(e)||g.isDate(e)?i.create(e):e};return g.isInteger(e)||(e=n(e)),g.isInteger(t)||(t=n(t)),g.isInteger(e)&&h.isPlainObject(t)?e=[t.year,t.month,t.date+e]:g.isInteger(t)&&h.isPlainObject(e)&&(t=[e.year,e.month,e.date+t]),{from:n(e),to:n(t)}},t.prototype.withinRange=function(e,t){return e=this.createRange(e.from,e.to),t.pick>=e.from.pick&&t.pick<=e.to.pick},t.prototype.overlapRanges=function(e,t){var i=this;return e=i.createRange(e.from,e.to),t=i.createRange(t.from,t.to),i.withinRange(e,t.from)||i.withinRange(e,t.to)||i.withinRange(t,e.from)||i.withinRange(t,e.to)},t.prototype.now=function(e,t,i){return t=new Date,i&&i.rel&&t.setDate(t.getDate()+i.rel),this.normalize(t,i)},t.prototype.navigate=function(e,t,i){var n,o,r,a,s=h.isArray(t),l=h.isPlainObject(t),c=this.item.view;if(s||l){for(a=l?(o=t.year,r=t.month,t.date):(o=+t[0],r=+t[1],+t[2]),i&&i.nav&&c&&c.month!==r&&(o=c.year,r=c.month),o=(n=new Date(o,r+(i&&i.nav?i.nav:0),1)).getFullYear(),r=n.getMonth();new Date(o,r,a).getMonth()!==r;)a-=1;t=[o,r,a]}return t},t.prototype.normalize=function(e){return e.setHours(0,0,0,0),e},t.prototype.measure=function(e,t){var i=this;return t?"string"==typeof t?t=i.parse(e,t):g.isInteger(t)&&(t=i.now(e,t,{rel:t})):t="min"==e?-1/0:1/0,t},t.prototype.viewset=function(e,t){return this.create([t.year,t.month,1])},t.prototype.validate=function(e,i,t){var n,o,r,a,s=this,l=i,c=t&&t.interval?t.interval:1,d=-1===s.item.enable,u=s.item.min,p=s.item.max,f=d&&s.item.disable.filter(function(e){if(h.isArray(e)){var t=s.create(e).pick;t<i.pick?n=!0:t>i.pick&&(o=!0)}return g.isInteger(e)}).length;if((!t||!t.nav)&&(!d&&s.disabled(i)||d&&s.disabled(i)&&(f||n||o)||!d&&(i.pick<=u.pick||i.pick>=p.pick)))for(d&&!f&&(!o&&0<c||!n&&c<0)&&(c*=-1);s.disabled(i)&&(1<Math.abs(c)&&(i.month<l.month||i.month>l.month)&&(i=l,c=0<c?1:-1),i.pick<=u.pick?(r=!0,c=1,i=s.create([u.year,u.month,u.date+(i.pick===u.pick?0:-1)])):i.pick>=p.pick&&(a=!0,c=-1,i=s.create([p.year,p.month,p.date+(i.pick===p.pick?0:1)])),!r||!a);)i=s.create([i.year,i.month,i.date+c]);return i},t.prototype.disabled=function(t){var i=this,e=i.item.disable.filter(function(e){return g.isInteger(e)?t.day===(i.settings.firstDay?e:e-1)%7:h.isArray(e)||g.isDate(e)?t.pick===i.create(e).pick:h.isPlainObject(e)?i.withinRange(e,t):void 0});return e=e.length&&!e.filter(function(e){return h.isArray(e)&&"inverted"==e[3]||h.isPlainObject(e)&&e.inverted}).length,-1===i.item.enable?!e:e||t.pick<i.item.min.pick||t.pick>i.item.max.pick},t.prototype.parse=function(e,n,t){var o=this,r={};return n&&"string"==typeof n?(t&&t.format||((t=t||{}).format=o.settings.format),o.formats.toArray(t.format).map(function(e){var t=o.formats[e],i=t?g.trigger(t,o,[n,r]):e.replace(/^!/,"").length;t&&(r[e]=n.substr(0,i)),n=n.substr(i)}),[r.yyyy||r.yy,+(r.mm||r.m)-1,r.dd||r.d]):n},t.prototype.formats=function(){function n(e,t,i){var n=e.match(/\w+/)[0];return i.mm||i.m||(i.m=t.indexOf(n)+1),n.length}function i(e){return e.match(/\w+/)[0].length}return{d:function(e,t){return e?g.digits(e):t.date},dd:function(e,t){return e?2:g.lead(t.date)},ddd:function(e,t){return e?i(e):this.settings.weekdaysShort[t.day]},dddd:function(e,t){return e?i(e):this.settings.weekdaysFull[t.day]},m:function(e,t){return e?g.digits(e):t.month+1},mm:function(e,t){return e?2:g.lead(t.month+1)},mmm:function(e,t){var i=this.settings.monthsShort;return e?n(e,i,t):i[t.month]},mmmm:function(e,t){var i=this.settings.monthsFull;return e?n(e,i,t):i[t.month]},yy:function(e,t){return e?2:(""+t.year).slice(2)},yyyy:function(e,t){return e?4:t.year},toArray:function(e){return e.split(/(d{1,4}|m{1,4}|y{4}|yy|!.)/g)},toString:function(e,t){var i=this;return i.formats.toArray(e).map(function(e){return g.trigger(i.formats[e],i,[0,t])||e.replace(/^!/,"")}).join("")}}}(),t.prototype.isDateExact=function(e,t){var i=this;return g.isInteger(e)&&g.isInteger(t)||"boolean"==typeof e&&"boolean"==typeof t?e===t:(g.isDate(e)||h.isArray(e))&&(g.isDate(t)||h.isArray(t))?i.create(e).pick===i.create(t).pick:!(!h.isPlainObject(e)||!h.isPlainObject(t))&&i.isDateExact(e.from,t.from)&&i.isDateExact(e.to,t.to)},t.prototype.isDateOverlap=function(e,t){var i=this,n=i.settings.firstDay?1:0;return g.isInteger(e)&&(g.isDate(t)||h.isArray(t))?(e=e%7+n)===i.create(t).day+1:g.isInteger(t)&&(g.isDate(e)||h.isArray(e))?(t=t%7+n)===i.create(e).day+1:!(!h.isPlainObject(e)||!h.isPlainObject(t))&&i.overlapRanges(e,t)},t.prototype.flipEnable=function(e){var t=this.item;t.enable=e||(-1==t.enable?1:-1)},t.prototype.deactivate=function(e,t){var n=this,o=n.item.disable.slice(0);return"flip"==t?n.flipEnable():!1===t?(n.flipEnable(1),o=[]):!0===t?(n.flipEnable(-1),o=[]):t.map(function(e){for(var t,i=0;i<o.length;i+=1)if(n.isDateExact(e,o[i])){t=!0;break}t||(g.isInteger(e)||g.isDate(e)||h.isArray(e)||h.isPlainObject(e)&&e.from&&e.to)&&o.push(e)}),o},t.prototype.activate=function(e,t){var r=this,a=r.item.disable,s=a.length;return"flip"==t?r.flipEnable():!0===t?(r.flipEnable(1),a=[]):!1===t?(r.flipEnable(-1),a=[]):t.map(function(e){var t,i,n,o;for(n=0;n<s;n+=1){if(i=a[n],r.isDateExact(i,e)){t=a[n]=null,o=!0;break}if(r.isDateOverlap(i,e)){h.isPlainObject(e)?(e.inverted=!0,t=e):h.isArray(e)?(t=e)[3]||t.push("inverted"):g.isDate(e)&&(t=[e.getFullYear(),e.getMonth(),e.getDate(),"inverted"]);break}}if(t)for(n=0;n<s;n+=1)if(r.isDateExact(a[n],e)){a[n]=null;break}if(o)for(n=0;n<s;n+=1)if(r.isDateOverlap(a[n],e)){a[n]=null;break}t&&a.push(t)}),a.filter(function(e){return null!=e})},t.prototype.nodes=function(c){var d=this,u=d.settings,e=d.item,a=e.now,s=e.select,l=e.highlight,p=e.view,f=e.disable,h=e.min,v=e.max,t=(r=(u.showWeekdaysFull?u.weekdaysFull:u.weekdaysLetter).slice(0),m=u.weekdaysFull.slice(0),u.firstDay&&(r.push(r.shift()),m.push(m.shift())),g.node("thead",g.node("tr",g.group({min:0,max:6,i:1,node:"th",item:function(e){return[r[e],u.klass.weekdays,'scope=col title="'+m[e]+'"']}})))),i=function(e){return g.node("div"," ",u.klass["nav"+(e?"Next":"Prev")]+(e&&p.year>=v.year&&p.month>=v.month||!e&&p.year<=h.year&&p.month<=h.month?" "+u.klass.navDisabled:""),"data-nav="+(e||-1)+" "+g.ariaAttr({role:"button",controls:d.$node[0].id+"_table"})+' title="'+(e?u.labelMonthNext:u.labelMonthPrev)+'"')},n=function(e){var t=u.showMonthsShort?u.monthsShort:u.monthsFull;return"short_months"==e&&(t=u.monthsShort),u.selectMonths&&null==e?g.node("select",g.group({min:0,max:11,i:1,node:"option",item:function(e){return[t[e],0,"value="+e+(p.month==e?" selected":"")+(p.year==h.year&&e<h.month||p.year==v.year&&e>v.month?" disabled":"")]}}),u.klass.selectMonth+" browser-default",(c?"":"disabled")+" "+g.ariaAttr({controls:d.$node[0].id+"_table"})+' title="'+u.labelMonthSelect+'"'):"short_months"==e?null!=s?g.node("div",t[s.month]):g.node("div",t[p.month]):g.node("div",t[p.month],u.klass.month)},o=function(e){var t=p.year,i=!0===u.selectYears?5:~~(u.selectYears/2);if(i){var n=h.year,o=v.year,r=t-i,a=t+i;if(r<n&&(a+=n-r,r=n),o<a){var s=r-n,l=a-o;r-=l<s?l:s,a=o}if(u.selectYears&&null==e)return g.node("select",g.group({min:r,max:a,i:1,node:"option",item:function(e){return[e,0,"value="+e+(t==e?" selected":"")]}}),u.klass.selectYear+" browser-default",(c?"":"disabled")+" "+g.ariaAttr({controls:d.$node[0].id+"_table"})+' title="'+u.labelYearSelect+'"')}return"raw"==e?g.node("div",t):g.node("div",t,u.klass.year)},r,m;return createDayLabel=function(){return null!=s?g.node("div",s.date):g.node("div",a.date)},createWeekdayLabel=function(){var e,t;return e=null!=s?s.day:a.day,u.weekdaysFull[e]},g.node("div",g.node("div",createWeekdayLabel(),"picker__weekday-display")+g.node("div",n("short_months"),u.klass.month_display)+g.node("div",createDayLabel(),u.klass.day_display)+g.node("div",o("raw"),u.klass.year_display),u.klass.date_display)+g.node("div",g.node("div",(u.selectYears,n()+o()+i()+i(1)),u.klass.header)+g.node("table",t+g.node("tbody",g.group({min:0,max:5,i:1,node:"tr",item:function(e){var t=u.firstDay&&0===d.create([p.year,p.month,1]).day?-7:0;return[g.group({min:7*e-p.day+t+1,max:function(){return this.min+7-1},i:1,node:"td",item:function(e){e=d.create([p.year,p.month,e+(u.firstDay?1:0)]);var t=s&&s.pick==e.pick,i=l&&l.pick==e.pick,n=f&&d.disabled(e)||e.pick<h.pick||e.pick>v.pick,o=g.trigger(d.formats.toString,d,[u.format,e]),r;return[g.node("div",e.date,(r=[u.klass.day],r.push(p.month==e.month?u.klass.infocus:u.klass.outfocus),a.pick==e.pick&&r.push(u.klass.now),t&&r.push(u.klass.selected),i&&r.push(u.klass.highlighted),n&&r.push(u.klass.disabled),r.join(" ")),"data-pick="+e.pick+" "+g.ariaAttr({role:"gridcell",label:o,selected:!(!t||d.$node.val()!==o)||null,activedescendant:!!i||null,disabled:!!n||null})),"",g.ariaAttr({role:"presentation"})]}})]}})),u.klass.table,'id="'+d.$node[0].id+'_table" '+g.ariaAttr({role:"grid",controls:d.$node[0].id,readonly:!0})),u.klass.calendar_container)+g.node("div",g.node("button",u.today,"btn-flat picker__today","type=button data-pick="+a.pick+(c&&!d.disabled(a)?"":" disabled")+" "+g.ariaAttr({controls:d.$node[0].id}))+g.node("button",u.clear,"btn-flat picker__clear","type=button data-clear=1"+(c?"":" disabled")+" "+g.ariaAttr({controls:d.$node[0].id}))+g.node("button",u.close,"btn-flat picker__close","type=button data-close=true "+(c?"":" disabled")+" "+g.ariaAttr({controls:d.$node[0].id})),u.klass.footer)},t.defaults={labelMonthNext:"Next month",labelMonthPrev:"Previous month",labelMonthSelect:"Select a month",labelYearSelect:"Select a year",monthsFull:["January","February","March","April","May","June","July","August","September","October","November","December"],monthsShort:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],weekdaysFull:["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],weekdaysShort:["Sun","Mon","Tue","Wed","Thu","Fri","Sat"],weekdaysLetter:["S","M","T","W","T","F","S"],today:"Today",clear:"Clear",close:"Close",format:"d mmmm, yyyy",klass:{table:(o=e.klasses().picker+"__")+"table",header:o+"header",date_display:o+"date-display",day_display:o+"day-display",month_display:o+"month-display",year_display:o+"year-display",calendar_container:o+"calendar-container",navPrev:o+"nav--prev",navNext:o+"nav--next",navDisabled:o+"nav--disabled",month:o+"month",year:o+"year",selectMonth:o+"select--month",selectYear:o+"select--year",weekdays:o+"weekday",day:o+"day",disabled:o+"day--disabled",selected:o+"day--selected",highlighted:o+"day--highlighted",now:o+"day--today",infocus:o+"day--infocus",outfocus:o+"day--outfocus",footer:o+"footer",buttonClear:o+"button--clear",buttonToday:o+"button--today",buttonClose:o+"button--close"}},e.extend("pickadate",t)}),function(n){function o(){var e=+n(this).attr("data-length"),t=+n(this).val().length,i=t<=e;n(this).parent().find('span[class="character-counter"]').html(t+"/"+e),s(i,n(this))}function r(e){var t=e.parent().find('span[class="character-counter"]');t.length||(t=n("<span/>").addClass("character-counter").css("float","right").css("font-size","12px").css("height",1),e.parent().append(t))}function a(){n(this).parent().find('span[class="character-counter"]').html("")}function s(e,t){var i=t.hasClass("invalid");e&&i?t.removeClass("invalid"):e||i||(t.removeClass("valid"),t.addClass("invalid"))}n.fn.characterCounter=function(){return this.each(function(){var e=n(this),t,i;e.parent().find('span[class="character-counter"]').length||void 0!==e.attr("data-length")&&(e.on("input",o),e.on("focus",o),e.on("blur",a),r(e))})},n(document).ready(function(){n("input, textarea").characterCounter()})}(jQuery),function(N){var t={init:function(_){var e={duration:200,dist:-100,shift:0,padding:0,fullWidth:!1,indicators:!1,noWrap:!1,onCycleTo:null};_=N.extend(e,_);var L=Materialize.objectSelectorString(N(this));return this.each(function(e){function t(){void 0!==window.ontouchstart&&(D[0].addEventListener("touchstart",c),D[0].addEventListener("touchmove",d),D[0].addEventListener("touchend",u)),D[0].addEventListener("mousedown",c),D[0].addEventListener("mousemove",d),D[0].addEventListener("mouseup",u),D[0].addEventListener("mouseleave",u),D[0].addEventListener("click",s)}function o(e){return e.targetTouches&&1<=e.targetTouches.length?e.targetTouches[0].clientX:e.clientX}function r(e){return e.targetTouches&&1<=e.targetTouches.length?e.targetTouches[0].clientY:e.clientY}function p(e){return k<=e?e%k:e<0?p(k+e%k):e}function a(e){A=!0,D.hasClass("scrolling")||D.addClass("scrolling"),null!=F&&window.clearTimeout(F),F=window.setTimeout(function(){A=!1,D.removeClass("scrolling")},_.duration);var t,i,n,o,r,a,s,l=g;if(m="number"==typeof e?e:m,g=Math.floor((m+w/2)/w),r=-(o=(n=m-g*w)<0?1:-1)*n*2/w,i=k>>1,_.fullWidth?s="translateX(0)":(s="translateX("+(D[0].clientWidth-h)/2+"px) ",s+="translateY("+(D[0].clientHeight-v)/2+"px)"),W){var c=g%k,d=z.find(".indicator-item.active");d.index()!==c&&(d.removeClass("active"),z.find(".indicator-item").eq(c).addClass("active"))}for((!_.noWrap||0<=g&&g<k)&&(a=f[p(g)],N(a).hasClass("active")||(D.find(".carousel-item").removeClass("active"),N(a).addClass("active")),a.style[q]=s+" translateX("+-n/2+"px) translateX("+o*_.shift*r*t+"px) translateZ("+_.dist*r+"px)",a.style.zIndex=0,_.fullWidth?tweenedOpacity=1:tweenedOpacity=1-.2*r,a.style.opacity=tweenedOpacity,a.style.display="block"),t=1;t<=i;++t)_.fullWidth?(zTranslation=_.dist,tweenedOpacity=t===i&&n<0?1-r:1):(zTranslation=_.dist*(2*t+r*o),tweenedOpacity=1-.2*(2*t+r*o)),(!_.noWrap||g+t<k)&&((a=f[p(g+t)]).style[q]=s+" translateX("+(_.shift+(w*t-n)/2)+"px) translateZ("+zTranslation+"px)",a.style.zIndex=-t,a.style.opacity=tweenedOpacity,a.style.display="block"),_.fullWidth?(zTranslation=_.dist,tweenedOpacity=t===i&&0<n?1-r:1):(zTranslation=_.dist*(2*t-r*o),tweenedOpacity=1-.2*(2*t-r*o)),(!_.noWrap||0<=g-t)&&((a=f[p(g-t)]).style[q]=s+" translateX("+(-_.shift+(-w*t-n)/2)+"px) translateZ("+zTranslation+"px)",a.style.zIndex=-t,a.style.opacity=tweenedOpacity,a.style.display="block");if((!_.noWrap||0<=g&&g<k)&&((a=f[p(g)]).style[q]=s+" translateX("+-n/2+"px) translateX("+o*_.shift*r+"px) translateZ("+_.dist*r+"px)",a.style.zIndex=0,_.fullWidth?tweenedOpacity=1:tweenedOpacity=1-.2*r,a.style.opacity=tweenedOpacity,a.style.display="block"),l!==g&&"function"==typeof _.onCycleTo){var u=D.find(".carousel-item").eq(p(g));_.onCycleTo.call(this,u,I)}}function i(){var e,t,i,n;t=(e=Date.now())-E,E=e,i=m-O,O=m,P=.8*(n=1e3*i/(1+t))+.2*P}function n(){var e,t;S&&(e=Date.now()-E,2<(t=S*Math.exp(-e/_.duration))||t<-2?(a(C-t),requestAnimationFrame(n)):a(C))}function s(e){if(I)return e.preventDefault(),e.stopPropagation(),!1;if(!_.fullWidth){var t=N(e.target).closest(".carousel-item").index(),i;0!==g%k-t&&(e.preventDefault(),e.stopPropagation()),l(t)}}function l(e){var t=g%k-e;_.noWrap||(t<0?Math.abs(t+k)<Math.abs(t)&&(t+=k):0<t&&Math.abs(t-k)<t&&(t-=k)),t<0?D.trigger("carouselNext",[Math.abs(t)]):0<t&&D.trigger("carouselPrev",[t])}function c(e){e.preventDefault(),M=I=!(b=!0),x=o(e),T=r(e),P=S=0,O=m,E=Date.now(),clearInterval($),$=setInterval(i,100)}function d(e){var t,i,n;if(b)if(t=o(e),y=r(e),i=x-t,(n=Math.abs(T-y))<30&&!M)(2<i||i<-2)&&(I=!0,x=t,a(m+i));else{if(I)return e.preventDefault(),e.stopPropagation(),!1;M=!0}if(I)return e.preventDefault(),e.stopPropagation(),!1}function u(e){if(b)return b=!1,clearInterval($),C=m,(10<P||P<-10)&&(C=m+(S=.9*P)),C=Math.round(C/w)*w,_.noWrap&&(w*(k-1)<=C?C=w*(k-1):C<0&&(C=0)),S=C-m,E=Date.now(),requestAnimationFrame(n),I&&(e.preventDefault(),e.stopPropagation()),!1}var f,h,v,m,g,b,w,k,x,T,S,C,P,A,q,O,E,$,I,M,j=L+e,z=N('<ul class="indicators"></ul>'),F=null,D=N(this),W=D.attr("data-indicators")||_.indicators,H=function(){var e=D.find(".carousel-item img").first();if(e.length)e.prop("complete")?D.css("height",e.height()):e.on("load",function(){D.css("height",N(this).height())});else{var t=D.find(".carousel-item").first().height();D.css("height",t)}};return _.fullWidth&&(_.dist=0,H(),W&&D.find(".carousel-fixed-item").addClass("with-indicators")),D.hasClass("initialized")?(N(window).trigger("resize"),N(this).trigger("carouselNext",[1e-6]),!0):(D.addClass("initialized"),b=!1,m=C=0,f=[],h=D.find(".carousel-item").first().innerWidth(),v=D.find(".carousel-item").first().innerHeight(),w=2*h+_.padding,D.find(".carousel-item").each(function(e){if(f.push(N(this)[0]),W){var t=N('<li class="indicator-item"></li>');0===e&&t.addClass("active"),t.click(function(e){var t;e.stopPropagation(),l(N(this).index())}),z.append(t)}}),W&&D.append(z),k=f.length,q="transform",["webkit","Moz","O","ms"].every(function(e){var t=e+"Transform";return void 0===document.body.style[t]||(q=t,!1)}),N(window).off("resize.carousel-"+j).on("resize.carousel-"+j,function(){_.fullWidth?(h=D.find(".carousel-item").first().innerWidth(),v=D.find(".carousel-item").first().innerHeight(),w=2*h+_.padding,C=m=2*g*h):a()}),t(),a(m),N(this).on("carouselNext",function(e,t){void 0===t&&(t=1),C=w*Math.round(m/w)+w*t,m!==C&&(S=C-m,E=Date.now(),requestAnimationFrame(n))}),N(this).on("carouselPrev",function(e,t){void 0===t&&(t=1),C=w*Math.round(m/w)-w*t,m!==C&&(S=C-m,E=Date.now(),requestAnimationFrame(n))}),void N(this).on("carouselSet",function(e,t){void 0===t&&(t=0),l(t)}))})},next:function(e){N(this).trigger("carouselNext",[e])},prev:function(e){N(this).trigger("carouselPrev",[e])},set:function(e){N(this).trigger("carouselSet",[e])}};N.fn.carousel=function(e){return t[e]?t[e].apply(this,Array.prototype.slice.call(arguments,1)):"object"!=typeof e&&e?void N.error("Method "+e+" does not exist on jQuery.carousel"):t.init.apply(this,arguments)}}(jQuery),function(H){var t={init:function(o){return this.each(function(){var j=H("#"+H(this).attr("data-activates")),z=(H("body"),H(this)),F=z.parent(".tap-target-wrapper"),D=F.find(".tap-target-wave"),t=F.find(".tap-target-origin"),W=z.find(".tap-target-content");F.length||(F=z.wrap(H('<div class="tap-target-wrapper"></div>')).parent()),W.length||(W=H('<div class="tap-target-content"></div>'),z.append(W)),D.length||(D=H('<div class="tap-target-wave"></div>'),t.length||((t=j.clone(!0,!0)).addClass("tap-target-origin"),t.removeAttr("id"),t.removeAttr("style"),D.append(t)),F.append(D));var e=function(){F.is(".open")||(F.addClass("open"),setTimeout(function(){t.off("click.tapTarget").on("click.tapTarget",function(e){i(),t.off("click.tapTarget")}),H(document).off("click.tapTarget").on("click.tapTarget",function(e){i(),H(document).off("click.tapTarget")});var e=Materialize.throttle(function(){n()},200);H(window).off("resize.tapTarget").on("resize.tapTarget",e)},0))},i=function(){F.is(".open")&&(F.removeClass("open"),t.off("click.tapTarget"),H(document).off("click.tapTarget"),H(window).off("resize.tapTarget"))},n=function(){var e="fixed"===j.css("position");if(!e)for(var t=j.parents(),i=0;i<t.length&&!(e="fixed"==H(t[i]).css("position"));i++);var n=j.outerWidth(),o=j.outerHeight(),r=e?j.offset().top-H(document).scrollTop():j.offset().top,a=e?j.offset().left-H(document).scrollLeft():j.offset().left,s=H(window).width(),l=H(window).height(),c=s/2,d=l/2,u=a<=c,p=c<a,f=r<=d,h=d<r,v=.25*s<=a&&a<=.75*s,m=z.outerWidth(),g=z.outerHeight(),y=r+o/2-g/2,b=a+n/2-m/2,w=e?"fixed":"absolute",k=v?m:m/2+n,x=g/2,T=f?g/2:0,S=0,C=u&&!v?m/2-n:0,P=0,A=n,q=h?"bottom":"top",O=2*n,E=O,$=g/2-E/2,I=m/2-O/2,M={};M.top=f?y:"",M.right=p?s-b-m:"",M.bottom=h?l-y-g:"",M.left=u?b:"",M.position=w,F.css(M),W.css({width:k,height:x,top:T,right:0,bottom:0,left:C,padding:A,verticalAlign:q}),D.css({top:$,left:I,width:O,height:E})};"open"==o&&(n(),e()),"close"==o&&i()})},open:function(){},close:function(){}};H.fn.tapTarget=function(e){return t[e]||"object"==typeof e?t.init.apply(this,arguments):void H.error("Method "+e+" does not exist on jQuery.tap-target")}}(jQuery),function(e){"use strict";"function"==typeof define&&define.amd?define(["jquery"],e):"undefined"!=typeof exports?module.exports=e(require("jquery")):e(jQuery)}(function(d){"use strict";var s=window.Slick||{};(s=function(){function e(e,t){var i,n=this;n.defaults={accessibility:!0,adaptiveHeight:!1,appendArrows:d(e),appendDots:d(e),arrows:!0,asNavFor:null,prevArrow:'<button type="button" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button">Previous</button>',nextArrow:'<button type="button" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button">Next</button>',autoplay:!1,autoplaySpeed:3e3,centerMode:!1,centerPadding:"50px",cssEase:"ease",customPaging:function(e,t){return d('<button type="button" data-role="none" role="button" tabindex="0" />').text(t+1)},dots:!1,dotsClass:"slick-dots",draggable:!0,easing:"linear",edgeFriction:.35,fade:!1,focusOnSelect:!1,infinite:!0,initialSlide:0,lazyLoad:"ondemand",mobileFirst:!1,pauseOnHover:!0,pauseOnFocus:!0,pauseOnDotsHover:!1,respondTo:"window",responsive:null,rows:1,rtl:!1,slide:"",slidesPerRow:1,slidesToShow:1,slidesToScroll:1,speed:500,swipe:!0,swipeToSlide:!1,touchMove:!0,touchThreshold:5,useCSS:!0,useTransform:!0,variableWidth:!1,vertical:!1,verticalSwiping:!1,waitForAnimate:!0,zIndex:1e3},n.initials={animating:!1,dragging:!1,autoPlayTimer:null,currentDirection:0,currentLeft:null,currentSlide:0,direction:1,$dots:null,listWidth:null,listHeight:null,loadIndex:0,$nextArrow:null,$prevArrow:null,slideCount:null,slideWidth:null,$slideTrack:null,$slides:null,sliding:!1,slideOffset:0,swipeLeft:null,$list:null,touchObject:{},transformsEnabled:!1,unslicked:!1},d.extend(n,n.initials),n.activeBreakpoint=null,n.animType=null,n.animProp=null,n.breakpoints=[],n.breakpointSettings=[],n.cssTransitions=!1,n.focussed=!1,n.interrupted=!1,n.hidden="hidden",n.paused=!0,n.positionProp=null,n.respondTo=null,n.rowCount=1,n.shouldClick=!0,n.$slider=d(e),n.$slidesCache=null,n.transformType=null,n.transitionType=null,n.visibilityChange="visibilitychange",n.windowWidth=0,n.windowTimer=null,i=d(e).data("slick")||{},n.options=d.extend({},n.defaults,t,i),n.currentSlide=n.options.initialSlide,n.originalSettings=n.options,void 0!==document.mozHidden?(n.hidden="mozHidden",n.visibilityChange="mozvisibilitychange"):void 0!==document.webkitHidden&&(n.hidden="webkitHidden",n.visibilityChange="webkitvisibilitychange"),n.autoPlay=d.proxy(n.autoPlay,n),n.autoPlayClear=d.proxy(n.autoPlayClear,n),n.autoPlayIterator=d.proxy(n.autoPlayIterator,n),n.changeSlide=d.proxy(n.changeSlide,n),n.clickHandler=d.proxy(n.clickHandler,n),n.selectHandler=d.proxy(n.selectHandler,n),n.setPosition=d.proxy(n.setPosition,n),n.swipeHandler=d.proxy(n.swipeHandler,n),n.dragHandler=d.proxy(n.dragHandler,n),n.keyHandler=d.proxy(n.keyHandler,n),n.instanceUid=o++,n.htmlExpr=/^(?:\s*(<[\w\W]+>)[^>]*)$/,n.registerBreakpoints(),n.init(!0)}var o=0;return e}()).prototype.activateADA=function(){var e;this.$slideTrack.find(".slick-active").attr({"aria-hidden":"false"}).find("a, input, button, select").attr({tabindex:"0"})},s.prototype.addSlide=s.prototype.slickAdd=function(e,t,i){var n=this;if("boolean"==typeof t)i=t,t=null;else if(t<0||t>=n.slideCount)return!1;n.unload(),"number"==typeof t?0===t&&0===n.$slides.length?d(e).appendTo(n.$slideTrack):i?d(e).insertBefore(n.$slides.eq(t)):d(e).insertAfter(n.$slides.eq(t)):!0===i?d(e).prependTo(n.$slideTrack):d(e).appendTo(n.$slideTrack),n.$slides=n.$slideTrack.children(this.options.slide),n.$slideTrack.children(this.options.slide).detach(),n.$slideTrack.append(n.$slides),n.$slides.each(function(e,t){d(t).attr("data-slick-index",e)}),n.$slidesCache=n.$slides,n.reinit()},s.prototype.animateHeight=function(){var e=this;if(1===e.options.slidesToShow&&!0===e.options.adaptiveHeight&&!1===e.options.vertical){var t=e.$slides.eq(e.currentSlide).outerHeight(!0);e.$list.animate({height:t},e.options.speed)}},s.prototype.animateSlide=function(e,t){var i={},n=this;n.animateHeight(),!0===n.options.rtl&&!1===n.options.vertical&&(e=-e),!1===n.transformsEnabled?!1===n.options.vertical?n.$slideTrack.animate({left:e},n.options.speed,n.options.easing,t):n.$slideTrack.animate({top:e},n.options.speed,n.options.easing,t):!1===n.cssTransitions?(!0===n.options.rtl&&(n.currentLeft=-n.currentLeft),d({animStart:n.currentLeft}).animate({animStart:e},{duration:n.options.speed,easing:n.options.easing,step:function(e){e=Math.ceil(e),!1===n.options.vertical?i[n.animType]="translate("+e+"px, 0px)":i[n.animType]="translate(0px,"+e+"px)",n.$slideTrack.css(i)},complete:function(){t&&t.call()}})):(n.applyTransition(),e=Math.ceil(e),!1===n.options.vertical?i[n.animType]="translate3d("+e+"px, 0px, 0px)":i[n.animType]="translate3d(0px,"+e+"px, 0px)",n.$slideTrack.css(i),t&&setTimeout(function(){n.disableTransition(),t.call()},n.options.speed))},s.prototype.getNavTarget=function(){var e=this,t=e.options.asNavFor;return t&&null!==t&&(t=d(t).not(e.$slider)),t},s.prototype.asNavFor=function(t){var e,i=this.getNavTarget();null!==i&&"object"==typeof i&&i.each(function(){var e=d(this).slick("getSlick");e.unslicked||e.slideHandler(t,!0)})},s.prototype.applyTransition=function(e){var t=this,i={};!1===t.options.fade?i[t.transitionType]=t.transformType+" "+t.options.speed+"ms "+t.options.cssEase:i[t.transitionType]="opacity "+t.options.speed+"ms "+t.options.cssEase,!1===t.options.fade?t.$slideTrack.css(i):t.$slides.eq(e).css(i)},s.prototype.autoPlay=function(){var e=this;e.autoPlayClear(),e.slideCount>e.options.slidesToShow&&(e.autoPlayTimer=setInterval(e.autoPlayIterator,e.options.autoplaySpeed))},s.prototype.autoPlayClear=function(){var e=this;e.autoPlayTimer&&clearInterval(e.autoPlayTimer)},s.prototype.autoPlayIterator=function(){var e=this,t=e.currentSlide+e.options.slidesToScroll;e.paused||e.interrupted||e.focussed||(!1===e.options.infinite&&(1===e.direction&&e.currentSlide+1===e.slideCount-1?e.direction=0:0===e.direction&&(t=e.currentSlide-e.options.slidesToScroll,e.currentSlide-1==0&&(e.direction=1))),e.slideHandler(t))},s.prototype.buildArrows=function(){var e=this;!0===e.options.arrows&&(e.$prevArrow=d(e.options.prevArrow).addClass("slick-arrow"),e.$nextArrow=d(e.options.nextArrow).addClass("slick-arrow"),e.slideCount>e.options.slidesToShow?(e.$prevArrow.removeClass("slick-hidden").removeAttr("aria-hidden tabindex"),e.$nextArrow.removeClass("slick-hidden").removeAttr("aria-hidden tabindex"),e.htmlExpr.test(e.options.prevArrow)&&e.$prevArrow.prependTo(e.options.appendArrows),e.htmlExpr.test(e.options.nextArrow)&&e.$nextArrow.appendTo(e.options.appendArrows),!0!==e.options.infinite&&e.$prevArrow.addClass("slick-disabled").attr("aria-disabled","true")):e.$prevArrow.add(e.$nextArrow).addClass("slick-hidden").attr({"aria-disabled":"true",tabindex:"-1"}))},s.prototype.buildDots=function(){var e,t,i=this;if(!0===i.options.dots&&i.slideCount>i.options.slidesToShow){for(i.$slider.addClass("slick-dotted"),t=d("<ul />").addClass(i.options.dotsClass),e=0;e<=i.getDotCount();e+=1)t.append(d("<li />").append(i.options.customPaging.call(this,i,e)));i.$dots=t.appendTo(i.options.appendDots),i.$dots.find("li").first().addClass("slick-active").attr("aria-hidden","false")}},s.prototype.buildOut=function(){var e=this;e.$slides=e.$slider.children(e.options.slide+":not(.slick-cloned)").addClass("slick-slide"),e.slideCount=e.$slides.length,e.$slides.each(function(e,t){d(t).attr("data-slick-index",e).data("originalStyling",d(t).attr("style")||"")}),e.$slider.addClass("slick-slider"),e.$slideTrack=0===e.slideCount?d('<div class="slick-track"/>').appendTo(e.$slider):e.$slides.wrapAll('<div class="slick-track"/>').parent(),e.$list=e.$slideTrack.wrap('<div aria-live="polite" class="slick-list"/>').parent(),e.$slideTrack.css("opacity",0),(!0===e.options.centerMode||!0===e.options.swipeToSlide)&&(e.options.slidesToScroll=1),d("img[data-lazy]",e.$slider).not("[src]").addClass("slick-loading"),e.setupInfinite(),e.buildArrows(),e.buildDots(),e.updateDots(),e.setSlideClasses("number"==typeof e.currentSlide?e.currentSlide:0),!0===e.options.draggable&&e.$list.addClass("draggable")},s.prototype.buildRows=function(){var e,t,i,n,o,r,a,s=this;if(n=document.createDocumentFragment(),r=s.$slider.children(),1<s.options.rows){for(a=s.options.slidesPerRow*s.options.rows,o=Math.ceil(r.length/a),e=0;e<o;e++){var l=document.createElement("div");for(t=0;t<s.options.rows;t++){var c=document.createElement("div");for(i=0;i<s.options.slidesPerRow;i++){var d=e*a+(t*s.options.slidesPerRow+i);r.get(d)&&c.appendChild(r.get(d))}l.appendChild(c)}n.appendChild(l)}s.$slider.empty().append(n),s.$slider.children().children().children().css({width:100/s.options.slidesPerRow+"%",display:"inline-block"})}},s.prototype.checkResponsive=function(e,t){var i,n,o,r=this,a=!1,s=r.$slider.width(),l=window.innerWidth||d(window).width();if("window"===r.respondTo?o=l:"slider"===r.respondTo?o=s:"min"===r.respondTo&&(o=Math.min(l,s)),r.options.responsive&&r.options.responsive.length&&null!==r.options.responsive){for(i in n=null,r.breakpoints)r.breakpoints.hasOwnProperty(i)&&(!1===r.originalSettings.mobileFirst?o<r.breakpoints[i]&&(n=r.breakpoints[i]):o>r.breakpoints[i]&&(n=r.breakpoints[i]));null!==n?null!==r.activeBreakpoint?(n!==r.activeBreakpoint||t)&&(r.activeBreakpoint=n,"unslick"===r.breakpointSettings[n]?r.unslick(n):(r.options=d.extend({},r.originalSettings,r.breakpointSettings[n]),!0===e&&(r.currentSlide=r.options.initialSlide),r.refresh(e)),a=n):(r.activeBreakpoint=n,"unslick"===r.breakpointSettings[n]?r.unslick(n):(r.options=d.extend({},r.originalSettings,r.breakpointSettings[n]),!0===e&&(r.currentSlide=r.options.initialSlide),r.refresh(e)),a=n):null!==r.activeBreakpoint&&(r.activeBreakpoint=null,r.options=r.originalSettings,!0===e&&(r.currentSlide=r.options.initialSlide),r.refresh(e),a=n),e||!1===a||r.$slider.trigger("breakpoint",[r,a])}},s.prototype.changeSlide=function(e,t){var i,n,o,r=this,a=d(e.currentTarget);switch(a.is("a")&&e.preventDefault(),a.is("li")||(a=a.closest("li")),i=(o=r.slideCount%r.options.slidesToScroll!=0)?0:(r.slideCount-r.currentSlide)%r.options.slidesToScroll,e.data.message){case"previous":n=0===i?r.options.slidesToScroll:r.options.slidesToShow-i,r.slideCount>r.options.slidesToShow&&r.slideHandler(r.currentSlide-n,!1,t);break;case"next":n=0===i?r.options.slidesToScroll:i,r.slideCount>r.options.slidesToShow&&r.slideHandler(r.currentSlide+n,!1,t);break;case"index":var s=0===e.data.index?0:e.data.index||a.index()*r.options.slidesToScroll;r.slideHandler(r.checkNavigable(s),!1,t),a.children().trigger("focus");break;default:return}},s.prototype.checkNavigable=function(e){var t,i,n;if(i=0,e>(t=this.getNavigableIndexes())[t.length-1])e=t[t.length-1];else for(var o in t){if(e<t[o]){e=i;break}i=t[o]}return e},s.prototype.cleanUpEvents=function(){var e=this;e.options.dots&&null!==e.$dots&&d("li",e.$dots).off("click.slick",e.changeSlide).off("mouseenter.slick",d.proxy(e.interrupt,e,!0)).off("mouseleave.slick",d.proxy(e.interrupt,e,!1)),e.$slider.off("focus.slick blur.slick"),!0===e.options.arrows&&e.slideCount>e.options.slidesToShow&&(e.$prevArrow&&e.$prevArrow.off("click.slick",e.changeSlide),e.$nextArrow&&e.$nextArrow.off("click.slick",e.changeSlide)),e.$list.off("touchstart.slick mousedown.slick",e.swipeHandler),e.$list.off("touchmove.slick mousemove.slick",e.swipeHandler),e.$list.off("touchend.slick mouseup.slick",e.swipeHandler),e.$list.off("touchcancel.slick mouseleave.slick",e.swipeHandler),e.$list.off("click.slick",e.clickHandler),d(document).off(e.visibilityChange,e.visibility),e.cleanUpSlideEvents(),!0===e.options.accessibility&&e.$list.off("keydown.slick",e.keyHandler),!0===e.options.focusOnSelect&&d(e.$slideTrack).children().off("click.slick",e.selectHandler),d(window).off("orientationchange.slick.slick-"+e.instanceUid,e.orientationChange),d(window).off(
"resize.slick.slick-"+e.instanceUid,e.resize),d("[draggable!=true]",e.$slideTrack).off("dragstart",e.preventDefault),d(window).off("load.slick.slick-"+e.instanceUid,e.setPosition),d(document).off("ready.slick.slick-"+e.instanceUid,e.setPosition)},s.prototype.cleanUpSlideEvents=function(){var e=this;e.$list.off("mouseenter.slick",d.proxy(e.interrupt,e,!0)),e.$list.off("mouseleave.slick",d.proxy(e.interrupt,e,!1))},s.prototype.cleanUpRows=function(){var e,t=this;1<t.options.rows&&((e=t.$slides.children().children()).removeAttr("style"),t.$slider.empty().append(e))},s.prototype.clickHandler=function(e){var t;!1===this.shouldClick&&(e.stopImmediatePropagation(),e.stopPropagation(),e.preventDefault())},s.prototype.destroy=function(e){var t=this;t.autoPlayClear(),t.touchObject={},t.cleanUpEvents(),d(".slick-cloned",t.$slider).detach(),t.$dots&&t.$dots.remove(),t.$prevArrow&&t.$prevArrow.length&&(t.$prevArrow.removeClass("slick-disabled slick-arrow slick-hidden").removeAttr("aria-hidden aria-disabled tabindex").css("display",""),t.htmlExpr.test(t.options.prevArrow)&&t.$prevArrow.remove()),t.$nextArrow&&t.$nextArrow.length&&(t.$nextArrow.removeClass("slick-disabled slick-arrow slick-hidden").removeAttr("aria-hidden aria-disabled tabindex").css("display",""),t.htmlExpr.test(t.options.nextArrow)&&t.$nextArrow.remove()),t.$slides&&(t.$slides.removeClass("slick-slide slick-active slick-center slick-visible slick-current").removeAttr("aria-hidden").removeAttr("data-slick-index").each(function(){d(this).attr("style",d(this).data("originalStyling"))}),t.$slideTrack.children(this.options.slide).detach(),t.$slideTrack.detach(),t.$list.detach(),t.$slider.append(t.$slides)),t.cleanUpRows(),t.$slider.removeClass("slick-slider"),t.$slider.removeClass("slick-initialized"),t.$slider.removeClass("slick-dotted"),t.unslicked=!0,e||t.$slider.trigger("destroy",[t])},s.prototype.disableTransition=function(e){var t=this,i={};i[t.transitionType]="",!1===t.options.fade?t.$slideTrack.css(i):t.$slides.eq(e).css(i)},s.prototype.fadeSlide=function(e,t){var i=this;!1===i.cssTransitions?(i.$slides.eq(e).css({zIndex:i.options.zIndex}),i.$slides.eq(e).animate({opacity:1},i.options.speed,i.options.easing,t)):(i.applyTransition(e),i.$slides.eq(e).css({opacity:1,zIndex:i.options.zIndex}),t&&setTimeout(function(){i.disableTransition(e),t.call()},i.options.speed))},s.prototype.fadeSlideOut=function(e){var t=this;!1===t.cssTransitions?t.$slides.eq(e).animate({opacity:0,zIndex:t.options.zIndex-2},t.options.speed,t.options.easing):(t.applyTransition(e),t.$slides.eq(e).css({opacity:0,zIndex:t.options.zIndex-2}))},s.prototype.filterSlides=s.prototype.slickFilter=function(e){var t=this;null!==e&&(t.$slidesCache=t.$slides,t.unload(),t.$slideTrack.children(this.options.slide).detach(),t.$slidesCache.filter(e).appendTo(t.$slideTrack),t.reinit())},s.prototype.focusHandler=function(){var i=this;i.$slider.off("focus.slick blur.slick").on("focus.slick blur.slick","*:not(.slick-arrow)",function(e){e.stopImmediatePropagation();var t=d(this);setTimeout(function(){i.options.pauseOnFocus&&(i.focussed=t.is(":focus"),i.autoPlay())},0)})},s.prototype.getCurrent=s.prototype.slickCurrentSlide=function(){var e;return this.currentSlide},s.prototype.getDotCount=function(){var e=this,t=0,i=0,n=0;if(!0===e.options.infinite)for(;t<e.slideCount;)++n,t=i+e.options.slidesToScroll,i+=e.options.slidesToScroll<=e.options.slidesToShow?e.options.slidesToScroll:e.options.slidesToShow;else if(!0===e.options.centerMode)n=e.slideCount;else if(e.options.asNavFor)for(;t<e.slideCount;)++n,t=i+e.options.slidesToScroll,i+=e.options.slidesToScroll<=e.options.slidesToShow?e.options.slidesToScroll:e.options.slidesToShow;else n=1+Math.ceil((e.slideCount-e.options.slidesToShow)/e.options.slidesToScroll);return n-1},s.prototype.getLeft=function(e){var t,i,n,o=this,r=0;return o.slideOffset=0,i=o.$slides.first().outerHeight(!0),!0===o.options.infinite?(o.slideCount>o.options.slidesToShow&&(o.slideOffset=o.slideWidth*o.options.slidesToShow*-1,r=i*o.options.slidesToShow*-1),o.slideCount%o.options.slidesToScroll!=0&&e+o.options.slidesToScroll>o.slideCount&&o.slideCount>o.options.slidesToShow&&(r=e>o.slideCount?(o.slideOffset=(o.options.slidesToShow-(e-o.slideCount))*o.slideWidth*-1,(o.options.slidesToShow-(e-o.slideCount))*i*-1):(o.slideOffset=o.slideCount%o.options.slidesToScroll*o.slideWidth*-1,o.slideCount%o.options.slidesToScroll*i*-1))):e+o.options.slidesToShow>o.slideCount&&(o.slideOffset=(e+o.options.slidesToShow-o.slideCount)*o.slideWidth,r=(e+o.options.slidesToShow-o.slideCount)*i),o.slideCount<=o.options.slidesToShow&&(r=o.slideOffset=0),!0===o.options.centerMode&&!0===o.options.infinite?o.slideOffset+=o.slideWidth*Math.floor(o.options.slidesToShow/2)-o.slideWidth:!0===o.options.centerMode&&(o.slideOffset=0,o.slideOffset+=o.slideWidth*Math.floor(o.options.slidesToShow/2)),t=!1===o.options.vertical?e*o.slideWidth*-1+o.slideOffset:e*i*-1+r,!0===o.options.variableWidth&&(n=o.slideCount<=o.options.slidesToShow||!1===o.options.infinite?o.$slideTrack.children(".slick-slide").eq(e):o.$slideTrack.children(".slick-slide").eq(e+o.options.slidesToShow),t=!0===o.options.rtl?n[0]?-1*(o.$slideTrack.width()-n[0].offsetLeft-n.width()):0:n[0]?-1*n[0].offsetLeft:0,!0===o.options.centerMode&&(n=o.slideCount<=o.options.slidesToShow||!1===o.options.infinite?o.$slideTrack.children(".slick-slide").eq(e):o.$slideTrack.children(".slick-slide").eq(e+o.options.slidesToShow+1),t=!0===o.options.rtl?n[0]?-1*(o.$slideTrack.width()-n[0].offsetLeft-n.width()):0:n[0]?-1*n[0].offsetLeft:0,t+=(o.$list.width()-n.outerWidth())/2)),t},s.prototype.getOption=s.prototype.slickGetOption=function(e){var t;return this.options[e]},s.prototype.getNavigableIndexes=function(){var e,t=this,i=0,n=0,o=[];for(e=!1===t.options.infinite?t.slideCount:(i=-1*t.options.slidesToScroll,n=-1*t.options.slidesToScroll,2*t.slideCount);i<e;)o.push(i),i=n+t.options.slidesToScroll,n+=t.options.slidesToScroll<=t.options.slidesToShow?t.options.slidesToScroll:t.options.slidesToShow;return o},s.prototype.getSlick=function(){return this},s.prototype.getSlideCount=function(){var e,i,n,o=this;return n=!0===o.options.centerMode?o.slideWidth*Math.floor(o.options.slidesToShow/2):0,!0===o.options.swipeToSlide?(o.$slideTrack.find(".slick-slide").each(function(e,t){return t.offsetLeft-n+d(t).outerWidth()/2>-1*o.swipeLeft?(i=t,!1):void 0}),e=Math.abs(d(i).attr("data-slick-index")-o.currentSlide)||1):o.options.slidesToScroll},s.prototype.goTo=s.prototype.slickGoTo=function(e,t){var i;this.changeSlide({data:{message:"index",index:parseInt(e)}},t)},s.prototype.init=function(e){var t=this;d(t.$slider).hasClass("slick-initialized")||(d(t.$slider).addClass("slick-initialized"),t.buildRows(),t.buildOut(),t.setProps(),t.startLoad(),t.loadSlider(),t.initializeEvents(),t.updateArrows(),t.updateDots(),t.checkResponsive(!0),t.focusHandler()),e&&t.$slider.trigger("init",[t]),!0===t.options.accessibility&&t.initADA(),t.options.autoplay&&(t.paused=!1,t.autoPlay())},s.prototype.initADA=function(){var t=this;t.$slides.add(t.$slideTrack.find(".slick-cloned")).attr({"aria-hidden":"true",tabindex:"-1"}).find("a, input, button, select").attr({tabindex:"-1"}),t.$slideTrack.attr("role","listbox"),t.$slides.not(t.$slideTrack.find(".slick-cloned")).each(function(e){d(this).attr({role:"option","aria-describedby":"slick-slide"+t.instanceUid+e})}),null!==t.$dots&&t.$dots.attr("role","tablist").find("li").each(function(e){d(this).attr({role:"presentation","aria-selected":"false","aria-controls":"navigation"+t.instanceUid+e,id:"slick-slide"+t.instanceUid+e})}).first().attr("aria-selected","true").end().find("button").attr("role","button").end().closest("div").attr("role","toolbar"),t.activateADA()},s.prototype.initArrowEvents=function(){var e=this;!0===e.options.arrows&&e.slideCount>e.options.slidesToShow&&(e.$prevArrow.off("click.slick").on("click.slick",{message:"previous"},e.changeSlide),e.$nextArrow.off("click.slick").on("click.slick",{message:"next"},e.changeSlide))},s.prototype.initDotEvents=function(){var e=this;!0===e.options.dots&&e.slideCount>e.options.slidesToShow&&d("li",e.$dots).on("click.slick",{message:"index"},e.changeSlide),!0===e.options.dots&&!0===e.options.pauseOnDotsHover&&d("li",e.$dots).on("mouseenter.slick",d.proxy(e.interrupt,e,!0)).on("mouseleave.slick",d.proxy(e.interrupt,e,!1))},s.prototype.initSlideEvents=function(){var e=this;e.options.pauseOnHover&&(e.$list.on("mouseenter.slick",d.proxy(e.interrupt,e,!0)),e.$list.on("mouseleave.slick",d.proxy(e.interrupt,e,!1)))},s.prototype.initializeEvents=function(){var e=this;e.initArrowEvents(),e.initDotEvents(),e.initSlideEvents(),e.$list.on("touchstart.slick mousedown.slick",{action:"start"},e.swipeHandler),e.$list.on("touchmove.slick mousemove.slick",{action:"move"},e.swipeHandler),e.$list.on("touchend.slick mouseup.slick",{action:"end"},e.swipeHandler),e.$list.on("touchcancel.slick mouseleave.slick",{action:"end"},e.swipeHandler),e.$list.on("click.slick",e.clickHandler),d(document).on(e.visibilityChange,d.proxy(e.visibility,e)),!0===e.options.accessibility&&e.$list.on("keydown.slick",e.keyHandler),!0===e.options.focusOnSelect&&d(e.$slideTrack).children().on("click.slick",e.selectHandler),d(window).on("orientationchange.slick.slick-"+e.instanceUid,d.proxy(e.orientationChange,e)),d(window).on("resize.slick.slick-"+e.instanceUid,d.proxy(e.resize,e)),d("[draggable!=true]",e.$slideTrack).on("dragstart",e.preventDefault),d(window).on("load.slick.slick-"+e.instanceUid,e.setPosition),d(document).on("ready.slick.slick-"+e.instanceUid,e.setPosition)},s.prototype.initUI=function(){var e=this;!0===e.options.arrows&&e.slideCount>e.options.slidesToShow&&(e.$prevArrow.show(),e.$nextArrow.show()),!0===e.options.dots&&e.slideCount>e.options.slidesToShow&&e.$dots.show()},s.prototype.keyHandler=function(e){var t=this;e.target.tagName.match("TEXTAREA|INPUT|SELECT")||(37===e.keyCode&&!0===t.options.accessibility?t.changeSlide({data:{message:!0===t.options.rtl?"next":"previous"}}):39===e.keyCode&&!0===t.options.accessibility&&t.changeSlide({data:{message:!0===t.options.rtl?"previous":"next"}}))},s.prototype.lazyLoad=function(){function e(e){d("img[data-lazy]",e).each(function(){var e=d(this),t=d(this).attr("data-lazy"),i=document.createElement("img");i.onload=function(){e.animate({opacity:0},100,function(){e.attr("src",t).animate({opacity:1},200,function(){e.removeAttr("data-lazy").removeClass("slick-loading")}),r.$slider.trigger("lazyLoaded",[r,e,t])})},i.onerror=function(){e.removeAttr("data-lazy").removeClass("slick-loading").addClass("slick-lazyload-error"),r.$slider.trigger("lazyLoadError",[r,e,t])},i.src=t})}var t,i,n,o,r=this;!0===r.options.centerMode?o=!0===r.options.infinite?(n=r.currentSlide+(r.options.slidesToShow/2+1))+r.options.slidesToShow+2:(n=Math.max(0,r.currentSlide-(r.options.slidesToShow/2+1)),r.options.slidesToShow/2+1+2+r.currentSlide):(n=r.options.infinite?r.options.slidesToShow+r.currentSlide:r.currentSlide,o=Math.ceil(n+r.options.slidesToShow),!0===r.options.fade&&(0<n&&n--,o<=r.slideCount&&o++)),e(t=r.$slider.find(".slick-slide").slice(n,o)),r.slideCount<=r.options.slidesToShow?e(i=r.$slider.find(".slick-slide")):r.currentSlide>=r.slideCount-r.options.slidesToShow?e(i=r.$slider.find(".slick-cloned").slice(0,r.options.slidesToShow)):0===r.currentSlide&&e(i=r.$slider.find(".slick-cloned").slice(-1*r.options.slidesToShow))},s.prototype.loadSlider=function(){var e=this;e.setPosition(),e.$slideTrack.css({opacity:1}),e.$slider.removeClass("slick-loading"),e.initUI(),"progressive"===e.options.lazyLoad&&e.progressiveLazyLoad()},s.prototype.next=s.prototype.slickNext=function(){var e;this.changeSlide({data:{message:"next"}})},s.prototype.orientationChange=function(){var e=this;e.checkResponsive(),e.setPosition()},s.prototype.pause=s.prototype.slickPause=function(){var e=this;e.autoPlayClear(),e.paused=!0},s.prototype.play=s.prototype.slickPlay=function(){var e=this;e.autoPlay(),e.options.autoplay=!0,e.paused=!1,e.focussed=!1,e.interrupted=!1},s.prototype.postSlide=function(e){var t=this;t.unslicked||(t.$slider.trigger("afterChange",[t,e]),t.animating=!1,t.setPosition(),t.swipeLeft=null,t.options.autoplay&&t.autoPlay(),!0===t.options.accessibility&&t.initADA())},s.prototype.prev=s.prototype.slickPrev=function(){var e;this.changeSlide({data:{message:"previous"}})},s.prototype.preventDefault=function(e){e.preventDefault()},s.prototype.progressiveLazyLoad=function(e){e=e||1;var t,i,n,o=this,r=d("img[data-lazy]",o.$slider);r.length?(t=r.first(),i=t.attr("data-lazy"),(n=document.createElement("img")).onload=function(){t.attr("src",i).removeAttr("data-lazy").removeClass("slick-loading"),!0===o.options.adaptiveHeight&&o.setPosition(),o.$slider.trigger("lazyLoaded",[o,t,i]),o.progressiveLazyLoad()},n.onerror=function(){e<3?setTimeout(function(){o.progressiveLazyLoad(e+1)},500):(t.removeAttr("data-lazy").removeClass("slick-loading").addClass("slick-lazyload-error"),o.$slider.trigger("lazyLoadError",[o,t,i]),o.progressiveLazyLoad())},n.src=i):o.$slider.trigger("allImagesLoaded",[o])},s.prototype.refresh=function(e){var t,i,n=this;i=n.slideCount-n.options.slidesToShow,!n.options.infinite&&n.currentSlide>i&&(n.currentSlide=i),n.slideCount<=n.options.slidesToShow&&(n.currentSlide=0),t=n.currentSlide,n.destroy(!0),d.extend(n,n.initials,{currentSlide:t}),n.init(),e||n.changeSlide({data:{message:"index",index:t}},!1)},s.prototype.registerBreakpoints=function(){var e,t,i,n=this,o=n.options.responsive||null;if("array"===d.type(o)&&o.length){for(e in n.respondTo=n.options.respondTo||"window",o)if(i=n.breakpoints.length-1,t=o[e].breakpoint,o.hasOwnProperty(e)){for(;0<=i;)n.breakpoints[i]&&n.breakpoints[i]===t&&n.breakpoints.splice(i,1),i--;n.breakpoints.push(t),n.breakpointSettings[t]=o[e].settings}n.breakpoints.sort(function(e,t){return n.options.mobileFirst?e-t:t-e})}},s.prototype.reinit=function(){var e=this;e.$slides=e.$slideTrack.children(e.options.slide).addClass("slick-slide"),e.slideCount=e.$slides.length,e.currentSlide>=e.slideCount&&0!==e.currentSlide&&(e.currentSlide=e.currentSlide-e.options.slidesToScroll),e.slideCount<=e.options.slidesToShow&&(e.currentSlide=0),e.registerBreakpoints(),e.setProps(),e.setupInfinite(),e.buildArrows(),e.updateArrows(),e.initArrowEvents(),e.buildDots(),e.updateDots(),e.initDotEvents(),e.cleanUpSlideEvents(),e.initSlideEvents(),e.checkResponsive(!1,!0),!0===e.options.focusOnSelect&&d(e.$slideTrack).children().on("click.slick",e.selectHandler),e.setSlideClasses("number"==typeof e.currentSlide?e.currentSlide:0),e.setPosition(),e.focusHandler(),e.paused=!e.options.autoplay,e.autoPlay(),e.$slider.trigger("reInit",[e])},s.prototype.resize=function(){var e=this;d(window).width()!==e.windowWidth&&(clearTimeout(e.windowDelay),e.windowDelay=window.setTimeout(function(){e.windowWidth=d(window).width(),e.checkResponsive(),e.unslicked||e.setPosition()},50))},s.prototype.removeSlide=s.prototype.slickRemove=function(e,t,i){var n=this;return e="boolean"==typeof e?!0===(t=e)?0:n.slideCount-1:!0===t?--e:e,!(n.slideCount<1||e<0||e>n.slideCount-1)&&(n.unload(),!0===i?n.$slideTrack.children().remove():n.$slideTrack.children(this.options.slide).eq(e).remove(),n.$slides=n.$slideTrack.children(this.options.slide),n.$slideTrack.children(this.options.slide).detach(),n.$slideTrack.append(n.$slides),n.$slidesCache=n.$slides,void n.reinit())},s.prototype.setCSS=function(e){var t,i,n=this,o={};!0===n.options.rtl&&(e=-e),t="left"==n.positionProp?Math.ceil(e)+"px":"0px",i="top"==n.positionProp?Math.ceil(e)+"px":"0px",o[n.positionProp]=e,!1===n.transformsEnabled||(!(o={})===n.cssTransitions?o[n.animType]="translate("+t+", "+i+")":o[n.animType]="translate3d("+t+", "+i+", 0px)"),n.$slideTrack.css(o)},s.prototype.setDimensions=function(){var e=this;!1===e.options.vertical?!0===e.options.centerMode&&e.$list.css({padding:"0px "+e.options.centerPadding}):(e.$list.height(e.$slides.first().outerHeight(!0)*e.options.slidesToShow),!0===e.options.centerMode&&e.$list.css({padding:e.options.centerPadding+" 0px"})),e.listWidth=e.$list.width(),e.listHeight=e.$list.height(),!1===e.options.vertical&&!1===e.options.variableWidth?(e.slideWidth=Math.ceil(e.listWidth/e.options.slidesToShow),e.$slideTrack.width(Math.ceil(e.slideWidth*e.$slideTrack.children(".slick-slide").length))):!0===e.options.variableWidth?e.$slideTrack.width(5e3*e.slideCount):(e.slideWidth=Math.ceil(e.listWidth),e.$slideTrack.height(Math.ceil(e.$slides.first().outerHeight(!0)*e.$slideTrack.children(".slick-slide").length)));var t=e.$slides.first().outerWidth(!0)-e.$slides.first().width();!1===e.options.variableWidth&&e.$slideTrack.children(".slick-slide").width(e.slideWidth-t)},s.prototype.setFade=function(){var i,n=this;n.$slides.each(function(e,t){i=n.slideWidth*e*-1,!0===n.options.rtl?d(t).css({position:"relative",right:i,top:0,zIndex:n.options.zIndex-2,opacity:0}):d(t).css({position:"relative",left:i,top:0,zIndex:n.options.zIndex-2,opacity:0})}),n.$slides.eq(n.currentSlide).css({zIndex:n.options.zIndex-1,opacity:1})},s.prototype.setHeight=function(){var e=this;if(1===e.options.slidesToShow&&!0===e.options.adaptiveHeight&&!1===e.options.vertical){var t=e.$slides.eq(e.currentSlide).outerHeight(!0);e.$list.css("height",t)}},s.prototype.setOption=s.prototype.slickSetOption=function(e,t,i){var n,o,r,a,s,l=this,c=!1;if("object"===d.type(e)?(r=e,c=t,s="multiple"):"string"===d.type(e)&&(a=t,c=i,"responsive"===(r=e)&&"array"===d.type(t)?s="responsive":void 0!==t&&(s="single")),"single"===s)l.options[r]=a;else if("multiple"===s)d.each(r,function(e,t){l.options[e]=t});else if("responsive"===s)for(o in a)if("array"!==d.type(l.options.responsive))l.options.responsive=[a[o]];else{for(n=l.options.responsive.length-1;0<=n;)l.options.responsive[n].breakpoint===a[o].breakpoint&&l.options.responsive.splice(n,1),n--;l.options.responsive.push(a[o])}c&&(l.unload(),l.reinit())},s.prototype.setPosition=function(){var e=this;e.setDimensions(),e.setHeight(),!1===e.options.fade?e.setCSS(e.getLeft(e.currentSlide)):e.setFade(),e.$slider.trigger("setPosition",[e])},s.prototype.setProps=function(){var e=this,t=document.body.style;e.positionProp=!0===e.options.vertical?"top":"left","top"===e.positionProp?e.$slider.addClass("slick-vertical"):e.$slider.removeClass("slick-vertical"),(void 0!==t.WebkitTransition||void 0!==t.MozTransition||void 0!==t.msTransition)&&!0===e.options.useCSS&&(e.cssTransitions=!0),e.options.fade&&("number"==typeof e.options.zIndex?e.options.zIndex<3&&(e.options.zIndex=3):e.options.zIndex=e.defaults.zIndex),void 0!==t.OTransform&&(e.animType="OTransform",e.transformType="-o-transform",e.transitionType="OTransition",void 0===t.perspectiveProperty&&void 0===t.webkitPerspective&&(e.animType=!1)),void 0!==t.MozTransform&&(e.animType="MozTransform",e.transformType="-moz-transform",e.transitionType="MozTransition",void 0===t.perspectiveProperty&&void 0===t.MozPerspective&&(e.animType=!1)),void 0!==t.webkitTransform&&(e.animType="webkitTransform",e.transformType="-webkit-transform",e.transitionType="webkitTransition",void 0===t.perspectiveProperty&&void 0===t.webkitPerspective&&(e.animType=!1)),void 0!==t.msTransform&&(e.animType="msTransform",e.transformType="-ms-transform",e.transitionType="msTransition",void 0===t.msTransform&&(e.animType=!1)),void 0!==t.transform&&!1!==e.animType&&(e.animType="transform",e.transformType="transform",e.transitionType="transition"),e.transformsEnabled=e.options.useTransform&&null!==e.animType&&!1!==e.animType},s.prototype.setSlideClasses=function(e){var t,i,n,o,r=this;i=r.$slider.find(".slick-slide").removeClass("slick-active slick-center slick-current").attr("aria-hidden","true"),r.$slides.eq(e).addClass("slick-current"),!0===r.options.centerMode?(t=Math.floor(r.options.slidesToShow/2),!0===r.options.infinite&&(t<=e&&e<=r.slideCount-1-t?r.$slides.slice(e-t,e+t+1).addClass("slick-active").attr("aria-hidden","false"):(n=r.options.slidesToShow+e,i.slice(n-t+1,n+t+2).addClass("slick-active").attr("aria-hidden","false")),0===e?i.eq(i.length-1-r.options.slidesToShow).addClass("slick-center"):e===r.slideCount-1&&i.eq(r.options.slidesToShow).addClass("slick-center")),r.$slides.eq(e).addClass("slick-center")):0<=e&&e<=r.slideCount-r.options.slidesToShow?r.$slides.slice(e,e+r.options.slidesToShow).addClass("slick-active").attr("aria-hidden","false"):i.length<=r.options.slidesToShow?i.addClass("slick-active").attr("aria-hidden","false"):(o=r.slideCount%r.options.slidesToShow,n=!0===r.options.infinite?r.options.slidesToShow+e:e,r.options.slidesToShow==r.options.slidesToScroll&&r.slideCount-e<r.options.slidesToShow?i.slice(n-(r.options.slidesToShow-o),n+o).addClass("slick-active").attr("aria-hidden","false"):i.slice(n,n+r.options.slidesToShow).addClass("slick-active").attr("aria-hidden","false")),"ondemand"===r.options.lazyLoad&&r.lazyLoad()},s.prototype.setupInfinite=function(){var e,t,i,n=this;if(!0===n.options.fade&&(n.options.centerMode=!1),!0===n.options.infinite&&!1===n.options.fade&&(t=null,n.slideCount>n.options.slidesToShow)){for(i=!0===n.options.centerMode?n.options.slidesToShow+1:n.options.slidesToShow,e=n.slideCount;e>n.slideCount-i;e-=1)t=e-1,d(n.$slides[t]).clone(!0).attr("id","").attr("data-slick-index",t-n.slideCount).prependTo(n.$slideTrack).addClass("slick-cloned");for(e=0;e<i;e+=1)t=e,d(n.$slides[t]).clone(!0).attr("id","").attr("data-slick-index",t+n.slideCount).appendTo(n.$slideTrack).addClass("slick-cloned");n.$slideTrack.find(".slick-cloned").find("[id]").each(function(){d(this).attr("id","")})}},s.prototype.interrupt=function(e){var t=this;e||t.autoPlay(),t.interrupted=e},s.prototype.selectHandler=function(e){var t=this,i=d(e.target).is(".slick-slide")?d(e.target):d(e.target).parents(".slick-slide"),n=parseInt(i.attr("data-slick-index"));return n||(n=0),t.slideCount<=t.options.slidesToShow?(t.setSlideClasses(n),void t.asNavFor(n)):void t.slideHandler(n)},s.prototype.slideHandler=function(e,t,i){var n,o,r,a,s,l=null,c=this;return t=t||!1,!0===c.animating&&!0===c.options.waitForAnimate||!0===c.options.fade&&c.currentSlide===e||c.slideCount<=c.options.slidesToShow?void 0:(!1===t&&c.asNavFor(e),n=e,l=c.getLeft(n),a=c.getLeft(c.currentSlide),c.currentLeft=null===c.swipeLeft?a:c.swipeLeft,!1===c.options.infinite&&!1===c.options.centerMode&&(e<0||e>c.getDotCount()*c.options.slidesToScroll)?void(!1===c.options.fade&&(n=c.currentSlide,!0!==i?c.animateSlide(a,function(){c.postSlide(n)}):c.postSlide(n))):!1===c.options.infinite&&!0===c.options.centerMode&&(e<0||e>c.slideCount-c.options.slidesToScroll)?void(!1===c.options.fade&&(n=c.currentSlide,!0!==i?c.animateSlide(a,function(){c.postSlide(n)}):c.postSlide(n))):(c.options.autoplay&&clearInterval(c.autoPlayTimer),o=n<0?c.slideCount%c.options.slidesToScroll!=0?c.slideCount-c.slideCount%c.options.slidesToScroll:c.slideCount+n:n>=c.slideCount?c.slideCount%c.options.slidesToScroll!=0?0:n-c.slideCount:n,c.animating=!0,c.$slider.trigger("beforeChange",[c,c.currentSlide,o]),r=c.currentSlide,c.currentSlide=o,c.setSlideClasses(c.currentSlide),c.options.asNavFor&&((s=(s=c.getNavTarget()).slick("getSlick")).slideCount<=s.options.slidesToShow&&s.setSlideClasses(c.currentSlide)),c.updateDots(),c.updateArrows(),!0===c.options.fade?(!0!==i?(c.fadeSlideOut(r),c.fadeSlide(o,function(){c.postSlide(o)})):c.postSlide(o),void c.animateHeight()):void(!0!==i?c.animateSlide(l,function(){c.postSlide(o)}):c.postSlide(o))))},s.prototype.startLoad=function(){var e=this;!0===e.options.arrows&&e.slideCount>e.options.slidesToShow&&(e.$prevArrow.hide(),e.$nextArrow.hide()),!0===e.options.dots&&e.slideCount>e.options.slidesToShow&&e.$dots.hide(),e.$slider.addClass("slick-loading")},s.prototype.swipeDirection=function(){var e,t,i,n,o=this;return e=o.touchObject.startX-o.touchObject.curX,t=o.touchObject.startY-o.touchObject.curY,i=Math.atan2(t,e),(n=Math.round(180*i/Math.PI))<0&&(n=360-Math.abs(n)),n<=45&&0<=n?!1===o.options.rtl?"left":"right":n<=360&&315<=n?!1===o.options.rtl?"left":"right":135<=n&&n<=225?!1===o.options.rtl?"right":"left":!0===o.options.verticalSwiping?35<=n&&n<=135?"down":"up":"vertical"},s.prototype.swipeEnd=function(e){var t,i,n=this;if(n.dragging=!1,n.interrupted=!1,n.shouldClick=!(10<n.touchObject.swipeLength),void 0===n.touchObject.curX)return!1;if(!0===n.touchObject.edgeHit&&n.$slider.trigger("edge",[n,n.swipeDirection()]),n.touchObject.swipeLength>=n.touchObject.minSwipe){switch(i=n.swipeDirection()){case"left":case"down":t=n.options.swipeToSlide?n.checkNavigable(n.currentSlide+n.getSlideCount()):n.currentSlide+n.getSlideCount(),n.currentDirection=0;break;case"right":case"up":t=n.options.swipeToSlide?n.checkNavigable(n.currentSlide-n.getSlideCount()):n.currentSlide-n.getSlideCount(),n.currentDirection=1}"vertical"!=i&&(n.slideHandler(t),n.touchObject={},n.$slider.trigger("swipe",[n,i]))}else n.touchObject.startX!==n.touchObject.curX&&(n.slideHandler(n.currentSlide),n.touchObject={})},s.prototype.swipeHandler=function(e){var t=this;if(!(!1===t.options.swipe||"ontouchend"in document&&!1===t.options.swipe||!1===t.options.draggable&&-1!==e.type.indexOf("mouse")))switch(t.touchObject.fingerCount=e.originalEvent&&void 0!==e.originalEvent.touches?e.originalEvent.touches.length:1,t.touchObject.minSwipe=t.listWidth/t.options.touchThreshold,!0===t.options.verticalSwiping&&(t.touchObject.minSwipe=t.listHeight/t.options.touchThreshold),e.data.action){case"start":t.swipeStart(e);break;case"move":t.swipeMove(e);break;case"end":t.swipeEnd(e)}},s.prototype.swipeMove=function(e){var t,i,n,o,r,a=this;return r=void 0!==e.originalEvent?e.originalEvent.touches:null,!(!a.dragging||r&&1!==r.length)&&(t=a.getLeft(a.currentSlide),a.touchObject.curX=void 0!==r?r[0].pageX:e.clientX,a.touchObject.curY=void 0!==r?r[0].pageY:e.clientY,a.touchObject.swipeLength=Math.round(Math.sqrt(Math.pow(a.touchObject.curX-a.touchObject.startX,2))),!0===a.options.verticalSwiping&&(a.touchObject.swipeLength=Math.round(Math.sqrt(Math.pow(a.touchObject.curY-a.touchObject.startY,2)))),"vertical"!==(i=a.swipeDirection())?(void 0!==e.originalEvent&&4<a.touchObject.swipeLength&&e.preventDefault(),o=(!1===a.options.rtl?1:-1)*(a.touchObject.curX>a.touchObject.startX?1:-1),!0===a.options.verticalSwiping&&(o=a.touchObject.curY>a.touchObject.startY?1:-1),n=a.touchObject.swipeLength,(a.touchObject.edgeHit=!1)===a.options.infinite&&(0===a.currentSlide&&"right"===i||a.currentSlide>=a.getDotCount()&&"left"===i)&&(n=a.touchObject.swipeLength*a.options.edgeFriction,a.touchObject.edgeHit=!0),!1===a.options.vertical?a.swipeLeft=t+n*o:a.swipeLeft=t+n*(a.$list.height()/a.listWidth)*o,!0===a.options.verticalSwiping&&(a.swipeLeft=t+n*o),!0!==a.options.fade&&!1!==a.options.touchMove&&(!0===a.animating?(a.swipeLeft=null,!1):void a.setCSS(a.swipeLeft))):void 0)},s.prototype.swipeStart=function(e){var t,i=this;return i.interrupted=!0,1!==i.touchObject.fingerCount||i.slideCount<=i.options.slidesToShow?!(i.touchObject={}):(void 0!==e.originalEvent&&void 0!==e.originalEvent.touches&&(t=e.originalEvent.touches[0]),i.touchObject.startX=i.touchObject.curX=void 0!==t?t.pageX:e.clientX,i.touchObject.startY=i.touchObject.curY=void 0!==t?t.pageY:e.clientY,void(i.dragging=!0))},s.prototype.unfilterSlides=s.prototype.slickUnfilter=function(){var e=this;null!==e.$slidesCache&&(e.unload(),e.$slideTrack.children(this.options.slide).detach(),e.$slidesCache.appendTo(e.$slideTrack),e.reinit())},s.prototype.unload=function(){var e=this;d(".slick-cloned",e.$slider).remove(),e.$dots&&e.$dots.remove(),e.$prevArrow&&e.htmlExpr.test(e.options.prevArrow)&&e.$prevArrow.remove(),e.$nextArrow&&e.htmlExpr.test(e.options.nextArrow)&&e.$nextArrow.remove(),e.$slides.removeClass("slick-slide slick-active slick-visible slick-current").attr("aria-hidden","true").css("width","")},s.prototype.unslick=function(e){var t=this;t.$slider.trigger("unslick",[t,e]),t.destroy()},s.prototype.updateArrows=function(){var e,t=this;e=Math.floor(t.options.slidesToShow/2),!0===t.options.arrows&&t.slideCount>t.options.slidesToShow&&!t.options.infinite&&(t.$prevArrow.removeClass("slick-disabled").attr("aria-disabled","false"),t.$nextArrow.removeClass("slick-disabled").attr("aria-disabled","false"),0===t.currentSlide?(t.$prevArrow.addClass("slick-disabled").attr("aria-disabled","true"),t.$nextArrow.removeClass("slick-disabled").attr("aria-disabled","false")):t.currentSlide>=t.slideCount-t.options.slidesToShow&&!1===t.options.centerMode?(t.$nextArrow.addClass("slick-disabled").attr("aria-disabled","true"),t.$prevArrow.removeClass("slick-disabled").attr("aria-disabled","false")):t.currentSlide>=t.slideCount-1&&!0===t.options.centerMode&&(t.$nextArrow.addClass("slick-disabled").attr("aria-disabled","true"),t.$prevArrow.removeClass("slick-disabled").attr("aria-disabled","false")))},s.prototype.updateDots=function(){var e=this;null!==e.$dots&&(e.$dots.find("li").removeClass("slick-active").attr("aria-hidden","true"),e.$dots.find("li").eq(Math.floor(e.currentSlide/e.options.slidesToScroll)).addClass("slick-active").attr("aria-hidden","false"))},s.prototype.visibility=function(){var e=this;e.options.autoplay&&(document[e.hidden]?e.interrupted=!0:e.interrupted=!1)},d.fn.slick=function(e){var t,i,n=this,o=e,r=Array.prototype.slice.call(arguments,1),a=n.length;for(t=0;t<a;t++)if("object"==typeof o||void 0===o?n[t].slick=new s(n[t],o):i=n[t].slick[o].apply(n[t].slick,r),void 0!==i)return i;return n}}),function(c,T,S){"use strict";function t(e){if(C=T.documentElement,n=T.body,X(),le=this,fe=(e=e||{}).constants||{},e.easing)for(var t in e.easing)U[t]=e.easing[t];we=e.edgeStrategy||"set",ue={beforerender:e.beforerender,render:e.render,keyframe:e.keyframe},(pe=!1!==e.forceHeight)&&(De=e.scale||1),he=e.mobileDeceleration||p,me=!1!==e.smoothScrolling,ge=e.smoothScrollingDuration||h,ye={targetTop:le.getScrollTop()},(Qe=(e.mobileCheck||function(){return/Android|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent||navigator.vendor||c.opera)})())?((de=T.getElementById(e.skrollrBody||f))&&se(),G(),$e(C,[r,l],[a])):$e(C,[r,s],[a]),le.refresh(),Te(c,"resize orientationchange",function(){var e=C.clientWidth,t=C.clientHeight;(t!==Ne||e!==Le)&&(Ne=t,Le=e,Ve=!0)});var i=Y();return function e(){K(),xe=i(e)}(),le}var C,n,P={get:function(){return le},init:function(e){return le||new t(e)},VERSION:"0.6.30"},A=Object.prototype.hasOwnProperty,q=c.Math,o=c.getComputedStyle,O="touchstart",E="touchmove",$="touchcancel",I="touchend",M="skrollable",j=M+"-before",z=M+"-between",F=M+"-after",r="skrollr",a="no-"+r,s=r+"-desktop",l=r+"-mobile",d="linear",u=1e3,p=.004,f="skrollr-body",h=200,D="start",W="end",v="center",m="bottom",H="___skrollable_id",_=/^(?:input|textarea|button|select)$/i,i=/^\s+|\s+$/g,L=/^data(?:-(_\w+))?(?:-?(-?\d*\.?\d+p?))?(?:-?(start|end|top|center|bottom))?(?:-?(top|center|bottom))?$/,g=/\s*(@?[\w\-\[\]]+)\s*:\s*(.+?)\s*(?:;|$)/gi,y=/^(@?[a-z\-]+)\[(\w+)\]$/,N=/-([a-z0-9_])/g,V=function(e,t){return t.toUpperCase()},b=/[\-+]?[\d]*\.?[\d]+/g,w=/\{\?\}/g,k=/rgba?\(\s*-?\d+\s*,\s*-?\d+\s*,\s*-?\d+/g,x=/[a-z\-]+-gradient/g,R="",Q="",X=function(){var e=/^(?:O|Moz|webkit|ms)|(?:-(?:o|moz|webkit|ms)-)/;if(o){var t=o(n,null);for(var i in t)if(R=i.match(e)||+i==i&&t[i].match(e))break;if(!R)return void(R=Q="");"-"===(R=R[0]).slice(0,1)?R={"-webkit-":"webkit","-moz-":"Moz","-ms-":"ms","-o-":"O"}[Q=R]:Q="-"+R.toLowerCase()+"-"}},Y=function(){var e=c.requestAnimationFrame||c[R.toLowerCase()+"RequestAnimationFrame"],n=je();return(Qe||!e)&&(e=function(e){var t=je()-n,i=q.max(0,1e3/60-t);return c.setTimeout(function(){n=je(),e()},i)}),e},B=function(){var e=c.cancelAnimationFrame||c[R.toLowerCase()+"CancelAnimationFrame"];return(Qe||!e)&&(e=function(e){return c.clearTimeout(e)}),e},U={begin:function(){return 0},end:function(){return 1},linear:function(e){return e},quadratic:function(e){return e*e},cubic:function(e){return e*e*e},swing:function(e){return-q.cos(e*q.PI)/2+.5},sqrt:function(e){return q.sqrt(e)},outCubic:function(e){return q.pow(e-1,3)+1},bounce:function(e
){var t;if(e<=.5083)t=3;else if(e<=.8489)t=9;else if(e<=.96208)t=27;else{if(!(e<=.99981))return 1;t=91}return 1-q.abs(3*q.cos(e*t*1.028)/t)}};t.prototype.refresh=function(e){var t,i,n=!1;for(e===S?(n=!0,ce=[],Re=0,e=T.getElementsByTagName("*")):e.length===S&&(e=[e]),t=0,i=e.length;t<i;t++){var o=e[t],r=o,a=[],s=me,l=we,c=!1;if(n&&H in o&&delete o[H],o.attributes){for(var d=0,u=o.attributes.length;d<u;d++){var p=o.attributes[d];if("data-anchor-target"!==p.name)if("data-smooth-scrolling"!==p.name)if("data-edge-strategy"!==p.name)if("data-emit-events"!==p.name){var f=p.name.match(L);if(null!==f){var h={props:p.value,element:o,eventType:p.name.replace(N,V)};a.push(h);var v=f[1];v&&(h.constant=v.substr(1));var m=f[2];/p$/.test(m)?(h.isPercentage=!0,h.offset=(0|m.slice(0,-1))/100):h.offset=0|m;var g=f[3],y=f[4]||g;g&&g!==D&&g!==W?(h.mode="relative",h.anchors=[g,y]):(h.mode="absolute",g===W?h.isEnd=!0:h.isPercentage||(h.offset=h.offset*De))}}else c=!0;else l=p.value;else s="off"!==p.value;else if(null===(r=T.querySelector(p.value)))throw'Unable to find anchor target "'+p.value+'"'}var b,w,k;if(a.length)w=!n&&H in o?(k=o[H],b=ce[k].styleAttr,ce[k].classAttr):(k=o[H]=Re++,b=o.style.cssText,Ee(o)),ce[k]={element:o,styleAttr:b,classAttr:w,anchorTarget:r,keyFrames:a,smoothScrolling:s,edgeStrategy:l,emitEvents:c,lastFrameIndex:-1},$e(o,[M],[])}}for(Ae(),t=0,i=e.length;t<i;t++){var x=ce[e[t][H]];x!==S&&(ee(x),ie(x))}return le},t.prototype.relativeToAbsolute=function(e,t,i){var n=C.clientHeight,o=e.getBoundingClientRect(),r=o.top,a=o.bottom-o.top;return t===m?r-=n:t===v&&(r-=n/2),i===m?r+=a:i===v&&(r+=a/2),(r+=le.getScrollTop())+.5|0},t.prototype.animateTo=function(e,t){t=t||{};var i=je(),n=le.getScrollTop(),o=t.duration===S?u:t.duration;return(ve={startTop:n,topDiff:e-n,targetTop:e,duration:o,startTime:i,endTime:i+o,easing:U[t.easing||d],done:t.done}).topDiff||(ve.done&&ve.done.call(le,!1),ve=S),le},t.prototype.stopAnimateTo=function(){ve&&ve.done&&ve.done.call(le,!0),ve=S},t.prototype.isAnimatingTo=function(){return!!ve},t.prototype.isMobile=function(){return Qe},t.prototype.setScrollTop=function(e,t){return be=!0===t,Qe?Xe=q.min(q.max(e,0),Fe):c.scrollTo(0,e),le},t.prototype.getScrollTop=function(){return Qe?Xe:c.pageYOffset||C.scrollTop||n.scrollTop||0},t.prototype.getMaxScrollTop=function(){return Fe},t.prototype.on=function(e,t){return ue[e]=t,le},t.prototype.off=function(e){return delete ue[e],le},t.prototype.destroy=function(){var e;B()(xe),Ce(),$e(C,[a],[r,s,l]);for(var t=0,i=ce.length;t<i;t++)ae(ce[t].element);C.style.overflow=n.style.overflow="",C.style.height=n.style.height="",de&&P.setStyle(de,"transform","none"),We="down",Qe=Ve=!(He=-(De=1)),Xe=Re=Ne=Le=Fe=0,ke=we=be=ye=ge=me=ve=he=fe=pe=ue=de=le=S};var G=function(){var u,p,f,h,v,m,g,y,b,w,k,x;Te(C,[O,E,$,I].join(" "),function(e){var t=e.changedTouches[0];for(h=e.target;3===h.nodeType;)h=h.parentNode;switch(v=t.clientY,m=t.clientX,w=e.timeStamp,_.test(h.tagName)||e.preventDefault(),e.type){case O:u&&u.blur(),le.stopAnimateTo(),u=h,p=g=v,f=m,b=w;break;case E:_.test(h.tagName)&&T.activeElement!==h&&e.preventDefault(),y=v-g,x=w-k,le.setScrollTop(Xe-y,!0),g=v,k=w;break;default:case $:case I:var i=p-v,n=f-m,o;if(n*n+i*i<49){if(!_.test(u.tagName)){u.focus();var r=T.createEvent("MouseEvents");r.initMouseEvent("click",!0,!0,e.view,1,t.screenX,t.screenY,t.clientX,t.clientY,e.ctrlKey,e.altKey,e.shiftKey,e.metaKey,0,null),u.dispatchEvent(r)}return}u=S;var a=y/x;a=q.max(q.min(a,3),-3);var s=q.abs(a/he),l=a*s+.5*he*s*s,c=le.getScrollTop()-l,d=0;Fe<c?(d=(Fe-c)/l,c=Fe):c<0&&(d=-c/l,c=0),s*=1-d,le.animateTo(c+.5|0,{easing:"outCubic",duration:s})}}),c.scrollTo(0,0),C.style.overflow=n.style.overflow="hidden"},Z=function(){var e,t,i,n,o,r,a,s,l,c,d,u=C.clientHeight,p=qe();for(s=0,l=ce.length;s<l;s++)for(t=(e=ce[s]).element,i=e.anchorTarget,o=0,r=(n=e.keyFrames).length;o<r;o++)c=(a=n[o]).offset,d=p[a.constant]||0,a.frame=c,a.isPercentage&&(c*=u,a.frame=c),"relative"===a.mode&&(ae(t),a.frame=le.relativeToAbsolute(i,a.anchors[0],a.anchors[1])-c,ae(t,!0)),a.frame+=d,pe&&!a.isEnd&&a.frame>Fe&&(Fe=a.frame);for(Fe=q.max(Fe,Oe()),s=0,l=ce.length;s<l;s++){for(o=0,r=(n=(e=ce[s]).keyFrames).length;o<r;o++)d=p[(a=n[o]).constant]||0,a.isEnd&&(a.frame=Fe-a.offset+d);e.keyFrames.sort(ze)}},J=function(e,t){for(var i=0,n=ce.length;i<n;i++){var o,r,a=ce[i],s=a.element,l=a.smoothScrolling?e:t,c=a.keyFrames,d=c.length,u=c[0],p=c[c.length-1],f=l<u.frame,h=l>p.frame,v=f?u:p,m=a.emitEvents,g=a.lastFrameIndex;if(f||h){if(f&&-1===a.edge||h&&1===a.edge)continue;switch(f?($e(s,[j],[F,z]),m&&-1<g&&(Pe(s,u.eventType,We),a.lastFrameIndex=-1)):($e(s,[F],[j,z]),m&&g<d&&(Pe(s,p.eventType,We),a.lastFrameIndex=d)),a.edge=f?-1:1,a.edgeStrategy){case"reset":ae(s);continue;case"ease":l=v.frame;break;default:case"set":var y=v.props;for(o in y)A.call(y,o)&&(r=re(y[o].value),0===o.indexOf("@")?s.setAttribute(o.substr(1),r):P.setStyle(s,o,r));continue}}else 0!==a.edge&&($e(s,[M,z],[j,F]),a.edge=0);for(var b=0;b<d-1;b++)if(l>=c[b].frame&&l<=c[b+1].frame){var w=c[b],k=c[b+1];for(o in w.props)if(A.call(w.props,o)){var x=(l-w.frame)/(k.frame-w.frame);x=w.props[o].easing(x),r=oe(w.props[o].value,k.props[o].value,x),r=re(r),0===o.indexOf("@")?s.setAttribute(o.substr(1),r):P.setStyle(s,o,r)}m&&g!==b&&(Pe(s,"down"===We?w.eventType:k.eventType,We),a.lastFrameIndex=b);break}}},K=function(){Ve&&(Ve=!1,Ae());var e,t,i=le.getScrollTop(),n=je();if(ve)n>=ve.endTime?(i=ve.targetTop,e=ve.done,ve=S):(t=ve.easing((n-ve.startTime)/ve.duration),i=ve.startTop+t*ve.topDiff|0),le.setScrollTop(i,!0);else if(!be){var o;ye.targetTop-i&&(ye={startTop:He,topDiff:i-He,targetTop:i,startTime:_e,endTime:_e+ge}),n<=ye.endTime&&(t=U.sqrt((n-ye.startTime)/ge),i=ye.startTop+t*ye.topDiff|0)}if(be||He!==i){var r={curTop:i,lastTop:He,maxTop:Fe,direction:We=He<i?"down":i<He?"up":We},a;(be=!1)!==(ue.beforerender&&ue.beforerender.call(le,r))&&(J(i,le.getScrollTop()),Qe&&de&&P.setStyle(de,"transform","translate(0, "+-Xe+"px) "+ke),He=i,ue.render&&ue.render.call(le,r)),e&&e.call(le,!1)}_e=n},ee=function(e){for(var t=0,i=e.keyFrames.length;t<i;t++){for(var n,o,r,a,s=e.keyFrames[t],l={};null!==(a=g.exec(s.props));)r=a[1],o=a[2],n=null!==(n=r.match(y))?(r=n[1],n[2]):d,o=o.indexOf("!")?te(o):[o.slice(1)],l[r]={value:o,easing:U[n]};s.props=l}},te=function(e){var t=[];return k.lastIndex=0,e=e.replace(k,function(e){return e.replace(b,function(e){return e/255*100+"%"})}),Q&&(x.lastIndex=0,e=e.replace(x,function(e){return Q+e})),e=e.replace(b,function(e){return t.push(+e),"{?}"}),t.unshift(e),t},ie=function(e){var t,i,n={};for(t=0,i=e.keyFrames.length;t<i;t++)ne(e.keyFrames[t],n);for(n={},t=e.keyFrames.length-1;0<=t;t--)ne(e.keyFrames[t],n)},ne=function(e,t){var i;for(i in t)A.call(e.props,i)||(e.props[i]=t[i]);for(i in e.props)t[i]=e.props[i]},oe=function(e,t,i){var n,o=e.length;if(o!==t.length)throw"Can't interpolate between \""+e[0]+'" and "'+t[0]+'"';var r=[e[0]];for(n=1;n<o;n++)r[n]=e[n]+(t[n]-e[n])*i;return r},re=function(e){var t=1;return w.lastIndex=0,e[0].replace(w,function(){return e[t++]})},ae=function(e,t){for(var i,n,o=0,r=(e=[].concat(e)).length;o<r;o++)n=e[o],(i=ce[n[H]])&&(t?(n.style.cssText=i.dirtyStyleAttr,$e(n,i.dirtyClassAttr)):(i.dirtyStyleAttr=n.style.cssText,i.dirtyClassAttr=Ee(n),n.style.cssText=i.styleAttr,$e(n,i.classAttr)))},se=function(){ke="translateZ(0)",P.setStyle(de,"transform",ke);var e=o(de),t=e.getPropertyValue("transform"),i=e.getPropertyValue(Q+"transform"),n;t&&"none"!==t||i&&"none"!==i||(ke="")};P.setStyle=function(e,t,i){var n=e.style;if("zIndex"===(t=t.replace(N,V).replace("-","")))isNaN(i)?n[t]=i:n[t]=""+(0|i);else if("float"===t)n.styleFloat=n.cssFloat=i;else try{R&&(n[R+t.slice(0,1).toUpperCase()+t.slice(1)]=i),n[t]=i}catch(e){}};var le,ce,de,ue,pe,fe,he,ve,me,ge,ye,be,we,ke,xe,Te=P.addEvent=function(e,t,i){for(var n=function(e){return(e=e||c.event).target||(e.target=e.srcElement),e.preventDefault||(e.preventDefault=function(){e.returnValue=!1,e.defaultPrevented=!0}),i.call(this,e)},o,r=0,a=(t=t.split(" ")).length;r<a;r++)o=t[r],e.addEventListener?e.addEventListener(o,i,!1):e.attachEvent("on"+o,n),Ye.push({element:e,name:o,listener:i})},Se=P.removeEvent=function(e,t,i){for(var n=0,o=(t=t.split(" ")).length;n<o;n++)e.removeEventListener?e.removeEventListener(t[n],i,!1):e.detachEvent("on"+t[n],i)},Ce=function(){for(var e,t=0,i=Ye.length;t<i;t++)e=Ye[t],Se(e.element,e.name,e.listener);Ye=[]},Pe=function(e,t,i){ue.keyframe&&ue.keyframe.call(le,e,t,i)},Ae=function(){var e=le.getScrollTop();Fe=0,pe&&!Qe&&(n.style.height=""),Z(),pe&&!Qe&&(n.style.height=Fe+C.clientHeight+"px"),Qe?le.setScrollTop(q.min(le.getScrollTop(),Fe)):le.setScrollTop(e,!0),be=!0},qe=function(){var e,t,i=C.clientHeight,n={};for(e in fe)"function"==typeof(t=fe[e])?t=t.call(le):/p$/.test(t)&&(t=t.slice(0,-1)/100*i),n[e]=t;return n},Oe=function(){var e,t=0;return de&&(t=q.max(de.offsetHeight,de.scrollHeight)),(e=q.max(t,n.scrollHeight,n.offsetHeight,C.scrollHeight,C.offsetHeight,C.clientHeight))-C.clientHeight},Ee=function(e){var t="className";return c.SVGElement&&e instanceof c.SVGElement&&(e=e[t],t="baseVal"),e[t]},$e=function(e,t,i){var n="className";if(c.SVGElement&&e instanceof c.SVGElement&&(e=e[n],n="baseVal"),i!==S){for(var o=e[n],r=0,a=i.length;r<a;r++)o=Me(o).replace(Me(i[r])," ");o=Ie(o);for(var s=0,l=t.length;s<l;s++)-1===Me(o).indexOf(Me(t[s]))&&(o+=" "+t[s]);e[n]=Ie(o)}else e[n]=t},Ie=function(e){return e.replace(i,"")},Me=function(e){return" "+e+" "},je=Date.now||function(){return+new Date},ze=function(e,t){return e.frame-t.frame},Fe=0,De=1,We="down",He=-1,_e=je(),Le=0,Ne=0,Ve=!1,Re=0,Qe=!1,Xe=0,Ye=[];"function"==typeof define&&define.amd?define([],function(){return P}):"undefined"!=typeof module&&module.exports?module.exports=P:c.skrollr=P}(window,document),
/*!
Waypoints - 4.0.1
Copyright © 2011-2016 Caleb Troughton
Licensed under the MIT license.
https://github.com/imakewebthings/waypoints/blob/master/licenses.txt
*/
function(){"use strict";
/* http://imakewebthings.com/waypoints/api/waypoint */
function t(e){if(!e)throw new Error("No options passed to Waypoint constructor");if(!e.element)throw new Error("No element option passed to Waypoint constructor");if(!e.handler)throw new Error("No handler option passed to Waypoint constructor");this.key="waypoint-"+i,this.options=t.Adapter.extend({},t.defaults,e),this.element=this.options.element,this.adapter=new t.Adapter(this.element),this.callback=e.handler,this.axis=this.options.horizontal?"horizontal":"vertical",this.enabled=this.options.enabled,this.triggerPoint=null,this.group=t.Group.findOrCreate({name:this.options.group,axis:this.axis}),this.context=t.Context.findOrCreateByElement(this.options.context),t.offsetAliases[this.options.offset]&&(this.options.offset=t.offsetAliases[this.options.offset]),this.group.add(this),this.context.add(this),r[this.key]=this,i+=1}
/* Private */var i=0,r={};t.prototype.queueTrigger=function(e){this.group.queueTrigger(this,e)}
/* Private */,t.prototype.trigger=function(e){this.enabled&&this.callback&&this.callback.apply(this,e)}
/* Public */
/* http://imakewebthings.com/waypoints/api/destroy */,t.prototype.destroy=function(){this.context.remove(this),this.group.remove(this),delete r[this.key]}
/* Public */
/* http://imakewebthings.com/waypoints/api/disable */,t.prototype.disable=function(){return this.enabled=!1,this}
/* Public */
/* http://imakewebthings.com/waypoints/api/enable */,t.prototype.enable=function(){return this.context.refresh(),this.enabled=!0,this}
/* Public */
/* http://imakewebthings.com/waypoints/api/next */,t.prototype.next=function(){return this.group.next(this)}
/* Public */
/* http://imakewebthings.com/waypoints/api/previous */,t.prototype.previous=function(){return this.group.previous(this)}
/* Private */,t.invokeAll=function(e){var t=[];for(var i in r)t.push(r[i]);for(var n=0,o=t.length;n<o;n++)t[n][e]()}
/* Public */
/* http://imakewebthings.com/waypoints/api/destroy-all */,t.destroyAll=function(){t.invokeAll("destroy")}
/* Public */
/* http://imakewebthings.com/waypoints/api/disable-all */,t.disableAll=function(){t.invokeAll("disable")}
/* Public */
/* http://imakewebthings.com/waypoints/api/enable-all */,t.enableAll=function(){for(var e in t.Context.refreshAll(),r)r[e].enabled=!0;return this}
/* Public */
/* http://imakewebthings.com/waypoints/api/refresh-all */,t.refreshAll=function(){t.Context.refreshAll()}
/* Public */
/* http://imakewebthings.com/waypoints/api/viewport-height */,t.viewportHeight=function(){return window.innerHeight||document.documentElement.clientHeight}
/* Public */
/* http://imakewebthings.com/waypoints/api/viewport-width */,t.viewportWidth=function(){return document.documentElement.clientWidth},t.adapters=[],t.defaults={context:window,continuous:!0,enabled:!0,group:"default",horizontal:!1,offset:0},t.offsetAliases={"bottom-in-view":function(){return this.context.innerHeight()-this.adapter.outerHeight()},"right-in-view":function(){return this.context.innerWidth()-this.adapter.outerWidth()}},window.Waypoint=t}(),function(){"use strict";function i(e){window.setTimeout(e,1e3/60)}
/* http://imakewebthings.com/waypoints/api/context */
function t(e){this.element=e,this.Adapter=g.Adapter,this.adapter=new this.Adapter(e),this.key="waypoint-context-"+n,this.didScroll=!1,this.didResize=!1,this.oldScroll={x:this.adapter.scrollLeft(),y:this.adapter.scrollTop()},this.waypoints={vertical:{},horizontal:{}},e.waypointContextKey=this.key,o[e.waypointContextKey]=this,n+=1,g.windowContext||(g.windowContext=!0,g.windowContext=new t(window)),this.createThrottledScrollHandler(),this.createThrottledResizeHandler()}
/* Private */var n=0,o={},g=window.Waypoint,e=window.onload;t.prototype.add=function(e){var t=e.options.horizontal?"horizontal":"vertical";this.waypoints[t][e.key]=e,this.refresh()}
/* Private */,t.prototype.checkEmpty=function(){var e=this.Adapter.isEmptyObject(this.waypoints.horizontal),t=this.Adapter.isEmptyObject(this.waypoints.vertical),i=this.element==this.element.window;e&&t&&!i&&(this.adapter.off(".waypoints"),delete o[this.key])}
/* Private */,t.prototype.createThrottledResizeHandler=function(){function e(){t.handleResize(),t.didResize=!1}var t=this;this.adapter.on("resize.waypoints",function(){t.didResize||(t.didResize=!0,g.requestAnimationFrame(e))})}
/* Private */,t.prototype.createThrottledScrollHandler=function(){function e(){t.handleScroll(),t.didScroll=!1}var t=this;this.adapter.on("scroll.waypoints",function(){t.didScroll&&!g.isTouch||(t.didScroll=!0,g.requestAnimationFrame(e))})}
/* Private */,t.prototype.handleResize=function(){g.Context.refreshAll()}
/* Private */,t.prototype.handleScroll=function(){var e={},t={horizontal:{newScroll:this.adapter.scrollLeft(),oldScroll:this.oldScroll.x,forward:"right",backward:"left"},vertical:{newScroll:this.adapter.scrollTop(),oldScroll:this.oldScroll.y,forward:"down",backward:"up"}};for(var i in t){var n=t[i],o,r=n.newScroll>n.oldScroll?n.forward:n.backward;for(var a in this.waypoints[i]){var s=this.waypoints[i][a];if(null!==s.triggerPoint){var l=n.oldScroll<s.triggerPoint,c=n.newScroll>=s.triggerPoint,d,u;(l&&c||!l&&!c)&&(s.queueTrigger(r),e[s.group.id]=s.group)}}}for(var p in e)e[p].flushTriggers();this.oldScroll={x:t.horizontal.newScroll,y:t.vertical.newScroll}}
/* Private */,t.prototype.innerHeight=function(){
/*eslint-disable eqeqeq */
return this.element==this.element.window?g.viewportHeight():this.adapter.innerHeight()
/*eslint-enable eqeqeq */}
/* Private */,t.prototype.remove=function(e){delete this.waypoints[e.axis][e.key],this.checkEmpty()}
/* Private */,t.prototype.innerWidth=function(){
/*eslint-disable eqeqeq */
return this.element==this.element.window?g.viewportWidth():this.adapter.innerWidth()
/*eslint-enable eqeqeq */}
/* Public */
/* http://imakewebthings.com/waypoints/api/context-destroy */,t.prototype.destroy=function(){var e=[];for(var t in this.waypoints)for(var i in this.waypoints[t])e.push(this.waypoints[t][i]);for(var n=0,o=e.length;n<o;n++)e[n].destroy()}
/* Public */
/* http://imakewebthings.com/waypoints/api/context-refresh */,t.prototype.refresh=function(){
/*eslint-disable eqeqeq */
var e=this.element==this.element.window
/*eslint-enable eqeqeq */,t=e?void 0:this.adapter.offset(),i={},n;for(var o in this.handleScroll(),n={horizontal:{contextOffset:e?0:t.left,contextScroll:e?0:this.oldScroll.x,contextDimension:this.innerWidth(),oldScroll:this.oldScroll.x,forward:"right",backward:"left",offsetProp:"left"},vertical:{contextOffset:e?0:t.top,contextScroll:e?0:this.oldScroll.y,contextDimension:this.innerHeight(),oldScroll:this.oldScroll.y,forward:"down",backward:"up",offsetProp:"top"}}){var r=n[o];for(var a in this.waypoints[o]){var s=this.waypoints[o][a],l=s.options.offset,c=s.triggerPoint,d=0,u=null==c,p,f,h,v,m;s.element!==s.element.window&&(d=s.adapter.offset()[r.offsetProp]),"function"==typeof l?l=l.apply(s):"string"==typeof l&&(l=parseFloat(l),-1<s.options.offset.indexOf("%")&&(l=Math.ceil(r.contextDimension*l/100))),p=r.contextScroll-r.contextOffset,s.triggerPoint=Math.floor(d+p-l),f=c<r.oldScroll,h=s.triggerPoint>=r.oldScroll,m=!f&&!h,!u&&(v=f&&h)?(s.queueTrigger(r.backward),i[s.group.id]=s.group):!u&&m?(s.queueTrigger(r.forward),i[s.group.id]=s.group):u&&r.oldScroll>=s.triggerPoint&&(s.queueTrigger(r.forward),i[s.group.id]=s.group)}}return g.requestAnimationFrame(function(){for(var e in i)i[e].flushTriggers()}),this}
/* Private */,t.findOrCreateByElement=function(e){return t.findByElement(e)||new t(e)}
/* Private */,t.refreshAll=function(){for(var e in o)o[e].refresh()}
/* Public */
/* http://imakewebthings.com/waypoints/api/context-find-by-element */,t.findByElement=function(e){return o[e.waypointContextKey]},window.onload=function(){e&&e(),t.refreshAll()},g.requestAnimationFrame=function(e){var t;(window.requestAnimationFrame||window.mozRequestAnimationFrame||window.webkitRequestAnimationFrame||i).call(window,e)},g.Context=t}(),function(){"use strict";function a(e,t){return e.triggerPoint-t.triggerPoint}function s(e,t){return t.triggerPoint-e.triggerPoint}
/* http://imakewebthings.com/waypoints/api/group */
function t(e){this.name=e.name,this.axis=e.axis,this.id=this.name+"-"+this.axis,this.waypoints=[],this.clearTriggerQueues(),i[this.axis][this.name]=this}
/* Private */var i={vertical:{},horizontal:{}},n=window.Waypoint;t.prototype.add=function(e){this.waypoints.push(e)}
/* Private */,t.prototype.clearTriggerQueues=function(){this.triggerQueues={up:[],down:[],left:[],right:[]}}
/* Private */,t.prototype.flushTriggers=function(){for(var e in this.triggerQueues){var t=this.triggerQueues[e],i="up"===e||"left"===e;t.sort(i?s:a);for(var n=0,o=t.length;n<o;n+=1){var r=t[n];(r.options.continuous||n===t.length-1)&&r.trigger([e])}}this.clearTriggerQueues()}
/* Private */,t.prototype.next=function(e){this.waypoints.sort(a);var t=n.Adapter.inArray(e,this.waypoints),i;return t===this.waypoints.length-1?null:this.waypoints[t+1]}
/* Private */,t.prototype.previous=function(e){this.waypoints.sort(a);var t=n.Adapter.inArray(e,this.waypoints);return t?this.waypoints[t-1]:null}
/* Private */,t.prototype.queueTrigger=function(e,t){this.triggerQueues[t].push(e)}
/* Private */,t.prototype.remove=function(e){var t=n.Adapter.inArray(e,this.waypoints);-1<t&&this.waypoints.splice(t,1)}
/* Public */
/* http://imakewebthings.com/waypoints/api/first */,t.prototype.first=function(){return this.waypoints[0]}
/* Public */
/* http://imakewebthings.com/waypoints/api/last */,t.prototype.last=function(){return this.waypoints[this.waypoints.length-1]}
/* Private */,t.findOrCreate=function(e){return i[e.axis][e.name]||new t(e)},n.Group=t}(),function(){"use strict";function i(e){this.$element=n(e)}var n=window.jQuery,e=window.Waypoint;n.each(["innerHeight","innerWidth","off","offset","on","outerHeight","outerWidth","scrollLeft","scrollTop"],function(e,t){i.prototype[t]=function(){var e=Array.prototype.slice.call(arguments);return this.$element[t].apply(this.$element,e)}}),n.each(["extend","inArray","isEmptyObject"],function(e,t){i[t]=n[t]}),e.adapters.push({name:"jquery",Adapter:i}),e.Adapter=i}(),function(){"use strict";function e(o){return function(e,t){var i=[],n=e;return o.isFunction(e)&&((n=o.extend({},t)).handler=e),this.each(function(){var e=o.extend({},n,{element:this});"string"==typeof e.context&&(e.context=o(this).closest(e.context)[0]),i.push(new r(e))}),i}}var r=window.Waypoint;window.jQuery&&(window.jQuery.fn.waypoint=e(window.jQuery)),window.Zepto&&(window.Zepto.fn.waypoint=e(window.Zepto))}(),
/**====================================================================
 *
 *  Main Script File
 *
 * 	The minified version includes the following libraries:
 * 	../components/plyr/src/js/plyr.js
 * 	./materialize-src/js/bin/materialize.min.js
 * 	../components/slick/slick.min.js
 * 	../components/skrollr/skrollr.min.js
 * 	../components/waypoints/jquery.waypoints.js
 *  
 ====================================================================**/
function(h){"use strict";h.qtWebsiteObj={},h.qtWebsiteObj.body=h("body"),h.qtWebsiteObj.htmlAndbody=h("html,body"),
/**====================================================================
	 *
	 *
	 * 	Function to go back in history used by form check
	 *
	 * 
	 ====================================================================*/
window.goBack=function(e){var t="http://www.mysite.com",i=window.location.hash,n;return history.back(),window.location.hash!==i||"string"==typeof document.referrer&&""!==document.referrer||window.setTimeout(function(){
// redirect to default location
window.location.href=t},1e3),e&&(e.preventDefault&&e.preventDefault(),e.preventPropagation&&e.preventPropagation()),!1;// stop event propagation and browser default event
},
/**====================================================================
	 *
	 *
	 * Automatic link embed
	 *
	 * 
	 ====================================================================*/
h.fn.embedMixcloudPlayer=function(e){var t=encodeURIComponent(e),i;return'<iframe data-state="0" class="mixcloudplayer" width="100%" height="80" src="//www.mixcloud.com/widget/iframe/?feed='+(t=t.replace("https","http"))+'&embed_uuid=addfd1ba-1531-4f6e-9977-6ca2bd308dcc&stylecolor=&embed_type=widget_standard" frameborder="0"></iframe><div class="canc"></div>'},h.fn.embedVideo=function(e,t,i){i=t/16*9;var n,o,r=e.match(/=[\w-]{11}/)[0].replace(/=/,""),a;return'<iframe width="'+t+'" height="'+i+'" src="'+window.location.protocol+"//www.youtube.com/embed/"+r+'?html5=1" frameborder="0" class="youtube-player" allowfullscreen></iframe>'}
/**====================================================================
	 *
	 * 
	 *	15. Smooth scrolling
	 *	
	 * 
	 ====================================================================*/,h.fn.qtSmoothScroll=function(){var t;h.qtWebsiteObj.body.off("click","a.qt-smoothscroll"),h.qtWebsiteObj.body.on("click","a.qt-smoothscroll",function(e){e.preventDefault(),t=h(this.hash).offset().top,h("html,body").animate({scrollTop:t},600)})}
/**====================================================================
	 *
	 *
	 *	 Responsive video resize
	 *
	 * 
	 ====================================================================*/,h.fn.NewYoutubeResize=function(){jQuery("iframe").each(function(e,t){// .youtube-player
var i=jQuery(this);if(i.attr("src")){var n=i.attr("src");if(n.match("youtube.com")||n.match("vimeo.com")||n.match("vevo.com")){var o=i.parent().width(),r=i.height();i.css({width:o}),i.height(o/16*9)}}})},
/**====================================================================
	 *
	 *
	 * 	Check images loaded in a container
	 *
	 * 
	 ====================================================================*/
h.fn.imagesLoaded=function(){
// get all the images (excluding those with no src attribute)
var e=this.find('img[src!=""]');
// if there's no images, just return an already resolved promise
if(!e.length)return h.Deferred().resolve().promise();
// for each image, add a deferred object to the array which resolves when the image is loaded (or if loading fails)
var i=[];
// return a master promise object which will resolve when all the deferred objects have resolved
// IE - when all the images are loaded
return e.each(function(){var e=h.Deferred();i.push(e);var t=new Image;t.onload=function(){e.resolve()},t.onerror=function(){e.resolve()},t.src=this.src}),h.when.apply(h,i)}
/**====================================================================
	 *
	 *
	 * Transform link in embedded players
	 *
	 * 
	 ====================================================================*/,h.fn.transformlinks=function(e){void 0===e&&(e="body"),jQuery(e).find("a[href*='youtube.com'],a[href*='youtu.be'],a[href*='mixcloud.com'],a[href*='soundcloud.com'], [data-autoembed]").not(".qw-disableembedding").each(function(t){
//=== STRING REPLACE (FINAL FUNCTION)
function i(e){return t.replaceWith(e),!0}var n=jQuery(this),e=n.attr("href");n.attr("data-autoembed")&&(e=n.attr("data-autoembed"));var o=n.parent().width();0===o&&(o=n.parent().parent().parent().width()),0===o&&(o=n.parent().parent().parent().width()),0===o&&(o=n.parent().parent().parent().parent().width());var r=n.height(),t=n,a=/(http|https):\/\/(\w{0,3}\.)?youtube\.\w{2,3}\/watch\?v=[\w-]{11}/gi,s=e.match(a);if(null!==s)for(var l=0;l<s.length;l++)i(e=e.replace(s[l],h.fn.embedVideo(s[l],o,o/16*9)));
//=== SOUNDCLOUD
var c="",d="",u,a=/(http|https)(\:\/\/soundcloud.com\/+([a-zA-Z0-9\/\-_]*))/g,p=e.match(a);if(null!==p)for(l=0;l<p.length;l++){var f=p[l].replace(":","%3A");f=f.replace("https","http"),jQuery.getJSON("https://soundcloud.com/oembed?maxheight=140&format=js&url="+f+"&iframe=true&callback=?",function(e){c=e.html,0<n.closest("li").length?n.closest("li").hasClass("qt-collapsible-item")&&(u=h(c),i('<div class="qt-dynamic-iframe" data-src="'+(d=u.attr("src"))+'"></div>')):i(c)})}
//=== MIXCLOUD
var a=/(http|https)\:\/\/www\.mixcloud\.com\/[\w-]{0,150}\/[\w-]{0,150}\/[\w-]{0,1}/gi;if(null!==(s=e.match(a)))for(l=0;l<s.length;l++)i(e=e.replace(s[l],h.fn.embedMixcloudPlayer(s[l])));h.fn.NewYoutubeResize()}),
/**
		 * Fix for soundcloud loaded in collapsed div for the chart
		 */
h.qtWebsiteObj.body.on("click",".qt-collapsible li",function(e){var t=h(this);if(t.hasClass("active")){var i=t.find(".qt-dynamic-iframe"),n=i.attr("data-src");i.replaceWith('<iframe src="'+n+'" frameborder="0"></iframe>'),h.fn.NewYoutubeResize()}})}
/**====================================================================
	 *
	 * 
	 *	12. Mobile navigation
	 *	
	 * 
	 ====================================================================*/,h.fn.qtMobileNav=function(){return h.qtWebsiteObj.body.find(".side-nav li.menu-item-has-children > a").each(function(e,t){var i=h(t);i.append("<i class='material-icons qt-openthis qt-btn-secondary'>keyboard_arrow_down</i>"),i.on("click","> .qt-openthis",function(e){e.preventDefault(),i.parent().toggleClass("open")})}),!0},
/**====================================================================
	*
	* 
	*  	Slick gallery
	*  
	* 
	====================================================================*/
h.fn.slickGallery=function(){h.qtWebsiteObj.slickSliders=h(".qt-slickslider, .qt-slick"),0!==h.qtWebsiteObj.slickSliders.length&&(h.qtWebsiteObj.slickSliders.not(".slick-initialized").each(function(){var e=h(this),t=e.attr("data-slidestoshow"),i=e.attr("data-slidestoshowmobile"),n=e.attr("data-slidestoshowipad"),o=e.attr("data-appendArrows");void 0!==t&&""!==t||(t=1),void 0!==i&&""!==i||(i=1),void 0!==n&&""!==n||(n=3),o=void 0===o||""===o?e:e.closest(o),e.slick({slidesToScroll:1,pauseOnHover:"true"===e.attr("data-pauseonhover"),infinite:"true"===e.attr("data-infinite"),autoplay:"true"===e.attr("data-autoplay"),autoplaySpeed:4e3,centerPadding:e.attr("data-centerpadding")||0,slide:".qt-item",dots:"true"===e.attr("data-dots"),variableWidth:"true"===e.attr("data-variablewidth"),arrows:"true"===e.attr("data-arrows"),centerMode:"true"===e.attr("data-centermode"),slidesToShow:t,appendArrows:o,responsive:[{breakpoint:790,settings:{arrows:"true"===e.attr("data-arrowsmobile"),centerMode:"true"===e.attr("data-centermodemobile"),centerPadding:0,variableWidth:!0,//that.attr("data-variablewidthmobile") === "true",
variableHeight:!1,dots:"true"===e.attr("data-dotsmobile"),slidesToShow:i,draggable:!1,swipe:!0,touchMove:!0,infinite:"true"===e.attr("data-infinitemobile")}},{breakpoint:1200,settings:{arrows:e.attr("data-arrowsipad"),dots:"true"===e.attr("data-dotsipad"),slidesToShow:n}}]}).promise().done(function(){e.removeClass("qt-invisible")})}),h.qtWebsiteObj.body.on("click","[data-slicknext]",function(e){e.preventDefault();var t=h(this).attr("data-slicknext");h(t).find(".qt-slickslider").slick("slickNext")}),h.qtWebsiteObj.body.on("click","[data-slickprev]",function(e){e.preventDefault();var t=h(this).attr("data-slickprev");h(t).find(".qt-slickslider").slick("slickPrev")}))},
/**====================================================================
	 *
	 * 
	 *	Generic class switcher (toggle class or toggleclass)
	 *	
	 * 
	 ====================================================================*/
h.fn.qtQtSwitch=function(){h.qtWebsiteObj.body.off("click","[data-qtswitch]"),h.qtWebsiteObj.body.on("click","[data-qtswitch]",function(e){var t=h(this);e.preventDefault(),h(t.attr("data-target")).toggleClass(t.attr("data-qtswitch"))}),h.qtWebsiteObj.body.on("click","[data-removeitem]",function(e){var t=h(this);h(t.attr("data-removeitem")).hide()}),h("[data-expandable]").each(function(e,t){var i,n=h(t).attr("data-expandable"),o=h(n);""!==n&&o.hasClass("open")&&o.velocity({properties:{height:o.find(".qt-expandable-inner").height()+"px"},options:{duration:50}})}),h.qtWebsiteObj.body.off("click","[data-expandable]"),h.qtWebsiteObj.body.on("click","[data-expandable]",function(e){e.preventDefault();var t=h(this),i=h(t.attr("data-expandable"));i.hasClass("open")?(i.removeClass("open"),i.velocity({properties:{height:0},options:{duration:300}})):(i.addClass("open"),i.velocity({properties:{height:i.find(".qt-expandable-inner").height()+"px"},options:{duration:300}}))})},
/**====================================================================
	 *
	 *
	 * 	Parallax Backgrounds
	 * 	http://designers.hubspot.com/docs/snippets/design/implement-a-parallax-effect
	 *
	 * 
	 ====================================================================*/
h.fn.qtParallaxRuntime=function(e,t,i,n,o,r,a){i=h(window).scrollTop(),(n=t.offset().top)+(o=t.outerHeight())<=i||i+a<=n||(r=Math.round((n-i)*e.speed),t.css("background-position","center "+r+"px"))},h.fn.qtParallaxV5=function(e){
// return;
var a=h(window).height(),s=h.extend({speed:.15},e);
// Establish default settings
if(h.qtWebsiteObj.body.hasClass("qt-parallax-on"))
// Iterate over each object in collection
return this.each(function(){var e=h(this),t=navigator.userAgent,i,n,o,r;/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(t)||h(window).width()<1280?e.css("background-attachment","local"):(e.css("background-attachment","fixed"),
// initialize
h.fn.qtParallaxRuntime(s,e,i,n,o,r,a),
// Set up Scroll Handler
h(document).scroll(function(){h.fn.qtParallaxRuntime(s,e,i,n,o,r,a)}))})}
/**====================================================================
	 *
	 * 
	 *  17. Dynamic backgrounds
	 *  
	 * 
	 ====================================================================*/,h.fn.dynamicBackgroundsV2=function(e){void 0===e&&(e="body");var t=0;h.qtWebsiteObj.body.hasClass("qt-lazyload")&&(t=1),t?h(e+" [data-bgimage]").each(function(){var e=h(this),t=e.attr("data-bgimage"),i=e.attr("data-speed");""!==t&&e.not(".imgloaded")&&(""==i||void 0===i?i=.15:i/=10,e.waypoint(function(){
/**
						 * 1. we add img src in the html to know when the pic is loaded
						 * 2. when loaded we add it as background and then fade in / paralax
						 */
/* 1. add picture as background */
e.append('<img src="'+t+'" class="qt-hidden qt-lazyimg" alt="">'),e.imagesLoaded().then(function(){e.css({"background-image":"url("+t+")","background-attachment":e.attr("data-bgattachment")||"local"}).addClass("imgloaded"),"1"===e.attr("data-parallax")&&e.qtParallaxV5({speed:i})})},{offset:"100%"}))}):h(e+" [data-bgimage]").each(function(){var e=h(this),t=e.attr("data-bgimage"),i=e.attr("data-speed");if(""!==t)return""==i||void 0===i?i=.15:i/=10,e.css({"background-image":"url("+t+")","background-attachment":e.attr("data-bgattachment")||"local"}).addClass("imgloaded"),void("1"===e.attr("data-parallax")&&e.qtParallaxV5({speed:i}))})},
/**====================================================================
	 *
	 * 
	 *  Event countdown (requires library component) 
	 *  
	 * 
	 ====================================================================*/
h.fn.qtCountdown=function(){h.each(h(".qt-countdown"),function(e,t){var i,n=h(t).attr("data-end");if(void 0!==n&&""!==n){var o=new Date(n),r=new Date,a,s,l=o.getTime()-r.getTime();h(t).ClassyCountdown({theme:"white-wide",end:h.now()+l/1e3})}})},
/**====================================================================
	 *
	 *
	 *	Masonry templates (based on default WordPress Masonry)
	 *
	 * 
	 ====================================================================*/
h.fn.qtMasonry=function(e){return void 0===e&&(e="body"),h(e).find(".qt-masonry").each(function(e,t){var i=h(t),n=h(t).attr("id"),o=document.querySelector("#"+n);o&&i.imagesLoaded().then(function(){var e=new Masonry(o,{itemSelector:".qt-ms-item",columnWidth:".qt-ms-item"})})}),h(e).find(".gallery").each(function(e,t){var i=h(t),n=h(t).attr("id"),o=document.querySelector("#"+n);o&&i.imagesLoaded().then(function(){var e=new Masonry(o,{itemSelector:".gallery-item",columnWidth:".gallery-item"})})}),!0},
/**====================================================================
	 *
	 *
	 *	Skrollr plugin initialization only for desktop
	 *
	 * 
	 ====================================================================*/
h.fn.qtSkrollrInit=function(){
// disable skrollr if using handheld device
/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)||(window.vcParallaxSkroll,h.skrollrInstance=skrollr.init({smoothScrolling:!0,forceHeight:!1,render:function(e){10<=e.curTop&&e.curTop<=350&&window.dispatchEvent(new Event("resize"))}}))},h.fn.qtMaterialSlideshow=function(){h(".qt-material-slider").each(function(e,t){var i=h(t),n=i.attr("data-timeout");if(""!==n&&null!=n||(n=3e3),i.slider({full_width:!0,height:"100%",indicators:!0,interval:Number(n)||3e3}),i.on("click",".prev",function(){i.slider("prev")}),i.on("click",".next",function(){i.slider("next")}),i.on("mouseenter",".qt-slideshow-link",function(){i.slider("pause")}).mouseleave(function(){i.slider("start")}),i.hasClass("qt-hero-slider")){i.find(".qt-hero-slider-index").append('<hr class="qt-heroindex-indicator">');var o=i.find(".indicators li.indicator-item"),r,a=100/o.length;o.css({width:a+"%"}),i.find(".qt-heroindex-indicator").css({width:a+"%"}),i.on("click","[data-qtslidegoto]",function(e){e.preventDefault();var t=h(this).attr("data-qtslidegoto");i.find(".indicators li").eq(t).click(),i.find(".qt-active").removeClass("qt-active"),i.find(".qt-heroindex-indicator").css({left:a*t+"%"}),h(this).parent().addClass("qt-active")});var s=0,l=setInterval(function(){s=i.find(".indicators li.indicator-item.active").index(),i.find(".qt-active").removeClass("qt-active"),i.find(".qt-hero-slider-index-item").eq(s).addClass("qt-active"),i.find(".qt-heroindex-indicator").css({left:a*s+"%"})},500)}})}
/**====================================================================
	 *
	 *	After ajax page initialization
	 * 	Used by QT Ajax Pageloader. 
	 * 	MUST RETURN TRUE IF ALL OK.
	 * 
	 ====================================================================*/,h.fn.qtFooterFx=function(){var e=h("#qtFooterfxcontainer"),t=h("#qtFooterfx"),i=h("#maincontent");e.removeAttr("style"),t.removeAttr("style"),/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)||h(window).width()<1280||(e.css({height:t.outerHeight()+"px"}),t.css({width:t.outerWidth()+"px"}),t.css({position:"fixed",height:t.outerHeight()+"px",bottom:"0"}))}
/**====================================================================
	 *
	 *	Card activator
	 * 
	 ====================================================================*/,h.fn.qtCardActivator=function(){h.qtWebsiteObj.body.on("click",".qt-activate-card",function(e){e.preventDefault(),h(this).closest(".qt-interactivecard").toggleClass("open"),h.fn.NewYoutubeResize()}),h.qtWebsiteObj.body.on("click","[data-activatetab]",function(e){e.preventDefault();var t=h(this),i=t.closest(".qt-cardtabs"),n=i.find("[data-"+t.attr("data-activatetab")+"]");i.find(".qt-the-content").addClass("qt-hidden"),n.removeClass("qt-hidden")})}
/**====================================================================
	 *
	 *	qtnavsearch
	 * 
	 ====================================================================*/,h.fn.qtnavSearch=function(){var t=h("#qtnavsearch"),i=h("#qtsearch");h.qtWebsiteObj.body.on("click","#qtnavsearchbutton",function(e){e.preventDefault(),t.hasClass("open")&&""!==i.val()?h("#qtnavform").submit():t.toggleClass("open")}),h.qtWebsiteObj.body.on("click","#qtnavsearchclose",function(e){e.preventDefault(),t.removeClass("open")})}
/**====================================================================
	 *
	 *	Video activator
	 * 
	 ====================================================================*/,h.fn.qtVideoActivator=function(){h.qtWebsiteObj.body.on("click","[data-videoactivator]",function(e){e.preventDefault();var t=h(this),i;h(t.attr("data-videoactivator")).toggleClass("active"),"object"==typeof h.qtWebsiteObj.videos?h.qtWebsiteObj.videos[0].play():"object"==typeof h.qtWebsiteObj.twitchPlayer&&h.qtWebsiteObj.twitchPlayer.play()}),h.qtWebsiteObj.body.hasClass("qt-video-autoplay")&&h("[data-videoactivator]").click()}
/**====================================================================
	 *
	 *	Video controller
	 * 
	 ====================================================================*/,h.fn.qtVideoControl=function(){h(window).load(function(){"object"==typeof plyr&&(h.qtWebsiteObj.videos=plyr.setup())})}
/**====================================================================
	 *
	 *	Twitch Video
	 * 
	 ====================================================================*/,h.fn.qtTwitchVideo=function(){if("object"==typeof Twitch){var e=h("#qtTwitchPlayer");h.qtWebsiteObj.twitchPlayer=!1,e.length<=0||e.each(function(e,t){var i,n,o={video:"v"+h(this).attr("data-videoid"),autoplay:!1};h.qtWebsiteObj.twitchPlayer=new Twitch.Player("qtTwitchPlayer",o)})}}
/**
	 * Time conversion for plyr skip cue
	 */,h.fn.qtTimeConvert=function(e){var t=e.split(":"),i,n,o,r;return o=2==t.length?(n=+t[i=0],+t[1]):(i=+t[0],n=+t[1],+t[2]),3600*i+60*n+o;// int   
}
/**
	 * [qtChapters time skipping for videos with plyr.js]
	 * 
	 */,h.fn.qtChapters=function(){var e,n;h.qtWebsiteObj.body.on("click",".qt-skip",function(e){e.preventDefault();var t,i=h(this).parent().attr("data-time");n=h.fn.qtTimeConvert(i),
// cue in different way depending on the type of video
"object"==typeof h.qtWebsiteObj.videos?h.qtWebsiteObj.videos[0].seek(n):"object"==typeof h.qtWebsiteObj.twitchPlayer&&h.qtWebsiteObj.twitchPlayer.seek(n.toFixed(3))})}
/**====================================================================
	 *
	 *	[qtLockSidebar when clicking the lock, the sidebar stays locked]
	 * 
	 ====================================================================*/,h.fn.qtLockSidebar=function(){var t,i=h("#qtMasterContainter"),e=h("#ttgSidebarBlock"),n=e.attr("data-state"),o=e.find("i"),r=i.attr("data-0"),a=r.split("qt-notscrolled").join("qt-scrolled"),s=h("#qtFlexibleTopSpacer");h.qtWebsiteObj.body.on("click","#ttgSidebarBlock",function(e){e.preventDefault(),t=h(this),n="open"===n?(o.html("lock"),i.attr("data-0",a),t.attr("data-state","close"),s.addClass("closed"),"closed"):(o.html("lock_open"),i.attr("data-0",r),t.attr("data-state","open"),s.removeClass("closed"),"open"),void 0!==h.skrollrInstance?h.skrollrInstance.refresh():h.fn.qtSkrollrInit()})}
/**====================================================================
	 *
	 *	After ajax page initialization
	 * 	Used by QT Ajax Pageloader. 
	 * 	MUST RETURN TRUE IF ALL OK.
	 * 
	 ====================================================================*/,h.fn.initializeAfterAjax=function(){return h.fn.qtLockSidebar(),h.fn.slickGallery(),h.fn.qtQtSwitch(),h.fn.dynamicBackgroundsV2(),h.fn.qtCardActivator(),void 0!==h.skrollrInstance?h.skrollrInstance.refresh():h.fn.qtSkrollrInit(),h.fn.qtMasonry(),h.fn.qtCountdown(),
// $.fn.qtFitvids();
h.fn.transformlinks("#maincontent"),h(".qt-collapsible").collapsible(),jQuery("ul.tabs").tabs({swipeable:!1}).delay(500).promise().done(function(){jQuery("ul.tabs li:first-child a").click()}),h.fn.qtVideoControl(),h.fn.qtTwitchVideo(),h.fn.qtVideoActivator(),h.fn.qtChapters(),h(".qt-scrollspy").scrollSpy(),h(".tooltipped").tooltip({delay:50}),h("#qwShowDropdown").change(function(){h("a#"+h(this).attr("value")).click()}),h.fn.qtMaterialSlideshow(),h.fn.qtSmoothScroll(),h.fn.NewYoutubeResize(),!0}
/**====================================================================
	 *
	 * 
	 *  Functions to run once on first page load
	 *  
	 * 
	 ====================================================================*/,h.fn.qtPageloadInit=function(){h(".button-collapse").sideNav(),h(".qt-button-extrasidebar").sideNav({edge:"right",closeOnClick:!1,draggable:!1}),h.qtWebsiteObj.body.on("click",".qt-button-extrasidebar-close",function(e){e.preventDefault(),h(".qt-button-extrasidebar").sideNav("hide")}),h.qtWebsiteObj.body.on("click",".qt-navmenu-close",function(e){e.preventDefault(),h(".button-collapse").sideNav("hide")}),h.fn.qtnavSearch(),h.qtWebsiteObj.body.off("click",".qt-scrolltop"),h.qtWebsiteObj.body.on("click",".qt-scrolltop",function(e){e.preventDefault(),h("html, body").animate({scrollTop:0},"slow")}),h.fn.qtMobileNav(),h.fn.qtFooterFx(),h.fn.initializeAfterAjax()},
/**====================================================================
	 *
	 *	Page Ready Trigger
	 * 	This needs to call only $.fn.qtInitTheme
	 * 
	 ====================================================================*/
jQuery(document).ready(function(){h.fn.qtPageloadInit()}),h(window).resize(function(){h.fn.NewYoutubeResize()})}(jQuery);