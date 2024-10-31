<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Register - Atrana</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/modules/bootstrap-5.1.3/css/bootstrap.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="assets/modules/bootstrap-icons/bootstrap-icons.css">
</head>
<body>

  <div id="auth">

    <div class="row h-100">
      <div class="col-lg-7 d-none d-lg-block">
        <div id="auth-left"></div>
      </div>
      <div class="col-lg-5 col-12">
        <div id="auth-right">
          <div class="auth-logo">
            <a href="index.html"><img src="assets/images/logo.png" alt="Logo"> ProStudy</a>
          </div>
          <h1 class="auth-title">Cadastre-se.</h1>
          <p class="auth-subtitle mb-5">Insira seus dados para se registrar.</p>

          <!-- Formulário de Registro -->
          <form action="{{ route('register') }}" method="POST">
            @csrf <!-- Adiciona o token CSRF para proteção -->

            <!-- Campo Nome -->
            <div class="form-group position-relative has-icon-left mb-4">
              <input type="text" name="name" class="form-control form-control-xl @error('name') is-invalid @enderror" placeholder="Seu nome" value="{{ old('name') }}" required autofocus>
              <div class="form-control-icon">
                <i class="bi bi-person"></i>
              </div>
              @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <!-- Campo Email -->
            <div class="form-group position-relative has-icon-left mb-4">
              <input type="email" name="email" class="form-control form-control-xl @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" required>
              <div class="form-control-icon">
                <i class="bi bi-envelope"></i>
              </div>
              @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <!-- Campo Senha -->
            <div class="form-group position-relative has-icon-left mb-4">
              <input type="password" name="password" class="form-control form-control-xl @error('password') is-invalid @enderror" placeholder="Senha" required>
              <div class="form-control-icon">
                <i class="bi bi-shield-lock"></i>
              </div>
              @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <!-- Campo Confirmação de Senha -->
            <div class="form-group position-relative has-icon-left mb-4">
              <input type="password" name="password_confirmation" class="form-control form-control-xl" placeholder="Confirme a senha" required>
              <div class="form-control-icon">
                <i class="bi bi-shield-lock"></i>
              </div>
            </div>

            <!-- Botão de Registro -->
            <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5" type="submit">Cadastre-se</button>
          </form>

          <div class="text-center mt-5 text-lg fs-4">
            <p class="text-gray-600">Já possui uma conta? <a href="{{ route('login') }}" class="font-bold">Log in</a>.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="assets/js/atrana.js"></script>

  <!-- JS Libraies -->
  <script src="assets/modules/jquery/jquery.min.js"></script>
  <script src="assets/modules/bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>
  <script src="assets/modules/popper/popper.min.js"></script>

  <!-- Template JS File -->
  <script src="assets/js/script.js"></script>
  <script src="assets/js/custom.js"></script>
</body>
</html>
