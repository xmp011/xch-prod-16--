<!DOCTYPE HTML>



<?php
	$vmode = 0; /* What is this about? */
	$amode = 0; /* What is this about? */
	if(isset($_GET['e']) && $_GET['e']=="1")
	$amode = 1;
	if(isset($_GET['vm']) && $_GET['vm']=="1")
	$vmode = 1;
?>
<?php

	/**
	if(isset($_GET['v']))
	$vend_code = $_GET["v"];
	**/
	/** $vend_code = null; **/
	$vend_code = $_GET['v'];

?>

<html><head>
        <title>XChangeMarket</title>

        <meta name="viewport" content="width=550" />

		<!-- Search related -->
		<!--<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.7/angular.min.js">-->

        <!--<script src="lib/jquery-1.5.1.min.js" type="text/javascript" charset="utf-8"></script>-->
        <script src="../lib/jquery-1.5.1.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="../jquery.kineticV2.0.1.js" type="text/javascript" charset="utf-8"></script>
		<!--<script src="../jquery.kinetic.js" type="text/javascript" charset="utf-8"></script>-->
        <!--<script src="jquery.kinetic.js" type="text/javascript" charset="utf-8"></script>-->



		<!-- Custom adoption _SANK - Start -->
		<!-- Modified(everything works) -->
		<script type="text/javascript">

			function goToVendorLetter(letr)
			{

				alphaClick = 1;

				var numbers = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
				var letters = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];
				var findObj;
				var jqs2f;

				if (letr === "#") {
					jqs2f = $('.vendthumb').filter(function(){ return ((numbers.indexOf($(this).text().charAt(0))) && ($(this).is(':visible')));});
                } else {
					jqs2f = $('.vendthumb').filter(function(){ return (($(this).text().charAt(0) === letr) && ($(this).is(':visible')));});
				}
				findObj = jqs2f[0];
				if($(findObj).attr('id') && $(findObj).is(':visible') && (typeof findObj !== 'undefined'))
				{
					var div1 = $(findObj);
					div1.mousedown().mouseup();
				} else {
					letters.unshift("#");
					var next = letters[($.inArray(letr, letters) + 1) % letters.length];
					goToVendorLetter(next);
				}

				alphaClick = 0;

			}

		</script>

		<style type="text/css">

		#left_letterBar{
			top: 100px;
			/* border-bottom: 2px solid lightblue; */
			overflow-y: hidden;
		}

		#left_letterBar span{
			width: 20px;
			color: #666;
			font-size: 14px;
			font-family: Arial, Helvetica, sans-serif;
		}

		#left_letterBar span:hover{
			cursor: pointer;
			color: #09F;
		}

		.alphasense{
			font-weight: bold;
			color: #09F !important;
		}
		.voidsense{
			color: #555;
		}

		#left_letterBar::-webkit-scrollbar-track
		{
			-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
			/* background-color: #F5F5F5; */
			background-color: black;
		}

		#left_letterBar::-webkit-scrollbar
		{
			/* width: 6px; */
			width: 2px;
			/* background-color: #F5F5F5; */
			background-color: black;
		}

		#left_letterBar::-webkit-scrollbar-thumb
		{
			/* background-color: #000000; */
			background-color: lightblue;
		}


		#inner2 div {
		  background: #545759;
		  background-image: -webkit-linear-gradient(top, #545759, #010203); /* For Safari 5.1 to 6.0 */
		  background-image: -moz-linear-gradient(top, #545759, #010203); /* For Firefox 3.6 to 15 */
		  background-image: -ms-linear-gradient(top, #545759, #010203);
		  background-image: -o-linear-gradient(top, #545759, #010203); /* For Opera 11.1 to 12.0 */
		  background-image: linear-gradient(to bottom, #545759, #010203); /* Standard syntax */
		  -webkit-border-radius: 8;
		  -moz-border-radius: 8;
		  border-radius: 8px;
		  text-shadow: 1px 1px 6px #666666;
		  -webkit-box-shadow: 0px 1px 3px #757575;
 		  -moz-box-shadow: 0px 1px 3px #757575;
		  box-shadow: 0px 1px 3px #757575;
		  padding: 10px 20px 10px 20px;
		  border: solid #303030 2px;
		  text-decoration: none;
		}


		#inner2 div:hover {
		  background: #5dbffc;
		  background-image: -webkit-linear-gradient(top, #5dbffc, #007bff); /* For Safari 5.1 to 6.0 */
		  background-image: -moz-linear-gradient(top, #5dbffc, #007bff); /* For Firefox 3.6 to 15 */
		  background-image: -ms-linear-gradient(top, #5dbffc, #007bff);
		  background-image: -o-linear-gradient(top, #5dbffc, #007bff); /* For Opera 11.1 to 12.0 */
		  background-image: linear-gradient(to bottom, #5dbffc, #007bff); /* Standard syntax */
		  text-decoration: none;
		}

		#inner2 div:active {
		  background: #5dbffc;
		  background-image: -webkit-linear-gradient(top, #5dbffc, #007bff); /* For Safari 5.1 to 6.0 */
		  background-image: -moz-linear-gradient(top, #5dbffc, #007bff); /* For Firefox 3.6 to 15 */
		  background-image: -ms-linear-gradient(top, #5dbffc, #007bff);
		  background-image: -o-linear-gradient(top, #5dbffc, #007bff); /* For Opera 11.1 to 12.0 */
		  background-image: linear-gradient(to bottom, #5dbffc, #007bff); /* Standard syntax */
		  text-decoration: none;
		}



		</style>
		<!-- Custom adoption _SANK - End -->



<script type="text/javascript">

			String.prototype.beginsWith = function (string) {
				return(this.indexOf(string) === 0);
			};

			function noop()
			{
			}

			/*** Admin mode ***/
			function encodeFields()
			{
				$('#e_desc')		.attr('value',		escape($('#f_desc')			.attr('value')) );
				$('#e_productName')	.attr('value',		escape($('#f_productName')	.attr('value')) );
				$('#e_subHead')		.attr('value',		escape($('#f_subHead')		.attr('value')) );
				$('#e_longdesc')	.attr('value',		escape($('#f_longdesc')		.attr('value')) );
				/* $('#e_category')	.attr('value',		escape($('#f_category')		.attr('value')) ); */
				$('#e_infolink')	.attr('value',		escape($('#f_infolink')		.attr('value')) );
				$('#e_ytlink')		.attr('value',		escape($('#f_ytlink')		.attr('value')) );
				$('#e_ytID')		.attr('value',		escape($('#f_ytID')			.attr('value')) );
				$('#e_ytplaylistID').attr('value',		escape($('#f_ytplaylistID')	.attr('value')) );
				$('#e_fblink')		.attr('value',		escape($('#f_fblink')		.attr('value')) );
			}
			function updateFields()
			{
				if($('#f_desc')			.attr('value')=='')
				$('#SHORT_DESC')		.html('{---}');
				else
				$('#SHORT_DESC')		.html($('#f_desc').attr('value'));

				if($('#f_productName')	.attr('value')=='')
				$('#PRODUCT_NAME')		.html('{---}');
				else
				$('#PRODUCT_NAME')		.html($('#f_productName').attr('value'));

				if($('#f_subHead')		.attr('value')=='')
				$('#sub_headline_font')	.html('{---}');
				else
				$('#sub_headline_font')	.html($('#f_subHead').attr('value'));

				if($('#f_longdesc')		.attr('value')=='')
				$('#content_font')		.html('{---}');
				else
				$('#content_font')		.html($('#f_longdesc').attr('value'));

				if($('#f_infolink')		.attr('value')=='')
				$('#infolink')			.attr('href',"javascript:noop();");
				else
				$('#infolink')			.attr('href',$('#f_infolink').attr('value'));

				if($('#f_ytlink')		.attr('value')=='')
				$('#ytlink')			.attr('href',"javascript:noop();");
				else
				$('#ytlink')			.attr('href',$('#f_ytlink').attr('value'));

				if($('#f_fblink')		.attr('value')=='')
				$('#fblink')			.attr('href',"javascript:noop();");
				else
				$('#fblink')			.attr('href',$('#f_fblink').attr('value'));
			}



/*** loadProductXML --START ***/
function loadProductXML(pth,pcode)
{





/* AJAX Start */
$.ajax({
type: "GET",
url: pth,
cache: false,
dataType: "xml",
success: function(xml){
$(xml).find('Item').each(function(){

var sACTIVE 			= $(this).find('active').text();
var sDESCRIPTION 		= $(this).find('description').text();
var sPNAME 				= $(this).find('productName').text();
var sSUBHEAD 			= $(this).find('subHeading').text();
var sLONGDESCRIPTION 	= $(this).find('longDescription').text();
var sCATEGORY 			= $(this).find('category').text();


sDESCRIPTION 			= unescape(sDESCRIPTION);
sPNAME 					= unescape(sPNAME);
sSUBHEAD 				= unescape(sSUBHEAD);
sLONGDESCRIPTION 		= unescape(sLONGDESCRIPTION);
var ca=sCATEGORY.split("|");
for(var i = 0; i < ca.length; i++)
{
/* $('#'+ca[i]).attr('selected','selected'); */
}
$('#f_category').val(ca); /* Deprecated */


var infolink		= "";
var ytlink			= "";
var ytID			= "";
var ytplaylistID	= "";
var fblink			= "";

$('#f_ytlink').attr('value',''); /* Admin */
$('#e_ytlink').attr('value',''); /* Admin */

$('#f_ytID').attr('value',''); /* Admin */
$('#e_ytID').attr('value',''); /* Admin */

$('#f_ytplaylistID').attr('value',''); /* Admin */
$('#e_ytplaylistID').attr('value',''); /* Admin */

infolink		= $(this).find('infolink').text();
ytlink			= $(this).find('ytlink').text();
ytID			= $(this).find('ytID').text();
ytplaylistID	= $(this).find('ytplaylistID').text();
fblink			= $(this).find('fblink').text();

infolink 		= unescape(infolink);
ytlink			= unescape(ytlink);
fblink			= unescape(fblink);


<?php
if($amode==1 && $vmode==0)
{
echo "$('#f_prod')	.attr('value',pcode);";
echo "$('#f_pth')	.attr('value',pth);";
echo "$('#f_php')	.html(pth.replace('.xml','_big.php'));";
echo "$('#f_php')	.attr('href',pth.replace('.xml','_big.php'));";

echo "$('#f_productName').html('{...}');";
echo "$('#f_productName').html(sPNAME);";

echo "$('#f_active').attr('checked',false);";
echo "if(sACTIVE=='1')";
echo "{";
echo "$('#f_active').attr('checked',true);";
echo "}";
echo "else";
echo "{";
echo "$('#f_active').attr('checked',false);";
echo "}";

echo "$('#f_desc').html('');";
echo "$('#f_desc').html(sDESCRIPTION);";

echo "$('#f_subHead').html('{...}');";
echo "$('#f_subHead').html(sSUBHEAD);";

echo "$('#f_longdesc').html('{...}');";
echo "$('#f_longdesc').html(sLONGDESCRIPTION);";

echo "$('#e_category').html('');";
echo "$('#e_category').html(sCATEGORY.replace('|',','));";

echo "$('#f_infolink')		.attr('value',infolink);";
echo "$('#f_ytlink')		.attr('value',ytlink);";
echo "$('#f_ytID')			.attr('value',ytID);";
echo "$('#f_ytplaylistID')	.attr('value',ytplaylistID);";
echo "$('#f_fblink')		.attr('value',fblink);";
echo "$('#infolink')		.attr('href',infolink);";
echo "$('#ytlink')			.attr('href',ytlink);";
echo "$('#fblink')			.attr('href',fblink);";

echo "updateFields();";
}
else
{
echo "$('#SHORT_DESC')			.html(sDESCRIPTION);";
echo "$('#PRODUCT_NAME')		.html(sPNAME);";
echo "$('#sub_headline_font')	.html(sSUBHEAD);";
echo "$('#content_font')		.html(sLONGDESCRIPTION);";


echo " if(infolink=='')";
echo " {";
echo "     $('#infolink').attr('href','javascript:noop();');";
echo "     $('#infolink').attr('target','');";
echo " }";
echo " else";
echo " {";
echo "     $('#infolink').attr('href',infolink);";
echo "     $('#infolink').attr('target','_blank');";
echo " }";


echo " if(ytlink=='')";
echo " {";
echo "     $('#ytlink').attr('href','javascript:noop();');";
echo "     $('#ytlink').attr('target','');";
echo " }";
echo " else";
echo " {";
echo "     $('#ytlink').attr('href',ytlink);";
echo "     $('#ytlink').attr('target','_blank');";
echo " }";


echo " if(fblink=='')";
echo " {";
echo "     $('#fblink').attr('href','javascript:noop();');";
echo "     $('#fblink').attr('target','');";
echo " }";
echo " else";
echo " {";
echo "     $('#fblink').attr('href',fblink);";
echo "     $('#fblink').attr('target','_blank');";
echo " }";

}
?>

});
},

error: function() {
/* alert("An error occurred while processing XML file."); */

<?php
if($amode==1 && $vmode==0)
{
echo "$('#f_prodDIV')	.html(pcode);";
echo "$('#f_prod')		.attr('value',pcode);";
echo "$('#f_pth')		.attr('value',pth);";
echo "$('#f_php')		.html( pth.replace('.xml','_big.php') );";
echo "$('#f_php')		.attr( 'href', pth.replace('.xml','_big.php') );";

echo "$('#f_infolink')		.attr('value',infolink);";
echo "$('#f_ytlink')		.attr('value',ytlink);";
echo "$('#f_ytID')			.attr('value',ytID);";
echo "$('#f_ytplaylistID')	.attr('value',ytplaylistID);";
echo "$('#f_fblink')		.attr('value',fblink);";
echo "$('#infolink')		.attr('href',infolink);";
echo "$('#ytlink')			.attr('href',ytlink);";
echo "$('#fblink')			.attr('href',fblink);";

echo "$('#f_desc')			.html('');";
echo "$('#f_productName')	.html('');";
echo "$('#f_subHead')		.html('');";
echo "$('#e_category')		.html('');";

echo "updateFields();";

}
else
{
echo "$('#SHORT_DESC')			.html('----');";
echo "$('#PRODUCT_NAME')		.html('----');";
echo "$('#sub_headline_font')	.html('----');";
echo "$('#content_font')		.html('----');";

echo "$('#f_infolink')		.attr('value','');";
echo "$('#f_ytlink')		.attr('value','');";
echo "$('#f_ytID')			.attr('value','');";
echo "$('#f_ytplaylistID')	.attr('value','');";
echo "$('#f_fblink')		.attr('value','');";
echo "$('#infolink')		.attr('href','javascript:noop();');";
echo "$('#ytlink')			.attr('href','javascript:noop();');";
echo "$('#fblink')			.attr('href','javascript:noop();');";
}
?>

}

});
/* AJAX End */





/*** Admin mode --START ***/
<?php if($amode==1) { ?>
$.ajax({
	type: "GET",
	cache: false,
    /* url : "getinfolink.php?prod="+pcode, */
    url : "../getinfolink.php?prod="+pcode,
    success : function(result){
		if(result=='-')
		{
			$('#infolink').attr('href','javascript:alert("NO INFO - CONTACT SUPPORT!")');
			/* $('#f_infolink').attr('value',''); */
		}
		else
		{
			$('#infolink').attr('href', result );
			/* $('#f_infolink').attr('value',result); */
		}
    },
	error: function() {
		$('#infolink').attr('href','NO INFO - CONTACT SUPPORT!');
		/* $('#f_infolink').attr('value',''); */
	}
});

$.ajax({
	type: "GET",
	cache: false,
    /* url : "getYTlink.php?prod="+pcode, */
    url : "../getYTlink.php?prod="+pcode,
    success : function(result){
		if(result=='-')
		{
			$('#ytlink').attr('href','javascript:noop();');
			/* $('#f_ytlink').attr('value',''); */
		}
		else
		{
			$('#ytlink').attr('href',result);
			/* $('#f_ytlink').attr('value',result); */
		}
    },
	error: function() {
		$('#ytlink').attr('href','javascript:noop();');
		/* $('#f_ytlink').attr('value',''); */
	}
});

$.ajax({
	type: "GET",
	cache: false,
	url : "../getFBlink.php?prod="+pcode,
    /* url : "getFBlink.php?prod="+pcode, */
    success : function(result){
		if(result=='-')
		{
			$('#fblink').attr('href','javascript:noop();');
			/* $('#f_fblink').attr('value',''); */
		}
		else
		{
			$('#fblink').attr('href', result );
			/* $('#f_fblink').attr('value',result); */
		}
    },
	error: function() {
		$('#fblink').attr('href','javascript:noop();');
		/* $('#f_fblink').attr('value',''); */
	}
});

<?php } ?>
/*** Admin mode --END ***/





}
/*** loadProductXML --START ***/



</script>

<script type="text/javascript">

/*** DECLARATIONS 1 ***/
/** PRODUCT RELATED **/
var curthumb		= "";		/* Current thumb(product) */
/**
var thumbCount 		= 0;
**/
var lastTHMB		= 0;		/* Last thumb */ /* Position of last selected product - $('#wrapper').scrollLeft() */
var lastPTH			= "";		/* Last path */
var lastPCODE		= "";		/* Last product code */
var vidtagloaded 	= 1;
var searched		= 0;

/** VENDOR RELATED **/
var lastSL 			= "0";		/* Last selected */ /* Position of last selected vendor - $('#wrapper2').scrollLeft() */ /* For extra caution, not mandatory */
var lastV 			= "---";	/* Last vendor */ /* Not important */
var curVendHL 		= 0;		/* Current vendor highlighted */
var curVENDOBJ 		= 0;		/* Current vendor object(DIV) */
var loadingVendor	= 0;
var alphaClick = 0;  /*<!---------- Lock --->*/

<?php /* echo "lastV 	= '".$vend_code."';"; */ ?> /** Last vendor **/ /** Not required, new version **/
/*** __DECLARATION 1 ***/

/*** BASIC 1 ***/
function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}
/*** __BASIC1 ***/

</script>

<script type="text/javascript">

function widthAdjustments() {
/** 1 **//** VENDOR RELATED **/
/** BRAND - scroller, width adjustment -- FIX to show exhaustive list **/
var width = 0;
$("#inner2 div.vendthumb").each(function() {
	if ($(this).is(':visible')) {
		width += $(this).outerWidth(true);
	}
});
$("#inner2").css("width", ++width);
/** Rough work, beta, more testing required **/

/** 3 **/
/* Hide arrows. Width adjustment */
if( $('#inner2').width() < $('#inner2').parent().width() )
{
	$('#inner2').width($('#inner2').parent().width());

	$('#leftvendarrow').attr('src','images/BlackOutArrow.png');
	$('#rightvendarrow').attr('src','images/BlackOutArrow.png');
} 
/** ARROWS ON THE BRAND SLIDER **/
else {
	$('#leftvendarrow').attr('src','images/leftBLUvend_white.png'); 
	$('#rightvendarrow').attr('src','images/rightBLUvend_white.png');
}

}

/* widthAdjustments(); */

function widthAdjustments2() {
/** 2 **//** PRODUCT RELATED **/
/** ITEM - scroller, width adjustment -- FIX to show exhaustive list **/
var width = 0;
if (searched == 0) {
	$("#inner div.thumb").each(function() {
		if ($(this).is(':visible')) {
			width += $(this).outerWidth(true);
		}
	});
} else {
	$("#inner div.outcome1").each(function() {
		if ($(this).is(':visible')) {
			width += $(this).outerWidth(true);
		}
	});
}
$("#inner").css("width", ++width);
/** Rough work, beta, more testing required **/

/** 3 **/
/* Hide arrows. Width adjustment */
if( $('#inner').width() < $('#inner').parent().width() )
{
	$('#inner').width($('#inner').parent().width());

	$('#leftthumbarrow').attr('src','images/BlackOutArrow.png');
	$('#rightthumbarrow').attr('src','images/BlackOutArrow.png');
} else {
	$('#leftthumbarrow').attr('src','images/leftBLUvend_white.png');
	$('#rightthumbarrow').attr('src','images/rightBLUvend_white.png');
}

}

</script>

<script type="text/javascript">

/***** VENDOR RELATED *****/
function selvendor(nnn)
{
	<?php
		if($amode==1)
		echo " var estr = '&e=1';";
		else
		echo " var estr = '';";
		if($vmode==1)
		echo " var estr2 = '&vm=1';";
		else
		echo " var estr2 = '';";
	?>

	curVENDOBJ = nnn;

	if(curVENDOBJ){

		/* Alphabet */
		$("#left_letterBar span").removeClass("alphasense");
		var numbers = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
		if (numbers.indexOf($(curVENDOBJ).text().charAt(0)) > -1){
			$("#left_letterBar span:first").addClass("alphasense");
		}
		else{
			var alphavalue = $("#left_letterBar span").filter(function() { return ($(this).text() === $(curVENDOBJ).text().charAt(0)) });
			$(alphavalue).addClass("alphasense");
		}

		/* Selection */
		$("#inner2 div").css({
			'color': '#ffffff',
			'background-image': '-webkit-linear-gradient(top, #545759, #010203)', /* For Safari */
			'text-decoration': 'none'
		});
		
		$("#inner2 div").css({
			'background-image': '-moz-linear-gradient(top, #545759, #010203)', /* For Firefox 3.6 to 15 */
		});
		
		$("#inner2 div").css({
			'background-image': '-o-linear-gradient(top, #545759, #010203)', /* For Opera 11.1 to 12.0 */
		});
		
		
		
		/* Default VENDOR THUMB CSS Examples
		  background: #545759;
		  background-image: -webkit-linear-gradient(top, #545759, #010203);
		  background-image: -moz-linear-gradient(top, #545759, #010203);
		  background-image: -ms-linear-gradient(top, #545759, #010203);
		  background-image: -o-linear-gradient(top, #545759, #010203);
		  background-image: linear-gradient(to bottom, #545759, #010203);
		  -webkit-border-radius: 8;
		  -moz-border-radius: 8;
		  border-radius: 8px;
		  text-shadow: 1px 1px 6px #666666;
		  -webkit-box-shadow: 0px 1px 3px #757575;
 		  -moz-box-shadow: 0px 1px 3px #757575;
		  box-shadow: 0px 1px 3px #757575;
		  padding: 10px 20px 10px 20px;
		  border: solid #303030 2px;
		  text-decoration: none;
		*/
		
		$(curVENDOBJ).css({
			'background-color': '#50a8ea', 
			'color': 'cyan',
			'border': '1px solid white',
			'background': '#5dbffc',
			'background-image': '-webkit-linear-gradient(top, #5dbffc, #007bff)',
			'text-decoration': 'none'	 
		});
		
		$(curVENDOBJ).css({
			'background-image': '-o-linear-gradient(top, #5dbffc, #007bff)'	 
		});
		
		$(curVENDOBJ).css({
			'background-image': 'moz-linear-gradient(top, #5dbffc, #007bff)'	 
		});

			/* ACTIVE VENDOR THUMB CSS Examples
		  	"background-image": "-moz-linear-gradient(top, #5dbffc, #007bff)",
		  	"background-image": "-ms-linear-gradient(top, #5dbffc, #007bff)",
		  	"background-image": "-o-linear-gradient(top, #5dbffc, #007bff)",
		  	"background-image": "linear-gradient(to bottom, #5dbffc, #007bff)",  	
			*/
		
		/* Width */
		widthAdjustments();
		
		/* Lock */
		if(alphaClick == 1)
		$('#wrapper2').scrollLeft( $(curVENDOBJ).position().left );
		lastV = nnn; 
	}
	/* Deselect lastV */ /* Pointless */
	/**
	$(lastV).css('background-color','#222');
	$(lastV).css('color','#ccc');
	**/
	/* Lock current vendor */
	/* if(curVENDOBJ){ */ /* New */
	/* $('#wrapper2').scrollLeft( $(curVENDOBJ).position().left ); */
	/* lastV = nnn; */
	/* } */ /* New */

	/*** Custom point __SANK ***/


	/*** load Vendor with Products ***/

	/********** Load products, AJAX dynamic functionality **********/
	/*** START 1XX ***/

	if(curVENDOBJ){ /* New */
		if (searched == 0)
		dispVendProducts($(lastV).attr("name"), 1);
		else
		dispVendProducts2($(lastV).attr("name"), 1);
	} /* New */

	/*** END 1xx ***/

}

function mDOWN(thmb)
{
	lastSL = $('#wrapper2').scrollLeft();
}
function mUP(thmb)
{
	if( lastSL == $('#wrapper2').scrollLeft() )
	{
		selvendor(thmb);
	}
}

/* key press */
function hlVEND_go()
{
	if(curVendHL)
	{
		/* sl = $('#wrapper2').scrollLeft(); */
		/* document.location = 'http://www.xchangemarket.com/n_products.php?v='+$(curVendHL).attr('id')+'&sl='+sl; */
		/* document.location = 'http://www.xchangemarket.com/Task4/n_products.php?v='+$(curVendHL).attr('id')+'&sl='+sl; */
		$(curVendHL).mousedown().mouseup();
	}
}
/* key press */
function hlnextVEND()
{
	if(curVendHL)
	{
		newVENDHL = $(curVendHL).next();
		if(newVENDHL.length > 0)
		{
			CLRvend(curVendHL);
			HLvend(newVENDHL);
			var container = $('#wrapper2');
			if( ($(newVENDHL).position().left+$(container).scrollLeft()+20) > $(container).width() )
			{
				container.scrollLeft( $(newVENDHL).position().left+newVENDHL.width() - container.width() + 20 );
			}
		}
	}
	else
	{
		if(curVENDOBJ)
		{
			HLvend(curVENDOBJ);
		}
	}
}
/* key press */
function hlprevVEND()
{
	if(curVendHL)
	{
		newVENDHL = $(curVendHL).prev();
		if(newVENDHL.length > 0)
		{
			CLRvend(curVendHL);
			HLvend(newVENDHL);
			var container = $('#wrapper2');
			if( container.scrollLeft() > newVENDHL.position().left )
			container.scrollLeft( newVENDHL.position().left );
		}
	}
	else
	{
		if(curVENDOBJ) /* Why? */
		{
			HLvend(curVENDOBJ);
		}
	}
}


/* Highlight vendor // VENDOR THUMB */
function HLvend(v)
{
	CLRvend(v);
	$(v).css('border', '1px solid cyan');
	curVendHL = v;
}

/* Clear(unhighlight) vendor */
function CLRvend(v)
{
	/* $(v).css('border','1px solid #000'); */
	$('.vendthumb').css('border','1px solid #000');
}

/* key press */
function CLRvendNOPARM()
{
	if(curVendHL)
	CLRvend(curVendHL);
}

</script>

<script type="text/javascript">

/***** PRODUCT RELATED *****/

function dispVendProducts(objID,force)
{
	if(force==0)
	{
		/** Extra precaution 1 **/
		if( lastVENDPOS != $('#wrapper2').scrollLeft() )
		return;

		/** Extra precaution 2 **/
		if(currVendorID==objID)
		return;
	}

	if(loadingVendor==1)
	return;

	/* currVendorID = objID; */ /** Not needed **/

	/**
	$('#imgBox')        .html('');
	$('#desc')          .html('');
	$('#pp')            .html('');
	$('#pp_b')          .html('');
	$('#sku')           .html('');
	$('#sp')            .html('');
	$('#sp_a')          .html('');
	$('#sp_b')          .html('');
	$('#prodName')      .html('');
	$('#prodSubHead')   .html('');
	$('#prodText')      .html('');
	$('#inner')         .html('');
	$('#innerTOP')      .css('height', 'auto');
	$('#innerTOP')      .html('<img style="height:100px;" src="../spinner1.gif"/>');
	$('#wrapper')       .scrollLeft(0);
	**/

	/* $('.vendthumb')     .css('color',   '#fff'); */
	/* $('#'+objID)        .css('color',   '#0090d2'); */

	var vc = objID;
	/* Look for this in xchangemarket.com, Gary might have implemented it. */
	ldstr = 'iMOB_loadSpecMode2.php?z=1&rid=<?php /* echo $resellerID; */ ?>&mid=<?php /* echo $mobileID; */ ?>&vend2show='+vc+'<?php /* if($ft!=''){ echo '&file_type='.$ft; } */ ?>';
	loadingVendor=1;
	$('#inner').load(ldstr, function(response, status, xhr)
	{
		var wereGood = 1;

		if (status == "error")
		{
			var msg = "Sorry but there was an error: ";
			if(xhr.status!=0)
			{
				wereGood = 0;
				alert(msg + xhr.status + " " + xhr.statusText);
			}
		}

		if(wereGood==1)
		{
			/* $('#innerTOP')  .css('height',    '0px'); */
			/* $('#innerTOP')  .html(''); */
			/* haveVidTag = 1; */
			/* createBigPicTag(); */

			widthAdjustments2();

			/* $('#wrapper').kinetic('do', { x: true, y: false, checkTheConstraints: true, maxScrollPointId: $('#wrapper').attr('id'), scrollOffsetFirstId: $('.thumb:first').attr('id'), scrollOffsetLastId: $('.thumb:last').attr('id'), thumbSelectFunc: 'selectPRODUCT', findNearest: true }); */
			$('#wrapper')	.kinetic();
			$('#left')		.click(function(){$('#wrapper').kinetic('start', { velocity: -10 	}	);});
			$('#right')		.click(function(){$('#wrapper').kinetic('start', { velocity: +10 	}	);});
			$('#end')		.click(function(){$('#wrapper').kinetic('end'							);});
			$('#stop')		.click(function(){$('#wrapper').kinetic('stop'							);});
			$('#detach')	.click(function(){$('#wrapper').kinetic('detach'						);});
			$('#attach')	.click(function(){$('#wrapper').kinetic('attach'						);});

			if( $('.thumb:first').length != 0 )
			{
				/* curSelectedThumb = $('.thumb:first'); */
				/* selectPRODUCT(); */

				var getcode = getParameterByName('pcode');
				if (getcode) {
					$('#inner div[name="'+getcode+'"]').css("display", "block").mousedown().mouseup();
				} else {
					$('#inner div').first().css("display", "block").mousedown().mouseup();
				}

			}
			else
			{
			}
			setTimeout(function() {

				/* showsize(); */
				loadingVendor=0;
				/* font_resize(); */
				/* resizeOverlay(); */
				/* resizePlay(); */

			}, 600);

		}

	});
}

function dispVendProducts2(objID,force)
{
	if(force==0)
	{
		/** Extra precaution 1 **/
		if( lastVENDPOS != $('#wrapper2').scrollLeft() )
		return;

		/** Extra precaution 2 **/
		if(currVendorID==objID)
		return;
	}

	if(loadingVendor==1)
	return;

	/* currVendorID = objID; */ /** Not needed **/

	/**
	$('#imgBox')        .html('');
	$('#desc')          .html('');
	$('#pp')            .html('');
	$('#pp_b')          .html('');
	$('#sku')           .html('');
	$('#sp')            .html('');
	$('#sp_a')          .html('');
	$('#sp_b')          .html('');
	$('#prodName')      .html('');
	$('#prodSubHead')   .html('');
	$('#prodText')      .html('');
	$('#inner')         .html('');
	$('#innerTOP')      .css('height', 'auto');
	$('#innerTOP')      .html('<img style="height:100px;" src="../spinner1.gif"/>');
	$('#wrapper')       .scrollLeft(0);
	**/

	/* $('.vendthumb')     .css('color',   '#fff'); */
	/* $('#'+objID)        .css('color',   '#0090d2'); */

	var vc = objID;

	loadingVendor = 1;

	if( $('.outcome1:first').length != 0 ) {
		/**** 100__ ****/
		var block1 = 0;
		$("#inner .outcome1").each(function( index ) {
			if ($(this).attr("data-vendor") === lastV.getAttribute("name")) {
				$(this).css("display", "block");
				/**** _001 ****/
				/* Load first product */ /* Implement $_GET['pcode] */
				/**** 100__ ****/
				if(block1 == 0){
					$(this).mousedown();
					$(this).mouseup();
				}
				block1++;
			} else {
				$(this).css("display", "none");
			}
		});
		/**** __001 ****/
		/*** end ***/
	} else {}

	widthAdjustments2();

	loadingVendor = 0;

}

function thumbDOWN(pth,pcode,ytID,ytplaylistID)
{
	lastTHMB = $('#wrapper').scrollLeft();
	lastPTH = pth;	/* Mandatory */
	lastPCODE = pcode;	/* Mandatory */
	lastYID = ytID;
	lastYPLID = ytplaylistID;
}
function thumbUP()
{
	if( lastTHMB == $('#wrapper').scrollLeft() )
	{

		/* $('#wrapper').scrollLeft( $('[name="'+lastPCODE+'"]').position().left ); */

		/* $('#bigpic').attr("src",'spinner-blue.gif'); */
		bigpage(lastPTH,lastPCODE);
	}
}

/* Deselect curthumb, select thmb // PRODUCT THUMB */
function hlthumb(thmb)
{
	if(curthumb)
	$(curthumb).css('border','1px solid white');
	$(thmb).css('border','1px solid #0099CC');
	curthumb = thmb;
}

/* key press */
function hlnextThumb()
{
	if($(curthumb).next().length > 0)
	{
		newthumb = $(curthumb).next();
		bigpage($(newthumb).attr("id"),$(newthumb).attr("name"));

		/* curthumb.scrollIntoView(); */
		var container = $('#wrapper');
		/* newthumb(hidden) */
		if( ($(newthumb).position().left+$(container).scrollLeft()) > $(container).width() )
		{
			/* alert($(newthumb).position().left+$(container).scrollLeft()+"----"+$(container).width()+"---"+$(container).scrollLeft()); */
			container.scrollLeft( $(newthumb).position().left+$(container).scrollLeft()+newthumb.width() - container.width() -12 );
		}
	}
	else
	{
		/* if(thumbCount>1) */
		/* { */
			/* newthumb = $(curthumb).prevAll().last(); */
			/* bigpage($(newthumb).attr("id"),$(newthumb).attr("name")); */
			/* curthumb.scrollIntoView(); */
		/* } */
	}
}

/* key press */
function hlprevThumb()
{
	if($(curthumb).prev().length > 0)
	{
		newthumb = $(curthumb).prev();
		bigpage($(newthumb).attr("id"),$(newthumb).attr("name"));

		/* curthumb.scrollIntoView(); */
		var container = $('#wrapper');
		if( $(newthumb).position().left < 0 )
		{
			/* alert($(newthumb).position().left+"----"+$(container).scrollLeft()); */
			container.scrollLeft( $(container).scrollLeft() + $(newthumb).position().left -24);
		}
	}
	else
	{
		/* if(thumbCount>1) */
		/* { */
			/* newthumb = $(curthumb).nextAll().last(); */
			/* bigpage($(newthumb).attr("id"),$(newthumb).attr("name")); */
			/* curthumb.scrollIntoView(); */
		/* } */
	}
}

/* PRODUCT THUMBS HIGHLIGHTS */
function HLicon(thmb)
{
	if(curthumb==thmb)
		$(curthumb).css('border','1px solid #0099CC');
	else
		$(thmb).css('border','1px solid #0099CC');
}

function CLRicon(thmb)
{
	if(curthumb==thmb)
		$(curthumb).css('border','1px solid #0099CC');
	else
		$(thmb).css('border','1px solid white');
}

</script>

<script type="text/javascript">

/*** TAKE A LOOK 1 ***/
/*** KineticJS ***/
/*** ... ***/
/*** Product ***/
function scrleft()
{
	$('#wrapper').kinetic('start', { velocity: -5 });
}
function scrRight()
{
	$('#wrapper').kinetic('start', { velocity: 5 });
}
/*** Vendor ***/
function vendLeft()
{
	$('#wrapper2').kinetic('start', { velocity: -5 });
}
function vendRight()
{
	$('#wrapper2').kinetic('start', { velocity: 5 });
}
/*** ... ***/
/*** __KineticJS ***/
/*** __TAKE A LOOK 1 ***/

</script>

<script type="text/javascript">

/*** CONTENT 1 YOUTUBE ***/
function showVideo()
{
	createVideoTag();
	if(lastYID=="" && lastYPLID=="")
		$('#ytplayer').html("<img src='images/NO_VIDEO.png'/>");
	else
		XMPloadplayer(lastYID,lastYPLID);
}

function createVideoTag()
{
	$('#imgBox').html("<div id='ytplayer'></div>");
	vidtagloaded = 1;
}


function createBigPicTag()
{
	$('#imgBox #playvideo').remove();
	if(vidtagloaded==1)
	$('#imgBox').html("<img src='' name='bigpic' width='460' height='416' id='bigpic' alt='Image is loading...' onclick='showVideo()' style='border: 0px; position:absolute; top:0; left:0;'/>");
	if(lastYID!=""/* && lastYPLID!=""*/)
	$('#imgBox').append("<img src='images/play.png' name='playvideo' width='35' height='26' id='playvideo' alt='' onclick='showVideo()' style='border: 0px; position:absolute; top:195px; left:212.5px;'/>");
	vidtagloaded = 0;
}

function toggleVidPic()
{
}

/*** IGNORE ***/
function bigtest(prod,prodCODE)
{
	<?php
		if($amode==1)
			echo " var estr = '&e=1';";
		else
			echo " var estr = '';";
		if($vmode==1)
			echo " var estr2 = '&vm=1';";
		else
			echo " var estr2 = '';";
		if($amode==1)
			echo " var estr3 = '&pcode='+prodCODE;";
		else
			echo " var estr3 = '';";
	?>
	sl = $('#wrapper2').scrollLeft();
	/* document.location = 'http://www.xchangemarket.com/n_products.php?v='+lastV+'&sl='+sl+'&slthmb='+lastTHMB+estr+estr2+estr3; */
	document.location = 'http://www.xchangemarket.com/Task4/n_products.php?v='+lastV+'&sl='+sl+'&slthmb='+lastTHMB+estr+estr2+estr3;
}

function bigpage(prod,prodCODE)
{
	videoIsLoaded = 0;
	createBigPicTag();

	hlthumb( document.getElementById(prod) );

	$.ajax({
		type: 'HEAD',
		url: prod + ".xml",
		dataType: "text", // Thanks Sank for the Firefox Fix
		success: function(){
		newImage = '' + prod + "_big_photo.png" + '';
		$('#bigpic').attr("src", newImage);
		},
		
		error: function(){
		newImage = '../BLANK_OVERLAY.png';
		$('#bigpic').attr("src", newImage);
		}

	});

	loadProductXML(prod+".xml",prodCODE);
}

/*** __CONTENT 1 ***/

</script>

<style type="text/css">
	body {
		font-family: arial, sans-serif;
	}
	pre code {
		background: #ddd;
		display: block;
		padding: 10px;
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		-o-border-radius: 5px;
		border-radius: 5px;
	}
	#container {
		margin: 0 auto;
		width: 800px;
	}
	#wrapper {
		border: solid 5px #000;
		height: 400px;
		width: 100%;
		overflow: hidden;
	}
	#wrapper2 {
		height: 210px;
		width: 6000px;
		overflow: hidden;
		border-top:1px solid #c0c0c0; 
		border-bottom:1px solid #c0c0c0;
		background: #8e9eab; /* fallback for old browsers */
		background: -webkit-linear-gradient( #ECE9E6 , #FFFFFF , #ECE9E6); /* Chrome 10-25, Safari 5.1-6 */
		background: linear-gradient( #ECE9E6 , #FFFFFF , #ECE9E6); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
	}
	#controls {
		padding: 10px;
	}
	#controls span {
		cursor: pointer;
	}

	.kinetic-moving-up {
		border-top-color: black !important;
	}
	.kinetic-moving-down {
		border-bottom-color: black !important;
	}
	.kinetic-moving-left {
		border-left-color: black !important;
	}
	.kinetic-moving-right {
		border-right-color: black !important;
	}

	.kinetic-decelerating-up {
		border-top-color: black !important;
	}
	.kinetic-decelerating-down {
		border-bottom-color: black !important;
	}
	.kinetic-decelerating-left {
		border-left-color: black !important;
	}
	.kinetic-decelerating-right {
		border-right-color: black !important;
	}
	
	/* #inner img { display: block;  width: 2000px; } */
	#inner { 
		width: 2000px; 
		height: 100px; 
	}
	
	/* #inner img { display: block; width: 2000px; } */
	#inner2 { 
		width: 2000px; 
		height: 100px;
	}
	
	#left, #right { 
		cursor: pointer; 
	}

	.thumbBAK {
		z-index:            -1;
		float:              left;
		height:             92%; /* gca 2015 was 70% */
		cursor:             pointer;
		border-left:        5px solid #000;
		border-right:       5px solid #000;
		/*-moz-border-radius:               6px;*/
		/*border-radius:                    6px;*/
		padding:            4px;
		background-color:   #000;

		/*-moz-outline-radius:              2px;*/
		/*outline-radius:                   2px;*/
		/*outline:                          5px solid green;*/
		/*outline-offset:                   5;*/
		/*-moz-box-shadow:                  20px 20px 20px green;*/
		/*-webkit-box-shadow:               20px 20px 20px green;*/
		/*box-shadow:                       20px 20px 20px green;*/
	}

</style>

<script type="text/javascript">
	/***********************************************
	* Disable Text Selection script- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
	* This notice MUST stay intact for legal use
	* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code

	***********************************************/
	function disableSelection(target){

		if (typeof target.onselectstart!="undefined") /* IE route */
			target.onselectstart=function(){return false}

		else if (typeof target.style.MozUserSelect!="undefined") /* Firefox route */
			target.style.MozUserSelect="none"

		else /* All other route (ie: Opera) */
			target.onmousedown=function(){return false}

		target.style.cursor = "default"
	}
	/* Sample usages */
	/* disableSelection(document.body) Disable text selection on entire body */
	/* disableSelection(document.getElementById("mydiv")) Disable text selection on element with id="mydiv" */
</script>

<link rel="stylesheet" href="../fonts/stylesheet.css" type="text/css" charset="utf-8" />
<link href="generic_style_2016.css" rel="stylesheet" type="text/css">
<script src="../scrollIntoView.min.js" type="text/javascript" charset="utf-8"></script>

</head>

<body>

<?php

	## -- NOT FOUND -- #

	function startsWith($haystack, $needle)
	{
		$length = strlen($needle);
		return (substr($haystack, 0, $length) === $needle);
	}

	function endsWith($haystack, $needle)
	{
		$length = strlen($needle);
		if ($length == 0) {
			return true;
		}

		return (substr($haystack, -$length) === $needle);
	}
?>

<!--<center ng-app="instantsearch">-->
<center>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.7/angular.min.js"></script>

<!-- Search feature _SANK - Start -->

<style type="text/css">

.box{
  /* margin: 100px auto; */
  width: 300px;
  /* height: 50px; */
  height: 30px;
  width: 100%;
  /* border-bottom: 2px solid white; */
  margin-bottom: 15px;
  margin-top: 7px;
}

/* Search 3 - zoom in looking glass */
.container-3{
  /* width: 300px; */
  width: 100%;
  vertical-align: middle;
  white-space: nowrap;
  position: relative;
}

/* SEARCH BAR */
.container-3 input#search{
  /* width: 300px; */
  width: 100% ;
  height: 30px ;
  border: none;
  font-size: 10pt ;
  float: left;
  z-index: -1;
  /*-webkit-border-radius: 5px;*/
  /*-moz-border-radius: 5px;*/
  /*border-radius: 5px;*/
}

.container-3 input#search::-webkit-input-placeholder {
   color: #6b7986;
}
.container-3 input#search:-moz-placeholder { /* Firefox 18- */
   color: #6b7986;  
}
.container-3 input#search::-moz-placeholder {  /* Firefox 19+ */
   color: #6b7986;  
}
.container-3 input#search:-ms-input-placeholder {  
   color: #6b7986;  
}



