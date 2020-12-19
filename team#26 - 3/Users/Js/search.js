let srch = document.getElementById('search_val');
srch.addEventListener("input", () => {
	
	let val = document.getElementById('search_val').value;
	let search_answeres = document.getElementById('search_answers');
	
	myFunction2(true);
	
	let str = "val="+val;
	let xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		
		if(this.readyState == 4 && this.status == 200){
			
			if(this.responseText.length > 20){
				search_answeres.innerHTML = this.responseText;
			}
			else{
				search_answeres.innerHTML = "<div class='w3-center w3-padding'>No communities</div>";
			}
		
		}
	}
	xhttp.open("POST", "Action/search.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(str);
	
});
