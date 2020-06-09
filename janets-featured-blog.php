<?php

/*
Plugin Name:       janets featured Blog Post 
Plugin URI:        https://devles.com/
Description:       janets wplms theme featured Blog Post show on blog page header
                   section by shorcode
Version:           1.0.0
Requires at least: 5.2
Requires PHP:      7.2
Author:            Rezwan Shiblu
Author URI:        https://devles.com/
Text Domain:       janets
License:           GPL v2 or later
License URI:       http://www.gnu.org/licenses/gpl-2.0.txt

janets featured Blog Post is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
janets featured Blog Post is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with janets featured Blog Post. If not, see http://www.gnu.org/licenses/gpl-2.0.txt.
*/


add_action('wp_enqueue_scripts', 'external_scripts_and_styles' );

function external_scripts_and_styles(){
		wp_enqueue_style('bootcss', PLUGINS_URL('assets/css/bootstrap.min.css', __FILE__));

		wp_enqueue_style('customcss', PLUGINS_URL('assets/css/custom.css', __FILE__));

		wp_enqueue_script('bootjs', PLUGINS_URL('bootstrap.min.js', __FILE__), array('jquery'));
	}

add_filter( 'excerpt_length', function( $length ) { return 25; } );	



add_shortcode( 'rz_featured_blog_post', 'rz_featured_post' );

function rz_featured_post() {	

$featured_query = new WP_Query( array( 
	'post_type'      => 'post',
	'posts_per_page' => '1',
	'category'       => 'featured'
) ); ?>
 

<?php while ($featured_query -> have_posts()) : $featured_query -> the_post(); ?>

<div class="sectionbg">
	<div class="container">
		<div class="row">
			<div class="col-md-7">
				<p class="author-name">by <?php the_author(); ?></p>
				<a href="<?php the_permalink(); ?>"><h4> <?php the_title(); ?> </h4></a>
				<p><?php the_excerpt(20); ?></p>
			</div>
			<div class="col-md-5">
			    <a href="<?php the_permalink(); ?>"><img src="<?php the_post_thumbnail(array(800, 600)); ?>"></a>
			</div>
		</div>		
	</div>
</div>

<?php 
      endwhile;

wp_reset_postdata();

}



