<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar with Notifications</title>
    <style>
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
        .icon-container {
            display: inline-flex;
            align-items: center;
            position: relative;
        }
        .notification-icon {
            font-size: 32px;
            cursor: pointer;
            margin-right: 15px;
            position: relative;
            top: 5px;
        }
        .notification-count {
            position: absolute;
            top: -5px;
            right: 3px;
            background-color: rgb(79, 231, 92);
            color: white;
            border-radius: 50%;
            padding: 3px 6px;
            font-size: 8px;
            font-weight: bold;
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
        .profile {
            background-color: #ffffff00;
            box-shadow: none;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <div class="menu">
            <!-- Outros itens da navbar -->
        </div>
        <div class="icon-container">
            <!-- Ícone de sino com contador de lembretes não lidos -->
            <a href="/lembretes">
            <span class="notification-icon">
                <i class="bx bxs-bell" style="width: 36px; heigth 36px;"> </i> <!-- Ícone de sino -->
                <span class="notification-count">
                    {{ \App\Models\Lembrete::where('user_id', Auth::id())->where('lida', false)->count() }}
                </span>
            </span>
        </a>

        <img
        src="{{ auth()->user()->photo ? asset('storage/' . auth()->user()->photo) : asset('assets/images/avatar/avatar-1.png') }}"
        alt="Avatar"
        id="profileImage">
            <div class="dropdown-menu" id="dropdownMenu">
                <a href="/perfil">Meu Perfil</a>
                <a href="settings.html">Settings</a>
                <hr>
                <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="#" onclick="document.getElementById('logoutForm').submit();">Logout</a>
            </div>
        </div>
    </div>

    <!-- JavaScript para o dropdown -->
    <script>
        const profileImage = document.getElementById('profileImage');
        const dropdownMenu = document.getElementById('dropdownMenu');

        profileImage.addEventListener('click', () => {
            dropdownMenu.classList.toggle('show');
        });

        // Fecha o dropdown ao clicar fora
        window.addEventListener('click', (e) => {
            if (!profileImage.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.remove('show');
            }
        });
    </script>
</body>
</html>