.container-3 input#search::-webkit-search-cancel-button {
  display: none;

  /* Remove default */
  /* -webkit-appearance: none; */

  /* Now your own custom styles */
  /**
  height: 10px;
  width: 10px;
  background: red;
  **/
  /* Will place small red box on the right of input (positioning carries over) */
}

.suggest-holder {
    /* width: 150px; */
}
.suggest-holder input {
	/* width: 146px; */
	/* border: 1px solid rgba(0,120,0,.6); */
	border: 1px solid #949FD3 !important;
}
.suggest-holder ul {
	display: none;
	list-style: none;
	margin: 0;
	padding: 0;
	border: 1px solid rgba(0,120,0,.6);
	margin-top: -6px;
}
.suggest-holder li {
	padding: 5px;
}
.suggest-holder li:hover {
	cursor: pointer;
}
.suggest-holder li:hover, li.active {
	background: rgba(0,120,0, .2);
}
.suggest-name {
	font-weight: bold;
	display: block;
	height: 15px;
}
.suggest-description {
	font-style: italic;
	font-size: 11px;
	color: #ffffff;
}

</style>

<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

<!-- LAYOUT 1 -->
<!-- <div ng-controller="instantSearchCtrl"> -->
<div class="box" style="text-align: -webkit-left;">
  <div class="container-3 suggest-holder">
     
      <input class="suggest-prompt" type="search" id="search" results="5"  autosave="some_unique_value" name="s" placeholder="Search by name, category or keywords" />

	<ul>
		<li>
			<span class='suggest-name'></span>
			<span class='suggest-description'></span>
		</li>
		<li>
			<span class='suggest-name'></span>
			<span class='suggest-description'></span>
		</li>
		<li>
			<span class='suggest-name'></span>
			<span class='suggest-description'></span>
		</li>
	</ul>

  </div>
