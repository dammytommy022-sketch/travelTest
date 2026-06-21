<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard · TravelWheel Ground Transport</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'DM Sans', sans-serif; background: #f0f2f8; min-height: 100vh; color: #1a1a1a; font-size: 13.5px; }

        /* ── Top bar ── */
        .topbar { background: linear-gradient(135deg,#0d1883,#2d39b6); padding: 0 28px; height: 56px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 100; box-shadow: 0 2px 12px rgba(13,24,131,.25); }
        .topbar-left { display: flex; align-items: center; gap: 12px; }
        .topbar-logo { font-family: 'Playfair Display',serif; font-size: 17px; color: #fff; font-weight: 600; }
        .topbar-tag { background: rgba(255,255,255,.18); color: #fff; font-size: 10px; font-weight: 600; padding: 3px 9px; border-radius: 20px; letter-spacing: .05em; text-transform: uppercase; }
        .topbar-right { display: flex; align-items: center; gap: 14px; }
        .admin-name { color: rgba(255,255,255,.8); font-size: 12.5px; }
        .btn-logout { padding: 6px 14px; background: rgba(255,255,255,.15); color: #fff; border: 1px solid rgba(255,255,255,.25); border-radius: 8px; font-size: 12px; font-weight: 600; font-family: 'DM Sans',sans-serif; cursor: pointer; text-decoration: none; transition: background .2s; }
        .btn-logout:hover { background: rgba(255,255,255,.25); }

        /* ── Page ── */
        .page { max-width: 1300px; margin: 0 auto; padding: 24px 20px 80px; }

        /* ── Stats row ── */
        .stats-row { display: grid; grid-template-columns: repeat(6,1fr); gap: 12px; margin-bottom: 22px; }
        @media(max-width:900px) { .stats-row { grid-template-columns: repeat(3,1fr); } }
        @media(max-width:560px) { .stats-row { grid-template-columns: repeat(2,1fr); } }
        .stat-card { background: #fff; border-radius: 12px; border: 1px solid #e4e6f0; padding: 14px 16px; }
        .stat-label { font-size: 10px; font-weight: 700; color: #999; text-transform: uppercase; letter-spacing: .07em; margin-bottom: 5px; }
        .stat-value { font-size: 22px; font-weight: 700; color: #0d1883; }
        .stat-value.green { color: #1a7a4e; }
        .stat-value.orange { color: #c77c00; }

        /* ── Section heading ── */
        .section-head { font-family: 'Playfair Display',serif; font-size: 16px; font-weight: 600; color: #0d1883; margin-bottom: 14px; display: flex; align-items: center; gap: 8px; }
        .section-head::after { content:''; flex:1; height:1px; background:#e0e4f8; }

        /* ── Filter bar ── */
        .filter-bar { display: flex; gap: 10px; flex-wrap: wrap; align-items: center; background: #fff; border-radius: 12px; border: 1px solid #e4e6f0; padding: 12px 16px; margin-bottom: 16px; }
        .filter-bar input[type="text"] { flex:1; min-width:200px; padding:8px 12px; border:1.5px solid #dde0ee; border-radius:8px; font-size:13px; font-family:'DM Sans',sans-serif; outline:none; background:#fafbff; transition:border-color .2s; }
        .filter-bar input[type="text"]:focus { border-color:#0d1883; }
        .filter-bar select { padding:8px 12px; border:1.5px solid #dde0ee; border-radius:8px; font-size:13px; font-family:'DM Sans',sans-serif; outline:none; background:#fafbff; cursor:pointer; }
        .btn-search { padding:8px 18px; background:#0d1883; color:#fff; border:none; border-radius:8px; font-size:13px; font-weight:600; font-family:'DM Sans',sans-serif; cursor:pointer; }
        .btn-clear { padding:8px 14px; background:#f0f3ff; color:#0d1883; border:1px solid #c5cef8; border-radius:8px; font-size:12.5px; font-weight:600; font-family:'DM Sans',sans-serif; cursor:pointer; text-decoration:none; }

        /* ── Tabs ── */
        .tab-bar { display:flex; gap:4px; margin-bottom:14px; background:#fff; border-radius:12px; border:1px solid #e4e6f0; padding:5px; width:fit-content; }
        .tab-btn { padding:8px 20px; border-radius:8px; border:none; font-size:13px; font-weight:600; font-family:'DM Sans',sans-serif; cursor:pointer; color:#999; background:transparent; transition:all .2s; }
        .tab-btn.active { background:#0d1883; color:#fff; }
        .tab-btn:not(.active):hover { background:#f0f3ff; color:#0d1883; }
        .tab-panel { display:none; }
        .tab-panel.active { display:block; }

        /* ── Table ── */
        .table-wrap { background:#fff; border-radius:14px; border:1px solid #e4e6f0; overflow:hidden; }
        table { width:100%; border-collapse:collapse; }
        thead { background:#f7f8ff; }
        thead th { padding:11px 14px; font-size:10.5px; font-weight:700; color:#666; text-transform:uppercase; letter-spacing:.06em; text-align:left; border-bottom:1px solid #e4e6f0; white-space:nowrap; }
        tbody tr { border-bottom:1px solid #f0f2f8; transition:background .15s; }
        tbody tr:last-child { border-bottom:none; }
        tbody tr:hover { background:#fafbff; }
        tbody td { padding:11px 14px; vertical-align:middle; }
        .ref-code { font-family:monospace; font-size:11.5px; color:#0d1883; font-weight:600; }
        .badge { display:inline-flex; align-items:center; gap:4px; padding:3px 9px; border-radius:20px; font-size:11px; font-weight:700; white-space:nowrap; }
        .badge.paid      { background:#e8f8f0; color:#1a7a4e; border:1px solid #a8e6c4; }
        .badge.pending   { background:#fff8e8; color:#b07000; border:1px solid #f0d080; }
        .badge.confirmed { background:#eef1ff; color:#0d1883; border:1px solid #c5cef8; }
        .badge.cancelled { background:#fff0f0; color:#c0392b; border:1px solid #ffc5c5; }
        .badge.completed { background:#f0fff4; color:#276749; border:1px solid #9ae6b4; }

        /* ── Action buttons ── */
        .btn-action { padding:5px 11px; border-radius:7px; border:1.5px solid #dde0ee; background:#fff; font-size:11.5px; font-weight:600; font-family:'DM Sans',sans-serif; cursor:pointer; transition:all .15s; color:#1a1a1a; white-space:nowrap; }
        .btn-action:hover { border-color:#0d1883; color:#0d1883; background:#f0f3ff; }
        .btn-action.blue { background:#0d1883; color:#fff; border-color:#0d1883; }
        .btn-action.blue:hover { background:#0b1570; }
        .btn-action.green { background:#1a7a4e; color:#fff; border-color:#1a7a4e; }
        .btn-action.green:hover { background:#155d3c; }
        .btn-action.red { background:#c0392b; color:#fff; border-color:#c0392b; }
        .btn-action.red:hover { background:#a93226; }
        .actions-cell { display:flex; gap:5px; flex-wrap:wrap; }

        /* ── Pagination ── */
        .pagination-wrap { padding:14px 16px; display:flex; justify-content:space-between; align-items:center; border-top:1px solid #f0f2f8; }
        .pagination-wrap .info { font-size:12px; color:#888; }
        .pagination-wrap .links { display:flex; gap:4px; }
        .pagination-wrap .links a,
        .pagination-wrap .links span { padding:5px 10px; border-radius:6px; border:1px solid #dde0ee; font-size:12.5px; color:#555; text-decoration:none; background:#fff; }
        .pagination-wrap .links a:hover { border-color:#0d1883; color:#0d1883; }
        .pagination-wrap .links span.active { background:#0d1883; color:#fff; border-color:#0d1883; }

        /* ── Empty state ── */
        .empty-state { padding:50px 20px; text-align:center; color:#bbb; }
        .empty-state p { font-size:13px; margin-top:10px; }

        /* ── MODALS ── */
        .modal-overlay { display:none; position:fixed; inset:0; background:rgba(10,12,40,0.65); z-index:9999; align-items:center; justify-content:center; padding:20px; }
        .modal-overlay.open { display:flex; }
        .modal-box { background:#fff; border-radius:18px; width:100%; max-width:600px; max-height:90vh; overflow-y:auto; box-shadow:0 24px 60px rgba(13,24,131,.25); animation:mIn .22s ease both; }
        .modal-box.wide  { max-width:700px; }
        .modal-box.xwide { max-width:820px; }
        @keyframes mIn { from { opacity:0; transform:translateY(16px) scale(.97); } to { opacity:1; transform:none; } }
        .modal-head { background:linear-gradient(135deg,#0d1883,#2d39b6); padding:18px 22px; border-radius:18px 18px 0 0; display:flex; align-items:center; justify-content:space-between; }
        .modal-head h3 { font-family:'Playfair Display',serif; font-size:17px; color:#fff; margin:0; }
        .modal-head p { font-size:11.5px; color:rgba(255,255,255,.7); margin:3px 0 0; }
        .modal-close { width:28px; height:28px; background:rgba(255,255,255,.18); border:none; border-radius:50%; color:#fff; font-size:16px; cursor:pointer; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
        .modal-body { padding:20px 22px; }
        .modal-foot { padding:14px 22px 20px; display:flex; gap:10px; border-top:1px solid #f0f2f8; }

        /* ── Detail grid ── */
        .detail-grid { display:grid; grid-template-columns:1fr 1fr; gap:10px; margin-bottom:14px; }
        @media(max-width:500px) { .detail-grid { grid-template-columns:1fr; } }
        .detail-item { background:#f7f8ff; border:1px solid #e4e8f5; border-radius:8px; padding:9px 12px; }
        .detail-item.full { grid-column:1/-1; }
        .detail-item .d-label { font-size:9.5px; font-weight:700; color:#999; text-transform:uppercase; letter-spacing:.07em; margin-bottom:3px; }
        .detail-item .d-val { font-size:13px; font-weight:600; color:#1a1a1a; word-break:break-word; }
        .detail-item .d-val.blue { color:#0d1883; }
        .detail-section { font-size:10px; font-weight:700; color:#0d1883; text-transform:uppercase; letter-spacing:.1em; margin:14px 0 8px; display:flex; align-items:center; gap:6px; }
        .detail-section::after { content:''; flex:1; height:1px; background:#e0e4f8; }

        /* ── Form elements ── */
        .mform-row { display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-bottom:12px; }
        @media(max-width:500px) { .mform-row { grid-template-columns:1fr; } }
        .mform-group { display:flex; flex-direction:column; gap:4px; }
        .mform-group label { font-size:10.5px; font-weight:600; color:#555; text-transform:uppercase; letter-spacing:.04em; }
        .mform-group input,
        .mform-group select,
        .mform-group textarea { padding:9px 12px; border:1.5px solid #dde0ee; border-radius:8px; font-size:13px; font-family:'DM Sans',sans-serif; color:#1a1a1a; background:#fafbff; outline:none; transition:border-color .2s; }
        .mform-group input:focus,
        .mform-group select:focus,
        .mform-group textarea:focus { border-color:#0d1883; background:#fff; }
        .mform-group textarea { resize:vertical; min-height:70px; }
        .mform-group.full { grid-column:1/-1; }

        /* ── Buttons ── */
        .btn-modal-primary { flex:1; padding:11px; background:linear-gradient(135deg,#0d1883,#2d39b6); color:#fff; border:none; border-radius:9px; font-size:13px; font-weight:600; font-family:'DM Sans',sans-serif; cursor:pointer; transition:all .2s; }
        .btn-modal-primary:hover { background:linear-gradient(135deg,#0b1570,#1e2d9e); }
        .btn-modal-primary:disabled { opacity:.6; cursor:not-allowed; }
        .btn-modal-secondary { padding:11px 18px; background:#f0f3ff; color:#0d1883; border:1.5px solid #c5cef8; border-radius:9px; font-size:13px; font-weight:600; font-family:'DM Sans',sans-serif; cursor:pointer; }
        .btn-modal-green { flex:1; padding:11px; background:linear-gradient(135deg,#1a7a4e,#25a66a); color:#fff; border:none; border-radius:9px; font-size:13px; font-weight:600; font-family:'DM Sans',sans-serif; cursor:pointer; transition:all .2s; }
        .btn-modal-green:hover { background:linear-gradient(135deg,#155d3c,#1d8455); }
        .btn-modal-green:disabled { opacity:.6; cursor:not-allowed; }

        /* ── Toast ── */
        #toast { position:fixed; bottom:28px; right:24px; background:#1a1a1a; color:#fff; padding:12px 20px; border-radius:10px; font-size:13px; font-weight:500; z-index:99999; opacity:0; transform:translateY(10px); transition:opacity .3s,transform .3s; max-width:340px; pointer-events:none; }
        #toast.show { opacity:1; transform:translateY(0); }
        #toast.success { background:#1a7a4e; }
        #toast.error   { background:#c0392b; }

        /* ── Status change ── */
        .status-row { display:flex; gap:8px; align-items:center; }
        .status-row select { flex:1; padding:7px 10px; border:1.5px solid #dde0ee; border-radius:7px; font-size:12.5px; font-family:'DM Sans',sans-serif; outline:none; background:#fafbff; }
        .status-row button { padding:7px 14px; background:#0d1883; color:#fff; border:none; border-radius:7px; font-size:12.5px; font-weight:600; font-family:'DM Sans',sans-serif; cursor:pointer; }

        /* ── Alert ── */
        .modal-alert { padding:9px 13px; border-radius:8px; font-size:12.5px; margin-bottom:12px; display:none; }
        .modal-alert.error   { background:#fff0f0; border:1px solid #ffc5c5; color:#c0392b; }
        .modal-alert.success { background:#e8f8f0; border:1px solid #a8e6c4; color:#1a7a4e; }
        .modal-alert.show    { display:block; }

        /* ── Driver card ── */
        .driver-card { background:#eef1ff; border:1.5px solid #c5cef8; border-radius:10px; padding:12px 14px; margin-bottom:10px; display:flex; align-items:center; gap:12px; }
        .driver-avatar { width:40px; height:40px; border-radius:50%; background:#0d1883; color:#fff; display:flex; align-items:center; justify-content:center; font-size:16px; font-weight:700; flex-shrink:0; }
        .driver-card-info h4 { font-size:14px; font-weight:600; color:#0d1883; margin-bottom:2px; }
        .driver-card-info p  { font-size:12px; color:#666; }

        /* ── Rates table ── */
        .rates-table { width:100%; border-collapse:collapse; }
        .rates-table th { padding:9px 12px; font-size:10.5px; font-weight:700; color:#666; text-transform:uppercase; letter-spacing:.06em; text-align:left; border-bottom:1.5px solid #e4e6f0; background:#f7f8ff; }
        .rates-table td { padding:9px 12px; border-bottom:1px solid #f0f2f8; vertical-align:middle; }
        .rates-table tr:last-child td { border-bottom:none; }
        .rates-input { width:100%; padding:6px 10px; border:1.5px solid #dde0ee; border-radius:7px; font-size:13px; font-family:'DM Sans',sans-serif; background:#fafbff; outline:none; transition:border-color .2s; }
        .rates-input:focus { border-color:#0d1883; background:#fff; }
        .vehicle-label { font-size:12.5px; font-weight:600; text-transform:capitalize; }

        /* ── Fleet grid ── */
        .fleet-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(240px,1fr)); gap:12px; margin-top:12px; }
        .fleet-card { background:#fff; border:1.5px solid #e4e6f0; border-radius:12px; overflow:hidden; }
        .fleet-card-img { height:130px; background:#e8ecff; display:flex; align-items:center; justify-content:center; overflow:hidden; }
        .fleet-card-img img { width:100%; height:100%; object-fit:cover; }
        .fleet-card-img .no-img { font-size:36px; opacity:.35; }
        .fleet-card-body { padding:11px 13px; }
        .fleet-card-name { font-size:13.5px; font-weight:700; color:#1a1a1a; margin-bottom:2px; }
        .fleet-card-meta { font-size:11px; color:#888; margin-bottom:8px; }
        .fleet-card-tag { display:inline-flex; align-items:center; gap:4px; background:#eef1ff; color:#0d1883; font-size:9.5px; font-weight:700; padding:3px 8px; border-radius:20px; text-transform:uppercase; letter-spacing:.04em; margin-right:4px; }
        .fleet-card-tag.transfer { background:#e8f8f0; color:#1a7a4e; }
        .fleet-card-actions { display:flex; gap:6px; margin-top:9px; }
        .fc-inactive { opacity:.5; }

        /* ── Image upload preview ── */
        .img-preview-row { display:flex; flex-wrap:wrap; gap:8px; margin-top:8px; }
        .img-preview-item { width:72px; height:54px; border-radius:7px; overflow:hidden; border:1.5px solid #dde0ee; position:relative; }
        .img-preview-item img { width:100%; height:100%; object-fit:cover; }

        /* ── Pill tabs inside admin (for rates/fleet) ── */
        .admin-section { background:#fff; border-radius:16px; border:1px solid #e4e6f0; margin-bottom:22px; overflow:hidden; }
        .admin-section-head { padding:16px 20px; border-bottom:1px solid #e4e6f0; display:flex; align-items:center; justify-content:space-between; }
        .admin-section-title { font-family:'Playfair Display',serif; font-size:15px; font-weight:600; color:#0d1883; }
        .admin-section-body { padding:18px 20px; }
    </style>
</head>
<body>

<div class="topbar">
    <div class="topbar-left">
        <span class="topbar-logo">TravelWheel</span>
        <span class="topbar-tag">Ground Transport Admin</span>
    </div>
    <div class="topbar-right">
        <span class="admin-name">👤 {{ Session::get('admin_name') }}</span>
        <a href="{{ route('admin.logout') }}" class="btn-logout">Sign Out</a>
    </div>
</div>

<div class="page">

    {{-- ── STATS ── --}}
    <div class="stats-row">
        <div class="stat-card"><div class="stat-label">Car Hire Total</div><div class="stat-value">{{ $stats['ch_total'] }}</div></div>
        <div class="stat-card"><div class="stat-label">CH Paid</div><div class="stat-value green">{{ $stats['ch_paid'] }}</div></div>
        <div class="stat-card"><div class="stat-label">CH Pending</div><div class="stat-value orange">{{ $stats['ch_pending'] }}</div></div>
        <div class="stat-card"><div class="stat-label">Transfer Total</div><div class="stat-value">{{ $stats['tr_total'] }}</div></div>
        <div class="stat-card"><div class="stat-label">TR Paid</div><div class="stat-value green">{{ $stats['tr_paid'] }}</div></div>
        <div class="stat-card"><div class="stat-label">TR Pending</div><div class="stat-value orange">{{ $stats['tr_pending'] }}</div></div>
    </div>

    {{-- ══════════════════════════════════════════
         FIX 1 — RATES MANAGEMENT (with base prices)
    ══════════════════════════════════════════ --}}
    <div class="admin-section">
        <div class="admin-section-head">
            <div class="admin-section-title">&#9881;&#65039; Rate Management</div>
            <button class="btn-action blue" onclick="saveRates()">Save All Rates</button>
        </div>
        <div class="admin-section-body">
            <div class="modal-alert error"   id="ratesErr"></div>
            <div class="modal-alert success" id="ratesOk"></div>
            <p style="font-size:12px;color:#888;margin-bottom:14px;">
                Changes take effect immediately for new bookings. Base prices are the flat trip fee per category before fuel &amp; hourly costs are added.
            </p>

            {{-- Sub-tabs --}}
            <div style="display:flex;gap:4px;margin-bottom:16px;background:#f7f8ff;border-radius:10px;padding:4px;width:fit-content;border:1px solid #e4e6f0;">
                <button id="rTab_hire" class="tab-btn active" style="font-size:12px;padding:6px 16px;"
                    onclick="switchRateTab('hire')">&#128664; Car Hire Rates</button>
                <button id="rTab_transfer" class="tab-btn" style="font-size:12px;padding:6px 16px;"
                    onclick="switchRateTab('transfer')">&#9992;&#65039; Transfer Rates</button>
            </div>

            {{-- CAR HIRE RATES --}}
            <div id="rPanel_hire">
                <p style="font-size:11.5px;color:#888;margin-bottom:12px;">
                    <strong>Total = Base Price + (km &times; Fuel Rate) + (hours &times; Hourly Rate)</strong>
                </p>
                <div style="overflow-x:auto;">
                    <table class="rates-table" id="ratesTable">
                        <thead>
                            <tr>
                                <th>Vehicle Type</th>
                                <th>Regular Base (&#8358;)</th>
                                <th>Standard Base (&#8358;)</th>
                                <th>Executive Base (&#8358;)</th>
                                <th>Fuel Rate / km (&#8358;)</th>
                                <th>Hourly Rate (&#8358;)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rates as $r)
                            <tr data-type="{{ $r->vehicle_type }}">
                                <td><span class="vehicle-label">{{ $r->vehicle_type === 'van' ? 'Mini Van' : ucfirst($r->vehicle_type) }}</span></td>
                                <td><input class="rates-input" type="number" name="price_regular"    value="{{ $r->price_regular   ?? 0 }}" min="0"></td>
                                <td><input class="rates-input" type="number" name="price_standard"   value="{{ $r->price_standard  ?? 0 }}" min="0"></td>
                                <td><input class="rates-input" type="number" name="price_executive"  value="{{ $r->price_executive ?? 0 }}" min="0"></td>
                                <td><input class="rates-input" type="number" name="fuel_rate_per_km" value="{{ $r->fuel_rate_per_km }}" min="0"></td>
                                <td><input class="rates-input" type="number" name="hourly_rate"      value="{{ $r->hourly_rate }}"      min="0"></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- TRANSFER RATES --}}
            <div id="rPanel_transfer" style="display:none;">
                <p style="font-size:11.5px;color:#888;margin-bottom:12px;">
                    <strong>Total = distance (km) &times; Rate per km</strong> — one rate per vehicle type.
                </p>
                <div style="overflow-x:auto;">
                    <table class="rates-table" id="ratesTableTr">
                        <thead>
                            <tr>
                                <th>Vehicle Type</th>
                                <th>Rate per km (&#8358;)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rates as $r)
                            <tr data-type="{{ $r->vehicle_type }}">
                                <td><span class="vehicle-label">{{ $r->vehicle_type === 'van' ? 'Mini Van' : ucfirst($r->vehicle_type) }}</span></td>
                                <td><input class="rates-input" type="number" name="transfer_rate_per_km" value="{{ $r->transfer_rate_per_km }}" min="0"></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════
         FLEET / CAR MANAGEMENT
         Single source of truth for every car model shown on the website
         (Car Hire + Transfer). Includes the original starter models plus
         any models added here. Deactivate hides a model from customers;
         Delete removes it permanently.
    ══════════════════════════════════════════ --}}
    <div class="admin-section">
        <div class="admin-section-head">
            <div class="admin-section-title">🚗 Fleet Management — All Car Models</div>
            <button class="btn-action blue" onclick="openModal('addCarModal')">+ Add Car</button>
        </div>
        <div class="admin-section-body">
            <div class="modal-alert error"   id="fleetErr"></div>
            <div class="modal-alert success" id="fleetOk"></div>
            <p style="font-size:12px;color:#888;margin-bottom:14px;">
                Every model below is live on the booking page. Deactivate a model to hide it from customers without losing its data,
                or Delete to remove it permanently.
            </p>

            @if($fleetCars->isEmpty())
                <div class="empty-state"><p>No cars in the fleet yet. Click "+ Add Car" to get started.</p></div>
            @else
                {{-- Group: Car Hire --}}
                @php $hireCars = $fleetCars->where('service_type','car_hire'); @endphp
                @if($hireCars->count())
                <p style="font-size:10.5px;font-weight:700;color:#0d1883;text-transform:uppercase;letter-spacing:.07em;margin-bottom:10px;">Car Hire Fleet</p>
                <div class="fleet-grid" id="fleetGrid_hire">
                    @foreach($hireCars as $car)
                    <div class="fleet-card {{ $car->is_active ? '' : 'fc-inactive' }}" id="fc_{{ $car->id }}">
                        <div class="fleet-card-img">
                            @if(!empty($car->images))
                                <img src="{{ asset('storage/'. ($car->images[0] ?? '')) }}" alt="{{ $car->car_name }}">
                            @else
                                <span class="no-img">🚗</span>
                            @endif
                        </div>
                        <div class="fleet-card-body">
                            <div class="fleet-card-name">{{ $car->car_name }}</div>
                            <div class="fleet-card-meta">
                                <span class="fleet-card-tag">{{ ucfirst($car->vehicle_type) }}</span>
                                @if($car->category)<span class="fleet-card-tag">{{ $car->category }}</span>@endif
                                {{ $car->passengers ? '· '.$car->passengers : '' }}
                            </div>
                            @if(!empty($car->features))
                            <ul style="list-style:none;font-size:11px;color:#666;margin-bottom:9px;display:flex;flex-direction:column;gap:3px;">
                                @foreach(array_slice($car->features, 0, 3) as $feat)
                                <li style="display:flex;gap:5px;"><span style="color:#0d1883;">&#8226;</span>{{ $feat }}</li>
                                @endforeach
                                @if(count($car->features) > 3)
                                <li style="color:#aaa;">+{{ count($car->features) - 3 }} more</li>
                                @endif
                            </ul>
                            @endif
                            <div class="fleet-card-actions">
                                <button class="btn-action {{ $car->is_active ? '' : 'green' }}" style="flex:1"
                                    onclick="toggleCar({{ $car->id }})">
                                    {{ $car->is_active ? 'Deactivate' : 'Activate' }}
                                </button>
                                <button class="btn-action red" onclick="deleteCar({{ $car->id }}, '{{ addslashes($car->car_name) }}')">Delete</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

                {{-- Group: Transfer --}}
                @php $trCars = $fleetCars->where('service_type','transfer'); @endphp
                @if($trCars->count())
                <p style="font-size:10.5px;font-weight:700;color:#1a7a4e;text-transform:uppercase;letter-spacing:.07em;margin:22px 0 10px;">Transfer Fleet</p>
                <div class="fleet-grid" id="fleetGrid_tr">
                    @foreach($trCars as $car)
                    <div class="fleet-card {{ $car->is_active ? '' : 'fc-inactive' }}" id="fc_{{ $car->id }}">
                        <div class="fleet-card-img">
                            @if(!empty($car->images))
                                <img src="{{ asset('storage/'. ($car->images[0] ?? '')) }}" alt="{{ $car->car_name }}">
                            @else
                                <span class="no-img">🚌</span>
                            @endif
                        </div>
                        <div class="fleet-card-body">
                            <div class="fleet-card-name">{{ $car->car_name }}</div>
                            <div class="fleet-card-meta">
                                <span class="fleet-card-tag transfer">Transfer</span>
                                <span class="fleet-card-tag">{{ ucfirst($car->vehicle_type) }}</span>
                                {{ $car->passengers ? '· '.$car->passengers : '' }}
                            </div>
                            @if(!empty($car->features))
                            <ul style="list-style:none;font-size:11px;color:#666;margin-bottom:9px;display:flex;flex-direction:column;gap:3px;">
                                @foreach(array_slice($car->features, 0, 3) as $feat)
                                <li style="display:flex;gap:5px;"><span style="color:#1a7a4e;">&#8226;</span>{{ $feat }}</li>
                                @endforeach
                                @if(count($car->features) > 3)
                                <li style="color:#aaa;">+{{ count($car->features) - 3 }} more</li>
                                @endif
                            </ul>
                            @endif
                            <div class="fleet-card-actions">
                                <button class="btn-action {{ $car->is_active ? '' : 'green' }}" style="flex:1"
                                    onclick="toggleCar({{ $car->id }})">
                                    {{ $car->is_active ? 'Deactivate' : 'Activate' }}
                                </button>
                                <button class="btn-action red" onclick="deleteCar({{ $car->id }}, '{{ addslashes($car->car_name) }}')">Delete</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            @endif
        </div>
    </div>

    {{-- ── SEARCH + FILTER ── --}}
    <form method="GET" action="{{ route('admin.ctdashboard') }}" id="filterForm">
        <input type="hidden" name="tab" id="activeTabInput" value="{{ $tab }}">
        <div class="filter-bar">
            <input type="text" name="search" value="{{ $search }}" placeholder="Search by name, email, phone or reference…">
            <select name="status">
                <option value="">All statuses</option>
                @foreach(['pending','paid','confirmed','completed','cancelled'] as $s)
                    <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn-search">Search</button>
            <a href="{{ route('admin.ctdashboard') }}" class="btn-clear">Clear</a>
        </div>
    </form>

    {{-- ── TABS ── --}}
    <div class="tab-bar">
        <button class="tab-btn {{ $tab === 'car_hire' ? 'active' : '' }}" onclick="switchTab('car_hire')">
            🚗 Car Hire ({{ $carHires->total() }})
        </button>
        <button class="tab-btn {{ $tab === 'transfer' ? 'active' : '' }}" onclick="switchTab('transfer')">
            ✈️ Transfer ({{ $transfers->total() }})
        </button>
    </div>

    {{-- ════ CAR HIRE TABLE ════ --}}
    <div class="tab-panel {{ $tab === 'car_hire' ? 'active' : '' }}" id="panel-car_hire">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>#</th><th>Reference</th><th>Customer</th><th>Vehicle</th>
                        <th>Route</th><th>Date</th><th>Amount</th><th>Status</th><th>Driver</th><th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($carHires as $b)
                    <tr>
                        <td style="color:#bbb;font-size:11px;">{{ $b->id }}</td>
                        <td><span class="ref-code">{{ $b->payment_reference }}</span></td>
                        <td>
                            <div style="font-weight:600;font-size:13px;">{{ $b->full_name }}</div>
                            <div style="font-size:11px;color:#888;">{{ $b->email }}</div>
                        </td>
                        <td>
                            <div style="font-size:12px;font-weight:600;">{{ ucfirst($b->car_type) }} · {{ $b->category }}</div>
                            <div style="font-size:11px;color:#888;">{{ $b->car_model ?? '—' }}</div>
                        </td>
                        <td>
                            <div style="font-size:11.5px;">{{ Str::limit($b->pickup_location,22) }}</div>
                            <div style="font-size:11px;color:#888;">→ {{ Str::limit($b->dropoff_location,22) }}</div>
                        </td>
                        <td style="font-size:12px;white-space:nowrap;">
                            {{ \Carbon\Carbon::parse($b->pickup_date)->format('d M Y') }}<br>
                            <span style="color:#888;font-size:11px;">{{ $b->pickup_time }}</span>
                        </td>
                        <td style="font-weight:700;color:#0d1883;white-space:nowrap;">₦{{ number_format($b->amount) }}</td>
                        <td><span class="badge {{ $b->payment_status }}">{{ ucfirst($b->payment_status) }}</span></td>
                        <td>
                            @if($b->driver_assigned)
                                <span style="font-size:11px;color:#1a7a4e;font-weight:600;">✓ Assigned</span>
                            @else
                                <span style="font-size:11px;color:#bbb;">Not assigned</span>
                            @endif
                        </td>
                        <td>
                            <div class="actions-cell">
                                <button class="btn-action" onclick="openDetail('car_hire',{{ $b->id }})">View</button>
                                <button class="btn-action blue" onclick="openAssign('car_hire',{{ $b->id }},'{{ addslashes($b->full_name) }}')">Assign</button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="10"><div class="empty-state"><p>No car hire bookings found</p></div></td></tr>
                    @endforelse
                </tbody>
            </table>
            @if($carHires->hasPages())
            <div class="pagination-wrap">
                <span class="info">Showing {{ $carHires->firstItem() }}–{{ $carHires->lastItem() }} of {{ $carHires->total() }}</span>
                <div class="links">{!! $carHires->appends(request()->query())->links('pagination::simple-bootstrap-4') !!}</div>
            </div>
            @endif
        </div>
    </div>

    {{-- ════ TRANSFER TABLE ════ --}}
    <div class="tab-panel {{ $tab === 'transfer' ? 'active' : '' }}" id="panel-transfer">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>#</th><th>Reference</th><th>Customer</th><th>Vehicle</th>
                        <th>Route</th><th>Date</th><th>Amount</th><th>Status</th><th>Driver</th><th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transfers as $b)
                    <tr>
                        <td style="color:#bbb;font-size:11px;">{{ $b->id }}</td>
                        <td><span class="ref-code">{{ $b->payment_reference }}</span></td>
                        <td>
                            <div style="font-weight:600;font-size:13px;">{{ $b->full_name }}</div>
                            <div style="font-size:11px;color:#888;">{{ $b->email }}</div>
                        </td>
                        <td>
                            <div style="font-size:12px;font-weight:600;">{{ ucfirst($b->vehicle_type) }}</div>
                            <div style="font-size:11px;color:#888;">{{ $b->vehicle_name }}</div>
                        </td>
                        <td>
                            <div style="font-size:11.5px;">{{ Str::limit($b->pickup_location,22) }}</div>
                            <div style="font-size:11px;color:#888;">→ {{ Str::limit($b->dropoff_location,22) }}</div>
                        </td>
                        <td style="font-size:12px;white-space:nowrap;">
                            {{ \Carbon\Carbon::parse($b->pickup_date)->format('d M Y') }}<br>
                            <span style="color:#888;font-size:11px;">{{ $b->pickup_time }}</span>
                        </td>
                        <td style="font-weight:700;color:#0d1883;white-space:nowrap;">₦{{ number_format($b->amount) }}</td>
                        <td><span class="badge {{ $b->payment_status }}">{{ ucfirst($b->payment_status) }}</span></td>
                        <td>
                            @if($b->driver_assigned)
                                <span style="font-size:11px;color:#1a7a4e;font-weight:600;">✓ Assigned</span>
                            @else
                                <span style="font-size:11px;color:#bbb;">Not assigned</span>
                            @endif
                        </td>
                        <td>
                            <div class="actions-cell">
                                <button class="btn-action" onclick="openDetail('transfer',{{ $b->id }})">View</button>
                                <button class="btn-action blue" onclick="openAssign('transfer',{{ $b->id }},'{{ addslashes($b->full_name) }}')">Assign</button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="10"><div class="empty-state"><p>No transfer bookings found</p></div></td></tr>
                    @endforelse
                </tbody>
            </table>
            @if($transfers->hasPages())
            <div class="pagination-wrap">
                <span class="info">Showing {{ $transfers->firstItem() }}–{{ $transfers->lastItem() }} of {{ $transfers->total() }}</span>
                <div class="links">{!! $transfers->appends(request()->query())->links('pagination::simple-bootstrap-4') !!}</div>
            </div>
            @endif
        </div>
    </div>

</div>{{-- /page --}}

{{-- ════════════════════════════════
     MODAL: BOOKING DETAIL  (FIX 3)
════════════════════════════════ --}}
<div class="modal-overlay" id="detailModal">
    <div class="modal-box wide">
        <div class="modal-head">
            <div><h3>Booking Detail</h3><p id="detailRef">Loading…</p></div>
            <button class="modal-close" onclick="closeModal('detailModal')">✕</button>
        </div>
        <div class="modal-body" id="detailBody">
            <p style="text-align:center;color:#bbb;padding:30px 0;">Loading…</p>
        </div>
        <div class="modal-foot">
            <button class="btn-modal-secondary" onclick="closeModal('detailModal')">Close</button>
            <button class="btn-modal-primary" id="detailAssignBtn">Assign Driver</button>
        </div>
    </div>
</div>

{{-- ════════════════════════════════
     MODAL: ASSIGN DRIVER  (FIX 4 & 5)
     - driver_id → select by name
     - car_model → auto dropdown from fleet
     - car_images → real file upload
════════════════════════════════ --}}
<div class="modal-overlay" id="assignModal">
    <div class="modal-box wide">
        <div class="modal-head">
            <div><h3>Assign Driver</h3><p id="assignModalSub">Booking details</p></div>
            <button class="modal-close" onclick="closeModal('assignModal')">✕</button>
        </div>
        <div class="modal-body">
            <div class="modal-alert error"   id="assignErr"></div>
            <div class="modal-alert success" id="assignOk"></div>

            <input type="hidden" id="asgn_type">
            <input type="hidden" id="asgn_booking_id">
            <input type="hidden" id="asgn_assignment_id">

            {{-- FIX 4a: Driver = search by name (select from drivers list), or type a new name to auto-create --}}
            <div class="mform-row">
                <div class="mform-group full">
                    <label>Driver Name</label>
                    <input type="text" id="asgn_driver_search" placeholder="Type driver name — pick from list or enter a new name"
                        oninput="filterDrivers(this.value)" autocomplete="off">
                    <div id="asgn_driver_dropdown" style="display:none;position:relative;z-index:200;">
                        <div style="border:1.5px solid #dde0ee;border-top:none;border-radius:0 0 8px 8px;background:#fff;max-height:180px;overflow-y:auto;">
                            @foreach($drivers as $d)
                            <div class="driver-option" data-id="{{ $d->id }}" data-name="{{ $d->name }}" data-phone="{{ $d->phone }}"
                                style="padding:9px 13px;cursor:pointer;font-size:13px;border-bottom:1px solid #f0f2f8;"
                                onmouseover="this.style.background='#f0f3ff'"
                                onmouseout="this.style.background='#fff'"
                                onclick="selectDriver({{ $d->id }},'{{ addslashes($d->name) }}','{{ addslashes($d->phone) }}')">
                                <strong>{{ $d->name }}</strong>
                                <span style="color:#888;font-size:11px;margin-left:6px;">{{ $d->phone }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <input type="hidden" id="asgn_driver_id">
                    <p id="asgn_new_driver_note" style="font-size:11.5px;color:#1a7a4e;margin-top:5px;display:none;">
                        ✓ New driver — will be added to your drivers list when you save this assignment.
                    </p>
                </div>
            </div>

            {{-- Phone number — required to create a new driver, hidden once an existing driver is picked --}}
            <div class="mform-row" id="asgn_new_driver_phone_row">
                <div class="mform-group full">
                    <label>Driver Phone Number</label>
                    <input type="text" id="asgn_driver_phone" placeholder="e.g. 08012345678">
                    <p style="font-size:11px;color:#888;margin-top:4px;">Required only when adding a new driver.</p>
                </div>
            </div>

            {{-- FIX 5: Car model = auto dropdown from fleet --}}
            <div class="mform-row">
                <div class="mform-group full">
                    <label>Car Model</label>
                    <div id="asgn_car_model_wrap">
                        <select id="asgn_car_model_select" style="width:100%;padding:9px 12px;border:1.5px solid #dde0ee;border-radius:8px;font-size:13px;font-family:'DM Sans',sans-serif;background:#fafbff;outline:none;">
                            <option value="">— Loading fleet cars… —</option>
                        </select>
                        <p id="asgn_fleet_note" style="font-size:11px;color:#888;margin-top:4px;display:none;">
                            No active fleet cars found for this vehicle type.
                            <a href="#" onclick="openModal('addCarModal');return false;" style="color:#0d1883;font-weight:600;">Add cars to fleet first.</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="mform-row">
                <div class="mform-group">
                    <label>Car Colour</label>
                    <input type="text" id="asgn_car_colour" placeholder="e.g. Silver">
                </div>
                <div class="mform-group">
                    <label>Plate Number</label>
                    <input type="text" id="asgn_plate" placeholder="e.g. LND 123 XY">
                </div>
            </div>

            {{-- FIX 4b: Car images = real file upload --}}
            <div class="mform-row">
                <div class="mform-group full">
                    <label>Car Images — select multiple photos (up to 5)</label>
                    <input type="file" id="asgn_images" accept="image/*" multiple
                        onchange="previewImages(this,'asgn_img_preview')"
                        style="padding:7px 10px;border:1.5px dashed #dde0ee;border-radius:8px;font-family:'DM Sans',sans-serif;cursor:pointer;background:#fafbff;width:100%;">
                    <p style="font-size:11px;color:#888;margin-top:5px;">
                        💡 Hold <kbd style="background:#f0f2f8;border:1px solid #dde0ee;border-radius:4px;padding:1px 5px;font-size:10px;">Ctrl</kbd> (Windows) or
                        <kbd style="background:#f0f2f8;border:1px solid #dde0ee;border-radius:4px;padding:1px 5px;font-size:10px;">⌘ Cmd</kbd> (Mac) to select multiple photos at once.
                    </p>
                    <div class="img-preview-row" id="asgn_img_preview"></div>
                    <p id="asgn_img_count" style="font-size:11px;color:#0d1883;margin-top:4px;display:none;font-weight:600;"></p>
                </div>
            </div>

            <div class="mform-row">
                <div class="mform-group full">
                    <label>Notes (optional)</label>
                    <textarea id="asgn_notes" placeholder="Any special instructions for the driver…"></textarea>
                </div>
            </div>
        </div>
        <div class="modal-foot">
            <button class="btn-modal-secondary" onclick="closeModal('assignModal')">Cancel</button>
            <button class="btn-modal-primary" id="asgnSaveBtn" onclick="saveAssignment()">Save Assignment</button>
            <button class="btn-modal-green"   id="asgnEmailBtn" onclick="sendEmail()" style="display:none;">📧 Send Email</button>
        </div>
    </div>
</div>

{{-- ════════════════════════════════
     MODAL: ADD CAR TO FLEET  (FIX 2)
════════════════════════════════ --}}
<div class="modal-overlay" id="addCarModal">
    <div class="modal-box wide">
        <div class="modal-head">
            <div><h3>Add Car to Fleet</h3><p>Post a new car model with features and photos</p></div>
            <button class="modal-close" onclick="closeModal('addCarModal')">✕</button>
        </div>
        <div class="modal-body">
            <div class="modal-alert error"   id="addCarErr"></div>
            <div class="modal-alert success" id="addCarOk"></div>

            <div class="mform-row">
                <div class="mform-group">
                    <label>Service Type</label>
                    <select id="ac_service" onchange="toggleCategoryField()">
                        <option value="car_hire">Car Hire</option>
                        <option value="transfer">Transfer</option>
                    </select>
                </div>
                <div class="mform-group">
                    <label>Vehicle Type</label>
                    <select id="ac_vehicle_type">
                        <option value="saloon">Saloon</option>
                        <option value="suv">SUV</option>
                        <option value="van">Mini Van</option>
                        <option value="bus">Bus</option>
                        <option value="luxury">Luxury</option>
                    </select>
                </div>
            </div>

            {{-- Car name always visible for both service types --}}
            <div class="mform-row">
                <div class="mform-group full">
                    <label>Car Name / Model</label>
                    <input type="text" id="ac_car_name" placeholder="e.g. Toyota Camry">
                </div>
            </div>

            {{-- Category only shown for Car Hire --}}
            <div class="mform-row" id="ac_category_row">
                <div class="mform-group full">
                    <label>Category (Car Hire only)</label>
                    <select id="ac_category">
                        <option value="">— None —</option>
                        <option value="Regular">Regular</option>
                        <option value="Standard">Standard</option>
                        <option value="Executive">Executive</option>
                    </select>
                </div>
            </div>

            <div class="mform-row">
                <div class="mform-group">
                    <label>Passenger Capacity</label>
                    <input type="text" id="ac_passengers" placeholder="e.g. 1 – 3 Passengers">
                </div>
            </div>

            <div class="mform-row">
                <div class="mform-group full">
                    <label>Features (one per line)</label>
                    <textarea id="ac_features" style="min-height:100px;" placeholder="Air conditioning&#10;Professional driver&#10;Complimentary bottled water&#10;Spacious boot for luggage"></textarea>
                </div>
            </div>

            <div class="mform-row">
                <div class="mform-group full">
                    <label>Carousel Images (up to 5 photos)</label>
                    <input type="file" id="ac_images" accept="image/*" multiple
                        onchange="previewImages(this,'ac_img_preview')"
                        style="padding:7px 10px;border:1.5px dashed #dde0ee;border-radius:8px;font-family:'DM Sans',sans-serif;cursor:pointer;background:#fafbff;">
                    <div class="img-preview-row" id="ac_img_preview"></div>
                </div>
            </div>
        </div>
        <div class="modal-foot">
            <button class="btn-modal-secondary" onclick="closeModal('addCarModal')">Cancel</button>
            <button class="btn-modal-primary" id="addCarBtn" onclick="saveCar()">Add to Fleet</button>
        </div>
    </div>
</div>

<div id="toast"></div>

<script>
const CSRF = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

/* ══ TABS ══ */
function switchTab(tab) {
    document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById('panel-' + tab).classList.add('active');
    event.currentTarget.classList.add('active');
    document.getElementById('activeTabInput').value = tab;
}

/* ══ MODALS ══ */
function openModal(id)  { document.getElementById(id).classList.add('open');    document.body.style.overflow = 'hidden'; }
function closeModal(id) { document.getElementById(id).classList.remove('open'); document.body.style.overflow = ''; }

/* ══ TOAST ══ */
function toast(msg, type='success') {
    const t = document.getElementById('toast');
    t.textContent = msg;
    t.className   = 'show ' + type;
    clearTimeout(t._timer);
    t._timer = setTimeout(() => t.className = '', 3500);
}

/* ══ IMAGE PREVIEW ══ */
function previewImages(input, previewId) {
    const wrap  = document.getElementById(previewId);
    wrap.innerHTML = '';
    const all   = Array.from(input.files);
    const files = all.slice(0, 5);

    // Show count indicator if there's a count element (assign modal)
    const countEl = document.getElementById(previewId.replace('_preview','_count'));
    if (countEl) {
        if (files.length > 0) {
            countEl.textContent = files.length + ' photo' + (files.length > 1 ? 's' : '') + ' selected' +
                (all.length > 5 ? ' (only first 5 will be uploaded)' : '');
            countEl.style.display = 'block';
        } else {
            countEl.style.display = 'none';
        }
    }

    files.forEach(f => {
        const reader = new FileReader();
        reader.onload = e => {
            const div = document.createElement('div');
            div.className = 'img-preview-item';
            div.innerHTML = `<img src="${e.target.result}" alt="preview">`;
            wrap.appendChild(div);
        };
        reader.readAsDataURL(f);
    });
}

/* ══════════════════════════════════════
   FIX 1 — SAVE RATES
══════════════════════════════════════ */
/* ── Rate tab switcher ── */
function switchRateTab(tab) {
    ['hire','transfer'].forEach(t => {
        document.getElementById('rPanel_' + t).style.display = t === tab ? '' : 'none';
        document.getElementById('rTab_' + t).classList.toggle('active', t === tab);
    });
}

async function saveRates() {
    const errEl = document.getElementById('ratesErr');
    const okEl  = document.getElementById('ratesOk');
    errEl.classList.remove('show'); okEl.classList.remove('show');

    const rates = [];

    // Collect Car Hire rows (base prices + fuel/hourly)
    const hireRows = document.querySelectorAll('#ratesTable tbody tr');
    for (const row of hireRows) {
        const type  = row.dataset.type;
        const preg  = parseInt(row.querySelector('[name="price_regular"]').value);
        const pstd  = parseInt(row.querySelector('[name="price_standard"]').value);
        const pexec = parseInt(row.querySelector('[name="price_executive"]').value);
        const fuel  = parseInt(row.querySelector('[name="fuel_rate_per_km"]').value);
        const hrly  = parseInt(row.querySelector('[name="hourly_rate"]').value);
        if ([preg,pstd,pexec,fuel,hrly].some(isNaN)) {
            errEl.textContent = 'All Car Hire rate fields must be valid numbers (check ' + type + ').';
            errEl.classList.add('show'); return;
        }
        rates.push({
            vehicle_type:        type,
            price_regular:       preg,
            price_standard:      pstd,
            price_executive:     pexec,
            fuel_rate_per_km:    fuel,
            hourly_rate:         hrly,
            transfer_rate_per_km: 0,   // placeholder — overwritten below
        });
    }

    // Collect Transfer rows and merge into the same rates array
    const trRows = document.querySelectorAll('#ratesTableTr tbody tr');
    for (const row of trRows) {
        const type = row.dataset.type;
        const trfr = parseInt(row.querySelector('[name="transfer_rate_per_km"]').value);
        if (isNaN(trfr)) {
            errEl.textContent = 'Transfer rate for ' + type + ' must be a valid number.';
            errEl.classList.add('show'); return;
        }
        const existing = rates.find(r => r.vehicle_type === type);
        if (existing) existing.transfer_rate_per_km = trfr;
    }

    const res  = await fetch('{{ route("admin.rates.update") }}', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
        body: JSON.stringify({ rates }),
    });
    const data = await res.json();
    if (data.success) {
        okEl.textContent = '\u2713 ' + data.message;
        okEl.classList.add('show');
        toast('Rates updated!');
    } else {
        errEl.textContent = data.message || 'Failed to update rates.';
        errEl.classList.add('show');
    }
}

/* ══════════════════════════════════════
   FIX 2 — ADD CAR / FLEET
══════════════════════════════════════ */
function toggleCategoryField() {
    const service = document.getElementById('ac_service').value;
    document.getElementById('ac_category_row').style.display = service === 'car_hire' ? '' : 'none';
}

async function saveCar() {
    const btn    = document.getElementById('addCarBtn');
    const errEl  = document.getElementById('addCarErr');
    const okEl   = document.getElementById('addCarOk');
    errEl.classList.remove('show'); okEl.classList.remove('show');

    const carName = document.getElementById('ac_car_name').value.trim();
    if (!carName) {
        errEl.textContent = 'Car name is required.';
        errEl.classList.add('show');
        return;
    }

    btn.disabled = true; btn.textContent = 'Saving…';

    const fd = new FormData();
    fd.append('service_type',  document.getElementById('ac_service').value);
    fd.append('vehicle_type',  document.getElementById('ac_vehicle_type').value);
    fd.append('category',      document.getElementById('ac_category').value);
    fd.append('car_name',      carName);
    fd.append('passengers',    document.getElementById('ac_passengers').value.trim());
    fd.append('features',      document.getElementById('ac_features').value);
    fd.append('_token',        CSRF);

    const imgFiles = document.getElementById('ac_images').files;
    Array.from(imgFiles).slice(0,5).forEach(f => fd.append('images[]', f));

    try {
        const res = await fetch('{{ route("admin.fleet.store") }}', { method: 'POST', body: fd });

        // Read raw text first — server may return HTML (422/500) instead of JSON
        const raw = await res.text();
        let data;
        try {
            data = JSON.parse(raw);
        } catch (parseErr) {
            console.error('[saveCar] Non-JSON response:', raw.slice(0, 500));
            // A returned HTML dashboard/login page (instead of JSON) almost always
            // means the admin session expired between page load and this request.
            if (raw.includes('Admin Dashboard') || raw.includes('admin.login') || res.status === 401) {
                errEl.textContent = 'Your session has expired. Please reload the page and log in again.';
                errEl.classList.add('show');
                toast('Session expired — please reload', 'error');
            } else {
                errEl.textContent = 'Server error (status ' + res.status + '): ' + raw.replace(/<[^>]*>/g, ' ').trim().slice(0, 200);
                errEl.classList.add('show');
                toast('Save failed — server error', 'error');
            }
            return;
        }

        if (!res.ok || !data.success) {
            // Laravel validation errors arrive as { message, errors: {field: [msgs]} }
            let msg = data.message || 'Failed to add car.';
            if (data.errors) {
                const firstField = Object.keys(data.errors)[0];
                msg = data.errors[firstField][0] || msg;
            }
            errEl.textContent = msg;
            errEl.classList.add('show');
            toast('Save failed', 'error');
            return;
        }

        okEl.textContent = '✓ ' + data.message;
        okEl.classList.add('show');
        toast(data.message);
        setTimeout(() => location.reload(), 1200);

    } catch (networkErr) {
        console.error('[saveCar] Network error:', networkErr);
        errEl.textContent = 'Network error — please check your connection and try again.';
        errEl.classList.add('show');
        toast('Network error', 'error');
    } finally {
        btn.disabled = false;
        btn.textContent = 'Add to Fleet';
    }
}

async function deleteCar(id, name) {
    if (!confirm('Remove ' + name + ' from the fleet?')) return;
    const res  = await fetch('{{ route("admin.fleet.delete") }}', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
        body: JSON.stringify({ car_id: id }),
    });
    const data = await res.json();
    if (data.success) {
        document.getElementById('fc_' + id)?.remove();
        toast(data.message);
    } else {
        toast(data.message || 'Delete failed', 'error');
    }
}

async function toggleCar(id) {
    const res  = await fetch('{{ route("admin.fleet.toggle") }}', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
        body: JSON.stringify({ car_id: id }),
    });
    const data = await res.json();
    if (data.success) {
        toast(data.is_active ? 'Car activated' : 'Car deactivated');
        setTimeout(() => location.reload(), 800);
    } else {
        toast('Toggle failed', 'error');
    }
}

/* ══════════════════════════════════════
   BOOKING DETAIL  (FIX 3 — hours & distance)
══════════════════════════════════════ */
async function openDetail(type, id) {
    document.getElementById('detailRef').textContent = 'Loading…';
    document.getElementById('detailBody').innerHTML  = '<p style="text-align:center;color:#bbb;padding:30px 0;">Loading…</p>';
    document.getElementById('detailAssignBtn').onclick = () => { closeModal('detailModal'); openAssign(type, id, ''); };
    openModal('detailModal');

    const res  = await fetch(`{{ route('admin.detail') }}?type=${type}&id=${id}`);
    const data = await res.json();
    const b    = data.booking;
    const a    = data.assignment;

    // Debug: log all keys returned so we can verify field names
    console.log('[BookingDetail] keys:', Object.keys(b));
    console.log('[BookingDetail] rental_hours:', b.rental_hours, '| distance_km:', b.distance_km);

    document.getElementById('detailRef').textContent = b.payment_reference;

    let html = '';

    html += `<div class="detail-section">👤 Customer</div>
    <div class="detail-grid">
        ${di('Full Name', b.full_name)}
        ${di('Email', b.email)}
        ${di('Phone', b.phone_number)}
        ${di('Passengers', b.passengers)}
    </div>`;

    if (type === 'car_hire') {
        // rental_hours and distance_km — be defensive: try all possible key names.
        // Laravel toArray() uses snake_case, but guard against null/undefined/0 (0 is falsy).
        const rawHours = b.rental_hours ?? b.rentalHours ?? b['rental_hours'] ?? null;
        const rawDist  = b.distance_km  ?? b.distanceKm  ?? b['distance_km']  ?? null;
        const hours = (rawHours !== null && rawHours !== undefined) ? String(rawHours) + ' hrs' : '—';
        const dist  = (rawDist  !== null && rawDist  !== undefined) ? String(rawDist)  + ' km'  : '—';
        html += `<div class="detail-section">&#128664; Car Hire</div>
        <div class="detail-grid">
            ${di('Type', cap(b.car_type))}
            ${di('Category', b.category)}
            ${di('Model', b.car_model)}
            ${di('Hours', hours)}
            ${di('Distance', dist)}
            ${di('Amount', '&#8358;' + fmt(b.amount), false, true)}
        </div>`;
    } else {
        html += `<div class="detail-section">✈️ Transfer</div>
        <div class="detail-grid">
            ${di('Vehicle Type', cap(b.vehicle_type))}
            ${di('Vehicle Name', b.vehicle_name)}
            ${di('Distance', (() => { const d = b.distance_km ?? b.distanceKm ?? b['distance_km'] ?? null; return d !== null && d !== undefined ? String(d) + ' km' : '—'; })())}
            ${di('Amount', '₦' + fmt(b.amount), false, true)}
            ${b.flight_number    ? di('Flight/Vessel', b.flight_number) : ''}
            ${b.special_requests ? di('Special Requests', b.special_requests, true) : ''}
        </div>`;
    }

    html += `<div class="detail-section">📍 Route & Schedule</div>
    <div class="detail-grid">
        ${di('Pick-up', b.pickup_location, true)}
        ${di('Drop-off', b.dropoff_location, true)}
        ${di('Date', b.pickup_date)}
        ${di('Time', b.pickup_time)}
    </div>`;

    html += `<div class="detail-section">💳 Payment</div>
    <div class="detail-grid">
        ${di('Method', cap(b.payment_option || '—'))}
        ${di('Reference', b.payment_reference)}
        ${di('Status', cap(b.payment_status))}
    </div>`;

    html += `<div class="detail-section">⚙️ Change Status</div>
    <div class="status-row" style="margin-bottom:14px;">
        <select id="statusSelect_${id}">
            ${['pending','paid','confirmed','completed','cancelled'].map(s =>
                `<option value="${s}" ${b.payment_status===s?'selected':''}>${cap(s)}</option>`
            ).join('')}
        </select>
        <button onclick="changeStatus('${type}',${id})">Update</button>
    </div>`;

    if (a) {
        const imgs = (a.car_images || []).map(p =>
            `<img src="/storage/${p}" style="height:52px;width:72px;object-fit:cover;border-radius:6px;border:1px solid #dde0ee;">`
        ).join('');
        html += `<div class="detail-section">🚗 Assigned Driver</div>
        <div class="driver-card">
            <div class="driver-avatar">${(a.driver?.name || '?')[0]}</div>
            <div class="driver-card-info">
                <h4>${a.driver?.name || 'Unknown'}</h4>
                <p>${a.driver?.phone || ''} · ${a.car_model} · ${a.car_colour} · <strong>${a.plate_number}</strong></p>
                ${imgs ? `<div style="display:flex;gap:6px;margin-top:7px;">${imgs}</div>` : ''}
                ${a.email_sent_at
                    ? `<p style="color:#1a7a4e;font-size:11px;margin-top:5px;">✓ Email sent ${new Date(a.email_sent_at).toLocaleDateString('en-NG')}</p>`
                    : `<p style="color:#bbb;font-size:11px;margin-top:5px;">Email not sent yet</p>`}
            </div>
        </div>
        <button class="btn-modal-green" style="width:100%;padding:10px;" onclick="sendEmailById(${a.id})">📧 Send Driver Assignment Email</button>`;
    } else {
        html += `<div class="detail-section">🚗 Driver</div>
        <p style="font-size:12.5px;color:#bbb;margin-bottom:10px;">No driver assigned yet.</p>`;
    }

    document.getElementById('detailBody').innerHTML = html;
}

function di(label, val, full, blue) {
    // Use nullish check so numeric 0 renders as "0", not "—"
    const display = (val !== null && val !== undefined && val !== '') ? val : '—';
    return `<div class="detail-item${full?' full':''}">
        <div class="d-label">${label}</div>
        <div class="d-val${blue?' blue':''}">${display}</div>
    </div>`;
}
function cap(s) { return s ? s.charAt(0).toUpperCase() + s.slice(1) : '—'; }
function fmt(n) { return Number(n).toLocaleString(); }

/* ══ CHANGE STATUS ══ */
async function changeStatus(type, id) {
    const status = document.getElementById('statusSelect_' + id).value;
    const res    = await fetch('{{ route("admin.status") }}', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
        body: JSON.stringify({ type, id, status }),
    });
    const data = await res.json();
    if (data.success) { toast('Status updated to ' + cap(status)); openDetail(type, id); }
    else              { toast('Failed to update status', 'error'); }
}

/* ══════════════════════════════════════
   FIX 4 — ASSIGN DRIVER
   - Driver: search-by-name input
   - Car model: auto dropdown from fleet
   - Car images: real file upload
══════════════════════════════════════ */

/* FIX 4a: Driver search — supports picking an existing driver OR typing a brand-new name */
function filterDrivers(val) {
    const drop   = document.getElementById('asgn_driver_dropdown');
    const opts   = document.querySelectorAll('.driver-option');
    const q      = val.toLowerCase().trim();
    const newNote = document.getElementById('asgn_new_driver_note');
    const phoneRow = document.getElementById('asgn_new_driver_phone_row');

    // Any typing clears a previously selected driver_id — force re-resolution on save
    document.getElementById('asgn_driver_id').value = '';

    if (!q) {
        drop.style.display = 'none';
        newNote.style.display = 'none';
        phoneRow.style.display = '';
        return;
    }

    let any = false;
    let exactMatch = false;
    opts.forEach(o => {
        const name = o.dataset.name.toLowerCase();
        const match = name.includes(q);
        o.style.display = match ? '' : 'none';
        if (match) any = true;
        if (name === q) exactMatch = true;
    });
    drop.style.display = any ? 'block' : 'none';

    // No existing driver matches at all → this will be a brand-new driver
    if (!any) {
        newNote.style.display = 'block';
        phoneRow.style.display = '';
    } else {
        newNote.style.display = 'none';
    }
}

function selectDriver(id, name, phone) {
    document.getElementById('asgn_driver_id').value     = id;
    document.getElementById('asgn_driver_search').value = name;
    document.getElementById('asgn_driver_phone').value   = phone || '';
    document.getElementById('asgn_driver_dropdown').style.display = 'none';
    document.getElementById('asgn_new_driver_note').style.display = 'none';
    document.getElementById('asgn_new_driver_phone_row').style.display = 'none';
}

/* FIX 5: Load fleet cars for the booking's vehicle type → auto populate car model dropdown */
async function loadFleetCars(type, bookingId) {
    const select = document.getElementById('asgn_car_model_select');
    const note   = document.getElementById('asgn_fleet_note');
    select.innerHTML = '<option value="">Loading…</option>';
    note.style.display = 'none';

    const res  = await fetch(`{{ route('admin.fleet.for.booking') }}?type=${type}&id=${bookingId}`);
    const data = await res.json();

    if (!data.cars || !data.cars.length) {
        select.innerHTML = '<option value="">— No fleet cars for this type —</option>';
        note.style.display = 'block';
        return;
    }

    select.innerHTML = '<option value="">— Select car model —</option>';
    data.cars.forEach(c => {
        const label  = c.car_name + (c.category ? ' (' + c.category + ')' : '');
        const opt    = document.createElement('option');
        opt.value    = c.car_name;
        opt.textContent = label;
        // Pre-select if it matches the car the customer booked
        if (data.booked_model && c.car_name === data.booked_model) {
            opt.selected = true;
        }
        select.appendChild(opt);
    });
}

async function openAssign(type, bookingId, name) {
    document.getElementById('asgn_type').value         = type;
    document.getElementById('asgn_booking_id').value   = bookingId;
    document.getElementById('asgn_assignment_id').value = '';
    document.getElementById('assignModalSub').textContent = name || ('Booking #' + bookingId);
    document.getElementById('assignErr').classList.remove('show');
    document.getElementById('assignOk').classList.remove('show');
    document.getElementById('asgnEmailBtn').style.display = 'none';
    // Clear fields
    document.getElementById('asgn_driver_search').value = '';
    document.getElementById('asgn_driver_id').value     = '';
    document.getElementById('asgn_driver_phone').value  = '';
    document.getElementById('asgn_driver_dropdown').style.display = 'none';
    document.getElementById('asgn_new_driver_note').style.display = 'none';
    document.getElementById('asgn_new_driver_phone_row').style.display = '';
    document.getElementById('asgn_car_colour').value    = '';
    document.getElementById('asgn_plate').value         = '';
    document.getElementById('asgn_notes').value         = '';
    document.getElementById('asgn_images').value        = '';
    document.getElementById('asgn_img_preview').innerHTML = '';

    // Load fleet cars for FIX 5
    await loadFleetCars(type, bookingId);

    openModal('assignModal');
}

async function saveAssignment() {
    const btn    = document.getElementById('asgnSaveBtn');
    const errEl  = document.getElementById('assignErr');
    const okEl   = document.getElementById('assignOk');
    errEl.classList.remove('show'); okEl.classList.remove('show');

    const driverId    = document.getElementById('asgn_driver_id').value;
    const driverName  = document.getElementById('asgn_driver_search').value.trim();
    const driverPhone = document.getElementById('asgn_driver_phone').value.trim();
    const model       = document.getElementById('asgn_car_model_select').value;
    const colour      = document.getElementById('asgn_car_colour').value.trim();
    const plate       = document.getElementById('asgn_plate').value.trim();

    // Driver: either an existing one was picked (driverId set) OR a new name was typed
    if (!driverId && !driverName) {
        errEl.textContent = 'Please type a driver name, or pick one from the list.';
        errEl.classList.add('show'); return;
    }
    // New driver requires a phone number so they can be added to the drivers table
    if (!driverId && driverName && !driverPhone) {
        errEl.textContent = 'This is a new driver — please enter their phone number too.';
        errEl.classList.add('show'); return;
    }
    if (!model) {
        errEl.textContent = 'Please select a car model.';
        errEl.classList.add('show'); return;
    }
    if (!colour || !plate) {
        errEl.textContent = 'Please fill in Car Colour and Plate Number.';
        errEl.classList.add('show'); return;
    }

    btn.disabled = true; btn.textContent = 'Saving…';

    const fd = new FormData();
    fd.append('_token',       CSRF);
    fd.append('type',         document.getElementById('asgn_type').value);
    fd.append('booking_id',   document.getElementById('asgn_booking_id').value);
    // Send driver_id only if an existing driver was actually selected;
    // otherwise send driver_name + driver_phone so the backend can create one.
    if (driverId) {
        fd.append('driver_id', driverId);
    } else {
        fd.append('driver_name',  driverName);
        fd.append('driver_phone', driverPhone);
    }
    fd.append('car_model',    model);
    fd.append('car_colour',   colour);
    fd.append('plate_number', plate);
    fd.append('notes',        document.getElementById('asgn_notes').value);

    const imgFiles = document.getElementById('asgn_images').files;
    Array.from(imgFiles).slice(0,5).forEach(f => fd.append('car_images[]', f));

    try {
        const res = await fetch('{{ route("admin.assign.driver") }}', { method: 'POST', body: fd });
        const raw = await res.text();
        let data;
        try {
            data = JSON.parse(raw);
        } catch (parseErr) {
            console.error('[saveAssignment] Non-JSON response:', raw.slice(0, 500));
            if (raw.includes('Admin Dashboard') || raw.includes('admin.login') || res.status === 401) {
                errEl.textContent = 'Your session has expired. Please reload the page and log in again.';
                errEl.classList.add('show');
            } else {
                errEl.textContent = 'Server error (status ' + res.status + '): ' + raw.replace(/<[^>]*>/g, ' ').trim().slice(0, 200);
                errEl.classList.add('show');
            }
            return;
        }

        if (!res.ok || !data.success) {
            let msg = data.message || 'Failed to assign driver.';
            if (data.errors) {
                const firstField = Object.keys(data.errors)[0];
                msg = data.errors[firstField][0] || msg;
            }
            errEl.textContent = msg;
            errEl.classList.add('show');
            toast('Assignment failed', 'error');
            return;
        }

        document.getElementById('asgn_assignment_id').value = data.assignment_id;
        // If the backend created a new driver, reflect its id so re-saving won't duplicate
        if (data.driver_id) {
            document.getElementById('asgn_driver_id').value = data.driver_id;
        }
        okEl.textContent = data.driver_created
            ? '✓ New driver added and assigned! You can now send the customer an email.'
            : '✓ Driver assigned! You can now send the customer an email.';
        okEl.classList.add('show');
        document.getElementById('asgnEmailBtn').style.display = 'flex';
        toast(data.driver_created ? 'New driver created & assigned!' : 'Driver assigned!');

    } catch (networkErr) {
        console.error('[saveAssignment] Network error:', networkErr);
        errEl.textContent = 'Network error — please check your connection and try again.';
        errEl.classList.add('show');
        toast('Network error', 'error');
    } finally {
        btn.disabled = false;
        btn.textContent = 'Save Assignment';
    }
}

/* ══ SEND EMAIL ══ */
async function sendEmail() {
    const assignmentId = document.getElementById('asgn_assignment_id').value;
    if (!assignmentId) { toast('Save the assignment first', 'error'); return; }
    sendEmailById(assignmentId);
}

async function sendEmailById(assignmentId) {
    const btn = document.getElementById('asgnEmailBtn');
    if (btn) { btn.disabled = true; btn.textContent = '📧 Sending…'; }

    const res  = await fetch('{{ route("admin.send.email") }}', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
        body: JSON.stringify({ assignment_id: assignmentId }),
    });
    const data = await res.json();

    if (btn) { btn.disabled = false; btn.textContent = '📧 Send Email'; }

    if (data.success) {
        toast('✓ ' + data.message);
        const ok = document.getElementById('assignOk');
        if (ok) { ok.textContent = '✓ ' + data.message; ok.classList.add('show'); }
    } else {
        toast(data.message || 'Email failed', 'error');
    }
}

// Close driver dropdown when clicking outside
document.addEventListener('click', e => {
    if (!e.target.closest('#asgn_driver_search') && !e.target.closest('#asgn_driver_dropdown')) {
        const d = document.getElementById('asgn_driver_dropdown');
        if (d) d.style.display = 'none';
    }
});
</script>

</body>
</html>