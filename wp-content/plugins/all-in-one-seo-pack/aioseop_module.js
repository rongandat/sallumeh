if ( typeof aioseop_data != 'undefined' ) {
	aioseop_data = aioseop_data.json.replace(/&quot;/g, '"');
	aioseop_data = jQuery.parseJSON( aioseop_data );
}

function toggleVisibility(id) {
	var e = document.getElementById(id);
	if (e.style.display == 'block')
		e.style.display = 'none';
	else
		e.style.display = 'block';
}

function countChars(field,cntfield) {
	cntfield.value = field.value.length;
}

function aioseop_get_field_value( field ) {
	cur = jQuery('[name=' + field + ']');
	if ( cur.length == 0 ) return field;
	type = cur.attr('type');
	if ( type == "checkbox" || type == "radio" )
		cur = jQuery('input[name=' + field + ']:checked');
	return cur.val();
}

function aioseop_get_field_values( field ) {
	arr = [];
	cur = jQuery('[name=' + field + ']');
	if ( cur.length == 0 ) return field;
	type = cur.attr('type');
	if ( type == "checkbox" || type == "radio" )
		jQuery('input[name=' + field + ']:checked').each(function() {
			arr.push(jQuery(this).val());
		});
	if ( arr.length <= 0 )
		arr.push(cur.val());
	return arr;
}

function aioseop_eval_condshow_logic( statement ) {
	var lhs, rhs;
	if ( ( typeof statement ) == 'object' ) {
		lhs = statement['lhs'];
		rhs = statement['rhs'];
		if ( lhs !== null && ( ( typeof lhs ) == 'object' ) )
			lhs = aioseop_eval_condshow_logic( statement['lhs'] );
		if ( rhs !== null && ( typeof rhs ) == 'object' )
			rhs = aioseop_eval_condshow_logic( statement['rhs'] );
		lhs = aioseop_get_field_value( lhs );
		rhs = aioseop_get_field_value( rhs );
		switch ( statement['op'] ) {
			case 'NOT': return ( ! lhs );
			case 'AND': return ( lhs && rhs );
			case 'OR' : return ( lhs || rhs );
			case '==' : return ( lhs == rhs );
			case '!=' : return ( lhs != rhs );
			default   : return null;
		}
	}
	return statement;
}

function aioseop_do_condshow_match( index, value ) {
	if ( typeof value != 'undefined' ) {
		matches = true;
		jQuery.each(value, function(subopt, setting) {
			var statement;
			if ( ( typeof setting ) == 'object' ) {
				statement = aioseop_eval_condshow_logic( setting );
				if ( !statement ) {
					matches = false;
				}				
			} else {
				if ( subopt.match(/\\\[\\\]/) ) { // special case for these -- pdb
					cur = aioseop_get_field_values( subopt );
					if ( jQuery.inArray( setting, cur, 0 ) < 0 ) {
						matches = false;
					}
				} else {
					cur = aioseop_get_field_value( subopt );
					if ( cur != setting ) {
						matches = false;
					}
				}
			}
		});
		if ( matches ) {
			jQuery('#' + index + '_wrapper' ).show();
		} else {
			jQuery('#' + index + '_wrapper' ).hide();
		}
		return matches;
	}
	return false;
}

function aioseop_add_condshow_handlers( index, value ) {
	if ( typeof value != 'undefined' ) {
		jQuery.each(value, function(subopt, setting) {
			jQuery('[name=' + subopt + ']').bind( "change keyup", function() {
				aioseop_do_condshow_match( index, value );
			});
		});
	}
}

function aioseop_do_condshow( condshow ) {
	if ( typeof aioseop_data.condshow != 'undefined' ) {
		jQuery.each(aioseop_data.condshow, function(index, value) {
			aioseop_do_condshow_match( index, value );
			aioseop_add_condshow_handlers( index, value );
		});
	}	
}

jQuery(document).ready(function(){
if (typeof aioseop_data != 'undefined') {
	if ( typeof aioseop_data.condshow != 'undefined' ) {
		aioseop_do_condshow( aioseop_data.condshow );
	}
}
});

