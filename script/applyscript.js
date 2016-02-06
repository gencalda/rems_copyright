// apply.php disable and enable field -----------------------------------------------------


function disableListReligion(status)
{

	document.getElementById('name_appQualitySearchReligion').disabled = status;
	if (status==false)
	{
		document.getElementById('name_appQualityReligionOthers').disabled = !status;
	}
	else
	{
		document.getElementById('name_appQualityReligionOthers').disabled = status;
	}
		document.getElementById("name_appQualitySearchReligion").selectedIndex = 0;
		document.getElementById("name_appQualityReligionOthers").value = "";
}
						
function disableListNationality(status)
{
	document.getElementById('name_appQualitySearchNationality').disabled = status;
	if (status==false)
	{
		document.getElementById('name_appQualityNationalityOthers').disabled = !status;
	}
	else
	{
		document.getElementById('name_appQualityNationalityOthers').disabled = status;
	}
		document.getElementById("name_appQualitySearchNationality").selectedIndex = 0;
		document.getElementById("name_appQualityNationalityOthers").value = "";
}

function enableTextboxReligion() 
{
	if (document.getElementById("name_appQualitySearchReligion").value == "others") 
	{
		document.getElementById("name_appQualityReligionOthers").disabled = false;
		document.getElementById("name_appQualityReligionOthers").setAttribute('placeholder',"Others, Please specify religion");
		document.getElementById("name_appQualitySearchReligion").disabled = true;
		document.getElementById("SelectReligionFromList").style.display = "block";
	}

}

function enableListReligion()
{
	document.getElementById("name_appQualityReligionOthers").disabled = true;
	document.getElementById("name_appQualitySearchReligion").disabled = false;
	document.getElementById("name_appQualitySearchReligion").selectedIndex = 0;
	document.getElementById("SelectReligionFromList").style.display = "none";
	document.getElementById("name_appQualityReligionOthers").setAttribute('placeholder',"Please specify religion");
	document.getElementById("name_appQualityReligionOthers").value = "";
}

function enableTextboxNationality() 
{
	if (document.getElementById("name_appQualitySearchNationality").value == "others") 
	{
		document.getElementById("name_appQualityNationalityOthers").disabled = false;
		document.getElementById("name_appQualityNationalityOthers").setAttribute('placeholder',"Others, Please specify nationality");
		document.getElementById("name_appQualitySearchNationality").disabled = true;
		document.getElementById("SelectNationalityFromList").style.display = "block";
	}

}

function enableListNationality()
{
	document.getElementById("name_appQualityNationalityOthers").disabled = true;
	document.getElementById("name_appQualitySearchNationality").disabled = false;
	document.getElementById("name_appQualitySearchNationality").selectedIndex = 0;
	document.getElementById("name_appQualityNationalityOthers").setAttribute('placeholder',"Please specify nationality");
	document.getElementById("SelectNationalityFromList").style.display = "none";
	document.getElementById("name_appQualityNationalityOthers").value = "";
}

//slide to top -working ------------------------------------------------------------


$(document).ready(function()
{
	var e=200;var t=2000;
	$("#top").click(function(e)
	{
		e.preventDefault();
		$("html, body").animate(
		{
			scrollTop:0
		},t);return false
	})

	$("#tops").click(function(e)
	{
		e.preventDefault();
		$("html, body").animate(
		{
			scrollTop:0
		},t);return false
	})
	$("#btnEasy2").click(function(e)
	{
		e.preventDefault();
		$("html, body").animate(
		{
			scrollTop:570
		},t);return false
	})


});


// forgot pass
var btnForgotPassword = false;
function forgotpassword() 
{
	
	var forgot = document.getElementById("forgot").value;
	var atpos = forgot.indexOf("@");
	var dotpos = forgot.lastIndexOf(".");
	if (forgot == null || forgot == "") 
    {
    	document.getElementById('forgot').setAttribute('placeholder',"You cannot leave this blank!");
    	document.getElementById('forgot').setAttribute('value','');
    	btnForgotPassword = false;
    	alert('Invalid Email address');
    	document.getElementById('forgot').focus();
    }
    else if (atpos < 1 || ( dotpos - atpos < 2 ))
	{
		btnForgotPassword = false;
		alert('Invalid Email address');
		document.getElementById('forgot').focus();
	}
    else if (!((forgot.indexOf(".") > 0) && (forgot.indexOf("@") > 0)) || /[^a-zA-Z0-9.@_-]/.test(forgot))
    {
    	btnForgotPassword = false;
    	alert('Invalid Email address');
    	document.getElementById('forgot').focus();
    }
   	else
   	{
   		btnForgotPassword = true;
   	}
	enableForgotPassword();
}


