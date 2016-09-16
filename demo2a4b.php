<!-- Structure this -->

<!DOCTYPE HTML>

<?php $vend_code = $_GET['v']; ?>

<html><head>
<title>XChangeMarket</title>

<!-- <meta name="viewport" content="width=550" /> -->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" media="screen" href="/xch-prod-16--/css/screen-Inner.css">
<link rel="stylesheet" type="text/css" media="screen" href="/xch-prod-16--/css/screen-Outer.css">

<!-- Search related -->
<!--<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.7/angular.min.js">-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.js"></script> -->
<!-- <script src="../lib/jquery-1.5.1.min.js" type="text/javascript" charset="utf-8"></script> -->
<script src="/xch-prod-16--/root/jquery.kineticV2.0.1.js" type="text/javascript" charset="utf-8"></script>

<script src="/xch-prod-16--/js/jquery.xdomainajax.js"></script>

<!-- CORE INTEGRATION 1 -->
<script>
function dispVendors()
{

	if(loadingVendor==1)
	return;

	ldstr = 'http://xchangemarket.com/xch-prod-16--/iMOB_loadSpecMode3.php';
	loadingVendor=1;
	$('#inner2').load(ldstr, function(response, status, xhr)
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

			widthAdjustments();

			/* $('#wrapper').kinetic('do', { x: true, y: false, checkTheConstraints: true, maxScrollPointId: $('#wrapper').attr('id'), scrollOffsetFirstId: $('.thumb:first').attr('id'), scrollOffsetLastId: $('.thumb:last').attr('id'), thumbSelectFunc: 'selectPRODUCT', findNearest: true }); */
			$('#wrapper2')	.kinetic();
            $('#left')		.click(function(){ $('#wrapper2').kinetic('start', 		{ velocity: -10 }	); 		});
            $('#right')		.click(function(){ $('#wrapper2').kinetic('start', 		{ velocity: +10 }	); 		});
            $('#end')		.click(function(){ $('#wrapper2').kinetic('end'								); 		});
            $('#stop')		.click(function(){ $('#wrapper2').kinetic('stop'							);		});
            $('#detach')	.click(function(){ $('#wrapper2').kinetic('detach'							);		});
            $('#attach')	.click(function(){ $('#wrapper2').kinetic('attach'							);		});

			setTimeout(function() {

				loadingVendor=0;

			}, 600);

		}

	});
}
</script>

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

<script type="text/javascript">
/**
String.prototype.beginsWith = function (string) {
return(this.indexOf(string) === 0);
};**/

function noop()
{
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

var dataString = "path=" + btoa(encodeURIComponent(pth));

$.ajax({
type        :           "GET",
url         :           "http://xchangemarket.com/xch-prod-16--/loadProduct.php",
data        :           dataString,
cache       :           false,
/* dataType    :           "xml", */
success     :           function(data){

if (JSON.parse(data).prodResult != null && JSON.parse(data).prodResult != undefined/* && vendContent2.length > 0*/) {

var json1 = JSON.parse(data).prodResult;

/* for(var i in json1){ */

var sACTIVE 			= json1.active[0];console.log(sACTIVE);
var sDESCRIPTION 		= json1.description;
var sPNAME 				= json1.productName;
var sSUBHEAD 			= json1.subHeading;
var sLONGDESCRIPTION 	= json1.longDescription;
var sCATEGORY 			= json1.category;


sDESCRIPTION 			= unescape(sDESCRIPTION);
sPNAME 					= unescape(sPNAME);
sSUBHEAD 				= unescape(sSUBHEAD);
sLONGDESCRIPTION 		= unescape(sLONGDESCRIPTION);

var infolink		= "";
var ytlink			= "";
var ytID			= "";
var ytplaylistID	= "";
var fblink			= "";

infolink		= json1.infolink;
ytlink			= json1.ytlink;
ytID			= json1.ytID;
ytplaylistID	= json1.ytplaylistID;
fblink			= json1.fblink;

infolink 		= unescape(infolink);
ytlink			= unescape(ytlink);
fblink			= unescape(fblink);


<?php

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

?>

/* } */

}

},

error       :           function() {
/* alert("An error occurred while processing XML file."); */

<?php

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

?>

}

});
/* AJAX End */





}
/*** loadProductXML --START ***/



</script>

<script type="text/javascript">

/*** DECLARATIONS 1 ***/
/** PRODUCT RELATED **/
/* 1 */
var curthumb		= "";		/* Current thumb(product) */
/* 2 */
var lastTHMB		= 0;		/* Last thumb */ /* Position of last selected product - $('#wrapper').scrollLeft() */
var lastPTH			= "";		/* Last path */
var lastPCODE		= "";		/* Last product code */
/* 3 */
var vidtagloaded 	= 1;

