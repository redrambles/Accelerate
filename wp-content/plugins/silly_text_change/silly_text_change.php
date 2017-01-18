<?php
/*
Plugin Name: Silly Text Change
Description: A simple plugin that replaces content with something else - both in the body and the title of posts/pages.
Version: 0.001
Author: Redrambles Coffee Pants
*/

function silly_change_in_text(){
    function  silly_change_content($content){

        $content = str_replace('WordPress', '<a href="http://explosm.net">SILLY</a>', $content);
          return $content;
    }
    add_filter( 'the_content', 'silly_change_content' ); 

    function silly_change_content_title( $title ){

      $title = str_replace('WordPress', '<a href="http://explosm.net">SILLY</a>', $title);
      return $title;
    }
    add_filter( 'the_title', 'silly_change_content_title' ); 
}
// run the function
silly_change_in_text();