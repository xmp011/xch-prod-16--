
<?php

	function utf8_urldecode($str) {
		$str = preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\1;",urldecode($str));
		return html_entity_decode($str,null,'UTF-8');
	}

        /***
	$resellerID = '';
	$mobileID = '';
	if( isset($_GET["rid"]) )
            $resellerID = $_GET["rid"];
	if( isset($_GET["mid"]) )
            $mobileID = $_GET["mid"];

	if($_GET["file_type"] == "temp"){
            $file_attribute = "TEMP";
	} else {
            $file_attribute = "LIVE";
	}
        ***/

	$vend2show = "";
	$vend2show = $_GET["vend2show"];

	$vend_code = $vend2show;

        /***
	if( $resellerID != '' && $mobileID != '' )
	{
        ***/

		/* echo "<div id='blankLEFT' style='height: 10px; width: 10px; background-color: #000; border: 0px solid #111; float: left;'></div>"; */

		//===============NOW SHOW ALL PRODUCT FOLDERS============
		$sub = "../products/".$vend_code;
		if( file_exists($sub) && $subHandle=opendir($sub) )
		{
			$arTHUMB1   = array();
			$arTHUMB2   = array();
			$arTHUMB3   = array();
			$arTHUMB4   = array();
			$arTHUMB5   = array();
			$arTHUMB6   = array();
			$arTHUMB7   = array();
			$arTHUMB8   = array();
			$arTHUMB9   = array();
			$arTHUMB10  = array();
			$arTHUMB11  = array();
			$arTHUMB12  = array();
			while (false !== ($subEntry = readdir($subHandle))) 
			{
				if ($subEntry != "." && $subEntry != ".." &&  is_dir($sub."/".$subEntry) === true)
				{
					$info_path = "../products/".$vend_code."/".$subEntry."/".$subEntry.".xml";
					if( file_exists($info_path) )
					{
						$xmlthumb = simplexml_load_file($info_path);
						if($xmlthumb->active=="1")
						{
							$arTHUMB1[] = utf8_urldecode($xmlthumb->productName);
							$arTHUMB2[] = $subEntry;
							$arTHUMB3[] = $xmlthumb->longDescription;
							$arTHUMB4[] = $vend_code;
							$arTHUMB5[] = $xmlthumb->subHeading;
							$arTHUMB6[] = $xmlthumb->ytID;
							$arTHUMB7[] = $xmlthumb->msrp;
							$arTHUMB8[] = $xmlthumb->map;
							$arTHUMB9[] = $xmlthumb->description;
							$arTHUMB10[] = $xmlthumb->platform;
							$arTHUMB11[] = $xmlthumb->interfaceType;
							$arTHUMB12[] = $xmlthumb->ytplaylistID;
						}
					}
				}
			}
			closedir($subHandle);

                        /***
			$dom = new DOMDocument;
			$dom->load($resellerID."/".$file_attribute."_".$resellerID."_".$mobileID.".xml");
			$xpath = new DOMXPath($dom);
                        ***/

			array_multisort($arTHUMB1,SORT_ASC,SORT_STRING,$arTHUMB2,$arTHUMB3,$arTHUMB4,$arTHUMB5,$arTHUMB6,$arTHUMB7,$arTHUMB8,$arTHUMB9,$arTHUMB10,$arTHUMB11,$arTHUMB12);
			$jj=0;
			$ss = $se = "";
			foreach ($arTHUMB1 as &$vvvTHUMB)
			{
					$bdisp = 0;

					$subEntry	= $arTHUMB2[$jj];
					$ldesc		= $arTHUMB3[$jj];
					$vend_code	= $arTHUMB4[$jj];
					$sheading	= $arTHUMB5[$jj];
					$pYID		= $arTHUMB6[$jj];
					$msrp		= $arTHUMB7[$jj];
					$map		= $arTHUMB8[$jj];
					$desc		= $arTHUMB9[$jj];
					$platform	= $arTHUMB10[$jj];
					$interfaceType  = $arTHUMB11[$jj];
					$pYPLID		= $arTHUMB12[$jj];
					$pname		= $vvvTHUMB;

					$is_special = "";
					$use_custom = "";
/***
					$darr1 = array();

					$liveProd = $xpath->query("/xmp/products/product[id='$subEntry']//@is_active");
					if($liveProd->item(0)->nodeValue=="1")
					{
						// Display DATA from folder structure with custom-data overrides
						$liveProd2 = $xpath->query("/xmp/products/product[id='$subEntry']//*");
						$ei = 0;
						foreach($liveProd2 as $lp)
						{
							$darr1[$lp->nodeName] = $lp->nodeValue;
							$ei++;
						}

						$liveProd2 = $xpath->query("/xmp/products/product[id='$subEntry']//@is_special");
						$is_special = $liveProd2->item(0)->nodeValue;

						$liveProd2 = $xpath->query("/xmp/products/product[id='$subEntry']//@use_custom");
						$use_custom = $liveProd2->item(0)->nodeValue;
***/
						/* works too...
							echo $liveProd->item(0)->nodeName;
							echo "...".$liveProd->item(0)->nodeValue;
							echo "...".$liveProd->item(1)->nodeValue;
						*//***
						$bdisp = 1;
					}
					else
					if($liveProd->item(0)->nodeValue=="0")
					{
						// Display nothing
						$bdisp = 0;
					}
***//***
					if(!$liveProd || $liveProd->item(0)->nodeValue=="")
					{***/
						// Display original DATA from folder structure
						$bdisp = 1;/***
					}
***/
					if($bdisp==1)
					{
						$pid = $subEntry;

						$sale_price = '';
						/*** $sale_price = $darr1['sale_price']; ***/

						// Sale start/end date
						$ss = $se = "";/***
						if($darr1["sale_start_date"] && $darr1["sale_end_date"])
						{
							$ss = strtotime($darr1["sale_start_date"]);
							$se = strtotime($darr1["sale_end_date"]);
						}
***//***
						if( isset($darr1['custom_subHeading']) && $darr1['custom_subHeading']!='' )
							$sheading_custom = $darr1['custom_subHeading'];
						else***/
							$sheading_custom = '';
/***
						if( isset($darr1['custom_productName']) && $darr1['custom_productName']!='' )
							$pname_custom = $darr1["custom_productName"];
						else***/
							$pname_custom = '';

						$big_image_path = '../products/'.$vend_code.'/'.$pid.'/'.$pid.'_big_photo.png';/***
						$custom_big_image = $darr1['custom_bigImage'];***//***

						if( isset($darr1['custom_longDescription']) && $darr1['custom_longDescription']!='' )
							$ldesc_custom = $darr1['custom_longDescription'];
						else***/
							$ldesc_custom = '';
/***
						if( isset($darr1['custom_thumb']) && $darr1['custom_thumb']!='' )
						{
							$thumb_path = $darr1['custom_thumb'];
						}
						else
						{***/
							$thumb_path = '../products/'.$vend_code.'/'.$pid.'/'.$pid.'_thumbm.jpg';/***
						}

						if( isset($darr1['custom_overlay']) && $darr1['custom_overlay']!='' )
							$custom_overlay = $darr1['custom_overlay'];
						else***/
							$custom_overlay = '';
/***
						if( isset($darr1['custom_ytID']) && $darr1['custom_ytID']!='' )
							$pYID_custom = $darr1['custom_ytID'];
						else***/
							$pYID_custom = '';

						if( file_exists($thumb_path) )
							$tsrc = $thumb_path;
						else
							$tsrc = 'missing_thumb.jpg';

						$bstr = "";
						if($vend2show!='')
						{
							if($is_special=="1")
								$bstr = " style='border-top:5px solid #309;' ";
							else
								$bstr = " style='border-top:5px solid #000;' ";
						}

						$ename = utf8_urldecode($pname);

						//---remove href from anchors so we cannot be redirected
						$ldesc = str_replace('href','data-t',$ldesc);
						$ldesc = str_replace('HREF','data-t',$ldesc);
						$ldesc_custom = str_replace('href','data-t',$ldesc_custom);
						$ldesc_custom = str_replace('HREF','data-t',$ldesc_custom);

                                                echo "<img class='thumb' src='$tsrc' data-fldr='$vend_code' data-pnc='$pname_custom' data-desc='$desc' data-ytID='$pYID' data-ytPLID='$pYPLID' data-ytID_custom='$pYID_custom' data-bp='$big_image_path' data-msrp='$msrp' data-map='$map' data-platform='$platform' data-interfaceType='$interfaceType' data-bpc='$custom_big_image' id='$pid' title='$ename' data-uc='$use_custom' data-ovl='$custom_overlay' data-sp='$sale_price' data-ss='$ss' data-se='$se' data-sh='$sheading' data-shc='$sheading_custom' data-ld='$ldesc' data-ldc='$ldesc_custom' onmouseup='thumbUP()' onmousedown=\"thumbDOWN('$pid')\"  $bstr  />";

					}

					$jj++;
			}
		}

		/* echo "<div id='blankRIGHT' style='height: 10px; width: 10px; background-color: #000; border: 0px solid #111; float: left;'></div>"; */
/***
	}
***/
?>