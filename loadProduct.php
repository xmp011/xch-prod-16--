<?php

header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');


function utf8_urldecode($str) {
    $str = preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\1;",urldecode($str));
    return html_entity_decode($str,null,'UTF-8');
}

$path      = "";
$path      = urldecode(base64_decode($_GET["path"]));

echo "Path: " . $path;

$result     = array();

if(isset($path))
{


$active 			        = "";
$description 		        = "";
$productName 				= "";
$subHeading 			    = "";
$longDescription 	        = "";
$category 			        = "";

$infolink		            = "";
$ytlink			            = "";
$ytID			            = "";
$ytplaylistID	            = "";
$fblink			            = "";

                    $actflag = "1";
                    $info_path = $path;
                    if( file_exists($info_path) )
                    {
                        $xml = simplexml_load_file($info_path);
                        $do_this_item = 1;
                        foreach($xml->children() as $child)
                        {echo $child;
                            if($child->getName()=="active")
                            {
                                $actflag = $child;
                            }
                            if($child->getName()=="description")
                            {
                                $description = urldecode($child);
                            }
                            if($child->getName()=="productName")
                            {
                                $productName = urldecode($child);
                            }
                            if($child->getName()=="subHeading")
                            {
                                $subHeading = urldecode($child);
                            }
                            if($child->getName()=="longDescription")
                            {
                                $longDescription = urldecode($child);
                            }
                            if($child->getName()=="category")
                            {
                                $category = urldecode($child);
                            }
                            if($child->getName()=="infolink")
                            {
                                $infolink = $child;
                            }
                            if($child->getName()=="ytlink")
                            {
                                $ytlink = urldecode($child);
                            }
                            if($child->getName()=="ytID")
                            {
                                $ytID = urldecode($child);
                            }
                            if($child->getName()=="ytplaylistID")
                            {
                                $ytplaylistID = $child;
                            }
                            if($child->getName()=="fblink")
                            {
                                $fblink = urldecode($child);
                            }
                            if($amode==0 && $child->getName()=="active")
                            {
                            }
                        }

                        if( $actflag=="1" )
                        {
                            $result["active"]           = $actflag;
                            $result["description"]      = $description;
                            $result["productName"]      = $productName;
                            $result["subHeading"]       = $subHeading;
                            $result["longDescription"]  = $longDescription;
                            $result["category"]         = $category;
                            $result["infolink"]         = $infolink;
                            $result["ytlink"]           = $ytlink;
                            $result["ytID"]             = $ytID;
                            $result["ytplaylistID"]     = $ytplaylistID;
                            $result["fblink"]           = $fblink;
                        }
                    }

                    $output = array("prodResult" => $result);
                    echo json_encode($output);

}