<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('pessoas.index') }}"
                        class="nav-link {{ request()->is('/enderecos') || request()->is('enderecos/*') || request()->is('pessoas') || request()->is('pessoas/*') ? 'active' : '' }}">
                        <i class="fa-fw nav-icon fas fa-users">

                        </i>
                        <p>
                            {{ trans('cruds.pessoa.title') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('conta.index') }}"
                        class="nav-link {{ request()->is('conta') || request()->is('conta/*') ? 'active' : '' }}">
                        <i class="fa-fw nav-icon fas fa-hand-holding-usd">
                        </i>
                        <p>
                            {{ trans('cruds.conta.title') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('movimentacoes.index') }}"
                        class="nav-link {{ request()->is('movimentacoes') || request()->is('movimentacoes/*') ? 'active' : '' }}">
                        <i class="fa-fw nav-icon fas fa-chart-line">
                        </i>
                        <p>
                            {{ trans('cruds.movimentacao.title') }}
                        </p>
                    </a>s
                </li>
            </ul>
        </nav>
    </div>
</aside>
