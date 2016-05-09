$(function() {
	var pathUrl = "http://"+window.location.hostname+window.location.pathname;
	doSelect(pathUrl);
	takeValue();
	displayCss();
	sortDropDownListByText();
	$('.align-products:last-child').addClass('last-randomproduct');
	stars();
	requestRate();
});     


/**
* Take out Stars
*/
     
var stars = function () 
{
	var oClsStars = $(".align-page .rating");

	for (var i = 5; i > 0; i--) {
		oClsStars.append(
			"<span onclick='CountStars("+i+");' class='rate-stars' id='star-"+i+"'>☆</span>"
		);
	}

};

/**
* Remove And add class
*/  

function CountStars(i)  
{
	var oNameRate = document.getElementsByClassName("rate-stars");
	
	for (var q = 1; q < 6; q++) {	
		
		$(".prod-info .rating span").removeClass("rate-stars-"+q);
	}

	for (var y = 0; y < oNameRate.length; y++) {
		
		oNameRate[y].classList.toggle('rate-stars-'+i);
	}

	document.getElementById("rate-star").value = i;

};

/**
* Take out rateing from api
*/

var requestRate = function() 
{
	$.post( "http://"+window.location.hostname+"/products/Comments", function( response ) {

		var aRate = [];

		for (var i = 0; i < response.data.length; i++) {
			
			aRate.push(response.data[i].rate);
		}
		
		var href = window.location.href;

		for (var i = 0; i < response.data.length; i++) {

			if (response.data[i].comments_products_id == href.substr(href.lastIndexOf('/') + 1)) {

				$( ".rate-stars" ).addClass("rate-stars-"+mean(aRate));	

				break;
			}
		}

	});		
};

/**
* Calculate mean
*/

function mean(v2_aRates) 
{
	var iTotal = 0; 
	
	for (var i = 0; i < v2_aRates.length; i += 1) {
		
		iTotal += v2_aRates[i];
	}

	return Math.floor(iTotal / v2_aRates.length);
}

/**
* Adding div
*/

function wrapContent(con, center)
{
	var get = $("<div id='"+con+"'></div>");
	get.appendTo($("#inner-main"));
	
	return center.appendTo(get);
}

/** 
* Running Select And url
*/

var doSelect = function(pathu)
{
	var tag = $(".selectTagBlogg");
	var urls = pathu.substring(pathu.indexOf("&") + 1);
	var Bloggselect = document.getElementsByClassName("selectBlogg");

	for (var y = 0; y < Bloggselect.length; y++) {
		for (var i = 0; i < Bloggselect[y].options.length; i++) {
			(urls === Bloggselect[y].options[i].value) 
				? Bloggselect[y].options[i].selected = true : 'false';
		}
	}
	
	$(".selectBlogg").change(function(change){
		window.location = 'Blogg&'+this.value; 
	});
};

/**
* Render content from api
*/

function takeValue() 
{
	// ta ut värdena 
	var pushComments = $(".postComments");
	var makeComment = $("<div id='makeComment' class='makeComment'></div>");
	var empt = '';
	var name = $("#comment_name");
	var makeComm = $("#makeComments");
	var CommentEmail = $("#comment_email");
	
	// Send request
	$("#btn-comment").click(function(){
		
		$.ajax({
			type: 'POST',
			url: 'Post/Comments',
			data: { pname: name.serialize(), 
				pComment: makeComm.serialize(), 
				pemail: CommentEmail.serialize(), 
				pPage: $("#pcomments").serialize()
			},

			success: function(response) {}
		});
		
		$("#displaypostAbove").append(
			'<p>'+name.serialize()+'</p>'+'<p>'+makeComm.serialize()+'</p>'
		);	

		name.val("");
		makeComm.val("");
		CommentEmail.val("");

	});

	makeComment.appendTo(pushComments);
}

/**
* Error report
*/

function storeValue(values)
{
	var ret = (values === '') 
		? 'What Happend!, Value is empty' : localStorage.setItem('#makeComment', values);
	
	return ret;	
}

/**
* Show Comments validering
*/

function commentsValidering(string, div, image)
{
	var stringSecond = (string === 'error') ? '<p>All fields are required</p>': ''; 
	
	if ($("."+string).length <= 0) {	
		div.html(
			"<div class='"+string+"'><img src='"+image+"'><p>"+string+'</p>'+stringSecond+'</div>'
		);
	}
}

/**
* Show register and login button
*/

function toggleClock() { 
	var loginId = document.getElementById('log-in');
	var regId = document.getElementById('reg-in');
	var btnId = document.getElementById('showreg-btn');
	var displaySettingLog = loginId.style.display;
	var displaySettingReg = regId.style.display;

	if (displaySettingLog == 'block') { 
	
		loginId.style.display = 'none';
		regId.style.display = 'block';    	
		btnId.innerHTML = 'Show Log in';
	
	} else {  
	
		loginId.style.display = 'block';
		regId.style.display = 'none';
		btnId.innerHTML = 'Show Register';
	
	}
}

/**
* Setup css none and display block
*/

function displayCss(){
	var regId = document.getElementsByClassName('users-group-in');
	var loginId = document.getElementsByClassName('log-group-in');

	if (regId) {
		for (var i = 0; i < regId.length; i++) {
			regId[i].style.display = 'none';
		}
	}
	if (loginId) {
		for (var i = 0; i < loginId.length; i++) {
			loginId[i].style.display = 'block';
		}
	}
}

/**
* Dropdown list sort values
*/

function sortDropDownListByText() {

    /**
    * Loop for each select element on the page.
    */

    $("select").each(function() {

    	var selectedValue = $(this).val();

    	$(this).html($("option", $(this)).sort(function(a, b) {
    		return a.text == b.text ? 0 : a.text < b.text ? -1 : 1
    	}));

    	$(this).val(selectedValue);
    });
}
 
/**
* Making slideshow
*/

$(document).ready(function(){	
	$(".slides").slice(1).hide();
	$('.slides:first-child').addClass('first');
	$('.slides:last-child').addClass('last');
	$("#slideshow > div:gt(0)").hide(); 

	setInterval(function() { 
		$('#slideshow > div:first').fadeOut(3000).next().fadeIn(3000).end().appendTo('#slideshow');
	},  5000);
});