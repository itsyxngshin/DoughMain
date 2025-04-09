@extends('layouts.app')

@section('title', 'Verification Code')

@section('screen-verification')
<div class="flex justify-center items-center min-h-screen bg-white">
  <div class="w-1/4 max-w-7xl h-20 p-8 flex justify-center items-center">
    <div class="relative w-[1026px] h-[847px] bg-white rounded-[25px] shadow-lg flex flex-col items-center p-10">
      <img src="{{ asset('img/group.png') }}" alt="Logo" class="w-[100px] h-[100px] mt-5" />
      
      <div class="text-4xl font-bold text-gray-800 mt-5">
        Verification Code
      </div>

      <img src="{{ asset('img/image.svg') }}" alt="Illustration" class="w-[173px] h-[146px] mt-5" />

      <div class="relative w-[512px] h-[119px] mt-10">
        @for ($i = 1; $i <= 6; $i++)
        <input type="text" id="digit{{ $i }}" name="digit{{ $i }}" class="tfa-input"
               maxlength="1" pattern="[0-9]" required>
        @endfor

      </div>

      <p class="mt-10 w-[590px] text-lg text-gray-800 text-center">
        We have sent a verification code to your email account to verify your account. Please enter your verification
        code.
      </p>

      <button class="mt-10 w-[218px] h-[55px] bg-black text-white text-lg font-bold rounded-[20px]">
        Resend
      </button>
    </div>
  </div>
</div>
@endsection
