<!-- ======= UI (Repayment Schedule + Adjustable Down Payment) ======= -->
<div class="col-12 p-3">
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 p-3">
      <div class="card shadow-sm p-2">
        <div class="container mt-4">
          <h2 class="mb-4">Pay Small Small Calculator</h2>

          <!-- Result -->
          <div id="result" class="card mt-4" style="display:none;">
            <div class="card-body row" id="resultBody"></div>
          </div>

          <!-- Form -->
          <form id="fareForm" onsubmit="return false;">
            <div class="row mb-3">

              <!-- Travel Date -->
              <div class="col-sm-6">
                <div class="mb-3">
                  <label for="date" class="form-label">Travel Date:</label>
                  <input type="date" id="date" name="date" class="form-control" required onchange="updatePlans()">
                </div>
              </div>

              <!-- Fare -->
              <div class="col-sm-6">
                <div class="mb-3">
                  <label for="cost" class="form-label">Cost Of Fare (₦):</label>
                  <input type="number" id="cost" name="cost" class="form-control" min="0" step="0.01" required oninput="updateDownPaymentDisplay()">
                </div>
              </div>

              <!-- Down Payment Percentage & Value -->
              <div class="col-sm-6">
                <div class="mb-3">
                  <label for="downPercent" class="form-label">Down Payment (%):</label>
                  <select id="downPercent" class="form-select" onchange="updateDownPaymentDisplay()">
                    <!-- 30–90% options -->
                  </select>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="mb-3">
                  <label for="downValue" class="form-label">Down Payment Value (₦):</label>
                  <input type="text" id="downValue" class="form-control" readonly>
                </div>
              </div>

              <!-- Stretch Option -->
              <div class="col-sm-6" id="stretchDiv">
                <div class="mb-3">
                  <label for="strech" class="form-label">Option Of Stretch:</label>
                  <select name="strech" id="strech" class="form-select" onchange="updatePlans()">
                    <option value=""> Select Option</option>
                    <option value="weekly"> Weekly</option>
                    <option value="bi-weekly"> Bi-weekly</option>
                    <option value="monthly"> Monthly</option>
                  </select>
                </div>
              </div>

              <!-- Payment Plan -->
              <div class="col-sm-6">
                <div class="mb-3">
                  <label for="plan" class="form-label">Payment Plan:</label>
                  <select name="plan" id="plan" class="form-select">
                    <option value=""> Select Option</option>
                  </select>
                  <div id="planHint" class="form-text">
                    <small>Plan options will be generated based on travel date and chosen stretch.</small>
                  </div>
                </div>
              </div>

              <div class="col-sm-12">
                <button type="button" class="btn btn-primary" onclick="calculatePayment()">Calculate</button>
              </div>
            </div>
          </form>

          <!-- Result -->
          <div id="result" class="card mt-3" style="display:none;">
            <div class="card-body" id="resultBody"></div>
          </div>

        </div>
      </div>
    </div>
    <div class="col-md-3"></div>
  </div>
</div>

