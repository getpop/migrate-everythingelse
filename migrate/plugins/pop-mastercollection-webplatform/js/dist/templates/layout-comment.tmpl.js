!function(){var t=Handlebars.template;(Handlebars.templates=Handlebars.templates||{})["layout-comment"]=t({1:function(t,n,e,l,a,o,u){var s,d,i=null!=n?n:t.nullContext||{},r=e.helperMissing,c=t.lambda,m=t.escapeExpression;return"\t<div "+(null!=(s=(e.generateId||n&&n.generateId||r).call(i,{name:"generateId",hash:{context:u[1]},fn:t.program(2,a,0,o,u),inverse:t.noop,data:a}))?s:"")+' class="'+m(c(null!=u[1]?u[1].class:u[1],n))+" pop-comment-"+m((d=null!=(d=e.id||(null!=n?n.id:n))?d:r,"function"==typeof d?d.call(i,{name:"id",hash:{},data:a}):d))+' module-comment" style="'+m(c(null!=u[1]?u[1].style:u[1],n))+'">\n\t\t<div class="comment-layout">\n\t\t\t<div class="media">\n'+(null!=(s=(e.withModule||n&&n.withModule||r).call(i,u[1],"authoravatar",{name:"withModule",hash:{},fn:t.program(4,a,0,o,u),inverse:t.noop,data:a}))?s:"")+'\t\t\t\t<div class="media-body">\n\t\t\t\t\t<div class="module-remove pull-right">\n'+(null!=(s=(e.withModule||n&&n.withModule||r).call(i,u[1],"btn-replycomment",{name:"withModule",hash:{},fn:t.program(6,a,0,o,u),inverse:t.noop,data:a}))?s:"")+'\t\t\t\t\t</div>\n\t\t\t\t\t<div class="comment">\n'+(null!=(s=(e.withModule||n&&n.withModule||r).call(i,u[1],"authorname",{name:"withModule",hash:{},fn:t.program(8,a,0,o,u),inverse:t.noop,data:a}))?s:"")+(null!=(s=e.if.call(i,null!=(s=null!=u[1]?u[1]["module-names"]:u[1])?s.abovelayout:s,{name:"if",hash:{},fn:t.program(10,a,0,o,u),inverse:t.noop,data:a}))?s:"")+(null!=(s=(e.withModule||n&&n.withModule||r).call(i,u[1],"content",{name:"withModule",hash:{},fn:t.program(14,a,0,o,u),inverse:t.noop,data:a}))?s:"")+'\t\t\t\t\t</div>\n\t\t\t\t\t<div class="clearfix"></div>\n\t\t\t\t\t<div class="pop-commentreplies-'+m((d=null!=(d=e.id||(null!=n?n.id:n))?d:r,"function"==typeof d?d.call(i,{name:"id",hash:{},data:a}):d))+'"></div>\n\t\t\t\t</div>\n\t\t\t</div>\n\t\t</div>\n\t</div>\n'},2:function(t,n,e,l,a,o,u){return t.escapeExpression(t.lambda(null!=u[1]?u[1].id:u[1],n))},4:function(t,n,e,l,a,o,u){var s;return'\t\t\t\t\t<div class="media-left">\n\t\t\t\t\t\t<div class="comment-author-avatar">\t\t\t\t\t\n\t\t\t\t\t\t\t'+t.escapeExpression((e.enterModule||n&&n.enterModule||e.helperMissing).call(null!=n?n:t.nullContext||{},u[2],{name:"enterModule",hash:{dbObjectID:null!=u[1]?u[1].author:u[1],dbKey:null!=(s=null!=(s=null!=u[2]?u[2].bs:u[2])?s.dbkeys:s)?s.author:s},data:a}))+"\n\t\t\t\t\t\t</div>\n\t\t\t\t\t</div>\n"},6:function(t,n,e,l,a,o,u){return"\t\t\t\t\t\t\t"+t.escapeExpression((e.enterModule||n&&n.enterModule||e.helperMissing).call(null!=n?n:t.nullContext||{},u[2],{name:"enterModule",hash:{},data:a}))+"\n"},8:function(t,n,e,l,a,o,u){var s,d=t.escapeExpression;return'\t\t\t\t\t\t\t<div class="comment-author">\n\t\t\t\t\t\t\t\t<div class="item">\n\t\t\t\t\t\t\t\t\t'+d((e.enterModule||n&&n.enterModule||e.helperMissing).call(null!=n?n:t.nullContext||{},u[2],{name:"enterModule",hash:{dbObjectID:null!=u[1]?u[1].author:u[1],dbKey:null!=(s=null!=(s=null!=u[2]?u[2].bs:u[2])?s.dbkeys:s)?s.author:s},data:a}))+'\n\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t<div class="item comment-date">\n\t\t\t\t\t\t\t\t\t<small><em>'+d(t.lambda(null!=u[1]?u[1].date:u[1],n))+"</em></small>\n\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t</div>\n"},10:function(t,n,e,l,a,o,u){var s,d=t.lambda,i=t.escapeExpression;return'\t\t\t\t\t\t\t<div class="abovelayout '+i(d(null!=(s=null!=u[1]?u[1].classes:u[1])?s.abovelayout:s,n))+'" style="'+i(d(null!=(s=null!=u[1]?u[1].styles:u[1])?s.abovelayout:s,n))+'">\n'+(null!=(s=e.each.call(null!=n?n:t.nullContext||{},null!=(s=null!=u[1]?u[1]["module-names"]:u[1])?s.abovelayout:s,{name:"each",hash:{},fn:t.program(11,a,0,o,u),inverse:t.noop,data:a}))?s:"")+"\t\t\t\t\t\t\t</div>\n"},11:function(t,n,e,l,a,o,u){var s;return null!=(s=(e.withModule||n&&n.withModule||e.helperMissing).call(null!=n?n:t.nullContext||{},u[2],n,{name:"withModule",hash:{},fn:t.program(12,a,0,o,u),inverse:t.noop,data:a}))?s:""},12:function(t,n,e,l,a,o,u){return"\t\t\t\t\t\t\t\t\t\t"+t.escapeExpression((e.enterModule||n&&n.enterModule||e.helperMissing).call(null!=n?n:t.nullContext||{},u[3],{name:"enterModule",hash:{},data:a}))+"\n"},14:function(t,n,e,l,a,o,u){return'\t\t\t\t\t\t\t<div class="comment-content pop-content">\n\t\t\t\t\t\t\t\t'+t.escapeExpression((e.enterModule||n&&n.enterModule||e.helperMissing).call(null!=n?n:t.nullContext||{},u[2],{name:"enterModule",hash:{},data:a}))+"\n\t\t\t\t\t\t\t</div>\n"},compiler:[7,">= 4.0.0"],main:function(t,n,e,l,a,o,u){var s;return null!=(s=e.with.call(null!=n?n:t.nullContext||{},null!=n?n.dbObject:n,{name:"with",hash:{},fn:t.program(1,a,0,o,u),inverse:t.noop,data:a}))?s:""},useData:!0,useDepths:!0})}();