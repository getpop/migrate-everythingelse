!function(){var t=Handlebars.template;(Handlebars.templates=Handlebars.templates||{})["fileupload-picture-download"]=t({1:function(t,l,e,n,a,o,s){var r,u,i=null!=l?l:t.nullContext||{},h=e.helperMissing,d=t.escapeExpression;return'    <div class="module-download fade">\n'+(null!=(r=e.if.call(i,null!=l?l.error:l,{name:"if",hash:{},fn:t.program(2,a,0,o,s),inverse:t.program(4,a,0,o,s),data:a}))?r:"")+'\t\t<div class="delete clearfix" style="padding-top: 5px;">\n\t\t\t<button class="btn btn-danger delete" data-type="'+d((u=null!=(u=e.deleteType||(null!=l?l.deleteType:l))?u:h,"function"==typeof u?u.call(i,{name:"deleteType",hash:{},data:a}):u))+'" data-url="'+d((u=null!=(u=e.deleteUrl||(null!=l?l.deleteUrl:l))?u:h,"function"==typeof u?u.call(i,{name:"deleteUrl",hash:{},data:a}):u))+'">\n\t\t\t\t<span class="glyphicon glyphicon-trash"></span> '+d(t.lambda(null!=(r=null!=s[1]?s[1].titles:s[1])?r.destroy:r,l))+"\n\t\t\t</button>\n\t\t</div>\n    </div>\n"},2:function(t,l,e,n,a){var o;return'            <div class="error">\n            \t<span class="label label-danger">'+t.escapeExpression((o=null!=(o=e.error||(null!=l?l.error:l))?o:e.helperMissing,"function"==typeof o?o.call(null!=l?l:t.nullContext||{},{name:"error",hash:{},data:a}):o))+"</span>\n            </div>\n"},4:function(t,l,e,n,a,o,s){var r,u,i=t.lambda,h=t.escapeExpression,d=null!=l?l:t.nullContext||{},p=e.helperMissing,c="function";return'        \t<div class="preview">\n        \t\t<div class="row">\n\t\t\t\t\t<div class="col-sm-4 col-md-3">\n\t\t\t\t\t\t<label>'+h(i(null!=(r=null!=s[1]?s[1].titles:s[1])?r.avatar:r,l))+'</label>\n\t\t\t\t\t\t<a href="'+h((u=null!=(u=e.thumbUrl||(null!=l?l.thumbUrl:l))?u:p,typeof u===c?u.call(d,{name:"thumbUrl",hash:{},data:a}):u))+'" rel="'+h(i(null!=s[1]?s[1]["image-rel"]:s[1],l))+'" title="'+h(i(null!=(r=null!=s[1]?s[1].titles:s[1])?r.avatar:r,l))+'">\n\t\t\t\t\t\t\t<img class="thumbnail img-responsive" src="'+h((u=null!=(u=e.thumbUrl||(null!=l?l.thumbUrl:l))?u:p,typeof u===c?u.call(d,{name:"thumbUrl",hash:{},data:a}):u))+'" width="'+h((u=null!=(u=e.thumbSize||(null!=l?l.thumbSize:l))?u:p,typeof u===c?u.call(d,{name:"thumbSize",hash:{},data:a}):u))+'" height="'+h((u=null!=(u=e.thumbSize||(null!=l?l.thumbSize:l))?u:p,typeof u===c?u.call(d,{name:"thumbSize",hash:{},data:a}):u))+'">\n\t\t\t\t\t\t</a>\n\t\t\t\t\t</div>\n\t\t\t\t\t<div class="col-sm-8 col-md-9">\n\t\t\t\t\t\t<label>'+h(i(null!=(r=null!=s[1]?s[1].titles:s[1])?r.photo:r,l))+'</label>\n\t\t\t\t\t\t<a href="'+h((u=null!=(u=e.photoUrl||(null!=l?l.photoUrl:l))?u:p,typeof u===c?u.call(d,{name:"photoUrl",hash:{},data:a}):u))+'" rel="'+h(i(null!=s[1]?s[1]["image-rel"]:s[1],l))+'" title="'+h(i(null!=(r=null!=s[1]?s[1].titles:s[1])?r.photo:r,l))+'">\n\t\t\t\t\t\t\t<img class="img-responsive" src="'+h((u=null!=(u=e.photoUrl||(null!=l?l.photoUrl:l))?u:p,typeof u===c?u.call(d,{name:"photoUrl",hash:{},data:a}):u))+'" width="'+h((u=null!=(u=e.photoWidth||(null!=l?l.photoWidth:l))?u:p,typeof u===c?u.call(d,{name:"photoWidth",hash:{},data:a}):u))+'" height="'+h((u=null!=(u=e.photoHeight||(null!=l?l.photoHeight:l))?u:p,typeof u===c?u.call(d,{name:"photoHeight",hash:{},data:a}):u))+'">\n\t\t\t\t\t\t</a>\n\t\t\t\t\t</div>\n\t\t\t\t</div>\n\t\t\t</div>\n'},compiler:[7,">= 4.0.0"],main:function(t,l,e,n,a,o,s){var r;return null!=(r=e.each.call(null!=l?l:t.nullContext||{},null!=(r=null!=l?l.o:l)?r.files:r,{name:"each",hash:{},fn:t.program(1,a,0,o,s),inverse:t.noop,data:a}))?r:""},useData:!0,useDepths:!0})}();