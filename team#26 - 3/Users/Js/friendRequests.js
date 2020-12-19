let accept = (id) => {
	
	let str = "id="+id;
	let xhttp = new XMLHttpRequest();
	
	xhttp.onreadystatechange = function() {
		
		if(this.readyState == 4 && this.status == 200){
			if(this.responseText == ""){
				location.reload(); 
			}
			
		}
	}
	xhttp.open("POST", "Action/acceptRequest.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(str);
	
}

let cancle = (id) => {
	
	let str = "id="+id;
	let xhttp = new XMLHttpRequest();
	
	xhttp.onreadystatechange = function() {
		
		if(this.readyState == 4 && this.status == 200){
			if(this.responseText == ""){
				location.reload(); 
			}
		}
	}
	xhttp.open("POST", "Action/cancleRequest.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(str);
	
}