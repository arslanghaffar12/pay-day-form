<?php

function getLoanAmountOptions() {
  $options = "";

  // 100 to 1000 (100-step)
  for ($i = 100; $i <= 1000; $i += 100) {
    $options .= "<option value=\"$i\">\$$i</option>";
  }

  // 1100 to 1500 (100-step)
  for ($i = 1100; $i <= 1500; $i += 100) {
    $options .= "<option value=\"$i\">\$$i</option>";
  }

  // 2000 to 36000 (1000-step)
  for ($i = 2000; $i <= 36000; $i += 1000) {
    $options .= "<option value=\"$i\">\$$i</option>";
  }

  return $options;
}

function getTimeOptions() {
  $list = [
    "1 Month or less",
    "2 Months",
    "3 Months",
    "3-6 Months",
    "6-12 Months",
    "1-2 Years",
    "2-5 Years",
    "5-8 Years",
    "8 Years or more"
  ];

  $options = "";
  foreach ($list as $val) {
    $options .= "<option value=\"$val\">$val</option>";
  }

  return $options;
}

function getStateOptions() {
  $states = [
    "AL" => "Alabama", "AK" => "Alaska", "AZ" => "Arizona", "AR" => "Arkansas",
    "CA" => "California", "CO" => "Colorado", "CT" => "Connecticut", "DE" => "Delaware",
    "DC" => "District Of Columbia", "FL" => "Florida", "GA" => "Georgia", "HI" => "Hawaii",
    "ID" => "Idaho", "IL" => "Illinois", "IN" => "Indiana", "IA" => "Iowa",
    "KS" => "Kansas", "KY" => "Kentucky", "LA" => "Louisiana", "ME" => "Maine",
    "MD" => "Maryland", "MA" => "Massachusetts", "MI" => "Michigan", "MN" => "Minnesota",
    "MS" => "Mississippi", "MO" => "Missouri", "MT" => "Montana", "NE" => "Nebraska",
    "NV" => "Nevada", "NH" => "New Hampshire", "NJ" => "New Jersey", "NM" => "New Mexico",
    "NY" => "New York", "NC" => "North Carolina", "ND" => "North Dakota", "OH" => "Ohio",
    "OK" => "Oklahoma", "OR" => "Oregon", "PA" => "Pennsylvania", "RI" => "Rhode Island",
    "SC" => "South Carolina", "SD" => "South Dakota", "TN" => "Tennessee", "TX" => "Texas",
    "UT" => "Utah", "VT" => "Vermont", "VA" => "Virginia", "WA" => "Washington",
    "WV" => "West Virginia", "WI" => "Wisconsin", "WY" => "Wyoming"
  ];

  $options = '<option value="">Select State</option>';
  foreach ($states as $abbr => $name) {
    $options .= "<option value=\"$abbr\">$name</option>";
  }

  return $options;
}
