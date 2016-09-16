<?php

header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');


    include "../config.php";

    $dbh = new PDO("mysql:host=$db_host;dbname=$db_name", $username, $password);

    /*if ((isset($_POST['terms']) && !empty($_POST['terms'])) && (isset($_POST['category']) && !empty($_POST['category']))){ /* Adjust here - lesser importance */

        $q = '';
        $c = '';
        $a = '';
        $p = '';

        $q = implode("+", explode(" ", $_POST['terms']));
        $c = $_POST['category'];
        $p = implode("+", explode(" ", $_POST['categoryOPT']));
        if($c == 'all')
        $a = 'SELECT sku, sku_folder FROM products WHERE ((name LIKE "%'.$q.'%") OR (category LIKE "%'.$q.'%") OR (key_words LIKE "%'.$q.'%"))';
        else if ($c == 'category')
        $a = 'SELECT sku, sku_folder FROM products WHERE (('.$c.' LIKE "%'.$p.'%") AND ((name LIKE "%'.$q.'%") OR (key_words LIKE "%'.$q.'%")))';
        else
        $a = 'SELECT sku, sku_folder FROM products WHERE ('.$c.' LIKE "%'.$q.'%")';
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

            $stack 			= array();
            $ar1 	        = array();
            $ar2 	        = array();

            #! Vendor list
            $vendContent 	= array();
            #! Product list
            $prodContent    = array();
            $vendThumbs 	= '';

            foreach($return as $val){



                    $entry      = $val['sku_folder'];
                    $subEntry   = $val['sku'];

                    #! Vendor integration
                    /* Implement random vendor selection here, glob */
                    /* $path = realpath('products'); */
                    $path = realpath('../products/'.$entry);

                    if($handle = opendir($path))
                    {
                        $info_path = "../products/".$entry."/".$entry.".xml";
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
                                                    $stack[] 	= $entry;
                                                    $ar1[] 		= $child;
                                                    $ar2[] 		= $entry;
                                                }
                                        }
                                    }
                        closedir($handle);
                    }



            }

            array_multisort($ar1,SORT_ASC,SORT_STRING,$ar2);
            $i=0;
            foreach ($ar1 as &$vvv)
            {
                $child = $vvv;
                $entry = $ar2[$i];

                $bgcol 	= "#222";
                $fcol 	= "#ccc";

                $vendOut = '';

                /* $vendOut .= "<div class='vendthumb' onmousedown='mDOWN(this);' onmouseup='mUP(this);' onmouseover='HLvend(this)' onmouseout='' name='$entry' id='$entry' style='float:left;width:auto;margin:0px 4px;border:1px solid #000;font-size:12px;background-color:$bgcol;color:$fcol;padding:10px;cursor:pointer;'>$child</div>\n"; */
                $vendOut .= $entry;
                $vendContent[] = $vendOut;
                /**********/
                $last_VEND_ID = $entry;
                $i++;
            }

        }

    $dbh = null;

    $vendContent    = array_unique($vendContent);
    sort($vendContent);
    /* $vendThumbs     = join("",array_unique($prodContent)); */
    /* sort($vendThumbs); /* Is this ok? */
    /* $output = array("vendContent" => $vendContent, "vendThumbs" => $vendThumbs); */
    $output = array("vendContent" => $vendContent);
    echo json_encode($output);

?>