<?php

header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');


    #! Active V Inactive
    #! Duplicates - array_unique()

    include "../config.php";

    $dbh = new PDO("mysql:host=$db_host;dbname=$db_name", $username, $password);

    if (isset($_POST['key_words'])){

        $q = implode("+", explode(" ", $_POST['key_words']));
        $return = array();
        $stmt = $dbh->prepare("SELECT sku, sku_folder FROM products WHERE name LIKE ? LIMIT 5");
        $stmt->execute(array("%$q%"));
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($return, array('sku'=>$row['sku'],'sku_folder'=>$row['sku_folder']));
        }
        if(count($return) < 5){
            $residue1 = 5 - count($return);
            $stmt = $dbh->prepare("SELECT sku, sku_folder FROM products WHERE category LIKE ? LIMIT {$residue1}");
            $stmt->execute(array("%$q%"));
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($return, array('sku'=>$row['sku'],'sku_folder'=>$row['sku_folder']));
            }
        }
        if(count($return) < 5){
            $residue2 = 5 - count($return);
            $stmt = $dbh->prepare("SELECT sku, sku_folder FROM products WHERE key_words LIKE ? LIMIT {$residue2}");
            $stmt->execute(array("%$q%"));
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($return, array('sku'=>$row['sku'],'sku_folder'=>$row['sku_folder']));
            }
        }

        if(isset($return) && !empty($return)){

            $entry          = '';
            $subEntry       = '';

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

                                    $pth = "../products/".$entry."/".$subEntry."/".$subEntry;
                                    $thumb_path = "../products/".$entry."/".$subEntry."/".$subEntry."_thumb.jpg";
                                    $actflag = "1";
                                    $pname = "";
                                    $sheading = "";
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
                                            if($child->getName()=="subHeading")
                                            {
                                                $sheading = urldecode($child);
                                            }
                                            if($amode==0 && $child->getName()=="active")
                                            {
                                            }
                                        }
                                        if( $actflag=="1" )
                                        {
                                            $arTHUMB1[] = $pname;
                                            $arTHUMB2[] = $subEntry;
                                            $arTHUMB3[] = $sheading;
                                        }
                                    }
                        closedir($subHandle);

                        array_multisort($arTHUMB1,SORT_ASC,SORT_STRING,$arTHUMB2,$arTHUMB3);
                        $k=0;
                        foreach ($arTHUMB1 as &$vvv) 
                        {
                            $pname			= $vvv;
                            $subEntry		= $arTHUMB2[$k];
                            $sheading		= $arTHUMB3[$k];
                            $pth = "http://xchangemarket.com/products/".$entry."/".$subEntry."/".$subEntry;
                            $thumb_path = "http://xchangemarket.com/products/".$entry."/".$subEntry."/".$subEntry."_thumb.jpg";
                            if($firstPTH=="")
                            {
                                $firstPTH = $pth;
                                $firstCODE = $subEntry;
                                /* $firstSHEADING = $sheading; */
                            }
                            $productOut = array();
                            /** Implement random Vendor selection **/
                            /* if(isset($vend_code) && $vend_code==$entry) : */
                            /* $productOut .= "<div style='display:block;float:left;width:60px;height:86px;margin-left:2px;margin-right:1px;border:1px solid #111;-moz-border-radius:2px;border-radius:2px;cursor:pointer;' data-vendor='$entry' id='$pth' name='$subEntry' title='$pname' onmouseup='thumbUP()' onmousedown=\"thumbDOWN('$pth','$subEntry','$ytID','$ytplaylistID')\" onmouseover='HLicon(this)' onmouseout='CLRicon(this);' >\n"; */
                            /* else : */
                            $productOut['pname'] = $pname;
                            $productOut['sheading'] = $sheading;
                            $productOut['vendor'] = $entry;
                            $productOut['pth'] = $pth;
                            $productOut['sku'] = $subEntry;
                            /* endif; */
                                    if( file_exists($thumb_path) )
                                    {
                                        $productOut['thmb'] = $thumb_path;
                                    }
                                    else
                                    {
                                        $productOut['thmb'] = 'http://xchangemarket.com/missing_thumb.jpg';
                                    }
                            $prodContent[] = $productOut;
                            $k++;
                        }

                    }



            }

        }

    }

    $dbh = null;

    /* $vendThumbs = join("",array_unique($prodContent)); */
    /* sort($vendThumbs); /* Is this ok? */
    /* $output = array("vendThumbs" => $vendThumbs); */
    $output = array("prodContent" => $prodContent);
    echo json_encode($output);

?>