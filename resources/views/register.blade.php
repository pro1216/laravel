<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー登録</title>
    <!-- Styles -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <!--Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!--Font Awesome5-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
</head>

<body>
    　　　　　　　<h1>入力フォーム</h1>
    <div class="container">
        <div class="mt-5">

            <form id="form" action="{{route('register')}}" method="POST" onSubmit="return check()">
                @csrf
                <x-alert type="danger" :session="session('danger')" />
            <label>氏名</label>
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Last name" id="last_name" name="last_name">
                    <div class="help-block with-errors" id="last_name_err"></div>
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="First name" id="first_name" name="first_name">
                    <div class="help-block with-errors" id="first_name_err"></div>
                </div>
            </div>

            <div class="form-group has-feedback">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                <div class="help-block with-errors" id="email_err"></div>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                <div class="help-block with-errors" id="pass_err"></div>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword2">Password確認</label>
                <input type="password" class="form-control" id="password1" naem="password1" placeholder="Password">
                <div class="help-block with-errors" id="pass_err1"></div>
                <div value="aa"></div>
            </div>

            <button type="submit" class="btn btn-primary" id="button">Submit</button>
            </form>

        </div>
    </div>
    <script>
        function check() {

            if (last_name.value && first_name.value && email.value &&
                password.value && password1.value) {

                if (checkLastName() && checkFirstName() && checkMail() && passwordDuewl()) {
                    return true;
                }


                alert('誤りがあります');
                return false;
            }

            alert('必須項目を記入してください');
            return false;

        }

        //バリデーション
        form.addEventListener('focusout', function() {
            checkLastName();
            checkFirstName();
            checkMail();
            passwordDuewl();
        })

        function checkLastName() {
            var regrex = /^[ぁ-んァ-ヶー一-龠]+$/;
            var last_name = document.getElementById('last_name');
            if (last_name.value) {
                console.log(last_name.value);
                if (regrex.test(last_name.value)) {

                    last_name_err.setAttribute('class', 'text-success form-text small');
                    last_name_err.textContent = "ok";
                    return true;
                }
                last_name_err.textContent = "全角で記入してください";
                last_name_err.setAttribute('class', 'text-danger form-text small');
                return false;
            }
            last_name_err.textContent = "必須項目です";
            last_name_err.setAttribute('class', 'text-danger form-text small');
            flg = false;
            return false;
        }

        function checkFirstName() {
            var regrex = /^[ぁ-んァ-ヶー一-龠]+$/;
            var first_name = document.getElementById('first_name');
            if (first_name.value) {
                if (regrex.test(first_name.value)) {
                    first_name_err.setAttribute('class', 'text-success form-text small');
                    first_name_err.textContent = "ok";
                    return true;

                }
                first_name_err.textContent = "全角で記入してください";
                first_name_err.setAttribute('class', 'text-danger form-text small');
                return false;
            }
            first_name_err.textContent = "必須項目です";
            first_name_err.setAttribute('class', 'text-danger form-text small');
            return false;
        }

        //メールチェック
        function checkMail() {
            var email = document.getElementById('email');
            if (email.value) {
                console.log('email : ' + email.value);
                var regrex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

                if (regrex.test(email.value)) {
                    console.log('success');
                    email_err.textContent = "ok";
                    email_err.setAttribute('class', 'text-success form-text small');

                    return true;
                }
                email_err.textContent = "メールの書式が違います";
                email_err.setAttribute('class', 'text-danger form-text small');
                return false;
            }

            email_err.textContent = "必須項目です";
            email_err.setAttribute('class', 'text-danger form-text small');
            return false;
        }


        //パスワード2重チェック
        function passwordDuewl() {
            var pass_err = document.getElementById('pass_err');

            if (password.value && password1) {
                if (password.value === password1.value) {
                    pass_err.setAttribute('class', 'text-success form-text small');
                    pass_err.textContent = "ok";
                    return true;
                }
                pass_err.setAttribute('class', 'text-danger form-text small');

                pass_err.textContent = "パスワードが一致してません";
                return false;

            }
            pass_err.setAttribute('class', 'text-danger form-text small');
            pass_err.textContent = "必須項目です";
        }
    </script>
</body>

</html>