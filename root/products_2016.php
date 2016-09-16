<!-- xchangemarket.com/products_2016.php -->

<? ob_start("ob_gzhandler"); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>XCHANGE Market Platform</title>

<link href="http://xchangemarket.com/xchange2016.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" media="screen" href="xch-prod-16--/css/screen-Outer.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>



<link href="http://xchangemarket.com/xchange_2012.css" rel="stylesheet" type="text/css" />
<link href="http://xchangemarket.com/p7pmm/p7PMMh03.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="http://xchangemarket.com/p7pmm/p7PMMscripts.js"></script>
<link href="http://xchangemarket.com/p7tpm/p7tpm06.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="http://xchangemarket.com/p7tpm/p7TPMscripts.js"></script>
<link href="http://xchangemarket.com/p7irm/p7IRM01.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="http://xchangemarket.com/p7irm/p7IRMscripts.js"></script>
<script src="xch-prod-16--/high-root/Scripts/swfobject_modified.js" type="text/javascript"></script>

</head>

<body>

<?php include("menu_2016.php"); ?>

<div class="page_wrap" style="margin-bottom: 0px;   overflow: hidden; background-color: #FFF; zoom: 0.95;">
<div style="float: left; height: auto; width: 100%; background-color: #FFF;">
<?php include '/xch-prod-16--/demo2a4b.php'; /* include 'demo2a4b0a.php'; */ ?>
</div>
</div>

<?php include("footer_2016.php"); ?>

</body>

<?php
	if($amode==1 && $vmode==0)
	{
		/* No cache headers */
		header("Expires: 0");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
	}
?>

</html>