</div>
<!-- </div> -->
<!-- Search feature _SANK - End -->

<!-- LAYOUT 2 -->
<!-- Custom adoption _SANK - Start -->
		<!-- <div id='left_letterBar' style='text-align:center;position:fixed;left:0px;top:0px;color:white;width:2.5%;'> -->
		<!-- <div id='left_letterBar' style='text-align:center; float:left; height:490px; left:0px; width:2.5%;'> -->
		<div id='left_letterBar' style='text-align:center; float:left; height:520px; left:0px; width:2.5%;'>
			<span style='' onclick="goToVendorLetter('#')">#</span>
		<br><span style='' onclick="goToVendorLetter('A')">A</span>
		<br><span style='' onclick="goToVendorLetter('B')">B</span>
		<br><span style='' onclick="goToVendorLetter('C')">C</span>
		<br><span style='' onclick="goToVendorLetter('D')">D</span>
		<br><span style='' onclick="goToVendorLetter('E')">E</span>
		<br><span style='' onclick="goToVendorLetter('F')">F</span>
		<br><span style='' onclick="goToVendorLetter('G')">G</span>
		<br><span style='' onclick="goToVendorLetter('H')">H</span>
		<br><span style='' onclick="goToVendorLetter('I')">I</span>
		<br><span style='' onclick="goToVendorLetter('J')">J</span>
		<br><span style='' onclick="goToVendorLetter('K')">K</span>
		<br><span style='' onclick="goToVendorLetter('L')">L</span>
		<br><span style='' onclick="goToVendorLetter('M')">M</span>
		<br><span style='' onclick="goToVendorLetter('N')">N</span>
		<br><span style='' onclick="goToVendorLetter('O')">O</span>
		<br><span style='' onclick="goToVendorLetter('P')">P</span>
		<br><span style='' onclick="goToVendorLetter('Q')">Q</span>
		<br><span style='' onclick="goToVendorLetter('R')">R</span>
		<br><span style='' onclick="goToVendorLetter('S')">S</span>
		<br><span style='' onclick="goToVendorLetter('T')">T</span>
		<br><span style='' onclick="goToVendorLetter('U')">U</span>
		<br><span style='' onclick="goToVendorLetter('V')">V</span>
		<br><span style='' onclick="goToVendorLetter('W')">W</span>
		<br><span style='' onclick="goToVendorLetter('X')">X</span>
		<br><span style='' onclick="goToVendorLetter('Y')">Y</span>
		<br><span style='' onclick="goToVendorLetter('Z')">Z</span>
		</div>
