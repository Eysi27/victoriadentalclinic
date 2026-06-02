<?php

$to = urldecode($_POST['to']);
$subject = urldecode($_POST['subject']);
$greetings = urldecode($_POST['greetings']);
$msg = nl2br(urldecode($_POST['msg']));
//INHERITANCE -- CREATING NEW INSTANCE OF A CLASS (INSTANTIATE)
$service = new ServiceClass();

$message = "
<html>
<head>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }
    .email-container {
      background-color: #ffffff;
      margin: 40px auto;
      padding: 20px;
      max-width: 600px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .email-header {
      background-color: #622c9e;
      color: white;
      padding: 10px 20px;
      border-top-left-radius: 8px;
      border-top-right-radius: 8px;
    }
    .email-body {
      padding: 20px;
      color: #333333;
      line-height: 1.6;
    }
    .email-footer {
      padding: 10px 20px;
      font-size: 12px;
      color: #888888;
      text-align: center;
      border-top: 1px solid #eeeeee;
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <div class='email-container'>
    <div class='email-header'>
      <h2>Smiles & More Notification</h2>
    </div>
    <div class='email-body'>
      <p><strong>$greetings,</strong></p>
      <p>$msg</p>
    </div>
    <div class='email-footer'>
      <p>This is an automated message. Please do not reply.</p>
    </div>
  </div>
</body>
</html>
";


$email = $service->sendEmail($to, $subject, $message);

//USE THIS AS YOUR BASIS
class ServiceClass
{

  public function sendEmail($to, $subject, $msg)
  {
    $msg = wordwrap($msg, 70);

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: <servicebot@smilesandmore.ph>' . "\r\n";
    mail($to, $subject, $msg, $headers);
  }
  //UNTIL THIS CODE

}
//UNTIL HERE COPY



?>