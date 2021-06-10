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

            <form action="{{route('register')}}" method="POST">
                @csrf
                <x-alert type="danger" :session="session('danger')" />
                <label>氏名</label>
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Last name" name="last_name" required>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" placeholder="First name" name="first_name" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email" required> 
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            
        </div>
    </div>

</body>

</html>