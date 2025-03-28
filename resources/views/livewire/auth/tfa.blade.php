<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Verification Code</title>
  </head>
  <body class="flex justify-center items-center min-h-screen bg-white">
    <div class="w-full max-w-7xl h-screen flex justify-center items-center">
      <div class="relative w-[1026px] h-[847px] bg-white rounded-[25px] shadow-lg flex flex-col items-center p-10">
        <img class="w-[100px] h-[100px] mt-5" src="img/group.png" alt="Logo" />
        <div class="text-4xl font-bold text-gray-800 mt-5">Verification Code</div>
        <img class="w-[173px] h-[146px] mt-5" src="img/image.svg" alt="Illustration" />
        <div class="relative w-[512px] h-[119px] mt-10">
          <img class="absolute w-[492px] h-[99px] top-[7px] left-[2px]" src="img/vector.svg" alt="Vector" />
          <img class="absolute w-full h-full top-0 left-0" src="img/vector-2.svg" alt="Vector 2" />
        </div>
        <p class="text-lg text-gray-800 text-center mt-10 w-[590px]">
          We have sent a verification code to your email account to verify your account. Please enter your verification
          code.
        </p>
        <button class="mt-10 w-[218px] h-[55px] bg-black text-white text-lg font-bold rounded-[20px]">
          Resend
        </button>
      </div>
    </div>
  </body>
</html>
