const form = document.querySelector(".login form"),
continueBtn = form.querySelector(".button input"),
loaderarea = form.querySelector(".loaderarea"),
errorText = form.querySelector(".errortext");

form.onsubmit = (e)=>{
    e.preventDefault(); //preventing form from reloading;
}

continueBtn.onclick = ()=>{
  loaderarea.style.display = "block";
  continueBtn.style.display = "none";
  //--- AJAX ---
  let xhr = new XMLHttpRequest(); // creating XML Object
  xhr.open("POST", "php/login.php", true);
  xhr.onload = ()=>{
    if(xhr.readyState === XMLHttpRequest.DONE){
        if(xhr.status === 200){
            let data = xhr.response;
            if(data === "success"){
             location.href="user.php";
            }
            else{
              loaderarea.style.display = "none";
              continueBtn.style.display = "block";
              errorText.style.display = "block";
              errorText.textContent = data;
              window.scrollTo(0, 0);
            }
        }
    }
  }
  // sending form data through ajax to php
  let formData = new FormData(form); //creating form object
  xhr.send(formData);  //sending the form data to php
}