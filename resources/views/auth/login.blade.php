<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login - ProStudy</title>

    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="assets/modules/bootstrap-5.1.3/css/bootstrap.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Bootstrap Icon-->
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
          <h1 class="auth-title">Login.</h1>
          <p class="auth-subtitle mb-5">Insira seus dados para realizar login.</p>

          <!-- Formulário de Login Atualizado -->
          <form action="{{ route('login') }}" method="POST">
            @csrf <!-- Token de segurança para o Laravel -->
            <div class="form-group position-relative has-icon-left mb-4">
              <input type="text" class="form-control form-control-xl" name="email" placeholder="Email" required autofocus>
              <div class="form-control-icon">
                <i class="bi bi-person"></i>
              </div>
            </div>
            <div class="form-group position-relative has-icon-left mb-4">
              <input type="password" class="form-control form-control-xl" name="password" placeholder="Senha" required>
              <div class="form-control-icon">
                <i class="bi bi-shield-lock"></i>
              </div>
            </div>
            <div class="form-check form-check-lg d-flex align-items-end">
              <input class="form-check-input me-2" type="checkbox" name="remember" id="flexCheckDefault">
              <label class="form-check-label text-gray-600" for="flexCheckDefault">
                Me lembre
              </label>
            </div>
            <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5" type="submit">Login</button>
          </form>

          <div class="text-center mt-5 text-lg fs-4">
            <p class="text-gray-600">Não tem uma conta? <a href="{{ route('register') }}" class="font-bold">Cadastre-se</a>.</p>
            <p><a class="font-bold" href="{{ route('password.request') }}">Esqueceu sua senha?</a>.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="assets/js/atrana.js"></script>
  <!-- JS Libraries -->
  <script src="assets/modules/jquery/jquery.min.js"></script>
  <script src="assets/modules/bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>
  <script src="assets/modules/popper/popper.min.js"></script>
  <!-- Template JS File -->
  <script src="assets/js/script.js"></script>
  <script src="assets/js/custom.js"></script>
</body>
</html>
