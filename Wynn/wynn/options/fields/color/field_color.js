jQuery(document).ready(function(){$colorpicker_inputs=jQuery("input.popup-colorpicker");$colorpicker_inputs.each(function(){var e=jQuery(this);var t=jQuery(this).siblings(".color-display");var n="#"+jQuery(this).attr("id")+"picker";var r=jQuery.farbtastic(n,function(n){e.val(n);t.css({backgroundColor:n});e.keyup(function(){var e=jQuery(this).val();t.css({backgroundColor:e})});if(r.bound==true){e.change()}else{r.bound=true}});r.setColor(e.val())});$colorpicker_inputs.each(function(e){jQuery(this).next(".farb-popup").hide()});$colorpicker_inputs.live("focus",function(e){jQuery(this).next(".farb-popup").show();jQuery(this).parents("li").css({position:"relative",zIndex:"9999"});jQuery("#tabber").css({overflow:"visible"})});$colorpicker_inputs.live("blur",function(e){jQuery(this).next(".farb-popup").hide();jQuery(this).parents("li").css({zIndex:"0"})})})