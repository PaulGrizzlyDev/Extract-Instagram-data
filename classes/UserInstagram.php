<?php

class UserInstagram{
    // GET Instagram user Data
    public function getDataUserInstagram($username){
    $response = @file_get_contents( "https://www.instagram.com/$username/?__a=1" );

    if ( $response !== false ) {
        $data = json_decode( $response, true );
    // var_dump($data); 
        if ( $data !== null ) {
            $full_name = $data['graphql']['user']['full_name'];
            $followers  = number_format($data['graphql']['user']['edge_followed_by']['count'],0, '', '.');
            $following  = number_format($data['graphql']['user']['edge_follow']['count'],0, '', '.');
        
            
            return "{$full_name} have {$followers} followers and {$following} users following.".$images;
        }

        } else {
            return 'User not exists';

        }
    }
    // Get Instagram user images thumbs
    public function getImageInstagramUser($username){

        $response = @file_get_contents( "https://www.instagram.com/$username/?__a=1" );

    if ( $response !== false ) {
        $data = json_decode( $response, true );
        if ( $data !== null ) {
        $latest_images = $data['graphql']['user']['edge_owner_to_timeline_media']['edges'];
       
        $images = array();
	    for($i = 0; $i<12; $i++) {
                if (isset($latest_images[$i])) {
                  $img  = $latest_images[$i]['node']['thumbnail_resources'][3]['src'];
                  $likes = $latest_images[$i]['node']['edge_media_preview_like']['count'];
                  $comments = $latest_images[$i]['node']['edge_media_to_comment']['count'];
                  $content = $latest_images[$i]['node']['edge_media_to_caption']['edges'][0]['node']['text'];
                  $time = $latest_images[$i]['node']['taken_at_timestamp'];
                  array_push($images , array($img, $likes, $comments, $content, $time));
                 
                }
        }
        return $images;
        } else {
            return 'User not exists';

        }
    }
   
}
}

?>