<script>
  // === Initialize Down Payment Select ===
  window.addEventListener("DOMContentLoaded", () => {
    const downSelect = document.getElementById("downPercent");
    for (let i = 30; i <= 90; i += 10) {
      const opt = document.createElement("option");
      opt.value = i / 100;
      opt.textContent = `${i}%`;
      if (i === 30) opt.selected = true;
      downSelect.appendChild(opt);
    }
    updateDownPaymentDisplay();
  });

  // === Update ₦ Value When Fare or % Changes ===
  function updateDownPaymentDisplay() {
    const fare = parseFloat(document.getElementById("cost").value) || 0;
    const percent = parseFloat(document.getElementById("downPercent").value) || 0.3;
    const downValue = fare * percent;
    document.getElementById("downValue").value = `₦${downValue.toLocaleString(undefined, {minimumFractionDigits:2})}`;
  }

  // === Existing Functions ===
  function updatePlans() {
    const stretch = document.getElementById("strech").value;
    const travelInput = document.getElementById("date").value;
    const planSelect = document.getElementById("plan");
    planSelect.innerHTML = '<option value=""> Select Option</option>';
    document.getElementById("result").style.display = "none";

    if (!travelInput || !stretch) return;

    const today = new Date();
    const travelDate = new Date(travelInput);

    const safeTravelDate = new Date(travelDate.getTime() - (14 * 24 * 60 * 60 * 1000));
    const diffMs = safeTravelDate.getTime() - today.getTime();
    const diffDays = Math.floor(diffMs / (1000 * 60 * 60 * 24));

    if (diffDays < 0) {
      planSelect.innerHTML = '<option value="">❌ No payment plan available (must complete payment 2 weeks before travel)</option>';
      return;
    }

    let maxPeriods = 0, label = "";
    if (stretch === "weekly")    { maxPeriods = Math.floor(diffDays / 7);  label = "week"; }
    if (stretch === "bi-weekly") { maxPeriods = Math.floor(diffDays / 14); label = "bi-week"; }
    if (stretch === "monthly")   { maxPeriods = Math.floor(diffDays / 30); label = "month"; }
    maxPeriods = Math.min(maxPeriods, 5);

    if (maxPeriods < 1) {
      planSelect.innerHTML = '<option value="">❌ No payment plan available (not enough time before travel)</option>';
      return;
    }

    for (let i = 1; i <= maxPeriods; i++) {
      const opt = document.createElement("option");
      opt.value = i;
      opt.textContent = `${i} ${i === 1 ? label : label + "s"}`;
      planSelect.appendChild(opt);
    }
  }

  function calculatePayment() {
    const fare       = parseFloat(document.getElementById("cost").value);
    const planValue  = parseInt(document.getElementById("plan").value, 10);
    const stretch    = document.getElementById("strech").value;
    const travelInput= document.getElementById("date").value;
    const downPaymentPercent = parseFloat(document.getElementById("downPercent").value);

    if (isNaN(fare) || fare <= 0)           { alert("Enter a valid fare."); return; }
    if (isNaN(planValue) || planValue <= 0) { alert("Select a valid plan."); return; }
    if (!stretch)                           { alert("Select your stretch option."); return; }

    const downPayment = fare * downPaymentPercent;
    renderSchedule(fare, planValue, stretch, new Date(travelInput), downPayment, downPaymentPercent);
  }

  function renderSchedule(fare, planValue, stretch, travelDate, downPayment, downPaymentPercent) {
    const repayTotal = fare - downPayment;
    const equalPercent = 100 / planValue;
    const percentages = Array(planValue).fill(equalPercent);

    let scheduleHtml  = `<h5>Payment Breakdown</h5>`;
    scheduleHtml     += `<p>Fare: ₦${fare.toLocaleString()}</p>`;
    scheduleHtml     += `<p>Down Payment (${(downPaymentPercent * 100)}%): ₦${downPayment.toLocaleString()}</p>`;
    scheduleHtml     += `<p>Remaining: ₦${repayTotal.toLocaleString()}</p>`;
    scheduleHtml     += `<hr/><h5 class="mt-3">Repayment Schedule</h5>`;
    scheduleHtml     += `<div id="installmentSchedule"></div>`;

    document.getElementById("resultBody").innerHTML = scheduleHtml;
    document.getElementById("result").style.display = "block";

    renderInstallments(percentages, fare, planValue, stretch, travelDate, downPayment);
  }

  function renderInstallments(percentages, fare, planValue, stretch, travelDate, downPayment) {
    const repayTotal = fare - downPayment;
    let currentBalance = repayTotal;

    let interestRate = 0.05;
    if (stretch === "weekly")    interestRate = 0.0125;
    if (stretch === "bi-weekly") interestRate = 0.025;
    if (stretch === "monthly")   interestRate = 0.05;

    let dates = [];
    let dueDate = new Date(travelDate.getTime() - (14 * 24 * 60 * 60 * 1000));
    const stepDays = (stretch === "weekly") ? 7 : (stretch === "bi-weekly" ? 14 : 30);
    for (let i = planValue; i >= 1; i--) {
      dates.unshift(new Date(dueDate));
      dueDate.setDate(dueDate.getDate() - stepDays);
    }

    const suffixes = ["1st", "2nd", "3rd", "4th", "5th"];
    let scheduleHtml = `<ol>`;
    let totalInterestPaid = 0;

    for (let i = 0; i < planValue; i++) {
      const principal = (repayTotal * percentages[i]) / 100;
      const interest = currentBalance * interestRate;
      const installmentAmount = principal + interest;
      totalInterestPaid += interest;

      scheduleHtml += `<li>
        <strong>${suffixes[i] || (i + 1) + "th"} Payment:</strong><br>
        Principal ₦${principal.toLocaleString(undefined, {minimumFractionDigits:2})} 
        + Interest ₦${interest.toLocaleString(undefined, {minimumFractionDigits:2})}
        = <strong>₦${installmentAmount.toLocaleString(undefined, {minimumFractionDigits:2})}</strong><br>
        <strong>(Due: ${dates[i].toDateString()})</strong><br><br>
      </li>`;
    }

    scheduleHtml += `</ol>`;
    scheduleHtml += `<p><strong>Total interest:</strong> ₦${totalInterestPaid.toLocaleString(undefined, {minimumFractionDigits:2})}</p>`;
    scheduleHtml += `<p><strong>Grand total (Fare + Interest):</strong> ₦${(fare + totalInterestPaid).toLocaleString(undefined, {minimumFractionDigits:2})}</p>`;
    document.getElementById("installmentSchedule").innerHTML = scheduleHtml;
  }
</script>
