let email = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/i;
let emailInput = document.getElementById("email");
emailInput.addEventListener("keyup",()=>{
    if(email.test(emailInput.value) == true){
        emailInput.style.color = "green";
    }else{
        emailInput.style.color = "red";
    }
});

let phone = /^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[789]\d{9}$/i;
let phoneInput = document.getElementById("phone");
phoneInput.addEventListener("keyup",()=>{
    if(phone.test(phoneInput.value) == true){
        phoneInput.style.color = "green";
    }else{
        phoneInput.style.color = "red";
    }
});


let alertPsw = document.getElementById("alertpsw");
let pswInput = document.getElementById("psw");
pswInput.addEventListener("keyup",()=>{
    var strength = 0;

strength += /[A-Z]+/.test(pswInput.value) ? 1 : 0;
strength += /[a-z]+/.test(pswInput.value) ? 1 : 0;
strength += /[0-9]+/.test(pswInput.value) ? 1 : 0;
strength += /[\W]+/.test(pswInput.value) ? 1 : 0;

switch(strength) {
    case 3:
        alertPsw.style.display = "block";
        pswInput.style.color = "orange";
        alertPsw.innerHTML = "Medium";
        alertPsw.style.color = "orange";
        break;
    case 4:
        alertPsw.style.display = "block";
        pswInput.style.color = "green";
        alertPsw.innerHTML = "Strong";
        alertPsw.style.color = "green";
        break;
    default:
        alertPsw.style.display = "block";
        pswInput.style.color = "red";
        alertPsw.innerHTML = "Weak";
        alertPsw.style.color = "red";
        break;
}
});




