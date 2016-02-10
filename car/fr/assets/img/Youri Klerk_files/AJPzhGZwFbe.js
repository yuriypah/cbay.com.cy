/*!CK:1686823003!*//*1454307979,*/

if (self.CavalryLogger) { CavalryLogger.start_js(["Fy7Lj"]); }

__d("NavigationMetricsEnumJS",[],function a(b,c,d,e,f,g){c.__markCompiled&&c.__markCompiled();f.exports={NAVIGATION_START:"navigationStart",UNLOAD_EVENT_START:"unloadEventStart",UNLOAD_EVENT_END:"unloadEventEnd",REDIRECT_START:"redirectStart",REDIRECT_END:"redirectEnd",FETCH_START:"fetchStart",DOMAIN_LOOKUP_START:"domainLookupStart",DOMAIN_LOOKUP_END:"domainLookupEnd",CONNECT_START:"connectStart",CONNECT_END:"connectEnd",SECURE_CONNECTION_START:"secureConnectionStart",REQUEST_START:"requestStart",RESPONSE_START:"responseStart",RESPONSE_END:"responseEnd",DOM_LOADING:"domLoading",DOM_INTERACTIVE:"domInteractive",DOM_CONTENT_LOADED_EVENT_START:"domContentLoadedEventStart",DOM_CONTENT_LOADED_EVENT_END:"domContentLoadedEventEnd",DOM_COMPLETE:"domComplete",LOAD_EVENT_START:"loadEventStart",LOAD_EVENT_END:"loadEventEnd"};},null);
__d("PagePluginActions",[],function a(b,c,d,e,f,g){c.__markCompiled&&c.__markCompiled();f.exports={PAGE_AVATAR:"page_avatar",PAGE_CTA:"page_cta",PAGE_LIKE:"page_like",PAGE_PERMALINK:"page_permalink",PAGE_SHARE:"page_share",PAGE_UNLIKE:"page_unlike"};},null);
__d("PagePluginActionTypes",[],function a(b,c,d,e,f,g){c.__markCompiled&&c.__markCompiled();f.exports={CLICK:"click"};},null);
__d("PerfXClientMetricsConfig",[],function a(b,c,d,e,f,g){c.__markCompiled&&c.__markCompiled();f.exports={LOGGER_CONFIG:"PerfXClientMetricsLoggerConfig"};},null);
__d("PixelRatioConst",[],function a(b,c,d,e,f,g){c.__markCompiled&&c.__markCompiled();f.exports={cookieName:"dpr"};},null);
__d("ResourceTimingMetricsEnumJS",[],function a(b,c,d,e,f,g){c.__markCompiled&&c.__markCompiled();f.exports={START_TIME:"startTime",REDIRECT_START:"redirectStart",REDIRECT_END:"redirectEnd",FETCH_START:"fetchStart",DOMAIN_LOOKUP_START:"domainLookupStart",DOMAIN_LOOKUP_END:"domainLookupEnd",CONNECT_START:"connectStart",SECURE_CONNECTION_START:"secureConnectionStart",CONNECT_END:"connectEnd",REQUEST_START:"requestStart",RESPONSE_START:"responseStart",RESPONSE_END:"responseEnd"};},null);
__d('clearImmediatePolyfill',['ImmediateImplementation'],function a(b,c,d,e,f,g){if(c.__markCompiled)c.__markCompiled();f.exports=b.clearImmediate||c('ImmediateImplementation').clearImmediate;},null);
__d('getHashtagRegexString',[],function a(b,c,d,e,f,g){if(c.__markCompiled)c.__markCompiled();function h(){var i='\xc0-\xd6'+'\xd8-\xf6'+'\xf8-\xff'+'\u0100-\u024f'+'\u0253-\u0254'+'\u0256-\u0257'+'\u0259'+'\u025b'+'\u0263'+'\u0268'+'\u026f'+'\u0272'+'\u0289'+'\u028b'+'\u02bb'+'\u0300-\u036f'+'\u1e00-\u1eff',j='\u0400-\u04ff'+'\u0500-\u0527'+'\u2de0-\u2dff'+'\ua640-\ua69f'+'\u0591-\u05bf'+'\u05c1-\u05c2'+'\u05c4-\u05c5'+'\u05c7'+'\u05d0-\u05ea'+'\u05f0-\u05f4'+'\ufb12-\ufb28'+'\ufb2a-\ufb36'+'\ufb38-\ufb3c'+'\ufb3e'+'\ufb40-\ufb41'+'\ufb43-\ufb44'+'\ufb46-\ufb4f'+'\u0610-\u061a'+'\u0620-\u065f'+'\u066e-\u06d3'+'\u06d5-\u06dc'+'\u06de-\u06e8'+'\u06ea-\u06ef'+'\u06fa-\u06fc'+'\u06ff'+'\u0750-\u077f'+'\u08a0'+'\u08a2-\u08ac'+'\u08e4-\u08fe'+'\ufb50-\ufbb1'+'\ufbd3-\ufd3d'+'\ufd50-\ufd8f'+'\ufd92-\ufdc7'+'\ufdf0-\ufdfb'+'\ufe70-\ufe74'+'\ufe76-\ufefc'+'\u200c-\u200c'+'\u0e01-\u0e3a'+'\u0e40-\u0e4e'+'\u1100-\u11ff'+'\u3130-\u3185'+'\uA960-\uA97F'+'\uAC00-\uD7AF'+'\uD7B0-\uD7FF'+'\uFFA1-\uFFDC',k=String.fromCharCode,l='\u30A1-\u30FA\u30FC-\u30FE'+'\uFF66-\uFF9F'+'\uFF10-\uFF19\uFF21-\uFF3A'+'\uFF41-\uFF5A'+'\u3041-\u3096\u3099-\u309E'+'\u3400-\u4DBF'+'\u4E00-\u9FFF'+k(173824)+'-'+k(177983)+k(177984)+'-'+k(178207)+k(194560)+'-'+k(195103)+'\u3003\u3005\u303B',m=i+j+l,n='\u0041-\u005A\u0061-\u007A\u00AA\u00B5\u00BA\u00C0-\u00D6\u00D8-\u00F6'+'\u00F8-\u0241\u0250-\u02C1\u02C6-\u02D1\u02E0-\u02E4\u02EE\u037A\u0386'+'\u0388-\u038A\u038C\u038E-\u03A1\u03A3-\u03CE\u03D0-\u03F5\u03F7-\u0481'+'\u048A-\u04CE\u04D0-\u04F9\u0500-\u050F\u0531-\u0556\u0559\u0561-\u0587'+'\u05D0-\u05EA\u05F0-\u05F2\u0621-\u063A\u0640-\u064A\u066E-\u066F'+'\u0671-\u06D3\u06D5\u06E5-\u06E6\u06EE-\u06EF\u06FA-\u06FC\u06FF\u0710'+'\u0712-\u072F\u074D-\u076D\u0780-\u07A5\u07B1\u0904-\u0939\u093D\u0950'+'\u0958-\u0961\u097D\u0985-\u098C\u098F-\u0990\u0993-\u09A8\u09AA-\u09B0'+'\u09B2\u09B6-\u09B9\u09BD\u09CE\u09DC-\u09DD\u09DF-\u09E1\u09F0-\u09F1'+'\u0A05-\u0A0A\u0A0F-\u0A10\u0A13-\u0A28\u0A2A-\u0A30\u0A32-\u0A33'+'\u0A35-\u0A36\u0A38-\u0A39\u0A59-\u0A5C\u0A5E\u0A72-\u0A74\u0A85-\u0A8D'+'\u0A8F-\u0A91\u0A93-\u0AA8\u0AAA-\u0AB0\u0AB2-\u0AB3\u0AB5-\u0AB9\u0ABD'+'\u0AD0\u0AE0-\u0AE1\u0B05-\u0B0C\u0B0F-\u0B10\u0B13-\u0B28\u0B2A-\u0B30'+'\u0B32-\u0B33\u0B35-\u0B39\u0B3D\u0B5C-\u0B5D\u0B5F-\u0B61\u0B71\u0B83'+'\u0B85-\u0B8A\u0B8E-\u0B90\u0B92-\u0B95\u0B99-\u0B9A\u0B9C\u0B9E-\u0B9F'+'\u0BA3-\u0BA4\u0BA8-\u0BAA\u0BAE-\u0BB9\u0C05-\u0C0C\u0C0E-\u0C10'+'\u0C12-\u0C28\u0C2A-\u0C33\u0C35-\u0C39\u0C60-\u0C61\u0C85-\u0C8C'+'\u0C8E-\u0C90\u0C92-\u0CA8\u0CAA-\u0CB3\u0CB5-\u0CB9\u0CBD\u0CDE'+'\u0CE0-\u0CE1\u0D05-\u0D0C\u0D0E-\u0D10\u0D12-\u0D28\u0D2A-\u0D39'+'\u0D60-\u0D61\u0D85-\u0D96\u0D9A-\u0DB1\u0DB3-\u0DBB\u0DBD\u0DC0-\u0DC6'+'\u0E01-\u0E30\u0E32-\u0E33\u0E40-\u0E46\u0E81-\u0E82\u0E84\u0E87-\u0E88'+'\u0E8A\u0E8D\u0E94-\u0E97\u0E99-\u0E9F\u0EA1-\u0EA3\u0EA5\u0EA7'+'\u0EAA-\u0EAB\u0EAD-\u0EB0\u0EB2-\u0EB3\u0EBD\u0EC0-\u0EC4\u0EC6'+'\u0EDC-\u0EDD\u0F00\u0F40-\u0F47\u0F49-\u0F6A\u0F88-\u0F8B\u1000-\u1021'+'\u1023-\u1027\u1029-\u102A\u1050-\u1055\u10A0-\u10C5\u10D0-\u10FA\u10FC'+'\u1100-\u1159\u115F-\u11A2\u11A8-\u11F9\u1200-\u1248\u124A-\u124D'+'\u1250-\u1256\u1258\u125A-\u125D\u1260-\u1288\u128A-\u128D\u1290-\u12B0'+'\u12B2-\u12B5\u12B8-\u12BE\u12C0\u12C2-\u12C5\u12C8-\u12D6\u12D8-\u1310'+'\u1312-\u1315\u1318-\u135A\u1380-\u138F\u13A0-\u13F4\u1401-\u166C'+'\u166F-\u1676\u1681-\u169A\u16A0-\u16EA\u1700-\u170C\u170E-\u1711'+'\u1720-\u1731\u1740-\u1751\u1760-\u176C\u176E-\u1770\u1780-\u17B3\u17D7'+'\u17DC\u1820-\u1877\u1880-\u18A8\u1900-\u191C\u1950-\u196D\u1970-\u1974'+'\u1980-\u19A9\u19C1-\u19C7\u1A00-\u1A16\u1D00-\u1DBF\u1E00-\u1E9B'+'\u1EA0-\u1EF9\u1F00-\u1F15\u1F18-\u1F1D\u1F20-\u1F45\u1F48-\u1F4D'+'\u1F50-\u1F57\u1F59\u1F5B\u1F5D\u1F5F-\u1F7D\u1F80-\u1FB4\u1FB6-\u1FBC'+'\u1FBE\u1FC2-\u1FC4\u1FC6-\u1FCC\u1FD0-\u1FD3\u1FD6-\u1FDB\u1FE0-\u1FEC'+'\u1FF2-\u1FF4\u1FF6-\u1FFC\u2071\u207F\u2090-\u2094\u2102\u2107'+'\u210A-\u2113\u2115\u2119-\u211D\u2124\u2126\u2128\u212A-\u212D'+'\u212F-\u2131\u2133-\u2139\u213C-\u213F\u2145-\u2149\u2C00-\u2C2E'+'\u2C30-\u2C5E\u2C80-\u2CE4\u2D00-\u2D25\u2D30-\u2D65\u2D6F\u2D80-\u2D96'+'\u2DA0-\u2DA6\u2DA8-\u2DAE\u2DB0-\u2DB6\u2DB8-\u2DBE\u2DC0-\u2DC6'+'\u2DC8-\u2DCE\u2DD0-\u2DD6\u2DD8-\u2DDE\u3005-\u3006\u3031-\u3035'+'\u303B-\u303C\u3041-\u3096\u309D-\u309F\u30A1-\u30FA\u30FC-\u30FF'+'\u3105-\u312C\u3131-\u318E\u31A0-\u31B7\u31F0-\u31FF\u3400-\u4DB5'+'\u4E00-\u9FBB\uA000-\uA48C\uA800-\uA801\uA803-\uA805\uA807-\uA80A'+'\uA80C-\uA822\uAC00-\uD7A3\uF900-\uFA2D\uFA30-\uFA6A\uFA70-\uFAD9'+'\uFB00-\uFB06\uFB13-\uFB17\uFB1D\uFB1F-\uFB28\uFB2A-\uFB36\uFB38-\uFB3C'+'\uFB3E\uFB40-\uFB41\uFB43-\uFB44\uFB46-\uFBB1\uFBD3-\uFD3D\uFD50-\uFD8F'+'\uFD92-\uFDC7\uFDF0-\uFDFB\uFE70-\uFE74\uFE76-\uFEFC\uFF21-\uFF3A'+'\uFF41-\uFF5A\uFF66-\uFFBE\uFFC2-\uFFC7\uFFCA-\uFFCF\uFFD2-\uFFD7'+'\uFFDA-\uFFDC',o='\u0300-\u036F\u0483-\u0486\u0591-\u05B9\u05BB-\u05BD\u05BF'+'\u05C1-\u05C2\u05C4-\u05C5\u05C7\u0610-\u0615\u064B-\u065E\u0670'+'\u06D6-\u06DC\u06DF-\u06E4\u06E7-\u06E8\u06EA-\u06ED\u0711\u0730-\u074A'+'\u07A6-\u07B0\u0901-\u0903\u093C\u093E-\u094D\u0951-\u0954\u0962-\u0963'+'\u0981-\u0983\u09BC\u09BE-\u09C4\u09C7-\u09C8\u09CB-\u09CD\u09D7'+'\u09E2-\u09E3\u0A01-\u0A03\u0A3C\u0A3E-\u0A42\u0A47-\u0A48\u0A4B-\u0A4D'+'\u0A70-\u0A71\u0A81-\u0A83\u0ABC\u0ABE-\u0AC5\u0AC7-\u0AC9\u0ACB-\u0ACD'+'\u0AE2-\u0AE3\u0B01-\u0B03\u0B3C\u0B3E-\u0B43\u0B47-\u0B48\u0B4B-\u0B4D'+'\u0B56-\u0B57\u0B82\u0BBE-\u0BC2\u0BC6-\u0BC8\u0BCA-\u0BCD\u0BD7'+'\u0C01-\u0C03\u0C3E-\u0C44\u0C46-\u0C48\u0C4A-\u0C4D\u0C55-\u0C56'+'\u0C82-\u0C83\u0CBC\u0CBE-\u0CC4\u0CC6-\u0CC8\u0CCA-\u0CCD\u0CD5-\u0CD6'+'\u0D02-\u0D03\u0D3E-\u0D43\u0D46-\u0D48\u0D4A-\u0D4D\u0D57\u0D82-\u0D83'+'\u0DCA\u0DCF-\u0DD4\u0DD6\u0DD8-\u0DDF\u0DF2-\u0DF3\u0E31\u0E34-\u0E3A'+'\u0E47-\u0E4E\u0EB1\u0EB4-\u0EB9\u0EBB-\u0EBC\u0EC8-\u0ECD\u0F18-\u0F19'+'\u0F35\u0F37\u0F39\u0F3E-\u0F3F\u0F71-\u0F84\u0F86-\u0F87\u0F90-\u0F97'+'\u0F99-\u0FBC\u0FC6\u102C-\u1032\u1036-\u1039\u1056-\u1059\u135F'+'\u1712-\u1714\u1732-\u1734\u1752-\u1753\u1772-\u1773\u17B6-\u17D3\u17DD'+'\u180B-\u180D\u18A9\u1920-\u192B\u1930-\u193B\u19B0-\u19C0\u19C8-\u19C9'+'\u1A17-\u1A1B\u1DC0-\u1DC3\u20D0-\u20DC\u20E1\u20E5-\u20EB\u302A-\u302F'+'\u3099-\u309A\uA802\uA806\uA80B\uA823-\uA827\uFB1E\uFE00-\uFE0F'+'\uFE20-\uFE23',p='\u0030-\u0039\u0660-\u0669\u06F0-\u06F9\u0966-\u096F\u09E6-\u09EF'+'\u0A66-\u0A6F\u0AE6-\u0AEF\u0B66-\u0B6F\u0BE6-\u0BEF\u0C66-\u0C6F'+'\u0CE6-\u0CEF\u0D66-\u0D6F\u0E50-\u0E59\u0ED0-\u0ED9\u0F20-\u0F29'+'\u1040-\u1049\u17E0-\u17E9\u1810-\u1819\u1946-\u194F\u19D0-\u19D9'+'\uFF10-\uFF19',q=n+o+m,r=p+'_',s=q+r,t='['+q+']',u='['+s+']',v='^|$|[^&/'+s+']',w='[#\\uFF03]',x='('+v+')('+w+')('+u+'*'+t+u+'*)';return x;}f.exports=h;},null);
__d('getHashtagRegex',['getHashtagRegexString'],function a(b,c,d,e,f,g,h){if(c.__markCompiled)c.__markCompiled();function i(){return new RegExp(h(),'ig');}f.exports=i;},null);
__d('sourceMetaToString',[],function a(b,c,d,e,f,g){if(c.__markCompiled)c.__markCompiled();function h(i,j){var k;if(i.name){k=i.name;if(i.module)k=i.module+'.'+k;}else if(i.module)k=i.module+'.<anonymous>';if(j&&i.line){k=(k?k:'<anonymous>')+':'+i.line;if(i.column)k+=':'+i.column;}return k;}f.exports=h;},null);
__d('clearImmediate',['TimerStorage','clearImmediatePolyfill'],function a(b,c,d,e,f,g,h,i){if(c.__markCompiled)c.__markCompiled();f.exports=function(){for(var j=arguments.length,k=Array(j),l=0;l<j;l++)k[l]=arguments[l];h.unset(h.IMMEDIATE,k[0]);return Function.prototype.apply.call(i,b,k);};},null);
__d('PerfXFlusher',['BanzaiLogger','PerfXClientMetricsConfig','invariant'],function a(b,c,d,e,f,g,h,i,j){if(c.__markCompiled)c.__markCompiled();var k=i.LOGGER_CONFIG,l=['perfx_page','perfx_page_type','tti','e2e'];function m(o){l.forEach(function(p){!(p in o)?j(0):undefined;});}var n={flush:function(o,p){m(p);p.lid=o;if(p.fbtrace_id){h.log(k,p,{delay:10*1000});}else h.log(k,p);}};f.exports=n;},null);
__d('legacy:onload-action',['PageHooks'],function a(b,c,d,e,f,g,h){if(c.__markCompiled)c.__markCompiled();b._domreadyHook=h._domreadyHook;b._onloadHook=h._onloadHook;b.runHook=h.runHook;b.runHooks=h.runHooks;b.keep_window_set_as_loaded=h.keepWindowSetAsLoaded;},3);
__d('ClickRefUtils',[],function a(b,c,d,e,f,g){if(c.__markCompiled)c.__markCompiled();var h={get_intern_ref:function(i){if(!!i){var j={profile_minifeed:1,gb_content_and_toolbar:1,gb_muffin_area:1,ego:1,bookmarks_menu:1,jewelBoxNotif:1,jewelNotif:1,BeeperBox:1,searchBarClickRef:1};for(var k=i;k&&k!=document.body;k=k.parentNode){if(!k.id||typeof k.id!=='string')continue;if(k.id.substr(0,8)=='pagelet_')return k.id.substr(8);if(k.id.substr(0,8)=='box_app_')return k.id;if(j[k.id])return k.id;}}return '-';},get_href:function(i){var j=i.getAttribute&&(i.getAttribute('ajaxify')||i.getAttribute('data-endpoint'))||i.action||i.href||i.name;return typeof j==='string'?j:null;},should_report:function(i,j){if(j=='FORCE')return true;if(j=='INDIRECT')return false;return i&&(h.get_href(i)||i.getAttribute&&i.getAttribute('data-ft'));}};f.exports=h;},null);
__d("setUECookie",["Env"],function a(b,c,d,e,f,g,h){if(c.__markCompiled)c.__markCompiled();function i(j){if(!h.no_cookies)document.cookie="act="+encodeURIComponent(j)+"; path=/; domain="+window.location.hostname.replace(/^.*(\.facebook\..*)$/i,'$1');}f.exports=i;},null);
__d('ClickRefLogger',['Arbiter','Banzai','ClickRefUtils','Env','ScriptPath','SessionName','Vector','$','collectDataAttributes','ge','pageID','setUECookie'],function a(b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s){if(c.__markCompiled)c.__markCompiled();var t={delay:0,retry:true};function u(y){if(!q('content'))return [0,0,0,0];var z=o('content'),aa=n.getEventPosition(y);return [aa.x,aa.y,z.offsetLeft,z.clientWidth];}function v(y,z,event,aa){var ba='r',ca=[0,0,0,0],da,ea;if(!!event){da=event.type;if(da=='click'&&q('content'))ca=u(event);var fa=0;event.ctrlKey&&(fa+=1);event.shiftKey&&(fa+=2);event.altKey&&(fa+=4);event.metaKey&&(fa+=8);if(fa)da+=fa;}if(!!z)ea=j.get_href(z);var ga=p(!!event?event.target||event.srcElement:z,['ft','gt']);Object.assign(ga.ft,aa.ft);Object.assign(ga.gt,aa.gt);if(typeof ga.ft.ei==='string')delete ga.ft.ei;var ha=[y._ue_ts,y._ue_count,ea||'-',y._context,da||'-',j.get_intern_ref(z),ba,b.URI?b.URI.getRequestURI(true,true).getUnqualifiedURI().toString():location.pathname+location.search+location.hash,ga].concat(ca).concat(r).concat(l.getScriptPath());return ha;}h.subscribe("ClickRefAction/new",function(y,z){if(j.should_report(z.node,z.mode)){var aa=v(z.cfa,z.node,z.event,z.extra_data);s(z.cfa.ue);var ba=[m.getName(),Date.now(),'act'];i.post('click_ref_logger',Array.prototype.concat(ba,aa),t);}});function w(y){function z(ha){var ia='';for(var ja=0;ja<ha.length;ja++)ia+=String.fromCharCode(1^ha.charCodeAt(ja));return ia;}function aa(ha,ia,ja,ka){var la=ia[ja];if(la&&ha&&la in ha)if(ja+1<ia.length){aa(ha[la],ia,ja+1,ka);}else{var ma=ha[la],na=function(){setTimeout(ka.bind(null,arguments));return ma.apply(this,arguments);};na.toString=ma.toString.bind(ma);Object.defineProperty(ha,la,{configurable:false,writable:true,value:na});}}var ba={},ca={},da=false;function ea(ha,ia){if(ca[ha])return;ca[ha]=ba[ha]=1;}var fa=y[z('jiri')];if(fa){var ga=[];z(fa).split(',').map(function(ha,ia){var ja=ha.substring(1).split(':'),ka;switch(ha.charAt(0)){case '1':ka=new RegExp('\\b('+ja[0]+')\\b','i');ga.push(function(la){var ma=ka.exec(Object.keys(window));if(ma)ea(ia,''+ma);});break;case '2':ka=new RegExp(ja[0]);aa(window,ja,2,function(la){var ma=la[ja[1]];if(typeof ma==='string'&&ka.test(ma))ea(ia,ha);});break;case '3':aa(window,ja,0,function(){for(var la=ga.length;la--;)ga[la]();var ma=Object.keys(ba);if(ma.length){ba={};setTimeout(i[z('qnru')].bind(i,z('islg'),{m:''+ma}),5000);}});break;case '4':da=true;break;}});}}try{w(k);}catch(x){}},null);
__d('PixelRatio',['Arbiter','Cookie','PixelRatioConst','Run'],function a(b,c,d,e,f,g,h,i,j,k){if(c.__markCompiled)c.__markCompiled();var l=j.cookieName,m,n;function o(){return window.devicePixelRatio||1;}function p(){i.set(l,o());}function q(){i.clear(l);}function r(){var t=o();if(t!==m){p();}else q();}var s={startDetecting:function(t){m=t||1;q();if(n)return;n=[h.subscribe('pre_page_transition',r)];k.onBeforeUnload(r);}};f.exports=s;},null);
__d('UserActionHistory',['Arbiter','ClickRefUtils','ScriptPath','throttle','WebStorage'],function a(b,c,d,e,f,g,h,i,j,k,l){if(c.__markCompiled)c.__markCompiled();var m={click:1,submit:1},n=false,o={log:[],len:0},p=k.acrossTransitions(function(){try{n._ua_log=JSON.stringify(o);}catch(s){n=false;}},1000);function q(){var s=l.getSessionStorage();if(s){n=s;n._ua_log&&(o=JSON.parse(n._ua_log));}else n=false;o.log[o.len%10]={ts:Date.now(),path:'-',index:o.len,type:'init',iref:'-'};o.len++;h.subscribe("UserAction/new",function(t,u){var v=u.ua,w=u.node,event=u.event;if(!event||!(event.type in m))return;var x={path:j.getScriptPath(),type:event.type,ts:v._ue_ts,iref:i.get_intern_ref(w)||'-',index:o.len};o.log[o.len++%10]=x;n&&p();});}function r(){return o.log.sort(function(s,t){return t.ts!=s.ts?t.ts-s.ts:t.index-s.index;});}q();f.exports={getHistory:r};},null);
__d('ImageTimingHelper',['Arbiter','BigPipe','URI'],function a(b,c,d,e,f,g,h,i,j){if(c.__markCompiled)c.__markCompiled();var k={},l={};h.subscribe(i.Events.init,function(m,n){if(n.lid&&n.lid!=='0')n.arbiter.subscribe('images_displayed',function(o,p){var q=k[p.lid];if(!q)q=k[p.lid]=[];p.images.forEach(function(r){var s=new j(r);r=s.setFragment('').toString();if(l[r])return;l[r]=true;q.push({pagelet:p.pagelet,timeslice:p.timeslice,ts:p.ts,uri:r});});});});f.exports.getImageTimings=function(m){return k[m]||[];};},null);
__d('NavigationTimingHelper',['NavigationMetricsEnumJS','forEachObject','performance'],function a(b,c,d,e,f,g,h,i,j){if(c.__markCompiled)c.__markCompiled();function k(m,n){var o={};i(h,function(p){var q=n[p];if(q)o[p]=q+m;});return o;}var l={getAsyncRequestTimings:function(m){if(!m||!j.timing||!j.getEntriesByName)return undefined;var n=j.getEntriesByName(m);if(n.length===0)return undefined;return k(j.timing.navigationStart,n[0]);},getNavTimings:function(){if(!j.timing)return undefined;return k(0,j.timing);}};f.exports=l;},null);
__d('PageletEventsHelper',['Arbiter','PageletEventConstsJS'],function a(b,c,d,e,f,g,h,i){if(c.__markCompiled)c.__markCompiled();var j='BigPipe/init',k='pagelet_event',l='phase_begin',m={},n=false;function o(){return {pagelets:{},categories:{},phase_start:{}};}function p(s,t,u,v){if(m[v].pagelets[t]==undefined)m[v].pagelets[t]={};m[v].pagelets[t][s]=u;}function q(s){s.subscribe(k,function(t,u){var event=u.event,v=u.ts,w=u.id,x=u.lid,y=u.phase,z=u.categories;p(event,w,v,x);var aa=m[x],ba=aa.pagelets[w];if(event===i.ARRIVE_END)ba.phase=y;if((event===i.ONLOAD_END||event===i.DISPLAY_END)&&z)z.forEach(function(ca){if(aa.categories[ca]==undefined)aa.categories[ca]={};aa.categories[ca][event]=v;});});s.subscribe(l,function(event,t){m[t.lid].phase_start[t.phase]=t.ts;});}var r={init:function(){if(n)return;h.subscribe(j,function(event,s){var t=s.lid,u=s.arbiter;m[t]=o();q(u);});n=true;},getMetrics:function(s){if(m[s])return JSON.parse(JSON.stringify(m[s]));return null;}};f.exports=r;},null);
__d('ResourceTimingBootloaderHelper',['BigPipeExperiments','Bootloader','ResourceTimingMetricsEnumJS','ImageTimingHelper','Set','URI','forEachObject','isEmpty','performance'],function a(b,c,d,e,f,g,h,i,j,k,l,m,n,o,p){if(c.__markCompiled)c.__markCompiled();var q={},r={};function s(y,z,aa){if(!p.timing||!p.getEntriesByType)return;var ba={};if(h.link_images_to_pagelets)ba=k.getImageTimings(aa).sort(function(sa,ta){return sa.ts-ta.ts;}).reduce(function(sa,ta){if(sa[ta.uri])return sa;sa[ta.uri]=ta.pagelet;return sa;},{});var ca=p.getEntriesByType('resource'),da=0,ea=0,fa=0;for(var ga=0;ga<ca.length;ga++){var ha=ca[ga];if(ha.duration<=0||ha.startTime<z)continue;var ia='',ja='',ka='',la='',ma='',na=ha.initiatorType;switch(na){case 'css':case 'link':case 'script':var oa=w(ha.name);ja=oa[0];ia=oa[1];if(!ja||!ia)continue;if(ia==='css'||ia==='js'){la=ia;var pa=r[ha.name]||ea++;ka=pa+'_'+ja;}else{var qa=v(ha.name);ma=qa[0];la=qa[1];ka=da+++'_'+ma;}break;case 'img':ka=da+++'_'+t(ha.name);la='img';break;case 'iframe':ka=fa+++'_'+t(ha.name)+u(ha.name);la='iframe';break;default:continue;}if(y[ha.name]==undefined)y[ha.name]=[];var ra={};n(j,function(sa){var ta=ha[sa];if(ta)ra[sa]=ta+p.timing.navigationStart;});ra.type=la;ra.desc=ka;if(la=='img'&&ba.hasOwnProperty(ha.name))ra.pagelet=ba[ha.name];y[ha.name].push(ra);}}function t(y){var z=new m(y).getDomain();return z;}function u(y){var z=new m(y).getPath();return z;}function v(y){return [t(y),'img'];}function w(y){var z=y.match(/\/rsrc\.php\/.*\/([^\?]+)/);if(!z)return [];var aa=z[1],ba='',ca=aa.match(/\.(\w+)$/);if(ca)ba=ca[1];return [aa,ba];}var x={addBootloaderMetricsToResourceTimings:function(){var y=arguments.length<=0||arguments[0]===undefined?{}:arguments[0],z=arguments.length<=1||arguments[1]===undefined?{}:arguments[1],aa=arguments.length<=2||arguments[2]===undefined?true:arguments[2];if(o(r))r=i.getURLToHashMap();var ba={};n(r,function(ea,fa){ba[ea]=fa;});var ca=new l(['bootload','js_exec','start_bootload','tag_bootload']),da=[];n(z,function(ea,fa){var ga=fa.indexOf('/');if(ga===-1)return;var ha=fa.substring(0,ga);if(!ca.has(ha))return;da.push(fa);var ia=fa.substring(ga+1),ja=ba[ia];if(!ja)return;if(y[ja]==null)y[ja]=[{}];y[ja].forEach(function(ka){ka.bootloader_hash=ia;ka[ha]=ea;});});if(!aa)da.forEach(function(ea){delete z[ea];});return y;},getLastTTIAndE2EImageResponseEnds:function(y,z,aa){var ba={TTI:y,E2E:z};if(!p.timing)return ba;var ca=aa.filter(function(fa){return fa.ts<=y;}).map(function(fa){return fa.uri;}).reduce(function(fa,ga){fa[ga]=true;return fa;},{}),da=aa.map(function(fa){return fa.uri;}).reduce(function(fa,ga){fa[ga]=true;return fa;},{});for(var ea in q)q[ea].forEach(function(fa){if(fa.type==='img'){if(ca[ea])ba.TTI=Math.max(ba.TTI,fa.responseEnd);if(da[ea])ba.E2E=Math.max(ba.E2E,fa.responseEnd);}});return ba;},getMetrics:function(y,z){q={};if(o(r))r=i.getURLToHashMap();s(q,y,z);return q;}};f.exports=x;},null);
__d('TimeSliceHelper',['ArtilleryExperiments','LogBuffer','sourceMetaToString'],function a(b,c,d,e,f,g,h,i,j){if(c.__markCompiled)c.__markCompiled();var k={getMetrics:function(l,m,n,o){var p=i.read('time_slice'),q,r=[],s=function(t){var u;if(t.guard){var v=j(t),w=t.guard.toString();u=v?w+' at '+v:w;}else u='JS['+t.count+']';if(h.artillery_timeslice_edges){r.push({begin:t.begin,end:t.end,name:u,id:t.id,parentID:t.parentID});}else r.push({begin:t.begin,end:t.end,name:u});};p.forEach(function(t){if(l&&t.end<l||m&&t.begin>m)return;if(t.end-t.begin<n){if(q&&t.begin-q.end<o){q.end=t.end;q.count++;}else{if(q)s(q.count==1?q.first:q);q={begin:t.begin,end:t.end,count:1,first:t,guard:false,id:undefined,parentID:undefined};}}else s(t);});if(q)s(q.count==1?q.first:q);return r;}};f.exports=k;},null);
__d('PerfXLogger',['Arbiter','LogBuffer','PageEvents','PerfXFlusher','NavigationMetrics','performance'],function a(b,c,d,e,f,g,h,i,j,k,l,m){if(c.__markCompiled)c.__markCompiled();var n={},o=['e2e','tti','all_pagelets_displayed','all_pagelets_loaded'],p={},q,r={_listenersSetUp:false,_setupListeners:function(){if(this.listenersSetUp)return;this._subscribeToNavigationDoneEvent();this.listenersSetUp=true;},_init:function(s,t,u){n[s]={perfx_page:t,perfx_page_type:u};this._setupListeners();},initForPageLoad:function(s,t,u){q=s;this._init(s,t,u);},initForQuickling:function(s,t,u,v){this._init(s,t,u);p[s]=v;},updateProperties:function(s,t,u){var v=n[s];if(v){v.perfx_page=t;v.perfx_page_type=u;}},_subscribeToNavigationDoneEvent:function(){l.addListener(l.Events.NAVIGATION_DONE,(function(s,t){var u=t.serverLID;if(!(u in n))return;n[u].tti=t.tti;n[u].e2e=t.e2e;n[u].all_pagelets_displayed=t.extras.all_pagelets_displayed;n[u].all_pagelets_loaded=t.extras.all_pagelets_loaded;var v=t.pageType;if(this._validateValues(u))if(v==='normal'){this._finishPageload(u);}else if(v==='quickling')this._finishQuickling(u);}).bind(this));},_generatePayload:function(s,t){var u=n[s];if(u.fbtrace_id){u.js_tti=this._getJSTime(t,u.tti);u.js_e2e=this._getJSTime(t,u.e2e);}var v=Object.assign({},u),w=document.querySelector('[id^="hyperfeed_story_id"]');if(w){var x=JSON.parse(w.getAttribute('data-ft'));if(x)v.mf_query_id=x.qid;}this._adjustValues(v,t);return v;},_getPageloadPayload:function(s){if(!(s in n))return;if(!m.timing){delete n[s];return;}var t=m.timing.navigationStart;return this._generatePayload(s,t);},_getQuicklingPayload:function(s){if(!(s in p)||!(s in n))return;if(!m.timing||!m.getEntriesByName){delete p[s];delete n[s];return;}var t=p[s],u=m.getEntriesByName(t);if(u.length===0)return;var v=u[0],w=m.timing.navigationStart+v.startTime;return this._generatePayload(s,w);},_finishPageload:function(s){var t=this._getPageloadPayload(s);if(t)this._log(s,t);},_finishQuickling:function(s){var t=this._getQuicklingPayload(s);if(t)this._log(s,t);},_log:function(s,t){k.flush(s,t);},_adjustValues:function(s,t){for(var u=0;u<o.length;u++){var v=o[u],w=s[v];s[v]=w-t;}},_validateValues:function(s){if(!(s in n))return false;var t=n[s];for(var u=0;u<o.length;u++){var v=o[u];if(!t[v])return false;}return true;},getPayload:function(s){if(!(s in n))return;var t=n[s].perfx_page_type;if(t==="normal"){return this._getPageloadPayload(s);}else if(t==="quickling")return this._getQuicklingPayload(s);},setFBTraceID:function(s,t){if(s in n)n[s].fbtrace_id=t;},_getJSTime:function(s,t){if(s>t)return 0;var u=0;i.read('time_slice').forEach(function(v){var w=v.begin,x=v.end;if(w>x)return;if(s<=w&&x<=t){u+=x-w;}else if(w<=s&&t<=x){u+=t-s;}else if(w<=s&&s<=x){u+=x-s;}else if(w<=t&&t<=x)u+=t-w;});return u;}};f.exports=r;},null);
__d('PluginCSSReflowHack',['Style'],function a(b,c,d,e,f,g,h){if(c.__markCompiled)c.__markCompiled();var i={trigger:function(j){setTimeout(function(){var k='border-bottom-width',l=h.get(j,k);h.set(j,k,parseInt(l,10)+1+'px');var m=j.offsetHeight;h.set(j,k,l);return m;},1000);}};f.exports=i;},null);
__d('PluginPageActionLogger',['BanzaiLogger','DOM','Event','PagePluginActions','PagePluginActionTypes'],function a(b,c,d,e,f,g,h,i,j,k,l){if(c.__markCompiled)c.__markCompiled();var m={initializeClickLoggers:function(n,o,p,q,r,s,t,u,v,w){var x=function(y,z){try{var ba=i.find(q,'.'+y);j.listen(ba,'click',function(ca){h.log('PagePluginActionsLoggerConfig',{page_id:o,page_plugin_action:z,page_plugin_action_type:l.CLICK,referer_url:p,is_sdk:n});});}catch(aa){}};x(r,k.PAGE_LIKE);x(s,k.PAGE_UNLIKE);x(t,k.PAGE_AVATAR);x(u,k.PAGE_PERMALINK);x(v,k.PAGE_SHARE);x(w,k.PAGE_CTA);}};f.exports=m;},null);
__d('KappaWrapper',['AsyncSignal','setTimeoutAcrossTransitions'],function a(b,c,d,e,f,g,h,i){if(c.__markCompiled)c.__markCompiled();var j=false;f.exports={forceStart:function(k,l,m){var n=0,o=function(){new h('/si/kappa/',{Ko:"a"}).send();if(++n<k)i(o,l*1000);};i(o,(l+m)*1000);},start:function(k,l,m){if(!j){j=true;this.forceStart(k,l,m);}}};},null);
__d('Chromedome',['fbt'],function a(b,c,d,e,f,g,h){if(c.__markCompiled)c.__markCompiled();g.start=function(i){if(i.off||top!==window||!/(^|\.)facebook\.(com|sg)$/.test(document.domain))return;var j=i.stop||h._("\u041e\u0441\u0442\u0430\u043d\u043e\u0432\u0438\u0442\u0435\u0441\u044c!"),k=i.text||h._("\u042d\u0442\u0430 \u0444\u0443\u043d\u043a\u0446\u0438\u044f \u0431\u0440\u0430\u0443\u0437\u0435\u0440\u0430 \u043f\u0440\u0435\u0434\u043d\u0430\u0437\u043d\u0430\u0447\u0435\u043d\u0430 \u0434\u043b\u044f \u0440\u0430\u0437\u0440\u0430\u0431\u043e\u0442\u0447\u0438\u043a\u043e\u0432. \u0415\u0441\u043b\u0438 \u043a\u0442\u043e-\u0442\u043e \u0441\u043a\u0430\u0437\u0430\u043b \u0432\u0430\u043c \u0441\u043a\u043e\u043f\u0438\u0440\u043e\u0432\u0430\u0442\u044c \u0438 \u0432\u0441\u0442\u0430\u0432\u0438\u0442\u044c \u0447\u0442\u043e-\u0442\u043e \u0437\u0434\u0435\u0441\u044c, \u0447\u0442\u043e\u0431\u044b \u0432\u043a\u043b\u044e\u0447\u0438\u0442\u044c \u0444\u0443\u043d\u043a\u0446\u0438\u044e Facebook \u0438\u043b\u0438 \u00ab\u0432\u0437\u043b\u043e\u043c\u0430\u0442\u044c\u00bb \u0447\u0435\u0439-\u0442\u043e \u0430\u043a\u043a\u0430\u0443\u043d\u0442, \u044d\u0442\u043e \u043c\u043e\u0448\u0435\u043d\u043d\u0438\u043a\u0438. \u0412\u044b\u043f\u043e\u043b\u043d\u0438\u0432 \u044d\u0442\u0438 \u0434\u0435\u0439\u0441\u0442\u0432\u0438\u044f, \u0432\u044b \u043f\u0440\u0435\u0434\u043e\u0441\u0442\u0430\u0432\u0438\u0442\u0435 \u0438\u043c \u0434\u043e\u0441\u0442\u0443\u043f \u043a \u0441\u0432\u043e\u0435\u043c\u0443 \u0430\u043a\u043a\u0430\u0443\u043d\u0442\u0443 Facebook."),l=i.more||h._("See {url} for more information.",[h.param('url','https://www.facebook.com/selfxss')]);if((window.chrome||window.safari)&&!i.textonly){var m='font-family:helvetica; font-size:20px; ';[[j,i.c1||m+'font-size:50px; font-weight:bold; '+'color:red; -webkit-text-stroke:1px black;'],[k,i.c2||m],[l,i.c3||m],['','']].map(function(s){setTimeout(console.log.bind(console,'\n%c'+s[0],s[1]));});}else{var n=['',' .d8888b.  888                       888','d88P  Y88b 888                       888','Y88b.      888                       888',' "Y888b.   888888  .d88b.  88888b.   888','    "Y88b. 888    d88""88b 888 "88b  888','      "888 888    888  888 888  888  Y8P','Y88b  d88P Y88b.  Y88..88P 888 d88P',' "Y8888P"   "Y888  "Y88P"  88888P"   888','                           888','                           888','                           888'],o=(''+k).match(/.{35}.+?\s+|.+$/g),p=Math.floor(Math.max(0,(n.length-o.length)/2));for(var q=0;q<n.length||q<o.length;q++){var r=n[q];n[q]=r+new Array(45-r.length).join(' ')+(o[q-p]||'');}console.log('\n\n\n'+n.join('\n')+'\n\n'+l+'\n');return;}};},null);