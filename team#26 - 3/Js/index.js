	function OpenLogIn()
	{
		document.getElementById("layer2").style.display = "none";
		document.getElementById("layer1").style.display = "block";
		
	}
	
	function OpenSignIn()
	{
		document.getElementById("layer2").style.display = "block";
		document.getElementById("layer1").style.display = "none";
	}
	
	
	let loginCheck = () => {
	    
	    let formL = document.getElementById('login');
		document.getElementById('eu').name = "Eu";
		document.getElementById('password').name = "Password";
		
		let eu = formL.Eu.value;
		let pass = formL.Password.value;
		let error = document.getElementById('loginerror');
		
		let check_data = new Check();
		if(check_data.check(eu) || check_data.check(pass)){
		    
		    alert("Please add correct details");
		    error.innerHTML = "Please add correct details";
		    return;
		    
		}
		
		//email login
		if(check_data.emailCheck(eu, error)){
		        
		        let str = "Pass="+pass+"&Email="+eu;
			let xhttp = new XMLHttpRequest();
			let loader = document.getElementById('loginloader');
			xhttp.onreadystatechange = function() {
            		loader.style.display = "block";
            		if(this.readyState == 4 && this.status == 200){
            			error.innerHTML = this.responseText;
            			loader.style.display = "none";
            			if(this.responseText == ""){
            			
					formL.method = "post";
            				formL.action = "detailsLogin.php";
            				formL.submit();
              			}
            		}
        		}
        		xhttp.open("POST", "Check/loginEmailCheck.php", true);
        		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		xhttp.send(str);
		        
		}
		else{
		       return false;
		}
		
	}
	
	let SignUpCheck = () => {
		
		let formS = document.getElementById('signup');
		document.getElementById('name').name = "Name";
		document.getElementById('email').name = "Email";
		document.getElementById('password1').name = "Pass1";
		document.getElementById('password2').name = "Pass2";
		document.getElementById('gender').name = "Gender";
		let check_data = new Check();
		let error = document.getElementById('SignUpError');
		let name = formS.Name.value;
		let email = formS.Email.value;
		let pass = formS.Pass1.value;
		let passCon = formS.Pass2.value;
		let gender = formS.Gender.value;
	
		if(name == "" || email == "" || pass == "" || passCon == "" || gender == ""){
			alert("Please enter every details");
			error.innerHTML = "Please enter every details";
			return false;
		}
		
		if(name.length <= 4) {
			alert("Please enter your full name");
			error.innerHTML = "Please enter your full name";
			return false;
		}
		
		try{
			if(!check_data.emailCheck(email, error)){
				
				return false;
				
			}
		
			if(check_data.check(email)){
				alert("Please enter valid email");
				error.innerHTML = "Please enter valid email";
				return false;
			}
			
			if(check_data.check(name)){
				alert("Please enter valid name");
				error.innerHTML = "Please enter valid email";
				return false;
			}
			
			if(check_data.check(pass)){
				alert("Please enter valid password");
				error.innerHTML = "Please enter valid email";
				return false;
			}
			
			if(check_data.check(passCon)){
				alert("Please enter valid password");
				error.innerHTML = "Please enter valid email";
				return false;
			}
		}
		catch(err){
			alert("There is a problem: "+err);
			return;
		}
		
		if(pass.length <= 5){
			alert("password must be more than 5 letters");
			error.innerHTML = "password must be more than 5 letters";
			return false;
		}
		
		if(pass !== passCon){
			alert("Both passwords do not match");
			error.innerHTML = "Both passwords do not match";
			return false;
		}
	
		let str = "Name="+name+"&Email="+email+"&Pass="+pass+"&Gender="+gender;
		let xhttp = new XMLHttpRequest();
		let loader = document.getElementById('loaderSignUp');
			xhttp.onreadystatechange = function() {
				loader.style.display = "block";
				if(this.readyState == 4 && this.status == 200){
					error.innerHTML = this.responseText;
					loader.style.display = "none";
					if(this.responseText == ""){
						
						formS.action = "details.php";
						formS.method = "post";
						formS.submit();
						
					}
				}
			}
		xhttp.open("POST", "Check/userCheck.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send(str);
	
	}
	
	