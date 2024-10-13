

<!-- Sidebar -->
@if (empty($hideSidebar))
<div class="sidebar transition overlay-scrollbars animate__animated  animate__slideInLeft">
    <div class="sidebar-content">
        <div id="sidebar">

        <!-- Logo -->
        <div class="logo">
                <h2 class="mb-0"><img src="{{ asset('assets/images/logo.png')}}"> Atrana</h2>
        </div>

        <ul class="side-menu">
            <li>
                <a href="/dash">
                    <i class='bx bxs-dashboard icon' ></i> Dashboard
                </a>
            </li>

            <!-- Divider-->
            <li class="divider" data-text="STARTER">Home</li>



            <li>
                <a href="/horarios">
                    <i class='bx bx-time icon'></i>
                    Horários
                </a>
            </li>


            <li>
                <a href="/tarefas">
                    <i class='bx bx-task icon'></i>
                    Tarefas
                </a>
            </li>

            <!-- Divider-->
            <li class="divider" data-text="Atrana">Atrana</li>

            <li>
                <a href="#">
                    <i class='bx bx-columns icon' ></i>
                    Components
                    <i class='bx bx-chevron-right icon-right' ></i>
                </a>
                <ul class="side-dropdown">
                    <li><a href="component-avatar.html">Avatar</a></li>
                    <li><a href="component-toastify.html">Toastify</a></li>
                    <li><a href="component-sweet-alert.html">Sweet Alert</a></li>
                    <li><a href="component-hero.html">Hero</a></li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <i class='bx bxs-notepad icon' ></i>
                    Forms
                    <i class='bx bx-chevron-right icon-right' ></i>
                </a>
                <ul class="side-dropdown">
                    <li><a href="forms-editor.html">Editor</a></li>
                    <li><a href="forms-validation.html">Validation</a></li>
                    <li><a href="forms-checkbox.html">Checkbox</a></li>
                    <li><a href="forms-radio.html">Radio</a></li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <i class='bx bxs-widget icon' ></i>
                    Widgets
                    <i class='bx bx-chevron-right icon-right' ></i>
                </a>
                <ul class="side-dropdown">
                    <li><a href="widgets-chatboxs.html">ChatBox</a></li>
                    <li><a href="widgets-email.html">Emails</a></li>
                    <li><a href="widgets-pricing.html">Pricing</a></li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <i class='bx bxs-bar-chart-alt-2 icon' ></i>
                    Charts
                    <i class='bx bx-chevron-right icon-right' ></i>
                </a>
                <ul class="side-dropdown">
                    <li><a href="chart-chartjs.html">ChartJS</a></li>
                    <li><a href="chart-apexcharts.html">Apexcharts</a></li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <i class='bx bxs-cloud-rain icon' ></i>
                    Icons
                    <i class='bx bx-chevron-right icon-right' ></i>
                </a>
                <ul class="side-dropdown">
                    <li><a href="icons-fontawesome.html">Fontawesome</a></li>
                    <li><a href="icons-boostrap.html">Bootstrap Icons</a></li>
                </ul>
            </li>

            <!-- Divider-->
            <li class="divider" data-text="Pages">Pages</li>

            <li>
                <a href="#">
                    <i class='bx bxs-user icon' ></i>
                    Auth
                    <i class='bx bx-chevron-right icon-right' ></i>
                </a>
                <ul class="side-dropdown">
                    <li><a href="auth-login.html">Login</a></li>
                    <li><a href="auth-register.html">Register</a></li>
                    <li><a href="auth-forgot-password.html">Forgot Password</a></li>
                    <li><a href="auth-reset-password.html">Reset Password</a></li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <i class='bx bxs-error icon' ></i>
                    Errors
                    <i class='bx bx-chevron-right icon-right' ></i>
                </a>
                <ul class="side-dropdown">
                    <li><a href="errors-403.html">403</a></li>
                    <li><a href="errors-404.html">404</a></li>
                    <li><a href="errors-500.html">500</a></li>
                    <li><a href="errors-503.html">503</a></li>
                </ul>
            </li>


            <li>
                <a href="credits.html"><i class='fa fa-pencil-ruler icon' ></i>
                    Credits
                </a>
            </li>

        </ul>

        <div class="ads">
            <div class="wrapper">
                <div class="help-icon"><i class="fa fa-circle-question fa-3x"></i></div>
                <p>Need Help with <strong>Atrana</strong>?</p>
                <a href="docs/" class="btn-upgrade">Documentation</a>
             </div>
        </div>
    </div>

   </div>
 </div>
</div><!-- End Sidebar-->
@endif
