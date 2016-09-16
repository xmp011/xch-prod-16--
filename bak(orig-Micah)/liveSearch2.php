<?php

    /* include "../config.php"; */
    include "config.php";

    $dbh = new PDO("mysql:host=$db_host;dbname=$db_name", $username, $password);

    if (isset($_POST['key_words'])){

        $q = implode("+", explode(" ", $_POST['key_words']));
        $return = array();
        $stmt = $dbh->prepare("SELECT sku, sku_folder FROM products WHERE key_words LIKE ?");
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

                    /* if(isset($entry)) */
                    /* { */
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
                    $sub = "../products/".$entry."/".$subEntry;
                    if($subHandle = opendir($sub))
                    {
                        $arTHUMB1 = array();
                        $arTHUMB2 = array();
                        $arTHUMB3 = array();
                        $arTHUMB4 = array();
                        /* while (false !== ($subEntry = readdir($subHandle))) */
                        /* { */
                            /* if ($subEntry != "." && $subEntry != "..") */
                            /* { */
                                /* if (is_dir($sub."/".$subEntry) === true) */
                                /* { */
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
                                /* } */
                            /* } */
                        /* } */
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
                            /* if(isset($vend_code) && $vend_code==$entry) : */
                            /* $productOut .= "<div style='display:block;float:left;width:60px;height:86px;margin-left:2px;margin-right:1px;border:1px solid #111;-moz-border-radius:2px;border-radius:2px;cursor:pointer;' data-vendor='$entry' id='$pth' name='$subEntry' title='$pname' onmouseup='thumbUP()' onmousedown=\"thumbDOWN('$pth','$subEntry','$ytID','$ytplaylistID')\" onmouseover='HLicon(this)' onmouseout='CLRicon(this);' >\n"; */
                            /* else : */
                            $productOut .= "<div class='outcome1' style='display:block;	float:left;	width:60px;	height:86px; margin-left:2px;	margin-right:1px;	border:0px solid red;	-moz-border-radius:2px;	border-radius:2px;cursor:pointer;' data-vendor='$entry' id='$pth' name='$subEntry' title='$pname' onmouseup='thumbUP()' onmousedown=\"thumbDOWN('$pth','$subEntry','$ytID','$ytplaylistID')\" onmouseover='HLicon(this)' onmouseout='CLRicon(this);' >\n";
                            /* endif; */
                                    if( file_exists($thumb_path) )
                                    {
                                        $productOut .= "<img src='$thumb_path' style='margin-top:4px; height:52px; width:52px; cursor:pointer;' />\n";
                                    }
                                    else
                                    {
                                        /* echo "<img src='missing_thumb.jpg' style='margin-top:4px;height:52px;width:52px;cursor:pointer;' />\n"; */
                                        $productOut .= "<img src='../missing_thumb.jpg' style='margin-top:4px; height:52px; width:52px; cursor:pointer;' />\n";
                                    }
                                    $spn = substr($pname,0,20);
                                    $productOut .= "<div style='width:52px; height:26px; margin-top:1px; background-color:#ffffff; overflow:hidden;'>$spn</div>\n";
                            $productOut .= "</div>";
                            /* $vendThumbs[$entry][] = $productOut; */
                            $prodContent[] = $productOut;
                            /* $vendThumbs .= $productOut; */
                            $k++;
                        }

                    }

                    #! Vendor integration
                    /* Implement random vendor selection here, glob */
                    /* $path = realpath('products'); */
                    $path = realpath('../products/'.$entry);
                    /* gca for randomizer */
                    $stack 			= array();
                    /* $vendContent 	= array(); */
                    /**
                    $vendThumbs		= array();
                    **/
                    $ar1 	= array();
                    $ar2 	= array();
                    if($handle = opendir($path))
                    {
                        $info_path = "../products/".$entry."/".$entry.".xml";
                        /* while (false !== ($entry = readdir($handle))) */
                        /* { */
                            /* if ($entry != "." && $entry != ".." && $entry != "0000" ) */
                            /* { */
                                /* if (is_dir($path."/".$entry) === true) */
                                /* { */
                                    /* $info_path = "products/".$entry."/".$entry.".xml"; */
                                    /* $info_path = "../products/".$entry."/".$entry.".xml"; */
                                    if( file_exists($info_path) )
                                    {
                                        $xml = simplexml_load_file($info_path);
                                        $do_this_item = 1;
                                        foreach($xml->children() as $child)
                                        {
                                            if($amode==0 && $child->getName()=="active")
                                            {
                                                if($child == "0")
                                                {
                                                    $do_this_item = 0;
                                                }
                                            }
                                            if( $do_this_item )
                                                if($child->getName()=="name")
                                                {
                                                    /* Pointless? */
                                                    /***
                                                    if(isset($vend_code) && $vend_code==$entry)
                                                    {
                                                        $bgcol 			= "#333";
                                                        $fcol 			= "cyan";
                
                                                        $scroll2divID 	= $entry;
                                                    }
                                                    else
                                                    {
                                                        $bgcol 	= "#222";
                                                        $fcol 	= "#ccc";
                                                    }
                                                    ***/
                                                    /* gca for randomizer */
                                                    $stack[] 	= $entry;
                                                    $ar1[] 		= $child;
                                                    $ar2[] 		= $entry;
                                                }
                                        }
                                    }
                                /* }else */
                                /* { */
                                /* } */
                            /* } */
                        /* } */
                        /*** Pick a random vendor ***/
                        /**
                        if(!isset($vend_code)){
                            $stack1 = $stack;
                            shuffle($stack1);
                            $vend_code = $stack1[0];
                        }
                        **/
                        closedir($handle);
                    }
                    array_multisort($ar1,SORT_ASC,SORT_STRING,$ar2);
                    $i=0;
                    foreach ($ar1 as &$vvv)
                    {
                        $child = $vvv;
                        $entry = $ar2[$i];
                        /* if(isset($vend_code) && $vend_code==$entry) */
                        /* { */
                            /* $bgcol 	= "#333"; */
                            /* $fcol 	= "cyan"; */
        
                            /* $scroll2divID = $entry; */		/* Future implementation */
                        /* } */
                        /* else */
                        /* { */
                            $bgcol 	= "#222";
                            $fcol 	= "#ccc";
                        /* } */
                        $vendOut = '';
                        /* echo "<div onmousedown='mDOWN(this);' onmouseup='mUP(this);' onmouseover='HLvend(this)' onmouseout='CLRvend(this)' name='$entry' id='$entry' style='float:left;font-size:12px;border:1px solid #000;width:auto;background-color:$bgcol;color:$fcol;margin:4px;padding:5px;cursor:pointer;'>$child</div>\n"; */
                        /* echo "<div class='vendthumb' onmousedown='mDOWN(this);' onmouseup='mUP(this);' onmouseover='HLvend(this)' onmouseout='CLRvend(this)' name='$entry' id='$entry' style='float:left;font-size:12px;border:1px solid #000;width:auto;background-color:$bgcol;color:$fcol;margin:4px;padding:5px;cursor:pointer;'>$child</div>\n"; */
                        /* $vendOut .= "<div class='vendthumb outcome1' onmousedown='mDOWN(this);' onmouseup='mUP(this);' onmouseover='HLvend(this)' onmouseout='CLRvend(this)' name='$entry' id='$entry' style='float:left;font-size:12px;border:1px solid #000;width:auto;background-color:$bgcol;color:$fcol;margin:4px;padding:5px;cursor:pointer;'>$child</div>\n"; */
                        $vendOut .= $entry;
                        $vendContent[] = $vendOut;
                        /**********/
                        $last_VEND_ID = $entry;
                        $i++;
                    }



            }

        }

    }

    /**
    if (isset($_GET['category'])){

        $q = $_GET['category'];
        $return = array();
        $stmt = $dbh->prepare("SELECT sku, sku_folder FROM products WHERE category LIKE ?");
        $stmt->execute(array("%$q%"));
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($return, array('sku'=>$row['sku'],'sku_folder'=>$row['sku_folder']));
        }

    }
    **/

    $dbh = null;

    $vendContent = array_unique($vendContent);
    sort($vendContent);
    $vendThumbs = join("",array_unique($prodContent));
    /* sort($vendThumbs); /* Is this ok? */
    $output = array("vendContent" => $vendContent, "vendThumbs" => $vendThumbs);
    echo json_encode($output);

    /* var_dump($vendContent); */
    /* var_dump($vendThumbs); */

?>