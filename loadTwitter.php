<?php

header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');


/***
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
***/

include "../config.php";

$dbh = new PDO("mysql:host=$db_host;dbname=$db_name", $username, $password);

/**
 * Returns a collection of the most recent Tweets posted by the user
 * https://dev.twitter.com/docs/api/1.1/get/statuses/user_timeline
 */

$posts = array();
if(isset($_GET['since_id']) && $_GET['since_id']){

$since_id = $_GET['since_id'];
$a = 'SELECT * FROM twitterfeed WHERE ((id > '.$since_id.') AND (hashtags LIKE BINARY "%NP%")) ORDER BY id DESC LIMIT 10';

} else {

$a = 'SELECT * FROM twitterfeed WHERE (hashtags LIKE BINARY "%NP%") ORDER BY id DESC LIMIT 10';

}
$stmt = $dbh->prepare($a);
$stmt->execute();
while($row = $stmt->fetch(PDO::FETCH_ASSOC))
array_push($posts, array('post_id'=>$row['id'],'text'=>$row['text'], 'hashtags'=>$row['hashtags']));

/***
function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}
***/

if(isset($posts) && !empty($posts)){
$return = array();
foreach($posts as $key=>$val){
/** **/

    $pcode = "";
    $p = explode("|", $val['hashtags']);
    foreach($p as $pval){
        if(strpos($pval, "NP") === 0){
            $pcode = str_replace("NP", "", $pval);
            if (ctype_xdigit($pcode)){
                $pcode = hexdec($pcode);
                $pcode = substr_replace($pcode, "-", 4, 0);

                $a = 'SELECT sku, sku_folder, name FROM products WHERE sku = "'.$pcode.'"';
                $stmt = $dbh->prepare($a);
                $stmt->execute();
                while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                array_push($return, array('post_id'=>$val['post_id'],'text'=>$val['text'],'sku'=>$row['sku'],'sku_folder'=>$row['sku_folder']));
            }
        }
    }

    /***
    $o = $val['text'];
    $fullstring = urldecode($val['text']);
    $parsed = get_string_between($fullstring, '--(', ')');
    $pcode = $parsed;
    ***/

    /***
    $pcode = "";
    $p = explode("|", $val['hashtags']);
    foreach($p as $pval){
        if(strpos($pval, "sku") === 0){
        $pcode = str_replace("sku", "", $pval);
        $pcode = str_replace("_", "-", $pcode);
        }
    }
    ***/

}

if(isset($return) && !empty($return)){

$prodContent    = array();

foreach($return as $val){



        $entry      = $val['sku_folder'];
        $subEntry   = $val['sku'];
        $post_id    = $val['post_id'];
        $text       = urldecode($val['text']);

        $sub = "../products/".$entry."/".$subEntry;
        if($subHandle = opendir($sub))
        {
            $arTHUMB1 = array();
            $arTHUMB2 = array();
            $arTHUMB3 = array();
            $arTHUMB4 = array();

                        $pth = "../products/".$entry."/".$subEntry."/".$subEntry;
                        $thumb_path = "../products/".$entry."/".$subEntry."/".$subEntry."_thumb.jpg";
                        $actflag = "1";
                        $ytID = "";
                        $ytplaylistID = "";
                        $pname = "";
                        $info_path = "../products/".$entry."/".$subEntry."/".$subEntry.".xml";
                        if( file_exists($info_path) )
                        {
                            $xml = simplexml_load_file($info_path);
                            $do_this_item = 1;
                            foreach($xml->children() as $child)
                            {
                                if($child->getName()=="active")
                                {
                                    $actflag = $child;
                                }
                                if($child->getName()=="productName")
                                {
                                    $pname = urldecode($child);
                                }
                                if($child->getName()=="ytID")
                                {
                                    $ytID = $child;
                                }
                                if($child->getName()=="ytplaylistID")
                                {
                                    $ytplaylistID = $child;
                                }
                                if($amode==0 && $child->getName()=="active")
                                {
                                }
                            }
                            if( $actflag=="1" )
                            {
                                $arTHUMB1[] = $pname;
                                $arTHUMB2[] = $subEntry;
                                $arTHUMB3[] = $ytID;
                                $arTHUMB4[] = $ytplaylistID;
                            }
                        }
            closedir($subHandle);

            array_multisort($arTHUMB1,SORT_ASC,SORT_STRING,$arTHUMB2,$arTHUMB3,$arTHUMB4);
            $k=0;
            foreach ($arTHUMB1 as &$vvv) 
            {
                $pname			= $vvv;
                $subEntry		= $arTHUMB2[$k];
                $ytID			= $arTHUMB3[$k];
                $ytplaylistID	= $arTHUMB4[$k];
                $pth = "../products/".$entry."/".$subEntry."/".$subEntry;
                $thumb_path = "../products/".$entry."/".$subEntry."/".$subEntry."_thumb.jpg";
                if($firstPTH=="")
                {
                    $firstPTH = $pth;
                    $firstCODE = $subEntry;
                    $firstYID = $ytID;
                    $firstYPLAYLISTID = $ytplaylistID;
                }
                $prodContent[] = array('pcode' => $subEntry, 'post_id' => $post_id, 'text' => $text, 'vendor' => $entry, 'name' => $pname, 'pth' => $pth, 'ytID' => $ytID, 'ytplaylistID' => $ytplaylistID);
                $k++;
            }

        }



}

}

}

$dbh = null;

$output = array("prodContent" => $prodContent);
echo json_encode($output);