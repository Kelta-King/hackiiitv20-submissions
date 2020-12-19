let sendRequest = (id) => {
	
	let str = "id="+id;
	let xhttp = new XMLHttpRequest();
	
	xhttp.onreadystatechange = function() {
		
		if(this.readyState == 4 && this.status == 200){
			if(this.responseText == ""){
				location.reload(); 
			}
			
		}
	}
	xhttp.open("POST", "Action/sendRequest.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(str);
	
}

let startChat = (id) => {
	
	let str = "id="+id;
	let xhttp = new XMLHttpRequest();
	
	xhttp.onreadystatechange = function() {
		
		if(this.readyState == 4 && this.status == 200){
			if(this.responseText.length >= 10){
				window.open(this.responseText, "_self");
			}
			else{
				alert(this.responseText);
			}
			
		}
	}
	xhttp.open("POST", "Action/startIndiChat.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(str);
	
}