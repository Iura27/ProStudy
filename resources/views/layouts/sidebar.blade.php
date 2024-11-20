
<style>
    .active {
    background-color: #a8a2a380; /* ou qualquer cor de destaque que você quiser */
    font-weight: bold;
    border-radius: 10px;
    text-decoration: underline;
    
}
</style>


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
            <li class="{{ Request::is('dash') ? 'active' : '' }}">
                <a href="/dash">
                    <i class='bx bxs-dashboard icon'></i> Dashboard
                </a>
            </li>

            <!-- Divider-->
            <li class="divider " data-text="STARTER" >Opções</li>

            <li class="{{ Request::is('planos') ? 'active' : '' }}">
                <a href="/planos">
                    <i class='bx bx-task icon'></i>
                    Planos de Estudo
                </a>
            </li>

            <li class="{{ Request::is('horarios') ? 'active' : '' }}">
                <a href="/horarios">
                    <i class='bx bx-time icon'></i>
                    Horários
                </a>
            </li>


            <li class="{{ Request::is('tarefas') ? 'active' : '' }}">
                <a href="/tarefas">
                    <i class='bx bx-task icon'></i>
                    Tarefas
                </a>
            </li>

            <li class="{{ Request::is('lembretes') ? 'active' : '' }}">
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
