@include('layouts.header')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Şifre Sıfırlama</h3>
                </div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                            <input id="email" type="email" class="form-control" name="email" placeholder="E-Posta Adresiniz" value="{{ old('email') }}" required>
                            </div>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary btn-block"> Parolamı Sıfırla </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')