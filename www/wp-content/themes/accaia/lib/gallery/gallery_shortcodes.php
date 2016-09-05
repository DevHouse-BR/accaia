<?php
/*
* @KingSize 2012 V4
** Add Gallery ShortCodes **
*/
######################   Gallery ShortCodes ######################  
// [img_gallery id="1" type="colorbox" layout="grid" orderby="random/custom_id/asc_order" order="ASC/DESC"  description="Some text here..." placement="above"]
function gallery_shortcodes( $atts, $content = null ) {
   
    global $data;
	extract(shortcode_atts(array(
		'id' => false,
        'type'	  => false,
		'layout'  => false,
		'orderby'	  => false,
		'order'	  => false,
		'description' => false,
		'placement'	=> false
    ), $atts));
	
	// variable setup	
	$post_id = ($id) ? $id  : '';
	$gallery_type = ($type) ? $type  : 'prettyphoto';
	$layout = ($layout) ? $layout  : 2;
	$order = ($order) ? $order  : 'DESC';
	$orderby = ($orderby) ? $orderby  : 'date';
	$description = ($description) ? $description  : '';
	$placement = ($placement) ? $placement  : 'above';

	//order by
	if($orderby == 'random')
		$orderby = 'rand';
	elseif($orderby == 'custom_id')
		$orderby = 'menu_order';
	elseif($orderby == 'asc_order')
		$orderby = 'date';
	else
		$orderby = 'date';
	
	//if no post id defined return blank
	if($post_id == '')
		return false;
	
	if($layout == "grid")
		$no_of_page_columns = "grid";
	elseif($layout == "2")
		$no_of_page_columns = "2columns";
	elseif($layout == "3")
		$no_of_page_columns = "3columns";
	elseif($layout == "4")
		$no_of_page_columns = "4columns";


	// Add Gallery type JS and CSS
	global $tpl_body_id;
	$tpl_body_id = $gallery_type;
	
	
	// Apply Gallery Type
	if($gallery_type=="colorbox")
		$relative_gal = 'gallery';
	elseif($gallery_type=="prettyphoto")
		$relative_gal = 'prettyPhoto[gallery]';
	elseif($gallery_type=="fancybox")
		$relative_gal = 'gallery';


//<!-- Gallery start here -->
##### Enable/Disabled Gallery Title #####
	$showTitle =  false;
if($gallery_type == "colorbox" && $data["wm_gallery_titles_colorbox"] == "Enable Colorbox Titles")
	$showTitle =  true;	
elseif($gallery_type == "fancybox" && $data["wm_gallery_titles_fancybox"] == "Enable Fancybox Titles")
	$showTitle =  true;	
elseif($gallery_type == "prettyphoto" && $data["wm_gallery_titles_prettyphoto"] == "Enable PrettyPhoto Titles")
	$showTitle =  true;	
elseif($gallery_type == "galleria" && $data["wm_gallery_titles_galleria"] == "Enable Galleria Titles")
	$showTitle =  true;	
elseif($gallery_type == "slideviewer" && $data["wm_gallery_titles_slideviewer"] == "Enable SlideViewer Titles")
	$showTitle =  true;	
##### END Enable/Disabled Gallery Title #####

#### getting the page Gallery attachments images ####
$args = array('post_type' => 'attachment', 'post_parent' => $post_id,  'orderby' => $orderby, 'order' => $order); 
$attachments = get_children($args); 

ob_start();
$url_post_img = "";		
if($gallery_type == "colorbox" || $gallery_type == "prettyphoto" || $gallery_type == "fancybox") :

  if($description && $placement=="above")
 	echo '<p>'.$description.'</p>';
?>
<div id="gallery_<?php echo $gallery_type;?>" class="gallery">	
   <ul class="gallery_<?php echo $no_of_page_columns;?> gallery_shortcode <?php if($layout == "2") echo ' 2col_shortcode';?>">							
	<?php 
		if ($attachments) { 
			foreach ($attachments as $attachment) { 
				if($no_of_page_columns=="2columns")
					$url_post_img = wm_image_resize('330','220', wp_get_attachment_url($attachment->ID));
				elseif($no_of_page_columns=="3columns")
					$url_post_img = wm_image_resize('220','140', wp_get_attachment_url($attachment->ID));
				elseif($no_of_page_columns=="4columns")
					$url_post_img = wm_image_resize('160','110', wp_get_attachment_url($attachment->ID));
				elseif($no_of_page_columns=="grid")
					$url_post_img = wm_image_resize('112','112', wp_get_attachment_url($attachment->ID));

				$post_title = $attachment->post_title."<p>".strip_tags($attachment->post_content)."</p>";
		?>
			<li><a href="<?php echo wp_get_attachment_url($attachment->ID);?>" class="image" title="<?php if($showTitle == true) { echo $post_title; } ?>" rel="<?php echo $relative_gal;?>"><img  src="<?php echo $url_post_img;?>" alt="<?php if($showTitle == true) { echo $attachment->post_title; } ?>" title="<?php if($showTitle == true) { echo $attachment->post_title; } ?>"/></a></li>									
	<?php
		   }
		}
	?>								
	</ul>	
</div>	
<?php elseif ($gallery_type == "galleria"): ?>
<!-- Galleria - place you images here -->
	<div id="gallery_galleria">    					   					
		<?php 
			//getting the page Gallery attachments images
			if ($attachments) { 
				foreach ($attachments as $attachment) { 										
					$url_post_img = wm_image_resize('680','450', wp_get_attachment_url($attachment->ID));
					$post_title = $attachment->post_title;
					
					if($showTitle == true) {
						echo '<img alt="'.$attachment->post_content.'" title="'.$post_title.'" src="'.$url_post_img.'"/>';
					}
					else{
						echo '<img alt="" title="" src="'.$url_post_img.'"/>';
					}
		
			   }
			}
		?>	
	</div>	
<!-- Galleria ends here -->
<?php elseif ($gallery_type == "slideviewer"): ?>
<!-- slideviewer - place you images here -->
	 <div id="gallery_slideviewer" class="swv">  
		<ul class="gallery_shortcode_slideviewer">
			<?php 
				if ($attachments) { 
					foreach ($attachments as $attachment) { 										
						$url_post_img = wm_image_resize('670','450', wp_get_attachment_url($attachment->ID));
						$post_title = $attachment->post_title;
						
						if($showTitle == true) {
							echo '<li><img alt="'.$post_title.'" title="'.$post_title.'" src="'.$url_post_img.'" /></li>'; 
						}else{
							echo '<li><img alt="" title="" src="'.$url_post_img.'" /></li>'; 
						}

			
				   }
				}
			?>	
			</ul>
		</div>	
<!-- slideviewer ends here -->
<?php
endif;
//<!-- Gallery ends here -->

if($description && $placement=="below")
	echo '<p>'.$description.'</p>';

$output = ob_get_contents();
ob_end_clean();
return $output;
}	

add_shortcode('img_gallery', 'gallery_shortcodes');
###################### End Gallery ShortCodes  #####################  

/*
//Gallery Shortcode is being used 
$pattern = get_shortcode_regex(); 
preg_match('/'.$pattern.'/s', $posts[0]->post_content, $matches); 
if (is_array($matches) && $matches[2] == 'img_gallery') { 
	//your action go here
} */
?>