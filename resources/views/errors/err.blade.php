<!DOCTYPE html>
<html>
    <head>
        <title>Depo Takip - Yetki</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap.min.css') }}">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                background-color: #2E3C42;
            }
            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }
            
            .content {
                text-align: center;
                display: inline-block;
            }
            .error-template {padding: 40px 15px;text-align: center;}
            .error-template h1 { color:red;font-weight: bold;font-size: 40px;}
            .error-actions {margin-top:15px;margin-bottom:15px;}
            .error-actions .btn { margin-right:10px; }
            .error-details{ font-size:36px; color:#F6CA3F;}
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="error-template">
                        <h1>Devre Dışı!</h1>
                        <div class="error-details">Bu Alan Sistem Tarafından Devre Dışı bırakılmıştır!</div>
                        <div class="error-actions">
                        <a href="{{ URL::to('/') }}" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home"></span>
                        Anasayfa </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
