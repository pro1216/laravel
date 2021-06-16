<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログインフォーム</title>
    <!-- Scripts -->
    <script src="{{asset('js/app.js')}}" defer></script>
    <script src="{{asset('js/jquery.js')}}"></script>
    <!-- Styles -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    </script>
    <link href="{{asset('css/signin.css')}}" rel="stylesheet">
    </script>
</head>

<body>
    <div class="container">
        <div class="mt-5">
            <form id="form" class="form-signin" method="POST" action="{{route('login')}}">
                @csrf
                <h1 class="h3 mb-3 font-weight-normal">ログインフォーム</h1>
                @foreach ($errors->all() as $error)
                <ul class="alert alert-danger">
                    <li>{{ $error }}</li>
                </ul>
                @endforeach
                <x-alert type="danger" :session="session('danger')" />
                <x-alert type="success" :session="session('success')" />

                <div class="form-group">
                    <label for="inputEmail" class="sr-only">Email address</label>
                    <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address">
                    <div id="err-email"></div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password">
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit" id="button">ログイン</button>

            </form>

        </div>
        <div id="modal" class="modal">
            <div class="modal-content">
                <div class="modal-body">
                <div class="text-danger">パスワードまたは、メールアドレスが誤っています。</div>
                    <input type="button" id="closeBtn" value="close">
                </div>
            </div>
        </div>

        <a href="{{route('register')}}">新規登録</a>
        <a href="{{route('password')}}">パスワード変更</a>
    </div>

    <script type="text/javascript">
        button.addEventListener('click', function(event) {
            
            if (!mailCheck() || !passwordCheck()) {
            event.preventDefault();
            var modal = document.getElementById('modal');
            modal.style.display = 'block';
                
            }
                return;
    

        })

        function mailCheck() {
            var email = document.getElementById('inputEmail');
            console.log('email : ' + email.value);
            if (email.value) {
                var regrex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
              
                if (regrex.test(email.value)) {
                    console.log('success');

                    return true;
                }
            }

            return false;
        }

        function passwordCheck() {
            var password = document.getElementById('inputPassword');
            
            if (password.value) {
                if(password.value.length >= 1){

                    console.log(password);
                    return true;
                }
            }
            return false;
        }

        window.addEventListener('click', function(e) {

            if (e.target == modal) {
                modal.style.display = 'none';
            }
            var closeBtn = document.getElementById('closeBtn');

            closeBtn.addEventListener('click', function() {
                modal.style.display = 'none';
            })
        });
        
    </script>
</body>

</html>