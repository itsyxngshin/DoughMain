@extends('layouts.app')

@section('title', 'Verification Code')

@section('screen-verification')
<div class="flex justify-center items-center min-h-screen bg-white">
  <div class="w-1/4 max-w-7xl h-20 flex justify-center items-center">
    <div class="relative w-[900px] h-[650px] bg-white rounded-[25px] shadow-lg flex flex-col items-center p-10">
      <img src="{{ asset('img/tfa.png') }}" alt="Logo" class=" pl-10 w-[140px] h-[100px] mt-5" />
      
      <div class="text-4xl font-bold text-gray-800 mt-5">
        Verification Code
      </div>
      <form wire:submit.prevent="verify" class="flex flex-col items-center space-y-4">
          <p class="text-lg text-gray-800 text-center">
            Enter the verification code sent to your email.
          </p>

          <!-- Input fields for the verification code -->

        <div class="flex space-x-2">
              @foreach(range(0, 3) as $index)
                  <input
                      type="text"
                      maxlength="1"
                      wire:model.lazy="digits.{{ $index }}"
                      x-on:input="if($event.target.value) $el.nextElementSibling?.focus()"
                      wire:keydown.backspace="$set('digits.{{ $index - 1 }}', '')"
                      wire:model.defer="digits.{{ $index }}"
                      class="w-12 h-12 text-center text-xl text-bold border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                      autofocus="{{ $index === 0 ? 'autofocus' : '' }}"
                  >
              @endforeach
          </div>


        <p class="mt-10 w-[590px] text-lg text-gray-800 text-center">
          We have sent a verification code to your email account to verify your account. Please enter your verification
          code.
        </p>

        <div class="relative">
          <button 
            type="submit"
            class="mt-10 w-[218px] h-[55px] bg-black text-white text-lg font-bold rounded-[20px] hover:bg-blue-700 transition flex items-center justify-center"
            wire:loading.attr="disabled"
          >
            {{-- Default text --}}
            <span wire:loading.remove>Verify</span>
        
            {{-- Spinner only on loading --}}
            <svg wire:loading class="w-5 h-5 animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
            </svg>
          </button>
        </div>
        <p class="text-lg text-gray-800 text-center">
          Didn’t receive the code? 
          <a href="#" class="text-blue-500 hover:underline">Resend</a>
        </p>

        <p class="text-lg text-gray-800 text-center">
          <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Back to Login</a>
        </p>

        @if(session('error'))
            <p class="text-red-500 mt-2">{{ session('error') }}</p>
        @endif
    </form>
    </div>
  </div>
</div>
@endsection
