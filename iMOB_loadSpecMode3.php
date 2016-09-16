<?php

header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');


	/* Implement random vendor selection here, glob */

	/* $path = realpath('products'); */
	$path = realpath('../products');

	/* gca for randomizer */
	$stack 			= array();

	$vendContent 	= array();
	/**
	$vendThumbs		= array();
	**/

	$ar1 	= array();
	$ar2 	= array();

	if($handle = opendir($path))
	{
		while (false !== ($entry = readdir($handle))) 
		{
			if ($entry != "." && $entry != ".." && $entry != "0000" ) 
			{
				if (is_dir($path."/".$entry) === true)
				{
					/* $info_path = "products/".$entry."/".$entry.".xml"; */
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

				}else
				{

				}
			}
		}

		/*** Pick a random vendor ***/
		if(!isset($vend_code)){
			$stack1 = $stack;
			shuffle($stack1);
			$vend_code = $stack1[0];
		}

		closedir($handle);
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
		$vendOut .= "<div class='vendthumb' onmousedown='mDOWN(this);' onmouseup='mUP(this);' onmouseover='HLvend(this)' onmouseout='' name='$entry' id='$entry' style='float:left;width:auto;margin:0px 4px;border:1px solid #000;font-size:12px;background-color:$bgcol;color:$fcol;padding:10px;cursor:pointer;'>$child</div>\n";
		echo $vendOut;

		/**********/

		$last_VEND_ID = $entry;
		$i++;
	}

?>