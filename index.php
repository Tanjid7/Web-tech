<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>2025 BookReviewHub Summer Reading Guide</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(120deg, #e0eafc 0%, #cfdef3 100%);
      margin: 0;
      font-family: 'Roboto', 'Poppins', sans-serif;
      color: #24292f;
    }

    /* Top logo div */
    .top-logo {
      background: #fff;
      padding: 1.2rem 0;
      text-align: center;
      box-shadow: 0 2px 6px rgba(0,0,0,0.07);
    }
    .top-logo img {
      height: 60px;
      vertical-align: middle;
      margin-right: 16px;
      border-radius: 12px;
      box-shadow: 0 4px 16px rgba(42,122,226,0.11);
    }
    .top-logo .logo-title {
      display: inline-block;
      font-family: 'Playfair Display', serif;
      font-size: 2.2rem;
      color: #2a7ae2;
      font-weight: bold;
      vertical-align: middle;
      letter-spacing: 2px;
    }

    header {
      background: #fff;
      box-shadow: 0 1px 4px rgba(0,0,0,0.03);
      padding: 0.5rem 0;
      text-align: center;
      position: relative;
    }
    .subtitle {
      color: #e67e22;
      font-size: 1.1rem;
      margin-top: 0.2rem;
      font-family: 'Roboto', sans-serif;
      letter-spacing: 1px;
    }
    nav {
      margin-top: 0.6rem;
      text-align: center;
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 2rem;
    }
    nav a {
      color: #2a7ae2;
      text-decoration: none;
      font-weight: bold;
      font-size: 1.08rem;
      transition: color 0.2s;
      padding: 0.5rem 0.9rem;
      border-radius: 4px;
    }
    nav a:hover {
      color: #fff;
      background: #e67e22;
    }

    /* Improved Dropdown */
    .login-dropdown {
      position: relative;
      display: inline-block;
    }
    .login-btn {
      background: #2a7ae2;
      color: #fff;
      font-weight: 700;
      border: none;
      border-radius: 6px;
      padding: 0.5rem 1.2rem;
      font-size: 1rem;
      cursor: pointer;
      transition: background 0.16s;
      margin-left: 0.5rem;
    }
    .login-btn:hover,
    .login-btn:focus {
      background: #e67e22;
      outline: none;
    }
    .login-options {
      display: none;
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
      top: 110%;
      background: #fff;
      min-width: 170px;
      box-shadow: 0 6px 24px rgba(42,122,226,0.11);
      border-radius: 7px;
      z-index: 99;
      overflow: hidden;
    }
    .login-dropdown:focus-within .login-options,
    .login-dropdown:hover .login-options {
      display: block;
    }
    .login-options a {
      display: block;
      color: #2a7ae2;
      padding: 0.8rem 1.2rem;
      text-decoration: none;
      font-weight: 500;
      border-bottom: 1px solid #e0eafc;
      transition: background 0.12s, color 0.12s;
      background: none;
    }
    .login-options a:last-child {
      border-bottom: none;
    }
    .login-options a:hover {
      background: #e0eafc;
      color: #e67e22;
    }

    /* Hero section - shortened and recolored */
    .hero {
      background: linear-gradient(135deg, #fdfdfd 0%, #e8f5e9 100%);
      padding: 1.5rem 0 1.5rem 0; /* shorter height */
      text-align: center;
      border-radius: 0 0 20px 20px;
      margin-bottom: 0.5rem;
      box-shadow: 0 2px 10px rgba(42,122,226,0.07);
    }
    .hero-quote {
      font-family: 'Playfair Display', serif;
      font-size: 1.6rem;
      font-weight: 700;
      color: #2a7ae2; /* clearer font color */
      margin-bottom: 0.7rem;
      letter-spacing: .5px;
    }
    .featured-img {
      width: 300px;
      max-width: 85vw;
      border-radius: 15px;
      box-shadow: 0 6px 24px rgba(0,0,0,0.12);
      margin-bottom: 0.8rem;
      border: 3px solid #f1f1f1;
      background: #fff;
    }

    .book-section {
      margin: 2.5rem auto;
      max-width: 950px;
      background: #f6f7fb;
      border-radius: 18px;
      box-shadow: 0 8px 32px rgba(42,122,226,0.10);
      padding: 2rem 2.5vw;
    }
    .book-section h2 {
      font-family: 'Playfair Display', serif;
      color: #2a7ae2;
      font-size: 2rem;
      margin-bottom: 1.2rem;
      letter-spacing: 1px;
      text-align: center;
    }
    .book-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
      gap: 2rem;
      margin-bottom: 1.5rem;
    }
    .book-card {
      background: #fff;
      border-radius: 14px;
      box-shadow: 0 2px 8px rgba(42,122,226,0.06);
      padding: 1.2rem;
      text-align: center;
      transition: box-shadow 0.18s;
    }
    .book-card:hover {
      box-shadow: 0 6px 28px rgba(42,122,226,0.18);
    }
    .book-cover {
      width: 110px;
      height: 155px;
      object-fit: cover;
      border-radius: 8px;
      margin-bottom: 0.9rem;
      box-shadow: 0 2px 12px rgba(42,122,226,0.12);
      background: #ededed;
    }
    .book-title {
      font-family: 'Playfair Display', serif;
      font-size: 1.08rem;
      font-weight: 700;
      color: #2a7ae2;
      margin-bottom: 0.3rem;
    }
    .book-author {
      color: #888;
      font-size: 0.97rem;
      margin-bottom: 0.6rem;
    }
    .book-desc {
      color: #3e4c5a;
      font-size: 0.97rem;
      margin-bottom: 0.7rem;
      min-height: 50px;
    }
    .review-btn {
      background: #2a7ae2;
      color: #fff;
      border: none;
      border-radius: 5px;
      padding: 0.5rem 1.2rem;
      font-weight: bold;
      cursor: pointer;
      font-size: 1rem;
      transition: background 0.15s;
    }
    .review-btn:hover {
      background: #e67e22;
    }
    footer {
      background: #2a7ae2;
      color: #fff;
      text-align: center;
      padding: 1.2rem 0;
      font-size: 1rem;
      letter-spacing: 1px;
      margin-top: 2rem;
      border-radius: 0 0 12px 12px;
    }
    @media (max-width: 700px) {
      .book-section { padding: 1rem 2vw; }
      .book-section h2 { font-size: 1.3rem; }
      .top-logo .logo-title { font-size: 1.35rem;}
      .hero-quote { font-size: 1rem;}
      .book-grid { gap: 1rem; }
      .book-card { padding: 0.6rem;}
    }
  </style>