<!-- Custom adoption _SANK - End -->

<!-- LAYOUT 3 -->
<div id="bigdiv" style='z-index:0;width:97.5%;margin-left:2.5%;'>
<!-- <div class="big_pic_box" id="big_pic_box" style='width:100%;'> -->
<div class="big_pic_box" id="big_pic_box" style='width:100%;height:520px;background-size:1000px 520px;'>
<!-- <div class="photobox_left" style='width:50%;'> -->
<div class="photobox_left" style='width:50%;height:520px;'>
    <div class="discript_box" id="discript_font"><div id="SHORT_DESC" style="border:0px solid yellow; color: #333;">&nbsp;</div></div> <!-- Product Title -->
	<div  id='imgBox' class="prod_photo_box"></div>
</div>

<!-- <div class="photobox_right" style='width:50%;'> -->
<div class="photobox_right" style='width:50%;height:520px;'>
			<div class="product_headline_big" id="big_headline_font" style="border:0px solid yellow; color: #333;"><div id="PRODUCT_NAME">&nbsp;</div></div>
			<div class="product_headline_small" id="sub_headline_font" style="border:0px solid yellow; color: #333;">&nbsp;</div>
			<div class="product_text" id="content_font" style="color: #333;"></div>
			<div class="product_icons">
			<a href='' id='infolink' target='_blank' style='text-decoration:none'>
			<img style='visibility:visible;' src='images/INFOicon.png' title='More Information' />
			</a>
				<?php 
                /*
                            <a href='' onclick='' id='ytlink' target='_blank' style='text-decoration:none'>
                                <img style='visibility:visible;' src='YTicon.png' title='Youtube channel' />
                            </a>
                */
                ?>
			<a href='' id='fblink' target='_blank' style='text-decoration:none'>
			<img style='visibility:visible;' src='images/FBicon.png' title='Facebook' />
			</a>
			<div style='font-size:11px;color:lightblue;' id='infolinkTEMP'>&nbsp;</div>
			&nbsp;&nbsp;&nbsp;&nbsp;
			</div>
