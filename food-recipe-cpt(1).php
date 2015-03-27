<?php

/*
Plugin Name: Food Recipe Custom Post Type 
Plugin URI: 
Description:  Features a admin panel for creating custom post types for food recpies WordPress
Author: Andrew, Nicolette, Archie
Version: 1.0.4
Author URI: http://phoenix.sheridanc.on.ca/~ccit2647/
Text Domain: Food-RecipeCPT-plugin
License: GPLv2
*/


// Add Self-Closing Shortcode
// This function returns the short code coder for foodrecipe-cpt by adding the add_shortcode function.
function my_shortcode() {

$options = get_option('foodrecipecptplugin_settings');
return "<p>Recipe Name:" . $options['foodrecipecptplugin_text_field_0'] . "</p>"."<p>Category: " . $options['foodrecipecptplugin_text_field_1']."</p>"."<p>Ingredients: ". $options['foodrecipecptplugin_text_field_2']."</p>"."<p>Recipe Instructions: " . $options['foodrecipecptplugin_text_field_3'] . "</p>";
}
add_shortcode( 'my_shortcode','my_shortcode' );


// This variable function twitter grabs the URL and the Title by calling the Post function. It also has a Tweet variable function that has CSS style embedded to it where Share on Twitter is a link. When user clicks on Share on Twitter link, it returns the Tweet variable function. Finally, this shortcode is now added.
function twitter($atts, $content=null){
$post_url = get_permalink($post->ID);
$post_title = get_the_title($post->ID);
$tweet = '<a style="color:blue; font-size: 20px;" href="http://twitter.com/home/?status=Read' . $post_title . 'at' . $post_url . '">
<b>Share on Twitter </b></a>';
return $tweet;
}
add_shortcode('twitter', 'twitter');


function foodrecipecptplugin_admin_actions() {
	add_menu_page ('FoodRecipeCPT','FoodRecipeCPT','manage_options','food-recipe-cpt','foodrecipecptplugin_admin',66);
	}
	
/* Anything regarding the linkage to the CSS */// This function runs the function foodrecipecptplugin_admin_actions and function foodrecipecptplugin_admin

add_action( "wp_enqueue_scripts", "register_plugin_styles" );

function register_plugin_styles() {
	wp_register_style( "foodrecipecpt", plugins_url("food-recipe-cpt/style.css" ) );
	wp_enqueue_style( "foodrecipecpt" );
}

function foodrecipecptplugin_settings_init( ) {
	register_setting( 'plugin_page', 'foodrecipecptplugin_settings' );
	
	add_settings_section(
		'foodrecipecptplugin_page_section',
		__( 'Add Your Own Recipe Here!', 'ANA'),
		'foodrecipecptplugin_settings_section_callback',
			'plugin_page'
	);
	
	add_settings_field(
		'foodrecipecptplugin_text_field_0',
		__('Enter Recipe Name', 'ANA'),
		'foodrecipecptplugin_text_field_0_render',
		'plugin_page',
		'foodrecipecptplugin_page_section'
	
	);
	
	add_settings_field(
		'foodrecipecptplugin_text_field_1',
		__('Enter Category of Recipe', 'ANA'),
		'foodrecipecptplugin_text_field_1_render',
		'plugin_page',
		'foodrecipecptplugin_page_section'
	
	);
	
	add_settings_field(
		'foodrecipecptplugin_text_field_2',
		__('Enter Ingredients of Recipe', 'ANA'),
		'foodrecipecptplugin_text_field_2_render',
		'plugin_page',
		'foodrecipecptplugin_page_section'
		
	);
	
	add_settings_field(
		'foodrecipecptplugin_text_field_3',
		__('Enter Instructions of Recipe', 'ANA'),
		'foodrecipecptplugin_text_field_3_render',
		'plugin_page',
		'foodrecipecptplugin_page_section'
	
	);

}

function foodrecipecptplugin_text_field_0_render() { 
	$options = get_option( 'foodrecipecptplugin_settings' );
	?>
	<input type="text" name="foodrecipecptplugin_settings[foodrecipecptplugin_text_field_0]" value="<?php if (isset($options['foodrecipecptplugin_text_field_0'])) echo $options['foodrecipecptplugin_text_field_0']; ?>">
	<?php
}

function foodrecipecptplugin_text_field_1_render() { 
	$options = get_option( 'foodrecipecptplugin_settings' );
	?>
	<input type="text" name="foodrecipecptplugin_settings[foodrecipecptplugin_text_field_1]" value="<?php if (isset($options['foodrecipecptplugin_text_field_1'])) echo $options['foodrecipecptplugin_text_field_1']; ?>">
	<?php
}

function foodrecipecptplugin_text_field_2_render() { 
	$options = get_option( 'foodrecipecptplugin_settings' );
	?>
	<textarea cols="40" rows="5" name="foodrecipecptplugin_settings[foodrecipecptplugin_text_field_2]"> 
		<?php if (isset($options['foodrecipecptplugin_text_field_2'])) echo $options['foodrecipecptplugin_text_field_2']; ?>
 	</textarea>
	<?php
}

function foodrecipecptplugin_text_field_3_render() { 
	$options = get_option( 'foodrecipecptplugin_settings' );
	?>
	<textarea cols="40" rows="5" name="foodrecipecptplugin_settings[foodrecipecptplugin_text_field_3]"> 
		<?php if (isset($options['foodrecipecptplugin_text_field_3'])) echo $options['foodrecipecptplugin_text_field_3']; ?>
 	</textarea>
	
	
<?php
}
function foodrecipecptplugin_settings_section_callback() { 
	echo __( 'Fill in name of recipe, category, ingredients and recipes' );
}


function foodrecipecptplugin_admin() { 
	?>
	
		<form action="options.php" method="post">
		
		
	<?php
		
		
		settings_fields( 'plugin_page' );
		do_settings_sections( 'plugin_page' );
		submit_button();
		?>
		
	</form>
	<?php

}

add_action( 'admin_menu', 'foodrecipecptplugin_admin_actions' );
add_action( 'admin_init', 'foodrecipecptplugin_settings_init' );	



function foodrecipecptplugin_callit(){
	$options = get_option( 'foodrecipecptplugin_settings' );

	echo '<p>Recipe Name: ' . $options['foodrecipecptplugin_text_field_0'] . '</p>';
	echo '<p>Category: ' . $options['foodrecipecptplugin_text_field_1'] . '</p>';
	echo '<p>Ingredients: ' . $options['foodrecipecptplugin_text_field_2'] . '</p>';
	echo '<p>Recipe Instructions: ' . $options['foodrecipecptplugin_text_field_3'] . '</p>';
	//echo do_shortcode('[my_shortcode]');
}	

//add_filter('the_content', 'foodrecipecptplugin_callit');	


?>