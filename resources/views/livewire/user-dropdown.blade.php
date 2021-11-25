
<div class="nav-item dropdown">
    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        {{auth()->user()->name}}
    </a>
    <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="navbarDropdown">
        <li><button class="dropdown-item" wire:click="logout"><i class="bi bi-power me-2"></i>Cerrar sesión</button></li>
    </ul>
</div>

