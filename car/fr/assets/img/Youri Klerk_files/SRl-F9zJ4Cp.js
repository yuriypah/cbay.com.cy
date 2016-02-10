/*!CK:1599795194!*//*1454308176,*/

if (self.CavalryLogger) { CavalryLogger.start_js(["GPZ2K"]); }

__d("ProfileDOMID",[],function a(b,c,d,e,f,g){c.__markCompiled&&c.__markCompiled();f.exports={ABOVE_HEADER_TIMELINE:"pagelet_above_header_timeline",ABOVE_HEADER_TIMELINE_PLACEHOLDER:"above_header_timeline_placeholder",COVER:"fbProfileCover",MAIN_COLUMN:"pagelet_main_column",MAIN_COLUMN_PERSONAL:"pagelet_main_column_personal",MAIN_COLUMN_PERSONAL_OTHER:"pagelet_main_column_personal_other",RIGHT_SIDEBAR:"pagelet_right_sidebar",TAB_LOAD_INDICATOR:"tab_load_indicator",TOP_SECTION:"timeline_top_section",PREFIX_MAIN_COLUMN_PERSONAL:"pagelet_main_column_personal_"};},null);
__d("ProfileOverviewDOMID",[],function a(b,c,d,e,f,g){c.__markCompiled&&c.__markCompiled();f.exports={MEDLEY_ROOT:"timeline-medley",PREFIX_APP_COLLECTION:"pagelet_timeline_app_collection_",PREFIX_COLLECTION_WRAPPER:"collection_wrapper_",PREFIX_MEDLEY:"pagelet_timeline_medley_",PREFIX_MEDLEY_HEADER:"medley_header_",PREFIX_RECOMMENDATION:"pagelet_recommendation_"};},null);
__d("ProfileTabConst",[],function a(b,c,d,e,f,g){c.__markCompiled&&c.__markCompiled();f.exports={ALBUM:"album",ALBUMS:"albums",ALL_ACTIVITY:"allactivity",APPROVAL:"approve",APPS:"apps",BOXES:"box_3",COMMERCE:"shop",DEALS:"deals",DRAFT_NOTES:"notes_drafts",EVENTS:"events",FAVORITES:"favorites",FOLLOWERS:"followers",FOLLOWING:"following",FRIENDS:"friends",FRIENDS_MUTUAL:"friends_mutual",GROUPS:"groups",GROUPS_MUTUAL:"groups_mutual",INFO:"info",LIKES:"likes",LOCATIONS:"locations",MAP:"map",MEMORIAL_CONTACT:"legacy_contact",NEARBY:"nearby",NOTES:"notes",OVERVIEW:"about",PAST_EVENTS:"pe",PHOTOS:"photos",PHOTOS_ALBUM:"media_set",PHOTOS_ALBUMS:"photos_albums",PHOTOS_BY_OTHERS:"photos_by_others",PHOTOS_STREAM:"photos_stream",PHOTOS_SYNCED:"photos_synced",POSTS:"posts",POSTS_OTHERS:"posts_to_page",RESUME:"resume",REVIEWS:"reviews",SAVED_FOR_LATER:"saved",SPORTS:"sports",TAGGED_NOTES:"notes_tagged",TIMELINE:"timeline",VIDEOS:"videos",WALL:"wall",WALL_ADMIN:"wall_admin",WIKIPEDIA:"wiki",PAGE_GETTING_STARTED:"page_getting_started",PAGE_MAP:"page_map",PAGE_MENU:"menu",PAGE_BOOK_PREVIEW:"book_preview",PAGE_PRODUCTS:"products",PAGE_SERVICES:"services",PAGES_CONTENT_TAB:"content_tab",PAGE_FAN_QUESTIONS:"questions",OG_APP_URL_PREFIX:"app_",OG_APPID_PREFIX:"og_app_",OG_NAMESPACE_PREFIX:"og_ns_",OG_BOOKS:"books",OG_FITNESS:"fitness",OG_GAMES:"games",OG_MOVIES:"movies",OG_MUSIC:"music",OG_NEWS:"news",OG_TV_SHOWS:"tv",OG_VIDEO:"video"};},null);
__d("TimelineScrollJankEventTypes",[],function a(b,c,d,e,f,g){c.__markCompiled&&c.__markCompiled();f.exports={BOTTOM_OUT:"bottom_out",JUMP_TO_NOWHERE:"jump_to_nowhere",UNBALANCED_COLUMNS:"unbalanced_columns"};},null);
__d("TimelineScrubberKey",[],function a(b,c,d,e,f,g){c.__markCompiled&&c.__markCompiled();f.exports={MONTH:"month",RECENT_ACTIVITY:"recent",YEAR:"year"};},null);
__d('ProfileTimelineUITypedLogger',['Banzai','GeneratedLoggerUtils','nullthrows'],function a(b,c,d,e,f,g,h,i,j){'use strict';if(c.__markCompiled)c.__markCompiled();function k(){this.clear();}k.prototype.log=function(){i.log('logger:ProfileTimelineUILoggerConfig',this.$ProfileTimelineUITypedLogger1,h.BASIC);};k.prototype.logVital=function(){i.log('logger:ProfileTimelineUILoggerConfig',this.$ProfileTimelineUITypedLogger1,h.VITAL);};k.prototype.clear=function(){this.$ProfileTimelineUITypedLogger1={};return this;};k.prototype.updateData=function(m){this.$ProfileTimelineUITypedLogger1=babelHelpers._extends({},this.$ProfileTimelineUITypedLogger1,m);return this;};k.prototype.setEvent=function(m){this.$ProfileTimelineUITypedLogger1.event=m;return this;};k.prototype.setEventMetadata=function(m){this.$ProfileTimelineUITypedLogger1.event_metadata=i.serializeMap(m);return this;};k.prototype.setProfileID=function(m){this.$ProfileTimelineUITypedLogger1.profile_id=m;return this;};k.prototype.setRelationshipType=function(m){this.$ProfileTimelineUITypedLogger1.relationship_type=m;return this;};k.prototype.setUIComponent=function(m){this.$ProfileTimelineUITypedLogger1.ui_component=m;return this;};k.prototype.setVC=function(m){this.$ProfileTimelineUITypedLogger1.vc=m;return this;};var l={event:true,event_metadata:true,profile_id:true,relationship_type:true,ui_component:true,vc:true};f.exports=k;},null);
__d('StickyController',['CSS','Event','Style','Vector','queryThenMutateDOM'],function a(b,c,d,e,f,g,h,i,j,k,l){if(c.__markCompiled)c.__markCompiled();function m(n,o,p,q){'use strict';this._element=n;this._marginTop=o;this._onchange=p;this._proxy=q||n.parentNode;this._boundQueryOnScroll=this.shouldFix.bind(this);this._boundMutateOnScroll=this._mutateOnScroll.bind(this);}m.prototype.handleScroll=function(){'use strict';l(this._boundQueryOnScroll,this._boundMutateOnScroll);};m.prototype.shouldFix=function(){'use strict';return k.getElementPosition(this._proxy,'viewport').y<=this._marginTop;};m.prototype._mutateOnScroll=function(){'use strict';var n=this.shouldFix();if(this.isFixed()!==n){j.set(this._element,'top',n?this._marginTop+'px':'');h.conditionClass(this._element,'fixed_elem',n);this._onchange&&this._onchange(n);}};m.prototype.start=function(){'use strict';if(this._event)return;this._event=i.listen(window,'scroll',this.handleScroll.bind(this));setTimeout(this.handleScroll.bind(this),0);};m.prototype.stop=function(){'use strict';this._event&&this._event.remove();this._event=null;};m.prototype.isFixed=function(){'use strict';return h.hasClass(this._element,'fixed_elem');};f.exports=m;},null);
__d('ProfileTabUtils',['ProfileTabConst'],function a(b,c,d,e,f,g,h){if(c.__markCompiled)c.__markCompiled();var i={isActivityLogTab:function(j){return (j===h.ALL_ACTIVITY||j===h.APPROVAL);},isOverviewTab:function(j){return (j===h.INFO||j===h.OVERVIEW);},isTimelineTab:function(j){return (!j||j===h.TIMELINE||j===h.WALL);},tabHasFixedAds:function(j){return true;},tabHasScrubber:function(j){return i.isActivityLogTab(j);}};i.tabHasStickyHeader=i.isTimelineTab;f.exports=i;},null);
__d('ProfileNavRef',['LinkController','Parent','URI'],function a(b,c,d,e,f,g,h,i,j){if(c.__markCompiled)c.__markCompiled();var k='pnref',l='data-'+k,m=false;function n(o){var p=[];o=i.byAttribute(o,l);while(o){p.unshift(o.getAttribute(l));o=i.byAttribute(o.parentNode,l);}return p.join('.');}g.track=function(){if(m)return;m=true;h.registerHandler(function(o){var p=n(o);if(p)o.href=new j(o.href).addQueryData(k,p).toString();});};},null);
__d('TimelineComponentKeys',['ImmutableObject'],function a(b,c,d,e,f,g,h){if(c.__markCompiled)c.__markCompiled();var i=new h({ADS:'ads',ASYNC_NAV:'async_nav',CONTENT:'content',COVER_NAV:'cover_nav',ESCAPE_HATCH:'escape_hatch',LOGGING:'logging',NAV:'nav',SCRUBBER:'scrubber',STICKY_COLUMN:'sticky_column',STICKY_HEADER:'sticky_header',STICKY_HEADER_NAV:'sticky_header_nav'});f.exports=i;},null);
__d('TimelineConstants',[],function a(b,c,d,e,f,g){if(c.__markCompiled)c.__markCompiled();var h={DS_LOADED:'timeline-capsule-loaded',DS_COLUMN_HEIGHT_DIFFERENTIAL:'timeline-column-diff-height',SCROLL_TO_OFFSET:100,SCRUBBER_DEFAULT_OFFSET:38,SECTION_EXPAND:'TimelineConstants/sectionExpand',SECTION_LOADING:'TimelineConstants/sectionLoading',SECTION_LOADED:'TimelineConstants/sectionLoaded',SECTION_FULLY_LOADED:'TimelineConstants/sectionFullyLoaded',SECTION_REGISTERED:'TimelineConstants/sectionRegistered',UNIT_SEGMENT_LOADED:'TimelineConstants/unitSegmentLoaded'};f.exports=h;},null);
__d('TimelineLegacySections',['CSS','DOM','fbt','getElementText'],function a(b,c,d,e,f,g,h,i,j,k){if(c.__markCompiled)c.__markCompiled();var l={},m={},n=false,o=[],p={},q={get:function(r){return m.hasOwnProperty(r)?m[r]:null;},getAll:function(){return m;},remove:function(r){for(var s=0;s<o.length;s++)if(o[s]===r){o[s]=null;break;}delete m[r];},removeAll:function(){m={};},set:function(r,s){m[r]=s;},addOnVisible:function(r,s){p[r]=s;},destroyOnVisible:function(r){var s=p[r];if(s){s.remove();i.remove(s.getElement());}p[r]=null;},removeOnVisible:function(r){var s=p[r];if(s)s.remove();},removeAllOnVisibles:function(){Object.keys(p).forEach((function(r){return this.removeOnVisible(r);}).bind(this));},getOnVisible:function(r){return p[r];},setMainSectionOrder:function(r,s){o[s]=r;},getMainSectionOrder:function(){return o;},addLoadPagelet:function(r,s){l[r]=s;},cancelLoadPagelet:function(r){if(l[r])l[r].cancel();},cancelLoadPagelets:function(){Object.keys(l).forEach((function(r){return this.cancelLoadPagelet(r);}).bind(this));l={};},shouldForceNoFriendActivity:function(){return n;},forceNoFriendActivity:function(){n=true;},collapsePlaceHolderHeaders:function(){var r,s,t=false;for(var u=0;u<o.length;u++){var v=o[u];if(!v)continue;var w=q.get(v);if(!w)continue;if(w.canScrollLoad()||w.isLoaded()){if(!w.isLoaded()){h.removeClass(w.getNode(),'fbTimelineTimePeriodSuppressed');h.addClass(w.getNode(),'fbTimelineTimePeriodUnexpanded');}if(r&&s){this.combineSectionHeaders(r,s);if(t)r.deactivateScrollLoad();t=true;}r=null;s=null;continue;}else if(r){s=w;w.deactivateScrollLoad();}else{r=w;s=w;if(t)w.activateScrollLoad();}h.removeClass(w.getNode(),'fbTimelineTimePeriodSuppressed');h.addClass(w.getNode(),'fbTimelineTimePeriodUnexpanded');}},combineSectionHeaders:function(r,s){h.removeClass(s.getNode(),'fbTimelineTimePeriodUnexpanded');h.addClass(s.getNode(),'fbTimelineTimePeriodSuppressed');var t=i.find(r.getNode(),'span.sectionLabel'),u=i.find(s.getNode(),'span.sectionLabel');if(!u.getAttribute('data-original-label'))u.setAttribute('data-original-label',k(u));if(t.getAttribute('data-month')&&u.getAttribute('data-month')&&t.getAttribute('data-year')==u.getAttribute('data-year')){i.setContent(u,j._("\u041f\u043e\u043a\u0430\u0437\u0430\u0442\u044c {month1} - {month2} {year}",[j.param('month1',u.getAttribute('data-month')),j.param('month2',t.getAttribute('data-month')),j.param('year',t.getAttribute('data-year'))]));}else if(t.getAttribute('data-year')!==u.getAttribute('data-year')){i.setContent(u,j._("\u041f\u043e\u043a\u0430\u0437\u0430\u0442\u044c {year1} - {year2}",[j.param('year1',u.getAttribute('data-year')),j.param('year2',t.getAttribute('data-year'))]));}else i.setContent(u,j._("\u041f\u043e\u043a\u0430\u0437\u0430\u0442\u044c {year}",[j.param('year',u.getAttribute('data-year'))]));}};f.exports=q;},null);
__d('TimelineScrollJankLogger',['Banzai','BanzaiLogger','TimelineScrollJankEventTypes','debounceCore','emptyFunction'],function a(b,c,d,e,f,g,h,i,j,k,l){if(c.__markCompiled)c.__markCompiled();var m='TimelineScrollJankLoggerConfig',n='timeline_scroll_jank',o=50;function p(event,s,t,u){i.log(m,{event:event,profileid:s,currentsection:u,sessionid:t});}var q=h.isEnabled(n)?k(p,o):l,r={logBottomOut:q.bind(null,j.BOTTOM_OUT)};f.exports=r;},null);
__d('TimelineController',['Arbiter','BlueBar','CSS','DataStore','DOMQuery','Event','ProfileDOMID','ProfileNavRef','ProfileTabConst','ProfileTabUtils','Run','ScrollingPager','TidyArbiter','TimelineComponentKeys','TimelineConstants','TimelineLegacySections','TimelineScrollJankLogger','TimelineScrubberKey','UITinyViewportAction','Vector','$','forEachObject','ge','queryThenMutateDOM','randomInt','tidyEvent'],function a(b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z,aa,ba,ca,da,ea,fa,ga){if(c.__markCompiled)c.__markCompiled();var ha=740,ia=5,ja='top',ka='paddingTop',la='paddingTop',ma=null,na=false,oa=null,pa=null,qa,ra={},sa={},ta=[],ua=null,va=0,wa=aa.getViewportDimensions(),xa=false,ya=false,za=false;function ab(mb,nb,ob){ob=ob||[];if(ra[mb])return ra[mb][nb].apply(ra[mb],ob);sa[mb]=sa[mb]||{};sa[mb][nb]=ob;return false;}function bb(){if(xa)xa=fb(da('rightCol'),la,lb.getCurrentScrubber());if(ya)ya=fb(ba(n.ABOVE_HEADER_TIMELINE),ja);if(za)za=fb(i.getBar(),ka);}function cb(){va=aa.getScrollPosition();var mb=va.y+wa.y,nb=aa.getDocumentDimensions().y-mb;if(nb<ia)x.logBottomOut(oa,qa);}function db(){bb();if(q.tabHasStickyHeader(ma))ab(u.STICKY_HEADER,'check',[va.y]);ab(u.CONTENT,'checkCurrentSectionChange');}function eb(){ea(cb,db,'TimelineController/scrollListener');}function fb(mb,nb,ob){if(!mb)return false;if(va.y<=0){gb(mb,nb);return false;}if(ob&&j.hasClass(ob.getRoot(),'fixed_elem')){gb(mb,nb);return false;}var pb=parseInt(mb.style[nb],10)||0;if(va.y<pb){j.addClass(mb,'timeline_fixed');mb.style[nb]=va.y+'px';}else j.removeClass(mb,'timeline_fixed');return true;}function gb(mb,nb){mb.style[nb]='0px';j.removeClass(mb,'timeline_fixed');}function hb(){wa=aa.getViewportDimensions();}function ib(){ea(hb,function(){ab(u.ADS,'adjustAdsToFit');ab(u.STICKY_HEADER_NAV,'adjustMenuHeights');ab(u.STICKY_HEADER,'check',[va.y]);},'TimelineController/resize');}function jb(event,mb){var nb=aa.getScrollPosition();mb=Math.min(mb,nb.y);var ob=da('rightCol');if(ob){ob.style[la]=mb+'px';xa=true;}var pb=ba(n.ABOVE_HEADER_TIMELINE);if(pb.firstChild){var qb=ba(n.ABOVE_HEADER_TIMELINE_PLACEHOLDER);qb.style.height=pb.offsetHeight+'px';pb.style[ja]=mb+'px';ya=true;}za=z.isTinyHeight();if(za)i.getBar().style[ka]=mb+'px';h.inform('reflow');}function kb(){while(ta.length)ta.pop().remove();ca(ra,function(nb,ob){nb.reset&&nb.reset();});ma=null;oa=null;qa=null;ra={};sa={};ua=null;na=false;ya=false;if(xa){var mb=da('rightCol');if(mb)gb(mb,la);}xa=false;if(za){gb(i.getBar(),ka);za=false;}k.purge(v.DS_LOADED);k.purge(v.DS_COLUMN_HEIGHT_DIFFERENTIAL);}var lb={init:function(mb,nb,ob){if(na)return;if(q.isTimelineTab(nb))nb=p.TIMELINE;na=true;oa=mb;qa=fa(Number.MAX_SAFE_INTEGER).toString();pa=ob.relationship_type;ta.push(m.listen(window,'scroll',eb),m.listen(window,'resize',ib));ga(t.subscribe('TimelineCover/coverCollapsed',jb));o.track();r.onLeave(kb);lb.registerCurrentKey(nb);var pb='#'+y.WAY_BACK;if(window.location.hash===pb)var qb=h.subscribe(v.SECTION_FULLY_LOADED,function(){ab(u.CONTENT,'navigateToSection',[y.WAY_BACK]);qb.unsubscribe();});},setAdsTracking:function(mb){ab(u.ADS,'start',[mb]);},registerCurrentKey:function(mb){ma=mb;ua=mb!==p.MAP&&aa.getViewportDimensions().y<ha&&q.tabHasScrubber(mb);ua=ua||i.getBar().offsetTop;ab(u.ADS,'setShortMode',[ua]);ab(u.ADS,'updateCurrentKey',[mb]);ab(u.ADS,'adjustAdsToFit');ab(u.COVER_NAV,'handleTabChange',[mb]);ab(u.SCRUBBER,'handleTabChange',[mb]);ab(u.ESCAPE_HATCH,'handleTabChange',[mb]);ab(u.STICKY_COLUMN,'adjust');ab(u.STICKY_HEADER,'handleTabChange',[mb]);eb();},getProfileID:function(){return oa;},getRelationshipType:function(){return pa;},getCurrentKey:function(){return ma;},getCurrentScrubber:function(){return ra[u.SCRUBBER];},getCurrentStickyHeaderNav:function(){return ra[u.STICKY_HEADER_NAV];},scrubberHasLoaded:function(mb){j.conditionClass(mb.getRoot(),'fixed_elem',!ua);ab(u.ADS,'registerScrubber',[mb]);},scrubberHasChangedState:function(){ab(u.ADS,'adjustAdsToFit');},scrubberWasClicked:function(mb){ab(u.LOGGING,'logScrubberClick',[mb]);},stickyHeaderNavWasClicked:function(mb){ab(u.LOGGING,'logStickyHeaderNavClick',[mb]);},sectionHasChanged:function(mb,nb){var ob=[mb,nb];ab(u.STICKY_HEADER_NAV,'updateSection',ob);ab(u.SCRUBBER,'updateSection',ob);ab(u.ADS,'loadAdsIfEnoughTimePassed');ab(u.LOGGING,'logSectionChange',ob);},navigateToSection:function(mb){ab(u.CONTENT,'navigateToSection',[mb]);},adjustStickyHeaderWidth:function(){ab(u.STICKY_HEADER,'adjustWidth');},hideStickyHeaderNavSectionMenu:function(){ab(u.STICKY_HEADER_NAV,'hideSectionMenu');},register:function(mb,nb){ra[mb]=nb;if(sa[mb]){ca(sa[mb],function(ob,pb){ab(mb,pb,ob);});delete sa[mb];}},adjustScrollingPagerBuffer:function(mb,nb){var ob=k.get(v.DS_COLUMN_HEIGHT_DIFFERENTIAL,nb);if(ob){var pb=s.getInstance(mb);pb&&pb.setBuffer(pb.getBuffer()+Math.abs(ob));}},runOnceWhenSectionFullyLoaded:function(mb,nb,ob){var pb=w.get(nb),qb=false;if(pb){var rb=l.scry(pb.getNode(),'.fbTimelineCapsule');qb=rb.some(function(tb){var ub=k.get(v.DS_LOADED,tb.id);if(parseInt(ub,10)>=parseInt(ob,10)){mb();return true;}});}if(!qb)var sb=h.subscribe(v.SECTION_FULLY_LOADED,function(tb,ub){if(ub.scrubberKey===nb&&ub.pageIndex===ob){mb();sb.unsubscribe();}});}};f.exports=lb;},null);
__d('ProfileTimelineUILogger',['Banzai','ProfileTimelineUITypedLogger','TimelineController'],function a(b,c,d,e,f,g,h,i,j){if(c.__markCompiled)c.__markCompiled();var k='profile_timeline_ui';function l(event,n,o){var p=j.getProfileID(),q=j.getRelationshipType();if(h.isEnabled(k)&&!!p&&!!q)new i().setEvent(event).setUIComponent(n).setProfileID(p).setRelationshipType(q).setEventMetadata(o).log();}var m={logCoverNavItemClick:function(n){l('click','cover_nav_item',{tab_key:n});},logCoverNavMoreItemClick:function(n){l('click','cover_nav_more_item',{tab_key:n});},logScrubberClick:function(n){l('click','scrubber',{section_key:n});},logStickyHeaderImpression:function(){l('view','sticky_header',{});},logStickyHeaderNavItemClick:function(n){l('click','sticky_header_nav_item',{tab_key:n});},logStickyHeaderScrubberClick:function(n){l('click','sticky_header_scrubber',{section_key:n});}};f.exports=m;},null);
__d('TimelineSideAds',['AdsMouseStateStore','Animation','Arbiter','CSS','DOM','EgoAdsObjectSet','Event','ProfileTabUtils','StickyController','TimelineAdsConfig','TimelineComponentKeys','TimelineConstants','TimelineController','UIPagelet','UITinyViewportAction','URI','Vector','csx','cx','debounce','ge','getOrCreateDOMID','queryThenMutateDOM'],function a(b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z,aa,ba,ca,da){if(c.__markCompiled)c.__markCompiled();var ea=75,fa='data-height',ga=h.STATES,ha=30000,ia=0,ja=false,ka,la,ma,na,oa,pa,qa=new m(),ra,sa,ta,ua=Infinity,va=false,wa=5,xa,ya,za,ab,bb,cb,db,eb,fb,gb,hb,ib=false,jb=[],kb;function lb(kc,lc,mc){var nc=0;if(lc)nc+=lc.getHeight();if(!qb()&&!nc)return;kc-=nc;var oc=0;for(var pc=0;pc<mc;pc++)oc+=zb(pc);if(lc)if(kc<oc){kc+=lc.fold(oc-kc);}else if(kc>oc)kc-=lc.unfold(kc-oc);return kc;}function mb(){var kc=la.cloneNode(true);kc.id='';var lc=new m();lc.init(l.scry(kc,'div.ego_unit'));var mc=true;lc.forEach(function(nc){if(mc){mc=false;}else l.remove(nc);});k.addClass(kc,'fixed_elem');return kc;}function nb(){pa=undefined;if(!o.tabHasScrubber(ra)){rb(wa);ub();}else if(ab){sb(la,false);var kc=bb;bb&&l.remove(bb);bb=mb();if(kc)fc();rb(ya);ub();if(!ta){var lc=t.getCurrentScrubber();if(lc)ec(lc.getRoot(),lc.getOffset());}ta&&ta.start();}else jc.adjustAdsToFit();}function ob(){if(bb){l.remove(bb);bb=null;}if(ta){ta.stop();ta=null;}var kc=o.tabHasScrubber(ra);k.conditionClass(la,'fixed_elem',!ab&&(qb()||kc));k.conditionClass(la,"_31wm",!kc);k.conditionClass(la,"_5r9k",kc);}function pb(kc){var lc=x.getViewportDimensions().y,mc=t.getCurrentScrubber(),nc=mc?mc.getOffset():s.SCRUBBER_DEFAULT_OFFSET,oc=lc-nc-ea;if(mc||qb())return lb(oc,mc,kc);}function qb(){return o.tabHasFixedAds(ra);}function rb(kc){oa=Math.min(kc,qa.getCount());qa.forEach(function(lc,mc){sb(lc,mc>=oa);});sb(la,oa===0);}function sb(kc,lc){k.conditionClass(kc,"_22r",lc);kc.setAttribute('aria-hidden',lc?'true':'false');}function tb(kc){var lc=l.find(qa.getUnit(kc),"div._4u8"),mc=lc.getAttribute('data-ad');return JSON.parse(mc).adid;}function ub(){wb();vb();}function vb(){var kc;if(pa!==undefined){kc=qa.getHoldoutAdIDsForSpace(pa,ac);}else kc=qa.getHoldoutAdIDsForNumAds(oa);if(kc)kc.forEach(xb);}function wb(){if(!cb)return;for(var kc=oa-1;kc>=0;--kc){if(ta&&ta.isFixed()&&(kc!==0||bb&&!k.shown(bb)))continue;var lc=tb(kc);if(!cb[lc])return;xb(lc);}}function xb(kc){if(!cb[kc])return;var lc=l.create('iframe',{src:new w('/ai.php').addQueryData({aed:cb[kc]}),width:0,height:0,frameborder:0,scrolling:'no',className:'fbEmuTracking'});lc.setAttribute('aria-hidden','true');l.appendContent(la,lc);delete cb[kc];}function yb(kc){var lc=0;for(var mc=0;mc<wa;mc++){var nc=zb(mc);kc-=nc;if(kc>0&&nc>0)lc++;}return lc;}function zb(kc){var lc=qa.getUnit(kc);if(!lc)return 0;return ac(lc);}function ac(kc){if(!kc.getAttribute(fa))bc(kc);return parseInt(kc.getAttribute(fa),10);}function bc(kc){kc.setAttribute(fa,kc.offsetHeight);}function cc(){for(var kc=0;kc<qa.getCount();kc++){var lc=qa.getUnit(kc);if(!lc)continue;bc(lc);}}function dc(){var kc=l.scry(la,'div.ego_unit');qa.init(kc);var lc=kc.length;if(!lc)return;k.addClass(qa.getUnit(0),'ego_unit_no_top_border');nb();setTimeout(function(){kc.forEach(bc);jc.adjustAdsToFit();ua=Date.now();},0);}function ec(kc,lc){ta=new p(kc,lc,function(mc){if(mc){fc();}else{l.remove(bb);ub();}});if(bb)ta.start();}function fc(){l.insertAfter(la,bb);gc();}function gc(){k.conditionShow(bb,zb(0)<=pb(1)&&!v.isTiny());}function hc(){if(sa){var kc=ba(ma);l.find(kc,'.ego_column').appendChild(sa);}if(q.fade)new i(ba(ma)).from('opacity',0).to('opacity',1).duration(600).go();}function ic(kc){return !!l.scry(kc,'div.fbEmuHidePoll')[0];}var jc={init:function(kc,lc,mc){if(ja)return;wa=mc.max_ads;ka=mc.refresh_delay;ha=mc.refresh_threshold;xa=mc.min_ads;ya=mc.min_ads_short;ja=true;na=lc;la=kc;h.updateRhcID(ca(la));db=j.subscribe(['UFI/CommentAddedActive','UFI/CommentDeletedActive','UFI/LikeActive','Curation/Action','ProfileBrowser/LoadMoreContent','Ads/NewContentDisplayed'],jc.loadAdsIfEnoughTimePassed);eb=j.subscribe('TimelineSideAds/refresh',jc.forceReloadAds);fb=j.subscribe('ProfileQuestionAnswered',jc.forceReloadAdsWithCallback);gb=j.subscribe('Ads/displayPoll',jc.displayAdsPoll);hb=j.subscribe('Ads/hidePoll',jc.hideAdsPoll);kb=aa(jc.loadAdsIfEnoughTimePassed,ka,this,true);if(mc.mouse_move){jb.push(n.listen(window,'mousemove',kb));jb.push(n.listen(window,'scroll',kb));jb.push(n.listen(window,'resize',kb));jb.push(n.listen(la,'mouseenter',function(){va=true;}));jb.push(n.listen(la,'mouseleave',function(){va=false;}));}t.register(r.ADS,jc);},setShortMode:function(kc){ab=kc;},start:function(kc){cb=kc;za=null;dc();},updateCurrentKey:function(kc){if(kc==ra)return;ra=kc;ob();},loadAds:function(kc){if(za)return;ua=Infinity;za=u.loadFromEndpoint('WebEgoPane',la.id,{pid:33,data:[na,'timeline_'+kc,ab?ya:wa,++ia,false]},{crossPage:true,bundle:false,handler:hc});},registerScrubber:function(kc){if(ab)ec(kc.getRoot(),kc.getOffset());!za&&jc.adjustAdsToFit();},intentShown:function(){if(!q.stateRefresh)return false;switch(h.getState()){case ga.HOVER:case ga.INTENT:default:return true;case ga.NO_INTENT:return false;case ga.STATIONARY:return !q.refreshOnStationary;}},loadAdsIfEnoughTimePassed:function(){if(ha&&Date.now()-ua>=ha&&!v.isTiny()&&(!ta||ta.isFixed())&&(!cb||!cb[tb(0)])&&!jc.intentShown()&&!va)jc.loadAds(ra);jc.adjustAdsToFit();},forceReloadAdsWithCallback:function(kc,lc){sa=lc;ma=ca(la);jc.loadAds(ra);},forceReloadAds:function(){jc.loadAds(ra);},displayAdsPoll:function(){var kc=-1;for(var lc=0;lc<qa.getCount();lc++){var mc=qa.getUnit(lc);if(!mc)continue;if(kc===-1&&ic(mc))kc=lc;bc(mc);}jc.adjustAdsToFit();if(kc===oa&&kc>0){sb(qa.getUnit(kc-1),true);sb(qa.getUnit(kc),false);}},hideAdsPoll:function(){cc();jc.adjustAdsToFit();},adjustAdsToFit:function(){if(!la||ib)return;ib=true;if(ab){if(ta&&bb){ta.handleScroll();if(ta.isFixed()){k.conditionShow(bb,zb(0)<=pb(1)&&!v.isTiny());}else rb(ya);ub();}ib=false;return;}var kc=0;da(function(){var lc=pb(xa);if(lc!==undefined){pa=lc;kc=yb(lc);}},function(){if(kc>0){rb(kc);ub();ib=false;}});},reset:function(){ta&&ta.stop();za&&za.cancel();qa=new m();la=null;ta=null;za=null;ia=0;ab=null;bb=null;ra=null;ua=Infinity;ja=false;db&&j.unsubscribe(db);db=null;eb&&j.unsubscribe(eb);eb=null;fb&&j.unsubscribe(fb);gb&&j.unsubscribe(gb);hb&&j.unsubscribe(hb);fb=null;va=false;jb.forEach(function(kc){kc.remove();});jb=[];kb&&kb.reset();}};f.exports=b.TimelineSideAds||jc;},null);
__d('TimelineStickyHeader',['Animation','Arbiter','BlueBar','Bootloader','CSS','DOM','ProfileTabConst','ProfileTabUtils','ProfileTimelineUILogger','Style','TimelineComponentKeys','TimelineController','Vector','ViewportBounds','UITinyViewportAction','ge','getOrCreateDOMID','queryThenMutateDOM'],function a(b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y){if(c.__markCompiled)c.__markCompiled();var z=200,aa=358,ba=48,ca=false,da=false,ea,fa,ga,ha,ia=false,ja=0,ka,la,ma={},na={VISIBLE:'TimelineStickyHeader/visible',ADJUST_WIDTH:'TimelineStickyHeader/adjustWidth',init:function(oa){if(ca)return;ca=true;ea=oa;fa=m.find(oa,'div.name');ga=m.find(oa,'div.actions');da=l.hasClass(oa,'fbTimelineStickyHeaderVisible');var pa,qa=false;y(function(){var ra=j.getBar();if(ra.offsetTop&&!w('page_admin_panel')&&s.getCurrentKey()!==n.TIMELINE){pa=t.tElementDimensions(ra).y;qa=true;}},function(){if(qa){k.loadModules(["StickyController"],function(ra){new ra(oa,pa).start();});}else l.addClass(oa,'fixed_elem');na.updateBounds(da);s.register(r.STICKY_HEADER,na);},'TimelineStickyHeader/init');},reset:function(){ca=false;da=false;ea=null;fa=null;ga=null;ma={};ha.remove();ha=null;},handleTabChange:function(oa){ja=o.isTimelineTab(oa)?aa-ba:0;if(!o.tabHasStickyHeader(oa)){this.toggle(false,function(){return l.hide(ea);});return;}l.show(ea);},updateBounds:function(){y(function(){ka=ea.offsetTop;la=ea.scrollHeight;},function(){ha=u.addTop(function(){return da?ka+la:0;});},'TimelineStickyHeader/init');},check:function(oa){if(v.isTiny()){this.toggle(false);return;}var pa=ja===0||oa>=ja;this.toggle(pa);},toggle:function(oa,pa){if(oa===da){pa&&pa();return;}var qa=oa?ka-la:ka,ra=oa?ka:ka-la;q.set(ea,'top',qa+'px');l.addClass(ea,'fbTimelineStickyHeaderAnimating');var sa=x(ea);ma[sa]&&ma[sa].stop();ma[sa]=new h(ea).from('top',qa).to('top',ra).duration(z).ondone(function(){ma[sa]=null;if(oa&&!ia){p.logStickyHeaderImpression();ia=true;}y(null,function(){l.conditionClass(ea,'fbTimelineStickyHeaderHidden',!oa);ea.setAttribute('aria-hidden',oa?'false':'true');l.removeClass(ea,'fbTimelineStickyHeaderAnimating');q.set(ea,'top','');na.updateBounds();i.inform(na.VISIBLE,oa);pa&&pa();});}).go();da=oa;if(da)na.adjustWidth();},adjustWidth:function(){i.inform(na.ADJUST_WIDTH,fa,i.BEHAVIOR_STATE);},getRoot:function(){return ea;},setActions:function(oa){if(ca&&oa){m.setContent(ga,oa);ga=oa;}}};f.exports=b.TimelineStickyHeader||na;},null);
__d('ButtonGroup',['CSS','DataStore','Parent'],function a(b,c,d,e,f,g,h,i,j){if(c.__markCompiled)c.__markCompiled();var k='firstItem',l='lastItem';function m(r,s){var t=j.byClass(r,s);if(!t)throw new Error('invalid use case');return t;}function n(r){return h.shown(r)&&Array.from(r.childNodes).some(h.shown);}function o(r){var s,t,u;Array.from(r.childNodes).forEach(function(v){u=n(v);h.removeClass(v,k);h.removeClass(v,l);h.conditionShow(v,u);if(u){s=s||v;t=v;}});s&&h.addClass(s,k);t&&h.addClass(t,l);h.conditionShow(r,s);}function p(r,s){var t=m(s,'uiButtonGroupItem');r(t);o(t.parentNode);}function q(r){'use strict';this._root=m(r,'uiButtonGroup');i.set(this._root,'ButtonGroup',this);o(this._root);}q.getInstance=function(r){'use strict';var s=m(r,'uiButtonGroup'),t=i.get(s,'ButtonGroup');return t||new q(s);};Object.assign(q.prototype,{hideItem:p.bind(null,h.hide),showItem:p.bind(null,h.show),toggleItem:p.bind(null,h.toggle)});f.exports=q;},null);
__d('TimelineStickyHeaderNav',['Arbiter','BlueBar','ButtonGroup','CSS','DataStore','DateStrings','DOM','Event','Parent','ProfileTimelineUILogger','SelectorDeprecated','Style','SubscriptionsHandler','TimelineComponentKeys','TimelineConstants','TimelineController','UITinyViewportAction','URI','Vector','queryThenMutateDOM'],function a(b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z,aa){if(c.__markCompiled)c.__markCompiled();var ba=false,ca,da,ea,fa,ga,ha,ia,ja,ka,la,ma,na={},oa={},pa=[],qa=false,ra=[],sa=[],ta,ua=80;function va(){var hb=r.getSelectorMenu(ga);ta.addSubscriptions(o.listen(hb,'click',wa),h.subscribe(v.SECTION_REGISTERED,ya));}function wa(event){var hb=p.byTag(event.getTarget(),'a'),ib=hb&&l.get(hb,'key');if(ib){w.stickyHeaderNavWasClicked(ib);w.navigateToSection(ib);q.logStickyHeaderScrubberClick(ib);event.prevent();}}function xa(hb){if(la===hb&&ja[hb]&&!da.custom_subsection_menu){cb(hb);}else za();w.adjustStickyHeaderWidth();}function ya(hb,ib){var jb=ib.section,kb=jb.getParentKey();if(!kb)return;var lb=bb(kb),mb=w.getCurrentScrubber(),nb=jb.getScrubberKey(),ob=mb?mb.getLabelForSubnav(kb,nb):ob=ab(nb);if(ob){ja[kb]=true;db(lb,{key:nb,label:ob});xa(kb);}}function za(){if(ea)ea.hideItem(ha);}function ab(hb){var ib=hb.split('_');return m.getMonthName(parseInt(ib.pop(),10));}function bb(hb){var ib=ia[hb];if(!ib){ib=ia[hb]=ha.cloneNode(true);var jb=n.scry(ib,'li.activityLog a')[0];if(jb)jb.href=new y(jb.href).addQueryData({key:hb});ta.addSubscriptions(o.listen(ib,'click',wa));}return ib;}function cb(hb){var ib=bb(hb);n.insertAfter(ha,ib);k.hide(ha);for(var jb in ia){var kb=ia[jb];k.conditionShow(kb,kb===ib);}if(ea)ea.showItem(ha);}function db(hb,ib){var jb=n.create('a',{href:'#',rel:'ignore',className:'itemAnchor',tabIndex:0},n.create('span',{className:'itemLabel fsm'},ib.label));jb.setAttribute('data-key',ib.key);jb.setAttribute('aria-checked',false);var kb=n.create('li',{className:'uiMenuItem uiMenuItemRadio uiSelectorOption'},jb);kb.setAttribute('data-label',ib.label);var lb=n.find(hb,'ul.uiMenuInner'),mb=n.create('option',{value:ib.key},ib.label),nb=n.find(hb,'select');if(ib.key==='recent'){n.prependContent(lb,kb);n.insertAfter(nb.options[0],mb);}else{n.appendContent(lb,kb);n.appendContent(nb,mb);}}function eb(hb,ib){var jb=n.scry(hb,'li.uiMenuItem');if(!jb)return;for(var kb=0;kb<jb.length;kb++){var lb=jb[kb];if(k.hasClass(lb,ib)||lb.firstChild.getAttribute('data-key')==ib){n.remove(lb);break;}}var mb=n.find(hb,'select'),nb=n.scry(mb,'option');for(kb=0;kb<nb.length;kb++)if(nb[kb].value===ib){n.remove(nb[kb]);return;}}function fb(event){var hb=p.byClass(event.target,'itemAnchor');if(hb){var ib=l.get(hb,'tab-key');if(ib)q.logStickyHeaderNavItemClick(ib);}}var gb={init:function(hb,ib){if(ba)return;ba=true;ca=hb;da=ib||{};fa=n.find(ca,'div.pageMenu');ga=n.find(ca,'div.sectionMenu');ha=n.find(ca,'div.subsectionMenu');ma=n.find(fa,'li.uiMenuSeparator');ea=j.getInstance(fa);ta=new t();ia={};ja={};ka={};gb.adjustMenuHeights();va();w.register(u.STICKY_HEADER_NAV,gb);sa.forEach(function(jb){jb();});ta.addSubscriptions(o.listen(fa,'click',fb));},reset:function(){ba=false;da={};pa=[];na={};oa={};qa=false;ra=[];ca=null;fa=null;ga=null;ha=null;ma=null;ia={};ja={};ka={};ta.release();},addTimePeriod:function(hb){var ib=w.getCurrentScrubber();if(!ib)return;var jb=ib.getLabelForNav(hb);if(!jb)return;db(ga,{key:hb,label:jb});var kb=n.find(ga,'ul.uiMenuInner');if(hb==='recent'||kb.children.length<2)r.setSelected(ga,hb,true);},updateSection:function(hb,ib){if(ib){var jb=bb(hb);r.setSelected(jb,ib);}else ka[hb]=true;la=hb;r.setSelected(ga,hb,true);xa(hb);},adjustMenuHeights:function(){var hb='';aa(function(){if(!x.isTiny()){hb=z.getViewportDimensions().y-z.getElementDimensions(i.getBar()).y-ua;hb+='px';}},function(){[fa,ga].map(function(ib){if(ib)s.set(n.find(ib,'ul.uiMenuInner'),'maxHeight',hb);});});},initPageMenu:function(hb,ib){if(!ba){sa.push(gb.initPageMenu.bind(null,hb,ib));return;}function jb(kb,lb){kb.forEach(function(mb){var nb=oa[mb]=n.create('li');k.hide(nb);lb?n.insertBefore(ma,nb):n.appendContent(n.find(fa,'ul.uiMenuInner'),nb);});}jb(hb,true);jb(ib,false);na.info=n.scry(fa,'li')[0];pa=ib;qa=true;if(ra.length)ra.forEach(function(kb){gb.registerPageMenuItem(kb.key,kb.item);});},registerPageMenuItem:function(hb,ib){if(!qa){ra.push({key:hb,item:ib});return;}if(oa[hb]){n.replace(oa[hb],ib);na[hb]=ib;delete oa[hb];if(pa.indexOf(hb)>=0)k.show(ma);}},removeTimePeriod:function(hb){eb(ga,hb);},hideSectionMenu:function(){if(ba)k.hide(ga);}};f.exports=gb;},null);
__d('ButtonGroupMonitor',['ContextualDialog','ContextualLayer','CSS','Layer','Parent','SelectorDeprecated','DataStore'],function a(b,c,d,e,f,g,h,i,j,k,l,m,n){if(c.__markCompiled)c.__markCompiled();function o(p,q){var r=l.byClass(p,'bg_stat_elem')||l.byClass(p,'uiButtonGroup');if(!r&&q)r=n.get(q,'toggleElement',null);if(r){q&&n.set(q,'toggleElement',r);j.toggleClass(r,'uiButtonGroupActive');}}k.subscribe(['hide','show'],function(p,q){if(q instanceof i||q instanceof h)o(q.getCausalElement(),q);});m.subscribe(['close','open'],function(p,q){o(q.selector);});},null);