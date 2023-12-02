<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="icon" type="image/png" href="{{ asset('gentella/production/images/bolu.png') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('cssku/login.css') }}">
	<style>
		body{
			height: fit-content;
		}
		.p-reg{
			margin-top: 20px !important;
			text-align: center !important;
		}

		.btn-login{
			margin-top: -12px !important;
		}

		.form-login{
			margin-top: 100px;
			padding-bottom: 10px !important;
			margin-bottom: 100px;
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
		<h3>Register</h3>

		<form method="POST" action="{{ route('register') }}">
        @csrf

		<input placeholder="Full Name" type="text" name="nama">

		<br>

		<input placeholder="Email" type="text" name="email">

		<br>

		<input placeholder="Telepon" type="text" name="telp">

		<br>

		<input placeholder="Password" type="password" name="password">

        <br>

		<select name="role">
            <option value="">Sebagai</option>
            <option value="3">Masyarakat</option>
            <option value="2">Pengantar</option>
        </select>

		<br>

		<p>
			<!-- <a class="link-lupa-password" onclick="showForgotPasswordAlert()">Forgot Password</a> -->
		</p>

		<button type="submit" class="btn-login">Register</button>

		</form>

		<p class="p-reg">
			<a href="{{ route('login') }}" class="register">Login Account</a>
		</p>

	</div>
</body>
</html>
