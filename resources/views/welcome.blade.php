<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DoughMain Bakery</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Bodoni:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css" />
    @vite(['resources/css/style.css'])
    @vite('resources/js/app.js')
  </head>
  <body>
    <div class="landing-page-cont">
      <main class="main-content">
        <header class="header">
          <div class="overlap-2">
          <img class="image" src="{{ asset('storage/bgcover.JPG') }}" alt="Bakery background">
            <header class="header">
            <nav class="navigation group">
              <a href="#" class="text-wrapper-4">HOME</a>
              <a href="#" class="text-wrapper-5">MENU</a>
              <a href="#" class="text-wrapper-8">SERVICES</a>
              <a href="#" class="text-wrapper-6">CONTACT US</a>
            </nav>
            <nav class="navigation group second-nav">
            <a href="login" class="text-wrapper-7">Log in</a>
              <img class="img" src="{{ asset('storage/profile.png') }}" alt="Social media icon 1" />
              <img class="group-2" src="{{ asset('storage/bag.png') }}" alt="Social media icon 2" />
            </nav>
            <div class="group-3">
            <img id="logo" class="brown-white-circle" src="{{ asset('storage/logo.png') }}" alt="DoughMain Bakery Logo">
              <p class="text-wrapper-9">ORDER ONLINE</p>
              <img class="line" src="img/line-1.svg" alt="Decorative line" />
            </div>
          </div>
        </header>
        <section class="best-sellers">
        <div class="features-container">
          <div class="feature">
            <img src="{{ asset('storage/dna.png') }}" alt="Nutrition Icon">
            <h3>Nutrition Rich</h3>
            <p>Nutrition-Rich delights, crafted to nourish your taste buds.</p>
          </div>
          <div class="feature">
            <img src="{{ asset('storage/oven.png') }}" alt="Baking Icon">
            <h3>100% Baked</h3>
            <p>Savoring 100% baked items from our oven to your plates.</p>
          </div>
          <div class="feature">
            <img src="{{ asset('storage/gift.png') }}" alt="Secure Packing Icon">
            <h3>Secure Packing</h3>
            <p>Enjoy peace of mind with our secure packing.</p>
          </div>
        </div>

        <h2 class="best-sellers-title"><span>Best </span><span class="italic">Sellers</span></h2>

        <div class="products">
          <div class="product">
            <img src="{{ asset('storage/ube.jpg') }}" alt="Ube Pandesal">
            <p>Ube Pandesal</p>
          </div>
          <div class="product">
            <img src="{{ asset('storage/pandesal.jpg') }}" alt="Pandesal">
            <p>Pandesal</p>
          </div>
          <div class="product">
            <img src="{{ asset('storage/ensay.jpg') }}" alt="Ensaymada">
            <p>Ensaymada</p>
          </div>
          <div class="product">
            <img src="{{ asset('storage/cass.jpg') }}" alt="Cassava Cake">
            <p>Cassava Cake</p>
          </div>
        </div>

        <div class="order-button-container">
          <button class="order-button">ORDER ONLINE</button>
        </div>
      </section>

              <<section class="about-bakery">
            <div class="about-container">
                            <!-- Centered Text -->
                            <div class="about-text">
                <h2 class="title">the making</h2>
                <p class="description">
                  “I popped my balloon because I’m an English-era, halata. A lot of people that I tried dating find me strong — as in nosebleed. 
                  Like, I get it a lot, and it doesn’t offend me. Pero yun lang, baka ma-overwhelm ka sakin, and baka ma-overwhelm din ako sayo 
                  pag straight Tagalog.”
                </p>
              </div>
              
              <!-- Left Image -->
              <div class="about-image left">
              <img src="{{ asset('storage/image2.jpg') }}" alt="Bakery Product 1">
              </div>

              <!-- Right Image -->
              <div class="about-image right">
              <img src="{{ asset('storage/image1.jpg') }}" alt="Bakery Product 1">
              </div>
            </div>
          </section>

          <section class="section-about">
        <div class="container-about">

            <!-- Left Image -->
            <div class="image-wrapper">
            <img src="{{ asset('storage/image3.jpg') }}" alt="Bakery Products">
            </div>

            <!-- Center Text Box -->
            <div class="text-box">
                <h2>about the bakery</h2>
                <p>
                    This is your About section. It’s a great space to tell your story and to describe who you are and what you do. If you're a business, 
                    talk about how you started and tell the story of your professional journey. People want to know the real you, 
                    so don't be afraid to share personal anecdotes.
                </p>
                <a href="#" class="btn-read">read more</a>
            </div>

            <!-- Right Image -->
            <div class="image-wrapper">
            <img src="{{ asset('storage/image4.jpg') }}" alt="Freshly baked bread">
            </div>

        </div>
        </section>
        <footer class="footer">
          <div class="footer-content">
            <p class="team-credit">© Created by Team 6</p>
            <a href="mailto:doughmain@gmail.com" class="email-link">doughmain@gmail.com</a>
            <p class="follow-text">Follow us:</p>
            <div class="social-icons">
              <a href="#" aria-label="Facebook">
              <img src="{{ asset('storage/fb.png') }}" alt="Facebook icon">
              </a>
              <a href="#" aria-label="Instagram">
              <img src="{{ asset('storage/ig.png') }}" alt="Instagram icon">
              </a>
              <a href="#" aria-label="Google">
              <img src="{{ asset('storage/google.png') }}" alt="Google icon">
              </a>
            </div>
            <div class="footer-line"></div>
            <div class="footer-line"></div>
            <p class="copyright">© DoughMain 2025</p>
          </div>
        </footer>
      </main>
    </div>
    <script src="{{ asset('js/script.js') }}"></script>
  </body>
</html>
