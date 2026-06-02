<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ground Transport</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'DM Sans', sans-serif; background: #f0f2f8; min-height: 100vh; color: #1a1a1a; }
        .page { max-width: 1200px; margin: 0 auto; padding: 28px 16px 60px; }

        .page-header { display: flex; align-items: flex-start; gap: 16px; margin-bottom: 22px; }
        .page-icon { width: 50px; height: 50px; background: #0d1883; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .page-icon svg { width: 24px; height: 24px; fill: white; }
        .page-header h1 { font-family: 'Playfair Display', serif; font-size: 24px; font-weight: 600; color: #0d1883; margin-bottom: 5px; }
        .page-header p { font-size: 13px; color: #777; line-height: 1.6; max-width: 520px; }

        .tab-bar { display: flex; margin-bottom: 20px; background: #fff; border-radius: 14px; padding: 5px; border: 1px solid #e0ddd6; width: fit-content; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
        .tab-btn { display: flex; align-items: center; gap: 8px; padding: 10px 22px; border-radius: 10px; border: none; font-size: 13.5px; font-weight: 600; font-family: 'DM Sans', sans-serif; cursor: pointer; transition: all .22s; color: #999; background: transparent; }
        .tab-btn svg { width: 15px; height: 15px; fill: currentColor; }
        .tab-btn.active { background: #0d1883; color: white; box-shadow: 0 4px 14px rgba(13,24,131,.25); }
        .tab-btn:not(.active):hover { background: #f0f3ff; color: #0d1883; }
        .tab-panel { display: none; }
        .tab-panel.active { display: block; }

        .outer-card { background: #fff; border-radius: 20px; border: 1px solid #e0ddd6; box-shadow: 0 4px 20px rgba(0,0,0,.06); }
        .card-layout { display: grid; grid-template-columns: 210px 1fr; }
        @media(max-width:768px){ .card-layout { grid-template-columns: 1fr; } }
        .sidebar { background: #f7f8ff; border-right: 1px solid #e8eaf5; padding: 22px 16px; border-radius: 20px 0 0 20px; }
        @media(max-width:768px){ .sidebar { border-right:none; border-bottom:1px solid #e8eaf5; border-radius:20px 20px 0 0; } }
        .section-label { display: inline-flex; align-items: center; background: #eef1ff; color: #0d1883; font-size: 10px; font-weight: 700; letter-spacing: .07em; padding: 4px 10px; border-radius: 20px; margin-bottom: 14px; text-transform: uppercase; }
        .content-area { padding: 22px 20px; display: flex; flex-direction: column; gap: 16px; }
        .inner-card { background: #fff; border-radius: 14px; border: 1px solid #e4e6f0; padding: 18px; }
        .inner-card.tinted { background: #fafbff; }

        /* Type cards */
        .type-card { display: flex; align-items: center; gap: 10px; padding: 10px 11px; border-radius: 10px; border: 1.5px solid #dde0f0; cursor: pointer; transition: border-color .2s, background .2s; margin-bottom: 7px; background: #fff; position: relative; overflow: hidden; user-select: none; }
        .type-card::before { content:''; position:absolute; left:0; top:0; bottom:0; width:3px; background:#0d1883; opacity:0; transition:opacity .2s; }
        .type-card:hover { border-color:#0d1883; background:#f0f3ff; }
        .type-card:hover::before { opacity:1; }
        .type-card.active { border-color:#0d1883; background:#eef1ff; }
        .type-card.active::before { opacity:1; }
        .type-thumb { width:52px; height:33px; background:#e8ecff; border-radius:6px; overflow:hidden; flex-shrink:0; display:flex; align-items:center; justify-content:center; }
        .type-thumb img { width:100%; height:100%; object-fit:contain; }
        .type-thumb svg { width:36px; height:22px; }
        .type-info h6 { font-size:12px; font-weight:600; color:#1a1a1a; margin-bottom:1px; }
        .type-info small { font-size:10px; color:#999; }
        .type-check { margin-left:auto; width:17px; height:17px; border-radius:50%; background:#0d1883; display:none; align-items:center; justify-content:center; flex-shrink:0; }
        .type-card.active .type-check { display:flex; }
        .type-check svg { width:9px; height:9px; }

        /* Horizontal category cards */
        .cat-empty { display:flex; flex-direction:column; align-items:center; justify-content:center; height:120px; gap:8px; }
        .cat-empty svg { width:32px; height:32px; opacity:.3; fill:#aaa; }
        .cat-empty p { font-size:12.5px; color:#bbb; }
        .cat-row { display:flex; gap:12px; flex-wrap:wrap; }
        .cat-thumb-card { flex:1; min-width:110px; max-width:170px; border:2px solid #e0e4f0; border-radius:14px; padding:13px 10px; cursor:pointer; transition:border-color .2s,background .2s,transform .2s,box-shadow .2s; background:#fff; text-align:center; position:relative; user-select:none; }
        .cat-thumb-card:hover { border-color:#0d1883; background:#f5f7ff; transform:translateY(-3px); box-shadow:0 6px 18px rgba(13,24,131,.1); }
        .cat-thumb-card.active { border-color:#0d1883; background:#eef1ff; box-shadow:0 6px 18px rgba(13,24,131,.15); }
        .cat-thumb-card.dimmed { opacity:.35; transform:none; pointer-events:none; }
        .ctc-img { width:100%; height:58px; background:#e8ecff; border-radius:9px; display:flex; align-items:center; justify-content:center; margin-bottom:9px; overflow:hidden; }
        .ctc-img img { width:100%; height:100%; object-fit:contain; }
        .ctc-img svg { width:50px; height:32px; }
        .ctc-name { font-size:13px; font-weight:600; color:#1a1a1a; margin-bottom:3px; }
        .ctc-price { font-size:11.5px; font-weight:700; color:#0d1883; }
        .ctc-pax { font-size:10px; color:#999; margin-top:2px; }
        .ctc-check { position:absolute; top:7px; right:7px; width:18px; height:18px; background:#0d1883; border-radius:50%; display:none; align-items:center; justify-content:center; }
        .cat-thumb-card.active .ctc-check { display:flex; }
        .ctc-check svg { width:10px; height:10px; fill:white; }

        /* Detail panel */
        .cat-detail-panel { display:none; border:2px solid #0d1883; border-radius:16px; overflow:hidden; margin-top:14px; animation:slideDown .28s cubic-bezier(.34,1.3,.64,1); }
        .cat-detail-panel.visible { display:block; }
        @keyframes slideDown { from{opacity:0;transform:translateY(-10px)} to{opacity:1;transform:translateY(0)} }
        .detail-inner { display:grid; grid-template-columns:320px 1fr; }
        @media(max-width:640px){ .detail-inner { grid-template-columns:1fr; } }

        /* Carousel */
        .carousel-wrap { position:relative; background:#0a1060; overflow:hidden; min-height:240px; }
        .carousel-track { display:flex; transition:transform .4s cubic-bezier(.25,.46,.45,.94); }
        .carousel-slide { min-width:100%; height:240px; overflow:hidden; display:flex; align-items:center; justify-content:center; background:#0d1883; }
        .carousel-slide img { width:100%; height:100%; object-fit:cover; display:block; }
        .carousel-slide .slide-fb { width:100%; height:100%; display:flex; align-items:center; justify-content:center; }
        .carousel-slide .slide-fb svg { width:120px; height:80px; }
        .car-nav { position:absolute; top:50%; transform:translateY(-50%); width:32px; height:32px; background:rgba(255,255,255,.2); border:none; border-radius:50%; cursor:pointer; display:flex; align-items:center; justify-content:center; backdrop-filter:blur(4px); transition:background .2s; z-index:5; }
        .car-nav:hover { background:rgba(255,255,255,.4); }
        .car-nav svg { width:14px; height:14px; fill:white; }
        .car-nav.prev { left:10px; }
        .car-nav.next { right:10px; }
        .car-dots { position:absolute; bottom:10px; left:50%; transform:translateX(-50%); display:flex; gap:6px; z-index:5; }
        .car-dot { width:7px; height:7px; border-radius:50%; background:rgba(255,255,255,.4); cursor:pointer; transition:background .2s,transform .2s; border:none; }
        .car-dot.active { background:white; transform:scale(1.3); }
        .slide-label { position:absolute; bottom:28px; left:12px; background:rgba(0,0,0,.55); color:white; font-size:10.5px; font-weight:600; padding:3px 9px; border-radius:20px; backdrop-filter:blur(4px); z-index:5; }

        /* Detail info */
        .detail-info { padding:20px 22px; display:flex; flex-direction:column; gap:12px; background:#fff; }
        .di-cat-name { font-family:'Playfair Display',serif; font-size:19px; font-weight:600; color:#0d1883; margin-bottom:3px; }
        .di-type-tag { display:inline-flex; background:#eef1ff; color:#0d1883; font-size:9.5px; font-weight:700; padding:3px 9px; border-radius:20px; text-transform:uppercase; letter-spacing:.06em; }
        .di-price { font-size:20px; font-weight:700; color:#0d1883; }
        .di-price span { font-size:11.5px; font-weight:400; color:#999; margin-left:3px; }
        .di-pax { display:flex; align-items:center; gap:6px; font-size:12px; color:#666; margin-top:4px; }
        .di-pax svg { width:13px; height:13px; fill:#0d1883; opacity:.7; }
        .feat-label { font-size:10px; font-weight:700; color:#999; text-transform:uppercase; letter-spacing:.09em; margin-bottom:7px; }
        .feat-list { list-style:none; display:flex; flex-direction:column; gap:5px; }
        .feat-list li { display:flex; align-items:flex-start; gap:7px; font-size:12px; color:#444; line-height:1.4; }
        .feat-list li svg { width:12px; height:12px; fill:#0d1883; flex-shrink:0; margin-top:1px; opacity:.85; }
        .di-actions { display:flex; gap:9px; margin-top:4px; }
        .btn-change { padding:9px 13px; background:#f0f3ff; color:#0d1883; border:1.5px solid #c5cef8; border-radius:9px; font-size:11.5px; font-weight:600; font-family:'DM Sans',sans-serif; cursor:pointer; transition:all .2s; display:flex; align-items:center; gap:5px; white-space:nowrap; }
        .btn-change:hover { background:#e0e8ff; }
        .btn-change svg { width:11px; height:11px; fill:#0d1883; }
        .btn-proceed-cat { flex:1; padding:10px 13px; background:linear-gradient(135deg,#0d1883,#2d39b6); color:white; border:none; border-radius:9px; font-size:11.5px; font-weight:600; font-family:'DM Sans',sans-serif; cursor:pointer; transition:all .2s; display:flex; align-items:center; justify-content:center; gap:5px; }
        .btn-proceed-cat:hover { background:linear-gradient(135deg,#0b1570,#1e2d9e); transform:translateY(-1px); }
        .btn-proceed-cat svg { width:11px; height:11px; fill:white; }

        /* Distance + pricing */
        .dist-status { display:none; align-items:center; gap:7px; font-size:12px; color:#0d1883; padding:8px 12px; background:#eef1ff; border-radius:8px; margin-bottom:10px; }
        .dist-status.show { display:flex; }
        .dist-status svg { width:14px; height:14px; fill:#0d1883; animation:spin .8s linear infinite; }
        .dist-result { display:none; background:#eef1ff; border:1px solid #c5cef8; border-radius:9px; padding:9px 13px; margin-bottom:10px; font-size:12px; color:#0d1883; font-weight:600; }
        .dist-result.show { display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:4px; }
        .price-breakdown { background:#f7f8ff; border:1.5px solid #c5cef8; border-radius:10px; padding:13px 15px; display:none; margin-top:8px; }
        .price-breakdown.show { display:block; }
        .pb-title { font-size:9.5px; font-weight:700; color:#999; text-transform:uppercase; letter-spacing:.08em; margin-bottom:9px; }
        .pb-row { display:flex; justify-content:space-between; padding:3px 0; font-size:12px; border-bottom:1px solid #e8eaf5; }
        .pb-row:last-of-type { border-bottom:none; }
        .pb-row span { color:#666; } .pb-row strong { color:#1a1a1a; }
        .pb-total { display:flex; justify-content:space-between; padding-top:7px; margin-top:3px; border-top:1.5px solid #c5cef8; font-size:13.5px; font-weight:700; }
        .pb-total span { color:#555; } .pb-total strong { color:#0d1883; }

        /* Forms */
        .form-section-title { font-family:'Playfair Display',serif; font-size:17px; font-weight:600; color:#0d1883; margin-bottom:4px; }
        .form-chip { display:inline-flex; align-items:center; gap:6px; background:#eef1ff; border:1px solid #c5cef8; border-radius:20px; padding:4px 11px; font-size:11px; font-weight:600; color:#0d1883; margin-bottom:14px; }
        .form-chip svg { width:11px; height:11px; fill:#0d1883; }
        .form-row { display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-bottom:12px; }
        @media(max-width:540px){ .form-row { grid-template-columns:1fr; } }
        .form-group { display:flex; flex-direction:column; gap:4px; }
        .form-group label { font-size:10.5px; font-weight:600; color:#555; letter-spacing:.04em; text-transform:uppercase; }
        .form-group input, .form-group select { padding:10px 12px; border:1.5px solid #dde0ee; border-radius:9px; font-size:13px; font-family:'DM Sans',sans-serif; color:#1a1a1a; background:#fafbff; transition:border-color .2s,box-shadow .2s; outline:none; }
        .form-group input:focus, .form-group select:focus { border-color:#0d1883; box-shadow:0 0 0 3px rgba(13,24,131,.07); background:#fff; }
        .pay-title { font-size:10.5px; font-weight:700; color:#555; text-transform:uppercase; letter-spacing:.04em; margin-bottom:8px; display:block; }
        .pay-opts { display:flex; gap:10px; margin-bottom:15px; }
        .pay-opt { flex:1; border:1.5px solid #dde0ee; border-radius:10px; padding:10px 12px; cursor:pointer; display:flex; align-items:center; gap:8px; transition:border-color .2s,background .2s; background:#fafbff; user-select:none; }
        .pay-opt:hover { border-color:#0d1883; background:#f0f3ff; }
        .pay-opt.active { border-color:#0d1883; background:#eef1ff; }
        .pay-opt input[type="radio"] { display:none; }
        .pay-dot { width:14px; height:14px; border-radius:50%; border:2px solid #ccc; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
        .pay-opt.active .pay-dot { border-color:#0d1883; }
        .pay-dot-inner { width:6px; height:6px; border-radius:50%; background:#0d1883; display:none; }
        .pay-opt.active .pay-dot-inner { display:block; }
        .pay-label { font-size:12px; font-weight:600; color:#1a1a1a; }
        .pay-sub { font-size:10px; color:#999; }
        .btn-review { width:100%; padding:13px; background:linear-gradient(135deg,#0d1883,#2d39b6); color:white; border:none; border-radius:11px; font-size:13.5px; font-weight:600; font-family:'DM Sans',sans-serif; cursor:pointer; transition:all .2s; letter-spacing:.02em; }
        .btn-review:hover { background:linear-gradient(135deg,#0b1570,#1e2d9e); transform:translateY(-1px); }
        .btn-calc { width:100%; padding:10px; background:#f0f3ff; color:#0d1883; border:1.5px solid #c5cef8; border-radius:9px; font-size:12.5px; font-weight:600; font-family:'DM Sans',sans-serif; cursor:pointer; transition:all .2s; margin-bottom:12px; }
        .btn-calc:hover { background:#e0e8ff; }
        .btn-proceed-form { width:100%; padding:11px; background:linear-gradient(135deg,#0d1883,#2d39b6); color:white; border:none; border-radius:10px; font-size:13px; font-weight:600; font-family:'DM Sans',sans-serif; cursor:pointer; transition:all .2s; margin-top:12px; display:flex; align-items:center; justify-content:center; gap:6px; }
        .btn-proceed-form:hover { background:linear-gradient(135deg,#0b1570,#1e2d9e); transform:translateY(-1px); }
        .btn-proceed-form svg { width:12px; height:12px; fill:white; }
        .secure-note { text-align:center; font-size:10.5px; color:#bbb; margin-top:9px; display:flex; align-items:center; justify-content:center; gap:5px; }
        .secure-note svg { width:10px; height:10px; opacity:.5; }
        .alert-box { background:#fff0f0; border:1px solid #ffc5c5; color:#c0392b; border-radius:9px; padding:9px 13px; font-size:12px; margin-bottom:12px; display:none; }

        /* Transfer */
        .tr-loc-grid { display:grid; grid-template-columns:1fr 32px 1fr; align-items:end; gap:8px; margin-bottom:12px; }
        @media(max-width:500px){ .tr-loc-grid { grid-template-columns:1fr; } .tr-arrow { display:none; } }
        .tr-arrow { display:flex; align-items:center; justify-content:center; padding-bottom:2px; }
        .tr-arrow svg { width:18px; height:18px; fill:#0d1883; opacity:.4; }
        .tr-vehicles { display:grid; grid-template-columns:repeat(3,1fr); gap:10px; }
        @media(max-width:560px){ .tr-vehicles { grid-template-columns:repeat(2,1fr); } }
        .tv { border:1.5px solid #e0e2f0; border-radius:12px; padding:13px 10px; cursor:pointer; transition:all .2s; background:#fff; text-align:center; }
        .tv:hover { border-color:#0d1883; background:#eef1ff; transform:translateY(-2px); box-shadow:0 4px 12px rgba(13,24,131,.1); }
        .tv.active { border-color:#0d1883; background:#eef1ff; box-shadow:0 4px 14px rgba(13,24,131,.12); }
        .tv-thumb { width:100%; height:48px; background:#e8ecff; border-radius:8px; display:flex; align-items:center; justify-content:center; margin-bottom:7px; overflow:hidden; }
        .tv-thumb img { width:100%; height:100%; object-fit:contain; }
        .tv-thumb svg { width:40px; height:26px; }
        .tv-name { font-size:12px; font-weight:600; color:#1a1a1a; margin-bottom:2px; }
        .tv-pax { font-size:10px; color:#999; margin-bottom:3px; }
        .tv-price { font-size:12.5px; font-weight:700; color:#0d1883; }
        .tv-rate { font-size:9.5px; color:#aaa; }

        /* ══════════════════════════════════════
           MODAL — fixed approach:
           - display:none / display:flex toggle (no opacity/visibility trick)
           - position:fixed with z-index:99999
           - modal box uses @keyframes for entrance animation
           - NO transform on the modal at rest (avoids invisible box bug)
        ══════════════════════════════════════ */
        /*#reviewModal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(10,12,40,0.65);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            z-index: 99999;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        #reviewModal.open {
            display: flex;
        }
        .modal {
            background: #fff;
            border-radius: 20px;
            width: 100%;
            max-width: 520px;
            max-height: 88vh;
            overflow-y: auto;
            box-shadow: 0 24px 60px rgba(13,24,131,.3);
            opacity: 1;
            transform: none;
            animation: modalIn .25s ease both;
        }*/
        @keyframes modalIn {
            from { opacity: 0; transform: translateY(20px) scale(.96); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }
        .modal-head { background:linear-gradient(135deg,#0d1883,#2d39b6); padding:24px 24px 20px; border-radius:20px 20px 0 0; position:relative; }
        .modal-head-icon { width:40px; height:40px; background:rgba(255,255,255,.18); border-radius:10px; display:flex; align-items:center; justify-content:center; margin-bottom:10px; }
        .modal-head-icon svg { width:20px; height:20px; fill:white; }
        .modal-head h2 { font-family:'Playfair Display',serif; font-size:18px; color:#fff; margin-bottom:3px; }
        .modal-head p { font-size:12px; color:rgba(255,255,255,.7); }
        .modal-x { position:absolute; top:14px; right:16px; width:28px; height:28px; background:rgba(255,255,255,.15); border:none; border-radius:50%; cursor:pointer; display:flex; align-items:center; justify-content:center; transition:background .2s; }
        .modal-x:hover { background:rgba(255,255,255,.3); }
        .modal-x svg { width:12px; height:12px; fill:white; }
        .modal-body { padding:18px 22px 4px; }
        .modal-warn { background:#fffbea; border:1px solid #f0d96a; border-radius:9px; padding:9px 12px; font-size:11.5px; color:#7a5c00; margin-bottom:14px; display:flex; gap:7px; align-items:flex-start; }
        .modal-warn svg { width:14px; height:14px; fill:#c8960a; flex-shrink:0; margin-top:1px; }
        .rev-section { margin-bottom:13px; }
        .rev-title { font-size:9.5px; font-weight:700; color:#0d1883; text-transform:uppercase; letter-spacing:.1em; margin-bottom:8px; display:flex; align-items:center; gap:5px; }
        .rev-title::after { content:''; flex:1; height:1px; background:#e0e4f8; }
        .rev-grid { display:grid; grid-template-columns:1fr 1fr; gap:7px; }
        .rev-item { background:#f7f8ff; border:1px solid #e4e8f5; border-radius:8px; padding:8px 11px; }
        .rev-item.full { grid-column:1/-1; }
        .rev-item.hi .rev-val { color:#0d1883; font-size:14px; }
        .rev-lbl { font-size:9.5px; color:#999; font-weight:600; text-transform:uppercase; letter-spacing:.06em; margin-bottom:2px; }
        .rev-val { font-size:12.5px; font-weight:600; color:#1a1a1a; word-break:break-word; }
        .pay-badge { display:inline-flex; align-items:center; gap:6px; background:#eef1ff; color:#0d1883; font-size:12px; font-weight:600; padding:5px 12px; border-radius:20px; }
        .pay-badge svg { width:12px; height:12px; fill:#0d1883; }
        .modal-foot { display:flex; gap:10px; padding:14px 22px 22px; }
        .btn-edit { flex:1; padding:11px; background:#f0f3ff; color:#0d1883; border:1.5px solid #c5cef8; border-radius:10px; font-size:12.5px; font-weight:600; font-family:'DM Sans',sans-serif; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:5px; transition:background .2s; }
        .btn-edit:hover { background:#e0e6ff; }
        .btn-edit svg { width:13px; height:13px; fill:#0d1883; }
        .btn-pay { flex:1.6; padding:11px; background:linear-gradient(135deg,#0d1883,#2d39b6); color:white; border:none; border-radius:10px; font-size:12.5px; font-weight:600; font-family:'DM Sans',sans-serif; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:5px; transition:all .2s; }
        .btn-pay:hover { background:linear-gradient(135deg,#0b1570,#1e2d9e); transform:translateY(-1px); }
        .btn-pay:disabled { opacity:.65; cursor:not-allowed; transform:none; }
        .btn-pay svg { width:13px; height:13px; fill:white; }
        @keyframes spin { to { transform:rotate(360deg); } }
    </style>
</head>
<body>
<div id="reviewModal" style="display:none;position:fixed;inset:0;background:rgba(10,12,40,0.65);backdrop-filter:blur(5px);z-index:99999;align-items:center;justify-content:center;padding:20px;">
    <div id="modalBox" style="background:#fff;border-radius:20px;width:100%;max-width:520px;max-height:90vh;overflow-y:auto;box-shadow:0 24px 60px rgba(13,24,131,.3);">

        <div style="background:#0d1883;padding:22px 22px 18px;border-radius:20px 20px 0 0;position:relative;">
            <button onclick="closeModal()" style="position:absolute;top:13px;right:14px;width:28px;height:28px;background:rgba(255,255,255,.15);border:none;border-radius:50%;cursor:pointer;display:flex;align-items:center;justify-content:center;">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="white"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/></svg>
            </button>
            <div style="width:36px;height:36px;background:rgba(255,255,255,.18);border-radius:10px;display:flex;align-items:center;justify-content:center;margin-bottom:10px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="white"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/></svg>
            </div>
            <h2 style="font-family:'Playfair Display',serif;font-size:18px;color:#fff;margin-bottom:3px;">Review Your Booking</h2>
            <p style="font-size:12px;color:rgba(255,255,255,.7);">Confirm all details before payment</p>
        </div>

        <div style="padding:16px 20px 4px;">
            <div style="background:#fffbea;border:1px solid #f0d96a;border-radius:9px;padding:9px 12px;font-size:11.5px;color:#7a5c00;margin-bottom:14px;display:flex;gap:7px;align-items:flex-start;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="#c8960a" style="flex-shrink:0;margin-top:1px"><path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/></svg>
                Double-check your details. Once payment starts, changes may not be possible.
            </div>
            <div id="modalContent"></div>
        </div>

        <div style="display:flex;gap:10px;padding:14px 20px 22px;">
            <button onclick="closeModal()" style="flex:1;padding:11px;background:#f0f3ff;color:#0d1883;border:1.5px solid #c5cef8;border-radius:10px;font-size:12.5px;font-weight:600;font-family:'DM Sans',sans-serif;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:5px;">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="#0d1883"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34a1 1 0 00-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>
                Edit Details
            </button>
            <button id="confirmBtn" onclick="submitBooking()" style="flex:1.6;padding:11px;background:#0d1883;color:white;border:none;border-radius:10px;font-size:12.5px;font-weight:600;font-family:'DM Sans',sans-serif;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:6px;">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="white"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z"/></svg>
                Confirm &amp; Pay
            </button>
        </div>

    </div>
</div>

<div class="page">

    <div class="page-header">
        <div class="page-icon"><svg viewBox="0 0 24 24"><path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/></svg></div>
        <div>
            <h1>Ground Transport</h1>
            <p>Book a car hire or arrange a seamless airport/port transfer. Professional drivers, all vehicle types, across Nigeria.</p>
        </div>
    </div>

    <div class="tab-bar">
        <button class="tab-btn active" id="tab-ch" onclick="switchTab('ch')">
            <svg viewBox="0 0 24 24"><path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99z"/></svg>
            Car Hire
        </button>
        <button class="tab-btn" id="tab-tr" onclick="switchTab('tr')">
            <svg viewBox="0 0 24 24"><path d="M21 3L3 10.53v.98l6.84 2.65L12.48 21h.98L21 3z"/></svg>
            Transfer
        </button>
    </div>

    {{-- ══════════ CAR HIRE ══════════ --}}
    <div class="tab-panel active" id="panel-ch">
        <div class="outer-card">
            <div class="card-layout">
                <div class="sidebar">
                    <div class="section-label">1 · Vehicle type</div>
                    @foreach(['saloon','suv','van','bus','luxury'] as $vtype)
                    <div class="type-card" onclick="ch_setType('{{ $vtype }}',this)">
                        <div class="type-thumb">
                            <img src="{{ $typeThumbs[$vtype] }}" onerror="this.style.display='none';this.nextElementSibling.style.display='block';" alt="{{ ucfirst($vtype) }}">
                            <svg style="display:none" viewBox="0 0 60 38" fill="none"><rect x="3" y="12" width="50" height="18" rx="3" fill="#0d1883" opacity="0.3"/><circle cx="14" cy="32" r="5" fill="#0d1883" opacity="0.7"/><circle cx="42" cy="32" r="5" fill="#0d1883" opacity="0.7"/></svg>
                        </div>
                        <div class="type-info">
                            <h6>{{ $vtype === 'van' ? 'Mini Van' : ucfirst($vtype) }}</h6>
                            <small>{{ $categories[$vtype]['items'][0]['passengers'] ?? '—' }}</small>
                        </div>
                        <div class="type-check"><svg viewBox="0 0 12 10" fill="none"><path d="M1 5l3 3 7-7" stroke="white" stroke-width="1.8" stroke-linecap="round"/></svg></div>
                    </div>
                    @endforeach
                </div>

                <div class="content-area">
                    <div class="inner-card tinted">
                        <div class="section-label">2 · Select category</div>
                        <div id="ch_typeLbl" style="font-size:12px;font-weight:500;color:#0d1883;margin-bottom:14px;display:none;"></div>
                        <div id="ch_catArea">
                            <div class="cat-empty">
                                <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z" fill="currentColor"/></svg>
                                <p>Choose a vehicle type first</p>
                            </div>
                        </div>
                        <div id="ch_detailPanel" class="cat-detail-panel"></div>
                    </div>

                    <div class="inner-card" id="ch_pricingCard" style="display:none;">
                        <div class="section-label">3 · Route &amp; duration</div>
                        <div id="ch_alertA" class="alert-box"></div>
                        <div class="form-row" style="margin-bottom:10px;">
                            <div class="form-group">
                                <label>Pick-up Location</label>
                                <input type="text" id="ch_pickup" placeholder="e.g. Victoria Island, Lagos" oninput="ch_clearDist()">
                            </div>
                            <div class="form-group">
                                <label>Drop-off Location</label>
                                <input type="text" id="ch_dropoff" placeholder="e.g. Lekki Phase 1, Lagos" oninput="ch_clearDist()">
                            </div>
                        </div>
                        <button class="btn-calc" onclick="ch_calcDist()">📍 Calculate Distance via Google Maps</button>
                        <div class="dist-status" id="ch_calcSt">
                            <svg viewBox="0 0 24 24"><path d="M12 4V1L8 5l4 4V6c3.31 0 6 2.69 6 6s-2.69 6-6 6-6-2.69-6-6H4c0 4.42 3.58 8 8 8s8-3.58 8-8-3.58-8-8-8z"/></svg>
                            Calculating via Google Maps...
                        </div>
                        <div class="dist-result" id="ch_distRes">
                            <div>Distance: <strong id="ch_distKmLbl">—</strong> &nbsp;·&nbsp; Drive time: <strong id="ch_driveLbl">—</strong></div>
                            <span style="font-size:10.5px;color:#888;">via Google Maps</span>
                        </div>
                        <div class="form-group" style="margin-bottom:10px;">
                            <label>Rental Duration (hours)</label>
                            <input type="number" id="ch_hours" placeholder="e.g. 4" min="1" oninput="ch_calcPrice()">
                        </div>
                        <div class="price-breakdown" id="ch_priceBox">
                            <div class="pb-title">Price Breakdown</div>
                            <div class="pb-row"><span>Base price</span><strong id="pb_base">₦0</strong></div>
                            <div class="pb-row"><span>Fuel (<span id="pb_km">0</span> km × ₦<span id="pb_frate">0</span>/km)</span><strong id="pb_fuel">₦0</strong></div>
                            <div class="pb-row"><span>Hourly (<span id="pb_hrs">0</span> hrs × ₦<span id="pb_hrate">0</span>/hr)</span><strong id="pb_hrly">₦0</strong></div>
                            <div class="pb-total"><span>Total Estimate</span><strong id="pb_total">₦0</strong></div>
                        </div>
                        <button class="btn-proceed-form" onclick="ch_goToForm()">
                            <svg viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/></svg>
                            Proceed to Booking Form
                        </button>
                    </div>

                    <div class="inner-card" id="ch_formCard" style="display:none;">
                        <div class="form-section-title">Booking Details</div>
                        <div class="form-chip">
                            <svg viewBox="0 0 24 24"><path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99z"/></svg>
                            <span id="ch_chipTxt"></span>
                        </div>
                        <div id="ch_alertB" class="alert-box"></div>
                        <div class="form-row">
                            <div class="form-group"><label>Full Name</label><input type="text" id="ch_name" placeholder="Enter your full name"></div>
                            <div class="form-group"><label>Email</label><input type="email" id="ch_email" placeholder="Enter your email"></div>
                        </div>
                        <div class="form-row">
                            <div class="form-group"><label>Phone Number</label><input type="tel" id="ch_phone" placeholder="Enter your phone"></div>
                            <div class="form-group"><label>Passengers</label><input type="number" id="ch_pax" placeholder="e.g. 2" min="1"></div>
                        </div>
                        <div class="form-row">
                            <div class="form-group"><label>Pick-up Date</label><input type="date" id="ch_date"></div>
                            <div class="form-group"><label>Pick-up Time</label><input type="time" id="ch_time"></div>
                        </div>
                        <span class="pay-title">Payment Method</span>
                        <div class="pay-opts">
                            <label class="pay-opt active" id="ch_p_budpay" onclick="ch_pay('budpay')">
                                <input type="radio" checked>
                                <div class="pay-dot"><div class="pay-dot-inner"></div></div>
                                <div><div class="pay-label">BudPay</div><div class="pay-sub">Card, bank transfer</div></div>
                            </label>
                            <label class="pay-opt" id="ch_p_seerbit" onclick="ch_pay('seerbit')">
                                <input type="radio">
                                <div class="pay-dot"><div class="pay-dot-inner"></div></div>
                                <div><div class="pay-label">SeerBit</div><div class="pay-sub">Card, USSD, bank</div></div>
                            </label>
                        </div>
                        <button type="button" class="btn-review" onclick="openModal('ch')">Review &amp; Proceed to Payment</button>
                        <div class="secure-note"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z"/></svg>Secured payment · Your data is protected</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ══════════ TRANSFER ══════════ --}}
    <div class="tab-panel" id="panel-tr">
        <div class="outer-card">
            <div class="content-area" style="padding:22px 20px;">
                <div class="inner-card tinted">
                    <div class="section-label">1 · Your route</div>
                    <p style="font-size:12.5px;color:#888;margin-bottom:14px;">Enter pick-up and drop-off — Google Maps calculates the exact road distance and price automatically.</p>
                    <div class="tr-loc-grid">
                        <div class="form-group">
                            <label>Pick-up Location</label>
                            <input type="text" id="tr_from" placeholder="e.g. Murtala Muhammed Airport, Lagos" oninput="tr_clearDist()">
                        </div>
                        <div class="tr-arrow"><svg viewBox="0 0 24 24"><path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/></svg></div>
                        <div class="form-group">
                            <label>Drop-off Location</label>
                            <input type="text" id="tr_to" placeholder="e.g. Victoria Island, Lagos" oninput="tr_clearDist()">
                        </div>
                    </div>
                    <button class="btn-calc" onclick="tr_calcDist()">📍 Calculate Distance via Google Maps</button>
                    <div class="dist-status" id="tr_calcSt">
                        <svg viewBox="0 0 24 24"><path d="M12 4V1L8 5l4 4V6c3.31 0 6 2.69 6 6s-2.69 6-6 6-6-2.69-6-6H4c0 4.42 3.58 8 8 8s8-3.58 8-8-3.58-8-8-8z"/></svg>
                        Calculating via Google Maps...
                    </div>
                    <div class="dist-result" id="tr_distRes">
                        <div>Distance: <strong id="tr_distKmLbl">—</strong> &nbsp;·&nbsp; Drive time: <strong id="tr_driveLbl">—</strong></div>
                        <span style="font-size:10.5px;color:#888;">via Google Maps</span>
                    </div>
                    <div id="tr_alertA" class="alert-box"></div>
                </div>

                <div class="inner-card" id="tr_vehicleCard" style="display:none;">
                    <div class="section-label">2 · Select vehicle</div>
                    <div class="tr-vehicles" id="tr_vehicleGrid"></div>
                </div>

                <div class="inner-card" id="tr_formCard" style="display:none;">
                    <div class="form-section-title">Transfer Details</div>
                    <div class="form-chip"><svg viewBox="0 0 24 24"><path d="M21 3L3 10.53v.98l6.84 2.65L12.48 21h.98L21 3z"/></svg><span id="tr_chipTxt"></span></div>
                    <div id="tr_alertB" class="alert-box"></div>
                    <div class="form-row">
                        <div class="form-group"><label>Full Name</label><input type="text" id="tr_name" placeholder="Enter your full name"></div>
                        <div class="form-group"><label>Email</label><input type="email" id="tr_email" placeholder="Enter your email"></div>
                    </div>
                    <div class="form-row">
                        <div class="form-group"><label>Phone Number</label><input type="tel" id="tr_phone" placeholder="Enter your phone"></div>
                        <div class="form-group"><label>Passengers</label><input type="number" id="tr_pax" placeholder="e.g. 2" min="1"></div>
                    </div>
                    <div class="form-row">
                        <div class="form-group"><label>Flight / Vessel No. (optional)</label><input type="text" id="tr_flight" placeholder="e.g. LH 401"></div>
                        <div class="form-group"><label>Special Requests (optional)</label><input type="text" id="tr_notes" placeholder="e.g. child seat, extra luggage"></div>
                    </div>
                    <div class="form-row">
                        <div class="form-group"><label>Arrival / Pick-up Date</label><input type="date" id="tr_date"></div>
                        <div class="form-group"><label>Arrival / Pick-up Time</label><input type="time" id="tr_time"></div>
                    </div>
                    <span class="pay-title">Payment Method</span>
                    <div class="pay-opts">
                        <label class="pay-opt active" id="tr_p_budpay" onclick="tr_pay('budpay')">
                            <input type="radio" checked>
                            <div class="pay-dot"><div class="pay-dot-inner"></div></div>
                            <div><div class="pay-label">BudPay</div><div class="pay-sub">Card, bank transfer</div></div>
                        </label>
                        <label class="pay-opt" id="tr_p_seerbit" onclick="tr_pay('seerbit')">
                            <input type="radio">
                            <div class="pay-dot"><div class="pay-dot-inner"></div></div>
                            <div><div class="pay-label">SeerBit</div><div class="pay-sub">Card, USSD, bank</div></div>
                        </label>
                    </div>
                    <button type="button" class="btn-review" onclick="openModal('tr')">Review &amp; Proceed to Payment</button>
                    <div class="secure-note"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z"/></svg>Secured payment · Your data is protected</div>
                </div>
            </div>
        </div>
    </div>

</div>{{-- /page --}}

{{-- Hidden submit forms --}}
<form id="ch_form" method="POST" action="{{ route('carhire.submit') }}" style="display:none">
    @csrf
    <input type="hidden" name="car_type"         id="h_ch_type">
    <input type="hidden" name="category"          id="h_ch_cat">
    <input type="hidden" name="price"             id="h_ch_price">
    <input type="hidden" name="distance_km"       id="h_ch_dist">
    <input type="hidden" name="rental_hours"      id="h_ch_hours">
    <input type="hidden" name="full_name"         id="h_ch_name">
    <input type="hidden" name="email"             id="h_ch_email">
    <input type="hidden" name="phone_number"      id="h_ch_phone">
    <input type="hidden" name="passengers"        id="h_ch_pax">
    <input type="hidden" name="pickup_location"   id="h_ch_pickup">
    <input type="hidden" name="dropoff_location"  id="h_ch_dropoff">
    <input type="hidden" name="pickup_date"       id="h_ch_date">
    <input type="hidden" name="pickup_time"       id="h_ch_time">
    <input type="hidden" name="payment_option"    id="h_ch_payment">
</form>
<form id="tr_form" method="POST" action="{{ route('transfer.submit') }}" style="display:none">
    @csrf
    <input type="hidden" name="vehicle_type"      id="h_tr_type">
    <input type="hidden" name="vehicle_name"      id="h_tr_vname">
    <input type="hidden" name="price"             id="h_tr_price">
    <input type="hidden" name="distance_km"       id="h_tr_dist">
    <input type="hidden" name="pickup_location"   id="h_tr_from">
    <input type="hidden" name="dropoff_location"  id="h_tr_to">
    <input type="hidden" name="full_name"         id="h_tr_name">
    <input type="hidden" name="email"             id="h_tr_email">
    <input type="hidden" name="phone_number"      id="h_tr_phone">
    <input type="hidden" name="passengers"        id="h_tr_pax">
    <input type="hidden" name="flight_number"     id="h_tr_flight">
    <input type="hidden" name="special_requests"  id="h_tr_notes">
    <input type="hidden" name="pickup_date"       id="h_tr_date">
    <input type="hidden" name="pickup_time"       id="h_tr_time">
    <input type="hidden" name="payment_option"    id="h_tr_payment">
</form>

<script>
/* ══════════════════════════════════════
   DATA FROM BACKEND — nothing hardcoded
══════════════════════════════════════ */
const CH_DATA     = @json($categories);
const TR_VEHICLES = @json($transferVehicles);
const CSRF_TOKEN  = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const DIST_URL    = '{{ route("api.distance") }}';
const SLIDE_LABELS = ['Front', 'Rear', 'Interior'];
const PAX_LIMITS = {
    saloon:  3,
    suv:     6,
    van:     9,
    bus:     16,
    luxury:  6,
};
const SVG_FB = `<svg viewBox="0 0 60 38" fill="none"><rect x="3" y="10" width="50" height="22" rx="3" fill="#0d1883" opacity="0.3"/><circle cx="14" cy="34" r="5" fill="#0d1883" opacity="0.6"/><circle cx="42" cy="34" r="5" fill="#0d1883" opacity="0.6"/></svg>`;

/* ── State ── */
let chSelType=null, chSelCat=null, chDistKm=0, chFinalPrice=0, chPayment='budpay';
let trDistKm=0, trSelVehicle=null, trFinalPrice=0, trPayment='budpay';
let activeModal=null, carIdx=0;

/* ══════════════════════════════════════
   TABS
══════════════════════════════════════ */
function switchTab(t) {
    ['ch','tr'].forEach(x => {
        document.getElementById('tab-'+x).classList.toggle('active', x===t);
        document.getElementById('panel-'+x).classList.toggle('active', x===t);
    });
}

/* ══════════════════════════════════════
   GOOGLE MAPS — backend proxy call
   Both car hire AND transfer use this
══════════════════════════════════════ */
async function fetchDistance(origin, destination) {
    const res = await fetch(DIST_URL, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': CSRF_TOKEN,
            'Accept': 'application/json',
        },
        body: JSON.stringify({ origin, destination }),
    });
    const data = await res.json();
    if (!res.ok) throw new Error(data.error || 'Distance calculation failed.');
    return data; // { distance_km, distance_text, drive_time }
}

/* ══════════════════════════════════════
   CAR HIRE
══════════════════════════════════════ */
function ch_setType(type, el) {
    document.querySelectorAll('#panel-ch .type-card').forEach(c => c.classList.remove('active'));
    el.classList.add('active');
    chSelType=type; chSelCat=null; chDistKm=0; chFinalPrice=0;
    const lbl = document.getElementById('ch_typeLbl');
    lbl.textContent = (type==='van'?'Mini Van':type.charAt(0).toUpperCase()+type.slice(1))+' — choose a category';
    lbl.style.display='block';
    document.getElementById('ch_pricingCard').style.display='none';
    document.getElementById('ch_formCard').style.display='none';
    document.getElementById('ch_detailPanel').classList.remove('visible');
    document.getElementById('ch_detailPanel').innerHTML='';
    ch_renderThumbs(type, null);
}

function ch_renderThumbs(type, activeName) {
    const cats = CH_DATA[type]?.items || [];
    const area = document.getElementById('ch_catArea');
    if (!cats.length) { area.innerHTML=`<div class="cat-empty"><p>No categories available.</p></div>`; return; }
    area.innerHTML = `<div class="cat-row">`+cats.map(cat => {
        const isActive = activeName===cat.name;
        const isDimmed = activeName && activeName!==cat.name;
        const cls = `cat-thumb-card${isActive?' active':''}${isDimmed?' dimmed':''}`;
        const thumbImg = cat.images?.[0]||'';
        const thumb = thumbImg
            ? `<img src="${thumbImg}" alt="${esc(cat.name)}" onerror="this.parentNode.innerHTML=SVG_FB">`
            : SVG_FB;
        return `<div class="${cls}" onclick="ch_selectCat('${esc(type)}','${escQ(cat.name)}')">
            <div class="ctc-check"><svg viewBox="0 0 12 10" fill="none"><path d="M1 5l3 3 7-7" stroke="white" stroke-width="1.8" stroke-linecap="round"/></svg></div>
            <div class="ctc-img">${thumb}</div>
            <div class="ctc-name">${esc(cat.name)}</div>
            <div class="ctc-price">From &#8358;${Number(cat.price).toLocaleString()}</div>
            <div class="ctc-pax">&#128100; ${esc(cat.passengers||'—')}</div>
        </div>`;
    }).join('')+`</div>`;
}

function ch_selectCat(type, name) {
    const cat = (CH_DATA[type]?.items||[]).find(c=>c.name===name);
    if (!cat) return;
    if (chSelCat?.name===name) {
        chSelCat=null;
        document.getElementById('ch_detailPanel').classList.remove('visible');
        document.getElementById('ch_pricingCard').style.display='none';
        document.getElementById('ch_formCard').style.display='none';
        ch_renderThumbs(type, null); return;
    }
    chSelCat=cat;
    ch_renderThumbs(type, name);
    ch_buildDetail(type, cat);

    const paxInput = document.getElementById('ch_pax');
    const maxPax = PAX_LIMITS[type] ?? 20;
    paxInput.max = maxPax;
    paxInput.placeholder = 'e.g. 2 (max ' + maxPax + ')';
    if (parseInt(paxInput.value) > maxPax) paxInput.value = maxPax;
    document.getElementById('ch_pricingCard').style.display='none';
    document.getElementById('ch_formCard').style.display='none';
}

function ch_buildDetail(type, cat) {
    const images = cat.images||[];
    carIdx=0;
    const typeName = type==='van'?'Mini Van':type.charAt(0).toUpperCase()+type.slice(1);
    const slides = images.length
        ? images.map((img,i)=>`<div class="carousel-slide">${img?`<img src="${img}" alt="${esc(cat.name)} ${SLIDE_LABELS[i]||''}">`:`<div class="slide-fb">${SVG_FB}</div>`}<span class="slide-label">${SLIDE_LABELS[i]||('View '+(i+1))}</span></div>`).join('')
        : `<div class="carousel-slide"><div class="slide-fb">${SVG_FB}</div></div>`;
    const totalSlides = images.length||1;
    const dots = images.map((_,i)=>`<button class="car-dot${i===0?' active':''}" onclick="carGoTo(${i})"></button>`).join('');
    const feats = (cat.features||[]).map(f=>`<li><svg viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/></svg>${esc(f)}</li>`).join('');
    const panel = document.getElementById('ch_detailPanel');
    panel.innerHTML=`
        <div class="detail-inner">
            <div class="carousel-wrap">
                <div class="carousel-track" id="carTrack">${slides}</div>
                <button class="car-nav prev" onclick="carGoTo(carIdx-1)"><svg viewBox="0 0 24 24"><path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/></svg></button>
                <button class="car-nav next" onclick="carGoTo(carIdx<${totalSlides-1}?carIdx+1:0)"><svg viewBox="0 0 24 24"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg></button>
                <div class="car-dots">${dots}</div>
            </div>
            <div class="detail-info">
                <div><div class="di-cat-name">${esc(cat.name)}</div><div class="di-type-tag">${esc(typeName)}</div></div>
                <div>
                    <div class="di-price">&#8358;${Number(cat.price).toLocaleString()} <span>base price / trip</span></div>
                    <div class="di-pax"><svg viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>${esc(cat.passengers||'—')} passengers</div>
                </div>
                <div><div class="feat-label">What's included</div><ul class="feat-list">${feats}</ul></div>
                <div class="di-actions">
                    <button class="btn-change" onclick="ch_resetCat()"><svg viewBox="0 0 24 24"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/></svg>Change</button>
                    <button class="btn-proceed-cat" onclick="ch_openPricing()"><svg viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/></svg>Book This Vehicle</button>
                </div>
            </div>
        </div>`;
    panel.classList.add('visible');
    panel.scrollIntoView({ behavior:'smooth', block:'nearest' });
}

function carGoTo(idx) {
    const track = document.getElementById('carTrack');
    if (!track) return;
    carIdx = Math.max(0,Math.min(idx,track.children.length-1));
    track.style.transform=`translateX(-${carIdx*100}%)`;
    document.querySelectorAll('.car-dot').forEach((d,i)=>d.classList.toggle('active',i===carIdx));
}

function ch_resetCat() {
    chSelCat=null;
    document.getElementById('ch_detailPanel').classList.remove('visible');
    document.getElementById('ch_pricingCard').style.display='none';
    document.getElementById('ch_formCard').style.display='none';
    if (chSelType) ch_renderThumbs(chSelType,null);
}

function ch_openPricing() {
    const card=document.getElementById('ch_pricingCard');
    card.style.display='block';
    document.getElementById('ch_formCard').style.display='none';
    card.scrollIntoView({ behavior:'smooth', block:'nearest' });
}

function ch_clearDist() {
    chDistKm=0; chFinalPrice=0;
    document.getElementById('ch_distRes').classList.remove('show');
    document.getElementById('ch_priceBox').classList.remove('show');
}

/* Car hire distance — uses same fetchDistance as transfer */
async function ch_calcDist() {
    const from = document.getElementById('ch_pickup').value.trim();
    const to   = document.getElementById('ch_dropoff').value.trim();
    const alertEl = document.getElementById('ch_alertA');
    alertEl.style.display='none';
    if (!from||!to) { alertEl.textContent='Please enter both pick-up and drop-off locations.'; alertEl.style.display='block'; return; }
    document.getElementById('ch_calcSt').classList.add('show');
    document.getElementById('ch_distRes').classList.remove('show');
    document.getElementById('ch_priceBox').classList.remove('show');
    try {
        const result = await fetchDistance(from, to);
        chDistKm = result.distance_km;
        document.getElementById('ch_distKmLbl').textContent = result.distance_text;
        document.getElementById('ch_driveLbl').textContent  = result.drive_time;
        document.getElementById('ch_distRes').classList.add('show');
        ch_calcPrice(); // auto-calculate if hours already entered
    } catch(e) {
        alertEl.textContent=e.message;
        alertEl.style.display='block';
    } finally {
        document.getElementById('ch_calcSt').classList.remove('show');
    }
}

function ch_calcPrice() {
    if (!chSelCat||!chSelType||!chDistKm) return;
    const typeData = CH_DATA[chSelType];
    const fuelRate = typeData?.fuel_rate_per_km||0;
    const hrRate   = typeData?.hourly_rate||0;
    const hrs      = parseFloat(document.getElementById('ch_hours').value)||0;
    const base     = chSelCat.price;
    const fuel     = chDistKm*fuelRate;
    const hrly     = hrs*hrRate;
    chFinalPrice   = base+fuel+hrly;
    document.getElementById('pb_base').textContent  = '₦'+base.toLocaleString();
    document.getElementById('pb_km').textContent    = chDistKm;
    document.getElementById('pb_frate').textContent = fuelRate.toLocaleString();
    document.getElementById('pb_fuel').textContent  = '₦'+fuel.toLocaleString();
    document.getElementById('pb_hrs').textContent   = hrs;
    document.getElementById('pb_hrate').textContent = hrRate.toLocaleString();
    document.getElementById('pb_hrly').textContent  = '₦'+hrly.toLocaleString();
    document.getElementById('pb_total').textContent = '₦'+chFinalPrice.toLocaleString();
    document.getElementById('ch_priceBox').classList.add('show');
}

function ch_goToForm() {
    const alertEl=document.getElementById('ch_alertA');
    alertEl.style.display='none';
    if (!chDistKm) { alertEl.textContent='Please calculate the distance first.'; alertEl.style.display='block'; return; }
    const hrs=parseFloat(document.getElementById('ch_hours').value)||0;
    if (!hrs) { alertEl.textContent='Please enter the rental duration in hours.'; alertEl.style.display='block'; return; }
    const typeName=chSelType==='van'?'Mini Van':chSelType.charAt(0).toUpperCase()+chSelType.slice(1);
    document.getElementById('ch_chipTxt').textContent=typeName+' · '+chSelCat.name+' · ₦'+chFinalPrice.toLocaleString();
    const fc=document.getElementById('ch_formCard');
    fc.style.display='block';
    fc.scrollIntoView({ behavior:'smooth', block:'start' });
}

function ch_pay(m) {
    chPayment=m;
    ['budpay','seerbit'].forEach(x=>document.getElementById('ch_p_'+x).classList.toggle('active',x===m));
}

/* ══════════════════════════════════════
   TRANSFER
══════════════════════════════════════ */
function tr_clearDist() {
    trDistKm=0; trSelVehicle=null; trFinalPrice=0;
    document.getElementById('tr_distRes').classList.remove('show');
    document.getElementById('tr_vehicleCard').style.display='none';
    document.getElementById('tr_formCard').style.display='none';
}

async function tr_calcDist() {
    const from=document.getElementById('tr_from').value.trim();
    const to=document.getElementById('tr_to').value.trim();
    const alertEl=document.getElementById('tr_alertA');
    alertEl.style.display='none';
    if (!from||!to) { alertEl.textContent='Please enter both pick-up and drop-off locations.'; alertEl.style.display='block'; return; }
    document.getElementById('tr_calcSt').classList.add('show');
    document.getElementById('tr_distRes').classList.remove('show');
    document.getElementById('tr_vehicleCard').style.display='none';
    document.getElementById('tr_formCard').style.display='none';
    try {
        const result=await fetchDistance(from,to);
        trDistKm=result.distance_km;
        document.getElementById('tr_distKmLbl').textContent=result.distance_text;
        document.getElementById('tr_driveLbl').textContent=result.drive_time;
        document.getElementById('tr_distRes').classList.add('show');
        tr_renderVehicles();
    } catch(e) {
        alertEl.textContent=e.message;
        alertEl.style.display='block';
    } finally {
        document.getElementById('tr_calcSt').classList.remove('show');
    }
}

function tr_renderVehicles() {
    document.getElementById('tr_vehicleCard').style.display='block';
    document.getElementById('tr_vehicleGrid').innerHTML=TR_VEHICLES.map(v=>{
        const price=Math.round(trDistKm*v.rate_per_km);
        const thumbImg=v.thumb||'';
        const thumb=thumbImg?`<img src="${thumbImg}" alt="${esc(v.name)}" onerror="this.parentNode.innerHTML=SVG_FB">`:SVG_FB;
        return `<div class="tv" id="tv_${v.key}" onclick="tr_selectVehicle('${v.key}')">
            <div class="tv-thumb">${thumb}</div>
            <div class="tv-name">${esc(v.name)}</div>
            <div class="tv-pax">&#128100; ${esc(v.passengers)}</div>
            <div class="tv-price">&#8358;${price.toLocaleString()}</div>
            <div class="tv-rate">&#8358;${v.rate_per_km}/km &middot; ${trDistKm} km</div>
        </div>`;
    }).join('');
}

function tr_selectVehicle(key) {
    document.querySelectorAll('.tv').forEach(c=>c.classList.remove('active'));
    document.getElementById('tv_'+key).classList.add('active');
    trSelVehicle=TR_VEHICLES.find(v=>v.key===key);
    trFinalPrice=Math.round(trDistKm*trSelVehicle.rate_per_km);
    const paxInput = document.getElementById('tr_pax');
    const maxPax = PAX_LIMITS[key] ?? 20;
    paxInput.max = maxPax;
    paxInput.placeholder = 'e.g. 2 (max ' + maxPax + ')';
    if (parseInt(paxInput.value) > maxPax) paxInput.value = maxPax;
    document.getElementById('tr_chipTxt').textContent=trSelVehicle.name+' · '+trDistKm+' km · ₦'+trFinalPrice.toLocaleString();
    const fc=document.getElementById('tr_formCard');
    fc.style.display='block';
    fc.scrollIntoView({ behavior:'smooth', block:'start' });
}

function tr_pay(m) {
    trPayment=m;
    ['budpay','seerbit'].forEach(x=>document.getElementById('tr_p_'+x).classList.toggle('active',x===m));
}

/* ══════════════════════════════════════
   MODAL HELPERS
══════════════════════════════════════ 
function ri(lbl,val,full,hi) {
    return `<div class="rev-item${full?' full':''}${hi?' hi':''}"><div class="rev-lbl">${lbl}</div><div class="rev-val">${val}</div></div>`;
}
function fmtDate(v) {
    if (!v) return '—';
    const d=new Date(v+'T00:00:00');
    return d.toLocaleDateString('en-NG',{weekday:'short',day:'numeric',month:'short',year:'numeric'});
}
function fmtTime(v) {
    if (!v) return '—';
    const [h,m]=v.split(':'); const hr=parseInt(h);
    return (hr%12||12)+':'+m+' '+(hr>=12?'PM':'AM');
}
function esc(s) { const d=document.createElement('div'); d.textContent=s||''; return d.innerHTML; }
function escQ(s) { return (s||'').replace(/\\/g,'\\\\').replace(/'/g,"\\'"); }


function showErr(elId, msg) {
    const el=document.getElementById(elId);
    el.textContent=msg;
    el.style.display='block';
    el.scrollIntoView({ behavior:'smooth', block:'center' });
}

/* ══════════════════════════════════════
   MODAL
══════════════════════════════════════ */
function ri(lbl, val, full, hi) {
    return `<div style="background:#f7f8ff;border:1px solid #e4e8f5;border-radius:8px;padding:8px 11px;${full?'grid-column:1/-1':''}">
        <div style="font-size:9.5px;color:#999;font-weight:600;text-transform:uppercase;letter-spacing:.06em;margin-bottom:2px;">${lbl}</div>
        <div style="font-size:${hi?'15px':'12.5px'};font-weight:${hi?'700':'600'};color:${hi?'#0d1883':'#1a1a1a'};word-break:break-word;">${val}</div>
    </div>`;
}

function rsec(icon, title, rows) {
    return `<div style="margin-bottom:13px;">
        <div style="font-size:9.5px;font-weight:700;color:#0d1883;text-transform:uppercase;letter-spacing:.1em;margin-bottom:8px;display:flex;align-items:center;gap:6px;">
            ${icon} ${title}
            <span style="flex:1;height:1px;background:#e0e4f8;display:block;"></span>
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:7px;">${rows}</div>
    </div>`;
}

function fmtDate(v) {
    if (!v) return '—';
    const d = new Date(v + 'T00:00:00');
    return d.toLocaleDateString('en-NG', { weekday:'short', day:'numeric', month:'short', year:'numeric' });
}
function fmtTime(v) {
    if (!v) return '—';
    const [h, m] = v.split(':');
    const hr = parseInt(h);
    return (hr % 12 || 12) + ':' + m + ' ' + (hr >= 12 ? 'PM' : 'AM');
}
function esc(s) {
    const d = document.createElement('div');
    d.textContent = s || '';
    return d.innerHTML;
}
function escQ(s) { return (s || '').replace(/\\/g, '\\\\').replace(/'/g, "\\'"); }

function showErr(elId, msg) {
    const el = document.getElementById(elId);
    el.textContent = msg;
    el.style.display = 'block';
    el.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

function openModal(tab) {
    activeModal = tab;

    // hide all alerts
    ['ch_alertA','ch_alertB','tr_alertA','tr_alertB'].forEach(id => {
        const el = document.getElementById(id);
        if (el) el.style.display = 'none';
    });

    let html = '';

    if (tab === 'ch') {
        // — validation —
        if (!chSelType || !chSelCat)  { showErr('ch_alertB', 'Please select a vehicle type and category.'); return; }
        if (!chDistKm)                { showErr('ch_alertA', 'Please calculate the route distance first.'); return; }
        const hrs = parseFloat(document.getElementById('ch_hours').value) || 0;
        if (!hrs)                     { showErr('ch_alertA', 'Please enter the rental duration in hours.'); return; }
        if (!chFinalPrice)            { showErr('ch_alertA', 'Price could not be calculated. Check your inputs.'); return; }

        const fields = [
            { id:'ch_name',  l:'Full Name' },
            { id:'ch_email', l:'Email Address' },
            { id:'ch_phone', l:'Phone Number' },
            { id:'ch_pax',   l:'Number of Passengers' },
            { id:'ch_date',  l:'Pick-up Date' },
            { id:'ch_time',  l:'Pick-up Time' },
        ];
        for (const f of fields) {
            if (!document.getElementById(f.id).value.trim()) {
                showErr('ch_alertB', 'Please fill in your ' + f.l + '.');
                return;
            }
        }

        const chPax = parseInt(document.getElementById('ch_pax').value);
        const chMaxPax = PAX_LIMITS[chSelType] ?? 20;
        if (chPax > chMaxPax) {
            showErr('ch_alertB', 'A ' + (chSelType === 'van' ? 'Mini Van' : chSelType) + ' can take a maximum of ' + chMaxPax + ' passengers.');
            return;
        }

        const typeName = chSelType === 'van' ? 'Mini Van' : chSelType.charAt(0).toUpperCase() + chSelType.slice(1);

        html =
            rsec('🚘', 'Vehicle',
                ri('Type', typeName) +
                ri('Category', esc(chSelCat.name)) +
                ri('Distance', document.getElementById('ch_distKmLbl').textContent) +
                ri('Duration', hrs + ' hour' + (hrs !== 1 ? 's' : '')) +
                ri('Total Price', '₦' + chFinalPrice.toLocaleString(), true, true)
            ) +
            rsec('👤', 'Customer',
                ri('Full Name',   esc(document.getElementById('ch_name').value)) +
                ri('Email',       esc(document.getElementById('ch_email').value)) +
                ri('Phone',       esc(document.getElementById('ch_phone').value)) +
                ri('Passengers',  document.getElementById('ch_pax').value)
            ) +
            rsec('📍', 'Route',
                ri('Pick-up',  esc(document.getElementById('ch_pickup').value),  true) +
                ri('Drop-off', esc(document.getElementById('ch_dropoff').value), true) +
                ri('Date', fmtDate(document.getElementById('ch_date').value)) +
                ri('Time', fmtTime(document.getElementById('ch_time').value))
            ) +
            `<div style="margin-bottom:13px;">
                <div style="font-size:9.5px;font-weight:700;color:#0d1883;text-transform:uppercase;letter-spacing:.1em;margin-bottom:8px;display:flex;align-items:center;gap:6px;">
                    💳 Payment <span style="flex:1;height:1px;background:#e0e4f8;display:block;"></span>
                </div>
                <span style="display:inline-flex;align-items:center;gap:6px;background:#eef1ff;color:#0d1883;font-size:12px;font-weight:600;padding:5px 12px;border-radius:20px;">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="#0d1883"><path d="M20 4H4c-1.11 0-2 .89-2 2v12c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"/></svg>
                    ${chPayment === 'budpay' ? 'BudPay' : 'SeerBit'}
                </span>
            </div>`;

    } else {
        // — Transfer validation —
        if (!trSelVehicle) { showErr('tr_alertB', 'Please select a vehicle first.'); return; }

        const fields = [
            { id:'tr_name',  l:'Full Name' },
            { id:'tr_email', l:'Email Address' },
            { id:'tr_phone', l:'Phone Number' },
            { id:'tr_pax',   l:'Number of Passengers' },
            { id:'tr_date',  l:'Pick-up Date' },
            { id:'tr_time',  l:'Pick-up Time' },
        ];
        for (const f of fields) {
            if (!document.getElementById(f.id).value.trim()) {
                showErr('tr_alertB', 'Please fill in your ' + f.l + '.');
                return;
            }
        }

        const trPax = parseInt(document.getElementById('tr_pax').value);
        const trMaxPax = PAX_LIMITS[trSelVehicle.key] ?? 20;
        if (trPax > trMaxPax) {
            showErr('tr_alertB', trSelVehicle.name + ' can take a maximum of ' + trMaxPax + ' passengers.');
            return;
        }

        html =
            rsec('🚗', 'Transfer',
                ri('Vehicle',  esc(trSelVehicle.name)) +
                ri('Distance', document.getElementById('tr_distKmLbl').textContent) +
                ri('Pick-up',  esc(document.getElementById('tr_from').value), true) +
                ri('Drop-off', esc(document.getElementById('tr_to').value),   true) +
                ri('Total Price', '₦' + trFinalPrice.toLocaleString(), true, true)
            ) +
            rsec('👤', 'Customer',
                ri('Full Name',    esc(document.getElementById('tr_name').value)) +
                ri('Email',        esc(document.getElementById('tr_email').value)) +
                ri('Phone',        esc(document.getElementById('tr_phone').value)) +
                ri('Passengers',   document.getElementById('tr_pax').value) +
                ri('Flight/Vessel',esc(document.getElementById('tr_flight').value) || 'N/A') +
                ri('Special Req.', esc(document.getElementById('tr_notes').value)  || 'None')
            ) +
            rsec('📅', 'Schedule',
                ri('Date', fmtDate(document.getElementById('tr_date').value)) +
                ri('Time', fmtTime(document.getElementById('tr_time').value))
            ) +
            `<div style="margin-bottom:13px;">
                <div style="font-size:9.5px;font-weight:700;color:#0d1883;text-transform:uppercase;letter-spacing:.1em;margin-bottom:8px;display:flex;align-items:center;gap:6px;">
                    💳 Payment <span style="flex:1;height:1px;background:#e0e4f8;display:block;"></span>
                </div>
                <span style="display:inline-flex;align-items:center;gap:6px;background:#eef1ff;color:#0d1883;font-size:12px;font-weight:600;padding:5px 12px;border-radius:20px;">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="#0d1883"><path d="M20 4H4c-1.11 0-2 .89-2 2v12c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"/></svg>
                    ${trPayment === 'budpay' ? 'BudPay' : 'SeerBit'}
                </span>
            </div>`;
    }

    // inject content, reset button, show modal
    document.getElementById('modalContent').innerHTML = html;
    const btn = document.getElementById('confirmBtn');
    btn.disabled = false;
    btn.innerHTML = `<svg width="13" height="13" viewBox="0 0 24 24" fill="white"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z"/></svg> Confirm &amp; Pay`;

    const modal = document.getElementById('reviewModal');
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('reviewModal').style.display = 'none';
    document.body.style.overflow = '';
}

// close on backdrop click
document.getElementById('reviewModal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});

function submitBooking() {
    const btn = document.getElementById('confirmBtn');
    btn.disabled = true;
    btn.innerHTML = 'Processing...';

    if (activeModal === 'ch') {
        document.getElementById('h_ch_type').value    = chSelType;
        document.getElementById('h_ch_cat').value     = chSelCat.name;
        document.getElementById('h_ch_price').value   = chFinalPrice;
        document.getElementById('h_ch_dist').value    = chDistKm;
        document.getElementById('h_ch_hours').value   = document.getElementById('ch_hours').value;
        document.getElementById('h_ch_name').value    = document.getElementById('ch_name').value;
        document.getElementById('h_ch_email').value   = document.getElementById('ch_email').value;
        document.getElementById('h_ch_phone').value   = document.getElementById('ch_phone').value;
        document.getElementById('h_ch_pax').value     = document.getElementById('ch_pax').value;
        document.getElementById('h_ch_pickup').value  = document.getElementById('ch_pickup').value;
        document.getElementById('h_ch_dropoff').value = document.getElementById('ch_dropoff').value;
        document.getElementById('h_ch_date').value    = document.getElementById('ch_date').value;
        document.getElementById('h_ch_time').value    = document.getElementById('ch_time').value;
        document.getElementById('h_ch_payment').value = chPayment;
        document.getElementById('ch_form').submit();
    } else {
        document.getElementById('h_tr_type').value    = trSelVehicle.key;
        document.getElementById('h_tr_vname').value   = trSelVehicle.name;
        document.getElementById('h_tr_price').value   = trFinalPrice;
        document.getElementById('h_tr_dist').value    = trDistKm;
        document.getElementById('h_tr_from').value    = document.getElementById('tr_from').value;
        document.getElementById('h_tr_to').value      = document.getElementById('tr_to').value;
        document.getElementById('h_tr_name').value    = document.getElementById('tr_name').value;
        document.getElementById('h_tr_email').value   = document.getElementById('tr_email').value;
        document.getElementById('h_tr_phone').value   = document.getElementById('tr_phone').value;
        document.getElementById('h_tr_pax').value     = document.getElementById('tr_pax').value;
        document.getElementById('h_tr_flight').value  = document.getElementById('tr_flight').value;
        document.getElementById('h_tr_notes').value   = document.getElementById('tr_notes').value;
        document.getElementById('h_tr_date').value    = document.getElementById('tr_date').value;
        document.getElementById('h_tr_time').value    = document.getElementById('tr_time').value;
        document.getElementById('h_tr_payment').value = trPayment;
        document.getElementById('tr_form').submit();
    }
}
</script>
</body>
</html>