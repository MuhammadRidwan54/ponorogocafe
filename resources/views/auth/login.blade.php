<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="{{ asset('logo_pocaf.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/heroicons@2.0.18/24/outline/esm/index.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        :root {
            --primary-color: #996207;
            --primary-light: rgba(153, 98, 7, 0.1);
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: #ffffff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            opacity: 0;
            animation: fadeIn 0.6s ease-out forwards;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .login-container {
            max-width: 400px;
            width: 100%;
            transform: translateY(20px);
            opacity: 0;
            animation: slideUp 0.6s ease-out 0.2s forwards;
        }
        
        @keyframes slideUp {
            from { 
                transform: translateY(20px);
                opacity: 0;
            }
            to { 
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        .login-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            background: #ffffff;
            border: 1px solid rgba(0, 0, 0, 0.05);
            transform: scale(0.98);
            opacity: 0;
            animation: cardPop 0.5s ease-out 0.4s forwards;
        }
        
        @keyframes cardPop {
            from { 
                transform: scale(0.98);
                opacity: 0;
            }
            to { 
                transform: scale(1);
                opacity: 1;
            }
        }
        
        .card-header {
            background: transparent;
            border-bottom: none;
            text-align: center;
            padding: 2rem 2rem 1rem;
            transform: translateY(10px);
            opacity: 0;
            animation: fadeInSlideUp 0.5s ease-out 0.6s forwards;
        }
        
        @keyframes fadeInSlideUp {
            from { 
                transform: translateY(10px);
                opacity: 0;
            }
            to { 
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        .logo {
            width: 80px;
            height: 80px;
            object-fit: contain;
            margin-bottom: 1rem;
            transform: scale(0.9);
            opacity: 0;
            animation: logoBounce 0.8s ease-out 0.8s forwards;
        }
        
        @keyframes logoBounce {
            0% { 
                transform: scale(0.9);
                opacity: 0;
            }
            60% {
                transform: scale(1.05);
            }
            80% {
                transform: scale(0.98);
            }
            100% { 
                transform: scale(1);
                opacity: 1;
            }
        }
        
        .card-body {
            padding: 1rem 2rem 2rem;
            opacity: 0;
            animation: fadeIn 0.5s ease-out 0.8s forwards;
        }
        
        .form-group {
            transform: translateY(10px);
            opacity: 0;
            animation: fadeInSlideUp 0.5s ease-out forwards;
        }
        
        .form-group:nth-child(1) { animation-delay: 0.9s; }
        .form-group:nth-child(2) { animation-delay: 1.0s; }
        .remember-me { animation-delay: 1.1s; }
        .login-btn { animation-delay: 1.2s; }
        .divider { animation-delay: 1.3s; }
        .footer-links { animation-delay: 1.4s; }
        
        .input-focus-effect {
            transition: all 0.3s ease;
        }
        
        .input-focus-effect:focus {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(153, 98, 7, 0.15);
        }
        
        .alert-message {
            transform: scale(0.95);
            opacity: 0;
            animation: scaleIn 0.4s ease-out forwards;
        }
        
        @keyframes scaleIn {
            from { 
                transform: scale(0.95);
                opacity: 0;
            }
            to { 
                transform: scale(1);
                opacity: 1;
            }
        }
        
        .btn-hover-effect {
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        
        .btn-hover-effect:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        
        .password-toggle {
            transition: all 0.2s ease;
        }
        
        .password-toggle:hover {
            transform: scale(1.1);
        }
        
        .footer-text {
            opacity: 0;
            animation: fadeIn 0.5s ease-out 1.5s forwards;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 col-md-6 col-lg-5">
                <div class="login-container mx-auto">
                    <div class="card login-card glassmorphism">
                        <div class="card-header">
                            <div class="flex justify-center">
                                <img src="{{ asset('logo_pocaf.png') }}" alt="POCAF Logo" class="h-16 w-16 sm:h-20 sm:w-20 object-contain mb-4 logo">
                            </div>
                            <h2 class="text-xl sm:text-2xl font-bold text-gray-800">Welcome Back</h2>
                            <p class="text-gray-500 text-sm">Sign in to your account</p>
                        </div>
                        <div class="card-body px-6 sm:px-8 pb-6 sm:pb-8">
                            @if(session('success'))
                                <div class="mb-4 bg-green-50 border-l-4 border-green-400 p-4 rounded-md alert-message">
                                    <div class="flex">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 text-green-500 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        <p class="ml-2 text-sm text-green-700">{{ session('success') }}</p>
                                    </div>
                                </div>
                            @endif
                            
                            @if(session('error'))
                                <div class="mb-4 bg-red-50 border-l-4 border-red-400 p-4 rounded-md alert-message">
                                    <div class="flex">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 text-red-500 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        <p class="ml-2 text-sm text-red-700">{{ session('error') }}</p>
                                    </div>
                                </div>
                            @endif
                            
                            <form method="POST" action="{{ route('login') }}" x-data="{ showPassword: false }">
                                @csrf
                                
                                <div class="mb-6 form-group">
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                        Email Address
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 text-gray-400 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                            </svg>
                                        </div>
                                        <input
                                            type="email"
                                            id="email"
                                            name="email"
                                            value="{{ old('email') }}"
                                            class="pl-8 sm:pl-10 input-focus-effect block w-full rounded-lg bg-gray-50 border-gray-200 border-2 py-2.5 sm:py-3 px-6 sm:px-4 text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#996207] focus:bg-white text-sm sm:text-base"
                                            placeholder="Enter your email"
                                            required
                                        >
                                    </div>
                                    @error('email')
                                        <p class="mt-2 text-sm text-red-600 animate-shake">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="mb-6 form-group">
                                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                        Password
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 text-gray-400 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <input
                                            :type="showPassword ? 'text' : 'password'"
                                            id="password"
                                            name="password"
                                            class="pl-8 sm:pl-10 pr-10 sm:pr-12 input-focus-effect block w-full rounded-lg bg-gray-50 border-gray-200 border-2 py-2.5 sm:py-3 px-6 sm:px-4 text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#996207] focus:bg-white text-sm sm:text-base"
                                            placeholder="Enter your password"
                                            required
                                        >
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                            <button
                                                type="button"
                                                @click="showPassword = !showPassword"
                                                class="text-gray-400 hover:text-gray-600 focus:outline-none transition-colors duration-150 password-toggle"
                                            >
                                                <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                                </svg>
                                                <svg x-show="showPassword" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor" style="display: none;">
                                                    <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd" />
                                                    <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    @error('password')
                                        <p class="mt-2 text-sm text-red-600 animate-shake">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="mb-6 remember-me">
                                    <div class="flex items-center">
                                        <input
                                            type="checkbox"
                                            id="remember"
                                            name="remember"
                                            {{ old('remember') ? 'checked' : '' }}
                                            class="h-3 w-3 sm:h-4 sm:w-4 text-[#996207] focus:ring-[#996207] bg-gray-100 border-gray-300 rounded transition-all duration-150 hover:scale-110"
                                        >
                                        <label for="remember" class="ml-2 block text-sm text-gray-600">
                                            Remember me for 30 days
                                        </label>
                                    </div>
                                </div>
                                
                                <button
                                    type="submit"
                                    class="group relative w-full flex justify-center py-2.5 sm:py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-black to-[#996207] hover:from-black hover:to-[#996207] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#996207] btn-hover-effect login-btn"
                                >
                                    <span class="absolute left-0 inset-y-0 flex items-center pl-3 transition-transform duration-300 group-hover:translate-x-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 text-yellow-300 group-hover:text-yellow-200 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                    Sign In
                                </button>
                                
                                <div class="relative flex items-center mt-6 sm:mt-8 mb-4 sm:mb-6 divider">
                                    <div class="flex-grow border-t border-gray-200"></div>
                                    <span class="flex-shrink mx-4 text-gray-400 text-sm">or</span>
                                    <div class="flex-grow border-t border-gray-200"></div>
                                </div>
                                
                                <div class="text-center footer-links">
                                    <p class="text-sm text-gray-600">
                                        Don't have an account? 
                                        <a href="{{ route('register') }}" class="font-medium text-[#996207] hover:text-[#7a4e05] transition-colors duration-150 hover:underline">
                                            Create Account
                                        </a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <div class="text-center mt-6 footer-text">
                        <p class="text-sm text-gray-500">
                            © {{ date('Y') }} POCAF. All rights reserved.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add ripple effect to login button
            const loginBtn = document.querySelector('.login-btn');
            if (loginBtn) {
                loginBtn.addEventListener('click', function(e) {
                    const x = e.clientX - e.target.getBoundingClientRect().left;
                    const y = e.clientY - e.target.getBoundingClientRect().top;
                    
                    const ripple = document.createElement('span');
                    ripple.classList.add('ripple-effect');
                    ripple.style.left = `${x}px`;
                    ripple.style.top = `${y}px`;
                    
                    this.appendChild(ripple);
                    
                    setTimeout(() => {
                        ripple.remove();
                    }, 1000);
                });
            }
            
            // Add focus/blur effects to inputs
            const inputs = document.querySelectorAll('input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('ring-2', 'ring-[#996207]', 'ring-opacity-50');
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('ring-2', 'ring-[#996207]', 'ring-opacity-50');
                });
            });
        });
    </script>
</body>
</html>