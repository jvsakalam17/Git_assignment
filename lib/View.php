<?php
class View {
	public function render( $file_name, $no_include = false ){		
		if( $no_include==true ){ //if template design should NOT be included
			require( MODULES . $file_name . '.php' );
		} else { //if template design should be included
			require( TEMPLATE . 'header.php' );
			
			require( MODULES . $file_name . '.php' );
			require( TEMPLATE . 'footer.php' );
		}
	}
}
