jQuery(document).ready(function(){jQuery(".slider").each(function(e,t){var n=this.id;var r=jQuery("#"+n);var i=r.next(".opacity-value");var s=i.val();if(s==-1)s=1;r.prev("p").find(".opacity").val(s);r.slider({animate:true,range:"min",step:.1,min:0,max:1,value:s,slide:function(e,t){r.prev("p").find(".opacity").val(t.value)},change:function(e,t){i.attr("value",t.value)}})})})