</head>
<body>
  
  <div class="top-logo">
    <img src="logo3.jpg" alt="Your Logo">
    <span class="logo-title">Shelf Talk</span>
  </div>

  <header>
    <div class="subtitle">2025 Summer Reading Guide</div>
    <nav>
      <a href="#">Home</a>
      <a href="#">Authors</a>
      <a href="contact.php">Contact</a>

      
      <div class="login-dropdown" tabindex="0">
        <button class="login-btn" aria-haspopup="true" aria-expanded="false">Login ▼</button>
        <div class="login-options">
          <a href="admin-login.html">Admin Login</a>
          <a href="author-login.html">Author Login</a>
          <a href="user-login.html">User Login</a>
        </div>
      </div>
    </nav>
  </header>

  <section class="hero">
    <div class="hero-quote">“Books are the plane, and the train, and the road. They are the destination and the journey. They are home.”</div>
    <img class="featured-img" src="images.jpg" alt="logo">
  </section>

  <section class="book-section">
    <h2>Editor's Picks for Summer 2025</h2>
    <div class="book-grid">
      <!-- Example Book 1 -->
      <div class="book-card">
        <img class="book-cover" src="https://covers.openlibrary.org/b/id/10509491-L.jpg" alt="Cover">
        <div class="book-title">The Midnight Library</div>
        <div class="book-author">by Matt Haig</div>
        <div class="book-desc">A life-affirming novel about regrets, choices, and infinite possibilities. Nora finds herself in a magical library between life and death.</div>
        <button class="review-btn">See Review</button>
      </div>
      <!-- Example Book 2 -->
      <div class="book-card">
        <img class="book-cover" src="https://covers.openlibrary.org/b/id/10958352-L.jpg" alt="Cover">
        <div class="book-title">Tomorrow, and Tomorrow, and Tomorrow</div>
        <div class="book-author">by Gabrielle Zevin</div>
        <div class="book-desc">A dazzling tale of friendship and creativity in the world of video game design, spanning decades and emotional landscapes.</div>
        <button class="review-btn">See Review</button>
      </div>
      <!-- Example Book 3 -->
      <div class="book-card">
        <img class="book-cover" src="https://covers.openlibrary.org/b/id/11094464-L.jpg" alt="Cover">
        <div class="book-title">Remarkably Bright Creatures</div>
        <div class="book-author">by Shelby Van Pelt</div>
        <div class="book-desc">A quirky, heartfelt story about an unlikely friendship between a widow and an octopus, and healing lost connections.</div>
        <button class="review-btn">See Review</button>
      </div>
      <!-- Example Book 4 -->
      <div class="book-card">
        <img class="book-cover" src="https://covers.openlibrary.org/b/id/10983608-L.jpg" alt="Cover">
        <div class="book-title">Fourth Wing</div>
        <div class="book-author">by Rebecca Yarros</div>
        <div class="book-desc">A fantasy adventure packed with dragons, danger, and romance—perfect for escaping into another world this summer!</div>
        <button class="review-btn">See Review</button>
      </div>
    </div>
  </section>

  <footer>
    &copy; 2025 BookReviewHub | Summer Reading Guide | Designed by Tanjid
  </footer>
</body>
</html>
