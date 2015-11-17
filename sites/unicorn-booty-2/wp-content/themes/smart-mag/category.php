<?php

/**
 * Category Template
 * 
 * Sets up the correct loop format to use. Additionally, meta is processed for other
 * layout preferences.
 */

global $bunyad_loop_template;

$category = get_category(get_query_var('cat'), false);
$cat_meta = Bunyad::options()->get('cat_meta_' . $category->term_id);

// save current options so that can they can be restored later
$options = Bunyad::options()->get_all();

if (!$cat_meta OR !$cat_meta['template']) {
	$cat_meta['template'] = Bunyad::options()->default_cat_template;
}

// grid template? defaults to loop if not specified
if (in_array($cat_meta['template'], array('alt', 'classic'))) {
	$bunyad_loop_template = 'loop-' . $cat_meta['template'];
}
// timeline template
else if ($cat_meta['template'] == 'timeline') {
	
	$bunyad_loop_template = 'loop-timeline';
	
	$category = get_category(get_query_var('cat'), false);
	$cat_meta = Bunyad::options()->get('cat_meta_' . $category->term_id);
	
	if (!$cat_meta['per_page']) {
		query_posts(array('cat' => $category->term_id, 'posts_per_page' => -1));
	}
	
}
// default modern template
else {
	$bunyad_loop_template = 'loop';
}

// have a sidebar preference?
if (!empty($cat_meta['sidebar'])) {
	Bunyad::core()->set_sidebar($cat_meta['sidebar']);
}

// enable infinite scroll?
if (!empty($cat_meta['pagination_type'])) {
	
	// normal is default - empty in options
	Bunyad::options()->set('pagination_type', ($cat_meta['pagination_type'] == 'normal' ? '' : $cat_meta['pagination_type']));
}

get_template_part('archive');

// restore modified options
Bunyad::options()->set_all($options);
