const form = document.getElementById("form");
const Firstname = document.getElementById("validationDefault01");
const Lastname = document.getElementById("validationDefault02");
const Mnumber=   document.getElementById("validationDefault03");




Firstname.addEventListener ('change' , e =>{
    checkFirstName();
});
//Validating the Mobile Number
Mnumber.addEventListener ('change' , e =>{
    checkMnumber();
    validateNumber();
});


function checkFirstName(){
    const FirstnameValue = Firstname.value.trim();
    if(	FirstnameValue  === '') {
		setErrorFor(Firstname, 'Username cannot be blank');
       
	} else {
		setSuccessFor(Firstname);
	}

}

function checkMnumber(){
    const MnumberValue = Mnumber.value.trim();
    if(	MnumberValue  === '') {
		setErrorFor(Mnumber, 'Mobile Number cannot be blank');
	} else {
		setSuccessFor(Mnumber);
	}

//check the mobile number is equal to 10
if(	MnumberValue.length  !== 12) {
		setErrorFor(Mnumber, 'Mobile Number must be a 10 digit number with prefix ');
	} else {
		setSuccessFor(Mnumber);
	}  
}




function setErrorFor(input, message) {
	const formControl = input.parentElement;
	const small = formControl.querySelector('small');
	formControl.className = 'formcontrol error';
	small.innerText = message;  
}

function setSuccessFor(input) {
	const formControl = input.parentElement;
	formControl.className = 'formcontrol success';
}

