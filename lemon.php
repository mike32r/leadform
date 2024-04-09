<?php
if (empty( $_POST )) die("Bad request");
$urls = [ "https://api.offer.store/wm/push.json?id=1299-3ef497968f669c48a4e9e5be6e5e62ce&offer=426&flow=4511&site=677", "https://offerstore.space/a/hairex/lp/?task=push&id=1299-3ef497968f669c48a4e9e5be6e5e62ce&offer=426&flow=4511&site=677" ];
$data = $_POST;
$data["ip"] = $_SERVER["HTTP_CF_CONNECTING_IP"] ? $_SERVER["HTTP_CF_CONNECTING_IP"] : ( $_SERVER["HTTP_X_FORWARDED_FOR"] ? $_SERVER["HTTP_X_FORWARDED_FOR"] : $_SERVER["REMOTE_ADDR"] );
$data["ua"] = $_SERVER["HTTP_USER_AGENT"];
$data["domain"] = $_SERVER["HTTP_X_FORWARDED_HOST"] ? $_SERVER["HTTP_X_FORWARDED_HOST"] : ( $_SERVER["HTTP_X_HOST"] ? $_SERVER["HTTP_X_HOST"] : ( $_SERVER["HTTP_HOST"] ? $_SERVER["HTTP_HOST"] : $_SERVER["SERVER_NAME"] ) );
if (isset( $data["phonecc"] )) $data["phone"] = $data["phonecc"].$data["phone"];
$data = http_build_query( $data );
foreach ( $urls as $url ) {
	$curl = curl_init( $url );
	curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $curl, CURLOPT_TIMEOUT, 65 );
	curl_setopt( $curl, CURLOPT_POST, 1 );
	curl_setopt( $curl, CURLOPT_POSTFIELDS, $data );
	curl_setopt( $curl, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"] );
	curl_setopt( $curl, CURLOPT_SSL_VERIFYHOST, 0 );
	curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, 0 );
	$result = json_decode( curl_exec( $curl ), true );
	curl_close( $curl );
    
	if ( $result ) break;
}
//if (count( $_GET )) $result = array_merge( $result, $_GET );
header( "Location: success.php?name=".$_POST['name']."&phone=" . $_POST['phone']);
die();
?>

