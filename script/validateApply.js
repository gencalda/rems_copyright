

//function to view uploaded image ----------------------------
						

function PreviewImage(no) 
{
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("uploadImage"+no).files[0]);

        oFReader.onload = function (oFREvent) 
        {
            document.getElementById("uploadPreview"+no).src = oFREvent.target.result;
        };
}


// function to view tooltip ---------------------------------

/*$(document).ready(function()
{
	 	$('[data-toggle="tooltip"]').tooltip(); 
});
*/




// slide to top howTO.php
$(document).ready(function()
{
	var e=200;var t=2500;

	$("#goTop").click(function(e)
	{
		e.preventDefault();
		$("html, body").animate(
		{
			scrollTop:0
		},t);return false
	})
});


/*
$(function() {
    $('#name_basicLastName').on('keypress', function(e) {
        if (e.which == 32)
		{
			validateLastName();
			return false;
		}
		else
			validateLastName();
    });
	$('#name_basicFirstName').on('keypress', function(e) {
        if (e.which == 32)
		{
			validateFirstName();
			return false;
		}
		else
			validateFirstName();
    });
});
*/


// start of validation for Basic Info --------------------------------------------------------

var boolFirst = false; 	var boolAddress = false; 	var boolMiddle = true;	
var boolLast = false;	var boolImage = true; 		var boolContact = false; 
var boolExt = true; 	var boolContact2 = true;



