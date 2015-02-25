<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Leniy Radius
 */

if ( ! function_exists( 'leniyradius_paging_nav' ) ) :
function leniyradius_paging_nav() {
	$range = 4;
	global $paged, $wp_query;
//	if ( !$max_page ) {
		$max_page = $wp_query->max_num_pages;
//	}

	// Don't print empty markup if there's only one page.
	if ( $max_page < 2 ) { return; }

	if(!$paged) {
		$paged = 1;
	}

	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'leniyradius' ); ?></h1>
		<div class="nav-links">
		<?php
		if($paged != 1) {
			echo "<a href='" . get_pagenum_link(1) . "' class='extend' title='" . __('Back to home', 'leniyradius' ) . "'> ";
			_e('Back to home', 'leniyradius');
			echo " </a>";
		}
		previous_posts_link( __( 'Newer posts', 'leniyradius' ) );
		if($max_page > $range) {
			if($paged < $range) {
				for($i = 1; $i <= ($range + 1); $i++) {
					echo "<a href='" . get_pagenum_link($i) ."'";
					if($i==$paged) echo " class='current'";
					echo ">$i</a>";
				}
			}
			elseif($paged >= ($max_page - ceil(($range/2)))) {
				for($i = $max_page - $range; $i <= $max_page; $i++) {
					echo "<a href='" . get_pagenum_link($i) ."'";
					if($i==$paged) echo " class='current'";echo ">$i</a>";
				}
			}
			elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))) {
				for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++) {
					echo "<a href='" . get_pagenum_link($i) ."'";
					if($i==$paged) echo " class='current'";echo ">$i</a>";
				}
			}
		}
		else {
			for($i = 1; $i <= $max_page; $i++) {
				echo "<a href='" . get_pagenum_link($i) ."'";
				if($i==$paged) echo " class='current'";
				echo ">$i</a>";
			}
		}
		next_posts_link( __( 'Older posts', 'leniyradius' ) );
		if($paged != $max_page) {
			echo "<a href='" . get_pagenum_link($max_page) . "' class='extend' title='" . __( 'Go to last Page', 'leniyradius' ) . "'> ";
			_e('Go to last Page', 'leniyradius');
			echo " </a>";
		}
		?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'leniyradius_post_nav' ) ) :
function leniyradius_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'leniyradius' ); ?></h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'leniyradius' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link',     'leniyradius' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'leniyradius_comment' ) ) :
function leniyradius_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="comment-body">
			<?php _e( 'Pingback:', 'leniyradius' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'leniyradius' ), '<span class="edit-link">', '</span>' ); ?>
		</div>

	<?php else : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<div class="comment-author-avatar">
				<?php if ( 0 != $args['avatar_size'] ) { echo get_avatar( $comment, $args['avatar_size'] ); } ?>
			</div>
			<div class="comment-content">
				<div class="comment-author vcard">
					<?php printf( __( '%s', 'leniyradius' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				</div><!-- .comment-author -->
				<?php comment_text(); ?>
				<footer class="comment-meta">
					<div class="comment-metadata">
						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
							<time datetime="<?php comment_time( 'c' ); ?>">
								<?php printf( _x( '%1$s %2$s', '1: date, 2: time', 'leniyradius' ), get_comment_date(), get_comment_time() ); 	?>
							</time>
						</a>
						<?php comment_reply_link( array_merge( $args, array(
							'add_below' => 'div-comment',
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
							'before'    => '<div class="reply">',
							'after'     => '</div>',
						) ) ); ?>
						<?php edit_comment_link( __( 'Edit', 'leniyradius' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .comment-metadata -->
					<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'leniyradius' ); ?></p>
					<?php endif; ?>
				</footer><!-- .comment-meta -->
			</div><!-- .comment-content -->
		</article><!-- .comment-body -->

	<?php
	endif;
}
endif; // ends check for leniyradius_comment()

if ( ! function_exists( 'leniyradius_entry_meta' ) ) :
function leniyradius_entry_meta() {
	if ( is_sticky() && is_home() && ! is_paged() )
		echo '<span class="genericon genericon-pinned"></span><span class="featured-post">' . __( 'sticky', 'leniyradius' ) . '</span>';
	if ( 'post' == get_post_type() ) {
		$time_string  = '<span class="genericon genericon-month"></span>';
		$time_string .= '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
		}
		$time_string .= '</span>';
		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date( 'Y-m-d' ) ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date( 'Y-m-d' ) )
		);
		echo $time_string;
	}
	if ( 'post' == get_post_type() ) {
		printf( '<span class="genericon genericon-user"></span><span class="author vcard">%1$s</span>',
			get_the_author()
		);
	}
	$categories_list = get_the_category_list( __( ', ', 'leniyradius' ) );
	if ( $categories_list ) {
		echo '<span class="genericon genericon-category"></span><span class="categories-links">' . $categories_list . '</span>';
	}
	$tag_list = get_the_tag_list( '', __( ', ', 'leniyradius' ) );
	if ( $tag_list ) {
		echo '<span class="genericon genericon-tag"></span><span class="tags-links">' . $tag_list . '</span>';
	}
	if ( comments_open() ) {
		echo '<span class="genericon genericon-comment"></span><span class="comments-link">';
		comments_popup_link( '0' . __( 'comment', 'leniyradius' ), '1' . __( 'comment', 'leniyradius' ),'%' . __( 'comments', 'leniyradius' ) );
		echo '</span>';
	}
	$post_views_value = get_post_meta(get_the_ID(),"views",true);
	if( ! empty( $post_views_value ) ) {
		echo '<span class="genericon genericon-show"></span><span class="post-views">';
		echo $post_views_value . __( 'views', 'leniyradius' );
		echo '</span>';
	}
	edit_post_link( __( 'Edit', 'leniyradius' ), '<span class="genericon genericon-edit"></span><span class="edit-link">', '</span>' );
}
endif;

