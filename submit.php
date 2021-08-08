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

if($file_extension != "doc" && $file_extension != "docx" && $file_extension != "txt"
&& $file_extension != "pdf" ) {
  echo "Please select a file with the extension DOC, DOCX, TXT or PDF";
  $upload_check = 0;
}

if ($upload_check == 0) {
	echo "Sorry, your file could not be uploaded.";
} else {
	if (move_uploaded_file($_FILES["file_to_upload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["file_to_upload"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }

}

$to = $email;
$subject = "Confirmation of submission";
$headers = "From: hr@corporate.com" . "\r\n" .

$msg = <<<MSG
Hello!
You submitted the following information in to our web form: <br>
First name: $first_name <br>
Last name: $last_name <br>
Email: $email    <br>
Telephone: $tel      <br>
Address 1: $address1 <br>
Address 2: $address2 <br>
Town: $town     <br>
County: $county   <br>
Postcode: $postcode <br>
Country: $country  <br>
MSG;

if(mail($to, $subject, $msg, $headers)) {
    echo "Email sent.";
}

?>