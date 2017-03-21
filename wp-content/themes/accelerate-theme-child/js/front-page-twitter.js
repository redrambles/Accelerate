/* INACTIVE - keeping this here for reference - used different approach - hooking into title filter
* in inc/extras.php
*
* The below JS code worked but was unnecessary 
*/

// Grab title of the Widget
var title = document.querySelectorAll('.widget-title')[0];

// Grab node with the dynamcially created text
var twitterHandle = document.querySelectorAll('.twitterhandle')[0];

// append our twitter handle to the title
title.appendChild( twitterHandle );

// Grab classes from the twitter name div
var twitterHandleClass = twitterHandle.classList;

// Add our reveal class so that we can show it
twitterHandleClass.add('reveal');