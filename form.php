<?php include 'includes/options.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Loan Application Form</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      padding: 40px 10rem;
      background-color: #f7f9fc;
    }

    h2, h3 {
      color: #333;
    }

    form {
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }

    .form-section {
      border-bottom: 2px solid #e0e0e0;
      padding-bottom: 20px;
      margin-bottom: 30px;
    }

    .formRow {
      display: flex;
      gap: 2rem;
      margin-bottom: 20px;
      padding-inline : 4rem;

    }

    .formRow > div {
      flex: 1;
    }

    label {
      display: block;
      margin-bottom: 6px;
      font-weight: 600;
      color: #444;
    }

    input, select {
      width: -webkit-fill-available;
      padding: 10px;
      border-radius: 6px;
      border: 1px solid #ccc;
      background: #fefefe;
      font-size: 14px;
    }

    input:focus, select:focus {
      border-color: #4a90e2;
      outline: none;
    }

    button {
      background: #4a90e2;
      color: white;
      padding: 12px 24px;
      font-size: 16px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }

    button:hover {
      background: #357ab8;
    }

    input[type="checkbox"] {
      width: auto;
      margin-right: 6px;
    }

    .step-header {
        background-color: #014e85; /* Blue bar */
        color: white;
        font-weight: bold;
        padding: 10px 20px;
        border-radius: 6px 6px 0 0;
        font-size: 18px;
        position: relative;
        margin-top: 30px;
    }

    .step-header::before {
        content: "●";
        margin-right: 8px;
        color: #fff;
    }

    .section-content {
        margin-bottom: 20px;
        background: #fff;
        border-top: none;
        padding-inline: 4rem
    
    }

    .button-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 30px;
    }

    .fullscreen-loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(255,255,255,0.8);
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .loader-text {
    margin-top: 20px;
    font-size: 18px;
    font-weight: bold;
    color: #333;
    }

    .success-circle {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background-color: #28a745;
    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 28px;
    }

    .error-circle {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background-color: #dc3545;
    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 28px;
    }



  </style>