</div>
</div>
</div>

<style type="text/css">

/*
.photobox_left, .photobox_right{
	overflow: scroll;
}
 */
 
.photobox_left::-webkit-scrollbar-track, .photobox_right::-webkit-scrollbar-track
{
	-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
	/* background-color: #F5F5F5; */
	background-color: black;
}

.photobox_left::-webkit-scrollbar, .photobox_right::-webkit-scrollbar
{
	/* width: 6px; */
	width: 2px;
	/* background-color: #F5F5F5; */
	background-color: black;
}

.photobox_left::-webkit-scrollbar-thumb, .photobox_right::-webkit-scrollbar-thumb
{
	background-color: red;
	/* background-color: lightblue; */
}
.photobox_left::-webkit-scrollbar-corner, .photobox_right::-webkit-scrollbar-corner
{
	/* Select the top half (or left half) or scrollbar track individually */
	background-color: #000000;
}
</style>

<!-- SPINNER -->
<div id="loader" style='z-index:0; width:100%; /*width:97.5%; margin-left:2.5%;*/'></div>

<style type="text/css">
#loader{ 
	display: none; 
	background: url("images/giphy.gif") 
	no-repeat center; 
	background-color: white; 
	/* height: 490px; */
	height: 520px; 
}
</style>

<!-- RESULT -->
<div id="resultout" style='z-index:0;width:100%;/*width:97.5%;margin-left:2.5%;*/'>
	<h1 class="no-results">Sorry, no results were found.</h1><br><br>
	<p><u>Clear your search and try these suggestions</u>:</p>
    <p>Check your spelling</p>
    <p>Try more general words</p>
    <p>Try different words</p>

