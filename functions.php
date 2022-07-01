<?php
// Function to create read more link of a content with link to full page
function readMore($content,$link,$var,$id, $limit) {
	$content = substr($content,0,$limit);
	$content = substr($content,0,strrpos($content,' '));
	$content = $content." <a href='$link?$var=$id'>Read More...</a>";
	return $content;
}
?>