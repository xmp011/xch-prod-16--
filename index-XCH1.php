<?php die(); ?>

<? ob_start("ob_gzhandler"); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" style="overflow: hidden; background-color: #FFF; zoom: 0.95;">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>XCHANGE Market Platform</title>
<link href="../xchange_2012.css" rel="stylesheet" type="text/css" />
<link href="../p7pmm/p7PMMh03.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="../p7pmm/p7PMMscripts.js"></script>
<link href="../p7tpm/p7tpm06.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="../p7tpm/p7TPMscripts.js"></script>
<link href="../p7irm/p7IRM01.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="../p7irm/p7IRMscripts.js"></script>
<script src="../../../Scripts/swfobject_modified.js" type="text/javascript"></script>
</head>

<body>

<div class="page_wrap" style="margin-bottom: 0px;">
<div style="float: left; height: auto; width: 100%; background-color: #FFF;">
<?php include 'demo2a4b.php'; /* include 'demo2a4b0a.php'; */ ?>
</div>
</div>

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
