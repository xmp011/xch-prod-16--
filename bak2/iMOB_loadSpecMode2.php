<?php

function utf8_urldecode($str) {
    $str = preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\1;",urldecode($str));
    return html_entity_decode($str,null,'UTF-8');
}

$mode           = "";
$mode           = $_GET["mode"];

$vend2show      = "";
$vend2show      = $_GET["vend2show"];

$terms          = "";
$terms          = urldecode(base64_decode($_GET["terms"]));

$category       = "";
$category       = urldecode(base64_decode($_GET["category"]));

$categoryOPT    = "";
$categoryOPT    = urldecode(base64_decode($_GET["categoryOPT"]));


$vend_code = $vend2show;
$entry     = $vend_code;



/* include "../config.php"; */
include "config.php";

$dbh = new PDO("mysql:host=$db_host;dbname=$db_name", $username, $password);

if($mode == "1"){

    if(isset($entry))
    {

        $sub = "../products/".$entry;
        if($subHandle = opendir($sub))
        {
            $arTHUMB1 = array();
            $arTHUMB2 = array();
            $arTHUMB3 = array();
            $arTHUMB4 = array();

            while (false !== ($subEntry = readdir($subHandle))) 
            {
                if ($subEntry != "." && $subEntry != "..") 
                {
                    if (is_dir($sub."/".$subEntry) === true)
                    {
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

                    }
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
                $productOut = '';
                /** Implement random Vendor selection **/
                if(isset($vend_code) && $vend_code==$entry) :
                /* $productOut .= "<div class='thumb' style='display:block;float:left;width:60px;height:86px;margin-left:2px;margin-right:1px;border:1px solid #111;-moz-border-radius:2px;border-radius:2px;cursor:pointer;' data-vendor='$entry' id='$pth' name='$subEntry' title='$pname' onmouseup='thumbUP()' onmousedown=\"thumbDOWN('$pth','$subEntry','$ytID','$ytplaylistID')\" onmouseover='HLicon(this)' onmouseout='CLRicon(this);' >\n"; */
                $productOut .= "<div class='thumb' onmousedown=\"thumbDOWN('$pth','$subEntry','$ytID','$ytplaylistID')\" onmouseup='thumbUP()' onmouseover='HLicon(this)' onmouseout='CLRicon(this);' name='$subEntry' id='$pth' data-vendor='$entry' title='$pname' style='display:block; float:left;width:60px;height:86px;margin-left:2px;margin-right:1px;border:1px solid white;-moz-border-radius:2px;border-radius:2px;cursor:pointer;' >\n";
                else :
                /* $productOut .= "<div class='thumb' style='display:none;float:left;width:60px;height:86px;margin-left:2px;margin-right:1px;border:1px solid #111;-moz-border-radius:2px;border-radius:2px;cursor:pointer;' data-vendor='$entry' id='$pth' name='$subEntry' title='$pname' onmouseup='thumbUP()' onmousedown=\"thumbDOWN('$pth','$subEntry','$ytID','$ytplaylistID')\" onmouseover='HLicon(this)' onmouseout='CLRicon(this);' >\n"; */
                $productOut .= "<div class='thumb' onmousedown=\"thumbDOWN('$pth','$subEntry','$ytID','$ytplaylistID')\" onmouseup='thumbUP()' onmouseover='HLicon(this)' onmouseout='CLRicon(this);' name='$subEntry' id='$pth' data-vendor='$entry' title='$pname' style='display:none; float:left;width:60px;height:86px;margin-left:2px;margin-right:1px;border:1px solid white;-moz-border-radius:2px;border-radius:2px;cursor:pointer;' >\n";
                endif;
                        if( file_exists($thumb_path) )
                        {
                            $productOut .= "<img src='$thumb_path' style='width:52px;height:52px;margin-top:3px;cursor:pointer;' />\n";
                        }
                        else
                        {
                            /* echo "<img src='missing_thumb.jpg' style='margin-top:4px;height:52px;width:52px;cursor:pointer;' />\n"; */
                            $productOut .= "<img src='../missing_thumb.jpg' style='width:52px;height:52px;margin-top:3px;cursor:pointer;' />\n";
                        }
                        $spn = substr($pname,0,20);
                        $productOut .= "<div style='width:52px;height:26px;margin-top:1px;background-color:white;overflow:hidden;'>$spn</div>\n";
                $productOut .= "</div>";
                /* $vendThumbs[$entry][] = $productOut; */
                /* $vendThumbs[] = $productOut; */
                echo $productOut;
                $k++;
            }

        }
    }

} else if ($mode == "2"){

    $q = implode("+", explode(" ", $terms));
    $return = array();
    $stmt = $dbh->prepare("SELECT sku, sku_folder FROM products WHERE ((sku_folder = '".$vend_code."') AND (key_words LIKE ?))");
    $stmt->execute(array("%$q%"));
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        array_push($return, array('sku'=>$row['sku'],'sku_folder'=>$row['sku_folder']));
    }

    if(isset($return) && !empty($return)){

        $entry          = '';
        $subEntry       = '';

        #! Vendor list
        $vendContent 	= array();
        #! Product list
        $prodContent    = array();
        $vendThumbs 	= '';

        foreach($return as $val){



                $entry      = $val['sku_folder'];
                $subEntry   = $val['sku'];

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
                        $productOut = '';
                        $productOut .= "<div class='thumb' style='display:block;float:left;width:60px;height:86px;margin-left:2px;margin-right:1px;border:1px solid white;-moz-border-radius:2px;border-radius:2px;cursor:pointer;' data-vendor='$entry' id='$pth' name='$subEntry' title='$pname' onmouseup='thumbUP()' onmousedown=\"thumbDOWN('$pth','$subEntry','$ytID','$ytplaylistID')\" onmouseover='HLicon(this)' onmouseout='CLRicon(this);' >\n";
                                if( file_exists($thumb_path) )
                                {
                                    $productOut .= "<img src='$thumb_path' style='margin-top:3px;height:52px;width:52px;cursor:pointer;' />\n";
                                }
                                else
                                {
                                    /* echo "<img src='missing_thumb.jpg' style='margin-top:4px;height:52px;width:52px;cursor:pointer;' />\n"; */
                                    $productOut .= "<img src='../missing_thumb.jpg' style='margin-top:3px;height:52px;width:52px;cursor:pointer;' />\n";
                                }
                                $spn = substr($pname,0,20);
                                $productOut .= "<div style='width:52px;height:26px;margin-top:1px;background-color:white;overflow:hidden;'>$spn</div>\n";
                        $productOut .= "</div>";
                        echo $productOut;
                        $k++;
                    }

                }



        }

    }

} else if ($mode == "3"){

    $q = '';
    $c = '';
    $a = '';
    $p = '';

    $q = implode("+", explode(" ", $terms));
    $c = $category;
    $p = implode("+", explode(" ", $categoryOPT));

    if($c == 'all')
    $a = 'SELECT sku, sku_folder FROM products WHERE ((sku_folder = "'.$vend_code.'") AND ((name LIKE "%'.$q.'%") OR (category LIKE "%'.$q.'%") OR (key_words LIKE "%'.$q.'%")))';
    else if ($c == 'category') /* Category */
    $a = 'SELECT sku, sku_folder FROM products WHERE (((sku_folder = "'.$vend_code.'") AND ('.$c.' LIKE "%'.$p.'%")) AND ((name LIKE "%'.$q.'%") OR (key_words LIKE "%'.$q.'%")))';
    else /* Name and Keywords */
    $a = 'SELECT sku, sku_folder FROM products WHERE ((sku_folder = "'.$vend_code.'") AND ('.$c.' LIKE "%'.$q.'%"))';
    /** **/
    $return = array();
    $stmt = $dbh->prepare($a);
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        array_push($return, array('sku'=>$row['sku'],'sku_folder'=>$row['sku_folder']));
    }

    if(isset($return) && !empty($return)){

        $entry          = '';
        $subEntry       = '';

        foreach($return as $val){



                $entry      = $val['sku_folder'];
                $subEntry   = $val['sku'];

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
                        /** Replaced **/
                        $productOut = '';
                        $productOut .= "<div class='thumb' style='display:block;float:left;width:60px;height:86px;margin-left:2px;margin-right:1px;border:1px solid white;-moz-border-radius:2px;border-radius:2px;cursor:pointer;' data-vendor='$entry' id='$pth' name='$subEntry' title='$pname' onmouseup='thumbUP()' onmousedown=\"thumbDOWN('$pth','$subEntry','$ytID','$ytplaylistID')\" onmouseover='HLicon(this)' onmouseout='CLRicon(this);' >\n";
                                if( file_exists($thumb_path) )
                                {
                                    $productOut .= "<img src='$thumb_path' style='margin-top:3px;height:52px;width:52px;cursor:pointer;' />\n";
                                }
                                else
                                {
                                    /* echo "<img src='missing_thumb.jpg' style='margin-top:4px;height:52px;width:52px;cursor:pointer;' />\n"; */
                                    $productOut .= "<img src='../missing_thumb.jpg' style='margin-top:3px;height:52px;width:52px;cursor:pointer;' />\n";
                                }
                                $spn = substr($pname,0,20);
                                $productOut .= "<div style='width:52px;height:26px;margin-top:1px;background-color:white;overflow:hidden;'>$spn</div>\n";
                        $productOut .= "</div>";
                        echo $productOut;
                        $k++;
                    }

                }



        }

    }

} else {}

?>