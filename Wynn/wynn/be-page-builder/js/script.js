;(function($){
	"use strict";
	var current_browse_button;
    var doc = {
        ready: function(){
       		be_pb_media.init();
        }
    },
    be_pb_media = {

        media_send_attachment: null,
        media_close_window: null,
        init: function(){
            $(document).on('click','.btn_browse_files',be_pb_media.browse_clicked);
        },
        browse_clicked: function(event) {
            current_browse_button = jQuery(this);
            event.preventDefault();
	
        	wp.media.editor.send.attachment = be_pb_media.media_accept;    
           
            be_pb_media.media_send_attachment = wp.media.editor.send.attachment;
            be_pb_media.media_close_window = wp.media.editor.remove;

           
            wp.media.editor.send.attachment = be_pb_media.media_accept;
            wp.media.editor.remove = be_pb_media.media_close;

			jQuery( ".browsed-images-container" ).sortable({ revert: true, distance: 10 });
			jQuery( ".browsed-images-container" ).disableSelection();
           	wp.media.editor.open();
        },
		media_accept: function(props, attachment){
			if(current_browse_button.hasClass('single')) {
				current_browse_button.closest('.right-section').find('.browsed-images-container').empty();
			}
			var images_container = current_browse_button.closest('.right-section').find('.browsed-images-container');
			var input_name = images_container.attr('data-name');
			images_container.append('<div class="seleced-images-wrap"><input type="hidden" name="'+input_name+'[]" value="'+attachment.id+'" /><img src="'+attachment.url+'" /><span class="remove"></span></div>');
       },
        media_close: function(id){

            wp.media.editor.send.attachment = be_pb_media.media_send_attachment;
            wp.media.editor.remove = be_pb_media.media_close_window;

            be_pb_media.media_send_attachment= null;
            be_pb_media.media_close_window= null;

            wp.media.editor.remove(id);
			alert('close');
        }
    };
    $(document).ready(doc.ready);
})(jQuery); 

