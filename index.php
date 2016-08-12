<html>
<head>
  <meta charset="utf-8">
  <title>CLA</title>
<!--link type="text/css" href="cla.css" rel="Stylesheet" /-->
<link type="text/css" href="webflow.css" rel="Stylesheet" />
 <link rel="shortcut icon" type="image/x-icon" href="https://corp.kaltura.com/sites/default/files/favicon.ico">
<script src="country.js"></script>
  <link href="assets/jquery.signaturepad.css" rel="stylesheet">
  <!--[if lt IE 9]><script src="../assets/flashcanvas.js"></script><![endif]-->
</head>
<body>
<script src="jquery.min.js"></script>
      <script>
	  function check_email(email) {

	        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		    if (!filter.test(email)) {
			return false;
		    }else{
			return true;
		    }
    }
    function add_contriber()
    {
	if (!document.getElementById('name').value){
			message.style.color = 'red';
			message.className='unhidden';
			message.innerHTML = 'Please input your name.';
			message.style.fontWeight="bold";
			document.getElementById('name').focus();
			return;
	}
	if (!document.getElementById('email').value){
			message.style.color = 'red';
			message.className='unhidden';
			message.innerHTML = 'Please input your email addr.';
			message.style.fontWeight="bold";
			document.getElementById('email').focus();
			return;
	}
	if(!check_email(document.getElementById('email').value)){
			message.className='unhidden';
			message.style.color = 'red';
			message.innerHTML = 'Please input a valid email addr.';
			message.style.fontWeight="bold";
			message.focus();
			return;
	}
	if (!document.getElementById('phone').value){
			    message.style.color = 'red';
			message.className='unhidden';
			message.innerHTML = 'Please input your phone num.';
			message.style.fontWeight="bold";
			document.getElementById('phone').focus();
			return;
	}
	if (!document.getElementById('addr').value){
			    message.style.color = 'red';
			message.className='unhidden';
			message.innerHTML = 'Please input your addr.';
			message.style.fontWeight="bold";
			document.getElementById('addr').focus();
			return;
	}
	if (!document.getElementById('country').value){
			    message.style.color = 'red';
			message.className='unhidden';
			message.innerHTML = 'Please input your country.';
			message.style.fontWeight="bold";
			document.getElementById('country').focus();
			return;
	}
	if (!document.getElementById('zip').value){
			    message.style.color = 'red';
			message.className='unhidden';
			message.innerHTML = 'Please input your zip.';
			message.style.fontWeight="bold";
			document.getElementById('zip').focus();
			return;
	}
	if (!document.getElementById('github_user').value){
			message.style.color = 'red';
			message.className='unhidden';
			message.innerHTML = 'Please input your GitHub user.';
			message.style.fontWeight="bold";
			document.getElementById('github_user').focus();
			return;
	}
	message.className='unhidden';
	message.style.color = 'blue';
	message.style.fontWeight="bold";
	message.innerHTML = 'Please wait while processing...'; 
	var name = document.getElementById('name').value;
	var email = document.getElementById('email').value;
	var phone = document.getElementById('phone').value;
	var addr = document.getElementById('addr').value;

	var country = document.getElementById('country').value;
	var state = document.getElementById('state').value;
	var zip = document.getElementById('zip').value;
	var company = document.getElementById('company').value;
	var role = document.getElementById('role').value;
	var github_user = document.getElementById('github_user').value;
	var output = document.getElementById('output').value;
	$.ajax({
		  type: 'POST',
		  url: 'add_contriber.php',
		  data: {'name': name,'email': email,'phone': phone, 'addr': addr, 'country': country, 'state': state, 'zip': zip,'company':company,'output':output,'github_user':github_user,'role':role},
		  success: function(data){
		      if (data!==null){
			message=document.getElementById("message");
			if (data.indexOf("ERR") !==-1) {
			    message.style.color = 'red';
			}else{
			    message.style.color = 'green';
			}
			message.className='unhidden';
			message.innerHTML = data;
			message.style.fontWeight="bold";
			} 
		      } 
	});
    }
    
    function unhide_add(divID) 
    {
	//alert('mbp');
	var item = document.getElementById(divID);
	item.className='unhidden';
	var name=document.getElementById('name');
	name.focus();
    }
  </script>
