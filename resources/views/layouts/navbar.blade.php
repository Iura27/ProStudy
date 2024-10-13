<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar with Dropdown</title>
    <style>
        /* Estilos básicos para a navbar */
        .navbar {
            background-color: #33333300;
            display: flex;
            justify-content: space-between;
            padding: 10px;
        }
        .navbar img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
        }
        .dropdown-menu {
            display: none;
            position: absolute;
            top: 60px;
            right: 10px;
            background-color: white;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            width: 150px;
            z-index: 1000;
        }
        .dropdown-menu a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #333;
        }
        .dropdown-menu a:hover {
            background-color: #f1f1f1;
        }
        .show {
            display: block;
        }
        .profile{
            background-color: #ffffff00;
            box-shadow: none
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <div class="menu">
            <!-- Outros itens da navbar -->
        </div>
        <div class="profile">
            <img src="{{ asset('assets/images/avatar/avatar-1.png')}}" alt="Avatar" id="profileImage">

            <div class="dropdown-menu" id="dropdownMenu">
                <a href="/perfil">Meu Perfil</a>
                <a href="settings.html">Settings</a>
                <hr>
                <a href="#">Logout</a>
            </div>
        </div>
    </div>

    <!-- JavaScript para o comportamento do dropdown -->
    <script>
        const profileImage = document.getElementById('profileImage');
        const dropdownMenu = document.getElementById('dropdownMenu');

        profileImage.addEventListener('click', () => {
            dropdownMenu.classList.toggle('show');
        });

        // Fechar o dropdown ao clicar fora
        window.addEventListener('click', (e) => {
            if (!profileImage.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.remove('show');
            }
        });
    </script>
</body>
</html>