jQuery(document).ready(function() {
	var image_field;
	jQuery('.aioseop_upload_image_button').click(function() {
		window.send_to_editor = aioseopNewSendToEditor;
		image_field = jQuery(this).next();
		formfield = image_field.attr('name');
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		return false;
	});
	aioseopStoreSendToEditor 	= window.send_to_editor;
	aioseopNewSendToEditor		= function(html) {
							imgurl = jQuery('img',html).attr('src');
							if ( typeof(imgurl) !== undefined )
								image_field.val(imgurl);
							tb_remove();
							window.send_to_editor = aioseopStoreSendToEditor;
						};
});

// props to commentluv for this fix
// workaround for bug that causes radio inputs to lose settings when meta box is dragged.
// http://core.trac.wordpress.org/ticket/16972
jQuery(document).ready(function(){
    // listen for drag drop of metaboxes , bind mousedown to .hndle so it only fires when starting to drag
    jQuery('.hndle').mousedown(function(){                                                               
        // set live event listener for mouse up on the content .wrap and wait a tick to give the dragged div time to settle before firing the reclick function
        jQuery('.wrap').mouseup(function(){store_radio(); setTimeout('reclick_radio();',50);});
    })
});
/**
* stores object of all radio buttons that are checked for entire form
*/
if(typeof store_radio != 'function') {
	function store_radio(){
	    var radioshack = {};
	    jQuery('input[type="radio"]').each(function(){
	        if(jQuery(this).is(':checked')){
	            radioshack[jQuery(this).attr('name')] = jQuery(this).val();
	        }
	        jQuery(document).data('radioshack',radioshack);
	    });
	}
}
/**
* detect mouseup and restore all radio buttons that were checked
*/
if(typeof reclick_radio != 'function') {
	function reclick_radio(){
	    // get object of checked radio button names and values
	    var radios = jQuery(document).data('radioshack');
	    //step thru each object element and trigger a click on it's corresponding radio button
	    for(key in radios){
	        jQuery('input[name="'+key+'"]').filter('[value="'+radios[key]+'"]').trigger('click');
	    }
	    // unbind the event listener on .wrap  (prevents clicks on inputs from triggering function)
	    jQuery('.wrap').unbind('mouseup');
	}
}

function aioseop_handle_ajax_call( action, settings, options, success) {
	var aioseop_sack = new sack(ajaxurl);
	aioseop_sack.execute = 1; 
	aioseop_sack.method = 'POST';
	aioseop_sack.setVar( "action", action );
	aioseop_sack.setVar( "settings", settings );
	aioseop_sack.setVar( "options", options );
	if ( typeof success != 'undefined' ) {
		aioseop_sack.onCompletion = success;
	}
	aioseop_sack.setVar( "nonce-aioseop", jQuery('input[name="nonce-aioseop"]').val() );
	
	aioseop_sack.onError = function() {alert('Ajax error on saving.'); };
	aioseop_sack.runAJAX();	
}

function aioseop_handle_post_url( action, settings, options, success) {
	jQuery("div#aiosp_"+settings).fadeOut('fast', function() {
		var loading = '<label class="aioseop_loading aioseop_'+settings+'_loading"></label> Please wait...';
		jQuery("div#aiosp_"+settings).fadeIn('fast', function() {
			aioseop_handle_ajax_call( action, settings, options, success);
		});
		jQuery("div#aiosp_"+settings).html(loading);
	})
};

function aioseop_is_overflowed(element) {
    return element.scrollHeight > element.clientHeight || element.scrollWidth > element.clientWidth;
}

function aioseop_overflow_border( el ) {
	if ( aioseop_is_overflowed(el) ) {
		el.className = 'aioseop_option_div aioseop_overflowed';
	} else {
		el.className = 'aioseop_option_div';
	}
}

