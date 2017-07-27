@include('layouts.header')

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Lütfen Giriş Yapın</h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
                        <fieldset>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <input id="email" type="text" class="form-control" placeholder="E-Posta Adresiniz" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input id="password" type="password" placeholder="Şifre" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> Beni Hatırla
                                </label>
                            </div>
                            <div class="form-group">
                                <a href="{{ url('/password/reset') }}">Şifremi unuttum</a>
                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                            <button type="submit" id='logins' class="btn btn-lg btn-success btn-block">
                                Giriş Yap
                            </button>
                        </fieldset>
                    </form>
                </div>
            </div>
            <p style="text-align: center">2017 © Rhn Yazılım</p>
        </div>

    </div>
</div>
@include('layouts.footer')
