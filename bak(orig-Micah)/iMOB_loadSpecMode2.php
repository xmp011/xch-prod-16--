<?php

function utf8_urldecode($str) {
    $str = preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\1;",urldecode($str));
    return html_entity_decode($str,null,'UTF-8');
}

$vend2show = "";
$vend2show = $_GET["vend2show"];

$vend_code = $vend2show;
$entry     = $vend_code;

#! ---INNER INTEGRATION--- !#
#! Load products(make an include file)

/* $vendThumbs 	= array(); */

/**
$firstPTH 		= "";
$firstCODE 		= "";
**/

/* $thumbCount 	= 0; */

/* if(isset($vend_code)) */
if(isset($entry))
{
    /*
    if( isset($_GET['pcode']) )
    {
        $firstCODE 	= $_GET['pcode'];
        $firstPTH 	= "../products/".$vend_code."/".$firstCODE."/".$firstCODE;
    }
    */

    //===============NOW SHOW ALL PRODUCT FOLDERS============
    /* $sub = "products/".$vend_code; */
    /* $sub = "../products/".$vend_code; */
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
                    /* $pth = "products/".$vend_code."/".$subEntry."/".$subEntry; */
                    /* $pth = "../products/".$vend_code."/".$subEntry."/".$subEntry; */
                    $pth = "../products/".$entry."/".$subEntry."/".$subEntry;
                    /* $thumb_path = "products/".$vend_code."/".$subEntry."/".$subEntry."_thumb.jpg"; */
                    /* $thumb_path = "../products/".$vend_code."/".$subEntry."/".$subEntry."_thumb.jpg"; */
                    $thumb_path = "../products/".$entry."/".$subEntry."/".$subEntry."_thumb.jpg";

                    $actflag = "1";
                    $ytID = "";
                    $ytplaylistID = "";
                    $pname = "";
                    /* $info_path = "products/".$vend_code."/".$subEntry."/".$subEntry.".xml"; */
                    /* $info_path = "../products/".$vend_code."/".$subEntry."/".$subEntry.".xml"; */
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
                    /* $thumbCount++; */
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
            /* $pth = "products/".$vend_code."/".$subEntry."/".$subEntry; */
            /* $pth = "../products/".$vend_code."/".$subEntry."/".$subEntry; */
            $pth = "../products/".$entry."/".$subEntry."/".$subEntry;
            /* $thumb_path = "products/".$vend_code."/".$subEntry."/".$subEntry."_thumb.jpg"; */
            /* $thumb_path = "../products/".$vend_code."/".$subEntry."/".$subEntry."_thumb.jpg"; */
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
            $productOut .= "<div class='thumb' onmousedown=\"thumbDOWN('$pth','$subEntry','$ytID','$ytplaylistID')\" onmouseup='thumbUP()' onmouseover='HLicon(this)' onmouseout='CLRicon(this);' name='$subEntry' id='$pth' data-vendor='$entry' title='$pname' style='display:block; float:left; width:60px; height:86px; margin-left:2px; margin-right:1px; border:1px solid white; -moz-border-radius:2px; border-radius:2px; cursor:pointer;' >\n";
            else :
            /* $productOut .= "<div class='thumb' style='display:none;float:left;width:60px;height:86px;margin-left:2px;margin-right:1px;border:1px solid #111;-moz-border-radius:2px;border-radius:2px;cursor:pointer;' data-vendor='$entry' id='$pth' name='$subEntry' title='$pname' onmouseup='thumbUP()' onmousedown=\"thumbDOWN('$pth','$subEntry','$ytID','$ytplaylistID')\" onmouseover='HLicon(this)' onmouseout='CLRicon(this);' >\n"; */
            $productOut .= "<div class='thumb' onmousedown=\"thumbDOWN('$pth','$subEntry','$ytID','$ytplaylistID')\" onmouseup='thumbUP()' onmouseover='HLicon(this)' onmouseout='CLRicon(this);' name='$subEntry' id='$pth' data-vendor='$entry' title='$pname' style='display:none; float:left; width:60px; height:86px; margin-left:2px; margin-right:1px; border:1px solid white; -moz-border-radius:2px; border-radius:2px; cursor:pointer;' >\n";
            endif;
                    if( file_exists($thumb_path) )
                    {
                        $productOut .= "<img src='$thumb_path' style='width:52px; height:52px; margin-top:3px; cursor:pointer;' />\n";
                    }
                    else
                    {
                        /* echo "<img src='missing_thumb.jpg' style='margin-top:4px;height:52px;width:52px;cursor:pointer;' />\n"; */
                        $productOut .= "<img src='../missing_thumb.jpg' style='width:52px; height:52px; margin-top:3px; cursor:pointer;' />\n";
                    }
                    $spn = substr($pname,0,20);
                    $productOut .= "<div style='width:52px; height:26px; margin-top:1px; background-color:white; overflow:hidden;'>$spn</div>\n";
            $productOut .= "</div>";
            /* $vendThumbs[$entry][] = $productOut; */
            /* $vendThumbs[] = $productOut; */
            echo $productOut;
            $k++;
        }

    }
}
#! ---INNER INTEGRATION __END --- !#