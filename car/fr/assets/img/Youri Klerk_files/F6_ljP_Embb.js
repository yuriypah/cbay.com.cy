/*!CK:3703385042!*//*1451877096,*/

if (self.CavalryLogger) { CavalryLogger.start_js(["yJTcZ"]); }

__d('AppsDivebarDisplayController',['AppsDivebarConfigData','AsyncRequest','Arbiter','CSS','UIPagelet','cx'],function a(b,c,d,e,f,g,h,i,j,k,l,m){if(c.__markCompiled)c.__markCompiled();var n='173',o={isVisible:function(){if(typeof this._visible!='undefined')return this._visible;this._visible=!h.hidden;return this._visible;},showApps:function(){this._visible=true;var p={fb_source_category:'sidebar'};l.loadFromEndpoint('GamesDivebarPagelet','pagelet_canvas_nav_content',p);k.show('apps_gripper');k.show('pagelet_canvas_nav_content');k.addClass('pagelet_canvas_nav_content',"_4woj");j.inform('AppsDivebar/show-apps');new i('/ajax/feed/apps/resize').setData({height:''+n,menu:true}).setMethod('POST').send();},hideApps:function(){this._visible=false;k.hide('pagelet_canvas_nav_content');k.hide('apps_gripper');j.inform('AppsDivebar/hide-apps');new i('/ajax/feed/apps/resize').setData({height:'1',menu:true}).setMethod('POST').send();}};f.exports=o;},null);
__d('DOMP2PTrigger',['CurrentEnvironment','JSXDOM','P2PAmountUtils','P2PTriggersUtils','TransformTextToDOMMixin','cx'],function a(b,c,d,e,f,g,h,i,j,k,l,m){if(c.__markCompiled)c.__markCompiled();var n={MAX_ITEMS:40,match:function(o){var p=k.getMatches(o);if(!p||!p.length)return false;var q=p[0];if(!j.isValidSendAmount(q))return false;var r=p.index;return {startIndex:r,endIndex:r+q.length,element:this._element(q)};},_element:function(o){return (i.a({href:"#",className:"_35i0"+(h.facebookdotcom?' '+"_4g4e":''),"data-p2p-trigger":o},o));}};f.exports=Object.assign(n,l);},null);
__d('p2pTriggerJSXDOMToString',['DOMEmoji','DOMEmote','DOMP2PTrigger','JSXDOM','transformTextToDOM'],function a(b,c,d,e,f,g,h,i,j,k,l){if(c.__markCompiled)c.__markCompiled();var m=function(n,o,p,q){var r=[];if(q)r.push(j);if(o)r.push(h);if(p)r.push(i);return (k.span(null,l(n,r)).innerHTML);};f.exports=m;},null);
__d('P2PTriggers.react',['DOM','Event','MercuryIDs','P2PActions','P2PLogger','P2PPaymentLoggerEvent','P2PPaymentLoggerEventFlow','P2PUserEligibilityStore','StoreAndPropBasedStateMixin','React','ReactDOM','nullthrows','p2pTriggerJSXDOMToString'],function a(b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t){'use strict';if(c.__markCompiled)c.__markCompiled();var u=q.PropTypes,v=q.createClass({displayName:'P2PTriggers',mixins:[p(o)],propTypes:{renderEmoji:u.bool,renderEmoticons:u.bool,text:u.string.isRequired,threadID:u.string.isRequired},getInitialState:function(){return {amount:''};},statics:{calculateState:function(w){var x=j.isGroupChat(w.threadID)||o.getEligibilityByThreadID(w.threadID);return {isThreadEligible:x,otherUserID:j.getUserIDFromThreadID(w.threadID)};}},_clickListeners:null,componentDidMount:function(){this._clickListeners=[];this.bindClickListeners();},componentWillUnmount:function(){this.unbindClickListeners();},log:function(w,x){l.log(w,babelHelpers._extends({www_event_flow:n.UI_FLOW_P2P_SEND,object_id:this.state.otherUserID},x));},bindClickListeners:function(){var w=s(this._clickListeners);if(!w.length){var x=h.scry(r.findDOMNode(this),'[data-p2p-trigger]');for(var y=0,z=x.length;y<z;y++)w.push(i.listen(x[y],'click',this.handleTriggerClick));}},unbindClickListeners:function(){var w;if(this._clickListeners){for(var x=0,y=this._clickListeners.length;x<y;x++){w=this._clickListeners[x];if(w)w.remove();}this._clickListeners=[];}},componentDidUpdate:function(w,x){if(!x.isThreadEligible&&this.state.isThreadEligible)this.bindClickListeners();},getAmountFromTriggerClickEvent:function(w){var x=w.target.getAttribute('data-p2p-trigger')||'';return x.replace(/[^0-9\.]+/g,'');},handleTriggerClick:function(w){w.preventDefault();var x=this.getAmountFromTriggerClickEvent(w);this.setState({amount:x});this.openSendView();this.log(m.UI_ACTN_INITIATE_SEND_TRIGGER,{raw_amount:this.state.amount,currency:'USD'});},openSendView:function(){k.chatSendViewOpened({threadID:this.props.threadID,amount:this.state.amount});},render:function(){var w=t(this.props.text,this.props.renderEmoji,this.props.renderEmoticons,this.state.isThreadEligible);return (q.createElement('span',{dangerouslySetInnerHTML:{__html:w}}));}});f.exports=v;},null);
__d('TextWithEntitiesAndP2P.react',['BaseTextWithEntities.react','Link.react','P2PTriggers.react','React'],function a(b,c,d,e,f,g,h,i,j,k){'use strict';if(c.__markCompiled)c.__markCompiled();var l=k.createClass({displayName:'TextWithEntitiesAndP2P',_renderText:function(m){return (k.createElement(j,{text:m,renderEmoticons:this.props.renderEmoticons,renderEmoji:this.props.renderEmoji,threadID:this.props.threadID}));},_renderRange:function(m,n){if(this.props.interpolator){return this.props.interpolator(m,n);}else return (k.createElement(i,{href:n.entity},m));},render:function(){return (k.createElement(h,babelHelpers._extends({},this.props,{textRenderer:this._renderText,rangeRenderer:this._renderRange,ranges:this.props.ranges,imageRanges:this.props.imageRanges,aggregatedRanges:this.props.aggregatedRanges,text:this.props.text})));}});f.exports=l;},null);