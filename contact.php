<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us - BookReviewHub</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(120deg, #e0eafc, #cfdef3);
      color: #333;
    }
    header {
      background: #2a7ae2;
      color: #fff;
      text-align: center;
      padding: 1.2rem;
      font-size: 1.5rem;
      font-weight: bold;
    }
    .contact-container {
      max-width: 600px;
      background: #fff;
      margin: 2rem auto;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 4px 18px rgba(0,0,0,0.1);
    }
    .contact-container h2 {
      text-align: center;
      margin-bottom: 1rem;
      color: #2a7ae2;
    }
    label {
      font-weight: bold;
      display: block;
      margin: 0.7rem 0 0.3rem;
    }
    input, textarea {
      width: 100%;
      padding: 0.8rem;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 1rem;
    }
    textarea {
      resize: vertical;
      min-height: 120px;
    }
    button {
      margin-top: 1rem;
      width: 100%;
      padding: 0.9rem;
      border: none;
      border-radius: 8px;
      background: #2a7ae2;
      color: #fff;
      font-size: 1rem;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.2s;
    }
    button:hover {
      background: #e67e22;
    }
    footer {
      background: #2a7ae2;
      color: #fff;
      text-align: center;
      padding: 1rem;
      margin-top: 2rem;
      font-size: 0.95rem;
    }
  </style>
</head>
<body>
  <header>📚 Contact Us</header>

  <div class="contact-container">
    <h2>Get in Touch</h2>
    <form action="contact-handler.php" method="POST">
      <label for="name">Your Name</label>
      <input type="text" id="name" name="name" placeholder="Enter your name" required>

      <label for="email">Your Email</label>
      <input type="email" id="email" name="email" placeholder="Enter your email" required>

      <label for="message">Your Message</label>
      <textarea id="message" name="message" placeholder="Write your message here..." required></textarea>

      <button type="submit">Send Message</button>
    </form>
  </div>

  <footer>
    &copy; 2025 BookReviewHub | Designed by Tanjid
  </footer>
</body>
</html>
