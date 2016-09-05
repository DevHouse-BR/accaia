<?php
// Original code courtesy of Unisphere Design - http://themeforest.net/user/unisphere            
function update_notifier_menu() {  
	$xml = get_latest_theme_version(21600); // This tells the function to cache the remote call for 21600 seconds (6 hours)
	$theme_data = get_theme_data(TEMPLATEPATH . '/style.css'); // Get theme data from style.css (current version is what we want)
	
	if(version_compare($theme_data['Version'], $xml->latest) == -1) {
		add_dashboard_page( $theme_data['Name'] . ' Theme Update', $theme_data['Name'] . '<span class="update-plugins count-1"><span class="update-count">Update</span></span>', 'administrator', strtolower($theme_data['Name']) . '-updates', update_notifier);
	}
}   

add_action('admin_menu', 'update_notifier_menu');

function update_notifier() { 
	$xml = get_latest_theme_version(21600); // This tells the function to cache the remote call for 21600 seconds (6 hours)
	$theme_data = get_theme_data(TEMPLATEPATH . '/style.css'); // Get theme data from style.css (current version is what we want) get_theme_data	
	?>
	
	<style>
		.update-nag {display: none;}
		#instructions {max-width: 800px;}
	</style>

	<div class="wrap">
	
		<div id="icon-tools" class="icon32"></div>
		<h2><?php echo $theme_data['Name']; ?> Theme Updates</h2>
	    <div id="message" class="updated below-h2"><p><strong>There is a new version of the <?php echo $theme_data['Name']; ?> theme available.</strong> You have version <?php echo $theme_data['Version']; ?> installed. Please update to version <?php echo $xml->latest; ?>.</p></div>
        
        <img style="float: left; margin: 0 20px 20px 0; border: 1px solid #ddd;" src="<?php echo get_bloginfo( 'template_url' ) . '/screenshot.png'; ?>" />
        
        <div id="instructions" style="max-width: 800px;">
            
            <h3>Update Instructions</h3>
            
            <p>To get the updated version of the theme go to your <a href="http://themeforest.net" target="_blank">ThemeForest</a> downloads page and redownload the theme.</p>
		
			<p>1. Read over the <a href="http://www.kingsizetheme.com/tag/change-log/" target="blank">Change Logs</a>.</p>
		
			<p>2. <strong style="color: red;">BACKUP YOUR WEBSITE</strong>!</p>
			
			<p>3. Go to <a href="http://themeforest.net/" target="blank">Theme Forest</a> and log into your account. Head to the "Downloads" section and locate the "KingSize WordPress" theme. Re-download this to your computer and extract it.</p>
			
			<p>4. Once extracted, inside locate the "<strong>Template Files</strong>" folder. In here you will find the zipped template named "<i>kingsize.zip</i>". Upload to your server where WordPress is installed, into the "<strong>../wp-content/themes</strong>" directory.</p>
			
			<p>5. Now you'll need to go to your hosting environments Control Panel > File Manager and extract the zipped folder you've uploaded (your hosting provider should offer a method to extract compressed folders with the file manager). Alternatively, you may also upload this already unzipped but the upload time will vary and will likely result in a longer upload process.</p>
			
			<p>6. Now decompress / extract the zipped files to overwrite the original "kingsize" theme folder.</p>
			
			<p>7. <strong style="color: red;">IMPORTANT</strong>: Head to your WordPress installation dashboard and go to "<strong>Appearance > Themes</strong>". Make sure it's stating the latest version is <strong><?php echo $xml->latest; ?></strong>. Now in order to apply the new features and updates, <strong>DE-ACTIVATE</strong> the template by enabling another and then <strong>RE-ACTIVATE</strong> the template again. This should be done after all updates to ensure those features are carried over properly.</p>
			
			<p>8. Go to "<strong>Appearance > KingSize Options</strong>" and be sure to "<strong>SAVE ALL CHANGES</strong>". This ensures the new options/features are set.</p>
			
			<p>For further information we always recommend you read the Template Documentation. This can be found inside the folder you downloaded and extracted from Theme Forest. Locate the folder named "<strong>Documentation</strong>" and inside it the "<i>Help.html</i>" file. For tutorials and demonstrations, please checkout the website: <a href="http://www.kingsizetheme.com" target="blank">http://www.kingsizetheme.com</a></p>
			
			<p>For buyer / customer Support Forums, please visit: <a href="http://www.denoizzed.com/forum" target="blank">http://www.denoizzed.com/forum</a> and if you're having difficulties joining the Support Forums, please <a href="http://denoizzed.com/how-to-register/" target="blank">read and/or watch the help documentation/video</a>. We're here to help, so do not hesitate to contact us!</p>
			
			<p>In your humble service,<br />
			Nick Shylo / <a href="http://www.denoizzed.com" target="blank">Denoizzed</a>, <i>HTML / Design Author</i><br />
			Bryce Wisekal &amp; Kumar Sekhar / <a href="http://www.ourwebmedia.com" target="blank">OurWebMedia</a>, <i>WordPress Developers</i></p>
			
			<p></p>

			<p><?php echo $xml->info; ?></p>
			
        </div>
        
        <div class="clear"></div>

	</div>
    
<?php } 

// This function retrieves a remote xml file on my server to see if there's a new update 
// For performance reasons this function caches the xml content in the database for XX seconds ($interval variable)
function get_latest_theme_version($interval) {
	// remote xml file location
	$notifier_file_url = 'http://www.kingsizetheme.com/notification/notifier.xml';
	
	$db_cache_field = 'kingsize-notifier-cache';
	$db_cache_field_last_updated = 'kingsize-notifier-last-updated';
	$last = get_option( $db_cache_field_last_updated );
	$now = time();
	// check the cache
	if ( !$last || (( $now - $last ) > $interval) ) {
		// cache doesn't exist, or is old, so refresh it
		if( function_exists('curl_init') ) { // if cURL is available, use it...
			$ch = curl_init($notifier_file_url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			$cache = curl_exec($ch);
			curl_close($ch);
		} else {
			$cache = @file_get_contents($notifier_file_url); // ...if not, use the common file_get_contents()
		}
		
		if ($cache) {			
			// we got good results
			update_option( $db_cache_field, $cache );
			update_option( $db_cache_field_last_updated, time() );			
		}
		// read from the cache file
		$notifier_data = get_option( $db_cache_field );
	}
	else {
		// cache file is fresh enough, so read from it
		$notifier_data = get_option( $db_cache_field );
	}
	
	if ( function_exists('simplexml_load_string') ) {	
		return simplexml_load_string($notifier_data); 	
	}
	
}

?>