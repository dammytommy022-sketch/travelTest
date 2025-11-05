<!-- ======= Pay Small Small Calculator (Up to 5 Months Repayment) ======= -->
<div class="col-12 p-3">
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 p-3">
      <div class="card shadow-sm p-3">
        <div class="container mt-4">
          <h2 class="mb-4">Pay Small Small Calculator</h2>
          <!-- Result -->
          <div id="result" class="card mt-4 mb-4" style="display:none;">
            <div class="card-body" id="resultBody"></div>
          </div>

          <!-- Form -->
          <form id="fareForm" onsubmit="return false;">
            <div class="row mb-3">

              <!-- Travel Date -->
              <div class="col-sm-6 mb-3">
                <label for="date" class="form-label">Travel Date:</label>
                <input type="date" id="date" name="date" class="form-control" required onchange="updateRepaymentOptions()">
              </div>

              <!-- Fare -->
              <div class="col-sm-6 mb-3">
                <label for="cost" class="form-label">Cost Of Fare (₦):</label>
                <input type="number" id="cost" name="cost" class="form-control" min="0" step="0.01" required oninput="updateDownPaymentValue()">
              </div>

              <!-- Down Payment % -->
              <div class="col-sm-6 mb-3">
                <label for="downPercent" class="form-label">Down Payment (%):</label>
                <select id="downPercent" class="form-select" onchange="updateDownPaymentValue()">
                  <option value="30">30%</option>
                  <option value="40">40%</option>
                  <option value="50">50%</option>
                  <option value="60">60%</option>
                  <option value="70">70%</option>
                  <option value="80">80%</option>
                  <option value="90">90%</option>
                </select>
              </div>

              <!-- Down Payment Value -->
              <div class="col-sm-6 mb-3">
                <label for="downValue" class="form-label">Equivalent Value (₦):</label>
                <input type="text" id="downValue" class="form-control" readonly>
              </div>

              <!-- Repayment Plan -->
              <div class="col-sm-12 mb-3">
                <label for="repayment" class="form-label">When do you want to pay back?</label>
                <select id="repayment" class="form-select">
                  <option value="">Select Option</option>
                </select>
              </div>

              <div class="col-sm-12">
                <button type="button" class="btn btn-primary" onclick="calculatePayment()">Calculate</button>
              </div>

            </div>
          </form>

          

        </div>
      </div>
    </div>
    <div class="col-md-3"></div>
  </div>
</div>

<script>
  function formatNaira(value) {
    return value.toLocaleString(undefined, { minimumFractionDigits: 2 });
  }

  function updateDownPaymentValue() {
    const cost = parseFloat(document.getElementById("cost").value) || 0;
    const percent = parseFloat(document.getElementById("downPercent").value) || 0;
    const downValue = (cost * percent) / 100;
    document.getElementById("downValue").value = downValue ? `₦${formatNaira(downValue)}` : "";
  }

  function updateRepaymentOptions() {
    const travelInput = document.getElementById("date").value;
    const repaymentSelect = document.getElementById("repayment");
    repaymentSelect.innerHTML = '<option value="">Select Option</option>';
    document.getElementById("result").style.display = "none";

    if (!travelInput) return;

    const today = new Date();
    const travelDate = new Date(travelInput);
    const safeTravelDate = new Date(travelDate.getTime() - (14 * 24 * 60 * 60 * 1000));
    const diffDays = Math.floor((safeTravelDate - today) / (1000 * 60 * 60 * 24));

    const options = [
      { label: "24 hours", days: 1 },
      { label: "48 hours", days: 2 },
      { label: "72 hours", days: 3 },
      { label: "1 week", days: 7 },
      { label: "2 weeks", days: 14 },
      { label: "3 weeks", days: 21 },
      { label: "1 month", days: 30 },
      { label: "2 months", days: 60 },
      { label: "3 months", days: 90 },
      { label: "4 months", days: 120 },
      { label: "5 months", days: 150 }
    ];

    options.forEach(opt => {
      if (diffDays >= opt.days) {
        const option = document.createElement("option");
        option.value = opt.label;
        option.textContent = opt.label;
        repaymentSelect.appendChild(option);
      }
    });
  }

  function calculatePayment() {
    const fare = parseFloat(document.getElementById("cost").value);
    const repaymentOption = document.getElementById("repayment").value;
    const downPercent = parseFloat(document.getElementById("downPercent").value);
    const travelInput = document.getElementById("date").value;

    if (isNaN(fare) || fare <= 0) { alert("Enter a valid fare."); return; }
    if (!repaymentOption) { alert("Select when you want to pay back."); return; }
    if (!travelInput) { alert("Select travel date."); return; }

    const downPayment = fare * (downPercent / 100);
    const remaining = fare - downPayment;

    renderSchedule(fare, repaymentOption, new Date(travelInput), downPayment, downPercent, remaining);
  }

  function renderSchedule(fare, repaymentOption, travelDate, downPayment, downPercent, remaining) {
    const interestRatePerMonth = 0.05; // 5% flat per month
    let months = 1;
    let schedule = [];

    // Splits
    switch (repaymentOption) {
      case "2 months":
        months = 2;
        schedule = [0.5, 0.5];
        break;
      case "3 months":
        months = 3;
        schedule = [0.4, 0.3, 0.3];
        break;
      case "4 months":
        months = 4;
        schedule = [0.25, 0.25, 0.25, 0.25];
        break;
      case "5 months":
        months = 5;
        schedule = [0.2, 0.2, 0.2, 0.2, 0.2];
        break;
      default:
        months = 1;
        schedule = [1.0];
    }

    // Interest applied per month (on full remaining balance)
    const totalInterest = remaining * interestRatePerMonth * months;
    const totalToPay = remaining + totalInterest;

    let scheduleHtml = `
      <h5>Payment Breakdown</h5>
      <p>Cost of Fare: ₦${formatNaira(fare)}</p>
      <p>Down Payment (${downPercent}%): ₦${formatNaira(downPayment)}</p>
      <p>Remaining Balance: ₦${formatNaira(remaining)}</p>
      <hr/>
      <h5>Repayment Schedule</h5>
      <ol>
    `;

    let suffixes = ["1st", "2nd", "3rd", "4th", "5th"];
    let startDate = new Date(); // Start from today (or payment date)
    let dueDate = new Date(startDate);
    const stepDays = repaymentOption.includes("month")
      ? 30
      : repaymentOption.includes("week")
      ? 7
      : repaymentOption.includes("hour")
      ? 1
      : 0;

    // Generate payments going forward
    for (let i = 0; i < schedule.length; i++) {
      const portion = schedule[i];
      const interestPay = remaining * interestRatePerMonth;
      const remainPay = portion * remaining;
      const amount = remainPay + interestPay;

      // Move due date forward for each payment
      if (i > 0) dueDate.setDate(dueDate.getDate() + stepDays);

      scheduleHtml += `
        <li>
          <strong>${suffixes[i] || (i + 1) + "th"} Payment: Due on ${dueDate.toDateString()}</strong><br>
          Principal ₦${formatNaira(remainPay)} + Interest ₦${formatNaira(interestPay)}
          = <strong>₦${formatNaira(amount)}</strong><br>
        </li>`;
    }

    scheduleHtml += `</ol>`;
    scheduleHtml += `<p><strong>Total Payable:</strong> ₦${formatNaira(totalToPay + downPayment)}</p>`

    document.getElementById("resultBody").innerHTML = scheduleHtml;
    document.getElementById("result").style.display = "block";
  }
</script>
