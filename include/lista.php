<?php
	$API_key    = 'KLUCZ_API';
	$channelId  = 'ID_KANAŁU_UT';
	$maxResults = 5;
	
	
	$video_list = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId='.$channelId.'&maxResults='.$maxResults.'&key='.$API_key.''));
	
	
	foreach($video_list->items as $item)
	{
		
	    //Embed video
		if(isset($item->id->videoId)){
			echo '
			<iframe width="91%" height="27%" src="https://www.youtube.com/embed/'. $item->id->videoId .'" title="'. $item->snippet->title .'"
			frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
			
			';
			
		}
	}
?>