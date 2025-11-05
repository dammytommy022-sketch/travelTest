<!-- ======= UI (your existing layout kept) ======= -->
<div class="col-12 p-3">
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 p-3">
      <div class="card shadow-sm p-2">
        <div class="container mt-4">
          <h2 class="mb-4">Pay Small Small Calculator</h2>

          <!-- Result (top) -->
          <div id="result" class="card mt-4" style="display:none;">
            <div class="card-body row" id="resultBody">
                
            </div> 
          </div>

          <!-- Form -->
          <form id="fareForm" onsubmit="return false;">
            <div class="row mb-3">
              <div class="col-sm-6">
                <div class="mb-3">
                  <label for="payment" class="form-label">Payment Completion Option:</label>
                  <select name="payment" id="payment" class="form-select" required onchange="toggleCollateralAndPlans()">
                    <option value=""> Select Option</option>
                    <option value="before"> Before Travel Date</option>
                    <option value="after"> After Travel Date</option>
                  </select> 
                </div>
              </div>

              <div class="col-sm-6" id="collateralDiv" style="display:none;">
                <div class="mb-3">
                  <label for="collateral" class="form-label">Collateral:</label>
                  <select id="collateral" class="form-select">
                    <option value="">Select Collateral</option>
                    <option value="House">House</option>
                    <option value="Land">Land</option>
                    <option value="Gold">Gold</option>
                  </select>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="mb-3">
                  <label for="date" class="form-label">Travel Date:</label>
                  <input type="date" id="date" name="date" class="form-control" required onchange="updatePlans()">
                </div>
              </div>

              <div class="col-sm-6">
                <div class="mb-3">
                  <label for="cost" class="form-label">Cost Of Fare (₦):</label>
                  <input type="number" id="cost" name="cost" class="form-control" min="0" step="0.01" required>
                </div>
              </div>

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

              <div class="col-sm-12">
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

          <!-- Result (bottom duplicate kept to match your markup) -->
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
  /* =========================
     Utilities & Global State
  ========================== */
  const floorTo5 = (n) => Math.max(0, Math.floor(n / 5) * 5);
  const ceilTo5  = (n) => Math.min(100, Math.ceil(n / 5) * 5);

  // remembers which installments the user edited (locked)
  // keys are 0-based indexes, values are the locked percentages
  let lockedPercents = {};

  /* =========================
     Collateral / Plan Toggles
  ========================== */
  function toggleCollateralAndPlans() {
    const option = document.getElementById("payment").value;
    const collateralDiv = document.getElementById("collateralDiv");
    const stretchDiv = document.getElementById("stretchDiv");
    document.getElementById("plan").innerHTML = '<option value=""> Select Option</option>';

    if (option === "after") {
      collateralDiv.style.display = "block";
      stretchDiv.style.display = "none"; // after travel = monthly only
    } else {
      collateralDiv.style.display = "none";
      stretchDiv.style.display = "block";
    }
    updatePlans();
  }

  function updatePlans() {
    const option = document.getElementById("payment").value;
    const stretch = document.getElementById("strech").value;
    const travelInput = document.getElementById("date").value;
    const planSelect = document.getElementById("plan");
    planSelect.innerHTML = '<option value=""> Select Option</option>';
    document.getElementById("result").style.display = "none";

    if (!travelInput) return;
    const today = new Date();
    const travelDate = new Date(travelInput);

    if (option === "before") {
      if (!stretch) return;

      const safeTravelDate = new Date(travelDate.getTime() - (14 * 24 * 60 * 60 * 1000)); // 2 weeks before travel
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
        
        // ✅ cap to max 5
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

    
    if (option === "after") {
      const capped = Math.min(6, 5); // force max 5
      for (let i = 1; i <= capped; i++) {
        const opt = document.createElement("option");
        opt.value = i;
        opt.textContent = `${i} month${i > 1 ? "s" : ""}`;
        planSelect.appendChild(opt);
      }
    }

  }

  /* =========================
     Calculation Entrypoint
  ========================== */
  function calculatePayment() {
    const fare       = parseFloat(document.getElementById("cost").value);
    const option     = document.getElementById("payment").value;
    const planValue  = parseInt(document.getElementById("plan").value, 10);
    const stretch    = document.getElementById("strech").value;
    const travelInput= document.getElementById("date").value;
    const collateral = document.getElementById("collateral").value;

    if (isNaN(fare) || fare <= 0)                 { alert("Enter a valid fare."); return; }
    if (!option)                                  { alert("Select Payment Completion Option."); return; }
    if (isNaN(planValue) || planValue <= 0)       { alert("Select a valid plan."); return; }
    if (option === "after" && !collateral)        { alert("Select collateral for after-travel option."); return; }

    const today      = new Date();
    const travelDate = new Date(travelInput);
    const diffDays   = Math.ceil((travelDate - today) / (1000 * 60 * 60 * 24));

    // determine mandatory first payment %
    let firstPaymentPercent = 0.6;
    if (option === "before") {
      if (diffDays <= 42)      firstPaymentPercent = 0.8;
      else if (diffDays <= 70) firstPaymentPercent = 0.7;
      else                     firstPaymentPercent = 0.6;
    } else if (option === "after") {
      firstPaymentPercent = (planValue <= 2) ? 0.7 : 0.6;
    }

    const firstPayment = fare * firstPaymentPercent;

    // Initial render of schedule + percent editor
    recalcSchedule(fare, option, planValue, stretch, travelDate, collateral, firstPayment, firstPaymentPercent);
  }

  /* ==========================================
     Render schedule + Build the percent editor
  =========================================== */
  function recalcSchedule(fare, option, planValue, stretch, travelDate, collateral, firstPayment, firstPaymentPercent) {
    // reset locks for this calculation session
    lockedPercents = {};

    let scheduleHtml  = `<h5>Payment Breakdown</h5>`;
    scheduleHtml     += `<p>Fare: ₦${fare.toFixed(2)}</p>`;
    scheduleHtml     += `<p>Initial Payment (${(firstPaymentPercent * 100)}%): ₦${firstPayment.toFixed(2)}</p>`;
    scheduleHtml     += `<p>Remaining: ₦${(fare - firstPayment).toFixed(2)}</p>`;
    if (option === "after") scheduleHtml += `<p><strong>Collateral:</strong> ${collateral}</p>`;
    scheduleHtml     += `<hr/><h6>Adjust Repayment Percentages</h6>`;
    scheduleHtml     += `<p>Total to repay: ₦${(fare - firstPayment).toFixed(2)}</p>`;

    // equal split defaults (integers; we’ll then snap to 5 in the dropdowns)
    //const equalEach = Math.floor(100 / planValue);
    //const remainder = 100 - (equalEach * planValue);
    let defaults = [];
    if (planValue === 3) {
      defaults = [40, 30, 30];   // ✅ special case
    } else {
      // equal split, rounded to nearest 5
      let base = Math.floor(100 / planValue);
      let rem  = 100 - (base * planValue);
      for (let i = 0; i < planValue; i++) {
        let d = base + (i === planValue - 1 ? rem : 0);
        defaults.push(ceilTo5(d)); // snap to 5 upwards 
      }
    }
    
    // then build the dropdowns
    for (let i = 1; i <= planValue; i++) {
      const minFirst = ceilTo5(100 / planValue);
      const minForThis = (i === 1) ? minFirst : 0;
      const def = Math.max(minForThis, defaults[i-1]);
    
      scheduleHtml += `
        <div class="col-sm-4 mb-2">
          <label>Installment ${i} (%)</label> 
          <select class="form-control repayPercent" data-index="${i-1}">
            ${generateOptions(def, minForThis)}
          </select> 
        </div>`;
    }

    

    scheduleHtml += `</div></form>`;
    scheduleHtml += `<hr/><div id="installmentSchedule"></div>`;

    document.getElementById("resultBody").innerHTML = scheduleHtml;
    document.getElementById("result").style.display = "block";

    // attach live listeners (auto-balance)
    document.querySelectorAll(".repayPercent").forEach(sel => {
      sel.addEventListener("change", (e) => onPercentChanged(e, fare, option, planValue, stretch, travelDate, collateral, firstPayment));
    });

    // initial render using current select values
    const initialPercents = readPercents();
    renderInstallments(initialPercents, fare, option, planValue, stretch, travelDate, collateral, firstPayment);
  }

  /* ==========================================
     Generate dropdown options (5% steps)
     - For first installment, min is >= system split (ceil to 5)
     - For others, min is 0
  =========================================== */
  function generateOptions(selected, minVal = 0) {
    let opts = "";
    for (let v = minVal; v <= 100; v += 5) {
      opts += `<option value="${v}" ${v === selected ? "selected" : ""}>${v}</option>`;
    }
    return opts;
  }

  /* ==========================================
     Read current percentages from the editor
  =========================================== */
  function readPercents() {
    const selects = document.querySelectorAll(".repayPercent");
    return Array.from(selects).map(s => parseInt(s.value, 10));
  }

  /* ==========================================
     Live change handler -> auto-balance with locks
  =========================================== */
  function onPercentChanged(e, fare, option, planValue, stretch, travelDate, collateral, firstPayment) {
    const selects = document.querySelectorAll(".repayPercent");
    const idx = parseInt(e.target.dataset.index, 10); // 0-based index of changed installment
    let values = readPercents();

    // Enforce first installment minimum (ceil(100/N) to step of 5)
    const minFirst = ceilTo5(100 / planValue);
    if (idx === 0 && values[0] < minFirst) {
      values[0] = minFirst;
      selects[0].value = minFirst;
    }

    // Lock the changed installment
    lockedPercents[idx] = values[idx];

    // Clamp changed value so total of all locks <= 100
    const sumLockedExceptChanged = Object.entries(lockedPercents)
      .filter(([k]) => parseInt(k,10) !== idx)
      .reduce((a, [,v]) => a + v, 0);

    let maxAllowed = 100 - sumLockedExceptChanged;
    maxAllowed = floorTo5(maxAllowed); // keep in 5s

    if (values[idx] > maxAllowed) {
      values[idx] = maxAllowed;
      lockedPercents[idx] = maxAllowed;
      selects[idx].value = maxAllowed;
    }

    // Build list of unlocked indexes
    const unlocked = [];
    for (let i = 0; i < planValue; i++) {
      if (!(i in lockedPercents)) unlocked.push(i);
    }

    // Distribute remaining across unlocked in 5% chunks
    const sumLocked = Object.values(lockedPercents).reduce((a,b)=>a+b,0);
    let remaining = 100 - sumLocked;           // this is guaranteed to be multiple of 5
    const per = (unlocked.length > 0) ? floorTo5(remaining / unlocked.length) : 0;
    let left = remaining - per * unlocked.length; // multiple of 5

    unlocked.forEach((i, j) => {
      values[i] = per + (left > 0 ? 5 : 0);
      if (left > 0) left -= 5;
    });

    // Write values back to dropdowns
    values.forEach((v, i) => { selects[i].value = v; });

    // Render schedule with new percentages
    renderInstallments(values, fare, option, planValue, stretch, travelDate, collateral, firstPayment);
  }

  /* ==========================================
     Render the installment schedule & totals
     - Interest is applied on current balance each period
  =========================================== */
  function renderInstallments(percentages, fare, option, planValue, stretch, travelDate, collateral, firstPayment) {
    const repayTotal = fare - firstPayment;
    let currentBalance = repayTotal;

    // Interest rate by stretch / option
    let interestRate = 0.05;
    if (option === "before") {
      if (stretch === "weekly")    interestRate = 0.0125;
      if (stretch === "bi-weekly") interestRate = 0.025;
      if (stretch === "monthly")   interestRate = 0.05;
    } else {
      interestRate = 0.05; // after travel (monthly only)
    }

    // Build due dates
    let dates = [];
    if (option === "before") {
      let dueDate = new Date(travelDate.getTime() - (14 * 24 * 60 * 60 * 1000)); // 2 weeks before travel
      const stepDays = (stretch === "weekly") ? 7 : (stretch === "bi-weekly" ? 14 : 30);
      for (let i = planValue; i >= 1; i--) {
        dates.unshift(new Date(dueDate));
        dueDate.setDate(dueDate.getDate() - stepDays);
      }
    } else {
      let dueDate = new Date(travelDate);
      for (let i = 1; i <= planValue; i++) {
        dueDate.setMonth(dueDate.getMonth() + 1);
        dates.push(new Date(dueDate));
      }
    }
 
    // Build schedule list
    let scheduleHtml = `<ol>`;
    let totalInterestPaid = 0;

    for (let i = 0; i < planValue; i++) {
      // principal slice from user percentages (last one will naturally fit since sum=100)
      let principal = (repayTotal * percentages[i]) / 100;

      // charge interest on the CURRENT balance first
      const interest = currentBalance * interestRate;
      const installmentAmount = principal + interest;

      totalInterestPaid += interest;
      currentBalance -= principal;

      scheduleHtml += `<li>
        <strong>Payment ${i+1} (Due: ${dates[i].toDateString()}):</strong>
        Principal ₦${principal.toFixed(2)} + Interest ₦${interest.toFixed(2)}
        = <strong>₦${installmentAmount.toFixed(2)}</strong>
        <br/><small>Remaining: ₦${Math.max(currentBalance, 0).toFixed(2)}</small>
      </li>`;
    }

    scheduleHtml += `</ol>`;
    scheduleHtml += `<p><strong>Total interest:</strong> ₦${totalInterestPaid.toFixed(2)}</p>`;
    scheduleHtml += `<p><strong>Grand total (Fare + Interest):</strong> ₦${(fare + totalInterestPaid).toFixed(2)}</p>`;

    document.getElementById("installmentSchedule").innerHTML = scheduleHtml;
  }
</script>
