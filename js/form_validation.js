
 

//Event handlers
function contactChange(event){

    
    var landlineMarker = document.getElementById("landlinemarker");
    var mobileMarker = document.getElementById("mobilemarker");  
    var emailMarker = document.getElementById("emailmarker");    

    var contactMobile = document.getElementById("contactMobile");
    var contactLandline = document.getElementById("contactLandline");  
    var contactEmail = document.getElementById("contactEmail");  
   
    
    //Remove old markers
    mobileMarker.style.visibility = "hidden";
    landlineMarker.style.visibility = "hidden";
    emailMarker.style.visibility = "hidden";   
    
    contactMobile.checked = false;
    contactLandline.checked = false;
    contactEmail.checked = false;
    
    //Show marker in right elements
    switch (event.currentTarget.value) {
        case "mobile":
                document.getElementById("contact_method").value = "mobile";
                mobileMarker.style.visibility = "visible";  
                contactMobile.checked = true;

                break;
        case "landline":
                document.getElementById("contact_method").value = "landline";
                landlineMarker.style.visibility = "visible"; 
                contactLandline.checked = true;       
                break;
        case "email":
                document.getElementById("contact_method").value = "email";
                emailMarker.style.visibility = "visible";    
                contactEmail.checked = true;       
      
                break;                    
    }    
}


function magazineChange(event){
    var streetMarker = document.getElementById("streetmarker");
    var suburbMarker = document.getElementById("suburbmarker");    
    var postcodeMarker = document.getElementById("postcodemarker");            

   

    if(event.currentTarget.checked == true)
    {
        //console.log(event.currentTarget.value);
        //Mark address elements as compulsory
        
        document.getElementById("magazine").value = "1";
          
        //Add markers to all the address elements.
        streetMarker.style.visibility = "visible";
        suburbMarker.style.visibility = "visible";
        postcodeMarker.style.visibility = "visible";            
    }
    else 
    {
        event.currentTarget.value = "no";
        document.getElementById("magazine").value = "0";

        //Unmark address elements as compulsory
        streetMarker.style.visibility = "hidden";
        suburbMarker.style.visibility = "hidden";
        postcodeMarker.style.visibility = "hidden";            
        
        // clear any hilights
        // clearHilight("streetrow");
        // clearHilight("suburbrow");
        // clearHilight("postcoderow");  
    }

}


function validateForm() {

  //console.log('hello?');
  var surname = document.forms["joinform"]["surname"].value;
  if (surname == "") {
    alert("surname must be filled out");
    return false;
  }

  var other_names = document.forms["joinform"]["other_name"].value;
  if (other_names == "") {
    alert("Other names must be filled out");
    return false;
  }

  var other_names = document.forms["joinform"]["other_name"].value;
  if (other_names == "") {
    alert("Other names must be filled out");
    return false;
  }

  if(document.getElementById("contact_method").value == 'email'){
    var email = document.forms["joinform"]["email"].value;
    if (email == "") {
      alert("Email must be filled out");
      return false;
    }
  }

  if(document.getElementById("contact_method").value == 'landline'){
    var landline = document.forms["joinform"]["landline"].value;
    if (landline == "") {
      alert("Landline must be filled out");
      return false;
    }
  }

  if(document.getElementById("contact_method").value == 'mobile'){
    var mobile = document.forms["joinform"]["mobile"].value;
  
    if (mobile == "") {
      alert("Mobile must be filled out");
      return false;
    }
  }



  

  

  var occupation = document.getElementById("occupation");
  if (occupation.options[occupation.selectedIndex].value == 'blank') {
    alert("occupation must be filled out");
    return false;
  }

  var street = document.forms["joinform"]["street"].value;
  if (street == '') {
    alert("Street address must be filled out");
    return false;
  }

  var suburbstate = document.forms["joinform"]["suburb"].value;
  if (suburbstate == '') {
    alert("Suburb and State must be filled out");
    return false;
  }

  var postcode = document.forms["joinform"]["postcode"].value;
  if (postcode == '') {
    alert("Postcode must be filled out");
    return false;
  }

  var username = document.forms["joinform"]["username"].value;
  if (username == '') {
    alert("Username must be filled out");
    return false;
  }

  var password = document.forms["joinform"]["password"].value;
  if (password == '') {
    alert("Password must be filled out");
    return false;
  }

  var verifypass = document.forms["joinform"]["verifypass"].value;
  if (verifypass == '') {
    alert("Verify password must be filled out");
    return false;
  }

  if(verifypass != password){
    alert("Passwords must match");
    return false;
  }

  var formData = new FormData(document.joinform);
  formData.set('magazine', document.getElementById('magazine').value)

  
  makeAjaxPostRequest('movie_zone_main.php','cmd_member_sign_up', formData, success, false, true);
  function success(data) 
    {
      //location.href = "index.php";
      document.getElementById("id_error").innerHTML = data;  
    }

}

