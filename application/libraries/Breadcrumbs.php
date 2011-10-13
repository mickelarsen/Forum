<?php

class Breadcrumbs{
	
	function __construct(){
		
	}

	
	function generate_breadcrumbs()
	{
		$CI =& get_instance();
		$CI->load->library('uri');
		$CI->load->helper('url');
		$segs = $CI->uri->segment_array();
		$breadcrumbs = "";
		foreach ( $segs as $seg_key => $seg_value )
		{
			$breadcrumbs .= anchor(base_url() . $this->recursive_bc($CI->uri->segment(1), $seg_key, 1), $seg_value) . " -> ";
		}
		echo rtrim($breadcrumbs, " -> ");
		
		
	}
	
	function recursive_bc($previous_uri, $limit, $count)
	{
		$CI =& get_instance();
		$CI->load->library('uri');
		if ( $count != $limit )
		{
			$count++;
			$previous_uri = $this->recursive_bc($previous_uri . "/" . $CI->uri->segment($count), $limit, $count);
		}
		return $previous_uri;
	}
	
}