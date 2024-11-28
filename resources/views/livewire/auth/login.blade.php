        <div class="min-h-screen flex items-center justify-center bg-gray-100">
            <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8">
                <h2 class="text-2xl font-bold text-center mb-6">Login</h2>
                <form wire:submit.prevent="login">
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" wire:model="email" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('email') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" id="password" wire:model="password" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('password') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="w-full bg-indigo-500 text-white py-2 px-4 rounded-md hover:bg-indigo-600">
                        Login
                    </button>
                </form>
            </div>
        </div>