/** VENDOR RELATED **/
/* 1 */
var lastSL 			= "0";		/* Last selected */ /* Position of last selected vendor - $('#wrapper2').scrollLeft() */ /* For extra caution, not mandatory */
var lastV 			= "---";	/* Last vendor */ /* Not important */
var curVendHL 		= 0;		/* Current vendor highlighted */
var curVENDOBJ 		= 0;		/* Current vendor object(DIV) */
var loadingVendor	= 0;
/* 2 */

/*** ##--001--##___ ***/
var alphaClick 		= 0;		/* Newly added */
var mode			= "1";		/* Display mode */

/** OTHER **/
/* 3 */
var searchST		= 0;		/* Newly added - search related */
var searchClick		= 0;		/* Newly added - search related */
var searchID		= "";
var searchCAT		= "all";	/* Before - "" */
var currentlyACT 	= false;	/* Currently active */
var categoryOPT		= "";		/* Category option */
/*** ___##--001--## ***/

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
	if ($(this).is(':visible'))
	width += $(this).outerWidth(true);
});
$("#inner2").css("width", (width + 20));
/** Rough work, beta, more testing required **/

/** 3 **/
/* Hide arrows. Width adjustment */
if( $('#inner2').width() < $('#inner2').parent().width() )
{
	$('#inner2').width($('#inner2').parent().width());

	$('#leftvendarrow').attr('src',		'/xch-prod-16--/images/BlackOutArrow.png');			/* Changed */
	$('#rightvendarrow').attr('src',	'/xch-prod-16--/images/BlackOutArrow.png');			/* Changed */
}
/** ARROWS ON THE BRAND SLIDER **/
else {
	$('#leftvendarrow').attr('src',		'/xch-prod-16--/images/leftBLUvend_white.png');		/* Changed */
	$('#rightvendarrow').attr('src',	'/xch-prod-16--/images/rightBLUvend_white.png');		/* Changed */
}

}

function widthAdjustments2() {
/** 2 **//** PRODUCT RELATED **/
/** ITEM - scroller, width adjustment -- FIX to show exhaustive list **/
var width = 0;
$("#inner div.thumb").each(function() {
	if ($(this).is(':visible'))
	width += $(this).outerWidth(true);
});
$("#inner").css("width", (width + 20));
/** Rough work, beta, more testing required **/

/** 3 **/
/* Hide arrows. Width adjustment */
if( $('#inner').width() < $('#inner').parent().width() )
{
	$('#inner').width($('#inner').parent().width());

	$('#leftthumbarrow').attr('src',	'/xch-prod-16--/images/BlackOutArrow.png');
	$('#rightthumbarrow').attr('src',	'/xch-prod-16--/images/BlackOutArrow.png');
} else {
	$('#leftthumbarrow').attr('src',	'/xch-prod-16--/images/leftBLUvend_white.png');
	$('#rightthumbarrow').attr('src',	'/xch-prod-16--/images/rightBLUvend_white.png');
}

}

</script>

<script type="text/javascript">

/***** VENDOR RELATED *****/
/** Touch/devices **/
$(document).on('touchend', ".vendthumb", function(event){ $(event.target).mousedown().mouseup(); })

/*** Core___ ***/
function selvendor(nnn)
{

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

		/** Changed **/
		/* Selection */
		$("#inner2 div").css({
			'color'				: 			'#ffffff',
			'background-image'	: 			'-webkit-linear-gradient(top, #545759, #010203)', /* For Safari */
			'text-decoration'	: 			'none'
		});

		$("#inner2 div").css({
			'background-image'	: 			'-moz-linear-gradient(top, #545759, #010203)', /* For Firefox 3.6 to 15 */
		});

		$("#inner2 div").css({
			'background-image'	: 			'-o-linear-gradient(top, #545759, #010203)', /* For Opera 11.1 to 12.0 */
		});

		$(curVENDOBJ).css({
			'background-color'		: '#50a8ea',
			'color'					: 'cyan',
			'border'				: '1px solid white',
			'background'			: '#5dbffc',
			'background-image'		: '-webkit-linear-gradient(top, #5dbffc, #007bff)',
			'text-decoration'		: 'none'
		});

		$(curVENDOBJ).css({
			'background-image'		: '-o-linear-gradient(top, #5dbffc, #007bff)'
		});

		$(curVENDOBJ).css({
			'background-image'		: 'moz-linear-gradient(top, #5dbffc, #007bff)'
		});

		/* Width */
		widthAdjustments();

		/* Lock */
		/* Changed */
		if((alphaClick == 1) || (curVENDOBJ == lastV))
		$('#wrapper2').scrollLeft( $(curVENDOBJ).position().left );

		lastV = nnn;

		dispVendProducts($(curVENDOBJ).attr("name"), 1);
	}

}
function mDOWN(thmb)
{
	lastSL = $('#wrapper2').scrollLeft();
}
function mUP(thmb)
{
	if( lastSL == $('#wrapper2').scrollLeft() )
	selvendor(thmb);
}
/*** ___Core ***/