function enableForgotPassword()
{
	
	if(btnForgotPassword == true)
	{
		document.getElementById("send").style.display = "block";
		document.getElementById("sendLink").disabled = false;
	
		
	}
	else
	{
		document.getElementById("send").style.display = "none";
		document.getElementById("sendLink").disabled = true;
		
	}
} 


// iApply.php enable proceed --------------------------------------------------------------
var boolEmail = false;
function validateEmail() 
{
	
	var email = document.getElementById("name_appInfoEmail").value;
	var atpos = email.indexOf("@");
	var dotpos = email.lastIndexOf(".");
	if (email == null || email == "") 
    {
    	document.getElementById('name_appInfoEmail').setAttribute('placeholder',"You cannot leave this blank!");
    	document.getElementById('name_appInfoEmail').setAttribute('value','');
    	boolEmail = false;
    	alert('Invalid Email address');
    	document.getElementById('name_appInfoEmail').focus();
    }
    else if (atpos < 1 || ( dotpos - atpos < 2 ))
	{
		boolEmail = false;
		alert('Invalid Email address');
		document.getElementById('name_appInfoEmail').focus();
	}
    else if (!((email.indexOf(".") > 0) && (email.indexOf("@") > 0)) || /[^a-zA-Z0-9.@_-]/.test(email))
    {
    	boolEmail = false;
    	alert('Invalid Email address');
    	document.getElementById('name_appInfoEmail').focus();
    }
   	else
   	{
   		boolEmail = true;
   	}
	enableProceed();
}

function enableProceed () 
{
	if(document.getElementById("terms").checked == true && document.getElementById("pic").checked == true && document.getElementById("resume").checked == true && boolEmail == true)
	{
		document.getElementById("proceed").disabled = false;
	}
	else
	{
		document.getElementById("proceed").disabled = true;
	}
}




//iApply.php slide function working  slide down ---------------------------------------------------------------

$(document).ready(function()
{
	var e=200;var t=2000;
	$("#btnApply1").click(function(e)
	{
		e.preventDefault();
		$("html, body").animate(
		{
			scrollTop:1450
		},t);return false
	})

	$("#btnEasy1").click(function(e)
	{
		e.preventDefault();
		$("html, body").animate(
		{
			scrollTop:560
		},t);return false
	})
	$("#btnApply2").click(function(e)
	{
		e.preventDefault();
		$("html, body").animate(
		{
			scrollTop:1450
		},t);return false
	})


});



// apply.php - next and prev in application form working experiment -----------------------------

		$(document).ready(function(){
            $("#login").fadeIn(1000);
        });

        $(document).ready(function(){
            $("#logout").fadeIn(1000);
        });

		$(document).ready(function(){
            $("#loginError").fadeIn(1000);
        });

        $(document).ready(function(){
            $("#forgotPassword").fadeIn(1000);
        });

         $(document).ready(function(){
            $('#attempt3').fadeIn(1000);
         });

        $(document).ready(function(){
            $('#attempt3').delay(7000).fadeOut(1000);
         });

        $(document).ready(function(){
            $("#basic").fadeIn(1000);
        });

        $(document).ready(function(){
            $('#loadingEmail').delay(7000).fadeOut(100);
         });

        $(document).ready(function(){
            $('#emailChecking').delay(7000).fadeOut(100);
         });

         $(document).ready(function(){
      	  $("#emailConfirmed").delay(7100).fadeIn(100);
        });

        $(document).ready(function(){
            $('#loading').delay(7000).fadeOut(100);
         });

        $(document).ready(function(){
            $('#hi').delay(7000).fadeOut(100);
         });

         $(document).ready(function(){
      	  $("#his").delay(7100).fadeIn(100);
        });

        $(document).ready(function(){
      	  $("#thankYou").fadeIn(1000);
        });

       

        $(document).ready(function(){
            $("#iApply").fadeIn(1000);
        });


		// apply transition
		
		$(document).ready(function()
		{
			$("#basic").fadeIn(1000);
	       	window.scrollTo(0, 0);

			$("#personal").fadeIn(1000);
	       	window.scrollTo(0, 0);

	       	$("#lang").fadeIn(1000);
	       	window.scrollTo(0, 0);

	       	$("#demographic").fadeIn(1000);
	       	window.scrollTo(0, 0);

	       	$("#family").fadeIn(1000);
	       	window.scrollTo(0, 0);

	       	$("#insurance").fadeIn(1000);
	       	window.scrollTo(0, 0);

	       	$("#education").fadeIn(1000);
	       	window.scrollTo(0, 0);

	       	$("#work").fadeIn(1000);
	       	window.scrollTo(0, 0);

	       	$("#character").fadeIn(1000);
	       	window.scrollTo(0, 0);

	       	$("#other").fadeIn(1000);
	       	window.scrollTo(0, 0);

	       	$("#position").fadeIn(1000);
	       	window.scrollTo(0, 0);
		});
					