if ( ! function_exists('leniyradius_breadcrumbs') ) :
function leniyradius_breadcrumbs() {
	$delimiter = '&raquo;';
	$before = '<span class="current">';
	$after = '</span>';
	if ( !is_home() && !is_front_page() || is_paged() ) {
		echo '<div itemscope itemtype="http://schema.org/WebPage" id="breadcrumbs">';
		global $post;
		$homeLink = home_url();
		echo ' <a itemprop="breadcrumb" href="' . $homeLink . '">' . __( 'Home' , 'leniyradius' ) . '</a> ' . $delimiter . ' ';
		if ( is_category() ) {
			global $wp_query;
			$cat_obj = $wp_query->get_queried_object();
			$thisCat = $cat_obj->term_id;
			$thisCat = get_category($thisCat);
			$parentCat = get_category($thisCat->parent);
			if ($thisCat->parent != 0){
				$cat_code = get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' ');
				echo $cat_code = str_replace ('<a','<a itemprop="breadcrumb"', $cat_code );
			}
			echo $before . '' . single_cat_title('', false) . '' . $after;
		} elseif ( is_day() ) {
			echo '<a itemprop="breadcrumb" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo '<a itemprop="breadcrumb"  href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time('d') . $after;
		} elseif ( is_month() ) {
			echo '<a itemprop="breadcrumb" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time('F') . $after;
		} elseif ( is_year() ) {
			echo $before . get_the_time('Y') . $after;
		} elseif ( is_single() && !is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				echo '<a itemprop="breadcrumb" href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
				echo $before . get_the_title() . $after;
			} else {
				$cat = get_the_category(); $cat = $cat[0];
				$cat_code = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
				echo $cat_code = str_replace ('<a','<a itemprop="breadcrumb"', $cat_code );
				echo $before . get_the_title() . $after;
			}
		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' ) {
			$post_type = get_post_type_object(get_post_type());
			echo $before . $post_type->labels->singular_name . $after;
		} elseif ( is_attachment() ) {
			$parent = get_post($post->post_parent);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			echo '<a itemprop="breadcrumb" href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
			echo $before . get_the_title() . $after;
		} elseif ( is_page() && !$post->post_parent ) {
			echo $before . get_the_title() . $after;
		} elseif ( is_page() && $post->post_parent ) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<a itemprop="breadcrumb" href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
			echo $before . get_the_title() . $after;
		} elseif ( is_search() ) {
			echo $before ;
			printf( __( 'Search Results for: %s', 'leniyradius' ),  get_search_query() );
			echo  $after;
		} elseif ( is_tag() ) {
			echo $before ;
			printf( __( 'Tag Archives: %s', 'leniyradius' ), single_tag_title( '', false ) );
			echo  $after;
		} elseif ( is_author() ) {
			global $author;
			$userdata = get_userdata($author);
			echo $before ;
			printf( __( 'Author Archives: %s', 'leniyradius' ),  $userdata->display_name );
			echo  $after;
		} elseif ( is_404() ) {
			echo $before;
			_e( 'Not Found', 'leniyradius' );
			echo  $after;
		}
		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() )
				echo sprintf( __( '( Page %s )', 'leniyradius' ), get_query_var('paged') );
		}
		echo '</div>';
	}
}
endif;