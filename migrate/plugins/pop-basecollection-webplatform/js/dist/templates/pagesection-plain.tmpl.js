!function(){var e=Handlebars.template;(Handlebars.templates=Handlebars.templates||{})["pagesection-plain"]=e({1:function(e,n,l,a,t,s,r){var u;return null!=(u=(l.withModule||n&&n.withModule||l.helperMissing).call(null!=n?n:e.nullContext||{},r[1],n,{name:"withModule",hash:{},fn:e.program(2,t,0,s,r),inverse:e.noop,data:t}))?u:""},2:function(e,n,l,a,t,s,r){var u,o=null!=n?n:e.nullContext||{};return"\t\t"+e.escapeExpression((l.enterModule||n&&n.enterModule||l.helperMissing).call(o,r[2],{name:"enterModule",hash:{},data:t}))+"\n"+(null!=(u=l.each.call(o,null!=(u=null!=r[2]?r[2].templates:r[2])?u.insideextensions:u,{name:"each",hash:{},fn:e.program(3,t,0,s,r),inverse:e.noop,data:t}))?u:"")},3:function(e,n,l,a,t,s,r){return"\t\t\t"+e.escapeExpression((l.enterTemplate||n&&n.enterTemplate||l.helperMissing).call(null!=n?n:e.nullContext||{},n,{name:"enterTemplate",hash:{context:r[3]},data:t}))+"\n"},5:function(e,n,l,a,t,s,r){return"\t"+e.escapeExpression((l.enterTemplate||n&&n.enterTemplate||l.helperMissing).call(null!=n?n:e.nullContext||{},n,{name:"enterTemplate",hash:{context:r[1]},data:t}))+"\n"},compiler:[7,">= 4.0.0"],main:function(e,n,l,a,t,s,r){var u,o=null!=n?n:e.nullContext||{};return(null!=(u=l.each.call(o,null!=(u=null!=n?n["settings-ids"]:n)?u.inners:u,{name:"each",hash:{},fn:e.program(1,t,0,s,r),inverse:e.noop,data:t}))?u:"")+(null!=(u=l.each.call(o,null!=(u=null!=n?n.templates:n)?u.extensions:u,{name:"each",hash:{},fn:e.program(5,t,0,s,r),inverse:e.noop,data:t}))?u:"")},useData:!0,useDepths:!0})}();