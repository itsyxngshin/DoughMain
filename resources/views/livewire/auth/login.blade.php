<div class="flex justify-center items-center h-screen">
    <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-center text-2xl font-semibold mb-4">Login</h2>

        @if (session()->has('message'))
            <div class="mb-4 text-green-600">
                {{ session('message') }}
            </div>
        @endif

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" wire:model.defer="email" id="email" class="w-full p-2 border border-gray-300 rounded">
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" wire:model.defer="password" id="password" class="w-full p-2 border border-gray-300 rounded">
                @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4 flex items-center">
                <input type="checkbox" wire:model="remember" id="remember" class="mr-2">
                <label for="remember" class="text-sm">Remember Me</label>
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">
                Login
            </button>
        </form>
    </div>
</div>
