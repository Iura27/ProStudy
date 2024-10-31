

<!-- Sidebar -->
@if (empty($hideSidebar))
<div class="sidebar transition overlay-scrollbars animate__animated  animate__slideInLeft">
    <div class="sidebar-content">
        <div id="sidebar">

        <!-- Logo -->
        <div class="logo">
                <h2 class="mb-0"><img src="{{ asset('assets/images/logo.png')}}"> ProStudy</h2>
        </div>

        <ul class="side-menu">
            <li>
                <a href="/dash">
                    <i class='bx bxs-dashboard icon' ></i> Dashboard
                </a>
            </li>

            <!-- Divider-->
            <li class="divider " data-text="STARTER" >Opções</li>

            <li>
                <a href="/planos">
                    <i class='bx bx-time icon'></i>
                    Planos de Estudo
                </a>
            </li>

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

            <li>
                <a href="/lembretes">
                    <i class='bx bx-calendar icon'></i>
                    Lembretes
                </a>
            </li>







        </div>
    </div>

   </div>
 </div>
</div><!-- End Sidebar-->
@endif