function validateImage() 
{

	var fup = document.getElementById('uploadImage1');
	var fileName = fup.value;
	var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
	if(ext == "gif" || ext == "GIF" || ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG" || ext == "png" || ext == "PNG")
	{
		//alert(ext);
		boolImage = true;
		//return true;
	} 
	else
	{
		alert("Invalid image format!");
		document.getElementById('uploadImage1').value = "";
		document.getElementById('uploadImage1').focus();
		//fup.focus();
		boolImage = false;
		//return false;
	}
	enableNext();
}

function validateLastName() 
{
	var LastName = document.forms["myForm"]["name_basicLastName"].value;
	var LastPatt = new RegExp(/^\S([A-Za-z-'\\\s]+)$/g);
	if (LastPatt.test(LastName) == false)
    {
		
		document.getElementById('name_basicLastName').setAttribute('placeholder',"You cannot leave this blank!");
		alert("Last name is incorrect format.");
		document.getElementById('name_basicLastName').value = "";
		boolLast = false;
		document.getElementById('name_basicLastName').focus();
		//return false;
    }
	else
   	{
   		boolLast = true;
   	}
	enableNext();
}

function validateFirstName() 
{
	var FirstName = document.forms["myForm"]["name_basicFirstName"].value;
	var FirstPatt = new RegExp(/^\S([A-Za-z-'\\\s]+)$/g);
	if (FirstPatt.test(FirstName) == false)
    {
		alert("First name incorrect format");
		document.getElementById('name_basicFirstName').value = "";
    	document.getElementById('name_basicFirstName').setAttribute('placeholder',"You cannot leave this blank!");
    	boolFirst = false;
		document.getElementById('name_basicFirstName').focus();
		//return false;
    }
   	else
   	{
   		boolFirst = true;
   	}
	enableNext();
}

function validateMiddleName()
{
	var MiddleName = document.forms["myForm"]["name_basicMiddleName"].value;
	var MiddlePatt = new RegExp(/^\S([A-Za-z-'\\\s]+)$/g);
	if(MiddleName == null || MiddleName == "")
	{
		boolMiddle = false;
	}
	else if (MiddlePatt.test(MiddleName) == false)
	{
		alert("Middle Name incorrect format");
		document.getElementById('name_basicMiddleName').value = "";
		boolMiddle = false;
		document.getElementById('name_basicMiddleName').focus();
		//return false;
	}
	else
	{
		boolMiddle = true;
	}
	enableNext();
}

function validateExtName()
{
	var ExtName = document.forms["myForm"]["name_basicExtName"].value;
	var ExtPatt = new RegExp(/^([A-Za-z-'.\\\s]+)$/g);
	if(ExtName == null || ExtName == "")
	{
		boolExt = false;
	}
	else if (ExtPatt.test(ExtName) == false)
	{
		alert("Extension Name incorrect format. Jr. Sr. III etc are accepted");
		document.getElementById('name_basicExtName').value = "";
		boolExt = false;
		document.getElementById('name_basicExtName').focus();
		//return false;
	}
	else
	{
		boolExt = true;
	}
	enableNext();
}

function validateContact() 
{
	var contact = document.forms["myForm"]["name_basic_contactNumber[]"].value;
	var ContactPatt = new RegExp(/^\S([0-9\\]+){6,14}$/g);
	if (ContactPatt.test(contact) == false)
    {
		alert("Contact number invalid format");
    	document.getElementById('name_basic_contactNumber[]').setAttribute('placeholder',"You cannot leave this blank!");
    	document.getElementById('name_basic_contactNumber[]').value = "";
    	boolContact = false;
		document.getElementById('name_basic_contactNumber[]').focus();
		//return false;
    }
   	else
   	{
   		boolContact = true;
   	}
	enableNext();
}

function validateContact2() 
{
	//boolContact = false;
	var contact = document.forms["myForm"]["name_basic_contactNumber2[]"].value;
	var ContactPatt = new RegExp(/^\S([0-9\\]+){6,14}$/g);
	if (ContactPatt.test(contact) == false)
    {
		alert("Contact number invalid format.");
    	document.getElementById('name_basic_contactNumber2[]').setAttribute('placeholder',"You cannot leave this blank!");
    	document.getElementById('name_basic_contactNumber2[]').value = "";
    	boolContact2 = false;
		document.getElementById('name_basic_contactNumber2[]').focus();
		//return false;
    }
   	else
   	{
   		boolContact2 = true;
   	}
	enableNext();
}


function disable()
{
	//document.getElementById('basicNext').setAttribute('disabled',true);
	boolContact2 = false;
	enableNext();
}

function enableButton()
{
	//document.getElementById('basicNext').setAttribute('disabled',true);
	boolContact2 = true;
	enableNext();
}

// /^\S([A-Za-z0-9-',.\\\s]+)$/g   - address

function enableNext()
{
	
	if(boolContact2 == true && boolImage == true && boolLast == true && boolFirst == true && boolMiddle == true && boolExt == true && boolContact == true)
	{
    	document.getElementById('basicNext').disabled = false; //open
    	//return false;
    }
    else
    {
    	document.getElementById('basicNext').disabled = true; //close
    }
}


// End of validation for Basic Info --------------------------------------------------------
// start of validation for Personal Info --------------------------------------------------------

var boolMonth = false; 	var boolBplace = false;		var boolCivil = false;
var boolDay = false; 	var boolHeight = false;		var boolReligion = false;
var boolYear = false;	var boolWeight = false;		var boolNationality = false;

function validateMonth()
{
	var month = document.forms["myForm"]["month"].value;
	if(month >= 1 || month <=12)
	{
		boolMonth = true;
	}
	else
	{
		alert('Please select your Birth Month.');
		document.getElementById('month').value = "Month";
		boolMonth = false;
	}
	enablePersonalNext();
}

function validateDay()
{
	var day = document.forms["myForm"]["day"].value;
	if(day >= 1 || day <=31)
	{
		boolDay = true;
	}
	else
	{
		alert('Please select your Birth Day.');
		document.getElementById('day').value = "Day";
		boolDay = false;
	}
	enablePersonalNext();
}

function validateYear()
{
	var year = document.forms["myForm"]["year"].value;
	var d = new Date();
	var n = d.getFullYear();
	var ok = n-year;
	if(ok <18)
	{
		boolYear = false;
		alert("Sorry, you're too young for our job offers.");
		document.getElementById('year').value = "Year";
	}
	else if (ok > 65)
	{
		boolYear = false;
		alert("Thank you for your interest but you're over the age limit of 65.");
		document.getElementById('year').value = "Year";
	}
	else
	{
		boolYear = true;
	}
	enablePersonalNext();
}

function validateBplace() 
{
	var Bplace = document.forms["myForm"]["name_personalPlaceOfBirth"].value;
	var BplacePatt = new RegExp(/^\S([A-Za-z0-9-',.\\\s]+)$/g );
	if (BplacePatt.test(Bplace) == false)
	{
		alert("Birth place invalid format.");
		document.getElementById('name_personalPlaceOfBirth').value = "";
		document.getElementById('name_personalPlaceOfBirth').setAttribute('placeholder',"You cannot leave this blank!");
		boolBplace = false;
		document.getElementById('name_personalPlaceOfBirth').focus();
			//return false;
    }
	else
   	{
   		boolBplace = true;
   	}
	enablePersonalNext();
}

function validateHeight() 
{
	var Height = document.forms["myForm"]["name_personalHeight"].value;
	var HeightPatt = new RegExp(/^([0-9.\\]+)$/g );
	if (HeightPatt.test(Height) == false)
	{
		alert("Height must be an integer or a decimal only.");
		document.getElementById('name_personalHeight').value = "";
		document.getElementById('name_personalHeight').setAttribute('placeholder',"Don't leave this blank!");
		boolHeight = false;
		document.getElementById('name_personalHeight').focus();
			//return false;
    }
	else if(Height >= 4)
	{
		alert("Wow you're too tall for your age.");
		document.getElementById('name_personalHeight').value = "";
		document.getElementById('name_personalHeight').setAttribute('placeholder',"Don't leave this blank!");
		boolHeight = false;
		document.getElementById('name_personalHeight').focus();
	}
	else if(Height == 0)
	{
		alert("Oops 0 is not allowed.");
		document.getElementById('name_personalHeight').value = "";
		document.getElementById('name_personalHeight').setAttribute('placeholder',"Don't leave this blank!");
		boolHeight = false;
		document.getElementById('name_personalHeight').focus();
	}
	else
   	{
   		boolHeight = true;
   	}
	enablePersonalNext();
}

function validateWeight() 
{
	var Weight = document.forms["myForm"]["name_personalWeight"].value;
	var WeightPatt = new RegExp(/^([0-9.\\]+)$/g );
	if (WeightPatt.test(Weight) == false)
	{
		alert("Weight must be an integer or a decimal only.");
		document.getElementById('name_personalWeight').value = "";
		document.getElementById('name_personalWeight').setAttribute('placeholder',"Don't leave this blank!");
		boolWeight = false;
		document.getElementById('name_personalWeight').focus();
			//return false;
    }
	else if (Weight >= 200)
	{
		alert("Wow! You're too heavy for your looks.");
		document.getElementById('name_personalWeight').value = "";
		document.getElementById('name_personalWeight').setAttribute('placeholder',"Don't leave this blank!");
		boolWeight = false;
		document.getElementById('name_personalWeight').focus();
			//return false;
    }
	else
   	{
   		boolWeight = true;
   	}
	enablePersonalNext();
}

function validateCivil()
{
	var civil = document.forms["myForm"]["name_personalCivilStatus"].value;
	if(civil != "Select Civil Status")
	{
		boolCivil = true;
	}
	else
	{
		boolCivil = false;
		alert("Please select civil status from the dropdown.");
	}
	enablePersonalNext();
}

function validateReligion()
{
	var Religion = document.forms["myForm"]["name_personalSearchReligion"].value;
	if(Religion == "Select Religion")
	{
		boolReligion = false;
		//alert("Religions.");
		//validateReligionOthers(); 
		
		
	}
	else if(Religion == "Others")
	{
		boolReligion = false;
		if (document.getElementById("name_personalSearchReligion").value == "Others") 
		{
			{
				document.getElementById("name_personalReligionOthers").disabled = false;
				document.getElementById("name_personalReligionOthers").setAttribute('placeholder',"Please specify Religion");
				document.getElementById("name_personalSearchReligion").disabled = true;
				document.getElementById("SelectReligionFromList").style.display = "block";
			}
				
				
				
			function enableListReligion()
			{
				document.getElementById("name_personalReligionOthers").disabled = true;
				document.getElementById("name_personalSearchReligion").disabled = false;
				document.getElementById("name_personalSearchReligion").selectedIndex = 0;
				document.getElementById("SelectReligionFromList").style.display = "none";
				document.getElementById("name_personalReligionOthers").setAttribute('placeholder',"Others, please specify");
				document.getElementById("name_personalReligionOthers").value = "";
				boolReligion = false;
			}
		}
				
		//validateReligionOthers();
		//alert("Religion Others.");
	}
	else
	{
		boolReligion = true;
	}
	enablePersonalNext();
}

function validateReligionOthers() 
{
	boolReligion = false;
	var ReligionOthers = document.forms["myForm"]["name_personalReligionOthers"].value;
	var ReligionOthersPatt = new RegExp(/^\S([A-Za-z-'\\\s]+)$/g);
	if (ReligionOthersPatt.test(ReligionOthers) == false)
	{
		
			document.getElementById('name_personalReligionOthers').setAttribute('placeholder',"Don't leave this blank!");
			document.getElementById('name_personalReligionOthers').setAttribute('value','');
			boolReligion = false;
			alert("Input for Religion is invalid in format.");
			document.getElementById('name_personalReligionOthers').focus();
			//return false;
    }
	else
   	{
   		boolReligion = true;
   	}
	enablePersonalNext();
}
  

 function validateNationality()
{
	var Nationality = document.forms["myForm"]["name_personalSearchNationality"].value;
	if(Nationality == "Select Nationality")
	{
		boolNationality = false;
		//alert("Religions.");
		//validateReligionOthers(); 
		
		
	}
	else if(Nationality == "Others")
	{
		boolNationality = false;
		if (document.getElementById("name_personalSearchNationality").value == "Others") 
		{
			{
				document.getElementById("name_personalNationalityOthers").disabled = false;
				document.getElementById("name_personalNationalityOthers").setAttribute('placeholder',"Please specify Nationality");
				document.getElementById("name_personalSearchNationality").disabled = true;
				document.getElementById("SelectNationalityFromList").style.display = "block";
			}	
				
				
			function enableListNationality()
			{
				document.getElementById("name_personalNationalityOthers").disabled = true;
				document.getElementById("name_personalSearchNationality").disabled = false;
				document.getElementById("name_personalSearchNationality").selectedIndex = 0;
				document.getElementById("name_personalNationalityOthers").setAttribute('placeholder',"Others, please specify");
				document.getElementById("SelectNationalityFromList").style.display = "none";
				document.getElementById("name_personalNationalityOthers").value = "";
				boolNationality = false;
			}
		}
	}
	else
	{
		boolNationality = true;
	}
	enablePersonalNext();
}


function validateNationalityOthers() 
{
	boolNationality = false;
	var NationOthers = document.forms["myForm"]["name_personalNationalityOthers"].value;
	var NationOthersPatt = new RegExp(/^\S([A-Za-z-'\\\s]+)$/g);
	if (NationOthersPatt.test(NationOthers) == false)
	{
		
			document.getElementById('name_personalNationalityOthers').setAttribute('placeholder',"Don't leave this blank!");
			document.getElementById('name_personalNationalityOthers').setAttribute('value','');
			boolNationality = false;
			alert("Input for Religion is invalid in format.");
			document.getElementById('name_personalNationalityOthers').focus();
			//return false;
    }
	else
   	{
   		boolNationality = true;
   	}
	enablePersonalNext();
}



function enablePersonalNext()
{
	
	if(boolMonth == true && boolDay == true && boolYear == true 
		&& boolBplace == true && boolHeight == true && boolWeight == true
		&& boolCivil == true && boolReligion == true && boolNationality == true  )
	{
    	document.getElementById('personalNext').disabled = false; //open
    	//return false;
    }
    else
    {
    	document.getElementById('personalNext').disabled = true; //close
    }
}

// End of validation for Personal Info --------------------------------------------------------
// Start of validation for Language Spoken --------------------------------------------------------
	var boolLang = false;

function addLang()
{
	//alert("Enterd");
	var Langua = document.forms["langForm"]["name_jobPostingLanguageOthers"].value;
	//alert(Langua);
	var LanguaPatt = new RegExp(/^\S([A-Za-z\\\s]+)$/g );
	if (LanguaPatt.test(Langua) == false)
	{
			//alert("malie");
			document.getElementById('name_jobPostingLanguageOthers').setAttribute('placeholder',"Don't leave this blank!");
			document.getElementById('name_jobPostingLanguageOthers').setAttribute('value','');
			//boolAddLang = false;
			document.getElementById('name_jobPostingLanguageOthersAdd').disabled = true;
			alert("Language input is invalid in format!");
			document.getElementById('name_jobPostingLanguageOthers').focus();
			//return false;
    }
	else
   	{
   		document.getElementById('name_jobPostingLanguageOthersAdd').disabled = false;
   	}
}	

	

// End of validation for Language Spoken --------------------------------------------------------
// Start of validation for address  --------------------------------------------------------

var boolAddBlock = true;		var boolAddBrgy = false; 		var boolProvince = false;
var boolAddStreet = false;		var boolAddDistrict = true;		var boolCountry = false;
var boolAddSubdivision = true;	var boolCity = false;			var boolZip = false;


function validateAddBlock() 
{
	var AddBlock = document.forms["myForm"]["name_addBlock"].value;
	var AddBlockPatt = new RegExp(/^([0-9A-Za-z.,\\\s]+)$/g );
	
	if (AddBlockPatt.test(AddBlock) == false)
	{
		
			//document.getElementById('name_addBlock').setAttribute('placeholder',"Don't leave this blank!");
			alert("Input invalid format.");
			document.getElementById('name_addBlock').value = "";
			boolAddBlock = true;
			document.getElementById('name_addBlock').focus();
			//return false;
	}
	else
	{
		boolAddBlock = true;
	}
		
	enableDemographicNext();
}

function validateAddStreet() 
{
	var AddStreet = document.forms["myForm"]["name_addStreet"].value;
	var AddStreetPatt = new RegExp(/^([0-9A-Za-z.,\\\s]+)$/g );
	if (AddStreetPatt.test(AddStreet) == false)
	{
		
			document.getElementById('name_addStreet').setAttribute('placeholder',"Don't leave this blank!");
			alert("Input invalid format.");
			document.getElementById('name_addStreet').value = "";
			boolAddStreet = false;
			document.getElementById('name_addStreet').focus();
			//return false;
    }
	else
   	{
   		boolAddStreet = true;
   	}
	enableDemographicNext();
}

function validateAddSubdivision() 
{
	var AddSub = document.forms["myForm"]["name_addSubdivision"].value;
	var AddSubPatt = new RegExp(/^([0-9A-Za-z.,\\\s]+)$/g );
	if (AddSubPatt.test(AddSub) == false)
	{
		alert("Input invalid format.");
		document.getElementById('name_addSubdivision').value = "";
		//document.getElementById('name_addSubdivision').setAttribute('placeholder',"Don't leave this blank!");
		boolAddSubdivision = true;
		document.getElementById('name_addSubdivision').focus();
			//return false;
	}
	else
	{
		boolAddSubdivision = true;
	}
		
	enableDemographicNext();
}

function validateAddBarangay() 
{
	var AddBarangay = document.forms["myForm"]["name_addBrgy"].value;
	var AddBrgyPatt = new RegExp(/^([0-9A-Za-z.,\\\s]+)$/g );
	if (AddBrgyPatt.test(AddBarangay) == false)
	{
		alert("Input for Barangay is invalid format.");
		document.getElementById('name_addBrgy').value = "";
		document.getElementById('name_addBrgy').setAttribute('placeholder',"Don't leave this blank!");
		boolAddBrgy = false;
		document.getElementById('name_addBrgy').focus();
		//return false;
	}
	else
	{
		boolAddBrgy = true;
	}
		
	enableDemographicNext();
}

function validateAddDistrict() 
{
	var AddDist = document.forms["myForm"]["name_addDistrict"].value;
	var AddDistPatt = new RegExp(/^([0-9A-Za-z.,\\\s]+)$/g );
	if (AddDistPatt.test(AddDist) == false)
	{
		alert("Input for District is invalid format.");
		document.getElementById('name_addDistrict').value = "";
		//document.getElementById('name_addSubdivision').setAttribute('placeholder',"Don't leave this blank!");
		boolAddDistrict = true;
		document.getElementById('name_addDistrict').focus();
			//return false;
	}
	else
	{
		boolAddDistrict = true;
	}
		
	enableDemographicNext();
}

function validateAddCity() 
{
	var AddCity = document.forms["myForm"]["name_addCity"].value;
	var AddCityPatt = new RegExp(/^\S([A-Za-z\\\s]+)$/g );
	if (AddCityPatt.test(AddCity) == false)
	{
		alert("Input for City is invalid format.");
		document.getElementById('name_addCity').value = "";
		document.getElementById('name_addCity').setAttribute('placeholder',"Don't leave this blank!");
		boolCity = false;
		document.getElementById('name_addCity').focus();
		//return false;
	}
	else
	{
		boolCity = true;
	}
		
	enableDemographicNext();
}

function validateAddProvince() 
{
	var AddProvince = document.forms["myForm"]["name_addProvince"].value;
	var AddProvincePatt = new RegExp(/^\S([A-Za-z\\\s]+)$/g );
	if (AddProvincePatt.test(AddProvince) == false)
	{
		alert("Input for Province is invalid format.");
		document.getElementById('name_addProvince').value = "";
		document.getElementById('name_addProvince').setAttribute('placeholder',"Don't leave this blank!");
		boolProvince = false;
		document.getElementById('name_addProvince').focus();
		//return false;
	}
	else
	{
		boolProvince = true;
	}
		
	enableDemographicNext();
}

function validateAddCountry() 
{
	var AddCountry = document.forms["myForm"]["name_addCountry"].value;
	var AddCountryPatt = new RegExp(/^\S([A-Za-z\\\s]+)$/g );
	if (AddCountryPatt.test(AddCountry) == false)
	{
		alert("Input for Country is invalid format.");
		document.getElementById('name_addCountry').value = "";
		document.getElementById('name_addCountry').setAttribute('placeholder',"Don't leave this blank!");
		boolCountry = false;
		document.getElementById('name_addCountry').focus();
		//return false;
	}
	else
	{
		boolCountry = true;
	}
		
	enableDemographicNext();
}

function validateAddZip() 
{
	var AddZip = document.forms["myForm"]["name_addZipCode"].value;
	var AddZipPatt = new RegExp(/^\S([0-9\\\s]+){3,3}$/g );
	if (AddZipPatt.test(AddZip) == false)
	{
		alert("Input for Zip Code is invalid format.");
		document.getElementById('name_addZipCode').value = "";
		document.getElementById('name_addZipCode').setAttribute('placeholder',"Zip!");
		boolZip = false;
		document.getElementById('name_addZipCode').focus();
		//return false;
	}
	else
	{
		boolZip = true;
	}
		
	enableDemographicNext();
}

function enableDemographicNext()
{
	
	if(boolAddBlock == true && boolAddStreet == true  && boolAddSubdivision == true
	&& boolAddBrgy == true && boolAddDistrict == true && boolCity == true
	&& boolProvince == true && boolCountry == true	 && boolZip == true	)
	{
    	document.getElementById('demographicNext').disabled = false; //open
    	//return false;
    }
    else
    {
    	document.getElementById('demographicNext').disabled = true; //close
    }
}


// End of validation for address -----------------------------------------------------------

// Start Validation for Family Background ---------------------------------

var boolSpouse = true;		var boolChild = true;	var boolCivilStat = true;	var boolMother = false;		var boolNotifAdd = false;
var boolSpouseAdd = true;	var boolAge = true; 	var boolFather = false;		var boolMotherOcc = true;	var boolNotifCont = false;
var boolSpouseOcc = true;	var boolGender = true;	var boolFatherOcc = true;	var boolNotifName = false;


function validateSpouse()
{
	
	var AddSpouse = document.forms["myForm"]["name_appInfoNameOfSpouse"].value;
	var AddSpousePatt = new RegExp(/^\S([A-Za-z-'\\\s]+)$/g);
	if (AddSpousePatt.test(AddSpouse) == false)
	{
		alert("Input for Spouse is invalid format.");
		document.getElementById('name_appInfoNameOfSpouse').value = "";
		//document.getElementById('name_appInfoNameOfSpouse').setAttribute('placeholder',"Don't leave this blank!");
		boolSpouse = true;
		document.getElementById('name_appInfoNameOfSpouse').focus();
		//return false;
	}
	else
	{
		boolSpouse = true;
	}
		
	enableFamilyNext();
}

function validateSpouseAddress()
{
	var AddSpouseAdd = document.forms["myForm"]["name_appInfoSpouseAddress"].value;
	var AddSpouseAddPatt = new RegExp(/^\S([A-Za-z0-9-',.\\\s]+)$/g);
	if (AddSpouseAddPatt.test(AddSpouseAdd) == false)
	{
		alert("Input for Spouse  Address is invalid format.");
		document.getElementById('name_appInfoSpouseAddress').value = "";
		//document.getElementById('name_appInfoSpouseAddress').setAttribute('placeholder',"Don't leave this blank!");
		boolSpouseAdd = true;
		document.getElementById('name_appInfoSpouseAddress').focus();
		//return false;
	}
	else
	{
		boolSpouseAdd = true;
	}
		
	enableFamilyNext();
}

function validateSpouseOcc()
{
	var AddSpouseAdd = document.forms["myForm"]["name_appInfoSpouseOccupation"].value;
	var AddSpouseAddPatt = new RegExp(/^\S([A-Za-z-'\\\s]+)$/g);
	if (AddSpouseAddPatt.test(AddSpouseAdd) == false)
	{
		alert("Input for Spouse  Occupation is invalid format.");
		document.getElementById('name_appInfoSpouseOccupation').value = "";
		//document.getElementById('name_appInfoSpouseAddress').setAttribute('placeholder',"Don't leave this blank!");
		boolSpouseOcc = true;
		document.getElementById('name_appInfoSpouseOccupation').focus();
		//return false;
	}
	else
	{
		boolSpouseOcc = true;
	}
		
	enableFamilyNext();
}

function validateChildName()
{
	var AddChildName = document.forms["myForm"]["name_appInfoNameOfChild[]"].value;
	var AddChildNamePatt = new RegExp(/^\S([A-Za-z-'\\\s]+)$/g);
	if (AddChildNamePatt.test(AddChildName) == false)
	{
		alert("Input for Child Name is invalid format.");
		document.getElementById('name_appInfoNameOfChild[]').value = "";
		//document.getElementById('name_appInfoSpouseAddress').setAttribute('placeholder',"Don't leave this blank!");
		boolChild = true;
		document.getElementById('name_appInfoNameOfChild[]').focus();
		//return false;
	}
	else
	{
		boolChild = true;
	}
		
	enableFamilyNext();
}

function validateChildAge()
{
	var AddChildAge = document.forms["myForm"]["name_appInfoAgeOfChild[]"].value;
	var AddChildAgePatt = new RegExp(/^([0-9\\]+){1,}$/g);
	if (AddChildAgePatt.test(AddChildAge) == false)
	{
		alert("Input for Child Age is invalid format.");
		document.getElementById('name_appInfoAgeOfChild[]').value = "";
		//document.getElementById('name_appInfoSpouseAddress').setAttribute('placeholder',"Don't leave this blank!");
		boolAge = true;
		document.getElementById('name_appInfoAgeOfChild[]').focus();
		//return false;
	}
	else
	{
		boolAge = true;
	}
		
	enableFamilyNext();
}

function childCivilStatus()
{
	var civilStat = document.forms["myForm"]["name_appInfoCivilStatusOfChild[]"].value;
	//alert (civilStat);
	if(civilStat == "")
	{
		boolCivilStat = true;
		alert("Please select civil status from the dropdown.");
	}
	else
	{
		boolCivilStat = true;
		
	}
		
	enableFamilyNext();
}

function validateFatherName()
{
	var AddFatherName = document.forms["myForm"]["name_appInfoNameOfFather"].value;
	var AddFatherNamePatt = new RegExp(/^\S([A-Za-z-'\\\s]+)$/g);
	if (AddFatherNamePatt.test(AddFatherName) == false)
	{
		alert("Input for Father Name is invalid format.");
		document.getElementById('name_appInfoNameOfFather').value = "";
		document.getElementById('name_appInfoNameOfFather').setAttribute('placeholder',"Don't leave this blank!");
		boolFather = false;
		document.getElementById('name_appInfoNameOfFather').focus();
		//return false;
	}
	else
	{
		boolFather = true;
	}
		
	enableFamilyNext();
}

function validateFatherOcc()
{
	var AddFatherOcc = document.forms["myForm"]["name_appInfoOccupationOfFather"].value;
	var AddFatherOccPatt = new RegExp(/^\S([A-Za-z-'\\\s]+)$/g);
	if (AddFatherOccPatt.test(AddFatherOcc) == false)
	{
		alert("Input for Father Occupation is invalid format.");
		document.getElementById('name_appInfoOccupationOfFather').value = "";
		//document.getElementById('name_appInfoOccupationOfFather').setAttribute('placeholder',"Don't leave this blank!");
		boolFatherOcc = true;
		document.getElementById('name_appInfoOccupationOfFather').focus();
		//return false;
	}
	else
	{
		boolFatherOcc = true;
	}
		
	enableFamilyNext();
}

function validateMotherName()
{
	var AddMotherOcc = document.forms["myForm"]["name_appInfoNameOfMother"].value;
	var AddMotherOccPatt = new RegExp(/^\S([A-Za-z-'\\\s]+)$/g);
	if (AddMotherOccPatt.test(AddMotherOcc) == false)
	{
		alert("Input for Mother Name is invalid format.");
		document.getElementById('name_appInfoNameOfMother').value = "";
		document.getElementById('name_appInfoNameOfMother').setAttribute('placeholder',"Don't leave this blank!");
		boolMother = false;
		document.getElementById('name_appInfoNameOfMother').focus();
		//return false;
	}
	else
	{
		boolMother = true;
	}
		
	enableFamilyNext();
}

function validateMotherOcc()
{
	var AddMotherOcc = document.forms["myForm"]["name_appInfoOccupationOfMother"].value;
	var AddMotherOccPatt = new RegExp(/^\S([A-Za-z-'\\\s]+)$/g);
	if (AddMotherOccPatt.test(AddMotherOcc) == false)
	{
		alert("Input for Mother Occupation is invalid format.");
		document.getElementById('name_appInfoOccupationOfMother').value = "";
		//document.getElementById('name_appInfoOccupationOfMother').setAttribute('placeholder',"Don't leave this blank!");
		boolFatherOcc = true;
		document.getElementById('name_appInfoOccupationOfMother').focus();
		//return false;
	}
	else
	{
		boolFatherOcc = true;
	}
		
	enableFamilyNext();
}

function validateNotifName()
{
	var AddNotifName = document.forms["myForm"]["name_appInfoEmergencyContactPerson"].value;
	var AddNotifNamePatt = new RegExp(/^\S([A-Za-z-'\\\s]+)$/g);
	if (AddNotifNamePatt.test(AddNotifName) == false)
	{
		alert("Input for Emergency Contact Name is invalid format.");
		document.getElementById('name_appInfoEmergencyContactPerson').value = "";
		document.getElementById('name_appInfoEmergencyContactPerson').setAttribute('placeholder',"Don't leave this blank!");
		boolNotifName = false;
		document.getElementById('name_appInfoEmergencyContactPerson').focus();
		//return false;
	}
	else
	{
		boolNotifName = true;
	}
		
	enableFamilyNext();
}

function validateNotifAdd()
{
	var AddNotifAdd = document.forms["myForm"]["name_appInfoAddressOfContactPerson"].value;
	var AddNotifAddPatt = new RegExp(/^\S([A-Za-z0-9-',.#\\\s]+)$/g);
	if (AddNotifAddPatt.test(AddNotifAdd) == false)
	{
		alert("Input for Emergency Contact Address is invalid format.");
		document.getElementById('name_appInfoAddressOfContactPerson').value = "";
		document.getElementById('name_appInfoAddressOfContactPerson').setAttribute('placeholder',"Don't leave this blank!");
		boolNotifAdd = false;
		document.getElementById('name_appInfoAddressOfContactPerson').focus();
		//return false;
	}
	else
	{
		boolNotifAdd = true;
	}
		
	enableFamilyNext();
}

function validateNotifCont()
{
	var AddNotifCont = document.forms["myForm"]["name_appInfoContactNumberOfContactPerson"].value;
	var AddNotifContPatt = new RegExp(/^\S([0-9-',.#\\\s]+){6,}$/g);
	if (AddNotifContPatt.test(AddNotifCont) == false)
	{
		alert("Input for Emergency Contact Number is invalid format.");
		document.getElementById('name_appInfoContactNumberOfContactPerson').value = "";
		document.getElementById('name_appInfoContactNumberOfContactPerson').setAttribute('placeholder',"Don't leave this blank!");
		boolNotifCont = false;
		document.getElementById('name_appInfoContactNumberOfContactPerson').focus();
		//return false;
	}
	else
	{
		boolNotifCont = true;
	}
		
	enableFamilyNext();
}

function enableFamilyNext()
{
	
	if(boolSpouse == true && boolSpouseAdd == true  && boolSpouseOcc == true
	&& boolChild == true && boolAge == true && boolGender == true
	&& boolCivilStat == true && boolFather == true	 && boolFatherOcc == true
	&& boolMother == true && boolMotherOcc == true && boolNotifName == true
	&& boolNotifAdd == true && boolNotifCont == true)
	{
    	document.getElementById('familyNext').disabled = false; //open
    	//return false;
    }
    else
    {
    	document.getElementById('familyNext').disabled = true; //close
    }
}



// End Validation for family Background -----------------------------------
// Start validation for insurance

var boolBenName = false;	var boolBenMonth = false;
var boolBenAdd = false;		var boolBenDay = false;		var boolBenCivil = false;
var boolBenRel = false;		var boolBenYear = false;

function ValidateBenName()
{
	var AddBenName = document.forms["insuranceForm"]["name_appInfoBenifeciaryName"].value;
	var AddBenNamePatt = new RegExp(/^\S([A-Za-z-'\\\s]+)$/g);
	if (AddBenNamePatt.test(AddBenName) == false)
	{
		alert("Input for Beneficiary Name is invalid format.");
		document.getElementById('name_appInfoBenifeciaryName').value = "";
		document.getElementById('name_appInfoBenifeciaryName').setAttribute('placeholder',"Don't leave this blank!");
		boolBenName = false;
		document.getElementById('name_appInfoBenifeciaryName').focus();
		//return false;
	}
	else
	{
		boolBenName = true;
	}
	//alert(boolBenName);
	enableInsuranceNext();
}

function ValidateBenAdd()
{
	var AddBenAdd = document.forms["insuranceForm"]["name_appInfoBenificiaryAddress"].value;
	var AddBenAddPatt = new RegExp(/^\S([A-Za-z0-9-',.\\\s]+)$/g);
	if (AddBenAddPatt.test(AddBenAdd) == false)
	{
		alert("Input for Beneficiary Name is invalid format.");
		document.getElementById('name_appInfoBenificiaryAddress').value = "";
		document.getElementById('name_appInfoBenificiaryAddress').setAttribute('placeholder',"Don't leave this blank!");
		boolBenAdd = false;
		document.getElementById('name_appInfoBenificiaryAddress').focus();
		//return false;
	}
	else
	{
		boolBenAdd = true;
	}
	//alert(boolBenAdd);	
	enableInsuranceNext();
}

function ValidateBenRel()
{
	var AddBenRel = document.forms["insuranceForm"]["name_appInfoBenificiaryRelationship"].value;
	var AddBenRelPatt = new RegExp(/^\S([A-Za-z\\\s]+)$/g);
	if (AddBenRelPatt.test(AddBenRel) == false)
	{
		alert("Input for Beneficiary Name is invalid format.");
		document.getElementById('name_appInfoBenificiaryRelationship').value = "";
		document.getElementById('name_appInfoBenificiaryRelationship').setAttribute('placeholder',"Don't leave this blank!");
		boolBenRel = false;
		document.getElementById('name_appInfoBenificiaryRelationship').focus();
		//return false;
	}
	else
	{
		boolBenRel = true;
	}
	//alert(boolBenRel);	
	enableInsuranceNext();
}

function ValidateBenMonth()
{
	var month = document.forms["insuranceForm"]["month"].value;
	if(month >= 1 || month <=12)
	{
		boolBenMonth = true;
	}
	else
	{
		alert('Please select Birth Month.');
		document.getElementById('month').value = "Month";
		boolBenMonth = false;
	}
	//alert(boolBenMonth);	
	enableInsuranceNext();
}

function ValidateBenDay()
{
	var day = document.forms["insuranceForm"]["day"].value;
	if(day >= 1 || day <=31)
	{
		boolBenDay = true;
	}
	else
	{
		alert('Please select Birth Day.');
		document.getElementById('day').value = "Day";
		boolBenDay = false;
	}
	//alert(boolBenDay);
	enableInsuranceNext();
}

function ValidateBenYear()
{
	var year = document.forms["insuranceForm"]["year"].value;
	var d = new Date();
	var n = d.getFullYear();
	var ok = n-year;
	if(year == "Year")
	{
		alert('Please select Birth Year.');
		document.getElementById('year').value = "Year";
		boolBenYear = false;
	}
	else
	{
		boolBenYear = true;
	}
	//alert(boolBenDay);
	enableInsuranceNext();
}

function ValidateBenCivil()
{
	var BenCivil = document.forms["insuranceForm"]["name_appInfoBenificiaryCivilStatus"].value;
	//alert (BenCivil);
	if(BenCivil == "Select Civil Status")
	{
		boolBenCivil = false;
		alert("Please select civil status from the dropdown.");
	}
	else
	{
		boolBenCivil = true;
		
	}
		
	enableInsuranceNext();
}

function enableInsuranceNext()
{
	
	if(boolBenName == true && boolBenAdd == true && boolBenRel == true	
		&& boolBenMonth == true && boolBenDay == true && boolBenYear == true
		&& boolBenCivil == true)
	{
    	document.getElementById('insuranceNext').disabled = false; //open
    	//return false;
    }
    else
    {
    	document.getElementById('insuranceNext').disabled = true; //close
    }
}

// End Validation for insurance

// validate resume

function validateResume() 
{

	var fup = document.getElementById('uploadResume');
	var fileName = fup.value;
	var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
	if(ext == "PDF" || ext == "pdf")
	{
		//alert(ext);
		//boolImage = true;
		//return true;
	} 
	else
	{
		alert("Invalid file format!");
		document.getElementById('uploadResume').value = "";
		document.getElementById('uploadResume').focus();
		//fup.focus();
		//boolImage = false;
		//return false;
	}
}