jQuery(document).ready(function() {
	if ( typeof aioseop_data.pointers != 'undefined' ) {
		jQuery.each(aioseop_data.pointers, function(index, value) {
			if ( value != 'undefined' && value.pointer_text != '' ) {
				aioseop_show_pointer( index, value );				
			}
		});
	}
	/*
	jQuery("#aiosp_settings_form").delegate("input[name='Submit']", "click", function() {
		aioseop_handle_post_url('aioseop_ajax_save_settings', 'ajax_settings_message', jQuery('form#aiosp_settings_form').serialize() );
		return false;
	});
	*/
	jQuery(".all-in-one-seo_page_all-in-one-seo-pack-aioseop_feature_manager #aiosp_settings_form .aioseop_settings_left").delegate("input[name='Submit']", "click", function(e) {
		e.preventDefault();
		return false;
	});
	jQuery(".all-in-one-seo_page_all-in-one-seo-pack-aioseop_feature_manager #aiosp_settings_form").delegate("input[name='Submit']", "click", function(e) {
		e.preventDefault();
		aioseop_handle_post_url('aioseop_ajax_save_settings', 'ajax_settings_message', jQuery('form#aiosp_settings_form').serialize(),
			function() {
				jQuery('.wp-has-current-submenu').fadeIn('fast', function() {
					aioseop_handle_ajax_call('aioseop_ajax_get_menu_links', 'ajax_settings_message', jQuery.param( {target: '.wp-has-current-submenu > ul'} ) );
				});
			} );
		return false;
	});
	var selectors = "div.aioseop_multicheckbox_type div.aioseop_option_div, #aiosp_sitemap_debug div.aioseop_option_div, #aiosp_performance_status div.aioseop_option_div";
	/*
	jQuery(selectors).each(function() {
		aioseop_overflow_border(this);
	});
	var resizeTimer;
	jQuery(window).resize(function() {
		clearTimeout(resizeTimer);
		resizeTimer = setTimeout(jQuery(selectors).each(function() {
			aioseop_overflow_border(this);
		}), 250);
	});
	*/
	jQuery("div#aiosp_sitemap_addl_pages_metabox").delegate("input[name='Submit']", "click", function() {
		aioseop_handle_post_url('aioseop_ajax_save_url', 'sitemap_addl_pages', jQuery('div#aiosp_sitemap_addl_pages_metabox input, div#aiosp_sitemap_addl_pages_metabox select').serialize() );
		return false;
	});
	jQuery("div#aiosp_sitemap_addl_pages_metabox").delegate("a.aiosp_delete_url", "click", function(e) {
		e.preventDefault();
		aioseop_handle_post_url('aioseop_ajax_delete_url', 'sitemap_addl_pages', jQuery(this).attr("title") );
		return false;
	});
	jQuery("div#aiosp_opengraph_scan_header").delegate("input[name='aiosp_opengraph_scan_header']", "click", function(e) {
		e.preventDefault();
		aioseop_handle_post_url('aioseop_ajax_scan_header', 'opengraph_scan_header', jQuery('div#aiosp_opengraph_scan_header').serialize() );
		return false;
	});

	jQuery('input[name="aiosp_sitemap_posttypes[]"][value="all"]').click(function () {
		jQuery(this).parents('div:eq(0)').find(':checkbox').attr('checked', this.checked);
    });
	jQuery('input[name="aiosp_sitemap_taxonomies[]"][value="all"]').click(function () {
		jQuery(this).parents('div:eq(0)').find(':checkbox').attr('checked', this.checked);
    });
	jQuery('input[name="aiosp_sitemap_posttypes[]"][value!="all"]').click(function () {
		if ( !this.checked )
			jQuery(this).parents('div:eq(0)').find('input[value="all"]:checkbox').attr('checked', this.checked);
    });
	jQuery('input[name="aiosp_sitemap_taxonomies[]"][value!="all"]').click(function () {
		if ( !this.checked )
			jQuery(this).parents('div:eq(0)').find('input[value="all"]:checkbox').attr('checked', this.checked);
    });
	jQuery(".aioseop_tab:not(:first)").hide();
    jQuery(".aioseop_tab:first").show();
    jQuery("a.aioseop_header_tab").click(function(){
            var stringref = jQuery(this).attr("href").split('#')[1];
            jQuery('.aioseop_tab:not(#'+stringref+')').hide('slow');
            jQuery('.aioseop_tab#' + stringref).show('slow');
            jQuery('.aioseop_header_tab[href!=#'+stringref+']').removeClass('active');
            jQuery('.aioseop_header_tab[href=#' + stringref+']').addClass('active');
            return false;
    });    
});
