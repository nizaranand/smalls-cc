
var se_timer = null;

function se_set_margin_preview(){
    var tmp;
    var se_btn_margin_left = isNaN(tmp = parseInt(document.getElementById('se_btn_margin_left').value)) ? 0 : tmp;
    var se_btn_margin_right = isNaN(tmp = parseInt(document.getElementById('se_btn_margin_right').value)) ? 0 : tmp;
    var se_arw_margin_top = isNaN(tmp = parseInt(document.getElementById('se_arw_margin_top').value)) ? 0 : tmp;
    var se_arw_margin_right = isNaN(tmp = parseInt(document.getElementById('se_arw_margin_right').value)) ? 0 : tmp;
    var se_arw_margin_bottom = isNaN(tmp = parseInt(document.getElementById('se_arw_margin_bottom').value)) ? 0 : tmp;
    var se_arw_margin_left = isNaN(tmp = parseInt(document.getElementById('se_arw_margin_left').value)) ? 0 : tmp;
    var se_txt_margin_top = isNaN(tmp = parseInt(document.getElementById('se_txt_margin_top').value)) ? 0 : tmp;
    var se_txt_margin_right = isNaN(tmp = parseInt(document.getElementById('se_txt_margin_right').value)) ? 0 : tmp;
    var se_txt_margin_bottom = isNaN(tmp = parseInt(document.getElementById('se_txt_margin_bottom').value)) ? 0 : tmp;
    var se_txt_margin_left = isNaN(tmp = parseInt(document.getElementById('se_txt_margin_left').value)) ? 0 : tmp;
    tmp = '0px ' + se_btn_margin_right + 'px ' + '0px ' + se_btn_margin_left + 'px';
    document.getElementById('se_btn_margin').value = tmp;
    tmp = se_arw_margin_top + 'px ' + se_arw_margin_right + 'px ' + se_arw_margin_bottom + 'px ' + se_arw_margin_left + 'px';
    document.getElementById('se_arw_margin').value = tmp;
    tmp = se_txt_margin_top + 'px ' + se_txt_margin_right + 'px ' + se_txt_margin_bottom + 'px ' + se_txt_margin_left + 'px';
    document.getElementById('se_txt_margin').value = tmp;
    if (jQuery('#live_preview div#social-essentials div.se_button').length){
        jQuery('#live_preview div#social-essentials div.se_button').each(function(index, value){
            jQuery(value).css('margin',jQuery('#se_btn_margin').val());
        });
    }
    if (jQuery('#live_preview div.call_to_action').length)
        jQuery('#live_preview div.call_to_action').css('margin',jQuery('#se_arw_margin').val());
    if (jQuery('#live_preview div.call_to_action .se_text').length)
        jQuery('#live_preview div.call_to_action .se_text').css('margin',jQuery('#se_txt_margin').val()); 
    se_btn_margin_left = null;
    se_btn_margin_right = null;
    se_arw_margin_top = null;
    se_arw_margin_right = null;
    se_arw_margin_bottom = null;
    se_arw_margin_left = null;
    se_txt_margin_top = null;
    se_txt_margin_right = null;
    se_txt_margin_bottom = null;
    se_txt_margin_left = null;
    tmp = null;
    se_timer = null;
}

function se_set_margin(string_id){
    if (se_timer)
        window.clearTimeout(se_timer);
    se_timer = null;    
    var obj = document.getElementById(string_id);
    var tmp = parseInt(obj.value);
    if ( isNaN(tmp) ) tmp = 0;
    tmp += 1;
    obj.value = tmp;
    tmp = null;
    se_timer = window.setTimeout(se_set_margin_preview,500);
}

function se_set_margin_value(obj){
    if (se_timer)
        window.clearTimeout(se_timer);
    se_timer = null; 
    if ( obj.value.length == 0 || obj.value == '-' )
        return;
    var tmp = parseInt(obj.value);
    if ( isNaN(tmp) ) tmp = 0;
    obj.value = tmp;
    se_timer = window.setTimeout(se_set_margin_preview,500);  
    tmp = null;
}

