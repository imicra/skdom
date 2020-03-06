/**
* Customizer controls
*/

jQuery(document).ready(function(){

	'use strict';
        
        /**
	 * CTA Parallax option
	 */
        // CTA Background attachment control
	var parallax_cta = jQuery('#customize-control-skdom_cta_parallax').find('input:checkbox');
	if(parallax_cta.is(':checked')){
		jQuery('#customize-control-skdom_cta_attachment').hide();
//                jQuery('#customize-control-skdom_cta_attachment').find('input:first').prop( "checked", true );
	} else {
		jQuery('#customize-control-skdom_cta_attachment').show();
//                jQuery('#customize-control-skdom_cta_attachment').find('input:first').prop( "checked", true );
	}

	parallax_cta.on('change',function(){
		if(jQuery(this).is(':checked')){
			jQuery('#customize-control-skdom_cta_attachment').fadeOut();
//                        if(jQuery('#customize-control-skdom_cta_attachment').find('input:first').prop( "checked", false )) {
//                            jQuery('#customize-control-skdom_cta_attachment').find('input:first').prop( "checked", true );
//                        }
		} else {
			jQuery('#customize-control-skdom_cta_attachment').fadeIn();
//                        if(jQuery('#customize-control-skdom_cta_attachment').find('input:first').prop( "checked", false )) {
//                            jQuery('#customize-control-skdom_cta_attachment').find('input:first').prop( "checked", true );
//                        }
		}
	});
        
        // CTA Parallax control interaction with Background Image
        var bgimage_cta = jQuery('#customize-control-skdom_cta_bgimage').find('img');
        if(bgimage_cta.length > 0) {
            jQuery('#customize-control-skdom_cta_parallax').show();
        } else {
            jQuery('#customize-control-skdom_cta_parallax').hide();
        }
        
        jQuery('#customize-control-skdom_cta_bgimage').on('click', '.default-button', function() {
                if(parallax_cta.is(':checked')) {
                    jQuery('#customize-control-skdom_cta_parallax').fadeIn();
                } else {
                    jQuery('#customize-control-skdom_cta_parallax').fadeIn();
                    jQuery('#customize-control-skdom_cta_attachment').fadeIn();
                }
                
        });
        
        jQuery('#customize-control-skdom_cta_bgimage').on('click', '.remove-button', function() {
                if(parallax_cta.is(':checked')) {
                    jQuery('#customize-control-skdom_cta_parallax').fadeOut();
                } else {
                    jQuery('#customize-control-skdom_cta_parallax').fadeOut();
                    jQuery('#customize-control-skdom_cta_attachment').fadeOut();
                }
                    
        });
        
        jQuery('#customize-control-skdom_cta_bgimage').on('click', '.upload-button', function() {
                if(parallax_cta.is(':checked')) {
                    jQuery('#customize-control-skdom_cta_parallax').fadeIn();
                } else {
                    jQuery('#customize-control-skdom_cta_parallax').fadeIn();
                    jQuery('#customize-control-skdom_cta_attachment').fadeIn();
                }
        });
        
        /**
	 * Workflow Parallax option
	 */
        // Workflow Background attachment control
	var parallax_wrkf = jQuery('#customize-control-skdom_workflow_parallax').find('input:checkbox');
	if(parallax_wrkf.is(':checked')){
		jQuery('#customize-control-skdom_workflow_attachment').hide();
	} else {
		jQuery('#customize-control-skdom_workflow_attachment').show();
	}

	parallax_wrkf.on('change',function(){
		if(jQuery(this).is(':checked')){
			jQuery('#customize-control-skdom_workflow_attachment').fadeOut();
		} else {
			jQuery('#customize-control-skdom_workflow_attachment').fadeIn();
		}
	});
        
        // Workflow Parallax control interaction with Background Image
        var bgimage_wrkf = jQuery('#customize-control-skdom_workflow_bgimage').find('img');
        if(bgimage_wrkf.length > 0) {
            jQuery('#customize-control-skdom_workflow_parallax').show();
        } else {
            jQuery('#customize-control-skdom_workflow_parallax').hide();
        }
        
        jQuery('#customize-control-skdom_workflow_bgimage').on('click', '.default-button', function() {
                if(parallax_wrkf.is(':checked')) {
                    jQuery('#customize-control-skdom_workflow_parallax').fadeIn();
                } else {
                    jQuery('#customize-control-skdom_workflow_parallax').fadeIn();
                    jQuery('#customize-control-skdom_workflow_attachment').fadeIn();
                }
                
        });
        
        jQuery('#customize-control-skdom_workflow_bgimage').on('click', '.remove-button', function() {
                if(parallax_wrkf.is(':checked')) {
                    jQuery('#customize-control-skdom_workflow_parallax').fadeOut();
                } else {
                    jQuery('#customize-control-skdom_workflow_parallax').fadeOut();
                    jQuery('#customize-control-skdom_workflow_attachment').fadeOut();
                }
                    
        });
        
        jQuery('#customize-control-skdom_workflow_bgimage').on('click', '.upload-button', function() {
                if(parallax_wrkf.is(':checked')) {
                    jQuery('#customize-control-skdom_workflow_parallax').fadeIn();
                } else {
                    jQuery('#customize-control-skdom_workflow_parallax').fadeIn();
                    jQuery('#customize-control-skdom_workflow_attachment').fadeIn();
                }
        });
        
        /**
	 * FAQ Accordion Mode
	 */
        var faq_mod = jQuery('#customize-control-skdom_faq_mode').find('input[value=toggle]:radio');
        if(faq_mod.is(':checked')) {
            jQuery('#customize-control-skdom_faq_active').show();
        } else {
            jQuery('#customize-control-skdom_faq_active').hide();
        }
        
        jQuery('#customize-control-skdom_faq_mode').on('click', 'input', function() {
            if(faq_mod.is(':checked')) {
                jQuery('#customize-control-skdom_faq_active').fadeIn();
            } else {
                jQuery('#customize-control-skdom_faq_active').fadeOut();
            }
        });
});