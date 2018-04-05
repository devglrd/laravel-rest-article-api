<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Laravel</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/notie/dist/notie.min.css">
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }
        
        .full-height {
            height: 100vh;
        }
        
        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }
        
        .position-ref {
            position: relative;
        }
        
        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }
        
        .content {
            text-align: center;
        }
        
        .title {
            font-size: 84px;
        }
        
        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }
        
        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div id="app" class="flex-center position-ref full-height">
    <div class="content">
        <img src="https://www.wallies.com/filebin/images/loading_apple.gif" class="" width="40" id="loading" alt="">
        <div class="links">
            <div class="" id="here"></div>
        </div>
    </div>
</div>
{{--<div class="container">--}}
    {{--<div class="row">--}}
        {{--<div class="col d-flex justify-content-center">--}}
            {{--<ul id="contentData">--}}
            {{--</ul>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
{{--<div class="show" id="loading" style="position: absolute;top:0px;z-index: 999;background-color: red;height: 100vh;width: 100%">zdaz</div>--}}
</body>
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://unpkg.com/notie"></script>
<script>
    let dictionary = [];
    $(document).ready(function () {

        $.ajax({
            method: 'GET',
            cache: false,
            url: '/api/users'
        }).done(function (data) {
            if (data) {
                let output = '';
                $.each(data.data, function (key, data) {
                    dictionary.push(data)
                    output += '<li class="py-1">' +
                        '<strong>' + data.name + '</strong>' +
                        '<button class="btn btn-warning ml-4 delete" data-id="' + data.id + '">Delete</boutton>' +
                        // '<button class="btn btn-primary open-modal" data-id="' + data.id + '" data-email="'+ data.email +'">Modifier</button>'
                        '</li>';
                });

                $('#here').append(output)
                $('#loading').hide();
                console.log(dictionary)
            }
        }).fail(function (error) {
            console.log(error);
        });
        
        
        
        
        function getData(item) {
            console.log(item)
        }

        
        $('#search').on('keyup', function () {
            const val = this.value;
            console.log(val);
            if(dictionary.isPrototypeOf(val)){
                console.log(this);
            }
        });
        
        $('#here').on('click', 'button.open-modal', function () {
            let email = $(this).data('email');
            $('#EmailInput').val(email);
            $('#modal-edit').modal();
            
        })
        
        $('#save-edit').on('click', function () {
            console.log('adz')
            $('#forming-edit').submit(function () {
                console.log('adz')
                
                let email = $('#EmailInput').val();
            })
        })
        
        $('#here').on('click', 'button.delete', function () {
            let id = $(this).data('id');
            let parrent = $(this).parent();
            $.ajax({
                type: 'post',
                data: {_method: 'delete', id: id},
                cache: false,
                url: '/api/user/' + id,
            }).done(function (data) {
                
                if (data) {
                    parrent.remove()
                    notie.alert({
                        type: 'success',
                        text: 'Utilisateur supprimée',
                    })
                }
            }).fail(function (error) {
                console.log(error)
            });
        })
    });
</script>
</html>
