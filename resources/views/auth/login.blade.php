<!DOCTYPE html>
<html>
<head>
    <title>Login SI Surat</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">
    <div class="bg-white shadow-lg rounded-lg p-6 w-96">
        <h2 class="text-2xl font-bold text-center mb-4">Login</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label class="block mb-1">Email</label>
                <input type="email" name="email" required 
                       class="w-full border p-2 rounded">
            </div>
            <div class="mb-3">
                <label class="block mb-1">Password</label>
                <input type="password" name="password" required 
                       class="w-full border p-2 rounded">
            </div>
            <div class="mb-3 flex items-center">
                <input type="checkbox" name="remember" class="mr-2"> Remember Me
            </div>
            <button type="submit" 
                    class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                Login
            </button>
        </form>
        @error('email')
            <p class="text-red-500 mt-2">{{ $message }}</p>
        @enderror
    </div>
</body>
</html>
