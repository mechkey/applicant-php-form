<?php

$first_name = htmlspecialchars(trim($_POST['first_name']));
$last_name 	= htmlspecialchars(trim($_POST['last_name']));
$email 		= htmlspecialchars(trim($_POST['email']));
$tel 		  = htmlspecialchars(trim($_POST['tel']));
$address1	= htmlspecialchars(trim($_POST['address1']));
$address2	= htmlspecialchars(trim($_POST['address2']));
$town 		= htmlspecialchars(trim($_POST['town']));
$county 	= htmlspecialchars(trim($_POST['county']));
$postcode	= htmlspecialchars(trim($_POST['postcode']));
$country	= htmlspecialchars(trim($_POST['country']));
$description= htmlspecialchars(trim($_POST['description']));


$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["file_to_upload"]["name"]);
$public_target_file = substr($target_file, strlen($target_dir));  
$upload_check = 1;
$file_extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $upload_check = 0;
}

if ($_FILES["file_to_upload"]["size"] > 1000000) {
  echo "Sorry, your file is too large.";
  $upload_check = 0;
}

if ($file_extension != "doc" && $file_extension != "docx" && $file_extension != "txt" && $file_extension != "pdf" ) {
  echo "Please select a file with the extension DOC, DOCX, TXT or PDF. ";
  $upload_check = 0;
}

if ($upload_check == 0) {
	echo "Sorry, your file could not be uploaded. ";
} else {
	if (move_uploaded_file($_FILES["file_to_upload"]["tmp_name"], $target_file)) {
    echo " Success! The file ". htmlspecialchars( basename( $_FILES["file_to_upload"]["name"])). " has been uploaded. ";
  } else {
    echo "Sorry, there was an error uploading your file. ";
  }

}

$to = $email;
$subject = "Confirmation of submission";
$headers = "From: hr@corporate.com" . "\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";


$msg = <<<MSG
You submitted the following information in to our web form: <br>
<table>
<tr><td>First name: </td><td>$first_name</td></tr>
<tr><td>Last name: </td><td>$last_name </td></tr>
<tr><td>Email: </td><td>$email    </td></tr>
<tr><td>Telephone: </td><td>$tel      </td></tr>
<tr><td>Address 1: </td><td>$address1 </td></tr>
<tr><td>Address 2: </td><td>$address2 </td></tr>
<tr><td>Town: </td><td>$town     </td></tr>
<tr><td>County: </td><td>$county   </td></tr>
<tr><td>Postcode: </td><td>$postcode </td></tr>
<tr><td>Country: </td><td>$country  </td></tr>
<tr><td>CV file uploaded: </td><td>$public_target_file </td></tr> 
</table>
MSG;

echo $msg;

if(mail($to, $subject, "<html><body>" .$msg. "</html></body>", $headers)) {
    echo "A confirmation email containing this information has been sent to the email address $email. ";
}


?>