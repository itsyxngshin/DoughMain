<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DoughMain Bakery</title>
    <link rel="stylesheet" href="globals.css" />
    <link rel="stylesheet" href="style.css" />
    @vite(['resources/css/app.css', 'resources/css/style.css', 'resources/js/app.js'])
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
            <div class="rectangle"></div>
            <div class="rectangle-2"></div>
            <nav class="navigation group second-nav">
            <a href="#" class="text-wrapper-7">Log in</a>
              <img class="img" src="{{ asset('storage/profile.png') }}" alt="Social media icon 1" />
              <img class="group-2" src="{{ asset('storage/bag.png') }}" alt="Social media icon 2" />
            </nav>
            <div class="group-3">
              <img
                class="brown-white-circle"
                src="{{ asset('storage/logo.png') }}"
                alt="DoughMain Bakery Logo"
              />
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
            <img src="{{ asset('storage/ube_pandesal.jpg') }}" alt="Ube Pandesal">
            <p>Ube Pandesal</p>
          </div>
          <div class="product">
            <img src="{{ asset('storage/pandesal.jpg') }}" alt="Pandesal">
            <p>Pandesal</p>
          </div>
          <div class="product">
            <img src="{{ asset('storage/ensaymada.jpg') }}" alt="Ensaymada">
            <p>Ensaymada</p>
          </div>
          <div class="product">
            <img src="{{ asset('storage/cassava_cake.jpg') }}" alt="Cassava Cake">
            <p>Cassava Cake</p>
          </div>
        </div>

        <div class="order-button-container">
          <button class="order-button">ORDER ONLINE</button>
        </div>
      </section>

        <section class="about-bakery">
          <div class="overlap-group">
            <h2 class="text-wrapper-2">about the bakery</h2>
            <p class="this-is-your-about">
              This is your About section. It's a great space to tell your story and to describe who you are and what you
              do. If you're a business, talk about how you started and tell the story of your professional journey.
              People want to know the real you, so don't be afraid to share personal anecdotes. Explain your core values
              and how you, your organization, or your business stand out from the crowd.
            </p>
            <div class="div-wrapper">
              <button class="text-wrapper-3">read more</button>
            </div>
          </div>
        </section>
        <section class="the-making">
          <div class="overlap-5">
            <h2 class="text-wrapper-17">the making</h2>
            <p class="text-wrapper-18">
              "I popped my balloon because I'm an Englishera, halata. A lot of people that I tried dating find me
              strong—as in nosebleed. Like, I get it a lot, and it doesn't offend me. Pero yun lang, baka ma-overwhelm
              ka sakin, and baka ma-overwhelm din ako sayo pag straight Tagalog."
            </p>
          </div>
          <img class="image-2" src="img/image-12.png" alt="Bakery making process 1" />
          <img class="image-3" src="img/image.png" alt="Bakery making process 2" />
          <img class="image-4" src="img/image-2.png" alt="Bakery making process 3" />
          <img class="image-5" src="img/image-3.png" alt="Bakery making process 4" />
        </section>
        <footer class="footer">
          <div class="overlap-6">
            <p class="text-wrapper-19">Follow us:</p>
            <a href="mailto:doughmain@gmail.com" class="text-wrapper-20">doughmain@gmail.com</a>
            <p class="text-wrapper-21">© Created by Team 6</p>
            <p class="text-wrapper-22">© DoughMain 2025</p>
            <a href="#" aria-label="Instagram">
              <img class="ri-instagram-line" src="img/ri-instagram-line.svg" alt="Instagram icon" />
            </a>
            <a href="#" aria-label="Google">
              <img class="ri-google-fill" src="img/ri-google-fill.svg" alt="Google icon" />
            </a>
          </div>
        </footer>
      </main>
    </div>
  </body>
</html>
