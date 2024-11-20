@extends('layouts.app')

@section('content')
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Perfil - Atrana</title>
    <style>
        .profile-avatar {
            height: 100px;
            width: 100px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
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
                        <!-- Foto do usuário e botão de upload -->
                        <div class="d-flex align-items-start align-items-sm-center mb-4">
                            <img
                                src="{{ auth()->user()->photo ? asset('storage/' . auth()->user()->photo) : asset('assets/images/avatar/avatar-1.png') }}"
                                alt="user-avatar"
                                class="d-block profile-avatar"
                                id="uploadedAvatar"
                            />
                            <div class="ms-3">
                                <form method="POST" action="{{ route('perfil.update', auth()->user()->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    
                                <label for="upload" class="btn btn-primary me-2" tabindex="0">
                                    <span>Upload new photo</span>
                                    <input
                                        type="file"
                                        id="upload"
                                        class="d-none"
                                        name="photo"
                                        accept="image/png, image/jpeg"
                                        onchange="previewImage(event)"
                                    />
                                </label>
                                <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                            </div>
                        </div>

                        <!-- Formulário -->


                            <!-- Inputs alinhados -->
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="firstName" class="form-label">First Name</label>
                                    <input
                                        class="form-control"
                                        type="text"
                                        id="firstName"
                                        name="firstName"
                                        value="{{ auth()->user()->name }}"
                                        autofocus
                                    />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input
                                        class="form-control"
                                        type="email"
                                        id="email"
                                        name="email"
                                        value="{{ auth()->user()->email }}"
                                    />
                                </div>
                            </div>

                            <!-- Botões de ação -->
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                <button type="reset" class="btn btn-outline-secondary">Cancel</button>
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

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imgPreview.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>
@endsection
