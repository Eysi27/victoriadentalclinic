<?php
session_start();

header('Content-Type: application/json');

$to = trim(urldecode($_POST['to'] ?? ''));
$subject = urldecode($_POST['subject'] ?? '');
$greetings = urldecode($_POST['greetings'] ?? '');
$msg = nl2br(urldecode($_POST['msg'] ?? ''));
$mobileNumbersInput = trim(urldecode($_POST['mobileNumbers'] ?? ''));
$mobileNumbers = array_values(array_filter(array_map(function ($value) {
  return preg_replace('/[^0-9]/', '', trim((string) $value));
}, array_filter(explode(',', $mobileNumbersInput), function ($value) {
  return trim((string) $value) !== '';
})), function ($value) {
  return $value !== '';
}));

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
      background-color: #cdda23;
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
      <h2>Victoria Advanced Dental Care Notification</h2>
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

$emailSent = false;
$smsSent = false;

if ($to !== '') {
  $emailSent = $service->sendEmail($to, $subject, $message);
}

if (!empty($mobileNumbers)) {
  $smsSent = $service->sendSmsBatch($mobileNumbers);
}

$status = 'Skipped';
if ($emailSent && $smsSent) {
  $status = 'Notified [email,sms]';
} elseif ($emailSent) {
  $status = 'Notified [email]';
} elseif ($smsSent) {
  $status = 'Notified [sms]';
}

echo json_encode([
  'success' => ($emailSent || $smsSent),
  'email' => $emailSent,
  'sms' => $smsSent,
  'status' => $status
]);

class ServiceClass
{

  public function sendEmail($to, $subject, $msg)
  {
    $msg = wordwrap($msg, 70);

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: <noreply@victoria-advanced-dentalcare.com>' . "\r\n";

    return mail($to, $subject, $msg, $headers);
  }

  public function sendSmsBatch($numbers)
  {
    if (empty($_SESSION['smskey'])) {
      $this->writeSmsLog('SMS skipped: missing smskey');
      return false;
    }

    if (empty($numbers)) {
      return false;
    }

    $message = 'Hi! It’s been 6 months since your dental cleaning. Book now at Victoria Advanced Dental Care (FB) or text 0968 350 7067. See you soon!';
    $batchSize = 100;
    $success = false;

    for ($i = 0; $i < count($numbers); $i += $batchSize) {
      $batch = array_slice($numbers, $i, $batchSize);
      $params = [
        'apikey' => $_SESSION['smskey'],
        'number' => implode(',', $batch),
        'message' => $message
      ];

      $ch = curl_init('https://api.semaphore.co/api/v4/messages');
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_TIMEOUT, 20);

      $response = curl_exec($ch);
      $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      curl_close($ch);

      $batchSuccess = $httpCode >= 200 && $httpCode < 300;
      $this->writeSmsLog('batch=' . count($batch) . ' http=' . $httpCode . ' success=' . ($batchSuccess ? 'true' : 'false') . ' response=' . (string) $response);
      $success = $success || $batchSuccess;
    }

    return $success;
  }

  private function writeSmsLog($message)
  {
    $logDir = dirname(__FILE__) . '/logs';
    if (!is_dir($logDir)) {
      mkdir($logDir, 0755, true);
    }

    $logFile = $logDir . '/sms_notifications.log';
    $entry = date('Y-m-d H:i:s') . ' ' . $message . PHP_EOL;
    file_put_contents($logFile, $entry, FILE_APPEND);
  }
}
?>