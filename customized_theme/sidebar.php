<?php

if(is_single()){
	dynamic_sidebar( 'sidebar2' ); 
}else{
	dynamic_sidebar( 'sidebar1' ); 
}

