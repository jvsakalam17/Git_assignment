<?php
/*
*********************************************
*                                           *
*                                           *
*                                           *
*                                           *
*                                           *
*                                           *
*                                           *
*                                           *
*                                           *
*********************************************
*/

class HTML{
	function __construct(){
		
	}

	public static function load_js_scripts(){
		$js_handle  = opendir(JS_DIR);
		$js_script  = '';
		
		$scan_dir = scandir(JS_DIR);
		foreach($scan_dir as $js_filename) {
			if( strpos($js_filename, "jscript_")!==false ){
			$js_filename_array[] = $js_filename;
			}
		}
		
		$count_js = 0;
		while( false!==( $js_file=readdir($js_handle) ) ){
			if( strpos($js_file, "jscript_")!==false ){
				/* $js_script .= '<script language="javascript" src="'. URL . JS_DIR . $js_file .'"></script>' . "\n"; */ // Original script
				 $js_script .= '	<script src="'. URL . JS_DIR . $js_filename_array[$count_js++] .'"></script>' . "\n";
			}		
		}
		closedir( $js_handle );
		return $js_script;
	}
	
	public static function load_css_scripts(){
		$css_handle = opendir(CSS_DIR);
		$css_script = '';
		
		while( false!==( $css_file=readdir($css_handle) ) ){
			if(strpos($css_file, "stylesheet_")!==false){
				$css_script .= '	<link rel="stylesheet" href="'.  URL . CSS_DIR . $css_file .'" />' . "\n";
			}		
		}
		closedir( $css_handle );
		return $css_script;
	}
}