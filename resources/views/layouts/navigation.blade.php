<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Menu</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ URL::to('/') }}">{{ env('APP_NAME','Uygulama') }}</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a id="profil" href="{{URL::to('#')}}"><i class="fa fa-user fa-fw"></i> {{ Auth::user()->name }}</a>
                </li>
                <li><a id="sifre" href="#"><i class="fa fa-gear fa-fw"></i> Şifre Değiştir</a>
                </li>
                <li class="divider"></li>

                <li><a href="{{ url('/logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out fa-fw"></i> Çıkış Yap</a>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="{{ URL::to('/') }}"><i class="fa fa-dashboard fa-fw"></i> Panel</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-desktop fa-fw"></i> Malzemeler<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{URL::to('malzemeler/')}}">Malzemeler</a>
                        </li>
                        <li>
                            <a href="{{ URL::to('/hareketler/emanet')}}">Emanetteki Malzemeler</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{URL::to('hareketler/')}}"><i class="fa fa-bar-chart-o fa-fw"></i> Malzeme Çıkış</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-wrench fa-fw"></i> Tanımlamalar<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ URL::to('/gruptanim')}}">Grup Tanımlama</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="{{ URL::to('about') }}"><i class="fa fa-user fa-gear"></i> Program</a>
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>