</div>


<style type="text/css">
#resultout{ 
	display: none; 
	background-color: white; 
	/* height: 490px; */
	height: 520px; 
}
#resultout h1.no-results {
  color: #0071bc;
  font-size: 24px;
  padding:50px 16px 0 0; /* whatever the dimensions the image needs */
}
</style>


<!-- CORE INTEGRATION 1 -->

<?php

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
		/* $vendOut .= "<div class='vendthumb' onmousedown='mDOWN(this);' onmouseup='mUP(this);' onmouseover='HLvend(this)' onmouseout='CLRvend(this)' name='$entry' id='$entry' style='float:left;font-size:12px;border:1px solid #000;width:auto;background-color:$bgcol;color:$fcol;margin:0px 4px;padding:10px;cursor:pointer;'>$child</div>\n"; */
		/* $vendOut .= "<div class='vendthumb' onmousedown='mDOWN(this);' onmouseup='mUP(this);' onmouseover='HLvend(this)' onmouseout='CLRvend(this)' name='$entry' id='$entry' style='float:left;width:auto;margin:0px 4px;border:1px solid #000;font-size:12px;background-color:$bgcol;color:$fcol;padding:10px;cursor:pointer;'>$child</div>\n"; */
		$vendOut .= "<div class='vendthumb' onmousedown='mDOWN(this);' onmouseup='mUP(this);' onmouseover='HLvend(this)' name='$entry' id='$entry' style='float:left; width:auto; margin:0px 4px; font-size:12px; padding:10px; cursor:pointer;'>$child</div>\n"; 
		$vendContent[] = $vendOut;

		/**********/

		$last_VEND_ID = $entry;
		$i++;
	}

?>

<!-- LAYOUT 4 -->
<!-- LIST ALL PRODUCTS app843904833 -->
<!--<div id="container" style='height:90px;width:99%;z-index:1;border:0px solid green;position:relative;top:-2px;margin-left:14px;'>-->
<!--<div id="container" style='height:90px;width:99%;z-index:1;border:0px solid green;position:relative;top:-2px;margin-top:10px;'>-->
<div id="container" style='width:100%; height:95px; margin-top:20px; padding-top: 5px; z-index:1; position:relative; top:-2px; border:1px solid #a8c9e7;'>
<!--<img id='leftthumbarrow' src='../leftBLUvend.png' onclick="scrleft();" style='float:left;width:15px;height:30px;margin-right:4px;margin-top:20px;cursor:pointer;' />-->
<img id='leftthumbarrow' src='images/leftBLUvend_white.png' onclick="scrleft();" style='float:left; width:20px; height:48px; margin-top:20px; cursor:pointer; padding-right:1%;' />
<!--<div id="wrapper" style='height:90px;border:0px solid white;width:92%;float:left;z-index:1;'>-->

<div id="wrapper" style='height:95px; float:left; z-index:1; width:94%; border:0px solid red; padding:0px; '>

    <div id="inner" style='height:90px; width:8000px; font-size:10px; color:#0e6fc1; border:0px solid red; '><!-- Custom, make changes here, inner2, come back // PRODUCT THUMB -->
    
        <?php
            if (count($vendThumbs) > 0):
            foreach($vendThumbs as $thumb1):
            echo $thumb1;
            endforeach;
            endif;
        ?>
    
    </div>
</div>

