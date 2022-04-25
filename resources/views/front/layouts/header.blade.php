<nav class="navbar navbar-expand-lg fixed-top navbar-white navbar-custom sticky" id="navbar">
    <div class="container">

        <!-- LOGO -->
        <a class="navbar-brand text-uppercase" href="">
            <img src=" {{ getLogoUrl() }} " alt="" width="120px" height="56px">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="mdi mdi-menu"></span>
        </button>

        <li class="collapse navbar-collapse list-unstyled" id="navbarCollapse">
            <ul class="navbar-nav mx-auto" id="navbar-navlist">
                <li class="nav-item">
                    <a class="nav-link active" href="#home">{{__('auth.home')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#features">{{__('auth.features')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">{{__('auth.about')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#pricing">{{__('auth.pricing')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">{{__('auth.contact')}}</a>
                </li>
                <li class="nav-item dropdown front-language">
                    @php
                        $styleCss = 'style';
                    @endphp
                    <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="languageDropdown"
                       data-bs-toggle="dropdown">{{ __('messages.language') }}</a>
                    <ul class="dropdown-menu" {{ $styleCss }}="min-width: 200px" aria-labelledby="languageDropdown">
                        @foreach(getLanguages() as $key => $value)
                            @foreach(\App\Models\User::FLAG as $imageKey=> $imageValue)
                                @if($imageKey == $key)
                                    <li class="d-flex align-items-center dropdown-item languageSelection {{ (checkFrontLanguageSession() == $key) ? 'active show' : '' }}"
                                        data-prefix-value="{{ $key }}" {{ $styleCss }}="max-height: 40px">
                                        <a href="javascript:void(0)" class="d-flex ps-0 align-items-center">
                                            <img class="rounded-1 mr-3 d-inline-block" {{ $styleCss }}="width: 20px"
                                            src="{{asset($imageValue)}}"/>
                                            <span class="d-inline-block">{{ $value }}</span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        @endforeach
                    </ul>
                </li>
            </ul>
            <div class="d-flex align-items-center">
                <div class="me-5 flex-shrink-0 d-lg-block">
                    @if(empty(getLogInUser()))
                        <a class="btn btn-primary nav-btn" href="{{ route('login') }}">
                            {{ __('auth.sign_in') }}
                        </a>
                    @else
                        @if(getLogInUser()->hasrole('admin') || getLogInUser()->hasrole('user'))
                            <a class="btn btn-primary nav-btn" href="{{ route('admin.dashboard') }}">
                                {{ __('messages.dashboard') }}
                            </a>
                        @endif
                        @if(getLogInUser()->hasrole('super_admin'))
                            <a class="btn btn-primary nav-btn" href="{{ route('sadmin.dashboard') }}">
                                {{ __('messages.dashboard') }}
                            </a>
                        @endif
                    @endif
                </div>
            </div>
        </li>

    </div>
</nav>
