<?php 
if(!isset($_POST['submit']))
{
    echo "error: You need to Submit form!";
}
$name=$_POST['name'];
$visitor_email= $_POST['email'];
$email_subject= $_POST['subject'];
$message = $_POST['message'];


if(empty($name)|| empty($visitor_email))
{
    echo "Name and Email are Required";
    exit;   
}
if (IsInjected($visitor_email))
{
    echo "Bad/Invalid Email";
    exit;
}

$email_from = 'razz.subedi@gmail.com';//<== update the email address
$email_subject = "New Form submission: $email_subject";
$email_body = "You have received a new message from the user $name.\n".
    "Here is the message:\n $message".
    
$to = "subedi.tirtha@gmail.com";
$headers = "From: $email_from \r\n";
$headers .= "Reply-To: $visitor_email \r\n";
//Send the email!
mail($to,$email_subject,$email_body,$headers);
//done. redirect to thank-you page.
header('Location: thank-you.html');


// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}

?> 