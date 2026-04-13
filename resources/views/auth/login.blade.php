<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<meta name="description" content="Application de gestion des ressources humaines pour Orange Mali.">
	<meta name="keywords" content="Orange Mali, gestion des ressources humaines, RH, congés, employés, paie, recrutement">
	<meta name="author" content="Orange Mali RH">
	<meta name="robots" content="noindex, nofollow">
	<title>Orange Mali RH - Connexion</title>

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/logo.png') }}">

	<!-- Apple Touch Icon -->
	<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/apple-touch-icon.png') }}">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

	<!-- Feather CSS -->
	<link rel="stylesheet" href="{{ asset('assets/plugins/icons/feather/feather.css') }}">

	<!-- Tabler Icon CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/tabler-icons/tabler-icons.min.css') }}">

	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">

	<!-- Main CSS -->
	<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

</head>

<body class="bg-white">

	<div id="global-loader" style="display: none;">
		<div class="page-loader"></div>
	</div>

	<!-- Main Wrapper -->
	<div class="main-wrapper">

		<div class="container-fuild">
			<div class="w-100 overflow-hidden position-relative flex-wrap d-block vh-100">
				<div class="row">
					
				
					<div class="col-lg-7 col-md-12 col-sm-12">
						<div class="row justify-content-center align-items-center vh-100 overflow-auto flex-wrap ">
							<div class="col-md-7 mx-auto vh-100">
								<form method="POST" action="{{ route('login') }}" class="vh-100">
                                    @csrf
									<div class="vh-100 d-flex flex-column justify-content-between p-4 pb-0">
										<div class=" mx-auto mb-5 text-center">
											<img src="{{ asset('assets/img/logo.svg') }}"
												class="img-fluid" width="150" alt="Logo">
										</div>
										<div class="">
											<div class="text-center mb-3">
												<h2 class="mb-2">Connexion</h2>
												<p class="mb-0">Bienvenue sur le portail RH Orange Mali. Connectez-vous pour accéder à votre espace.</p>
											</div>
											<div class="mb-3">
												<label for="email" class="form-label">Adresse E-mail</label>
												<div class="input-group">
													<input id="email" type="email" class="form-control border-end-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
													<span class="input-group-text border-start-0">
														<i class="ti ti-mail"></i>
													</span>
												</div>
                                                @error('email')
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
											</div>
											<div class="mb-3">
												<label for="password" class="form-label">Mot de passe</label>
												<div class="pass-group">
													<input id="password" type="password" class="pass-input form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
													<span class="ti toggle-password ti-eye-off"></span>
												</div>
                                                @error('password')
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
											</div>
											<div class="d-flex align-items-center justify-content-between mb-3">
												<div class="d-flex align-items-center">
													<div class="form-check form-check-md mb-0">
														<input class="form-check-input" name="remember" id="remember_me" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
														<label for="remember_me" class="form-check-label mt-0">Se souvenir de moi</label>
													</div>
												</div>
												<div class="text-end">
                                                    @if (Route::has('password.request'))
													    <a href="{{ route('password.request') }}" class="link-danger">Mot de passe oublié ?</a>
                                                    @endif
												</div>
											</div>
											<div class="mb-3">
												<button type="submit" class="btn btn-primary w-100">Se connecter</button>
											</div>
											<div class="text-center">
												<h6 class="fw-normal text-dark mb-0">Pas encore de compte ? Contactez l'administrateur RH pour obtenir un accès. 
													
												</h6>
											</div>
										</div>
										<div class="mt-5 pb-4 text-center">
											<p class="mb-0 text-gray-9">Orange Mali RH &copy; {{ date('Y') }}</p>
										</div>
									</div>
								</form>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Main Wrapper -->

	<!-- jQuery -->
	<script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>

	<!-- Bootstrap Core JS -->
	<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

	<!-- Feather Icon JS -->
	<script src="{{ asset('assets/js/feather.min.js') }}"></script>

	<!-- Custom JS -->
	<script src="{{ asset('assets/js/script.js') }}"></script>
</body>
</html>
