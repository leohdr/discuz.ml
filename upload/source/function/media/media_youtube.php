<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$checkurl = array('www.youtube.com/watch?');

function media_youtube($url, $width, $height) { 
	if(preg_match("/^https?:\/\/www.youtube.com\/watch\?v=([^\/&]+)&?/i", $url, $matches)) {
		$flv = 'https://www.youtube.com/v/'.$matches[1].'&fs=1';
		$iframe = 'https://www.youtube.com/embed/'.$matches[1];
		if(!$width && !$height) {
			$str = file_get_contents($url, false, $ctx);
			if(!empty($str) && preg_match("/'VIDEO_HQ_THUMB':\s'(.+?)'/i", $str, $image)) {
				$url = substr($image[1], 0, strrpos($image[1], '/')+1);
				$filename = substr($image[1], strrpos($image[1], '/')+3);
				$imgurl = $url.$filename;
			}
		}
	}
	return array($flv, $iframe, $url, $imgurl);
}