<!--<img id='rightthumbarrow' src="../rightBLUvend.png" onclick="scrRight();" style='float:left;width:15px;height:30px;margin-left:5px;margin-top:20px;cursor:pointer;' />-->
<img id='rightthumbarrow' src="images/rightBLUvend_white.png" onclick="scrRight();" style='float:left; width:20px; height:48px; margin-top:20px; cursor:pointer; padding-left:1%;' />
</div>
<script type="text/javascript">
disableSelection(document.getElementById("inner")) /* Disable text selection on element with id="mydiv" */
disableSelection(document.getElementById("wrapper")) /* Disable text selection on element with id="mydiv" */
disableSelection(document.getElementById("container")) /* Disable text selection on element with id="mydiv" */
</script>
<script type="text/javascript" charset="utf-8">
	$('#wrapper')	.kinetic();
	$('#left')		.click(function(){$('#wrapper').kinetic('start', { velocity: -10 	}	);});
	$('#right')		.click(function(){$('#wrapper').kinetic('start', { velocity: +10 	}	);});
	$('#end')		.click(function(){$('#wrapper').kinetic('end'							);});
	$('#stop')		.click(function(){$('#wrapper').kinetic('stop'							);});
	$('#detach')	.click(function(){$('#wrapper').kinetic('detach'						);});
	$('#attach')	.click(function(){$('#wrapper').kinetic('attach'						);});
</script>
<!-- _app843904833 -->

<!-- LAYOUT 5 -->
<!-- LIST ALL VENDORS app903248489 -->
<!--<div id="container2" style='width:99%;height:44px;z-index:1;position:relative;top:0px;margin-left:14px;'>-->
<div id="container2" style='width:100%; height:48px; margin-top:4px; z-index:1; position:relative; top:0px;'>
<img id='leftvendarrow' src='images/leftBLUvend_white.png' onclick='vendLeft();' style='float:left; width:20px; height:48px; margin-top:10px; cursor:pointer; padding-right:1%;' />

<div id="wrapper2" style='height:44px; float:left; z-index:1; width:94%; padding-top:10px; padding-bottom:10px;'>

<div id="inner2" style='position:relative; top:0px; width:8000px; padding:5px; border:0px solid red;'>

<?php
	if (count($vendContent) > 0):
	foreach($vendContent as $vend1):
	echo $vend1;
	endforeach;
	endif;
?>

</div>
</div>
<!--<img id='rightvendarrow' src='../rightBLUvend.png' onclick='vendRight();' style='float:left;width:15px;height:30px;margin-left:4px;margin-top:10px;cursor:pointer;' />-->
<img id='rightvendarrow' src='images/rightBLUvend_white.png' onclick='vendRight();' style='float:left; width:20px; height:48px; margin-top:10px; cursor:pointer; padding-left:1%;' />
</div>
<script type="text/javascript">
disableSelection(document.getElementById("inner2")) /* Disable text selection on element with id="mydiv" */
disableSelection(document.getElementById("wrapper2")) /* Disable text selection on element with id="mydiv" */
disableSelection(document.getElementById("container2")) /* Disable text selection on element with id="mydiv" */
</script>
<!-- KineticJS 1 -->
<!-- Redundant? -->
<script type="text/javascript" charset="utf-8">
	$('#wrapper2')	.kinetic();
	$('#left')		.click(function(){ $('#wrapper2').kinetic('start', 		{ velocity: -10 }	); 		});
	$('#right')		.click(function(){ $('#wrapper2').kinetic('start', 		{ velocity: +10 }	); 		});
	$('#end')		.click(function(){ $('#wrapper2').kinetic('end'								); 		});
	$('#stop')		.click(function(){ $('#wrapper2').kinetic('stop'							);		});
	$('#detach')	.click(function(){ $('#wrapper2').kinetic('detach'							);		});
	$('#attach')	.click(function(){ $('#wrapper2').kinetic('attach'							);		});
</script>

<!-- _app903248489 -->

<!-- Reintegrated -->
<!-- Xx00-similar -->
<!-- What is this about? -->
<!-- Selected vendor(position), after page load -->
<!-- Position adjustment -->
<script type="text/javascript" charset="utf-8">
	/***
	$(document).ready(function() {
	});
	***/
	<?php
	/***
		if(isset($_GET['sl']))
		echo "$('#wrapper2').scrollLeft(".$_GET['sl'].");";
	***/
	?>
</script>

</center>

<!-- Search related -->
<div class="content"><div id="result"></div></div>
<style type="text/css">

    .content{
        width:900px;
        margin:0 auto;
    }
	
    #result
    {
        position:absolute;
        width:500px;
        padding:10px;
        display:none;
        margin-top:-1px;
        border-top:0px;
        overflow:hidden;
        border:1px #CCC solid;
        background-color: white;
    }

</style>

<!-- Xx00-similar -->
<script type="text/javascript" >
	<?php

		/**  **/

		/* gca for randomizer */
		if(isset($vend_code) && $vend_code)
		/* { */
		/* if(isset($vend_code)) */
		{
			$vset = $vend_code;

			echo "curVENDOBJ = document.getElementById('$vset');";

			/**
			if(isset($_GET['sl']))
			echo "$('#wrapper2').scrollLeft(".$_GET['sl'].");";
			else
			{
			**/
				/* echo "curVENDOBJ.scrollIntoView();"; */
				/** echo "$('#wrapper2').scrollLeft( $(curVENDOBJ).position().left );"; **/
				echo "alphaClick = 1;"; 
				echo "selvendor(curVENDOBJ);"; 		/* randomize(0) --check this */
				echo "alphaClick = 0;";
			/**
			}
			**/

		}
		/*** Not necessary ***/
		/* else */
		/* { */
			/*** Select a random vendor ***/
			/* shuffle($stack); */
			/* echo "var ooo=document.getElementById('".$stack[0]."');"; */
			/* echo "selvendor(ooo);"; */
		/* } */
	?>
</script>


<?php
if($amode==1 && $vmode==0)
{
/* echo "<br><div style='padding:0px;border:0px solid lightblue;'>"; */ /* Redundant */
/* echo "<form method='post' style='width:100%;color:cyan;background-color: transparent;' target='_blank' action='n_produpdate_GCA2.php' onsubmit='encodeFields();' >"; */
echo "<form method='post' style='width:100%; color:cyan; background-color: transparent;' target='_blank' action='../n_produpdate_GCA2.php' onsubmit='encodeFields();' >";

echo "<table with='100%' style='float:left;'>";
echo "<tr><td valign=top style='border-top:1px solid #999; padding:10px;'>";

echo "<strong>ACTIVE:</strong>&nbsp;";
echo "<input type=checkbox name='f_active' id='f_active' />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

echo "PROD_ID: <input readonly style='font-size:20px;border:0px;color:cyan;background-color:transparent;width:100px;' name='f_prod' id='f_prod' value='' />";
/* echo "<span style='color:cyan;'><a target='_blank' href='' style='color:lightblue;' id='f_php'>------</a></span>"; */

echo "<input type=hidden name='f_pth'  id='f_pth' value='' />";

echo "<br>COMPANY:";
echo "<textarea style='color:white; background-color:transparent; padding:2px; width:400px; height:20px;' 		name='f_desc' 			id='f_desc'></textarea>";

echo "<br>PROD_NAME:";
echo "<textarea style='color:white; background-color:transparent; padding:2px; width:400px; height:20px;' 		name='f_productName' 	id='f_productName'></textarea>";

echo "<br>SUB_HEAD:";
echo "<textarea style='color:white; background-color:transparent; padding:2px; width:400px; height:20px;' 		name='f_subHead' 		id='f_subHead'></textarea>";

echo "<br>LONG_DESC:<br>";
echo "<textarea style='color:black; background-color:white; padding:2px; border:0px; width:100%; height:100px;' 	name='f_longdesc' 		id='f_longdesc'></textarea>";


/*
echo "<option>Analysis</option>";
echo "<option>Audio Editor</option>";
echo "<option>Audio Restoration</option>";
echo "<option>Compressor/Limiter</option>";
echo "<option>Drum Machine</option>";
echo "<option>Effects Delay/Echo</option>";
echo "<option>Effects Flanger</option>";
echo "<option>Effects Harmonizer</option>";
echo "<option>Effects Morphing</option>";
echo "<option>Effects Phaser</option>";
echo "<option>Effects Reverb</option>";
echo "<option>Emulator</option>";
echo "<option>EQ</option>";
echo "<option>Grooves/Beats</option>";
echo "<option>Host</option>";
echo "<option>Library</option>";
echo "<option>Mastering</option>";
echo "<option>Maximizer/Punch</option>";
echo "<option>Mixer</option>";
echo "<option>MIDI Sequencer</option>";
echo "<option>Modelling</option>";
echo "<option>Notation</option>";
echo "<option>Pitch Correction</option>";
echo "<option>Sampler</option>";
echo "<option>Storage</option>";
echo "<option>Surround Sound</option>";
echo "<option>Sound Effects</option>";
echo "<option>Synthesizer</option>";
echo "<option>Time Shifting</option>";
echo "<option>Virtual Instrument</option>";
echo "<option>Vocoder</option>";
*/
/*
echo "<br>CATEGORY: (use SHIFT or CONTRL for multiple)<br>";
echo "<select size=10 name='f_category[]' id='f_category'  multiple='multiple' >";
echo "<option>DAW</option>";
echo "<option>Effects Plug-ins</option>";
echo "<option>Virtual Instruments</option>";
echo "<option>Drum Machines</option>";
echo "<option>Pitch Correction</option>";
echo "<option>Loops & Content</option>";
echo "<option>Instructional</option>";
echo "<option>Audio Restoration</option>";
echo "<option>Notation</option>";
echo "<option>Solutions</option>";
echo "<option>Mastering</option>";
echo "</select>";
*/
echo "<br><br><span style='color:orange;'>GuitarCenter CATEGORIES:</span><div name='e_category' id='e_category' >&nbsp;</div>";

echo "<br><br><br><br><br><br>";
echo "</td>";
echo "<td valign=top style='border-left: 1px solid #999; border-top:1px solid #999; padding:10px;'>";

echo "Youtube-ID:";
echo "<br><textarea style='color:black; background-color:yellow; padding:2px; width:200px; height:20px; border:0px;' name='f_ytID' 			id='f_ytID'></textarea>";

echo "<br>Youtube-Playlist-ID:";
echo "<br><textarea style='color:black; background-color:yellow; padding:2px; width:200px; height:20px; border:0px;' name='f_ytplaylistID' 	id='f_ytplaylistID'></textarea>";

echo "<br>Youtube-URL:";
echo "<br><textarea style='color:white; background-color:transparent; padding:2px; width:250px; height:20px;' 		name='f_ytlink' 		id='f_ytlink'></textarea>";

echo "<hr><br>";
echo "INFO_LINK:";
echo "<textarea style='color:white; background-color:transparent; padding:2px; width:250px; height:20px;' 			name='f_infolink' 		id='f_infolink'></textarea>";
echo "<br>FB_LINK:";
echo "<textarea style='color:white; background-color:transparent; padding:2px; width:250px; height:20px;' 			name='f_fblink' 		id='f_fblink'></textarea>";

echo "<input type=hidden name='e_desc'        id='e_desc' />";
echo "<input type=hidden name='e_productName' id='e_productName' />";
echo "<input type=hidden name='e_subHead'     id='e_subHead' />";
echo "<input type=hidden name='e_longdesc'    id='e_longdesc' />";

echo "<input type=hidden name='e_infolink'		id='e_infolink'/>";
echo "<input type=hidden name='e_ytlink'		id='e_ytlink'  />";
echo "<input type=hidden name='e_ytID'			id='e_ytID'  />";
echo "<input type=hidden name='e_ytplaylistID'	id='e_ytplaylistID'  />";
echo "<input type=hidden name='e_fblink'		id='e_fblink'  />";

echo "</td>";
echo "<td valign=top align=left style='border-left:1px solid #999;border-top:1px solid #999;padding:10px;'>";

echo "<input type=submit style='width:200px;background-color:lightblue;color:blue;' value='Save Changes' />";
echo "<br><br><input type=button onclick='updateFields()' style='width:200px;background-color:lightblue;color:blue;' value='Test' />";

echo "</td>";

echo "</tr>";

echo "</table>";

echo "</form>";
}
?>