function se_set_margin_blur(obj){
    if ( obj.value.length === 0 ){
        if (se_timer)
            window.clearTimeout(se_timer);
        se_timer = null;
        obj.value = 0;
        se_timer = window.setTimeout(se_set_margin_preview,500);    
    }
}

jQuery(document).ready(function(){

	if (jQuery("#se_show_buttons").length) 
	{
		jQuery("#se_show_buttons").sortable({
			revert: true,		
			refreshPositions:true,
			items: 'tr',
			stop: function(){				
				
				var order = [];
				
				jQuery('#se_show_buttons').find('input').each(function(){
					order.push(jQuery(this).attr('rel'));
				});
				
				jQuery('input[name=se_buttons_order]').val(order.join(','));
				
			}
		});
	}
	
	jQuery('#se_preview').click(function(){
	
		jQuery('#live_preview').html('<div class="se_preloader"></div>');
		
		var data = {
			action: 'se_preview',
			twitter_username: jQuery('input[name=se_settings_twitter_username]').val(),
			fb_app_id: jQuery('input[name=se_settings_fb_app_id]').val(),
			show_twitter: (jQuery('input[name=se_show_twitter]').is(':checked')) ? '1' : '0',
			show_fb_share: (jQuery('input[name=se_show_fb_share]').is(':checked')) ? '1' : '0',
			show_fb_like: (jQuery('input[name=se_show_fb_like]').is(':checked')) ? '1' : '0',
			show_google: (jQuery('input[name=se_show_google]').is(':checked')) ? '1' : '0',
			show_stumbleupon: (jQuery('input[name=se_show_stumbleupon]').is(':checked')) ? '1' : '0',
			show_pinterest: (jQuery('input[name=se_show_pinterest]').is(':checked')) ? '1' : '0',
			icon_size: jQuery('input[name=se_icon_size]:checked').val(),
			icon_aligment: jQuery('input[name=se_icon_aligment]:checked').val(),
			custom_css: jQuery('input[name=se_custom_css]').val(),
			call_to_action: (jQuery('input[name=se_call_to_action]').is(':checked')) ? '1' : '0',
			call_to_action_text: jQuery('input[name=se_call_to_action_text]').val(),
			call_to_action_position: jQuery('input[name=se_call_to_action_position]:checked').val(),
			call_to_action_text_size: jQuery('input[name=se_call_to_action_text_size]:checked').val(),
			text_call_to_action_color: jQuery('input[name=se_text_call_to_action_color]').val(),
			call_to_action_text_style_bold: (jQuery('input[name=se_call_to_action_text_style_bold]').is(':checked')) ? '1' : '0',
			call_to_action_text_style_italic: (jQuery('input[name=se_call_to_action_text_style_italic]').is(':checked')) ? '1' : '0',
			call_to_action_text_style_underline: (jQuery('input[name=se_call_to_action_text_style_underline]').is(':checked')) ? '1' : '0',
			text_call_to_action_arrow: jQuery('input[type=hidden][name=se_text_call_to_action_arrow]').val(),
			display_above_posts: (jQuery('input[name=se_display_above_posts]').is(':checked')) ? '1' : '0',
			display_below_posts: (jQuery('input[name=se_display_below_posts]').is(':checked')) ? '1' : '0',
			display_above_pages: (jQuery('input[name=se_display_above_pages]').is(':checked')) ? '1' : '0',
			display_below_pages: (jQuery('input[name=se_display_below_pages]').is(':checked')) ? '1' : '0',
			display_above_home: (jQuery('input[name=se_display_above_home]').is(':checked')) ? '1' : '0',
			display_below_home: (jQuery('input[name=se_display_below_home]').is(':checked')) ? '1' : '0',
			buttons_order: jQuery('input[name=se_buttons_order]').val()
		};

		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		jQuery.post(ajaxurl, data, function(response) {			
			
			jQuery('.se_preloader').remove();
			jQuery('#live_preview').html(response);
			
			if (window.FB && window.FB.Share)
				FB.Share.renderAll();
            if (window.FB && window.FB.XFBML)
                FB.XFBML.parse();    
			if (window.twttr && window.twttr.widgets)	
				twttr.widgets.load();
			if (window.gapi && window.gapi.plusone)
				gapi.plusone.go('live_preview');	
			if(window.STMBLPN)
				STMBLPN.processWidgets();
                
            se_set_margin_preview();    
			
		});
	});
	
	jQuery('.se_filter').click(function(){
		jQuery('.se_filter').removeClass('se_selected');
		jQuery(this).addClass('se_selected');
		
		var data = {
			action: 'se_stats',
			type: (jQuery(this).attr('id') == 'posts_stats') ? 'post' : 'page'
		};
		
		jQuery('#se_stats_table').html('<div class="se_preloader"></div>');
		
		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		jQuery.post(ajaxurl, data, function(response) {			
			
			jQuery('#se_stats_table').html(response);
			
		});
	});
	
	jQuery('.se_top_filter').click(function(){
		jQuery('.se_top_filter').removeClass('se_selected');
		jQuery(this).addClass('se_selected');
		
		var data = {
			action: 'se_stats_top',
			type: (jQuery(this).attr('id') == 'posts_top_stats') ? 'post' : 'page'
		};
		
		jQuery('#se_stats_top').html('<div class="se_preloader"></div>');
		
		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		jQuery.post(ajaxurl, data, function(response) {			
			
			jQuery('#se_stats_top').html(response);
			
		});
	});
	
	jQuery('.se_last_top_filter').click(function(){
		jQuery('.se_last_top_filter').removeClass('se_selected');
		jQuery(this).addClass('se_selected');
		
		var data = {
			action: 'se_stats_last_top',
			type: (jQuery(this).attr('id') == 'posts_last_top_stats') ? 'post' : 'page'
		};
		
		jQuery('#se_stats_last_top').html('<div class="se_preloader"></div>');
		
		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		jQuery.post(ajaxurl, data, function(response) {			
			
			jQuery('#se_stats_last_top').html(response);
			
		});
	});
		
    if (jQuery('#ilctabscolorpicker').length) jQuery('#ilctabscolorpicker').farbtastic("#se_text_call_to_action_color");
    jQuery("#se_text_call_to_action_color").click(function(){
		jQuery('#ilctabscolorpicker,#label_for_down_picker').slideToggle();
	});
	
	jQuery("#se_call_to_action_more_arrows").click(function(){
		jQuery('#se_call_to_action_block_arrows').slideToggle();
	});
	
	jQuery(".se_call_to_action_image_arrow img").click(function(){
		if (jQuery('#se_call_to_action_block_current_arrow').length) {
			if (jQuery('#se_call_to_action_block_current_arrow img#se_call_action_to_current_arrow').length)
				jQuery('#se_call_to_action_block_current_arrow img#se_call_action_to_current_arrow').attr('src',jQuery(this).attr('src'));
			else
				jQuery('#se_call_to_action_block_current_arrow').html('<img id="se_call_action_to_current_arrow" src="' + jQuery(this).attr('src') + '" />');
			jQuery('#se_call_action_to_arrow').val(jQuery(this).attr('src'));			
		}
	});
    
    jQuery('#se_reset_margin').click(function(){
        var tmp;
        jQuery('#se_control div.se_control_margins input[type=text]').each(function(indx,value){
            tmp = jQuery('#'+jQuery(value).attr('id')+'_default');
            if (tmp.length)
                jQuery(value).val(tmp.val());
            tmp = null;    
        });
        se_set_margin_preview();
    });
  	
});