jQuery(document).ready(function() {
	"use strict";
	var shortcode_dialog = jQuery("#shortcodes"),
		shortcode_form = jQuery("#shortcode-form"),
		main = jQuery("#be-pb-main"),
		edit_shortcode = jQuery('#edit-shortcode'),
		ajax_url = jQuery('#ajax_url').val(),
		$delete_item,
		$current_add_shortcode_block,
		$custom_overlay = jQuery('.dialog-overlay-custom'),
		$current_shortcode_element;
		
		
		
	doSort();

	jQuery( ".portlet" ).addClass( "ui-helper-clearfix" );


	jQuery('.be-pb-color-field').wpColorPicker();	

	jQuery( "#dialog-confirm" ).dialog({
		resizable: false,
		height: 300,
		width: 420,
		modal: true,
		autoOpen: false,
		buttons: {
			"Ok": function() {
				$delete_item.fadeOut(function(){
					jQuery(this).remove();
				});
				jQuery( this ).dialog( "close" );
			},
			Cancel: function() {
				jQuery( this ).dialog( "close" );
			}
		},
		open: function() {
			jQuery('.ui-dialog-buttonpane').addClass('clearfix');
            jQuery('.ui-dialog-buttonpane').find('button').first().addClass('ok-btn');
			jQuery('.ui-dialog-buttonpane').find('button').last().addClass('cancel-btn');
        },
		position: { my: "center", at: "center", of: window }
	});

	main.on('click','.icon-delete',function(){
		$delete_item = jQuery(this).closest('.be-pb-element');
		jQuery( "#dialog-confirm" ).dialog('open');
	});

	main.on('click','.icon-duplicate',function(){
		var $this_module = jQuery(this).closest('.be-pb-element');
		$this_module.after($this_module.clone());
	});

	main.on('click','.btn-icon-row-delete',function(){
		$delete_item = jQuery(this).closest('.be-pb-row-wrap');
		jQuery( "#dialog-confirm" ).dialog('open');
	});	

	main.on('click','.btn-icon-section-delete',function(){
		$delete_item = jQuery(this).closest('.be-pb-section-wrap');
		jQuery( "#dialog-confirm" ).dialog('open');
	});		

	main.on('click','.choose-shortcode',function(e){
		$current_add_shortcode_block = jQuery(this).closest('.be-pb-controls').prev('.be-pb-shortcode-col');
	    e.preventDefault();
		shortcode_dialog.parent().css({position:"fixed"}).end().dialog( "open" );
		shortcode_dialog.find('button').blur();
	});

	main.on('click','.btn-icon-section-duplicate',function(){
		var $this_section = jQuery(this).closest('.be-pb-section-wrap');
		$this_section.after($this_section.clone());
		doSort();			
	});
	jQuery(document).on('click', '.btn-icon-section-view', function(e){
		e.preventDefault();
		var $this = jQuery(this);
		if($this.closest('.be-pb-section-controls').hasClass('toggled')) {
			$this.closest('.be-pb-section-controls').toggleClass('toggled');
			$this.closest('.be-pb-section-wrap').find('.be-pb-row-controls').each(function(){
				var $this = jQuery(this);
				$this.removeClass('toggled');
			});
			$this.closest('.be-pb-section-wrap').find('.be-pb-multi-fields-header-wrap .be-pb-control-icon.icon-eye').each(function(){
				var $this = jQuery(this);
				$this.closest('.be-pb-multi-wrap').removeClass('toggled');
				$this.closest('.be-pb-multi-wrap').find('.be-pb-multi-fields-wrap').slideUp();
			});
			$this.closest('.be-pb-section-wrap').find('.portlet-header-controls-wrap .be-pb-control-icon.icon-eye').each(function(){
				var $this = jQuery(this);
				$this.closest('.portlet-header').removeClass('toggled');
				$this.closest('.portlet-header').siblings('.portlet-content').slideUp();
			});
		} else {
			$this.closest('.be-pb-section-controls').toggleClass('toggled');
			$this.closest('.be-pb-section-wrap').find('.be-pb-row-controls').each(function(){
				var $this = jQuery(this);
				$this.addClass('toggled');
			});
			$this.closest('.be-pb-section-wrap').find('.be-pb-multi-fields-header-wrap .be-pb-control-icon.icon-eye').each(function(){
				var $this = jQuery(this);
				$this.closest('.be-pb-multi-wrap').addClass('toggled');
				$this.closest('.be-pb-multi-wrap').find('.be-pb-multi-fields-wrap').slideDown();
			});
			$this.closest('.be-pb-section-wrap').find('.portlet-header-controls-wrap .be-pb-control-icon.icon-eye').each(function(){
				var $this = jQuery(this);
				$this.closest('.portlet-header').addClass('toggled');
				$this.closest('.portlet-header').siblings('.portlet-content').slideDown();
			});
		}
	});
	jQuery(document).on('click', '.portlet-header-controls-wrap .be-pb-control-icon.icon-eye', function(e){
		e.preventDefault();
		var $this = jQuery(this);
		$this.closest('.portlet-header').toggleClass('toggled');
		$this.closest('.portlet-header').siblings('.portlet-content').slideToggle();
	});
	jQuery(document).on('click', '.be-pb-multi-fields-header-wrap .be-pb-control-icon.icon-eye', function(e){
		e.preventDefault();
		var $this = jQuery(this);
		$this.closest('.be-pb-multi-wrap').toggleClass('toggled');
		$this.closest('.be-pb-multi-wrap').find('.be-pb-multi-fields-wrap').slideToggle();
	});

	main.on('click','.be-pb-row-controls a',function() {
		
		var $this = jQuery(this);
		var $this_row = $this.closest('.be-pb-row-wrap');
		if($this.data('action') == 'delete' || $this.data('action') == 'edit' || $this.data('action') == 'view' ){
			//$this_row.remove();
			if($this.data('action') == 'view') {
				var $this = jQuery(this);
				if($this.closest('.be-pb-row-controls').hasClass('toggled')) {
					$this.closest('.be-pb-row-controls').toggleClass('toggled');
					$this.closest('.be-pb-row-wrap').find('.be-pb-multi-fields-header-wrap .be-pb-control-icon.icon-eye').each(function(){
						var $this = jQuery(this);
						$this.closest('.be-pb-multi-wrap').removeClass('toggled');
						$this.closest('.be-pb-multi-wrap').find('.be-pb-multi-fields-wrap').slideUp();
					});
					$this.closest('.be-pb-row-wrap').find('.portlet-header-controls-wrap .be-pb-control-icon.icon-eye').each(function(){
						var $this = jQuery(this);
						$this.closest('.portlet-header').removeClass('toggled');
						$this.closest('.portlet-header').siblings('.portlet-content').slideUp();
					});
				} else {
					$this.closest('.be-pb-row-controls').toggleClass('toggled');
					$this.closest('.be-pb-row-wrap').find('.be-pb-multi-fields-header-wrap .be-pb-control-icon.icon-eye').each(function(){
						var $this = jQuery(this);
						$this.closest('.be-pb-multi-wrap').addClass('toggled');
						$this.closest('.be-pb-multi-wrap').find('.be-pb-multi-fields-wrap').slideDown();
					});
					$this.closest('.be-pb-row-wrap').find('.portlet-header-controls-wrap .be-pb-control-icon.icon-eye').each(function(){
						var $this = jQuery(this);
						$this.closest('.portlet-header').addClass('toggled');
						$this.closest('.portlet-header').siblings('.portlet-content').slideDown();
					});
				}
			}
			return false;
		}
		if($this.data('action') == 'duplicate'){
			//$this_row.clone(true).appendTo(main);
			$this_row.after($this_row.clone());
			doSort();
			return false;
		}			
		var row_length= $this_row.children('.be-pb-row').children('.be-pb-col-wrap').length;
		var col_difference = $this.data('col-count') - row_length;
		var convert_to_col= $this.data('col-name');
		if(col_difference == 0){
			changeColClasses($this_row,convert_to_col);
			
		}

		else if(col_difference > 0){
			var i;
			for(i=0; i<col_difference; i++) {
				$this_row.children('.be-pb-row').append('<div class="be-pb-col-wrap '+convert_to_col+'" data-col-name="'+convert_to_col+'">'+
					'<div class="be-pb-column be-pb-shortcode-col"></div>'+
					'<div class="be-pb-controls">'+
		        	    '<a class="mini-btn mini-btn-dark choose-shortcode" title="Add" role="button">'+
							'<span class="btn-icon-plus"><i class="font-icon icon-plus"></i>Add</span>'+
						'</a>'+
				    '</div>'+
				'</div>');
			}
			
			changeColClasses($this_row,convert_to_col);
			
		}
		else{
			var dump_to = $this_row.find('.be-pb-col-wrap:first-child').children('.be-pb-column');
			var to_remove = $this_row.find('.be-pb-col-wrap').slice(col_difference);
			to_remove.each(function(){
				dump_to.append(jQuery(this).children('.be-pb-column').html());
				jQuery(this).remove();
			});
			changeColClasses($this_row,convert_to_col);
			
		}
		doSort();
	});

		

	main.on('click','.be-pb-add-row',function(e){
		e.preventDefault();
		var $this = jQuery(this);
		jQuery.ajax({
			type: "POST",
			url: ajax_url,
			data: "action=be_pb_add_row",
			success	: function(msg) {
				var $row = jQuery(msg);
				$this.siblings('.be-pb-section').append($row);
				doSort();
			},
			error: function(msg) {
				
			},
			complete: function() {
				
			}
		});
	});

	jQuery('#be-pb-add-section').on('click',function(e){
		e.preventDefault();
		jQuery.ajax({

			type: "POST",
			url: ajax_url,
			data: "action=be_pb_add_section",
			success	: function(msg) {
				var $section = jQuery(msg);
				jQuery('#be-pb-main').append($section);
				doSort();
			},
			error: function(msg) {
				
			},
			complete: function() {
				
			}				

		});	
	});

	edit_shortcode.dialog({
		width: 960,
      	height: jQuery(window).height() - 50,
      	maxHeight: '1000',
     	modal: false,
		autoOpen: false,
		resizable: false,
		open: function() {
			$custom_overlay.show();
		}
	});

	shortcode_dialog.dialog({
		width: 960,
      	height: jQuery(window).height() - 50,
      	maxHeight: '1000',
     	modal: false,
		autoOpen: false,
		resizable:false,
		open: function() {
			$custom_overlay.show();
		}
    });

	shortcode_dialog.on('dialogclose',function(e){
		removeEditorControls(shortcode_form);
		shortcode_form.html('');
		$custom_overlay.hide();
	});

	edit_shortcode.on('dialogclose',function(e){
		removeEditorControls(edit_shortcode);
		edit_shortcode.html('');
		$custom_overlay.hide();
	});

	shortcode_dialog.on('dialogopen',function(e) {
		jQuery('#wpbody').find('.switch-tmce').trigger('click');
	});
	edit_shortcode.on('dialogopen',function(e) {
		jQuery('#wpbody').find('.switch-tmce').trigger('click');
	});

	main.on('click','.edit-shortcode',function(e){
		e.preventDefault();
		var shortcode = jQuery(this).closest('.be-pb-element').children('.shortcode');  //parent().siblings('.shortcode');
		$current_shortcode_element = jQuery(this).closest('.be-pb-element');
	
		edit_shortcode.parent().css({position:"fixed"}).end().dialog('open');
		var shortcode_html=encodeURIComponent(shortcode.html());
		jQuery.ajax({

			type: "POST",
			url: ajax_url,
			data: "action=edit_shortcode_form&shortcode_name="+jQuery(this).attr('data-shortcode')+"&shortcode="+shortcode_html,
			success	: function(msg) {
				removeEditorControls(edit_shortcode);
				edit_shortcode.empty();
				edit_shortcode.html(msg);
				edit_shortcode.find(".be-pb-select, .be-pb-checkbox, .be-pb-radio, .be-pb-file").uniform();
				addEditorControls(edit_shortcode);
				attachColorPicker(edit_shortcode);
				edit_shortcode.find('.be-pb-sortable').sortable({ distance: 10 });
				

			},
			error: function(msg) {
				
			},
			complete: function() {
				
			}				

		});	
	});

	jQuery(document).on('click','.seleced-images-wrap .remove', function(e){
		jQuery(this).closest('.seleced-images-wrap').fadeOut(function(){
			jQuery(this).remove();
		});
	});				
	
	jQuery('.insert-shortcode').on('click',function(e){
		e.preventDefault();
		var shortcode_type = jQuery(this).data('shortcode-type'),
		 	$this = jQuery(this),
		 	shortcode_options = jQuery(this).data('shortcode-options');
		jQuery.ajax({
			type: "POST",
			url: ajax_url,
			data: "action=get_shortcode_form&shortcode="+jQuery(this).data('shortcode')+"&type="+shortcode_type,
			success	: function(msg) {
				//removeEditorControls(shortcode_form);
				shortcode_form.empty();
				 if(shortcode_options == 'no'){
				 	$this.closest('.ui-dialog-content').dialog( "close" );
				 	$current_add_shortcode_block.append(msg);						
				}
				else {
					shortcode_form.html(msg);
					shortcode_form.find(".be-pb-select, .be-pb-checkbox, .be-pb-radio, .be-pb-file").uniform();
					addEditorControls(shortcode_form);
					attachColorPicker(shortcode_form);
					jQuery('#shortcodes').animate({scrollTop: jQuery('#shortcode-form').offset().top - 20}, 'slow');
				}
				
			},
			error: function(msg) {
				
			},
			complete: function() {
				
			}
		});
	});
	jQuery(document).on('click','.add-shortcode',function(e){
		e.preventDefault();
		tinyMCE.triggerSave();

		var	shortcode_action = jQuery(this).data('action'),
			form = jQuery(this).closest('form'),
			$this = jQuery(this),
			$shortcode_name = form.data('shortcode-name'),
			$shortcode_type = form.data('shortcode-type'),
			$dialog;

		if(shortcode_action == 'edit' || $shortcode_type == 'multi_single'){
			$dialog = edit_shortcode;
		}
		else{
			$dialog = shortcode_dialog;
		}	
			 
	
		var $ajax_data = "action=get_shortcode_block&shortcode_name="+$shortcode_name+"&"+form.serialize()+"&shortcode_action="+shortcode_action+"&shortcode_type="+$shortcode_type;
	
		jQuery.ajax({
			type: "POST",
			url: ajax_url,
			data: $ajax_data, //"action=get_shortcode_block&shortcode_name="+form.data('shortcode-name')+"&"+form.serialize()+"&shortcode_action="+shortcode_action,
			success	: function(msg) {
				//alert(msg);

				if(shortcode_action == 'edit'){
					removeEditorControls(edit_shortcode);
					edit_shortcode.html('');
					$dialog.dialog( "close" );
					if($shortcode_name == 'section' || $shortcode_name == 'row' || $shortcode_type == 'multi') {					
						$current_shortcode_element.children('.shortcode').html('').append(msg);
					} else {
						$current_shortcode_element.replaceWith(msg);
					}
					
				}
				else {
					removeEditorControls(form);
					form.html('');
					$dialog.dialog( "close" );
					$current_add_shortcode_block.append(msg);
					
				}
				doSort();
				jQuery('#be-pb-save').trigger('click');
				},
			error: function(msg) {
				
			},
			complete: function() {
				
			}
		});
	});

	jQuery(document).on('click','.add-multi-field',function(e){
		e.preventDefault();
		edit_shortcode.parent().css({position:"fixed"}).end().dialog('open');
		$current_add_shortcode_block = jQuery(this).closest('.be-pb-controls').prev('.be-pb-shortcode-col');
		var $ajax_data = "action=be_pb_add_field&shortcode_name="+jQuery(this).closest('.be-pb-multi-wrap').data('shortcode')+"&single_field="+jQuery(this).data('single-field');
			jQuery.ajax({
				type: "POST",
				url: ajax_url,
				data: $ajax_data, //"action=get_shortcode_block&shortcode_name="+form.data('shortcode-name')+"&"+form.serialize()+"&shortcode_action="+shortcode_action,
				success	: function(msg) {
					//alert(msg);	
					edit_shortcode.append(msg);
					addEditorControls(edit_shortcode);
					attachColorPicker(edit_shortcode);
				},
				error: function(msg) {
					
				},
				complete: function() {
					
				}
			});

	}); 

	jQuery(document).on('click','.remove-tab',function(e){
		e.preventDefault();
		jQuery(this).closest('.be-pb-tab').remove();
	});	

	function changeColClasses($row,$convert_to_col) {
		var $column = $row.find('.be-pb-row');
		if($convert_to_col == "two_third"){
			$column.children('.be-pb-col-wrap:first-child').removeClass(function() {
  					return jQuery(this).attr('data-col-name');
				}).addClass($convert_to_col).attr('data-col-name',$convert_to_col);
			$column.children('.be-pb-col-wrap:last-child').removeClass(function() {
  					return jQuery(this).attr('data-col-name');
				}).addClass('one_third').attr('data-col-name','one_third');
		}

		else if($convert_to_col == "three_fourth"){
			$column.children('.be-pb-col-wrap:first-child').removeClass(function() {
  					return jQuery(this).attr('data-col-name');
				}).addClass($convert_to_col).attr('data-col-name',$convert_to_col);
			$column.children('.be-pb-col-wrap:last-child').removeClass(function() {
  					return jQuery(this).attr('data-col-name');
				}).addClass('one_fourth').attr('data-col-name','one_fourth');
		}

		else if($convert_to_col == "one_half_fourth"){
			$column.children('.be-pb-col-wrap:first-child').removeClass(function() {
  					return jQuery(this).attr('data-col-name');
				}).addClass('one_half').attr('data-col-name','one_half');
			$column.children('.be-pb-col-wrap:nth-child(2)').removeClass(function() {
  					return jQuery(this).attr('data-col-name');
				}).addClass('one_fourth').attr('data-col-name','one_fourth');
			$column.children('.be-pb-col-wrap:last-child').removeClass(function() {
  					return jQuery(this).attr('data-col-name');
				}).addClass('one_fourth').attr('data-col-name','one_fourth');			

		}		

		else {

			$column.children('.be-pb-col-wrap').removeClass(function() {
  					return jQuery(this).attr('data-col-name');
				}).attr('data-col-name',$convert_to_col).addClass($convert_to_col);
		}
		
	} 

	function doSort(){
		jQuery(".be-pb-column").sortable({
			connectWith: ".be-pb-column",
			distance: 10
		}).disableSelection();
		jQuery(".be-pb-section").sortable({
			connectWith: ".be-pb-section",
			distance: 10
		}).disableSelection();
		jQuery( ".be-pb-sortable" ).sortable({ distance: 10 });
	}

	function attachColorPicker($form){
		$form.find('.be-pb-color-field').wpColorPicker();
	}

	function removeEditorControls($form) {
		window.tinyMCE.execCommand( "mceRemoveEditor", false, 'textblockcontent' );
		jQuery('#content-old').attr('id','textblockcontent');
		if(jQuery('#textblockcontent').length > 0) {
			var val = window.switchEditors.wpautop(jQuery('#textblockcontent').val());
			jQuery('#textblockcontent').val(val);
		}
		window.tinyMCE.execCommand( "mceAddEditor", false, 'textblockcontent' );
		
	}
	
	var add_button = true;
	function addEditorControls($form) {
		var editors = $form.find('.be-pb-editor');
		window.tinyMCE.execCommand( "mceRemoveEditor", false, 'textblockcontent' );
		jQuery('#textblockcontent').attr('id','content-old');
		$form.find('.be-pb-editor').attr('id','textblockcontent');
		window.tinyMCE.execCommand( "mceAddEditor", false, 'textblockcontent' );
		jQuery('.be-jq-dialog .wp-editor-wrap').removeClass('html-active').addClass('tmce-active');
		window.tinymce.execCommand('mceFocus', false, 'textblockcontent');
		quicktags({id:"textblockcontent", buttons: "link, em, strong, block, del, ins, img, ul, li, ol, code, more, spell, close, fullscreen"});
		QTags.addButton( 'custom_print', 'p', '<p>', '</p>', 'p', 'Print tag', 1, 'textblockcontent' );
		if(add_button) {
			QTags.addButton( 'custom_bold', 'B', '<b>', '</b>', 'b', 'Bold', 1, 'textblockcontent' );
			QTags.addButton( 'custom_italic', 'I', '<i>', '</i>', 'i', 'Italic', 2, 'textblockcontent' );
			QTags.addButton( 'custom_paragraph', 'P', '<p>', '</p>', 'p', 'Paragraph', 3, 'textblockcontent' );
			QTags.addButton( 'custom_blockquote', 'b-quote', '<blockquote>', '</blockquote>', 'blockquote', 'Blockquote', 100, 'textblockcontent' );
			QTags.addButton( 'custom_ul', 'ul', '<ul>', '</ul>', 'ul', 'Unordered List', 101, 'textblockcontent' );
			QTags.addButton( 'custom_ol', 'ol', '<ol>', '</ol>', 'ol', 'Ordered List', 102, 'textblockcontent' );
			QTags.addButton( 'custom_li', 'li', '<li>', '</li>', 'li', 'List', 103, 'textblockcontent' );
			QTags.addButton( 'custom_code', 'code', '<code>', '</code>', 'code', 'Code', 104, 'textblockcontent' );
			QTags.addButton( 'custom_more', 'more', '<!--more-->', '', 'more', 'More', 105, 'textblockcontent' );
			QTags.addButton( 'custom_del', 'del', '<del datetime="'+Date('dd-MM-yyyy hh:mm:ss AA')+'">', '</del>', 'del', 'Del', 106, 'textblockcontent' );
			QTags.addButton( 'custom_ins', 'ins', '<ins datetime="'+Date('dd-MM-yyyy hh:mm:ss AA')+'">', '</ins>', 'ins', 'Ins', 107, 'textblockcontent' );
			add_button = false;
		}
	}

	jQuery(document).on('click', '.be-jq-dialog .wp-switch-editor.switch-tmce', function() {
		jQuery(this).closest('.wp-editor-wrap').removeClass('html-active').addClass('tmce-active');
		window.tinyMCE.execCommand('mceAddEditor', false, 'textblockcontent');
	});
	jQuery(document).on('click', '.be-jq-dialog .wp-switch-editor.switch-html', function() {
		jQuery(this).closest('.wp-editor-wrap').removeClass('tmce-active').addClass('html-active');
		window.tinyMCE.execCommand('mceRemoveEditor', false, 'textblockcontent');
	});

	jQuery('#be-pb-save').on('click', function(e){
		e.preventDefault();
		jQuery('#be-pb-loader').show();
		var sections = jQuery("#be-pb-main").children('.be-pb-section-wrap'),
			output = '',
			html ='';
		//html = main.html();
		//html = encodeURIComponent(html);
		sections.each(function(){
			output += jQuery(this).children('.shortcode').html();
			var rows = jQuery(this).find('.be-pb-row-wrap'); 	
			rows.each(function(){
				output += jQuery(this).children('.shortcode').html();
				var columns = jQuery(this).find('.be-pb-col-wrap');
				columns.each(function(){
					output +='['+jQuery(this).attr('data-col-name')+']';
					var elements = jQuery(this).find('.be-pb-column').children();
					elements.each(function(){
						if(jQuery(this).hasClass('be-pb-multi-wrap')){
							//output +='['+jQuery(this).attr('data-shortcode')+']';
							output += jQuery(this).children('.shortcode').html();
							var single_field = jQuery(this).find('.be-pb-element');
							single_field.each(function(){
								output += jQuery(this).children('.shortcode').html();
							});
							output +='[/'+jQuery(this).attr('data-shortcode')+']';
						}
						else {
							output += jQuery(this).children('.shortcode').html();
						}
					});
					output +='[/'+jQuery(this).attr('data-col-name')+']';
				});
				output +='[/row]';
			});
			output +='[/section]';
		});
		console.log(output);
		output = encodeURIComponent(output);
		var disable;
		if(jQuery('#be-pb-disable-check').is(':checked')) {
			disable = 'yes';
		} else {
			disable = 'no';
		}	
		jQuery.ajax({
			type: "POST",
			url: ajax_url,
			data: "action=save_be_pb_builder&nonce="+jQuery('#be_pb_save_nonce').val()+"&post_id="+jQuery('#post_ID').val()+"&content="+output+"&disable_pb="+disable,
			success	: function(msg) {	
				jQuery('#be-pb-loader').hide();
				if(msg =='success') {
					jQuery('<div class="notification green">Successfully Saved<span class="close"></span></div>').hide().appendTo('#be-pb-save-wrap').fadeIn();
					
				}
				else if(msg == 'no_changes') {
					jQuery('<div class="notification red">No Changes have been made<span class="close"></span></div>').hide().appendTo('#be-pb-save-wrap').fadeIn();
				}
				setTimeout( "jQuery('#be-pb-save-wrap .notification').fadeOut(500, function() { jQuery(this).remove(); });",2000 );
				
			},
			error: function(msg) {
				
			},
			complete: function() {
				
			}
		});
	});	// end pagebuilder save function

}); // end document ready function