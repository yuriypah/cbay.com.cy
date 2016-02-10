/*!CK:2220515436!*//*1454307979,*/

if (self.CavalryLogger) { CavalryLogger.start_js(["E4ZWl"]); }

__d("MercuryParticipantTypes",[],function a(b,c,d,e,f,g){c.__markCompiled&&c.__markCompiled();f.exports={USER:"user",THREAD:"thread",EVENT:"event",PAGE:"page",FRIEND:"friend",FB4C:"fb4c",NON_FRIEND:"non_friend"};},null);
__d("SyncRequestStatusEnum",[],function a(b,c,d,e,f,g){c.__markCompiled&&c.__markCompiled();f.exports={PENDING:0,ACCEPTED:1,REJECTED:2,EXPIRED:3,CANCELED:4,namesByValue:["PENDING","ACCEPTED","REJECTED","EXPIRED","CANCELED"]};},null);
__d('ChatTypeaheadConstants',[],function a(b,c,d,e,f,g){if(c.__markCompiled)c.__markCompiled();var h={USER_TYPE:'user',THREAD_TYPE:'thread',FRIEND_TYPE:'friend',NON_FRIEND_TYPE:'non_friend',FB4C_TYPE:'fb4c',PAGE_TYPE:'page',MEETING_ROOM_PAGE_TYPE:'meeting_room_page',COMMERCE_PAGE_TYPE:'commerce_page',HEADER_TYPE:'header'};f.exports=h;},null);
__d('MercuryIDs',[],function a(b,c,d,e,f,g){if(c.__markCompiled)c.__markCompiled();var h={isValid:function(i){if(!i||typeof i!=='string')return false;return (/^\w{3,12}:/.test(i));},isValidThreadID:function(i){if(!h.isValid(i))return false;var j=h.tokenize(i);switch(j.type){case 'user':case 'group':case 'thread':case 'root':case 'pending':return true;default:return false;}},tokenize:function(i){if(!this.isValid(i))throw new Error('bad_id_format '+i);var j=i.indexOf(':');return {type:i.substr(0,j),value:i.substr(j+1)};},getUserIDFromParticipantID:function(i){if(!this.isValid(i))throw new Error('bad_id_format '+i);var j=h.tokenize(i),k=j.type,l=j.value;if(k!='fbid')return null;return l;},getParticipantIDFromUserID:function(i){if(isNaN(i))throw new Error('Not a user ID: '+i);return 'fbid:'+i;},getUserIDFromThreadID:function(i){if(!this.isCanonical(i))return null;return this.tokenize(i).value;},getThreadIDFromUserID:function(i){return 'user:'+i;},getThreadIDFromThreadFBID:function(i){return 'thread:'+i;},getThreadIDFromParticipantID:function(i){var j=this.getUserIDFromParticipantID(i);return j?this.getThreadIDFromUserID(j):null;},getParticipantIDFromFromThreadID:function(i){return this.getParticipantIDFromUserID(this.getUserIDFromThreadID(i)||'');},isCanonical:function(i){return this.isValid(i)&&this.tokenize(i).type==='user';},isGroupChat:function(i){return this.isValid(i)&&this.tokenize(i).type!=='user';},isLocalThread:function(i){return this.isValid(i)&&this.tokenize(i).type==='root';}};f.exports=h;},null);
__d('WebMessengerPermalinkConstants',['URI'],function a(b,c,d,e,f,g,h){if(c.__markCompiled)c.__markCompiled();var i={ARCHIVED_PATH:'/messages/archived',BASE_PATH:'/messages',PENDING_PATH:'/messages/pending',OTHER_PATH:'/messages/other',SPAM_PATH:'/messages/spam',COMPOSE_POSTFIX_PATH:'/new',SEARCH_POSTFIX_PATH:'/search',TID_POSTFIX_PARTIAL_PATH:'/conversation-',overriddenVanities:'(archived|other|pending|spam|new|search|conversation-.*)',getURIPathForThreadID:function(j,k){return (k||i.BASE_PATH)+i.TID_POSTFIX_PARTIAL_PATH+h.encodeComponent(h.encodeComponent(j));},getThreadIDFromURI:function(j){var k=j.getPath().match(i.BASE_PATH+'(/[^/]*)*'+i.TID_POSTFIX_PARTIAL_PATH+'([^/]+)');if(k){var l=h.decodeComponent(h.decodeComponent(k[2]));return l;}},getURIPathForIDOrVanity:function(j,k){if(j.match('^'+i.overriddenVanities+'$'))j='.'+j;return (k||i.BASE_PATH)+'/'+j;},getUserIDOrVanity:function(j){var k=j.match(i.BASE_PATH+'.*/([^/]+)/?$'),l=k&&k[1],m=i.overriddenVanities;if(!l||l.match('^'+m+'$')){return false;}else if(l.match('^\\.'+m+'$')){return l.substr(1);}else return l;}};f.exports=i;},null);
__d('ChatOpenTab',['ChatTypeaheadConstants','ContextualThing','Event','MercuryIDs','MercuryParticipantTypes','Parent','URI','WebMessengerPermalinkConstants','csx','curry','cx','emptyFunction','goURI','ifRequired','requireWeak'],function a(b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v){'use strict';if(c.__markCompiled)c.__markCompiled();var w=null;v('ChatApp',function(ha){return w=ha;});function x(ha,ia){var ja=ha?new n(o.getURIPathForThreadID(ha)):new n(o.BASE_PATH+o.COMPOSE_POSTFIX_PATH);if(ia)ja.addQueryData({ref:ia});u('BusinessURI.brands',function(ka){return t(ka(ja));},function(){return t(ja);});}function y(ha,ia){x(k.getThreadIDFromUserID(ha),ia);}function z(ha,ia,ja){y(ia,ja);}function aa(ha,ia){x(k.getThreadIDFromThreadFBID(ha),ia);}function ba(ha,ia){x(null,ia);}function ca(ha,ia,ja,ka){j.listen(ha,'click',function(la){if(ga.canOpenTab()){ka(ia,ja);return la.kill();}});}function da(ha,ia,ja,ka){j.listen(ha,'click',function(la){if(ga.canOpenTab())ka(ia,ja);});}function ea(ha,ia,ja,ka){ga.impl()._logChatOpenTabEvent(ha,ia,ja,ka);}function fa(ha){var ia=i.getContext(ha);return ia&&m.bySelector(ia,"._3qw")!==null;}var ga={canOpenTab:function(){return w&&!w.isHidden();},openEmptyTab:function(ha,ia,ja){ga.impl().openEmptyTab(ha,ia,ja);},listenOpenEmptyTab:function(ha,ia){ca(ha,null,ia,ga.openEmptyTab);},openThread:function(ha,ia,ja,ka,la){ga.impl().openThreadTab(ha,ia,ja,ka,la);},openClientTab:function(ha,ia,ja,ka,la){var ma=ga.impl();ma.openClientTab(ha,ka,la);ma._logChatOpenTabEvent(ia,ha,null,ja);},listenOpenThread:function(ha,ia,ja){ca(ha,ia,ja,ga.openThread);},openUserTab:function(ha,ia,ja){ga.impl().openUserTab(ha,ia,ja);},openPageTab:function(ha,ia,ja){ga.impl().openPageTab(ha,ia,ja);return true;},listenOpenUserTab:function(ha,ia,ja){if(!fa(ha))ca(ha,ia,ja,ga.openUserTab);},listenOpenPageTab:function(ha,ia,ja,ka){if(!fa(ha))ca(ha,ia,ka,q(ga.openPageTab,ja));},listenOpenPageTabPersistentEvent:function(ha,ia,ja,ka){if(!fa(ha))da(ha,ia,ka,q(ga.openPageTab,ja));},openTabByType:function(ha,ia,ja){if(ia===h.THREAD_TYPE){if(ha){this.openThread(ha,ja);}else this.openEmptyTab(null,ja);}else if(!ia||ia===l.FRIEND||ia===h.FRIEND_TYPE||ia===h.PAGE_TYPE||ia===h.USER_TYPE)this.openUserTab(ha,ja);},impl:function(){if(w&&w.isInitialized()&&!w.isHidden()&&w.chatOpenTabImpl){return w.chatOpenTabImpl;}else return {openClientTab:x,openUserTab:y,openEmptyTab:ba,openThreadTab:aa,openPageTab:z,_logChatOpenTabEvent:s};}};f.exports=ga;},null);
__d("arrayStableSort",[],function a(b,c,d,e,f,g){if(c.__markCompiled)c.__markCompiled();function h(i,j){return i.map(function(k,l){return {data:k,index:l};}).sort(function(k,l){return j(k.data,l.data)||k.index-l.index;}).map(function(k){return k.data;});}f.exports=h;},null);
__d('RangedCallbackManager',['CallbackManagerController','arrayStableSort','createObjectFrom'],function a(b,c,d,e,f,g,h,i,j){if(c.__markCompiled)c.__markCompiled();function k(l,m,n){'use strict';this.$RangedCallbackManager1=[];this.$RangedCallbackManager2=false;this.$RangedCallbackManager3=false;this.$RangedCallbackManager4={};this.$RangedCallbackManager5=new h(this.$RangedCallbackManager6.bind(this));this.$RangedCallbackManager7=l;this.$RangedCallbackManager8=m;this.$RangedCallbackManager9=n;}k.prototype.executeOrEnqueue=function(l,m,n,o,p){'use strict';return this.$RangedCallbackManager5.executeOrEnqueue({start:l,limit:m},n,{strict:!!o,skipOnStrictHandler:p});};k.prototype.unsubscribe=function(l){'use strict';this.$RangedCallbackManager5.unsubscribe(l);};k.prototype.getUnavailableResources=function(l){'use strict';var m=this.$RangedCallbackManager5.getRequest(l),n=[];if(m&&!this.$RangedCallbackManager2){var o=m.request,p=this.$RangedCallbackManager10(m.options),q=o.start+o.limit;for(var r=p.length;r<q;r++)n.push(r);}return n;};k.prototype.addResources=function(l){'use strict';l.forEach((function(m){if(!this.$RangedCallbackManager4[m]){this.$RangedCallbackManager4[m]=true;this.$RangedCallbackManager1.push(m);this.$RangedCallbackManager3=null;}}).bind(this));this.resortResources();this.$RangedCallbackManager5.runPossibleCallbacks();};k.prototype.addResourcesWithoutSorting=function(l,m){'use strict';var n=this.$RangedCallbackManager1.slice(0,m);n=n.concat(l);n=n.concat(this.$RangedCallbackManager1.slice(m));this.$RangedCallbackManager1=n;Object.assign(this.$RangedCallbackManager4,j(l,true));this.$RangedCallbackManager3=null;this.$RangedCallbackManager5.runPossibleCallbacks();};k.prototype.removeResources=function(l){'use strict';l.forEach((function(m){if(this.$RangedCallbackManager4[m]){this.$RangedCallbackManager4[m]=false;var n=this.$RangedCallbackManager1.indexOf(m);if(n!=-1)this.$RangedCallbackManager1.splice(n,1);}}).bind(this));};k.prototype.removeAllResources=function(){'use strict';this.$RangedCallbackManager1=[];this.$RangedCallbackManager4={};};k.prototype.resortResources=function(){'use strict';this.$RangedCallbackManager1=i(this.$RangedCallbackManager1,(function(l,m){return (this.$RangedCallbackManager8(this.$RangedCallbackManager7(l),this.$RangedCallbackManager7(m)));}).bind(this));};k.prototype.setReachedEndOfArray=function(){'use strict';if(!this.$RangedCallbackManager2){this.$RangedCallbackManager2=true;this.$RangedCallbackManager3=null;this.$RangedCallbackManager5.runPossibleCallbacks();}};k.prototype.hasReachedEndOfArray=function(){'use strict';return this.$RangedCallbackManager2;};k.prototype.setError=function(l){'use strict';if(this.$RangedCallbackManager3!==l){this.$RangedCallbackManager3=l;this.$RangedCallbackManager5.runPossibleCallbacks();}};k.prototype.getError=function(l,m,n){'use strict';var o=this.$RangedCallbackManager10({strict:n});return l+m>o.length?this.$RangedCallbackManager3:null;};k.prototype.hasResource=function(l){'use strict';return this.$RangedCallbackManager4[l];};k.prototype.getResourceAtIndex=function(l){'use strict';return this.$RangedCallbackManager1[l];};k.prototype.getAllResources=function(){'use strict';return this.$RangedCallbackManager1.concat();};k.prototype.getCurrentArraySize=function(l){'use strict';return this.$RangedCallbackManager10(l).length;};k.prototype.$RangedCallbackManager10=function(l){'use strict';var m=this.$RangedCallbackManager1;if(l&&l.strict){var n=l.skipOnStrictHandler||this.$RangedCallbackManager9;if(n)m=m.filter(n);}return m;};k.prototype.$RangedCallbackManager6=function(l,m){'use strict';var n=this.$RangedCallbackManager10(m);if(!this.$RangedCallbackManager2&&!this.$RangedCallbackManager3&&l.start+l.limit>n.length){return false;}else{var o=n.slice(l.start,l.start+l.limit),p=l.start+l.limit>n.length?this.$RangedCallbackManager3:null;return [o,p];}};k.prototype.getElementsUntil=function(l){'use strict';var m=[];for(var n=0;n<this.$RangedCallbackManager1.length;n++){var o=this.$RangedCallbackManager7(this.$RangedCallbackManager1[n]);if(this.$RangedCallbackManager8(o,l)>0)break;m.push(this.$RangedCallbackManager1[n]);}return m;};f.exports=k;},null);
__d("cancelAnimationFramePolyfill",[],function a(b,c,d,e,f,g){if(c.__markCompiled)c.__markCompiled();var h=b.cancelAnimationFrame||b.webkitCancelAnimationFrame||b.mozCancelAnimationFrame||b.oCancelAnimationFrame||b.msCancelAnimationFrame||b.clearTimeout;f.exports=h;},null);
__d('padNumber',[],function a(b,c,d,e,f,g){'use strict';if(c.__markCompiled)c.__markCompiled();function h(i,j){var k=i.toString();if(k.length>=j)return k;return Array(j-k.length+1).join('0')+k;}f.exports=h;},null);
__d("DateConsts",[],function a(b,c,d,e,f,g){if(c.__markCompiled)c.__markCompiled();var h=1000,i=60,j=60,k=24,l=7,m=12,n=30.43,o=365.242,p=i*j,q=p*k,r=q*l,s=q*o,t=h*i,u=t*j,v=h*q,w=v*l,x=v*o,y={SUNDAY:0,MONDAY:1,TUESDAY:2,WEDNESDAY:3,THURSDAY:4,FRIDAY:5,SATURDAY:6};Object.freeze(y);var z={getDaysInMonth:function(aa,ba){return new Date(aa,ba,0).getDate();},getCurrentTimeInSeconds:function(){return Date.now()/h;},DAYS:y,MS_PER_SEC:h,MS_PER_MIN:t,MS_PER_HOUR:u,MS_PER_DAY:v,MS_PER_WEEK:w,MS_PER_YEAR:x,SEC_PER_MIN:i,SEC_PER_HOUR:p,SEC_PER_DAY:q,SEC_PER_WEEK:r,SEC_PER_YEAR:s,MIN_PER_HOUR:j,HOUR_PER_DAY:k,DAYS_PER_WEEK:l,MONTHS_PER_YEAR:m,AVG_DAYS_PER_MONTH:n,AVG_DAYS_PER_YEAR:o};f.exports=z;},null);
__d('DateStrings',['fbt'],function a(b,c,d,e,f,g,h){if(c.__markCompiled)c.__markCompiled();var i,j,k,l,m,n,o,p,q={getWeekdayName:function(r){if(!n)n=[h._("\u0412\u043e\u0441\u043a\u0440\u0435\u0441\u0435\u043d\u044c\u0435"),h._("\u041f\u043e\u043d\u0435\u0434\u0435\u043b\u044c\u043d\u0438\u043a"),h._("\u0412\u0442\u043e\u0440\u043d\u0438\u043a"),h._("\u0421\u0440\u0435\u0434\u0430"),h._("\u0427\u0435\u0442\u0432\u0435\u0440\u0433"),h._("\u041f\u044f\u0442\u043d\u0438\u0446\u0430"),h._("\u0421\u0443\u0431\u0431\u043e\u0442\u0430")];return n[r];},getUppercaseWeekdayName:function(r){if(!p)p=[h._("\u0412\u041e\u0421\u041a\u0420\u0415\u0421\u0415\u041d\u042c\u0415"),h._("\u041f\u041e\u041d\u0415\u0414\u0415\u041b\u042c\u041d\u0418\u041a"),h._("\u0412\u0422\u041e\u0420\u041d\u0418\u041a"),h._("\u0421\u0420\u0415\u0414\u0410"),h._("\u0427\u0415\u0422\u0412\u0415\u0420\u0413"),h._("\u041f\u042f\u0422\u041d\u0418\u0426\u0410"),h._("\u0421\u0423\u0411\u0411\u041e\u0422\u0410")];return p[r];},getWeekdayNameShort:function(r){if(!o)o=[h._("\u0412\u0441"),h._("\u041f\u043d"),h._("\u0412\u0442"),h._("\u0421\u0440"),h._("\u0427\u0442"),h._("\u041f\u0442"),h._("\u0421\u0431")];return o[r];},getMonthName:function(r){if(!i)i=[h._("\u044f\u043d\u0432\u0430\u0440\u044f"),h._("\u0444\u0435\u0432\u0440\u0430\u043b\u044f"),h._("\u043c\u0430\u0440\u0442\u0430"),h._("\u0430\u043f\u0440\u0435\u043b\u044f"),h._("\u043c\u0430\u044f"),h._("\u0438\u044e\u043d\u044f"),h._("\u0438\u044e\u043b\u044f"),h._("\u0430\u0432\u0433\u0443\u0441\u0442\u0430"),h._("\u0441\u0435\u043d\u0442\u044f\u0431\u0440\u044f"),h._("\u043e\u043a\u0442\u044f\u0431\u0440\u044f"),h._("\u043d\u043e\u044f\u0431\u0440\u044f"),h._("\u0434\u0435\u043a\u0430\u0431\u0440\u044f")];return i[r-1];},getUppercaseMonthName:function(r){if(!l)l=[h._("\u042f\u041d\u0412\u0410\u0420\u042c"),h._("\u0424\u0415\u0412\u0420\u0410\u041b\u042c"),h._("\u041c\u0410\u0420\u0422"),h._("\u0410\u041f\u0420\u0415\u041b\u042c"),h._("\u041c\u0410\u0419"),h._("\u0418\u042e\u041d\u042c"),h._("\u0418\u042e\u041b\u042c"),h._("\u0410\u0412\u0413\u0423\u0421\u0422"),h._("\u0421\u0415\u041d\u0422\u042f\u0411\u0420\u042c"),h._("\u041e\u041a\u0422\u042f\u0411\u0420\u042c"),h._("\u041d\u041e\u042f\u0411\u0420\u042c"),h._("\u0414\u0415\u041a\u0410\u0411\u0420\u042c")];return l[r-1];},getMonthNameShort:function(r){if(!j)j=[h._("\u042f\u043d\u0432"),h._("\u0424\u0435\u0432"),h._("\u041c\u0430\u0440"),h._("\u0410\u043f\u0440"),h._("\u041c\u0430\u0439"),h._("\u0418\u044e\u043d"),h._("\u0418\u044e\u043b"),h._("\u0410\u0432\u0433"),h._("\u0421\u0435\u043d"),h._("\u041e\u043a\u0442"),h._("\u041d\u043e\u044f"),h._("\u0414\u0435\u043a")];return j[r-1];},getUppercaseMonthNameShort:function(r){if(!k)k=[h._("\u042f\u041d\u0412"),h._("\u0424\u0415\u0412"),h._("\u041c\u0410\u0420"),h._("\u0410\u041f\u0420"),h._("\u041c\u0410\u0419"),h._("\u0418\u042e\u041d"),h._("\u0418\u042e\u041b"),h._("\u0410\u0412\u0413"),h._("\u0421\u0415\u041d"),h._("\u041e\u041a\u0422"),h._("\u041d\u041e\u042f"),h._("\u0414\u0415\u041a")];return k[r-1];},getOrdinalSuffix:function(r){if(!m)m=['',h._("-\u043e\u0435"),h._("-\u043e\u0435"),h._("-\u0435"),h._("-\u043e\u0435"),h._("-oe"),h._("-\u043e\u0435"),h._("-\u043e\u0435"),h._("-\u043e\u0435"),h._("-oe"),h._("-\u043e\u0435"),h._("-oe"),h._("-oe"),h._("-\u043e\u0435"),h._("-oe"),h._("-\u043e\u0435"),h._("-oe"),h._("-\u043e\u0435"),h._("-oe"),h._("-\u043e\u0435"),h._("-\u043e\u0435"),h._("-\u043e\u0435"),h._("-\u043e\u0435"),h._("-\u0435"),h._("-\u043e\u0435"),h._("-\u043e\u0435"),h._("-oe"),h._("-oe"),h._("-\u043e\u0435"),h._("-oe"),h._("-\u043e\u0435"),h._("-\u043e\u0435")];return m[r];},getDayLabel:function(){return h._("\u0414\u0435\u043d\u044c:");},getMonthLabel:function(){return h._("\u041c\u0435\u0441\u044f\u0446:");},getYearLabel:function(){return h._("\u0413\u043e\u0434:");},getDayPlaceholder:function(){return h._("\u0434\u0434");},getMonthPlaceholder:function(){return h._("\u043c\u043c");},getYearPlaceholder:function(){return h._("\u0433\u0433\u0433\u0433");},get12HourClockSuffix:function(r){if(r<12)return h._("\u0443\u0442\u0440\u0430");return h._("\u0432\u0435\u0447\u0435\u0440\u0430");},getUppercase12HourClockSuffix:function(r){if(r<12)return h._("AM");return h._("PM");}};f.exports=q;},null);
__d('formatDate',['DateStrings','DateFormatConfig','invariant','padNumber'],function a(b,c,d,e,f,g,h,i,j,k){if(c.__markCompiled)c.__markCompiled();function l(o,p,q){q=q||{};if(!p||!o)return '';if(typeof o==='string')o=parseInt(o,10);if(typeof o==='number')o=new Date(o*1000);!(o instanceof Date)?j(0):undefined;!!isNaN(o.getTime())?j(0):undefined;if(typeof p!=='string'){var r=m();for(var s in r){var t=r[s];if(t.start<=o.getTime()&&p[t.name]){p=p[t.name];break;}}}var u;if(q.skipPatternLocalization||!q.formatInternal&&n()||p.length===1){u=p;}else{!i.formats[p]?j(0):undefined;u=i.formats[p];}var v=q.utc?'getUTC':'get',w=o[v+'Date'](),x=o[v+'Day'](),y=o[v+'Month'](),z=o[v+'FullYear'](),aa=o[v+'Hours'](),ba=o[v+'Minutes'](),ca=o[v+'Seconds'](),da=o[v+'Milliseconds'](),ea='';for(var fa=0;fa<u.length;fa++){var ga=u.charAt(fa);switch(ga){case '\\':fa++;ea+=u.charAt(fa);break;case 'd':ea+=k(w,2);break;case 'j':ea+=w;break;case 'S':ea+=h.getOrdinalSuffix(w);break;case 'D':ea+=h.getWeekdayNameShort(x);break;case 'l':ea+=h.getWeekdayName(x);break;case 'F':case 'f':ea+=h.getMonthName(y+1);break;case 'M':ea+=h.getMonthNameShort(y+1);break;case 'm':ea+=k(y+1,2);break;case 'n':ea+=y+1;break;case 'Y':ea+=z;break;case 'y':ea+=(''+z).slice(2);break;case 'a':ea+=h.get12HourClockSuffix(aa);break;case 'A':ea+=h.getUppercase12HourClockSuffix(aa);break;case 'g':ea+=aa===0||aa===12?12:aa%12;break;case 'G':ea+=aa;break;case 'h':if(aa===0||aa===12){ea+=12;}else ea+=k(aa%12,2);break;case 'H':ea+=k(aa,2);break;case 'i':ea+=k(ba,2);break;case 's':ea+=k(ca,2);break;case 'X':ea+=k(da,3);break;default:ea+=ga;}}return ea;}function m(){var o=new Date(),p=o.getTime(),q=o.getFullYear(),r=o.getDate()-(o.getDay()-i.weekStart+6)%7,s=new Date(q,o.getMonth()+1,0).getDate(),t=new Date(q,1,29).getMonth()===1?366:365,u=1000*60*60*24;return [{name:'today',start:o.setHours(0,0,0,0)},{name:'withinDay',start:p-u},{name:'thisWeek',start:new Date(o.getTime()).setDate(r)},{name:'withinWeek',start:p-u*7},{name:'thisMonth',start:o.setDate(1)},{name:'withinMonth',start:p-u*s},{name:'thisYear',start:o.setMonth(0)},{name:'withinYear',start:p-u*t},{name:'older',start:-Infinity}];}l.periodNames=['today','thisWeek','thisMonth','thisYear','withinDay','withinWeek','withinMonth','withinYear','older'];function n(){if(typeof window==='undefined'||!window||!window.location||!window.location.pathname)return false;var o=window.location.pathname,p='/intern';return o.substr(0,p.length)===p;}f.exports=l;},null);
__d('cancelAnimationFrame',['TimerStorage','cancelAnimationFramePolyfill'],function a(b,c,d,e,f,g,h,i){if(c.__markCompiled)c.__markCompiled();f.exports=function(){for(var j=arguments.length,k=Array(j),l=0;l<j;l++)k[l]=arguments[l];h.unset(h.ANIMATION_FRAME,k[0]);return Function.prototype.apply.call(i,b,k);};},null);
__d("ScriptPathState",["Arbiter"],function a(b,c,d,e,f,g,h){if(c.__markCompiled)c.__markCompiled();var i,j,k,l,m=100,n={setIsUIPageletRequest:function(o){k=o;},setUserURISampleRate:function(o){l=o;},reset:function(){i=null;j=false;k=false;},_shouldUpdateScriptPath:function(){return j&&!k;},_shouldSendURI:function(){return Math.random()<l;},getParams:function(){var o={};if(n._shouldUpdateScriptPath()){if(n._shouldSendURI()&&i!==null)o.user_uri=i.substring(0,m);}else o.no_script_path=1;return o;}};h.subscribe("pre_page_transition",function(o,p){j=true;i=p.to.getUnqualifiedURI().toString();});f.exports=b.ScriptPathState=n;},null);
__d('goOrReplace',['URI'],function a(b,c,d,e,f,g,h){if(c.__markCompiled)c.__markCompiled();function i(j,k,l){var m=new h(k),n=b.Quickling;if(j.pathname=='/'&&m.getPath()!='/'&&n&&n.isActive()&&n.isPageActive(m)){var o=j.search?{}:{q:''};m=new h().setPath('/').setQueryData(o).setFragment(m.getUnqualifiedURI().toString());k=m.toString();}if(l){j.replace(k);}else if(j.href==k){j.reload();}else j.href=k;}f.exports=i;},null);
__d('AjaxPipeRequest',['Arbiter','AsyncRequest','BigPipe','CSS','DOM','Env','PageEvents','PageletSet','ScriptPathState','URI','ge','goOrReplace','performance','performanceAbsoluteNow'],function a(b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u){if(c.__markCompiled)c.__markCompiled();var v,w=0;function x(aa,ba){var ca=r(aa);if(!ca)return;if(!ba)ca.style.minHeight='100px';var da=o.getPageletIDs();for(var ea=0;ea<da.length;ea++){var fa=da[ea];if(l.contains(ca,fa))o.removePagelet(fa);}l.empty(ca);h.inform('pagelet/destroy',{id:null,root:ca});}function y(aa,ba){var ca=r(aa);if(ca&&!ba)ca.style.minHeight='100px';}function z(aa,ba){'use strict';this._uri=aa;this._query_data=ba;this._request=new i();this._canvas_id=null;this._allow_cross_page_transition=true;this._arbiter=new h();this._requestID=w++;}z.prototype.setCanvasId=function(aa){'use strict';this._canvas_id=aa;return this;};z.prototype.setURI=function(aa){'use strict';this._uri=aa;return this;};z.prototype.setData=function(aa){'use strict';this._query_data=aa;return this;};z.prototype.getData=function(aa){'use strict';return this._query_data;};z.prototype.setAllowCrossPageTransition=function(aa){'use strict';this._allow_cross_page_transition=aa;return this;};z.prototype.setAppend=function(aa){'use strict';this._append=aa;return this;};z.prototype.send=function(){'use strict';this._arbiter.inform(n.AJAXPIPE_SEND,{rid:this._requestID,quickling:!!this._isQuickling,ts:u()},h.BEHAVIOR_PERSISTENT);var aa={ajaxpipe:1,ajaxpipe_token:m.ajaxpipe_token};Object.assign(aa,p.getParams());p.reset();this._request.setOption('useIframeTransport',true).setURI(this._uri).setData(Object.assign(aa,this._query_data)).setPreBootloadHandler(this._preBootloadHandler.bind(this)).setInitialHandler(this._onInitialResponse.bind(this)).setHandler(this._onResponse.bind(this)).setMethod('GET').setReadOnly(true).setAllowCrossPageTransition(this._allow_cross_page_transition).setAllowIrrelevantRequests(this._allowIrrelevantRequests);if(this._automatic){this._relevantRequest=v;}else v=this._request;if(this._isQuickling){var ba=t.clearResourceTimings||t.webkitClearResourceTimings;if(ba)ba.call(t);}this._request.send();return this;};z.prototype._preBootloadFirstResponse=function(aa){'use strict';return false;};z.prototype._fireDomContentCallback=function(){'use strict';this._arbiter.inform(n.AJAXPIPE_DOMREADY,true,h.BEHAVIOR_STATE);};z.prototype._fireOnloadCallback=function(){'use strict';this._arbiter.inform(n.AJAXPIPE_ONLOAD,{lid:this.pipe.lid,rid:this._requestID,ts:u()},h.BEHAVIOR_STATE);};z.prototype._isRelevant=function(aa){'use strict';return this._request==v||this._automatic&&this._relevantRequest==v||this._jsNonBlock||v&&v._allowIrrelevantRequests;};z.prototype._preBootloadHandler=function(aa){'use strict';var ba=aa.getPayload();if(!ba||ba.redirect||!this._isRelevant(aa))return false;var ca=false;if(aa.is_first){!this._append&&!this._displayCallback&&x(this._canvas_id,this._constHeight);ca=this._preBootloadFirstResponse(aa);this.pipe=new j({arbiter:this._arbiter,rootNodeID:this._canvas_id,lid:this._request.lid,rid:this._requestID,isAjax:true,domContentCallback:this._fireDomContentCallback.bind(this),onloadCallback:this._fireOnloadCallback.bind(this),domContentEvt:n.AJAXPIPE_DOMREADY,onloadEvt:n.AJAXPIPE_ONLOAD,jsNonBlock:this._jsNonBlock,automatic:this._automatic,displayCallback:this._displayCallback,allowIrrelevantRequests:this._allowIrrelevantRequests});}return ca;};z.prototype._redirect=function(aa){'use strict';if(aa.redirect){if(aa.force||!this.isPageActive(aa.redirect)){var ba=['ajaxpipe','ajaxpipe_token'].concat(this.getSanitizedParameters());s(window.location,new q(aa.redirect).removeQueryData(ba),true);}else{var ca=b.PageTransitions;ca.go(aa.redirect,true);}return true;}else return false;};z.prototype.isPageActive=function(aa){'use strict';return true;};z.prototype.getSanitizedParameters=function(){'use strict';return [];};z.prototype._versionCheck=function(aa){'use strict';return true;};z.prototype._onInitialResponse=function(aa){'use strict';var ba=aa.getPayload();if(!this._isRelevant(aa))return false;if(!ba)return true;if(this._redirect(ba)||!this._versionCheck(ba))return false;return true;};z.prototype._processFirstResponse=function(aa){'use strict';var ba=aa.getPayload();if(r(this._canvas_id)&&ba.canvas_class!=null)k.setClass(this._canvas_id,ba.canvas_class);};z.prototype.setFirstResponseCallback=function(aa){'use strict';this._firstResponseCallback=aa;return this;};z.prototype.setFirstResponseHandler=function(aa){'use strict';this._processFirstResponse=aa;return this;};z.prototype._onResponse=function(aa){'use strict';var ba=aa.payload;if(!this._isRelevant(aa))return i.suppressOnloadToken;if(aa.is_first){this._processFirstResponse(aa);this._firstResponseCallback&&this._firstResponseCallback();ba.provides=ba.provides||[];ba.provides.push('uipage_onload');}if(ba){if('content' in ba.content&&this._canvas_id!==null){if(this._append)ba.append=this._canvas_id;var ca=ba.content.content;delete ba.content.content;ba.content[this._canvas_id]=ca;}if(ba.secondFlushResources){this.pipe.setSecondFlushResources(ba.secondFlushResources);}else this.pipe.onPageletArrive(ba);}if(aa.is_last)y(this._canvas_id,this._constHeight);return i.suppressOnloadToken;};z.prototype.setNectarModuleDataSafe=function(aa){'use strict';this._request.setNectarModuleDataSafe(aa);return this;};z.prototype.setFinallyHandler=function(aa){'use strict';this._request.setFinallyHandler(aa);return this;};z.prototype.setErrorHandler=function(aa){'use strict';this._request.setErrorHandler(aa);return this;};z.prototype.setTransportErrorHandler=function(aa){'use strict';this._request.setTransportErrorHandler(aa);return this;};z.prototype.abort=function(){'use strict';this._request.abort();if(v==this._request)v=null;this._request=null;return this;};z.prototype.setJSNonBlock=function(aa){'use strict';this._jsNonBlock=aa;return this;};z.prototype.setAutomatic=function(aa){'use strict';this._automatic=aa;return this;};z.prototype.setDisplayCallback=function(aa){'use strict';this._displayCallback=aa;return this;};z.prototype.setConstHeight=function(aa){'use strict';this._constHeight=aa;return this;};z.prototype.setAllowIrrelevantRequests=function(aa){'use strict';this._allowIrrelevantRequests=aa;return this;};z.prototype.getAsyncRequest=function(){'use strict';return this._request;};z.getCurrentRequest=function(){'use strict';return v;};z.setCurrentRequest=function(aa){'use strict';v=aa;};f.exports=z;},null);
__d("CSSClassTransition",[],function a(b,c,d,e,f,g){if(c.__markCompiled)c.__markCompiled();var h=[];function i(){}Object.assign(i,{go:function(j,k,l,m){var n;for(var o=0;o<h.length;o++)if(h[o](j,k,l,m)===true)n=true;if(!n)j.className=k;},registerHandler:function(j){h.push(j);return {remove:function(){var k=h.indexOf(j);if(k>=0)h.splice(k,1);}};}});f.exports=i;},null);
__d('DocumentTitle',['Arbiter'],function a(b,c,d,e,f,g,h){if(c.__markCompiled)c.__markCompiled();var i=document.title,j=null,k=1500,l=[],m=0,n=null,o=false;function p(){if(l.length>0){if(!o){q(l[m].title);m=++m%l.length;}else r();}else{clearInterval(n);n=null;r();}}function q(t){document.title=t;o=true;}function r(){s.set(j||i,true);o=false;}var s={get:function(){return i;},set:function(t,u){document.title=t;if(!u){i=t;j=null;h.inform('update_title',t);}else j=t;},blink:function(t){var u={title:t};l.push(u);if(n===null)n=setInterval(p,k);return {stop:function(){var v=l.indexOf(u);if(v>=0){l.splice(v,1);if(m>v){m--;}else if(m==v&&m==l.length)m=0;}}};}};f.exports=s;},null);
__d('FBID',[],function a(b,c,d,e,f,g){'use strict';if(c.__markCompiled)c.__markCompiled();var h={isUser:function(i){return i<2.2e+09||i>=1e+14&&i<=100099999989999||i>=8.9e+13&&i<=89999999999999||i>=6.000001e+13&&i<=60000019999999;}};f.exports=h;},null);
__d('MenuDeprecated',['Event','Arbiter','CSS','DataStore','DOM','HTML','Keys','Parent','Style','UserAgent_DEPRECATED','emptyFunction','Run'],function a(b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r){if(c.__markCompiled)c.__markCompiled();var s='menu:mouseover',t=null;function u(ea){if(j.hasClass(ea,'uiMenuContainer'))return ea;return o.byClass(ea,'uiMenu');}function v(ea){return o.byClass(ea,'uiMenuItem');}function w(ea){if(document.activeElement){var fa=v(document.activeElement);return ea.indexOf(fa);}return -1;}function x(ea){return l.find(ea,'a.itemAnchor');}function y(ea){return j.hasClass(ea,'checked');}function z(ea){return !j.hasClass(ea,'disabled')&&p.get(ea,'display')!=='none';}function aa(event){var ea=document.activeElement;if(!ea||!o.byClass(ea,'uiMenu')||!l.isInputNode(ea)){var fa=v(event.getTarget());fa&&da.focusItem(fa);}}function ba(ea){q.firefox()&&x(ea).blur();da.inform('select',{menu:u(ea),item:ea});}var ca=function(){ca=r;var ea={};ea.click=function(event){var fa=v(event.getTarget());if(fa&&z(fa)){ba(fa);var ga=x(fa),ha=ga.href,ia=ga.getAttribute('rel');return ia&&ia!=='ignore'||ha&&ha.charAt(ha.length-1)!=='#';}};ea.keydown=function(event){var fa=event.getTarget();if(event.getModifiers().any)return;if(!t||l.isInputNode(fa))return;var ga=h.getKeyCode(event),ha;switch(ga){case n.UP:case n.DOWN:var ia=da.getEnabledItems(t);ha=w(ia);da.focusItem(ia[ha+(ga===n.UP?-1:1)]);return false;case n.SPACE:var ja=v(fa);if(ja){ba(ja);event.prevent();}break;default:var ka=String.fromCharCode(ga).toLowerCase(),la=da.getEnabledItems(t);ha=w(la);var ma=ha,na=la.length;while(~ha&&(ma=++ma%na)!==ha||!~ha&&++ma<na){var oa=da.getItemLabel(la[ma]);if(oa&&oa.charAt(0).toLowerCase()===ka){da.focusItem(la[ma]);return false;}}}};h.listen(document.body,ea);},da=Object.assign(new i(),{focusItem:function(ea){if(ea&&z(ea)){this._removeSelected(u(ea));j.addClass(ea,'selected');x(ea).focus();}},getEnabledItems:function(ea){return da.getItems(ea).filter(z);},getCheckedItems:function(ea){return da.getItems(ea).filter(y);},getItems:function(ea){return l.scry(ea,'li.uiMenuItem');},getItemLabel:function(ea){return ea.getAttribute('data-label',2)||'';},isItemChecked:function(ea){return j.hasClass(ea,'checked');},autoregister:function(ea,fa,ga){ea.subscribe('show',function(){da.register(fa,ga);});ea.subscribe('hide',function(){da.unregister(fa);});},register:function(ea,fa){ea=u(ea);ca();if(!k.get(ea,s))k.set(ea,s,h.listen(ea,'mouseover',aa));if(fa!==false)t=ea;},setItemEnabled:function(ea,fa){if(!fa&&!l.scry(ea,'span.disabledAnchor')[0])l.appendContent(ea,l.create('span',{className:l.find(ea,'a').className+' disabledAnchor'},m(x(ea).innerHTML)));j.conditionClass(ea,'disabled',!fa);},toggleItem:function(ea){var fa=!da.isItemChecked(ea);da.setItemChecked(ea,fa);},setItemChecked:function(ea,fa){j.conditionClass(ea,'checked',fa);x(ea).setAttribute('aria-checked',fa);},unregister:function(ea){ea=u(ea);var fa=k.remove(ea,s);fa&&fa.remove();t=null;this._removeSelected(ea);},_removeSelected:function(ea){da.getItems(ea).filter(function(fa){return j.hasClass(fa,'selected');}).forEach(function(fa){j.removeClass(fa,'selected');});}});f.exports=da;},null);
__d('reportData',['Banzai','SessionName'],function a(b,c,d,e,f,g,h,i){if(c.__markCompiled)c.__markCompiled();var j={retry:true};function k(l,m){m=m||{};var n={ft:m.ft||{},gt:m.gt||{}},o='-',p=[],q='r',r=[Date.now(),0,o,l,o,o,q,b.URI?b.URI.getRequestURI(true,true).getUnqualifiedURI().toString():location.pathname+location.search+location.hash,n,0,0,0,0].concat(p),s=[i.getName(),Date.now(),'act'];h.post('eagle_eye_event',Array.prototype.concat(s,r),j);}f.exports=k;},null);
__d("UIPageletContentCache",[],function a(b,c,d,e,f,g){if(c.__markCompiled)c.__markCompiled();var h={cache:{},getContent:function(i){if(i in this.cache)return this.cache[i];return null;},setContent:function(i,j){this.cache[i]=j;}};f.exports=h;},null);
__d('UIPagelet',['ActorURI','AjaxPipeRequest','AsyncRequest','DOM','HTML','ScriptPathState','UIPageletContentCache','URI','emptyFunction','ge','isElementNode'],function a(b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r){if(c.__markCompiled)c.__markCompiled();function s(t,u,v){'use strict';var w=t&&r(t)?t.id:t;this._id=w||null;this._element=q(t||k.create('div'));this._src=u||null;this._context_data=v||{};this._data={};this._handler=p;this._request=null;this._use_ajaxpipe=false;this._use_post_request=false;this._is_bundle=true;this._allow_cross_page_transition=false;this._append=false;this._cache_content=false;this._content_cache_key='';}s.prototype.getElement=function(){'use strict';return this._element;};s.prototype.setHandler=function(t){'use strict';this._handler=t;return this;};s.prototype.go=function(t,u){'use strict';if(arguments.length>=2||typeof t=='string'){this._src=t;this._data=u||{};}else if(arguments.length==1)this._data=t;this.refresh();return this;};s.prototype.setAllowCrossPageTransition=function(t){'use strict';this._allow_cross_page_transition=t;return this;};s.prototype.setBundleOption=function(t){'use strict';this._is_bundle=t;return this;};s.prototype.setErrorHandler=function(t){'use strict';this._errorHandler=t;return this;};s.prototype.setTransportErrorHandler=function(t){'use strict';this.transportErrorHandler=t;return this;};s.prototype.refresh=function(){'use strict';if(this._use_ajaxpipe){m.setIsUIPageletRequest(true);this._request=new i();this._request.setCanvasId(this._id).setAppend(this._append).setConstHeight(this._constHeight).setJSNonBlock(this._jsNonblock).setAutomatic(this._automatic).setDisplayCallback(this._displayCallback).setFinallyHandler(this._finallyHandler).setAllowIrrelevantRequests(this._allowIrrelevantRequests);if(this._errorHandler)this._request.setErrorHandler(this._errorHandler);if(this.transportErrorHandler)this._request.setTransportErrorHandler(this.transportErrorHandler);}else{if(this._cache_content){var t=n.getContent(this._content_cache_key);if(t!==null){this.handleContent(t);return this;}}var u=(function(y){this._request=null;var z=l(y.getPayload());this.handleContent(z);if(this._cache_content)n.setContent(this._content_cache_key,z);}).bind(this),v=this._displayCallback,w=this._finallyHandler;this._request=new j().setMethod('GET').setReadOnly(true).setOption('bundle',this._is_bundle).setHandler(function(y){if(v){v(u.bind(null,y));}else u(y);w&&w();});if(this._errorHandler)this._request.setErrorHandler(this._errorHandler);if(this.transportErrorHandler)this._request.setTransportErrorHandler(this.transportErrorHandler);if(this._use_post_request)this._request.setMethod('POST');}var x=babelHelpers._extends({},this._context_data,this._data);if(this._actorID)x[h.PARAMETER_ACTOR]=this._actorID;this._request.setURI(this._src).setAllowCrossPageTransition(this._allow_cross_page_transition).setData({data:JSON.stringify(x)}).send();return this;};s.prototype.handleContent=function(t){'use strict';if(this._append){k.appendContent(this._element,t);}else k.setContent(this._element,t);this._handler();};s.prototype.cancel=function(){'use strict';if(this._request)this._request.abort();};s.prototype.setUseAjaxPipe=function(t){'use strict';this._use_ajaxpipe=!!t;return this;};s.prototype.setUsePostRequest=function(t){'use strict';this._use_post_request=!!t;return this;};s.prototype.setAppend=function(t){'use strict';this._append=!!t;return this;};s.prototype.setJSNonBlock=function(t){'use strict';this._jsNonblock=!!t;return this;};s.prototype.setAutomatic=function(t){'use strict';this._automatic=!!t;return this;};s.prototype.setDisplayCallback=function(t){'use strict';this._displayCallback=t;return this;};s.prototype.setConstHeight=function(t){'use strict';this._constHeight=!!t;return this;};s.prototype.setFinallyHandler=function(t){'use strict';this._finallyHandler=t;return this;};s.prototype.setAllowIrrelevantRequests=function(t){'use strict';this._allowIrrelevantRequests=t;return this;};s.prototype.setActorID=function(t){'use strict';this._actorID=t;return this;};s.prototype.setCacheContent=function(t){'use strict';this._cache_content=t;return this;};s.prototype.setContentCacheKey=function(t){'use strict';this._content_cache_key=t;return this;};s.appendToInline=function(t,u){'use strict';var v=q(t),w=q(u);if(v&&w){while(w.firstChild)k.appendContent(v,w.firstChild);k.remove(w);}};s.loadFromEndpoint=function(t,u,v,w){'use strict';w=w||{};var x='/ajax/pagelet/generic.php/'+t;if(w.intern)x='/intern'+x;var y=new o(x.replace(/\/+/g,'/'));if(w.subdomain)y.setSubdomain(w.subdomain);var z=false,aa='';if(w.contentCacheKey){z=true;aa=t+','+String(w.contentCacheKey);}var ba=new s(u,y,v).setUseAjaxPipe(w.usePipe).setBundleOption(w.bundle!==false).setAppend(w.append).setJSNonBlock(w.jsNonblock).setAutomatic(w.automatic).setDisplayCallback(w.displayCallback).setConstHeight(w.constHeight).setAllowCrossPageTransition(w.crossPage).setFinallyHandler(w.finallyHandler||p).setErrorHandler(w.errorHandler).setTransportErrorHandler(w.transportErrorHandler).setAllowIrrelevantRequests(w.allowIrrelevantRequests).setActorID(w.actorID).setCacheContent(z).setContentCacheKey(aa).setUsePostRequest(w.usePostRequest);w.handler&&ba.setHandler(w.handler);ba.go();return ba;};s.loadFromEndpointBatched=function(t,u,v){'use strict';var w=t.slice(0,v),x=t.slice(v);if(x.length>0){var y=w[w.length-1],z=p;if(y.options&&y.options.finallyHandler)z=y.options.finallyHandler;y.options=babelHelpers._extends({},y.options,{finallyHandler:function(){z();window.setTimeout(function(){s.loadFromEndpointBatched(x,u,v);},1);}});}w.forEach(function(aa){s.loadFromEndpoint(aa.controller,aa.target_element,aa.data,babelHelpers._extends({},aa.options,u,{bundle:true}));});};f.exports=s;},null);
__d('XUIBadge',['CSS','DOM','cx','invariant'],function a(b,c,d,e,f,g,h,i,j,k){if(c.__markCompiled)c.__markCompiled();function l(n){return parseInt(n,10)===n;}function m(n){'use strict';this.target=n.target;this.count=n.count;this.maxcount=n.maxcount;}m.prototype.getCount=function(){'use strict';return this.count;};m.prototype.setCount=function(n){'use strict';!l(n)?k(0):undefined;!(n>=0)?k(0):undefined;this.count=n;h.conditionClass(this.target,'hidden_elem',this.count===0);if(n>this.maxcount){i.setContent(this.target,this.maxcount+'+');h.addClass(this.target,"_5ugi");}else{i.setContent(this.target,n);h.removeClass(this.target,"_5ugi");}};m.prototype.setLegacyContent=function(n){'use strict';if(typeof n==='string'){h.conditionClass(this.target,'hidden_elem',n==0);i.setContent(this.target,n);h.removeClass(this.target,"_5ugi");}else this.setCount(n);};m.prototype.increment=function(){'use strict';this.setCount(this.getCount()+1);};f.exports=m;},null);