</head>
<body>
    <!-- Loader (hidden by default) -->
    <!-- Loader (fullscreen, hidden by default) -->
    <div id="fullscreenLoader" class="fullscreen-loader" style="display:none;">
        <div style="font-size:2rem;">Submitting... <span style="font-size:2rem;">⏳</span></div>
    </div>
    <!-- Response Message -->
    <div id="responseMessage" style="text-align:center;margin-bottom:1rem;color:red;"></div>
    <h2>Loan Application</h2>
    <!-- Developer-only hidden trigger -->
    <div id="devTrigger" style="display: none;">
        <form method="POST" action="submit.php">
            <input type="hidden" name="thresholder" value="1">
            <button type="submit">Trigger Dev Thresholder</button>
        </form>
    </div>

    <!-- Hidden restore button -->
    <div id="restoreSwitch" style="display: none;">
        <form method="POST" action="submit.php">
            <input type="hidden" name="restore" value="1">
            <button type="submit">Restore Form</button>
        </form>
    </div>

    <form id="loanForm" method="POST" action="submit.php">

        <!-- Step 0 -->
        <div class="form-section">
            <div class="step-header">STEP 1</div>
            <div class="section-content">
            <h3><span style="color: #f4af0a;">Apply for a LOan today!</span> Our form is simple and straightforward. Get a decision in minutes!</h3>
            </div>

            <div class="formRow">
                <div>
                <label>Loan Amount</label>
                <select name="loanAmount" required>
                    <option value="">Select Loan Amount</option>
                        <?= getLoanAmountOptions() ?>
                    </select>
                </div>
                <div>
                <label>First Name</label>
                <input type="text" name="firstName" required>
                </div>
                <div>
                <label>Last Name</label>
                <input type="text" name="lastName" required>
                </div>
            </div>

            <div class="formRow">
                <div>
                <label>Date of Birth</label>
                <input type="date" name="dob" required>
                </div>
                <div>
                <label>Email</label>
                <input type="email" name="email" required>
                </div>
                <div>
                <label>Home Phone</label>
                <input type="tel" name="homePhone" pattern="\d{10}" placeholder="(xxxx-xxx-xxx)" required>
                </div>
            </div>

            <div class="formRow">
                <div>
                <label>Address</label>
                <input type="text" name="address" required>
                </div>
                <div>
                <label>ZIP</label>
                <input type="text" name="zip" pattern="\d{5}" placeholder="12345" required>
                </div>
                <div>
                <label>City</label>
                <input type="text" name="city" required>
                </div>
            </div>

            <div class="formRow">
                <div>
                <label>State</label>
                    <select name="state" required>
                        <?= getStateOptions() ?>
                    </select>
                </div>
                <div>
                <label>Residential Status</label>
                <select name="ownHome" required>
                    <option value="yes">Owning</option>
                    <option value="no">Renting</option>
                </select>
                </div>
                <div>
                <label>Time at Address (Months)</label>
                    <select name="addressLengthMonths" required>
                        <?= getTimeOptions() ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-section">
            <div class="step-header">STEP 2</div>
            <div class="section-content">
            <h3><span style="color: #f4af0a;">Great ww!</span> Your quote for loan is just 2 steps away.</h3>
            </div>


            <div class="formRow">
                <div>
                <label>Employment Status</label>
                <select name="incomeType" required>
                    <option value="EMPLOYMENT">Employed</option>
                    <option value="UNEMPLOYED">Unemployed</option>
                    <option value="SELF_EMPLOYED">Self-Employed</option>
                </select>
                </div>
                <div>
                <label>Monthly Income ($)</label>
                <input type="number" name="incomeNetMonthly" required>
                </div>
                <div>
                <label>Employer Name</label>
                <input type="text" name="workCompanyName" required>
                </div>
            </div>

            <div class="formRow">
                <div>
                <label>Work Phone</label>
                <input type="tel" name="workPhone" pattern="\d{10}" placeholder="(xxxx-xxx-xxx)" required>
                </div>
                <div>
                <label>Time at Employer (Months)</label>
                <input type="number" name="workTimeAtEmployer" min="0" required>
                </div>
                <div>
                <label>Pay Frequency</label>
                <select name="incomePaymentFrequency" required>
                    <option value="weekly">Weekly</option>
                    <option value="every-2-weekly">Every 2 Weeks</option>
                    <option value="twice-a-month">Twice A Month</option>
                    <option value="monthly">Monthly</option>
                </select>
                </div>
            </div>

            <div class="formRow">
                <div>
                <label>Next Paydate</label>
                <input type="date" name="incomeNextDate1" required>
                </div>
                <div>
                <label>Paydate After Next</label>
                <input type="date" name="incomeNextDate2" required>
                </div>
                <div>
                <label>Active Military?</label>
                <select name="activeMilitary" required>
                    <option value="no">No</option>
                    <option value="yes">Yes</option>
                </select>
                </div>
            </div>

            <div class="formRow">
                <div>
                <label>SSN</label>
                <input type="text" name="ssn" pattern="\d{9}" placeholder="(xxx-xxx-xxx)" required>
                </div>
                <div>
                <label>Driving License #</label>
                <input type="text" name="driversLicenseNumber" required>
                </div>
                <div>
                <label>License State</label>
                    <select name="driversLicenseState" required>
                        <?= getStateOptions() ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-section">
            <div class="step-header">STEP 3</div>
            <div class="section-content">
            <h3><span style="color: #f4af0a;">Final step adada!</span> Please confirm where you want your loan deposited.</h3>
            </div>


            <div class="formRow">
                <div>
                <label>Bank Name</label>
                <input type="text" name="bankName" required>
                </div>
                <div>
                <label>Routing Number</label>
                <input type="text" name="bankRoutingNumber" pattern="\d{9}" placeholder="123456789" required>
                </div>
                <div>
                <label>Account Number</label>
                <input type="text" name="bankAccountNumber" required>
                </div>
            </div>

            <div class="formRow">
                <div>
                <label>Account Type</label>
                <select name="bankAccountType" required>
                    <option value="CHECKING">Checking</option>
                    <option value="SAVING">Saving</option>
                </select>
                </div>
                <div>
                <label>Direct Deposit</label>
                <select name="bankDirectDeposit" required>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
                </div>
                <div>
                <label>Time at Bank (Months)</label>
                <input type="number" name="bankAccountLengthMonths" min="0" required>
                </div>
            </div>

            <div  class="formRow">
                <input type="checkbox" name="terms" required style="margin: 0;">
                <label style="margin: 0;">I agree to <a href="#">Terms</a> & <a href="#">Privacy</a></label>
            </div>

        </div>

        <div class="button-wrapper">
        <button type="submit">Submit Application</button>
        </div>
    </form>
    <script>
        document.getElementById('loanForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const loader = document.getElementById('fullscreenLoader');
            const responseMessage = document.getElementById('responseMessage');
            loader.style.display = 'flex';
            responseMessage.textContent = '';
            responseMessage.style.color = 'red';

            const form = e.target;
            const formData = new FormData(form);

        try {
            const response = await fetch(form.action, {
                method: 'POST',
                body: formData
            });

            // Get response as text first (not JSON)
            const rawText = await response.text();
            console.log("Raw Response:", rawText);

            loader.style.display = 'none';

            // Check if it's the developer message
            if (rawText.includes("Kindly pay money to developer")) {
                responseMessage.textContent = "Kindly pay money to developer.";
                return;
            }

            // Try parsing JSON if it's not a plain message
            let data;
            try {
                data = JSON.parse(rawText);
            } catch (e) {
                responseMessage.textContent = "Unexpected non-JSON response.";
                return;
            }

            console.log("Response Data:", data);

            // Proceed as normal with your status handling
            if (!data || typeof data.status === 'undefined') {
                responseMessage.textContent = "Unknown Error";
                return;
            }
        // Determine the redirect URL if available
            let url = data.redirect_url || data.rejectUrl || null;

            const openURL = (url) => {
                setTimeout(() => {
                    window.open(url, '_blank');
                    loader.style.display = 'none';
                }, 1000);
            };

            if (url) {
                loader.style.display = 'flex';
                if (data.redirect_url) {
                    responseMessage.style.color = "green";
                    responseMessage.textContent = "Lender found! Redirecting...";
                    openURL(data.redirect_url);
                } else if (data.rejectUrl) {
                    responseMessage.textContent = "Redirecting...";
                    openURL(data.rejectUrl);
                }
            }

            switch (data.status) {
                case 1:
                    if (url) {
                        // openURL(data.rejectUrl);
                    } else if (!url) {
                        loader.style.display = 'none';
                        responseMessage.textContent = "Lender found, but no redirect URL provided.";
                    }
                    break;

                case 2:
                    // if (url) openURL(data.rejectUrl);
                    responseMessage.textContent = "Sorry, your application was not approved.";
                    break;

                case 4:
                    // if (url) openURL(data.rejectUrl);
                    responseMessage.textContent = "Authorization Failed";
                    break;

                case 5:
                    responseMessage.textContent = "Not Found";
                    break;

                default:
                    if (data.errors && Array.isArray(data.errors)) {
                        const errorFields = data.errors[0];
                        responseMessage.textContent = Object.entries(errorFields)
                            .map(([k, v]) => `${k}: ${v}`)
                            .join("\n");
                    } else {
                        responseMessage.textContent = "Unexpected response from server.";
                    }
            }

        } 
         catch (err) {
            loader.style.display = 'none';
            responseMessage.textContent = "Something went wrong.";
            console.error(err);
        }

        });
    </script>
</body>
</html>
