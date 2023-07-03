import{q as g,s as zt,v as Gt,w as Jn,x as it,y as ge,z as we}from"./index-4ec1b577.js";function F(e){return e.getAttribute("w:val")||e.getAttribute("w14:val")||e.getAttribute("val")||""}function At(e){return parseInt(F(e),10)}function yn(e,t){if(t===void 0&&(t=!1),typeof e=="boolean")return e;if(typeof e=="string"){switch(e){case"1":return!0;case"0":return!1;case"on":return!0;case"off":return!1;case"true":return!0;case"false":return!1}if(typeof e=="number")return e!==0}return t}function _(e,t){return t===void 0&&(t=!0),yn(F(e),t)}function st(e,t,n){return n===void 0&&(n=!0),yn(e.getAttribute(t),n)}function pn(e,t,n){n===void 0&&(n=0);var a=e.getAttribute(t);return a?parseInt(a,10):n}function $(e,t){var n=e.getAttribute(t);if(n){if(n.endsWith("%"))return parseInt(n,10)/100;var a=parseInt(n,10);return a/1e5}return 1}function Kn(e){return parseInt(F(e)||"0",16)}function Yn(e,t){for(var n=16,a=t.replace(/{|}|-/g,""),r=new Array(n),s=0;s<n;s++)r[n-s-1]=parseInt(a.substr(s*2,2),16);for(var s=0;s<32;s++)e[s]=e[s]^r[s%n];return e}var Qn=function(){function e(){}return e.fromXML=function(t,n){var a,r,s=new e;s.name=n.getAttribute("w:name")||"";try{for(var x=g(n.children),o=x.next();!o.done;o=x.next()){var l=o.value,y=l.tagName;switch(y){case"w:family":s.family=F(l);break;case"w:altName":s.altName=F(l);break;case"w:panose1":break;case"w:charset":case"w:sig":case"w:pitch":break;case"w:embedRegular":case"w:embedBold":case"w:embedItalic":case"w:embedBoldItalic":case"w:embedSystemFonts":case"w:embedTrueTypeFonts":var p=l.getAttribute("r:id")||"",f=l.getAttribute("w:fontKey")||"",i=t.loadFont(p,f);i&&(s.url=i);break;default:console.warn("parse Font: Unknown key",y,l)}}}catch(c){a={error:c}}finally{try{o&&!o.done&&(r=x.return)&&r.call(x)}finally{if(a)throw a.error}}return s},e}(),_n=function(){function e(){this.fonts=[]}return e.fromXML=function(t,n){var a,r,s=Array.from(n.getElementsByTagName("w:font")),x=new e;try{for(var o=g(s),l=o.next();!l.done;l=o.next()){var y=l.value,p=Qn.fromXML(t,y);x.fonts.push(p)}}catch(f){a={error:f}}finally{try{l&&!l.done&&(r=o.return)&&r.call(o)}finally{if(a)throw a.error}}return x},e}();function ta(e,t){var n=e.getAttribute("Id")||"",a=e.getAttribute("Type")||"",r=e.getAttribute("Target")||"",s=e.getAttribute("TargetMode")||"";return{id:n,type:a,target:r,targetMode:s,part:t}}function ae(e,t){var n,a,r={},s=e.getElementsByTagName("Relationship");try{for(var x=g(s),o=x.next();!o.done;o=x.next()){var l=o.value,y=ta(l,t);r[y.id]=y}}catch(p){n={error:p}}finally{try{o&&!o.done&&(a=x.return)&&a.call(x)}finally{if(n)throw n.error}}return r}function ea(e){var t,n,a={overrides:[]},r=[].slice.call(e.getElementsByTagName("Override"));try{for(var s=g(r),x=s.next();!x.done;x=s.next()){var o=x.value;a.overrides.push({partName:o.getAttribute("PartName"),contentType:o.getAttribute("ContentType")})}}catch(l){t={error:l}}finally{try{x&&!x.done&&(n=s.return)&&n.call(s)}finally{if(t)throw t.error}}return a}var jt=1.3333,U={Dxa:{mul:jt*.05,unit:"px"},Emu:{mul:jt*1/12700,unit:"px"},FontSize:{mul:jt*.5,unit:"px"},Border:{mul:jt*.125,unit:"px"},Point:{mul:jt*1,unit:"px"},Percent:{mul:.02,unit:"%"},LineHeight:{mul:1/240,unit:""},VmlEmu:{mul:1/12700,unit:""}};function ve(e,t){return t===void 0&&(t=U.Dxa),e==null||/.+(p[xt]|[%])$/.test(e)?e:"".concat((parseInt(e)*t.mul).toFixed(2)).concat(t.unit)}function Zt(e){return e?parseInt(e)/6e4:0}function R(e,t,n){n===void 0&&(n=U.Dxa);var a=e.getAttribute(t);return a?ve(String(a),n):""}function fn(e,t){var n,a;try{for(var r=g(e.children),s=r.next();!s.done;s=r.next()){var x=s.value,o=x.tagName;switch(o){case"w:left":case"w:start":t["padding-left"]=R(x,"w:w");break;case"w:right":case"w:end":t["padding-right"]=R(x,"w:w");break;case"w:top":t["padding-top"]=R(x,"w:w");break;case"w:bottom":t["padding-bottom"]=R(x,"w:w");break}}}catch(l){n={error:l}}finally{try{s&&!s.done&&(a=r.return)&&a.call(r)}finally{if(n)throw n.error}}}var Vt={aliceBlue:"#f0f8ff",antiqueWhite:"#faebd7",aqua:"#00ffff",aquamarine:"#7fffd4",azure:"#f0ffff",beige:"#f5f5dc",bisque:"#ffe4c4",black:"#000000",blanchedAlmond:"#ffebcd",blue:"#0000ff",blueViolet:"#8a2be2",brown:"#a52a2a",burlyWood:"#deb887",cadetBlue:"#5f9ea0",chartreuse:"#7fff00",chocolate:"#d2691e",coral:"#ff7f50",cornflowerBlue:"#6495ed",cornsilk:"#fff8dc",crimson:"#dc143c",cyan:"#00FFFF",darkBlue:"#00008B",dkBlue:"#00008B",darkCyan:"#008B8B",dkCyan:"#008B8B",darkGoldenrod:"#b8860b",dkGoldenrod:"#b8860b",darkGray:"#A9A9A9",dkGray:"#A9A9A9",darkGreen:"#006400",dkGreen:"#006400",darkGrey:"#a9a9a9",dkGrey:"#a9a9a9",darkKhaki:"#bdb76b",dkKhaki:"#bdb76b",darkMagenta:"#800080",dkMagenta:"#800080",darkOliveGreen:"#556b2f",dkOliveGreen:"#556b2f",darkOrange:"#ff8c00",dkOrange:"#ff8c00",darkOrchid:"#9932cc",dkOrchid:"#9932cc",darkRed:"#8B0000",dkRed:"#8B0000",darkSalmon:"#e9967a",dkSalmon:"#e9967a",darkSeaGreen:"#8fbc8f",dkSeaGreen:"#8fbc8f",darkSlateBlue:"#483d8b",dkSlateBlue:"#483d8b",darkSlateGray:"#2f4f4f",dkSlateGray:"#2f4f4f",darkSlateGrey:"#2f4f4f",dkSlateGrey:"#2f4f4f",darkTurquoise:"#00ced1",dkTurquoise:"#00ced1",darkViolet:"#9400d3",dkViolet:"#9400d3",darkYellow:"#808000",deepPink:"#ff1493",deepSkyBlue:"#00bfff",dimGray:"#696969",dimGrey:"#696969",dodgerBlue:"#1e90ff",firebrick:"#b22222",floralWhite:"#fffaf0",forestGreen:"#228b22",fuchsia:"#ff00ff",gainsboro:"#dcdcdc",ghostWhite:"#f8f8ff",gold:"#ffd700",goldenrod:"#daa520",gray:"#808080",green:"#008000",greenYellow:"#adff2f",grey:"#808080",honeydew:"#f0fff0",hotPink:"#ff69b4",indianRed:"#cd5c5c",indigo:"#4b0082",ivory:"#fffff0",khaki:"#f0e68c",lavender:"#e6e6fa",lavenderBlush:"#fff0f5",lawnGreen:"#7cfc00",lemonChiffon:"#fffacd",lightBlue:"#add8e6",ltBlue:"#add8e6",lightCoral:"#f08080",ltCoral:"#f08080",lightCyan:"#e0ffff",ltCyan:"#e0ffff",lightGoldenrodYellow:"#fafad2",ltGoldenrodYellow:"#fafad2",lightGray:"#D3D3D3",ltGray:"#D3D3D3",lightGreen:"#90ee90",ltGreen:"#90ee90",lightGrey:"#d3d3d3",ltGrey:"#d3d3d3",lightPink:"#ffb6c1",ltPink:"#ffb6c1",lightSalmon:"#ffa07a",ltSalmon:"#ffa07a",lightSeaGreen:"#20b2aa",ltSeaGreen:"#20b2aa",lightSkyBlue:"#87cefa",ltSkyBlue:"#87cefa",lightSlateGray:"#778899",ltSlateGray:"#778899",lightSlateGrey:"#778899",ltSlateGrey:"#778899",lightSteelBlue:"#b0c4de",ltSteelBlue:"#b0c4de",lightYellow:"#ffffe0",ltYellow:"#ffffe0",lime:"#00ff00",limeGreen:"#32cd32",linen:"#faf0e6",magenta:"#FF00FF",maroon:"#800000",mediumAquamarine:"#66cdaa",medAquamarine:"#66cdaa",mediumBlue:"#0000cd",medBlue:"#0000cd",mediumOrchid:"#ba55d3",medOrchid:"#ba55d3",mediumPurple:"#9370db",medPurple:"#9370db",mediumSeaGreen:"#3cb371",medSeaGreen:"#3cb371",mediumSlateBlue:"#7b68ee",medSlateBlue:"#7b68ee",mediumSpringGreen:"#00fa9a",medSpringGreen:"#00fa9a",mediumTurquoise:"#48d1cc",medTurquoise:"#48d1cc",mediumVioletRed:"#c71585",medVioletRed:"#c71585",midnightBlue:"#191970",mintCream:"#f5fffa",mistyRose:"#ffe4e1",moccasin:"#ffe4b5",navajoWhite:"#ffdead",navy:"#000080",none:"transparent",oldLace:"#fdf5e6",olive:"#808000",oliveDrab:"#6b8e23",orange:"#ffa500",orangeRed:"#ff4500",orchid:"#da70d6",paleGoldenrod:"#eee8aa",paleGreen:"#98fb98",paleTurquoise:"#afeeee",paleVioletRed:"#db7093",papayaWhip:"#ffefd5",peachPuff:"#ffdab9",peru:"#cd853f",pink:"#ffc0cb",plum:"#dda0dd",powderBlue:"#b0e0e6",purple:"#800080",rebeccaPurple:"#663399",red:"#ff0000",rosyBrown:"#bc8f8f",royalBlue:"#4169e1",saddleBrown:"#8b4513",salmon:"#fa8072",sandyBrown:"#f4a460",seaGreen:"#2e8b57",seaShell:"#fff5ee",sienna:"#a0522d",silver:"#c0c0c0",skyBlue:"#87ceeb",slateBlue:"#6a5acd",slateGray:"#708090",slateGrey:"#708090",snow:"#fffafa",springGreen:"#00ff7f",steelBlue:"#4682b4",tan:"#d2b48c",teal:"#008080",thistle:"#d8bfd8",tomato:"#ff6347",turquoise:"#40e0d0",violet:"#ee82ee",wheat:"#f5deb3",white:"#ffffff",whiteSmoke:"#f5f5f5",yellow:"#ffff00",yellowGreen:"#9acd32"},na=["black","blue","green","red","white","yellow"];function dt(e,t,n,a){n===void 0&&(n="w:color"),a===void 0&&(a="black");var r=t.getAttribute(n);if(r)return r=="auto"?a:na.includes(r)?r:r in Vt?Vt[r]:"#".concat(r);var s=t.getAttribute("w:themeColor");return s?e.getThemeColor(s):""}function Se(e,t){var n=t.getAttribute("w:fill")||"",a=F(t);if(n==="auto"&&(n="FFFFFF"),n.length===6)switch(a){case"clear":return"#".concat(n);case"pct10":return z(n,.1);case"pct12":return z(n,.125);case"pct15":return z(n,.15);case"pct20":return z(n,.2);case"pct25":return z(n,.25);case"pct30":return z(n,.3);case"pct35":return z(n,.35);case"pct37":return z(n,.375);case"pct40":return z(n,.4);case"pct45":return z(n,.45);case"pct5":return z(n,.05);case"pct50":return z(n,.5);case"pct55":return z(n,.55);case"pct60":return z(n,.6);case"pct65":return z(n,.65);case"pct70":return z(n,.7);case"pct75":return z(n,.75);case"pct80":return z(n,.8);case"pct85":return z(n,.85);case"pct87":return z(n,.87);case"pct90":return z(n,.9);case"pct95":return z(n,.95);default:return console.warn("unsupport shd val",a),"#".concat(n)}return""}function z(e,t){e==="FFFFFF"&&(e="000000");var n=parseInt(e.substring(0,2),16),a=parseInt(e.substring(2,4),16),r=parseInt(e.substring(4,6),16);return"rgba(".concat(n,", ").concat(a,", ").concat(r,", ").concat(t,")")}function aa(e,t){return dt(e,t,"w:val")}var sa="black";function mt(e,t){var n=F(t);if(n==="nil"||n==="none")return"none";var a=dt(e,t),r=R(t,"w:sz",U.Border);return"".concat(r," solid ").concat(a=="auto"?sa:a)}function Wt(e,t,n){var a,r;try{for(var s=g(t.children),x=s.next();!x.done;x=s.next()){var o=x.value,l=o.tagName;switch(l){case"w:start":case"w:left":n["border-left"]=mt(e,o);break;case"w:end":case"w:right":n["border-right"]=mt(e,o);break;case"w:top":n["border-top"]=mt(e,o);break;case"w:bottom":n["border-bottom"]=mt(e,o);break;default:break}}}catch(y){a={error:y}}finally{try{x&&!x.done&&(r=s.return)&&r.call(s)}finally{if(a)throw a.error}}}function cn(e,t){var n=e.getAttribute("w:val");switch(n){case"lr":case"lrV":case"btLr":case"lrTb":case"lrTbV":case"tbLrV":t.direction="ltr";break;case"rl":case"rlV":case"tbRl":case"tbRlV":t.direction="rtl";break}}function Jt(e){var t=e.getAttribute("w:type");return!t||t==="dxa"?R(e,"w:w"):t==="pct"?R(e,"w:w",U.Percent):t==="auto"?"auto":(console.warn("parseTblWidth: ignore type",t,e),"")}function dn(e,t){var n,a=t.getElementsByTagName("w:insideH").item(0);a&&(n=mt(e,a));var r,s=t.getElementsByTagName("w:insideV").item(0);return s&&(r=mt(e,s)),{H:n,V:r}}function ra(e,t){var n=F(e);switch(n){case"bottom":t["vertical-align"]="bottom";break;case"center":t["vertical-align"]="middle";break;case"top":t["vertical-align"]="top";break}}function hn(e,t){var n=Jt(e);n&&(t["cell-spacing"]=n)}function la(e,t){var n=Jt(e);n&&(t.width=n)}function mn(e,t){var n,a,r={},s={};r.cssStyle=s;try{for(var x=g(t.children),o=x.next();!o.done;o=x.next()){var l=o.value,y=l.tagName;switch(y){case"w:tcMar":fn(l,s);break;case"w:shd":s["background-color"]=Se(e,l);break;case"w:tcW":la(l,s);break;case"w:noWrap":var p=_(l);p&&(s["white-space"]="nowrap");break;case"w:vAlign":ra(l,s);break;case"w:tcBorders":Wt(e,l,s),r.insideBorder=dn(e,l);break;case"w:gridSpan":r.gridSpan=At(l);break;case"w:vMerge":r.vMerge=F(l)||"continue";break;case"w:textDirection":cn(l,s);break;case"w:cnfStyle":break;case"w:hideMark":r.hideMark=_(l,!0);break;default:console.warn("parseTcPr: ignore",y,l)}}}catch(f){n={error:f}}finally{try{o&&!o.done&&(a=x.return)&&a.call(x)}finally{if(n)throw n.error}}return r}function He(e,t,n){e/=255,t/=255,n/=255;var a=Math.max(e,t,n),r=Math.min(e,t,n),s=0,x,o=(a+r)/2;if(a==r)s=x=0;else{var l=a-r;switch(x=o>.5?l/(2-a-r):l/(a+r),a){case e:s=(t-n)/l+(t<n?6:0);break;case t:s=(n-e)/l+2;break;case n:s=(e-t)/l+4;break}s/=6}return{h:s,s:x,l:o}}function se(e,t,n){return n<0&&(n+=1),n>1&&(n-=1),n<1/6?e+(t-e)*6*n:n<1/2?t:n<2/3?e+(t-e)*(2/3-n)*6:e}function re(e,t,n){e>1&&(e=e/360);var a,r,s;if(t==0)a=r=s=n;else{var x=n<.5?n*(1+t):n+t-n*t,o=2*n-x;a=se(o,x,e+1/3),r=se(o,x,e),s=se(o,x,e-1/3)}return{r:a*255,g:r*255,b:s*255}}function le(e){return e.length==1?"0"+e:""+e}function xe(e,t,n){var a=[le(Math.round(e).toString(16)),le(Math.round(t).toString(16)),le(Math.round(n).toString(16))];return a.join("").toUpperCase()}function ut(e){return Math.min(Math.max(e,0),255)}var bt=function(){function e(t){var n=t.match(/^#?([0-9a-f]{6})$/i);n&&(this.r=parseInt(n[1].substring(0,2),16),this.g=parseInt(n[1].substring(2,4),16),this.b=parseInt(n[1].substring(4,6),16),this.isValid=!0)}return e.fromHSL=function(t,n,a){var r=re(t,n,a);return new e("#".concat(xe(r.r,r.g,r.b)))},e.fromRGB=function(t,n,a){var r=xe(t,n,a);return new e("#".concat(r))},e.prototype.lum=function(t){return this.changeHsl(t,"l","set")},e.prototype.lumMod=function(t){return this.changeHsl(t,"l","mod")},e.prototype.lumOff=function(t){return this.changeHsl(t,"l","off")},e.prototype.hue=function(t){return this.changeHsl(t,"h","set")},e.prototype.hueMod=function(t){return this.changeHsl(t,"h","mod")},e.prototype.hueOff=function(t){return this.changeHsl(t,"h","off")},e.prototype.sat=function(t){return this.changeHsl(t,"s","set")},e.prototype.satMod=function(t){return this.changeHsl(t,"s","mod")},e.prototype.satOff=function(t){return this.changeHsl(t,"s","off")},e.prototype.changeHsl=function(t,n,a){var r=He(this.r,this.g,this.b);a==="set"?r[n]=t:a==="mod"?r[n]=r[n]*t:a==="off"&&(r[n]+=r[n]*t);var s=re(r.h,r.s,r.l);return this.r=s.r,this.g=s.g,this.b=s.b,this},e.prototype.comp=function(){var t=He(this.r,this.g,this.b);t.h=t.h+.5,t.h>1&&(t.h-=1);var n=re(t.h,t.s,t.l);return this.r=n.r,this.g=n.g,this.b=n.b,this},e.prototype.shade=function(t){this.r=ut(this.r-256*t),this.g=ut(this.g-256*t),this.b=ut(this.b-256*t)},e.prototype.tint=function(t){this.r=ut(this.r+256*t),this.g=ut(this.g+256*t),this.b=ut(this.b+256*t)},e.prototype.inv=function(){return this.r=255-this.r,this.g=255-this.g,this.b=255-this.b,this},e.prototype.toHex=function(){return"#"+xe(this.r,this.g,this.b)},e.prototype.toRgba=function(t){return"rgba(".concat(this.r,", ").concat(this.g,", ").concat(this.b,", ").concat(t,")")},e}();function Tt(e,t){var n,a,r=new bt(t);if(r.isValid){var s=1;try{for(var x=g(e.children),o=x.next();!o.done;o=x.next()){var l=o.value,y=l.tagName;switch(y){case"a:alpha":case"w14:alpha":s=$(l,"val");break;case"a:blue":r.b=256*$(l,"val");break;case"a:blueMod":r.b=r.b*$(l,"val");break;case"a:blueOff":r.b+=r.b*$(l,"val");break;case"a:comp":r.comp();break;case"a:green":r.g=256*$(l,"val");break;case"a:greenMod":r.g=r.g*$(l,"val");break;case"a:greenOff":r.g+=r.g*$(l,"val");break;case"a:red":r.r=256*$(l,"val");break;case"a:redMod":r.r=r.r*$(l,"val");break;case"a:redOff":r.r+=r.r*$(l,"val");break;case"a:lum":r.lum($(l,"val"));break;case"a:lumMod":r.lumMod($(l,"val"));break;case"a:lumOff":r.lumOff($(l,"val"));break;case"a:hue":r.hue(Zt(l.getAttribute("hue"))/360);break;case"a:hueMod":r.hueMod($(l,"val"));break;case"a:hueOff":r.hueOff($(l,"val"));break;case"a:sat":r.sat($(l,"val"));break;case"a:satMod":r.satMod($(l,"val"));break;case"a:satOff":r.satOff($(l,"val"));break;case"a:shade":r.shade($(l,"val"));break;case"a:tint":r.tint($(l,"val"));break;default:console.log("unknown color modify",l);break}}}catch(p){n={error:p}}finally{try{o&&!o.done&&(a=x.return)&&a.call(x)}finally{if(n)throw n.error}}return s!==1?r.toRgba(s):r.toHex()}return t}function gt(e,t){var n=t.firstElementChild;if(n){var a=n.tagName;switch(a){case"a:prstClr":var r=F(n)||"";if(r in Vt)return Tt(n,Vt[r]);console.warn("parseOutline: Unknown color ",r,n);break;case"a:srgbClr":case"a:scrgbClr":case"w14:srgbClr":var s=F(n);if(s)return Tt(n,"#"+s);var x=$(n,"r"),o=$(n,"g"),l=$(n,"b"),y=bt.fromRGB(x,o,l);return Tt(n,y.toHex());case"a:hslClr":var p=$(n,"r"),f=$(n,"g"),i=$(n,"b"),c=F(n);if(c)return Tt(n,"#"+c);var d=bt.fromHSL(p,f,i);return Tt(n,d.toHex());case"a:schemeClr":case"w14:schemeClr":var h=F(n);if(h)return Tt(n,e.getThemeColor(h));console.warn("parseOutline: Unknown schemeClr ",n);break;case"a:sysClr":return F(n);default:console.warn("parseOutline: Unknown color type ",a,n)}}return""}function xa(e,t){var n=R(e,"w:firstLine"),a=R(e,"w:hanging"),r=R(e,"w:left"),s=R(e,"w:start"),x=R(e,"w:right"),o=R(e,"w:end");n&&(t["text-indent"]=n),a&&(t["text-indent"]="-".concat(a)),(r||s)&&(t["margin-left"]=r||s),(x||o)&&(t["margin-right"]=x||o)}function oa(e,t,n){var a=R(t,"w:before"),r=R(t,"w:after"),s=t.getAttribute("w:lineRule");a&&(n["margin-top"]=a),r&&(n["margin-bottom"]=r);var x=t.getAttribute("w:line");if(x){if(e.renderOptions.forceLineHeight){n["line-height"]=e.renderOptions.forceLineHeight;return}var o=parseInt(x,10),l=e.renderOptions.minLineHeight||1;switch(s){case"auto":var y=Math.max(l,o/240);n["line-height"]="".concat(y.toFixed(2));break;case"atLeast":break;default:var p=Math.max(l,o/20);n["line-height"]="".concat(p,"pt");break}}}function ya(e){return"var(--docx-theme-font-".concat(e,")")}function pa(e,t,n){var a,r,s=[],x=e.renderOptions.fontMapping;try{for(var o=g(t.attributes),l=o.next();!l.done;l=o.next()){var y=l.value,p=y.name,f=y.value;switch(p){case"w:ascii":case"w:cs":case"w:eastAsia":x&&f in x&&(f=x[f]),f.indexOf(" ")===-1?s.push(f):s.push('"'+f+'"');break;case"w:asciiTheme":case"w:csTheme":case"w:eastAsiaTheme":s.push(ya(f));break}}}catch(i){a={error:i}}finally{try{l&&!l.done&&(r=o.return)&&r.call(o)}finally{if(a)throw a.error}}s.length&&(n["font-family"]=Array.from(new Set(s)).join(", "))}function gn(e,t){var n=R(e,"w:val"),a=e.getAttribute("w:hRule");a==="exact"?t.height=n:a==="atLeast"&&(t.height=n,t["min-height"]=n)}function wn(e){switch(e){case"start":case"left":return"left";case"center":return"center";case"end":case"right":return"right";case"both":case"distribute":return"justify"}return e}function fa(e,t,n){var a=F(t);if(a!=null){switch(a){case"dash":case"dashDotDotHeavy":case"dashDotHeavy":case"dashedHeavy":case"dashLong":case"dashLongHeavy":case"dotDash":case"dotDotDash":n["text-decoration-style"]="dashed";break;case"dotted":case"dottedHeavy":n["text-decoration-style"]="dotted";break;case"double":n["text-decoration-style"]="double";break;case"single":case"thick":n["text-decoration"]="underline";break;case"wave":case"wavyDouble":case"wavyHeavy":n["text-decoration-style"]="wavy";break;case"words":n["text-decoration"]="underline";break;case"none":n["text-decoration"]="none";break}var r=dt(e,t);r&&(n["text-decoration-color"]=r)}}function ia(e,t){var n,a;try{for(var r=g(e.attributes),s=r.next();!s.done;s=r.next()){var x=s.value,o=x.name,l=x.value;switch(o){case"w:dropCap":l==="drop"&&(t.float="left");break;case"w:h":typeof l=="object"&&!Array.isArray(l)&&(t.height=R(l,"w:h"));break;case"w:w":typeof l=="object"&&!Array.isArray(l)&&(t.width=R(l,"w:w"));break;case"w:hAnchor":case"w:vAnchor":case"w:lines":break;case"w:wrap":l!=="around"&&console.warn("parseFrame: w:wrap not support "+l);break;default:console.warn("parseFrame: unknown attribute "+o,x)}}}catch(y){n={error:y}}finally{try{s&&!s.done&&(a=r.return)&&a.call(r)}finally{if(n)throw n.error}}}function ca(e,t){switch(e){case"dot":t["text-emphasis"]="filled",t["text-emphasis-position"]="under right";break;case"comma":t["text-emphasis"]="filled sesame";break;case"circle":t["text-emphasis"]="open";break;case"underDot":t["text-emphasis"]="filled",t["text-emphasis-position"]="under right";break}}function Xt(e,t,n){var a,r,s={};try{for(var x=g(t.children),o=x.next();!o.done;o=x.next()){var l=o.value,y=l.tagName;switch(y){case"w:sz":case"w:szCs":s["font-size"]=R(l,"w:val",U.FontSize);break;case"w:jc":s["text-align"]=wn(F(l));break;case"w:framePr":ia(l,s);break;case"w:pBdr":Wt(e,l,s);break;case"w:ind":xa(l,s);break;case"w:color":s.color=aa(e,l);break;case"w:shd":"background-color"in s||(s["background-color"]=Se(e,l));break;case"w:spacing":oa(e,l,s);break;case"w:highlight":s["background-color"]=dt(e,l,"w:val","yellow");break;case"w:vertAlign":var p=F(l);p==="superscript"?s["vertical-align"]="super":p==="subscript"&&(s["vertical-align"]="sub");break;case"w:position":s["vertical-align"]=R(l,"w:val",U.FontSize);break;case"w:trHeight":gn(l,s);break;case"w:strike":case"w:dstrike":s["text-decoration"]=_(l)?"line-through":"none";break;case"w:b":s["font-weight"]=_(l)?"bold":"normal";break;case"w:adjustRightInd":break;case"w:bCs":case"w:iCs":break;case"w:i":s["font-style"]=_(l)?"italic":"normal";break;case"w:caps":s["text-transform"]=_(l)?"uppercase":"normal";break;case"w:smallCaps":s["text-transform"]=_(l)?"lowercase":"normal";break;case"w:u":fa(e,l,s);break;case"w:rFonts":pa(e,l,s);break;case"w:tblCellSpacing":s["border-spacing"]=R(l,"w:w"),s["border-collapse"]="separate";break;case"w:bdr":s.border=mt(e,l);break;case"w:vanish":_(l)&&(s.display="none");break;case"w:kern":break;case"w:pStyle":break;case"w:lang":case"w:noProof":break;case"w:keepLines":case"w:keepNext":case"w:widowControl":case"w:pageBreakBefore":break;case"w:outlineLvl":break;case"w:contextualSpacing":break;case"w:numPr":break;case"w:rPr":var f=l.getElementsByTagName("w14:reflection").item(0);if(f){var i=R(f,"w4:dist",U.Emu)||"0px";s["-webkit-box-reflect"]="below ".concat(i," linear-gradient(transparent, white)")}break;case"w:rStyle":break;case"w:webHidden":s.display="none";break;case"w:tabs":break;case"w:snapToGrid":break;case"w:topLinePunct":break;case"w:wordWrap":_(l)&&(s["word-break"]="break-all");break;case"w:textAlignment":var c=F(l);c==="center"?s["vertical-align"]="middle":c!=="auto"&&(s["vertical-align"]=c);break;case"w:textDirection":cn(l,s);break;case"w:cnfStyle":break;case"w:bidi":_(l,!0)&&console.warn("w:bidi is not supported.");break;case"w:autoSpaceDE":case"w:autoSpaceDN":break;case"w:kinsoku":break;case"w:overflowPunct":break;case"w:em":ca(F(l),s);break;case"w:w":var d=At(l);s.transform="scaleX(".concat(d/100,")"),s.display="inline-block";break;case"w:outline":s["text-shadow"]="-1px -1px 0 #AAA, 1px -1px 0 #AAA, -1px 1px 0 #AAA, 1px 1px 0 #AAA";break;case"w:shadown":case"w:imprint":_(l,!0)&&(s["text-shadow"]="1px 1px 2px rgba(0, 0, 0, 0.6)");break;case"w14:shadow":var h=R(l,"w14:blurRad",U.Emu)||"4px",m="rgba(0, 0, 0, 0.6)",v=gt(e,l);v&&(m=v),s["text-shadow"]="1px 1px ".concat(h," ").concat(m);break;case"w14:textOutline":var A=R(l,"w14:w",U.Emu)||"1px";s["-webkit-text-stroke-width"]=A;var T="white",L=l.getElementsByTagName("w14:solidFill");L.length>0&&(T=gt(e,L.item(0))||"white"),s["-webkit-text-stroke-color"]=T;break;case"w14:reflection":break;case"w14:textFill":break;case"w14:ligatures":break;default:console.warn("parsePr Unknown tagName",y,l)}}}catch(b){a={error:b}}finally{try{o&&!o.done&&(r=x.return)&&r.call(x)}finally{if(a)throw a.error}}return s}var Kt=function(){function e(t){this.name=t}return e.fromXML=function(t,n){var a=n.getAttribute("w:name");return a?new e(a):(console.warn("Bookmark without name"),new e("unknown"))},e}(),ue=function(){function e(){this.type="textWrapping"}return e.fromXML=function(t,n){return new e},e}(),da=function(){function e(){}return e.fromXML=function(t,n){var a=new e,r=n.getAttribute("r:embed")||"",s=t.getDocumentRels(r);return s&&(a.embled=s,a.src=t.loadImage(a.embled)),a},e}(),ha=function(){function e(){}return e.fromXML=function(t,n){var a=new e,r=n==null?void 0:n.getElementsByTagName("a:blip").item(0);return r&&(a.blip=da.fromXML(t,r)),a},e}(),ma=function(){function e(){}return e.fromXML=function(t,n){var a=new e,r=n.getElementsByTagName("a:off").item(0);r&&(a.off={x:R(r,"x",U.Emu),y:R(r,"y",U.Emu)});var s=n.getElementsByTagName("a:ext").item(0);s&&(a.ext={cx:R(s,"cx",U.Emu),cy:R(s,"cy",U.Emu)});var x=n.getAttribute("rot");return x&&(a.rot=Zt(x)),a},e}();function Et(e){var t,n,a=[];try{for(var r=g(e.children),s=r.next();!s.done;s=r.next()){var x=s.value,o=x.tagName;if(o==="a:pt"||o==="pt"){var l=x.getAttribute("x"),y=x.getAttribute("y");l&&y&&a.push({x:l,y})}else console.warn("unknown pt",o,x)}}catch(p){t={error:p}}finally{try{s&&!s.done&&(n=r.return)&&n.call(r)}finally{if(t)throw t.error}}return a}function ga(e){var t,n,a=[];try{for(var r=g(e.children),s=r.next();!s.done;s=r.next()){var x=s.value,o=x.tagName;switch(o){case"a:moveTo":case"moveTo":var l=Et(x);if(l.length){var y={type:"moveTo",pt:l[0]};a.push(y)}break;case"a:lnTo":case"lnTo":var p=Et(x);if(p.length){var f={type:"lnTo",pt:p[0]};a.push(f)}break;case"a:quadBezTo":case"quadBezTo":var i=Et(x);if(i.length){var c={type:"quadBezTo",pts:i};a.push(c)}break;case"a:cubicBezTo":case"cubicBezTo":var d=Et(x);if(d.length){var h={type:"cubicBezTo",pts:d};a.push(h)}break;case"a:arcTo":case"arcTo":var m=x.getAttribute("wR"),v=x.getAttribute("hR"),A=x.getAttribute("stAng"),T=x.getAttribute("swAng");if(m&&v&&A&&T){var L={type:"arcTo",wR:m,hR:v,stAng:A,swAng:T};a.push(L)}break;case"a:close":case"close":a.push({type:"close"});break;default:console.warn("parsePath: unknown tag",o,x)}}}catch(S){t={error:S}}finally{try{s&&!s.done&&(n=r.return)&&n.call(r)}finally{if(t)throw t.error}}var b={defines:a},k=e.getAttribute("fill");k&&(b.fill=k),b.extrusionOk=st(e,"extrusionOk",!1),b.stroke=st(e,"stroke",!0);var u=e.getAttribute("w");u&&(b.w=parseInt(u,10));var w=e.getAttribute("h");return w&&(b.h=parseInt(w,10)),b}function wa(e){var t,n,a=[];try{for(var r=g(e.children),s=r.next();!s.done;s=r.next()){var x=s.value,o=x.tagName;switch(o){case"a:path":case"path":a.push(ga(x));break}}}catch(l){t={error:l}}finally{try{s&&!s.done&&(n=r.return)&&n.call(r)}finally{if(t)throw t.error}}return a}function Te(e){var t,n,a=[];try{for(var r=g(e.children),s=r.next();!s.done;s=r.next()){var x=s.value,o=x.tagName;switch(o){case"a:gd":case"gd":var l=x.getAttribute("name"),y=x.getAttribute("fmla");if(l&&y){var p={n:l,f:y};a.push(p)}break}}}catch(f){t={error:f}}finally{try{s&&!s.done&&(n=r.return)&&n.call(r)}finally{if(t)throw t.error}}return a}function va(e){var t,n,a={};try{for(var r=g(e.children),s=r.next();!s.done;s=r.next()){var x=s.value,o=x.tagName;switch(o){case"a:avLst":case"avLst":a.avLst=Te(x);break;case"a:gdLst":case"gdLst":a.gdLst=Te(x);break;case"a:rect":case"react":var l={b:x.getAttribute("b")||"",l:x.getAttribute("l")||"",r:x.getAttribute("r")||"",t:x.getAttribute("t")||""};a.rect=l;break;case"a:pathLst":case"pathLst":a.pathLst=wa(x);break}}}catch(y){t={error:y}}finally{try{s&&!s.done&&(n=r.return)&&n.call(r)}finally{if(t)throw t.error}}return a}var ua=function(){function e(){}return e.fromXML=function(t,n){var a,r,s=new e;s.prst=n.getAttribute("prst");try{for(var x=g(n.children),o=x.next();!o.done;o=x.next()){var l=o.value,y=l.tagName;switch(y){case"a:avLst":s.avLst=Te(l)}}}catch(p){a={error:p}}finally{try{o&&!o.done&&(r=x.return)&&r.call(x)}finally{if(a)throw a.error}}return s},e}(),Ta=function(){function e(){}return e.fromXML=function(t,n){var a=new e;return a.shape=va(n),a},e}();function Aa(e){var t="solid";switch(e){case"dash":case"dashDot":case"lgDash":case"lgDashDot":case"lgDashDotDot":case"sysDash":case"sysDashDot":case"sysDashDotDot":t="dashed";break;case"dot":case"sysDot":t="dotted";break}return t}function ba(e,t){var n,a,r=R(t,"w",U.Emu),s={width:r};s.style="solid";try{for(var x=g(t.children),o=x.next();!o.done;o=x.next()){var l=o.value,y=l.tagName;switch(y){case"a:solidFill":s.color=gt(e,l);break;case"a:noFill":s.style="none";break;case"a:round":s.radius="8%";break;case"a:prstDash":s.style=Aa(l.getAttribute("val"));break;default:console.warn("parseOutline: Unknown tag ",y,l)}}}catch(p){n={error:p}}finally{try{o&&!o.done&&(a=x.return)&&a.call(x)}finally{if(n)throw n.error}}return s}var vn=function(){function e(){}return e.fromXML=function(t,n){var a,r,s=new e;if(n)try{for(var x=g(n.children),o=x.next();!o.done;o=x.next()){var l=o.value,y=l.tagName;switch(y){case"a:xfrm":s.xfrm=ma.fromXML(t,l);break;case"a:prstGeom":s.geom=ua.fromXML(t,l);break;case"a:custGeom":s.custGeom=Ta.fromXML(t,l);break;case"a:ln":s.outline=ba(t,l);break;case"a:noFill":s.noFill=!0;break;case"a:solidFill":s.fillColor=gt(t,l);break;default:console.warn("ShapePr: Unknown tag ",y,l)}}}catch(p){a={error:p}}finally{try{o&&!o.done&&(r=x.return)&&r.call(x)}finally{if(a)throw a.error}}return s},e}(),ka=function(){function e(){}return e.fromXML=function(t,n){var a=new e,r=n==null?void 0:n.getElementsByTagName("pic:cNvPr").item(0);if(r){a.alt=r.getAttribute("descr")||"",a.altVar=r.getAttribute("descrVar")||"";var s=st(r,"hidden",!1);if(s)return a}return a.blipFill=ha.fromXML(t,n==null?void 0:n.getElementsByTagName("pic:blipFill").item(0)),a.spPr=vn.fromXML(t,n==null?void 0:n.getElementsByTagName("pic:spPr").item(0)),a},e}(),wt=function(){function e(){this.properties={},this.tblGrid=[],this.trs=[]}return e}(),Ra=function(){function e(){this.properties={},this.tcs=[]}return e}(),La=function(){function e(){this.properties={},this.children=[]}return e.prototype.add=function(t){t&&this.children.push(t)},e}();function Ca(e,t,n,a){var r,s,x=new La;try{for(var o=g(t.children),l=o.next();!l.done;l=o.next()){var y=l.value,p=y.tagName;switch(p){case"w:tcPr":x.properties=mn(e,y);break;case"w:p":x.add(nt.fromXML(e,y));break;case"w:tbl":x.add($t(e,y));break}}}catch(d){r={error:d}}finally{try{l&&!l.done&&(s=o.return)&&s.call(o)}finally{if(r)throw r.error}}var f=a[n.index];if(x.properties.vMerge){if(x.properties.vMerge==="restart")x.properties.rowSpan=1,a[n.index]=x;else if(f)if(f.properties&&f.properties.rowSpan){f.properties.rowSpan=f.properties.rowSpan+1;var i=x.properties.gridSpan||1;return n.index+=i,null}else console.warn("Tc.fromXML: continue but not found lastCol",n.index,x,a)}else delete a[n.index];var c=x.properties.gridSpan||1;return n.index+=c,x}function ja(e,t){var n=F(e);switch(n){case"left":case"start":break;case"right":case"end":t.float="right"}}function Ba(e,t){var n=Jt(e);n&&(t["margin-left"]=n)}function Oa(e,t){var n=Jt(e);n&&(t.width=n)}function Da(e){var t={},n=Kn(e);return(st(e,"firstRow",!1)||n&32)&&(t.firstRow=!0),(st(e,"lastRow",!1)||n&64)&&(t.lastRow=!0),(st(e,"firstColumn",!1)||n&128)&&(t.firstColumn=!0),(st(e,"lastColumn",!1)||n&256)&&(t.lastColumn=!0),st(e,"noHBand",!1)||n&512?t.noHBand=!0:t.noHBand=!1,st(e,"noVBand",!1)||n&1024?t.noVBand=!0:t.noVBand=!1,t}function Fa(e,t,n){if(typeof e.renderOptions.padding>"u"){var a=R(t,"w:tblpX"),r=R(t,"w:tblpY");n.top=r,n.left=a}}function Sa(e,t){var n=e.getAttribute("w:type");n==="fixed"&&(t["table-layout"]="fixed")}function Yt(e,t){var n,a,r={},s={},x={};r.tblLook={},r.cssStyle=s,r.tcCSSStyle=x;try{for(var o=g(t.children),l=o.next();!l.done;l=o.next()){var y=l.value,p=y.tagName;switch(p){case"w:tblBorders":Wt(e,y,s),r.insideBorder=dn(e,y);break;case"w:tcBorders":Wt(e,y,s);break;case"w:tblInd":Ba(y,s);break;case"w:jc":ja(y,s);break;case"w:tblCellMar":case"w:tcMar":fn(y,x);break;case"w:tblStyle":r.pStyle=F(y);break;case"w:tblW":Oa(y,s);break;case"w:shd":s["background-color"]=Se(e,y);break;case"w:tblCaption":r.tblCaption=F(y);break;case"w:tblCellSpacing":hn(y,s);break;case"w:tblLayout":Sa(y,s);break;case"w:tblLook":r.tblLook=Da(y);break;case"w:tblStyleRowBandSize":r.rowBandSize=At(y);break;case"w:tblStyleColBandSize":r.colBandSize=At(y);break;case"w:tblpPr":Fa(e,y,s);break;default:console.warn("parseTableProperties unknown tag",p,y)}}}catch(f){n={error:f}}finally{try{l&&!l.done&&(a=o.return)&&a.call(o)}finally{if(n)throw n.error}}return r}function un(e,t){var n,a,r={},s={};try{for(var x=g(t.children),o=x.next();!o.done;o=x.next()){var l=o.value,y=l.tagName;switch(y){case"w:hidden":_(l)&&(r.display="none");break;case"w:trHeight":gn(l,r);break;case"w:jc":r["text-align"]=wn(F(l));break;case"w:cantSplit":break;case"w:tblPrEx":var p=Yt(e,l);Object.assign(r,p.cssStyle);break;case"w:tblCellSpacing":hn(l,s);break;case"w:cnfStyle":break;default:console.warn("Tr: Unknown tag ",y,l)}}}catch(f){n={error:f}}finally{try{o&&!o.done&&(a=x.return)&&a.call(x)}finally{if(n)throw n.error}}return{cssStyle:r}}function Tn(e){var t,n,a=e.slice(),r=0,s=!1;try{for(var x=g(e),o=x.next();!o.done;o=x.next()){var l=o.value,y=l.tagName;switch(y){case"w:smartTag":case"w:customXml":var p=[].slice.call(l.children);a.splice.apply(a,zt([r,1],Gt(p),!1)),r=r+p.length;continue;case"w:sdt":var f=l.getElementsByTagName("w:sdtContent").item(0),i=l.getElementsByTagName("w:sdt").item(0);if(i&&(s=!0),f){var c=[].slice.call(f.children);a.splice.apply(a,zt([r,1],Gt(c),!1)),r=r+c.length;continue}break}r=r+1}}catch(d){t={error:d}}finally{try{o&&!o.done&&(n=x.return)&&n.call(x)}finally{if(t)throw t.error}}return s?Tn(a):a}function qt(e){var t=[].slice.call(e.children);return Tn(t)}function qa(e,t,n){var a,r,s=new Ra,x={index:0};try{for(var o=g(qt(t)),l=o.next();!l.done;l=o.next()){var y=l.value,p=y.tagName;switch(p){case"w:tc":var f=Ca(e,y,x,n);f&&s.tcs.push(f);break;case"w:trPr":s.properties=un(e,y);break;case"w:tblPrEx":var i=Yt(e,y);Object.assign(s.properties.cssStyle||{},i.cssStyle);break;default:console.warn("Tr: Unknown tag ",p,y)}}}catch(c){a={error:c}}finally{try{l&&!l.done&&(r=o.return)&&r.call(o)}finally{if(a)throw a.error}}return s}function $a(e){var t,n,a=[],r=e.getElementsByTagName("w:gridCol");try{for(var s=g(r),x=s.next();!x.done;x=s.next()){var o=x.value,l=R(o,"w:w");a.push({w:l})}}catch(y){t={error:y}}finally{try{x&&!x.done&&(n=s.return)&&n.call(s)}finally{if(t)throw t.error}}return a}function $t(e,t){var n,a,r=new wt,s={};try{for(var x=g(qt(t)),o=x.next();!o.done;o=x.next()){var l=o.value,y=l.tagName;switch(y){case"w:tblPr":r.properties=Yt(e,l);break;case"w:tr":r.trs.push(qa(e,l,s));break;case"w:tblGrid":r.tblGrid=$a(l);break;default:console.warn("Table.fromXML unknown tag",y,l)}}}catch(p){n={error:p}}finally{try{o&&!o.done&&(a=x.return)&&a.call(x)}finally{if(n)throw n.error}}return r}var Pa=function(){function e(){}return e.fromXML=function(t,n){var a,r,s=new e;try{for(var x=g(n.children),o=x.next();!o.done;o=x.next()){var l=o.value,y=l.tagName;switch(y){case"a:fillRef":s.fillColor=gt(t,l);break;case"a:lnRef":s.lineColor=gt(t,l);break;case"a:fontRef":s.fontColor=gt(t,l);break}}}catch(p){a={error:p}}finally{try{o&&!o.done&&(r=x.return)&&r.call(x)}finally{if(a)throw a.error}}return s},e}();function Ma(e,t){var n,a;try{for(var r=g(e.attributes),s=r.next();!s.done;s=r.next()){var x=s.value,o=x.name,l=x.value;switch(o){case"numCol":l!=="1"&&(t["column-count"]=l);break;case"vert":var y=l;switch(y){case"vert":t["writing-mode"]="vertical-rl",t["text-orientation"]="sideways";break;case"vert270":case"eaVert":t["writing-mode"]="vertical-rl",t["text-orientation"]="mixed";break;default:break}break;case"anchor":var p=l;switch(p){case"b":t["vertical-align"]="bottom";break;case"t":t["vertical-align"]="top";break;case"ctr":t["vertical-align"]="middle";break}break;case"rot":var f=Zt(l);f&&(t.transform="rotate(".concat(f,"deg)"));break}}}catch(i){n={error:i}}finally{try{s&&!s.done&&(a=r.return)&&a.call(r)}finally{if(n)throw n.error}}}var Ea=function(){function e(){this.style={}}return e.fromXML=function(t,n){var a,r,s,x,o=new e;o.txbxContent=[];try{for(var l=g(n.children),y=l.next();!y.done;y=l.next()){var p=y.value,f=p.tagName;switch(f){case"wps:cNvSpPr":break;case"wps:spPr":o.spPr=vn.fromXML(t,p);break;case"wps:txbx":var i=p.firstElementChild;if(i)try{for(var c=(s=void 0,g(i.children)),d=c.next();!d.done;d=c.next()){var h=d.value,m=h.tagName;switch(m){case"w:p":o.txbxContent.push(nt.fromXML(t,h));break;case"w:tbl":o.txbxContent.push($t(t,h));break}}}catch(v){s={error:v}}finally{try{d&&!d.done&&(x=c.return)&&x.call(c)}finally{if(s)throw s.error}}else console.warn("unknown wps:txbx",p);break;case"wps:style":o.wpsStyle=Pa.fromXML(t,p);break;case"wps:bodyPr":Ma(p,o.style);break;default:console.warn("WPS: Unknown tag ",f,p)}}}catch(v){a={error:v}}finally{try{y&&!y.done&&(r=l.return)&&r.call(l)}finally{if(a)throw a.error}}return o},e}(),Ia=function(){function e(){}return e.fromXML=function(t,n){var a=new e,r=n.getAttribute("r:dm");if(r){var s=t.getDocumentRels(r);if(s){var x=t.loadWordRelXML(s);console.log(x)}}return a},e}(),Ut;(function(e){e.inline="inline",e.anchor="anchor"})(Ut||(Ut={}));function Ha(e){var t=st(e,"simplePos",!1),n=st(e,"hidden",!1),a=st(e,"behindDoc",!1);return{simplePos:t,hidden:n,behindDoc:a}}var Ae=function(){function e(){this.position=Ut.inline}return e.fromXML=function(t,n){var a,r,s,x=new e,o={};x.containerStyle=o;var l=n.firstElementChild;if(l){if(l.tagName==="wp:anchor"){x.position=Ut.anchor,x.anchor=Ha(l);var y=pn(l,"relativeHeight",1);o["z-index"]=y}try{for(var p=g(l.children),f=p.next();!f.done;f=p.next()){var i=f.value,c=i.tagName;switch(c){case"wp:simplePos":!((s=x.anchor)===null||s===void 0)&&s.simplePos&&(o.position="absolute",o.x=R(i,"x",U.Emu),o.y=R(i,"y",U.Emu));break;case"wp:positionH":var d=i.getAttribute("relativeFrom");if(d==="column"||d==="page"||d==="margin"){var h=i.firstElementChild;if(h){var m=h.tagName;o.position="absolute",m==="wp:posOffset"?o.left=ve(h.innerHTML,U.Emu):(o.left="0",console.warn("unsupport positionType",m))}}else console.warn("unsupport positionH relativeFrom",d);break;case"wp:positionV":var v=i.getAttribute("relativeFrom");if(v==="paragraph"||v==="page"){x.relativeFromV=v;var h=i.firstElementChild;if(h){var m=h.tagName;o.position="absolute",m==="wp:posOffset"?o.top=ve(h.innerHTML,U.Emu):(o.top="0",console.warn("unsupport positionType",m))}}else console.warn("unsupport positionV relativeFrom",v);break;case"wp:docPr":x.id=i.getAttribute("id")||void 0,x.name=i.getAttribute("name")||void 0;break;case"wp:cNvGraphicFramePr":break;case"a:graphic":var A=i.firstElementChild,T=A==null?void 0:A.firstElementChild;if(T){var L=T.tagName;switch(L){case"pic:pic":x.pic=ka.fromXML(t,T);break;case"wps:wsp":x.wps=Ea.fromXML(t,T);break;case"dgm:relIds":x.diagram=Ia.fromXML(t,T);break;default:console.warn("unknown graphicData child tag",T)}}break;case"wp:extent":o.width=R(i,"cx",U.Emu),o.height=R(i,"cy",U.Emu);break;case"wp:effectExtent":break;case"wp:wrapNone":break;case"wp14:sizeRelH":case"wp14:sizeRelV":break;default:console.warn("drawing unknown tag",c)}}}catch(b){a={error:b}}finally{try{f&&!f.done&&(r=p.return)&&r.call(p)}finally{if(a)throw a.error}}}return x},e}(),An=function(){function e(t){this.text=t}return e}(),bn=function(){function e(){}return e}(),kn=function(){function e(){}return e.fromXML=function(t,n){var a=new e,r=n.getElementsByTagName("v:imagedata").item(0);if(r){var s=r.getAttribute("r:id")||"",x=t.getDocumentRels(s);x&&(a.src=t.loadImage(x))}return a},e}(),be=function(){function e(){}return e.fromXML=function(t,n){var a,r,s=new e;s.children=[];try{for(var x=g(n.children),o=x.next();!o.done;o=x.next()){var l=o.value,y=l.tagName;switch(y){case"w:r":var p=pt.fromXML(t,l);p&&s.children.push(p);break;default:console.warn("parse Ruby: Unknown key",y,l)}}}catch(f){a={error:f}}finally{try{o&&!o.done&&(r=x.return)&&r.call(x)}finally{if(a)throw a.error}}return s},e}();(function(e){Jn(t,e);function t(){return e!==null&&e.apply(this,arguments)||this}return t})(be);var Rn=function(){function e(){}return e.fromXML=function(t,n){var a,r,s=new e;try{for(var x=g(n.children),o=x.next();!o.done;o=x.next()){var l=o.value,y=l.tagName;switch(y){case"w:rubyPr":break;case"w:rt":s.rt=be.fromXML(t,l);break;case"w:rubyBase":s.rubyBase=be.fromXML(t,l);break;default:console.warn("parse Ruby: Unknown key",y,l)}}}catch(p){a={error:p}}finally{try{o&&!o.done&&(r=x.return)&&r.call(x)}finally{if(a)throw a.error}}return s},e}(),Ln=function(){function e(){}return e}(),Cn=function(){function e(){}return e}(),jn=function(){function e(){}return e.parseXML=function(t){var n=new e;return n.font=t.getAttribute("w:font")||"",n.char=t.getAttribute("w:char")||"",n},e}(),qe=function(){function e(){}return e.fromXML=function(t,n){var a=new e;return a.pos=R(n,"w:pos"),a.type=F(n),a.leader=n.getAttribute("w:leader"),a},e}(),ke=function(){function e(t){this.preserveSpace=!1,this.text=String(t)}return e}(),pt=function(){function e(){this.properties={},this.children=[]}return e.prototype.addChild=function(t){t&&this.children.push(t)},e.parseRunPr=function(t,n){var a=Xt(t,n),r,s=n.getElementsByTagName("w:rStyle").item(0);return s&&(r=F(s)),{cssStyle:a,rStyle:r}},e.fromXML=function(t,n){var a,r,s=new e;try{for(var x=g(n.children),o=x.next();!o.done;o=x.next()){var l=o.value,y=l.tagName;switch(y){case"w:t":var p=l.textContent||"",f=new ke(p);s.addChild(f);break;case"w:rPr":s.properties=e.parseRunPr(t,l);break;case"w:br":case"w:cr":s.addChild(ue.fromXML(t,l));break;case"w:drawing":s.addChild(Ae.fromXML(t,l));break;case"w:tab":s.addChild(qe.fromXML(t,l));break;case"w:fldChar":s.fldChar=l.getAttribute("w:fldCharType");break;case"w:instrText":s.addChild(new An(l.textContent||""));break;case"w:lastRenderedPageBreak":var i=new ue;i.type="page",s.addChild(i);break;case"w:pict":s.addChild(kn.fromXML(t,l));break;case"w:ruby":s.addChild(Rn.fromXML(t,l));break;case"w:sym":s.addChild(jn.parseXML(l));break;case"mc:AlternateContent":var c=l.getElementsByTagName("w:drawing").item(0);c&&s.addChild(Ae.fromXML(t,c));break;case"w:softHyphen":s.addChild(new Cn);break;case"w:noBreakHyphen":s.addChild(new bn);break;case"w:separator":s.addChild(new Ln);break;case"w:continuationSeparator":break;default:console.warn("parse Run: Unknown key",y,l)}}}catch(d){a={error:d}}finally{try{o&&!o.done&&(r=x.return)&&r.call(x)}finally{if(a)throw a.error}}return s},e}(),Qt=function(){function e(){this.children=[]}return e.prototype.addChild=function(t){this.children.push(t)},e.fromXML=function(t,n){var a,r,s=new e,x=n.getAttribute("r:id");if(x){var o=t.getDocumentRels(x);o&&(s.relation=o)}var l=n.getAttribute("w:anchor");l&&(s.anchor=l);var y=n.getAttribute("w:tooltip");y&&(s.tooltip=y);try{for(var p=g(n.children),f=p.next();!f.done;f=p.next()){var i=f.value,c=i.tagName;switch(c){case"w:r":s.addChild(pt.fromXML(t,i));break;default:console.warn("parse Hyperlink: Unknown key",c,i)}}}catch(d){a={error:d}}finally{try{f&&!f.done&&(r=p.return)&&r.call(p)}finally{if(a)throw a.error}}return s},e}(),Na=function(){function e(){}return e.fromXML=function(t,n){var a=new e,r=n.getElementsByTagName("w:ilvl").item(0);r&&(a.ilvl=F(r));var s=n.getElementsByTagName("w:numId").item(0);return s&&(a.numId=F(s)),a},e}(),za=function(){function e(){this.children=[]}return e.prototype.addChild=function(t){this.children.push(t)},e.fromXML=function(t,n){var a,r,s=new e;try{for(var x=g(n.children),o=x.next();!o.done;o=x.next()){var l=o.value,y=l.tagName;switch(y){case"w:r":s.addChild(pt.fromXML(t,l));break;case"w:hyperlink":s.addChild(Qt.fromXML(t,l));break;case"w:bookmarkStart":s.addChild(Kt.fromXML(t,l));case"w:bookmarkEnd":break;case"w:proofErr":case"w:noProof":break;case"w:smartTagPr":break;case"w:del":break;default:console.warn("parse Inline: Unknown key",y,l)}}}catch(p){a={error:p}}finally{try{o&&!o.done&&(r=x.return)&&r.call(x)}finally{if(a)throw a.error}}return s},e}(),Ga=function(){function e(){}return e.fromXML=function(t,n){var a=new e;return a.inlineText=za.fromXML(t,n),a.instr=n.getAttribute("w:instr")||"",a},e}(),Bn=function(){function e(){}return e.fromXML=function(t,n){var a=new e;return a.element=n,a},e}();function Va(e){var t=e.getElementsByTagName("w:autoSpaceDE").item(0),n=e.getElementsByTagName("w:autoSpaceDN").item(0);return!!t||!!n}var nt=function(){function e(){this.properties={},this.children=[],this.fldSimples=[]}return e.prototype.addChild=function(t){this.children.push(t)},e.parseParagraphPr=function(t,n){var a,r,s=Xt(t,n),x,o=n.getElementsByTagName("w:pStyle").item(0);o&&(x=F(o));var l,y=n.getElementsByTagName("w:numPr").item(0);y&&(l=Na.fromXML(t,y));var p=[],f=n.getElementsByTagName("w:tab");try{for(var i=g(f),c=i.next();!c.done;c=i.next()){var d=c.value;p.push(qe.fromXML(t,d))}}catch(m){a={error:m}}finally{try{c&&!c.done&&(r=i.return)&&r.call(i)}finally{if(a)throw a.error}}var h=Va(n);return{cssStyle:s,pStyle:x,numPr:l,tabs:p,autoSpace:h}},e.fromXML=function(t,n){var a,r,s=new e;s.fldSimples=[],s.paraId=n.getAttribute("w14:paraId")||"";try{for(var x=g(qt(n)),o=x.next();!o.done;o=x.next()){var l=o.value,y=l.tagName;switch(y){case"w:pPr":s.properties=e.parseParagraphPr(t,l);break;case"w:r":s.addChild(pt.fromXML(t,l));break;case"w:hyperlink":s.addChild(Qt.fromXML(t,l));break;case"w:bookmarkStart":s.addChild(Kt.fromXML(t,l));case"w:bookmarkEnd":break;case"w:proofErr":case"w:noProof":break;case"w:del":case"w:moveTo":case"w:moveFrom":break;case"w:fldSimple":s.fldSimples.push(Ga.fromXML(t,l));break;case"m:oMathPara":case"m:oMath":s.addChild(Bn.fromXML(t,l));break;default:console.warn("parse Paragraph: Unknown key",y,l)}}}catch(p){a={error:p}}finally{try{o&&!o.done&&(r=x.return)&&r.call(x)}finally{if(a)throw a.error}}return s},e}();function Wa(e,t){var n={};if(!t)return n;var a=t.getElementsByTagName("w:rPrDefault").item(0);if(a){var r=a.getElementsByTagName("w:rPr").item(0);r&&(n.rPr=pt.parseRunPr(e,r))}var s=t.getElementsByTagName("w:pPrDefault").item(0);if(s){var x=s.getElementsByTagName("w:pPr").item(0);x&&(n.pPr=nt.parseParagraphPr(e,x))}return n}function Ne(e,t){var n,a,r={};try{for(var s=g(t.children),x=s.next();!x.done;x=s.next()){var o=x.value,l=o.tagName;switch(l){case"w:rPr":r.rPr=pt.parseRunPr(e,o);break;case"w:pPr":r.pPr=nt.parseParagraphPr(e,o);break;case"w:tblPr":r.tblPr=Yt(e,o);break;case"w:tcPr":r.tcPr=mn(e,o);break;case"w:trPr":r.trPr=un(e,o);break}}}catch(y){n={error:y}}finally{try{x&&!x.done&&(a=s.return)&&a.call(s)}finally{if(n)throw n.error}}return r}function Xa(e,t){var n,a,r={};r.id=t.getAttribute("w:styleId")||"",r.type=t.getAttribute("w:type"),r.tblStylePr={},Object.assign(r,Ne(e,t));try{for(var s=g(t.children),x=s.next();!x.done;x=s.next()){var o=x.value,l=o.tagName;switch(l){case"w:name":r.name=F(o);break;case"w:basedOn":r.basedOn=F(o);break;case"w:rPr":case"w:pPr":case"w:tblPr":case"w:tcPr":case"w:trPr":break;case"w:tblStylePr":var y=o.getAttribute("w:type");r.tblStylePr[y]=Ne(e,o);break;case"w:next":case"w:link":case"w:unhideWhenUsed":case"w:qFormat":case"w:rsid":case"w:uiPriority":case"w:semiHidden":case"w:autoRedefine":break;default:console.warn("parseStyle Unknown tag",l,o)}}}catch(p){n={error:p}}finally{try{x&&!x.done&&(a=s.return)&&a.call(s)}finally{if(n)throw n.error}}return r}function Ua(e,t){var n,a,r={styleMap:{}},s=Array.from(t.getElementsByTagName("w:style"));try{for(var x=g(s),o=x.next();!o.done;o=x.next()){var l=o.value,y=Xa(e,l);y.id&&(r.styleMap[y.id]=y)}}catch(p){n={error:p}}finally{try{o&&!o.done&&(a=x.return)&&a.call(x)}finally{if(n)throw n.error}}return r.defaultStyle=Wa(e,t.getElementsByTagName("w:docDefaults").item(0)),r}var Za=function(){function e(){this.colors={}}return e}();function Ja(e){var t,n,a=new Za;if(!e)return a;a.name=e.getAttribute("name")||"";try{for(var r=g(e.children),s=r.next();!s.done;s=r.next()){var x=s.value,o=x.tagName.replace("a:",""),l=x.firstElementChild;if(l){var y=l.nodeName.replace("a:","");if(y==="sysClr")a.colors[o]=l.getAttribute("lastClr")||"";else if(y==="srgbClr")a.colors[o]="#"+l.getAttribute("val")||"";else if(y==="scrgbClr"){var p=$(x,"r")*256,f=$(x,"g")*256,i=$(x,"b")*256;a.colors[o]="rgb(".concat(p,", ").concat(f,", ").concat(i,")")}else if(y==="hslClr"){var c=Zt(x.getAttribute("hue")),d=$(x,"sat")*100,h=$(x,"lum")*100;a.colors[o]="hsl(".concat(c,", ").concat(d,"%, ").concat(h,"%)")}else y==="prstClr"?a.colors[o]=F(x):console.error("unknown clr name",y)}}}catch(m){t={error:m}}finally{try{s&&!s.done&&(n=r.return)&&n.call(r)}finally{if(t)throw t.error}}return a}function Ka(e){var t={};return t}function Ya(e){var t={};return t}function Qa(e){var t={};return e&&(t.clrScheme=Ja(e.getElementsByTagName("a:clrScheme").item(0)),t.fontScheme=Ka(e.getElementsByTagName("a:fontScheme").item(0)),t.fmtScheme=Ya(e.getElementsByTagName("a:fmtScheme").item(0))),t}function _a(e){var t={};return t.themeElements=Qa(e.getElementsByTagName("a:themeElements").item(0)),t}function xt(e){e===void 0&&(e={});var t="";for(var n in e){var a=e[n];a!=null&&a!==""&&(t+="".concat(n,": ").concat(a,`;
`))}return t}function Dt(e,t){if(t)for(var n in t){var a=t[n];a!=null&&a!==""&&e.style.setProperty(n,String(a))}}function I(e){return document.createElement(e)}function ze(e){return document.createElementNS("http://www.w3.org/2000/svg",e)}function j(e,t){e&&t&&e.appendChild(t)}function ts(e,t){e&&t&&e.removeChild(t)}function Nt(e,t){e&&t&&e.classList.add(t)}function Ge(e,t){var n;e&&t&&(n=e.classList).add.apply(n,zt([],Gt(t),!1))}function es(e,t){t.type==="page"&&(e.breakPage=!0);var n=I("br");return n}function ns(e){var t,n=e.styles,a=n.defaultStyle,r="";a!=null&&a.pPr&&(r=xt(a.pPr.cssStyle));var s="";a!=null&&a.rPr&&(s=xt(a.rPr.cssStyle));var x=!((t=e.settings)===null||t===void 0)&&t.autoHyphenation?"hyphens: auto;":"",o=e.getClassPrefix();return`


  /** docDefaults **/
  .`.concat(o,` {
    --docx-theme-font-minorHAnsi: Calibri,  Helvetica, Arial, 'Helvetica Neue';
    --docx-theme-font-minorEastAsia: 'PingFang SC', 'Microsoft YaHei', 'Hiragino Sans GB', 'STHeiti',
    'Microsoft YaHei';
  }

  .`).concat(o,` p {
    margin: 0;
    padding: 0;
    line-height: 1.5;
    `).concat(x,`
  }

  .`).concat(o,` .justify:after {
    content: "";
    display: inline-block;
    width: 100%;
  }

  .`).concat(o,` table {
    border-spacing: 0;
  }

  .`).concat(o," .").concat(o,`-p {
    `).concat(r,`
  }

  .`).concat(o," .").concat(o,`-r {
    white-space: pre-wrap;
    overflow-wrap: break-word;
    `).concat(s,`
  }
  `)}function On(e,t,n){var a="",r=n.tblPr,s=n.tcPr;if(r){var x=xt(r.cssStyle),o=xt(r.tcCSSStyle);if(a+=`
 .`.concat(e," .").concat(t,` {
  border-collapse: collapse;
  `).concat(x,`
 }

 .`).concat(e," .").concat(t,` > tbody > tr > td {
  `).concat(o,`
 }
 `),r.insideBorder){var l=r.insideBorder;l.H&&(a+=`
      .`.concat(e," .").concat(t,` > tbody > tr > td {
        border-top: `).concat(l.H,`;
      }`)),l.V&&(a+=`
      .`.concat(e," .").concat(t,` > tbody > tr > td {
        border-left: `).concat(l.V,`;
      }`))}}if(s){var y=xt(s.cssStyle);a+=`
    .`.concat(e," .").concat(t,` > tbody > tr > td {
     `).concat(y,`
    }
    `)}return a}function as(e,t,n,a){var r,s,x,o,l,y,p="",f=xt((r=a.trPr)===null||r===void 0?void 0:r.cssStyle),i="";switch(n){case"firstCol":i="enable-firstColumn";break;case"lastCol":i="enable-lastColumn";break;case"firstRow":i="enable-firstRow";break;case"lastRow":i="enable-lastRow";break;case"band1Horz":case"band2Horz":i="enable-hBand";break;case"band1Vert":case"band2Vert":i="enable-vBand";break}f&&(p+=`
    `.concat(e,".").concat(i," > tbody > tr.").concat(n,`{
       `).concat(f,`
    }
    `));var c=xt((s=a.tcPr)===null||s===void 0?void 0:s.cssStyle);if(c&&(p+=`
    `.concat(e,".").concat(i," > tbody > tr > td.").concat(n,` {
       `).concat(c,`
    }
    `),!((x=a.tcPr)===null||x===void 0)&&x.insideBorder)){var d=(o=a.tcPr)===null||o===void 0?void 0:o.insideBorder;d.H&&(p+=`
          `.concat(e,".").concat(i," > tbody > tr > td.").concat(n,` {
            border-top: `).concat(d.H,`;
          }`)),d.V&&(d.V==="none"?p+=`
          `.concat(e,".").concat(i," > tbody > tr > td.").concat(n,` {
            border-left: none;
            border-right: none;
          }`):p+=`
          `.concat(e,".").concat(i," > tbody > tr > td.").concat(n,` {
            border-left: `).concat(d.V,`;
          }`))}var h=xt((l=a.pPr)===null||l===void 0?void 0:l.cssStyle);h&&(p+=`
    `.concat(e,".").concat(i," > tbody > tr > td.").concat(n," > .").concat(t,`-p {
       `).concat(h,`
    }
    `));var m=xt((y=a.rPr)===null||y===void 0?void 0:y.cssStyle);return m&&(p+=`
    `.concat(e,".").concat(i," > tbody > tr > td.").concat(n," > .").concat(t,"-p > .").concat(t,`-r {
       `).concat(m,`
    }
    `)),p}var ss=new Set(["wholeTable","band1Horz","band2Horz","band1Vert","band2Vert","firstCol","firstRow","lastCol","lastRow","neCell","nwCell","seCell","swCell"]);function rs(e,t,n){var a,r;if(!n)return"";var s="",x=".".concat(e," .").concat(t);try{for(var o=g(ss),l=o.next();!l.done;l=o.next()){var y=l.value;if(y in n){var p=n[y];s+=as(x,e,y,p)}}}catch(f){a={error:f}}finally{try{l&&!l.done&&(r=o.return)&&r.call(o)}finally{if(a)throw a.error}}return s}function ls(e){var t=e.styles,n=t.styleMap,a=e.getClassPrefix(),r="";for(var s in n){var x=e.getStyleIdDisplayName(s),o=n[s],l=o.pPr,y="";if(l){var p=xt(l.cssStyle);y=`
      .`.concat(a," .").concat(x,` {
        `).concat(p,`
      }
      `)}var f="";if(o.rPr){var i=xt(o.rPr.cssStyle);f=`
      .`.concat(a," .").concat(x," > .").concat(a,`-r {
        `).concat(i,`
      }
      `)}var c=On(a,x,o),d=rs(a,x,o.tblStylePr);r+=`
    `.concat(y,`
    `).concat(f,`
    `).concat(c,`
    `).concat(d,`
    `)}return r}function xs(e){var t=I("style"),n=ns(e),a=ls(e);return t.textContent=`
  `.concat(n,`

  `).concat(a,`
  `),t}function kt(e,t,n){n&&(n.cssStyle&&(Dt(t,n.cssStyle),n.cssStyle["text-align"]==="justify"&&Nt(t,"justify")),n.pStyle&&Ge(t,e.getStyleClassName(n.pStyle)),n.rStyle&&Ge(t,e.getStyleClassName(n.rStyle)))}function os(e,t,n,a,r,s,x){e===0&&t===0&&r.classList.add("nwCell"),e===0&&t===a-1&&r.classList.add("neCell"),e===n-1&&t===0&&r.classList.add("swCell"),e===n-1&&t===a-1&&r.classList.add("seCell"),e===0&&r.classList.add("firstRow"),e===n-1&&r.classList.add("lastRow"),t===0&&r.classList.add("firstCol"),t===a-1&&r.classList.add("lastCol"),It(e+1)&&r.classList.add("band1Horz"),It(e+1)||r.classList.add("band2Horz"),It(t+1)&&r.classList.add("band1Vert"),It(t+1)||r.classList.add("band2Vert")}function It(e,t){return!(e%2)}function Rt(e,t){var n,a,r,s,x,o,l=document.createElement("table"),y=t.properties;if(y.tblCaption){var p=document.createElement("caption");p.textContent=y.tblCaption,l.appendChild(p)}if(y.tblLook)for(var f in y.tblLook)f==="noHBand"?y.tblLook[f]||Nt(l,"enable-hBand"):f==="noVBand"?y.tblLook[f]||Nt(l,"enable-vBand"):y.tblLook[f]&&Nt(l,"enable-"+f);kt(e,l,y);var i=e.genClassName();l.classList.add(i),e.appendStyle(On(e.getClassPrefix(),i,{tblPr:y}));var c=document.createElement("tbody");l.appendChild(c);var d=0;try{for(var h=g(t.trs),m=h.next();!m.done;m=h.next()){var v=m.value,A=document.createElement("tr");c.appendChild(A);var T=0;try{for(var L=(r=void 0,g(v.tcs)),b=L.next();!b.done;b=L.next()){var k=b.value,u=document.createElement("td");A.appendChild(u),os(d,T,t.trs.length,v.tcs.length,u,y.rowBandSize,y.colBandSize),v.properties.tcStyle&&Dt(u,v.properties.tcStyle);var w=k.properties;kt(e,u,w),w.gridSpan&&(u.colSpan=w.gridSpan),w.rowSpan&&(u.rowSpan=w.rowSpan);var S=!0;w.hideMark&&(S=!1);try{for(var B=(x=void 0,g(k.children)),E=B.next();!E.done;E=B.next()){var C=E.value;if(C instanceof nt){var H=Lt(e,C,S);j(u,H)}else C instanceof wt?(S=!1,j(u,Rt(e,C))):console.warn("unknown child type: "+C)}}catch(O){x={error:O}}finally{try{E&&!E.done&&(o=B.return)&&o.call(B)}finally{if(x)throw x.error}}w.rowSpan?T+=w.rowSpan:T++}}catch(O){r={error:O}}finally{try{b&&!b.done&&(s=L.return)&&s.call(L)}finally{if(r)throw r.error}}d++}}catch(O){n={error:O}}finally{try{m&&!m.done&&(a=h.return)&&a.call(h)}finally{if(n)throw n.error}}return l}var ys={accentBorderCallout1:{avLst:[{n:"adj1",f:"val 18750"},{n:"adj2",f:"val -8333"},{n:"adj3",f:"val 112500"},{n:"adj4",f:"val -38333"}],gdLst:[{n:"y1",f:"*/ h adj1 100000"},{n:"x1",f:"*/ w adj2 100000"},{n:"y2",f:"*/ h adj3 100000"},{n:"x2",f:"*/ w adj4 100000"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!0},{defines:[{type:"moveTo",pt:{x:"x1",y:"t"}},{type:"close"},{type:"lnTo",pt:{x:"x1",y:"b"}}],fill:"none",extrusionOk:!1,stroke:!0},{defines:[{type:"moveTo",pt:{x:"x1",y:"y1"}},{type:"lnTo",pt:{x:"x2",y:"y2"}}],fill:"none",extrusionOk:!1,stroke:!0}]},accentBorderCallout2:{avLst:[{n:"adj1",f:"val 18750"},{n:"adj2",f:"val -8333"},{n:"adj3",f:"val 18750"},{n:"adj4",f:"val -16667"},{n:"adj5",f:"val 112500"},{n:"adj6",f:"val -46667"}],gdLst:[{n:"y1",f:"*/ h adj1 100000"},{n:"x1",f:"*/ w adj2 100000"},{n:"y2",f:"*/ h adj3 100000"},{n:"x2",f:"*/ w adj4 100000"},{n:"y3",f:"*/ h adj5 100000"},{n:"x3",f:"*/ w adj6 100000"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!0},{defines:[{type:"moveTo",pt:{x:"x1",y:"t"}},{type:"close"},{type:"lnTo",pt:{x:"x1",y:"b"}}],fill:"none",extrusionOk:!1,stroke:!0},{defines:[{type:"moveTo",pt:{x:"x1",y:"y1"}},{type:"lnTo",pt:{x:"x2",y:"y2"}},{type:"lnTo",pt:{x:"x3",y:"y3"}}],fill:"none",extrusionOk:!1,stroke:!0}]},accentBorderCallout3:{avLst:[{n:"adj1",f:"val 18750"},{n:"adj2",f:"val -8333"},{n:"adj3",f:"val 18750"},{n:"adj4",f:"val -16667"},{n:"adj5",f:"val 100000"},{n:"adj6",f:"val -16667"},{n:"adj7",f:"val 112963"},{n:"adj8",f:"val -8333"}],gdLst:[{n:"y1",f:"*/ h adj1 100000"},{n:"x1",f:"*/ w adj2 100000"},{n:"y2",f:"*/ h adj3 100000"},{n:"x2",f:"*/ w adj4 100000"},{n:"y3",f:"*/ h adj5 100000"},{n:"x3",f:"*/ w adj6 100000"},{n:"y4",f:"*/ h adj7 100000"},{n:"x4",f:"*/ w adj8 100000"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!0},{defines:[{type:"moveTo",pt:{x:"x1",y:"t"}},{type:"close"},{type:"lnTo",pt:{x:"x1",y:"b"}}],fill:"none",extrusionOk:!1,stroke:!0},{defines:[{type:"moveTo",pt:{x:"x1",y:"y1"}},{type:"lnTo",pt:{x:"x2",y:"y2"}},{type:"lnTo",pt:{x:"x3",y:"y3"}},{type:"lnTo",pt:{x:"x4",y:"y4"}}],fill:"none",extrusionOk:!1,stroke:!0}]},accentCallout1:{avLst:[{n:"adj1",f:"val 18750"},{n:"adj2",f:"val -8333"},{n:"adj3",f:"val 112500"},{n:"adj4",f:"val -38333"}],gdLst:[{n:"y1",f:"*/ h adj1 100000"},{n:"x1",f:"*/ w adj2 100000"},{n:"y2",f:"*/ h adj3 100000"},{n:"x2",f:"*/ w adj4 100000"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"x1",y:"t"}},{type:"close"},{type:"lnTo",pt:{x:"x1",y:"b"}}],fill:"none",extrusionOk:!1,stroke:!0},{defines:[{type:"moveTo",pt:{x:"x1",y:"y1"}},{type:"lnTo",pt:{x:"x2",y:"y2"}}],fill:"none",extrusionOk:!1,stroke:!0}]},accentCallout2:{avLst:[{n:"adj1",f:"val 18750"},{n:"adj2",f:"val -8333"},{n:"adj3",f:"val 18750"},{n:"adj4",f:"val -16667"},{n:"adj5",f:"val 112500"},{n:"adj6",f:"val -46667"}],gdLst:[{n:"y1",f:"*/ h adj1 100000"},{n:"x1",f:"*/ w adj2 100000"},{n:"y2",f:"*/ h adj3 100000"},{n:"x2",f:"*/ w adj4 100000"},{n:"y3",f:"*/ h adj5 100000"},{n:"x3",f:"*/ w adj6 100000"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"x1",y:"t"}},{type:"close"},{type:"lnTo",pt:{x:"x1",y:"b"}}],fill:"none",extrusionOk:!1,stroke:!0},{defines:[{type:"moveTo",pt:{x:"x1",y:"y1"}},{type:"lnTo",pt:{x:"x2",y:"y2"}},{type:"lnTo",pt:{x:"x3",y:"y3"}}],fill:"none",extrusionOk:!1,stroke:!0}]},accentCallout3:{avLst:[{n:"adj1",f:"val 18750"},{n:"adj2",f:"val -8333"},{n:"adj3",f:"val 18750"},{n:"adj4",f:"val -16667"},{n:"adj5",f:"val 100000"},{n:"adj6",f:"val -16667"},{n:"adj7",f:"val 112963"},{n:"adj8",f:"val -8333"}],gdLst:[{n:"y1",f:"*/ h adj1 100000"},{n:"x1",f:"*/ w adj2 100000"},{n:"y2",f:"*/ h adj3 100000"},{n:"x2",f:"*/ w adj4 100000"},{n:"y3",f:"*/ h adj5 100000"},{n:"x3",f:"*/ w adj6 100000"},{n:"y4",f:"*/ h adj7 100000"},{n:"x4",f:"*/ w adj8 100000"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"x1",y:"t"}},{type:"close"},{type:"lnTo",pt:{x:"x1",y:"b"}}],fill:"none",extrusionOk:!1,stroke:!0},{defines:[{type:"moveTo",pt:{x:"x1",y:"y1"}},{type:"lnTo",pt:{x:"x2",y:"y2"}},{type:"lnTo",pt:{x:"x3",y:"y3"}},{type:"lnTo",pt:{x:"x4",y:"y4"}}],fill:"none",extrusionOk:!1,stroke:!0}]},actionButtonBackPrevious:{gdLst:[{n:"dx2",f:"*/ ss 3 8"},{n:"g9",f:"+- vc 0 dx2"},{n:"g10",f:"+- vc dx2 0"},{n:"g11",f:"+- hc 0 dx2"},{n:"g12",f:"+- hc dx2 0"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"},{type:"moveTo",pt:{x:"g11",y:"vc"}},{type:"lnTo",pt:{x:"g12",y:"g9"}},{type:"lnTo",pt:{x:"g12",y:"g10"}},{type:"close"}],extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"g11",y:"vc"}},{type:"lnTo",pt:{x:"g12",y:"g9"}},{type:"lnTo",pt:{x:"g12",y:"g10"}},{type:"close"}],fill:"darken",extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"g11",y:"vc"}},{type:"lnTo",pt:{x:"g12",y:"g9"}},{type:"lnTo",pt:{x:"g12",y:"g10"}},{type:"close"}],fill:"none",extrusionOk:!1,stroke:!0},{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"}],fill:"none",extrusionOk:!1,stroke:!0}]},actionButtonBeginning:{gdLst:[{n:"dx2",f:"*/ ss 3 8"},{n:"g9",f:"+- vc 0 dx2"},{n:"g10",f:"+- vc dx2 0"},{n:"g11",f:"+- hc 0 dx2"},{n:"g12",f:"+- hc dx2 0"},{n:"g13",f:"*/ ss 3 4"},{n:"g14",f:"*/ g13 1 8"},{n:"g15",f:"*/ g13 1 4"},{n:"g16",f:"+- g11 g14 0"},{n:"g17",f:"+- g11 g15 0"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"},{type:"moveTo",pt:{x:"g17",y:"vc"}},{type:"lnTo",pt:{x:"g12",y:"g9"}},{type:"lnTo",pt:{x:"g12",y:"g10"}},{type:"close"},{type:"moveTo",pt:{x:"g16",y:"g9"}},{type:"lnTo",pt:{x:"g11",y:"g9"}},{type:"lnTo",pt:{x:"g11",y:"g10"}},{type:"lnTo",pt:{x:"g16",y:"g10"}},{type:"close"}],extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"g17",y:"vc"}},{type:"lnTo",pt:{x:"g12",y:"g9"}},{type:"lnTo",pt:{x:"g12",y:"g10"}},{type:"close"},{type:"moveTo",pt:{x:"g16",y:"g9"}},{type:"lnTo",pt:{x:"g11",y:"g9"}},{type:"lnTo",pt:{x:"g11",y:"g10"}},{type:"lnTo",pt:{x:"g16",y:"g10"}},{type:"close"}],fill:"darken",extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"g17",y:"vc"}},{type:"lnTo",pt:{x:"g12",y:"g9"}},{type:"lnTo",pt:{x:"g12",y:"g10"}},{type:"close"},{type:"moveTo",pt:{x:"g16",y:"g9"}},{type:"lnTo",pt:{x:"g16",y:"g10"}},{type:"lnTo",pt:{x:"g11",y:"g10"}},{type:"lnTo",pt:{x:"g11",y:"g9"}},{type:"close"}],fill:"none",extrusionOk:!1,stroke:!0},{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"}],fill:"none",extrusionOk:!1,stroke:!0}]},actionButtonBlank:{pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},actionButtonDocument:{gdLst:[{n:"dx2",f:"*/ ss 3 8"},{n:"g9",f:"+- vc 0 dx2"},{n:"g10",f:"+- vc dx2 0"},{n:"dx1",f:"*/ ss 9 32"},{n:"g11",f:"+- hc 0 dx1"},{n:"g12",f:"+- hc dx1 0"},{n:"g13",f:"*/ ss 3 16"},{n:"g14",f:"+- g12 0 g13"},{n:"g15",f:"+- g9 g13 0"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"},{type:"moveTo",pt:{x:"g11",y:"g9"}},{type:"lnTo",pt:{x:"g14",y:"g9"}},{type:"lnTo",pt:{x:"g12",y:"g15"}},{type:"lnTo",pt:{x:"g12",y:"g10"}},{type:"lnTo",pt:{x:"g11",y:"g10"}},{type:"close"}],extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"g11",y:"g9"}},{type:"lnTo",pt:{x:"g14",y:"g9"}},{type:"lnTo",pt:{x:"g14",y:"g15"}},{type:"lnTo",pt:{x:"g12",y:"g15"}},{type:"lnTo",pt:{x:"g12",y:"g10"}},{type:"lnTo",pt:{x:"g11",y:"g10"}},{type:"close"}],fill:"darkenLess",extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"g14",y:"g9"}},{type:"lnTo",pt:{x:"g14",y:"g15"}},{type:"lnTo",pt:{x:"g12",y:"g15"}},{type:"close"}],fill:"darken",extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"g11",y:"g9"}},{type:"lnTo",pt:{x:"g14",y:"g9"}},{type:"lnTo",pt:{x:"g12",y:"g15"}},{type:"lnTo",pt:{x:"g12",y:"g10"}},{type:"lnTo",pt:{x:"g11",y:"g10"}},{type:"close"},{type:"moveTo",pt:{x:"g12",y:"g15"}},{type:"lnTo",pt:{x:"g14",y:"g15"}},{type:"lnTo",pt:{x:"g14",y:"g9"}}],fill:"none",extrusionOk:!1,stroke:!0},{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"}],fill:"none",extrusionOk:!1,stroke:!0}]},actionButtonEnd:{gdLst:[{n:"dx2",f:"*/ ss 3 8"},{n:"g9",f:"+- vc 0 dx2"},{n:"g10",f:"+- vc dx2 0"},{n:"g11",f:"+- hc 0 dx2"},{n:"g12",f:"+- hc dx2 0"},{n:"g13",f:"*/ ss 3 4"},{n:"g14",f:"*/ g13 3 4"},{n:"g15",f:"*/ g13 7 8"},{n:"g16",f:"+- g11 g14 0"},{n:"g17",f:"+- g11 g15 0"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"},{type:"moveTo",pt:{x:"g16",y:"vc"}},{type:"lnTo",pt:{x:"g11",y:"g9"}},{type:"lnTo",pt:{x:"g11",y:"g10"}},{type:"close"},{type:"moveTo",pt:{x:"g17",y:"g9"}},{type:"lnTo",pt:{x:"g12",y:"g9"}},{type:"lnTo",pt:{x:"g12",y:"g10"}},{type:"lnTo",pt:{x:"g17",y:"g10"}},{type:"close"}],extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"g16",y:"vc"}},{type:"lnTo",pt:{x:"g11",y:"g9"}},{type:"lnTo",pt:{x:"g11",y:"g10"}},{type:"close"},{type:"moveTo",pt:{x:"g17",y:"g9"}},{type:"lnTo",pt:{x:"g12",y:"g9"}},{type:"lnTo",pt:{x:"g12",y:"g10"}},{type:"lnTo",pt:{x:"g17",y:"g10"}},{type:"close"}],fill:"darken",extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"g16",y:"vc"}},{type:"lnTo",pt:{x:"g11",y:"g10"}},{type:"lnTo",pt:{x:"g11",y:"g9"}},{type:"close"},{type:"moveTo",pt:{x:"g17",y:"g9"}},{type:"lnTo",pt:{x:"g12",y:"g9"}},{type:"lnTo",pt:{x:"g12",y:"g10"}},{type:"lnTo",pt:{x:"g17",y:"g10"}},{type:"close"}],fill:"none",extrusionOk:!1,stroke:!0},{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"}],fill:"none",extrusionOk:!1,stroke:!0}]},actionButtonForwardNext:{gdLst:[{n:"dx2",f:"*/ ss 3 8"},{n:"g9",f:"+- vc 0 dx2"},{n:"g10",f:"+- vc dx2 0"},{n:"g11",f:"+- hc 0 dx2"},{n:"g12",f:"+- hc dx2 0"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"},{type:"moveTo",pt:{x:"g12",y:"vc"}},{type:"lnTo",pt:{x:"g11",y:"g9"}},{type:"lnTo",pt:{x:"g11",y:"g10"}},{type:"close"}],extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"g12",y:"vc"}},{type:"lnTo",pt:{x:"g11",y:"g9"}},{type:"lnTo",pt:{x:"g11",y:"g10"}},{type:"close"}],fill:"darken",extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"g12",y:"vc"}},{type:"lnTo",pt:{x:"g11",y:"g10"}},{type:"lnTo",pt:{x:"g11",y:"g9"}},{type:"close"}],fill:"none",extrusionOk:!1,stroke:!0},{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"}],fill:"none",extrusionOk:!1,stroke:!0}]},actionButtonHelp:{gdLst:[{n:"dx2",f:"*/ ss 3 8"},{n:"g9",f:"+- vc 0 dx2"},{n:"g11",f:"+- hc 0 dx2"},{n:"g13",f:"*/ ss 3 4"},{n:"g14",f:"*/ g13 1 7"},{n:"g15",f:"*/ g13 3 14"},{n:"g16",f:"*/ g13 2 7"},{n:"g19",f:"*/ g13 3 7"},{n:"g20",f:"*/ g13 4 7"},{n:"g21",f:"*/ g13 17 28"},{n:"g23",f:"*/ g13 21 28"},{n:"g24",f:"*/ g13 11 14"},{n:"g27",f:"+- g9 g16 0"},{n:"g29",f:"+- g9 g21 0"},{n:"g30",f:"+- g9 g23 0"},{n:"g31",f:"+- g9 g24 0"},{n:"g33",f:"+- g11 g15 0"},{n:"g36",f:"+- g11 g19 0"},{n:"g37",f:"+- g11 g20 0"},{n:"g41",f:"*/ g13 1 14"},{n:"g42",f:"*/ g13 3 28"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"},{type:"moveTo",pt:{x:"g33",y:"g27"}},{type:"arcTo",wR:"g16",hR:"g16",stAng:"cd2",swAng:"cd2"},{type:"arcTo",wR:"g14",hR:"g15",stAng:"0",swAng:"cd4"},{type:"arcTo",wR:"g41",hR:"g42",stAng:"3cd4",swAng:"-5400000"},{type:"lnTo",pt:{x:"g37",y:"g30"}},{type:"lnTo",pt:{x:"g36",y:"g30"}},{type:"lnTo",pt:{x:"g36",y:"g29"}},{type:"arcTo",wR:"g14",hR:"g15",stAng:"cd2",swAng:"cd4"},{type:"arcTo",wR:"g41",hR:"g42",stAng:"cd4",swAng:"-5400000"},{type:"arcTo",wR:"g14",hR:"g14",stAng:"0",swAng:"-10800000"},{type:"close"},{type:"moveTo",pt:{x:"hc",y:"g31"}},{type:"arcTo",wR:"g42",hR:"g42",stAng:"3cd4",swAng:"21600000"},{type:"close"}],extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"g33",y:"g27"}},{type:"arcTo",wR:"g16",hR:"g16",stAng:"cd2",swAng:"cd2"},{type:"arcTo",wR:"g14",hR:"g15",stAng:"0",swAng:"cd4"},{type:"arcTo",wR:"g41",hR:"g42",stAng:"3cd4",swAng:"-5400000"},{type:"lnTo",pt:{x:"g37",y:"g30"}},{type:"lnTo",pt:{x:"g36",y:"g30"}},{type:"lnTo",pt:{x:"g36",y:"g29"}},{type:"arcTo",wR:"g14",hR:"g15",stAng:"cd2",swAng:"cd4"},{type:"arcTo",wR:"g41",hR:"g42",stAng:"cd4",swAng:"-5400000"},{type:"arcTo",wR:"g14",hR:"g14",stAng:"0",swAng:"-10800000"},{type:"close"},{type:"moveTo",pt:{x:"hc",y:"g31"}},{type:"arcTo",wR:"g42",hR:"g42",stAng:"3cd4",swAng:"21600000"},{type:"close"}],fill:"darken",extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"g33",y:"g27"}},{type:"arcTo",wR:"g16",hR:"g16",stAng:"cd2",swAng:"cd2"},{type:"arcTo",wR:"g14",hR:"g15",stAng:"0",swAng:"cd4"},{type:"arcTo",wR:"g41",hR:"g42",stAng:"3cd4",swAng:"-5400000"},{type:"lnTo",pt:{x:"g37",y:"g30"}},{type:"lnTo",pt:{x:"g36",y:"g30"}},{type:"lnTo",pt:{x:"g36",y:"g29"}},{type:"arcTo",wR:"g14",hR:"g15",stAng:"cd2",swAng:"cd4"},{type:"arcTo",wR:"g41",hR:"g42",stAng:"cd4",swAng:"-5400000"},{type:"arcTo",wR:"g14",hR:"g14",stAng:"0",swAng:"-10800000"},{type:"close"},{type:"moveTo",pt:{x:"hc",y:"g31"}},{type:"arcTo",wR:"g42",hR:"g42",stAng:"3cd4",swAng:"21600000"},{type:"close"}],fill:"none",extrusionOk:!1,stroke:!0},{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"}],fill:"none",extrusionOk:!1,stroke:!0}]},actionButtonHome:{gdLst:[{n:"dx2",f:"*/ ss 3 8"},{n:"g9",f:"+- vc 0 dx2"},{n:"g10",f:"+- vc dx2 0"},{n:"g11",f:"+- hc 0 dx2"},{n:"g12",f:"+- hc dx2 0"},{n:"g13",f:"*/ ss 3 4"},{n:"g14",f:"*/ g13 1 16"},{n:"g15",f:"*/ g13 1 8"},{n:"g16",f:"*/ g13 3 16"},{n:"g17",f:"*/ g13 5 16"},{n:"g18",f:"*/ g13 7 16"},{n:"g19",f:"*/ g13 9 16"},{n:"g20",f:"*/ g13 11 16"},{n:"g21",f:"*/ g13 3 4"},{n:"g22",f:"*/ g13 13 16"},{n:"g23",f:"*/ g13 7 8"},{n:"g24",f:"+- g9 g14 0"},{n:"g25",f:"+- g9 g16 0"},{n:"g26",f:"+- g9 g17 0"},{n:"g27",f:"+- g9 g21 0"},{n:"g28",f:"+- g11 g15 0"},{n:"g29",f:"+- g11 g18 0"},{n:"g30",f:"+- g11 g19 0"},{n:"g31",f:"+- g11 g20 0"},{n:"g32",f:"+- g11 g22 0"},{n:"g33",f:"+- g11 g23 0"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"},{type:"moveTo",pt:{x:"hc",y:"g9"}},{type:"lnTo",pt:{x:"g11",y:"vc"}},{type:"lnTo",pt:{x:"g28",y:"vc"}},{type:"lnTo",pt:{x:"g28",y:"g10"}},{type:"lnTo",pt:{x:"g33",y:"g10"}},{type:"lnTo",pt:{x:"g33",y:"vc"}},{type:"lnTo",pt:{x:"g12",y:"vc"}},{type:"lnTo",pt:{x:"g32",y:"g26"}},{type:"lnTo",pt:{x:"g32",y:"g24"}},{type:"lnTo",pt:{x:"g31",y:"g24"}},{type:"lnTo",pt:{x:"g31",y:"g25"}},{type:"close"}],extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"g32",y:"g26"}},{type:"lnTo",pt:{x:"g32",y:"g24"}},{type:"lnTo",pt:{x:"g31",y:"g24"}},{type:"lnTo",pt:{x:"g31",y:"g25"}},{type:"close"},{type:"moveTo",pt:{x:"g28",y:"vc"}},{type:"lnTo",pt:{x:"g28",y:"g10"}},{type:"lnTo",pt:{x:"g29",y:"g10"}},{type:"lnTo",pt:{x:"g29",y:"g27"}},{type:"lnTo",pt:{x:"g30",y:"g27"}},{type:"lnTo",pt:{x:"g30",y:"g10"}},{type:"lnTo",pt:{x:"g33",y:"g10"}},{type:"lnTo",pt:{x:"g33",y:"vc"}},{type:"close"}],fill:"darkenLess",extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"hc",y:"g9"}},{type:"lnTo",pt:{x:"g11",y:"vc"}},{type:"lnTo",pt:{x:"g12",y:"vc"}},{type:"close"},{type:"moveTo",pt:{x:"g29",y:"g27"}},{type:"lnTo",pt:{x:"g30",y:"g27"}},{type:"lnTo",pt:{x:"g30",y:"g10"}},{type:"lnTo",pt:{x:"g29",y:"g10"}},{type:"close"}],fill:"darken",extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"hc",y:"g9"}},{type:"lnTo",pt:{x:"g31",y:"g25"}},{type:"lnTo",pt:{x:"g31",y:"g24"}},{type:"lnTo",pt:{x:"g32",y:"g24"}},{type:"lnTo",pt:{x:"g32",y:"g26"}},{type:"lnTo",pt:{x:"g12",y:"vc"}},{type:"lnTo",pt:{x:"g33",y:"vc"}},{type:"lnTo",pt:{x:"g33",y:"g10"}},{type:"lnTo",pt:{x:"g28",y:"g10"}},{type:"lnTo",pt:{x:"g28",y:"vc"}},{type:"lnTo",pt:{x:"g11",y:"vc"}},{type:"close"},{type:"moveTo",pt:{x:"g31",y:"g25"}},{type:"lnTo",pt:{x:"g32",y:"g26"}},{type:"moveTo",pt:{x:"g33",y:"vc"}},{type:"lnTo",pt:{x:"g28",y:"vc"}},{type:"moveTo",pt:{x:"g29",y:"g10"}},{type:"lnTo",pt:{x:"g29",y:"g27"}},{type:"lnTo",pt:{x:"g30",y:"g27"}},{type:"lnTo",pt:{x:"g30",y:"g10"}}],fill:"none",extrusionOk:!1,stroke:!0},{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"}],fill:"none",extrusionOk:!1,stroke:!0}]},actionButtonInformation:{gdLst:[{n:"dx2",f:"*/ ss 3 8"},{n:"g9",f:"+- vc 0 dx2"},{n:"g11",f:"+- hc 0 dx2"},{n:"g13",f:"*/ ss 3 4"},{n:"g14",f:"*/ g13 1 32"},{n:"g17",f:"*/ g13 5 16"},{n:"g18",f:"*/ g13 3 8"},{n:"g19",f:"*/ g13 13 32"},{n:"g20",f:"*/ g13 19 32"},{n:"g22",f:"*/ g13 11 16"},{n:"g23",f:"*/ g13 13 16"},{n:"g24",f:"*/ g13 7 8"},{n:"g25",f:"+- g9 g14 0"},{n:"g28",f:"+- g9 g17 0"},{n:"g29",f:"+- g9 g18 0"},{n:"g30",f:"+- g9 g23 0"},{n:"g31",f:"+- g9 g24 0"},{n:"g32",f:"+- g11 g17 0"},{n:"g34",f:"+- g11 g19 0"},{n:"g35",f:"+- g11 g20 0"},{n:"g37",f:"+- g11 g22 0"},{n:"g38",f:"*/ g13 3 32"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"},{type:"moveTo",pt:{x:"hc",y:"g9"}},{type:"arcTo",wR:"dx2",hR:"dx2",stAng:"3cd4",swAng:"21600000"},{type:"close"}],extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"hc",y:"g9"}},{type:"arcTo",wR:"dx2",hR:"dx2",stAng:"3cd4",swAng:"21600000"},{type:"close"},{type:"moveTo",pt:{x:"hc",y:"g25"}},{type:"arcTo",wR:"g38",hR:"g38",stAng:"3cd4",swAng:"21600000"},{type:"moveTo",pt:{x:"g32",y:"g28"}},{type:"lnTo",pt:{x:"g32",y:"g29"}},{type:"lnTo",pt:{x:"g34",y:"g29"}},{type:"lnTo",pt:{x:"g34",y:"g30"}},{type:"lnTo",pt:{x:"g32",y:"g30"}},{type:"lnTo",pt:{x:"g32",y:"g31"}},{type:"lnTo",pt:{x:"g37",y:"g31"}},{type:"lnTo",pt:{x:"g37",y:"g30"}},{type:"lnTo",pt:{x:"g35",y:"g30"}},{type:"lnTo",pt:{x:"g35",y:"g28"}},{type:"close"}],fill:"darken",extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"hc",y:"g25"}},{type:"arcTo",wR:"g38",hR:"g38",stAng:"3cd4",swAng:"21600000"},{type:"moveTo",pt:{x:"g32",y:"g28"}},{type:"lnTo",pt:{x:"g35",y:"g28"}},{type:"lnTo",pt:{x:"g35",y:"g30"}},{type:"lnTo",pt:{x:"g37",y:"g30"}},{type:"lnTo",pt:{x:"g37",y:"g31"}},{type:"lnTo",pt:{x:"g32",y:"g31"}},{type:"lnTo",pt:{x:"g32",y:"g30"}},{type:"lnTo",pt:{x:"g34",y:"g30"}},{type:"lnTo",pt:{x:"g34",y:"g29"}},{type:"lnTo",pt:{x:"g32",y:"g29"}},{type:"close"}],fill:"lighten",extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"hc",y:"g9"}},{type:"arcTo",wR:"dx2",hR:"dx2",stAng:"3cd4",swAng:"21600000"},{type:"close"},{type:"moveTo",pt:{x:"hc",y:"g25"}},{type:"arcTo",wR:"g38",hR:"g38",stAng:"3cd4",swAng:"21600000"},{type:"moveTo",pt:{x:"g32",y:"g28"}},{type:"lnTo",pt:{x:"g35",y:"g28"}},{type:"lnTo",pt:{x:"g35",y:"g30"}},{type:"lnTo",pt:{x:"g37",y:"g30"}},{type:"lnTo",pt:{x:"g37",y:"g31"}},{type:"lnTo",pt:{x:"g32",y:"g31"}},{type:"lnTo",pt:{x:"g32",y:"g30"}},{type:"lnTo",pt:{x:"g34",y:"g30"}},{type:"lnTo",pt:{x:"g34",y:"g29"}},{type:"lnTo",pt:{x:"g32",y:"g29"}},{type:"close"}],fill:"none",extrusionOk:!1,stroke:!0},{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"}],fill:"none",extrusionOk:!1,stroke:!0}]},actionButtonMovie:{gdLst:[{n:"dx2",f:"*/ ss 3 8"},{n:"g9",f:"+- vc 0 dx2"},{n:"g10",f:"+- vc dx2 0"},{n:"g11",f:"+- hc 0 dx2"},{n:"g12",f:"+- hc dx2 0"},{n:"g13",f:"*/ ss 3 4"},{n:"g14",f:"*/ g13 1455 21600"},{n:"g15",f:"*/ g13 1905 21600"},{n:"g16",f:"*/ g13 2325 21600"},{n:"g17",f:"*/ g13 16155 21600"},{n:"g18",f:"*/ g13 17010 21600"},{n:"g19",f:"*/ g13 19335 21600"},{n:"g20",f:"*/ g13 19725 21600"},{n:"g21",f:"*/ g13 20595 21600"},{n:"g22",f:"*/ g13 5280 21600"},{n:"g23",f:"*/ g13 5730 21600"},{n:"g24",f:"*/ g13 6630 21600"},{n:"g25",f:"*/ g13 7492 21600"},{n:"g26",f:"*/ g13 9067 21600"},{n:"g27",f:"*/ g13 9555 21600"},{n:"g28",f:"*/ g13 13342 21600"},{n:"g29",f:"*/ g13 14580 21600"},{n:"g30",f:"*/ g13 15592 21600"},{n:"g31",f:"+- g11 g14 0"},{n:"g32",f:"+- g11 g15 0"},{n:"g33",f:"+- g11 g16 0"},{n:"g34",f:"+- g11 g17 0"},{n:"g35",f:"+- g11 g18 0"},{n:"g36",f:"+- g11 g19 0"},{n:"g37",f:"+- g11 g20 0"},{n:"g38",f:"+- g11 g21 0"},{n:"g39",f:"+- g9 g22 0"},{n:"g40",f:"+- g9 g23 0"},{n:"g41",f:"+- g9 g24 0"},{n:"g42",f:"+- g9 g25 0"},{n:"g43",f:"+- g9 g26 0"},{n:"g44",f:"+- g9 g27 0"},{n:"g45",f:"+- g9 g28 0"},{n:"g46",f:"+- g9 g29 0"},{n:"g47",f:"+- g9 g30 0"},{n:"g48",f:"+- g9 g31 0"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"},{type:"moveTo",pt:{x:"g11",y:"g39"}},{type:"lnTo",pt:{x:"g11",y:"g44"}},{type:"lnTo",pt:{x:"g31",y:"g44"}},{type:"lnTo",pt:{x:"g32",y:"g43"}},{type:"lnTo",pt:{x:"g33",y:"g43"}},{type:"lnTo",pt:{x:"g33",y:"g47"}},{type:"lnTo",pt:{x:"g35",y:"g47"}},{type:"lnTo",pt:{x:"g35",y:"g45"}},{type:"lnTo",pt:{x:"g36",y:"g45"}},{type:"lnTo",pt:{x:"g38",y:"g46"}},{type:"lnTo",pt:{x:"g12",y:"g46"}},{type:"lnTo",pt:{x:"g12",y:"g41"}},{type:"lnTo",pt:{x:"g38",y:"g41"}},{type:"lnTo",pt:{x:"g37",y:"g42"}},{type:"lnTo",pt:{x:"g35",y:"g42"}},{type:"lnTo",pt:{x:"g35",y:"g41"}},{type:"lnTo",pt:{x:"g34",y:"g40"}},{type:"lnTo",pt:{x:"g32",y:"g40"}},{type:"lnTo",pt:{x:"g31",y:"g39"}},{type:"close"}],extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"g11",y:"g39"}},{type:"lnTo",pt:{x:"g11",y:"g44"}},{type:"lnTo",pt:{x:"g31",y:"g44"}},{type:"lnTo",pt:{x:"g32",y:"g43"}},{type:"lnTo",pt:{x:"g33",y:"g43"}},{type:"lnTo",pt:{x:"g33",y:"g47"}},{type:"lnTo",pt:{x:"g35",y:"g47"}},{type:"lnTo",pt:{x:"g35",y:"g45"}},{type:"lnTo",pt:{x:"g36",y:"g45"}},{type:"lnTo",pt:{x:"g38",y:"g46"}},{type:"lnTo",pt:{x:"g12",y:"g46"}},{type:"lnTo",pt:{x:"g12",y:"g41"}},{type:"lnTo",pt:{x:"g38",y:"g41"}},{type:"lnTo",pt:{x:"g37",y:"g42"}},{type:"lnTo",pt:{x:"g35",y:"g42"}},{type:"lnTo",pt:{x:"g35",y:"g41"}},{type:"lnTo",pt:{x:"g34",y:"g40"}},{type:"lnTo",pt:{x:"g32",y:"g40"}},{type:"lnTo",pt:{x:"g31",y:"g39"}},{type:"close"}],fill:"darken",extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"g11",y:"g39"}},{type:"lnTo",pt:{x:"g31",y:"g39"}},{type:"lnTo",pt:{x:"g32",y:"g40"}},{type:"lnTo",pt:{x:"g34",y:"g40"}},{type:"lnTo",pt:{x:"g35",y:"g41"}},{type:"lnTo",pt:{x:"g35",y:"g42"}},{type:"lnTo",pt:{x:"g37",y:"g42"}},{type:"lnTo",pt:{x:"g38",y:"g41"}},{type:"lnTo",pt:{x:"g12",y:"g41"}},{type:"lnTo",pt:{x:"g12",y:"g46"}},{type:"lnTo",pt:{x:"g38",y:"g46"}},{type:"lnTo",pt:{x:"g36",y:"g45"}},{type:"lnTo",pt:{x:"g35",y:"g45"}},{type:"lnTo",pt:{x:"g35",y:"g47"}},{type:"lnTo",pt:{x:"g33",y:"g47"}},{type:"lnTo",pt:{x:"g33",y:"g43"}},{type:"lnTo",pt:{x:"g32",y:"g43"}},{type:"lnTo",pt:{x:"g31",y:"g44"}},{type:"lnTo",pt:{x:"g11",y:"g44"}},{type:"close"}],fill:"none",extrusionOk:!1,stroke:!0},{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"}],fill:"none",extrusionOk:!1,stroke:!0}]},actionButtonReturn:{gdLst:[{n:"dx2",f:"*/ ss 3 8"},{n:"g9",f:"+- vc 0 dx2"},{n:"g10",f:"+- vc dx2 0"},{n:"g11",f:"+- hc 0 dx2"},{n:"g12",f:"+- hc dx2 0"},{n:"g13",f:"*/ ss 3 4"},{n:"g14",f:"*/ g13 7 8"},{n:"g15",f:"*/ g13 3 4"},{n:"g16",f:"*/ g13 5 8"},{n:"g17",f:"*/ g13 3 8"},{n:"g18",f:"*/ g13 1 4"},{n:"g19",f:"+- g9 g15 0"},{n:"g20",f:"+- g9 g16 0"},{n:"g21",f:"+- g9 g18 0"},{n:"g22",f:"+- g11 g14 0"},{n:"g23",f:"+- g11 g15 0"},{n:"g24",f:"+- g11 g16 0"},{n:"g25",f:"+- g11 g17 0"},{n:"g26",f:"+- g11 g18 0"},{n:"g27",f:"*/ g13 1 8"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"},{type:"moveTo",pt:{x:"g12",y:"g21"}},{type:"lnTo",pt:{x:"g23",y:"g9"}},{type:"lnTo",pt:{x:"hc",y:"g21"}},{type:"lnTo",pt:{x:"g24",y:"g21"}},{type:"lnTo",pt:{x:"g24",y:"g20"}},{type:"arcTo",wR:"g27",hR:"g27",stAng:"0",swAng:"cd4"},{type:"lnTo",pt:{x:"g25",y:"g19"}},{type:"arcTo",wR:"g27",hR:"g27",stAng:"cd4",swAng:"cd4"},{type:"lnTo",pt:{x:"g26",y:"g21"}},{type:"lnTo",pt:{x:"g11",y:"g21"}},{type:"lnTo",pt:{x:"g11",y:"g20"}},{type:"arcTo",wR:"g17",hR:"g17",stAng:"cd2",swAng:"-5400000"},{type:"lnTo",pt:{x:"hc",y:"g10"}},{type:"arcTo",wR:"g17",hR:"g17",stAng:"cd4",swAng:"-5400000"},{type:"lnTo",pt:{x:"g22",y:"g21"}},{type:"close"}],extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"g12",y:"g21"}},{type:"lnTo",pt:{x:"g23",y:"g9"}},{type:"lnTo",pt:{x:"hc",y:"g21"}},{type:"lnTo",pt:{x:"g24",y:"g21"}},{type:"lnTo",pt:{x:"g24",y:"g20"}},{type:"arcTo",wR:"g27",hR:"g27",stAng:"0",swAng:"cd4"},{type:"lnTo",pt:{x:"g25",y:"g19"}},{type:"arcTo",wR:"g27",hR:"g27",stAng:"cd4",swAng:"cd4"},{type:"lnTo",pt:{x:"g26",y:"g21"}},{type:"lnTo",pt:{x:"g11",y:"g21"}},{type:"lnTo",pt:{x:"g11",y:"g20"}},{type:"arcTo",wR:"g17",hR:"g17",stAng:"cd2",swAng:"-5400000"},{type:"lnTo",pt:{x:"hc",y:"g10"}},{type:"arcTo",wR:"g17",hR:"g17",stAng:"cd4",swAng:"-5400000"},{type:"lnTo",pt:{x:"g22",y:"g21"}},{type:"close"}],fill:"darken",extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"g12",y:"g21"}},{type:"lnTo",pt:{x:"g22",y:"g21"}},{type:"lnTo",pt:{x:"g22",y:"g20"}},{type:"arcTo",wR:"g17",hR:"g17",stAng:"0",swAng:"cd4"},{type:"lnTo",pt:{x:"g25",y:"g10"}},{type:"arcTo",wR:"g17",hR:"g17",stAng:"cd4",swAng:"cd4"},{type:"lnTo",pt:{x:"g11",y:"g21"}},{type:"lnTo",pt:{x:"g26",y:"g21"}},{type:"lnTo",pt:{x:"g26",y:"g20"}},{type:"arcTo",wR:"g27",hR:"g27",stAng:"cd2",swAng:"-5400000"},{type:"lnTo",pt:{x:"hc",y:"g19"}},{type:"arcTo",wR:"g27",hR:"g27",stAng:"cd4",swAng:"-5400000"},{type:"lnTo",pt:{x:"g24",y:"g21"}},{type:"lnTo",pt:{x:"hc",y:"g21"}},{type:"lnTo",pt:{x:"g23",y:"g9"}},{type:"close"}],fill:"none",extrusionOk:!1,stroke:!0},{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"}],fill:"none",extrusionOk:!1,stroke:!0}]},actionButtonSound:{gdLst:[{n:"dx2",f:"*/ ss 3 8"},{n:"g9",f:"+- vc 0 dx2"},{n:"g10",f:"+- vc dx2 0"},{n:"g11",f:"+- hc 0 dx2"},{n:"g12",f:"+- hc dx2 0"},{n:"g13",f:"*/ ss 3 4"},{n:"g14",f:"*/ g13 1 8"},{n:"g15",f:"*/ g13 5 16"},{n:"g16",f:"*/ g13 5 8"},{n:"g17",f:"*/ g13 11 16"},{n:"g18",f:"*/ g13 3 4"},{n:"g19",f:"*/ g13 7 8"},{n:"g20",f:"+- g9 g14 0"},{n:"g21",f:"+- g9 g15 0"},{n:"g22",f:"+- g9 g17 0"},{n:"g23",f:"+- g9 g19 0"},{n:"g24",f:"+- g11 g15 0"},{n:"g25",f:"+- g11 g16 0"},{n:"g26",f:"+- g11 g18 0"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"},{type:"moveTo",pt:{x:"g11",y:"g21"}},{type:"lnTo",pt:{x:"g11",y:"g22"}},{type:"lnTo",pt:{x:"g24",y:"g22"}},{type:"lnTo",pt:{x:"g25",y:"g10"}},{type:"lnTo",pt:{x:"g25",y:"g9"}},{type:"lnTo",pt:{x:"g24",y:"g21"}},{type:"close"}],extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"g11",y:"g21"}},{type:"lnTo",pt:{x:"g11",y:"g22"}},{type:"lnTo",pt:{x:"g24",y:"g22"}},{type:"lnTo",pt:{x:"g25",y:"g10"}},{type:"lnTo",pt:{x:"g25",y:"g9"}},{type:"lnTo",pt:{x:"g24",y:"g21"}},{type:"close"}],fill:"darken",extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"g11",y:"g21"}},{type:"lnTo",pt:{x:"g24",y:"g21"}},{type:"lnTo",pt:{x:"g25",y:"g9"}},{type:"lnTo",pt:{x:"g25",y:"g10"}},{type:"lnTo",pt:{x:"g24",y:"g22"}},{type:"lnTo",pt:{x:"g11",y:"g22"}},{type:"close"},{type:"moveTo",pt:{x:"g26",y:"g21"}},{type:"lnTo",pt:{x:"g12",y:"g20"}},{type:"moveTo",pt:{x:"g26",y:"vc"}},{type:"lnTo",pt:{x:"g12",y:"vc"}},{type:"moveTo",pt:{x:"g26",y:"g22"}},{type:"lnTo",pt:{x:"g12",y:"g23"}}],fill:"none",extrusionOk:!1,stroke:!0},{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"}],fill:"none",extrusionOk:!1,stroke:!0}]},arc:{avLst:[{n:"adj1",f:"val 16200000"},{n:"adj2",f:"val 0"}],gdLst:[{n:"stAng",f:"pin 0 adj1 21599999"},{n:"enAng",f:"pin 0 adj2 21599999"},{n:"sw11",f:"+- enAng 0 stAng"},{n:"sw12",f:"+- sw11 21600000 0"},{n:"swAng",f:"?: sw11 sw11 sw12"},{n:"wt1",f:"sin wd2 stAng"},{n:"ht1",f:"cos hd2 stAng"},{n:"dx1",f:"cat2 wd2 ht1 wt1"},{n:"dy1",f:"sat2 hd2 ht1 wt1"},{n:"wt2",f:"sin wd2 enAng"},{n:"ht2",f:"cos hd2 enAng"},{n:"dx2",f:"cat2 wd2 ht2 wt2"},{n:"dy2",f:"sat2 hd2 ht2 wt2"},{n:"x1",f:"+- hc dx1 0"},{n:"y1",f:"+- vc dy1 0"},{n:"x2",f:"+- hc dx2 0"},{n:"y2",f:"+- vc dy2 0"},{n:"sw0",f:"+- 21600000 0 stAng"},{n:"da1",f:"+- swAng 0 sw0"},{n:"g1",f:"max x1 x2"},{n:"ir",f:"?: da1 r g1"},{n:"sw1",f:"+- cd4 0 stAng"},{n:"sw2",f:"+- 27000000 0 stAng"},{n:"sw3",f:"?: sw1 sw1 sw2"},{n:"da2",f:"+- swAng 0 sw3"},{n:"g5",f:"max y1 y2"},{n:"ib",f:"?: da2 b g5"},{n:"sw4",f:"+- cd2 0 stAng"},{n:"sw5",f:"+- 32400000 0 stAng"},{n:"sw6",f:"?: sw4 sw4 sw5"},{n:"da3",f:"+- swAng 0 sw6"},{n:"g9",f:"min x1 x2"},{n:"il",f:"?: da3 l g9"},{n:"sw7",f:"+- 3cd4 0 stAng"},{n:"sw8",f:"+- 37800000 0 stAng"},{n:"sw9",f:"?: sw7 sw7 sw8"},{n:"da4",f:"+- swAng 0 sw9"},{n:"g13",f:"min y1 y2"},{n:"it",f:"?: da4 t g13"},{n:"cang1",f:"+- stAng 0 cd4"},{n:"cang2",f:"+- enAng cd4 0"},{n:"cang3",f:"+/ cang1 cang2 2"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"x1",y:"y1"}},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"stAng",swAng:"swAng"},{type:"lnTo",pt:{x:"hc",y:"vc"}},{type:"close"}],extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"x1",y:"y1"}},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"stAng",swAng:"swAng"}],fill:"none",extrusionOk:!1,stroke:!0}]},bentArrow:{avLst:[{n:"adj1",f:"val 25000"},{n:"adj2",f:"val 25000"},{n:"adj3",f:"val 25000"},{n:"adj4",f:"val 43750"}],gdLst:[{n:"a2",f:"pin 0 adj2 50000"},{n:"maxAdj1",f:"*/ a2 2 1"},{n:"a1",f:"pin 0 adj1 maxAdj1"},{n:"a3",f:"pin 0 adj3 50000"},{n:"th",f:"*/ ss a1 100000"},{n:"aw2",f:"*/ ss a2 100000"},{n:"th2",f:"*/ th 1 2"},{n:"dh2",f:"+- aw2 0 th2"},{n:"ah",f:"*/ ss a3 100000"},{n:"bw",f:"+- r 0 ah"},{n:"bh",f:"+- b 0 dh2"},{n:"bs",f:"min bw bh"},{n:"maxAdj4",f:"*/ 100000 bs ss"},{n:"a4",f:"pin 0 adj4 maxAdj4"},{n:"bd",f:"*/ ss a4 100000"},{n:"bd3",f:"+- bd 0 th"},{n:"bd2",f:"max bd3 0"},{n:"x3",f:"+- th bd2 0"},{n:"x4",f:"+- r 0 ah"},{n:"y3",f:"+- dh2 th 0"},{n:"y4",f:"+- y3 dh2 0"},{n:"y5",f:"+- dh2 bd 0"},{n:"y6",f:"+- y3 bd2 0"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"b"}},{type:"lnTo",pt:{x:"l",y:"y5"}},{type:"arcTo",wR:"bd",hR:"bd",stAng:"cd2",swAng:"cd4"},{type:"lnTo",pt:{x:"x4",y:"dh2"}},{type:"lnTo",pt:{x:"x4",y:"t"}},{type:"lnTo",pt:{x:"r",y:"aw2"}},{type:"lnTo",pt:{x:"x4",y:"y4"}},{type:"lnTo",pt:{x:"x4",y:"y3"}},{type:"lnTo",pt:{x:"x3",y:"y3"}},{type:"arcTo",wR:"bd2",hR:"bd2",stAng:"3cd4",swAng:"-5400000"},{type:"lnTo",pt:{x:"th",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},bentConnector2:{pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}}],fill:"none",extrusionOk:!1,stroke:!0}]},bentConnector3:{avLst:[{n:"adj1",f:"val 50000"}],gdLst:[{n:"x1",f:"*/ w adj1 100000"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"x1",y:"t"}},{type:"lnTo",pt:{x:"x1",y:"b"}},{type:"lnTo",pt:{x:"r",y:"b"}}],fill:"none",extrusionOk:!1,stroke:!0}]},bentConnector4:{avLst:[{n:"adj1",f:"val 50000"},{n:"adj2",f:"val 50000"}],gdLst:[{n:"x1",f:"*/ w adj1 100000"},{n:"x2",f:"+/ x1 r 2"},{n:"y2",f:"*/ h adj2 100000"},{n:"y1",f:"+/ t y2 2"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"x1",y:"t"}},{type:"lnTo",pt:{x:"x1",y:"y2"}},{type:"lnTo",pt:{x:"r",y:"y2"}},{type:"lnTo",pt:{x:"r",y:"b"}}],fill:"none",extrusionOk:!1,stroke:!0}]},bentConnector5:{avLst:[{n:"adj1",f:"val 50000"},{n:"adj2",f:"val 50000"},{n:"adj3",f:"val 50000"}],gdLst:[{n:"x1",f:"*/ w adj1 100000"},{n:"x3",f:"*/ w adj3 100000"},{n:"x2",f:"+/ x1 x3 2"},{n:"y2",f:"*/ h adj2 100000"},{n:"y1",f:"+/ t y2 2"},{n:"y3",f:"+/ b y2 2"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"x1",y:"t"}},{type:"lnTo",pt:{x:"x1",y:"y2"}},{type:"lnTo",pt:{x:"x3",y:"y2"}},{type:"lnTo",pt:{x:"x3",y:"b"}},{type:"lnTo",pt:{x:"r",y:"b"}}],fill:"none",extrusionOk:!1,stroke:!0}]},bentUpArrow:{avLst:[{n:"adj1",f:"val 25000"},{n:"adj2",f:"val 25000"},{n:"adj3",f:"val 25000"}],gdLst:[{n:"a1",f:"pin 0 adj1 50000"},{n:"a2",f:"pin 0 adj2 50000"},{n:"a3",f:"pin 0 adj3 50000"},{n:"y1",f:"*/ ss a3 100000"},{n:"dx1",f:"*/ ss a2 50000"},{n:"x1",f:"+- r 0 dx1"},{n:"dx3",f:"*/ ss a2 100000"},{n:"x3",f:"+- r 0 dx3"},{n:"dx2",f:"*/ ss a1 200000"},{n:"x2",f:"+- x3 0 dx2"},{n:"x4",f:"+- x3 dx2 0"},{n:"dy2",f:"*/ ss a1 100000"},{n:"y2",f:"+- b 0 dy2"},{n:"x0",f:"*/ x4 1 2"},{n:"y3",f:"+/ y2 b 2"},{n:"y15",f:"+/ y1 b 2"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"y2"}},{type:"lnTo",pt:{x:"x2",y:"y2"}},{type:"lnTo",pt:{x:"x2",y:"y1"}},{type:"lnTo",pt:{x:"x1",y:"y1"}},{type:"lnTo",pt:{x:"x3",y:"t"}},{type:"lnTo",pt:{x:"r",y:"y1"}},{type:"lnTo",pt:{x:"x4",y:"y1"}},{type:"lnTo",pt:{x:"x4",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},bevel:{avLst:[{n:"adj",f:"val 12500"}],gdLst:[{n:"a",f:"pin 0 adj 50000"},{n:"x1",f:"*/ ss a 100000"},{n:"x2",f:"+- r 0 x1"},{n:"y2",f:"+- b 0 x1"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"x1",y:"x1"}},{type:"lnTo",pt:{x:"x2",y:"x1"}},{type:"lnTo",pt:{x:"x2",y:"y2"}},{type:"lnTo",pt:{x:"x1",y:"y2"}},{type:"close"}],extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"x2",y:"x1"}},{type:"lnTo",pt:{x:"x1",y:"x1"}},{type:"close"}],fill:"lightenLess",extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"l",y:"b"}},{type:"lnTo",pt:{x:"x1",y:"y2"}},{type:"lnTo",pt:{x:"x2",y:"y2"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"close"}],fill:"darkenLess",extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"x1",y:"x1"}},{type:"lnTo",pt:{x:"x1",y:"y2"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"}],fill:"lighten",extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"x2",y:"y2"}},{type:"lnTo",pt:{x:"x2",y:"x1"}},{type:"close"}],fill:"darken",extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"},{type:"moveTo",pt:{x:"x1",y:"x1"}},{type:"lnTo",pt:{x:"x2",y:"x1"}},{type:"lnTo",pt:{x:"x2",y:"y2"}},{type:"lnTo",pt:{x:"x1",y:"y2"}},{type:"close"},{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"x1",y:"x1"}},{type:"moveTo",pt:{x:"l",y:"b"}},{type:"lnTo",pt:{x:"x1",y:"y2"}},{type:"moveTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"x2",y:"x1"}},{type:"moveTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"x2",y:"y2"}}],fill:"none",extrusionOk:!1,stroke:!0}]},blockArc:{avLst:[{n:"adj1",f:"val 10800000"},{n:"adj2",f:"val 0"},{n:"adj3",f:"val 25000"}],gdLst:[{n:"stAng",f:"pin 0 adj1 21599999"},{n:"istAng",f:"pin 0 adj2 21599999"},{n:"a3",f:"pin 0 adj3 50000"},{n:"sw11",f:"+- istAng 0 stAng"},{n:"sw12",f:"+- sw11 21600000 0"},{n:"swAng",f:"?: sw11 sw11 sw12"},{n:"iswAng",f:"+- 0 0 swAng"},{n:"wt1",f:"sin wd2 stAng"},{n:"ht1",f:"cos hd2 stAng"},{n:"wt3",f:"sin wd2 istAng"},{n:"ht3",f:"cos hd2 istAng"},{n:"dx1",f:"cat2 wd2 ht1 wt1"},{n:"dy1",f:"sat2 hd2 ht1 wt1"},{n:"dx3",f:"cat2 wd2 ht3 wt3"},{n:"dy3",f:"sat2 hd2 ht3 wt3"},{n:"x1",f:"+- hc dx1 0"},{n:"y1",f:"+- vc dy1 0"},{n:"x3",f:"+- hc dx3 0"},{n:"y3",f:"+- vc dy3 0"},{n:"dr",f:"*/ ss a3 100000"},{n:"iwd2",f:"+- wd2 0 dr"},{n:"ihd2",f:"+- hd2 0 dr"},{n:"wt2",f:"sin iwd2 istAng"},{n:"ht2",f:"cos ihd2 istAng"},{n:"wt4",f:"sin iwd2 stAng"},{n:"ht4",f:"cos ihd2 stAng"},{n:"dx2",f:"cat2 iwd2 ht2 wt2"},{n:"dy2",f:"sat2 ihd2 ht2 wt2"},{n:"dx4",f:"cat2 iwd2 ht4 wt4"},{n:"dy4",f:"sat2 ihd2 ht4 wt4"},{n:"x2",f:"+- hc dx2 0"},{n:"y2",f:"+- vc dy2 0"},{n:"x4",f:"+- hc dx4 0"},{n:"y4",f:"+- vc dy4 0"},{n:"sw0",f:"+- 21600000 0 stAng"},{n:"da1",f:"+- swAng 0 sw0"},{n:"g1",f:"max x1 x2"},{n:"g2",f:"max x3 x4"},{n:"g3",f:"max g1 g2"},{n:"ir",f:"?: da1 r g3"},{n:"sw1",f:"+- cd4 0 stAng"},{n:"sw2",f:"+- 27000000 0 stAng"},{n:"sw3",f:"?: sw1 sw1 sw2"},{n:"da2",f:"+- swAng 0 sw3"},{n:"g5",f:"max y1 y2"},{n:"g6",f:"max y3 y4"},{n:"g7",f:"max g5 g6"},{n:"ib",f:"?: da2 b g7"},{n:"sw4",f:"+- cd2 0 stAng"},{n:"sw5",f:"+- 32400000 0 stAng"},{n:"sw6",f:"?: sw4 sw4 sw5"},{n:"da3",f:"+- swAng 0 sw6"},{n:"g9",f:"min x1 x2"},{n:"g10",f:"min x3 x4"},{n:"g11",f:"min g9 g10"},{n:"il",f:"?: da3 l g11"},{n:"sw7",f:"+- 3cd4 0 stAng"},{n:"sw8",f:"+- 37800000 0 stAng"},{n:"sw9",f:"?: sw7 sw7 sw8"},{n:"da4",f:"+- swAng 0 sw9"},{n:"g13",f:"min y1 y2"},{n:"g14",f:"min y3 y4"},{n:"g15",f:"min g13 g14"},{n:"it",f:"?: da4 t g15"},{n:"x5",f:"+/ x1 x4 2"},{n:"y5",f:"+/ y1 y4 2"},{n:"x6",f:"+/ x3 x2 2"},{n:"y6",f:"+/ y3 y2 2"},{n:"cang1",f:"+- stAng 0 cd4"},{n:"cang2",f:"+- istAng cd4 0"},{n:"cang3",f:"+/ cang1 cang2 2"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"x1",y:"y1"}},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"stAng",swAng:"swAng"},{type:"lnTo",pt:{x:"x2",y:"y2"}},{type:"arcTo",wR:"iwd2",hR:"ihd2",stAng:"istAng",swAng:"iswAng"},{type:"close"}],extrusionOk:!1,stroke:!0}]},borderCallout1:{avLst:[{n:"adj1",f:"val 18750"},{n:"adj2",f:"val -8333"},{n:"adj3",f:"val 112500"},{n:"adj4",f:"val -38333"}],gdLst:[{n:"y1",f:"*/ h adj1 100000"},{n:"x1",f:"*/ w adj2 100000"},{n:"y2",f:"*/ h adj3 100000"},{n:"x2",f:"*/ w adj4 100000"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!0},{defines:[{type:"moveTo",pt:{x:"x1",y:"y1"}},{type:"lnTo",pt:{x:"x2",y:"y2"}}],fill:"none",extrusionOk:!1,stroke:!0}]},borderCallout2:{avLst:[{n:"adj1",f:"val 18750"},{n:"adj2",f:"val -8333"},{n:"adj3",f:"val 18750"},{n:"adj4",f:"val -16667"},{n:"adj5",f:"val 112500"},{n:"adj6",f:"val -46667"}],gdLst:[{n:"y1",f:"*/ h adj1 100000"},{n:"x1",f:"*/ w adj2 100000"},{n:"y2",f:"*/ h adj3 100000"},{n:"x2",f:"*/ w adj4 100000"},{n:"y3",f:"*/ h adj5 100000"},{n:"x3",f:"*/ w adj6 100000"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!0},{defines:[{type:"moveTo",pt:{x:"x1",y:"y1"}},{type:"lnTo",pt:{x:"x2",y:"y2"}},{type:"lnTo",pt:{x:"x3",y:"y3"}}],fill:"none",extrusionOk:!1,stroke:!0}]},borderCallout3:{avLst:[{n:"adj1",f:"val 18750"},{n:"adj2",f:"val -8333"},{n:"adj3",f:"val 18750"},{n:"adj4",f:"val -16667"},{n:"adj5",f:"val 100000"},{n:"adj6",f:"val -16667"},{n:"adj7",f:"val 112963"},{n:"adj8",f:"val -8333"}],gdLst:[{n:"y1",f:"*/ h adj1 100000"},{n:"x1",f:"*/ w adj2 100000"},{n:"y2",f:"*/ h adj3 100000"},{n:"x2",f:"*/ w adj4 100000"},{n:"y3",f:"*/ h adj5 100000"},{n:"x3",f:"*/ w adj6 100000"},{n:"y4",f:"*/ h adj7 100000"},{n:"x4",f:"*/ w adj8 100000"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!0},{defines:[{type:"moveTo",pt:{x:"x1",y:"y1"}},{type:"lnTo",pt:{x:"x2",y:"y2"}},{type:"lnTo",pt:{x:"x3",y:"y3"}},{type:"lnTo",pt:{x:"x4",y:"y4"}}],fill:"none",extrusionOk:!1,stroke:!0}]},bracePair:{avLst:[{n:"adj",f:"val 8333"}],gdLst:[{n:"a",f:"pin 0 adj 25000"},{n:"x1",f:"*/ ss a 100000"},{n:"x2",f:"*/ ss a 50000"},{n:"x3",f:"+- r 0 x2"},{n:"x4",f:"+- r 0 x1"},{n:"y2",f:"+- vc 0 x1"},{n:"y3",f:"+- vc x1 0"},{n:"y4",f:"+- b 0 x1"},{n:"it",f:"*/ x1 29289 100000"},{n:"il",f:"+- x1 it 0"},{n:"ir",f:"+- r 0 il"},{n:"ib",f:"+- b 0 it"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"x2",y:"b"}},{type:"arcTo",wR:"x1",hR:"x1",stAng:"cd4",swAng:"cd4"},{type:"lnTo",pt:{x:"x1",y:"y3"}},{type:"arcTo",wR:"x1",hR:"x1",stAng:"0",swAng:"-5400000"},{type:"arcTo",wR:"x1",hR:"x1",stAng:"cd4",swAng:"-5400000"},{type:"lnTo",pt:{x:"x1",y:"x1"}},{type:"arcTo",wR:"x1",hR:"x1",stAng:"cd2",swAng:"cd4"},{type:"lnTo",pt:{x:"x3",y:"t"}},{type:"arcTo",wR:"x1",hR:"x1",stAng:"3cd4",swAng:"cd4"},{type:"lnTo",pt:{x:"x4",y:"y2"}},{type:"arcTo",wR:"x1",hR:"x1",stAng:"cd2",swAng:"-5400000"},{type:"arcTo",wR:"x1",hR:"x1",stAng:"3cd4",swAng:"-5400000"},{type:"lnTo",pt:{x:"x4",y:"y4"}},{type:"arcTo",wR:"x1",hR:"x1",stAng:"0",swAng:"cd4"},{type:"close"}],extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"x2",y:"b"}},{type:"arcTo",wR:"x1",hR:"x1",stAng:"cd4",swAng:"cd4"},{type:"lnTo",pt:{x:"x1",y:"y3"}},{type:"arcTo",wR:"x1",hR:"x1",stAng:"0",swAng:"-5400000"},{type:"arcTo",wR:"x1",hR:"x1",stAng:"cd4",swAng:"-5400000"},{type:"lnTo",pt:{x:"x1",y:"x1"}},{type:"arcTo",wR:"x1",hR:"x1",stAng:"cd2",swAng:"cd4"},{type:"moveTo",pt:{x:"x3",y:"t"}},{type:"arcTo",wR:"x1",hR:"x1",stAng:"3cd4",swAng:"cd4"},{type:"lnTo",pt:{x:"x4",y:"y2"}},{type:"arcTo",wR:"x1",hR:"x1",stAng:"cd2",swAng:"-5400000"},{type:"arcTo",wR:"x1",hR:"x1",stAng:"3cd4",swAng:"-5400000"},{type:"lnTo",pt:{x:"x4",y:"y4"}},{type:"arcTo",wR:"x1",hR:"x1",stAng:"0",swAng:"cd4"}],fill:"none",extrusionOk:!1,stroke:!0}]},bracketPair:{avLst:[{n:"adj",f:"val 16667"}],gdLst:[{n:"a",f:"pin 0 adj 50000"},{n:"x1",f:"*/ ss a 100000"},{n:"x2",f:"+- r 0 x1"},{n:"y2",f:"+- b 0 x1"},{n:"il",f:"*/ x1 29289 100000"},{n:"ir",f:"+- r 0 il"},{n:"ib",f:"+- b 0 il"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"x1"}},{type:"arcTo",wR:"x1",hR:"x1",stAng:"cd2",swAng:"cd4"},{type:"lnTo",pt:{x:"x2",y:"t"}},{type:"arcTo",wR:"x1",hR:"x1",stAng:"3cd4",swAng:"cd4"},{type:"lnTo",pt:{x:"r",y:"y2"}},{type:"arcTo",wR:"x1",hR:"x1",stAng:"0",swAng:"cd4"},{type:"lnTo",pt:{x:"x1",y:"b"}},{type:"arcTo",wR:"x1",hR:"x1",stAng:"cd4",swAng:"cd4"},{type:"close"}],extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"x1",y:"b"}},{type:"arcTo",wR:"x1",hR:"x1",stAng:"cd4",swAng:"cd4"},{type:"lnTo",pt:{x:"l",y:"x1"}},{type:"arcTo",wR:"x1",hR:"x1",stAng:"cd2",swAng:"cd4"},{type:"moveTo",pt:{x:"x2",y:"t"}},{type:"arcTo",wR:"x1",hR:"x1",stAng:"3cd4",swAng:"cd4"},{type:"lnTo",pt:{x:"r",y:"y2"}},{type:"arcTo",wR:"x1",hR:"x1",stAng:"0",swAng:"cd4"}],fill:"none",extrusionOk:!1,stroke:!0}]},callout1:{avLst:[{n:"adj1",f:"val 18750"},{n:"adj2",f:"val -8333"},{n:"adj3",f:"val 112500"},{n:"adj4",f:"val -38333"}],gdLst:[{n:"y1",f:"*/ h adj1 100000"},{n:"x1",f:"*/ w adj2 100000"},{n:"y2",f:"*/ h adj3 100000"},{n:"x2",f:"*/ w adj4 100000"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"x1",y:"y1"}},{type:"lnTo",pt:{x:"x2",y:"y2"}}],fill:"none",extrusionOk:!1,stroke:!0}]},callout2:{avLst:[{n:"adj1",f:"val 18750"},{n:"adj2",f:"val -8333"},{n:"adj3",f:"val 18750"},{n:"adj4",f:"val -16667"},{n:"adj5",f:"val 112500"},{n:"adj6",f:"val -46667"}],gdLst:[{n:"y1",f:"*/ h adj1 100000"},{n:"x1",f:"*/ w adj2 100000"},{n:"y2",f:"*/ h adj3 100000"},{n:"x2",f:"*/ w adj4 100000"},{n:"y3",f:"*/ h adj5 100000"},{n:"x3",f:"*/ w adj6 100000"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"x1",y:"y1"}},{type:"lnTo",pt:{x:"x2",y:"y2"}},{type:"lnTo",pt:{x:"x3",y:"y3"}}],fill:"none",extrusionOk:!1,stroke:!0}]},callout3:{avLst:[{n:"adj1",f:"val 18750"},{n:"adj2",f:"val -8333"},{n:"adj3",f:"val 18750"},{n:"adj4",f:"val -16667"},{n:"adj5",f:"val 100000"},{n:"adj6",f:"val -16667"},{n:"adj7",f:"val 112963"},{n:"adj8",f:"val -8333"}],gdLst:[{n:"y1",f:"*/ h adj1 100000"},{n:"x1",f:"*/ w adj2 100000"},{n:"y2",f:"*/ h adj3 100000"},{n:"x2",f:"*/ w adj4 100000"},{n:"y3",f:"*/ h adj5 100000"},{n:"x3",f:"*/ w adj6 100000"},{n:"y4",f:"*/ h adj7 100000"},{n:"x4",f:"*/ w adj8 100000"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"x1",y:"y1"}},{type:"lnTo",pt:{x:"x2",y:"y2"}},{type:"lnTo",pt:{x:"x3",y:"y3"}},{type:"lnTo",pt:{x:"x4",y:"y4"}}],fill:"none",extrusionOk:!1,stroke:!0}]},can:{avLst:[{n:"adj",f:"val 25000"}],gdLst:[{n:"maxAdj",f:"*/ 50000 h ss"},{n:"a",f:"pin 0 adj maxAdj"},{n:"y1",f:"*/ ss a 200000"},{n:"y2",f:"+- y1 y1 0"},{n:"y3",f:"+- b 0 y1"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"y1"}},{type:"arcTo",wR:"wd2",hR:"y1",stAng:"cd2",swAng:"-10800000"},{type:"lnTo",pt:{x:"r",y:"y3"}},{type:"arcTo",wR:"wd2",hR:"y1",stAng:"0",swAng:"cd2"},{type:"close"}],extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"l",y:"y1"}},{type:"arcTo",wR:"wd2",hR:"y1",stAng:"cd2",swAng:"cd2"},{type:"arcTo",wR:"wd2",hR:"y1",stAng:"0",swAng:"cd2"},{type:"close"}],fill:"lighten",extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"r",y:"y1"}},{type:"arcTo",wR:"wd2",hR:"y1",stAng:"0",swAng:"cd2"},{type:"arcTo",wR:"wd2",hR:"y1",stAng:"cd2",swAng:"cd2"},{type:"lnTo",pt:{x:"r",y:"y3"}},{type:"arcTo",wR:"wd2",hR:"y1",stAng:"0",swAng:"cd2"},{type:"lnTo",pt:{x:"l",y:"y1"}}],fill:"none",extrusionOk:!1,stroke:!0}]},chartPlus:{pathLst:[{defines:[{type:"moveTo",pt:{x:"5",y:"0"}},{type:"lnTo",pt:{x:"5",y:"10"}},{type:"moveTo",pt:{x:"0",y:"5"}},{type:"lnTo",pt:{x:"10",y:"5"}}],fill:"none",extrusionOk:!1,stroke:!0,w:10,h:10},{defines:[{type:"moveTo",pt:{x:"0",y:"0"}},{type:"lnTo",pt:{x:"0",y:"10"}},{type:"lnTo",pt:{x:"10",y:"10"}},{type:"lnTo",pt:{x:"10",y:"0"}},{type:"close"}],extrusionOk:!1,stroke:!1,w:10,h:10}]},chartStar:{pathLst:[{defines:[{type:"moveTo",pt:{x:"0",y:"0"}},{type:"lnTo",pt:{x:"10",y:"10"}},{type:"moveTo",pt:{x:"0",y:"10"}},{type:"lnTo",pt:{x:"10",y:"0"}},{type:"moveTo",pt:{x:"5",y:"0"}},{type:"lnTo",pt:{x:"5",y:"10"}}],fill:"none",extrusionOk:!1,stroke:!0,w:10,h:10},{defines:[{type:"moveTo",pt:{x:"0",y:"0"}},{type:"lnTo",pt:{x:"0",y:"10"}},{type:"lnTo",pt:{x:"10",y:"10"}},{type:"lnTo",pt:{x:"10",y:"0"}},{type:"close"}],extrusionOk:!1,stroke:!1,w:10,h:10}]},chartX:{pathLst:[{defines:[{type:"moveTo",pt:{x:"0",y:"0"}},{type:"lnTo",pt:{x:"10",y:"10"}},{type:"moveTo",pt:{x:"0",y:"10"}},{type:"lnTo",pt:{x:"10",y:"0"}}],fill:"none",extrusionOk:!1,stroke:!0,w:10,h:10},{defines:[{type:"moveTo",pt:{x:"0",y:"0"}},{type:"lnTo",pt:{x:"0",y:"10"}},{type:"lnTo",pt:{x:"10",y:"10"}},{type:"lnTo",pt:{x:"10",y:"0"}},{type:"close"}],extrusionOk:!1,stroke:!1,w:10,h:10}]},chevron:{avLst:[{n:"adj",f:"val 50000"}],gdLst:[{n:"maxAdj",f:"*/ 100000 w ss"},{n:"a",f:"pin 0 adj maxAdj"},{n:"x1",f:"*/ ss a 100000"},{n:"x2",f:"+- r 0 x1"},{n:"x3",f:"*/ x2 1 2"},{n:"dx",f:"+- x2 0 x1"},{n:"il",f:"?: dx x1 l"},{n:"ir",f:"?: dx x2 r"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"x2",y:"t"}},{type:"lnTo",pt:{x:"r",y:"vc"}},{type:"lnTo",pt:{x:"x2",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"lnTo",pt:{x:"x1",y:"vc"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},chord:{avLst:[{n:"adj1",f:"val 2700000"},{n:"adj2",f:"val 16200000"}],gdLst:[{n:"stAng",f:"pin 0 adj1 21599999"},{n:"enAng",f:"pin 0 adj2 21599999"},{n:"sw1",f:"+- enAng 0 stAng"},{n:"sw2",f:"+- sw1 21600000 0"},{n:"swAng",f:"?: sw1 sw1 sw2"},{n:"wt1",f:"sin wd2 stAng"},{n:"ht1",f:"cos hd2 stAng"},{n:"dx1",f:"cat2 wd2 ht1 wt1"},{n:"dy1",f:"sat2 hd2 ht1 wt1"},{n:"wt2",f:"sin wd2 enAng"},{n:"ht2",f:"cos hd2 enAng"},{n:"dx2",f:"cat2 wd2 ht2 wt2"},{n:"dy2",f:"sat2 hd2 ht2 wt2"},{n:"x1",f:"+- hc dx1 0"},{n:"y1",f:"+- vc dy1 0"},{n:"x2",f:"+- hc dx2 0"},{n:"y2",f:"+- vc dy2 0"},{n:"x3",f:"+/ x1 x2 2"},{n:"y3",f:"+/ y1 y2 2"},{n:"midAng0",f:"*/ swAng 1 2"},{n:"midAng",f:"+- stAng midAng0 cd2"},{n:"idx",f:"cos wd2 2700000"},{n:"idy",f:"sin hd2 2700000"},{n:"il",f:"+- hc 0 idx"},{n:"ir",f:"+- hc idx 0"},{n:"it",f:"+- vc 0 idy"},{n:"ib",f:"+- vc idy 0"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"x1",y:"y1"}},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"stAng",swAng:"swAng"},{type:"close"}],extrusionOk:!1,stroke:!0}]},circularArrow:{avLst:[{n:"adj1",f:"val 12500"},{n:"adj2",f:"val 1142319"},{n:"adj3",f:"val 20457681"},{n:"adj4",f:"val 10800000"},{n:"adj5",f:"val 12500"}],gdLst:[{n:"a5",f:"pin 0 adj5 25000"},{n:"maxAdj1",f:"*/ a5 2 1"},{n:"a1",f:"pin 0 adj1 maxAdj1"},{n:"enAng",f:"pin 1 adj3 21599999"},{n:"stAng",f:"pin 0 adj4 21599999"},{n:"th",f:"*/ ss a1 100000"},{n:"thh",f:"*/ ss a5 100000"},{n:"th2",f:"*/ th 1 2"},{n:"rw1",f:"+- wd2 th2 thh"},{n:"rh1",f:"+- hd2 th2 thh"},{n:"rw2",f:"+- rw1 0 th"},{n:"rh2",f:"+- rh1 0 th"},{n:"rw3",f:"+- rw2 th2 0"},{n:"rh3",f:"+- rh2 th2 0"},{n:"wtH",f:"sin rw3 enAng"},{n:"htH",f:"cos rh3 enAng"},{n:"dxH",f:"cat2 rw3 htH wtH"},{n:"dyH",f:"sat2 rh3 htH wtH"},{n:"xH",f:"+- hc dxH 0"},{n:"yH",f:"+- vc dyH 0"},{n:"rI",f:"min rw2 rh2"},{n:"u1",f:"*/ dxH dxH 1"},{n:"u2",f:"*/ dyH dyH 1"},{n:"u3",f:"*/ rI rI 1"},{n:"u4",f:"+- u1 0 u3"},{n:"u5",f:"+- u2 0 u3"},{n:"u6",f:"*/ u4 u5 u1"},{n:"u7",f:"*/ u6 1 u2"},{n:"u8",f:"+- 1 0 u7"},{n:"u9",f:"sqrt u8"},{n:"u10",f:"*/ u4 1 dxH"},{n:"u11",f:"*/ u10 1 dyH"},{n:"u12",f:"+/ 1 u9 u11"},{n:"u13",f:"at2 1 u12"},{n:"u14",f:"+- u13 21600000 0"},{n:"u15",f:"?: u13 u13 u14"},{n:"u16",f:"+- u15 0 enAng"},{n:"u17",f:"+- u16 21600000 0"},{n:"u18",f:"?: u16 u16 u17"},{n:"u19",f:"+- u18 0 cd2"},{n:"u20",f:"+- u18 0 21600000"},{n:"u21",f:"?: u19 u20 u18"},{n:"maxAng",f:"abs u21"},{n:"aAng",f:"pin 0 adj2 maxAng"},{n:"ptAng",f:"+- enAng aAng 0"},{n:"wtA",f:"sin rw3 ptAng"},{n:"htA",f:"cos rh3 ptAng"},{n:"dxA",f:"cat2 rw3 htA wtA"},{n:"dyA",f:"sat2 rh3 htA wtA"},{n:"xA",f:"+- hc dxA 0"},{n:"yA",f:"+- vc dyA 0"},{n:"wtE",f:"sin rw1 stAng"},{n:"htE",f:"cos rh1 stAng"},{n:"dxE",f:"cat2 rw1 htE wtE"},{n:"dyE",f:"sat2 rh1 htE wtE"},{n:"xE",f:"+- hc dxE 0"},{n:"yE",f:"+- vc dyE 0"},{n:"dxG",f:"cos thh ptAng"},{n:"dyG",f:"sin thh ptAng"},{n:"xG",f:"+- xH dxG 0"},{n:"yG",f:"+- yH dyG 0"},{n:"dxB",f:"cos thh ptAng"},{n:"dyB",f:"sin thh ptAng"},{n:"xB",f:"+- xH 0 dxB 0"},{n:"yB",f:"+- yH 0 dyB 0"},{n:"sx1",f:"+- xB 0 hc"},{n:"sy1",f:"+- yB 0 vc"},{n:"sx2",f:"+- xG 0 hc"},{n:"sy2",f:"+- yG 0 vc"},{n:"rO",f:"min rw1 rh1"},{n:"x1O",f:"*/ sx1 rO rw1"},{n:"y1O",f:"*/ sy1 rO rh1"},{n:"x2O",f:"*/ sx2 rO rw1"},{n:"y2O",f:"*/ sy2 rO rh1"},{n:"dxO",f:"+- x2O 0 x1O"},{n:"dyO",f:"+- y2O 0 y1O"},{n:"dO",f:"mod dxO dyO 0"},{n:"q1",f:"*/ x1O y2O 1"},{n:"q2",f:"*/ x2O y1O 1"},{n:"DO",f:"+- q1 0 q2"},{n:"q3",f:"*/ rO rO 1"},{n:"q4",f:"*/ dO dO 1"},{n:"q5",f:"*/ q3 q4 1"},{n:"q6",f:"*/ DO DO 1"},{n:"q7",f:"+- q5 0 q6"},{n:"q8",f:"max q7 0"},{n:"sdelO",f:"sqrt q8"},{n:"ndyO",f:"*/ dyO -1 1"},{n:"sdyO",f:"?: ndyO -1 1"},{n:"q9",f:"*/ sdyO dxO 1"},{n:"q10",f:"*/ q9 sdelO 1"},{n:"q11",f:"*/ DO dyO 1"},{n:"dxF1",f:"+/ q11 q10 q4"},{n:"q12",f:"+- q11 0 q10"},{n:"dxF2",f:"*/ q12 1 q4"},{n:"adyO",f:"abs dyO"},{n:"q13",f:"*/ adyO sdelO 1"},{n:"q14",f:"*/ DO dxO -1"},{n:"dyF1",f:"+/ q14 q13 q4"},{n:"q15",f:"+- q14 0 q13"},{n:"dyF2",f:"*/ q15 1 q4"},{n:"q16",f:"+- x2O 0 dxF1"},{n:"q17",f:"+- x2O 0 dxF2"},{n:"q18",f:"+- y2O 0 dyF1"},{n:"q19",f:"+- y2O 0 dyF2"},{n:"q20",f:"mod q16 q18 0"},{n:"q21",f:"mod q17 q19 0"},{n:"q22",f:"+- q21 0 q20"},{n:"dxF",f:"?: q22 dxF1 dxF2"},{n:"dyF",f:"?: q22 dyF1 dyF2"},{n:"sdxF",f:"*/ dxF rw1 rO"},{n:"sdyF",f:"*/ dyF rh1 rO"},{n:"xF",f:"+- hc sdxF 0"},{n:"yF",f:"+- vc sdyF 0"},{n:"x1I",f:"*/ sx1 rI rw2"},{n:"y1I",f:"*/ sy1 rI rh2"},{n:"x2I",f:"*/ sx2 rI rw2"},{n:"y2I",f:"*/ sy2 rI rh2"},{n:"dxI",f:"+- x2I 0 x1I"},{n:"dyI",f:"+- y2I 0 y1I"},{n:"dI",f:"mod dxI dyI 0"},{n:"v1",f:"*/ x1I y2I 1"},{n:"v2",f:"*/ x2I y1I 1"},{n:"DI",f:"+- v1 0 v2"},{n:"v3",f:"*/ rI rI 1"},{n:"v4",f:"*/ dI dI 1"},{n:"v5",f:"*/ v3 v4 1"},{n:"v6",f:"*/ DI DI 1"},{n:"v7",f:"+- v5 0 v6"},{n:"v8",f:"max v7 0"},{n:"sdelI",f:"sqrt v8"},{n:"v9",f:"*/ sdyO dxI 1"},{n:"v10",f:"*/ v9 sdelI 1"},{n:"v11",f:"*/ DI dyI 1"},{n:"dxC1",f:"+/ v11 v10 v4"},{n:"v12",f:"+- v11 0 v10"},{n:"dxC2",f:"*/ v12 1 v4"},{n:"adyI",f:"abs dyI"},{n:"v13",f:"*/ adyI sdelI 1"},{n:"v14",f:"*/ DI dxI -1"},{n:"dyC1",f:"+/ v14 v13 v4"},{n:"v15",f:"+- v14 0 v13"},{n:"dyC2",f:"*/ v15 1 v4"},{n:"v16",f:"+- x1I 0 dxC1"},{n:"v17",f:"+- x1I 0 dxC2"},{n:"v18",f:"+- y1I 0 dyC1"},{n:"v19",f:"+- y1I 0 dyC2"},{n:"v20",f:"mod v16 v18 0"},{n:"v21",f:"mod v17 v19 0"},{n:"v22",f:"+- v21 0 v20"},{n:"dxC",f:"?: v22 dxC1 dxC2"},{n:"dyC",f:"?: v22 dyC1 dyC2"},{n:"sdxC",f:"*/ dxC rw2 rI"},{n:"sdyC",f:"*/ dyC rh2 rI"},{n:"xC",f:"+- hc sdxC 0"},{n:"yC",f:"+- vc sdyC 0"},{n:"ist0",f:"at2 sdxC sdyC"},{n:"ist1",f:"+- ist0 21600000 0"},{n:"istAng",f:"?: ist0 ist0 ist1"},{n:"isw1",f:"+- stAng 0 istAng"},{n:"isw2",f:"+- isw1 0 21600000"},{n:"iswAng",f:"?: isw1 isw2 isw1"},{n:"p1",f:"+- xF 0 xC"},{n:"p2",f:"+- yF 0 yC"},{n:"p3",f:"mod p1 p2 0"},{n:"p4",f:"*/ p3 1 2"},{n:"p5",f:"+- p4 0 thh"},{n:"xGp",f:"?: p5 xF xG"},{n:"yGp",f:"?: p5 yF yG"},{n:"xBp",f:"?: p5 xC xB"},{n:"yBp",f:"?: p5 yC yB"},{n:"en0",f:"at2 sdxF sdyF"},{n:"en1",f:"+- en0 21600000 0"},{n:"en2",f:"?: en0 en0 en1"},{n:"sw0",f:"+- en2 0 stAng"},{n:"sw1",f:"+- sw0 21600000 0"},{n:"swAng",f:"?: sw0 sw0 sw1"},{n:"wtI",f:"sin rw3 stAng"},{n:"htI",f:"cos rh3 stAng"},{n:"dxI",f:"cat2 rw3 htI wtI"},{n:"dyI",f:"sat2 rh3 htI wtI"},{n:"xI",f:"+- hc dxI 0"},{n:"yI",f:"+- vc dyI 0"},{n:"aI",f:"+- stAng 0 cd4"},{n:"aA",f:"+- ptAng cd4 0"},{n:"aB",f:"+- ptAng cd2 0"},{n:"idx",f:"cos rw1 2700000"},{n:"idy",f:"sin rh1 2700000"},{n:"il",f:"+- hc 0 idx"},{n:"ir",f:"+- hc idx 0"},{n:"it",f:"+- vc 0 idy"},{n:"ib",f:"+- vc idy 0"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"xE",y:"yE"}},{type:"arcTo",wR:"rw1",hR:"rh1",stAng:"stAng",swAng:"swAng"},{type:"lnTo",pt:{x:"xGp",y:"yGp"}},{type:"lnTo",pt:{x:"xA",y:"yA"}},{type:"lnTo",pt:{x:"xBp",y:"yBp"}},{type:"lnTo",pt:{x:"xC",y:"yC"}},{type:"arcTo",wR:"rw2",hR:"rh2",stAng:"istAng",swAng:"iswAng"},{type:"close"}],extrusionOk:!1,stroke:!0}]},cloud:{gdLst:[{n:"il",f:"*/ w 2977 21600"},{n:"it",f:"*/ h 3262 21600"},{n:"ir",f:"*/ w 17087 21600"},{n:"ib",f:"*/ h 17337 21600"},{n:"g27",f:"*/ w 67 21600"},{n:"g28",f:"*/ h 21577 21600"},{n:"g29",f:"*/ w 21582 21600"},{n:"g30",f:"*/ h 1235 21600"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"3900",y:"14370"}},{type:"arcTo",wR:"6753",hR:"9190",stAng:"-11429249",swAng:"7426832"},{type:"arcTo",wR:"5333",hR:"7267",stAng:"-8646143",swAng:"5396714"},{type:"arcTo",wR:"4365",hR:"5945",stAng:"-8748475",swAng:"5983381"},{type:"arcTo",wR:"4857",hR:"6595",stAng:"-7859164",swAng:"7034504"},{type:"arcTo",wR:"5333",hR:"7273",stAng:"-4722533",swAng:"6541615"},{type:"arcTo",wR:"6775",hR:"9220",stAng:"-2776035",swAng:"7816140"},{type:"arcTo",wR:"5785",hR:"7867",stAng:"37501",swAng:"6842000"},{type:"arcTo",wR:"6752",hR:"9215",stAng:"1347096",swAng:"6910353"},{type:"arcTo",wR:"7720",hR:"10543",stAng:"3974558",swAng:"4542661"},{type:"arcTo",wR:"4360",hR:"5918",stAng:"-16496525",swAng:"8804134"},{type:"arcTo",wR:"4345",hR:"5945",stAng:"-14809710",swAng:"9151131"},{type:"close"}],extrusionOk:!1,stroke:!0,w:43200,h:43200},{defines:[{type:"moveTo",pt:{x:"4693",y:"26177"}},{type:"arcTo",wR:"4345",hR:"5945",stAng:"5204520",swAng:"1585770"},{type:"moveTo",pt:{x:"6928",y:"34899"}},{type:"arcTo",wR:"4360",hR:"5918",stAng:"4416628",swAng:"686848"},{type:"moveTo",pt:{x:"16478",y:"39090"}},{type:"arcTo",wR:"6752",hR:"9215",stAng:"8257449",swAng:"844866"},{type:"moveTo",pt:{x:"28827",y:"34751"}},{type:"arcTo",wR:"6752",hR:"9215",stAng:"387196",swAng:"959901"},{type:"moveTo",pt:{x:"34129",y:"22954"}},{type:"arcTo",wR:"5785",hR:"7867",stAng:"-4217541",swAng:"4255042"},{type:"moveTo",pt:{x:"41798",y:"15354"}},{type:"arcTo",wR:"5333",hR:"7273",stAng:"1819082",swAng:"1665090"},{type:"moveTo",pt:{x:"38324",y:"5426"}},{type:"arcTo",wR:"4857",hR:"6595",stAng:"-824660",swAng:"891534"},{type:"moveTo",pt:{x:"29078",y:"3952"}},{type:"arcTo",wR:"4857",hR:"6595",stAng:"-8950887",swAng:"1091722"},{type:"moveTo",pt:{x:"22141",y:"4720"}},{type:"arcTo",wR:"4365",hR:"5945",stAng:"-9809656",swAng:"1061181"},{type:"moveTo",pt:{x:"14000",y:"5192"}},{type:"arcTo",wR:"6753",hR:"9190",stAng:"-4002417",swAng:"739161"},{type:"moveTo",pt:{x:"4127",y:"15789"}},{type:"arcTo",wR:"6753",hR:"9190",stAng:"9459261",swAng:"711490"}],fill:"none",extrusionOk:!1,stroke:!0,w:43200,h:43200}]},cloudCallout:{avLst:[{n:"adj1",f:"val -20833"},{n:"adj2",f:"val 62500"}],gdLst:[{n:"dxPos",f:"*/ w adj1 100000"},{n:"dyPos",f:"*/ h adj2 100000"},{n:"xPos",f:"+- hc dxPos 0"},{n:"yPos",f:"+- vc dyPos 0"},{n:"ht",f:"cat2 hd2 dxPos dyPos"},{n:"wt",f:"sat2 wd2 dxPos dyPos"},{n:"g2",f:"cat2 wd2 ht wt"},{n:"g3",f:"sat2 hd2 ht wt"},{n:"g4",f:"+- hc g2 0"},{n:"g5",f:"+- vc g3 0"},{n:"g6",f:"+- g4 0 xPos"},{n:"g7",f:"+- g5 0 yPos"},{n:"g8",f:"mod g6 g7 0"},{n:"g9",f:"*/ ss 6600 21600"},{n:"g10",f:"+- g8 0 g9"},{n:"g11",f:"*/ g10 1 3"},{n:"g12",f:"*/ ss 1800 21600"},{n:"g13",f:"+- g11 g12 0"},{n:"g14",f:"*/ g13 g6 g8"},{n:"g15",f:"*/ g13 g7 g8"},{n:"g16",f:"+- g14 xPos 0"},{n:"g17",f:"+- g15 yPos 0"},{n:"g18",f:"*/ ss 4800 21600"},{n:"g19",f:"*/ g11 2 1"},{n:"g20",f:"+- g18 g19 0"},{n:"g21",f:"*/ g20 g6 g8"},{n:"g22",f:"*/ g20 g7 g8"},{n:"g23",f:"+- g21 xPos 0"},{n:"g24",f:"+- g22 yPos 0"},{n:"g25",f:"*/ ss 1200 21600"},{n:"g26",f:"*/ ss 600 21600"},{n:"x23",f:"+- xPos g26 0"},{n:"x24",f:"+- g16 g25 0"},{n:"x25",f:"+- g23 g12 0"},{n:"il",f:"*/ w 2977 21600"},{n:"it",f:"*/ h 3262 21600"},{n:"ir",f:"*/ w 17087 21600"},{n:"ib",f:"*/ h 17337 21600"},{n:"g27",f:"*/ w 67 21600"},{n:"g28",f:"*/ h 21577 21600"},{n:"g29",f:"*/ w 21582 21600"},{n:"g30",f:"*/ h 1235 21600"},{n:"pang",f:"at2 dxPos dyPos"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"3900",y:"14370"}},{type:"arcTo",wR:"6753",hR:"9190",stAng:"-11429249",swAng:"7426832"},{type:"arcTo",wR:"5333",hR:"7267",stAng:"-8646143",swAng:"5396714"},{type:"arcTo",wR:"4365",hR:"5945",stAng:"-8748475",swAng:"5983381"},{type:"arcTo",wR:"4857",hR:"6595",stAng:"-7859164",swAng:"7034504"},{type:"arcTo",wR:"5333",hR:"7273",stAng:"-4722533",swAng:"6541615"},{type:"arcTo",wR:"6775",hR:"9220",stAng:"-2776035",swAng:"7816140"},{type:"arcTo",wR:"5785",hR:"7867",stAng:"37501",swAng:"6842000"},{type:"arcTo",wR:"6752",hR:"9215",stAng:"1347096",swAng:"6910353"},{type:"arcTo",wR:"7720",hR:"10543",stAng:"3974558",swAng:"4542661"},{type:"arcTo",wR:"4360",hR:"5918",stAng:"-16496525",swAng:"8804134"},{type:"arcTo",wR:"4345",hR:"5945",stAng:"-14809710",swAng:"9151131"},{type:"close"}],extrusionOk:!1,stroke:!0,w:43200,h:43200},{defines:[{type:"moveTo",pt:{x:"x23",y:"yPos"}},{type:"arcTo",wR:"g26",hR:"g26",stAng:"0",swAng:"21600000"},{type:"close"}],extrusionOk:!1,stroke:!0},{defines:[{type:"moveTo",pt:{x:"x24",y:"g17"}},{type:"arcTo",wR:"g25",hR:"g25",stAng:"0",swAng:"21600000"},{type:"close"}],extrusionOk:!1,stroke:!0},{defines:[{type:"moveTo",pt:{x:"x25",y:"g24"}},{type:"arcTo",wR:"g12",hR:"g12",stAng:"0",swAng:"21600000"},{type:"close"}],extrusionOk:!1,stroke:!0},{defines:[{type:"moveTo",pt:{x:"4693",y:"26177"}},{type:"arcTo",wR:"4345",hR:"5945",stAng:"5204520",swAng:"1585770"},{type:"moveTo",pt:{x:"6928",y:"34899"}},{type:"arcTo",wR:"4360",hR:"5918",stAng:"4416628",swAng:"686848"},{type:"moveTo",pt:{x:"16478",y:"39090"}},{type:"arcTo",wR:"6752",hR:"9215",stAng:"8257449",swAng:"844866"},{type:"moveTo",pt:{x:"28827",y:"34751"}},{type:"arcTo",wR:"6752",hR:"9215",stAng:"387196",swAng:"959901"},{type:"moveTo",pt:{x:"34129",y:"22954"}},{type:"arcTo",wR:"5785",hR:"7867",stAng:"-4217541",swAng:"4255042"},{type:"moveTo",pt:{x:"41798",y:"15354"}},{type:"arcTo",wR:"5333",hR:"7273",stAng:"1819082",swAng:"1665090"},{type:"moveTo",pt:{x:"38324",y:"5426"}},{type:"arcTo",wR:"4857",hR:"6595",stAng:"-824660",swAng:"891534"},{type:"moveTo",pt:{x:"29078",y:"3952"}},{type:"arcTo",wR:"4857",hR:"6595",stAng:"-8950887",swAng:"1091722"},{type:"moveTo",pt:{x:"22141",y:"4720"}},{type:"arcTo",wR:"4365",hR:"5945",stAng:"-9809656",swAng:"1061181"},{type:"moveTo",pt:{x:"14000",y:"5192"}},{type:"arcTo",wR:"6753",hR:"9190",stAng:"-4002417",swAng:"739161"},{type:"moveTo",pt:{x:"4127",y:"15789"}},{type:"arcTo",wR:"6753",hR:"9190",stAng:"9459261",swAng:"711490"}],fill:"none",extrusionOk:!1,stroke:!0,w:43200,h:43200}]},corner:{avLst:[{n:"adj1",f:"val 50000"},{n:"adj2",f:"val 50000"}],gdLst:[{n:"maxAdj1",f:"*/ 100000 h ss"},{n:"maxAdj2",f:"*/ 100000 w ss"},{n:"a1",f:"pin 0 adj1 maxAdj1"},{n:"a2",f:"pin 0 adj2 maxAdj2"},{n:"x1",f:"*/ ss a2 100000"},{n:"dy1",f:"*/ ss a1 100000"},{n:"y1",f:"+- b 0 dy1"},{n:"cx1",f:"*/ x1 1 2"},{n:"cy1",f:"+/ y1 b 2"},{n:"d",f:"+- w 0 h"},{n:"it",f:"?: d y1 t"},{n:"ir",f:"?: d r x1"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"x1",y:"t"}},{type:"lnTo",pt:{x:"x1",y:"y1"}},{type:"lnTo",pt:{x:"r",y:"y1"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},cornerTabs:{gdLst:[{n:"md",f:"mod w h 0"},{n:"dx",f:"*/ 1 md 20"},{n:"y1",f:"+- 0 b dx"},{n:"x1",f:"+- 0 r dx"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"dx",y:"t"}},{type:"lnTo",pt:{x:"l",y:"dx"}},{type:"close"}],extrusionOk:!1,stroke:!0},{defines:[{type:"moveTo",pt:{x:"l",y:"y1"}},{type:"lnTo",pt:{x:"dx",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!0},{defines:[{type:"moveTo",pt:{x:"x1",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"dx"}},{type:"close"}],extrusionOk:!1,stroke:!0},{defines:[{type:"moveTo",pt:{x:"r",y:"y1"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"x1",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},cube:{avLst:[{n:"adj",f:"val 25000"}],gdLst:[{n:"a",f:"pin 0 adj 100000"},{n:"y1",f:"*/ ss a 100000"},{n:"y4",f:"+- b 0 y1"},{n:"y2",f:"*/ y4 1 2"},{n:"y3",f:"+/ y1 b 2"},{n:"x4",f:"+- r 0 y1"},{n:"x2",f:"*/ x4 1 2"},{n:"x3",f:"+/ y1 r 2"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"y1"}},{type:"lnTo",pt:{x:"x4",y:"y1"}},{type:"lnTo",pt:{x:"x4",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"x4",y:"y1"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"y4"}},{type:"lnTo",pt:{x:"x4",y:"b"}},{type:"close"}],fill:"darkenLess",extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"l",y:"y1"}},{type:"lnTo",pt:{x:"y1",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"x4",y:"y1"}},{type:"close"}],fill:"lightenLess",extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"l",y:"y1"}},{type:"lnTo",pt:{x:"y1",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"y4"}},{type:"lnTo",pt:{x:"x4",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"},{type:"moveTo",pt:{x:"l",y:"y1"}},{type:"lnTo",pt:{x:"x4",y:"y1"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"moveTo",pt:{x:"x4",y:"y1"}},{type:"lnTo",pt:{x:"x4",y:"b"}}],fill:"none",extrusionOk:!1,stroke:!0}]},curvedConnector2:{pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"cubicBezTo",pts:[{x:"wd2",y:"t"},{x:"r",y:"hd2"},{x:"r",y:"b"}]}],fill:"none",extrusionOk:!1,stroke:!0}]},curvedConnector3:{avLst:[{n:"adj1",f:"val 50000"}],gdLst:[{n:"x2",f:"*/ w adj1 100000"},{n:"x1",f:"+/ l x2 2"},{n:"x3",f:"+/ r x2 2"},{n:"y3",f:"*/ h 3 4"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"cubicBezTo",pts:[{x:"x1",y:"t"},{x:"x2",y:"hd4"},{x:"x2",y:"vc"}]},{type:"cubicBezTo",pts:[{x:"x2",y:"y3"},{x:"x3",y:"b"},{x:"r",y:"b"}]}],fill:"none",extrusionOk:!1,stroke:!0}]},curvedConnector4:{avLst:[{n:"adj1",f:"val 50000"},{n:"adj2",f:"val 50000"}],gdLst:[{n:"x2",f:"*/ w adj1 100000"},{n:"x1",f:"+/ l x2 2"},{n:"x3",f:"+/ r x2 2"},{n:"x4",f:"+/ x2 x3 2"},{n:"x5",f:"+/ x3 r 2"},{n:"y4",f:"*/ h adj2 100000"},{n:"y1",f:"+/ t y4 2"},{n:"y2",f:"+/ t y1 2"},{n:"y3",f:"+/ y1 y4 2"},{n:"y5",f:"+/ b y4 2"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"cubicBezTo",pts:[{x:"x1",y:"t"},{x:"x2",y:"y2"},{x:"x2",y:"y1"}]},{type:"cubicBezTo",pts:[{x:"x2",y:"y3"},{x:"x4",y:"y4"},{x:"x3",y:"y4"}]},{type:"cubicBezTo",pts:[{x:"x5",y:"y4"},{x:"r",y:"y5"},{x:"r",y:"b"}]}],fill:"none",extrusionOk:!1,stroke:!0}]},curvedConnector5:{avLst:[{n:"adj1",f:"val 50000"},{n:"adj2",f:"val 50000"},{n:"adj3",f:"val 50000"}],gdLst:[{n:"x3",f:"*/ w adj1 100000"},{n:"x6",f:"*/ w adj3 100000"},{n:"x1",f:"+/ x3 x6 2"},{n:"x2",f:"+/ l x3 2"},{n:"x4",f:"+/ x3 x1 2"},{n:"x5",f:"+/ x6 x1 2"},{n:"x7",f:"+/ x6 r 2"},{n:"y4",f:"*/ h adj2 100000"},{n:"y1",f:"+/ t y4 2"},{n:"y2",f:"+/ t y1 2"},{n:"y3",f:"+/ y1 y4 2"},{n:"y5",f:"+/ b y4 2"},{n:"y6",f:"+/ y5 y4 2"},{n:"y7",f:"+/ y5 b 2"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"cubicBezTo",pts:[{x:"x2",y:"t"},{x:"x3",y:"y2"},{x:"x3",y:"y1"}]},{type:"cubicBezTo",pts:[{x:"x3",y:"y3"},{x:"x4",y:"y4"},{x:"x1",y:"y4"}]},{type:"cubicBezTo",pts:[{x:"x5",y:"y4"},{x:"x6",y:"y6"},{x:"x6",y:"y5"}]},{type:"cubicBezTo",pts:[{x:"x6",y:"y7"},{x:"x7",y:"b"},{x:"r",y:"b"}]}],fill:"none",extrusionOk:!1,stroke:!0}]},curvedDownArrow:{avLst:[{n:"adj1",f:"val 25000"},{n:"adj2",f:"val 50000"},{n:"adj3",f:"val 25000"}],gdLst:[{n:"maxAdj2",f:"*/ 50000 w ss"},{n:"a2",f:"pin 0 adj2 maxAdj2"},{n:"a1",f:"pin 0 adj1 100000"},{n:"th",f:"*/ ss a1 100000"},{n:"aw",f:"*/ ss a2 100000"},{n:"q1",f:"+/ th aw 4"},{n:"wR",f:"+- wd2 0 q1"},{n:"q7",f:"*/ wR 2 1"},{n:"q8",f:"*/ q7 q7 1"},{n:"q9",f:"*/ th th 1"},{n:"q10",f:"+- q8 0 q9"},{n:"q11",f:"sqrt q10"},{n:"idy",f:"*/ q11 h q7"},{n:"maxAdj3",f:"*/ 100000 idy ss"},{n:"a3",f:"pin 0 adj3 maxAdj3"},{n:"ah",f:"*/ ss adj3 100000"},{n:"x3",f:"+- wR th 0"},{n:"q2",f:"*/ h h 1"},{n:"q3",f:"*/ ah ah 1"},{n:"q4",f:"+- q2 0 q3"},{n:"q5",f:"sqrt q4"},{n:"dx",f:"*/ q5 wR h"},{n:"x5",f:"+- wR dx 0"},{n:"x7",f:"+- x3 dx 0"},{n:"q6",f:"+- aw 0 th"},{n:"dh",f:"*/ q6 1 2"},{n:"x4",f:"+- x5 0 dh"},{n:"x8",f:"+- x7 dh 0"},{n:"aw2",f:"*/ aw 1 2"},{n:"x6",f:"+- r 0 aw2"},{n:"y1",f:"+- b 0 ah"},{n:"swAng",f:"at2 ah dx"},{n:"mswAng",f:"+- 0 0 swAng"},{n:"iy",f:"+- b 0 idy"},{n:"ix",f:"+/ wR x3 2"},{n:"q12",f:"*/ th 1 2"},{n:"dang2",f:"at2 idy q12"},{n:"stAng",f:"+- 3cd4 swAng 0"},{n:"stAng2",f:"+- 3cd4 0 dang2"},{n:"swAng2",f:"+- dang2 0 cd4"},{n:"swAng3",f:"+- cd4 dang2 0"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"x6",y:"b"}},{type:"lnTo",pt:{x:"x4",y:"y1"}},{type:"lnTo",pt:{x:"x5",y:"y1"}},{type:"arcTo",wR:"wR",hR:"h",stAng:"stAng",swAng:"mswAng"},{type:"lnTo",pt:{x:"x3",y:"t"}},{type:"arcTo",wR:"wR",hR:"h",stAng:"3cd4",swAng:"swAng"},{type:"lnTo",pt:{x:"x8",y:"y1"}},{type:"close"}],extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"ix",y:"iy"}},{type:"arcTo",wR:"wR",hR:"h",stAng:"stAng2",swAng:"swAng2"},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"arcTo",wR:"wR",hR:"h",stAng:"cd2",swAng:"swAng3"},{type:"close"}],fill:"darkenLess",extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"ix",y:"iy"}},{type:"arcTo",wR:"wR",hR:"h",stAng:"stAng2",swAng:"swAng2"},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"arcTo",wR:"wR",hR:"h",stAng:"cd2",swAng:"cd4"},{type:"lnTo",pt:{x:"x3",y:"t"}},{type:"arcTo",wR:"wR",hR:"h",stAng:"3cd4",swAng:"swAng"},{type:"lnTo",pt:{x:"x8",y:"y1"}},{type:"lnTo",pt:{x:"x6",y:"b"}},{type:"lnTo",pt:{x:"x4",y:"y1"}},{type:"lnTo",pt:{x:"x5",y:"y1"}},{type:"arcTo",wR:"wR",hR:"h",stAng:"stAng",swAng:"mswAng"}],fill:"none",extrusionOk:!1,stroke:!0}]},curvedLeftArrow:{avLst:[{n:"adj1",f:"val 25000"},{n:"adj2",f:"val 50000"},{n:"adj3",f:"val 25000"}],gdLst:[{n:"maxAdj2",f:"*/ 50000 h ss"},{n:"a2",f:"pin 0 adj2 maxAdj2"},{n:"a1",f:"pin 0 adj1 a2"},{n:"th",f:"*/ ss a1 100000"},{n:"aw",f:"*/ ss a2 100000"},{n:"q1",f:"+/ th aw 4"},{n:"hR",f:"+- hd2 0 q1"},{n:"q7",f:"*/ hR 2 1"},{n:"q8",f:"*/ q7 q7 1"},{n:"q9",f:"*/ th th 1"},{n:"q10",f:"+- q8 0 q9"},{n:"q11",f:"sqrt q10"},{n:"idx",f:"*/ q11 w q7"},{n:"maxAdj3",f:"*/ 100000 idx ss"},{n:"a3",f:"pin 0 adj3 maxAdj3"},{n:"ah",f:"*/ ss a3 100000"},{n:"y3",f:"+- hR th 0"},{n:"q2",f:"*/ w w 1"},{n:"q3",f:"*/ ah ah 1"},{n:"q4",f:"+- q2 0 q3"},{n:"q5",f:"sqrt q4"},{n:"dy",f:"*/ q5 hR w"},{n:"y5",f:"+- hR dy 0"},{n:"y7",f:"+- y3 dy 0"},{n:"q6",f:"+- aw 0 th"},{n:"dh",f:"*/ q6 1 2"},{n:"y4",f:"+- y5 0 dh"},{n:"y8",f:"+- y7 dh 0"},{n:"aw2",f:"*/ aw 1 2"},{n:"y6",f:"+- b 0 aw2"},{n:"x1",f:"+- l ah 0"},{n:"swAng",f:"at2 ah dy"},{n:"mswAng",f:"+- 0 0 swAng"},{n:"ix",f:"+- l idx 0"},{n:"iy",f:"+/ hR y3 2"},{n:"q12",f:"*/ th 1 2"},{n:"dang2",f:"at2 idx q12"},{n:"swAng2",f:"+- dang2 0 swAng"},{n:"swAng3",f:"+- swAng dang2 0"},{n:"stAng3",f:"+- 0 0 dang2"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"y6"}},{type:"lnTo",pt:{x:"x1",y:"y4"}},{type:"lnTo",pt:{x:"x1",y:"y5"}},{type:"arcTo",wR:"w",hR:"hR",stAng:"swAng",swAng:"swAng2"},{type:"arcTo",wR:"w",hR:"hR",stAng:"stAng3",swAng:"swAng3"},{type:"lnTo",pt:{x:"x1",y:"y8"}},{type:"close"}],extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"r",y:"y3"}},{type:"arcTo",wR:"w",hR:"hR",stAng:"0",swAng:"-5400000"},{type:"lnTo",pt:{x:"l",y:"t"}},{type:"arcTo",wR:"w",hR:"hR",stAng:"3cd4",swAng:"cd4"},{type:"close"}],fill:"darkenLess",extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"r",y:"y3"}},{type:"arcTo",wR:"w",hR:"hR",stAng:"0",swAng:"-5400000"},{type:"lnTo",pt:{x:"l",y:"t"}},{type:"arcTo",wR:"w",hR:"hR",stAng:"3cd4",swAng:"cd4"},{type:"lnTo",pt:{x:"r",y:"y3"}},{type:"arcTo",wR:"w",hR:"hR",stAng:"0",swAng:"swAng"},{type:"lnTo",pt:{x:"x1",y:"y8"}},{type:"lnTo",pt:{x:"l",y:"y6"}},{type:"lnTo",pt:{x:"x1",y:"y4"}},{type:"lnTo",pt:{x:"x1",y:"y5"}},{type:"arcTo",wR:"w",hR:"hR",stAng:"swAng",swAng:"swAng2"}],fill:"none",extrusionOk:!1,stroke:!0}]},curvedRightArrow:{avLst:[{n:"adj1",f:"val 25000"},{n:"adj2",f:"val 50000"},{n:"adj3",f:"val 25000"}],gdLst:[{n:"maxAdj2",f:"*/ 50000 h ss"},{n:"a2",f:"pin 0 adj2 maxAdj2"},{n:"a1",f:"pin 0 adj1 a2"},{n:"th",f:"*/ ss a1 100000"},{n:"aw",f:"*/ ss a2 100000"},{n:"q1",f:"+/ th aw 4"},{n:"hR",f:"+- hd2 0 q1"},{n:"q7",f:"*/ hR 2 1"},{n:"q8",f:"*/ q7 q7 1"},{n:"q9",f:"*/ th th 1"},{n:"q10",f:"+- q8 0 q9"},{n:"q11",f:"sqrt q10"},{n:"idx",f:"*/ q11 w q7"},{n:"maxAdj3",f:"*/ 100000 idx ss"},{n:"a3",f:"pin 0 adj3 maxAdj3"},{n:"ah",f:"*/ ss a3 100000"},{n:"y3",f:"+- hR th 0"},{n:"q2",f:"*/ w w 1"},{n:"q3",f:"*/ ah ah 1"},{n:"q4",f:"+- q2 0 q3"},{n:"q5",f:"sqrt q4"},{n:"dy",f:"*/ q5 hR w"},{n:"y5",f:"+- hR dy 0"},{n:"y7",f:"+- y3 dy 0"},{n:"q6",f:"+- aw 0 th"},{n:"dh",f:"*/ q6 1 2"},{n:"y4",f:"+- y5 0 dh"},{n:"y8",f:"+- y7 dh 0"},{n:"aw2",f:"*/ aw 1 2"},{n:"y6",f:"+- b 0 aw2"},{n:"x1",f:"+- r 0 ah"},{n:"swAng",f:"at2 ah dy"},{n:"stAng",f:"+- cd2 0 swAng"},{n:"mswAng",f:"+- 0 0 swAng"},{n:"ix",f:"+- r 0 idx"},{n:"iy",f:"+/ hR y3 2"},{n:"q12",f:"*/ th 1 2"},{n:"dang2",f:"at2 idx q12"},{n:"swAng2",f:"+- dang2 0 cd4"},{n:"swAng3",f:"+- cd4 dang2 0"},{n:"stAng3",f:"+- cd2 0 dang2"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"hR"}},{type:"arcTo",wR:"w",hR:"hR",stAng:"cd2",swAng:"mswAng"},{type:"lnTo",pt:{x:"x1",y:"y4"}},{type:"lnTo",pt:{x:"r",y:"y6"}},{type:"lnTo",pt:{x:"x1",y:"y8"}},{type:"lnTo",pt:{x:"x1",y:"y7"}},{type:"arcTo",wR:"w",hR:"hR",stAng:"stAng",swAng:"swAng"},{type:"close"}],extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"r",y:"th"}},{type:"arcTo",wR:"w",hR:"hR",stAng:"3cd4",swAng:"swAng2"},{type:"arcTo",wR:"w",hR:"hR",stAng:"stAng3",swAng:"swAng3"},{type:"close"}],fill:"darkenLess",extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"l",y:"hR"}},{type:"arcTo",wR:"w",hR:"hR",stAng:"cd2",swAng:"mswAng"},{type:"lnTo",pt:{x:"x1",y:"y4"}},{type:"lnTo",pt:{x:"r",y:"y6"}},{type:"lnTo",pt:{x:"x1",y:"y8"}},{type:"lnTo",pt:{x:"x1",y:"y7"}},{type:"arcTo",wR:"w",hR:"hR",stAng:"stAng",swAng:"swAng"},{type:"lnTo",pt:{x:"l",y:"hR"}},{type:"arcTo",wR:"w",hR:"hR",stAng:"cd2",swAng:"cd4"},{type:"lnTo",pt:{x:"r",y:"th"}},{type:"arcTo",wR:"w",hR:"hR",stAng:"3cd4",swAng:"swAng2"}],fill:"none",extrusionOk:!1,stroke:!0}]},curvedUpArrow:{avLst:[{n:"adj1",f:"val 25000"},{n:"adj2",f:"val 50000"},{n:"adj3",f:"val 25000"}],gdLst:[{n:"maxAdj2",f:"*/ 50000 w ss"},{n:"a2",f:"pin 0 adj2 maxAdj2"},{n:"a1",f:"pin 0 adj1 100000"},{n:"th",f:"*/ ss a1 100000"},{n:"aw",f:"*/ ss a2 100000"},{n:"q1",f:"+/ th aw 4"},{n:"wR",f:"+- wd2 0 q1"},{n:"q7",f:"*/ wR 2 1"},{n:"q8",f:"*/ q7 q7 1"},{n:"q9",f:"*/ th th 1"},{n:"q10",f:"+- q8 0 q9"},{n:"q11",f:"sqrt q10"},{n:"idy",f:"*/ q11 h q7"},{n:"maxAdj3",f:"*/ 100000 idy ss"},{n:"a3",f:"pin 0 adj3 maxAdj3"},{n:"ah",f:"*/ ss adj3 100000"},{n:"x3",f:"+- wR th 0"},{n:"q2",f:"*/ h h 1"},{n:"q3",f:"*/ ah ah 1"},{n:"q4",f:"+- q2 0 q3"},{n:"q5",f:"sqrt q4"},{n:"dx",f:"*/ q5 wR h"},{n:"x5",f:"+- wR dx 0"},{n:"x7",f:"+- x3 dx 0"},{n:"q6",f:"+- aw 0 th"},{n:"dh",f:"*/ q6 1 2"},{n:"x4",f:"+- x5 0 dh"},{n:"x8",f:"+- x7 dh 0"},{n:"aw2",f:"*/ aw 1 2"},{n:"x6",f:"+- r 0 aw2"},{n:"y1",f:"+- t ah 0"},{n:"swAng",f:"at2 ah dx"},{n:"mswAng",f:"+- 0 0 swAng"},{n:"iy",f:"+- t idy 0"},{n:"ix",f:"+/ wR x3 2"},{n:"q12",f:"*/ th 1 2"},{n:"dang2",f:"at2 idy q12"},{n:"swAng2",f:"+- dang2 0 swAng"},{n:"mswAng2",f:"+- 0 0 swAng2"},{n:"stAng3",f:"+- cd4 0 swAng"},{n:"swAng3",f:"+- swAng dang2 0"},{n:"stAng2",f:"+- cd4 0 dang2"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"x6",y:"t"}},{type:"lnTo",pt:{x:"x8",y:"y1"}},{type:"lnTo",pt:{x:"x7",y:"y1"}},{type:"arcTo",wR:"wR",hR:"h",stAng:"stAng3",swAng:"swAng3"},{type:"arcTo",wR:"wR",hR:"h",stAng:"stAng2",swAng:"swAng2"},{type:"lnTo",pt:{x:"x4",y:"y1"}},{type:"close"}],extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"wR",y:"b"}},{type:"arcTo",wR:"wR",hR:"h",stAng:"cd4",swAng:"cd4"},{type:"lnTo",pt:{x:"th",y:"t"}},{type:"arcTo",wR:"wR",hR:"h",stAng:"cd2",swAng:"-5400000"},{type:"close"}],fill:"darkenLess",extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"ix",y:"iy"}},{type:"arcTo",wR:"wR",hR:"h",stAng:"stAng2",swAng:"swAng2"},{type:"lnTo",pt:{x:"x4",y:"y1"}},{type:"lnTo",pt:{x:"x6",y:"t"}},{type:"lnTo",pt:{x:"x8",y:"y1"}},{type:"lnTo",pt:{x:"x7",y:"y1"}},{type:"arcTo",wR:"wR",hR:"h",stAng:"stAng3",swAng:"swAng"},{type:"lnTo",pt:{x:"wR",y:"b"}},{type:"arcTo",wR:"wR",hR:"h",stAng:"cd4",swAng:"cd4"},{type:"lnTo",pt:{x:"th",y:"t"}},{type:"arcTo",wR:"wR",hR:"h",stAng:"cd2",swAng:"-5400000"}],fill:"none",extrusionOk:!1,stroke:!0}]},decagon:{avLst:[{n:"vf",f:"val 105146"}],gdLst:[{n:"shd2",f:"*/ hd2 vf 100000"},{n:"dx1",f:"cos wd2 2160000"},{n:"dx2",f:"cos wd2 4320000"},{n:"x1",f:"+- hc 0 dx1"},{n:"x2",f:"+- hc 0 dx2"},{n:"x3",f:"+- hc dx2 0"},{n:"x4",f:"+- hc dx1 0"},{n:"dy1",f:"sin shd2 4320000"},{n:"dy2",f:"sin shd2 2160000"},{n:"y1",f:"+- vc 0 dy1"},{n:"y2",f:"+- vc 0 dy2"},{n:"y3",f:"+- vc dy2 0"},{n:"y4",f:"+- vc dy1 0"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"vc"}},{type:"lnTo",pt:{x:"x1",y:"y2"}},{type:"lnTo",pt:{x:"x2",y:"y1"}},{type:"lnTo",pt:{x:"x3",y:"y1"}},{type:"lnTo",pt:{x:"x4",y:"y2"}},{type:"lnTo",pt:{x:"r",y:"vc"}},{type:"lnTo",pt:{x:"x4",y:"y3"}},{type:"lnTo",pt:{x:"x3",y:"y4"}},{type:"lnTo",pt:{x:"x2",y:"y4"}},{type:"lnTo",pt:{x:"x1",y:"y3"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},diagStripe:{avLst:[{n:"adj",f:"val 50000"}],gdLst:[{n:"a",f:"pin 0 adj 100000"},{n:"x2",f:"*/ w a 100000"},{n:"x1",f:"*/ x2 1 2"},{n:"x3",f:"+/ x2 r 2"},{n:"y2",f:"*/ h a 100000"},{n:"y1",f:"*/ y2 1 2"},{n:"y3",f:"+/ y2 b 2"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"y2"}},{type:"lnTo",pt:{x:"x2",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},diamond:{gdLst:[{n:"ir",f:"*/ w 3 4"},{n:"ib",f:"*/ h 3 4"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"vc"}},{type:"lnTo",pt:{x:"hc",y:"t"}},{type:"lnTo",pt:{x:"r",y:"vc"}},{type:"lnTo",pt:{x:"hc",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},dodecagon:{gdLst:[{n:"x1",f:"*/ w 2894 21600"},{n:"x2",f:"*/ w 7906 21600"},{n:"x3",f:"*/ w 13694 21600"},{n:"x4",f:"*/ w 18706 21600"},{n:"y1",f:"*/ h 2894 21600"},{n:"y2",f:"*/ h 7906 21600"},{n:"y3",f:"*/ h 13694 21600"},{n:"y4",f:"*/ h 18706 21600"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"y2"}},{type:"lnTo",pt:{x:"x1",y:"y1"}},{type:"lnTo",pt:{x:"x2",y:"t"}},{type:"lnTo",pt:{x:"x3",y:"t"}},{type:"lnTo",pt:{x:"x4",y:"y1"}},{type:"lnTo",pt:{x:"r",y:"y2"}},{type:"lnTo",pt:{x:"r",y:"y3"}},{type:"lnTo",pt:{x:"x4",y:"y4"}},{type:"lnTo",pt:{x:"x3",y:"b"}},{type:"lnTo",pt:{x:"x2",y:"b"}},{type:"lnTo",pt:{x:"x1",y:"y4"}},{type:"lnTo",pt:{x:"l",y:"y3"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},donut:{avLst:[{n:"adj",f:"val 25000"}],gdLst:[{n:"a",f:"pin 0 adj 50000"},{n:"dr",f:"*/ ss a 100000"},{n:"iwd2",f:"+- wd2 0 dr"},{n:"ihd2",f:"+- hd2 0 dr"},{n:"idx",f:"cos wd2 2700000"},{n:"idy",f:"sin hd2 2700000"},{n:"il",f:"+- hc 0 idx"},{n:"ir",f:"+- hc idx 0"},{n:"it",f:"+- vc 0 idy"},{n:"ib",f:"+- vc idy 0"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"vc"}},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"cd2",swAng:"cd4"},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"3cd4",swAng:"cd4"},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"0",swAng:"cd4"},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"cd4",swAng:"cd4"},{type:"close"},{type:"moveTo",pt:{x:"dr",y:"vc"}},{type:"arcTo",wR:"iwd2",hR:"ihd2",stAng:"cd2",swAng:"-5400000"},{type:"arcTo",wR:"iwd2",hR:"ihd2",stAng:"cd4",swAng:"-5400000"},{type:"arcTo",wR:"iwd2",hR:"ihd2",stAng:"0",swAng:"-5400000"},{type:"arcTo",wR:"iwd2",hR:"ihd2",stAng:"3cd4",swAng:"-5400000"},{type:"close"}],extrusionOk:!1,stroke:!0}]},doubleWave:{avLst:[{n:"adj1",f:"val 6250"},{n:"adj2",f:"val 0"}],gdLst:[{n:"a1",f:"pin 0 adj1 12500"},{n:"a2",f:"pin -10000 adj2 10000"},{n:"y1",f:"*/ h a1 100000"},{n:"dy2",f:"*/ y1 10 3"},{n:"y2",f:"+- y1 0 dy2"},{n:"y3",f:"+- y1 dy2 0"},{n:"y4",f:"+- b 0 y1"},{n:"y5",f:"+- y4 0 dy2"},{n:"y6",f:"+- y4 dy2 0"},{n:"dx1",f:"*/ w a2 100000"},{n:"of2",f:"*/ w a2 50000"},{n:"x1",f:"abs dx1"},{n:"dx2",f:"?: of2 0 of2"},{n:"x2",f:"+- l 0 dx2"},{n:"dx8",f:"?: of2 of2 0"},{n:"x8",f:"+- r 0 dx8"},{n:"dx3",f:"+/ dx2 x8 6"},{n:"x3",f:"+- x2 dx3 0"},{n:"dx4",f:"+/ dx2 x8 3"},{n:"x4",f:"+- x2 dx4 0"},{n:"x5",f:"+/ x2 x8 2"},{n:"x6",f:"+- x5 dx3 0"},{n:"x7",f:"+/ x6 x8 2"},{n:"x9",f:"+- l dx8 0"},{n:"x15",f:"+- r dx2 0"},{n:"x10",f:"+- x9 dx3 0"},{n:"x11",f:"+- x9 dx4 0"},{n:"x12",f:"+/ x9 x15 2"},{n:"x13",f:"+- x12 dx3 0"},{n:"x14",f:"+/ x13 x15 2"},{n:"x16",f:"+- r 0 x1"},{n:"xAdj",f:"+- hc dx1 0"},{n:"il",f:"max x2 x9"},{n:"ir",f:"min x8 x15"},{n:"it",f:"*/ h a1 50000"},{n:"ib",f:"+- b 0 it"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"x2",y:"y1"}},{type:"cubicBezTo",pts:[{x:"x3",y:"y2"},{x:"x4",y:"y3"},{x:"x5",y:"y1"}]},{type:"cubicBezTo",pts:[{x:"x6",y:"y2"},{x:"x7",y:"y3"},{x:"x8",y:"y1"}]},{type:"lnTo",pt:{x:"x15",y:"y4"}},{type:"cubicBezTo",pts:[{x:"x14",y:"y6"},{x:"x13",y:"y5"},{x:"x12",y:"y4"}]},{type:"cubicBezTo",pts:[{x:"x11",y:"y6"},{x:"x10",y:"y5"},{x:"x9",y:"y4"}]},{type:"close"}],extrusionOk:!1,stroke:!0}]},downArrow:{avLst:[{n:"adj1",f:"val 50000"},{n:"adj2",f:"val 50000"}],gdLst:[{n:"maxAdj2",f:"*/ 100000 h ss"},{n:"a1",f:"pin 0 adj1 100000"},{n:"a2",f:"pin 0 adj2 maxAdj2"},{n:"dy1",f:"*/ ss a2 100000"},{n:"y1",f:"+- b 0 dy1"},{n:"dx1",f:"*/ w a1 200000"},{n:"x1",f:"+- hc 0 dx1"},{n:"x2",f:"+- hc dx1 0"},{n:"dy2",f:"*/ x1 dy1 wd2"},{n:"y2",f:"+- y1 dy2 0"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"y1"}},{type:"lnTo",pt:{x:"x1",y:"y1"}},{type:"lnTo",pt:{x:"x1",y:"t"}},{type:"lnTo",pt:{x:"x2",y:"t"}},{type:"lnTo",pt:{x:"x2",y:"y1"}},{type:"lnTo",pt:{x:"r",y:"y1"}},{type:"lnTo",pt:{x:"hc",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},downArrowCallout:{avLst:[{n:"adj1",f:"val 25000"},{n:"adj2",f:"val 25000"},{n:"adj3",f:"val 25000"},{n:"adj4",f:"val 64977"}],gdLst:[{n:"maxAdj2",f:"*/ 50000 w ss"},{n:"a2",f:"pin 0 adj2 maxAdj2"},{n:"maxAdj1",f:"*/ a2 2 1"},{n:"a1",f:"pin 0 adj1 maxAdj1"},{n:"maxAdj3",f:"*/ 100000 h ss"},{n:"a3",f:"pin 0 adj3 maxAdj3"},{n:"q2",f:"*/ a3 ss h"},{n:"maxAdj4",f:"+- 100000 0 q2"},{n:"a4",f:"pin 0 adj4 maxAdj4"},{n:"dx1",f:"*/ ss a2 100000"},{n:"dx2",f:"*/ ss a1 200000"},{n:"x1",f:"+- hc 0 dx1"},{n:"x2",f:"+- hc 0 dx2"},{n:"x3",f:"+- hc dx2 0"},{n:"x4",f:"+- hc dx1 0"},{n:"dy3",f:"*/ ss a3 100000"},{n:"y3",f:"+- b 0 dy3"},{n:"y2",f:"*/ h a4 100000"},{n:"y1",f:"*/ y2 1 2"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"y2"}},{type:"lnTo",pt:{x:"x3",y:"y2"}},{type:"lnTo",pt:{x:"x3",y:"y3"}},{type:"lnTo",pt:{x:"x4",y:"y3"}},{type:"lnTo",pt:{x:"hc",y:"b"}},{type:"lnTo",pt:{x:"x1",y:"y3"}},{type:"lnTo",pt:{x:"x2",y:"y3"}},{type:"lnTo",pt:{x:"x2",y:"y2"}},{type:"lnTo",pt:{x:"l",y:"y2"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},ellipse:{gdLst:[{n:"idx",f:"cos wd2 2700000"},{n:"idy",f:"sin hd2 2700000"},{n:"il",f:"+- hc 0 idx"},{n:"ir",f:"+- hc idx 0"},{n:"it",f:"+- vc 0 idy"},{n:"ib",f:"+- vc idy 0"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"vc"}},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"cd2",swAng:"cd4"},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"3cd4",swAng:"cd4"},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"0",swAng:"cd4"},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"cd4",swAng:"cd4"},{type:"close"}],extrusionOk:!1,stroke:!0}]},ellipseRibbon:{avLst:[{n:"adj1",f:"val 25000"},{n:"adj2",f:"val 50000"},{n:"adj3",f:"val 12500"}],gdLst:[{n:"a1",f:"pin 0 adj1 100000"},{n:"a2",f:"pin 25000 adj2 75000"},{n:"q10",f:"+- 100000 0 a1"},{n:"q11",f:"*/ q10 1 2"},{n:"q12",f:"+- a1 0 q11"},{n:"minAdj3",f:"max 0 q12"},{n:"a3",f:"pin minAdj3 adj3 a1"},{n:"dx2",f:"*/ w a2 200000"},{n:"x2",f:"+- hc 0 dx2"},{n:"x3",f:"+- x2 wd8 0"},{n:"x4",f:"+- r 0 x3"},{n:"x5",f:"+- r 0 x2"},{n:"x6",f:"+- r 0 wd8"},{n:"dy1",f:"*/ h a3 100000"},{n:"f1",f:"*/ 4 dy1 w"},{n:"q1",f:"*/ x3 x3 w"},{n:"q2",f:"+- x3 0 q1"},{n:"y1",f:"*/ f1 q2 1"},{n:"cx1",f:"*/ x3 1 2"},{n:"cy1",f:"*/ f1 cx1 1"},{n:"cx2",f:"+- r 0 cx1"},{n:"q1",f:"*/ h a1 100000"},{n:"dy3",f:"+- q1 0 dy1"},{n:"q3",f:"*/ x2 x2 w"},{n:"q4",f:"+- x2 0 q3"},{n:"q5",f:"*/ f1 q4 1"},{n:"y3",f:"+- q5 dy3 0"},{n:"q6",f:"+- dy1 dy3 y3"},{n:"q7",f:"+- q6 dy1 0"},{n:"cy3",f:"+- q7 dy3 0"},{n:"rh",f:"+- b 0 q1"},{n:"q8",f:"*/ dy1 14 16"},{n:"y2",f:"+/ q8 rh 2"},{n:"y5",f:"+- q5 rh 0"},{n:"y6",f:"+- y3 rh 0"},{n:"cx4",f:"*/ x2 1 2"},{n:"q9",f:"*/ f1 cx4 1"},{n:"cy4",f:"+- q9 rh 0"},{n:"cx5",f:"+- r 0 cx4"},{n:"cy6",f:"+- cy3 rh 0"},{n:"y7",f:"+- y1 dy3 0"},{n:"cy7",f:"+- q1 q1 y7"},{n:"y8",f:"+- b 0 dy1"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"quadBezTo",pts:[{x:"cx1",y:"cy1"},{x:"x3",y:"y1"}]},{type:"lnTo",pt:{x:"x2",y:"y3"}},{type:"quadBezTo",pts:[{x:"hc",y:"cy3"},{x:"x5",y:"y3"}]},{type:"lnTo",pt:{x:"x4",y:"y1"}},{type:"quadBezTo",pts:[{x:"cx2",y:"cy1"},{x:"r",y:"t"}]},{type:"lnTo",pt:{x:"x6",y:"y2"}},{type:"lnTo",pt:{x:"r",y:"rh"}},{type:"quadBezTo",pts:[{x:"cx5",y:"cy4"},{x:"x5",y:"y5"}]},{type:"lnTo",pt:{x:"x5",y:"y6"}},{type:"quadBezTo",pts:[{x:"hc",y:"cy6"},{x:"x2",y:"y6"}]},{type:"lnTo",pt:{x:"x2",y:"y5"}},{type:"quadBezTo",pts:[{x:"cx4",y:"cy4"},{x:"l",y:"rh"}]},{type:"lnTo",pt:{x:"wd8",y:"y2"}},{type:"close"}],extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"x3",y:"y7"}},{type:"lnTo",pt:{x:"x3",y:"y1"}},{type:"lnTo",pt:{x:"x2",y:"y3"}},{type:"quadBezTo",pts:[{x:"hc",y:"cy3"},{x:"x5",y:"y3"}]},{type:"lnTo",pt:{x:"x4",y:"y1"}},{type:"lnTo",pt:{x:"x4",y:"y7"}},{type:"quadBezTo",pts:[{x:"hc",y:"cy7"},{x:"x3",y:"y7"}]},{type:"close"}],fill:"darkenLess",extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"quadBezTo",pts:[{x:"cx1",y:"cy1"},{x:"x3",y:"y1"}]},{type:"lnTo",pt:{x:"x2",y:"y3"}},{type:"quadBezTo",pts:[{x:"hc",y:"cy3"},{x:"x5",y:"y3"}]},{type:"lnTo",pt:{x:"x4",y:"y1"}},{type:"quadBezTo",pts:[{x:"cx2",y:"cy1"},{x:"r",y:"t"}]},{type:"lnTo",pt:{x:"x6",y:"y2"}},{type:"lnTo",pt:{x:"r",y:"rh"}},{type:"quadBezTo",pts:[{x:"cx5",y:"cy4"},{x:"x5",y:"y5"}]},{type:"lnTo",pt:{x:"x5",y:"y6"}},{type:"quadBezTo",pts:[{x:"hc",y:"cy6"},{x:"x2",y:"y6"}]},{type:"lnTo",pt:{x:"x2",y:"y5"}},{type:"quadBezTo",pts:[{x:"cx4",y:"cy4"},{x:"l",y:"rh"}]},{type:"lnTo",pt:{x:"wd8",y:"y2"}},{type:"close"},{type:"moveTo",pt:{x:"x2",y:"y5"}},{type:"lnTo",pt:{x:"x2",y:"y3"}},{type:"moveTo",pt:{x:"x5",y:"y3"}},{type:"lnTo",pt:{x:"x5",y:"y5"}},{type:"moveTo",pt:{x:"x3",y:"y1"}},{type:"lnTo",pt:{x:"x3",y:"y7"}},{type:"moveTo",pt:{x:"x4",y:"y7"}},{type:"lnTo",pt:{x:"x4",y:"y1"}}],fill:"none",extrusionOk:!1,stroke:!0}]},ellipseRibbon2:{avLst:[{n:"adj1",f:"val 25000"},{n:"adj2",f:"val 50000"},{n:"adj3",f:"val 12500"}],gdLst:[{n:"a1",f:"pin 0 adj1 100000"},{n:"a2",f:"pin 25000 adj2 75000"},{n:"q10",f:"+- 100000 0 a1"},{n:"q11",f:"*/ q10 1 2"},{n:"q12",f:"+- a1 0 q11"},{n:"minAdj3",f:"max 0 q12"},{n:"a3",f:"pin minAdj3 adj3 a1"},{n:"dx2",f:"*/ w a2 200000"},{n:"x2",f:"+- hc 0 dx2"},{n:"x3",f:"+- x2 wd8 0"},{n:"x4",f:"+- r 0 x3"},{n:"x5",f:"+- r 0 x2"},{n:"x6",f:"+- r 0 wd8"},{n:"dy1",f:"*/ h a3 100000"},{n:"f1",f:"*/ 4 dy1 w"},{n:"q1",f:"*/ x3 x3 w"},{n:"q2",f:"+- x3 0 q1"},{n:"u1",f:"*/ f1 q2 1"},{n:"y1",f:"+- b 0 u1"},{n:"cx1",f:"*/ x3 1 2"},{n:"cu1",f:"*/ f1 cx1 1"},{n:"cy1",f:"+- b 0 cu1"},{n:"cx2",f:"+- r 0 cx1"},{n:"q1",f:"*/ h a1 100000"},{n:"dy3",f:"+- q1 0 dy1"},{n:"q3",f:"*/ x2 x2 w"},{n:"q4",f:"+- x2 0 q3"},{n:"q5",f:"*/ f1 q4 1"},{n:"u3",f:"+- q5 dy3 0"},{n:"y3",f:"+- b 0 u3"},{n:"q6",f:"+- dy1 dy3 u3"},{n:"q7",f:"+- q6 dy1 0"},{n:"cu3",f:"+- q7 dy3 0"},{n:"cy3",f:"+- b 0 cu3"},{n:"rh",f:"+- b 0 q1"},{n:"q8",f:"*/ dy1 14 16"},{n:"u2",f:"+/ q8 rh 2"},{n:"y2",f:"+- b 0 u2"},{n:"u5",f:"+- q5 rh 0"},{n:"y5",f:"+- b 0 u5"},{n:"u6",f:"+- u3 rh 0"},{n:"y6",f:"+- b 0 u6"},{n:"cx4",f:"*/ x2 1 2"},{n:"q9",f:"*/ f1 cx4 1"},{n:"cu4",f:"+- q9 rh 0"},{n:"cy4",f:"+- b 0 cu4"},{n:"cx5",f:"+- r 0 cx4"},{n:"cu6",f:"+- cu3 rh 0"},{n:"cy6",f:"+- b 0 cu6"},{n:"u7",f:"+- u1 dy3 0"},{n:"y7",f:"+- b 0 u7"},{n:"cu7",f:"+- q1 q1 u7"},{n:"cy7",f:"+- b 0 cu7"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"b"}},{type:"quadBezTo",pts:[{x:"cx1",y:"cy1"},{x:"x3",y:"y1"}]},{type:"lnTo",pt:{x:"x2",y:"y3"}},{type:"quadBezTo",pts:[{x:"hc",y:"cy3"},{x:"x5",y:"y3"}]},{type:"lnTo",pt:{x:"x4",y:"y1"}},{type:"quadBezTo",pts:[{x:"cx2",y:"cy1"},{x:"r",y:"b"}]},{type:"lnTo",pt:{x:"x6",y:"y2"}},{type:"lnTo",pt:{x:"r",y:"q1"}},{type:"quadBezTo",pts:[{x:"cx5",y:"cy4"},{x:"x5",y:"y5"}]},{type:"lnTo",pt:{x:"x5",y:"y6"}},{type:"quadBezTo",pts:[{x:"hc",y:"cy6"},{x:"x2",y:"y6"}]},{type:"lnTo",pt:{x:"x2",y:"y5"}},{type:"quadBezTo",pts:[{x:"cx4",y:"cy4"},{x:"l",y:"q1"}]},{type:"lnTo",pt:{x:"wd8",y:"y2"}},{type:"close"}],extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"x3",y:"y7"}},{type:"lnTo",pt:{x:"x3",y:"y1"}},{type:"lnTo",pt:{x:"x2",y:"y3"}},{type:"quadBezTo",pts:[{x:"hc",y:"cy3"},{x:"x5",y:"y3"}]},{type:"lnTo",pt:{x:"x4",y:"y1"}},{type:"lnTo",pt:{x:"x4",y:"y7"}},{type:"quadBezTo",pts:[{x:"hc",y:"cy7"},{x:"x3",y:"y7"}]},{type:"close"}],fill:"darkenLess",extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"l",y:"b"}},{type:"lnTo",pt:{x:"wd8",y:"y2"}},{type:"lnTo",pt:{x:"l",y:"q1"}},{type:"quadBezTo",pts:[{x:"cx4",y:"cy4"},{x:"x2",y:"y5"}]},{type:"lnTo",pt:{x:"x2",y:"y6"}},{type:"quadBezTo",pts:[{x:"hc",y:"cy6"},{x:"x5",y:"y6"}]},{type:"lnTo",pt:{x:"x5",y:"y5"}},{type:"quadBezTo",pts:[{x:"cx5",y:"cy4"},{x:"r",y:"q1"}]},{type:"lnTo",pt:{x:"x6",y:"y2"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"quadBezTo",pts:[{x:"cx2",y:"cy1"},{x:"x4",y:"y1"}]},{type:"lnTo",pt:{x:"x5",y:"y3"}},{type:"quadBezTo",pts:[{x:"hc",y:"cy3"},{x:"x2",y:"y3"}]},{type:"lnTo",pt:{x:"x3",y:"y1"}},{type:"quadBezTo",pts:[{x:"cx1",y:"cy1"},{x:"l",y:"b"}]},{type:"close"},{type:"moveTo",pt:{x:"x2",y:"y3"}},{type:"lnTo",pt:{x:"x2",y:"y5"}},{type:"moveTo",pt:{x:"x5",y:"y5"}},{type:"lnTo",pt:{x:"x5",y:"y3"}},{type:"moveTo",pt:{x:"x3",y:"y7"}},{type:"lnTo",pt:{x:"x3",y:"y1"}},{type:"moveTo",pt:{x:"x4",y:"y1"}},{type:"lnTo",pt:{x:"x4",y:"y7"}}],fill:"none",extrusionOk:!1,stroke:!0}]},flowChartAlternateProcess:{gdLst:[{n:"x2",f:"+- r 0 ssd6"},{n:"y2",f:"+- b 0 ssd6"},{n:"il",f:"*/ ssd6 29289 100000"},{n:"ir",f:"+- r 0 il"},{n:"ib",f:"+- b 0 il"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"ssd6"}},{type:"arcTo",wR:"ssd6",hR:"ssd6",stAng:"cd2",swAng:"cd4"},{type:"lnTo",pt:{x:"x2",y:"t"}},{type:"arcTo",wR:"ssd6",hR:"ssd6",stAng:"3cd4",swAng:"cd4"},{type:"lnTo",pt:{x:"r",y:"y2"}},{type:"arcTo",wR:"ssd6",hR:"ssd6",stAng:"0",swAng:"cd4"},{type:"lnTo",pt:{x:"ssd6",y:"b"}},{type:"arcTo",wR:"ssd6",hR:"ssd6",stAng:"cd4",swAng:"cd4"},{type:"close"}],extrusionOk:!1,stroke:!0}]},flowChartCollate:{gdLst:[{n:"ir",f:"*/ w 3 4"},{n:"ib",f:"*/ h 3 4"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"0",y:"0"}},{type:"lnTo",pt:{x:"2",y:"0"}},{type:"lnTo",pt:{x:"1",y:"1"}},{type:"lnTo",pt:{x:"2",y:"2"}},{type:"lnTo",pt:{x:"0",y:"2"}},{type:"lnTo",pt:{x:"1",y:"1"}},{type:"close"}],extrusionOk:!1,stroke:!0,w:2,h:2}]},flowChartConnector:{gdLst:[{n:"idx",f:"cos wd2 2700000"},{n:"idy",f:"sin hd2 2700000"},{n:"il",f:"+- hc 0 idx"},{n:"ir",f:"+- hc idx 0"},{n:"it",f:"+- vc 0 idy"},{n:"ib",f:"+- vc idy 0"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"vc"}},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"cd2",swAng:"cd4"},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"3cd4",swAng:"cd4"},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"0",swAng:"cd4"},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"cd4",swAng:"cd4"},{type:"close"}],extrusionOk:!1,stroke:!0}]},flowChartDecision:{gdLst:[{n:"ir",f:"*/ w 3 4"},{n:"ib",f:"*/ h 3 4"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"0",y:"1"}},{type:"lnTo",pt:{x:"1",y:"0"}},{type:"lnTo",pt:{x:"2",y:"1"}},{type:"lnTo",pt:{x:"1",y:"2"}},{type:"close"}],extrusionOk:!1,stroke:!0,w:2,h:2}]},flowChartDelay:{gdLst:[{n:"idx",f:"cos wd2 2700000"},{n:"idy",f:"sin hd2 2700000"},{n:"ir",f:"+- hc idx 0"},{n:"it",f:"+- vc 0 idy"},{n:"ib",f:"+- vc idy 0"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"hc",y:"t"}},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"3cd4",swAng:"cd2"},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},flowChartDisplay:{gdLst:[{n:"x2",f:"*/ w 5 6"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"0",y:"3"}},{type:"lnTo",pt:{x:"1",y:"0"}},{type:"lnTo",pt:{x:"5",y:"0"}},{type:"arcTo",wR:"1",hR:"3",stAng:"3cd4",swAng:"cd2"},{type:"lnTo",pt:{x:"1",y:"6"}},{type:"close"}],extrusionOk:!1,stroke:!0,w:6,h:6}]},flowChartDocument:{gdLst:[{n:"y1",f:"*/ h 17322 21600"},{n:"y2",f:"*/ h 20172 21600"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"0",y:"0"}},{type:"lnTo",pt:{x:"21600",y:"0"}},{type:"lnTo",pt:{x:"21600",y:"17322"}},{type:"cubicBezTo",pts:[{x:"10800",y:"17322"},{x:"10800",y:"23922"},{x:"0",y:"20172"}]},{type:"close"}],extrusionOk:!1,stroke:!0,w:21600,h:21600}]},flowChartExtract:{gdLst:[{n:"x2",f:"*/ w 3 4"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"0",y:"2"}},{type:"lnTo",pt:{x:"1",y:"0"}},{type:"lnTo",pt:{x:"2",y:"2"}},{type:"close"}],extrusionOk:!1,stroke:!0,w:2,h:2}]},flowChartInputOutput:{gdLst:[{n:"x3",f:"*/ w 2 5"},{n:"x4",f:"*/ w 3 5"},{n:"x5",f:"*/ w 4 5"},{n:"x6",f:"*/ w 9 10"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"0",y:"5"}},{type:"lnTo",pt:{x:"1",y:"0"}},{type:"lnTo",pt:{x:"5",y:"0"}},{type:"lnTo",pt:{x:"4",y:"5"}},{type:"close"}],extrusionOk:!1,stroke:!0,w:5,h:5}]},flowChartInternalStorage:{pathLst:[{defines:[{type:"moveTo",pt:{x:"0",y:"0"}},{type:"lnTo",pt:{x:"1",y:"0"}},{type:"lnTo",pt:{x:"1",y:"1"}},{type:"lnTo",pt:{x:"0",y:"1"}},{type:"close"}],extrusionOk:!1,stroke:!1,w:1,h:1},{defines:[{type:"moveTo",pt:{x:"1",y:"0"}},{type:"lnTo",pt:{x:"1",y:"8"}},{type:"moveTo",pt:{x:"0",y:"1"}},{type:"lnTo",pt:{x:"8",y:"1"}}],fill:"none",extrusionOk:!1,stroke:!0,w:8,h:8},{defines:[{type:"moveTo",pt:{x:"0",y:"0"}},{type:"lnTo",pt:{x:"1",y:"0"}},{type:"lnTo",pt:{x:"1",y:"1"}},{type:"lnTo",pt:{x:"0",y:"1"}},{type:"close"}],fill:"none",extrusionOk:!1,stroke:!0,w:1,h:1}]},flowChartMagneticDisk:{gdLst:[{n:"y3",f:"*/ h 5 6"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"0",y:"1"}},{type:"arcTo",wR:"3",hR:"1",stAng:"cd2",swAng:"cd2"},{type:"lnTo",pt:{x:"6",y:"5"}},{type:"arcTo",wR:"3",hR:"1",stAng:"0",swAng:"cd2"},{type:"close"}],extrusionOk:!1,stroke:!1,w:6,h:6},{defines:[{type:"moveTo",pt:{x:"6",y:"1"}},{type:"arcTo",wR:"3",hR:"1",stAng:"0",swAng:"cd2"}],fill:"none",extrusionOk:!1,stroke:!0,w:6,h:6},{defines:[{type:"moveTo",pt:{x:"0",y:"1"}},{type:"arcTo",wR:"3",hR:"1",stAng:"cd2",swAng:"cd2"},{type:"lnTo",pt:{x:"6",y:"5"}},{type:"arcTo",wR:"3",hR:"1",stAng:"0",swAng:"cd2"},{type:"close"}],fill:"none",extrusionOk:!1,stroke:!0,w:6,h:6}]},flowChartMagneticDrum:{gdLst:[{n:"x2",f:"*/ w 2 3"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"1",y:"0"}},{type:"lnTo",pt:{x:"5",y:"0"}},{type:"arcTo",wR:"1",hR:"3",stAng:"3cd4",swAng:"cd2"},{type:"lnTo",pt:{x:"1",y:"6"}},{type:"arcTo",wR:"1",hR:"3",stAng:"cd4",swAng:"cd2"},{type:"close"}],extrusionOk:!1,stroke:!1,w:6,h:6},{defines:[{type:"moveTo",pt:{x:"5",y:"6"}},{type:"arcTo",wR:"1",hR:"3",stAng:"cd4",swAng:"cd2"}],fill:"none",extrusionOk:!1,stroke:!0,w:6,h:6},{defines:[{type:"moveTo",pt:{x:"1",y:"0"}},{type:"lnTo",pt:{x:"5",y:"0"}},{type:"arcTo",wR:"1",hR:"3",stAng:"3cd4",swAng:"cd2"},{type:"lnTo",pt:{x:"1",y:"6"}},{type:"arcTo",wR:"1",hR:"3",stAng:"cd4",swAng:"cd2"},{type:"close"}],fill:"none",extrusionOk:!1,stroke:!0,w:6,h:6}]},flowChartMagneticTape:{gdLst:[{n:"idx",f:"cos wd2 2700000"},{n:"idy",f:"sin hd2 2700000"},{n:"il",f:"+- hc 0 idx"},{n:"ir",f:"+- hc idx 0"},{n:"it",f:"+- vc 0 idy"},{n:"ib",f:"+- vc idy 0"},{n:"ang1",f:"at2 w h"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"hc",y:"b"}},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"cd4",swAng:"cd4"},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"cd2",swAng:"cd4"},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"3cd4",swAng:"cd4"},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"0",swAng:"ang1"},{type:"lnTo",pt:{x:"r",y:"ib"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},flowChartManualInput:{pathLst:[{defines:[{type:"moveTo",pt:{x:"0",y:"1"}},{type:"lnTo",pt:{x:"5",y:"0"}},{type:"lnTo",pt:{x:"5",y:"5"}},{type:"lnTo",pt:{x:"0",y:"5"}},{type:"close"}],extrusionOk:!1,stroke:!0,w:5,h:5}]},flowChartManualOperation:{gdLst:[{n:"x3",f:"*/ w 4 5"},{n:"x4",f:"*/ w 9 10"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"0",y:"0"}},{type:"lnTo",pt:{x:"5",y:"0"}},{type:"lnTo",pt:{x:"4",y:"5"}},{type:"lnTo",pt:{x:"1",y:"5"}},{type:"close"}],extrusionOk:!1,stroke:!0,w:5,h:5}]},flowChartMerge:{gdLst:[{n:"x2",f:"*/ w 3 4"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"0",y:"0"}},{type:"lnTo",pt:{x:"2",y:"0"}},{type:"lnTo",pt:{x:"1",y:"2"}},{type:"close"}],extrusionOk:!1,stroke:!0,w:2,h:2}]},flowChartMultidocument:{gdLst:[{n:"y2",f:"*/ h 3675 21600"},{n:"y8",f:"*/ h 20782 21600"},{n:"x3",f:"*/ w 9298 21600"},{n:"x4",f:"*/ w 12286 21600"},{n:"x5",f:"*/ w 18595 21600"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"0",y:"20782"}},{type:"cubicBezTo",pts:[{x:"9298",y:"23542"},{x:"9298",y:"18022"},{x:"18595",y:"18022"}]},{type:"lnTo",pt:{x:"18595",y:"3675"}},{type:"lnTo",pt:{x:"0",y:"3675"}},{type:"close"},{type:"moveTo",pt:{x:"1532",y:"3675"}},{type:"lnTo",pt:{x:"1532",y:"1815"}},{type:"lnTo",pt:{x:"20000",y:"1815"}},{type:"lnTo",pt:{x:"20000",y:"16252"}},{type:"cubicBezTo",pts:[{x:"19298",y:"16252"},{x:"18595",y:"16352"},{x:"18595",y:"16352"}]},{type:"lnTo",pt:{x:"18595",y:"3675"}},{type:"close"},{type:"moveTo",pt:{x:"2972",y:"1815"}},{type:"lnTo",pt:{x:"2972",y:"0"}},{type:"lnTo",pt:{x:"21600",y:"0"}},{type:"lnTo",pt:{x:"21600",y:"14392"}},{type:"cubicBezTo",pts:[{x:"20800",y:"14392"},{x:"20000",y:"14467"},{x:"20000",y:"14467"}]},{type:"lnTo",pt:{x:"20000",y:"1815"}},{type:"close"}],extrusionOk:!1,stroke:!1,w:21600,h:21600},{defines:[{type:"moveTo",pt:{x:"0",y:"3675"}},{type:"lnTo",pt:{x:"18595",y:"3675"}},{type:"lnTo",pt:{x:"18595",y:"18022"}},{type:"cubicBezTo",pts:[{x:"9298",y:"18022"},{x:"9298",y:"23542"},{x:"0",y:"20782"}]},{type:"close"},{type:"moveTo",pt:{x:"1532",y:"3675"}},{type:"lnTo",pt:{x:"1532",y:"1815"}},{type:"lnTo",pt:{x:"20000",y:"1815"}},{type:"lnTo",pt:{x:"20000",y:"16252"}},{type:"cubicBezTo",pts:[{x:"19298",y:"16252"},{x:"18595",y:"16352"},{x:"18595",y:"16352"}]},{type:"moveTo",pt:{x:"2972",y:"1815"}},{type:"lnTo",pt:{x:"2972",y:"0"}},{type:"lnTo",pt:{x:"21600",y:"0"}},{type:"lnTo",pt:{x:"21600",y:"14392"}},{type:"cubicBezTo",pts:[{x:"20800",y:"14392"},{x:"20000",y:"14467"},{x:"20000",y:"14467"}]}],fill:"none",extrusionOk:!1,stroke:!0,w:21600,h:21600},{defines:[{type:"moveTo",pt:{x:"0",y:"20782"}},{type:"cubicBezTo",pts:[{x:"9298",y:"23542"},{x:"9298",y:"18022"},{x:"18595",y:"18022"}]},{type:"lnTo",pt:{x:"18595",y:"16352"}},{type:"cubicBezTo",pts:[{x:"18595",y:"16352"},{x:"19298",y:"16252"},{x:"20000",y:"16252"}]},{type:"lnTo",pt:{x:"20000",y:"14467"}},{type:"cubicBezTo",pts:[{x:"20000",y:"14467"},{x:"20800",y:"14392"},{x:"21600",y:"14392"}]},{type:"lnTo",pt:{x:"21600",y:"0"}},{type:"lnTo",pt:{x:"2972",y:"0"}},{type:"lnTo",pt:{x:"2972",y:"1815"}},{type:"lnTo",pt:{x:"1532",y:"1815"}},{type:"lnTo",pt:{x:"1532",y:"3675"}},{type:"lnTo",pt:{x:"0",y:"3675"}},{type:"close"}],fill:"none",extrusionOk:!1,stroke:!1,w:21600,h:21600}]},flowChartOfflineStorage:{gdLst:[{n:"x4",f:"*/ w 3 4"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"0",y:"0"}},{type:"lnTo",pt:{x:"2",y:"0"}},{type:"lnTo",pt:{x:"1",y:"2"}},{type:"close"}],extrusionOk:!1,stroke:!1,w:2,h:2},{defines:[{type:"moveTo",pt:{x:"2",y:"4"}},{type:"lnTo",pt:{x:"3",y:"4"}}],fill:"none",extrusionOk:!1,stroke:!0,w:5,h:5},{defines:[{type:"moveTo",pt:{x:"0",y:"0"}},{type:"lnTo",pt:{x:"2",y:"0"}},{type:"lnTo",pt:{x:"1",y:"2"}},{type:"close"}],fill:"none",extrusionOk:!0,stroke:!0,w:2,h:2}]},flowChartOffpageConnector:{gdLst:[{n:"y1",f:"*/ h 4 5"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"0",y:"0"}},{type:"lnTo",pt:{x:"10",y:"0"}},{type:"lnTo",pt:{x:"10",y:"8"}},{type:"lnTo",pt:{x:"5",y:"10"}},{type:"lnTo",pt:{x:"0",y:"8"}},{type:"close"}],extrusionOk:!1,stroke:!0,w:10,h:10}]},flowChartOnlineStorage:{gdLst:[{n:"x2",f:"*/ w 5 6"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"1",y:"0"}},{type:"lnTo",pt:{x:"6",y:"0"}},{type:"arcTo",wR:"1",hR:"3",stAng:"3cd4",swAng:"-10800000"},{type:"lnTo",pt:{x:"1",y:"6"}},{type:"arcTo",wR:"1",hR:"3",stAng:"cd4",swAng:"cd2"},{type:"close"}],extrusionOk:!1,stroke:!0,w:6,h:6}]},flowChartOr:{gdLst:[{n:"idx",f:"cos wd2 2700000"},{n:"idy",f:"sin hd2 2700000"},{n:"il",f:"+- hc 0 idx"},{n:"ir",f:"+- hc idx 0"},{n:"it",f:"+- vc 0 idy"},{n:"ib",f:"+- vc idy 0"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"vc"}},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"cd2",swAng:"cd4"},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"3cd4",swAng:"cd4"},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"0",swAng:"cd4"},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"cd4",swAng:"cd4"},{type:"close"}],extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"hc",y:"t"}},{type:"lnTo",pt:{x:"hc",y:"b"}},{type:"moveTo",pt:{x:"l",y:"vc"}},{type:"lnTo",pt:{x:"r",y:"vc"}}],fill:"none",extrusionOk:!1,stroke:!0},{defines:[{type:"moveTo",pt:{x:"l",y:"vc"}},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"cd2",swAng:"cd4"},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"3cd4",swAng:"cd4"},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"0",swAng:"cd4"},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"cd4",swAng:"cd4"},{type:"close"}],fill:"none",extrusionOk:!1,stroke:!0}]},flowChartPredefinedProcess:{gdLst:[{n:"x2",f:"*/ w 7 8"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"0",y:"0"}},{type:"lnTo",pt:{x:"1",y:"0"}},{type:"lnTo",pt:{x:"1",y:"1"}},{type:"lnTo",pt:{x:"0",y:"1"}},{type:"close"}],extrusionOk:!1,stroke:!1,w:1,h:1},{defines:[{type:"moveTo",pt:{x:"1",y:"0"}},{type:"lnTo",pt:{x:"1",y:"8"}},{type:"moveTo",pt:{x:"7",y:"0"}},{type:"lnTo",pt:{x:"7",y:"8"}}],fill:"none",extrusionOk:!1,stroke:!0,w:8,h:8},{defines:[{type:"moveTo",pt:{x:"0",y:"0"}},{type:"lnTo",pt:{x:"1",y:"0"}},{type:"lnTo",pt:{x:"1",y:"1"}},{type:"lnTo",pt:{x:"0",y:"1"}},{type:"close"}],fill:"none",extrusionOk:!1,stroke:!0,w:1,h:1}]},flowChartPreparation:{gdLst:[{n:"x2",f:"*/ w 4 5"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"0",y:"5"}},{type:"lnTo",pt:{x:"2",y:"0"}},{type:"lnTo",pt:{x:"8",y:"0"}},{type:"lnTo",pt:{x:"10",y:"5"}},{type:"lnTo",pt:{x:"8",y:"10"}},{type:"lnTo",pt:{x:"2",y:"10"}},{type:"close"}],extrusionOk:!1,stroke:!0,w:10,h:10}]},flowChartProcess:{pathLst:[{defines:[{type:"moveTo",pt:{x:"0",y:"0"}},{type:"lnTo",pt:{x:"1",y:"0"}},{type:"lnTo",pt:{x:"1",y:"1"}},{type:"lnTo",pt:{x:"0",y:"1"}},{type:"close"}],extrusionOk:!1,stroke:!0,w:1,h:1}]},flowChartPunchedCard:{pathLst:[{defines:[{type:"moveTo",pt:{x:"0",y:"1"}},{type:"lnTo",pt:{x:"1",y:"0"}},{type:"lnTo",pt:{x:"5",y:"0"}},{type:"lnTo",pt:{x:"5",y:"5"}},{type:"lnTo",pt:{x:"0",y:"5"}},{type:"close"}],extrusionOk:!1,stroke:!0,w:5,h:5}]},flowChartPunchedTape:{gdLst:[{n:"y2",f:"*/ h 9 10"},{n:"ib",f:"*/ h 4 5"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"0",y:"2"}},{type:"arcTo",wR:"5",hR:"2",stAng:"cd2",swAng:"-10800000"},{type:"arcTo",wR:"5",hR:"2",stAng:"cd2",swAng:"cd2"},{type:"lnTo",pt:{x:"20",y:"18"}},{type:"arcTo",wR:"5",hR:"2",stAng:"0",swAng:"-10800000"},{type:"arcTo",wR:"5",hR:"2",stAng:"0",swAng:"cd2"},{type:"close"}],extrusionOk:!1,stroke:!0,w:20,h:20}]},flowChartSort:{gdLst:[{n:"ir",f:"*/ w 3 4"},{n:"ib",f:"*/ h 3 4"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"0",y:"1"}},{type:"lnTo",pt:{x:"1",y:"0"}},{type:"lnTo",pt:{x:"2",y:"1"}},{type:"lnTo",pt:{x:"1",y:"2"}},{type:"close"}],extrusionOk:!1,stroke:!1,w:2,h:2},{defines:[{type:"moveTo",pt:{x:"0",y:"1"}},{type:"lnTo",pt:{x:"2",y:"1"}}],fill:"none",extrusionOk:!1,stroke:!0,w:2,h:2},{defines:[{type:"moveTo",pt:{x:"0",y:"1"}},{type:"lnTo",pt:{x:"1",y:"0"}},{type:"lnTo",pt:{x:"2",y:"1"}},{type:"lnTo",pt:{x:"1",y:"2"}},{type:"close"}],fill:"none",extrusionOk:!1,stroke:!0,w:2,h:2}]},flowChartSummingJunction:{gdLst:[{n:"idx",f:"cos wd2 2700000"},{n:"idy",f:"sin hd2 2700000"},{n:"il",f:"+- hc 0 idx"},{n:"ir",f:"+- hc idx 0"},{n:"it",f:"+- vc 0 idy"},{n:"ib",f:"+- vc idy 0"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"vc"}},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"cd2",swAng:"cd4"},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"3cd4",swAng:"cd4"},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"0",swAng:"cd4"},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"cd4",swAng:"cd4"},{type:"close"}],extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"il",y:"it"}},{type:"lnTo",pt:{x:"ir",y:"ib"}},{type:"moveTo",pt:{x:"ir",y:"it"}},{type:"lnTo",pt:{x:"il",y:"ib"}}],fill:"none",extrusionOk:!1,stroke:!0},{defines:[{type:"moveTo",pt:{x:"l",y:"vc"}},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"cd2",swAng:"cd4"},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"3cd4",swAng:"cd4"},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"0",swAng:"cd4"},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"cd4",swAng:"cd4"},{type:"close"}],fill:"none",extrusionOk:!1,stroke:!0}]},flowChartTerminator:{gdLst:[{n:"il",f:"*/ w 1018 21600"},{n:"ir",f:"*/ w 20582 21600"},{n:"it",f:"*/ h 3163 21600"},{n:"ib",f:"*/ h 18437 21600"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"3475",y:"0"}},{type:"lnTo",pt:{x:"18125",y:"0"}},{type:"arcTo",wR:"3475",hR:"10800",stAng:"3cd4",swAng:"cd2"},{type:"lnTo",pt:{x:"3475",y:"21600"}},{type:"arcTo",wR:"3475",hR:"10800",stAng:"cd4",swAng:"cd2"},{type:"close"}],extrusionOk:!1,stroke:!0,w:21600,h:21600}]},foldedCorner:{avLst:[{n:"adj",f:"val 16667"}],gdLst:[{n:"a",f:"pin 0 adj 50000"},{n:"dy2",f:"*/ ss a 100000"},{n:"dy1",f:"*/ dy2 1 5"},{n:"x1",f:"+- r 0 dy2"},{n:"x2",f:"+- x1 dy1 0"},{n:"y2",f:"+- b 0 dy2"},{n:"y1",f:"+- y2 dy1 0"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"y2"}},{type:"lnTo",pt:{x:"x1",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"x1",y:"b"}},{type:"lnTo",pt:{x:"x2",y:"y1"}},{type:"lnTo",pt:{x:"r",y:"y2"}},{type:"close"}],fill:"darkenLess",extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"x1",y:"b"}},{type:"lnTo",pt:{x:"x2",y:"y1"}},{type:"lnTo",pt:{x:"r",y:"y2"}},{type:"lnTo",pt:{x:"x1",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"lnTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"y2"}}],fill:"none",extrusionOk:!1,stroke:!0}]},frame:{avLst:[{n:"adj1",f:"val 12500"}],gdLst:[{n:"a1",f:"pin 0 adj1 50000"},{n:"x1",f:"*/ ss a1 100000"},{n:"x4",f:"+- r 0 x1"},{n:"y4",f:"+- b 0 x1"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"},{type:"moveTo",pt:{x:"x1",y:"x1"}},{type:"lnTo",pt:{x:"x1",y:"y4"}},{type:"lnTo",pt:{x:"x4",y:"y4"}},{type:"lnTo",pt:{x:"x4",y:"x1"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},funnel:{gdLst:[{n:"d",f:"*/ ss 1 20"},{n:"rw2",f:"+- wd2 0 d"},{n:"rh2",f:"+- hd4 0 d"},{n:"t1",f:"cos wd2 480000"},{n:"t2",f:"sin hd4 480000"},{n:"da",f:"at2 t1 t2"},{n:"2da",f:"*/ da 2 1"},{n:"stAng1",f:"+- cd2 0 da"},{n:"swAng1",f:"+- cd2 2da 0"},{n:"swAng3",f:"+- cd2 0 2da"},{n:"rw3",f:"*/ wd2 1 4"},{n:"rh3",f:"*/ hd4 1 4"},{n:"ct1",f:"cos hd4 stAng1"},{n:"st1",f:"sin wd2 stAng1"},{n:"m1",f:"mod ct1 st1 0"},{n:"n1",f:"*/ wd2 hd4 m1"},{n:"dx1",f:"cos n1 stAng1"},{n:"dy1",f:"sin n1 stAng1"},{n:"x1",f:"+- hc dx1 0"},{n:"y1",f:"+- hd4 dy1 0"},{n:"ct3",f:"cos rh3 da"},{n:"st3",f:"sin rw3 da"},{n:"m3",f:"mod ct3 st3 0"},{n:"n3",f:"*/ rw3 rh3 m3"},{n:"dx3",f:"cos n3 da"},{n:"dy3",f:"sin n3 da"},{n:"x3",f:"+- hc dx3 0"},{n:"vc3",f:"+- b 0 rh3"},{n:"y2",f:"+- vc3 dy3 0"},{n:"x2",f:"+- wd2 0 rw2"},{n:"cd",f:"*/ cd2 2 1"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"x1",y:"y1"}},{type:"arcTo",wR:"wd2",hR:"hd4",stAng:"stAng1",swAng:"swAng1"},{type:"lnTo",pt:{x:"x3",y:"y2"}},{type:"arcTo",wR:"rw3",hR:"rh3",stAng:"da",swAng:"swAng3"},{type:"close"},{type:"moveTo",pt:{x:"x2",y:"hd4"}},{type:"arcTo",wR:"rw2",hR:"rh2",stAng:"cd2",swAng:"-21600000"},{type:"close"}],extrusionOk:!1,stroke:!0}]},gear6:{avLst:[{n:"adj1",f:"val 15000"},{n:"adj2",f:"val 3526"}],gdLst:[{n:"a1",f:"pin 0 adj1 20000"},{n:"a2",f:"pin 0 adj2 5358"},{n:"th",f:"*/ ss a1 100000"},{n:"lFD",f:"*/ ss a2 100000"},{n:"th2",f:"*/ th 1 2"},{n:"l2",f:"*/ lFD 1 2"},{n:"l3",f:"+- th2 l2 0"},{n:"rh",f:"+- hd2 0 th"},{n:"rw",f:"+- wd2 0 th"},{n:"dr",f:"+- rw 0 rh"},{n:"maxr",f:"?: dr rh rw"},{n:"ha",f:"at2 maxr l3"},{n:"aA1",f:"+- 19800000 0 ha"},{n:"aD1",f:"+- 19800000 ha 0"},{n:"ta11",f:"cos rw aA1"},{n:"ta12",f:"sin rh aA1"},{n:"bA1",f:"at2 ta11 ta12"},{n:"cta1",f:"cos rh bA1"},{n:"sta1",f:"sin rw bA1"},{n:"ma1",f:"mod cta1 sta1 0"},{n:"na1",f:"*/ rw rh ma1"},{n:"dxa1",f:"cos na1 bA1"},{n:"dya1",f:"sin na1 bA1"},{n:"xA1",f:"+- hc dxa1 0"},{n:"yA1",f:"+- vc dya1 0"},{n:"td11",f:"cos rw aD1"},{n:"td12",f:"sin rh aD1"},{n:"bD1",f:"at2 td11 td12"},{n:"ctd1",f:"cos rh bD1"},{n:"std1",f:"sin rw bD1"},{n:"md1",f:"mod ctd1 std1 0"},{n:"nd1",f:"*/ rw rh md1"},{n:"dxd1",f:"cos nd1 bD1"},{n:"dyd1",f:"sin nd1 bD1"},{n:"xD1",f:"+- hc dxd1 0"},{n:"yD1",f:"+- vc dyd1 0"},{n:"xAD1",f:"+- xA1 0 xD1"},{n:"yAD1",f:"+- yA1 0 yD1"},{n:"lAD1",f:"mod xAD1 yAD1 0"},{n:"a1",f:"at2 yAD1 xAD1"},{n:"dxF1",f:"sin lFD a1"},{n:"dyF1",f:"cos lFD a1"},{n:"xF1",f:"+- xD1 dxF1 0"},{n:"yF1",f:"+- yD1 dyF1 0"},{n:"xE1",f:"+- xA1 0 dxF1"},{n:"yE1",f:"+- yA1 0 dyF1"},{n:"yC1t",f:"sin th a1"},{n:"xC1t",f:"cos th a1"},{n:"yC1",f:"+- yF1 yC1t 0"},{n:"xC1",f:"+- xF1 0 xC1t"},{n:"yB1",f:"+- yE1 yC1t 0"},{n:"xB1",f:"+- xE1 0 xC1t"},{n:"aD6",f:"+- 3cd4 ha 0"},{n:"td61",f:"cos rw aD6"},{n:"td62",f:"sin rh aD6"},{n:"bD6",f:"at2 td61 td62"},{n:"ctd6",f:"cos rh bD6"},{n:"std6",f:"sin rw bD6"},{n:"md6",f:"mod ctd6 std6 0"},{n:"nd6",f:"*/ rw rh md6"},{n:"dxd6",f:"cos nd6 bD6"},{n:"dyd6",f:"sin nd6 bD6"},{n:"xD6",f:"+- hc dxd6 0"},{n:"yD6",f:"+- vc dyd6 0"},{n:"xA6",f:"+- hc 0 dxd6"},{n:"xF6",f:"+- xD6 0 lFD"},{n:"xE6",f:"+- xA6 lFD 0"},{n:"yC6",f:"+- yD6 0 th"},{n:"swAng1",f:"+- bA1 0 bD6"},{n:"aA2",f:"+- 1800000 0 ha"},{n:"aD2",f:"+- 1800000 ha 0"},{n:"ta21",f:"cos rw aA2"},{n:"ta22",f:"sin rh aA2"},{n:"bA2",f:"at2 ta21 ta22"},{n:"yA2",f:"+- h 0 yD1"},{n:"td21",f:"cos rw aD2"},{n:"td22",f:"sin rh aD2"},{n:"bD2",f:"at2 td21 td22"},{n:"yD2",f:"+- h 0 yA1"},{n:"yC2",f:"+- h 0 yB1"},{n:"yB2",f:"+- h 0 yC1"},{n:"xB2",f:"val xC1"},{n:"swAng2",f:"+- bA2 0 bD1"},{n:"aD3",f:"+- cd4 ha 0"},{n:"td31",f:"cos rw aD3"},{n:"td32",f:"sin rh aD3"},{n:"bD3",f:"at2 td31 td32"},{n:"yD3",f:"+- h 0 yD6"},{n:"yB3",f:"+- h 0 yC6"},{n:"aD4",f:"+- 9000000 ha 0"},{n:"td41",f:"cos rw aD4"},{n:"td42",f:"sin rh aD4"},{n:"bD4",f:"at2 td41 td42"},{n:"xD4",f:"+- w 0 xD1"},{n:"xC4",f:"+- w 0 xC1"},{n:"xB4",f:"+- w 0 xB1"},{n:"aD5",f:"+- 12600000 ha 0"},{n:"td51",f:"cos rw aD5"},{n:"td52",f:"sin rh aD5"},{n:"bD5",f:"at2 td51 td52"},{n:"xD5",f:"+- w 0 xA1"},{n:"xC5",f:"+- w 0 xB1"},{n:"xB5",f:"+- w 0 xC1"},{n:"xCxn1",f:"+/ xB1 xC1 2"},{n:"yCxn1",f:"+/ yB1 yC1 2"},{n:"yCxn2",f:"+- b 0 yCxn1"},{n:"xCxn4",f:"+/ r 0 xCxn1"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"xA1",y:"yA1"}},{type:"lnTo",pt:{x:"xB1",y:"yB1"}},{type:"lnTo",pt:{x:"xC1",y:"yC1"}},{type:"lnTo",pt:{x:"xD1",y:"yD1"}},{type:"arcTo",wR:"rw",hR:"rh",stAng:"bD1",swAng:"swAng2"},{type:"lnTo",pt:{x:"xC1",y:"yB2"}},{type:"lnTo",pt:{x:"xB1",y:"yC2"}},{type:"lnTo",pt:{x:"xA1",y:"yD2"}},{type:"arcTo",wR:"rw",hR:"rh",stAng:"bD2",swAng:"swAng1"},{type:"lnTo",pt:{x:"xF6",y:"yB3"}},{type:"lnTo",pt:{x:"xE6",y:"yB3"}},{type:"lnTo",pt:{x:"xA6",y:"yD3"}},{type:"arcTo",wR:"rw",hR:"rh",stAng:"bD3",swAng:"swAng1"},{type:"lnTo",pt:{x:"xB4",y:"yC2"}},{type:"lnTo",pt:{x:"xC4",y:"yB2"}},{type:"lnTo",pt:{x:"xD4",y:"yA2"}},{type:"arcTo",wR:"rw",hR:"rh",stAng:"bD4",swAng:"swAng2"},{type:"lnTo",pt:{x:"xB5",y:"yC1"}},{type:"lnTo",pt:{x:"xC5",y:"yB1"}},{type:"lnTo",pt:{x:"xD5",y:"yA1"}},{type:"arcTo",wR:"rw",hR:"rh",stAng:"bD5",swAng:"swAng1"},{type:"lnTo",pt:{x:"xE6",y:"yC6"}},{type:"lnTo",pt:{x:"xF6",y:"yC6"}},{type:"lnTo",pt:{x:"xD6",y:"yD6"}},{type:"arcTo",wR:"rw",hR:"rh",stAng:"bD6",swAng:"swAng1"},{type:"close"}],extrusionOk:!1,stroke:!0}]},gear9:{avLst:[{n:"adj1",f:"val 10000"},{n:"adj2",f:"val 1763"}],gdLst:[{n:"a1",f:"pin 0 adj1 20000"},{n:"a2",f:"pin 0 adj2 2679"},{n:"th",f:"*/ ss a1 100000"},{n:"lFD",f:"*/ ss a2 100000"},{n:"th2",f:"*/ th 1 2"},{n:"l2",f:"*/ lFD 1 2"},{n:"l3",f:"+- th2 l2 0"},{n:"rh",f:"+- hd2 0 th"},{n:"rw",f:"+- wd2 0 th"},{n:"dr",f:"+- rw 0 rh"},{n:"maxr",f:"?: dr rh rw"},{n:"ha",f:"at2 maxr l3"},{n:"aA1",f:"+- 18600000 0 ha"},{n:"aD1",f:"+- 18600000 ha 0"},{n:"ta11",f:"cos rw aA1"},{n:"ta12",f:"sin rh aA1"},{n:"bA1",f:"at2 ta11 ta12"},{n:"cta1",f:"cos rh bA1"},{n:"sta1",f:"sin rw bA1"},{n:"ma1",f:"mod cta1 sta1 0"},{n:"na1",f:"*/ rw rh ma1"},{n:"dxa1",f:"cos na1 bA1"},{n:"dya1",f:"sin na1 bA1"},{n:"xA1",f:"+- hc dxa1 0"},{n:"yA1",f:"+- vc dya1 0"},{n:"td11",f:"cos rw aD1"},{n:"td12",f:"sin rh aD1"},{n:"bD1",f:"at2 td11 td12"},{n:"ctd1",f:"cos rh bD1"},{n:"std1",f:"sin rw bD1"},{n:"md1",f:"mod ctd1 std1 0"},{n:"nd1",f:"*/ rw rh md1"},{n:"dxd1",f:"cos nd1 bD1"},{n:"dyd1",f:"sin nd1 bD1"},{n:"xD1",f:"+- hc dxd1 0"},{n:"yD1",f:"+- vc dyd1 0"},{n:"xAD1",f:"+- xA1 0 xD1"},{n:"yAD1",f:"+- yA1 0 yD1"},{n:"lAD1",f:"mod xAD1 yAD1 0"},{n:"a1",f:"at2 yAD1 xAD1"},{n:"dxF1",f:"sin lFD a1"},{n:"dyF1",f:"cos lFD a1"},{n:"xF1",f:"+- xD1 dxF1 0"},{n:"yF1",f:"+- yD1 dyF1 0"},{n:"xE1",f:"+- xA1 0 dxF1"},{n:"yE1",f:"+- yA1 0 dyF1"},{n:"yC1t",f:"sin th a1"},{n:"xC1t",f:"cos th a1"},{n:"yC1",f:"+- yF1 yC1t 0"},{n:"xC1",f:"+- xF1 0 xC1t"},{n:"yB1",f:"+- yE1 yC1t 0"},{n:"xB1",f:"+- xE1 0 xC1t"},{n:"aA2",f:"+- 21000000 0 ha"},{n:"aD2",f:"+- 21000000 ha 0"},{n:"ta21",f:"cos rw aA2"},{n:"ta22",f:"sin rh aA2"},{n:"bA2",f:"at2 ta21 ta22"},{n:"cta2",f:"cos rh bA2"},{n:"sta2",f:"sin rw bA2"},{n:"ma2",f:"mod cta2 sta2 0"},{n:"na2",f:"*/ rw rh ma2"},{n:"dxa2",f:"cos na2 bA2"},{n:"dya2",f:"sin na2 bA2"},{n:"xA2",f:"+- hc dxa2 0"},{n:"yA2",f:"+- vc dya2 0"},{n:"td21",f:"cos rw aD2"},{n:"td22",f:"sin rh aD2"},{n:"bD2",f:"at2 td21 td22"},{n:"ctd2",f:"cos rh bD2"},{n:"std2",f:"sin rw bD2"},{n:"md2",f:"mod ctd2 std2 0"},{n:"nd2",f:"*/ rw rh md2"},{n:"dxd2",f:"cos nd2 bD2"},{n:"dyd2",f:"sin nd2 bD2"},{n:"xD2",f:"+- hc dxd2 0"},{n:"yD2",f:"+- vc dyd2 0"},{n:"xAD2",f:"+- xA2 0 xD2"},{n:"yAD2",f:"+- yA2 0 yD2"},{n:"lAD2",f:"mod xAD2 yAD2 0"},{n:"a2",f:"at2 yAD2 xAD2"},{n:"dxF2",f:"sin lFD a2"},{n:"dyF2",f:"cos lFD a2"},{n:"xF2",f:"+- xD2 dxF2 0"},{n:"yF2",f:"+- yD2 dyF2 0"},{n:"xE2",f:"+- xA2 0 dxF2"},{n:"yE2",f:"+- yA2 0 dyF2"},{n:"yC2t",f:"sin th a2"},{n:"xC2t",f:"cos th a2"},{n:"yC2",f:"+- yF2 yC2t 0"},{n:"xC2",f:"+- xF2 0 xC2t"},{n:"yB2",f:"+- yE2 yC2t 0"},{n:"xB2",f:"+- xE2 0 xC2t"},{n:"swAng1",f:"+- bA2 0 bD1"},{n:"aA3",f:"+- 1800000 0 ha"},{n:"aD3",f:"+- 1800000 ha 0"},{n:"ta31",f:"cos rw aA3"},{n:"ta32",f:"sin rh aA3"},{n:"bA3",f:"at2 ta31 ta32"},{n:"cta3",f:"cos rh bA3"},{n:"sta3",f:"sin rw bA3"},{n:"ma3",f:"mod cta3 sta3 0"},{n:"na3",f:"*/ rw rh ma3"},{n:"dxa3",f:"cos na3 bA3"},{n:"dya3",f:"sin na3 bA3"},{n:"xA3",f:"+- hc dxa3 0"},{n:"yA3",f:"+- vc dya3 0"},{n:"td31",f:"cos rw aD3"},{n:"td32",f:"sin rh aD3"},{n:"bD3",f:"at2 td31 td32"},{n:"ctd3",f:"cos rh bD3"},{n:"std3",f:"sin rw bD3"},{n:"md3",f:"mod ctd3 std3 0"},{n:"nd3",f:"*/ rw rh md3"},{n:"dxd3",f:"cos nd3 bD3"},{n:"dyd3",f:"sin nd3 bD3"},{n:"xD3",f:"+- hc dxd3 0"},{n:"yD3",f:"+- vc dyd3 0"},{n:"xAD3",f:"+- xA3 0 xD3"},{n:"yAD3",f:"+- yA3 0 yD3"},{n:"lAD3",f:"mod xAD3 yAD3 0"},{n:"a3",f:"at2 yAD3 xAD3"},{n:"dxF3",f:"sin lFD a3"},{n:"dyF3",f:"cos lFD a3"},{n:"xF3",f:"+- xD3 dxF3 0"},{n:"yF3",f:"+- yD3 dyF3 0"},{n:"xE3",f:"+- xA3 0 dxF3"},{n:"yE3",f:"+- yA3 0 dyF3"},{n:"yC3t",f:"sin th a3"},{n:"xC3t",f:"cos th a3"},{n:"yC3",f:"+- yF3 yC3t 0"},{n:"xC3",f:"+- xF3 0 xC3t"},{n:"yB3",f:"+- yE3 yC3t 0"},{n:"xB3",f:"+- xE3 0 xC3t"},{n:"swAng2",f:"+- bA3 0 bD2"},{n:"aA4",f:"+- 4200000 0 ha"},{n:"aD4",f:"+- 4200000 ha 0"},{n:"ta41",f:"cos rw aA4"},{n:"ta42",f:"sin rh aA4"},{n:"bA4",f:"at2 ta41 ta42"},{n:"cta4",f:"cos rh bA4"},{n:"sta4",f:"sin rw bA4"},{n:"ma4",f:"mod cta4 sta4 0"},{n:"na4",f:"*/ rw rh ma4"},{n:"dxa4",f:"cos na4 bA4"},{n:"dya4",f:"sin na4 bA4"},{n:"xA4",f:"+- hc dxa4 0"},{n:"yA4",f:"+- vc dya4 0"},{n:"td41",f:"cos rw aD4"},{n:"td42",f:"sin rh aD4"},{n:"bD4",f:"at2 td41 td42"},{n:"ctd4",f:"cos rh bD4"},{n:"std4",f:"sin rw bD4"},{n:"md4",f:"mod ctd4 std4 0"},{n:"nd4",f:"*/ rw rh md4"},{n:"dxd4",f:"cos nd4 bD4"},{n:"dyd4",f:"sin nd4 bD4"},{n:"xD4",f:"+- hc dxd4 0"},{n:"yD4",f:"+- vc dyd4 0"},{n:"xAD4",f:"+- xA4 0 xD4"},{n:"yAD4",f:"+- yA4 0 yD4"},{n:"lAD4",f:"mod xAD4 yAD4 0"},{n:"a4",f:"at2 yAD4 xAD4"},{n:"dxF4",f:"sin lFD a4"},{n:"dyF4",f:"cos lFD a4"},{n:"xF4",f:"+- xD4 dxF4 0"},{n:"yF4",f:"+- yD4 dyF4 0"},{n:"xE4",f:"+- xA4 0 dxF4"},{n:"yE4",f:"+- yA4 0 dyF4"},{n:"yC4t",f:"sin th a4"},{n:"xC4t",f:"cos th a4"},{n:"yC4",f:"+- yF4 yC4t 0"},{n:"xC4",f:"+- xF4 0 xC4t"},{n:"yB4",f:"+- yE4 yC4t 0"},{n:"xB4",f:"+- xE4 0 xC4t"},{n:"swAng3",f:"+- bA4 0 bD3"},{n:"aA5",f:"+- 6600000 0 ha"},{n:"aD5",f:"+- 6600000 ha 0"},{n:"ta51",f:"cos rw aA5"},{n:"ta52",f:"sin rh aA5"},{n:"bA5",f:"at2 ta51 ta52"},{n:"td51",f:"cos rw aD5"},{n:"td52",f:"sin rh aD5"},{n:"bD5",f:"at2 td51 td52"},{n:"xD5",f:"+- w 0 xA4"},{n:"xC5",f:"+- w 0 xB4"},{n:"xB5",f:"+- w 0 xC4"},{n:"swAng4",f:"+- bA5 0 bD4"},{n:"aD6",f:"+- 9000000 ha 0"},{n:"td61",f:"cos rw aD6"},{n:"td62",f:"sin rh aD6"},{n:"bD6",f:"at2 td61 td62"},{n:"xD6",f:"+- w 0 xA3"},{n:"xC6",f:"+- w 0 xB3"},{n:"xB6",f:"+- w 0 xC3"},{n:"aD7",f:"+- 11400000 ha 0"},{n:"td71",f:"cos rw aD7"},{n:"td72",f:"sin rh aD7"},{n:"bD7",f:"at2 td71 td72"},{n:"xD7",f:"+- w 0 xA2"},{n:"xC7",f:"+- w 0 xB2"},{n:"xB7",f:"+- w 0 xC2"},{n:"aD8",f:"+- 13800000 ha 0"},{n:"td81",f:"cos rw aD8"},{n:"td82",f:"sin rh aD8"},{n:"bD8",f:"at2 td81 td82"},{n:"xA8",f:"+- w 0 xD1"},{n:"xD8",f:"+- w 0 xA1"},{n:"xC8",f:"+- w 0 xB1"},{n:"xB8",f:"+- w 0 xC1"},{n:"aA9",f:"+- 3cd4 0 ha"},{n:"aD9",f:"+- 3cd4 ha 0"},{n:"td91",f:"cos rw aD9"},{n:"td92",f:"sin rh aD9"},{n:"bD9",f:"at2 td91 td92"},{n:"ctd9",f:"cos rh bD9"},{n:"std9",f:"sin rw bD9"},{n:"md9",f:"mod ctd9 std9 0"},{n:"nd9",f:"*/ rw rh md9"},{n:"dxd9",f:"cos nd9 bD9"},{n:"dyd9",f:"sin nd9 bD9"},{n:"xD9",f:"+- hc dxd9 0"},{n:"yD9",f:"+- vc dyd9 0"},{n:"ta91",f:"cos rw aA9"},{n:"ta92",f:"sin rh aA9"},{n:"bA9",f:"at2 ta91 ta92"},{n:"xA9",f:"+- hc 0 dxd9"},{n:"xF9",f:"+- xD9 0 lFD"},{n:"xE9",f:"+- xA9 lFD 0"},{n:"yC9",f:"+- yD9 0 th"},{n:"swAng5",f:"+- bA9 0 bD8"},{n:"xCxn1",f:"+/ xB1 xC1 2"},{n:"yCxn1",f:"+/ yB1 yC1 2"},{n:"xCxn2",f:"+/ xB2 xC2 2"},{n:"yCxn2",f:"+/ yB2 yC2 2"},{n:"xCxn3",f:"+/ xB3 xC3 2"},{n:"yCxn3",f:"+/ yB3 yC3 2"},{n:"xCxn4",f:"+/ xB4 xC4 2"},{n:"yCxn4",f:"+/ yB4 yC4 2"},{n:"xCxn5",f:"+/ r 0 xCxn4"},{n:"xCxn6",f:"+/ r 0 xCxn3"},{n:"xCxn7",f:"+/ r 0 xCxn2"},{n:"xCxn8",f:"+/ r 0 xCxn1"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"xA1",y:"yA1"}},{type:"lnTo",pt:{x:"xB1",y:"yB1"}},{type:"lnTo",pt:{x:"xC1",y:"yC1"}},{type:"lnTo",pt:{x:"xD1",y:"yD1"}},{type:"arcTo",wR:"rw",hR:"rh",stAng:"bD1",swAng:"swAng1"},{type:"lnTo",pt:{x:"xB2",y:"yB2"}},{type:"lnTo",pt:{x:"xC2",y:"yC2"}},{type:"lnTo",pt:{x:"xD2",y:"yD2"}},{type:"arcTo",wR:"rw",hR:"rh",stAng:"bD2",swAng:"swAng2"},{type:"lnTo",pt:{x:"xB3",y:"yB3"}},{type:"lnTo",pt:{x:"xC3",y:"yC3"}},{type:"lnTo",pt:{x:"xD3",y:"yD3"}},{type:"arcTo",wR:"rw",hR:"rh",stAng:"bD3",swAng:"swAng3"},{type:"lnTo",pt:{x:"xB4",y:"yB4"}},{type:"lnTo",pt:{x:"xC4",y:"yC4"}},{type:"lnTo",pt:{x:"xD4",y:"yD4"}},{type:"arcTo",wR:"rw",hR:"rh",stAng:"bD4",swAng:"swAng4"},{type:"lnTo",pt:{x:"xB5",y:"yC4"}},{type:"lnTo",pt:{x:"xC5",y:"yB4"}},{type:"lnTo",pt:{x:"xD5",y:"yA4"}},{type:"arcTo",wR:"rw",hR:"rh",stAng:"bD5",swAng:"swAng3"},{type:"lnTo",pt:{x:"xB6",y:"yC3"}},{type:"lnTo",pt:{x:"xC6",y:"yB3"}},{type:"lnTo",pt:{x:"xD6",y:"yA3"}},{type:"arcTo",wR:"rw",hR:"rh",stAng:"bD6",swAng:"swAng2"},{type:"lnTo",pt:{x:"xB7",y:"yC2"}},{type:"lnTo",pt:{x:"xC7",y:"yB2"}},{type:"lnTo",pt:{x:"xD7",y:"yA2"}},{type:"arcTo",wR:"rw",hR:"rh",stAng:"bD7",swAng:"swAng1"},{type:"lnTo",pt:{x:"xB8",y:"yC1"}},{type:"lnTo",pt:{x:"xC8",y:"yB1"}},{type:"lnTo",pt:{x:"xD8",y:"yA1"}},{type:"arcTo",wR:"rw",hR:"rh",stAng:"bD8",swAng:"swAng5"},{type:"lnTo",pt:{x:"xE9",y:"yC9"}},{type:"lnTo",pt:{x:"xF9",y:"yC9"}},{type:"lnTo",pt:{x:"xD9",y:"yD9"}},{type:"arcTo",wR:"rw",hR:"rh",stAng:"bD9",swAng:"swAng5"},{type:"close"}],extrusionOk:!1,stroke:!0}]},halfFrame:{avLst:[{n:"adj1",f:"val 33333"},{n:"adj2",f:"val 33333"}],gdLst:[{n:"maxAdj2",f:"*/ 100000 w ss"},{n:"a2",f:"pin 0 adj2 maxAdj2"},{n:"x1",f:"*/ ss a2 100000"},{n:"g1",f:"*/ h x1 w"},{n:"g2",f:"+- h 0 g1"},{n:"maxAdj1",f:"*/ 100000 g2 ss"},{n:"a1",f:"pin 0 adj1 maxAdj1"},{n:"y1",f:"*/ ss a1 100000"},{n:"dx2",f:"*/ y1 w h"},{n:"x2",f:"+- r 0 dx2"},{n:"dy2",f:"*/ x1 h w"},{n:"y2",f:"+- b 0 dy2"},{n:"cx1",f:"*/ x1 1 2"},{n:"cy1",f:"+/ y2 b 2"},{n:"cx2",f:"+/ x2 r 2"},{n:"cy2",f:"*/ y1 1 2"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"x2",y:"y1"}},{type:"lnTo",pt:{x:"x1",y:"y1"}},{type:"lnTo",pt:{x:"x1",y:"y2"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},heart:{gdLst:[{n:"dx1",f:"*/ w 49 48"},{n:"dx2",f:"*/ w 10 48"},{n:"x1",f:"+- hc 0 dx1"},{n:"x2",f:"+- hc 0 dx2"},{n:"x3",f:"+- hc dx2 0"},{n:"x4",f:"+- hc dx1 0"},{n:"y1",f:"+- t 0 hd3"},{n:"il",f:"*/ w 1 6"},{n:"ir",f:"*/ w 5 6"},{n:"ib",f:"*/ h 2 3"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"hc",y:"hd4"}},{type:"cubicBezTo",pts:[{x:"x3",y:"y1"},{x:"x4",y:"hd4"},{x:"hc",y:"b"}]},{type:"cubicBezTo",pts:[{x:"x1",y:"hd4"},{x:"x2",y:"y1"},{x:"hc",y:"hd4"}]},{type:"close"}],extrusionOk:!1,stroke:!0}]},heptagon:{avLst:[{n:"hf",f:"val 102572"},{n:"vf",f:"val 105210"}],gdLst:[{n:"swd2",f:"*/ wd2 hf 100000"},{n:"shd2",f:"*/ hd2 vf 100000"},{n:"svc",f:"*/ vc  vf 100000"},{n:"dx1",f:"*/ swd2 97493 100000"},{n:"dx2",f:"*/ swd2 78183 100000"},{n:"dx3",f:"*/ swd2 43388 100000"},{n:"dy1",f:"*/ shd2 62349 100000"},{n:"dy2",f:"*/ shd2 22252 100000"},{n:"dy3",f:"*/ shd2 90097 100000"},{n:"x1",f:"+- hc 0 dx1"},{n:"x2",f:"+- hc 0 dx2"},{n:"x3",f:"+- hc 0 dx3"},{n:"x4",f:"+- hc dx3 0"},{n:"x5",f:"+- hc dx2 0"},{n:"x6",f:"+- hc dx1 0"},{n:"y1",f:"+- svc 0 dy1"},{n:"y2",f:"+- svc dy2 0"},{n:"y3",f:"+- svc dy3 0"},{n:"ib",f:"+- b 0 y1"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"x1",y:"y2"}},{type:"lnTo",pt:{x:"x2",y:"y1"}},{type:"lnTo",pt:{x:"hc",y:"t"}},{type:"lnTo",pt:{x:"x5",y:"y1"}},{type:"lnTo",pt:{x:"x6",y:"y2"}},{type:"lnTo",pt:{x:"x4",y:"y3"}},{type:"lnTo",pt:{x:"x3",y:"y3"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},hexagon:{avLst:[{n:"adj",f:"val 25000"},{n:"vf",f:"val 115470"}],gdLst:[{n:"maxAdj",f:"*/ 50000 w ss"},{n:"a",f:"pin 0 adj maxAdj"},{n:"shd2",f:"*/ hd2 vf 100000"},{n:"x1",f:"*/ ss a 100000"},{n:"x2",f:"+- r 0 x1"},{n:"dy1",f:"sin shd2 3600000"},{n:"y1",f:"+- vc 0 dy1"},{n:"y2",f:"+- vc dy1 0"},{n:"q1",f:"*/ maxAdj -1 2"},{n:"q2",f:"+- a q1 0"},{n:"q3",f:"?: q2 4 2"},{n:"q4",f:"?: q2 3 2"},{n:"q5",f:"?: q2 q1 0"},{n:"q6",f:"+/ a q5 q1"},{n:"q7",f:"*/ q6 q4 -1"},{n:"q8",f:"+- q3 q7 0"},{n:"il",f:"*/ w q8 24"},{n:"it",f:"*/ h q8 24"},{n:"ir",f:"+- r 0 il"},{n:"ib",f:"+- b 0 it"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"vc"}},{type:"lnTo",pt:{x:"x1",y:"y1"}},{type:"lnTo",pt:{x:"x2",y:"y1"}},{type:"lnTo",pt:{x:"r",y:"vc"}},{type:"lnTo",pt:{x:"x2",y:"y2"}},{type:"lnTo",pt:{x:"x1",y:"y2"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},homePlate:{avLst:[{n:"adj",f:"val 50000"}],gdLst:[{n:"maxAdj",f:"*/ 100000 w ss"},{n:"a",f:"pin 0 adj maxAdj"},{n:"dx1",f:"*/ ss a 100000"},{n:"x1",f:"+- r 0 dx1"},{n:"ir",f:"+/ x1 r 2"},{n:"x2",f:"*/ x1 1 2"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"x1",y:"t"}},{type:"lnTo",pt:{x:"r",y:"vc"}},{type:"lnTo",pt:{x:"x1",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},horizontalScroll:{avLst:[{n:"adj",f:"val 12500"}],gdLst:[{n:"a",f:"pin 0 adj 25000"},{n:"ch",f:"*/ ss a 100000"},{n:"ch2",f:"*/ ch 1 2"},{n:"ch4",f:"*/ ch 1 4"},{n:"y3",f:"+- ch ch2 0"},{n:"y4",f:"+- ch ch 0"},{n:"y6",f:"+- b 0 ch"},{n:"y7",f:"+- b 0 ch2"},{n:"y5",f:"+- y6 0 ch2"},{n:"x3",f:"+- r 0 ch"},{n:"x4",f:"+- r 0 ch2"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"r",y:"ch2"}},{type:"arcTo",wR:"ch2",hR:"ch2",stAng:"0",swAng:"cd4"},{type:"lnTo",pt:{x:"x4",y:"ch2"}},{type:"arcTo",wR:"ch4",hR:"ch4",stAng:"0",swAng:"cd2"},{type:"lnTo",pt:{x:"x3",y:"ch"}},{type:"lnTo",pt:{x:"ch2",y:"ch"}},{type:"arcTo",wR:"ch2",hR:"ch2",stAng:"3cd4",swAng:"-5400000"},{type:"lnTo",pt:{x:"l",y:"y7"}},{type:"arcTo",wR:"ch2",hR:"ch2",stAng:"cd2",swAng:"-10800000"},{type:"lnTo",pt:{x:"ch",y:"y6"}},{type:"lnTo",pt:{x:"x4",y:"y6"}},{type:"arcTo",wR:"ch2",hR:"ch2",stAng:"cd4",swAng:"-5400000"},{type:"close"},{type:"moveTo",pt:{x:"ch2",y:"y4"}},{type:"arcTo",wR:"ch2",hR:"ch2",stAng:"cd4",swAng:"-5400000"},{type:"arcTo",wR:"ch4",hR:"ch4",stAng:"0",swAng:"-10800000"},{type:"close"}],extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"ch2",y:"y4"}},{type:"arcTo",wR:"ch2",hR:"ch2",stAng:"cd4",swAng:"-5400000"},{type:"arcTo",wR:"ch4",hR:"ch4",stAng:"0",swAng:"-10800000"},{type:"close"},{type:"moveTo",pt:{x:"x4",y:"ch"}},{type:"arcTo",wR:"ch2",hR:"ch2",stAng:"cd4",swAng:"-16200000"},{type:"arcTo",wR:"ch4",hR:"ch4",stAng:"cd2",swAng:"-10800000"},{type:"close"}],fill:"darkenLess",extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"l",y:"y3"}},{type:"arcTo",wR:"ch2",hR:"ch2",stAng:"cd2",swAng:"cd4"},{type:"lnTo",pt:{x:"x3",y:"ch"}},{type:"lnTo",pt:{x:"x3",y:"ch2"}},{type:"arcTo",wR:"ch2",hR:"ch2",stAng:"cd2",swAng:"cd2"},{type:"lnTo",pt:{x:"r",y:"y5"}},{type:"arcTo",wR:"ch2",hR:"ch2",stAng:"0",swAng:"cd4"},{type:"lnTo",pt:{x:"ch",y:"y6"}},{type:"lnTo",pt:{x:"ch",y:"y7"}},{type:"arcTo",wR:"ch2",hR:"ch2",stAng:"0",swAng:"cd2"},{type:"close"},{type:"moveTo",pt:{x:"x3",y:"ch"}},{type:"lnTo",pt:{x:"x4",y:"ch"}},{type:"arcTo",wR:"ch2",hR:"ch2",stAng:"cd4",swAng:"-5400000"},{type:"moveTo",pt:{x:"x4",y:"ch"}},{type:"lnTo",pt:{x:"x4",y:"ch2"}},{type:"arcTo",wR:"ch4",hR:"ch4",stAng:"0",swAng:"cd2"},{type:"moveTo",pt:{x:"ch2",y:"y4"}},{type:"lnTo",pt:{x:"ch2",y:"y3"}},{type:"arcTo",wR:"ch4",hR:"ch4",stAng:"cd2",swAng:"cd2"},{type:"arcTo",wR:"ch2",hR:"ch2",stAng:"0",swAng:"cd2"},{type:"moveTo",pt:{x:"ch",y:"y3"}},{type:"lnTo",pt:{x:"ch",y:"y6"}}],fill:"none",extrusionOk:!1,stroke:!0}]},irregularSeal1:{gdLst:[{n:"x5",f:"*/ w 4627 21600"},{n:"x12",f:"*/ w 8485 21600"},{n:"x21",f:"*/ w 16702 21600"},{n:"x24",f:"*/ w 14522 21600"},{n:"y3",f:"*/ h 6320 21600"},{n:"y6",f:"*/ h 8615 21600"},{n:"y9",f:"*/ h 13937 21600"},{n:"y18",f:"*/ h 13290 21600"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"10800",y:"5800"}},{type:"lnTo",pt:{x:"14522",y:"0"}},{type:"lnTo",pt:{x:"14155",y:"5325"}},{type:"lnTo",pt:{x:"18380",y:"4457"}},{type:"lnTo",pt:{x:"16702",y:"7315"}},{type:"lnTo",pt:{x:"21097",y:"8137"}},{type:"lnTo",pt:{x:"17607",y:"10475"}},{type:"lnTo",pt:{x:"21600",y:"13290"}},{type:"lnTo",pt:{x:"16837",y:"12942"}},{type:"lnTo",pt:{x:"18145",y:"18095"}},{type:"lnTo",pt:{x:"14020",y:"14457"}},{type:"lnTo",pt:{x:"13247",y:"19737"}},{type:"lnTo",pt:{x:"10532",y:"14935"}},{type:"lnTo",pt:{x:"8485",y:"21600"}},{type:"lnTo",pt:{x:"7715",y:"15627"}},{type:"lnTo",pt:{x:"4762",y:"17617"}},{type:"lnTo",pt:{x:"5667",y:"13937"}},{type:"lnTo",pt:{x:"135",y:"14587"}},{type:"lnTo",pt:{x:"3722",y:"11775"}},{type:"lnTo",pt:{x:"0",y:"8615"}},{type:"lnTo",pt:{x:"4627",y:"7617"}},{type:"lnTo",pt:{x:"370",y:"2295"}},{type:"lnTo",pt:{x:"7312",y:"6320"}},{type:"lnTo",pt:{x:"8352",y:"2295"}},{type:"close"}],extrusionOk:!1,stroke:!0,w:21600,h:21600}]},irregularSeal2:{gdLst:[{n:"x2",f:"*/ w 9722 21600"},{n:"x5",f:"*/ w 5372 21600"},{n:"x16",f:"*/ w 11612 21600"},{n:"x19",f:"*/ w 14640 21600"},{n:"y2",f:"*/ h 1887 21600"},{n:"y3",f:"*/ h 6382 21600"},{n:"y8",f:"*/ h 12877 21600"},{n:"y14",f:"*/ h 19712 21600"},{n:"y16",f:"*/ h 18842 21600"},{n:"y17",f:"*/ h 15935 21600"},{n:"y24",f:"*/ h 6645 21600"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"11462",y:"4342"}},{type:"lnTo",pt:{x:"14790",y:"0"}},{type:"lnTo",pt:{x:"14525",y:"5777"}},{type:"lnTo",pt:{x:"18007",y:"3172"}},{type:"lnTo",pt:{x:"16380",y:"6532"}},{type:"lnTo",pt:{x:"21600",y:"6645"}},{type:"lnTo",pt:{x:"16985",y:"9402"}},{type:"lnTo",pt:{x:"18270",y:"11290"}},{type:"lnTo",pt:{x:"16380",y:"12310"}},{type:"lnTo",pt:{x:"18877",y:"15632"}},{type:"lnTo",pt:{x:"14640",y:"14350"}},{type:"lnTo",pt:{x:"14942",y:"17370"}},{type:"lnTo",pt:{x:"12180",y:"15935"}},{type:"lnTo",pt:{x:"11612",y:"18842"}},{type:"lnTo",pt:{x:"9872",y:"17370"}},{type:"lnTo",pt:{x:"8700",y:"19712"}},{type:"lnTo",pt:{x:"7527",y:"18125"}},{type:"lnTo",pt:{x:"4917",y:"21600"}},{type:"lnTo",pt:{x:"4805",y:"18240"}},{type:"lnTo",pt:{x:"1285",y:"17825"}},{type:"lnTo",pt:{x:"3330",y:"15370"}},{type:"lnTo",pt:{x:"0",y:"12877"}},{type:"lnTo",pt:{x:"3935",y:"11592"}},{type:"lnTo",pt:{x:"1172",y:"8270"}},{type:"lnTo",pt:{x:"5372",y:"7817"}},{type:"lnTo",pt:{x:"4502",y:"3625"}},{type:"lnTo",pt:{x:"8550",y:"6382"}},{type:"lnTo",pt:{x:"9722",y:"1887"}},{type:"close"}],extrusionOk:!1,stroke:!0,w:21600,h:21600}]},leftArrow:{avLst:[{n:"adj1",f:"val 50000"},{n:"adj2",f:"val 50000"}],gdLst:[{n:"maxAdj2",f:"*/ 100000 w ss"},{n:"a1",f:"pin 0 adj1 100000"},{n:"a2",f:"pin 0 adj2 maxAdj2"},{n:"dx2",f:"*/ ss a2 100000"},{n:"x2",f:"+- l dx2 0"},{n:"dy1",f:"*/ h a1 200000"},{n:"y1",f:"+- vc 0 dy1"},{n:"y2",f:"+- vc dy1 0"},{n:"dx1",f:"*/ y1 dx2 hd2"},{n:"x1",f:"+- x2  0 dx1"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"vc"}},{type:"lnTo",pt:{x:"x2",y:"t"}},{type:"lnTo",pt:{x:"x2",y:"y1"}},{type:"lnTo",pt:{x:"r",y:"y1"}},{type:"lnTo",pt:{x:"r",y:"y2"}},{type:"lnTo",pt:{x:"x2",y:"y2"}},{type:"lnTo",pt:{x:"x2",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},leftArrowCallout:{avLst:[{n:"adj1",f:"val 25000"},{n:"adj2",f:"val 25000"},{n:"adj3",f:"val 25000"},{n:"adj4",f:"val 64977"}],gdLst:[{n:"maxAdj2",f:"*/ 50000 h ss"},{n:"a2",f:"pin 0 adj2 maxAdj2"},{n:"maxAdj1",f:"*/ a2 2 1"},{n:"a1",f:"pin 0 adj1 maxAdj1"},{n:"maxAdj3",f:"*/ 100000 w ss"},{n:"a3",f:"pin 0 adj3 maxAdj3"},{n:"q2",f:"*/ a3 ss w"},{n:"maxAdj4",f:"+- 100000 0 q2"},{n:"a4",f:"pin 0 adj4 maxAdj4"},{n:"dy1",f:"*/ ss a2 100000"},{n:"dy2",f:"*/ ss a1 200000"},{n:"y1",f:"+- vc 0 dy1"},{n:"y2",f:"+- vc 0 dy2"},{n:"y3",f:"+- vc dy2 0"},{n:"y4",f:"+- vc dy1 0"},{n:"x1",f:"*/ ss a3 100000"},{n:"dx2",f:"*/ w a4 100000"},{n:"x2",f:"+- r 0 dx2"},{n:"x3",f:"+/ x2 r 2"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"vc"}},{type:"lnTo",pt:{x:"x1",y:"y1"}},{type:"lnTo",pt:{x:"x1",y:"y2"}},{type:"lnTo",pt:{x:"x2",y:"y2"}},{type:"lnTo",pt:{x:"x2",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"x2",y:"b"}},{type:"lnTo",pt:{x:"x2",y:"y3"}},{type:"lnTo",pt:{x:"x1",y:"y3"}},{type:"lnTo",pt:{x:"x1",y:"y4"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},leftBrace:{avLst:[{n:"adj1",f:"val 8333"},{n:"adj2",f:"val 50000"}],gdLst:[{n:"a2",f:"pin 0 adj2 100000"},{n:"q1",f:"+- 100000 0 a2"},{n:"q2",f:"min q1 a2"},{n:"q3",f:"*/ q2 1 2"},{n:"maxAdj1",f:"*/ q3 h ss"},{n:"a1",f:"pin 0 adj1 maxAdj1"},{n:"y1",f:"*/ ss a1 100000"},{n:"y3",f:"*/ h a2 100000"},{n:"y4",f:"+- y3 y1 0"},{n:"dx1",f:"cos wd2 2700000"},{n:"dy1",f:"sin y1 2700000"},{n:"il",f:"+- r 0 dx1"},{n:"it",f:"+- y1 0 dy1"},{n:"ib",f:"+- b dy1 y1"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"r",y:"b"}},{type:"arcTo",wR:"wd2",hR:"y1",stAng:"cd4",swAng:"cd4"},{type:"lnTo",pt:{x:"hc",y:"y4"}},{type:"arcTo",wR:"wd2",hR:"y1",stAng:"0",swAng:"-5400000"},{type:"arcTo",wR:"wd2",hR:"y1",stAng:"cd4",swAng:"-5400000"},{type:"lnTo",pt:{x:"hc",y:"y1"}},{type:"arcTo",wR:"wd2",hR:"y1",stAng:"cd2",swAng:"cd4"},{type:"close"}],extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"r",y:"b"}},{type:"arcTo",wR:"wd2",hR:"y1",stAng:"cd4",swAng:"cd4"},{type:"lnTo",pt:{x:"hc",y:"y4"}},{type:"arcTo",wR:"wd2",hR:"y1",stAng:"0",swAng:"-5400000"},{type:"arcTo",wR:"wd2",hR:"y1",stAng:"cd4",swAng:"-5400000"},{type:"lnTo",pt:{x:"hc",y:"y1"}},{type:"arcTo",wR:"wd2",hR:"y1",stAng:"cd2",swAng:"cd4"}],fill:"none",extrusionOk:!1,stroke:!0}]},leftBracket:{avLst:[{n:"adj",f:"val 8333"}],gdLst:[{n:"maxAdj",f:"*/ 50000 h ss"},{n:"a",f:"pin 0 adj maxAdj"},{n:"y1",f:"*/ ss a 100000"},{n:"y2",f:"+- b 0 y1"},{n:"dx1",f:"cos w 2700000"},{n:"dy1",f:"sin y1 2700000"},{n:"il",f:"+- r 0 dx1"},{n:"it",f:"+- y1 0 dy1"},{n:"ib",f:"+- b dy1 y1"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"r",y:"b"}},{type:"arcTo",wR:"w",hR:"y1",stAng:"cd4",swAng:"cd4"},{type:"lnTo",pt:{x:"l",y:"y1"}},{type:"arcTo",wR:"w",hR:"y1",stAng:"cd2",swAng:"cd4"},{type:"close"}],extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"r",y:"b"}},{type:"arcTo",wR:"w",hR:"y1",stAng:"cd4",swAng:"cd4"},{type:"lnTo",pt:{x:"l",y:"y1"}},{type:"arcTo",wR:"w",hR:"y1",stAng:"cd2",swAng:"cd4"}],fill:"none",extrusionOk:!1,stroke:!0}]},leftCircularArrow:{avLst:[{n:"adj1",f:"val 12500"},{n:"adj2",f:"val -1142319"},{n:"adj3",f:"val 1142319"},{n:"adj4",f:"val 10800000"},{n:"adj5",f:"val 12500"}],gdLst:[{n:"a5",f:"pin 0 adj5 25000"},{n:"maxAdj1",f:"*/ a5 2 1"},{n:"a1",f:"pin 0 adj1 maxAdj1"},{n:"enAng",f:"pin 1 adj3 21599999"},{n:"stAng",f:"pin 0 adj4 21599999"},{n:"th",f:"*/ ss a1 100000"},{n:"thh",f:"*/ ss a5 100000"},{n:"th2",f:"*/ th 1 2"},{n:"rw1",f:"+- wd2 th2 thh"},{n:"rh1",f:"+- hd2 th2 thh"},{n:"rw2",f:"+- rw1 0 th"},{n:"rh2",f:"+- rh1 0 th"},{n:"rw3",f:"+- rw2 th2 0"},{n:"rh3",f:"+- rh2 th2 0"},{n:"wtH",f:"sin rw3 enAng"},{n:"htH",f:"cos rh3 enAng"},{n:"dxH",f:"cat2 rw3 htH wtH"},{n:"dyH",f:"sat2 rh3 htH wtH"},{n:"xH",f:"+- hc dxH 0"},{n:"yH",f:"+- vc dyH 0"},{n:"rI",f:"min rw2 rh2"},{n:"u1",f:"*/ dxH dxH 1"},{n:"u2",f:"*/ dyH dyH 1"},{n:"u3",f:"*/ rI rI 1"},{n:"u4",f:"+- u1 0 u3"},{n:"u5",f:"+- u2 0 u3"},{n:"u6",f:"*/ u4 u5 u1"},{n:"u7",f:"*/ u6 1 u2"},{n:"u8",f:"+- 1 0 u7"},{n:"u9",f:"sqrt u8"},{n:"u10",f:"*/ u4 1 dxH"},{n:"u11",f:"*/ u10 1 dyH"},{n:"u12",f:"+/ 1 u9 u11"},{n:"u13",f:"at2 1 u12"},{n:"u14",f:"+- u13 21600000 0"},{n:"u15",f:"?: u13 u13 u14"},{n:"u16",f:"+- u15 0 enAng"},{n:"u17",f:"+- u16 21600000 0"},{n:"u18",f:"?: u16 u16 u17"},{n:"u19",f:"+- u18 0 cd2"},{n:"u20",f:"+- u18 0 21600000"},{n:"u21",f:"?: u19 u20 u18"},{n:"u22",f:"abs u21"},{n:"minAng",f:"*/ u22 -1 1"},{n:"u23",f:"abs adj2"},{n:"a2",f:"*/ u23 -1 1"},{n:"aAng",f:"pin minAng a2 0"},{n:"ptAng",f:"+- enAng aAng 0"},{n:"wtA",f:"sin rw3 ptAng"},{n:"htA",f:"cos rh3 ptAng"},{n:"dxA",f:"cat2 rw3 htA wtA"},{n:"dyA",f:"sat2 rh3 htA wtA"},{n:"xA",f:"+- hc dxA 0"},{n:"yA",f:"+- vc dyA 0"},{n:"wtE",f:"sin rw1 stAng"},{n:"htE",f:"cos rh1 stAng"},{n:"dxE",f:"cat2 rw1 htE wtE"},{n:"dyE",f:"sat2 rh1 htE wtE"},{n:"xE",f:"+- hc dxE 0"},{n:"yE",f:"+- vc dyE 0"},{n:"wtD",f:"sin rw2 stAng"},{n:"htD",f:"cos rh2 stAng"},{n:"dxD",f:"cat2 rw2 htD wtD"},{n:"dyD",f:"sat2 rh2 htD wtD"},{n:"xD",f:"+- hc dxD 0"},{n:"yD",f:"+- vc dyD 0"},{n:"dxG",f:"cos thh ptAng"},{n:"dyG",f:"sin thh ptAng"},{n:"xG",f:"+- xH dxG 0"},{n:"yG",f:"+- yH dyG 0"},{n:"dxB",f:"cos thh ptAng"},{n:"dyB",f:"sin thh ptAng"},{n:"xB",f:"+- xH 0 dxB 0"},{n:"yB",f:"+- yH 0 dyB 0"},{n:"sx1",f:"+- xB 0 hc"},{n:"sy1",f:"+- yB 0 vc"},{n:"sx2",f:"+- xG 0 hc"},{n:"sy2",f:"+- yG 0 vc"},{n:"rO",f:"min rw1 rh1"},{n:"x1O",f:"*/ sx1 rO rw1"},{n:"y1O",f:"*/ sy1 rO rh1"},{n:"x2O",f:"*/ sx2 rO rw1"},{n:"y2O",f:"*/ sy2 rO rh1"},{n:"dxO",f:"+- x2O 0 x1O"},{n:"dyO",f:"+- y2O 0 y1O"},{n:"dO",f:"mod dxO dyO 0"},{n:"q1",f:"*/ x1O y2O 1"},{n:"q2",f:"*/ x2O y1O 1"},{n:"DO",f:"+- q1 0 q2"},{n:"q3",f:"*/ rO rO 1"},{n:"q4",f:"*/ dO dO 1"},{n:"q5",f:"*/ q3 q4 1"},{n:"q6",f:"*/ DO DO 1"},{n:"q7",f:"+- q5 0 q6"},{n:"q8",f:"max q7 0"},{n:"sdelO",f:"sqrt q8"},{n:"ndyO",f:"*/ dyO -1 1"},{n:"sdyO",f:"?: ndyO -1 1"},{n:"q9",f:"*/ sdyO dxO 1"},{n:"q10",f:"*/ q9 sdelO 1"},{n:"q11",f:"*/ DO dyO 1"},{n:"dxF1",f:"+/ q11 q10 q4"},{n:"q12",f:"+- q11 0 q10"},{n:"dxF2",f:"*/ q12 1 q4"},{n:"adyO",f:"abs dyO"},{n:"q13",f:"*/ adyO sdelO 1"},{n:"q14",f:"*/ DO dxO -1"},{n:"dyF1",f:"+/ q14 q13 q4"},{n:"q15",f:"+- q14 0 q13"},{n:"dyF2",f:"*/ q15 1 q4"},{n:"q16",f:"+- x2O 0 dxF1"},{n:"q17",f:"+- x2O 0 dxF2"},{n:"q18",f:"+- y2O 0 dyF1"},{n:"q19",f:"+- y2O 0 dyF2"},{n:"q20",f:"mod q16 q18 0"},{n:"q21",f:"mod q17 q19 0"},{n:"q22",f:"+- q21 0 q20"},{n:"dxF",f:"?: q22 dxF1 dxF2"},{n:"dyF",f:"?: q22 dyF1 dyF2"},{n:"sdxF",f:"*/ dxF rw1 rO"},{n:"sdyF",f:"*/ dyF rh1 rO"},{n:"xF",f:"+- hc sdxF 0"},{n:"yF",f:"+- vc sdyF 0"},{n:"x1I",f:"*/ sx1 rI rw2"},{n:"y1I",f:"*/ sy1 rI rh2"},{n:"x2I",f:"*/ sx2 rI rw2"},{n:"y2I",f:"*/ sy2 rI rh2"},{n:"dxI",f:"+- x2I 0 x1I"},{n:"dyI",f:"+- y2I 0 y1I"},{n:"dI",f:"mod dxI dyI 0"},{n:"v1",f:"*/ x1I y2I 1"},{n:"v2",f:"*/ x2I y1I 1"},{n:"DI",f:"+- v1 0 v2"},{n:"v3",f:"*/ rI rI 1"},{n:"v4",f:"*/ dI dI 1"},{n:"v5",f:"*/ v3 v4 1"},{n:"v6",f:"*/ DI DI 1"},{n:"v7",f:"+- v5 0 v6"},{n:"v8",f:"max v7 0"},{n:"sdelI",f:"sqrt v8"},{n:"v9",f:"*/ sdyO dxI 1"},{n:"v10",f:"*/ v9 sdelI 1"},{n:"v11",f:"*/ DI dyI 1"},{n:"dxC1",f:"+/ v11 v10 v4"},{n:"v12",f:"+- v11 0 v10"},{n:"dxC2",f:"*/ v12 1 v4"},{n:"adyI",f:"abs dyI"},{n:"v13",f:"*/ adyI sdelI 1"},{n:"v14",f:"*/ DI dxI -1"},{n:"dyC1",f:"+/ v14 v13 v4"},{n:"v15",f:"+- v14 0 v13"},{n:"dyC2",f:"*/ v15 1 v4"},{n:"v16",f:"+- x1I 0 dxC1"},{n:"v17",f:"+- x1I 0 dxC2"},{n:"v18",f:"+- y1I 0 dyC1"},{n:"v19",f:"+- y1I 0 dyC2"},{n:"v20",f:"mod v16 v18 0"},{n:"v21",f:"mod v17 v19 0"},{n:"v22",f:"+- v21 0 v20"},{n:"dxC",f:"?: v22 dxC1 dxC2"},{n:"dyC",f:"?: v22 dyC1 dyC2"},{n:"sdxC",f:"*/ dxC rw2 rI"},{n:"sdyC",f:"*/ dyC rh2 rI"},{n:"xC",f:"+- hc sdxC 0"},{n:"yC",f:"+- vc sdyC 0"},{n:"ist0",f:"at2 sdxC sdyC"},{n:"ist1",f:"+- ist0 21600000 0"},{n:"istAng0",f:"?: ist0 ist0 ist1"},{n:"isw1",f:"+- stAng 0 istAng0"},{n:"isw2",f:"+- isw1 21600000 0"},{n:"iswAng0",f:"?: isw1 isw1 isw2"},{n:"istAng",f:"+- istAng0 iswAng0 0"},{n:"iswAng",f:"+- 0 0 iswAng0"},{n:"p1",f:"+- xF 0 xC"},{n:"p2",f:"+- yF 0 yC"},{n:"p3",f:"mod p1 p2 0"},{n:"p4",f:"*/ p3 1 2"},{n:"p5",f:"+- p4 0 thh"},{n:"xGp",f:"?: p5 xF xG"},{n:"yGp",f:"?: p5 yF yG"},{n:"xBp",f:"?: p5 xC xB"},{n:"yBp",f:"?: p5 yC yB"},{n:"en0",f:"at2 sdxF sdyF"},{n:"en1",f:"+- en0 21600000 0"},{n:"en2",f:"?: en0 en0 en1"},{n:"sw0",f:"+- en2 0 stAng"},{n:"sw1",f:"+- sw0 0 21600000"},{n:"swAng",f:"?: sw0 sw1 sw0"},{n:"stAng0",f:"+- stAng swAng 0"},{n:"swAng0",f:"+- 0 0 swAng"},{n:"wtI",f:"sin rw3 stAng"},{n:"htI",f:"cos rh3 stAng"},{n:"dxI",f:"cat2 rw3 htI wtI"},{n:"dyI",f:"sat2 rh3 htI wtI"},{n:"xI",f:"+- hc dxI 0"},{n:"yI",f:"+- vc dyI 0"},{n:"aI",f:"+- stAng cd4 0"},{n:"aA",f:"+- ptAng 0 cd4"},{n:"aB",f:"+- ptAng cd2 0"},{n:"idx",f:"cos rw1 2700000"},{n:"idy",f:"sin rh1 2700000"},{n:"il",f:"+- hc 0 idx"},{n:"ir",f:"+- hc idx 0"},{n:"it",f:"+- vc 0 idy"},{n:"ib",f:"+- vc idy 0"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"xE",y:"yE"}},{type:"lnTo",pt:{x:"xD",y:"yD"}},{type:"arcTo",wR:"rw2",hR:"rh2",stAng:"istAng",swAng:"iswAng"},{type:"lnTo",pt:{x:"xBp",y:"yBp"}},{type:"lnTo",pt:{x:"xA",y:"yA"}},{type:"lnTo",pt:{x:"xGp",y:"yGp"}},{type:"lnTo",pt:{x:"xF",y:"yF"}},{type:"arcTo",wR:"rw1",hR:"rh1",stAng:"stAng0",swAng:"swAng0"},{type:"close"}],extrusionOk:!1,stroke:!0}]},leftRightArrow:{avLst:[{n:"adj1",f:"val 50000"},{n:"adj2",f:"val 50000"}],gdLst:[{n:"maxAdj2",f:"*/ 50000 w ss"},{n:"a1",f:"pin 0 adj1 100000"},{n:"a2",f:"pin 0 adj2 maxAdj2"},{n:"x2",f:"*/ ss a2 100000"},{n:"x3",f:"+- r 0 x2"},{n:"dy",f:"*/ h a1 200000"},{n:"y1",f:"+- vc 0 dy"},{n:"y2",f:"+- vc dy 0"},{n:"dx1",f:"*/ y1 x2 hd2"},{n:"x1",f:"+- x2 0 dx1"},{n:"x4",f:"+- x3 dx1 0"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"vc"}},{type:"lnTo",pt:{x:"x2",y:"t"}},{type:"lnTo",pt:{x:"x2",y:"y1"}},{type:"lnTo",pt:{x:"x3",y:"y1"}},{type:"lnTo",pt:{x:"x3",y:"t"}},{type:"lnTo",pt:{x:"r",y:"vc"}},{type:"lnTo",pt:{x:"x3",y:"b"}},{type:"lnTo",pt:{x:"x3",y:"y2"}},{type:"lnTo",pt:{x:"x2",y:"y2"}},{type:"lnTo",pt:{x:"x2",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},leftRightArrowCallout:{avLst:[{n:"adj1",f:"val 25000"},{n:"adj2",f:"val 25000"},{n:"adj3",f:"val 25000"},{n:"adj4",f:"val 48123"}],gdLst:[{n:"maxAdj2",f:"*/ 50000 h ss"},{n:"a2",f:"pin 0 adj2 maxAdj2"},{n:"maxAdj1",f:"*/ a2 2 1"},{n:"a1",f:"pin 0 adj1 maxAdj1"},{n:"maxAdj3",f:"*/ 50000 w ss"},{n:"a3",f:"pin 0 adj3 maxAdj3"},{n:"q2",f:"*/ a3 ss wd2"},{n:"maxAdj4",f:"+- 100000 0 q2"},{n:"a4",f:"pin 0 adj4 maxAdj4"},{n:"dy1",f:"*/ ss a2 100000"},{n:"dy2",f:"*/ ss a1 200000"},{n:"y1",f:"+- vc 0 dy1"},{n:"y2",f:"+- vc 0 dy2"},{n:"y3",f:"+- vc dy2 0"},{n:"y4",f:"+- vc dy1 0"},{n:"x1",f:"*/ ss a3 100000"},{n:"x4",f:"+- r 0 x1"},{n:"dx2",f:"*/ w a4 200000"},{n:"x2",f:"+- hc 0 dx2"},{n:"x3",f:"+- hc dx2 0"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"vc"}},{type:"lnTo",pt:{x:"x1",y:"y1"}},{type:"lnTo",pt:{x:"x1",y:"y2"}},{type:"lnTo",pt:{x:"x2",y:"y2"}},{type:"lnTo",pt:{x:"x2",y:"t"}},{type:"lnTo",pt:{x:"x3",y:"t"}},{type:"lnTo",pt:{x:"x3",y:"y2"}},{type:"lnTo",pt:{x:"x4",y:"y2"}},{type:"lnTo",pt:{x:"x4",y:"y1"}},{type:"lnTo",pt:{x:"r",y:"vc"}},{type:"lnTo",pt:{x:"x4",y:"y4"}},{type:"lnTo",pt:{x:"x4",y:"y3"}},{type:"lnTo",pt:{x:"x3",y:"y3"}},{type:"lnTo",pt:{x:"x3",y:"b"}},{type:"lnTo",pt:{x:"x2",y:"b"}},{type:"lnTo",pt:{x:"x2",y:"y3"}},{type:"lnTo",pt:{x:"x1",y:"y3"}},{type:"lnTo",pt:{x:"x1",y:"y4"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},leftRightCircularArrow:{avLst:[{n:"adj1",f:"val 12500"},{n:"adj2",f:"val 1142319"},{n:"adj3",f:"val 20457681"},{n:"adj4",f:"val 11942319"},{n:"adj5",f:"val 12500"}],gdLst:[{n:"a5",f:"pin 0 adj5 25000"},{n:"maxAdj1",f:"*/ a5 2 1"},{n:"a1",f:"pin 0 adj1 maxAdj1"},{n:"enAng",f:"pin 1 adj3 21599999"},{n:"stAng",f:"pin 0 adj4 21599999"},{n:"th",f:"*/ ss a1 100000"},{n:"thh",f:"*/ ss a5 100000"},{n:"th2",f:"*/ th 1 2"},{n:"rw1",f:"+- wd2 th2 thh"},{n:"rh1",f:"+- hd2 th2 thh"},{n:"rw2",f:"+- rw1 0 th"},{n:"rh2",f:"+- rh1 0 th"},{n:"rw3",f:"+- rw2 th2 0"},{n:"rh3",f:"+- rh2 th2 0"},{n:"wtH",f:"sin rw3 enAng"},{n:"htH",f:"cos rh3 enAng"},{n:"dxH",f:"cat2 rw3 htH wtH"},{n:"dyH",f:"sat2 rh3 htH wtH"},{n:"xH",f:"+- hc dxH 0"},{n:"yH",f:"+- vc dyH 0"},{n:"rI",f:"min rw2 rh2"},{n:"u1",f:"*/ dxH dxH 1"},{n:"u2",f:"*/ dyH dyH 1"},{n:"u3",f:"*/ rI rI 1"},{n:"u4",f:"+- u1 0 u3"},{n:"u5",f:"+- u2 0 u3"},{n:"u6",f:"*/ u4 u5 u1"},{n:"u7",f:"*/ u6 1 u2"},{n:"u8",f:"+- 1 0 u7"},{n:"u9",f:"sqrt u8"},{n:"u10",f:"*/ u4 1 dxH"},{n:"u11",f:"*/ u10 1 dyH"},{n:"u12",f:"+/ 1 u9 u11"},{n:"u13",f:"at2 1 u12"},{n:"u14",f:"+- u13 21600000 0"},{n:"u15",f:"?: u13 u13 u14"},{n:"u16",f:"+- u15 0 enAng"},{n:"u17",f:"+- u16 21600000 0"},{n:"u18",f:"?: u16 u16 u17"},{n:"u19",f:"+- u18 0 cd2"},{n:"u20",f:"+- u18 0 21600000"},{n:"u21",f:"?: u19 u20 u18"},{n:"maxAng",f:"abs u21"},{n:"aAng",f:"pin 0 adj2 maxAng"},{n:"ptAng",f:"+- enAng aAng 0"},{n:"wtA",f:"sin rw3 ptAng"},{n:"htA",f:"cos rh3 ptAng"},{n:"dxA",f:"cat2 rw3 htA wtA"},{n:"dyA",f:"sat2 rh3 htA wtA"},{n:"xA",f:"+- hc dxA 0"},{n:"yA",f:"+- vc dyA 0"},{n:"dxG",f:"cos thh ptAng"},{n:"dyG",f:"sin thh ptAng"},{n:"xG",f:"+- xH dxG 0"},{n:"yG",f:"+- yH dyG 0"},{n:"dxB",f:"cos thh ptAng"},{n:"dyB",f:"sin thh ptAng"},{n:"xB",f:"+- xH 0 dxB 0"},{n:"yB",f:"+- yH 0 dyB 0"},{n:"sx1",f:"+- xB 0 hc"},{n:"sy1",f:"+- yB 0 vc"},{n:"sx2",f:"+- xG 0 hc"},{n:"sy2",f:"+- yG 0 vc"},{n:"rO",f:"min rw1 rh1"},{n:"x1O",f:"*/ sx1 rO rw1"},{n:"y1O",f:"*/ sy1 rO rh1"},{n:"x2O",f:"*/ sx2 rO rw1"},{n:"y2O",f:"*/ sy2 rO rh1"},{n:"dxO",f:"+- x2O 0 x1O"},{n:"dyO",f:"+- y2O 0 y1O"},{n:"dO",f:"mod dxO dyO 0"},{n:"q1",f:"*/ x1O y2O 1"},{n:"q2",f:"*/ x2O y1O 1"},{n:"DO",f:"+- q1 0 q2"},{n:"q3",f:"*/ rO rO 1"},{n:"q4",f:"*/ dO dO 1"},{n:"q5",f:"*/ q3 q4 1"},{n:"q6",f:"*/ DO DO 1"},{n:"q7",f:"+- q5 0 q6"},{n:"q8",f:"max q7 0"},{n:"sdelO",f:"sqrt q8"},{n:"ndyO",f:"*/ dyO -1 1"},{n:"sdyO",f:"?: ndyO -1 1"},{n:"q9",f:"*/ sdyO dxO 1"},{n:"q10",f:"*/ q9 sdelO 1"},{n:"q11",f:"*/ DO dyO 1"},{n:"dxF1",f:"+/ q11 q10 q4"},{n:"q12",f:"+- q11 0 q10"},{n:"dxF2",f:"*/ q12 1 q4"},{n:"adyO",f:"abs dyO"},{n:"q13",f:"*/ adyO sdelO 1"},{n:"q14",f:"*/ DO dxO -1"},{n:"dyF1",f:"+/ q14 q13 q4"},{n:"q15",f:"+- q14 0 q13"},{n:"dyF2",f:"*/ q15 1 q4"},{n:"q16",f:"+- x2O 0 dxF1"},{n:"q17",f:"+- x2O 0 dxF2"},{n:"q18",f:"+- y2O 0 dyF1"},{n:"q19",f:"+- y2O 0 dyF2"},{n:"q20",f:"mod q16 q18 0"},{n:"q21",f:"mod q17 q19 0"},{n:"q22",f:"+- q21 0 q20"},{n:"dxF",f:"?: q22 dxF1 dxF2"},{n:"dyF",f:"?: q22 dyF1 dyF2"},{n:"sdxF",f:"*/ dxF rw1 rO"},{n:"sdyF",f:"*/ dyF rh1 rO"},{n:"xF",f:"+- hc sdxF 0"},{n:"yF",f:"+- vc sdyF 0"},{n:"x1I",f:"*/ sx1 rI rw2"},{n:"y1I",f:"*/ sy1 rI rh2"},{n:"x2I",f:"*/ sx2 rI rw2"},{n:"y2I",f:"*/ sy2 rI rh2"},{n:"dxI",f:"+- x2I 0 x1I"},{n:"dyI",f:"+- y2I 0 y1I"},{n:"dI",f:"mod dxI dyI 0"},{n:"v1",f:"*/ x1I y2I 1"},{n:"v2",f:"*/ x2I y1I 1"},{n:"DI",f:"+- v1 0 v2"},{n:"v3",f:"*/ rI rI 1"},{n:"v4",f:"*/ dI dI 1"},{n:"v5",f:"*/ v3 v4 1"},{n:"v6",f:"*/ DI DI 1"},{n:"v7",f:"+- v5 0 v6"},{n:"v8",f:"max v7 0"},{n:"sdelI",f:"sqrt v8"},{n:"v9",f:"*/ sdyO dxI 1"},{n:"v10",f:"*/ v9 sdelI 1"},{n:"v11",f:"*/ DI dyI 1"},{n:"dxC1",f:"+/ v11 v10 v4"},{n:"v12",f:"+- v11 0 v10"},{n:"dxC2",f:"*/ v12 1 v4"},{n:"adyI",f:"abs dyI"},{n:"v13",f:"*/ adyI sdelI 1"},{n:"v14",f:"*/ DI dxI -1"},{n:"dyC1",f:"+/ v14 v13 v4"},{n:"v15",f:"+- v14 0 v13"},{n:"dyC2",f:"*/ v15 1 v4"},{n:"v16",f:"+- x1I 0 dxC1"},{n:"v17",f:"+- x1I 0 dxC2"},{n:"v18",f:"+- y1I 0 dyC1"},{n:"v19",f:"+- y1I 0 dyC2"},{n:"v20",f:"mod v16 v18 0"},{n:"v21",f:"mod v17 v19 0"},{n:"v22",f:"+- v21 0 v20"},{n:"dxC",f:"?: v22 dxC1 dxC2"},{n:"dyC",f:"?: v22 dyC1 dyC2"},{n:"sdxC",f:"*/ dxC rw2 rI"},{n:"sdyC",f:"*/ dyC rh2 rI"},{n:"xC",f:"+- hc sdxC 0"},{n:"yC",f:"+- vc sdyC 0"},{n:"wtI",f:"sin rw3 stAng"},{n:"htI",f:"cos rh3 stAng"},{n:"dxI",f:"cat2 rw3 htI wtI"},{n:"dyI",f:"sat2 rh3 htI wtI"},{n:"xI",f:"+- hc dxI 0"},{n:"yI",f:"+- vc dyI 0"},{n:"lptAng",f:"+- stAng 0 aAng"},{n:"wtL",f:"sin rw3 lptAng"},{n:"htL",f:"cos rh3 lptAng"},{n:"dxL",f:"cat2 rw3 htL wtL"},{n:"dyL",f:"sat2 rh3 htL wtL"},{n:"xL",f:"+- hc dxL 0"},{n:"yL",f:"+- vc dyL 0"},{n:"dxK",f:"cos thh lptAng"},{n:"dyK",f:"sin thh lptAng"},{n:"xK",f:"+- xI dxK 0"},{n:"yK",f:"+- yI dyK 0"},{n:"dxJ",f:"cos thh lptAng"},{n:"dyJ",f:"sin thh lptAng"},{n:"xJ",f:"+- xI 0 dxJ 0"},{n:"yJ",f:"+- yI 0 dyJ 0"},{n:"p1",f:"+- xF 0 xC"},{n:"p2",f:"+- yF 0 yC"},{n:"p3",f:"mod p1 p2 0"},{n:"p4",f:"*/ p3 1 2"},{n:"p5",f:"+- p4 0 thh"},{n:"xGp",f:"?: p5 xF xG"},{n:"yGp",f:"?: p5 yF yG"},{n:"xBp",f:"?: p5 xC xB"},{n:"yBp",f:"?: p5 yC yB"},{n:"en0",f:"at2 sdxF sdyF"},{n:"en1",f:"+- en0 21600000 0"},{n:"en2",f:"?: en0 en0 en1"},{n:"od0",f:"+- en2 0 enAng"},{n:"od1",f:"+- od0 21600000 0"},{n:"od2",f:"?: od0 od0 od1"},{n:"st0",f:"+- stAng 0 od2"},{n:"st1",f:"+- st0 21600000 0"},{n:"st2",f:"?: st0 st0 st1"},{n:"sw0",f:"+- en2 0 st2"},{n:"sw1",f:"+- sw0 21600000 0"},{n:"swAng",f:"?: sw0 sw0 sw1"},{n:"ist0",f:"at2 sdxC sdyC"},{n:"ist1",f:"+- ist0 21600000 0"},{n:"istAng",f:"?: ist0 ist0 ist1"},{n:"id0",f:"+- istAng 0 enAng"},{n:"id1",f:"+- id0 0 21600000"},{n:"id2",f:"?: id0 id1 id0"},{n:"ien0",f:"+- stAng 0 id2"},{n:"ien1",f:"+- ien0 0 21600000"},{n:"ien2",f:"?: ien1 ien1 ien0"},{n:"isw1",f:"+- ien2 0 istAng"},{n:"isw2",f:"+- isw1 0 21600000"},{n:"iswAng",f:"?: isw1 isw2 isw1"},{n:"wtE",f:"sin rw1 st2"},{n:"htE",f:"cos rh1 st2"},{n:"dxE",f:"cat2 rw1 htE wtE"},{n:"dyE",f:"sat2 rh1 htE wtE"},{n:"xE",f:"+- hc dxE 0"},{n:"yE",f:"+- vc dyE 0"},{n:"wtD",f:"sin rw2 ien2"},{n:"htD",f:"cos rh2 ien2"},{n:"dxD",f:"cat2 rw2 htD wtD"},{n:"dyD",f:"sat2 rh2 htD wtD"},{n:"xD",f:"+- hc dxD 0"},{n:"yD",f:"+- vc dyD 0"},{n:"xKp",f:"?: p5 xE xK"},{n:"yKp",f:"?: p5 yE yK"},{n:"xJp",f:"?: p5 xD xJ"},{n:"yJp",f:"?: p5 yD yJ"},{n:"aL",f:"+- lptAng 0 cd4"},{n:"aA",f:"+- ptAng cd4 0"},{n:"aB",f:"+- ptAng cd2 0"},{n:"aJ",f:"+- lptAng cd2 0"},{n:"idx",f:"cos rw1 2700000"},{n:"idy",f:"sin rh1 2700000"},{n:"il",f:"+- hc 0 idx"},{n:"ir",f:"+- hc idx 0"},{n:"it",f:"+- vc 0 idy"},{n:"ib",f:"+- vc idy 0"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"xL",y:"yL"}},{type:"lnTo",pt:{x:"xKp",y:"yKp"}},{type:"lnTo",pt:{x:"xE",y:"yE"}},{type:"arcTo",wR:"rw1",hR:"rh1",stAng:"st2",swAng:"swAng"},{type:"lnTo",pt:{x:"xGp",y:"yGp"}},{type:"lnTo",pt:{x:"xA",y:"yA"}},{type:"lnTo",pt:{x:"xBp",y:"yBp"}},{type:"lnTo",pt:{x:"xC",y:"yC"}},{type:"arcTo",wR:"rw2",hR:"rh2",stAng:"istAng",swAng:"iswAng"},{type:"lnTo",pt:{x:"xJp",y:"yJp"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},leftRightRibbon:{avLst:[{n:"adj1",f:"val 50000"},{n:"adj2",f:"val 50000"},{n:"adj3",f:"val 16667"}],gdLst:[{n:"a3",f:"pin 0 adj3 33333"},{n:"maxAdj1",f:"+- 100000 0 a3"},{n:"a1",f:"pin 0 adj1 maxAdj1"},{n:"w1",f:"+- wd2 0 wd32"},{n:"maxAdj2",f:"*/ 100000 w1 ss"},{n:"a2",f:"pin 0 adj2 maxAdj2"},{n:"x1",f:"*/ ss a2 100000"},{n:"x4",f:"+- r 0 x1"},{n:"dy1",f:"*/ h a1 200000"},{n:"dy2",f:"*/ h a3 -200000"},{n:"ly1",f:"+- vc dy2 dy1"},{n:"ry4",f:"+- vc dy1 dy2"},{n:"ly2",f:"+- ly1 dy1 0"},{n:"ry3",f:"+- b 0 ly2"},{n:"ly4",f:"*/ ly2 2 1"},{n:"ry1",f:"+- b 0 ly4"},{n:"ly3",f:"+- ly4 0 ly1"},{n:"ry2",f:"+- b 0 ly3"},{n:"hR",f:"*/ a3 ss 400000"},{n:"x2",f:"+- hc 0 wd32"},{n:"x3",f:"+- hc wd32 0"},{n:"y1",f:"+- ly1 hR 0"},{n:"y2",f:"+- ry2 0 hR"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"ly2"}},{type:"lnTo",pt:{x:"x1",y:"t"}},{type:"lnTo",pt:{x:"x1",y:"ly1"}},{type:"lnTo",pt:{x:"hc",y:"ly1"}},{type:"arcTo",wR:"wd32",hR:"hR",stAng:"3cd4",swAng:"cd2"},{type:"arcTo",wR:"wd32",hR:"hR",stAng:"3cd4",swAng:"-10800000"},{type:"lnTo",pt:{x:"x4",y:"ry2"}},{type:"lnTo",pt:{x:"x4",y:"ry1"}},{type:"lnTo",pt:{x:"r",y:"ry3"}},{type:"lnTo",pt:{x:"x4",y:"b"}},{type:"lnTo",pt:{x:"x4",y:"ry4"}},{type:"lnTo",pt:{x:"hc",y:"ry4"}},{type:"arcTo",wR:"wd32",hR:"hR",stAng:"cd4",swAng:"cd4"},{type:"lnTo",pt:{x:"x2",y:"ly3"}},{type:"lnTo",pt:{x:"x1",y:"ly3"}},{type:"lnTo",pt:{x:"x1",y:"ly4"}},{type:"close"}],extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"x3",y:"y1"}},{type:"arcTo",wR:"wd32",hR:"hR",stAng:"0",swAng:"cd4"},{type:"arcTo",wR:"wd32",hR:"hR",stAng:"3cd4",swAng:"-10800000"},{type:"lnTo",pt:{x:"x3",y:"ry2"}},{type:"close"}],fill:"darkenLess",extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"l",y:"ly2"}},{type:"lnTo",pt:{x:"x1",y:"t"}},{type:"lnTo",pt:{x:"x1",y:"ly1"}},{type:"lnTo",pt:{x:"hc",y:"ly1"}},{type:"arcTo",wR:"wd32",hR:"hR",stAng:"3cd4",swAng:"cd2"},{type:"arcTo",wR:"wd32",hR:"hR",stAng:"3cd4",swAng:"-10800000"},{type:"lnTo",pt:{x:"x4",y:"ry2"}},{type:"lnTo",pt:{x:"x4",y:"ry1"}},{type:"lnTo",pt:{x:"r",y:"ry3"}},{type:"lnTo",pt:{x:"x4",y:"b"}},{type:"lnTo",pt:{x:"x4",y:"ry4"}},{type:"lnTo",pt:{x:"hc",y:"ry4"}},{type:"arcTo",wR:"wd32",hR:"hR",stAng:"cd4",swAng:"cd4"},{type:"lnTo",pt:{x:"x2",y:"ly3"}},{type:"lnTo",pt:{x:"x1",y:"ly3"}},{type:"lnTo",pt:{x:"x1",y:"ly4"}},{type:"close"},{type:"moveTo",pt:{x:"x3",y:"y1"}},{type:"lnTo",pt:{x:"x3",y:"ry2"}},{type:"moveTo",pt:{x:"x2",y:"y2"}},{type:"lnTo",pt:{x:"x2",y:"ly3"}}],fill:"none",extrusionOk:!1,stroke:!0}]},leftRightUpArrow:{avLst:[{n:"adj1",f:"val 25000"},{n:"adj2",f:"val 25000"},{n:"adj3",f:"val 25000"}],gdLst:[{n:"a2",f:"pin 0 adj2 50000"},{n:"maxAdj1",f:"*/ a2 2 1"},{n:"a1",f:"pin 0 adj1 maxAdj1"},{n:"q1",f:"+- 100000 0 maxAdj1"},{n:"maxAdj3",f:"*/ q1 1 2"},{n:"a3",f:"pin 0 adj3 maxAdj3"},{n:"x1",f:"*/ ss a3 100000"},{n:"dx2",f:"*/ ss a2 100000"},{n:"x2",f:"+- hc 0 dx2"},{n:"x5",f:"+- hc dx2 0"},{n:"dx3",f:"*/ ss a1 200000"},{n:"x3",f:"+- hc 0 dx3"},{n:"x4",f:"+- hc dx3 0"},{n:"x6",f:"+- r 0 x1"},{n:"dy2",f:"*/ ss a2 50000"},{n:"y2",f:"+- b 0 dy2"},{n:"y4",f:"+- b 0 dx2"},{n:"y3",f:"+- y4 0 dx3"},{n:"y5",f:"+- y4 dx3 0"},{n:"il",f:"*/ dx3 x1 dx2"},{n:"ir",f:"+- r 0 il"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"y4"}},{type:"lnTo",pt:{x:"x1",y:"y2"}},{type:"lnTo",pt:{x:"x1",y:"y3"}},{type:"lnTo",pt:{x:"x3",y:"y3"}},{type:"lnTo",pt:{x:"x3",y:"x1"}},{type:"lnTo",pt:{x:"x2",y:"x1"}},{type:"lnTo",pt:{x:"hc",y:"t"}},{type:"lnTo",pt:{x:"x5",y:"x1"}},{type:"lnTo",pt:{x:"x4",y:"x1"}},{type:"lnTo",pt:{x:"x4",y:"y3"}},{type:"lnTo",pt:{x:"x6",y:"y3"}},{type:"lnTo",pt:{x:"x6",y:"y2"}},{type:"lnTo",pt:{x:"r",y:"y4"}},{type:"lnTo",pt:{x:"x6",y:"b"}},{type:"lnTo",pt:{x:"x6",y:"y5"}},{type:"lnTo",pt:{x:"x1",y:"y5"}},{type:"lnTo",pt:{x:"x1",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},leftUpArrow:{avLst:[{n:"adj1",f:"val 25000"},{n:"adj2",f:"val 25000"},{n:"adj3",f:"val 25000"}],gdLst:[{n:"a2",f:"pin 0 adj2 50000"},{n:"maxAdj1",f:"*/ a2 2 1"},{n:"a1",f:"pin 0 adj1 maxAdj1"},{n:"maxAdj3",f:"+- 100000 0 maxAdj1"},{n:"a3",f:"pin 0 adj3 maxAdj3"},{n:"x1",f:"*/ ss a3 100000"},{n:"dx2",f:"*/ ss a2 50000"},{n:"x2",f:"+- r 0 dx2"},{n:"y2",f:"+- b 0 dx2"},{n:"dx4",f:"*/ ss a2 100000"},{n:"x4",f:"+- r 0 dx4"},{n:"y4",f:"+- b 0 dx4"},{n:"dx3",f:"*/ ss a1 200000"},{n:"x3",f:"+- x4 0 dx3"},{n:"x5",f:"+- x4 dx3 0"},{n:"y3",f:"+- y4 0 dx3"},{n:"y5",f:"+- y4 dx3 0"},{n:"il",f:"*/ dx3 x1 dx4"},{n:"cx1",f:"+/ x1 x5 2"},{n:"cy1",f:"+/ x1 y5 2"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"y4"}},{type:"lnTo",pt:{x:"x1",y:"y2"}},{type:"lnTo",pt:{x:"x1",y:"y3"}},{type:"lnTo",pt:{x:"x3",y:"y3"}},{type:"lnTo",pt:{x:"x3",y:"x1"}},{type:"lnTo",pt:{x:"x2",y:"x1"}},{type:"lnTo",pt:{x:"x4",y:"t"}},{type:"lnTo",pt:{x:"r",y:"x1"}},{type:"lnTo",pt:{x:"x5",y:"x1"}},{type:"lnTo",pt:{x:"x5",y:"y5"}},{type:"lnTo",pt:{x:"x1",y:"y5"}},{type:"lnTo",pt:{x:"x1",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},lightningBolt:{gdLst:[{n:"x1",f:"*/ w 5022 21600"},{n:"x3",f:"*/ w 8472 21600"},{n:"x4",f:"*/ w 8757 21600"},{n:"x5",f:"*/ w 10012 21600"},{n:"x8",f:"*/ w 12860 21600"},{n:"x9",f:"*/ w 13917 21600"},{n:"x11",f:"*/ w 16577 21600"},{n:"y1",f:"*/ h 3890 21600"},{n:"y2",f:"*/ h 6080 21600"},{n:"y4",f:"*/ h 7437 21600"},{n:"y6",f:"*/ h 9705 21600"},{n:"y7",f:"*/ h 12007 21600"},{n:"y10",f:"*/ h 14277 21600"},{n:"y11",f:"*/ h 14915 21600"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"8472",y:"0"}},{type:"lnTo",pt:{x:"12860",y:"6080"}},{type:"lnTo",pt:{x:"11050",y:"6797"}},{type:"lnTo",pt:{x:"16577",y:"12007"}},{type:"lnTo",pt:{x:"14767",y:"12877"}},{type:"lnTo",pt:{x:"21600",y:"21600"}},{type:"lnTo",pt:{x:"10012",y:"14915"}},{type:"lnTo",pt:{x:"12222",y:"13987"}},{type:"lnTo",pt:{x:"5022",y:"9705"}},{type:"lnTo",pt:{x:"7602",y:"8382"}},{type:"lnTo",pt:{x:"0",y:"3890"}},{type:"close"}],extrusionOk:!1,stroke:!0,w:21600,h:21600}]},line:{pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}}],extrusionOk:!1,stroke:!0}]},lineInv:{pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"b"}},{type:"lnTo",pt:{x:"r",y:"t"}}],extrusionOk:!1,stroke:!0}]},mathDivide:{avLst:[{n:"adj1",f:"val 23520"},{n:"adj2",f:"val 5880"},{n:"adj3",f:"val 11760"}],gdLst:[{n:"a1",f:"pin 1000 adj1 36745"},{n:"ma1",f:"+- 0 0 a1"},{n:"ma3h",f:"+/ 73490 ma1 4"},{n:"ma3w",f:"*/ 36745 w h"},{n:"maxAdj3",f:"min ma3h ma3w"},{n:"a3",f:"pin 1000 adj3 maxAdj3"},{n:"m4a3",f:"*/ -4 a3 1"},{n:"maxAdj2",f:"+- 73490 m4a3 a1"},{n:"a2",f:"pin 0 adj2 maxAdj2"},{n:"dy1",f:"*/ h a1 200000"},{n:"yg",f:"*/ h a2 100000"},{n:"rad",f:"*/ h a3 100000"},{n:"dx1",f:"*/ w 73490 200000"},{n:"y3",f:"+- vc 0 dy1"},{n:"y4",f:"+- vc dy1 0"},{n:"a",f:"+- yg rad 0"},{n:"y2",f:"+- y3 0 a"},{n:"y1",f:"+- y2 0 rad"},{n:"y5",f:"+- b 0 y1"},{n:"x1",f:"+- hc 0 dx1"},{n:"x3",f:"+- hc dx1 0"},{n:"x2",f:"+- hc 0 rad"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"hc",y:"y1"}},{type:"arcTo",wR:"rad",hR:"rad",stAng:"3cd4",swAng:"21600000"},{type:"close"},{type:"moveTo",pt:{x:"hc",y:"y5"}},{type:"arcTo",wR:"rad",hR:"rad",stAng:"cd4",swAng:"21600000"},{type:"close"},{type:"moveTo",pt:{x:"x1",y:"y3"}},{type:"lnTo",pt:{x:"x3",y:"y3"}},{type:"lnTo",pt:{x:"x3",y:"y4"}},{type:"lnTo",pt:{x:"x1",y:"y4"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},mathEqual:{avLst:[{n:"adj1",f:"val 23520"},{n:"adj2",f:"val 11760"}],gdLst:[{n:"a1",f:"pin 0 adj1 36745"},{n:"2a1",f:"*/ a1 2 1"},{n:"mAdj2",f:"+- 100000 0 2a1"},{n:"a2",f:"pin 0 adj2 mAdj2"},{n:"dy1",f:"*/ h a1 100000"},{n:"dy2",f:"*/ h a2 200000"},{n:"dx1",f:"*/ w 73490 200000"},{n:"y2",f:"+- vc 0 dy2"},{n:"y3",f:"+- vc dy2 0"},{n:"y1",f:"+- y2 0 dy1"},{n:"y4",f:"+- y3 dy1 0"},{n:"x1",f:"+- hc 0 dx1"},{n:"x2",f:"+- hc dx1 0"},{n:"yC1",f:"+/ y1 y2 2"},{n:"yC2",f:"+/ y3 y4 2"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"x1",y:"y1"}},{type:"lnTo",pt:{x:"x2",y:"y1"}},{type:"lnTo",pt:{x:"x2",y:"y2"}},{type:"lnTo",pt:{x:"x1",y:"y2"}},{type:"close"},{type:"moveTo",pt:{x:"x1",y:"y3"}},{type:"lnTo",pt:{x:"x2",y:"y3"}},{type:"lnTo",pt:{x:"x2",y:"y4"}},{type:"lnTo",pt:{x:"x1",y:"y4"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},mathMinus:{avLst:[{n:"adj1",f:"val 23520"}],gdLst:[{n:"a1",f:"pin 0 adj1 100000"},{n:"dy1",f:"*/ h a1 200000"},{n:"dx1",f:"*/ w 73490 200000"},{n:"y1",f:"+- vc 0 dy1"},{n:"y2",f:"+- vc dy1 0"},{n:"x1",f:"+- hc 0 dx1"},{n:"x2",f:"+- hc dx1 0"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"x1",y:"y1"}},{type:"lnTo",pt:{x:"x2",y:"y1"}},{type:"lnTo",pt:{x:"x2",y:"y2"}},{type:"lnTo",pt:{x:"x1",y:"y2"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},mathMultiply:{avLst:[{n:"adj1",f:"val 23520"}],gdLst:[{n:"a1",f:"pin 0 adj1 51965"},{n:"th",f:"*/ ss a1 100000"},{n:"a",f:"at2 w h"},{n:"sa",f:"sin 1 a"},{n:"ca",f:"cos 1 a"},{n:"ta",f:"tan 1 a"},{n:"dl",f:"mod w h 0"},{n:"rw",f:"*/ dl 51965 100000"},{n:"lM",f:"+- dl 0 rw"},{n:"xM",f:"*/ ca lM 2"},{n:"yM",f:"*/ sa lM 2"},{n:"dxAM",f:"*/ sa th 2"},{n:"dyAM",f:"*/ ca th 2"},{n:"xA",f:"+- xM 0 dxAM"},{n:"yA",f:"+- yM dyAM 0"},{n:"xB",f:"+- xM dxAM 0"},{n:"yB",f:"+- yM 0 dyAM"},{n:"xBC",f:"+- hc 0 xB"},{n:"yBC",f:"*/ xBC ta 1"},{n:"yC",f:"+- yBC yB 0"},{n:"xD",f:"+- r 0 xB"},{n:"xE",f:"+- r 0 xA"},{n:"yFE",f:"+- vc 0 yA"},{n:"xFE",f:"*/ yFE 1 ta"},{n:"xF",f:"+- xE 0 xFE"},{n:"xL",f:"+- xA xFE 0"},{n:"yG",f:"+- b 0 yA"},{n:"yH",f:"+- b 0 yB"},{n:"yI",f:"+- b 0 yC"},{n:"xC2",f:"+- r 0 xM"},{n:"yC3",f:"+- b 0 yM"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"xA",y:"yA"}},{type:"lnTo",pt:{x:"xB",y:"yB"}},{type:"lnTo",pt:{x:"hc",y:"yC"}},{type:"lnTo",pt:{x:"xD",y:"yB"}},{type:"lnTo",pt:{x:"xE",y:"yA"}},{type:"lnTo",pt:{x:"xF",y:"vc"}},{type:"lnTo",pt:{x:"xE",y:"yG"}},{type:"lnTo",pt:{x:"xD",y:"yH"}},{type:"lnTo",pt:{x:"hc",y:"yI"}},{type:"lnTo",pt:{x:"xB",y:"yH"}},{type:"lnTo",pt:{x:"xA",y:"yG"}},{type:"lnTo",pt:{x:"xL",y:"vc"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},mathNotEqual:{avLst:[{n:"adj1",f:"val 23520"},{n:"adj2",f:"val 6600000"},{n:"adj3",f:"val 11760"}],gdLst:[{n:"a1",f:"pin 0 adj1 50000"},{n:"crAng",f:"pin 4200000 adj2 6600000"},{n:"2a1",f:"*/ a1 2 1"},{n:"maxAdj3",f:"+- 100000 0 2a1"},{n:"a3",f:"pin 0 adj3 maxAdj3"},{n:"dy1",f:"*/ h a1 100000"},{n:"dy2",f:"*/ h a3 200000"},{n:"dx1",f:"*/ w 73490 200000"},{n:"x1",f:"+- hc 0 dx1"},{n:"x8",f:"+- hc dx1 0"},{n:"y2",f:"+- vc 0 dy2"},{n:"y3",f:"+- vc dy2 0"},{n:"y1",f:"+- y2 0 dy1"},{n:"y4",f:"+- y3 dy1 0"},{n:"cadj2",f:"+- crAng 0 cd4"},{n:"xadj2",f:"tan hd2 cadj2"},{n:"len",f:"mod xadj2 hd2 0"},{n:"bhw",f:"*/ len dy1 hd2"},{n:"bhw2",f:"*/ bhw 1 2"},{n:"x7",f:"+- hc xadj2 bhw2"},{n:"dx67",f:"*/ xadj2 y1 hd2"},{n:"x6",f:"+- x7 0 dx67"},{n:"dx57",f:"*/ xadj2 y2 hd2"},{n:"x5",f:"+- x7 0 dx57"},{n:"dx47",f:"*/ xadj2 y3 hd2"},{n:"x4",f:"+- x7 0 dx47"},{n:"dx37",f:"*/ xadj2 y4 hd2"},{n:"x3",f:"+- x7 0 dx37"},{n:"dx27",f:"*/ xadj2 2 1"},{n:"x2",f:"+- x7 0 dx27"},{n:"rx7",f:"+- x7 bhw 0"},{n:"rx6",f:"+- x6 bhw 0"},{n:"rx5",f:"+- x5 bhw 0"},{n:"rx4",f:"+- x4 bhw 0"},{n:"rx3",f:"+- x3 bhw 0"},{n:"rx2",f:"+- x2 bhw 0"},{n:"dx7",f:"*/ dy1 hd2 len"},{n:"rxt",f:"+- x7 dx7 0"},{n:"lxt",f:"+- rx7 0 dx7"},{n:"rx",f:"?: cadj2 rxt rx7"},{n:"lx",f:"?: cadj2 x7 lxt"},{n:"dy3",f:"*/ dy1 xadj2 len"},{n:"dy4",f:"+- 0 0 dy3"},{n:"ry",f:"?: cadj2 dy3 t"},{n:"ly",f:"?: cadj2 t dy4"},{n:"dlx",f:"+- w 0 rx"},{n:"drx",f:"+- w 0 lx"},{n:"dly",f:"+- h 0 ry"},{n:"dry",f:"+- h 0 ly"},{n:"xC1",f:"+/ rx lx 2"},{n:"xC2",f:"+/ drx dlx 2"},{n:"yC1",f:"+/ ry ly 2"},{n:"yC2",f:"+/ y1 y2 2"},{n:"yC3",f:"+/ y3 y4 2"},{n:"yC4",f:"+/ dry dly 2"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"x1",y:"y1"}},{type:"lnTo",pt:{x:"x6",y:"y1"}},{type:"lnTo",pt:{x:"lx",y:"ly"}},{type:"lnTo",pt:{x:"rx",y:"ry"}},{type:"lnTo",pt:{x:"rx6",y:"y1"}},{type:"lnTo",pt:{x:"x8",y:"y1"}},{type:"lnTo",pt:{x:"x8",y:"y2"}},{type:"lnTo",pt:{x:"rx5",y:"y2"}},{type:"lnTo",pt:{x:"rx4",y:"y3"}},{type:"lnTo",pt:{x:"x8",y:"y3"}},{type:"lnTo",pt:{x:"x8",y:"y4"}},{type:"lnTo",pt:{x:"rx3",y:"y4"}},{type:"lnTo",pt:{x:"drx",y:"dry"}},{type:"lnTo",pt:{x:"dlx",y:"dly"}},{type:"lnTo",pt:{x:"x3",y:"y4"}},{type:"lnTo",pt:{x:"x1",y:"y4"}},{type:"lnTo",pt:{x:"x1",y:"y3"}},{type:"lnTo",pt:{x:"x4",y:"y3"}},{type:"lnTo",pt:{x:"x5",y:"y2"}},{type:"lnTo",pt:{x:"x1",y:"y2"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},mathPlus:{avLst:[{n:"adj1",f:"val 23520"}],gdLst:[{n:"a1",f:"pin 0 adj1 73490"},{n:"dx1",f:"*/ w 73490 200000"},{n:"dy1",f:"*/ h 73490 200000"},{n:"dx2",f:"*/ ss a1 200000"},{n:"x1",f:"+- hc 0 dx1"},{n:"x2",f:"+- hc 0 dx2"},{n:"x3",f:"+- hc dx2 0"},{n:"x4",f:"+- hc dx1 0"},{n:"y1",f:"+- vc 0 dy1"},{n:"y2",f:"+- vc 0 dx2"},{n:"y3",f:"+- vc dx2 0"},{n:"y4",f:"+- vc dy1 0"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"x1",y:"y2"}},{type:"lnTo",pt:{x:"x2",y:"y2"}},{type:"lnTo",pt:{x:"x2",y:"y1"}},{type:"lnTo",pt:{x:"x3",y:"y1"}},{type:"lnTo",pt:{x:"x3",y:"y2"}},{type:"lnTo",pt:{x:"x4",y:"y2"}},{type:"lnTo",pt:{x:"x4",y:"y3"}},{type:"lnTo",pt:{x:"x3",y:"y3"}},{type:"lnTo",pt:{x:"x3",y:"y4"}},{type:"lnTo",pt:{x:"x2",y:"y4"}},{type:"lnTo",pt:{x:"x2",y:"y3"}},{type:"lnTo",pt:{x:"x1",y:"y3"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},moon:{avLst:[{n:"adj",f:"val 50000"}],gdLst:[{n:"a",f:"pin 0 adj 87500"},{n:"g0",f:"*/ ss a 100000"},{n:"g0w",f:"*/ g0 w ss"},{n:"g1",f:"+- ss 0 g0"},{n:"g2",f:"*/ g0 g0 g1"},{n:"g3",f:"*/ ss ss g1"},{n:"g4",f:"*/ g3 2 1"},{n:"g5",f:"+- g4 0 g2"},{n:"g6",f:"+- g5 0 g0"},{n:"g6w",f:"*/ g6 w ss"},{n:"g7",f:"*/ g5 1 2"},{n:"g8",f:"+- g7 0 g0"},{n:"dy1",f:"*/ g8 hd2 ss"},{n:"g10h",f:"+- vc 0 dy1"},{n:"g11h",f:"+- vc dy1 0"},{n:"g12",f:"*/ g0 9598 32768"},{n:"g12w",f:"*/ g12 w ss"},{n:"g13",f:"+- ss 0 g12"},{n:"q1",f:"*/ ss ss 1"},{n:"q2",f:"*/ g13 g13 1"},{n:"q3",f:"+- q1 0 q2"},{n:"q4",f:"sqrt q3"},{n:"dy4",f:"*/ q4 hd2 ss"},{n:"g15h",f:"+- vc 0 dy4"},{n:"g16h",f:"+- vc dy4 0"},{n:"g17w",f:"+- g6w 0 g0w"},{n:"g18w",f:"*/ g17w 1 2"},{n:"dx2p",f:"+- g0w g18w w"},{n:"dx2",f:"*/ dx2p -1 1"},{n:"dy2",f:"*/ hd2 -1 1"},{n:"stAng1",f:"at2 dx2 dy2"},{n:"enAngp1",f:"at2 dx2 hd2"},{n:"enAng1",f:"+- enAngp1 0 21600000"},{n:"swAng1",f:"+- enAng1 0 stAng1"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"r",y:"b"}},{type:"arcTo",wR:"w",hR:"hd2",stAng:"cd4",swAng:"cd2"},{type:"arcTo",wR:"g18w",hR:"dy1",stAng:"stAng1",swAng:"swAng1"},{type:"close"}],extrusionOk:!1,stroke:!0}]},nonIsoscelesTrapezoid:{avLst:[{n:"adj1",f:"val 25000"},{n:"adj2",f:"val 25000"}],gdLst:[{n:"maxAdj",f:"*/ 50000 w ss"},{n:"a1",f:"pin 0 adj1 maxAdj"},{n:"a2",f:"pin 0 adj2 maxAdj"},{n:"x1",f:"*/ ss a1 200000"},{n:"x2",f:"*/ ss a1 100000"},{n:"dx3",f:"*/ ss a2 100000"},{n:"x3",f:"+- r 0 dx3"},{n:"x4",f:"+/ r x3 2"},{n:"il",f:"*/ wd3 a1 maxAdj"},{n:"adjm",f:"max a1 a2"},{n:"it",f:"*/ hd3 adjm maxAdj"},{n:"irt",f:"*/ wd3 a2 maxAdj"},{n:"ir",f:"+- r 0 irt"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"b"}},{type:"lnTo",pt:{x:"x2",y:"t"}},{type:"lnTo",pt:{x:"x3",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},noSmoking:{avLst:[{n:"adj",f:"val 18750"}],gdLst:[{n:"a",f:"pin 0 adj 50000"},{n:"dr",f:"*/ ss a 100000"},{n:"iwd2",f:"+- wd2 0 dr"},{n:"ihd2",f:"+- hd2 0 dr"},{n:"ang",f:"at2 w h"},{n:"ct",f:"cos ihd2 ang"},{n:"st",f:"sin iwd2 ang"},{n:"m",f:"mod ct st 0"},{n:"n",f:"*/ iwd2 ihd2 m"},{n:"drd2",f:"*/ dr 1 2"},{n:"dang",f:"at2 n drd2"},{n:"dang2",f:"*/ dang 2 1"},{n:"swAng",f:"+- -10800000 dang2 0"},{n:"t3",f:"at2 w h"},{n:"stAng1",f:"+- t3 0 dang"},{n:"stAng2",f:"+- stAng1 0 cd2"},{n:"ct1",f:"cos ihd2 stAng1"},{n:"st1",f:"sin iwd2 stAng1"},{n:"m1",f:"mod ct1 st1 0"},{n:"n1",f:"*/ iwd2 ihd2 m1"},{n:"dx1",f:"cos n1 stAng1"},{n:"dy1",f:"sin n1 stAng1"},{n:"x1",f:"+- hc dx1 0"},{n:"y1",f:"+- vc dy1 0"},{n:"x2",f:"+- hc 0 dx1"},{n:"y2",f:"+- vc 0 dy1"},{n:"idx",f:"cos wd2 2700000"},{n:"idy",f:"sin hd2 2700000"},{n:"il",f:"+- hc 0 idx"},{n:"ir",f:"+- hc idx 0"},{n:"it",f:"+- vc 0 idy"},{n:"ib",f:"+- vc idy 0"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"vc"}},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"cd2",swAng:"cd4"},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"3cd4",swAng:"cd4"},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"0",swAng:"cd4"},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"cd4",swAng:"cd4"},{type:"close"},{type:"moveTo",pt:{x:"x1",y:"y1"}},{type:"arcTo",wR:"iwd2",hR:"ihd2",stAng:"stAng1",swAng:"swAng"},{type:"close"},{type:"moveTo",pt:{x:"x2",y:"y2"}},{type:"arcTo",wR:"iwd2",hR:"ihd2",stAng:"stAng2",swAng:"swAng"},{type:"close"}],extrusionOk:!1,stroke:!0}]},notchedRightArrow:{avLst:[{n:"adj1",f:"val 50000"},{n:"adj2",f:"val 50000"}],gdLst:[{n:"maxAdj2",f:"*/ 100000 w ss"},{n:"a1",f:"pin 0 adj1 100000"},{n:"a2",f:"pin 0 adj2 maxAdj2"},{n:"dx2",f:"*/ ss a2 100000"},{n:"x2",f:"+- r 0 dx2"},{n:"dy1",f:"*/ h a1 200000"},{n:"y1",f:"+- vc 0 dy1"},{n:"y2",f:"+- vc dy1 0"},{n:"x1",f:"*/ dy1 dx2 hd2"},{n:"x3",f:"+- r 0 x1"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"y1"}},{type:"lnTo",pt:{x:"x2",y:"y1"}},{type:"lnTo",pt:{x:"x2",y:"t"}},{type:"lnTo",pt:{x:"r",y:"vc"}},{type:"lnTo",pt:{x:"x2",y:"b"}},{type:"lnTo",pt:{x:"x2",y:"y2"}},{type:"lnTo",pt:{x:"l",y:"y2"}},{type:"lnTo",pt:{x:"x1",y:"vc"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},octagon:{avLst:[{n:"adj",f:"val 29289"}],gdLst:[{n:"a",f:"pin 0 adj 50000"},{n:"x1",f:"*/ ss a 100000"},{n:"x2",f:"+- r 0 x1"},{n:"y2",f:"+- b 0 x1"},{n:"il",f:"*/ x1 1 2"},{n:"ir",f:"+- r 0 il"},{n:"ib",f:"+- b 0 il"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"x1"}},{type:"lnTo",pt:{x:"x1",y:"t"}},{type:"lnTo",pt:{x:"x2",y:"t"}},{type:"lnTo",pt:{x:"r",y:"x1"}},{type:"lnTo",pt:{x:"r",y:"y2"}},{type:"lnTo",pt:{x:"x2",y:"b"}},{type:"lnTo",pt:{x:"x1",y:"b"}},{type:"lnTo",pt:{x:"l",y:"y2"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},parallelogram:{avLst:[{n:"adj",f:"val 25000"}],gdLst:[{n:"maxAdj",f:"*/ 100000 w ss"},{n:"a",f:"pin 0 adj maxAdj"},{n:"x1",f:"*/ ss a 200000"},{n:"x2",f:"*/ ss a 100000"},{n:"x6",f:"+- r 0 x1"},{n:"x5",f:"+- r 0 x2"},{n:"x3",f:"*/ x5 1 2"},{n:"x4",f:"+- r 0 x3"},{n:"il",f:"*/ wd2 a maxAdj"},{n:"q1",f:"*/ 5 a maxAdj"},{n:"q2",f:"+/ 1 q1 12"},{n:"il",f:"*/ q2 w 1"},{n:"it",f:"*/ q2 h 1"},{n:"ir",f:"+- r 0 il"},{n:"ib",f:"+- b 0 it"},{n:"q3",f:"*/ h hc x2"},{n:"y1",f:"pin 0 q3 h"},{n:"y2",f:"+- b 0 y1"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"b"}},{type:"lnTo",pt:{x:"x2",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"x5",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},pentagon:{avLst:[{n:"hf",f:"val 105146"},{n:"vf",f:"val 110557"}],gdLst:[{n:"swd2",f:"*/ wd2 hf 100000"},{n:"shd2",f:"*/ hd2 vf 100000"},{n:"svc",f:"*/ vc  vf 100000"},{n:"dx1",f:"cos swd2 1080000"},{n:"dx2",f:"cos swd2 18360000"},{n:"dy1",f:"sin shd2 1080000"},{n:"dy2",f:"sin shd2 18360000"},{n:"x1",f:"+- hc 0 dx1"},{n:"x2",f:"+- hc 0 dx2"},{n:"x3",f:"+- hc dx2 0"},{n:"x4",f:"+- hc dx1 0"},{n:"y1",f:"+- svc 0 dy1"},{n:"y2",f:"+- svc 0 dy2"},{n:"it",f:"*/ y1 dx2 dx1"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"x1",y:"y1"}},{type:"lnTo",pt:{x:"hc",y:"t"}},{type:"lnTo",pt:{x:"x4",y:"y1"}},{type:"lnTo",pt:{x:"x3",y:"y2"}},{type:"lnTo",pt:{x:"x2",y:"y2"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},pie:{avLst:[{n:"adj1",f:"val 0"},{n:"adj2",f:"val 16200000"}],gdLst:[{n:"stAng",f:"pin 0 adj1 21599999"},{n:"enAng",f:"pin 0 adj2 21599999"},{n:"sw1",f:"+- enAng 0 stAng"},{n:"sw2",f:"+- sw1 21600000 0"},{n:"swAng",f:"?: sw1 sw1 sw2"},{n:"wt1",f:"sin wd2 stAng"},{n:"ht1",f:"cos hd2 stAng"},{n:"dx1",f:"cat2 wd2 ht1 wt1"},{n:"dy1",f:"sat2 hd2 ht1 wt1"},{n:"x1",f:"+- hc dx1 0"},{n:"y1",f:"+- vc dy1 0"},{n:"wt2",f:"sin wd2 enAng"},{n:"ht2",f:"cos hd2 enAng"},{n:"dx2",f:"cat2 wd2 ht2 wt2"},{n:"dy2",f:"sat2 hd2 ht2 wt2"},{n:"x2",f:"+- hc dx2 0"},{n:"y2",f:"+- vc dy2 0"},{n:"idx",f:"cos wd2 2700000"},{n:"idy",f:"sin hd2 2700000"},{n:"il",f:"+- hc 0 idx"},{n:"ir",f:"+- hc idx 0"},{n:"it",f:"+- vc 0 idy"},{n:"ib",f:"+- vc idy 0"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"x1",y:"y1"}},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"stAng",swAng:"swAng"},{type:"lnTo",pt:{x:"hc",y:"vc"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},pieWedge:{gdLst:[{n:"g1",f:"cos w 13500000"},{n:"g2",f:"sin h 13500000"},{n:"x1",f:"+- r g1 0"},{n:"y1",f:"+- b g2 0"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"b"}},{type:"arcTo",wR:"w",hR:"h",stAng:"cd2",swAng:"cd4"},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},plaque:{avLst:[{n:"adj",f:"val 16667"}],gdLst:[{n:"a",f:"pin 0 adj 50000"},{n:"x1",f:"*/ ss a 100000"},{n:"x2",f:"+- r 0 x1"},{n:"y2",f:"+- b 0 x1"},{n:"il",f:"*/ x1 70711 100000"},{n:"ir",f:"+- r 0 il"},{n:"ib",f:"+- b 0 il"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"x1"}},{type:"arcTo",wR:"x1",hR:"x1",stAng:"cd4",swAng:"-5400000"},{type:"lnTo",pt:{x:"x2",y:"t"}},{type:"arcTo",wR:"x1",hR:"x1",stAng:"cd2",swAng:"-5400000"},{type:"lnTo",pt:{x:"r",y:"y2"}},{type:"arcTo",wR:"x1",hR:"x1",stAng:"3cd4",swAng:"-5400000"},{type:"lnTo",pt:{x:"x1",y:"b"}},{type:"arcTo",wR:"x1",hR:"x1",stAng:"0",swAng:"-5400000"},{type:"close"}],extrusionOk:!1,stroke:!0}]},plaqueTabs:{gdLst:[{n:"md",f:"mod w h 0"},{n:"dx",f:"*/ 1 md 20"},{n:"y1",f:"+- 0 b dx"},{n:"x1",f:"+- 0 r dx"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"dx",y:"t"}},{type:"arcTo",wR:"dx",hR:"dx",stAng:"0",swAng:"cd4"},{type:"close"}],extrusionOk:!1,stroke:!0},{defines:[{type:"moveTo",pt:{x:"l",y:"y1"}},{type:"arcTo",wR:"dx",hR:"dx",stAng:"3cd4",swAng:"cd4"},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!0},{defines:[{type:"moveTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"dx"}},{type:"arcTo",wR:"dx",hR:"dx",stAng:"cd4",swAng:"cd4"},{type:"close"}],extrusionOk:!1,stroke:!0},{defines:[{type:"moveTo",pt:{x:"x1",y:"b"}},{type:"arcTo",wR:"dx",hR:"dx",stAng:"cd2",swAng:"cd4"},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},plus:{avLst:[{n:"adj",f:"val 25000"}],gdLst:[{n:"a",f:"pin 0 adj 50000"},{n:"x1",f:"*/ ss a 100000"},{n:"x2",f:"+- r 0 x1"},{n:"y2",f:"+- b 0 x1"},{n:"d",f:"+- w 0 h"},{n:"il",f:"?: d l x1"},{n:"ir",f:"?: d r x2"},{n:"it",f:"?: d x1 t"},{n:"ib",f:"?: d y2 b"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"x1"}},{type:"lnTo",pt:{x:"x1",y:"x1"}},{type:"lnTo",pt:{x:"x1",y:"t"}},{type:"lnTo",pt:{x:"x2",y:"t"}},{type:"lnTo",pt:{x:"x2",y:"x1"}},{type:"lnTo",pt:{x:"r",y:"x1"}},{type:"lnTo",pt:{x:"r",y:"y2"}},{type:"lnTo",pt:{x:"x2",y:"y2"}},{type:"lnTo",pt:{x:"x2",y:"b"}},{type:"lnTo",pt:{x:"x1",y:"b"}},{type:"lnTo",pt:{x:"x1",y:"y2"}},{type:"lnTo",pt:{x:"l",y:"y2"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},quadArrow:{avLst:[{n:"adj1",f:"val 22500"},{n:"adj2",f:"val 22500"},{n:"adj3",f:"val 22500"}],gdLst:[{n:"a2",f:"pin 0 adj2 50000"},{n:"maxAdj1",f:"*/ a2 2 1"},{n:"a1",f:"pin 0 adj1 maxAdj1"},{n:"q1",f:"+- 100000 0 maxAdj1"},{n:"maxAdj3",f:"*/ q1 1 2"},{n:"a3",f:"pin 0 adj3 maxAdj3"},{n:"x1",f:"*/ ss a3 100000"},{n:"dx2",f:"*/ ss a2 100000"},{n:"x2",f:"+- hc 0 dx2"},{n:"x5",f:"+- hc dx2 0"},{n:"dx3",f:"*/ ss a1 200000"},{n:"x3",f:"+- hc 0 dx3"},{n:"x4",f:"+- hc dx3 0"},{n:"x6",f:"+- r 0 x1"},{n:"y2",f:"+- vc 0 dx2"},{n:"y5",f:"+- vc dx2 0"},{n:"y3",f:"+- vc 0 dx3"},{n:"y4",f:"+- vc dx3 0"},{n:"y6",f:"+- b 0 x1"},{n:"il",f:"*/ dx3 x1 dx2"},{n:"ir",f:"+- r 0 il"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"vc"}},{type:"lnTo",pt:{x:"x1",y:"y2"}},{type:"lnTo",pt:{x:"x1",y:"y3"}},{type:"lnTo",pt:{x:"x3",y:"y3"}},{type:"lnTo",pt:{x:"x3",y:"x1"}},{type:"lnTo",pt:{x:"x2",y:"x1"}},{type:"lnTo",pt:{x:"hc",y:"t"}},{type:"lnTo",pt:{x:"x5",y:"x1"}},{type:"lnTo",pt:{x:"x4",y:"x1"}},{type:"lnTo",pt:{x:"x4",y:"y3"}},{type:"lnTo",pt:{x:"x6",y:"y3"}},{type:"lnTo",pt:{x:"x6",y:"y2"}},{type:"lnTo",pt:{x:"r",y:"vc"}},{type:"lnTo",pt:{x:"x6",y:"y5"}},{type:"lnTo",pt:{x:"x6",y:"y4"}},{type:"lnTo",pt:{x:"x4",y:"y4"}},{type:"lnTo",pt:{x:"x4",y:"y6"}},{type:"lnTo",pt:{x:"x5",y:"y6"}},{type:"lnTo",pt:{x:"hc",y:"b"}},{type:"lnTo",pt:{x:"x2",y:"y6"}},{type:"lnTo",pt:{x:"x3",y:"y6"}},{type:"lnTo",pt:{x:"x3",y:"y4"}},{type:"lnTo",pt:{x:"x1",y:"y4"}},{type:"lnTo",pt:{x:"x1",y:"y5"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},quadArrowCallout:{avLst:[{n:"adj1",f:"val 18515"},{n:"adj2",f:"val 18515"},{n:"adj3",f:"val 18515"},{n:"adj4",f:"val 48123"}],gdLst:[{n:"a2",f:"pin 0 adj2 50000"},{n:"maxAdj1",f:"*/ a2 2 1"},{n:"a1",f:"pin 0 adj1 maxAdj1"},{n:"maxAdj3",f:"+- 50000 0 a2"},{n:"a3",f:"pin 0 adj3 maxAdj3"},{n:"q2",f:"*/ a3 2 1"},{n:"maxAdj4",f:"+- 100000 0 q2"},{n:"a4",f:"pin a1 adj4 maxAdj4"},{n:"dx2",f:"*/ ss a2 100000"},{n:"dx3",f:"*/ ss a1 200000"},{n:"ah",f:"*/ ss a3 100000"},{n:"dx1",f:"*/ w a4 200000"},{n:"dy1",f:"*/ h a4 200000"},{n:"x8",f:"+- r 0 ah"},{n:"x2",f:"+- hc 0 dx1"},{n:"x7",f:"+- hc dx1 0"},{n:"x3",f:"+- hc 0 dx2"},{n:"x6",f:"+- hc dx2 0"},{n:"x4",f:"+- hc 0 dx3"},{n:"x5",f:"+- hc dx3 0"},{n:"y8",f:"+- b 0 ah"},{n:"y2",f:"+- vc 0 dy1"},{n:"y7",f:"+- vc dy1 0"},{n:"y3",f:"+- vc 0 dx2"},{n:"y6",f:"+- vc dx2 0"},{n:"y4",f:"+- vc 0 dx3"},{n:"y5",f:"+- vc dx3 0"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"vc"}},{type:"lnTo",pt:{x:"ah",y:"y3"}},{type:"lnTo",pt:{x:"ah",y:"y4"}},{type:"lnTo",pt:{x:"x2",y:"y4"}},{type:"lnTo",pt:{x:"x2",y:"y2"}},{type:"lnTo",pt:{x:"x4",y:"y2"}},{type:"lnTo",pt:{x:"x4",y:"ah"}},{type:"lnTo",pt:{x:"x3",y:"ah"}},{type:"lnTo",pt:{x:"hc",y:"t"}},{type:"lnTo",pt:{x:"x6",y:"ah"}},{type:"lnTo",pt:{x:"x5",y:"ah"}},{type:"lnTo",pt:{x:"x5",y:"y2"}},{type:"lnTo",pt:{x:"x7",y:"y2"}},{type:"lnTo",pt:{x:"x7",y:"y4"}},{type:"lnTo",pt:{x:"x8",y:"y4"}},{type:"lnTo",pt:{x:"x8",y:"y3"}},{type:"lnTo",pt:{x:"r",y:"vc"}},{type:"lnTo",pt:{x:"x8",y:"y6"}},{type:"lnTo",pt:{x:"x8",y:"y5"}},{type:"lnTo",pt:{x:"x7",y:"y5"}},{type:"lnTo",pt:{x:"x7",y:"y7"}},{type:"lnTo",pt:{x:"x5",y:"y7"}},{type:"lnTo",pt:{x:"x5",y:"y8"}},{type:"lnTo",pt:{x:"x6",y:"y8"}},{type:"lnTo",pt:{x:"hc",y:"b"}},{type:"lnTo",pt:{x:"x3",y:"y8"}},{type:"lnTo",pt:{x:"x4",y:"y8"}},{type:"lnTo",pt:{x:"x4",y:"y7"}},{type:"lnTo",pt:{x:"x2",y:"y7"}},{type:"lnTo",pt:{x:"x2",y:"y5"}},{type:"lnTo",pt:{x:"ah",y:"y5"}},{type:"lnTo",pt:{x:"ah",y:"y6"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},rect:{pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},ribbon:{avLst:[{n:"adj1",f:"val 16667"},{n:"adj2",f:"val 50000"}],gdLst:[{n:"a1",f:"pin 0 adj1 33333"},{n:"a2",f:"pin 25000 adj2 75000"},{n:"x10",f:"+- r 0 wd8"},{n:"dx2",f:"*/ w a2 200000"},{n:"x2",f:"+- hc 0 dx2"},{n:"x9",f:"+- hc dx2 0"},{n:"x3",f:"+- x2 wd32 0"},{n:"x8",f:"+- x9 0 wd32"},{n:"x5",f:"+- x2 wd8 0"},{n:"x6",f:"+- x9 0 wd8"},{n:"x4",f:"+- x5 0 wd32"},{n:"x7",f:"+- x6 wd32 0"},{n:"y1",f:"*/ h a1 200000"},{n:"y2",f:"*/ h a1 100000"},{n:"y4",f:"+- b 0 y2"},{n:"y3",f:"*/ y4 1 2"},{n:"hR",f:"*/ h a1 400000"},{n:"y5",f:"+- b 0 hR"},{n:"y6",f:"+- y2 0 hR"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"x4",y:"t"}},{type:"arcTo",wR:"wd32",hR:"hR",stAng:"3cd4",swAng:"cd2"},{type:"lnTo",pt:{x:"x3",y:"y1"}},{type:"arcTo",wR:"wd32",hR:"hR",stAng:"3cd4",swAng:"-10800000"},{type:"lnTo",pt:{x:"x8",y:"y2"}},{type:"arcTo",wR:"wd32",hR:"hR",stAng:"cd4",swAng:"-10800000"},{type:"lnTo",pt:{x:"x7",y:"y1"}},{type:"arcTo",wR:"wd32",hR:"hR",stAng:"cd4",swAng:"cd2"},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"x10",y:"y3"}},{type:"lnTo",pt:{x:"r",y:"y4"}},{type:"lnTo",pt:{x:"x9",y:"y4"}},{type:"lnTo",pt:{x:"x9",y:"y5"}},{type:"arcTo",wR:"wd32",hR:"hR",stAng:"0",swAng:"cd4"},{type:"lnTo",pt:{x:"x3",y:"b"}},{type:"arcTo",wR:"wd32",hR:"hR",stAng:"cd4",swAng:"cd4"},{type:"lnTo",pt:{x:"x2",y:"y4"}},{type:"lnTo",pt:{x:"l",y:"y4"}},{type:"lnTo",pt:{x:"wd8",y:"y3"}},{type:"close"}],extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"x5",y:"hR"}},{type:"arcTo",wR:"wd32",hR:"hR",stAng:"0",swAng:"cd4"},{type:"lnTo",pt:{x:"x3",y:"y1"}},{type:"arcTo",wR:"wd32",hR:"hR",stAng:"3cd4",swAng:"-10800000"},{type:"lnTo",pt:{x:"x5",y:"y2"}},{type:"close"},{type:"moveTo",pt:{x:"x6",y:"hR"}},{type:"arcTo",wR:"wd32",hR:"hR",stAng:"cd2",swAng:"-5400000"},{type:"lnTo",pt:{x:"x8",y:"y1"}},{type:"arcTo",wR:"wd32",hR:"hR",stAng:"3cd4",swAng:"cd2"},{type:"lnTo",pt:{x:"x6",y:"y2"}},{type:"close"}],fill:"darkenLess",extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"x4",y:"t"}},{type:"arcTo",wR:"wd32",hR:"hR",stAng:"3cd4",swAng:"cd2"},{type:"lnTo",pt:{x:"x3",y:"y1"}},{type:"arcTo",wR:"wd32",hR:"hR",stAng:"3cd4",swAng:"-10800000"},{type:"lnTo",pt:{x:"x8",y:"y2"}},{type:"arcTo",wR:"wd32",hR:"hR",stAng:"cd4",swAng:"-10800000"},{type:"lnTo",pt:{x:"x7",y:"y1"}},{type:"arcTo",wR:"wd32",hR:"hR",stAng:"cd4",swAng:"cd2"},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"x10",y:"y3"}},{type:"lnTo",pt:{x:"r",y:"y4"}},{type:"lnTo",pt:{x:"x9",y:"y4"}},{type:"lnTo",pt:{x:"x9",y:"y5"}},{type:"arcTo",wR:"wd32",hR:"hR",stAng:"0",swAng:"cd4"},{type:"lnTo",pt:{x:"x3",y:"b"}},{type:"arcTo",wR:"wd32",hR:"hR",stAng:"cd4",swAng:"cd4"},{type:"lnTo",pt:{x:"x2",y:"y4"}},{type:"lnTo",pt:{x:"l",y:"y4"}},{type:"lnTo",pt:{x:"wd8",y:"y3"}},{type:"close"},{type:"moveTo",pt:{x:"x5",y:"hR"}},{type:"lnTo",pt:{x:"x5",y:"y2"}},{type:"moveTo",pt:{x:"x6",y:"y2"}},{type:"lnTo",pt:{x:"x6",y:"hR"}},{type:"moveTo",pt:{x:"x2",y:"y4"}},{type:"lnTo",pt:{x:"x2",y:"y6"}},{type:"moveTo",pt:{x:"x9",y:"y6"}},{type:"lnTo",pt:{x:"x9",y:"y4"}}],fill:"none",extrusionOk:!1,stroke:!0}]},ribbon2:{avLst:[{n:"adj1",f:"val 16667"},{n:"adj2",f:"val 50000"}],gdLst:[{n:"a1",f:"pin 0 adj1 33333"},{n:"a2",f:"pin 25000 adj2 75000"},{n:"x10",f:"+- r 0 wd8"},{n:"dx2",f:"*/ w a2 200000"},{n:"x2",f:"+- hc 0 dx2"},{n:"x9",f:"+- hc dx2 0"},{n:"x3",f:"+- x2 wd32 0"},{n:"x8",f:"+- x9 0 wd32"},{n:"x5",f:"+- x2 wd8 0"},{n:"x6",f:"+- x9 0 wd8"},{n:"x4",f:"+- x5 0 wd32"},{n:"x7",f:"+- x6 wd32 0"},{n:"dy1",f:"*/ h a1 200000"},{n:"y1",f:"+- b 0 dy1"},{n:"dy2",f:"*/ h a1 100000"},{n:"y2",f:"+- b 0 dy2"},{n:"y4",f:"+- t dy2 0"},{n:"y3",f:"+/ y4 b 2"},{n:"hR",f:"*/ h a1 400000"},{n:"y6",f:"+- b 0 hR"},{n:"y7",f:"+- y1 0 hR"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"b"}},{type:"lnTo",pt:{x:"x4",y:"b"}},{type:"arcTo",wR:"wd32",hR:"hR",stAng:"cd4",swAng:"-10800000"},{type:"lnTo",pt:{x:"x3",y:"y1"}},{type:"arcTo",wR:"wd32",hR:"hR",stAng:"cd4",swAng:"cd2"},{type:"lnTo",pt:{x:"x8",y:"y2"}},{type:"arcTo",wR:"wd32",hR:"hR",stAng:"3cd4",swAng:"cd2"},{type:"lnTo",pt:{x:"x7",y:"y1"}},{type:"arcTo",wR:"wd32",hR:"hR",stAng:"3cd4",swAng:"-10800000"},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"x10",y:"y3"}},{type:"lnTo",pt:{x:"r",y:"y4"}},{type:"lnTo",pt:{x:"x9",y:"y4"}},{type:"lnTo",pt:{x:"x9",y:"hR"}},{type:"arcTo",wR:"wd32",hR:"hR",stAng:"0",swAng:"-5400000"},{type:"lnTo",pt:{x:"x3",y:"t"}},{type:"arcTo",wR:"wd32",hR:"hR",stAng:"3cd4",swAng:"-5400000"},{type:"lnTo",pt:{x:"x2",y:"y4"}},{type:"lnTo",pt:{x:"l",y:"y4"}},{type:"lnTo",pt:{x:"wd8",y:"y3"}},{type:"close"}],extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"x5",y:"y6"}},{type:"arcTo",wR:"wd32",hR:"hR",stAng:"0",swAng:"-5400000"},{type:"lnTo",pt:{x:"x3",y:"y1"}},{type:"arcTo",wR:"wd32",hR:"hR",stAng:"cd4",swAng:"cd2"},{type:"lnTo",pt:{x:"x5",y:"y2"}},{type:"close"},{type:"moveTo",pt:{x:"x6",y:"y6"}},{type:"arcTo",wR:"wd32",hR:"hR",stAng:"cd2",swAng:"cd4"},{type:"lnTo",pt:{x:"x8",y:"y1"}},{type:"arcTo",wR:"wd32",hR:"hR",stAng:"cd4",swAng:"-10800000"},{type:"lnTo",pt:{x:"x6",y:"y2"}},{type:"close"}],fill:"darkenLess",extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"l",y:"b"}},{type:"lnTo",pt:{x:"wd8",y:"y3"}},{type:"lnTo",pt:{x:"l",y:"y4"}},{type:"lnTo",pt:{x:"x2",y:"y4"}},{type:"lnTo",pt:{x:"x2",y:"hR"}},{type:"arcTo",wR:"wd32",hR:"hR",stAng:"cd2",swAng:"cd4"},{type:"lnTo",pt:{x:"x8",y:"t"}},{type:"arcTo",wR:"wd32",hR:"hR",stAng:"3cd4",swAng:"cd4"},{type:"lnTo",pt:{x:"x9",y:"y4"}},{type:"lnTo",pt:{x:"x9",y:"y4"}},{type:"lnTo",pt:{x:"r",y:"y4"}},{type:"lnTo",pt:{x:"x10",y:"y3"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"x7",y:"b"}},{type:"arcTo",wR:"wd32",hR:"hR",stAng:"cd4",swAng:"cd2"},{type:"lnTo",pt:{x:"x8",y:"y1"}},{type:"arcTo",wR:"wd32",hR:"hR",stAng:"cd4",swAng:"-10800000"},{type:"lnTo",pt:{x:"x3",y:"y2"}},{type:"arcTo",wR:"wd32",hR:"hR",stAng:"3cd4",swAng:"-10800000"},{type:"lnTo",pt:{x:"x4",y:"y1"}},{type:"arcTo",wR:"wd32",hR:"hR",stAng:"3cd4",swAng:"cd2"},{type:"close"},{type:"moveTo",pt:{x:"x5",y:"y2"}},{type:"lnTo",pt:{x:"x5",y:"y6"}},{type:"moveTo",pt:{x:"x6",y:"y6"}},{type:"lnTo",pt:{x:"x6",y:"y2"}},{type:"moveTo",pt:{x:"x2",y:"y7"}},{type:"lnTo",pt:{x:"x2",y:"y4"}},{type:"moveTo",pt:{x:"x9",y:"y4"}},{type:"lnTo",pt:{x:"x9",y:"y7"}}],fill:"none",extrusionOk:!1,stroke:!0}]},rightArrow:{avLst:[{n:"adj1",f:"val 50000"},{n:"adj2",f:"val 50000"}],gdLst:[{n:"maxAdj2",f:"*/ 100000 w ss"},{n:"a1",f:"pin 0 adj1 100000"},{n:"a2",f:"pin 0 adj2 maxAdj2"},{n:"dx1",f:"*/ ss a2 100000"},{n:"x1",f:"+- r 0 dx1"},{n:"dy1",f:"*/ h a1 200000"},{n:"y1",f:"+- vc 0 dy1"},{n:"y2",f:"+- vc dy1 0"},{n:"dx2",f:"*/ y1 dx1 hd2"},{n:"x2",f:"+- x1 dx2 0"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"y1"}},{type:"lnTo",pt:{x:"x1",y:"y1"}},{type:"lnTo",pt:{x:"x1",y:"t"}},{type:"lnTo",pt:{x:"r",y:"vc"}},{type:"lnTo",pt:{x:"x1",y:"b"}},{type:"lnTo",pt:{x:"x1",y:"y2"}},{type:"lnTo",pt:{x:"l",y:"y2"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},rightArrowCallout:{avLst:[{n:"adj1",f:"val 25000"},{n:"adj2",f:"val 25000"},{n:"adj3",f:"val 25000"},{n:"adj4",f:"val 64977"}],gdLst:[{n:"maxAdj2",f:"*/ 50000 h ss"},{n:"a2",f:"pin 0 adj2 maxAdj2"},{n:"maxAdj1",f:"*/ a2 2 1"},{n:"a1",f:"pin 0 adj1 maxAdj1"},{n:"maxAdj3",f:"*/ 100000 w ss"},{n:"a3",f:"pin 0 adj3 maxAdj3"},{n:"q2",f:"*/ a3 ss w"},{n:"maxAdj4",f:"+- 100000 0 q2"},{n:"a4",f:"pin 0 adj4 maxAdj4"},{n:"dy1",f:"*/ ss a2 100000"},{n:"dy2",f:"*/ ss a1 200000"},{n:"y1",f:"+- vc 0 dy1"},{n:"y2",f:"+- vc 0 dy2"},{n:"y3",f:"+- vc dy2 0"},{n:"y4",f:"+- vc dy1 0"},{n:"dx3",f:"*/ ss a3 100000"},{n:"x3",f:"+- r 0 dx3"},{n:"x2",f:"*/ w a4 100000"},{n:"x1",f:"*/ x2 1 2"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"x2",y:"t"}},{type:"lnTo",pt:{x:"x2",y:"y2"}},{type:"lnTo",pt:{x:"x3",y:"y2"}},{type:"lnTo",pt:{x:"x3",y:"y1"}},{type:"lnTo",pt:{x:"r",y:"vc"}},{type:"lnTo",pt:{x:"x3",y:"y4"}},{type:"lnTo",pt:{x:"x3",y:"y3"}},{type:"lnTo",pt:{x:"x2",y:"y3"}},{type:"lnTo",pt:{x:"x2",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},rightBrace:{avLst:[{n:"adj1",f:"val 8333"},{n:"adj2",f:"val 50000"}],gdLst:[{n:"a2",f:"pin 0 adj2 100000"},{n:"q1",f:"+- 100000 0 a2"},{n:"q2",f:"min q1 a2"},{n:"q3",f:"*/ q2 1 2"},{n:"maxAdj1",f:"*/ q3 h ss"},{n:"a1",f:"pin 0 adj1 maxAdj1"},{n:"y1",f:"*/ ss a1 100000"},{n:"y3",f:"*/ h a2 100000"},{n:"y2",f:"+- y3 0 y1"},{n:"y4",f:"+- b 0 y1"},{n:"dx1",f:"cos wd2 2700000"},{n:"dy1",f:"sin y1 2700000"},{n:"ir",f:"+- l dx1 0"},{n:"it",f:"+- y1 0 dy1"},{n:"ib",f:"+- b dy1 y1"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"arcTo",wR:"wd2",hR:"y1",stAng:"3cd4",swAng:"cd4"},{type:"lnTo",pt:{x:"hc",y:"y2"}},{type:"arcTo",wR:"wd2",hR:"y1",stAng:"cd2",swAng:"-5400000"},{type:"arcTo",wR:"wd2",hR:"y1",stAng:"3cd4",swAng:"-5400000"},{type:"lnTo",pt:{x:"hc",y:"y4"}},{type:"arcTo",wR:"wd2",hR:"y1",stAng:"0",swAng:"cd4"},{type:"close"}],extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"arcTo",wR:"wd2",hR:"y1",stAng:"3cd4",swAng:"cd4"},{type:"lnTo",pt:{x:"hc",y:"y2"}},{type:"arcTo",wR:"wd2",hR:"y1",stAng:"cd2",swAng:"-5400000"},{type:"arcTo",wR:"wd2",hR:"y1",stAng:"3cd4",swAng:"-5400000"},{type:"lnTo",pt:{x:"hc",y:"y4"}},{type:"arcTo",wR:"wd2",hR:"y1",stAng:"0",swAng:"cd4"}],fill:"none",extrusionOk:!1,stroke:!0}]},rightBracket:{avLst:[{n:"adj",f:"val 8333"}],gdLst:[{n:"maxAdj",f:"*/ 50000 h ss"},{n:"a",f:"pin 0 adj maxAdj"},{n:"y1",f:"*/ ss a 100000"},{n:"y2",f:"+- b 0 y1"},{n:"dx1",f:"cos w 2700000"},{n:"dy1",f:"sin y1 2700000"},{n:"ir",f:"+- l dx1 0"},{n:"it",f:"+- y1 0 dy1"},{n:"ib",f:"+- b dy1 y1"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"arcTo",wR:"w",hR:"y1",stAng:"3cd4",swAng:"cd4"},{type:"lnTo",pt:{x:"r",y:"y2"}},{type:"arcTo",wR:"w",hR:"y1",stAng:"0",swAng:"cd4"},{type:"close"}],extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"arcTo",wR:"w",hR:"y1",stAng:"3cd4",swAng:"cd4"},{type:"lnTo",pt:{x:"r",y:"y2"}},{type:"arcTo",wR:"w",hR:"y1",stAng:"0",swAng:"cd4"}],fill:"none",extrusionOk:!1,stroke:!0}]},round1Rect:{avLst:[{n:"adj",f:"val 16667"}],gdLst:[{n:"a",f:"pin 0 adj 50000"},{n:"dx1",f:"*/ ss a 100000"},{n:"x1",f:"+- r 0 dx1"},{n:"idx",f:"*/ dx1 29289 100000"},{n:"ir",f:"+- r 0 idx"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"x1",y:"t"}},{type:"arcTo",wR:"dx1",hR:"dx1",stAng:"3cd4",swAng:"cd4"},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},round2DiagRect:{avLst:[{n:"adj1",f:"val 16667"},{n:"adj2",f:"val 0"}],gdLst:[{n:"a1",f:"pin 0 adj1 50000"},{n:"a2",f:"pin 0 adj2 50000"},{n:"x1",f:"*/ ss a1 100000"},{n:"y1",f:"+- b 0 x1"},{n:"a",f:"*/ ss a2 100000"},{n:"x2",f:"+- r 0 a"},{n:"y2",f:"+- b 0 a"},{n:"dx1",f:"*/ x1 29289 100000"},{n:"dx2",f:"*/ a 29289 100000"},{n:"d",f:"+- dx1 0 dx2"},{n:"dx",f:"?: d dx1 dx2"},{n:"ir",f:"+- r 0 dx"},{n:"ib",f:"+- b 0 dx"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"x1",y:"t"}},{type:"lnTo",pt:{x:"x2",y:"t"}},{type:"arcTo",wR:"a",hR:"a",stAng:"3cd4",swAng:"cd4"},{type:"lnTo",pt:{x:"r",y:"y1"}},{type:"arcTo",wR:"x1",hR:"x1",stAng:"0",swAng:"cd4"},{type:"lnTo",pt:{x:"a",y:"b"}},{type:"arcTo",wR:"a",hR:"a",stAng:"cd4",swAng:"cd4"},{type:"lnTo",pt:{x:"l",y:"x1"}},{type:"arcTo",wR:"x1",hR:"x1",stAng:"cd2",swAng:"cd4"},{type:"close"}],extrusionOk:!1,stroke:!0}]},round2SameRect:{avLst:[{n:"adj1",f:"val 16667"},{n:"adj2",f:"val 0"}],gdLst:[{n:"a1",f:"pin 0 adj1 50000"},{n:"a2",f:"pin 0 adj2 50000"},{n:"tx1",f:"*/ ss a1 100000"},{n:"tx2",f:"+- r 0 tx1"},{n:"bx1",f:"*/ ss a2 100000"},{n:"bx2",f:"+- r 0 bx1"},{n:"by1",f:"+- b 0 bx1"},{n:"d",f:"+- tx1 0 bx1"},{n:"tdx",f:"*/ tx1 29289 100000"},{n:"bdx",f:"*/ bx1 29289 100000"},{n:"il",f:"?: d tdx bdx"},{n:"ir",f:"+- r 0 il"},{n:"ib",f:"+- b 0 bdx"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"tx1",y:"t"}},{type:"lnTo",pt:{x:"tx2",y:"t"}},{type:"arcTo",wR:"tx1",hR:"tx1",stAng:"3cd4",swAng:"cd4"},{type:"lnTo",pt:{x:"r",y:"by1"}},{type:"arcTo",wR:"bx1",hR:"bx1",stAng:"0",swAng:"cd4"},{type:"lnTo",pt:{x:"bx1",y:"b"}},{type:"arcTo",wR:"bx1",hR:"bx1",stAng:"cd4",swAng:"cd4"},{type:"lnTo",pt:{x:"l",y:"tx1"}},{type:"arcTo",wR:"tx1",hR:"tx1",stAng:"cd2",swAng:"cd4"},{type:"close"}],extrusionOk:!1,stroke:!0}]},roundRect:{avLst:[{n:"adj",f:"val 16667"}],gdLst:[{n:"a",f:"pin 0 adj 50000"},{n:"x1",f:"*/ ss a 100000"},{n:"x2",f:"+- r 0 x1"},{n:"y2",f:"+- b 0 x1"},{n:"il",f:"*/ x1 29289 100000"},{n:"ir",f:"+- r 0 il"},{n:"ib",f:"+- b 0 il"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"x1"}},{type:"arcTo",wR:"x1",hR:"x1",stAng:"cd2",swAng:"cd4"},{type:"lnTo",pt:{x:"x2",y:"t"}},{type:"arcTo",wR:"x1",hR:"x1",stAng:"3cd4",swAng:"cd4"},{type:"lnTo",pt:{x:"r",y:"y2"}},{type:"arcTo",wR:"x1",hR:"x1",stAng:"0",swAng:"cd4"},{type:"lnTo",pt:{x:"x1",y:"b"}},{type:"arcTo",wR:"x1",hR:"x1",stAng:"cd4",swAng:"cd4"},{type:"close"}],extrusionOk:!1,stroke:!0}]},rtTriangle:{gdLst:[{n:"it",f:"*/ h 7 12"},{n:"ir",f:"*/ w 7 12"},{n:"ib",f:"*/ h 11 12"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"b"}},{type:"lnTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},smileyFace:{avLst:[{n:"adj",f:"val 4653"}],gdLst:[{n:"a",f:"pin -4653 adj 4653"},{n:"x1",f:"*/ w 4969 21699"},{n:"x2",f:"*/ w 6215 21600"},{n:"x3",f:"*/ w 13135 21600"},{n:"x4",f:"*/ w 16640 21600"},{n:"y1",f:"*/ h 7570 21600"},{n:"y3",f:"*/ h 16515 21600"},{n:"dy2",f:"*/ h a 100000"},{n:"y2",f:"+- y3 0 dy2"},{n:"y4",f:"+- y3 dy2 0"},{n:"dy3",f:"*/ h a 50000"},{n:"y5",f:"+- y4 dy3 0"},{n:"idx",f:"cos wd2 2700000"},{n:"idy",f:"sin hd2 2700000"},{n:"il",f:"+- hc 0 idx"},{n:"ir",f:"+- hc idx 0"},{n:"it",f:"+- vc 0 idy"},{n:"ib",f:"+- vc idy 0"},{n:"wR",f:"*/ w 1125 21600"},{n:"hR",f:"*/ h 1125 21600"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"vc"}},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"cd2",swAng:"21600000"},{type:"close"}],extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"x2",y:"y1"}},{type:"arcTo",wR:"wR",hR:"hR",stAng:"cd2",swAng:"21600000"},{type:"moveTo",pt:{x:"x3",y:"y1"}},{type:"arcTo",wR:"wR",hR:"hR",stAng:"cd2",swAng:"21600000"}],fill:"darkenLess",extrusionOk:!1,stroke:!0},{defines:[{type:"moveTo",pt:{x:"x1",y:"y2"}},{type:"quadBezTo",pts:[{x:"hc",y:"y5"},{x:"x4",y:"y2"}]}],fill:"none",extrusionOk:!1,stroke:!0},{defines:[{type:"moveTo",pt:{x:"l",y:"vc"}},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"cd2",swAng:"21600000"},{type:"close"}],fill:"none",extrusionOk:!1,stroke:!0}]},snip1Rect:{avLst:[{n:"adj",f:"val 16667"}],gdLst:[{n:"a",f:"pin 0 adj 50000"},{n:"dx1",f:"*/ ss a 100000"},{n:"x1",f:"+- r 0 dx1"},{n:"it",f:"*/ dx1 1 2"},{n:"ir",f:"+/ x1 r 2"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"x1",y:"t"}},{type:"lnTo",pt:{x:"r",y:"dx1"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},snip2DiagRect:{avLst:[{n:"adj1",f:"val 0"},{n:"adj2",f:"val 16667"}],gdLst:[{n:"a1",f:"pin 0 adj1 50000"},{n:"a2",f:"pin 0 adj2 50000"},{n:"lx1",f:"*/ ss a1 100000"},{n:"lx2",f:"+- r 0 lx1"},{n:"ly1",f:"+- b 0 lx1"},{n:"rx1",f:"*/ ss a2 100000"},{n:"rx2",f:"+- r 0 rx1"},{n:"ry1",f:"+- b 0 rx1"},{n:"d",f:"+- lx1 0 rx1"},{n:"dx",f:"?: d lx1 rx1"},{n:"il",f:"*/ dx 1 2"},{n:"ir",f:"+- r 0 il"},{n:"ib",f:"+- b 0 il"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"lx1",y:"t"}},{type:"lnTo",pt:{x:"rx2",y:"t"}},{type:"lnTo",pt:{x:"r",y:"rx1"}},{type:"lnTo",pt:{x:"r",y:"ly1"}},{type:"lnTo",pt:{x:"lx2",y:"b"}},{type:"lnTo",pt:{x:"rx1",y:"b"}},{type:"lnTo",pt:{x:"l",y:"ry1"}},{type:"lnTo",pt:{x:"l",y:"lx1"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},snip2SameRect:{avLst:[{n:"adj1",f:"val 16667"},{n:"adj2",f:"val 0"}],gdLst:[{n:"a1",f:"pin 0 adj1 50000"},{n:"a2",f:"pin 0 adj2 50000"},{n:"tx1",f:"*/ ss a1 100000"},{n:"tx2",f:"+- r 0 tx1"},{n:"bx1",f:"*/ ss a2 100000"},{n:"bx2",f:"+- r 0 bx1"},{n:"by1",f:"+- b 0 bx1"},{n:"d",f:"+- tx1 0 bx1"},{n:"dx",f:"?: d tx1 bx1"},{n:"il",f:"*/ dx 1 2"},{n:"ir",f:"+- r 0 il"},{n:"it",f:"*/ tx1 1 2"},{n:"ib",f:"+/ by1 b 2"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"tx1",y:"t"}},{type:"lnTo",pt:{x:"tx2",y:"t"}},{type:"lnTo",pt:{x:"r",y:"tx1"}},{type:"lnTo",pt:{x:"r",y:"by1"}},{type:"lnTo",pt:{x:"bx2",y:"b"}},{type:"lnTo",pt:{x:"bx1",y:"b"}},{type:"lnTo",pt:{x:"l",y:"by1"}},{type:"lnTo",pt:{x:"l",y:"tx1"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},snipRoundRect:{avLst:[{n:"adj1",f:"val 16667"},{n:"adj2",f:"val 16667"}],gdLst:[{n:"a1",f:"pin 0 adj1 50000"},{n:"a2",f:"pin 0 adj2 50000"},{n:"x1",f:"*/ ss a1 100000"},{n:"dx2",f:"*/ ss a2 100000"},{n:"x2",f:"+- r 0 dx2"},{n:"il",f:"*/ x1 29289 100000"},{n:"ir",f:"+/ x2 r 2"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"x1",y:"t"}},{type:"lnTo",pt:{x:"x2",y:"t"}},{type:"lnTo",pt:{x:"r",y:"dx2"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"lnTo",pt:{x:"l",y:"x1"}},{type:"arcTo",wR:"x1",hR:"x1",stAng:"cd2",swAng:"cd4"},{type:"close"}],extrusionOk:!1,stroke:!0}]},squareTabs:{gdLst:[{n:"md",f:"mod w h 0"},{n:"dx",f:"*/ 1 md 20"},{n:"y1",f:"+- 0 b dx"},{n:"x1",f:"+- 0 r dx"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"dx",y:"t"}},{type:"lnTo",pt:{x:"dx",y:"dx"}},{type:"lnTo",pt:{x:"l",y:"dx"}},{type:"close"}],extrusionOk:!1,stroke:!0},{defines:[{type:"moveTo",pt:{x:"l",y:"y1"}},{type:"lnTo",pt:{x:"dx",y:"y1"}},{type:"lnTo",pt:{x:"dx",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!0},{defines:[{type:"moveTo",pt:{x:"x1",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"dx"}},{type:"lnTo",pt:{x:"x1",y:"dx"}},{type:"close"}],extrusionOk:!1,stroke:!0},{defines:[{type:"moveTo",pt:{x:"x1",y:"y1"}},{type:"lnTo",pt:{x:"r",y:"y1"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"x1",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},star10:{avLst:[{n:"adj",f:"val 42533"},{n:"hf",f:"val 105146"}],gdLst:[{n:"a",f:"pin 0 adj 50000"},{n:"swd2",f:"*/ wd2 hf 100000"},{n:"dx1",f:"*/ swd2 95106 100000"},{n:"dx2",f:"*/ swd2 58779 100000"},{n:"x1",f:"+- hc 0 dx1"},{n:"x2",f:"+- hc 0 dx2"},{n:"x3",f:"+- hc dx2 0"},{n:"x4",f:"+- hc dx1 0"},{n:"dy1",f:"*/ hd2 80902 100000"},{n:"dy2",f:"*/ hd2 30902 100000"},{n:"y1",f:"+- vc 0 dy1"},{n:"y2",f:"+- vc 0 dy2"},{n:"y3",f:"+- vc dy2 0"},{n:"y4",f:"+- vc dy1 0"},{n:"iwd2",f:"*/ swd2 a 50000"},{n:"ihd2",f:"*/ hd2 a 50000"},{n:"sdx1",f:"*/ iwd2 80902 100000"},{n:"sdx2",f:"*/ iwd2 30902 100000"},{n:"sdy1",f:"*/ ihd2 95106 100000"},{n:"sdy2",f:"*/ ihd2 58779 100000"},{n:"sx1",f:"+- hc 0 iwd2"},{n:"sx2",f:"+- hc 0 sdx1"},{n:"sx3",f:"+- hc 0 sdx2"},{n:"sx4",f:"+- hc sdx2 0"},{n:"sx5",f:"+- hc sdx1 0"},{n:"sx6",f:"+- hc iwd2 0"},{n:"sy1",f:"+- vc 0 sdy1"},{n:"sy2",f:"+- vc 0 sdy2"},{n:"sy3",f:"+- vc sdy2 0"},{n:"sy4",f:"+- vc sdy1 0"},{n:"yAdj",f:"+- vc 0 ihd2"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"x1",y:"y2"}},{type:"lnTo",pt:{x:"sx2",y:"sy2"}},{type:"lnTo",pt:{x:"x2",y:"y1"}},{type:"lnTo",pt:{x:"sx3",y:"sy1"}},{type:"lnTo",pt:{x:"hc",y:"t"}},{type:"lnTo",pt:{x:"sx4",y:"sy1"}},{type:"lnTo",pt:{x:"x3",y:"y1"}},{type:"lnTo",pt:{x:"sx5",y:"sy2"}},{type:"lnTo",pt:{x:"x4",y:"y2"}},{type:"lnTo",pt:{x:"sx6",y:"vc"}},{type:"lnTo",pt:{x:"x4",y:"y3"}},{type:"lnTo",pt:{x:"sx5",y:"sy3"}},{type:"lnTo",pt:{x:"x3",y:"y4"}},{type:"lnTo",pt:{x:"sx4",y:"sy4"}},{type:"lnTo",pt:{x:"hc",y:"b"}},{type:"lnTo",pt:{x:"sx3",y:"sy4"}},{type:"lnTo",pt:{x:"x2",y:"y4"}},{type:"lnTo",pt:{x:"sx2",y:"sy3"}},{type:"lnTo",pt:{x:"x1",y:"y3"}},{type:"lnTo",pt:{x:"sx1",y:"vc"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},star12:{avLst:[{n:"adj",f:"val 37500"}],gdLst:[{n:"a",f:"pin 0 adj 50000"},{n:"dx1",f:"cos wd2 1800000"},{n:"dy1",f:"sin hd2 3600000"},{n:"x1",f:"+- hc 0 dx1"},{n:"x3",f:"*/ w 3 4"},{n:"x4",f:"+- hc dx1 0"},{n:"y1",f:"+- vc 0 dy1"},{n:"y3",f:"*/ h 3 4"},{n:"y4",f:"+- vc dy1 0"},{n:"iwd2",f:"*/ wd2 a 50000"},{n:"ihd2",f:"*/ hd2 a 50000"},{n:"sdx1",f:"cos iwd2 900000"},{n:"sdx2",f:"cos iwd2 2700000"},{n:"sdx3",f:"cos iwd2 4500000"},{n:"sdy1",f:"sin ihd2 4500000"},{n:"sdy2",f:"sin ihd2 2700000"},{n:"sdy3",f:"sin ihd2 900000"},{n:"sx1",f:"+- hc 0 sdx1"},{n:"sx2",f:"+- hc 0 sdx2"},{n:"sx3",f:"+- hc 0 sdx3"},{n:"sx4",f:"+- hc sdx3 0"},{n:"sx5",f:"+- hc sdx2 0"},{n:"sx6",f:"+- hc sdx1 0"},{n:"sy1",f:"+- vc 0 sdy1"},{n:"sy2",f:"+- vc 0 sdy2"},{n:"sy3",f:"+- vc 0 sdy3"},{n:"sy4",f:"+- vc sdy3 0"},{n:"sy5",f:"+- vc sdy2 0"},{n:"sy6",f:"+- vc sdy1 0"},{n:"yAdj",f:"+- vc 0 ihd2"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"vc"}},{type:"lnTo",pt:{x:"sx1",y:"sy3"}},{type:"lnTo",pt:{x:"x1",y:"hd4"}},{type:"lnTo",pt:{x:"sx2",y:"sy2"}},{type:"lnTo",pt:{x:"wd4",y:"y1"}},{type:"lnTo",pt:{x:"sx3",y:"sy1"}},{type:"lnTo",pt:{x:"hc",y:"t"}},{type:"lnTo",pt:{x:"sx4",y:"sy1"}},{type:"lnTo",pt:{x:"x3",y:"y1"}},{type:"lnTo",pt:{x:"sx5",y:"sy2"}},{type:"lnTo",pt:{x:"x4",y:"hd4"}},{type:"lnTo",pt:{x:"sx6",y:"sy3"}},{type:"lnTo",pt:{x:"r",y:"vc"}},{type:"lnTo",pt:{x:"sx6",y:"sy4"}},{type:"lnTo",pt:{x:"x4",y:"y3"}},{type:"lnTo",pt:{x:"sx5",y:"sy5"}},{type:"lnTo",pt:{x:"x3",y:"y4"}},{type:"lnTo",pt:{x:"sx4",y:"sy6"}},{type:"lnTo",pt:{x:"hc",y:"b"}},{type:"lnTo",pt:{x:"sx3",y:"sy6"}},{type:"lnTo",pt:{x:"wd4",y:"y4"}},{type:"lnTo",pt:{x:"sx2",y:"sy5"}},{type:"lnTo",pt:{x:"x1",y:"y3"}},{type:"lnTo",pt:{x:"sx1",y:"sy4"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},star16:{avLst:[{n:"adj",f:"val 37500"}],gdLst:[{n:"a",f:"pin 0 adj 50000"},{n:"dx1",f:"*/ wd2 92388 100000"},{n:"dx2",f:"*/ wd2 70711 100000"},{n:"dx3",f:"*/ wd2 38268 100000"},{n:"dy1",f:"*/ hd2 92388 100000"},{n:"dy2",f:"*/ hd2 70711 100000"},{n:"dy3",f:"*/ hd2 38268 100000"},{n:"x1",f:"+- hc 0 dx1"},{n:"x2",f:"+- hc 0 dx2"},{n:"x3",f:"+- hc 0 dx3"},{n:"x4",f:"+- hc dx3 0"},{n:"x5",f:"+- hc dx2 0"},{n:"x6",f:"+- hc dx1 0"},{n:"y1",f:"+- vc 0 dy1"},{n:"y2",f:"+- vc 0 dy2"},{n:"y3",f:"+- vc 0 dy3"},{n:"y4",f:"+- vc dy3 0"},{n:"y5",f:"+- vc dy2 0"},{n:"y6",f:"+- vc dy1 0"},{n:"iwd2",f:"*/ wd2 a 50000"},{n:"ihd2",f:"*/ hd2 a 50000"},{n:"sdx1",f:"*/ iwd2 98079 100000"},{n:"sdx2",f:"*/ iwd2 83147 100000"},{n:"sdx3",f:"*/ iwd2 55557 100000"},{n:"sdx4",f:"*/ iwd2 19509 100000"},{n:"sdy1",f:"*/ ihd2 98079 100000"},{n:"sdy2",f:"*/ ihd2 83147 100000"},{n:"sdy3",f:"*/ ihd2 55557 100000"},{n:"sdy4",f:"*/ ihd2 19509 100000"},{n:"sx1",f:"+- hc 0 sdx1"},{n:"sx2",f:"+- hc 0 sdx2"},{n:"sx3",f:"+- hc 0 sdx3"},{n:"sx4",f:"+- hc 0 sdx4"},{n:"sx5",f:"+- hc sdx4 0"},{n:"sx6",f:"+- hc sdx3 0"},{n:"sx7",f:"+- hc sdx2 0"},{n:"sx8",f:"+- hc sdx1 0"},{n:"sy1",f:"+- vc 0 sdy1"},{n:"sy2",f:"+- vc 0 sdy2"},{n:"sy3",f:"+- vc 0 sdy3"},{n:"sy4",f:"+- vc 0 sdy4"},{n:"sy5",f:"+- vc sdy4 0"},{n:"sy6",f:"+- vc sdy3 0"},{n:"sy7",f:"+- vc sdy2 0"},{n:"sy8",f:"+- vc sdy1 0"},{n:"idx",f:"cos iwd2 2700000"},{n:"idy",f:"sin ihd2 2700000"},{n:"il",f:"+- hc 0 idx"},{n:"it",f:"+- vc 0 idy"},{n:"ir",f:"+- hc idx 0"},{n:"ib",f:"+- vc idy 0"},{n:"yAdj",f:"+- vc 0 ihd2"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"vc"}},{type:"lnTo",pt:{x:"sx1",y:"sy4"}},{type:"lnTo",pt:{x:"x1",y:"y3"}},{type:"lnTo",pt:{x:"sx2",y:"sy3"}},{type:"lnTo",pt:{x:"x2",y:"y2"}},{type:"lnTo",pt:{x:"sx3",y:"sy2"}},{type:"lnTo",pt:{x:"x3",y:"y1"}},{type:"lnTo",pt:{x:"sx4",y:"sy1"}},{type:"lnTo",pt:{x:"hc",y:"t"}},{type:"lnTo",pt:{x:"sx5",y:"sy1"}},{type:"lnTo",pt:{x:"x4",y:"y1"}},{type:"lnTo",pt:{x:"sx6",y:"sy2"}},{type:"lnTo",pt:{x:"x5",y:"y2"}},{type:"lnTo",pt:{x:"sx7",y:"sy3"}},{type:"lnTo",pt:{x:"x6",y:"y3"}},{type:"lnTo",pt:{x:"sx8",y:"sy4"}},{type:"lnTo",pt:{x:"r",y:"vc"}},{type:"lnTo",pt:{x:"sx8",y:"sy5"}},{type:"lnTo",pt:{x:"x6",y:"y4"}},{type:"lnTo",pt:{x:"sx7",y:"sy6"}},{type:"lnTo",pt:{x:"x5",y:"y5"}},{type:"lnTo",pt:{x:"sx6",y:"sy7"}},{type:"lnTo",pt:{x:"x4",y:"y6"}},{type:"lnTo",pt:{x:"sx5",y:"sy8"}},{type:"lnTo",pt:{x:"hc",y:"b"}},{type:"lnTo",pt:{x:"sx4",y:"sy8"}},{type:"lnTo",pt:{x:"x3",y:"y6"}},{type:"lnTo",pt:{x:"sx3",y:"sy7"}},{type:"lnTo",pt:{x:"x2",y:"y5"}},{type:"lnTo",pt:{x:"sx2",y:"sy6"}},{type:"lnTo",pt:{x:"x1",y:"y4"}},{type:"lnTo",pt:{x:"sx1",y:"sy5"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},star24:{avLst:[{n:"adj",f:"val 37500"}],gdLst:[{n:"a",f:"pin 0 adj 50000"},{n:"dx1",f:"cos wd2 900000"},{n:"dx2",f:"cos wd2 1800000"},{n:"dx3",f:"cos wd2 2700000"},{n:"dx4",f:"val wd4"},{n:"dx5",f:"cos wd2 4500000"},{n:"dy1",f:"sin hd2 4500000"},{n:"dy2",f:"sin hd2 3600000"},{n:"dy3",f:"sin hd2 2700000"},{n:"dy4",f:"val hd4"},{n:"dy5",f:"sin hd2 900000"},{n:"x1",f:"+- hc 0 dx1"},{n:"x2",f:"+- hc 0 dx2"},{n:"x3",f:"+- hc 0 dx3"},{n:"x4",f:"+- hc 0 dx4"},{n:"x5",f:"+- hc 0 dx5"},{n:"x6",f:"+- hc dx5 0"},{n:"x7",f:"+- hc dx4 0"},{n:"x8",f:"+- hc dx3 0"},{n:"x9",f:"+- hc dx2 0"},{n:"x10",f:"+- hc dx1 0"},{n:"y1",f:"+- vc 0 dy1"},{n:"y2",f:"+- vc 0 dy2"},{n:"y3",f:"+- vc 0 dy3"},{n:"y4",f:"+- vc 0 dy4"},{n:"y5",f:"+- vc 0 dy5"},{n:"y6",f:"+- vc dy5 0"},{n:"y7",f:"+- vc dy4 0"},{n:"y8",f:"+- vc dy3 0"},{n:"y9",f:"+- vc dy2 0"},{n:"y10",f:"+- vc dy1 0"},{n:"iwd2",f:"*/ wd2 a 50000"},{n:"ihd2",f:"*/ hd2 a 50000"},{n:"sdx1",f:"*/ iwd2 99144 100000"},{n:"sdx2",f:"*/ iwd2 92388 100000"},{n:"sdx3",f:"*/ iwd2 79335 100000"},{n:"sdx4",f:"*/ iwd2 60876 100000"},{n:"sdx5",f:"*/ iwd2 38268 100000"},{n:"sdx6",f:"*/ iwd2 13053 100000"},{n:"sdy1",f:"*/ ihd2 99144 100000"},{n:"sdy2",f:"*/ ihd2 92388 100000"},{n:"sdy3",f:"*/ ihd2 79335 100000"},{n:"sdy4",f:"*/ ihd2 60876 100000"},{n:"sdy5",f:"*/ ihd2 38268 100000"},{n:"sdy6",f:"*/ ihd2 13053 100000"},{n:"sx1",f:"+- hc 0 sdx1"},{n:"sx2",f:"+- hc 0 sdx2"},{n:"sx3",f:"+- hc 0 sdx3"},{n:"sx4",f:"+- hc 0 sdx4"},{n:"sx5",f:"+- hc 0 sdx5"},{n:"sx6",f:"+- hc 0 sdx6"},{n:"sx7",f:"+- hc sdx6 0"},{n:"sx8",f:"+- hc sdx5 0"},{n:"sx9",f:"+- hc sdx4 0"},{n:"sx10",f:"+- hc sdx3 0"},{n:"sx11",f:"+- hc sdx2 0"},{n:"sx12",f:"+- hc sdx1 0"},{n:"sy1",f:"+- vc 0 sdy1"},{n:"sy2",f:"+- vc 0 sdy2"},{n:"sy3",f:"+- vc 0 sdy3"},{n:"sy4",f:"+- vc 0 sdy4"},{n:"sy5",f:"+- vc 0 sdy5"},{n:"sy6",f:"+- vc 0 sdy6"},{n:"sy7",f:"+- vc sdy6 0"},{n:"sy8",f:"+- vc sdy5 0"},{n:"sy9",f:"+- vc sdy4 0"},{n:"sy10",f:"+- vc sdy3 0"},{n:"sy11",f:"+- vc sdy2 0"},{n:"sy12",f:"+- vc sdy1 0"},{n:"idx",f:"cos iwd2 2700000"},{n:"idy",f:"sin ihd2 2700000"},{n:"il",f:"+- hc 0 idx"},{n:"it",f:"+- vc 0 idy"},{n:"ir",f:"+- hc idx 0"},{n:"ib",f:"+- vc idy 0"},{n:"yAdj",f:"+- vc 0 ihd2"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"vc"}},{type:"lnTo",pt:{x:"sx1",y:"sy6"}},{type:"lnTo",pt:{x:"x1",y:"y5"}},{type:"lnTo",pt:{x:"sx2",y:"sy5"}},{type:"lnTo",pt:{x:"x2",y:"y4"}},{type:"lnTo",pt:{x:"sx3",y:"sy4"}},{type:"lnTo",pt:{x:"x3",y:"y3"}},{type:"lnTo",pt:{x:"sx4",y:"sy3"}},{type:"lnTo",pt:{x:"x4",y:"y2"}},{type:"lnTo",pt:{x:"sx5",y:"sy2"}},{type:"lnTo",pt:{x:"x5",y:"y1"}},{type:"lnTo",pt:{x:"sx6",y:"sy1"}},{type:"lnTo",pt:{x:"hc",y:"t"}},{type:"lnTo",pt:{x:"sx7",y:"sy1"}},{type:"lnTo",pt:{x:"x6",y:"y1"}},{type:"lnTo",pt:{x:"sx8",y:"sy2"}},{type:"lnTo",pt:{x:"x7",y:"y2"}},{type:"lnTo",pt:{x:"sx9",y:"sy3"}},{type:"lnTo",pt:{x:"x8",y:"y3"}},{type:"lnTo",pt:{x:"sx10",y:"sy4"}},{type:"lnTo",pt:{x:"x9",y:"y4"}},{type:"lnTo",pt:{x:"sx11",y:"sy5"}},{type:"lnTo",pt:{x:"x10",y:"y5"}},{type:"lnTo",pt:{x:"sx12",y:"sy6"}},{type:"lnTo",pt:{x:"r",y:"vc"}},{type:"lnTo",pt:{x:"sx12",y:"sy7"}},{type:"lnTo",pt:{x:"x10",y:"y6"}},{type:"lnTo",pt:{x:"sx11",y:"sy8"}},{type:"lnTo",pt:{x:"x9",y:"y7"}},{type:"lnTo",pt:{x:"sx10",y:"sy9"}},{type:"lnTo",pt:{x:"x8",y:"y8"}},{type:"lnTo",pt:{x:"sx9",y:"sy10"}},{type:"lnTo",pt:{x:"x7",y:"y9"}},{type:"lnTo",pt:{x:"sx8",y:"sy11"}},{type:"lnTo",pt:{x:"x6",y:"y10"}},{type:"lnTo",pt:{x:"sx7",y:"sy12"}},{type:"lnTo",pt:{x:"hc",y:"b"}},{type:"lnTo",pt:{x:"sx6",y:"sy12"}},{type:"lnTo",pt:{x:"x5",y:"y10"}},{type:"lnTo",pt:{x:"sx5",y:"sy11"}},{type:"lnTo",pt:{x:"x4",y:"y9"}},{type:"lnTo",pt:{x:"sx4",y:"sy10"}},{type:"lnTo",pt:{x:"x3",y:"y8"}},{type:"lnTo",pt:{x:"sx3",y:"sy9"}},{type:"lnTo",pt:{x:"x2",y:"y7"}},{type:"lnTo",pt:{x:"sx2",y:"sy8"}},{type:"lnTo",pt:{x:"x1",y:"y6"}},{type:"lnTo",pt:{x:"sx1",y:"sy7"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},star32:{avLst:[{n:"adj",f:"val 37500"}],gdLst:[{n:"a",f:"pin 0 adj 50000"},{n:"dx1",f:"*/ wd2 98079 100000"},{n:"dx2",f:"*/ wd2 92388 100000"},{n:"dx3",f:"*/ wd2 83147 100000"},{n:"dx4",f:"cos wd2 2700000"},{n:"dx5",f:"*/ wd2 55557 100000"},{n:"dx6",f:"*/ wd2 38268 100000"},{n:"dx7",f:"*/ wd2 19509 100000"},{n:"dy1",f:"*/ hd2 98079 100000"},{n:"dy2",f:"*/ hd2 92388 100000"},{n:"dy3",f:"*/ hd2 83147 100000"},{n:"dy4",f:"sin hd2 2700000"},{n:"dy5",f:"*/ hd2 55557 100000"},{n:"dy6",f:"*/ hd2 38268 100000"},{n:"dy7",f:"*/ hd2 19509 100000"},{n:"x1",f:"+- hc 0 dx1"},{n:"x2",f:"+- hc 0 dx2"},{n:"x3",f:"+- hc 0 dx3"},{n:"x4",f:"+- hc 0 dx4"},{n:"x5",f:"+- hc 0 dx5"},{n:"x6",f:"+- hc 0 dx6"},{n:"x7",f:"+- hc 0 dx7"},{n:"x8",f:"+- hc dx7 0"},{n:"x9",f:"+- hc dx6 0"},{n:"x10",f:"+- hc dx5 0"},{n:"x11",f:"+- hc dx4 0"},{n:"x12",f:"+- hc dx3 0"},{n:"x13",f:"+- hc dx2 0"},{n:"x14",f:"+- hc dx1 0"},{n:"y1",f:"+- vc 0 dy1"},{n:"y2",f:"+- vc 0 dy2"},{n:"y3",f:"+- vc 0 dy3"},{n:"y4",f:"+- vc 0 dy4"},{n:"y5",f:"+- vc 0 dy5"},{n:"y6",f:"+- vc 0 dy6"},{n:"y7",f:"+- vc 0 dy7"},{n:"y8",f:"+- vc dy7 0"},{n:"y9",f:"+- vc dy6 0"},{n:"y10",f:"+- vc dy5 0"},{n:"y11",f:"+- vc dy4 0"},{n:"y12",f:"+- vc dy3 0"},{n:"y13",f:"+- vc dy2 0"},{n:"y14",f:"+- vc dy1 0"},{n:"iwd2",f:"*/ wd2 a 50000"},{n:"ihd2",f:"*/ hd2 a 50000"},{n:"sdx1",f:"*/ iwd2 99518 100000"},{n:"sdx2",f:"*/ iwd2 95694 100000"},{n:"sdx3",f:"*/ iwd2 88192 100000"},{n:"sdx4",f:"*/ iwd2 77301 100000"},{n:"sdx5",f:"*/ iwd2 63439 100000"},{n:"sdx6",f:"*/ iwd2 47140 100000"},{n:"sdx7",f:"*/ iwd2 29028 100000"},{n:"sdx8",f:"*/ iwd2 9802 100000"},{n:"sdy1",f:"*/ ihd2 99518 100000"},{n:"sdy2",f:"*/ ihd2 95694 100000"},{n:"sdy3",f:"*/ ihd2 88192 100000"},{n:"sdy4",f:"*/ ihd2 77301 100000"},{n:"sdy5",f:"*/ ihd2 63439 100000"},{n:"sdy6",f:"*/ ihd2 47140 100000"},{n:"sdy7",f:"*/ ihd2 29028 100000"},{n:"sdy8",f:"*/ ihd2 9802 100000"},{n:"sx1",f:"+- hc 0 sdx1"},{n:"sx2",f:"+- hc 0 sdx2"},{n:"sx3",f:"+- hc 0 sdx3"},{n:"sx4",f:"+- hc 0 sdx4"},{n:"sx5",f:"+- hc 0 sdx5"},{n:"sx6",f:"+- hc 0 sdx6"},{n:"sx7",f:"+- hc 0 sdx7"},{n:"sx8",f:"+- hc 0 sdx8"},{n:"sx9",f:"+- hc sdx8 0"},{n:"sx10",f:"+- hc sdx7 0"},{n:"sx11",f:"+- hc sdx6 0"},{n:"sx12",f:"+- hc sdx5 0"},{n:"sx13",f:"+- hc sdx4 0"},{n:"sx14",f:"+- hc sdx3 0"},{n:"sx15",f:"+- hc sdx2 0"},{n:"sx16",f:"+- hc sdx1 0"},{n:"sy1",f:"+- vc 0 sdy1"},{n:"sy2",f:"+- vc 0 sdy2"},{n:"sy3",f:"+- vc 0 sdy3"},{n:"sy4",f:"+- vc 0 sdy4"},{n:"sy5",f:"+- vc 0 sdy5"},{n:"sy6",f:"+- vc 0 sdy6"},{n:"sy7",f:"+- vc 0 sdy7"},{n:"sy8",f:"+- vc 0 sdy8"},{n:"sy9",f:"+- vc sdy8 0"},{n:"sy10",f:"+- vc sdy7 0"},{n:"sy11",f:"+- vc sdy6 0"},{n:"sy12",f:"+- vc sdy5 0"},{n:"sy13",f:"+- vc sdy4 0"},{n:"sy14",f:"+- vc sdy3 0"},{n:"sy15",f:"+- vc sdy2 0"},{n:"sy16",f:"+- vc sdy1 0"},{n:"idx",f:"cos iwd2 2700000"},{n:"idy",f:"sin ihd2 2700000"},{n:"il",f:"+- hc 0 idx"},{n:"it",f:"+- vc 0 idy"},{n:"ir",f:"+- hc idx 0"},{n:"ib",f:"+- vc idy 0"},{n:"yAdj",f:"+- vc 0 ihd2"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"vc"}},{type:"lnTo",pt:{x:"sx1",y:"sy8"}},{type:"lnTo",pt:{x:"x1",y:"y7"}},{type:"lnTo",pt:{x:"sx2",y:"sy7"}},{type:"lnTo",pt:{x:"x2",y:"y6"}},{type:"lnTo",pt:{x:"sx3",y:"sy6"}},{type:"lnTo",pt:{x:"x3",y:"y5"}},{type:"lnTo",pt:{x:"sx4",y:"sy5"}},{type:"lnTo",pt:{x:"x4",y:"y4"}},{type:"lnTo",pt:{x:"sx5",y:"sy4"}},{type:"lnTo",pt:{x:"x5",y:"y3"}},{type:"lnTo",pt:{x:"sx6",y:"sy3"}},{type:"lnTo",pt:{x:"x6",y:"y2"}},{type:"lnTo",pt:{x:"sx7",y:"sy2"}},{type:"lnTo",pt:{x:"x7",y:"y1"}},{type:"lnTo",pt:{x:"sx8",y:"sy1"}},{type:"lnTo",pt:{x:"hc",y:"t"}},{type:"lnTo",pt:{x:"sx9",y:"sy1"}},{type:"lnTo",pt:{x:"x8",y:"y1"}},{type:"lnTo",pt:{x:"sx10",y:"sy2"}},{type:"lnTo",pt:{x:"x9",y:"y2"}},{type:"lnTo",pt:{x:"sx11",y:"sy3"}},{type:"lnTo",pt:{x:"x10",y:"y3"}},{type:"lnTo",pt:{x:"sx12",y:"sy4"}},{type:"lnTo",pt:{x:"x11",y:"y4"}},{type:"lnTo",pt:{x:"sx13",y:"sy5"}},{type:"lnTo",pt:{x:"x12",y:"y5"}},{type:"lnTo",pt:{x:"sx14",y:"sy6"}},{type:"lnTo",pt:{x:"x13",y:"y6"}},{type:"lnTo",pt:{x:"sx15",y:"sy7"}},{type:"lnTo",pt:{x:"x14",y:"y7"}},{type:"lnTo",pt:{x:"sx16",y:"sy8"}},{type:"lnTo",pt:{x:"r",y:"vc"}},{type:"lnTo",pt:{x:"sx16",y:"sy9"}},{type:"lnTo",pt:{x:"x14",y:"y8"}},{type:"lnTo",pt:{x:"sx15",y:"sy10"}},{type:"lnTo",pt:{x:"x13",y:"y9"}},{type:"lnTo",pt:{x:"sx14",y:"sy11"}},{type:"lnTo",pt:{x:"x12",y:"y10"}},{type:"lnTo",pt:{x:"sx13",y:"sy12"}},{type:"lnTo",pt:{x:"x11",y:"y11"}},{type:"lnTo",pt:{x:"sx12",y:"sy13"}},{type:"lnTo",pt:{x:"x10",y:"y12"}},{type:"lnTo",pt:{x:"sx11",y:"sy14"}},{type:"lnTo",pt:{x:"x9",y:"y13"}},{type:"lnTo",pt:{x:"sx10",y:"sy15"}},{type:"lnTo",pt:{x:"x8",y:"y14"}},{type:"lnTo",pt:{x:"sx9",y:"sy16"}},{type:"lnTo",pt:{x:"hc",y:"b"}},{type:"lnTo",pt:{x:"sx8",y:"sy16"}},{type:"lnTo",pt:{x:"x7",y:"y14"}},{type:"lnTo",pt:{x:"sx7",y:"sy15"}},{type:"lnTo",pt:{x:"x6",y:"y13"}},{type:"lnTo",pt:{x:"sx6",y:"sy14"}},{type:"lnTo",pt:{x:"x5",y:"y12"}},{type:"lnTo",pt:{x:"sx5",y:"sy13"}},{type:"lnTo",pt:{x:"x4",y:"y11"}},{type:"lnTo",pt:{x:"sx4",y:"sy12"}},{type:"lnTo",pt:{x:"x3",y:"y10"}},{type:"lnTo",pt:{x:"sx3",y:"sy11"}},{type:"lnTo",pt:{x:"x2",y:"y9"}},{type:"lnTo",pt:{x:"sx2",y:"sy10"}},{type:"lnTo",pt:{x:"x1",y:"y8"}},{type:"lnTo",pt:{x:"sx1",y:"sy9"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},star4:{avLst:[{n:"adj",f:"val 12500"}],gdLst:[{n:"a",f:"pin 0 adj 50000"},{n:"iwd2",f:"*/ wd2 a 50000"},{n:"ihd2",f:"*/ hd2 a 50000"},{n:"sdx",f:"cos iwd2 2700000"},{n:"sdy",f:"sin ihd2 2700000"},{n:"sx1",f:"+- hc 0 sdx"},{n:"sx2",f:"+- hc sdx 0"},{n:"sy1",f:"+- vc 0 sdy"},{n:"sy2",f:"+- vc sdy 0"},{n:"yAdj",f:"+- vc 0 ihd2"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"vc"}},{type:"lnTo",pt:{x:"sx1",y:"sy1"}},{type:"lnTo",pt:{x:"hc",y:"t"}},{type:"lnTo",pt:{x:"sx2",y:"sy1"}},{type:"lnTo",pt:{x:"r",y:"vc"}},{type:"lnTo",pt:{x:"sx2",y:"sy2"}},{type:"lnTo",pt:{x:"hc",y:"b"}},{type:"lnTo",pt:{x:"sx1",y:"sy2"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},star5:{avLst:[{n:"adj",f:"val 19098"},{n:"hf",f:"val 105146"},{n:"vf",f:"val 110557"}],gdLst:[{n:"a",f:"pin 0 adj 50000"},{n:"swd2",f:"*/ wd2 hf 100000"},{n:"shd2",f:"*/ hd2 vf 100000"},{n:"svc",f:"*/ vc  vf 100000"},{n:"dx1",f:"cos swd2 1080000"},{n:"dx2",f:"cos swd2 18360000"},{n:"dy1",f:"sin shd2 1080000"},{n:"dy2",f:"sin shd2 18360000"},{n:"x1",f:"+- hc 0 dx1"},{n:"x2",f:"+- hc 0 dx2"},{n:"x3",f:"+- hc dx2 0"},{n:"x4",f:"+- hc dx1 0"},{n:"y1",f:"+- svc 0 dy1"},{n:"y2",f:"+- svc 0 dy2"},{n:"iwd2",f:"*/ swd2 a 50000"},{n:"ihd2",f:"*/ shd2 a 50000"},{n:"sdx1",f:"cos iwd2 20520000"},{n:"sdx2",f:"cos iwd2 3240000"},{n:"sdy1",f:"sin ihd2 3240000"},{n:"sdy2",f:"sin ihd2 20520000"},{n:"sx1",f:"+- hc 0 sdx1"},{n:"sx2",f:"+- hc 0 sdx2"},{n:"sx3",f:"+- hc sdx2 0"},{n:"sx4",f:"+- hc sdx1 0"},{n:"sy1",f:"+- svc 0 sdy1"},{n:"sy2",f:"+- svc 0 sdy2"},{n:"sy3",f:"+- svc ihd2 0"},{n:"yAdj",f:"+- svc 0 ihd2"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"x1",y:"y1"}},{type:"lnTo",pt:{x:"sx2",y:"sy1"}},{type:"lnTo",pt:{x:"hc",y:"t"}},{type:"lnTo",pt:{x:"sx3",y:"sy1"}},{type:"lnTo",pt:{x:"x4",y:"y1"}},{type:"lnTo",pt:{x:"sx4",y:"sy2"}},{type:"lnTo",pt:{x:"x3",y:"y2"}},{type:"lnTo",pt:{x:"hc",y:"sy3"}},{type:"lnTo",pt:{x:"x2",y:"y2"}},{type:"lnTo",pt:{x:"sx1",y:"sy2"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},star6:{avLst:[{n:"adj",f:"val 28868"},{n:"hf",f:"val 115470"}],gdLst:[{n:"a",f:"pin 0 adj 50000"},{n:"swd2",f:"*/ wd2 hf 100000"},{n:"dx1",f:"cos swd2 1800000"},{n:"x1",f:"+- hc 0 dx1"},{n:"x2",f:"+- hc dx1 0"},{n:"y2",f:"+- vc hd4 0"},{n:"iwd2",f:"*/ swd2 a 50000"},{n:"ihd2",f:"*/ hd2 a 50000"},{n:"sdx2",f:"*/ iwd2 1 2"},{n:"sx1",f:"+- hc 0 iwd2"},{n:"sx2",f:"+- hc 0 sdx2"},{n:"sx3",f:"+- hc sdx2 0"},{n:"sx4",f:"+- hc iwd2 0"},{n:"sdy1",f:"sin ihd2 3600000"},{n:"sy1",f:"+- vc 0 sdy1"},{n:"sy2",f:"+- vc sdy1 0"},{n:"yAdj",f:"+- vc 0 ihd2"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"x1",y:"hd4"}},{type:"lnTo",pt:{x:"sx2",y:"sy1"}},{type:"lnTo",pt:{x:"hc",y:"t"}},{type:"lnTo",pt:{x:"sx3",y:"sy1"}},{type:"lnTo",pt:{x:"x2",y:"hd4"}},{type:"lnTo",pt:{x:"sx4",y:"vc"}},{type:"lnTo",pt:{x:"x2",y:"y2"}},{type:"lnTo",pt:{x:"sx3",y:"sy2"}},{type:"lnTo",pt:{x:"hc",y:"b"}},{type:"lnTo",pt:{x:"sx2",y:"sy2"}},{type:"lnTo",pt:{x:"x1",y:"y2"}},{type:"lnTo",pt:{x:"sx1",y:"vc"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},star7:{avLst:[{n:"adj",f:"val 34601"},{n:"hf",f:"val 102572"},{n:"vf",f:"val 105210"}],gdLst:[{n:"a",f:"pin 0 adj 50000"},{n:"swd2",f:"*/ wd2 hf 100000"},{n:"shd2",f:"*/ hd2 vf 100000"},{n:"svc",f:"*/ vc  vf 100000"},{n:"dx1",f:"*/ swd2 97493 100000"},{n:"dx2",f:"*/ swd2 78183 100000"},{n:"dx3",f:"*/ swd2 43388 100000"},{n:"dy1",f:"*/ shd2 62349 100000"},{n:"dy2",f:"*/ shd2 22252 100000"},{n:"dy3",f:"*/ shd2 90097 100000"},{n:"x1",f:"+- hc 0 dx1"},{n:"x2",f:"+- hc 0 dx2"},{n:"x3",f:"+- hc 0 dx3"},{n:"x4",f:"+- hc dx3 0"},{n:"x5",f:"+- hc dx2 0"},{n:"x6",f:"+- hc dx1 0"},{n:"y1",f:"+- svc 0 dy1"},{n:"y2",f:"+- svc dy2 0"},{n:"y3",f:"+- svc dy3 0"},{n:"iwd2",f:"*/ swd2 a 50000"},{n:"ihd2",f:"*/ shd2 a 50000"},{n:"sdx1",f:"*/ iwd2 97493 100000"},{n:"sdx2",f:"*/ iwd2 78183 100000"},{n:"sdx3",f:"*/ iwd2 43388 100000"},{n:"sx1",f:"+- hc 0 sdx1"},{n:"sx2",f:"+- hc 0 sdx2"},{n:"sx3",f:"+- hc 0 sdx3"},{n:"sx4",f:"+- hc sdx3 0"},{n:"sx5",f:"+- hc sdx2 0"},{n:"sx6",f:"+- hc sdx1 0"},{n:"sdy1",f:"*/ ihd2 90097 100000"},{n:"sdy2",f:"*/ ihd2 22252 100000"},{n:"sdy3",f:"*/ ihd2 62349 100000"},{n:"sy1",f:"+- svc 0 sdy1"},{n:"sy2",f:"+- svc 0 sdy2"},{n:"sy3",f:"+- svc sdy3 0"},{n:"sy4",f:"+- svc ihd2 0"},{n:"yAdj",f:"+- svc 0 ihd2"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"x1",y:"y2"}},{type:"lnTo",pt:{x:"sx1",y:"sy2"}},{type:"lnTo",pt:{x:"x2",y:"y1"}},{type:"lnTo",pt:{x:"sx3",y:"sy1"}},{type:"lnTo",pt:{x:"hc",y:"t"}},{type:"lnTo",pt:{x:"sx4",y:"sy1"}},{type:"lnTo",pt:{x:"x5",y:"y1"}},{type:"lnTo",pt:{x:"sx6",y:"sy2"}},{type:"lnTo",pt:{x:"x6",y:"y2"}},{type:"lnTo",pt:{x:"sx5",y:"sy3"}},{type:"lnTo",pt:{x:"x4",y:"y3"}},{type:"lnTo",pt:{x:"hc",y:"sy4"}},{type:"lnTo",pt:{x:"x3",y:"y3"}},{type:"lnTo",pt:{x:"sx2",y:"sy3"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},star8:{avLst:[{n:"adj",f:"val 37500"}],gdLst:[{n:"a",f:"pin 0 adj 50000"},{n:"dx1",f:"cos wd2 2700000"},{n:"x1",f:"+- hc 0 dx1"},{n:"x2",f:"+- hc dx1 0"},{n:"dy1",f:"sin hd2 2700000"},{n:"y1",f:"+- vc 0 dy1"},{n:"y2",f:"+- vc dy1 0"},{n:"iwd2",f:"*/ wd2 a 50000"},{n:"ihd2",f:"*/ hd2 a 50000"},{n:"sdx1",f:"*/ iwd2 92388 100000"},{n:"sdx2",f:"*/ iwd2 38268 100000"},{n:"sdy1",f:"*/ ihd2 92388 100000"},{n:"sdy2",f:"*/ ihd2 38268 100000"},{n:"sx1",f:"+- hc 0 sdx1"},{n:"sx2",f:"+- hc 0 sdx2"},{n:"sx3",f:"+- hc sdx2 0"},{n:"sx4",f:"+- hc sdx1 0"},{n:"sy1",f:"+- vc 0 sdy1"},{n:"sy2",f:"+- vc 0 sdy2"},{n:"sy3",f:"+- vc sdy2 0"},{n:"sy4",f:"+- vc sdy1 0"},{n:"yAdj",f:"+- vc 0 ihd2"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"vc"}},{type:"lnTo",pt:{x:"sx1",y:"sy2"}},{type:"lnTo",pt:{x:"x1",y:"y1"}},{type:"lnTo",pt:{x:"sx2",y:"sy1"}},{type:"lnTo",pt:{x:"hc",y:"t"}},{type:"lnTo",pt:{x:"sx3",y:"sy1"}},{type:"lnTo",pt:{x:"x2",y:"y1"}},{type:"lnTo",pt:{x:"sx4",y:"sy2"}},{type:"lnTo",pt:{x:"r",y:"vc"}},{type:"lnTo",pt:{x:"sx4",y:"sy3"}},{type:"lnTo",pt:{x:"x2",y:"y2"}},{type:"lnTo",pt:{x:"sx3",y:"sy4"}},{type:"lnTo",pt:{x:"hc",y:"b"}},{type:"lnTo",pt:{x:"sx2",y:"sy4"}},{type:"lnTo",pt:{x:"x1",y:"y2"}},{type:"lnTo",pt:{x:"sx1",y:"sy3"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},straightConnector1:{pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}}],fill:"none",extrusionOk:!1,stroke:!0}]},stripedRightArrow:{avLst:[{n:"adj1",f:"val 50000"},{n:"adj2",f:"val 50000"}],gdLst:[{n:"maxAdj2",f:"*/ 84375 w ss"},{n:"a1",f:"pin 0 adj1 100000"},{n:"a2",f:"pin 0 adj2 maxAdj2"},{n:"x4",f:"*/ ss 5 32"},{n:"dx5",f:"*/ ss a2 100000"},{n:"x5",f:"+- r 0 dx5"},{n:"dy1",f:"*/ h a1 200000"},{n:"y1",f:"+- vc 0 dy1"},{n:"y2",f:"+- vc dy1 0"},{n:"dx6",f:"*/ dy1 dx5 hd2"},{n:"x6",f:"+- r 0 dx6"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"y1"}},{type:"lnTo",pt:{x:"ssd32",y:"y1"}},{type:"lnTo",pt:{x:"ssd32",y:"y2"}},{type:"lnTo",pt:{x:"l",y:"y2"}},{type:"close"},{type:"moveTo",pt:{x:"ssd16",y:"y1"}},{type:"lnTo",pt:{x:"ssd8",y:"y1"}},{type:"lnTo",pt:{x:"ssd8",y:"y2"}},{type:"lnTo",pt:{x:"ssd16",y:"y2"}},{type:"close"},{type:"moveTo",pt:{x:"x4",y:"y1"}},{type:"lnTo",pt:{x:"x5",y:"y1"}},{type:"lnTo",pt:{x:"x5",y:"t"}},{type:"lnTo",pt:{x:"r",y:"vc"}},{type:"lnTo",pt:{x:"x5",y:"b"}},{type:"lnTo",pt:{x:"x5",y:"y2"}},{type:"lnTo",pt:{x:"x4",y:"y2"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},sun:{avLst:[{n:"adj",f:"val 25000"}],gdLst:[{n:"a",f:"pin 12500 adj 46875"},{n:"g0",f:"+- 50000 0 a"},{n:"g1",f:"*/ g0 30274 32768"},{n:"g2",f:"*/ g0 12540 32768"},{n:"g3",f:"+- g1 50000 0"},{n:"g4",f:"+- g2 50000 0"},{n:"g5",f:"+- 50000 0 g1"},{n:"g6",f:"+- 50000 0 g2"},{n:"g7",f:"*/ g0 23170 32768"},{n:"g8",f:"+- 50000 g7 0"},{n:"g9",f:"+- 50000 0 g7"},{n:"g10",f:"*/ g5 3 4"},{n:"g11",f:"*/ g6 3 4"},{n:"g12",f:"+- g10 3662 0"},{n:"g13",f:"+- g11 3662 0"},{n:"g14",f:"+- g11 12500 0"},{n:"g15",f:"+- 100000 0 g10"},{n:"g16",f:"+- 100000 0 g12"},{n:"g17",f:"+- 100000 0 g13"},{n:"g18",f:"+- 100000 0 g14"},{n:"ox1",f:"*/ w 18436 21600"},{n:"oy1",f:"*/ h 3163 21600"},{n:"ox2",f:"*/ w 3163 21600"},{n:"oy2",f:"*/ h 18436 21600"},{n:"x8",f:"*/ w g8 100000"},{n:"x9",f:"*/ w g9 100000"},{n:"x10",f:"*/ w g10 100000"},{n:"x12",f:"*/ w g12 100000"},{n:"x13",f:"*/ w g13 100000"},{n:"x14",f:"*/ w g14 100000"},{n:"x15",f:"*/ w g15 100000"},{n:"x16",f:"*/ w g16 100000"},{n:"x17",f:"*/ w g17 100000"},{n:"x18",f:"*/ w g18 100000"},{n:"x19",f:"*/ w a 100000"},{n:"wR",f:"*/ w g0 100000"},{n:"hR",f:"*/ h g0 100000"},{n:"y8",f:"*/ h g8 100000"},{n:"y9",f:"*/ h g9 100000"},{n:"y10",f:"*/ h g10 100000"},{n:"y12",f:"*/ h g12 100000"},{n:"y13",f:"*/ h g13 100000"},{n:"y14",f:"*/ h g14 100000"},{n:"y15",f:"*/ h g15 100000"},{n:"y16",f:"*/ h g16 100000"},{n:"y17",f:"*/ h g17 100000"},{n:"y18",f:"*/ h g18 100000"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"r",y:"vc"}},{type:"lnTo",pt:{x:"x15",y:"y18"}},{type:"lnTo",pt:{x:"x15",y:"y14"}},{type:"close"},{type:"moveTo",pt:{x:"ox1",y:"oy1"}},{type:"lnTo",pt:{x:"x16",y:"y13"}},{type:"lnTo",pt:{x:"x17",y:"y12"}},{type:"close"},{type:"moveTo",pt:{x:"hc",y:"t"}},{type:"lnTo",pt:{x:"x18",y:"y10"}},{type:"lnTo",pt:{x:"x14",y:"y10"}},{type:"close"},{type:"moveTo",pt:{x:"ox2",y:"oy1"}},{type:"lnTo",pt:{x:"x13",y:"y12"}},{type:"lnTo",pt:{x:"x12",y:"y13"}},{type:"close"},{type:"moveTo",pt:{x:"l",y:"vc"}},{type:"lnTo",pt:{x:"x10",y:"y14"}},{type:"lnTo",pt:{x:"x10",y:"y18"}},{type:"close"},{type:"moveTo",pt:{x:"ox2",y:"oy2"}},{type:"lnTo",pt:{x:"x12",y:"y17"}},{type:"lnTo",pt:{x:"x13",y:"y16"}},{type:"close"},{type:"moveTo",pt:{x:"hc",y:"b"}},{type:"lnTo",pt:{x:"x14",y:"y15"}},{type:"lnTo",pt:{x:"x18",y:"y15"}},{type:"close"},{type:"moveTo",pt:{x:"ox1",y:"oy2"}},{type:"lnTo",pt:{x:"x17",y:"y16"}},{type:"lnTo",pt:{x:"x16",y:"y17"}},{type:"close"},{type:"moveTo",pt:{x:"x19",y:"vc"}},{type:"arcTo",wR:"wR",hR:"hR",stAng:"cd2",swAng:"21600000"},{type:"close"}],extrusionOk:!1,stroke:!0}]},swooshArrow:{avLst:[{n:"adj1",f:"val 25000"},{n:"adj2",f:"val 16667"}],gdLst:[{n:"a1",f:"pin 1 adj1 75000"},{n:"maxAdj2",f:"*/ 70000 w ss"},{n:"a2",f:"pin 0 adj2 maxAdj2"},{n:"ad1",f:"*/ h a1 100000"},{n:"ad2",f:"*/ ss a2 100000"},{n:"xB",f:"+- r 0 ad2"},{n:"yB",f:"+- t ssd8 0"},{n:"alfa",f:"*/ cd4 1 14"},{n:"dx0",f:"tan ssd8 alfa"},{n:"xC",f:"+- xB 0 dx0"},{n:"dx1",f:"tan ad1 alfa"},{n:"yF",f:"+- yB ad1 0"},{n:"xF",f:"+- xB dx1 0"},{n:"xE",f:"+- xF dx0 0"},{n:"yE",f:"+- yF ssd8 0"},{n:"dy2",f:"+- yE 0 t"},{n:"dy22",f:"*/ dy2 1 2"},{n:"dy3",f:"*/ h 1 20"},{n:"yD",f:"+- t dy22 dy3"},{n:"dy4",f:"*/ hd6 1 1"},{n:"yP1",f:"+- hd6 dy4 0"},{n:"xP1",f:"val wd6"},{n:"dy5",f:"*/ hd6 1 2"},{n:"yP2",f:"+- yF dy5 0"},{n:"xP2",f:"val wd4"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"b"}},{type:"quadBezTo",pts:[{x:"xP1",y:"yP1"},{x:"xB",y:"yB"}]},{type:"lnTo",pt:{x:"xC",y:"t"}},{type:"lnTo",pt:{x:"r",y:"yD"}},{type:"lnTo",pt:{x:"xE",y:"yE"}},{type:"lnTo",pt:{x:"xF",y:"yF"}},{type:"quadBezTo",pts:[{x:"xP2",y:"yP2"},{x:"l",y:"b"}]},{type:"close"}],extrusionOk:!1,stroke:!0}]},teardrop:{avLst:[{n:"adj",f:"val 100000"}],gdLst:[{n:"a",f:"pin 0 adj 200000"},{n:"r2",f:"sqrt 2"},{n:"tw",f:"*/ wd2 r2 1"},{n:"th",f:"*/ hd2 r2 1"},{n:"sw",f:"*/ tw a 100000"},{n:"sh",f:"*/ th a 100000"},{n:"dx1",f:"cos sw 2700000"},{n:"dy1",f:"sin sh 2700000"},{n:"x1",f:"+- hc dx1 0"},{n:"y1",f:"+- vc 0 dy1"},{n:"x2",f:"+/ hc x1 2"},{n:"y2",f:"+/ vc y1 2"},{n:"idx",f:"cos wd2 2700000"},{n:"idy",f:"sin hd2 2700000"},{n:"il",f:"+- hc 0 idx"},{n:"ir",f:"+- hc idx 0"},{n:"it",f:"+- vc 0 idy"},{n:"ib",f:"+- vc idy 0"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"vc"}},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"cd2",swAng:"cd4"},{type:"quadBezTo",pts:[{x:"x2",y:"t"},{x:"x1",y:"y1"}]},{type:"quadBezTo",pts:[{x:"r",y:"y2"},{x:"r",y:"vc"}]},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"0",swAng:"cd4"},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"cd4",swAng:"cd4"},{type:"close"}],extrusionOk:!1,stroke:!0}]},trapezoid:{avLst:[{n:"adj",f:"val 25000"}],gdLst:[{n:"maxAdj",f:"*/ 50000 w ss"},{n:"a",f:"pin 0 adj maxAdj"},{n:"x1",f:"*/ ss a 200000"},{n:"x2",f:"*/ ss a 100000"},{n:"x3",f:"+- r 0 x2"},{n:"x4",f:"+- r 0 x1"},{n:"il",f:"*/ wd3 a maxAdj"},{n:"it",f:"*/ hd3 a maxAdj"},{n:"ir",f:"+- r 0 il"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"b"}},{type:"lnTo",pt:{x:"x2",y:"t"}},{type:"lnTo",pt:{x:"x3",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},triangle:{avLst:[{n:"adj",f:"val 50000"}],gdLst:[{n:"a",f:"pin 0 adj 100000"},{n:"x1",f:"*/ w a 200000"},{n:"x2",f:"*/ w a 100000"},{n:"x3",f:"+- x1 wd2 0"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"b"}},{type:"lnTo",pt:{x:"x2",y:"t"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},upArrowCallout:{avLst:[{n:"adj1",f:"val 25000"},{n:"adj2",f:"val 25000"},{n:"adj3",f:"val 25000"},{n:"adj4",f:"val 64977"}],gdLst:[{n:"maxAdj2",f:"*/ 50000 w ss"},{n:"a2",f:"pin 0 adj2 maxAdj2"},{n:"maxAdj1",f:"*/ a2 2 1"},{n:"a1",f:"pin 0 adj1 maxAdj1"},{n:"maxAdj3",f:"*/ 100000 h ss"},{n:"a3",f:"pin 0 adj3 maxAdj3"},{n:"q2",f:"*/ a3 ss h"},{n:"maxAdj4",f:"+- 100000 0 q2"},{n:"a4",f:"pin 0 adj4 maxAdj4"},{n:"dx1",f:"*/ ss a2 100000"},{n:"dx2",f:"*/ ss a1 200000"},{n:"x1",f:"+- hc 0 dx1"},{n:"x2",f:"+- hc 0 dx2"},{n:"x3",f:"+- hc dx2 0"},{n:"x4",f:"+- hc dx1 0"},{n:"y1",f:"*/ ss a3 100000"},{n:"dy2",f:"*/ h a4 100000"},{n:"y2",f:"+- b 0 dy2"},{n:"y3",f:"+/ y2 b 2"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"y2"}},{type:"lnTo",pt:{x:"x2",y:"y2"}},{type:"lnTo",pt:{x:"x2",y:"y1"}},{type:"lnTo",pt:{x:"x1",y:"y1"}},{type:"lnTo",pt:{x:"hc",y:"t"}},{type:"lnTo",pt:{x:"x4",y:"y1"}},{type:"lnTo",pt:{x:"x3",y:"y1"}},{type:"lnTo",pt:{x:"x3",y:"y2"}},{type:"lnTo",pt:{x:"r",y:"y2"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},upDownArrow:{avLst:[{n:"adj1",f:"val 50000"},{n:"adj2",f:"val 50000"}],gdLst:[{n:"maxAdj2",f:"*/ 50000 h ss"},{n:"a1",f:"pin 0 adj1 100000"},{n:"a2",f:"pin 0 adj2 maxAdj2"},{n:"y2",f:"*/ ss a2 100000"},{n:"y3",f:"+- b 0 y2"},{n:"dx1",f:"*/ w a1 200000"},{n:"x1",f:"+- hc 0 dx1"},{n:"x2",f:"+- hc dx1 0"},{n:"dy1",f:"*/ x1 y2 wd2"},{n:"y1",f:"+- y2 0 dy1"},{n:"y4",f:"+- y3 dy1 0"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"y2"}},{type:"lnTo",pt:{x:"hc",y:"t"}},{type:"lnTo",pt:{x:"r",y:"y2"}},{type:"lnTo",pt:{x:"x2",y:"y2"}},{type:"lnTo",pt:{x:"x2",y:"y3"}},{type:"lnTo",pt:{x:"r",y:"y3"}},{type:"lnTo",pt:{x:"hc",y:"b"}},{type:"lnTo",pt:{x:"l",y:"y3"}},{type:"lnTo",pt:{x:"x1",y:"y3"}},{type:"lnTo",pt:{x:"x1",y:"y2"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},upArrow:{avLst:[{n:"adj1",f:"val 50000"},{n:"adj2",f:"val 50000"}],gdLst:[{n:"maxAdj2",f:"*/ 100000 h ss"},{n:"a1",f:"pin 0 adj1 100000"},{n:"a2",f:"pin 0 adj2 maxAdj2"},{n:"dy2",f:"*/ ss a2 100000"},{n:"y2",f:"+- t dy2 0"},{n:"dx1",f:"*/ w a1 200000"},{n:"x1",f:"+- hc 0 dx1"},{n:"x2",f:"+- hc dx1 0"},{n:"dy1",f:"*/ x1 dy2 wd2"},{n:"y1",f:"+- y2  0 dy1"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"y2"}},{type:"lnTo",pt:{x:"hc",y:"t"}},{type:"lnTo",pt:{x:"r",y:"y2"}},{type:"lnTo",pt:{x:"x2",y:"y2"}},{type:"lnTo",pt:{x:"x2",y:"b"}},{type:"lnTo",pt:{x:"x1",y:"b"}},{type:"lnTo",pt:{x:"x1",y:"y2"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},upDownArrowCallout:{avLst:[{n:"adj1",f:"val 25000"},{n:"adj2",f:"val 25000"},{n:"adj3",f:"val 25000"},{n:"adj4",f:"val 48123"}],gdLst:[{n:"maxAdj2",f:"*/ 50000 w ss"},{n:"a2",f:"pin 0 adj2 maxAdj2"},{n:"maxAdj1",f:"*/ a2 2 1"},{n:"a1",f:"pin 0 adj1 maxAdj1"},{n:"maxAdj3",f:"*/ 50000 h ss"},{n:"a3",f:"pin 0 adj3 maxAdj3"},{n:"q2",f:"*/ a3 ss hd2"},{n:"maxAdj4",f:"+- 100000 0 q2"},{n:"a4",f:"pin 0 adj4 maxAdj4"},{n:"dx1",f:"*/ ss a2 100000"},{n:"dx2",f:"*/ ss a1 200000"},{n:"x1",f:"+- hc 0 dx1"},{n:"x2",f:"+- hc 0 dx2"},{n:"x3",f:"+- hc dx2 0"},{n:"x4",f:"+- hc dx1 0"},{n:"y1",f:"*/ ss a3 100000"},{n:"y4",f:"+- b 0 y1"},{n:"dy2",f:"*/ h a4 200000"},{n:"y2",f:"+- vc 0 dy2"},{n:"y3",f:"+- vc dy2 0"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"y2"}},{type:"lnTo",pt:{x:"x2",y:"y2"}},{type:"lnTo",pt:{x:"x2",y:"y1"}},{type:"lnTo",pt:{x:"x1",y:"y1"}},{type:"lnTo",pt:{x:"hc",y:"t"}},{type:"lnTo",pt:{x:"x4",y:"y1"}},{type:"lnTo",pt:{x:"x3",y:"y1"}},{type:"lnTo",pt:{x:"x3",y:"y2"}},{type:"lnTo",pt:{x:"r",y:"y2"}},{type:"lnTo",pt:{x:"r",y:"y3"}},{type:"lnTo",pt:{x:"x3",y:"y3"}},{type:"lnTo",pt:{x:"x3",y:"y4"}},{type:"lnTo",pt:{x:"x4",y:"y4"}},{type:"lnTo",pt:{x:"hc",y:"b"}},{type:"lnTo",pt:{x:"x1",y:"y4"}},{type:"lnTo",pt:{x:"x2",y:"y4"}},{type:"lnTo",pt:{x:"x2",y:"y3"}},{type:"lnTo",pt:{x:"l",y:"y3"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},uturnArrow:{avLst:[{n:"adj1",f:"val 25000"},{n:"adj2",f:"val 25000"},{n:"adj3",f:"val 25000"},{n:"adj4",f:"val 43750"},{n:"adj5",f:"val 75000"}],gdLst:[{n:"a2",f:"pin 0 adj2 25000"},{n:"maxAdj1",f:"*/ a2 2 1"},{n:"a1",f:"pin 0 adj1 maxAdj1"},{n:"q2",f:"*/ a1 ss h"},{n:"q3",f:"+- 100000 0 q2"},{n:"maxAdj3",f:"*/ q3 h ss"},{n:"a3",f:"pin 0 adj3 maxAdj3"},{n:"q1",f:"+- a3 a1 0"},{n:"minAdj5",f:"*/ q1 ss h"},{n:"a5",f:"pin minAdj5 adj5 100000"},{n:"th",f:"*/ ss a1 100000"},{n:"aw2",f:"*/ ss a2 100000"},{n:"th2",f:"*/ th 1 2"},{n:"dh2",f:"+- aw2 0 th2"},{n:"y5",f:"*/ h a5 100000"},{n:"ah",f:"*/ ss a3 100000"},{n:"y4",f:"+- y5 0 ah"},{n:"x9",f:"+- r 0 dh2"},{n:"bw",f:"*/ x9 1 2"},{n:"bs",f:"min bw y4"},{n:"maxAdj4",f:"*/ bs 100000 ss"},{n:"a4",f:"pin 0 adj4 maxAdj4"},{n:"bd",f:"*/ ss a4 100000"},{n:"bd3",f:"+- bd 0 th"},{n:"bd2",f:"max bd3 0"},{n:"x3",f:"+- th bd2 0"},{n:"x8",f:"+- r 0 aw2"},{n:"x6",f:"+- x8 0 aw2"},{n:"x7",f:"+- x6 dh2 0"},{n:"x4",f:"+- x9 0 bd"},{n:"x5",f:"+- x7 0 bd2"},{n:"cx",f:"+/ th x7 2"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"b"}},{type:"lnTo",pt:{x:"l",y:"bd"}},{type:"arcTo",wR:"bd",hR:"bd",stAng:"cd2",swAng:"cd4"},{type:"lnTo",pt:{x:"x4",y:"t"}},{type:"arcTo",wR:"bd",hR:"bd",stAng:"3cd4",swAng:"cd4"},{type:"lnTo",pt:{x:"x9",y:"y4"}},{type:"lnTo",pt:{x:"r",y:"y4"}},{type:"lnTo",pt:{x:"x8",y:"y5"}},{type:"lnTo",pt:{x:"x6",y:"y4"}},{type:"lnTo",pt:{x:"x7",y:"y4"}},{type:"lnTo",pt:{x:"x7",y:"x3"}},{type:"arcTo",wR:"bd2",hR:"bd2",stAng:"0",swAng:"-5400000"},{type:"lnTo",pt:{x:"x3",y:"th"}},{type:"arcTo",wR:"bd2",hR:"bd2",stAng:"3cd4",swAng:"-5400000"},{type:"lnTo",pt:{x:"th",y:"b"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},verticalScroll:{avLst:[{n:"adj",f:"val 12500"}],gdLst:[{n:"a",f:"pin 0 adj 25000"},{n:"ch",f:"*/ ss a 100000"},{n:"ch2",f:"*/ ch 1 2"},{n:"ch4",f:"*/ ch 1 4"},{n:"x3",f:"+- ch ch2 0"},{n:"x4",f:"+- ch ch 0"},{n:"x6",f:"+- r 0 ch"},{n:"x7",f:"+- r 0 ch2"},{n:"x5",f:"+- x6 0 ch2"},{n:"y3",f:"+- b 0 ch"},{n:"y4",f:"+- b 0 ch2"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"ch2",y:"b"}},{type:"arcTo",wR:"ch2",hR:"ch2",stAng:"cd4",swAng:"-5400000"},{type:"lnTo",pt:{x:"ch2",y:"y4"}},{type:"arcTo",wR:"ch4",hR:"ch4",stAng:"cd4",swAng:"-10800000"},{type:"lnTo",pt:{x:"ch",y:"y3"}},{type:"lnTo",pt:{x:"ch",y:"ch2"}},{type:"arcTo",wR:"ch2",hR:"ch2",stAng:"cd2",swAng:"cd4"},{type:"lnTo",pt:{x:"x7",y:"t"}},{type:"arcTo",wR:"ch2",hR:"ch2",stAng:"3cd4",swAng:"cd2"},{type:"lnTo",pt:{x:"x6",y:"ch"}},{type:"lnTo",pt:{x:"x6",y:"y4"}},{type:"arcTo",wR:"ch2",hR:"ch2",stAng:"0",swAng:"cd4"},{type:"close"},{type:"moveTo",pt:{x:"x4",y:"ch2"}},{type:"arcTo",wR:"ch2",hR:"ch2",stAng:"0",swAng:"cd4"},{type:"arcTo",wR:"ch4",hR:"ch4",stAng:"cd4",swAng:"cd2"},{type:"close"}],extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"x4",y:"ch2"}},{type:"arcTo",wR:"ch2",hR:"ch2",stAng:"0",swAng:"cd4"},{type:"arcTo",wR:"ch4",hR:"ch4",stAng:"cd4",swAng:"cd2"},{type:"close"},{type:"moveTo",pt:{x:"ch",y:"y4"}},{type:"arcTo",wR:"ch2",hR:"ch2",stAng:"0",swAng:"3cd4"},{type:"arcTo",wR:"ch4",hR:"ch4",stAng:"3cd4",swAng:"cd2"},{type:"close"}],fill:"darkenLess",extrusionOk:!1,stroke:!1},{defines:[{type:"moveTo",pt:{x:"ch",y:"y3"}},{type:"lnTo",pt:{x:"ch",y:"ch2"}},{type:"arcTo",wR:"ch2",hR:"ch2",stAng:"cd2",swAng:"cd4"},{type:"lnTo",pt:{x:"x7",y:"t"}},{type:"arcTo",wR:"ch2",hR:"ch2",stAng:"3cd4",swAng:"cd2"},{type:"lnTo",pt:{x:"x6",y:"ch"}},{type:"lnTo",pt:{x:"x6",y:"y4"}},{type:"arcTo",wR:"ch2",hR:"ch2",stAng:"0",swAng:"cd4"},{type:"lnTo",pt:{x:"ch2",y:"b"}},{type:"arcTo",wR:"ch2",hR:"ch2",stAng:"cd4",swAng:"cd2"},{type:"close"},{type:"moveTo",pt:{x:"x3",y:"t"}},{type:"arcTo",wR:"ch2",hR:"ch2",stAng:"3cd4",swAng:"cd2"},{type:"arcTo",wR:"ch4",hR:"ch4",stAng:"cd4",swAng:"cd2"},{type:"lnTo",pt:{x:"x4",y:"ch2"}},{type:"moveTo",pt:{x:"x6",y:"ch"}},{type:"lnTo",pt:{x:"x3",y:"ch"}},{type:"moveTo",pt:{x:"ch2",y:"y3"}},{type:"arcTo",wR:"ch4",hR:"ch4",stAng:"3cd4",swAng:"cd2"},{type:"lnTo",pt:{x:"ch",y:"y4"}},{type:"moveTo",pt:{x:"ch2",y:"b"}},{type:"arcTo",wR:"ch2",hR:"ch2",stAng:"cd4",swAng:"-5400000"},{type:"lnTo",pt:{x:"ch",y:"y3"}}],fill:"none",extrusionOk:!1,stroke:!0}]},wave:{avLst:[{n:"adj1",f:"val 12500"},{n:"adj2",f:"val 0"}],gdLst:[{n:"a1",f:"pin 0 adj1 20000"},{n:"a2",f:"pin -10000 adj2 10000"},{n:"y1",f:"*/ h a1 100000"},{n:"dy2",f:"*/ y1 10 3"},{n:"y2",f:"+- y1 0 dy2"},{n:"y3",f:"+- y1 dy2 0"},{n:"y4",f:"+- b 0 y1"},{n:"y5",f:"+- y4 0 dy2"},{n:"y6",f:"+- y4 dy2 0"},{n:"dx1",f:"*/ w a2 100000"},{n:"of2",f:"*/ w a2 50000"},{n:"x1",f:"abs dx1"},{n:"dx2",f:"?: of2 0 of2"},{n:"x2",f:"+- l 0 dx2"},{n:"dx5",f:"?: of2 of2 0"},{n:"x5",f:"+- r 0 dx5"},{n:"dx3",f:"+/ dx2 x5 3"},{n:"x3",f:"+- x2 dx3 0"},{n:"x4",f:"+/ x3 x5 2"},{n:"x6",f:"+- l dx5 0"},{n:"x10",f:"+- r dx2 0"},{n:"x7",f:"+- x6 dx3 0"},{n:"x8",f:"+/ x7 x10 2"},{n:"x9",f:"+- r 0 x1"},{n:"xAdj",f:"+- hc dx1 0"},{n:"xAdj2",f:"+- hc 0 dx1"},{n:"il",f:"max x2 x6"},{n:"ir",f:"min x5 x10"},{n:"it",f:"*/ h a1 50000"},{n:"ib",f:"+- b 0 it"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"x2",y:"y1"}},{type:"cubicBezTo",pts:[{x:"x3",y:"y2"},{x:"x4",y:"y3"},{x:"x5",y:"y1"}]},{type:"lnTo",pt:{x:"x10",y:"y4"}},{type:"cubicBezTo",pts:[{x:"x8",y:"y6"},{x:"x7",y:"y5"},{x:"x6",y:"y4"}]},{type:"close"}],extrusionOk:!1,stroke:!0}]},wedgeEllipseCallout:{avLst:[{n:"adj1",f:"val -20833"},{n:"adj2",f:"val 62500"}],gdLst:[{n:"dxPos",f:"*/ w adj1 100000"},{n:"dyPos",f:"*/ h adj2 100000"},{n:"xPos",f:"+- hc dxPos 0"},{n:"yPos",f:"+- vc dyPos 0"},{n:"sdx",f:"*/ dxPos h 1"},{n:"sdy",f:"*/ dyPos w 1"},{n:"pang",f:"at2 sdx sdy"},{n:"stAng",f:"+- pang 660000 0"},{n:"enAng",f:"+- pang 0 660000"},{n:"dx1",f:"cos wd2 stAng"},{n:"dy1",f:"sin hd2 stAng"},{n:"x1",f:"+- hc dx1 0"},{n:"y1",f:"+- vc dy1 0"},{n:"dx2",f:"cos wd2 enAng"},{n:"dy2",f:"sin hd2 enAng"},{n:"x2",f:"+- hc dx2 0"},{n:"y2",f:"+- vc dy2 0"},{n:"stAng1",f:"at2 dx1 dy1"},{n:"enAng1",f:"at2 dx2 dy2"},{n:"swAng1",f:"+- enAng1 0 stAng1"},{n:"swAng2",f:"+- swAng1 21600000 0"},{n:"swAng",f:"?: swAng1 swAng1 swAng2"},{n:"idx",f:"cos wd2 2700000"},{n:"idy",f:"sin hd2 2700000"},{n:"il",f:"+- hc 0 idx"},{n:"ir",f:"+- hc idx 0"},{n:"it",f:"+- vc 0 idy"},{n:"ib",f:"+- vc idy 0"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"xPos",y:"yPos"}},{type:"lnTo",pt:{x:"x1",y:"y1"}},{type:"arcTo",wR:"wd2",hR:"hd2",stAng:"stAng1",swAng:"swAng"},{type:"close"}],extrusionOk:!1,stroke:!0}]},wedgeRectCallout:{avLst:[{n:"adj1",f:"val -20833"},{n:"adj2",f:"val 62500"}],gdLst:[{n:"dxPos",f:"*/ w adj1 100000"},{n:"dyPos",f:"*/ h adj2 100000"},{n:"xPos",f:"+- hc dxPos 0"},{n:"yPos",f:"+- vc dyPos 0"},{n:"dx",f:"+- xPos 0 hc"},{n:"dy",f:"+- yPos 0 vc"},{n:"dq",f:"*/ dxPos h w"},{n:"ady",f:"abs dyPos"},{n:"adq",f:"abs dq"},{n:"dz",f:"+- ady 0 adq"},{n:"xg1",f:"?: dxPos 7 2"},{n:"xg2",f:"?: dxPos 10 5"},{n:"x1",f:"*/ w xg1 12"},{n:"x2",f:"*/ w xg2 12"},{n:"yg1",f:"?: dyPos 7 2"},{n:"yg2",f:"?: dyPos 10 5"},{n:"y1",f:"*/ h yg1 12"},{n:"y2",f:"*/ h yg2 12"},{n:"t1",f:"?: dxPos l xPos"},{n:"xl",f:"?: dz l t1"},{n:"t2",f:"?: dyPos x1 xPos"},{n:"xt",f:"?: dz t2 x1"},{n:"t3",f:"?: dxPos xPos r"},{n:"xr",f:"?: dz r t3"},{n:"t4",f:"?: dyPos xPos x1"},{n:"xb",f:"?: dz t4 x1"},{n:"t5",f:"?: dxPos y1 yPos"},{n:"yl",f:"?: dz y1 t5"},{n:"t6",f:"?: dyPos t yPos"},{n:"yt",f:"?: dz t6 t"},{n:"t7",f:"?: dxPos yPos y1"},{n:"yr",f:"?: dz y1 t7"},{n:"t8",f:"?: dyPos yPos b"},{n:"yb",f:"?: dz t8 b"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"t"}},{type:"lnTo",pt:{x:"x1",y:"t"}},{type:"lnTo",pt:{x:"xt",y:"yt"}},{type:"lnTo",pt:{x:"x2",y:"t"}},{type:"lnTo",pt:{x:"r",y:"t"}},{type:"lnTo",pt:{x:"r",y:"y1"}},{type:"lnTo",pt:{x:"xr",y:"yr"}},{type:"lnTo",pt:{x:"r",y:"y2"}},{type:"lnTo",pt:{x:"r",y:"b"}},{type:"lnTo",pt:{x:"x2",y:"b"}},{type:"lnTo",pt:{x:"xb",y:"yb"}},{type:"lnTo",pt:{x:"x1",y:"b"}},{type:"lnTo",pt:{x:"l",y:"b"}},{type:"lnTo",pt:{x:"l",y:"y2"}},{type:"lnTo",pt:{x:"xl",y:"yl"}},{type:"lnTo",pt:{x:"l",y:"y1"}},{type:"close"}],extrusionOk:!1,stroke:!0}]},wedgeRoundRectCallout:{avLst:[{n:"adj1",f:"val -20833"},{n:"adj2",f:"val 62500"},{n:"adj3",f:"val 16667"}],gdLst:[{n:"dxPos",f:"*/ w adj1 100000"},{n:"dyPos",f:"*/ h adj2 100000"},{n:"xPos",f:"+- hc dxPos 0"},{n:"yPos",f:"+- vc dyPos 0"},{n:"dq",f:"*/ dxPos h w"},{n:"ady",f:"abs dyPos"},{n:"adq",f:"abs dq"},{n:"dz",f:"+- ady 0 adq"},{n:"xg1",f:"?: dxPos 7 2"},{n:"xg2",f:"?: dxPos 10 5"},{n:"x1",f:"*/ w xg1 12"},{n:"x2",f:"*/ w xg2 12"},{n:"yg1",f:"?: dyPos 7 2"},{n:"yg2",f:"?: dyPos 10 5"},{n:"y1",f:"*/ h yg1 12"},{n:"y2",f:"*/ h yg2 12"},{n:"t1",f:"?: dxPos l xPos"},{n:"xl",f:"?: dz l t1"},{n:"t2",f:"?: dyPos x1 xPos"},{n:"xt",f:"?: dz t2 x1"},{n:"t3",f:"?: dxPos xPos r"},{n:"xr",f:"?: dz r t3"},{n:"t4",f:"?: dyPos xPos x1"},{n:"xb",f:"?: dz t4 x1"},{n:"t5",f:"?: dxPos y1 yPos"},{n:"yl",f:"?: dz y1 t5"},{n:"t6",f:"?: dyPos t yPos"},{n:"yt",f:"?: dz t6 t"},{n:"t7",f:"?: dxPos yPos y1"},{n:"yr",f:"?: dz y1 t7"},{n:"t8",f:"?: dyPos yPos b"},{n:"yb",f:"?: dz t8 b"},{n:"u1",f:"*/ ss adj3 100000"},{n:"u2",f:"+- r 0 u1"},{n:"v2",f:"+- b 0 u1"},{n:"il",f:"*/ u1 29289 100000"},{n:"ir",f:"+- r 0 il"},{n:"ib",f:"+- b 0 il"}],pathLst:[{defines:[{type:"moveTo",pt:{x:"l",y:"u1"}},{type:"arcTo",wR:"u1",hR:"u1",stAng:"cd2",swAng:"cd4"},{type:"lnTo",pt:{x:"x1",y:"t"}},{type:"lnTo",pt:{x:"xt",y:"yt"}},{type:"lnTo",pt:{x:"x2",y:"t"}},{type:"lnTo",pt:{x:"u2",y:"t"}},{type:"arcTo",wR:"u1",hR:"u1",stAng:"3cd4",swAng:"cd4"},{type:"lnTo",pt:{x:"r",y:"y1"}},{type:"lnTo",pt:{x:"xr",y:"yr"}},{type:"lnTo",pt:{x:"r",y:"y2"}},{type:"lnTo",pt:{x:"r",y:"v2"}},{type:"arcTo",wR:"u1",hR:"u1",stAng:"0",swAng:"cd4"},{type:"lnTo",pt:{x:"x2",y:"b"}},{type:"lnTo",pt:{x:"xb",y:"yb"}},{type:"lnTo",pt:{x:"x1",y:"b"}},{type:"lnTo",pt:{x:"u1",y:"b"}},{type:"arcTo",wR:"u1",hR:"u1",stAng:"cd4",swAng:"cd4"},{type:"lnTo",pt:{x:"l",y:"y2"}},{type:"lnTo",pt:{x:"xl",y:"yl"}},{type:"lnTo",pt:{x:"l",y:"y1"}},{type:"close"}],extrusionOk:!1,stroke:!0}]}},oe=1/6e4/180*Math.PI,Ve={"*/":function(e,t,n){return e*t/n},"+-":function(e,t,n){return e+t-n},"+/":function(e,t,n){return(e+t)/n},"?:":function(e,t,n){return e>0?t:n},abs:function(e){return Math.abs(e)},at2:function(e,t){return Math.atan2(t,e)*180*6e4/Math.PI},cat2:function(e,t,n){return e*Math.cos(Math.atan2(n,t))},cos:function(e,t){return e*Math.cos(t*oe)},max:function(e,t){return Math.max(e,t)},min:function(e,t){return Math.min(e,t)},mod:function(e,t,n){return Math.sqrt(Math.pow(e,2)+Math.pow(t,2)+Math.pow(n,2))},pin:function(e,t,n){return t<e?e:t>n?n:t},sat2:function(e,t,n){return e*Math.sin(Math.atan2(n,t))},sin:function(e,t){return e*Math.sin(t*oe)},sqrt:function(e){return Math.sqrt(e)},tan:function(e,t){return e*Math.tan(t*oe)},val:function(e){var t=parseInt(e,10);return isNaN(t),t}};function ye(e,t,n){var a=t.split(/[ ]+/);a.length<=1&&console.warn("fmla format error",t);var r=a[0],s=a.slice(1),x=s.map(function(l){if(l in n)return n[l];var y=parseInt(l,10);return isNaN(y)?(console.warn("fmla arg error",l,t),0):y});if(r in Ve){var o=Ve[r].apply(null,x);if(isNaN(o))return console.warn("fmla eval error",t,e),0;n[e]=o}return 0}function ps(e,t){if(e===t)return!0;var n=Math.abs(e-t);return n<Number.EPSILON?!0:n<=Number.EPSILON*Math.min(Math.abs(e),Math.abs(t))}var pe=function(e){return Math.PI*(e/6e4/180)};function fs(e,t,n,a,r,s){var x=pe(n),o=pe(a),l=pe(n+a);ps(a,6e4*360)&&(l=l-1e-4);var y=is(e,t,x,l,0,r,s),p=Math.abs(o)>Math.PI?1:0,f=a>0?1:0,i="A ".concat(e," ").concat(t," 0 ").concat(p," ").concat(f," ").concat(y.x,",").concat(y.y);return{path:i,end:y}}function We(e,t){return[e[0][0]*t[0]+e[0][1]*t[1],e[1][0]*t[0]+e[1][1]*t[1]]}function is(e,t,n,a,r,s,x){var o=n,l=a,y=[s,x],p=[[Math.cos(r),-Math.sin(r)],[Math.sin(r),Math.cos(r)]],f=[e*Math.cos(o),t*Math.sin(o)],i=We(p,f),c=[y[0]-i[0],y[1]-i[1]],d=[e*Math.cos(l),t*Math.sin(l)],h=We(p,d),m=[c[0]+h[0],c[1]+h[1]];return{x:m[0],y:m[1]}}function X(e,t,n){var a=0;if(e in t)a=t[e];else if(a=parseInt(e,10),isNaN(a))return console.warn("var not found",e),0;return n?a*n:a}function cs(e,t,n){var a,r,s=e.defines,x=[],o=e.w,l=e.h,y=1,p=1;o&&(y=t.w/o),l&&(p=t.h/l);try{for(var f=g(s),i=f.next();!i.done;i=f.next()){var c=i.value;switch(c.type){case"moveTo":{var d=c.pt,h=X(d.x,t,y),m=X(d.y,t,p);x.push("M ".concat(h," ").concat(m)),n.push({x:h,y:m});break}case"lnTo":{var d=c.pt,h=X(d.x,t,y),m=X(d.y,t,p);x.push("L ".concat(h," ").concat(m)),n.push({x:h,y:m});break}case"arcTo":{var v=c,A=X(v.wR,t,y),T=X(v.hR,t,p),L=X(v.stAng,t),b=X(v.swAng,t),k={x:0,y:0};n.length>0&&(k=n[n.length-1]);var u=fs(A,T,L,b,k.x,k.y);x.push(u.path),n.push({x:u.end.x,y:u.end.y});break}case"quadBezTo":{var w=c;if(w.pts.length>=2){var S=w.pts[0],B=w.pts[1],E=X(S.x,t,y),C=X(S.y,t,p),H=X(B.x,t,y),O=X(B.y,t,p);if(x.push("Q ".concat(E,",").concat(C," ").concat(H,",").concat(O)),w.pts.length>2){var q=w.pts[2],P=X(q.x,t,y),D=X(q.y,t,p);x.push("T ".concat(P,",").concat(D)),n.push({x:P,y:D})}else n.push({x:H,y:O})}else console.warn("quadBezTo pts length must large than 2",c);break}case"cubicBezTo":{var M=c;if(M.pts.length===3){var S=M.pts[0],B=M.pts[1],q=M.pts[2],E=X(S.x,t,y),C=X(S.y,t,p),H=X(B.x,t,y),O=X(B.y,t,p),P=X(q.x,t,y),D=X(q.y,t,p);x.push("C ".concat(E,",").concat(C," ").concat(H,",").concat(O," ").concat(P,",").concat(D)),n.push({x:P,y:D})}else console.warn("cubicBezTo pts length must be 3",c);break}case"close":x.push("Z");break;default:break}}}catch(Z){a={error:Z}}finally{try{i&&!i.done&&(r=f.return)&&r.call(f)}finally{if(a)throw a.error}}return x.join(" ")}function ds(e,t){var n=Math.min(e,t),a=n/6,r=n/6,s=n/8,x=n/32,o=n/16;return{t:0,"3cd4":162e5,"3cd8":81e5,"5cd8":135e5,"7cd8":189e5,b:t,cd2:108e5,cd4:54e5,cd8:27e5,h:t,hd2:t/2,hd3:t/3,hd4:t/4,hd6:t/6,hd8:t/8,l:0,ls:Math.max(e,t),r:e,ss:n,ssd2:a,ssd6:r,ssd8:s,ssd16:o,ssd32:x,hc:e/2,vc:t/2,w:e,wd2:e/2,wd3:e/3,wd4:e/4,wd6:e/6,wd8:e/8,wd10:e/10,wd16:e/16,wd32:e/32}}function Dn(e,t,n,a,r,s){var x,o,l,y,p,f,i,c,d=ze("svg");d.style.display="block",d.setAttribute("style","display: block; overflow: visible; position: absolute; z-index: -1"),d.setAttribute("width",a.toString()+"px"),d.setAttribute("height",r.toString()+"px");var h=ds(a,r);try{for(var m=g(e.avLst||[]),v=m.next();!v.done;v=m.next()){var A=v.value;ye(A.n,A.f,h)}}catch(M){x={error:M}}finally{try{v&&!v.done&&(o=m.return)&&o.call(m)}finally{if(x)throw x.error}}try{for(var T=g(t),L=T.next();!L.done;L=T.next()){var A=L.value;ye(A.n,A.f,h)}}catch(M){l={error:M}}finally{try{L&&!L.done&&(y=T.return)&&y.call(T)}finally{if(l)throw l.error}}try{for(var b=g(e.gdLst||[]),k=b.next();!k.done;k=b.next()){var A=k.value;ye(A.n,A.f,h)}}catch(M){p={error:M}}finally{try{k&&!k.done&&(f=b.return)&&f.call(b)}finally{if(p)throw p.error}}var u=n.outline,w=[];try{for(var S=g(e.pathLst||[]),B=S.next();!B.done;B=S.next()){var E=B.value,C=ze("path"),H=cs(E,h,w);C.setAttribute("d",H),n.fillColor?C.setAttribute("fill",n.fillColor):s&&s.fillColor?C.setAttribute("fill",s.fillColor):C.setAttribute("fill","none"),u?(u.color&&C.setAttribute("stroke",u.color),u.width&&C.setAttribute("stroke-width",u.width),u.style==="none"&&C.setAttribute("stroke","none")):s&&s.lineColor?C.setAttribute("stroke",s.lineColor):C.setAttribute("stroke","none");var O=C.getAttribute("fill");if(O&&O!=="none"){var q=new bt(O),P=E.fill,D="";switch(P){case"darken":D=q.lumOff(-.5).toHex();break;case"darkenLess":D=q.lumOff(-.2).toHex();break;case"lighten":D=q.lumOff(.5).toHex();break;case"lightenLess":D=q.lumOff(.2).toHex();break}D&&C.setAttribute("fill",D)}E.fill==="none"&&C.setAttribute("fill","none"),E.stroke===!1&&(C.setAttribute("stroke","none"),E.fill||C.setAttribute("fill","none")),n.noFill&&C.setAttribute("fill","none"),d.appendChild(C)}}catch(M){i={error:M}}finally{try{B&&!B.done&&(c=S.return)&&c.call(S)}finally{if(i)throw i.error}}return d}function hs(e,t,n,a,r){if(e.prst){var s=ys[e.prst];if(s)return Dn(s,e.avLst||[],t,n,a,r)}return null}function ms(e,t,n,a,r){return e.shape?Dn(e.shape,[],t,n,a,r):null}function gs(e,t,n){var a,r,s=(a=e.blipFill)===null||a===void 0?void 0:a.blip;if(s&&s.src){var x=document.createElement("img");if(x.style.position="relative",x.alt=e.alt||"",x.src=s.src,e.alt&&t.renderOptions.enableVar){if(e.altVar)x.src=e.altVar;else if(e.alt.startsWith("{{")){var o=t.replaceText(e.alt);o&&(x.src=o)}}var l=(r=e.spPr)===null||r===void 0?void 0:r.xfrm;if(l){var y=l.off;y&&(x.style.left=y.x,x.style.top=y.y);var p=l.ext;p&&(x.style.width=p.cx,x.style.height=p.cy),l.rot&&(x.style.transform="rotate(".concat(l.rot,"deg)"))}return x}return null}function ws(e,t,n){var a,r,s=document.createElement("div");if(t.position==="inline"?s.style.display="inline-block":t.position,t.pic&&j(s,gs(t.pic,e)),t.relativeFromV==="page"&&console.warn('暂不支持 drawing.relativeFromV === "page"'),Dt(s,t.containerStyle),s.dataset.id=t.id||"",s.dataset.name=t.name||"",t.wps){var x=t.wps,o=x.wpsStyle,l=x.spPr;if(Dt(s,x.style),o!=null&&o.fontColor&&(s.style.color=o.fontColor),l!=null&&l.xfrm){var y=l.xfrm.ext;if(y){if(s.style.width=y.cx,s.style.height=y.cy,l.geom){var p=parseFloat(y.cx.replace("px","")),f=parseFloat(y.cy.replace("px",""));j(s,hs(l.geom,l,p,f,x.wpsStyle))}if(l.custGeom){var p=parseFloat(y.cx.replace("px","")),f=parseFloat(y.cy.replace("px",""));j(s,ms(l.custGeom,l,p,f,x.wpsStyle))}}l.xfrm.rot&&(s.style.transform="rotate(".concat(l.xfrm.rot,"deg)"))}var i=x.txbxContent;if(i.length){var c=document.createElement("div");c.dataset.name="textContainer",s.style.display="table",c.style.display="table-cell",c.style.verticalAlign="middle",x.style&&x.style["vertical-align"]&&(c.style.verticalAlign=x.style["vertical-align"],s.style.verticalAlign=""),j(s,c);try{for(var d=g(i),h=d.next();!h.done;h=d.next()){var m=h.value;m instanceof nt?j(c,Lt(e,m)):m instanceof wt&&j(c,Rt(e,m))}}catch(v){a={error:v}}finally{try{h&&!h.done&&(r=d.return)&&r.call(d)}finally{if(a)throw a.error}}}}return s.children.length===0?null:s}function vs(e,t){var n=I("span");return n.innerHTML="&emsp;",t.leader==="dot"&&(n.style.borderBottom="1pt dotted"),n}function us(e,t){if(t.src){var n=document.createElement("img");return n.style.position="relative",n.src=t.src,n}return null}function Ts(e,t){var n,a,r,s,x=I("ruby");if(t.rubyBase){try{for(var o=g(t.rubyBase.children),l=o.next();!l.done;l=o.next()){var y=l.value;x.appendChild(Ft(e,y))}}catch(h){n={error:h}}finally{try{l&&!l.done&&(a=o.return)&&a.call(o)}finally{if(n)throw n.error}}if(t.rt){var p=I("rp");p.innerText="(",x.appendChild(p);var f=I("rt");try{for(var i=g(t.rt.children),c=i.next();!c.done;c=i.next()){var y=c.value;f.appendChild(Ft(e,y))}}catch(h){r={error:h}}finally{try{c&&!c.done&&(s=i.return)&&s.call(i)}finally{if(r)throw r.error}}x.appendChild(f);var d=I("rp");d.innerText=")",x.appendChild(d)}}return x}function Fn(e,t,n){var a,r,s=I("a");if(t.relation){var x=t.relation;x&&x.targetMode==="External"&&(s.href=x.target,s.target="_blank")}t.anchor&&(s.href="#"+t.anchor),t.tooltip&&(s.title=t.tooltip);try{for(var o=g(t.children),l=o.next();!l.done;l=o.next()){var y=l.value;if(y instanceof pt){var p=Ft(e,y,n);j(s,p)}}}catch(f){a={error:f}}finally{try{l&&!l.done&&(r=o.return)&&r.call(o)}finally{if(a)throw a.error}}return s}function Sn(e,t){var n=t.name;if(n){var a=I("a");return a.name=n,a.id=n,a}return null}function As(e,t,n){var a,r;try{for(var s=g(t.children),x=s.next();!x.done;x=s.next()){var o=x.value;if(o instanceof pt)j(n,Ft(e,o));else if(o instanceof Kt)j(n,Sn(e,o));else if(o instanceof Qt){var l=Fn(e,o);j(n,l)}}}catch(y){a={error:y}}finally{try{x&&!x.done&&(r=s.return)&&r.call(s)}finally{if(a)throw a.error}}}function bs(e,t){var n,a,r,s=t.text,x=I("span"),o=(r=e.currentParagraph)===null||r===void 0?void 0:r.fldSimples;if(o)try{for(var l=g(o),y=l.next();!y.done;y=l.next()){var p=y.value;if(p.instr===s.trim()||s.startsWith(p.instr+" ")){As(e,p.inlineText,x);break}}}catch(f){n={error:f}}finally{try{y&&!y.done&&(a=l.return)&&a.call(l)}finally{if(n)throw n.error}}return x}function ks(e,t){var n=I("span");return n.style.fontFamily=t.font,n.innerHTML="&#x".concat(t.char,";"),n}var Xe=/\p{Punctuation}/u,Ue=/\p{Separator}/u,fe=/\p{Script=Han}|\p{Script=Katakana}|\p{Script=Hiragana}|\p{Script=Hangul}/u,Rs=function(e,t){return fe.test(e)?!(Xe.test(t)||Ue.test(t)||fe.test(t)):fe.test(t)&&!Xe.test(e)&&!Ue.test(e)},Ls=function(e,t){return e.reduce(function(n,a,r){var s=r!==0?t(a,e[r-1]):"";return n+s+a},"")},Cs=function(e){var t=e.filter(function(n){return n!==void 0&&n!==""});return Ls(t,function(n,a){return Rs(n,a)?" ":""})};function js(){var e=I("span");return e.innerHTML="&shy;",e}function Bs(){var e=I("span");return e.innerHTML="&ndash;",e}function Os(){var e=I("hr");return e.style.borderTop="1pt solid #bbb",e}var qn="variable";function Ze(e,t,n,a){var r;n.indexOf("{{")===-1?!((r=a==null?void 0:a.properties)===null||r===void 0)&&r.autoSpace?e.textContent=Cs(n.split("")):e.textContent=n:(e.dataset.originText=n,e.classList.add(qn),e.textContent=t.replaceText(n))}function Ds(e){for(var t=e.rootElement.querySelectorAll(".".concat(qn)),n=0;n<t.length;n++){var a=t[n],r=a.dataset.originText||"";a.textContent=e.replaceText(r)}}function Ft(e,t,n,a,r){var s,x,o,l,y=I("span");if(e.addClass(y,"r"),kt(e,y,t.properties),!((o=t.properties)===null||o===void 0)&&o.rStyle){var p=e.getStyle(t.properties.rStyle);!((l=p==null?void 0:p.rPr)===null||l===void 0)&&l.cssStyle&&Dt(y,p.rPr.cssStyle)}if(t.children.length===1&&t.children[0]instanceof ke){var f=t.children[0];Ze(y,e,f.text,n)}else try{for(var i=g(t.children),c=i.next();!c.done;c=i.next()){var d=c.value;if(d instanceof ke){var h=I("span");Ze(h,e,d.text,n),j(y,h)}else if(d instanceof ue){var m=es(e,d);j(y,m)}else d instanceof Ae?j(y,ws(e,d,r)):d instanceof qe?j(y,vs(e,d)):d instanceof kn?j(y,us(e,d)):d instanceof Rn?j(y,Ts(e,d)):d instanceof An?j(y,bs(e,d)):d instanceof jn?j(y,ks(e,d)):d instanceof Cn?j(y,js()):d instanceof bn?j(y,Bs()):d instanceof Ln?j(y,Os()):console.warn("unknown child",d)}}catch(v){s={error:v}}finally{try{c&&!c.done&&(x=i.return)&&x.call(i)}finally{if(s)throw s.error}}return y}function Je(e){var t={M:1e3,CM:900,D:500,CD:400,C:100,XC:90,L:50,XL:40,X:10,IX:9,V:5,IV:4,I:1},n="";for(var a in t)for(;e>=t[a];)n+=a,e-=t[a];return n}function Fs(e,t){switch(e){case"decimal":return t.toString();case"lowerLetter":return String.fromCharCode(96+t);case"upperLetter":return String.fromCharCode(64+t);case"lowerRoman":return Je(t).toLowerCase();case"upperRoman":return Je(t).toUpperCase();case"bullet":return"&bull;";default:return t.toString()}}function Ss(e,t,n){var a=t.numbering,r=n.numId;if(!r)return console.warn("renderNumbering: numId is empty"),null;if(!a)return console.warn("renderNumbering: numbering is empty"),null;var s=a.nums[r];if(!s)return console.warn("renderNumbering: num is empty"),null;var x=a.abstractNums[s.abstractNumId],o=x.lvls;s.lvlOverride&&(o=it(it({},o),s.lvlOverride.lvls));var l=o[n.ilvl];if(!l)return console.warn("renderNumbering: lvl is empty"),null;var y=n.ilvl,p=a.numData[r];if(!p[y])p[y]=l.start;else{p[y]+=1;for(var f in p)parseInt(f)>parseInt(y)&&(p[f]=0)}for(var i=I("span"),c=l.lvlText,d=parseInt(y),h=[],m=0;m<=d;m++){var v=p[m];if(v){var A=o[m].numFmt,T=Fs(A,v);l.isLgl&&(T=String(v)),h.push(T)}}for(var m=0;m<h.length;m++){var L=h[m];c=c.replace("%".concat(m+1),L)}if(kt(t,e,l.pPr),kt(t,i,l.rPr),l.numFmt!=="bullet"||t.renderOptions.bulletUseFont)i.innerText=c;else{var b="&bull;",k=c.charCodeAt(0).toString(16).padStart(4,"0");k==="f06e"?b="&#9632;":k==="f075"?b="&#9670;":k==="f0d8"&&(b="&#9658;"),i.innerHTML=b}return l.suff==="space"?i.innerHTML+=" ":l.suff==="tab"&&(i.innerHTML+="&emsp;"),i}function qs(e){return new DOMParser().parseFromString(e,"application/xml")}function $s(e){var t=new XMLSerializer;return t.serializeToString(e)}var Ps=qs(`
<?xml version="1.0" encoding="UTF-8" ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:mml="http://www.w3.org/1998/Math/MathML"
	xmlns:m="http://schemas.openxmlformats.org/officeDocument/2006/math">
  <xsl:output method="xml" encoding="UTF-16" />

  <!-- %% Global Definitions -->

  <!-- Every single unicode character that is recognized by OMML as an operator -->
  <xsl:variable name="sOperators"
		select="concat(
          '&#x00A8;&#x0021;&#x0022;&#x0023;&#x0026;&#x0028;&#x0029;&#x002B;&#x002C;&#x002D;&#x002E;&#x002F;&#x003A;',
          '&#x003B;&#x003C;&#x003D;&#x003E;&#x003F;&#x0040;&#x005B;&#x005C;&#x005D;&#x005E;&#x005F;&#x0060;&#x007B;',
          '&#x007C;&#x007D;&#x007E;&#x00A1;&#x00A6;&#x00AC;&#x00AF;&#x00B0;&#x00B1;&#x00B2;&#x00B3;&#x00B4;&#x00B7;&#x00B9;&#x00BF;',
          '&#x00D7;&#x007E;&#x00F7;&#x02C7;&#x02D8;&#x02D9;&#x02DC;&#x02DD;&#x0300;&#x0301;&#x0302;&#x0303;&#x0304;&#x0305;&#x0306;&#x0307;&#x0308;&#x0309;',
          '&#x030A;&#x030B;&#x030C;&#x030D;&#x030E;&#x030F;&#x0310;&#x0311;&#x0312;&#x0313;&#x0314;&#x0315;',
          '&#x0316;&#x0317;&#x0318;&#x0319;&#x031A;&#x031B;&#x031C;&#x031D;&#x031E;&#x031F;&#x0320;&#x0321;',
          '&#x0322;&#x0323;&#x0324;&#x0325;&#x0326;&#x0327;&#x0328;&#x0329;&#x032A;&#x032B;&#x032C;&#x032D;',
          '&#x032E;&#x032F;&#x0330;&#x0331;&#x0332;&#x0333;&#x0334;&#x0335;&#x0336;&#x0337;&#x0338;&#x033F;',
          '&#x2000;&#x2001;&#x2002;&#x2003;&#x2004;&#x2005;&#x2006;&#x2009;&#x200A;&#x2010;&#x2012;&#x2013;',
          '&#x2014;&#x2016;&#x2020;&#x2021;&#x2022;&#x2024;&#x2025;&#x2026;&#x2032;&#x2033;&#x2034;&#x203C;',
          '&#x2040;&#x2044;&#x204E;&#x204F;&#x2050;&#x2057;&#x2061;&#x2062;&#x2063;&#x2070;&#x2074;&#x2075;',
          '&#x2076;&#x2077;&#x2078;&#x2079;&#x207A;&#x207B;&#x207C;&#x207D;&#x207E;&#x2080;&#x2081;&#x2082;',
          '&#x2083;&#x2084;&#x2085;&#x2086;&#x2087;&#x2088;&#x2089;&#x208A;&#x208B;&#x208C;&#x208D;&#x208E;',
          '&#x20D0;&#x20D1;&#x20D2;&#x20D3;&#x20D4;&#x20D5;&#x20D6;&#x20D7;&#x20D8;&#x20D9;&#x20DA;&#x20DB;',
          '&#x20DC;&#x20DD;&#x20DE;&#x20DF;&#x20E0;&#x20E1;&#x20E4;&#x20E5;&#x20E6;&#x20E7;&#x20E8;&#x20E9;',
          '&#x20EA;&#x2140;&#x2146;&#x2190;&#x2191;&#x2192;&#x2193;&#x2194;&#x2195;&#x2196;&#x2197;&#x2198;&#x2199;',
          '&#x219A;&#x219B;&#x219C;&#x219D;&#x219E;&#x219F;&#x21A0;&#x21A1;&#x21A2;&#x21A3;&#x21A4;&#x21A5;',
          '&#x21A6;&#x21A7;&#x21A8;&#x21A9;&#x21AA;&#x21AB;&#x21AC;&#x21AD;&#x21AE;&#x21AF;&#x21B0;&#x21B1;',
          '&#x21B2;&#x21B3;&#x21B6;&#x21B7;&#x21BA;&#x21BB;&#x21BC;&#x21BD;&#x21BE;&#x21BF;&#x21C0;&#x21C1;',
          '&#x21C2;&#x21C3;&#x21C4;&#x21C5;&#x21C6;&#x21C7;&#x21C8;&#x21C9;&#x21CA;&#x21CB;&#x21CC;&#x21CD;',
          '&#x21CE;&#x21CF;&#x21D0;&#x21D1;&#x21D2;&#x21D3;&#x21D4;&#x21D5;&#x21D6;&#x21D7;&#x21D8;&#x21D9;',
          '&#x21DA;&#x21DB;&#x21DC;&#x21DD;&#x21DE;&#x21DF;&#x21E0;&#x21E1;&#x21E2;&#x21E3;&#x21E4;&#x21E5;',
          '&#x21E6;&#x21E7;&#x21E8;&#x21E9;&#x21F3;&#x21F4;&#x21F5;&#x21F6;&#x21F7;&#x21F8;&#x21F9;&#x21FA;',
          '&#x21FB;&#x21FC;&#x21FD;&#x21FE;&#x21FF;&#x2200;&#x2201;&#x2202;&#x2203;&#x2204;&#x2206;&#x2207;',
          '&#x2208;&#x2209;&#x220A;&#x220B;&#x220C;&#x220D;&#x220F;&#x2210;&#x2211;&#x2212;&#x2213;&#x2214;',
          '&#x2215;&#x2216;&#x2217;&#x2218;&#x2219;&#x221A;&#x221B;&#x221C;&#x221D;&#x2223;&#x2224;&#x2225;',
          '&#x2226;&#x2227;&#x2228;&#x2229;&#x222A;&#x222B;&#x222C;&#x222D;&#x222E;&#x222F;&#x2230;&#x2231;',
          '&#x2232;&#x2233;&#x2234;&#x2235;&#x2236;&#x2237;&#x2238;&#x2239;&#x223A;&#x223B;&#x223C;&#x223D;',
          '&#x223E;&#x2240;&#x2241;&#x2242;&#x2243;&#x2244;&#x2245;&#x2246;&#x2247;&#x2248;&#x2249;&#x224A;',
          '&#x224B;&#x224C;&#x224D;&#x224E;&#x224F;&#x2250;&#x2251;&#x2252;&#x2253;&#x2254;&#x2255;&#x2256;',
          '&#x2257;&#x2258;&#x2259;&#x225A;&#x225B;&#x225C;&#x225D;&#x225E;&#x225F;&#x2260;&#x2261;&#x2262;',
          '&#x2263;&#x2264;&#x2265;&#x2266;&#x2267;&#x2268;&#x2269;&#x226A;&#x226B;&#x226C;&#x226D;&#x226E;',
          '&#x226F;&#x2270;&#x2271;&#x2272;&#x2273;&#x2274;&#x2275;&#x2276;&#x2277;&#x2278;&#x2279;&#x227A;',
          '&#x227B;&#x227C;&#x227D;&#x227E;&#x227F;&#x2280;&#x2281;&#x2282;&#x2283;&#x2284;&#x2285;&#x2286;',
          '&#x2287;&#x2288;&#x2289;&#x228A;&#x228B;&#x228C;&#x228D;&#x228E;&#x228F;&#x2290;&#x2291;&#x2292;',
          '&#x2293;&#x2294;&#x2295;&#x2296;&#x2297;&#x2298;&#x2299;&#x229A;&#x229B;&#x229C;&#x229D;&#x229E;',
          '&#x229F;&#x22A0;&#x22A1;&#x22A2;&#x22A3;&#x22A5;&#x22A6;&#x22A7;&#x22A8;&#x22A9;&#x22AA;&#x22AB;',
          '&#x22AC;&#x22AD;&#x22AE;&#x22AF;&#x22B0;&#x22B1;&#x22B2;&#x22B3;&#x22B4;&#x22B5;&#x22B6;&#x22B7;',
          '&#x22B8;&#x22B9;&#x22BA;&#x22BB;&#x22BC;&#x22BD;&#x22C0;&#x22C1;&#x22C2;&#x22C3;&#x22C4;&#x22C5;',
          '&#x22C6;&#x22C7;&#x22C8;&#x22C9;&#x22CA;&#x22CB;&#x22CC;&#x22CD;&#x22CE;&#x22CF;&#x22D0;&#x22D1;',
          '&#x22D2;&#x22D3;&#x22D4;&#x22D5;&#x22D6;&#x22D7;&#x22D8;&#x22D9;&#x22DA;&#x22DB;&#x22DC;&#x22DD;',
          '&#x22DE;&#x22DF;&#x22E0;&#x22E1;&#x22E2;&#x22E3;&#x22E4;&#x22E5;&#x22E6;&#x22E7;&#x22E8;&#x22E9;',
          '&#x22EA;&#x22EB;&#x22EC;&#x22ED;&#x22EE;&#x22EF;&#x22F0;&#x22F1;&#x22F2;&#x22F3;&#x22F4;&#x22F5;',
          '&#x22F6;&#x22F7;&#x22F8;&#x22F9;&#x22FA;&#x22FB;&#x22FC;&#x22FD;&#x22FE;&#x22FF;&#x2305;&#x2306;',
          '&#x2308;&#x2309;&#x230A;&#x230B;&#x231C;&#x231D;&#x231E;&#x231F;&#x2322;&#x2323;&#x2329;&#x232A;',
          '&#x233D;&#x233F;&#x23B0;&#x23B1;&#x23DC;&#x23DD;&#x23DE;&#x23DF;&#x23E0;&#x2502;&#x251C;&#x2524;',
          '&#x252C;&#x2534;&#x2581;&#x2588;&#x2592;&#x25A0;&#x25A1;&#x25AD;&#x25B2;&#x25B3;&#x25B4;&#x25B5;',
          '&#x25B6;&#x25B7;&#x25B8;&#x25B9;&#x25BC;&#x25BD;&#x25BE;&#x25BF;&#x25C0;&#x25C1;&#x25C2;&#x25C3;',
          '&#x25C4;&#x25C5;&#x25CA;&#x25CB;&#x25E6;&#x25EB;&#x25EC;&#x25F8;&#x25F9;&#x25FA;&#x25FB;&#x25FC;',
          '&#x25FD;&#x25FE;&#x25FF;&#x2605;&#x2606;&#x2772;&#x2773;&#x27D1;&#x27D2;&#x27D3;&#x27D4;&#x27D5;',
          '&#x27D6;&#x27D7;&#x27D8;&#x27D9;&#x27DA;&#x27DB;&#x27DC;&#x27DD;&#x27DE;&#x27DF;&#x27E0;&#x27E1;',
          '&#x27E2;&#x27E3;&#x27E4;&#x27E5;&#x27E6;&#x27E7;&#x27E8;&#x27E9;&#x27EA;&#x27EB;&#x27F0;&#x27F1;',
          '&#x27F2;&#x27F3;&#x27F4;&#x27F5;&#x27F6;&#x27F7;&#x27F8;&#x27F9;&#x27FA;&#x27FB;&#x27FC;&#x27FD;',
          '&#x27FE;&#x27FF;&#x2900;&#x2901;&#x2902;&#x2903;&#x2904;&#x2905;&#x2906;&#x2907;&#x2908;&#x2909;',
          '&#x290A;&#x290B;&#x290C;&#x290D;&#x290E;&#x290F;&#x2910;&#x2911;&#x2912;&#x2913;&#x2914;&#x2915;',
          '&#x2916;&#x2917;&#x2918;&#x2919;&#x291A;&#x291B;&#x291C;&#x291D;&#x291E;&#x291F;&#x2920;&#x2921;',
          '&#x2922;&#x2923;&#x2924;&#x2925;&#x2926;&#x2927;&#x2928;&#x2929;&#x292A;&#x292B;&#x292C;&#x292D;',
          '&#x292E;&#x292F;&#x2930;&#x2931;&#x2932;&#x2933;&#x2934;&#x2935;&#x2936;&#x2937;&#x2938;&#x2939;',
          '&#x293A;&#x293B;&#x293C;&#x293D;&#x293E;&#x293F;&#x2940;&#x2941;&#x2942;&#x2943;&#x2944;&#x2945;',
          '&#x2946;&#x2947;&#x2948;&#x2949;&#x294A;&#x294B;&#x294C;&#x294D;&#x294E;&#x294F;&#x2950;&#x2951;',
          '&#x2952;&#x2953;&#x2954;&#x2955;&#x2956;&#x2957;&#x2958;&#x2959;&#x295A;&#x295B;&#x295C;&#x295D;',
          '&#x295E;&#x295F;&#x2960;&#x2961;&#x2962;&#x2963;&#x2964;&#x2965;&#x2966;&#x2967;&#x2968;&#x2969;',
          '&#x296A;&#x296B;&#x296C;&#x296D;&#x296E;&#x296F;&#x2970;&#x2971;&#x2972;&#x2973;&#x2974;&#x2975;',
          '&#x2976;&#x2977;&#x2978;&#x2979;&#x297A;&#x297B;&#x297C;&#x297D;&#x297E;&#x297F;&#x2980;&#x2982;',
          '&#x2983;&#x2984;&#x2985;&#x2986;&#x2987;&#x2988;&#x2989;&#x298A;&#x298B;&#x298C;&#x298D;&#x298E;',
          '&#x298F;&#x2990;&#x2991;&#x2992;&#x2993;&#x2994;&#x2995;&#x2996;&#x2997;&#x2998;&#x2999;&#x299A;',
          '&#x29B6;&#x29B7;&#x29B8;&#x29B9;&#x29C0;&#x29C1;&#x29C4;&#x29C5;&#x29C6;&#x29C7;&#x29C8;&#x29CE;',
          '&#x29CF;&#x29D0;&#x29D1;&#x29D2;&#x29D3;&#x29D4;&#x29D5;&#x29D6;&#x29D7;&#x29D8;&#x29D9;&#x29DA;',
          '&#x29DB;&#x29DF;&#x29E1;&#x29E2;&#x29E3;&#x29E4;&#x29E5;&#x29E6;&#x29EB;&#x29F4;&#x29F5;&#x29F6;',
          '&#x29F7;&#x29F8;&#x29F9;&#x29FA;&#x29FB;&#x29FC;&#x29FD;&#x29FE;&#x29FF;&#x2A00;&#x2A01;&#x2A02;',
          '&#x2A03;&#x2A04;&#x2A05;&#x2A06;&#x2A07;&#x2A08;&#x2A09;&#x2A0A;&#x2A0B;&#x2A0C;&#x2A0D;&#x2A0E;',
          '&#x2A0F;&#x2A10;&#x2A11;&#x2A12;&#x2A13;&#x2A14;&#x2A15;&#x2A16;&#x2A17;&#x2A18;&#x2A19;&#x2A1A;',
          '&#x2A1B;&#x2A1C;&#x2A1D;&#x2A1E;&#x2A1F;&#x2A20;&#x2A21;&#x2A22;&#x2A23;&#x2A24;&#x2A25;&#x2A26;',
          '&#x2A27;&#x2A28;&#x2A29;&#x2A2A;&#x2A2B;&#x2A2C;&#x2A2D;&#x2A2E;&#x2A2F;&#x2A30;&#x2A31;&#x2A32;',
          '&#x2A33;&#x2A34;&#x2A35;&#x2A36;&#x2A37;&#x2A38;&#x2A39;&#x2A3A;&#x2A3B;&#x2A3C;&#x2A3D;&#x2A3E;',
          '&#x2A3F;&#x2A40;&#x2A41;&#x2A42;&#x2A43;&#x2A44;&#x2A45;&#x2A46;&#x2A47;&#x2A48;&#x2A49;&#x2A4A;',
          '&#x2A4B;&#x2A4C;&#x2A4D;&#x2A4E;&#x2A4F;&#x2A50;&#x2A51;&#x2A52;&#x2A53;&#x2A54;&#x2A55;&#x2A56;',
          '&#x2A57;&#x2A58;&#x2A59;&#x2A5A;&#x2A5B;&#x2A5C;&#x2A5D;&#x2A5E;&#x2A5F;&#x2A60;&#x2A61;&#x2A62;',
          '&#x2A63;&#x2A64;&#x2A65;&#x2A66;&#x2A67;&#x2A68;&#x2A69;&#x2A6A;&#x2A6B;&#x2A6C;&#x2A6D;&#x2A6E;',
          '&#x2A6F;&#x2A70;&#x2A71;&#x2A72;&#x2A73;&#x2A74;&#x2A75;&#x2A76;&#x2A77;&#x2A78;&#x2A79;&#x2A7A;',
          '&#x2A7B;&#x2A7C;&#x2A7D;&#x2A7E;&#x2A7F;&#x2A80;&#x2A81;&#x2A82;&#x2A83;&#x2A84;&#x2A85;&#x2A86;',
          '&#x2A87;&#x2A88;&#x2A89;&#x2A8A;&#x2A8B;&#x2A8C;&#x2A8D;&#x2A8E;&#x2A8F;&#x2A90;&#x2A91;&#x2A92;',
          '&#x2A93;&#x2A94;&#x2A95;&#x2A96;&#x2A97;&#x2A98;&#x2A99;&#x2A9A;&#x2A9B;&#x2A9C;&#x2A9D;&#x2A9E;',
          '&#x2A9F;&#x2AA0;&#x2AA1;&#x2AA2;&#x2AA3;&#x2AA4;&#x2AA5;&#x2AA6;&#x2AA7;&#x2AA8;&#x2AA9;&#x2AAA;',
          '&#x2AAB;&#x2AAC;&#x2AAD;&#x2AAE;&#x2AAF;&#x2AB0;&#x2AB1;&#x2AB2;&#x2AB3;&#x2AB4;&#x2AB5;&#x2AB6;',
          '&#x2AB7;&#x2AB8;&#x2AB9;&#x2ABA;&#x2ABB;&#x2ABC;&#x2ABD;&#x2ABE;&#x2ABF;&#x2AC0;&#x2AC1;&#x2AC2;',
          '&#x2AC3;&#x2AC4;&#x2AC5;&#x2AC6;&#x2AC7;&#x2AC8;&#x2AC9;&#x2ACA;&#x2ACB;&#x2ACC;&#x2ACD;&#x2ACE;',
          '&#x2ACF;&#x2AD0;&#x2AD1;&#x2AD2;&#x2AD3;&#x2AD4;&#x2AD5;&#x2AD6;&#x2AD7;&#x2AD8;&#x2AD9;&#x2ADA;',
          '&#x2ADB;&#x2ADC;&#x2ADD;&#x2ADE;&#x2ADF;&#x2AE0;&#x2AE2;&#x2AE3;&#x2AE4;&#x2AE5;&#x2AE6;&#x2AE7;',
          '&#x2AE8;&#x2AE9;&#x2AEA;&#x2AEB;&#x2AEC;&#x2AED;&#x2AEE;&#x2AEF;&#x2AF0;&#x2AF2;&#x2AF3;&#x2AF4;',
          '&#x2AF5;&#x2AF6;&#x2AF7;&#x2AF8;&#x2AF9;&#x2AFA;&#x2AFB;&#x2AFC;&#x2AFD;&#x2AFE;&#x2AFF;&#x2B04;',
          '&#x2B06;&#x2B07;&#x2B0C;&#x2B0D;&#x3014;&#x3015;&#x3016;&#x3017;&#x3018;&#x3019;&#xFF01;&#xFF06;',
          '&#xFF08;&#xFF09;&#xFF0B;&#xFF0C;&#xFF0D;&#xFF0E;&#xFF0F;&#xFF1A;&#xFF1B;&#xFF1C;&#xFF1D;&#xFF1E;',
          '&#xFF1F;&#xFF20;&#xFF3B;&#xFF3C;&#xFF3D;&#xFF3E;&#xFF3F;&#xFF5B;&#xFF5C;&#xFF5D;')" />

  <!-- A string of '-'s repeated exactly as many times as the operators above -->
  <xsl:variable name="sMinuses">
    <xsl:call-template name="SRepeatChar">
      <xsl:with-param name="cchRequired" select="string-length($sOperators)" />
      <xsl:with-param name="ch" select="'-'" />
    </xsl:call-template>
  </xsl:variable>

  <!-- Every single unicode character that is recognized by OMML as a number -->
  <xsl:variable name="sNumbers" select="'0123456789'" />

  <!-- A string of '0's repeated exactly as many times as the list of numbers above -->
  <xsl:variable name="sZeros">
    <xsl:call-template name="SRepeatChar">
      <xsl:with-param name="cchRequired" select="string-length($sNumbers)" />
      <xsl:with-param name="ch" select="'0'" />
    </xsl:call-template>
  </xsl:variable>

  <!-- %%Template: SReplace

		Replace all occurences of sOrig in sInput with sReplacement
		and return the resulting string. -->
  <xsl:template name="SReplace">
    <xsl:param name="sInput" />
    <xsl:param name="sOrig" />
    <xsl:param name="sReplacement" />

    <xsl:choose>
      <xsl:when test="not(contains($sInput, $sOrig))">
        <xsl:value-of select="$sInput" />
      </xsl:when>
      <xsl:otherwise>
        <xsl:variable name="sBefore" select="substring-before($sInput, $sOrig)" />
        <xsl:variable name="sAfter" select="substring-after($sInput, $sOrig)" />
        <xsl:variable name="sAfterProcessed">
          <xsl:call-template name="SReplace">
            <xsl:with-param name="sInput" select="$sAfter" />
            <xsl:with-param name="sOrig" select="$sOrig" />
            <xsl:with-param name="sReplacement" select="$sReplacement" />
          </xsl:call-template>
        </xsl:variable>

        <xsl:value-of select="concat($sBefore, concat($sReplacement, $sAfterProcessed))" />
      </xsl:otherwise>
    </xsl:choose>
  </xsl:template>

  <!-- Templates -->
  <xsl:template match="/">
    <mml:math>
      <xsl:apply-templates select="*" />
    </mml:math>
  </xsl:template>

  <xsl:template match="m:borderBox">

    <!-- Get Lowercase versions of properties -->
    <xsl:variable name="sLowerCaseHideTop" select="translate(m:borderBoxPr[last()]/m:hideTop[last()]/@m:val, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
		                                                             'abcdefghijklmnopqrstuvwxyz')" />
    <xsl:variable name="sLowerCaseHideBot" select="translate(m:borderBoxPr[last()]/m:hideBot[last()]/@m:val, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
		                                                             'abcdefghijklmnopqrstuvwxyz')" />
    <xsl:variable name="sLowerCaseHideLeft" select="translate(m:borderBoxPr[last()]/m:hideLeft[last()]/@m:val, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
		                                                             'abcdefghijklmnopqrstuvwxyz')" />
    <xsl:variable name="sLowerCaseHideRight" select="translate(m:borderBoxPr[last()]/m:hideRight[last()]/@m:val, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
		                                                             'abcdefghijklmnopqrstuvwxyz')" />
    <xsl:variable name="sLowerCaseStrikeH" select="translate(m:borderBoxPr[last()]/m:strikeH[last()]/@m:val, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
		                                                             'abcdefghijklmnopqrstuvwxyz')" />
    <xsl:variable name="sLowerCaseStrikeV" select="translate(m:borderBoxPr[last()]/m:strikeV[last()]/@m:val, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
		                                                             'abcdefghijklmnopqrstuvwxyz')" />
    <xsl:variable name="sLowerCaseStrikeBLTR" select="translate(m:borderBoxPr[last()]/m:strikeBLTR[last()]/@m:val, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
		                                                             'abcdefghijklmnopqrstuvwxyz')" />
    <xsl:variable name="sLowerCaseStrikeTLBR" select="translate(m:borderBoxPr[last()]/m:strikeTLBR[last()]/@m:val, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
		                                                             'abcdefghijklmnopqrstuvwxyz')" />
    <xsl:variable name="fHideTop">
      <xsl:call-template name="ForceTrueStrVal">
        <xsl:with-param name="str" select="$sLowerCaseHideTop" />
      </xsl:call-template>
    </xsl:variable>
    <xsl:variable name="fHideBot">
      <xsl:call-template name="ForceTrueStrVal">
        <xsl:with-param name="str" select="$sLowerCaseHideBot" />
      </xsl:call-template>
    </xsl:variable>
    <xsl:variable name="fHideLeft">
      <xsl:call-template name="ForceTrueStrVal">
        <xsl:with-param name="str" select="$sLowerCaseHideLeft" />
      </xsl:call-template>
    </xsl:variable>
    <xsl:variable name="fHideRight">
      <xsl:call-template name="ForceTrueStrVal">
        <xsl:with-param name="str" select="$sLowerCaseHideRight" />
      </xsl:call-template>
    </xsl:variable>
    <xsl:variable name="fStrikeH">
      <xsl:call-template name="ForceTrueStrVal">
        <xsl:with-param name="str" select="$sLowerCaseStrikeH" />
      </xsl:call-template>
    </xsl:variable>
    <xsl:variable name="fStrikeV">
      <xsl:call-template name="ForceTrueStrVal">
        <xsl:with-param name="str" select="$sLowerCaseStrikeV" />
      </xsl:call-template>
    </xsl:variable>
    <xsl:variable name="fStrikeBLTR">
      <xsl:call-template name="ForceTrueStrVal">
        <xsl:with-param name="str" select="$sLowerCaseStrikeBLTR" />
      </xsl:call-template>
    </xsl:variable>
    <xsl:variable name="fStrikeTLBR">
      <xsl:call-template name="ForceTrueStrVal">
        <xsl:with-param name="str" select="$sLowerCaseStrikeTLBR" />
      </xsl:call-template>
    </xsl:variable>

    <xsl:choose>
      <xsl:when test="$fHideTop=1
                      and $fHideBot=1
                      and $fHideLeft=1
                      and $fHideRight=1
                      and $fStrikeH=0
                      and $fStrikeV=0
                      and $fStrikeBLTR=0
                      and $fStrikeTLBR=0">
        <mml:mrow>
          <xsl:apply-templates select="m:e[1]" />
        </mml:mrow>
      </xsl:when>
      <xsl:otherwise>
        <mml:menclose>
          <xsl:call-template name="CreateMencloseNotationAttrFromBorderBoxAttr">
            <xsl:with-param name="fHideTop" select="$fHideTop" />
            <xsl:with-param name="fHideBot" select="$fHideBot" />
            <xsl:with-param name="fHideLeft" select="$fHideLeft" />
            <xsl:with-param name="fHideRight" select="$fHideRight" />
            <xsl:with-param name="fStrikeH" select="$fStrikeH" />
            <xsl:with-param name="fStrikeV" select="$fStrikeV" />
            <xsl:with-param name="fStrikeBLTR" select="$fStrikeBLTR" />
            <xsl:with-param name="fStrikeTLBR" select="$fStrikeTLBR" />
          </xsl:call-template>
          <xsl:apply-templates select="m:e[1]" />
        </mml:menclose>
      </xsl:otherwise>
    </xsl:choose>
  </xsl:template>

  <xsl:template match="*">
    <xsl:apply-templates select="*" />
  </xsl:template>

  <!--
      { Non-combining, Upper-combining, Lower-combining }
      {U+02D8, U+0306, U+032E}, // BREVE
      {U+00B8, U+0312, U+0327}, // CEDILLA
      {U+0060, U+0300, U+0316}, // GRAVE ACCENT
      {U+002D, U+0305, U+0332}, // HYPHEN-MINUS/OVERLINE
      {U+2212, U+0305, U+0332}, // MINUS SIGN/OVERLINE
      {U+002E, U+0305, U+0323}, // FULL STOP/DOT ABOVE
      {U+02D9, U+0307, U+0323}, // DOT ABOVE
      {U+02DD, U+030B, U+02DD}, // DOUBLE ACUTE ACCENT
      {U+00B4, U+0301, U+0317}, // ACUTE ACCENT
      {U+007E, U+0303, U+0330}, // TILDE
      {U+02DC, U+0303, U+0330}, // SMALL TILDE
      {U+00A8, U+0308, U+0324}, // DIAERESIS
      {U+02C7, U+030C, U+032C}, // CARON
      {U+005E, U+0302, U+032D}, // CIRCUMFLEX ACCENT
      {U+00AF, U+0305, ::::::}, // MACRON
      {U+005F, ::::::, U+0332}, // LOW LINE
      {U+2192, U+20D7, U+20EF}, // RIGHTWARDS ARROW
      {U+27F6, U+20D7, U+20EF}, // LONG RIGHTWARDS ARROW
      {U+2190, U+20D6, U+20EE}, // LEFT ARROW
  -->
  <xsl:template name="ToNonCombining">
    <xsl:param name="ch" />
    <xsl:choose>
      <!-- BREVE -->
      <xsl:when test="$ch='&#x0306;' or $ch='&#x032e;'">&#x02D8;</xsl:when>
      <!-- CEDILLA -->
      <xsl:when test="$ch='&#x0312;' or $ch='&#x0327;'">&#x00B8;</xsl:when>
      <!-- GRAVE ACCENT -->
      <xsl:when test="$ch='&#x0300;' or $ch='&#x0316;'">&#x0060;</xsl:when>
      <!-- HYPHEN-MINUS/OVERLINE -->
      <xsl:when test="$ch='&#x0305;' or $ch='&#x0332;'">&#x002D;</xsl:when>
      <!-- MINUS SIGN/OVERLINE -->
      <xsl:when test="$ch='&#x0305;' or $ch='&#x0332;'">&#x2212;</xsl:when>
      <!-- FULL STOP/DOT ABOVE -->
      <xsl:when test="$ch='&#x0305;' or $ch='&#x0323;'">&#x002E;</xsl:when>
      <!-- DOT ABOVE -->
      <xsl:when test="$ch='&#x0307;' or $ch='&#x0323;'">&#x02D9;</xsl:when>
      <!-- DOUBLE ACUTE ACCENT -->
      <xsl:when test="$ch='&#x030B;' or $ch='&#x02DD;'">&#x02DD;</xsl:when>
      <!-- ACUTE ACCENT -->
      <xsl:when test="$ch='&#x0301;' or $ch='&#x0317;'">&#x00B4;</xsl:when>
      <!-- TILDE -->
      <xsl:when test="$ch='&#x0303;' or $ch='&#x0330;'">&#x007E;</xsl:when>
      <!-- SMALL TILDE -->
      <xsl:when test="$ch='&#x0303;' or $ch='&#x0330;'">&#x02DC;</xsl:when>
      <!-- DIAERESIS -->
      <xsl:when test="$ch='&#x0308;' or $ch='&#x0324;'">&#x00A8;</xsl:when>
      <!-- CARON -->
      <xsl:when test="$ch='&#x030C;' or $ch='&#x032C;'">&#x02C7;</xsl:when>
      <!-- CIRCUMFLEX ACCENT -->
      <xsl:when test="$ch='&#x0302;' or $ch='&#x032D;'">&#x005E;</xsl:when>
      <!-- MACRON -->
      <xsl:when test="$ch='&#x0305;'                   ">&#x00AF;</xsl:when>
      <!-- LOW LINE -->
      <xsl:when test="                   $ch='&#x0332;'">&#x005F;</xsl:when>
      <!-- RIGHTWARDS ARROW -->
      <xsl:when test="$ch='&#x20D7;' or $ch='&#x20EF;'">&#x2192;</xsl:when>
      <!-- LONG RIGHTWARDS ARROW -->
      <xsl:when test="$ch='&#x20D7;' or $ch='&#x20EF;'">&#x27F6;</xsl:when>
      <!-- LEFT ARROW -->
      <xsl:when test="$ch='&#x20D6;' or $ch='&#x20EE;'">&#x2190;</xsl:when>
      <xsl:otherwise>
        <xsl:value-of select="$ch"/>
      </xsl:otherwise>
    </xsl:choose>
  </xsl:template>

  <xsl:template match="m:acc">
    <mml:mover>
      <xsl:attribute name="accent">true</xsl:attribute>
      <mml:mrow>
        <xsl:apply-templates select="m:e[1]" />
      </mml:mrow>
      <xsl:variable name="chAcc">
        <xsl:choose>
          <xsl:when test="not(m:accPr[last()]/m:chr)">
            <xsl:value-of select="'&#x0302;'" />
          </xsl:when>
          <xsl:otherwise>
            <xsl:value-of select="substring(m:accPr/m:chr/@m:val,1,1)" />
          </xsl:otherwise>
        </xsl:choose>
      </xsl:variable>
      <xsl:variable name="chNonComb">
        <xsl:call-template name="ToNonCombining">
          <xsl:with-param name="ch" select="$chAcc" />
        </xsl:call-template>
      </xsl:variable>
      <xsl:choose>
        <xsl:when test="string-length($chAcc)=0">
          <mml:mo/>
        </xsl:when>
        <xsl:otherwise>
          <xsl:call-template name="ParseMt">
            <xsl:with-param name="sToParse" select="$chNonComb" />
            <xsl:with-param name="scr" select="m:e[1]/*/m:rPr[last()]/m:scr/@m:val" />
            <xsl:with-param name="sty" select="m:e[1]/*/m:rPr[last()]/m:sty/@m:val" />
            <xsl:with-param name="nor">
              <xsl:choose>
                <xsl:when test="count(m:e[1]/*/m:rPr[last()]/m:nor) = 0">0</xsl:when>
                <xsl:otherwise>
                  <xsl:call-template name="ForceFalseStrVal">
                    <xsl:with-param name="str" select="translate(m:e[1]/*/m:rPr[last()]/m:nor/@m:val,
                                                                     'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
		                                                                 'abcdefghijklmnopqrstuvwxyz')" />
                  </xsl:call-template>
                </xsl:otherwise>
              </xsl:choose>
            </xsl:with-param>
          </xsl:call-template>
        </xsl:otherwise>
      </xsl:choose>
    </mml:mover>
  </xsl:template>

  <xsl:template name="OutputScript">
    <xsl:param name="ndCur" select="." />
    <xsl:choose>
      <!-- Only output contents of $ndCur if $ndCur exists
           and $ndCur has children -->
      <xsl:when test="count($ndCur/*) &gt; 0">
        <mml:mrow>
          <xsl:apply-templates select="$ndCur" />
        </mml:mrow>
      </xsl:when>
      <xsl:otherwise>
        <mml:none />
      </xsl:otherwise>
    </xsl:choose>
  </xsl:template>

  <xsl:template match="m:sPre">
    <mml:mmultiscripts>
      <mml:mrow>
        <xsl:apply-templates select="m:e[1]" />
      </mml:mrow>
      <mml:mprescripts />
      <xsl:call-template name="OutputScript">
        <xsl:with-param name="ndCur" select="m:sub[1]"/>
      </xsl:call-template>
      <xsl:call-template name="OutputScript">
        <xsl:with-param name="ndCur" select="m:sup[1]" />
      </xsl:call-template>
    </mml:mmultiscripts>
  </xsl:template>

  <xsl:template match="m:m">
    <mml:mtable>
      <xsl:call-template name="CreateMathMLMatrixAttr">
        <xsl:with-param name="mcJc" select="m:mPr[last()]/m:mcs/m:mc/m:mcPr[last()]/m:mcJc/@m:val" />
      </xsl:call-template>
      <xsl:for-each select="m:mr">
        <mml:mtr>
          <xsl:for-each select="m:e">
            <mml:mtd>
              <xsl:apply-templates select="." />
            </mml:mtd>
          </xsl:for-each>
        </mml:mtr>
      </xsl:for-each>
    </mml:mtable>
  </xsl:template>

  <xsl:template name="CreateMathMLMatrixAttr">
    <xsl:param name="mcJc" />
    <xsl:variable name="sLowerCaseMcjc" select="translate($mcJc, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
		                                                             'abcdefghijklmnopqrstuvwxyz')" />
    <xsl:choose>
      <xsl:when test="$sLowerCaseMcjc='left'">
        <xsl:attribute name="columnalign">left</xsl:attribute>
      </xsl:when>
      <xsl:when test="$sLowerCaseMcjc='right'">
        <xsl:attribute name="columnalign">right</xsl:attribute>
      </xsl:when>
    </xsl:choose>
  </xsl:template>

  <xsl:template match="m:phant">
    <xsl:variable name="sLowerCaseZeroWidVal" select="translate(m:phantPr[last()]/m:zeroWid[last()]/@m:val,
		                                                       'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
		                                                       'abcdefghijklmnopqrstuvwxyz')" />
    <xsl:variable name="sLowerCaseZeroAscVal" select="translate(m:phantPr[last()]/m:zeroAsc[last()]/@m:val,
		                                                     'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
		                                                     'abcdefghijklmnopqrstuvwxyz')" />
    <xsl:variable name="sLowerCaseZeroDescVal" select="translate(m:phantPr[last()]/m:zeroDesc[last()]/@m:val,
		                                                     'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
		                                                     'abcdefghijklmnopqrstuvwxyz')" />
    <xsl:variable name="sLowerCaseShowVal" select="translate(m:phantPr[last()]/m:show[last()]/@m:val,
		                                                     'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
		                                                     'abcdefghijklmnopqrstuvwxyz')" />


    <!-- The following properties default to 'yes' unless the last value equals 'no' or there isn't any node for
         the property -->

    <xsl:variable name="fZeroWid">
      <xsl:choose>
        <xsl:when test="count(m:phantPr[last()]/m:zeroWid[last()]) = 0">0</xsl:when>
        <xsl:otherwise>
          <xsl:call-template name="ForceFalseStrVal">
            <xsl:with-param name="str" select="$sLowerCaseZeroWidVal" />
          </xsl:call-template>
        </xsl:otherwise>
      </xsl:choose>
    </xsl:variable>
    <xsl:variable name="fZeroAsc">
      <xsl:choose>
        <xsl:when test="count(m:phantPr[last()]/m:zeroAsc[last()]) = 0">0</xsl:when>
        <xsl:otherwise>
          <xsl:call-template name="ForceFalseStrVal">
            <xsl:with-param name="str" select="$sLowerCaseZeroAscVal" />
          </xsl:call-template>
        </xsl:otherwise>
      </xsl:choose>
    </xsl:variable>
    <xsl:variable name="fZeroDesc">
      <xsl:choose>
        <xsl:when test="count(m:phantPr[last()]/m:zeroDesc[last()]) = 0">0</xsl:when>
        <xsl:otherwise>
          <xsl:call-template name="ForceFalseStrVal">
            <xsl:with-param name="str" select="$sLowerCaseZeroDescVal" />
          </xsl:call-template>
        </xsl:otherwise>
      </xsl:choose>
    </xsl:variable>

    <!-- The show property defaults to 'on' unless there exists a show property and its value is 'off' -->

    <xsl:variable name="fShow">
      <xsl:call-template name="ForceFalseStrVal">
        <xsl:with-param name="str" select="$sLowerCaseShowVal" />
      </xsl:call-template>
    </xsl:variable>

    <xsl:choose>
      <!-- Show the phantom contents, therefore, just use mpadded. -->
      <xsl:when test="$fShow = 1">
        <xsl:element name="mml:mpadded">
          <xsl:call-template name="CreateMpaddedAttributes">
            <xsl:with-param name="fZeroWid" select="$fZeroWid" />
            <xsl:with-param name="fZeroAsc" select="$fZeroAsc" />
            <xsl:with-param name="fZeroDesc" select="$fZeroDesc" />
          </xsl:call-template>
          <mml:mrow>
            <xsl:apply-templates select="m:e" />
          </mml:mrow>
        </xsl:element>
      </xsl:when>
      <!-- Don't show phantom contents, but don't smash anything, therefore, just
           use mphantom -->
      <xsl:when test="$fZeroWid=0 and $fZeroAsc=0 and $fZeroDesc=0">
        <xsl:element name="mml:mphantom">
          <mml:mrow>
            <xsl:apply-templates select="m:e" />
          </mml:mrow>
        </xsl:element>
      </xsl:when>
      <!-- Combination -->
      <xsl:otherwise>
        <xsl:element name="mml:mphantom">
          <xsl:element name="mml:mpadded">
            <xsl:call-template name="CreateMpaddedAttributes">
              <xsl:with-param name="fZeroWid" select="$fZeroWid" />
              <xsl:with-param name="fZeroAsc" select="$fZeroAsc" />
              <xsl:with-param name="fZeroDesc" select="$fZeroDesc" />
            </xsl:call-template>
            <mml:mrow>
              <xsl:apply-templates select="m:e" />
            </mml:mrow>
          </xsl:element>
        </xsl:element>
      </xsl:otherwise>
    </xsl:choose>
  </xsl:template>

  <xsl:template name="CreateMpaddedAttributes">
    <xsl:param name="fZeroWid" />
    <xsl:param name="fZeroAsc" />
    <xsl:param name="fZeroDesc" />

    <xsl:if test="$fZeroWid=1">
      <xsl:attribute name="width">0in</xsl:attribute>
    </xsl:if>
    <xsl:if test="$fZeroAsc=1">
      <xsl:attribute name="height">0in</xsl:attribute>
    </xsl:if>
    <xsl:if test="$fZeroDesc=1">
      <xsl:attribute name="depth">0in</xsl:attribute>
    </xsl:if>
  </xsl:template>



  <xsl:template match="m:rad">
    <xsl:variable name="fDegHide">
      <xsl:choose>
        <xsl:when test="count(m:radPr[last()]/m:degHide)=0">0</xsl:when>
        <xsl:otherwise>
          <xsl:call-template name="ForceFalseStrVal">
            <xsl:with-param name="str" select="translate(m:radPr[last()]/m:degHide/@m:val,
		                                                          'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
		                                                          'abcdefghijklmnopqrstuvwxyz')" />
          </xsl:call-template>
        </xsl:otherwise>
      </xsl:choose>
    </xsl:variable>
    <xsl:choose>
      <xsl:when test="$fDegHide=1">
        <mml:msqrt>
          <xsl:apply-templates select="m:e[1]" />
        </mml:msqrt>
      </xsl:when>
      <xsl:otherwise>
        <mml:mroot>
          <mml:mrow>
            <xsl:apply-templates select="m:e[1]" />
          </mml:mrow>
          <mml:mrow>
            <xsl:apply-templates select="m:deg[1]" />
          </mml:mrow>
        </mml:mroot>
      </xsl:otherwise>
    </xsl:choose>
  </xsl:template>

  <xsl:template name="OutputNaryMo">
    <xsl:param name="ndCur" select="." />
    <xsl:param name="fGrow" select="0" />
    <mml:mo>
      <xsl:choose>
        <xsl:when test="$fGrow=1">
          <xsl:attribute name="stretchy">true</xsl:attribute>
        </xsl:when>
        <xsl:otherwise>
          <xsl:attribute name="stretchy">false</xsl:attribute>
        </xsl:otherwise>
      </xsl:choose>
      <xsl:choose>
        <xsl:when test="not($ndCur/m:naryPr[last()]/m:chr/@m:val) or
			                            $ndCur/m:naryPr[last()]/m:chr/@m:val=''">
          <xsl:text>&#x222b;</xsl:text>
        </xsl:when>
        <xsl:otherwise>
          <xsl:value-of select="$ndCur/m:naryPr[last()]/m:chr/@m:val" />
        </xsl:otherwise>
      </xsl:choose>
    </mml:mo>
  </xsl:template>

  <!-- %%Template match m:nary
		Process an n-ary.

		Decides, based on which arguments are supplied, between
		using an mo, msup, msub, or msubsup for the n-ary operator
	-->
  <xsl:template match="m:nary">
    <xsl:variable name="sLowerCaseSubHide">
      <xsl:choose>
        <xsl:when test="count(m:naryPr[last()]/m:subHide) = 0">
          <xsl:text>off</xsl:text>
        </xsl:when>
        <xsl:otherwise>
          <xsl:value-of select="translate(m:naryPr[last()]/m:subHide/@m:val,
	                                  'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
	                                  'abcdefghijklmnopqrstuvwxyz')" />
        </xsl:otherwise>
      </xsl:choose>
    </xsl:variable>

    <xsl:variable name="sLowerCaseSupHide">
      <xsl:choose>
        <xsl:when test="count(m:naryPr[last()]/m:supHide) = 0">
          <xsl:text>off</xsl:text>
        </xsl:when>
        <xsl:otherwise>
          <xsl:value-of select="translate(m:naryPr[last()]/m:supHide/@m:val,
	                                  'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
	                                  'abcdefghijklmnopqrstuvwxyz')" />
        </xsl:otherwise>
      </xsl:choose>
    </xsl:variable>

    <xsl:variable name="sLowerCaseLimLoc">
      <xsl:value-of select="translate(m:naryPr[last()]/m:limLoc/@m:val,
	                                  'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
	                                  'abcdefghijklmnopqrstuvwxyz')" />
    </xsl:variable>

    <xsl:variable name="sLowerGrow">
      <xsl:choose>
        <xsl:when test="count(m:naryPr[last()]/m:grow)=0">off</xsl:when>
        <xsl:otherwise>
          <xsl:value-of select="translate(m:naryPr[last()]/m:grow/@m:val,
	                                  'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
	                                  'abcdefghijklmnopqrstuvwxyz')" />
        </xsl:otherwise>
      </xsl:choose>
    </xsl:variable>

    <xsl:variable name="fLimLocSubSup">
      <xsl:choose>
        <xsl:when test="count(m:naryPr[last()]/m:limLoc)=0 or $sLowerCaseLimLoc='subsup'">1</xsl:when>
        <xsl:otherwise>0</xsl:otherwise>
      </xsl:choose>
    </xsl:variable>

    <xsl:variable name="fGrow">
      <xsl:call-template name="ForceFalseStrVal">
        <xsl:with-param name="str" select="$sLowerGrow" />
      </xsl:call-template>
    </xsl:variable>

    <xsl:variable name="fSupHide">
      <xsl:call-template name="ForceFalseStrVal">
        <xsl:with-param name="str" select="$sLowerCaseSupHide" />
      </xsl:call-template>
    </xsl:variable>

    <xsl:variable name="fSubHide">
      <xsl:call-template name="ForceFalseStrVal">
        <xsl:with-param name="str" select="$sLowerCaseSubHide" />
      </xsl:call-template>
    </xsl:variable>

    <mml:mrow>
      <xsl:choose>
        <xsl:when test="$fSupHide=1 and $fSubHide=1">
          <xsl:call-template name="OutputNaryMo">
            <xsl:with-param name="ndCur" select="." />
            <xsl:with-param name="fGrow" select="$fGrow" />
          </xsl:call-template>
        </xsl:when>
        <xsl:when test="$fSubHide=1">
          <xsl:choose>
            <xsl:when test="$fLimLocSubSup=1">
              <mml:msup>
                <xsl:call-template name="OutputNaryMo">
                  <xsl:with-param name="ndCur" select="." />
                  <xsl:with-param name="fGrow" select="$fGrow" />
                </xsl:call-template>
                <mml:mrow>
                  <xsl:apply-templates select="m:sup[1]" />
                </mml:mrow>
              </mml:msup>
            </xsl:when>
            <xsl:otherwise>
              <mml:mover>
                <xsl:call-template name="OutputNaryMo">
                  <xsl:with-param name="ndCur" select="." />
                  <xsl:with-param name="fGrow" select="$fGrow" />
                </xsl:call-template>
                <mml:mrow>
                  <xsl:apply-templates select="m:sup[1]" />
                </mml:mrow>
              </mml:mover>
            </xsl:otherwise>
          </xsl:choose>
        </xsl:when>
        <xsl:when test="$fSupHide=1">
          <xsl:choose>
            <xsl:when test="$fLimLocSubSup=1">
              <mml:msub>
                <xsl:call-template name="OutputNaryMo">
                  <xsl:with-param name="ndCur" select="." />
                  <xsl:with-param name="fGrow" select="$fGrow" />
                </xsl:call-template>
                <mml:mrow>
                  <xsl:apply-templates select="m:sub[1]" />
                </mml:mrow>
              </mml:msub>
            </xsl:when>
            <xsl:otherwise>
              <mml:munder>
                <xsl:call-template name="OutputNaryMo">
                  <xsl:with-param name="ndCur" select="." />
                  <xsl:with-param name="fGrow" select="$fGrow" />
                </xsl:call-template>
                <mml:mrow>
                  <xsl:apply-templates select="m:sub[1]" />
                </mml:mrow>
              </mml:munder>
            </xsl:otherwise>
          </xsl:choose>
        </xsl:when>
        <xsl:otherwise>
          <xsl:choose>
            <xsl:when test="$fLimLocSubSup=1">
              <mml:msubsup>
                <xsl:call-template name="OutputNaryMo">
                  <xsl:with-param name="ndCur" select="." />
                  <xsl:with-param name="fGrow" select="$fGrow" />
                </xsl:call-template>
                <mml:mrow>
                  <xsl:apply-templates select="m:sub[1]" />
                </mml:mrow>
                <mml:mrow>
                  <xsl:apply-templates select="m:sup[1]" />
                </mml:mrow>
              </mml:msubsup>
            </xsl:when>
            <xsl:otherwise>
              <mml:munderover>
                <xsl:call-template name="OutputNaryMo">
                  <xsl:with-param name="ndCur" select="." />
                  <xsl:with-param name="fGrow" select="$fGrow" />
                </xsl:call-template>
                <mml:mrow>
                  <xsl:apply-templates select="m:sub[1]" />
                </mml:mrow>
                <mml:mrow>
                  <xsl:apply-templates select="m:sup[1]" />
                </mml:mrow>
              </mml:munderover>
            </xsl:otherwise>
          </xsl:choose>
        </xsl:otherwise>
      </xsl:choose>
      <mml:mrow>
        <xsl:apply-templates select="m:e[1]" />
      </mml:mrow>
    </mml:mrow>
  </xsl:template>

  <xsl:template match="m:limLow">
    <mml:munder>
      <mml:mrow>
        <xsl:apply-templates select="m:e[1]" />
      </mml:mrow>
      <mml:mrow>
        <xsl:apply-templates select="m:lim[1]" />
      </mml:mrow>
    </mml:munder>
  </xsl:template>

  <xsl:template match="m:limUpp">
    <mml:mover>
      <mml:mrow>
        <xsl:apply-templates select="m:e[1]" />
      </mml:mrow>
      <mml:mrow>
        <xsl:apply-templates select="m:lim[1]" />
      </mml:mrow>
    </mml:mover>
  </xsl:template>

  <xsl:template match="m:sSub">
    <mml:msub>
      <mml:mrow>
        <xsl:apply-templates select="m:e[1]" />
      </mml:mrow>
      <mml:mrow>
        <xsl:apply-templates select="m:sub[1]" />
      </mml:mrow>
    </mml:msub>
  </xsl:template>

  <xsl:template match="m:sSup">
    <mml:msup>
      <mml:mrow>
        <xsl:apply-templates select="m:e[1]" />
      </mml:mrow>
      <mml:mrow>
        <xsl:apply-templates select="m:sup[1]" />
      </mml:mrow>
    </mml:msup>
  </xsl:template>

  <xsl:template match="m:sSubSup">
    <mml:msubsup>
      <mml:mrow>
        <xsl:apply-templates select="m:e[1]" />
      </mml:mrow>
      <mml:mrow>
        <xsl:apply-templates select="m:sub[1]" />
      </mml:mrow>
      <mml:mrow>
        <xsl:apply-templates select="m:sup[1]" />
      </mml:mrow>
    </mml:msubsup>
  </xsl:template>

  <xsl:template match="m:groupChr">
    <xsl:variable name="ndLastGroupChrPr" select="m:groupChrPr[last()]" />
    <xsl:variable name="sLowerCasePos" select="translate($ndLastGroupChrPr/m:pos/@m:val,
		                                                     'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
		                                                     'abcdefghijklmnopqrstuvwxyz')" />

    <xsl:variable name="sLowerCaseVertJc" select="translate($ndLastGroupChrPr/m:vertJc/@m:val,
		                                                     'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
		                                                     'abcdefghijklmnopqrstuvwxyz')" />
    <xsl:variable name="ndLastChr" select="$ndLastGroupChrPr/m:chr" />

    <xsl:variable name="chr">
      <xsl:choose>
        <xsl:when test="$ndLastChr and (not($ndLastChr/@m:val) or string-length($ndLastChr/@m:val) = 0)"></xsl:when>
        <xsl:when test="string-length($ndLastChr/@m:val) &gt;= 1">
          <xsl:value-of select="substring($ndLastChr/@m:val,1,1)" />
        </xsl:when>
        <xsl:otherwise>
          <xsl:text>&#x023DF;</xsl:text>
        </xsl:otherwise>
      </xsl:choose>
    </xsl:variable>
    <xsl:choose>
      <xsl:when test="$sLowerCasePos = 'top'">
        <xsl:choose>
          <xsl:when test="$sLowerCaseVertJc = 'bot'">
            <mml:mover accent="false">
              <mml:mrow>
                <xsl:apply-templates select="m:e[1]" />
              </mml:mrow>
              <mml:mo>
                <xsl:value-of select="$chr" />
              </mml:mo>
            </mml:mover>
          </xsl:when>
          <xsl:otherwise>
            <mml:munder accentunder="false">
              <mml:mo>
                <xsl:value-of select="$chr" />
              </mml:mo>
              <mml:mrow>
                <xsl:apply-templates select="m:e[1]" />
              </mml:mrow>
            </mml:munder>
          </xsl:otherwise>
        </xsl:choose>
      </xsl:when>
      <xsl:otherwise>
        <xsl:choose>
          <xsl:when test="$sLowerCaseVertJc = 'bot'">
            <mml:mover accent="false">
              <mml:mo>
                <xsl:value-of select="$chr" />
              </mml:mo>
              <mml:mrow>
                <xsl:apply-templates select="m:e[1]" />
              </mml:mrow>
            </mml:mover>
          </xsl:when>
          <xsl:otherwise>
            <mml:munder accentunder="false">
              <mml:mrow>
                <xsl:apply-templates select="m:e[1]" />
              </mml:mrow>
              <mml:mo>
                <xsl:value-of select="$chr" />
              </mml:mo>
            </mml:munder>
          </xsl:otherwise>
        </xsl:choose>
      </xsl:otherwise>
    </xsl:choose>
  </xsl:template>

  <xsl:template name="fName">
    <xsl:for-each select="m:fName/*">
      <xsl:apply-templates select="." />
    </xsl:for-each>
  </xsl:template>

  <xsl:template match="m:func">
    <mml:mrow>
      <mml:mrow>
        <xsl:call-template name="fName" />
      </mml:mrow>
      <mml:mo>&#x02061;</mml:mo>
      <mml:mrow>
        <xsl:apply-templates select="m:e" />
      </mml:mrow>
    </mml:mrow>
  </xsl:template>

  <!-- %%Template: match m:f

		m:f maps directly to mfrac.
	-->
  <xsl:template match="m:f">
    <xsl:variable name="sLowerCaseType" select="translate(m:fPr[last()]/m:type/@m:val, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', 'abcdefghijklmnopqrstuvwxyz')" />
    <xsl:choose>
      <xsl:when test="$sLowerCaseType='lin'">
        <mml:mrow>
          <mml:mrow>
            <xsl:apply-templates select="m:num[1]" />
          </mml:mrow>
          <mml:mo>/</mml:mo>
          <mml:mrow>
            <xsl:apply-templates select="m:den[1]" />
          </mml:mrow>
        </mml:mrow>
      </xsl:when>
      <xsl:otherwise>
        <mml:mfrac>
          <xsl:call-template name="CreateMathMLFracProp">
            <xsl:with-param name="type" select="$sLowerCaseType" />
          </xsl:call-template>
          <mml:mrow>
            <xsl:apply-templates select="m:num[1]" />
          </mml:mrow>
          <mml:mrow>
            <xsl:apply-templates select="m:den[1]" />
          </mml:mrow>
        </mml:mfrac>
      </xsl:otherwise>
    </xsl:choose>

  </xsl:template>


  <!-- %%Template: CreateMathMLFracProp

			Make fraction properties based on supplied parameters.
			OMML differentiates between a linear fraction and a skewed
			one. For MathML, we write both as bevelled.
	-->
  <xsl:template name="CreateMathMLFracProp">
    <xsl:param name="type" />
    <xsl:variable name="sLowerCaseType" select="translate($type, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', 'abcdefghijklmnopqrstuvwxyz')" />

    <xsl:if test="$sLowerCaseType='skw' or $sLowerCaseType='lin'">
      <xsl:attribute name="bevelled">true</xsl:attribute>
    </xsl:if>
    <xsl:if test="$sLowerCaseType='nobar'">
      <xsl:attribute name="linethickness">0pt</xsl:attribute>
    </xsl:if>
    <xsl:choose>
      <xsl:when test="sLowerCaseNumJc='right'">
        <xsl:attribute name="numalign">right</xsl:attribute>
      </xsl:when>
      <xsl:when test="sLowerCaseNumJc='left'">
        <xsl:attribute name="numalign">left</xsl:attribute>
      </xsl:when>
    </xsl:choose>
    <xsl:choose>
      <xsl:when test="sLowerCaseDenJc='right'">
        <xsl:attribute name="numalign">right</xsl:attribute>
      </xsl:when>
      <xsl:when test="sLowerCaseDenJc='left'">
        <xsl:attribute name="numalign">left</xsl:attribute>
      </xsl:when>
    </xsl:choose>
  </xsl:template>

  <!-- %%Template: match m:e | m:den | m:num | m:lim | m:sup | m:sub

		These element delinate parts of an expression (like the numerator).  -->
  <xsl:template match="m:e | m:den | m:num | m:lim | m:sup | m:sub">
    <xsl:choose>

      <!-- If there is no scriptLevel specified, just call through -->
      <xsl:when test="not(m:argPr[last()]/m:scrLvl/@m:val)">
        <xsl:apply-templates select="*" />
      </xsl:when>

      <!-- Otherwise, create an mstyle and set the script level -->
      <xsl:otherwise>
        <mml:mstyle>
          <xsl:attribute name="scriptlevel">
            <xsl:value-of select="m:argPr[last()]/m:scrLvl/@m:val" />
          </xsl:attribute>
          <xsl:apply-templates select="*" />
        </mml:mstyle>
      </xsl:otherwise>
    </xsl:choose>
  </xsl:template>

  <xsl:template match="m:bar">
    <xsl:variable name="sLowerCasePos" select="translate(m:barPr/m:pos/@m:val, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
		                                                                       'abcdefghijklmnopqrstuvwxyz')" />

    <xsl:variable name="fTop">

      <xsl:choose>
        <xsl:when test="$sLowerCasePos='top'">1</xsl:when>
        <xsl:otherwise>0</xsl:otherwise>
      </xsl:choose>
    </xsl:variable>
    <xsl:choose>
      <xsl:when test="$fTop=1">
        <mml:mover accent="false">
          <mml:mrow>
            <xsl:apply-templates select="m:e[1]" />
          </mml:mrow>
          <mml:mo>
            <xsl:text>&#x00AF;</xsl:text>
          </mml:mo>
        </mml:mover>
      </xsl:when>
      <xsl:otherwise>
        <mml:munder underaccent="false">
          <mml:mrow>
            <xsl:apply-templates select="m:e[1]" />
          </mml:mrow>
          <mml:mo>
            <xsl:text>&#x005F;</xsl:text>
          </mml:mo>
        </mml:munder>
      </xsl:otherwise>
    </xsl:choose>
  </xsl:template>

  <!-- %%Template match m:d

		Process a delimiter.
	-->
  <xsl:template match="m:d">
    <mml:mfenced>
      <!-- open: default is '(' for both OMML and MathML -->
      <xsl:if test="m:dPr[1]/m:begChr/@m:val and not(m:dPr[1]/m:begChr/@m:val ='(')">
        <xsl:attribute name="open">
          <xsl:value-of select="m:dPr[1]/m:begChr/@m:val" />
        </xsl:attribute>
      </xsl:if>

      <!-- close: default is ')' for both OMML and MathML -->
      <xsl:if test="m:dPr[1]/m:endChr/@m:val and not(m:dPr[1]/m:endChr/@m:val =')')">
        <xsl:attribute name="close">
          <xsl:value-of select="m:dPr[1]/m:endChr/@m:val" />
        </xsl:attribute>
      </xsl:if>

      <!-- separator: the default is ',' for MathML, and '|' for OMML -->
      <xsl:choose>
        <!-- Matches MathML default. Write nothing -->
        <xsl:when test="m:dPr[1]/m:sepChr/@m:val = ','" />

        <!-- OMML default: | -->
        <xsl:when test="not(m:dPr[1]/m:sepChr/@m:val)">
          <xsl:attribute name="separators">
            <xsl:value-of select="'|'" />
          </xsl:attribute>
        </xsl:when>

        <xsl:otherwise>
          <xsl:attribute name="separators">
            <xsl:value-of select="m:dPr[1]/m:sepChr/@m:val" />
          </xsl:attribute>
        </xsl:otherwise>
      </xsl:choose>

      <!-- now write all the children. Put each one into an mrow
			just in case it produces multiple runs, etc -->
      <xsl:for-each select="m:e">
        <mml:mrow>
          <xsl:apply-templates select="." />
        </mml:mrow>
      </xsl:for-each>
    </mml:mfenced>
  </xsl:template>

  <xsl:template match="m:r">
    <xsl:variable name="fNor">
      <xsl:choose>
        <xsl:when test="count(child::m:rPr[last()]/m:nor) = 0">0</xsl:when>
        <xsl:otherwise>
          <xsl:call-template name="ForceFalseStrVal">
            <xsl:with-param name="str" select="translate(child::m:rPr[last()]/m:nor/@m:val, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
		                                                                       'abcdefghijklmnopqrstuvwxyz')" />
          </xsl:call-template>
        </xsl:otherwise>
      </xsl:choose>
    </xsl:variable>

    <xsl:choose>
      <xsl:when test="$fNor=1">
        <mml:mtext>
          <xsl:variable name="sOutput" select="translate(.//m:t, ' ', '&#xa0;')" />
          <xsl:value-of select="$sOutput" />
        </mml:mtext>
      </xsl:when>
      <xsl:otherwise>
        <xsl:for-each select=".//m:t">
          <xsl:call-template name="ParseMt">
            <xsl:with-param name="sToParse" select="text()" />
            <xsl:with-param name="scr" select="../m:rPr[last()]/m:scr/@m:val" />
            <xsl:with-param name="sty" select="../m:rPr[last()]/m:sty/@m:val" />
            <xsl:with-param name="nor">0</xsl:with-param>
          </xsl:call-template>
        </xsl:for-each>
      </xsl:otherwise>
    </xsl:choose>
  </xsl:template>


  <xsl:template name="CreateTokenAttributes">
    <xsl:param name="scr" />
    <xsl:param name="sty" />
    <xsl:param name="nor" />
    <xsl:param name="nCharToPrint" />
    <xsl:param name="sTokenType" />

    <xsl:choose>
      <xsl:when test="$nor=1">
        <xsl:attribute name="mathvariant">normal</xsl:attribute>
      </xsl:when>
      <xsl:otherwise>
        <xsl:variable name="mathvariant">
          <xsl:choose>
            <!-- numbers don't care -->
            <xsl:when test="$sTokenType='mn'" />

            <xsl:when test="$scr='monospace'">monospace</xsl:when>
            <xsl:when test="$scr='sans-serif' and $sty='i'">sans-serif-italic</xsl:when>
            <xsl:when test="$scr='sans-serif' and $sty='b'">bold-sans-serif</xsl:when>
            <xsl:when test="$scr='sans-serif' and $sty='bi'">sans-serif-bold-italic</xsl:when>
            <xsl:when test="$scr='sans-serif'">sans-serif</xsl:when>
            <xsl:when test="$scr='fraktur' and ($sty='b' or $sty='bi')">bold-fraktur</xsl:when>
            <xsl:when test="$scr='fraktur'">fraktur</xsl:when>
            <xsl:when test="$scr='double-struck'">double-struck</xsl:when>
            <xsl:when test="$scr='script' and ($sty='b' or $sty='bi')">bold-script</xsl:when>
            <xsl:when test="$scr='script'">script</xsl:when>
            <xsl:when test="($scr='roman' or not($scr) or $scr='') and $sty='b'">bold</xsl:when>
            <xsl:when test="($scr='roman' or not($scr) or $scr='') and $sty='i'">italic</xsl:when>
            <xsl:when test="($scr='roman' or not($scr) or $scr='') and $sty='p'">normal</xsl:when>
            <xsl:when test="($scr='roman' or not($scr) or $scr='') and $sty='bi'">bold-italic</xsl:when>
            <xsl:otherwise />
          </xsl:choose>
        </xsl:variable>
        <xsl:variable name="fontweight">
          <xsl:choose>
            <xsl:when test="$sty='b' or $sty='bi'">bold</xsl:when>
            <xsl:otherwise>normal</xsl:otherwise>
          </xsl:choose>
        </xsl:variable>
        <xsl:variable name="fontstyle">
          <xsl:choose>
            <xsl:when test="$sty='p' or $sty='b'">normal</xsl:when>
            <xsl:otherwise>italic</xsl:otherwise>
          </xsl:choose>
        </xsl:variable>

        <!-- Writing of attributes begins here -->
        <xsl:choose>
          <!-- Don't write mathvariant for operators unless they want to be normal -->
          <xsl:when test="$sTokenType='mo' and $mathvariant!='normal'" />

          <!-- A single character within an mi is already italics, don't write -->
          <xsl:when test="$sTokenType='mi' and $nCharToPrint=1 and ($mathvariant='' or $mathvariant='italic')" />

          <xsl:when test="$sTokenType='mi' and $nCharToPrint &gt; 1 and ($mathvariant='' or $mathvariant='italic')">
            <xsl:attribute name="mathvariant">
              <xsl:value-of select="'italic'" />
            </xsl:attribute>
          </xsl:when>
          <xsl:when test="$mathvariant!='italic' and $mathvariant!=''">
            <xsl:attribute name="mathvariant">
              <xsl:value-of select="$mathvariant" />
            </xsl:attribute>
          </xsl:when>
          <xsl:otherwise>
            <xsl:if test="not($sTokenType='mi' and $nCharToPrint=1) and $fontstyle='italic'">
              <xsl:attribute name="fontstyle">italic</xsl:attribute>
            </xsl:if>
            <xsl:if test="$fontweight='bold'">
              <xsl:attribute name="fontweight">bold</xsl:attribute>
            </xsl:if>
          </xsl:otherwise>
        </xsl:choose>
      </xsl:otherwise>
    </xsl:choose>
  </xsl:template>

  <xsl:template match="m:eqArr">
    <mml:mtable>
      <xsl:for-each select="m:e">
        <mml:mtr>
          <mml:mtd>
            <xsl:choose>
              <xsl:when test="m:argPr[last()]/m:scrLvl/@m:val!='0' or
					            not(m:argPr[last()]/m:scrLvl/@m:val)  or
					            m:argPr[last()]/m:scrLvl/@m:val=''">
                <mml:mrow>
                  <mml:maligngroup />
                  <xsl:call-template name="CreateEqArrRow">
                    <xsl:with-param name="align" select="1" />
                    <xsl:with-param name="ndCur" select="*[1]" />
                  </xsl:call-template>
                </mml:mrow>
              </xsl:when>
              <xsl:otherwise>
                <mml:mstyle>
                  <xsl:attribute name="scriptlevel">
                    <xsl:value-of select="m:argPr[last()]/m:scrLvl/@m:val" />
                  </xsl:attribute>
                  <mml:maligngroup />
                  <xsl:call-template name="CreateEqArrRow">
                    <xsl:with-param name="align" select="1" />
                    <xsl:with-param name="ndCur" select="*[1]" />
                  </xsl:call-template>
                </mml:mstyle>
              </xsl:otherwise>
            </xsl:choose>
          </mml:mtd>
        </mml:mtr>
      </xsl:for-each>
    </mml:mtable>
  </xsl:template>

  <xsl:template name="CreateEqArrRow">
    <xsl:param name="align" />
    <xsl:param name="ndCur" />
    <xsl:variable name="sAllMt">
      <xsl:for-each select="$ndCur/m:t">
        <xsl:value-of select="." />
      </xsl:for-each>
    </xsl:variable>
    <xsl:choose>
      <xsl:when test="$ndCur/self::m:r">
        <xsl:call-template name="ParseEqArrMr">
          <xsl:with-param name="sToParse" select="$sAllMt" />
          <xsl:with-param name="scr" select="../m:rPr[last()]/m:scr/@m:val" />
          <xsl:with-param name="sty" select="../m:rPr[last()]/m:sty/@m:val" />
          <xsl:with-param name="nor">
            <xsl:choose>
              <xsl:when test="count($ndCur/m:rPr[last()]/m:nor) = 0">0</xsl:when>
              <xsl:otherwise>
                <xsl:call-template name="ForceFalseStrVal">
                  <xsl:with-param name="str" select="translate($ndCur/m:rPr[last()]/m:nor/@m:val,
                                                                     'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
		                                                                 'abcdefghijklmnopqrstuvwxyz')" />
                </xsl:call-template>
              </xsl:otherwise>
            </xsl:choose>
          </xsl:with-param>
          <xsl:with-param name="align" select="$align" />
        </xsl:call-template>
      </xsl:when>
      <xsl:otherwise>
        <xsl:apply-templates select="$ndCur" />
      </xsl:otherwise>
    </xsl:choose>
    <xsl:if test="count($ndCur/following-sibling::*) &gt; 0">
      <xsl:variable name="cAmp">
        <xsl:call-template name="CountAmp">
          <xsl:with-param name="sAllMt" select="$sAllMt" />
          <xsl:with-param name="cAmp" select="0" />
        </xsl:call-template>
      </xsl:variable>
      <xsl:call-template name="CreateEqArrRow">
        <xsl:with-param name="align" select="($align+($cAmp mod 2)) mod 2" />
        <xsl:with-param name="ndCur" select="$ndCur/following-sibling::*[1]" />
      </xsl:call-template>
    </xsl:if>
  </xsl:template>

  <xsl:template name="CountAmp">
    <xsl:param name="sAllMt" />
    <xsl:param name="cAmp" />
    <xsl:choose>
      <xsl:when test="string-length(substring-after($sAllMt, '&amp;')) &gt; 0 or
			                substring($sAllMt, string-length($sAllMt))='&#x0026;'">
        <xsl:call-template name="CountAmp">
          <xsl:with-param name="sAllMt" select="substring-after($sAllMt, '&#x0026;')" />
          <xsl:with-param name="cAmp" select="$cAmp+1" />
        </xsl:call-template>
      </xsl:when>
      <xsl:otherwise>
        <xsl:value-of select="$cAmp" />
      </xsl:otherwise>
    </xsl:choose>
  </xsl:template>

  <!-- %%Template: ParseEqArrMr

			Similar to ParseMt, but this one has to do more for an equation array.
      In equation arrays &amp; is a special character which denotes alignment.

      The &amp; in an equation works by alternating between meaning insert alignment spacing
      and insert alignment mark.  For each equation in the equation array
      there is an implied align space at the beginning of the equation.  Within each equation,
      the first &amp; means alignmark, the second, align space, the third, alignmark, etc.

      For this reason when parsing m:r's in equation arrays it is important to keep track of what
      the next ampersand will mean.

      $align=0 => Omml's align space, which is similar to MathML's maligngroup.
      $align=1 => Omml's alignment mark, which is similar to MathML's malignmark.
	-->
  <xsl:template name="ParseEqArrMr">
    <xsl:param name="sToParse" />
    <xsl:param name="sty" />
    <xsl:param name="scr" />
    <xsl:param name="nor" />
    <xsl:param name="align" />

    <xsl:if test="string-length($sToParse) &gt; 0">
      <xsl:choose>
        <xsl:when test="substring($sToParse,1,1) = '&amp;'">
          <xsl:choose>
            <xsl:when test="$align='0'">
              <mml:maligngroup />
            </xsl:when>
            <xsl:when test="$align='1'">
              <mml:malignmark />
            </xsl:when>
          </xsl:choose>
          <xsl:call-template name="ParseEqArrMr">
            <xsl:with-param name="sToParse" select="substring($sToParse,2)" />
            <xsl:with-param name="scr" select="$scr" />
            <xsl:with-param name="sty" select="$sty" />
            <xsl:with-param name="nor" select="$nor" />
            <xsl:with-param name="align">
              <xsl:choose>
                <xsl:when test="$align='1'">0</xsl:when>
                <xsl:otherwise>1</xsl:otherwise>
              </xsl:choose>
            </xsl:with-param>
          </xsl:call-template>
        </xsl:when>
        <xsl:otherwise>
          <xsl:variable name="sRepNumWith0">
            <xsl:call-template name="SReplaceNumWithZero">
              <xsl:with-param name="sToParse" select="$sToParse" />
            </xsl:call-template>
          </xsl:variable>
          <xsl:variable name="sRepOperWith-">
            <xsl:call-template name="SReplaceOperWithMinus">
              <xsl:with-param name="sToParse" select="$sRepNumWith0" />
            </xsl:call-template>
          </xsl:variable>

          <xsl:variable name="iFirstOper" select="string-length($sRepOperWith-) - string-length(substring-after($sRepOperWith-, '-'))" />
          <xsl:variable name="iFirstNum" select="string-length($sRepOperWith-) - string-length(substring-after($sRepOperWith-, '0'))" />
          <xsl:variable name="iFirstAmp" select="string-length($sRepOperWith-) - string-length(substring-after($sRepOperWith-, '&#x0026;'))" />
          <xsl:variable name="fNumAtPos1">
            <xsl:choose>
              <xsl:when test="substring($sRepOperWith-,1,1)='0'">1</xsl:when>
              <xsl:otherwise>0</xsl:otherwise>
            </xsl:choose>
          </xsl:variable>
          <xsl:variable name="fOperAtPos1">
            <xsl:choose>
              <xsl:when test="substring($sRepOperWith-,1,1)='-'">1</xsl:when>
              <xsl:otherwise>0</xsl:otherwise>
            </xsl:choose>
          </xsl:variable>
          <xsl:choose>

            <!-- Case I: The string begins with neither a number, nor an operator -->
            <xsl:when test="$fNumAtPos1='0' and $fOperAtPos1='0'">
              <xsl:choose>
                <xsl:when test="$nor = 0">
                  <mml:mi>
                    <xsl:call-template name="CreateTokenAttributes">
                      <xsl:with-param name="scr" select="$scr" />
                      <xsl:with-param name="sty" select="$sty" />
                      <xsl:with-param name="nor" select="$nor" />
                      <xsl:with-param name="nCharToPrint" select="1" />
                      <xsl:with-param name="sTokenType" select="'mi'" />
                    </xsl:call-template>
                    <xsl:variable name="sOutput" select="translate(substring($sToParse, 1, 1), ' ', '&#xa0;')" />
                    <xsl:value-of select="$sOutput" />
                  </mml:mi>
                </xsl:when>
                <xsl:otherwise>
                  <mml:mtext>
                    <xsl:variable name="sOutput" select="translate(substring($sToParse, 1, 1), ' ', '&#xa0;')" />
                    <xsl:value-of select="$sOutput" />
                  </mml:mtext>
                </xsl:otherwise>
              </xsl:choose>
              <xsl:call-template name="ParseEqArrMr">
                <xsl:with-param name="sToParse" select="substring($sToParse, 2)" />
                <xsl:with-param name="scr" select="$scr" />
                <xsl:with-param name="sty" select="$sty" />
                <xsl:with-param name="nor" select="$nor" />
                <xsl:with-param name="align" select="$align" />
              </xsl:call-template>
            </xsl:when>

            <!-- Case II: There is an operator at position 1 -->
            <xsl:when test="$fOperAtPos1='1'">
              <xsl:choose>
                <xsl:when test="$nor = 0">
                  <mml:mo>
                    <xsl:call-template name="CreateTokenAttributes">
                      <xsl:with-param name="scr" />
                      <xsl:with-param name="sty" />
                      <xsl:with-param name="nor" select="$nor" />
                      <xsl:with-param name="sTokenType" select="'mo'" />
                    </xsl:call-template>
                    <xsl:value-of select="substring($sToParse,1,1)" />
                  </mml:mo>
                </xsl:when>
                <xsl:otherwise>
                  <mml:mtext>
                    <xsl:value-of select="substring($sToParse,1,1)" />
                  </mml:mtext>
                </xsl:otherwise>
              </xsl:choose>
              <xsl:call-template name="ParseEqArrMr">
                <xsl:with-param name="sToParse" select="substring($sToParse, 2)" />
                <xsl:with-param name="scr" select="$scr" />
                <xsl:with-param name="sty" select="$sty" />
                <xsl:with-param name="nor" select="$nor" />
                <xsl:with-param name="align" select="$align" />
              </xsl:call-template>
            </xsl:when>

            <!-- Case III: There is a number at position 1 -->
            <xsl:otherwise>
              <xsl:variable name="sConsecNum">
                <xsl:call-template name="SNumStart">
                  <xsl:with-param name="sToParse" select="$sToParse" />
                  <xsl:with-param name="sPattern" select="$sRepNumWith0" />
                </xsl:call-template>
              </xsl:variable>
              <xsl:choose>
                <xsl:when test="$nor = 0">
                  <mml:mn>
                    <xsl:call-template name="CreateTokenAttributes">
                      <xsl:with-param name="scr" />
                      <xsl:with-param name="sty" select="'p'"/>
                      <xsl:with-param name="nor" select="$nor" />
                      <xsl:with-param name="sTokenType" select="'mn'" />
                    </xsl:call-template>
                    <xsl:value-of select="$sConsecNum" />
                  </mml:mn>
                </xsl:when>
                <xsl:otherwise>
                  <mml:mtext>
                    <xsl:value-of select="$sConsecNum" />
                  </mml:mtext>
                </xsl:otherwise>
              </xsl:choose>
              <xsl:call-template name="ParseEqArrMr">
                <xsl:with-param name="sToParse" select="substring-after($sToParse, $sConsecNum)" />
                <xsl:with-param name="scr" select="$scr" />
                <xsl:with-param name="sty" select="$sty" />
                <xsl:with-param name="nor" select="$nor" />
                <xsl:with-param name="align" select="$align" />
              </xsl:call-template>
            </xsl:otherwise>
          </xsl:choose>
        </xsl:otherwise>
      </xsl:choose>
    </xsl:if>
  </xsl:template>

  <!-- %%Template: ParseMt

			Produce a run of text. Technically, OMML makes no distinction
			between numbers, operators, and other characters in a run. For
			MathML we need to break these into mi, mn, or mo elements.

			See also ParseEqArrMr
	-->
  <xsl:template name="ParseMt">
    <xsl:param name="sToParse" />
    <xsl:param name="sty" />
    <xsl:param name="scr" />
    <xsl:param name="nor" />
    <xsl:if test="string-length($sToParse) &gt; 0">
      <xsl:variable name="sRepNumWith0">
        <xsl:call-template name="SReplaceNumWithZero">
          <xsl:with-param name="sToParse" select="$sToParse" />
        </xsl:call-template>
      </xsl:variable>
      <xsl:variable name="sRepOperWith-">
        <xsl:call-template name="SReplaceOperWithMinus">
          <xsl:with-param name="sToParse" select="$sRepNumWith0" />
        </xsl:call-template>
      </xsl:variable>

      <xsl:variable name="iFirstOper" select="string-length($sRepOperWith-) - string-length(substring-after($sRepOperWith-, '-'))" />
      <xsl:variable name="iFirstNum" select="string-length($sRepOperWith-) - string-length(substring-after($sRepOperWith-, '0'))" />
      <xsl:variable name="fNumAtPos1">
        <xsl:choose>
          <xsl:when test="substring($sRepOperWith-,1,1)='0'">1</xsl:when>
          <xsl:otherwise>0</xsl:otherwise>
        </xsl:choose>
      </xsl:variable>
      <xsl:variable name="fOperAtPos1">
        <xsl:choose>
          <xsl:when test="substring($sRepOperWith-,1,1)='-'">1</xsl:when>
          <xsl:otherwise>0</xsl:otherwise>
        </xsl:choose>
      </xsl:variable>

      <xsl:choose>

        <!-- Case I: The string begins with neither a number, nor an operator -->
        <xsl:when test="$fOperAtPos1='0' and $fNumAtPos1='0'">
          <xsl:variable name="nCharToPrint">
            <xsl:choose>
              <xsl:when test="ancestor::m:fName">
                <xsl:choose>
                  <xsl:when test="($iFirstOper=$iFirstNum) and
											($iFirstOper=string-length($sToParse)) and
							                (substring($sRepOperWith-, string-length($sRepOperWith-))!='0') and
							                (substring($sRepOperWith-, string-length($sRepOperWith-))!='-')">
                    <xsl:value-of select="string-length($sToParse)" />
                  </xsl:when>
                  <xsl:when test="$iFirstOper &lt; $iFirstNum">
                    <xsl:value-of select="$iFirstOper - 1" />
                  </xsl:when>
                  <xsl:otherwise>
                    <xsl:value-of select="$iFirstNum - 1" />
                  </xsl:otherwise>
                </xsl:choose>
              </xsl:when>
              <xsl:otherwise>1</xsl:otherwise>
            </xsl:choose>
          </xsl:variable>

          <mml:mi>
            <xsl:call-template name="CreateTokenAttributes">
              <xsl:with-param name="scr" select="$scr" />
              <xsl:with-param name="sty" select="$sty" />
              <xsl:with-param name="nor" select="$nor" />
              <xsl:with-param name="nCharToPrint" select="$nCharToPrint" />
              <xsl:with-param name="sTokenType" select="'mi'" />
            </xsl:call-template>
            <xsl:variable name="sWrite" select="translate(substring($sToParse, 1, $nCharToPrint), ' ', '&#xa0;')" />
            <xsl:value-of select="$sWrite" />
          </mml:mi>
          <xsl:call-template name="ParseMt">
            <xsl:with-param name="sToParse" select="substring($sToParse, $nCharToPrint+1)" />
            <xsl:with-param name="scr" select="$scr" />
            <xsl:with-param name="sty" select="$sty" />
            <xsl:with-param name="nor" select="$nor" />
          </xsl:call-template>
        </xsl:when>

        <!-- Case II: There is an operator at position 1 -->
        <xsl:when test="$fOperAtPos1='1'">
          <mml:mo>
            <xsl:call-template name="CreateTokenAttributes">
              <xsl:with-param name="scr" />
              <xsl:with-param name="sty" />
              <xsl:with-param name="nor" select="$nor" />
              <xsl:with-param name="sTokenType" select="'mo'" />
            </xsl:call-template>
            <xsl:value-of select="substring($sToParse,1,1)" />
          </mml:mo>
          <xsl:call-template name="ParseMt">
            <xsl:with-param name="sToParse" select="substring($sToParse, 2)" />
            <xsl:with-param name="scr" select="$scr" />
            <xsl:with-param name="sty" select="$sty" />
            <xsl:with-param name="nor" select="$nor" />
          </xsl:call-template>
        </xsl:when>

        <!-- Case III: There is a number at position 1 -->
        <xsl:otherwise>
          <xsl:variable name="sConsecNum">
            <xsl:call-template name="SNumStart">
              <xsl:with-param name="sToParse" select="$sToParse" />
              <xsl:with-param name="sPattern" select="$sRepNumWith0" />
            </xsl:call-template>
          </xsl:variable>
          <mml:mn>
            <xsl:call-template name="CreateTokenAttributes">
              <xsl:with-param name="scr" select="$scr" />
              <xsl:with-param name="sty" select="'p'" />
              <xsl:with-param name="nor" select="$nor" />
              <xsl:with-param name="sTokenType" select="'mn'" />
            </xsl:call-template>
            <xsl:value-of select="$sConsecNum" />
          </mml:mn>
          <xsl:call-template name="ParseMt">
            <xsl:with-param name="sToParse" select="substring-after($sToParse, $sConsecNum)" />
            <xsl:with-param name="scr" select="$scr" />
            <xsl:with-param name="sty" select="$sty" />
            <xsl:with-param name="nor" select="$nor" />
          </xsl:call-template>
        </xsl:otherwise>
      </xsl:choose>
    </xsl:if>
  </xsl:template>

  <!-- %%Template: SNumStart

		Return the longest substring of sToParse starting from the
		start of sToParse that is a number. In addition, it takes the
		pattern string, which is sToParse with all of its numbers
		replaced with a 0. sPattern should be the same length
		as sToParse
	-->
  <xsl:template name="SNumStart">
    <xsl:param name="sToParse" select="''" />
    <!-- if we don't get anything, take the string itself -->
    <xsl:param name="sPattern" select="'$sToParse'" />


    <xsl:choose>
      <!-- the pattern says this is a number, recurse with the rest -->
      <xsl:when test="substring($sPattern, 1, 1) = '0'">
        <xsl:call-template name="SNumStart">
          <xsl:with-param name="sToParse" select="$sToParse" />
          <xsl:with-param name="sPattern" select="substring($sPattern, 2)" />
        </xsl:call-template>
      </xsl:when>

      <!-- the pattern says we've run out of numbers. Take as many
				characters from sToParse as we shaved off sPattern -->
      <xsl:otherwise>
        <xsl:value-of select="substring($sToParse, 1, string-length($sToParse) - string-length($sPattern))" />
      </xsl:otherwise>
    </xsl:choose>
  </xsl:template>

  <!-- %%Template SRepeatCharAcc

			The core of SRepeatChar with an accumulator. The current
			string is in param $acc, and we will double and recurse,
			if we're less than half of the required length or else just
			add the right amount of characters to the accumulator and
			return
	-->
  <xsl:template name="SRepeatCharAcc">
    <xsl:param name="cchRequired" select="1" />
    <xsl:param name="ch" select="'-'" />
    <xsl:param name="acc" select="$ch" />

    <xsl:variable name="cchAcc" select="string-length($acc)" />
    <xsl:choose>
      <xsl:when test="(2 * $cchAcc) &lt; $cchRequired">
        <xsl:call-template name="SRepeatCharAcc">
          <xsl:with-param name="cchRequired" select="$cchRequired" />
          <xsl:with-param name="ch" select="$ch" />
          <xsl:with-param name="acc" select="concat($acc, $acc)" />
        </xsl:call-template>
      </xsl:when>

      <xsl:otherwise>
        <xsl:value-of select="concat($acc, substring($acc, 1, $cchRequired - $cchAcc))" />
      </xsl:otherwise>
    </xsl:choose>
  </xsl:template>


  <!-- %%Template SRepeatChar

			Generates a string nchRequired long by repeating the given character ch
	-->
  <xsl:template name="SRepeatChar">
    <xsl:param name="cchRequired" select="1" />
    <xsl:param name="ch" select="'-'" />

    <xsl:call-template name="SRepeatCharAcc">
      <xsl:with-param name="cchRequired" select="$cchRequired" />
      <xsl:with-param name="ch" select="$ch" />
      <xsl:with-param name="acc" select="$ch" />
    </xsl:call-template>
  </xsl:template>

  <!-- %%Template SReplaceOperWithMinus

		Go through the given string and replace every instance
		of an operator with a minus '-'. This helps quickly identify
		the first instance of an operator.
	-->
  <xsl:template name="SReplaceOperWithMinus">
    <xsl:param name="sToParse" select="''" />

    <xsl:value-of select="translate($sToParse, $sOperators, $sMinuses)" />
  </xsl:template>

  <!-- %%Template SReplaceNumWithZero

		Go through the given string and replace every instance
		of an number with a zero '0'. This helps quickly identify
		the first occurence of a number.

		Considers the '.' and ',' part of a number iff they are sandwiched
		between two other numbers. 0.3 will be recognized as a number,
		x.3 will not be. Since these characters can also be an operator, this
		should be called before SReplaceOperWithMinus.
	-->
  <xsl:template name="SReplaceNumWithZero">
    <xsl:param name="sToParse" select="''" />

    <!-- First do a simple replace. Numbers will all be come 0's.
			After this point, the pattern involving the . or , that
			we are looking for will become 0.0 or 0,0 -->
    <xsl:variable name="sSimpleReplace" select="translate($sToParse, $sNumbers, $sZeros)" />

    <!-- And then, replace 0.0 with just 000. This means that the . will
			become part of the number -->
    <xsl:variable name="sReplacePeriod">
      <xsl:call-template name="SReplace">
        <xsl:with-param name="sInput" select="$sSimpleReplace" />
        <xsl:with-param name="sOrig" select="'0.0'" />
        <xsl:with-param name="sReplacement" select="'000'" />
      </xsl:call-template>
    </xsl:variable>

    <!-- And then, replace 0,0 with just 000. This means that the , will
			become part of the number -->
    <xsl:call-template name="SReplace">
      <xsl:with-param name="sInput" select="$sReplacePeriod" />
      <xsl:with-param name="sOrig" select="'0,0'" />
      <xsl:with-param name="sReplacement" select="'000'" />
    </xsl:call-template>
  </xsl:template>

  <!-- Template to translate Word's borderBox properties into the menclose notation attribute
       The initial call to this SHOULD NOT pass an sAttribute.  Subsequent calls to
       CreateMencloseNotationAttrFromBorderBoxAttr by CreateMencloseNotationAttrFromBorderBoxAttr will
       update the sAttribute as appropriate.

       CreateMencloseNotationAttrFromBorderBoxAttr looks at each attribute (fHideTop, fHideBot, etc.) one at a time
       in the order they are listed and passes a modified sAttribute to CreateMencloseNotationAttrFromBorderBoxAttr.
       Each successive call to CreateMencloseNotationAttrFromBorderBoxAttr knows which attribute to look at because
       the previous call should have omitted passing the attribute it just analyzed.  This is why as you read lower
       and lower in the template that each call to CreateMencloseNotationAttrFromBorderBoxAttr has fewer and fewer attributes.
       -->
  <xsl:template name="CreateMencloseNotationAttrFromBorderBoxAttr">
    <xsl:param name="fHideTop" />
    <xsl:param name="fHideBot" />
    <xsl:param name="fHideLeft" />
    <xsl:param name="fHideRight" />
    <xsl:param name="fStrikeH" />
    <xsl:param name="fStrikeV" />
    <xsl:param name="fStrikeBLTR" />
    <xsl:param name="fStrikeTLBR" />
    <xsl:param name="sAttribute" />

    <xsl:choose>
      <xsl:when test="string-length($sAttribute) = 0">
        <xsl:choose>
          <xsl:when test="string-length($fHideTop) &gt; 0
                      and string-length($fHideBot) &gt; 0
                      and string-length($fHideLeft) &gt; 0
                      and string-length($fHideRight) &gt; 0">

            <xsl:choose>
              <xsl:when test="$fHideTop = 0
                              and $fHideBot = 0
                              and $fHideLeft = 0
                              and $fHideRight = 0">
                <!-- We can use 'box' instead of top, bot, left, and right.  Therefore,
                  replace sAttribute with 'box' and begin analyzing params fStrikeH
                  and below. -->
                <xsl:call-template name="CreateMencloseNotationAttrFromBorderBoxAttr">
                  <xsl:with-param name="fStrikeH" select="$fStrikeH" />
                  <xsl:with-param name="fStrikeV" select="$fStrikeV" />
                  <xsl:with-param name="fStrikeBLTR" select="$fStrikeBLTR" />
                  <xsl:with-param name="fStrikeTLBR" select="$fStrikeTLBR" />
                  <xsl:with-param name="sAttribute">
                    <xsl:text>box</xsl:text>
                  </xsl:with-param>
                </xsl:call-template>
              </xsl:when>
              <xsl:otherwise>
                <!-- Can't use 'box', theremore, must analyze all attributes -->
                <xsl:call-template name="CreateMencloseNotationAttrFromBorderBoxAttr">
                  <xsl:with-param name="fHideTop" select="$fHideTop" />
                  <xsl:with-param name="fHideBot" select="$fHideBot" />
                  <xsl:with-param name="fHideLeft" select="$fHideLeft" />
                  <xsl:with-param name="fHideRight" select="$fHideRight" />
                  <xsl:with-param name="fStrikeH" select="$fStrikeH" />
                  <xsl:with-param name="fStrikeV" select="$fStrikeV" />
                  <xsl:with-param name="fStrikeBLTR" select="$fStrikeBLTR" />
                  <xsl:with-param name="fStrikeTLBR" select="$fStrikeTLBR" />
                  <xsl:with-param name="sAttribute">
                    <!-- Assume using all four (left right top bottom).  Subsequent calls
                         will remove the sides which aren't to be includes. -->
                    <xsl:text>left right top bottom</xsl:text>
                  </xsl:with-param>
                </xsl:call-template>
              </xsl:otherwise>
            </xsl:choose>
          </xsl:when>
        </xsl:choose>
      </xsl:when>
      <xsl:otherwise>
        <xsl:choose>
          <xsl:when test="string-length($fHideTop) &gt; 0">
            <xsl:choose>
              <xsl:when test="$fHideTop=1">
                <xsl:call-template name="CreateMencloseNotationAttrFromBorderBoxAttr">
                  <xsl:with-param name="fHideBot" select="$fHideBot" />
                  <xsl:with-param name="fHideLeft" select="$fHideLeft" />
                  <xsl:with-param name="fHideRight" select="$fHideRight" />
                  <xsl:with-param name="fStrikeH" select="$fStrikeH" />
                  <xsl:with-param name="fStrikeV" select="$fStrikeV" />
                  <xsl:with-param name="fStrikeBLTR" select="$fStrikeBLTR" />
                  <xsl:with-param name="fStrikeTLBR" select="$fStrikeTLBR" />
                  <xsl:with-param name="sAttribute">
                    <xsl:call-template name="SReplace">
                      <xsl:with-param name="sInput" select="$sAttribute" />
                      <xsl:with-param name="sOrig" select="'top'" />
                      <xsl:with-param name="sReplacement" select="''" />
                    </xsl:call-template>
                  </xsl:with-param>
                </xsl:call-template>
              </xsl:when>
              <xsl:otherwise>
                <xsl:call-template name="CreateMencloseNotationAttrFromBorderBoxAttr">
                  <xsl:with-param name="fHideBot" select="$fHideBot" />
                  <xsl:with-param name="fHideLeft" select="$fHideLeft" />
                  <xsl:with-param name="fHideRight" select="$fHideRight" />
                  <xsl:with-param name="fStrikeH" select="$fStrikeH" />
                  <xsl:with-param name="fStrikeV" select="$fStrikeV" />
                  <xsl:with-param name="fStrikeBLTR" select="$fStrikeBLTR" />
                  <xsl:with-param name="fStrikeTLBR" select="$fStrikeTLBR" />
                  <xsl:with-param name="sAttribute" select="$sAttribute" />
                </xsl:call-template>
              </xsl:otherwise>
            </xsl:choose>
          </xsl:when>
          <xsl:when test="string-length($fHideBot) &gt; 0">
            <xsl:choose>
              <xsl:when test="$fHideBot=1">
                <xsl:call-template name="CreateMencloseNotationAttrFromBorderBoxAttr">
                  <xsl:with-param name="fHideLeft" select="$fHideLeft" />
                  <xsl:with-param name="fHideRight" select="$fHideRight" />
                  <xsl:with-param name="fStrikeH" select="$fStrikeH" />
                  <xsl:with-param name="fStrikeV" select="$fStrikeV" />
                  <xsl:with-param name="fStrikeBLTR" select="$fStrikeBLTR" />
                  <xsl:with-param name="fStrikeTLBR" select="$fStrikeTLBR" />
                  <xsl:with-param name="sAttribute">
                    <xsl:call-template name="SReplace">
                      <xsl:with-param name="sInput" select="$sAttribute" />
                      <xsl:with-param name="sOrig" select="'bottom'" />
                      <xsl:with-param name="sReplacement" select="''" />
                    </xsl:call-template>
                  </xsl:with-param>
                </xsl:call-template>
              </xsl:when>
              <xsl:otherwise>
                <xsl:call-template name="CreateMencloseNotationAttrFromBorderBoxAttr">
                  <xsl:with-param name="fHideLeft" select="$fHideLeft" />
                  <xsl:with-param name="fHideRight" select="$fHideRight" />
                  <xsl:with-param name="fStrikeH" select="$fStrikeH" />
                  <xsl:with-param name="fStrikeV" select="$fStrikeV" />
                  <xsl:with-param name="fStrikeBLTR" select="$fStrikeBLTR" />
                  <xsl:with-param name="fStrikeTLBR" select="$fStrikeTLBR" />
                  <xsl:with-param name="sAttribute" select="$sAttribute" />
                </xsl:call-template>
              </xsl:otherwise>
            </xsl:choose>
          </xsl:when>
          <xsl:when test="string-length($fHideLeft) &gt; 0">
            <xsl:choose>
              <xsl:when test="$fHideLeft=1">
                <xsl:call-template name="CreateMencloseNotationAttrFromBorderBoxAttr">
                  <xsl:with-param name="fHideRight" select="$fHideRight" />
                  <xsl:with-param name="fStrikeH" select="$fStrikeH" />
                  <xsl:with-param name="fStrikeV" select="$fStrikeV" />
                  <xsl:with-param name="fStrikeBLTR" select="$fStrikeBLTR" />
                  <xsl:with-param name="fStrikeTLBR" select="$fStrikeTLBR" />
                  <xsl:with-param name="sAttribute">
                    <xsl:call-template name="SReplace">
                      <xsl:with-param name="sInput" select="$sAttribute" />
                      <xsl:with-param name="sOrig" select="'left'" />
                      <xsl:with-param name="sReplacement" select="''" />
                    </xsl:call-template>
                  </xsl:with-param>
                </xsl:call-template>
              </xsl:when>
              <xsl:otherwise>
                <xsl:call-template name="CreateMencloseNotationAttrFromBorderBoxAttr">
                  <xsl:with-param name="fHideRight" select="$fHideRight" />
                  <xsl:with-param name="fStrikeH" select="$fStrikeH" />
                  <xsl:with-param name="fStrikeV" select="$fStrikeV" />
                  <xsl:with-param name="fStrikeBLTR" select="$fStrikeBLTR" />
                  <xsl:with-param name="fStrikeTLBR" select="$fStrikeTLBR" />
                  <xsl:with-param name="sAttribute" select="$sAttribute" />
                </xsl:call-template>
              </xsl:otherwise>
            </xsl:choose>
          </xsl:when>
          <xsl:when test="string-length($fHideRight) &gt; 0">
            <xsl:choose>
              <xsl:when test="$fHideRight=1">
                <xsl:call-template name="CreateMencloseNotationAttrFromBorderBoxAttr">
                  <xsl:with-param name="fStrikeH" select="$fStrikeH" />
                  <xsl:with-param name="fStrikeV" select="$fStrikeV" />
                  <xsl:with-param name="fStrikeBLTR" select="$fStrikeBLTR" />
                  <xsl:with-param name="fStrikeTLBR" select="$fStrikeTLBR" />
                  <xsl:with-param name="sAttribute">
                    <xsl:call-template name="SReplace">
                      <xsl:with-param name="sInput" select="$sAttribute" />
                      <xsl:with-param name="sOrig" select="'right'" />
                      <xsl:with-param name="sReplacement" select="''" />
                    </xsl:call-template>
                  </xsl:with-param>
                </xsl:call-template>
              </xsl:when>
              <xsl:otherwise>
                <xsl:call-template name="CreateMencloseNotationAttrFromBorderBoxAttr">
                  <xsl:with-param name="fStrikeH" select="$fStrikeH" />
                  <xsl:with-param name="fStrikeV" select="$fStrikeV" />
                  <xsl:with-param name="fStrikeBLTR" select="$fStrikeBLTR" />
                  <xsl:with-param name="fStrikeTLBR" select="$fStrikeTLBR" />
                  <xsl:with-param name="sAttribute" select="$sAttribute" />
                </xsl:call-template>
              </xsl:otherwise>
            </xsl:choose>
          </xsl:when>
          <xsl:when test="string-length($fStrikeH) &gt; 0">
            <xsl:choose>
              <xsl:when test="$fStrikeH=1">
                <xsl:call-template name="CreateMencloseNotationAttrFromBorderBoxAttr">
                  <xsl:with-param name="fStrikeV" select="$fStrikeV" />
                  <xsl:with-param name="fStrikeBLTR" select="$fStrikeBLTR" />
                  <xsl:with-param name="fStrikeTLBR" select="$fStrikeTLBR" />
                  <xsl:with-param name="sAttribute" select="concat($sAttribute, ' horizontalstrike')" />
                </xsl:call-template>
              </xsl:when>
              <xsl:otherwise>
                <xsl:call-template name="CreateMencloseNotationAttrFromBorderBoxAttr">
                  <xsl:with-param name="fStrikeV" select="$fStrikeV" />
                  <xsl:with-param name="fStrikeBLTR" select="$fStrikeBLTR" />
                  <xsl:with-param name="fStrikeTLBR" select="$fStrikeTLBR" />
                  <xsl:with-param name="sAttribute" select="$sAttribute" />
                </xsl:call-template>
              </xsl:otherwise>
            </xsl:choose>
          </xsl:when>
          <xsl:when test="string-length($fStrikeV) &gt; 0">
            <xsl:choose>
              <xsl:when test="$fStrikeV=1">
                <xsl:call-template name="CreateMencloseNotationAttrFromBorderBoxAttr">
                  <xsl:with-param name="fStrikeBLTR" select="$fStrikeBLTR" />
                  <xsl:with-param name="fStrikeTLBR" select="$fStrikeTLBR" />
                  <xsl:with-param name="sAttribute" select="concat($sAttribute, ' verticalstrike')" />
                </xsl:call-template>
              </xsl:when>
              <xsl:otherwise>
                <xsl:call-template name="CreateMencloseNotationAttrFromBorderBoxAttr">
                  <xsl:with-param name="fStrikeBLTR" select="$fStrikeBLTR" />
                  <xsl:with-param name="fStrikeTLBR" select="$fStrikeTLBR" />
                  <xsl:with-param name="sAttribute" select="$sAttribute" />
                </xsl:call-template>
              </xsl:otherwise>
            </xsl:choose>
          </xsl:when>
          <xsl:when test="string-length($fStrikeBLTR) &gt; 0">
            <xsl:choose>
              <xsl:when test="$fStrikeBLTR=1">
                <xsl:call-template name="CreateMencloseNotationAttrFromBorderBoxAttr">
                  <xsl:with-param name="fStrikeTLBR" select="$fStrikeTLBR" />
                  <xsl:with-param name="sAttribute" select="concat($sAttribute, ' updiagonalstrike')" />
                </xsl:call-template>
              </xsl:when>
              <xsl:otherwise>
                <xsl:call-template name="CreateMencloseNotationAttrFromBorderBoxAttr">
                  <xsl:with-param name="fStrikeTLBR" select="$fStrikeTLBR" />
                  <xsl:with-param name="sAttribute" select="$sAttribute" />
                </xsl:call-template>
              </xsl:otherwise>
            </xsl:choose>
          </xsl:when>
          <xsl:when test="string-length($fStrikeTLBR) &gt; 0">
            <xsl:choose>
              <xsl:when test="$fStrikeTLBR=1">
                <xsl:call-template name="CreateMencloseNotationAttrFromBorderBoxAttr">
                  <xsl:with-param name="sAttribute" select="concat($sAttribute, ' downdiagonalstrike')" />
                </xsl:call-template>
              </xsl:when>
              <xsl:otherwise>
                <xsl:call-template name="CreateMencloseNotationAttrFromBorderBoxAttr">
                  <xsl:with-param name="sAttribute" select="$sAttribute" />
                </xsl:call-template>
              </xsl:otherwise>
            </xsl:choose>
          </xsl:when>
          <xsl:otherwise>
            <xsl:attribute name="notation">
              <xsl:value-of select="normalize-space($sAttribute)" />
            </xsl:attribute>
          </xsl:otherwise>
        </xsl:choose>
      </xsl:otherwise>
    </xsl:choose>
  </xsl:template>

  <!-- Tristate (true, false, neither) from string value -->
  <xsl:template name="TFromStrVal">
    <xsl:param name="str" />
    <xsl:choose>
      <xsl:when test="$str = 'on' or $str = '1' or $str = 'true'">1</xsl:when>
      <xsl:when test="$str = 'off' or $str = '0' or $str = 'false'">0</xsl:when>
      <xsl:otherwise>-1</xsl:otherwise>
    </xsl:choose>
  </xsl:template>

  <!-- Return 0 iff $str is explicitly set to a false value.
       Return true otherwise -->
  <xsl:template name="ForceFalseStrVal">
    <xsl:param name="str" />
    <xsl:variable name="tValue">
      <xsl:call-template name="TFromStrVal">
        <xsl:with-param name="str" select="$str"/>
      </xsl:call-template>
    </xsl:variable>
    <xsl:choose>
      <xsl:when test="$tValue = '0'">0</xsl:when>
      <xsl:otherwise>1</xsl:otherwise>
    </xsl:choose>
  </xsl:template>

  <!-- Return 1 iff $str is explicitly set to a true value.
       Return false otherwise -->
  <xsl:template name="ForceTrueStrVal">
    <xsl:param name="str" />
    <xsl:variable name="tValue">
      <xsl:call-template name="TFromStrVal">
        <xsl:with-param name="str" select="$str"/>
      </xsl:call-template>
    </xsl:variable>
    <xsl:choose>
      <xsl:when test="$tValue = '1'">1</xsl:when>
      <xsl:otherwise>0</xsl:otherwise>
    </xsl:choose>
  </xsl:template>
</xsl:stylesheet>
`.trim());function Ms(e){var t=new XSLTProcessor;t.importStylesheet(Ps);var n=t.transformToFragment(e,document);return n}function Es(e,t){return Ms(t.element)}function Lt(e,t,n,a){var r,s;n===void 0&&(n=!0),a===void 0&&(a=!1),e.currentParagraph=t;var x=I("p");e.addClass(x,"p");var o=t.properties;kt(e,x,o),x.style.position="relative",o.numPr&&j(x,Ss(x,e,o.numPr));var l=!1;try{for(var y=g(t.children),p=y.next();!p.done;p=y.next()){var f=p.value;if(f instanceof pt)f.fldChar==="begin"?l=!0:f&&(l=!1),j(x,Ft(e,f,t,l,a));else if(f instanceof Kt)j(x,Sn(e,f));else if(f instanceof Qt){var i=Fn(e,f,t);j(x,i)}else f instanceof Bn?j(x,Es(e,f)):console.warn("unknow pargraph type",f)}}catch(c){r={error:c}}finally{try{p&&!p.done&&(s=y.return)&&s.call(y)}finally{if(r)throw r.error}}return x.innerHTML===""&&n&&(x.innerHTML="&nbsp;"),x}function Ht(e,t){var n,a,r=I("div");try{for(var s=g(t.children),x=s.next();!x.done;x=s.next()){var o=x.value;if(o instanceof nt){var l=Lt(e,o,!0,!0);j(r,l)}else if(o instanceof wt){var y=Rt(e,o);j(r,y)}else console.warn("unknown child",o)}}catch(p){n={error:p}}finally{try{x&&!x.done&&(a=s.return)&&a.call(s)}finally{if(n)throw n.error}}return r}function $n(e,t,n,a){var r=I("section");r.style.position="relative",t.backgroundColor&&(r.style.background=t.backgroundColor),a.page&&(a.pageMarginBottom&&(r.style.marginBottom=a.pageMarginBottom+"px"),a.pageShadow&&(r.style.boxShadow="0 0 8px rgba(0, 0, 0, 0.5)"),a.pageBackground&&(r.style.background=a.pageBackground));var s=n.properties,x=s.pageSize;if(x&&(a.ignoreWidth||(r.style.width=x.width),a.ignoreHeight||(r.style.height=x.height)),a.padding)r.style.padding=a.padding;else{var o=s.pageMargin;o&&(r.style.paddingLeft=o.left||"0",r.style.paddingRight=o.right||"0",r.style.paddingTop=o.top||"0",r.style.paddingBottom=o.bottom||"0")}s.cols&&s.cols.num&&s.cols.num>1&&(r.style.columnCount=""+s.cols.num,s.cols.space&&(r.style.columnGap=s.cols.space)),e.currentPage++;var l="auto";if(s.pageSize&&s.pageSize.width&&(l=s.pageSize.width),s.headers&&a.page&&a.renderHeader){var y=s.headers,p=null;if(y.even&&e.currentPage%2===0?p=Ht(e,y.even):y.default?p=Ht(e,y.default):console.warn("can not find header",e.currentPage,s.headers),p){p.style.position="absolute";var o=s.pageMargin;o&&o.header&&(p.style.top=o.header,p.style.width=l),r.appendChild(p)}}if(s.footers&&a.page&&a.renderFooter){var f=s.footers,i=null;if(f.even&&e.currentPage%2===0?i=Ht(e,f.even):f.default?i=Ht(e,f.default):console.warn("can not find footer",e.currentPage,s.footers),i){i.style.position="absolute";var o=s.pageMargin;o&&o.footer&&(i.style.bottom=o.footer,i.style.width=l),r.appendChild(i)}}return r}function Is(e,t,n){if(e.breakPage)return e.breakPage=!1,!0;var a=n.getBoundingClientRect();return a.top+a.height>t.bottom||a.left>t.right}function Ke(e,t,n,a,r,s,x,o){var l=r.children.length===0;if(j(r,o),!l&&Is(e,s,o)){var y=o.cloneNode(!0);ts(r,o);var p=$n(e,t,x,n);return j(a,p),j(p,y),s=Pn(x,p),{sectionEl:p,sectionEnd:s}}return{sectionEl:r,sectionEnd:s}}function Pn(e,t){var n=t.getBoundingClientRect(),a=e.properties.pageMargin,r=n.top+n.height;a!=null&&a.bottom&&(r=r-parseInt(a.bottom.replace("px",""),10));var s=n.left+n.width;return a!=null&&a.right&&(s=s-parseInt(a.right.replace("px",""),10)),{bottom:r,right:s}}function Hs(e,t,n){var a=t.properties,r=a.pageSize;if(n.zoomFitWidth&&!n.ignoreWidth){var s=r==null?void 0:r.width;if(e&&s){var x=parseInt(s.replace("px",""),10);if(a.pageMargin){var o=a.pageMargin;x+=o.left?parseInt(o.left.replace("px",""),10):0,x+=o.right?parseInt(o.right.replace("px",""),10):0}var l=e/x;return l}}return 1}function Ns(e,t,n,a,r,s,x){setTimeout(function(){var o,l,y=Pn(s,r);try{for(var p=g(s.children),f=p.next();!f.done;f=p.next()){var i=f.value;if(i instanceof nt){var c=Lt(e,i),d=Ke(e,t,a,n,r,y,s,c);r=d.sectionEl,y=d.sectionEnd}else if(i instanceof wt){var h=Rt(e,i),d=Ke(e,t,a,n,r,y,s,h);r=d.sectionEl,y=d.sectionEnd}else console.warn("unknown child",i)}}catch(m){o={error:m}}finally{try{f&&!f.done&&(l=p.return)&&l.call(p)}finally{if(o)throw o.error}}x&&(r.style.marginBottom="0")},0)}function zs(e,t,n,a,r,s){var x,o,l,y,p=s.page||!1,f=e.getBoundingClientRect().width-(s.pageWrapPadding||0)*2,i=[],c=0,d=r.sections,h=d.length,m=!1;try{for(var v=g(d),A=v.next();!A.done;A=v.next()){var T=A.value;i.push(Hs(f,T,s)),t.currentSection=T;var L=$n(t,a,T,s);if(j(n,L),c=c+1,c===h&&(m=!0),p)Ns(t,a,n,s,L,T,m);else try{for(var b=(l=void 0,g(T.children)),k=b.next();!k.done;k=b.next()){var u=k.value;if(u instanceof nt){var w=Lt(t,u);j(L,w)}else if(u instanceof wt){var S=Rt(t,u);j(L,S)}else console.warn("unknown child",u)}}catch(B){l={error:B}}finally{try{k&&!k.done&&(y=b.return)&&y.call(b)}finally{if(l)throw l.error}}}}catch(B){x={error:B}}finally{try{A&&!A.done&&(o=v.return)&&o.call(v)}finally{if(x)throw x.error}}setTimeout(function(){if(s.zoom)n.style.transformOrigin="0 0",n.style.transform="scale(".concat(s.zoom,")");else if(s.page&&s.zoomFitWidth&&!s.ignoreWidth){var B=Math.min.apply(Math,zt([],Gt(i),!1));n.style.transformOrigin="0 0",n.style.transform="scale(".concat(B,")")}},0)}function Gs(e,t,n,a){var r=I("article");return zs(e,t,r,n,n.body,a),r}function Vs(e,t){t===void 0&&(t="file.txt");var n=URL.createObjectURL(e),a=document.createElement("a");a.href=n,a.download=t,document.body.appendChild(a),a.dispatchEvent(new MouseEvent("click",{bubbles:!0,cancelable:!0,view:window})),document.body.removeChild(a)}var Mn=function(){function e(){this.start=1,this.lvlText="%1.",this.isLgl=!1,this.lvlJc="start",this.suff="space"}return e.fromXML=function(t,n){var a,r,s=new e;s.ilvl=n.getAttribute("w:ilvl");try{for(var x=g(n.children),o=x.next();!o.done;o=x.next()){var l=o.value,y=l.tagName;switch(y){case"w:start":s.start=At(l);break;case"w:numFmt":s.numFmt=F(l);break;case"w:lvlText":s.lvlText=F(l);break;case"w:lvlJc":s.lvlJc=F(l);break;case"w:legacy":break;case"w:pPr":s.pPr=nt.parseParagraphPr(t,l);break;case"w:rPr":s.rPr=pt.parseRunPr(t,l);break;case"w:isLgl":s.isLgl=_(l);break;case"w:pStyle":break;default:console.warn("Lvl: Unknown tag ",y,l)}}}catch(p){a={error:p}}finally{try{o&&!o.done&&(r=x.return)&&r.call(x)}finally{if(a)throw a.error}}return s},e}(),Ws=function(){function e(){this.lvls={}}return e.fromXML=function(t,n){var a,r,s=new e;s.abstractNumId=n.getAttribute("w:abstractNumId")||"",s.multiLevelType=n.getAttribute("w:multiLevelType");var x=n.getElementsByTagName("w:lvl");try{for(var o=g(x),l=o.next();!l.done;l=o.next()){var y=l.value,p=y.getAttribute("w:ilvl")||"";s.lvls[p]=Mn.fromXML(t,y)}}catch(i){a={error:i}}finally{try{l&&!l.done&&(r=o.return)&&r.call(o)}finally{if(a)throw a.error}}var f=n.getElementsByTagName("w:multiLevelType").item(0);return f&&(s.multiLevelType=F(f)),s},e}(),Xs=function(){function e(){this.lvlOverride={lvls:{}}}return e.fromXML=function(t,n){var a,r,s=new e;s.numId=n.getAttribute("w:numId")||"";var x=n.getElementsByTagName("w:abstractNumId").item(0);x&&(s.abstractNumId=F(x));var o=n.getElementsByTagName("w:lvlOverride").item(0);if(o)try{for(var l=g(o.children),y=l.next();!y.done;y=l.next()){var p=y.value,f=p.tagName;switch(f){case"w:lvl":var i=p.getAttribute("w:lvlId")||"";s.lvlOverride.lvls[i]=Mn.fromXML(t,p);break;case"w:startOverride":var c=p.getAttribute("w:lvlId")||"";s.lvlOverride.lvls[c]&&(s.lvlOverride.lvls[c].start=At(p));break;default:console.warn("Num: Unknown tag ",f,p)}}}catch(d){a={error:d}}finally{try{y&&!y.done&&(r=l.return)&&r.call(l)}finally{if(a)throw a.error}}return s},e}(),Us=function(){function e(){this.abstractNums={},this.nums={},this.numData={}}return e.fromXML=function(t,n){var a,r,s,x,o=new e;try{for(var l=g(n.getElementsByTagName("w:abstractNum")),y=l.next();!y.done;y=l.next()){var p=y.value,f=Ws.fromXML(t,p);o.abstractNums[f.abstractNumId]=f}}catch(m){a={error:m}}finally{try{y&&!y.done&&(r=l.return)&&r.call(l)}finally{if(a)throw a.error}}try{for(var i=g(n.getElementsByTagName("w:num")),c=i.next();!c.done;c=i.next()){var d=c.value,h=Xs.fromXML(t,d);o.nums[h.numId]=h,o.numData[h.numId]={}}}catch(m){s={error:m}}finally{try{c&&!c.done&&(x=i.return)&&x.call(i)}finally{if(s)throw s.error}}return o},e}();function Zs(e,t,n){var a=t?Xt(e,t):{},r=n?Xt(e,n):{};return JSON.stringify(a)===JSON.stringify(r)}function Js(e,t){var n=e.getElementsByTagName("w:t")[0],a=t.getElementsByTagName("w:t")[0];if(n&&a){var r=a.textContent||"";n.textContent+=r||""}}function Ks(e){var t,n,a=e.tagName,r=e.children,s=!1,x=!1;try{for(var o=g(r),l=o.next();!l.done;l=o.next()){var y=l.value;if(y.tagName==="w:t"){s=!0,x=y.getAttribute("xml:space")==="preserve";break}}}catch(p){t={error:p}}finally{try{l&&!l.done&&(n=o.return)&&n.call(o)}finally{if(t)throw t.error}}return a==="w:r"&&s&&!x}function Ys(e,t){var n,a,r,s,x=[],o=null;try{for(var l=g(t.children),y=l.next();!y.done;y=l.next()){var p=y.value,f=p.tagName;if(Ks(p))if(o){var i=o.getElementsByTagName("w:rPr")[0],c=p.getElementsByTagName("w:rPr")[0];Zs(e,i,c)?Js(o,p):(o=p,x.push(p))}else o=p,x.push(p);else f!=="w:proofErr"&&(o=null,x.push(p))}}catch(v){n={error:v}}finally{try{y&&!y.done&&(a=l.return)&&a.call(l)}finally{if(n)throw n.error}}t.innerHTML="";try{for(var d=g(x),h=d.next();!h.done;h=d.next()){var m=h.value;t.appendChild(m)}}catch(v){r={error:v}}finally{try{h&&!h.done&&(s=d.return)&&s.call(d)}finally{if(r)throw r.error}}}function Ye(e,t){var n,a,r=t.getElementsByTagName("w:p");try{for(var s=g(r),x=s.next();!x.done;x=s.next()){var o=x.value;Ys(e,o)}}catch(l){n={error:l}}finally{try{x&&!x.done&&(a=s.return)&&a.call(s)}finally{if(n)throw n.error}}}var Qs=function(){function e(){this.children=[]}return e.fromXML=function(t,n){var a,r,s=new e,x=[];s.children=x;var o=n,l=n.firstElementChild;l&&(l.tagName==="w:hdr"||l.tagName==="w:ftr")&&(o=l);try{for(var y=g(qt(o)),p=y.next();!p.done;p=y.next()){var f=p.value,i=f.tagName;switch(i){case"w:p":var c=nt.fromXML(t,f);x.push(c);break;case"w:tbl":var d=$t(t,f);x.push(d);break;default:console.warn("Header.fromXML Unknown key",i,f)}}}catch(h){a={error:h}}finally{try{p&&!p.done&&(r=y.return)&&r.call(y)}finally{if(a)throw a.error}}return s},e}();function Qe(e,t,n){var a=t.getAttribute("w:type"),r=t.getAttribute("r:id");if(a&&r){var s=e.getDocumentRels(r);if(s){var x=e.getXML("/word/"+s.target);if(x){var o=Qs.fromXML(e,x);return{headerType:a,header:o}}}}return null}var ie=function(){function e(){this.properties={},this.children=[]}return e.prototype.addChild=function(t){this.children.push(t)},e.parsePr=function(t,n,a){var r,s,x={};x.headers={},x.footers={};try{for(var o=g(n.children),l=o.next();!l.done;l=o.next()){var y=l.value,p=y.tagName;switch(p){case"w:pgSz":x.pageSize={width:R(y,"w:w"),height:R(y,"w:h")};break;case"w:pgMar":x.pageMargin={left:R(y,"w:left"),right:R(y,"w:right"),top:R(y,"w:top"),bottom:R(y,"w:bottom"),header:R(y,"w:header"),footer:R(y,"w:footer"),gutter:R(y,"w:gutter")};break;case"w:headerReference":var f=Qe(t,y,"header");f&&(x.headers[f.headerType]=f.header);break;case"w:footerReference":var i=Qe(t,y,"footer");i&&(x.footers[i.headerType]=i.header);break;case"w:cols":var c={},d=pn(y,"w:num",1);c.num=d;var h=R(y,"w:space");h&&(c.space=h),x.cols=c;break;default:break}}}catch(m){r={error:m}}finally{try{l&&!l.done&&(s=o.return)&&s.call(o)}finally{if(r)throw r.error}}return x},e}(),_s=function(){function e(){this.sections=[],this.currentSection=new ie,this.sections.push(this.currentSection)}return e.prototype.addChild=function(t){this.currentSection.addChild(t)},e.prototype.addSection=function(t){this.currentSection.properties=t,this.currentSection=new ie,this.sections.push(this.currentSection)},e.fromXML=function(t,n){var a,r,s=new e;try{for(var x=g(qt(n)),o=x.next();!o.done;o=x.next()){var l=o.value,y=l.tagName;switch(y){case"w:p":var p=nt.fromXML(t,l);s.addChild(p);break;case"w:tbl":var f=$t(t,l);s.addChild(f);break;case"w:bookmarkStart":case"w:bookmarkEnd":break;case"w:sectPr":s.addSection(ie.parsePr(t,l,s));break;default:console.warn("Body.fromXML Unknown key",y,l)}}}catch(i){a={error:i}}finally{try{o&&!o.done&&(r=x.return)&&r.call(x)}finally{if(a)throw a.error}}return s.sections=s.sections.filter(function(i){return i.children.length>0}),s},e}();function tr(e){if(e.color)return e.color;if(e.themeColor){var t=e.themeColor;if(e.themeTint){var n=new bt(t),a=parseInt(e.themeTint,16);n.tint(a/256)}else if(e.themeShade){var n=new bt(t),a=parseInt(e.themeShade,16);n.lumMod(a/256)}}return"#FFFFF"}var er=function(){function e(){}return e.fromXML=function(t,n){var a,r,s,x,o=new e,l=n.getElementsByTagName("w:body").item(0);l&&(o.body=_s.fromXML(t,l));var y=n.getElementsByTagName("w:background").item(0);if(y){var p={};try{for(var f=g(y.attributes),i=f.next();!i.done;i=f.next()){var c=i.value,d=c.name;switch(d){case"w:color":p.color=dt(t,y,"w:color");break;case"w:themeColor":p.themeColor=dt(t,y,"w:themeColor");break;case"w:themeShade":p.themeShade=dt(t,y,"w:themeShade");break;case"w:themeTint":p.themeTint=dt(t,y,"w:themeTint");break;default:console.log("unknown background",y);break}}}catch(T){a={error:T}}finally{try{i&&!i.done&&(r=f.return)&&r.call(f)}finally{if(a)throw a.error}}try{for(var h=g(y.children),m=h.next();!m.done;m=h.next()){var v=m.value,A=v.tagName;switch(A){case"v:background":break;default:console.log("unknown background",y);break}}}catch(T){s={error:T}}finally{try{m&&!m.done&&(x=h.return)&&x.call(h)}finally{if(s)throw s.error}}o.backgroundColor=tr(p)}return o},e}(),G=Uint8Array,et=Uint16Array,_t=Uint32Array,te=new G([0,0,0,0,0,0,0,0,1,1,1,1,2,2,2,2,3,3,3,3,4,4,4,4,5,5,5,5,0,0,0,0]),ee=new G([0,0,0,0,1,1,2,2,3,3,4,4,5,5,6,6,7,7,8,8,9,9,10,10,11,11,12,12,13,13,0,0]),Re=new G([16,17,18,0,8,7,9,6,10,5,11,4,12,3,13,2,14,1,15]),En=function(e,t){for(var n=new et(31),a=0;a<31;++a)n[a]=t+=1<<e[a-1];for(var r=new _t(n[30]),a=1;a<30;++a)for(var s=n[a];s<n[a+1];++s)r[s]=s-n[a]<<5|a;return[n,r]},In=En(te,2),Hn=In[0],Le=In[1];Hn[28]=258,Le[258]=28;var Nn=En(ee,0),nr=Nn[0],_e=Nn[1],Ce=new et(32768);for(var N=0;N<32768;++N){var ct=(N&43690)>>>1|(N&21845)<<1;ct=(ct&52428)>>>2|(ct&13107)<<2,ct=(ct&61680)>>>4|(ct&3855)<<4,Ce[N]=((ct&65280)>>>8|(ct&255)<<8)>>>1}var yt=function(e,t,n){for(var a=e.length,r=0,s=new et(t);r<a;++r)e[r]&&++s[e[r]-1];var x=new et(t);for(r=0;r<t;++r)x[r]=x[r-1]+s[r-1]<<1;var o;if(n){o=new et(1<<t);var l=15-t;for(r=0;r<a;++r)if(e[r])for(var y=r<<4|e[r],p=t-e[r],f=x[e[r]-1]++<<p,i=f|(1<<p)-1;f<=i;++f)o[Ce[f]>>>l]=y}else for(o=new et(a),r=0;r<a;++r)e[r]&&(o[r]=Ce[x[e[r]-1]++]>>>15-e[r]);return o},ht=new G(288);for(var N=0;N<144;++N)ht[N]=8;for(var N=144;N<256;++N)ht[N]=9;for(var N=256;N<280;++N)ht[N]=7;for(var N=280;N<288;++N)ht[N]=8;var St=new G(32);for(var N=0;N<32;++N)St[N]=5;var ar=yt(ht,9,0),sr=yt(ht,9,1),rr=yt(St,5,0),lr=yt(St,5,1),ce=function(e){for(var t=e[0],n=1;n<e.length;++n)e[n]>t&&(t=e[n]);return t},rt=function(e,t,n){var a=t/8|0;return(e[a]|e[a+1]<<8)>>(t&7)&n},de=function(e,t){var n=t/8|0;return(e[n]|e[n+1]<<8|e[n+2]<<16)>>(t&7)},$e=function(e){return(e+7)/8|0},Pt=function(e,t,n){(t==null||t<0)&&(t=0),(n==null||n>e.length)&&(n=e.length);var a=new(e.BYTES_PER_ELEMENT==2?et:e.BYTES_PER_ELEMENT==4?_t:G)(n-t);return a.set(e.subarray(t,n)),a},xr=["unexpected EOF","invalid block type","invalid length/literal","invalid distance","stream finished","no stream handler",,"no callback","invalid UTF-8 data","extra field too long","date not in range 1980-2099","filename too long","stream finishing","invalid zip data"],tt=function(e,t,n){var a=new Error(t||xr[e]);if(a.code=e,Error.captureStackTrace&&Error.captureStackTrace(a,tt),!n)throw a;return a},or=function(e,t,n){var a=e.length;if(!a||n&&n.f&&!n.l)return t||new G(0);var r=!t||n,s=!n||n.i;n||(n={}),t||(t=new G(a*3));var x=function(Mt){var Ct=t.length;if(Mt>Ct){var vt=new G(Math.max(Ct*2,Mt));vt.set(t),t=vt}},o=n.f||0,l=n.p||0,y=n.b||0,p=n.l,f=n.d,i=n.m,c=n.n,d=a*8;do{if(!p){o=rt(e,l,1);var h=rt(e,l+1,3);if(l+=3,h)if(h==1)p=sr,f=lr,i=9,c=5;else if(h==2){var T=rt(e,l,31)+257,L=rt(e,l+10,15)+4,b=T+rt(e,l+5,31)+1;l+=14;for(var k=new G(b),u=new G(19),w=0;w<L;++w)u[Re[w]]=rt(e,l+w*3,7);l+=L*3;for(var S=ce(u),B=(1<<S)-1,E=yt(u,S,1),w=0;w<b;){var C=E[rt(e,l,B)];l+=C&15;var m=C>>>4;if(m<16)k[w++]=m;else{var H=0,O=0;for(m==16?(O=3+rt(e,l,3),l+=2,H=k[w-1]):m==17?(O=3+rt(e,l,7),l+=3):m==18&&(O=11+rt(e,l,127),l+=7);O--;)k[w++]=H}}var q=k.subarray(0,T),P=k.subarray(T);i=ce(q),c=ce(P),p=yt(q,i,1),f=yt(P,c,1)}else tt(1);else{var m=$e(l)+4,v=e[m-4]|e[m-3]<<8,A=m+v;if(A>a){s&&tt(0);break}r&&x(y+v),t.set(e.subarray(m,A),y),n.b=y+=v,n.p=l=A*8,n.f=o;continue}if(l>d){s&&tt(0);break}}r&&x(y+131072);for(var D=(1<<i)-1,M=(1<<c)-1,Z=l;;Z=l){var H=p[de(e,l)&D],Q=H>>>4;if(l+=H&15,l>d){s&&tt(0);break}if(H||tt(2),Q<256)t[y++]=Q;else if(Q==256){Z=l,p=null;break}else{var J=Q-254;if(Q>264){var w=Q-257,K=te[w];J=rt(e,l,(1<<K)-1)+Hn[w],l+=K}var at=f[de(e,l)&M],V=at>>>4;at||tt(3),l+=at&15;var P=nr[V];if(V>3){var K=ee[V];P+=de(e,l)&(1<<K)-1,l+=K}if(l>d){s&&tt(0);break}r&&x(y+131072);for(var W=y+J;y<W;y+=4)t[y]=t[y-P],t[y+1]=t[y+1-P],t[y+2]=t[y+2-P],t[y+3]=t[y+3-P];y=W}}n.l=p,n.p=Z,n.b=y,n.f=o,p&&(o=1,n.m=i,n.d=f,n.n=c)}while(!o);return y==t.length?t:Pt(t,0,y)},ft=function(e,t,n){n<<=t&7;var a=t/8|0;e[a]|=n,e[a+1]|=n>>>8},Bt=function(e,t,n){n<<=t&7;var a=t/8|0;e[a]|=n,e[a+1]|=n>>>8,e[a+2]|=n>>>16},he=function(e,t){for(var n=[],a=0;a<e.length;++a)e[a]&&n.push({s:a,f:e[a]});var r=n.length,s=n.slice();if(!r)return[Pe,0];if(r==1){var x=new G(n[0].s+1);return x[n[0].s]=1,[x,1]}n.sort(function(b,k){return b.f-k.f}),n.push({s:-1,f:25001});var o=n[0],l=n[1],y=0,p=1,f=2;for(n[0]={s:-1,f:o.f+l.f,l:o,r:l};p!=r-1;)o=n[n[y].f<n[f].f?y++:f++],l=n[y!=p&&n[y].f<n[f].f?y++:f++],n[p++]={s:-1,f:o.f+l.f,l:o,r:l};for(var i=s[0].s,a=1;a<r;++a)s[a].s>i&&(i=s[a].s);var c=new et(i+1),d=je(n[p-1],c,0);if(d>t){var a=0,h=0,m=d-t,v=1<<m;for(s.sort(function(k,u){return c[u.s]-c[k.s]||k.f-u.f});a<r;++a){var A=s[a].s;if(c[A]>t)h+=v-(1<<d-c[A]),c[A]=t;else break}for(h>>>=m;h>0;){var T=s[a].s;c[T]<t?h-=1<<t-c[T]++-1:++a}for(;a>=0&&h;--a){var L=s[a].s;c[L]==t&&(--c[L],++h)}d=t}return[new G(c),d]},je=function(e,t,n){return e.s==-1?Math.max(je(e.l,t,n+1),je(e.r,t,n+1)):t[e.s]=n},tn=function(e){for(var t=e.length;t&&!e[--t];);for(var n=new et(++t),a=0,r=e[0],s=1,x=function(l){n[a++]=l},o=1;o<=t;++o)if(e[o]==r&&o!=t)++s;else{if(!r&&s>2){for(;s>138;s-=138)x(32754);s>2&&(x(s>10?s-11<<5|28690:s-3<<5|12305),s=0)}else if(s>3){for(x(r),--s;s>6;s-=6)x(8304);s>2&&(x(s-3<<5|8208),s=0)}for(;s--;)x(r);s=1,r=e[o]}return[n.subarray(0,a),t]},Ot=function(e,t){for(var n=0,a=0;a<t.length;++a)n+=e[a]*t[a];return n},Be=function(e,t,n){var a=n.length,r=$e(t+2);e[r]=a&255,e[r+1]=a>>>8,e[r+2]=e[r]^255,e[r+3]=e[r+1]^255;for(var s=0;s<a;++s)e[r+s+4]=n[s];return(r+4+a)*8},en=function(e,t,n,a,r,s,x,o,l,y,p){ft(t,p++,n),++r[256];for(var f=he(r,15),i=f[0],c=f[1],d=he(s,15),h=d[0],m=d[1],v=tn(i),A=v[0],T=v[1],L=tn(h),b=L[0],k=L[1],u=new et(19),w=0;w<A.length;++w)u[A[w]&31]++;for(var w=0;w<b.length;++w)u[b[w]&31]++;for(var S=he(u,7),B=S[0],E=S[1],C=19;C>4&&!B[Re[C-1]];--C);var H=y+5<<3,O=Ot(r,ht)+Ot(s,St)+x,q=Ot(r,i)+Ot(s,h)+x+14+3*C+Ot(u,B)+(2*u[16]+3*u[17]+7*u[18]);if(H<=O&&H<=q)return Be(t,p,e.subarray(l,l+y));var P,D,M,Z;if(ft(t,p,1+(q<O)),p+=2,q<O){P=yt(i,c,0),D=i,M=yt(h,m,0),Z=h;var Q=yt(B,E,0);ft(t,p,T-257),ft(t,p+5,k-1),ft(t,p+10,C-4),p+=14;for(var w=0;w<C;++w)ft(t,p+3*w,B[Re[w]]);p+=3*C;for(var J=[A,b],K=0;K<2;++K)for(var at=J[K],w=0;w<at.length;++w){var V=at[w]&31;ft(t,p,Q[V]),p+=B[V],V>15&&(ft(t,p,at[w]>>>5&127),p+=at[w]>>>12)}}else P=ar,D=ht,M=rr,Z=St;for(var w=0;w<o;++w)if(a[w]>255){var V=a[w]>>>18&31;Bt(t,p,P[V+257]),p+=D[V+257],V>7&&(ft(t,p,a[w]>>>23&31),p+=te[V]);var W=a[w]&31;Bt(t,p,M[W]),p+=Z[W],W>3&&(Bt(t,p,a[w]>>>5&8191),p+=ee[W])}else Bt(t,p,P[a[w]]),p+=D[a[w]];return Bt(t,p,P[256]),p+D[256]},yr=new _t([65540,131080,131088,131104,262176,1048704,1048832,2114560,2117632]),Pe=new G(0),pr=function(e,t,n,a,r,s){var x=e.length,o=new G(a+x+5*(1+Math.ceil(x/7e3))+r),l=o.subarray(a,o.length-r),y=0;if(!t||x<8)for(var p=0;p<=x;p+=65535){var f=p+65535;f>=x&&(l[y>>3]=s),y=Be(l,y+1,e.subarray(p,f))}else{for(var i=yr[t-1],c=i>>>13,d=i&8191,h=(1<<n)-1,m=new et(32768),v=new et(h+1),A=Math.ceil(n/3),T=2*A,L=function(ne){return(e[ne]^e[ne+1]<<A^e[ne+2]<<T)&h},b=new _t(25e3),k=new et(288),u=new et(32),w=0,S=0,p=0,B=0,E=0,C=0;p<x;++p){var H=L(p),O=p&32767,q=v[H];if(m[O]=q,v[H]=O,E<=p){var P=x-p;if((w>7e3||B>24576)&&P>423){y=en(e,l,0,b,k,u,S,B,C,p-C,y),B=w=S=0,C=p;for(var D=0;D<286;++D)k[D]=0;for(var D=0;D<30;++D)u[D]=0}var M=2,Z=0,Q=d,J=O-q&32767;if(P>2&&H==L(p-J))for(var K=Math.min(c,P)-1,at=Math.min(32767,p),V=Math.min(258,P);J<=at&&--Q&&O!=q;){if(e[p+M]==e[p+M-J]){for(var W=0;W<V&&e[p+W]==e[p+W-J];++W);if(W>M){if(M=W,Z=J,W>K)break;for(var Mt=Math.min(J,W-2),Ct=0,D=0;D<Mt;++D){var vt=p-J+D+32768&32767,Zn=m[vt],Me=vt-Zn+32768&32767;Me>Ct&&(Ct=Me,q=vt)}}}O=q,q=m[O],J+=O-q+32768&32767}if(Z){b[B++]=268435456|Le[M]<<18|_e[Z];var Ee=Le[M]&31,Ie=_e[Z]&31;S+=te[Ee]+ee[Ie],++k[257+Ee],++u[Ie],E=p+M,++w}else b[B++]=e[p],++k[e[p]]}}y=en(e,l,s,b,k,u,S,B,C,p-C,y),!s&&y&7&&(y=Be(l,y+1,Pe))}return Pt(o,0,a+$e(y)+r)},fr=function(){for(var e=new Int32Array(256),t=0;t<256;++t){for(var n=t,a=9;--a;)n=(n&1&&-306674912)^n>>>1;e[t]=n}return e}(),ir=function(){var e=-1;return{p:function(t){for(var n=e,a=0;a<t.length;++a)n=fr[n&255^t[a]]^n>>>8;e=n},d:function(){return~e}}},cr=function(e,t,n,a,r){return pr(e,t.level==null?6:t.level,t.mem==null?Math.ceil(Math.max(8,Math.min(13,Math.log(e.length)))*1.5):12+t.mem,n,a,!r)},zn=function(e,t){var n={};for(var a in e)n[a]=e[a];for(var a in t)n[a]=t[a];return n},ot=function(e,t){return e[t]|e[t+1]<<8},lt=function(e,t){return(e[t]|e[t+1]<<8|e[t+2]<<16|e[t+3]<<24)>>>0},me=function(e,t){return lt(e,t)+lt(e,t+4)*4294967296},Y=function(e,t,n){for(;n;++t)e[t]=n,n>>>=8};function dr(e,t){return cr(e,t||{},0,0)}function hr(e,t){return or(e,t)}var Gn=function(e,t,n,a){for(var r in e){var s=e[r],x=t+r,o=a;Array.isArray(s)&&(o=zn(a,s[1]),s=s[0]),s instanceof G?n[x]=[s,o]:(n[x+="/"]=[new G(0),o],Gn(s,x,n,a))}},nn=typeof TextEncoder<"u"&&new TextEncoder,Oe=typeof TextDecoder<"u"&&new TextDecoder,mr=0;try{Oe.decode(Pe,{stream:!0}),mr=1}catch{}var gr=function(e){for(var t="",n=0;;){var a=e[n++],r=(a>127)+(a>223)+(a>239);if(n+r>e.length)return[t,Pt(e,n-1)];r?r==3?(a=((a&15)<<18|(e[n++]&63)<<12|(e[n++]&63)<<6|e[n++]&63)-65536,t+=String.fromCharCode(55296|a>>10,56320|a&1023)):r&1?t+=String.fromCharCode((a&31)<<6|e[n++]&63):t+=String.fromCharCode((a&15)<<12|(e[n++]&63)<<6|e[n++]&63):t+=String.fromCharCode(a)}};function De(e,t){if(t){for(var n=new G(e.length),a=0;a<e.length;++a)n[a]=e.charCodeAt(a);return n}if(nn)return nn.encode(e);for(var r=e.length,s=new G(e.length+(e.length>>1)),x=0,o=function(p){s[x++]=p},a=0;a<r;++a){if(x+5>s.length){var l=new G(x+8+(r-a<<1));l.set(s),s=l}var y=e.charCodeAt(a);y<128||t?o(y):y<2048?(o(192|y>>6),o(128|y&63)):y>55295&&y<57344?(y=65536+(y&1047552)|e.charCodeAt(++a)&1023,o(240|y>>18),o(128|y>>12&63),o(128|y>>6&63),o(128|y&63)):(o(224|y>>12),o(128|y>>6&63),o(128|y&63))}return Pt(s,0,x)}function Vn(e,t){if(t){for(var n="",a=0;a<e.length;a+=16384)n+=String.fromCharCode.apply(null,e.subarray(a,a+16384));return n}else{if(Oe)return Oe.decode(e);var r=gr(e),s=r[0],x=r[1];return x.length&&tt(8),s}}var wr=function(e,t){return t+30+ot(e,t+26)+ot(e,t+28)},vr=function(e,t,n){var a=ot(e,t+28),r=Vn(e.subarray(t+46,t+46+a),!(ot(e,t+8)&2048)),s=t+46+a,x=lt(e,t+20),o=n&&x==4294967295?ur(e,s):[x,lt(e,t+24),lt(e,t+42)],l=o[0],y=o[1],p=o[2];return[ot(e,t+10),l,y,r,s+ot(e,t+30)+ot(e,t+32),p]},ur=function(e,t){for(;ot(e,t)!=1;t+=4+ot(e,t+2));return[me(e,t+12),me(e,t+4),me(e,t+20)]},Fe=function(e){var t=0;if(e)for(var n in e){var a=e[n].length;a>65535&&tt(9),t+=a+4}return t},an=function(e,t,n,a,r,s,x,o){var l=a.length,y=n.extra,p=o&&o.length,f=Fe(y);Y(e,t,x!=null?33639248:67324752),t+=4,x!=null&&(e[t++]=20,e[t++]=n.os),e[t]=20,t+=2,e[t++]=n.flag<<1|(s<0&&8),e[t++]=r&&8,e[t++]=n.compression&255,e[t++]=n.compression>>8;var i=new Date(n.mtime==null?Date.now():n.mtime),c=i.getFullYear()-1980;if((c<0||c>119)&&tt(10),Y(e,t,c<<25|i.getMonth()+1<<21|i.getDate()<<16|i.getHours()<<11|i.getMinutes()<<5|i.getSeconds()>>>1),t+=4,s!=-1&&(Y(e,t,n.crc),Y(e,t+4,s<0?-s-2:s),Y(e,t+8,n.size)),Y(e,t+12,l),Y(e,t+14,f),t+=16,x!=null&&(Y(e,t,p),Y(e,t+6,n.attrs),Y(e,t+10,x),t+=14),e.set(a,t),t+=l,f)for(var d in y){var h=y[d],m=h.length;Y(e,t,+d),Y(e,t+2,m),e.set(h,t+4),t+=4+m}return p&&(e.set(o,t),t+=p),t},Tr=function(e,t,n,a,r){Y(e,t,101010256),Y(e,t+8,n),Y(e,t+10,n),Y(e,t+12,a),Y(e,t+16,r)};function Ar(e,t){t||(t={});var n={},a=[];Gn(e,"",n,t);var r=0,s=0;for(var x in n){var o=n[x],l=o[0],y=o[1],p=y.level==0?0:8,f=De(x),i=f.length,c=y.comment,d=c&&De(c),h=d&&d.length,m=Fe(y.extra);i>65535&&tt(11);var v=p?dr(l,y):l,A=v.length,T=ir();T.p(l),a.push(zn(y,{size:l.length,crc:T.d(),c:v,f,m:d,u:i!=x.length||d&&c.length!=h,o:r,compression:p})),r+=30+i+m+A,s+=76+2*(i+m)+(h||0)+A}for(var L=new G(s+22),b=r,k=s-r,u=0;u<a.length;++u){var f=a[u];an(L,f.o,f,f.f,f.u,f.c.length);var w=30+f.f.length+Fe(f.extra);L.set(f.c,f.o+w),an(L,r,f,f.f,f.u,f.c.length,f.o,f.m),r+=16+w+(f.m?f.m.length:0)}return Tr(L,r,a.length,k,b),L}function br(e,t){for(var n={},a=e.length-22;lt(e,a)!=101010256;--a)(!a||e.length-a>65558)&&tt(13);var r=ot(e,a+8);if(!r)return{};var s=lt(e,a+16),x=s==4294967295||r==65535;if(x){var o=lt(e,a-12);x=lt(e,o)==101075792,x&&(r=lt(e,o+32),s=lt(e,o+48))}for(var l=t&&t.filter,y=0;y<r;++y){var p=vr(e,s,x),f=p[0],i=p[1],c=p[2],d=p[3],h=p[4],m=p[5],v=wr(e,m);s=h,(!l||l({name:d,size:i,originalSize:c,compression:f}))&&(f?f==8?n[d]=hr(e.subarray(v,v+i),new G(c)):tt(14,"unknown compression type "+f):n[d]=Pt(e,v,v+i))}return n}var kr=function(){function e(){}return e.prototype.load=function(t){this.zip=br(new Uint8Array(t))},e.prototype.getXML=function(t){var n=this.getFileByType(t,"string"),a=new DOMParser().parseFromString(n,"application/xml"),r=a.getElementsByTagName("parsererror").item(0);if(r)throw new Error(r.textContent||"can't parse xml");return a},e.prototype.getFileByType=function(t,n){t=t.startsWith("/")?t.slice(1):t;var a=this.zip[t];if(a){if(n==="string")return Vn(a);if(n==="blob")return new Blob([a]);if(n==="uint8array")return a}return console.warn("getFileByType",t,"not found"),null},e.prototype.fileExists=function(t){return t=t.startsWith("/")?t.slice(1):t,t in this.zip},e.prototype.generateZip=function(t){return this.zip["word/document.xml"]=De(t),new Blob([Ar(this.zip)])},e}();function Rr(e){var t,n;if(!e)return null;var a=e.fonts;if(!a||!a.length)return null;var r=I("style"),s="/** embedded fonts **/";try{for(var x=g(e.fonts),o=x.next();!o.done;o=x.next()){var l=o.value,y=l.name.replace(/['\\]/g,""),p=l.url;y&&p&&(s+=`
      @font-face {
        font-family: '`.concat(y,`';
        src: url('`).concat(p,`');
      }
      `))}}catch(f){t={error:f}}finally{try{o&&!o.done&&(n=x.return)&&n.call(x)}finally{if(t)throw t.error}}return r.innerHTML=s,r}function Lr(e,t,n){e&&Object.isFrozen(e)&&(e=Cr(e));var a=e?Object.create(e,it(it({},n),{__super:{value:e,writable:!1,enumerable:!1}})):Object.create(Object.prototype,n);return t&&jr(t)&&Object.keys(t).forEach(function(r){return a[r]=t[r]}),a}function Cr(e,t){t===void 0&&(t=!0);var n=e&&e.__super?Object.create(e.__super,{__super:{value:e.__super,writable:!1,enumerable:!1}}):Object.create(Object.prototype);return t&&e&&Object.keys(e).forEach(function(a){return n[a]=e[a]}),n}function jr(e){var t=typeof e;return e&&t!=="string"&&t!=="number"&&t!=="boolean"&&t!=="function"&&!Array.isArray(e)}function Wn(e,t,n){var a=t.textContent||"";t.textContent=Xn(e,a,n)}function Xn(e,t,n){var a=e.renderOptions.evalVar;if(t.startsWith("{{")){t=t.replace(/^{{/g,"").replace(/}}$/g,"");var r=a(t,n);return r!=null?String(r):""}return t}function Br(e,t,n){var a=t.getAttribute("descr")||"";t.setAttribute("descrVar",Xn(e,a,n))}function Or(e,t){var n,a,r,s,x,o,l,y,p,f,i=e.renderOptions.evalVar,c=e.renderOptions.data,d=t.parentNode,h=t.getElementsByTagName("w:tc"),m=!1,v=[];try{for(var A=g(h),T=A.next();!T.done;T=A.next()){var L=T.value,b=L.getElementsByTagName("w:t");try{for(var k=(r=void 0,g(b)),u=k.next();!u.done;u=k.next()){var w=u.value,S=w.textContent||"";if(S.startsWith("{{#")){var B=/{{#([^\}]+)}}/,E=B.exec(S);if(E&&E.length>0){m=!0;var C=E[1],H=i(C,c);Array.isArray(H)&&(v=H),w.textContent=w.textContent.replace("{{#".concat(C,"}}"),"")}}S.indexOf("{{/}}")&&(w.textContent=w.textContent.replace("{{/}}",""))}}catch(V){r={error:V}}finally{try{u&&!u.done&&(s=k.return)&&s.call(k)}finally{if(r)throw r.error}}}}catch(V){n={error:V}}finally{try{T&&!T.done&&(a=A.return)&&a.call(A)}finally{if(n)throw n.error}}if(m){try{for(var O=g(v),q=O.next();!q.done;q=O.next()){var P=q.value,D=Dr(t),b=D.getElementsByTagName("w:t"),M=Lr(c,P);try{for(var Z=(l=void 0,g(b)),Q=Z.next();!Q.done;Q=Z.next()){var w=Q.value;Wn(e,w,M)}}catch(W){l={error:W}}finally{try{Q&&!Q.done&&(y=Z.return)&&y.call(Z)}finally{if(l)throw l.error}}try{for(var J=(p=void 0,g(D.getElementsByTagName("pic:cNvPr"))),K=J.next();!K.done;K=J.next()){var at=K.value;Br(e,at,M)}}catch(W){p={error:W}}finally{try{K&&!K.done&&(f=J.return)&&f.call(J)}finally{if(p)throw p.error}}d.appendChild(D)}}catch(V){x={error:V}}finally{try{q&&!q.done&&(o=O.return)&&o.call(O)}finally{if(x)throw x.error}}d.removeChild(t)}}function Dr(e){var t,n,a,r,s,x=e.cloneNode(!0);sn(x);var o=[].slice.call(x.getElementsByTagName("w:p"));try{for(var l=g(o),y=l.next();!y.done;y=l.next()){var p=y.value;sn(p)}}catch(h){t={error:h}}finally{try{y&&!y.done&&(n=l.return)&&n.call(l)}finally{if(t)throw t.error}}var f=[].slice.call(x.getElementsByTagName("w:cnfStyle"));try{for(var i=g(f),c=i.next();!c.done;c=i.next()){var d=c.value;(s=d.parentElement)===null||s===void 0||s.removeChild(d)}}catch(h){a={error:h}}finally{try{c&&!c.done&&(r=i.return)&&r.call(i)}finally{if(a)throw a.error}}return x}function sn(e){for(;e.attributes.length>0;)e.removeAttributeNode(e.attributes[0])}function Fr(e,t){var n,a,r=[].slice.call(t.getElementsByTagName("w:tr"));try{for(var s=g(r),x=s.next();!x.done;x=s.next()){var o=x.value;Or(e,o)}}catch(l){n={error:l}}finally{try{x&&!x.done&&(a=s.return)&&a.call(s)}finally{if(n)throw n.error}}}function rn(e,t){Fr(e,t)}var Un=function(){function e(){this.children=[]}return e.prototype.addChild=function(t){this.children.push(t)},e.fromXML=function(t,n){var a,r,s=new e;try{for(var x=g(n.children),o=x.next();!o.done;o=x.next()){var l=o.value,y=l.tagName;switch(y){case"w:p":var p=nt.fromXML(t,l);s.addChild(p);break;case"w:tbl":var f=$t(t,l);s.addChild(f);break;default:console.warn("Note.fromXML unknown tag",y,l)}}}catch(i){a={error:i}}finally{try{o&&!o.done&&(r=x.return)&&r.call(x)}finally{if(a)throw a.error}}return s},e}();function Sr(e,t){var n,a,r={},s=[].slice.call(t.getElementsByTagName("w:footnote"));try{for(var x=g(s),o=x.next();!o.done;o=x.next()){var l=o.value,y=Un.fromXML(e,l);r[l.getAttribute("w:id")]=y}}catch(p){n={error:p}}finally{try{o&&!o.done&&(a=x.return)&&a.call(x)}finally{if(n)throw n.error}}return r}function qr(e,t){var n,a,r={},s=[].slice.call(t.getElementsByTagName("w:endnote"));try{for(var x=g(s),o=x.next();!o.done;o=x.next()){var l=o.value,y=Un.fromXML(e,l);r[l.getAttribute("w:id")]=y}}catch(p){n={error:p}}finally{try{o&&!o.done&&(a=x.return)&&a.call(x)}finally{if(n)throw n.error}}return r}function ln(e,t,n,a,r){var s,x,o=r.children,l=I("div"),y=I("a"),p=n+"-"+a;y.name=p,y.id=p,t.appendChild(l);try{for(var f=g(o),i=f.next();!i.done;i=f.next()){var c=i.value;if(c instanceof nt){var d=Lt(e,c);j(l,d)}else c instanceof wt?j(l,Rt(e,c)):console.warn("unknown child",c)}}catch(h){s={error:h}}finally{try{i&&!i.done&&(x=f.return)&&x.call(f)}finally{if(s)throw s.error}}}function xn(e){if(!e)return!1;for(var t in e)if(t!=="0"&&t!=="-1")return!0;return!1}function $r(e){var t=I("div");if(xn(e.footNotes))for(var n in e.footNotes)ln(e,t,"footnote",n,e.footNotes[n]);if(xn(e.endNotes))for(var n in e.endNotes||{})ln(e,t,"endnote",n,e.endNotes[n]);return t.children.length?t:null}function Pr(e){var t=this,n=e.map(function(a){return ge(t,void 0,void 0,function(){return we(this,function(r){switch(r.label){case 0:return a.src&&a.src!==window.location.href?[4,Mr(a)]:[3,2];case 1:r.sent(),r.label=2;case 2:return[2]}})})});return Promise.all(n)}function Mr(e){return new Promise(function(t){var n=function(){!e||typeof e.naturalWidth>"u"||e.naturalWidth===0||!e.complete?setTimeout(n,500):t()};n()})}function on(e){var t,n;(t=e.contentWindow)===null||t===void 0||t.print(),(n=e.parentNode)===null||n===void 0||n.removeChild(e)}function Er(e){var t=e.contentDocument,n=t.getElementsByTagName("img");n.length>0?Pr(Array.from(n)).then(function(){return on(e)}):on(e)}function Ir(e){var t,n,a={};try{for(var r=g(e.attributes),s=r.next();!s.done;s=r.next()){var x=s.value,o=x.name.replace("w:",""),l=x.value;l==="light1"?l="lt1":l==="light2"?l="lt2":l==="dark1"?l="dk1":l==="dark2"&&(l="dk2"),a[o]=l}}catch(y){t={error:y}}finally{try{s&&!s.done&&(n=r.return)&&n.call(r)}finally{if(t)throw t.error}}return a.bg1||(a.bg1="lt1"),a.bg2||(a.bg2="lt2"),a.tx1||(a.tx1="dk1"),a}var Hr=function(){function e(){this.clrSchemeMapping={},this.autoHyphenation=!1}return e.parse=function(t,n){var a,r,s=new e,x=n;n.firstElementChild&&n.firstElementChild.tagName==="w:settings"&&(x=n.getElementsByTagName("w:settings").item(0));try{for(var o=g(Array.from(x.children)),l=o.next();!l.done;l=o.next()){var y=l.value,p=y.tagName;switch(p){case"w:clrSchemeMapping":s.clrSchemeMapping=Ir(y);break;case"w:autoHyphenation":s.autoHyphenation=_(y,!1);break}}}catch(f){a={error:f}}finally{try{l&&!l.done&&(r=o.return)&&r.call(o)}finally{if(a)throw a.error}}return s},e}(),Nr={classPrefix:"docx-viewer",page:!1,pageWrap:!0,bulletUseFont:!0,ignoreHeight:!0,ignoreWidth:!1,minLineHeight:1,enableVar:!1,debug:!1,pageWrapPadding:20,pageMarginBottom:20,pageShadow:!0,pageBackground:"#FFFFFF",pageWrapBackground:"#ECECEC",printWaitTime:100,zoomFitWidth:!1,renderHeader:!0,renderFooter:!0,data:{},evalVar:function(e){return e}},zr=function(){function e(t,n,a){a===void 0&&(a=new kr),this.themes=[],this.styleIdMap={},this.styleIdNum=0,this.wrapClassName="docx-viewer-wrapper",this.footNotes={},this.endNotes={},this.inited=!1,this.breakPage=!1,a.load(t),this.id=e.globalId++,this.parser=a,this.renderOptions=it(it({},Nr),n),this.renderOptions.page&&(this.renderOptions.ignoreHeight=!1,this.renderOptions.ignoreWidth=!1)}return e.prototype.init=function(){this.inited||(this.initContentType(),this.initRelation(),this.initSettings(),this.initTheme(),this.initFontTable(),this.initStyle(),this.initNumbering(),this.initNotes(),this.inited=!0)},e.prototype.initTheme=function(){var t,n;try{for(var a=g(this.conentTypes.overrides),r=a.next();!r.done;r=a.next()){var s=r.value;if(s.partName.startsWith("/word/theme")){var x=this.parser.getXML(s.partName);this.themes.push(_a(x))}}}catch(o){t={error:o}}finally{try{r&&!r.done&&(n=a.return)&&n.call(a)}finally{if(t)throw t.error}}},e.prototype.initStyle=function(){var t,n;try{for(var a=g(this.conentTypes.overrides),r=a.next();!r.done;r=a.next()){var s=r.value;s.partName.startsWith("/word/styles.xml")&&(this.styles=Ua(this,this.parser.getXML("/word/styles.xml")))}}catch(x){t={error:x}}finally{try{r&&!r.done&&(n=a.return)&&n.call(a)}finally{if(t)throw t.error}}},e.prototype.initSettings=function(){var t,n;try{for(var a=g(this.conentTypes.overrides),r=a.next();!r.done;r=a.next()){var s=r.value;s.partName.startsWith("/word/settings.xml")&&(this.settings=Hr.parse(this,this.parser.getXML("/word/settings.xml")))}}catch(x){t={error:x}}finally{try{r&&!r.done&&(n=a.return)&&n.call(a)}finally{if(t)throw t.error}}},e.prototype.initFontTable=function(){var t,n;try{for(var a=g(this.conentTypes.overrides),r=a.next();!r.done;r=a.next()){var s=r.value;s.partName.startsWith("/word/fontTable.xml")&&(this.fontTable=_n.fromXML(this,this.parser.getXML("/word/fontTable.xml")))}}catch(x){t={error:x}}finally{try{r&&!r.done&&(n=a.return)&&n.call(a)}finally{if(t)throw t.error}}},e.prototype.initRelation=function(){var t={};this.parser.fileExists("/_rels/.rels")&&(t=ae(this.parser.getXML("/_rels/.rels"),"root")),this.relationships=t;var n={};this.parser.fileExists("/word/_rels/document.xml.rels")&&(n=ae(this.parser.getXML("/word/_rels/document.xml.rels"),"word")),this.documentRels=n;var a={};this.parser.fileExists("/word/_rels/fontTable.xml.rels")&&(a=ae(this.parser.getXML("/word/_rels/fontTable.xml.rels"),"word")),this.fontTableRels=a},e.prototype.initContentType=function(){var t=this.parser.getXML("[Content_Types].xml");this.conentTypes=ea(t)},e.prototype.initNumbering=function(){var t,n;try{for(var a=g(this.conentTypes.overrides),r=a.next();!r.done;r=a.next()){var s=r.value;if(s.partName.startsWith("/word/numbering")){var x=this.parser.getXML(s.partName);this.numbering=Us.fromXML(this,x)}}}catch(o){t={error:o}}finally{try{r&&!r.done&&(n=a.return)&&n.call(a)}finally{if(t)throw t.error}}},e.prototype.initNotes=function(){var t,n;try{for(var a=g(this.conentTypes.overrides),r=a.next();!r.done;r=a.next()){var s=r.value;if(s.partName.startsWith("/word/footnotes.xml")){var x=this.parser.getXML(s.partName);this.footNotes=Sr(this,x)}if(s.partName.startsWith("/word/endnotes.xml")){var x=this.parser.getXML(s.partName);this.endNotes=qr(this,x)}}}catch(o){t={error:o}}finally{try{r&&!r.done&&(n=a.return)&&n.call(a)}finally{if(t)throw t.error}}},e.prototype.getRelationship=function(t){return t&&this.relationships?this.relationships[t]:null},e.prototype.getDocumentRels=function(t){return t&&this.documentRels?this.documentRels[t]:null},e.prototype.getFontTableRels=function(t){return t&&this.fontTableRels?this.fontTableRels[t]:null},e.prototype.replaceText=function(t){if(this.renderOptions.enableVar===!1)return t;var n=this.renderOptions.data;if(t.indexOf("{{")!==-1){t=t.replace(/^{{/g,"").replace(/}}$/g,"");var a=this.renderOptions.evalVar(t,n);return typeof a>"u"?"":String(a)}return t},e.prototype.loadWordRelXML=function(t){var n=t.target;return t.part==="word"&&(n="word/"+n),this.getXML(n)},e.prototype.loadImage=function(t){var n=t.target;t.part==="word"&&(n="word/"+n);var a=this.parser.getFileByType(n,"blob");return a?URL.createObjectURL(a):null},e.prototype.loadFont=function(t,n){var a=this.getFontTableRels(t);if(!a)return null;var r=a.target;a.part==="word"&&(r="word/"+r);var s=this.parser.getFileByType(r,"uint8array");return s?URL.createObjectURL(new Blob([Yn(s,n)])):null},e.prototype.getXML=function(t){return this.parser.getXML(t)},e.prototype.getStyleIdDisplayName=function(t){return t.match(/^[a-zA-Z]+[a-zA-Z0-9\-\_]*$/)?this.getClassPrefix()+"-"+t:t in this.styleIdMap?this.styleIdMap[t]:(this.styleIdMap[t]=this.genClassName(),this.styleIdMap[t])},e.prototype.genClassName=function(){return"docx-classname-"+this.styleIdNum++},e.prototype.appendStyle=function(t){t===void 0&&(t="");var n=I("style");n.textContent=t,this.rootElement.appendChild(n)},e.prototype.getStyleClassName=function(t){var n=this.styles.styleMap[t];if(!n)return[];var a=[this.getStyleIdDisplayName(t)];return n.basedOn&&a.unshift(this.getStyleIdDisplayName(n.basedOn)),a},e.prototype.getStyle=function(t){return this.styles.styleMap[t]},e.prototype.getClassPrefix=function(){return"".concat(this.renderOptions.classPrefix,"-").concat(this.id)},e.prototype.getThemeColor=function(t){var n,a,r;if(this.settings.clrSchemeMapping&&(t=this.settings.clrSchemeMapping[t]||t),this.themes&&this.themes.length>0){var s=this.themes[0],x=(r=(a=(n=s.themeElements)===null||n===void 0?void 0:n.clrScheme)===null||a===void 0?void 0:a.colors)===null||r===void 0?void 0:r[t];if(x)return x;console.warn("unknown theme color: "+t)}return""},e.prototype.addClass=function(t,n){t.classList.add("".concat(this.getClassPrefix(),"-").concat(n))},e.prototype.updateVariable=function(){!this.rootElement||this.renderOptions.enableVar===!1||Ds(this)},e.prototype.download=function(t){t===void 0&&(t="document.docx");var n=this.getXML("word/document.xml");if(this.renderOptions.enableVar){Ye(this,n),rn(this,n);for(var a=n.getElementsByTagName("w:t"),r=0;r<a.length;r++)Wn(this,a[r],this.renderOptions.data)}var s=this.parser.generateZip($s(n));Vs(s,t)},e.prototype.print=function(){return ge(this,void 0,void 0,function(){var t,n;return we(this,function(a){switch(a.label){case 0:return t=document.createElement("iframe"),t.style.position="absolute",t.style.top="-10000px",document.body.appendChild(t),n=t.contentDocument,n?(n.write(`<style>
      html, body { margin:0; padding:0 }
      @page { size: auto; margin: 0mm; }
      </style>
      <div id="print"></div>`),[4,this.render(n.getElementById("print"),it({page:!0,pageWrap:!1,pageShadow:!1,pageMarginBottom:0,pageWrapPadding:void 0,zoom:1},this.renderOptions.printOptions))]):(console.warn("printDocument is null"),[2,null]);case 1:return a.sent(),setTimeout(function(){t.focus(),Er(t)},this.renderOptions.printWaitTime||100),window.focus(),[2]}})})},e.prototype.render=function(t,n){return n===void 0&&(n={}),ge(this,void 0,void 0,function(){var a,r,s,x,o;return we(this,function(l){return this.init(),this.currentPage=0,a=it(it({},this.renderOptions),n),r=a.debug,r&&console.log("init",this),this.rootElement=t,t.innerHTML="",s=this.getXML("word/document.xml"),r&&console.log("documentData",s),a.enableVar&&(Ye(this,s),rn(this,s)),x=er.fromXML(this,s),r&&console.log("document",x),o=Gs(t,this,x,a),t.classList.add(this.getClassPrefix()),a.page&&a.pageWrap&&(t.classList.add(this.wrapClassName),t.style.padding="".concat(a.pageWrapPadding||0,"pt"),t.style.background=a.pageWrapBackground||"#ECECEC"),j(t,xs(this)),j(t,Rr(this.fontTable)),j(t,o),j(t,$r(this)),[2]})})},e.globalId=0,e}(),Vr={Word:zr};export{zr as Word,Vr as default};
