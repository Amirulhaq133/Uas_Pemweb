<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Modern UI</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            padding: 40px;
            width: 100%;
            max-width: 450px;
            position: relative;
            overflow: hidden;
        }

        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #667eea, #764ba2, #f093fb, #f5576c);
            background-size: 300% 100%;
            animation: gradientShift 3s ease infinite;
        }

        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 15px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            font-weight: bold;
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
            transform: perspective(1000px) rotateX(15deg);
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: perspective(1000px) rotateX(15deg) translateY(0px); }
            50% { transform: perspective(1000px) rotateX(15deg) translateY(-10px); }
        }

        .title {
            font-size: 2rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #666;
            font-size: 1rem;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            color: #555;
            margin-bottom: 8px;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-group input {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e1e8ed;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8fafc;
            outline: none;
        }

        .form-group input:focus {
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }

        .form-group input:valid {
            border-color: #10b981;
        }

        .password-strength {
            margin-top: 8px;
            font-size: 0.8rem;
        }

        .strength-bar {
            height: 4px;
            background: #e1e8ed;
            border-radius: 2px;
            overflow: hidden;
            margin-top: 5px;
        }

        .strength-fill {
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, #ef4444, #f59e0b, #10b981);
            transition: width 0.3s ease;
            border-radius: 2px;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
        }

        .checkbox-group input[type="checkbox"] {
            width: 20px;
            height: 20px;
            margin-right: 12px;
            accent-color: #667eea;
        }

        .checkbox-group label {
            font-size: 0.9rem;
            color: #555;
            cursor: pointer;
        }

        .checkbox-group a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .checkbox-group a:hover {
            text-decoration: underline;
        }

        .register-btn {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
        }

        .register-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(102, 126, 234, 0.4);
        }

        .register-btn:active {
            transform: translateY(0);
        }

        .register-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .register-btn:hover::before {
            left: 100%;
        }

        .divider {
            text-align: center;
            margin: 30px 0;
            position: relative;
            color: #999;
            font-size: 0.9rem;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e1e8ed;
            z-index: 1;
        }

        .divider span {
            background: rgba(255, 255, 255, 0.95);
            padding: 0 20px;
            position: relative;
            z-index: 2;
        }

        .social-login {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
        }

        .social-btn {
            flex: 1;
            padding: 12px;
            border: 2px solid #e1e8ed;
            border-radius: 10px;
            background: white;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .social-btn:hover {
            border-color: #667eea;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .google { color: #db4437; }
        .facebook { color: #3b5998; }
        .twitter { color: #1da1f2; }

        .login-link {
            text-align: center;
            margin-top: 25px;
            color: #666;
            font-size: 0.9rem;
        }

        .login-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .container {
                margin: 10px;
                padding: 30px 25px;
            }
            
            .title {
                font-size: 1.6rem;
            }
            
            .social-login {
                flex-direction: column;
            }
        }

        .input-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            transition: color 0.3s ease;
        }

        .form-group:focus-within .input-icon {
            color: #667eea;
        }

        .success-icon {
            color: #10b981;
        }

        .error-message {
            color: #ef4444;
            font-size: 0.8rem;
            margin-top: 5px;
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <div class="logo-icon">R</div>
            <h1 class="title">Daftar Akun</h1>
            <p class="subtitle">Buat akun baru untuk memulai</p>
        </div>

        <form id="registerForm" action="/register" method="POST">
            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" id="name" name="name" required>
                <div class="input-icon">👤</div>
                <div class="error-message">Nama harus diisi</div>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
                <div class="input-icon">📧</div>
                <div class="error-message">Email tidak valid</div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <div class="input-icon">🔒</div>
                <div class="password-strength">
                    <div class="strength-bar">
                        <div class="strength-fill" id="strengthFill"></div>
                    </div>
                    <span id="strengthText">Masukkan password</span>
                </div>
                <div class="error-message">Password minimal 8 karakter</div>
            </div>

            <div class="form-group">
                <label for="confirmPassword">Konfirmasi Password</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required>
                <div class="input-icon">🔒</div>
                <div class="error-message">Password tidak cocok</div>
            </div>

            <div class="checkbox-group">
                <input type="checkbox" id="terms" name="terms" required>
                <label for="terms">
                    Saya setuju dengan <a href="#" target="_blank">Syarat & Ketentuan</a> 
                    dan <a href="#" target="_blank">Kebijakan Privasi</a>
                </label>
            </div>

            <button type="submit" class="register-btn">
                Daftar Sekarang
            </button>
        </form>

        <div class="divider">
            <span>atau daftar dengan</span>
        </div>

        <div class="social-login">
            <button type="button" class="social-btn google" onclick="loginWithGoogle()">
                <span>G</span>
            </button>
            <button type="button" class="social-btn facebook" onclick="loginWithFacebook()">
                <span>f</span>
            </button>
            <button type="button" class="social-btn twitter" onclick="loginWithTwitter()">
                <span>𝕏</span>
            </button>
        </div>

        <div class="login-link">
            Sudah punya akun? <a href="/login">Masuk di sini</a>
        </div>
    </div>

    <script>
        // Password strength checker
        const passwordInput = document.getElementById('password');
        const strengthFill = document.getElementById('strengthFill');
        const strengthText = document.getElementById('strengthText');

        passwordInput.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;
            let strengthLabel = '';

            if (password.length >= 8) strength += 25;
            if (password.match(/[a-z]/)) strength += 25;
            if (password.match(/[A-Z]/)) strength += 25;
            if (password.match(/[0-9]/)) strength += 25;

            strengthFill.style.width = strength + '%';

            if (strength === 0) {
                strengthLabel = 'Masukkan password';
            } else if (strength === 25) {
                strengthLabel = 'Lemah';
            } else if (strength === 50) {
                strengthLabel = 'Sedang';
            } else if (strength === 75) {
                strengthLabel = 'Kuat';
            } else {
                strengthLabel = 'Sangat Kuat';
            }

            strengthText.textContent = strengthLabel;
        });

        // Form validation
        const form = document.getElementById('registerForm');
        const confirmPassword = document.getElementById('confirmPassword');

        confirmPassword.addEventListener('input', function() {
            const password = passwordInput.value;
            const confirmPass = this.value;
            
            if (password !== confirmPass && confirmPass.length > 0) {
                this.style.borderColor = '#ef4444';
                this.nextElementSibling.nextElementSibling.style.display = 'block';
            } else {
                this.style.borderColor = '#10b981';
                this.nextElementSibling.nextElementSibling.style.display = 'none';
            }
        });

        // Form submission
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Basic validation
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const password = passwordInput.value;
            const confirmPass = confirmPassword.value;
            const terms = document.getElementById('terms').checked;

            if (!name || !email || !password || !confirmPass) {
                alert('Semua field harus diisi!');
                return;
            }

            if (password !== confirmPass) {
                alert('Password tidak cocok!');
                return;
            }

            if (password.length < 8) {
                alert('Password minimal 8 karakter!');
                return;
            }

            if (!terms) {
                alert('Anda harus menyetujui syarat dan ketentuan!');
                return;
            }

            // If validation passes, submit the form
            // You can replace this with actual form submission
            alert('Registrasi berhasil! (Demo)');
            
            // Uncomment the line below for actual form submission
            // this.submit();
        });

        // Social login functions
        function loginWithGoogle() {
            alert('Login dengan Google (Demo)');
            // Implement Google OAuth here
        }

        function loginWithFacebook() {
            alert('Login dengan Facebook (Demo)');
            // Implement Facebook OAuth here
        }

        function loginWithTwitter() {
            alert('Login dengan Twitter (Demo)');
            // Implement Twitter OAuth here
        }

        // Add floating animation to form inputs
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateY(-2px)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateY(0)';
            });
        });
    </script>
</body>
</html>