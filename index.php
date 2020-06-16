<?php

class UserInstagram{

public function getDataUserInstagram($username){
$response = @file_get_contents( "https://www.instagram.com/$username/?__a=1" );

if ( $response !== false ) {
    $data = json_decode( $response, true );
  //  var_dump($data); 
    if ( $data !== null ) {
        $full_name = $data['graphql']['user']['full_name'];
        $followers  = number_format($data['graphql']['user']['edge_followed_by']['count'],0, '', '.');
        $following  = number_format($data['graphql']['user']['edge_follow']['count'],0, '', '.');
        return "{$full_name} have {$followers} followers and {$following} users following.";
    }

} else {
    return 'User not exists';

}
}
}
$user = new UserInstagram(); 
// change value $username for your instagram user without @
$username = "elrubiuswtf";
echo $user->getDataUserInstagram($username);
?>