/* Key press___ */
function hlVEND_go()
{
	if(curVendHL)
	{
		/* sl = $('#wrapper2').scrollLeft(); */
		$(curVendHL).mousedown().mouseup();
	}
}
function hlnextVEND()
{
	if(curVendHL)
	{
		newVENDHL = $(curVendHL).next();
		if((newVENDHL.length > 0)/* && (newVENDHL.is(":visible"))*/)
		{
			if (newVENDHL.is(":visible")) {

			CLRvend(curVendHL);
			HLvend(newVENDHL);
			var container = $('#wrapper2');
			if( ($(newVENDHL).position().left+$(container).scrollLeft()+20) > $(container).width() )
			{
				container.scrollLeft( $(newVENDHL).position().left+newVENDHL.width() - container.width() + 20 );
			}

			} else {

			curVendHL = newVENDHL;
			hlnextVEND();

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
function hlprevVEND()
{
	if(curVendHL)
	{
		newVENDHL = $(curVendHL).prev();
		if((newVENDHL.length > 0)/* && (newVENDHL.is(":visible"))*/)
		{
			if (newVENDHL.is(":visible")) {

			CLRvend(curVendHL);
			HLvend(newVENDHL);
			var container = $('#wrapper2');
			if( container.scrollLeft() > newVENDHL.position().left )
			container.scrollLeft( newVENDHL.position().left );

			} else {

			curVendHL = newVENDHL;
			hlprevVEND();

			}
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
/*** ___Key press ***/

/* Highlight vendor and clear__ // VENDOR THUMB */
function HLvend(v)
{
	CLRvend(v);
	$(v).css('border', '1px solid cyan');		/* Changed */
	curVendHL = v;
}
function CLRvend(v)
{
	/* $(v).css('border','1px solid #000'); */
	$('.vendthumb').css('border','1px solid #000');
}
function CLRvendNOPARM()
{
	if(curVendHL)
	CLRvend(curVendHL);
}
/*** __Highlight and clear ***/

</script>

<script type="text/javascript">

/***** PRODUCT RELATED *****/
/** Touch/devices **/
$(document).on('touchend', ".thumb", function(event){ $(event.target).mousedown().mouseup(); })

/*** Core ___ ***/
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

	var vc = objID;
	var terms = btoa(encodeURIComponent(searchID));
	var category = btoa(encodeURIComponent(searchCAT));
	var categoryOPTION = btoa(encodeURIComponent(categoryOPT));
	ldstr = 'http://xchangemarket.com/xch-prod-16--/iMOB_loadSpecMode2.php?mode='+mode+'&vend2show='+vc+'&terms='+terms+'&category='+category+'&categoryOPT='+categoryOPTION+'';
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

				if (searchClick == 1){	/* vend2show - all products(shown) - select 1 */
					var getcode = getParameterByName('pcode');
					if (getcode) {
						/* if($('#inner div[name="'+getcode+'"]').length > 0){ */
							var placeit = $('#inner div[name="'+getcode+'"]').detach();
							$('#inner').empty().append(placeit);
							$('#inner div[name="'+getcode+'"]').mousedown().mouseup();
						/* } else {} */

						/* Affected elsewhere? - check this */
						if (history.pushState) {
						var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname;
						window.history.pushState({path:newurl},'',newurl);
						}
					} else {}
					searchClick = 0;
				} else {

					/*** Vendor -> Product -- relation/restriction || implement ***/
					var getcode = getParameterByName('pcode');
					if (getcode) {
						if($('#inner div[name="'+getcode+'"]').length > 0)	/* Found under current/selected vendor? */
						$('#inner div[name="'+getcode+'"]').mousedown().mouseup();
						else
						$('#inner div').first().mousedown().mouseup();

						/*** Star here tomorrow - July 13, 2016 ***/
						if (history.pushState) {
						var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname;
						window.history.pushState({path:newurl},'',newurl);
						}
					} else {
						$('#inner div').first().mousedown().mouseup();
					}
				}

			}
			else
			{
			}
			setTimeout(function() {

				loadingVendor=0;

			}, 600);

		}

	});
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
	bigpage(lastPTH,lastPCODE);
}
/*** ___Core ***/

/*** Highlight and clear__ ***/
/* Deselect curthumb, select thmb // PRODUCT THUMB */
function hlthumb(thmb)
{
	if(curthumb)
	$(curthumb)	.css('border','1px solid white');
	$(thmb)		.css('border','1px solid #0099CC');
	curthumb = thmb;
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
/*** __Highlight and clear ***/

/*** Key press__ ***/
function hlnextThumb()
{
	newthumb = $(curthumb).next();
	if($(curthumb).next().length > 0/* && ($(curthumb).next().is(":visible"))*/)
	{
		if (newthumb.is(":visible")) {

		/* newthumb = $(curthumb).next(); */
		bigpage($(newthumb).attr("id"),$(newthumb).attr("name"));

		var container = $('#wrapper');
		if( ($(newthumb).position().left+$(container).scrollLeft()) > $(container).width() )
		{
			container.scrollLeft( $(newthumb).position().left+$(container).scrollLeft()+newthumb.width() - container.width() -12 );
		}

		} else {
			curthumb = newthumb;
			hlnextThumb();
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

function hlprevThumb()
{
	newthumb = $(curthumb).prev();
	if(($(curthumb).prev().length > 0)/* && ($(curthumb).next().is(":visible"))*/)
	{
		if (newthumb.is(":visible")) {

		/* newthumb = $(curthumb).prev(); */
		bigpage($(newthumb).attr("id"),$(newthumb).attr("name"));

		/* curthumb.scrollIntoView(); */
		var container = $('#wrapper');
		if( $(newthumb).position().left < 0 )
		{
			/* alert($(newthumb).position().left+"----"+$(container).scrollLeft()); */
			container.scrollLeft( $(container).scrollLeft() + $(newthumb).position().left -24);
		}

		} else {

			curthumb = newthumb;
			hlprevThumb();

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
/*** __Key press ***/

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
	$('#ytplayer').html("<img src='/xch-prod-16--/images/NO_VIDEO.png'/>");
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
	$('#imgBox').html("<img src='' name='bigpic' width='460' height='416' id='bigpic' alt='Image is loading...' onclick='showVideo()' style='border:0px; position:absolute; top:0; left:0;'/>");
	if(lastYID!=""/* && lastYPLID!=""*/)
	$('#imgBox').append("<img src='/xch-prod-16--/images/play.png' name='playvideo' width='35' height='26' id='playvideo' alt='' onclick='showVideo()' style='border:0px; position:absolute; top:195px; left:212.5px;'/>");		/* Changed */

	vidtagloaded = 0;
}
function toggleVidPic()
{
}

function bigpage(prod,prodCODE)
{
	videoIsLoaded = 0;
	createBigPicTag();

	hlthumb( document.getElementById(prod) );
/**
	$.ajax({
		type: 'HEAD',
		url: prod + ".xml",
		dataType: "text", /* Thanks Sank for the Firefox Fix *//**
		success: function(){
		newImage = ''+prod+"_big_photo.png"+'';
		$('#bigpic').attr("src",newImage);
		},
		error: function(){
		newImage = 'http://xchangemarket.com/BLANK_OVERLAY.png';
		$('#bigpic').attr("src",newImage);
		}
	});**/

	loadProductXML(prod+".xml",prodCODE);
}

/*** __CONTENT 1 ***/

</script>

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

<link rel="stylesheet" href="http://xchangemarket.com/fonts/stylesheet.css" type="text/css" charset="utf-8" />
<link href="/xch-prod-16--/generic_style_2016.css" rel="stylesheet" type="text/css">
<script src="http://xchangemarket.com/scrollIntoView.min.js" type="text/javascript" charset="utf-8"></script> <!-- Check this. What's this about? -->

<script>

var widthANIM 	= 0;
var doANIM 		= 0;
var time		= 0;

$(function(){

/* (function poll(){ */
setInterval(function(){


/* var sinceID = $(".twitterThumb:first").data("post"); */
var sinceID = $(".rpt300:first").data("post");
if (sinceID)
var dataString = 'since_id='+ sinceID;
else
var dataString = 'since_id=""';

$.ajax({
url: "http://xchangemarket.com/xch-prod-16--/loadTwitter.php",
data: dataString,
cache: false,
success: function(data){

/* console.log(data); */

if (JSON.parse(data).prodContent != null && JSON.parse(data).prodContent != undefined/* && vendContent2.length > 0*/) {

var json1 = JSON.parse(data).prodContent.reverse();
if ($(".rpt300").length >= 10)
$(".rpt300:nth-last-child(-n+"+json1.length+")").remove();

for(var i in json1){
$("#inner200").prepend("<span class='rpt300' style='float:left;z-index:20;width:auto; line-height:35px;vertical-align:bottom;'  data-post='"+json1[i].post_id+"' data-vendor='"+json1[i].vendor+"' name='"+json1[i].pcode+"' title='"+json1[i].name+"'><span class='X200-tag'></span>&nbsp;&nbsp;"+decodeURIComponent(json1[i].text)+"</span>");
}

/*** AFTER - 1 ***/
setTimeout(function(){
/* Adjust container width */
widthANIM = 0;
$('.rpt300').each(function() {
widthANIM += $(this).outerWidth( true );
});
widthANIM += 30;
$("#inner200").css('width', (widthANIM));

/* if (doANIM == 0) { */
/* animateMe($('#inner200'), 45000); */
time = widthANIM * 15;
$('#wn200 #inner200').stop(true);
animateMe($('#inner200'), time);
/* doANIM = 1; */
/* } */
}, 1000);
/*** ___AFTER - 1 ***/

}

},
error: function(){

},
}).done(function() {

/* poll(); */

});


}, 5000);
/* })(); */

});

$(document).on('click touchend', ".rpt300", function(event){
		var vendor = $(this).data( "vendor" ); /* Vendor ID */
		var name = $(this).attr( "name" ); /* SKU */
		if (vendor !== undefined) {

			mode = "1";

			/* searchClick = 1; */
			if (history.pushState) {
			var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?pcode=' + name;
			window.history.pushState({path:newurl},'',newurl);
			}

			setTimeout(function(){
			$('.vendthumb').css("display", "block");
			/**
			$('.vendthumb[name="'+vendor+'"]').css("display", "block").mousedown().mouseup();
			$('.vendthumb[name="'+vendor+'"]').css("display", "block").mousedown().mouseup();
			**/
			$('.vendthumb[name="'+vendor+'"]').mousedown().mouseup();
			$('.vendthumb[name="'+vendor+'"]').mousedown().mouseup();
			}, 500);

		}

        animateMe($('#inner200'), remainingTime, 'hover');

})

</script>

<script>

/* var time 			= 30000; */
var distance 		= -(-(widthANIM) - $('#wn200').width()); /* var distance 		= -(-2650 - $('#wn200').width()); /* Change here */
var currentTime 	= 0;
var remainingTime 	= 0;

var animateMe = function(targetElement, speed, state){

	if (state!=="hover")
	$(targetElement).css({right:-(widthANIM)}); /* Double check *//* $(targetElement).css({left:'-2650px'}); */ /* $(targetElement).css({right:'-2650px'}); */

	$(".rpt300").css("display", "table-cell");
    $(targetElement).animate(
        {
        'right': $('#wn200').width() /* 'left': $('#wn200').width() *//* 'left': 200 */

        }, 
        {

		queue: false, 
        duration: speed, 
		step: function (now, fx) {

			/* remainingTime = Math.round((1 - ((now + 2650) / 3655)) * time); */
			remainingTime = Math.round((1 - ((now + widthANIM) / 3655)) * time);

		}, 
		/* easing: 'linear', */
        complete: function(){
		/* animateMe(this, speed); */
		animateMe(this, time);
		}

        }

	);

};

/* setTimeout(function(){ animateMe($('#inner200'), 30000); }, 35000); */

$(document).on('mouseenter', "#wn200 span", function(e){
$('#wn200 #inner200').stop();
});
$(document).on('mouseleave', "#wn200 span", function(e){
animateMe($('#inner200'), remainingTime, 'hover');
/* event.stopPropagation(); */
});

</script>

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

<a id="xch-wrapper" href="https://twitter.com/xchangemarket" target="_blank"><div id="feed-header" style="/*background-color: white; */z-index: 99999; height: 38px; width: 38px; /*position: absolute; left: 0;*/float: left;border-radius: 50px;"><img src="/xch-prod-16--/images/feed-icons/twitter-icon-circle-1.png" alt="XCHANGE MARKET Feed" height="38" width="38"></div></a>
<div id="wn200" style="background-color:#95BFA4;/*width:100%;*/width:966px;">
<div id="inner200" style="position: absolute;  width: 2650px;/* left: -2650px; */float: left; top: 0px; z-index: 10;">
</div>
</div>

<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

<!-- LAYOUT 1 -->

<form id="search-target" action="" autocomplete="off">

<div class="box" style="text-align: -webkit-left;">
<div class="container-3 suggest-holder">
<span class="reset-search"><i class="fa fa-refresh" style="margin-top: 7px;"></i></span>
<input class="suggest-prompt" type="search" id="search" placeholder="Search by name, category or keywords" />
<button class="icon" id="search-go" ><i class="fa fa-search"></i></button>

<select id="s-categories">
<option value="DAW">DAW</option>
<option value="Effects Plug-ins">Effects Plug-ins</option>
<option value="Virtual Instruments">Virtual Instruments</option>
<option value="Drum Machines">Drum Machines</option>
<option value="Pitch Correction">Pitch Correction</option>
<option value="Loops & Content">Loops & Content</option>
<option value="Instructional">Instructional</option>
<option value="Audio Restoration">Audio Restoration</option>
<option value="Notation">Notation</option>
<option value="Solutions">Solutions</option>
<option value="Mastering">Mastering</option>
<option value="DJ Tools">DJ Tools</option>
</select>

<select id="s-options">
<option value="all" 		style="background-image:url(/xch-prod-16--/images/dd-icons/all-icon.png);">		    All		</option>
<option value="name" 		style="background-image:url(/xch-prod-16--/images/dd-icons/name-icon.png);">		Name	</option>
<option value="category" 	style="background-image:url(/xch-prod-16--/images/dd-icons/cat-icon.png);">		    Category</option>
<option value="key_words" 	style="background-image:url(/xch-prod-16--/images/dd-icons/keywords-icon.png);">	Keywords</option>
</select>

<ul></ul>

</div>
</div>

</form>

<!-- </div> -->
<!-- Search feature _SANK - End -->

<!-- LAYOUT 2 -->
<!-- Custom adoption _SANK - Start -->
<div id='left_letterBar' style='text-align:center; float:left; height:520px; left:0px; color:white; width:2.5%;'>
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
<div class="big_pic_box" id="big_pic_box" style='width:100%;height:520px;background-size:1000px 520px;'>

<div class="photobox_left" style='width:50%;height:520px;'>
<div class="discript_box" id="discript_font"><div id="SHORT_DESC" style="border:0px solid yellow; color:#333;">&nbsp;</div></div> <!-- Product Title -->
<div  id='imgBox' class="prod_photo_box"></div>
</div>

<div class="photobox_right" style='width:50%;height:520px;'>
<div class="product_headline_big" id="big_headline_font" style="border:0px solid yellow; color:#333;"><div id="PRODUCT_NAME">&nbsp;</div></div>
<div class="product_headline_small" id="sub_headline_font" style="border:0px solid yellow; color:#333;">&nbsp;</div>
<div class="product_text" id="content_font" style="color:#333;"></div>
<div class="product_icons">
<a href='' id='infolink' target='_blank' style='text-decoration:none'>
<img style='visibility:visible;' src='/xch-prod-16--/images/INFOicon.png' title='More Information' />
</a>
<?php 
/*
<a href='' onclick='' id='ytlink' target='_blank' style='text-decoration:none'>
<img style='visibility:visible;' src='YTicon.png' title='Youtube channel' />
</a>
*/
?>
<a href='' id='fblink' target='_blank' style='text-decoration:none'>
<img style='visibility:visible;' src='/xch-prod-16--/images/FBicon.png' title='Facebook' />
</a>
<div style='font-size:11px;color:lightblue;' id='infolinkTEMP'>&nbsp;</div>
&nbsp;&nbsp;&nbsp;&nbsp;
</div>
</div>

</div>
</div>

<!-- SPINNER -->
<div id="loader" style='z-index:0;width:100%;/*width:97.5%;margin-left:2.5%;*/'></div>

<!-- RESULT -->
<div id="resultout" style='z-index:0;width:100%;/*width:97.5%;margin-left:2.5%;*/'>
<h1 class="no-results">Sorry, no results were found.</h1><br><br>
<p><u>Clear your search and try these suggestions</u>:</p>
<p>Check your spelling</p>
<p>Try more general words</p>
<p>Try different words</p>
</div>

<!-- LAYOUT 4 -->
<!-- LIST ALL PRODUCTS app843904833 -->
<div id="container" style='width:100%; height:95px; margin-top:20px; padding-top:5px; z-index:1; position:relative; top:-2px; border:1px solid #a8c9e7;'>
<img id='leftthumbarrow' src='/xch-prod-16--/images/leftBLUvend_white.png' onclick="scrleft();" style='float:left; width:20px; height:48px; margin-top:20px; cursor:pointer; padding-right:1%;' />
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
<img id='rightthumbarrow' src="/xch-prod-16--/images/rightBLUvend_white.png" onclick="scrRight();" style='float:left; width:20px; height:48px; margin-top:20px; cursor:pointer; padding-left:1%;' />
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
<div id="container2" style='width:100%; height:48px; margin-top:4px; z-index:1; position:relative; top:0px;'>
<img id='leftvendarrow' src='/xch-prod-16--/images/leftBLUvend_white.png' onclick='vendLeft();' style='float:left; width:20px; height:48px; margin-top:10px; cursor:pointer; padding-right:1%;' />
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
<img id='rightvendarrow' src='/xch-prod-16--/images/rightBLUvend_white.png' onclick='vendRight();' style='float:left; width:20px; height:48px; margin-top:10px; cursor:pointer; padding-left:1%;' />
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

</center>

<!-- Search related -->
<div class="content"><div id="result"></div></div>

<!-- Xx00-similar -->
<script type="text/javascript" >

dispVendors();

<?php

/**  **/

/*** FOR NOW - 2016-09-15 ***/
$vend_code = "1018";

if(isset($vend_code) && $vend_code)
{
$vset = $vend_code;

echo "curVENDOBJ = document.getElementById('$vset');";

echo "alphaClick = 1;";
echo "selvendor(curVENDOBJ);";		/* randomize(0) --check this */
echo "alphaClick = 0;";

}

?>
</script>

</body>


<!-- Key press -->
<script type="text/javascript">

	var arrowGroup = 1;

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

$(function(){

    var kCode = null;

	var typingTimer;
	var doneTypingInterval = 2000;
	/* var Xinput = $('#search'); */

	$('#search').keyup(function (e) {
	  clearTimeout(typingTimer);
	  typingTimer = setTimeout(doneTyping, doneTypingInterval);
      /** **/
      kCode = e.keyCode;
	});

	$('#search').keydown(function () {
	  currentlyACT = true;
	  clearTimeout(typingTimer);
	});

	function doneTyping()
	{

		$('.suggest-holder ul').empty();

		searchID = $('#search').val();
		var dataString = 'key_words='+ searchID;
		if(searchID!='')
		{

            $(".reset-search").css({
                'display'               : 'block'
            });
            if ($("#s-categories").is(":visible")) {
            $("#search").css({
                'width'                 : '60%'
            });
            } else {
            $("#search").css({
                'width'                 : '75%'
            });
            }

			/* searchST = 1; */

			$('.suggest-holder ul').show();

			$.ajax({
			type: "POST",
			url: "http://xchangemarket.com/xch-prod-16--/liveSearch3.php",
			data: dataString,
			cache: false,
			success: function(html)
			{

				var json1 = JSON.parse(html).prodContent;

				for(var i in json1){
					$('.suggest-holder ul').append($("<li class='prod-wrapper'><div data-name='" + json1[i].sku + "' data-vendor='" + json1[i].vendor + "'><img src='" + json1[i].thmb + "' style='width:30px;height:30px;float:left;'><div style='padding-left:5px;display:inline-block;'><span class='suggest-name'>" + json1[i].pname + "</span><span class='suggest-description'>" + json1[i].sheading + "</span></div></div></li>"));
				}
				$('.suggest-holder ul').append($("<li class='suggest-all-wrapper'><div><span class='suggest-all'>See all results for \"" + searchID + "\"</span></div></div></li>"));
				/* $('.suggest-holder ul').show(); */

			},
			error: function(){

			}
			}).done(function() { /* Come back to this function */

				currentlyACT = false;

			});
		}else {

			mode = "1";

			/* searchST = 0; */

			$('.suggest-holder ul').hide();
			$('#loader, #resultout').css("display", "none");
			$('#left_letterBar, #bigdiv, #container, #container2').css("display", "block");
			$('.vendthumb').css("display", "block");
			setTimeout(function(){		/* This is ok, but find another way */
			/**
            $('.vendthumb:first').mousedown().mouseup();
			$('.vendthumb:first').mousedown().mouseup();
            **/
            $('.vendthumb:visible').eq(0).mousedown().mouseup();
            $('.vendthumb:visible').eq(0).mousedown().mouseup();
			}, 500);

			currentlyACT = false;

            if (kCode == 13)
            $('#search-go').click();

		}
		return false;

	}

	$('#search-go').click(function(){

		var intervalId = setInterval(function() {
        if(currentlyACT == false) {
            clearInterval(intervalId);

            $(".reset-search").css({
                'display'               : 'block'
            });
            if ($("#s-categories").is(":visible")) {
            $("#search").css({
                'width'                 : '60%'
            });
            } else {
            $("#search").css({
                'width'                 : '75%'
            });
            }

			mode = "3";

			$('.suggest-holder ul').hide();
			$('#left_letterBar, #bigdiv, #container, #container2, #resultout').css("display", "none");
			$('#loader').css("display", "block");

			searchCAT = $('#s-options').val();
			if ($('#s-options').val() === 'category')
			categoryOPT = $('#s-categories').val();
			/* if(searchID!='') */
			$.ajax({
			type: "POST",
			url: "http://xchangemarket.com/xch-prod-16--/liveSearch4.php",
			data: { go: '1', terms: searchID, category: searchCAT, categoryOPT: categoryOPT },
			cache: false,
			success: function(html)
			{

				$("#inner").empty();

				if (JSON.parse(html).vendContent != null && JSON.parse(html).vendContent != undefined/* && vendContent2.length > 0*/) {
					$('#left_letterBar, #bigdiv, #container, #container2').css("display", "block");
					$('#loader, #resultout').css("display", "none");

					var objJSON = JSON.parse(html).vendContent;
					$(".vendthumb").css("display", "none");
					jQuery.each(objJSON, function(i, val) {
						var vendor = val;
						if (vendor !== undefined && $(".vendthumb[name='"+vendor+"']").length != 0) {
							$('.vendthumb[name="'+vendor+'"]').css("display", "block");
						}
					});

					setTimeout(function(){
					$('.vendthumb:visible').eq(0).mousedown().mouseup();
					$('.vendthumb:visible').eq(0).mousedown().mouseup();
					}, 500);

				} else {
					$('#left_letterBar, #bigdiv, #container, #container2, #loader').css("display", "none");
					$('#resultout').css("display", "block");

					return false; /* What is this about? */
				}

			},
			error: function(){

			}
			}).done(function() {

				/* $('.suggest-holder ul').hide(); */

			});

		}
		}, 100);

	})

	/** liveSearchX? **/
    $(document).on('click', ".suggest-holder .prod-wrapper", function(){

        /**
        $(".reset-search").css({
            'display'               : 'block'
        });
        $("#search").css({
            'width'                 : '75%'
        });
        **/

		mode = "1";

		$('.suggest-holder ul').hide();
		$('#left_letterBar, #bigdiv, #container, #container2, #resultout').css("display", "none");
		$('#loader').css("display", "block");
		$(".vendthumb").css("display", "none");

		var vendor = $(this).children("div").data( "vendor" ); /* Vendor ID */
		var name = $(this).children("div").data( "name" ); /* SKU */
		if (vendor !== undefined) {

			searchClick = 1;
			if (history.pushState) {
			var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?pcode=' + name;
			window.history.pushState({path:newurl},'',newurl);
			}

			$('.vendthumb[name="'+vendor+'"]').css("display", "block");
			$('#left_letterBar, #bigdiv, #container, #container2').css("display", "block");
			$('#loader, #resultout').css("display", "none");
			setTimeout(function(){
			$('.vendthumb[name="'+vendor+'"]').css("display", "block").mousedown().mouseup();
			$('.vendthumb[name="'+vendor+'"]').css("display", "block").mousedown().mouseup();
			}, 500);

		}

	});

    $(document).on('click', ".suggest-all-wrapper", function(){

        /**
        $(".reset-search").css({
            'display'               : 'block'
        });
        $("#search").css({
            'width'                 : '75%'
        });
        **/

		mode = "2";

		$('.suggest-holder ul').hide();
		$('#left_letterBar, #bigdiv, #container, #container2, #resultout').css("display", "none");
		$('#loader').css("display", "block");

		/* var searchid = $('#search').val(); */
		var dataString = 'key_words='+ searchID;

		$.ajax({
		type: "POST",
		url: "http://xchangemarket.com/xch-prod-16--/liveSearch2.php",
		data: dataString,
		cache: false,
		success: function(html)
		{

				/* $('.suggest-holder ul').hide(); */

				$("#inner").empty();

				if (JSON.parse(html).vendContent != null && JSON.parse(html).vendContent != undefined/* && vendContent2.length > 0*/) {
					$('#left_letterBar, #bigdiv, #container, #container2').css("display", "block");
					$('#loader, #resultout').css("display", "none");

					var objJSON = JSON.parse(html).vendContent;
					$(".vendthumb").css("display", "none");
					jQuery.each(objJSON, function(i, val) {
						var vendor = val;
						if (vendor !== undefined && $(".vendthumb[name='"+vendor+"']").length != 0) {
							$('.vendthumb[name="'+vendor+'"]').css("display", "block");
						}
					});

					setTimeout(function(){
					$('.vendthumb:visible').eq(0).mousedown().mouseup();
					$('.vendthumb:visible').eq(0).mousedown().mouseup();
					}, 500);
				} else {
					$('#left_letterBar, #bigdiv, #container, #container2, #loader').css("display", "none");
					$('#resultout').css("display", "block");
					/* $(".vendthumb").css("display", "none"); */

					return false;
				}

		},
		error: function(){

		}
		}).done(function() { /* Come back to this function */

		});

	});

	$('#s-options').change(function() {

    $(".reset-search").css({
        'display'               : 'block'
    });
    if ($("#s-categories").is(":visible")) {
    $("#search").css({
        'width'                 : '60%'
    });
    } else {
    $("#search").css({
        'width'                 : '75%'
    });
    }

	if (this.value == 'category') {

	$('.container-3 input#search').css('width','65%');
	$('#s-categories').css('display','block');

    } else {

	$('.container-3 input#search').css('width','80%');
	$('#s-categories').css('display','none');

	}

	});

    $(".reset-search").click(function(){

        mode = "1";

        /* searchST = 0; */

        $('.suggest-holder ul').hide();
        $('#loader, #resultout').css("display", "none");
        $('#left_letterBar, #bigdiv, #container, #container2').css("display", "block");
        $('.vendthumb').css("display", "block");
        setTimeout(function(){		/* This is ok, but find another way */
        /**
        $('.vendthumb:first').mousedown().mouseup();
        $('.vendthumb:first').mousedown().mouseup();
        **/
        $('.vendthumb:visible').eq(0).mousedown().mouseup();
        $('.vendthumb:visible').eq(0).mousedown().mouseup();
        }, 500);

        /* currentlyACT = false; */

        $("#search").val("");
        $("#s-categories").val("DAW");
        $("#s-options").val("all");

        $(".reset-search").css({
            'display'               : 'none'
        });
        $("#s-categories").css({
            'display'               : 'none'
        })
        $("#search").css({
            'width'                 : '80%'
        });

    })

});

$(document).mouseup(function (e){
	var container = $('.suggest-holder ul');

	if (/*!container.is(e.target) && */container.has(e.target).length === 0)
	container.hide();

});

$("#search-target").submit(function( event ) {

    event.preventDefault();

})

</script>