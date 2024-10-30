<?php
/**
 * @package hello_darkness
 * @version 0.2
 */
/*
Plugin Name: Hello Darkness
Plugin URI: https://wordpress.org/plugins/hello-darkness/
Description: This is a modified Hello Dolly plugin, created for educational purposes. In the future versions of the plugin, more hooks and filters will be added. So, students will be able to uncomment a hook/filter to test it’s behavior.
Author: wpdarkness
Version: 0.2
Author URI: https://wpdarkness.wordpress.com
Text Domain: hello-darkness
*/

class  HelloDarkness {

	/* **
	* Constructor
	** */
	public function __construct() {

		// Plugin Details
        $this->plugin               = new stdClass;
        $this->plugin->name         = 'hello-darkness'; // Plugin Folder
        $this->plugin->displayName  = 'Hello Darkness'; // Plugin Name
        $this->plugin->posttype 	= 'hellodarkness';
        $this->plugin->version      = '1.0.1';
        $this->plugin->folder       = plugin_dir_path( __FILE__ );
        $this->plugin->url          = plugin_dir_url( __FILE__ );


		// The fiter modifies a post content with contentFilter function
		add_filter( 'the_content', array( &$this, 'hello_darkness_contentFilter' ));
		
	}

	function hello_darkness_get_lyric() {
		/** These are the lyrics to Hello Darkness */
		$lyrics = "Hello darkness, my old friend
					I've come to talk with you again
					Because a vision softly creeping
					Left its seeds while I was sleeping
					And the vision that was planted in my brain
					Still remains
					Within the sound of silence";

		// Here we split it into lines
		$lyrics = explode( "\n", $lyrics );

		// And then randomly choose a line
		return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
	}

	// This just echoes the chosen line, we'll position it later
	function hello_darkness() {
		$chosen = $this->hello_darkness_get_lyric();
		return "<p id='darkness'>$chosen</p>";
	}

	// Function adds a random lyrics line to a post content
	function hello_darkness_contentFilter( $content ) {
		return $this->hello_darkness() . $content;
	}

	// Now we set that function up to execute when the admin_notices action is called
	// Uncomment the string below to enable Hello Dolly functionality
	//add_action( 'admin_notices', 'hello_darkness' );



	// We need some CSS to position the paragraph
	function hello_darkness_css() {
		// This makes sure that the positioning is also good for right-to-left languages
		$x = is_rtl() ? 'left' : 'right';

		echo "
		<style type='text/css'>
		#darkness {
			float: $x;
			padding-$x: 15px;
			padding-top: 5px;
			margin: 0;
			font-size: 11px;
		}
		</style>
		";
	}



}

$helloDarkness = new HelloDarkness(); 

?>
