<?php
// Include options if needed (assuming this contains getLoanAmountOptions(), getStateOptions(), etc.)
include 'includes/options.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>HANFINCAL - Loan Application</title>
    <link rel="stylesheet" href="css/style.css" />
    <style>
        /* Add all the form styles from your PHP form here */
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f7f9fc;
        }

        .loan-form-container {
            padding: 40px 10rem;
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
            background-color: #014e85;
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
            padding-inline: 4rem;
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

        /* Response message styling */
        #responseMessage {
            text-align: center;
            margin: 1rem auto;
            color: red;
            max-width: 80%;
        }
    </style>
</head>

<body>

    <header class="site-header">
        <div class="container">
            <div class="logo">
                <img src="logo.png" alt="Logo" />
                <!-- <span><span class="highlight">MANI</span>LOAN</span> -->
            </div>
            <nav class="nav-links">
                <a href="#" id="openRatesModal">Rates & Fees</a>
                <a href="#" id="openFaqModal">FAQs</a>
            </nav>
        </div>
    </header>

    <div class="loan-form-container">
        <!-- Loader (fullscreen, hidden by default) -->
        <div id="fullscreenLoader" class="fullscreen-loader" style="display:none;">
            <div style="font-size:2rem;">Submitting... <span style="font-size:2rem;">⏳</span></div>
        </div>
        
        <!-- Response Message -->
        <div id="responseMessage"></div>
        
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

        <form id="loanForm" method="POST" action="">

            <!-- Step 0 -->
            <div class="form-section">
                <div class="step-header">STEP 1</div>
                <div class="section-content">
                <h3><span style="color: #f4af0a;">Apply for a Loan today!</span> Our form is simple and straightforward. Get a decision in minutes!</h3>
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
                <h3><span style="color: #f4af0a;">Great!</span> Your quote for loan is just 2 steps away.</h3>
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
                <h3><span style="color: #f4af0a;">Final step!</span> Please confirm where you want your loan deposited.</h3>
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
    </div>

    <footer class="site-footer">
        <div class="footer-links">
            <a href="contactUs.html">CONTACT US</a>
            <a href="privacyPolicy.html">PRIVACY POLICY</a>
            <a href="disclaimer.html">DISCLAIMER</a>
        </div>
        <div class="copyright">
            © Copyright 2025 HANFINCAL
        </div>
    </footer>

    <!-- Modal Overlay -->
    <div id="ratesModal" class="modal-overlay">
        <div class="modal-content">
            <h2>Rates & Fee</h2>
            <p style="font-family: Inter; font-size: 18px; font-weight:400;line-height: 130%; margin-bottom: 13px;">
                <strong>Hanfincal.com</strong> provides free-of-charge service to help borrowers like you connect with
                reliable lenders to solve your financial needs. We do not review, approve or make any decisions related
                to your loan requests or approvals, you have to work with your lenders regarding rates, APR, lending
                policy, fees or any other rules. Each state may have different local regulations to proceed with your
                loan request, we only try our best to provide you with as much information as we can, including how it
                works and some FAQs.
            </p>

            <p style="font-family: Inter; font-size: 18px; font-weight:400;line-height: 130%; margin-bottom: 13px;">It
                is important to read and understand all the agreement and related information, including the fees and
                APR, as well as the terms of repayment and loan renewal options, if your request is approved by the
                lender. If there are any terms or conditions you need to clarify, please check with your lenders to
                address all questions, we only can help you with relevant questions related to our service.</p>

            <p style="font-family: Inter; font-size: 18px; font-weight:400;line-height: 130%; margin-bottom: 13px;">he
                most crucial thing that you should comprehend as a borrower is an implication of making late
                installments on your credit. Although every lender whom we work with has its own particular terms and
                conditions for the advances they offer, there are some late-installment repercussions that you ought to
                know before entering into a loan contract with the lender.</p>

            <p style="font-family: Inter; font-size: 18px; font-weight:400;line-height: 130%; margin-bottom: 13px;">
                <strong>Hanfincal.com</strong>is a free-of-charge platform which collects your personal details to
                submit for the lenders to review your loan requests. We do not relate to the reviewing process or
                address your loan-related questions, please contact your financial providers directly to clarify all the
                information. We try our best to connect you with the most suitable lender, however the approval decision
                will be fully determined by the lender.
            </p>

            <p style="font-family: Inter; font-size: 18px; font-weight:400;line-height: 130%; margin-bottom: 13px;">By
                reading Privacy Policy and Terms of Use, you understand and consent that this Site collects personal
                details and shares with its third-party partners. Also, the links of third-party websites are presented
                on this Site. For any loan reasons, you should connect with a consultation specialist before deciding
                your loan.</p>
        </div>

        <!-- Close button OUTSIDE the modal -->
        <div class="modal-close" id="closeModalBtn">✖</div>
    </div>


    <!-- FAQ Modal -->
    <div id="faqModal" class="modal-overlay">
        <div class="modal-content">
            <h2
                style="font-family: Days One;font-size: 30px; font-weight: 400; font-style: normal;line-height: normal;margin-bottom: 32px;">
                Frequently Asked Questions</h2>

            <p style="margin: 20px 0px;"><strong>1. What is Trusted Online Loans?</strong></p>
            <p><strong>Trusted Online Loans</strong> is a cash advance and personal loan online referral service on our
                website.

                If a customer is looking for a cash advance or personal loan online, we help connect them with a
                marketplace of companies who offer personal loans and cash advances. Our website features a secure form
                requesting information that lenders and/or lending partners within our cash advance and personal loan
                referral marketplace will use to decide whether they want to offer a customer a cash advance or personal
                loan. The information that they need in order to make cash advance or personal loan decisions about each
                customer includes name, address, home and work phone numbers, and email address. They also need a
                customer's birth date and social security number to comply with the US Patriot Act. The operator of this
                website can be reached by mail at Trusted Online Loans, 2803 Philadelphia Pike, Suite B #1020, Claymont,
                DE 19703, United States or by email. Customers can contact us if they want to discontinue using our loan
                referral service, or to change their communication preferences. Any questions about cash advance or
                personal loan amounts should be directed to the company from which a customer obtained his or her cash
                advance or personal loan.</p>

            <p style="margin: 20px 0px;"><strong>2. How much will the loan cost?</strong></p>
            <p>The cost of the loan and Annual Percentage Rate (APR) depend on several factors including but not limited
                to, credit history, stable source of income, and state law. Your APR also depends on how much you want
                to borrow and how quickly you want to repay the loan.
                The terms of your loan are disclosed during the loan request process when you are directed to the
                lender's and/or lending partner's loan agreement. This information is strictly between you and your
                lender and/or lending partner. Not all customers will be eligible for a loan or meet the criteria to
                receive the best terms or lowest interest rate.</p>

            <p style="margin: 20px 0px;"><strong>3. How soon can a personal loan or cash advance be made
                    available?</strong></p>
            <p>The time it takes to process a loan and transfer or ACH funds into an individual's account varies with
                each loan company, and also depends on the financial institution where the customer has their bank
                account. However, approved individuals can often receive their loan as soon as the next business day
                after approval.</p>

            <p style="margin: 20px 0px;"><strong>4. Why are you collecting my SSN and Bank Details?</strong></p>

            <p>Our network of lenders use your SSN and bank details to help them make a decision about whether or not to
                extend you a loan offer. The bank details also help the lender that you are connected to know how to
                send money to your account. Our websites are encrypted using industry recognized encryption technology
                to help keep your information safe. Additionally, lenders use the SSN to help ensure the identity of the
                applicant is really the person they say they are.</p>

            <p style="margin: 20px 0px;"><strong>5. Are you a lender?</strong></p>
            <p>No, we are not a lender. We work with several lenders to make up a network that can help you to find a
                loan. After submitting a request, if accepted, we will forward you to the lender's website where you
                will be able to learn more about your specific loan offer.</p>

            <p style="margin: 20px 0px;"><strong>6. What if I have bad credit?</strong></p>
            <p>We attempt to connect consumers with lenders regardless of your credit history. Requirements needed for a
                loan approval is based on each individual lender. Please review our How It Works page to determine if
                you have the basic requirements to qualify.</p>

            <p style="margin: 20px 0px;"><strong>7. Where do I find my ABA / Routing Number & account number?</strong>
            </p>
            <p>Please see the diagram below for instructions on how to find the information from your check book.
                Alternatively please call your bank for more information.</p>
            <div style="text-align: center;">
                <img src="https://loan.hanfincal.com/static/media/img1.22da9ce5.png" alt="Routing info example"
                    style="max-width:100%; height:auto;object-fit: cover;vertical-align: bottom; transition: all 0.5s ease;">
            </div>

            <p style="margin: 20px 0px;"><strong>8. What Happens If I Do Not Pay (Implications Of Non-Payment)?</strong>
            </p>
            <p><strong>Late/Partial Payments:</strong> IIf you do not pay the full amount of principal and interest by
                the agreed-upon payment date, you will likely be charged a new finance charge and payment date may be
                extended until your next pay date. This new finance charge may be a flat fee, or may be calculated by
                applying the proportionate amount of the finance charge to the unpaid loan amount. Review the late
                payment policy detailed in the loan documents provided to you by your lender and/or lending partner
                before signing your e-signature, and thereby agreeing to the loan terms.</p>
            <p><strong>No-Payment:</strong>Trusted Online Loans does not enforce payment. If you do not pay, your lender
                and/or lending partner may take legal action against you. Additional fees may apply to you in the event
                that you are unable to repay your loan. Information regarding your payment history, delinquency or
                defaults on the account may be reported to a third party consumer reporting agency and may impact your
                credit rating.</p>
            <p><strong>Loan Renewals:</strong>Trusted Online Loans will not provide a renewal for you. Your lender
                and/or lending partner has renewal policies which will vary. With every extension or renewal, a new
                finance charge ("Extension Fee") may be assessed by the lender and/or lending partner, and the
                re-payment date may be extended until the borrower's next pay date. The finance charges can be
                significant depending on the lender and/or lending partner.</p>

            <p><strong>Collection Practices:</strong>Collections practices of lenders and/or lending partners and/or any
                assignee(s) will be in accordance with the principles of applicable federal regulations. Lenders and/or
                lending partners may attempt to contact borrowers via one or more authorized methods, including phone
                calls and emails, to arrange for payment. Impact to Credit Score: Your lender and/or lending partner may
                report late or missed payments to the credit bureaus. This can negatively affect your credit score.
                Consumers with credit difficulties should seek credit counseling.</p>

            <p style="margin: 20px 0px;"><strong>9. What Are Personal Loans Or Installment Loans?</strong></p>
            <p>Personal and/or installment loans typically range between $100 and $5,000. They can be used for almost
                any personal expense, from paying off credit cards and medical bills to financing home repairs or even a
                much-needed vacation. Personal loans are commonly called installment loans because they are typically
                paid back in monthly or bi-monthly installments over an extended period of time. They can be a
                convenient alternative to bank loans or high-interest credit cards, with online loan request forms and
                no-hassle automated repayment.</p>

            <p style="margin: 20px 0px;"><strong>10. How Much Can I Receive?</strong></p>
            <p>Qualified loan amounts can vary and are based on personal eligibility. Approved loan amounts can range between $100 to $5,000.</p>

            <p style="margin: 20px 0px;"><strong>11. What is the cost?</strong></p>
            <p>There is no cost to use Hanfincal.com. The fees of the loan will vary depending upon the amount and the lender. The lender will inform you of the fees for the loan which may vary depending on the lender.</p>
            
            <p style="margin: 20px 0px;"><strong>12. Loan Renewal Policies</strong></p>
            <p>Loan renewal options are not always available. It is therefore advisable to clarify whether the option is available with your lender. Be sure to carefully peruse the renewal policy presented in the agreement before you sign the documents.</p>

            <p style="margin: 20px 0px;"><strong>13. Representative Example of APR</strong></p>
            <p>If you borrow $2,500 over a term of 1 year with an APR of 10% and a fee of 3%, you will pay $219,79 each month. The total amount payable will be $2,637, with a total interest of $137,48.</p>

            <p style="margin: 20px 0px;"><strong>14. Collection Practices</strong></p>
            <p>Trusted Online Loans is not a lender. As such, we are not involved in any debt collection practices and cannot make you aware of any of them. Your lender will specify their collection practices in your loan agreement. If you have any questions regarding the issue, please, address them to your lender. For more information visit our page for Responsible Lending. Hanfincal.com itself isn't involved in debt collection.</p>
        </div>

        <!-- Close Button (bottom center) -->
        <div class="modal-close" id="closeFaqModal">✖</div>
    </div>

    <script>
        // Modal scripts
        const modal = document.getElementById('ratesModal');
        const openBtn = document.getElementById('openRatesModal');
        const closeBtn = document.getElementById('closeModalBtn');

        openBtn.addEventListener('click', function (e) {
            e.preventDefault();
            modal.style.display = 'flex';
        });

        closeBtn.addEventListener('click', function () {
            modal.style.display = 'none';
        });

        // Optional: close modal when clicking outside the modal content
        window.addEventListener('click', function (e) {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });

        // FAQ Modal JS
        const faqModal = document.getElementById('faqModal');
        const openFaqBtn = document.getElementById('openFaqModal');
        const closeFaqBtn = document.getElementById('closeFaqModal');

        openFaqBtn.addEventListener('click', function (e) {
            e.preventDefault();
            faqModal.style.display = 'flex';
        });

        closeFaqBtn.addEventListener('click', function () {
            faqModal.style.display = 'none';
        });

        window.addEventListener('click', function (e) {
            if (e.target === faqModal) {
                faqModal.style.display = 'none';
            }
        });

        // Form submission script
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