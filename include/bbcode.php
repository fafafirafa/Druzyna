<?php

function bbcode($zrodlo){
$zrodlo=preg_replace("#\[url\](.*?)?(.*?)\[/url\]#si", "<A HREF=\"//\\1\\2\" TARGET=\"_blank\">\\1\\2</A>", $zrodlo);
$zrodlo=preg_replace("#\[b\](.*?)\[/b\]#si", "<b>\\1</b>", $zrodlo);
$zrodlo=preg_replace("#\[i\](.*?)\[/i\]#si", "<i>\\1</i>", $zrodlo);
$zrodlo=preg_replace("#\[u\](.*?)\[/u\]#si", "<u>\\1</u>", $zrodlo);
$zrodlo=preg_replace("#\[small\](.*?)\[/small\]#si", "<small>\\1</small>", $zrodlo);
$zrodlo=preg_replace("#\[big\](.*?)\[/big\]#si", "<big>\\1</big>", $zrodlo);
$zrodlo=preg_replace("#\[p\](.*?)\[\/p\]#si", "<p>\\1</p>", $zrodlo);
$zrodlo=preg_replace("#\[center\](.*?)\[\/center\]#si", "<center>\\1</center>", $zrodlo);
$zrodlo=preg_replace("#\[color=(http://)?(.*?)\](.*?)\[/color\]#si", "<span style=\"color:\\2\">\\3</span>", $zrodlo);
$zrodlo=preg_replace("#\[size=(http://)?(.*?)\](.*?)\[/size\]#si", "<span style=\"font-size:\\2\">\\3</span>", $zrodlo);
$zrodlo=preg_replace("#\[img\](.*?)\[/img\]#si", "<img src=\"\\1\" border=\"0\" alt=\"Obrazek\" />", $zrodlo);
$zrodlo=nl2br($zrodlo);
return $zrodlo;
}

 ?>