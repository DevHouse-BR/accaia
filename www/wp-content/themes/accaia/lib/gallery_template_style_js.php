<?php
/**
* @KingSize 2011
* The PHP code for setup Theme Gallery Page support header file.
* Begin creating Gallery Page support header file
* Gallery Page support header file
*/
global $tpl_body_id;

###### getting current template name ######
global $wp_query,$data;
$template_name = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );

if ($tpl_body_id=="colorbox"  || $template_name == "template-colorbox.php") { 
?>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/colorbox.css" type="text/css" media="screen"/>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.colorbox.js"> </script>
<?php
}
elseif ($tpl_body_id=="fancybox"  || $template_name == "template-fancybox.php") { 
?>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/jquery.fancybox-1.3.4.css" type="text/css" media="screen"/>
	 <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.fancybox-1.3.4.pack.js"></script> 
<?php
}
elseif ($tpl_body_id=="prettyphoto"   || $template_name == "template-prettyphoto.php") { 
?>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/prettyPhoto.css" type="text/css" media="screen"/>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.prettyPhoto.js"></script> 
<?php
}
elseif ($tpl_body_id=="blog_overview" ) { 
?>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/prettyPhoto.css" type="text/css" media="screen"/>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.prettyPhoto.js"></script> 

	<script type="text/javascript">  
	 jQuery(document).ready(function($) {
	   $("a[href$='.jpg'], a[href$='.jpeg'], a[href$='.gif'], a[href$='.png']").prettyPhoto({
		animationSpeed: 'normal', /* fast/slow/normal */
		padding: 40, /* padding for each side of the picture */
		opacity: 0.7, /* Value betwee 0 and 1 */
		<?php if($data["wm_prettybox_share_option"] != "Disable PrettyPhoto Share") { echo ''; } else { echo 'social_tools: false,'; }?>	
		showTitle: true /* true/false */
		});
	})
	</script>
<?php
}
elseif ($tpl_body_id=="galleria"   || $template_name == "template-galleria.php") { 
?>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/galleria/galleria.js"></script> 

	<!-- // If an image is inserted into Gallery Page Template (PrettyPhoto) it breaks the page functionality -->
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/prettyPhoto.css" type="text/css" media="screen"/>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.prettyPhoto.js"></script> 
<?php
}
elseif ($tpl_body_id=="slideviewer"   || $template_name == "template-slideviewer.php") { 
?>
 <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.slideviewer.1.2.js"></script> 
 <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.easing.1.3.js"></script>	
 
 <script type="text/javascript">		
	$(window).bind("load", function(){ 
		$("#gallery_slideviewer").css('display', 'none');
		$("#gallery_slideviewer").fadeIn('fast');
		$("#gallery_slideviewer").slideView();
	});
 </script>

 <!-- // If an image is inserted into Gallery Page Template (PrettyPhoto) it breaks the page functionality -->
 <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/prettyPhoto.css" type="text/css" media="screen"/>
 <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.prettyPhoto.js"></script> 
 
<?php
}	
?>