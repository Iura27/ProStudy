@extends('layouts.app')

@section('content')
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>perfil - Atrana</title>
</head>
<body>
    <div id="content">
        <div>
            <div class="content-header">
                <h4>Hi, {{ auth()->user()->name }}!</h4>
                <p>Change information about yourself on this page</p>
            </div>

            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center">
                            <!-- Exibe a foto do usuário logado -->
                            <img
                                src="{{ auth()->user()->photo ? asset('storage/' . auth()->user()->photo) : asset('assets/images/avatar/avatar-1.png') }}"
                                alt="user-avatar"
                                class="d-block rounded"
                                height="100"
                                width="100px"
                                id="uploadedAvatar"
                            />
                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block">Upload new photo</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input
                                        type="file"
                                        id="upload"
                                        class="account-file-input"
                                        name="photo"
                                        hidden
                                        accept="image/png, image/jpeg"
                                        onchange="previewImage(event)"
                                    />
                                </label>
                                <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('perfil.update', auth()->user()->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')  <!-- Certifique-se de adicionar o método PUT -->
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="firstName" class="form-label">First Name</label>
                                    <input class="form-control" type="text" id="firstName" name="firstName" value="{{ auth()->user()->name }}" autofocus />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input class="form-control" type="email" id="email" name="email" value="{{ auth()->user()->email }}" />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="organization" class="form-label">Organization</label>
                                    <input type="text" class="form-control" id="organization" name="organization" value="{{ auth()->user()->organization }}" />
                                </div>

                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                    <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function previewImage(event) {
            const input = event.target;
            const imgPreview = document.getElementById('uploadedAvatar');

            // Verifica se um arquivo foi selecionado
            if (input.files && input.files[0]) {
                const reader = new FileReader();

                // Define a função de callback que irá executar quando o arquivo for carregado
                reader.onload = function(e) {
                    imgPreview.src = e.target.result; // Atualiza o src da imagem de pré-visualização
                }

                // Lê o arquivo como Data URL
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>
@endsection
