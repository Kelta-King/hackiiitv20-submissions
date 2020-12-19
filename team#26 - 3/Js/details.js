let img = "Uploads/user.png";

$(document).ready(function(){
	$(document).on('change', '#file', function(){
		
	let name = document.getElementById("file").files[0].name;
	let form_data = new FormData();
	let ext = name.split('.').pop().toLowerCase();
	
	let	oFReader = new FileReader();
	oFReader.readAsDataURL(document.getElementById("file").files[0]);
	let f = document.getElementById("file").files[0];
	let fsize = f.size||f.fileSize;
	
	if(fsize > 2000000){
		
		//more than 2 mb
		alert("Image File Size is very big");
	   
	}
	else{
		form_data.append("file", document.getElementById('file').files[0]);
		$.ajax({
			url:"Upload/upload.php",
			method:"POST",
			data: form_data,
			contentType: false,
			cache: false,
			processData: false,  
			success:function(data){
				document.getElementById('status').innerHTML = "Image uploaded";
				img = data;
			}
		});
	}
	});
});


let join = (email) => {
	
	let  role = document.getElementById('role').value;
	let dob = document.getElementById('dob').value;
	let form = document.getElementById('data');
	let about = document.getElementById('aboutMe').value;
	
	let check_data = new Check();
	
	if(check_data.dobCheck(dob)){
		
		let str = "email="+email+"&role="+role+"&dob="+dob+"&about="+about+"&img="+img;
		let xhttp = new XMLHttpRequest();
		let loader = document.getElementById('loader-details');
		let error = document.getElementById('details-error');
		
		xhttp.onreadystatechange = function() {
            		loader.style.display = "block";
            		if(this.readyState == 4 && this.status == 200){
            			error.innerHTML = this.responseText;
            			loader.style.display = "none";
            			if(this.responseText == ""){
            			
					form.action = "logins.php";
            				form.method = "post";
            				form.submit();
              			}
				else{
					error.innerHTML = this.responseText;
				}
            		}
        	}
        	xhttp.open("POST", "Check/addDetails.php", true);
        	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        	xhttp.send(str);
		
	}
	
}

let joinLogin = (email) => {
	
	let  role = document.getElementById('role').value;
	let dob = document.getElementById('dob').value;
	let form = document.getElementById('data');
	let about = document.getElementById('aboutMe').value;
	
	let check_data = new Check();
	
	if(check_data.dobCheck(dob)){
		
		let str = "email="+email+"&role="+role+"&dob="+dob+"&about="+about+"&img="+img;
		let xhttp = new XMLHttpRequest();
		let loader = document.getElementById('loader-details');
		let error = document.getElementById('details-error');
		
		xhttp.onreadystatechange = function() {
            		loader.style.display = "block";
            		if(this.readyState == 4 && this.status == 200){
            			error.innerHTML = this.responseText;
            			loader.style.display = "none";
            			if(this.responseText == ""){
            			
					form.action = "login.php";
            				form.method = "post";
            				form.submit();
              			}
				else{
					error.innerHTML = this.responseText;
				}
            		}
        	}
        	xhttp.open("POST", "Check/addDetailsLogin.php", true);
        	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        	xhttp.send(str);
		
	}
	
}