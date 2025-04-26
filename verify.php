<?php 
  session_start();
  include 'php/db.php';
  $unique_id = $_SESSION['unique_id'];
  if(empty($unique_id))
  {
    header ("Location: ./auth/login.html");
  } 
  $qry = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '{$unique_id}'");
  if(mysqli_num_rows($qry) > 0){
    $row = mysqli_fetch_assoc($qry);
    if($row){
      $_SESSION['verification_status'] = $row['verification_status'];
      if($row['verification_status'] == 'Verified')
      {
        header ("Location: ./dashboard/index.php");
      } 
  }
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Verify Account</title>
    <link rel="stylesheet" href="static/css/form.css">
  </head>
  <body>
    <div class="form" style="text-align: center;">
      <h2>Verify Your Account</h2>
      <p>We emailed you the four digit otp code to Enter the code below to confirm your email address.</p>
      <form action=""autocomplete="off">
        <div class="error-text">Error</div>
          <div class="fields_input">
            <input type="number" name="otp1" class="otp_field" placeholder="0" min="0" max="9" required onpaste="return false">
            <input type="number" name="otp2" class="otp_field" placeholder="0" min="0" max="9" required onpaste="return false">
            <input type="number" name="otp3" class="otp_field" placeholder="0" min="0" max="9" required onpaste="return false">
            <input type="number" name="otp4" class="otp_field" placeholder="0" min="0" max="9" required onpaste="return false">
        </div>
        <div class="submit">
      <input type="submit" value="Verify Now" class="button">
    </div>
    </form>
    </div>
<script>
    const otp = document.querySelectorAll('.otp_field');

// Initially focus first input
otp[0].focus();

otp.forEach((field, index) => {
	field.addEventListener('keydown', (e) => {
		if(e.key >= 0 && e.key <= 9) {
            otp[index].value = "";
			setTimeout(() => {
				otp[index+1].focus();
			}, 4);
		} else if (e.key === 'Backspace') {
			setTimeout(() => {
				otp[index-1].focus();
			}, 4);
		}
	});
});


const form = document.querySelector('.form form'),
submitbtn = form.querySelector('.submit .button'),
errortxt = form.querySelector('.error-text');


form.onsubmit = (e) =>{
    e.preventDefault();         //stops the default action
}
submitbtn.onclick = () =>{
    // start ajax

    let xhr = new XMLHttpRequest(); //create xml object
    xhr.open("POST","./php/otp.php",true);
    xhr.onload = () =>{
        if(xhr.readyState == XMLHttpRequest.DONE){
            if(xhr.status == 200){
                let data = xhr.response;
                if(data == "success"){
                    location.href = "./dashboard/index.php";
                }
                else{
                    errortxt.textContent = data;
                    errortxt.style.display = "block";
                }
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}
</script>
  </body>
</html>
