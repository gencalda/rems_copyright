// Start validation for insurance

var boolBenName = false;	var boolBenMonth = false;	var boolBenGender = false;
var boolBenAdd = false;		var boolBenDay = false;		var boolBenCivil = false;
var boolBenRel = false;		var boolBenYear = false;

function ValidateBenName()
{
	var AddBenName = document.forms["insuranceForm"]["name_appInfoBeneficiaryName"].value;
	var AddBenNamePatt = new RegExp(/^\S([A-Za-z-'\\\s]+)$/g);
	if (AddBenNamePatt.test(AddBenName) == false)
	{
		alert("Input for Beneficiary Name is invalid format.");
		document.getElementById('name_appInfoBeneficiaryName').value = "";
		document.getElementById('name_appInfoBeneficiaryName').setAttribute('placeholder',"Don't leave this blank!");
		boolBenName = false;
		document.getElementById('name_appInfoBeneficiaryName').focus();
		//return false;
	}
	else
	{
		boolBenName = true;
	}
		
	enableInsuranceNext();
}



function enableInsuranceNext()
{
	
	if(boolBenName == true && boolBenAdd == true && boolBenRel == true	
		&& boolBenMoth == true && boolBenDay == true && boolBenYear == true
		&& boolBenGender == true && boolBenCivil == true)
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


