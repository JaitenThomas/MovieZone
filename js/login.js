/*-------------------------------------------------------------------------------------------------
									THE CONTROLLER FUNCTIONS
--------------------------------------------------------------------------------------------------*/
/*This function submits the request using Ajax or non-Ajax approach
	@requestid: request command the server side code need to execute i.e. add/delete/update/select
	@mode: ajax or non-ajax
*/
function submitRequest(requestid, mode) {
	if (mode == 'ajax') {
		document.loginform.request.value = requestid;
		//this method wrap up all user input into the form data object which can be submitted via POST
		var formdata = new FormData(document.loginform);
	
		var xhttp;    
		xhttp = new XMLHttpRequest();
		xhttp.open("POST", "login.php", true);
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
		
				alert (this.responseText);
				document.location.reload();
			}
		};		
		xhttp.send(formdata);		
	} else {
		document.loginform.request.value = requestid;
		document.loginform.submit();
	}
}
