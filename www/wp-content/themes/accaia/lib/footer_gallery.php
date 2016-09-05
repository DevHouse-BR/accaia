<?php
global $tpl_body_id,$portfolio_page;


### getting current file template name ###
global $wp_query;
$template_name = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );

if ($tpl_body_id=="colorbox"  || $template_name == "template-colorbox.php") { 
?>
<script type="text/javascript">

	jQuery(document).ready(function() { 

		var items = jQuery('div#content a').filter(function() {
			if (jQuery(this).attr('href'))	
				return jQuery(this).attr('href').match(/\.(jpg|png|gif|JPG|GIF|PNG|Jpg|Gif|Png|JPEG|Jpeg)/);
		});


		if (items.length > 1){
			var gallerySwitch="gallery";
		}else{
			var gallerySwitch="";
		}

		items.attr('rel',gallerySwitch);

		//load colorbox
		jQuery('#gallery_colorbox ul li a').colorbox({
			'maxHeight' : '95%',
			'maxWidth' : '95%'
		});    
		// If an image is inserted into Gallery Page Template (PrettyPhoto) it breaks the page functionality
		jQuery("a[rel^='gallery']").colorbox({
			'maxHeight' : '95%',
			'maxWidth' : '95%'
		});

	});
</script>		
<?php
}
elseif ($tpl_body_id=="fancybox"  || $template_name == "template-fancybox.php") { 
?>
<script type="text/javascript">
	
	function formatTitle(title, currentArray, currentIndex, currentOpts) {
	    return '<div id="tip7-title">' + (title && title.length ? '<b>' + title + '</b>' : '' ) + '<span>' + (currentIndex + 1) + ' / ' + currentArray.length + '</span></div>';
	}
	
	jQuery(document).ready(function() { 

			var items = jQuery('div#content a').filter(function() {
				if (jQuery(this).attr('href'))	
					return jQuery(this).attr('href').match(/\.(jpg|png|gif|JPG|GIF|PNG|Jpg|Gif|Png|JPEG|Jpeg)/);
			});

			if (items.length > 1){
				var gallerySwitch="gallery";
			}else{
				var gallerySwitch="";
			}

			items.attr('rel',gallerySwitch);	

			//load fancybox and options
			jQuery("#gallery_fancybox ul li a").fancybox({
				'overlayOpacity': '0.8',
				'overlayColor' 	: 'black',
				'transitionIn'  : 'elastic',
				'transitionOut' : 'fade',
				'titlePosition' : 'inside',
				 'titleFormat'	: formatTitle
			});	
			// If an image is inserted into Gallery Page Template (PrettyPhoto) it breaks the page functionality
			jQuery("a[rel^='gallery']").fancybox({
				'overlayOpacity': '0.8',
				'overlayColor' 	: 'black',
				'transitionIn'  : 'elastic',
				'transitionOut' : 'fade',
				'titlePosition' : 'inside',
				 'titleFormat'	: formatTitle
			});	

	});	
</script>
<?php
}
elseif ($tpl_body_id=="prettyphoto"  || $template_name == "template-prettyphoto.php") { 	
?>
<script type="text/javascript">
	jQuery(document).ready(function() { 

		var items = jQuery('div#content a').filter(function() {
			if (jQuery(this).attr('href'))	
				return jQuery(this).attr('href').match(/\.(jpg|png|gif|JPG|GIF|PNG|Jpg|Gif|Png|JPEG|Jpeg)/);
		});

		if (items.length > 1){
			var gallerySwitch="prettyPhoto[gallery]";
		}else{
			var gallerySwitch="";
		}

		items.attr('rel',gallerySwitch);	

	//load prettyPhoto
	<?php
	if($portfolio_page == 'portfolio') {	
	?>	
	jQuery("a[rel^='prettyPhoto']").prettyPhoto({ <?php if($data["wm_prettybox_share_option"] != "Disable PrettyPhoto Share") { echo ''; } else { echo 'social_tools: false'; }?>});
	<?php } else { ?>
	jQuery(document).ready(function($) {
	 $("a[href$='.jpg'], a[href$='.jpeg'], a[href$='.gif'], a[href$='.png']").prettyPhoto({
		animationSpeed: 'normal', /* fast/slow/normal */
		padding: 40, /* padding for each side of the picture */
		opacity: 0.7, /* Value betwee 0 and 1 */
		<?php if($data["wm_prettybox_share_option"] != "Disable PrettyPhoto Share") { echo ''; } else { echo 'social_tools: false,'; }?>
		<?php if($data["wm_gallery_titles_prettyphoto"] ==  "Enable PrettyPhoto Titles") { echo 'showTitle: true /* true/false */';} else { echo 'showTitle: false';} ?>
		});
	})
	<?php } ?>
  });
</script>
<?php
}
elseif ($tpl_body_id=="galleria"  || $template_name == "template-galleria.php") { 
?>
<script type="text/javascript">
	// Load the classic theme
	Galleria.loadTheme('<?php echo get_template_directory_uri(); ?>/js/galleria/galleria.classic.js');
	// Initialize Galleria
	jQuery('#gallery_galleria').galleria({ transition: 'fade'});
		
	// If an image is inserted into Gallery Page Template (PrettyPhoto) it breaks the page functionality
	jQuery(document).ready(function() { 

		var items = jQuery('div#content a').filter(function() {
			if (jQuery(this).attr('href'))	
				return jQuery(this).attr('href').match(/\.(jpg|png|gif|JPG|GIF|PNG|Jpg|Gif|Png|JPEG|Jpeg)/);
		});

		if (items.length > 1){
			var gallerySwitch="prettyPhoto[gallery]";
		}else{
			var gallerySwitch="";
		}

		items.attr('rel',gallerySwitch);	

		jQuery("a[rel^='prettyPhoto']").prettyPhoto({ <?php if($data["wm_prettybox_share_option"] != "Disable PrettyPhoto Share") { echo ''; } else { echo 'social_tools: false'; }?>});
  });
</script>
<?php
}
elseif ($tpl_body_id=="slideviewer"   || $template_name == "template-slideviewer.php") { 
?> 
<script type="text/javascript">	
jQuery(document).ready(function() { 

	var items = jQuery('div#content a').filter(function() {
		if (jQuery(this).attr('href'))	
			return jQuery(this).attr('href').match(/\.(jpg|png|gif|JPG|GIF|PNG|Jpg|Gif|Png|JPEG|Jpeg)/);
	});

	if (items.length > 1){
		var gallerySwitch="prettyPhoto[gallery]";
	}else{
		var gallerySwitch="";
	}

	items.attr('rel',gallerySwitch);	

    jQuery("a[rel^='prettyPhoto']").prettyPhoto({ <?php if($data["wm_prettybox_share_option"] != "Disable PrettyPhoto Share") { echo ''; } else { echo 'social_tools: false'; }?>});

});
</script>
<?php
}
?> 