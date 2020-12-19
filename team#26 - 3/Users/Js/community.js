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
			url:"Needs/upload.php",
			method:"POST",
			data: form_data,
			contentType: false,
			cache: false,
			processData: false,  
			success:function(data){
				document.getElementById('post_data').innerHTML += data;
			}
		});
	}
	});
});

let addPost = (c_id) => {
	
	let data = document.getElementById("post_data").innerHTML;
	let str = "c_id="+c_id+"&data="+data;
	let error = document.getElementById('post-error');
	
	let xhttp = new XMLHttpRequest();
	let loader = document.getElementById('post-loader');
	
	xhttp.onreadystatechange = function() {
		loader.style.display = "block";
		if(this.readyState == 4 && this.status == 200){
			
			error.innerHTML = this.responseText;
			loader.style.display = "none";
			
			if(this.responseText == ""){
				alert("Post Added");
				location.reload(); 
			}
		}
	}
	xhttp.open("POST", "Action/addPost.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(str);
	
}

let like = (p_id) => {
	
	let likes = document.getElementById(p_id).innerHTML;
	let btn = document.getElementById(p_id+"_btn");
	
	let xhttp = new XMLHttpRequest();
	let str = "p_id="+p_id;
	xhttp.onreadystatechange = function() {

		if(this.readyState == 4 && this.status == 200){
			
			if(this.responseText == ""){
				
			}
			else{
				document.getElementById(p_id).innerHTML = this.responseText;
				btn.className += "w3-green";
				
			}
		}
	}
	xhttp.open("POST", "Action/likePost.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(str);
	
}