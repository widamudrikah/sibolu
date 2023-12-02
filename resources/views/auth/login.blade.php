<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="icon" type="image/png" href="{{ asset('gentella/production/images/bolu.png') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('cssku/login.css') }}">
	<style>
		.p-reg{
			margin-top: 20px !important;
			text-align: center !important;
		}

		.btn-login{
			margin-top: -12px !important;
		}

		.form-login{
			padding-bottom: 10px !important;
		}

		.register{
			text-decoration:none;
			color:#2A3F54;
			font-size:16px;
			cursor: pointer;
		}
		.register:hover{
			text-decoration:none;
			color:#2A3F54;
			font-size:16px;
			font-weight:600;
			cursor: pointer;
		}
	</style>
</head>
<body>
	<div class="form-login">

		<div class="brand">
			<img src="{{ asset('gentella/production/images/bolu.png') }}" class="idn">
		</div>
		<h3>Login</h3>

		<form method="POST" action="{{ route('login') }}">
        @csrf

		<input placeholder="Email" type="text" name="email">

		<br>

		<input placeholder="Password" type="password" name="password">

		<p>
			<!-- <a class="link-lupa-password" onclick="showForgotPasswordAlert()">Forgot Password</a> -->
		</p>

		<button type="submit" class="btn-login">Login</button>

		</form>

		<p class="p-reg">
			<a href="{{ route('register') }}" class="register">Register Account</a>
		</p>

	</div>

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<script>
        function showForgotPasswordAlert() {
            Swal.fire({
                title: 'Forgot Password?',
                text: 'Contact the admin for help with this issue.',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#2A3F54',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Contact Admin',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Arahkan ke URL WhatsApp dengan pesan
                    window.open('https://wa.me/6282191170349?text=Saya%20Lupa%20Password','_blank');
                }
            });
        }
    </script>
</body>
</html>