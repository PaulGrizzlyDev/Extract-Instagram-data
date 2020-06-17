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
       
        $images = [];
	    for($i = 0; $i<12; $i++) {
                if (isset($latest_images[$i])) {
                    $images['https://www.instagram.com/p/'.$latest_images[$i]['node']['shortcode']] = $latest_images[$i]['node']['thumbnail_resources'][0]['src'];
                }
        }
        return $images;
    } else {
        return 'User not exists';

    }}
   
}
}
$user = new UserInstagram(); 
// change value $username for your instagram user without @
$username = "elrubiuswtf";
echo $user->getDataUserInstagram($username);
$images =  $user->getImageInstagramUser($username);
foreach($images as $image){
    echo "<img src='{$image}'/>"; 
}
?>