<html>
<head>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Lato:300,500');
        body {
            margin: 20px;
            font-family: Lato, sans-serif;
            font-size: 14px;
            line-height: 1.42857143;
            font-weight: 100;
        }
    </style>
</head>
<body>

    @yield('body')

    <div style="margin-top:40px">
        Yardım için yardim@coz-gec.com adresine e-posta gönderebilirsiniz.
        <br/><br/>
        <div style="margin-bottom:15px;">
            <img src="{{ asset('images/logo-white-filled-with-text.png') }}" height="60" alt="">
        </div>
        AppFab Uygulama Fabrikası Yazılım A.Ş. <br/>
        Mustafa Kemal Mh. Dumlupınar Blv. 266 B No: 73 Çankaya / ANKARA <br/>
        Mersis No: 0071083022700001
    </div>

</body>
</html>