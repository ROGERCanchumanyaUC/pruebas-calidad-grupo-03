<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>JM y JS Alimentos Lácteos — Plataforma Web</title>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
:root{--teal-dark:#085041;--teal-mid:#0F6E56;--teal-light:#1D9E75;--teal-pale:#E1F5EE;--teal-soft:#9FE1CB;--amber:#EF9F27;--amber-pale:#FAEEDA;--cream:#FAFAF7;--white:#FFFFFF;--gray-900:#1a1a18;--gray-700:#3a3a36;--gray-500:#6b6b64;--gray-300:#b4b2a9;--gray-100:#f1efe8;--font-display:'Cormorant Garamond',serif;--font-body:'DM Sans',sans-serif;--radius:12px;--radius-sm:8px;--shadow:0 4px 24px rgba(15,110,86,.10);--shadow-hover:0 8px 40px rgba(15,110,86,.18)}
*{margin:0;padding:0;box-sizing:border-box}html{scroll-behavior:smooth}
body{font-family:var(--font-body);color:var(--gray-900);background:var(--cream);font-size:16px;line-height:1.6;overflow-x:hidden}
nav{position:fixed;top:0;left:0;right:0;z-index:100;background:rgba(255,255,255,.95);backdrop-filter:blur(12px);border-bottom:1px solid rgba(15,110,86,.10);padding:0 5%;display:flex;align-items:center;justify-content:space-between;height:70px;transition:box-shadow .3s}
nav.scrolled{box-shadow:0 2px 20px rgba(15,110,86,.12)}
.nav-logo{display:flex;align-items:center;gap:10px;text-decoration:none}
.logo-icon{width:38px;height:38px;background:var(--teal-mid);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:18px}
.logo-text{font-family:var(--font-display);font-size:18px;font-weight:700;color:var(--teal-dark);line-height:1.2}
.logo-sub{font-size:10px;color:var(--gray-500);letter-spacing:.08em;text-transform:uppercase;font-weight:500}
.nav-links{display:flex;align-items:center;gap:32px}
.nav-links a{text-decoration:none;color:var(--gray-700);font-size:14px;font-weight:500;position:relative;transition:color .2s}
.nav-links a::after{content:'';position:absolute;bottom:-3px;left:0;width:0;height:2px;background:var(--teal-light);border-radius:2px;transition:width .3s}
.nav-links a:hover{color:var(--teal-mid)}.nav-links a:hover::after{width:100%}
.btn-nav{background:var(--teal-mid) !important;color:#fff !important;padding:8px 20px;border-radius:50px;font-size:14px !important;font-weight:500 !important;transition:background .2s,transform .15s !important}
.btn-nav::after{display:none !important}.btn-nav:hover{background:var(--teal-dark) !important;transform:translateY(-1px)}
.hero{min-height:100vh;display:grid;grid-template-columns:1fr 1fr;align-items:center;padding:100px 5% 60px;gap:60px;position:relative;overflow:hidden}
.hero::before{content:'';position:absolute;top:-120px;right:-120px;width:600px;height:600px;background:radial-gradient(circle,rgba(29,158,117,.08) 0%,transparent 70%);pointer-events:none}
.hero::after{content:'';position:absolute;bottom:-80px;left:-80px;width:400px;height:400px;background:radial-gradient(circle,rgba(239,159,39,.06) 0%,transparent 70%);pointer-events:none}
.hero-badge{display:inline-flex;align-items:center;gap:6px;background:var(--teal-pale);color:var(--teal-dark);padding:5px 14px;border-radius:50px;font-size:12px;font-weight:600;letter-spacing:.06em;text-transform:uppercase;margin-bottom:24px;animation:fadeUp .6s ease both}
.hero-badge span{width:6px;height:6px;background:var(--teal-light);border-radius:50%;display:inline-block;animation:pulse 2s infinite}
.hero h1{font-family:var(--font-display);font-size:clamp(42px,5vw,68px);font-weight:700;line-height:1.1;color:var(--gray-900);margin-bottom:24px;animation:fadeUp .7s .1s ease both}
.hero h1 em{color:var(--teal-mid);font-style:normal}
.hero p{font-size:17px;color:var(--gray-500);line-height:1.7;max-width:500px;margin-bottom:40px;animation:fadeUp .7s .2s ease both}
.hero-ctas{display:flex;gap:14px;flex-wrap:wrap;animation:fadeUp .7s .3s ease both}
.btn-primary{background:var(--teal-mid);color:#fff;padding:14px 32px;border-radius:50px;border:none;cursor:pointer;font-family:var(--font-body);font-size:15px;font-weight:600;text-decoration:none;display:inline-flex;align-items:center;gap:8px;transition:background .2s,transform .15s,box-shadow .2s;box-shadow:0 4px 16px rgba(15,110,86,.3)}
.btn-primary:hover{background:var(--teal-dark);transform:translateY(-2px);box-shadow:0 8px 24px rgba(15,110,86,.35)}
.btn-outline{background:transparent;color:var(--teal-mid);padding:13px 28px;border-radius:50px;border:1.5px solid var(--teal-mid);cursor:pointer;font-family:var(--font-body);font-size:15px;font-weight:600;text-decoration:none;display:inline-flex;align-items:center;gap:8px;transition:all .2s}
.btn-outline:hover{background:var(--teal-pale);transform:translateY(-2px)}
.hero-visual{position:relative;display:flex;justify-content:center;align-items:center;animation:fadeIn 1s .4s ease both}
.hero-card-main{background:var(--white);border-radius:24px;padding:32px;width:340px;box-shadow:var(--shadow);position:relative;z-index:2;border:1px solid rgba(15,110,86,.08)}
.product-img-placeholder{width:100%;height:180px;background:linear-gradient(135deg,var(--teal-pale) 0%,var(--teal-soft) 100%);border-radius:16px;margin-bottom:16px;display:flex;align-items:center;justify-content:center;font-size:60px}
.product-title{font-family:var(--font-display);font-size:20px;font-weight:700;color:var(--gray-900);margin-bottom:6px}
.product-meta{font-size:13px;color:var(--gray-500);margin-bottom:16px}
.product-price-row{display:flex;align-items:center;justify-content:space-between}
.price{font-size:22px;font-weight:700;color:var(--teal-mid)}.price small{font-size:13px;color:var(--gray-500);font-weight:400;display:block}
.btn-add{background:var(--teal-mid);color:#fff;border:none;border-radius:50px;padding:8px 18px;font-size:13px;font-weight:600;cursor:pointer;transition:background .2s}.btn-add:hover{background:var(--teal-dark)}
.floating-card{position:absolute;background:var(--white);border-radius:14px;padding:12px 16px;box-shadow:0 8px 32px rgba(0,0,0,.10);border:1px solid rgba(15,110,86,.06)}
.float-1{top:-20px;right:-20px;display:flex;align-items:center;gap:8px}
.float-2{bottom:20px;left:-30px;text-align:left}
.float-icon{width:32px;height:32px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:16px}
.float-icon.teal{background:var(--teal-pale)}.float-icon.amber{background:var(--amber-pale)}
.float-label{font-size:11px;color:var(--gray-500)}.float-val{font-size:14px;font-weight:700;color:var(--gray-900)}
.stats-bar{background:var(--teal-dark);color:#fff;padding:40px 5%;display:grid;grid-template-columns:repeat(4,1fr);gap:24px;text-align:center}
.stat-num{font-family:var(--font-display);font-size:42px;font-weight:700;color:var(--teal-soft);line-height:1}
.stat-label{font-size:13px;color:rgba(255,255,255,.7);margin-top:4px;letter-spacing:.04em}
section{padding:90px 5%}
.section-tag{display:inline-block;background:var(--teal-pale);color:var(--teal-dark);padding:4px 14px;border-radius:50px;font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;margin-bottom:16px}
.section-title{font-family:var(--font-display);font-size:clamp(32px,3.5vw,48px);font-weight:700;color:var(--gray-900);margin-bottom:14px;line-height:1.15}
.section-title em{color:var(--teal-mid);font-style:normal}
.section-subtitle{font-size:16px;color:var(--gray-500);max-width:520px;line-height:1.7;margin-bottom:50px}
.section-header{display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:24px;margin-bottom:50px}
.about{background:var(--white)}
.about-grid{display:grid;grid-template-columns:1fr 1fr;gap:80px;align-items:center}
.about-visual{display:grid;grid-template-columns:1fr 1fr;gap:16px}
.about-img-card{border-radius:var(--radius);overflow:hidden;background:var(--teal-pale);height:200px;display:flex;align-items:center;justify-content:center;font-size:48px;transition:transform .3s}
.about-img-card:hover{transform:translateY(-4px)}
.about-img-card:first-child{grid-column:1/-1;height:240px;background:linear-gradient(135deg,var(--teal-pale),#c8f0e0)}
.about-img-card.amber{background:var(--amber-pale)}
.about-features{display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-top:32px}
.feat-item{display:flex;gap:10px;align-items:flex-start}
.feat-icon{width:36px;height:36px;border-radius:10px;background:var(--teal-pale);flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:16px}
.feat-text{font-size:13px;color:var(--gray-700);font-weight:500}
.courses{background:var(--cream)}
.courses-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px}
.course-card{background:var(--white);border-radius:var(--radius);overflow:hidden;border:1px solid rgba(15,110,86,.06);transition:transform .3s,box-shadow .3s;cursor:pointer;position:relative}
.course-card:hover{transform:translateY(-6px);box-shadow:var(--shadow-hover)}
.course-card.featured{border:2px solid var(--teal-mid)}
.course-badge{position:absolute;top:14px;left:14px;background:var(--teal-mid);color:#fff;padding:3px 10px;border-radius:50px;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.06em}
.course-badge.popular{background:var(--amber);color:var(--gray-900)}
.course-thumb{height:180px;display:flex;align-items:center;justify-content:center;font-size:54px}
.course-thumb.t1{background:linear-gradient(135deg,#E1F5EE,#9FE1CB)}.course-thumb.t2{background:linear-gradient(135deg,#FAEEDA,#FAC775)}.course-thumb.t3{background:linear-gradient(135deg,#E6F1FB,#B5D4F4)}
.course-body{padding:20px}
.course-cat{font-size:11px;font-weight:700;color:var(--teal-mid);text-transform:uppercase;letter-spacing:.07em;margin-bottom:6px}
.course-name{font-family:var(--font-display);font-size:20px;font-weight:700;color:var(--gray-900);margin-bottom:8px;line-height:1.25}
.course-desc{font-size:13px;color:var(--gray-500);margin-bottom:16px;line-height:1.6}
.course-meta{display:flex;gap:14px;margin-bottom:18px}
.course-meta span{font-size:12px;color:var(--gray-500);display:flex;align-items:center;gap:4px}
.course-footer{display:flex;align-items:center;justify-content:space-between;border-top:1px solid var(--gray-100);padding-top:16px}
.course-price{font-size:22px;font-weight:700;color:var(--teal-mid)}
.course-price small{font-size:12px;color:var(--gray-500);font-weight:400;display:block;line-height:1}
.btn-enroll{background:var(--teal-mid);color:#fff;border:none;border-radius:50px;padding:9px 18px;font-size:13px;font-weight:600;cursor:pointer;transition:all .2s;font-family:var(--font-body)}
.btn-enroll:hover{background:var(--teal-dark);transform:translateY(-1px)}
.btn-enroll.outline{background:transparent;color:var(--teal-mid);border:1.5px solid var(--teal-mid)}.btn-enroll.outline:hover{background:var(--teal-pale)}
.services{background:var(--teal-dark);color:#fff}
.services .section-tag{background:rgba(255,255,255,.1);color:#fff}
.services .section-title{color:#fff}.services .section-title em{color:var(--teal-soft)}
.services .section-subtitle{color:rgba(255,255,255,.65)}
.services-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
.service-card{background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:var(--radius);padding:28px;transition:all .3s;cursor:pointer}
.service-card:hover{background:rgba(255,255,255,.10);transform:translateY(-4px);border-color:var(--teal-soft)}
.serv-icon{font-size:32px;margin-bottom:16px}
.serv-title{font-family:var(--font-display);font-size:20px;font-weight:700;color:#fff;margin-bottom:10px}
.serv-desc{font-size:13px;color:rgba(255,255,255,.6);line-height:1.6;margin-bottom:18px}
.serv-link{color:var(--teal-soft);font-size:13px;font-weight:600;text-decoration:none;display:flex;align-items:center;gap:6px;transition:gap .2s}.serv-link:hover{gap:10px}
.how{background:var(--white)}
.steps{display:grid;grid-template-columns:repeat(4,1fr);gap:0;position:relative}
.steps::before{content:'';position:absolute;top:32px;left:10%;right:10%;height:2px;background:var(--teal-pale);z-index:0}
.step{text-align:center;padding:0 16px;position:relative;z-index:1}
.step-num{width:64px;height:64px;border-radius:50%;background:var(--teal-pale);color:var(--teal-mid);font-family:var(--font-display);font-size:24px;font-weight:700;display:flex;align-items:center;justify-content:center;margin:0 auto 20px;border:3px solid var(--white);box-shadow:0 0 0 2px var(--teal-pale);transition:all .3s}
.step:hover .step-num{background:var(--teal-mid);color:#fff}
.step-title{font-weight:600;font-size:15px;color:var(--gray-900);margin-bottom:8px}
.step-desc{font-size:13px;color:var(--gray-500);line-height:1.6}
.quality{background:var(--amber-pale)}
.quality-grid{display:grid;grid-template-columns:1fr 1fr;gap:60px;align-items:center}
.quality-badges{display:flex;gap:12px;flex-wrap:wrap;margin-top:32px}
.q-badge{background:var(--white);border-radius:50px;padding:8px 18px;font-size:12px;font-weight:700;color:var(--teal-dark);border:1px solid rgba(15,110,86,.15);display:flex;align-items:center;gap:6px}
.q-badge span{color:var(--teal-mid);font-size:14px}
.quality-list{list-style:none}
.quality-list li{padding:14px 0;border-bottom:1px solid rgba(15,110,86,.10);display:flex;align-items:center;gap:12px;font-size:15px;color:var(--gray-700)}
.quality-list li::before{content:'✓';color:var(--teal-mid);font-weight:700;font-size:16px}
.quality-visual{background:var(--white);border-radius:20px;padding:36px;box-shadow:var(--shadow)}
.q-chart-title{font-family:var(--font-display);font-size:22px;font-weight:700;color:var(--gray-900);margin-bottom:24px}
.q-row{margin-bottom:16px}
.q-row-label{display:flex;justify-content:space-between;margin-bottom:6px;font-size:13px;font-weight:500;color:var(--gray-700)}
.q-bar-bg{background:var(--gray-100);border-radius:50px;height:10px;overflow:hidden}
.q-bar{height:100%;border-radius:50px;background:var(--teal-mid);transition:width 1.5s ease;width:0}
.q-bar.amber{background:var(--amber)}
.cta-band{background:linear-gradient(135deg,var(--teal-mid) 0%,var(--teal-dark) 100%);padding:80px 5%;text-align:center;color:#fff}
.cta-band h2{font-family:var(--font-display);font-size:42px;font-weight:700;margin-bottom:16px}
.cta-band p{font-size:16px;color:rgba(255,255,255,.75);margin-bottom:36px}
.cta-btns{display:flex;gap:14px;justify-content:center;flex-wrap:wrap}
.btn-white{background:#fff;color:var(--teal-dark);padding:14px 32px;border-radius:50px;border:none;cursor:pointer;font-family:var(--font-body);font-size:15px;font-weight:700;text-decoration:none;display:inline-flex;align-items:center;gap:8px;transition:all .2s}.btn-white:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(0,0,0,.2)}
.btn-ghost-white{background:transparent;color:#fff;padding:13px 28px;border-radius:50px;border:1.5px solid rgba(255,255,255,.5);cursor:pointer;font-family:var(--font-body);font-size:15px;font-weight:600;text-decoration:none;display:inline-flex;align-items:center;gap:8px;transition:all .2s}.btn-ghost-white:hover{border-color:#fff;background:rgba(255,255,255,.08)}
.contact{background:var(--cream)}
.contact-grid{display:grid;grid-template-columns:1fr 1fr;gap:60px;align-items:start}
.contact-info p{font-size:15px;color:var(--gray-500);line-height:1.7;margin-bottom:32px}
.contact-items{display:flex;flex-direction:column;gap:16px}
.contact-item{display:flex;align-items:center;gap:14px}
.ci-icon{width:44px;height:44px;background:var(--teal-pale);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0}
.ci-label{font-size:11px;color:var(--gray-500);text-transform:uppercase;font-weight:600;letter-spacing:.05em}
.ci-val{font-size:15px;font-weight:500;color:var(--gray-900)}
.contact-form{background:var(--white);border-radius:var(--radius);padding:36px;border:1px solid rgba(15,110,86,.06);box-shadow:var(--shadow)}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:14px}
.form-group{display:flex;flex-direction:column;gap:6px;margin-bottom:14px}
.form-group label{font-size:12px;font-weight:600;color:var(--gray-700);text-transform:uppercase;letter-spacing:.05em}
.form-group input,.form-group select,.form-group textarea{border:1.5px solid var(--gray-100);border-radius:var(--radius-sm);padding:11px 14px;font-family:var(--font-body);font-size:14px;color:var(--gray-900);background:var(--cream);outline:none;transition:border-color .2s,box-shadow .2s;width:100%}
.form-group input:focus,.form-group select:focus,.form-group textarea:focus{border-color:var(--teal-mid);box-shadow:0 0 0 3px rgba(15,110,86,.08)}
.form-group textarea{resize:vertical;min-height:100px}
.btn-submit{width:100%;background:var(--teal-mid);color:#fff;border:none;border-radius:50px;padding:14px;font-family:var(--font-body);font-size:15px;font-weight:700;cursor:pointer;transition:all .2s;display:flex;align-items:center;justify-content:center;gap:8px}.btn-submit:hover{background:var(--teal-dark);transform:translateY(-1px)}
.wa-float{position:fixed;bottom:28px;right:28px;z-index:200;width:58px;height:58px;border-radius:50%;background:#25D366;color:#fff;border:none;cursor:pointer;font-size:26px;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 20px rgba(37,211,102,.45);transition:transform .2s,box-shadow .2s;animation:waggle 3s 2s ease infinite}
.wa-float:hover{transform:scale(1.1);box-shadow:0 8px 32px rgba(37,211,102,.55);animation:none}
footer{background:var(--gray-900);color:rgba(255,255,255,.7);padding:60px 5% 30px}
.footer-grid{display:grid;grid-template-columns:2fr 1fr 1fr 1fr;gap:40px;margin-bottom:40px}
.footer-brand p{font-size:13px;line-height:1.7;margin-top:12px}
.footer-col h4{font-size:13px;font-weight:700;color:#fff;text-transform:uppercase;letter-spacing:.07em;margin-bottom:16px}
.footer-col a{display:block;font-size:13px;color:rgba(255,255,255,.55);text-decoration:none;margin-bottom:8px;transition:color .2s}.footer-col a:hover{color:var(--teal-soft)}
.footer-bottom{border-top:1px solid rgba(255,255,255,.08);padding-top:24px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;font-size:12px}
.footer-bottom span{color:rgba(255,255,255,.35)}
.modal-overlay{position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:500;display:flex;align-items:center;justify-content:center;padding:20px;opacity:0;pointer-events:none;transition:opacity .3s}
.modal-overlay.active{opacity:1;pointer-events:all}
.modal{background:var(--white);border-radius:20px;padding:40px;max-width:500px;width:100%;transform:translateY(20px);transition:transform .3s;box-shadow:0 20px 60px rgba(0,0,0,.2)}
.modal-overlay.active .modal{transform:translateY(0)}
.modal-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:24px}
.modal-title{font-family:var(--font-display);font-size:26px;font-weight:700;color:var(--gray-900)}
.modal-close{background:var(--gray-100);border:none;border-radius:50%;width:34px;height:34px;cursor:pointer;font-size:16px;display:flex;align-items:center;justify-content:center;transition:background .2s}.modal-close:hover{background:var(--gray-300)}
.modal-price-box{background:var(--teal-pale);border-radius:12px;padding:18px;margin-bottom:24px;display:flex;align-items:center;justify-content:space-between}
.modal-price{font-size:28px;font-weight:700;color:var(--teal-mid)}
.modal-features{list-style:none;margin-bottom:24px}
.modal-features li{padding:8px 0;border-bottom:1px solid var(--gray-100);font-size:14px;color:var(--gray-700);display:flex;align-items:center;gap:10px}
.modal-features li::before{content:'✓';color:var(--teal-mid);font-weight:700}
.toast{position:fixed;bottom:96px;right:28px;z-index:600;background:var(--teal-dark);color:#fff;padding:12px 20px;border-radius:12px;font-size:14px;font-weight:500;display:flex;align-items:center;gap:8px;transform:translateX(120%);transition:transform .4s ease;box-shadow:0 4px 20px rgba(8,80,65,.4)}
.toast.show{transform:translateX(0)}
@keyframes fadeUp{from{opacity:0;transform:translateY(24px)}to{opacity:1;transform:translateY(0)}}
@keyframes fadeIn{from{opacity:0}to{opacity:1}}
@keyframes pulse{0%,100%{transform:scale(1);opacity:1}50%{transform:scale(1.5);opacity:.6}}
@keyframes waggle{0%,100%{transform:rotate(0)}20%{transform:rotate(-12deg)}40%{transform:rotate(12deg)}60%{transform:rotate(-8deg)}80%{transform:rotate(8deg)}}
.reveal{opacity:0;transform:translateY(30px);transition:opacity .7s ease,transform .7s ease}.reveal.visible{opacity:1;transform:translateY(0)}
@media(max-width:900px){.hero{grid-template-columns:1fr;padding-top:100px}.hero-visual{display:none}.about-grid,.quality-grid,.contact-grid{grid-template-columns:1fr}.stats-bar{grid-template-columns:repeat(2,1fr)}.courses-grid{grid-template-columns:1fr}.services-grid{grid-template-columns:1fr}.steps{grid-template-columns:1fr 1fr}.steps::before{display:none}.footer-grid{grid-template-columns:1fr 1fr}.nav-links{display:none}}
@media(max-width:600px){.form-row{grid-template-columns:1fr}.steps{grid-template-columns:1fr}}
</style>
</head>
<body>

<nav id="navbar">
  <a href="#" class="nav-logo">
    <div class="logo-icon">🥛</div>
    <div><div class="logo-text">JM y JS</div><div class="logo-sub">Alimentos Lácteos</div></div>
  </a>
  <div class="nav-links">
    <a href="#nosotros">Nosotros</a>
    <a href="#cursos">Cursos</a>
    <a href="#servicios">Servicios</a>
    <a href="#calidad">Calidad</a>
    <a href="#contacto">Contacto</a>
    <a href="#" class="btn-nav" onclick="showToast('¡Próximamente disponible!'); return false;">Iniciar sesión</a>
  </div>
</nav>

<section class="hero" id="inicio">
  <div class="hero-content">
    <div class="hero-badge"><span></span> Plataforma Láctea Digital</div>
    <h1>Aprende, compra y gestiona la <em>calidad láctea</em></h1>
    <p>Capacitaciones especializadas, asesorías en BPM e ISO, y una tienda digital pensada para profesionales y PyMEs del sector alimentario.</p>
    <div class="hero-ctas">
      <a href="#cursos" class="btn-primary">Ver cursos disponibles →</a>
      <a href="#servicios" class="btn-outline">Nuestros servicios</a>
    </div>
  </div>
  <div class="hero-visual">
    <div class="hero-card-main">
      <div class="product-img-placeholder">🧀</div>
      <div class="product-title">BPM en Lácteos</div>
      <div class="product-meta">Certificación · 8 semanas</div>
      <div class="product-price-row">
        <div class="price">S/ 350<small>por persona</small></div>
        <button class="btn-add" onclick="showToast('¡Agregado al carrito! 🛒')">Inscribirse</button>
      </div>
    </div>
    <div class="floating-card float-1">
      <div class="float-icon teal">📊</div>
      <div><div class="float-val">ISO 25010</div><div class="float-label">Calidad certificada</div></div>
    </div>
    <div class="floating-card float-2">
      <div class="float-icon amber" style="margin-bottom:4px;">🎓</div>
      <div class="float-val">+240 alumnos</div>
      <div class="float-label">ya se capacitaron</div>
    </div>
  </div>
</section>

<div class="stats-bar">
  <div class="stat-item"><div class="stat-num" data-target="240">0</div><div class="stat-label">Profesionales capacitados</div></div>
  <div class="stat-item"><div class="stat-num" data-target="12">0</div><div class="stat-label">Cursos activos</div></div>
  <div class="stat-item"><div class="stat-num" data-target="98">0</div><div class="stat-label">% de satisfacción</div></div>
  <div class="stat-item"><div class="stat-num" data-target="50">0</div><div class="stat-label">Empresas asesoradas</div></div>
</div>

<section class="about reveal" id="nosotros">
  <div class="about-grid">
    <div class="about-visual">
      <div class="about-img-card">🏭</div>
      <div class="about-img-card">🥛</div>
      <div class="about-img-card amber">📋</div>
    </div>
    <div>
      <div class="section-tag">Nuestra empresa</div>
      <h2 class="section-title">Expertos en la <em>industria láctea</em> peruana</h2>
      <p class="section-subtitle">JM y JS Alimentos Lácteos es una empresa líder en asesoría de calidad alimentaria y capacitación técnica para el sector lácteo.</p>
      <div class="about-features">
        <div class="feat-item"><div class="feat-icon">🎯</div><div class="feat-text">Misión: Elevar la calidad productiva del sector lácteo</div></div>
        <div class="feat-item"><div class="feat-icon">🔭</div><div class="feat-text">Visión: Ser referentes nacionales en calidad láctea</div></div>
        <div class="feat-item"><div class="feat-icon">🏆</div><div class="feat-text">ISO 9001 y BPM aplicados a cada proceso</div></div>
        <div class="feat-item"><div class="feat-icon">⚡</div><div class="feat-text">Plataforma 100% digital y disponible 24/7</div></div>
      </div>
    </div>
  </div>
</section>

<section class="courses reveal" id="cursos">
  <div class="section-header">
    <div>
      <div class="section-tag">Capacitaciones</div>
      <h2 class="section-title">Cursos y <em>certificaciones</em></h2>
    </div>
    <a href="#" class="btn-outline" style="margin-bottom:50px;">Ver todos →</a>
  </div>
  <div class="courses-grid">
    <div class="course-card reveal" onclick="openModal('BPM en Industria Láctea','S/ 350','Domina las Buenas Prácticas de Manufactura aplicadas al sector lácteo. Incluye evaluación final y certificado digital.')">
      <div class="course-badge">Nuevo</div>
      <div class="course-thumb t1">🥛</div>
      <div class="course-body">
        <div class="course-cat">Calidad · Certificación</div>
        <div class="course-name">BPM en Industria Láctea</div>
        <div class="course-desc">Buenas Prácticas de Manufactura aplicadas al procesamiento de leche y derivados.</div>
        <div class="course-meta"><span>📅 8 semanas</span><span>🎓 Certificado</span><span>💻 Online</span></div>
        <div class="course-footer">
          <div class="course-price">S/ 350<small>por persona</small></div>
          <button class="btn-enroll" onclick="event.stopPropagation();openModal('BPM en Industria Láctea','S/ 350','Buenas Prácticas de Manufactura aplicadas al sector lácteo.')">Inscribirse</button>
        </div>
      </div>
    </div>
    <div class="course-card featured reveal" onclick="openModal('Gestión de Calidad ISO 9001','S/ 480','Aprende a implementar un Sistema de Gestión de Calidad bajo la norma ISO 9001 en empresas del rubro alimentario.')">
      <div class="course-badge popular">⭐ Popular</div>
      <div class="course-thumb t2">📋</div>
      <div class="course-body">
        <div class="course-cat">Normas · ISO</div>
        <div class="course-name">Gestión de Calidad ISO 9001</div>
        <div class="course-desc">Implementación de sistemas de gestión de calidad en empresas del rubro lácteo y alimentario.</div>
        <div class="course-meta"><span>📅 10 semanas</span><span>🎓 Certificado</span><span>💻 Online</span></div>
        <div class="course-footer">
          <div class="course-price">S/ 480<small>por persona</small></div>
          <button class="btn-enroll" onclick="event.stopPropagation();openModal('Gestión de Calidad ISO 9001','S/ 480','Implementa un SGC bajo ISO 9001.')">Inscribirse</button>
        </div>
      </div>
    </div>
    <div class="course-card reveal" onclick="openModal('Control Microbiológico','S/ 280','Técnicas y protocolos para el control microbiológico en plantas de procesamiento de productos lácteos.')">
      <div class="course-thumb t3">🔬</div>
      <div class="course-body">
        <div class="course-cat">Microbiología · Laboratorio</div>
        <div class="course-name">Control Microbiológico</div>
        <div class="course-desc">Técnicas y protocolos para el control microbiológico en plantas lácteas y de procesamiento.</div>
        <div class="course-meta"><span>📅 6 semanas</span><span>🎓 Certificado</span><span>💻 Online</span></div>
        <div class="course-footer">
          <div class="course-price">S/ 280<small>por persona</small></div>
          <button class="btn-enroll outline" onclick="event.stopPropagation();openModal('Control Microbiológico','S/ 280','Control microbiológico en plantas lácteas.')">Inscribirse</button>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="services reveal" id="servicios">
  <div class="section-tag">Servicios</div>
  <h2 class="section-title">Asesoría <em>profesional</em> para tu empresa</h2>
  <p class="section-subtitle">Acompañamos a empresas lácteas en su proceso de certificación y mejora continua.</p>
  <div class="services-grid">
    <div class="service-card"><div class="serv-icon">🏭</div><div class="serv-title">Auditoría de Planta</div><div class="serv-desc">Evaluación in situ de tus procesos productivos bajo criterios BPM, HACCP e ISO 9001.</div><a href="#" class="serv-link" onclick="showToast('Redirigiendo a asesoría...'); return false;">Solicitar →</a></div>
    <div class="service-card"><div class="serv-icon">📊</div><div class="serv-title">Consultoría ISO</div><div class="serv-desc">Implementación y documentación de Sistemas de Gestión de Calidad para lograr tu certificación.</div><a href="#" class="serv-link" onclick="showToast('Redirigiendo a asesoría...'); return false;">Solicitar →</a></div>
    <div class="service-card"><div class="serv-icon">🎓</div><div class="serv-title">Capacitación In-Company</div><div class="serv-desc">Programas de formación a medida para tu equipo, impartidos en tu planta o de forma virtual.</div><a href="#" class="serv-link" onclick="showToast('Redirigiendo a asesoría...'); return false;">Solicitar →</a></div>
    <div class="service-card"><div class="serv-icon">📄</div><div class="serv-title">Manuales y Procedimientos</div><div class="serv-desc">Elaboración de documentación técnica: manuales HACCP, POE, POES y registros de calidad.</div><a href="#" class="serv-link" onclick="showToast('Redirigiendo a asesoría...'); return false;">Solicitar →</a></div>
    <div class="service-card"><div class="serv-icon">🔬</div><div class="serv-title">Análisis de Producto</div><div class="serv-desc">Evaluación sensorial, fisicoquímica y microbiológica de productos lácteos terminados.</div><a href="#" class="serv-link" onclick="showToast('Redirigiendo a asesoría...'); return false;">Solicitar →</a></div>
    <div class="service-card"><div class="serv-icon">💬</div><div class="serv-title">Soporte por WhatsApp</div><div class="serv-desc">Canal de consulta rápida para clientes registrados. Respuesta garantizada en menos de 2 horas.</div><a href="#" class="serv-link" onclick="showToast('Abriendo WhatsApp...'); return false;">Contactar →</a></div>
  </div>
</section>

<section class="how reveal">
  <div style="text-align:center;margin-bottom:50px;">
    <div class="section-tag" style="margin:0 auto 16px;">¿Cómo funciona?</div>
    <h2 class="section-title">Del registro al <em>aprendizaje</em> en 4 pasos</h2>
  </div>
  <div class="steps">
    <div class="step"><div class="step-num">1</div><div class="step-title">Crea tu cuenta</div><div class="step-desc">Regístrate gratis con tu correo y datos básicos en menos de 2 minutos.</div></div>
    <div class="step"><div class="step-num">2</div><div class="step-title">Elige tu curso</div><div class="step-desc">Explora el catálogo y selecciona la capacitación que necesitas.</div></div>
    <div class="step"><div class="step-num">3</div><div class="step-title">Realiza el pago</div><div class="step-desc">Pago seguro en línea. Confirmación automática al instante.</div></div>
    <div class="step"><div class="step-num">4</div><div class="step-title">¡Aprende ya!</div><div class="step-desc">Accede al material, videos y documentos desde cualquier dispositivo.</div></div>
  </div>
</section>

<section class="quality reveal" id="calidad">
  <div class="quality-grid">
    <div>
      <div class="section-tag">Calidad</div>
      <h2 class="section-title">Comprometidos con los más altos <em>estándares</em></h2>
      <p class="section-subtitle" style="margin-bottom:24px;">Nuestro sistema cumple con normas internacionales para garantizarte la mejor experiencia.</p>
      <ul class="quality-list">
        <li>Sistema diseñado bajo ISO/IEC 25010</li>
        <li>Pruebas automatizadas con Cypress</li>
        <li>Transacciones seguras y cifradas</li>
        <li>Disponibilidad 24/7 garantizada</li>
        <li>Entrega automática de materiales post-pago</li>
      </ul>
      <div class="quality-badges">
        <div class="q-badge"><span>✓</span> ISO 25010</div>
        <div class="q-badge"><span>✓</span> ISO 29119</div>
        <div class="q-badge"><span>✓</span> ISO 9001</div>
        <div class="q-badge"><span>✓</span> BPM</div>
      </div>
    </div>
    <div class="quality-visual" id="qualityChart">
      <div class="q-chart-title">Métricas de calidad del sistema</div>
      <div class="q-row"><div class="q-row-label"><span>Seguridad</span><span>96%</span></div><div class="q-bar-bg"><div class="q-bar" data-width="96"></div></div></div>
      <div class="q-row"><div class="q-row-label"><span>Rendimiento</span><span>92%</span></div><div class="q-bar-bg"><div class="q-bar" data-width="92"></div></div></div>
      <div class="q-row"><div class="q-row-label"><span>Usabilidad</span><span>94%</span></div><div class="q-bar-bg"><div class="q-bar" data-width="94"></div></div></div>
      <div class="q-row"><div class="q-row-label"><span>Confiabilidad</span><span>98%</span></div><div class="q-bar-bg"><div class="q-bar" data-width="98"></div></div></div>
      <div class="q-row"><div class="q-row-label"><span>Satisfacción</span><span>98%</span></div><div class="q-bar-bg"><div class="q-bar amber" data-width="98"></div></div></div>
    </div>
  </div>
</section>

<div class="cta-band reveal">
  <h2>¿Listo para capacitar a tu equipo?</h2>
  <p>Únete a más de 240 profesionales que ya confían en JM y JS Alimentos Lácteos.</p>
  <div class="cta-btns">
    <a href="#cursos" class="btn-white">🎓 Ver cursos disponibles</a>
    <a href="#contacto" class="btn-ghost-white">💬 Hablar con un asesor</a>
  </div>
</div>

<section class="contact reveal" id="contacto">
  <div class="section-header">
    <div><div class="section-tag">Contacto</div><h2 class="section-title">Escríbenos <em>hoy</em></h2></div>
  </div>
  <div class="contact-grid">
    <div class="contact-info">
      <p>¿Tienes dudas sobre un curso o servicio? Nuestro equipo responde en menos de 2 horas. También puedes escribirnos directo por WhatsApp.</p>
      <div class="contact-items">
        <div class="contact-item"><div class="ci-icon">📍</div><div><div class="ci-label">Ubicación</div><div class="ci-val">Huancayo, Junín — Perú</div></div></div>
        <div class="contact-item"><div class="ci-icon">📱</div><div><div class="ci-label">WhatsApp</div><div class="ci-val">+51 987 654 321</div></div></div>
        <div class="contact-item"><div class="ci-icon">✉️</div><div><div class="ci-label">Correo</div><div class="ci-val">contacto@jmjslacteos.pe</div></div></div>
        <div class="contact-item"><div class="ci-icon">🕐</div><div><div class="ci-label">Horario de atención</div><div class="ci-val">Lunes a Viernes · 8am – 6pm</div></div></div>
      </div>
    </div>
    <div class="contact-form">
      <div class="form-row">
        <div class="form-group"><label>Nombre</label><input type="text" placeholder="Tu nombre completo"></div>
        <div class="form-group"><label>Empresa</label><input type="text" placeholder="Nombre de tu empresa"></div>
      </div>
      <div class="form-group"><label>Correo electrónico</label><input type="email" placeholder="correo@empresa.com"></div>
      <div class="form-group"><label>Servicio de interés</label>
        <select><option>Seleccionar...</option><option>Curso BPM en Lácteos</option><option>Curso Gestión ISO 9001</option><option>Consultoría empresarial</option><option>Capacitación in-company</option><option>Otro</option></select>
      </div>
      <div class="form-group"><label>Mensaje</label><textarea placeholder="Cuéntanos en qué podemos ayudarte..."></textarea></div>
      <button class="btn-submit" onclick="showToast('✅ ¡Mensaje enviado! Te contactaremos pronto.')">Enviar mensaje ✓</button>
    </div>
  </div>
</section>

<footer>
  <div class="footer-grid">
    <div class="footer-brand">
      <div style="display:flex;gap:10px;align-items:center;margin-bottom:4px;">
        <div style="width:32px;height:32px;background:var(--teal-mid);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:15px;">🥛</div>
        <span style="font-family:var(--font-display);font-size:18px;font-weight:700;color:var(--teal-soft);">JM y JS Alimentos Lácteos</span>
      </div>
      <p>Expertos en calidad alimentaria, BPM e ISO para el sector lácteo peruano. Formamos líderes que transforman la industria.</p>
    </div>
    <div class="footer-col"><h4>Plataforma</h4><a href="#">Cursos</a><a href="#">Servicios</a><a href="#">Certificaciones</a><a href="#">Blog técnico</a></div>
    <div class="footer-col"><h4>Empresa</h4><a href="#">Nosotros</a><a href="#">Misión y Visión</a><a href="#">Clientes</a><a href="#">Trabaja con nosotros</a></div>
    <div class="footer-col"><h4>Soporte</h4><a href="#">Centro de ayuda</a><a href="#">WhatsApp</a><a href="#">Política de privacidad</a><a href="#">Términos de uso</a></div>
  </div>
  <div class="footer-bottom">
    <span>© 2026 JM y JS Alimentos Lácteos · Huancayo, Perú</span>
    <span>Desarrollado por Grupo 3 — Universidad Continental</span>
  </div>
</footer>

<button class="wa-float" onclick="showToast('Abriendo WhatsApp... 💬')" title="Contactar por WhatsApp">
  <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="white"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
</button>

<div class="modal-overlay" id="modal">
  <div class="modal">
    <div class="modal-header">
      <div class="modal-title" id="modal-title">BPM en Industria Láctea</div>
      <button class="modal-close" onclick="closeModal()">✕</button>
    </div>
    <div class="modal-price-box">
      <div><div style="font-size:12px;color:var(--teal-dark);font-weight:600;text-transform:uppercase;letter-spacing:.05em;margin-bottom:4px;">Precio del curso</div><div class="modal-price" id="modal-price">S/ 350</div></div>
      <div style="text-align:right"><div style="font-size:12px;color:var(--teal-dark);margin-bottom:4px;">Incluye</div><div style="font-size:13px;font-weight:600;color:var(--teal-dark);">Certificado oficial</div></div>
    </div>
    <p id="modal-desc" style="font-size:14px;color:var(--gray-500);margin-bottom:20px;line-height:1.7;"></p>
    <ul class="modal-features">
      <li>Acceso inmediato tras confirmar pago</li>
      <li>Material en PDF y videos descargables</li>
      <li>Soporte por WhatsApp durante el curso</li>
      <li>Certificado con código de verificación</li>
    </ul>
    <button class="btn-primary" style="width:100%;justify-content:center;" onclick="closeModal();showToast('✅ ¡Inscripción exitosa! Revisa tu correo.')">Inscribirse ahora →</button>
  </div>
</div>

<div class="toast" id="toast">✓ <span id="toast-msg"></span></div>

<script>
window.addEventListener('scroll',()=>{document.getElementById('navbar').classList.toggle('scrolled',window.scrollY>20)});
const obs=new IntersectionObserver((e)=>{e.forEach(x=>{if(x.isIntersecting)x.target.classList.add('visible')})},{threshold:.1});
document.querySelectorAll('.reveal').forEach(el=>obs.observe(el));
const sObs=new IntersectionObserver((e)=>{e.forEach(x=>{if(x.isIntersecting){x.target.querySelectorAll('[data-target]').forEach(n=>{const t=+n.dataset.target;let c=0;const inc=Math.max(1,Math.ceil(t/60));const ti=setInterval(()=>{c=Math.min(c+inc,t);n.textContent=c;if(c>=t)clearInterval(ti)},20)});sObs.unobserve(x.target)}})},{threshold:.5});
const sb=document.querySelector('.stats-bar');if(sb)sObs.observe(sb);
const bObs=new IntersectionObserver((e)=>{e.forEach(x=>{if(x.isIntersecting){x.target.querySelectorAll('.q-bar').forEach(b=>{b.style.width=b.dataset.width+'%'});bObs.unobserve(x.target)}})},{threshold:.3});
const qc=document.getElementById('qualityChart');if(qc)bObs.observe(qc);
function openModal(title,price,desc){document.getElementById('modal-title').textContent=title;document.getElementById('modal-price').textContent=price;document.getElementById('modal-desc').textContent=desc;document.getElementById('modal').classList.add('active');document.body.style.overflow='hidden'}
function closeModal(){document.getElementById('modal').classList.remove('active');document.body.style.overflow=''}
document.getElementById('modal').addEventListener('click',(e)=>{if(e.target===document.getElementById('modal'))closeModal()});
let tt;function showToast(msg){clearTimeout(tt);const t=document.getElementById('toast');document.getElementById('toast-msg').textContent=msg;t.classList.add('show');tt=setTimeout(()=>t.classList.remove('show'),3200)}
</script>
</body>
</html>