<div class="logo"><a href="http://www.kaltura.com"><img src="images/logo.png" alt="kaltura" height="65" width="146"></a></div>
<br>
<div class="radio-description">
<p>Dear Contributor, </br>Please read the Contributor License Agreement and submit the form below.</p><hr></br>
<?php echo file_get_contents('cla.html');?>
</div>
<br>
<br>
<div class="w-form">
    <form method="post" action="javascript:add_contriber()" class="sigPadd">
<div class="company-details-div">
	<!--legend>Please sign below</legend-->
	<div class="w-row form-row">
		<div class="w-col w-col-6">
			<label for="name" class="form-labels">Name:</label>
			<input type="text" id="name" name="name" tabindex="10" autocomplete="on" class="w-input input-light" >
		</div>
		<div class="w-col w-col-6">
			<label for="email" class="form-labels">Email:</label>
			<input type="text" id="email" name="email" tabindex="20" autocomplete="on" class="w-input input-light">
		</div>
	</div>
	<div class="w-row form-row">
		<div class="w-col w-col-6">

			<label for="phone" class="form-labels">Phone:</label>
			<input type="text" id="phone" name="phone" tabindex="30" autocomplete="on" class="w-input input-light">
		</div>
		<div class="w-col w-col-6">

			<label for="addr" class="form-labels">Address:</label>
			<input type="text" id="addr" name="addr" tabindex="40" autocomplete="on" class="w-input input-light">
		</div>
	</div>
	<div class="w-row form-row">
		<div class="w-col w-col-6">
  			<label for="edit-country" class="form-labels">Country:</label>
			<select id="country" name="country" onchange="populateState()" tabindex="50" class="w-select input-light"></select>
		</div>
		<div class="w-col w-col-6" id="statediv">
  			<label for="edit-state" class="form-labels">State / Province </label>
			<select id="state" name="state" tabindex="60" class="w-select input-light"></select>
		</div>
	</div>
<script type="text/javascript">initCountry(""); </script>
		
	<div class="w-row form-row">
		<div class="w-col w-col-6">
			<label for="zip" class="form-labels">Zipcode:</label>
			<input type="text" id="zip" name="zip" tabindex="70" autocomplete="on" class="w-input input-light">
	    	</div>
		<div class="w-col w-col-6">
			<label for="company" class="form-labels">Company:</label>
			<input type="text" id="company" name="company" tabindex="80" autocomplete="on" class="w-input input-light"> 
	    	</div>
	</div>
	<div class="w-row form-row">
		<div class="w-col w-col-6">
			<label for="role" class="form-labels">Role:</label>
			<input type="text" id="role" name="role" tabindex="90" autocomplete="on" class="w-input input-light">
	    	</div>
		<div class="w-col w-col-6">
			<label for="github_user" class="form-labels">Github user:</label>
			<input type="text" id="github_user" name="github_user" tabindex="100" autocomplete="on" class="w-input input-light">
	    	</div>
	</div>
	<div class="w-row form-row">
		<div class="w-col w-col-6">
		    <p>Draw your signature:</p>
	    	</div>
	</div>
    	    <!--li class="sigNav"-->
	   <!--/li-->
<br><br>
      <div class="typed"></div>
      <canvas class="pad" width="370" height="100"></canvas>
      <input type="hidden" name="output" id="output" class="output">
	<div class="w-row form-row">
		<div class="w-col w-col-6">
		<div class="clearButton">
			<a href="#clear">Clear signature</a>
		</div>
		</div>
	</div>
<br><br>
	<!--div class="agree">
   <input type="checkbox" name="agree" id="agree" value="agree">I agree<br>
   </div-->
    <p><b>By clicking 'I agree' you confirm that you agree to the terms and conditions of the
Contributor License Agreement.</br> 
This digital signature will generate a signed agreement that will be sent to your email address and saved in our
records.</b></p>
    <button type="submit" class="w-button standard-button vpaas-signup-btn">I agree</button>
    </div>
  </form>
    </div>

  <script src="jquery.signaturepad.js"></script>
  <script>
    $(document).ready(function() {
      $('.sigPadd').signaturePad({drawOnly:true});
    });
  </script>
  <script src="assets/json2.min.js"></script>
  <div class=k-slider id="message" class=hidden></div><br>
<p>The Kaltura CLA system is a FOSS project. <br>Feel free to download and use it for your own needs at: <a href="https://github.com/kaltura/agent-contrib">https://github.com/kaltura/agent-contrib</a>.</p>
</body>
</html>