</body>


<!-- Key press -->
<script type="text/javascript">

	var arrowGroup = 1;

	<?php /* echo "thumbCount=".$thumbCount.";"; */ ?>

	/* $(document).ready(function(){ */
	$(function(){

		$(document).keydown(function(e){ /* What about Search? */

			/* e.preventDefault(); */

			if (e.keyCode == 49/* 38*/) /* 1 V Up arrow *//* Product selection */
			{
				console.log("You have entered the Product selection mode...");
				arrowGroup = 1;	/* document.getElementById('inner'); */
				CLRvendNOPARM();
			}
			if (e.keyCode == 50/* 40*/) /* 2 V Down arrow *//* Vendor selection */
			{
				console.log("You have entered the Vendor selection mode...");
				arrowGroup = 2;	/* document.getElementById('inner2'); */
				if(curVendHL)
				HLvend(curVendHL);
			}

			if (e.keyCode == 37) /* Left arrow */
			{
				if(arrowGroup==1) /* Product */
				{
					<?php
					if($amode==1)
					;
					else
					{
						echo "hlprevThumb();";
						echo "return false;";
					}
					?>
				}
				else
				if(arrowGroup==2) /* Vendor */
				{
					<?php
						echo "hlprevVEND();";
						echo "return false;";
					?>
				}
			}
			if (e.keyCode == 39) /* Right arrow */
			{
				if(arrowGroup==1)
				{
					<?php
					if($amode==1)
					;
					else
					{
						echo "hlnextThumb();";
						echo "return false;";
					}
					?>
				}
				else
				if(arrowGroup==2)
				{
					<?php
						echo "hlnextVEND();";
						echo "return false;";
					?>
				}
			}

			if (e.keyCode == 13) /* Enter button */
			{
				if(arrowGroup==2)
				{
					<?php
						echo "hlVEND_go();";
						echo "return false;";
					?>
				}
			}

		});

	});

	/* Character codes... */
	/* 37 - left */
	/* 39 - right */
	/* 40 - down */

</script>


<!-- YouTube integration -->
<script type="text/javascript">
	var tag = document.createElement('script');
	tag.src = "https://www.youtube.com/player_api";
	var firstScriptTag = document.getElementsByTagName('script')[0];
	firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
	var player;
	function onYouTubePlayerAPIReady() {
		/* XMPloadplayer(''); */
	}
	function XMPloadplayer(vidID,vidPLID)
	{
		var vi='';
			vi = vidID;

			player = new YT.Player('ytplayer', {
				playerVars: { 'autoplay': 1, 'loop': 1, 'controls': 1,'rel': 0,'autohide': 1,'wmode': 'opaque',
					list: vidPLID,
					listType: 'playlist'
				},
				videoId: vi,
				width: '100%',
				height: '100%',
			});

		videoIsLoaded = 1;

		/ * loadVideoById({'videoId': vidID}); */

	}
</script>
<!-- END YouTube integration -->


</html>

<script type="text/javascript">

<?php
	/* $calcwidth = $thumbCount * 65; */
	/* echo "document.getElementById('inner').style.width = '".$calcwidth."px';"; */

	/**
	echo "the_last_vend = $('#".$last_VEND_ID."');";
	echo "ppp = $(the_last_vend).position().left + $(the_last_vend).width() + 40;";
	echo "document.getElementById('inner2').style.width = ''+ppp+'px';";
	**/
	/* echo "alert(ppp)"; */
?>

</script>

<script type="text/javascript">

$(function(){

	var typingTimer;
	var doneTypingInterval = 2000;
	/* var Xinput = $('#search'); */

	/* $('#search').on('keyup', function () { */
	$('#search').keyup(function () {
	  clearTimeout(typingTimer);
	  typingTimer = setTimeout(doneTyping, doneTypingInterval);
	});

	/* $('#search').on('keydown', function () { */
	$('#search').keydown(function () {
	  $('#left_letterBar, #bigdiv, #container, #container2, #resultout').css("display", "none");
	  $('#loader').css("display", "block");
	  clearTimeout(typingTimer);
	});

	function doneTyping()
	{

		/* var searchid = $(this).val(); */
		var searchid = $('#search').val();
		var dataString = 'key_words='+ searchid;
		if(searchid!='')
		{
			$.ajax({
			type: "POST",
			url: "liveSearch2.php",
			data: dataString,
			cache: false,
			success: function(html)
			{

				/* PRODUCT RELATED */
				var galleryJSON = JSON.parse(html).vendThumbs;
				$("#inner").empty();
				$("#inner").html(galleryJSON);
				searched = 1;
				/* widthAdjustments2(); */

				/* VENDOR RELATED */
				if (JSON.parse(html).vendContent != null && JSON.parse(html).vendContent != undefined/* && JSON.parse(html).vendContent.length > 0*/) {
					$('#left_letterBar, #bigdiv, #container, #container2').css("display", "block");
					$('#loader, #resultout').css("display", "none");
					var objJSON = JSON.parse(html).vendContent;
						$(".vendthumb").css("display", "none");
						var firstV = '';
						jQuery.each(objJSON, function(i, val) {
							var vendor = val;
							if (vendor !== undefined && $(".outcome1[data-vendor='"+vendor+"']").length != 0) {
								if (firstV=='')
								firstV = vendor;
								$('.vendthumb[name="'+vendor+'"]').css("display", "block");
							}
						});
						curVENDOBJ = document.getElementById(''+firstV+'');
						selvendor(curVENDOBJ);
				} else {
					$('#left_letterBar, #bigdiv, #container, #container2, #loader').css("display", "none");
					$('#resultout').css("display", "block");
					$(".vendthumb").css("display", "none");
					/*** 0.11__ ***/
					/* widthAdjustments();? */
					/** What about resetting content? **/
					curVENDOBJ = 0;
					selvendor(curVENDOBJ);
					/*** __0.11 ***/
					return false;
				}

			},
			error: function(){

			}
			});
		}else {
			$('#left_letterBar, #bigdiv, #container, #container2').css("display", "block");
			$('#loader, #resultout').css("display", "none");
			searched = 0;
			var firstV = '';
			$(".vendthumb").css("display", "block");
			if( $('.vendthumb:first').length != 0 ) {
					firstV = $('.vendthumb:first').attr('id');
					curVENDOBJ = document.getElementById(''+firstV+'');
					$(curVENDOBJ).mousedown().mouseup();
			} else {}
		}
		return false;

	}

	/**
	jQuery("#result").on("click",function(e){
		var $clicked = $(e.target);
		var $name = $clicked.find(\'.name\').html();
		var decoded = $("<div/>").html($name).text();
		$(\'#searchid\').val(decoded);
	});

	jQuery(document).live("click", function(e) {
		var $clicked = $(e.target);
		if (! $clicked.hasClass("search")){
		jQuery("#result").fadeOut();
		}
	});

	$(\'#searchid\').click(function(){
		jQuery("#result").fadeIn();
	});
	**/

});

</script>