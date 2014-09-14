<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>CLA</title>
<link type="text/css" href="cla.css" rel="Stylesheet" />
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
	alert('mbp');
	var item = document.getElementById(divID);
	item.className='unhidden';
	var name=document.getElementById('name');
	name.focus();
    }
  </script>
<?php echo file_get_contents('cla.html');?>
<br>
<br>
    <form method="post" action="javascript:add_contriber()" class="sigPad">
<div id=\'add_form\'>
    <fieldset>
	<legend>Please sign below</legend>
	<ul>
	    <li class="fl">
		<label for="name">Name:</label>
		<input type="text" id="name" name="name" tabindex="10" autocomplete="on">
	    </li>

	    <li class="fl">
		<label for="email">Email:</label>
		<input type="text" id="email" name="email" tabindex="20" autocomplete="on">
	    </li>

	    <li class="fl">
		<label for="phone">Phone:</label>
		<input type="text" id="phone" name="phone" tabindex="30" autocomplete="on">
	    </li>

	    <li class="fl">
		<label for="addr">Address:</label>
		<input type="text" id="addr" name="addr" tabindex="40" autocomplete="on">
	    </li>
	    <li class="fl">
<div class="form-item form-type-select form-item-country">
  <label for="edit-country">Country:</label>
<select id="country" name="country" onchange="populateState()"></select>
</div>
</li>
	    <li class="fl">
<div class="form-item form-type-select form-item-state">
  <label for="edit-state">State / Province </label>
<select id="state" name="state"></select>
</div>
	    </li>
<script type="text/javascript">initCountry(""); </script>
		
	    <li class="fl">
		<label for="zip">Zipcode:</label>
		<input type="text" id="zip" name="zip" tabindex="70" autocomplete="on">
	    </li>
	    <li class="fl">
		<label for="company">Company:</label>
		<input type="text" id="company" name="company" tabindex="80" autocomplete="on">
	    </li>
	    <li class="fl">
		<label for="role">Role:</label>
		<input type="text" id="role" name="role" tabindex="90" autocomplete="on">
	    </li>
	    <li class="fl">
		<label for="github_user">Github user:</label>
		<input type="text" id="github_user" name="github_user" tabindex="100" autocomplete="on">
	    </li>
	    <li class="fl">
		    <p>Draw your signature:</p>
<hr>
	    </li>
    	    <!--li class="sigNav"-->
	   <!--/li-->
<br><br>
    <li>
      <div class="typed"></div>
      <canvas class="pad" width="370" height="70"></canvas>
      <input type="hidden" name="output" id="output" class="output">
    </li>
<hr>
              <li class="clearButton"><a href="#clear">Clear signature</a></li>
<br><br>
	<!--div class="agree">
   <input type="checkbox" name="agree" id="agree" value="agree">I agree<br>
   </div-->
    <p><b>By clicking submit you confirm that you agree to the terms and conditions of the
Contributor License Agreement. This digital signature will generate a
signed agreement that will be sent to your email address and saved in our
records.</b></p>
    <button type="submit">I agree</button>
    </fieldset>
    </ul>
  </form>
    </div>

  <script src="jquery.signaturepad.js"></script>
  <script>
    $(document).ready(function() {
      $('.sigPad').signaturePad({drawOnly:true});
    });
  </script>
  <script src="assets/json2.min.js"></script>
  <div class=k-slider id="message" class=hidden></div><br>
</body>
