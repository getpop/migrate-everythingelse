!function(){var n=Handlebars.template;(Handlebars.templates=Handlebars.templates||{})["layout-menu-dropdown"]=n({1:function(n,e,t,a,l){var u;return n.escapeExpression((u=null!=(u=t.id||(null!=e?e.id:e))?u:t.helperMissing,"function"==typeof u?u.call(null!=e?e:n.nullContext||{},{name:"id",hash:{},data:l}):u))},3:function(n,e,t,a,l,u,s){var r,i,o=null!=e?e:n.nullContext||{},m=t.helperMissing,p=n.escapeExpression;return"\n\t\titem = '<li id=\"menu-item-"+p((t.lastGeneratedId||e&&e.lastGeneratedId||m).call(o,{name:"lastGeneratedId",hash:{context:s[1]},data:l}))+"-"+p((i=null!=(i=t.id||(null!=e?e.id:e))?i:m,"function"==typeof i?i.call(o,{name:"id",hash:{},data:l}):i))+'" class="'+p((i=null!=(i=t.classes||(null!=e?e.classes:e))?i:m,"function"==typeof i?i.call(o,{name:"classes",hash:{},data:l}):i))+"\">';\n"+(null!=(r=(t.compare||e&&e.compare||m).call(o,null!=e?e.title:e,"divider",{name:"compare",hash:{},fn:n.program(4,l,0,u,s),inverse:n.program(6,l,0,u,s),data:l}))?r:"")+"\t\titem += '</li>';\n\n"+(null!=(r=(t.compare||e&&e.compare||m).call(o,null!=e?e["menu-item-parent"]:e,0,{name:"compare",hash:{operator:">"},fn:n.program(8,l,0,u,s),inverse:n.program(10,l,0,u,s),data:l}))?r:"")},4:function(n,e,t,a,l){return"\t\t\titem += '<hr />';\n"},6:function(n,e,t,a,l){var u,s,r=null!=e?e:n.nullContext||{},i=t.helperMissing,o=n.escapeExpression;return"\t\t\titem += '<a href=\""+o((s=null!=(s=t.url||(null!=e?e.url:e))?s:i,"function"==typeof s?s.call(r,{name:"url",hash:{},data:l}):s))+'" title="'+o((s=null!=(s=t.alt||(null!=e?e.alt:e))?s:i,"function"==typeof s?s.call(r,{name:"alt",hash:{},data:l}):s))+'" '+(null!=(s=null!=(s=t["additional-attrs"]||(null!=e?e["additional-attrs"]:e))?s:i,u="function"==typeof s?s.call(r,{name:"additional-attrs",hash:{},data:l}):s)?u:"")+">"+(null!=(s=null!=(s=t.title||(null!=e?e.title:e))?s:i,u="function"==typeof s?s.call(r,{name:"title",hash:{},data:l}):s)?u:"")+"</a>';\n"},8:function(n,e,t,a,l){var u,s=null!=e?e:n.nullContext||{},r=t.helperMissing,i=n.escapeExpression;return"\t\t\tif (!submenus['menu-item-"+i((u=null!=(u=t["menu-item-parent"]||(null!=e?e["menu-item-parent"]:e))?u:r,"function"==typeof u?u.call(s,{name:"menu-item-parent",hash:{},data:l}):u))+"']) {\n\t\t\t\tsubmenus['menu-item-"+i((u=null!=(u=t["menu-item-parent"]||(null!=e?e["menu-item-parent"]:e))?u:r,"function"==typeof u?u.call(s,{name:"menu-item-parent",hash:{},data:l}):u))+"'] = [];\n\t\t\t}\n\t\t\tsubmenus['menu-item-"+i((u=null!=(u=t["menu-item-parent"]||(null!=e?e["menu-item-parent"]:e))?u:r,"function"==typeof u?u.call(s,{name:"menu-item-parent",hash:{},data:l}):u))+"'].push(item);\n"},10:function(n,e,t,a,l,u,s){return"\t\t\t$('#"+n.escapeExpression((t.lastGeneratedId||e&&e.lastGeneratedId||t.helperMissing).call(null!=e?e:n.nullContext||{},{name:"lastGeneratedId",hash:{context:s[1]},data:l}))+"').append(item);\n"},compiler:[7,">= 4.0.0"],main:function(n,e,t,a,l,u,s){var r,i,o,m=null!=e?e:n.nullContext||{},p=t.helperMissing,c=n.escapeExpression,d='<ul class="nav '+c((i=null!=(i=t.class||(null!=e?e.class:e))?i:p,"function"==typeof i?i.call(m,{name:"class",hash:{},data:l}):i))+'" style="'+c((i=null!=(i=t.style||(null!=e?e.style:e))?i:p,"function"==typeof i?i.call(m,{name:"style",hash:{},data:l}):i))+'" role="menu" ';return i=null!=(i=t.generateId||(null!=e?e.generateId:e))?i:p,o={name:"generateId",hash:{},fn:n.program(1,l,0,u,s),inverse:n.noop,data:l},r="function"==typeof i?i.call(m,o):i,t.generateId||(r=t.blockHelperMissing.call(e,r,o)),null!=r&&(d+=r),d+">\n</ul>\n<script type=\"text/javascript\">\n(function($){\n\n\tvar item = '', submenus = {};\n"+(null!=(r=t.each.call(m,null!=(r=null!=e?e.dbObject:e)?r.items:r,{name:"each",hash:{},fn:n.program(3,l,0,u,s),inverse:n.noop,data:l}))?r:"")+"\n\t$.each(submenus, function(key, value) {\n\t\t$('#'+key+'>a')\n\t\t\t.addClass('dropdown-toggle')\n\t\t\t.data('toggle', 'dropdown')\n\t\t\t.append(' <span class=\"caret\"></span>');\n\t\t$('#'+key)\n\t\t\t.addClass('dropdown')\n\t\t\t.append($('<ul class=\"dropdown-menu\" role=\"menu\"></ul>').html(value.join('')));\n\t});\n\n})(jQuery);\n<\/script>"},useData:!0,useDepths:!0})}();