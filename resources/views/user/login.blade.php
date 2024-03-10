<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <!---font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .containers {
            width: 100%;
            height: 100vh;
        }

        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            background-image: linear-gradient(to right, black);
            justify-content: center;
            display: flex;
            padding-top: 20px;
            color: black;
            border: none;
            height: 100%;
            padding: 60px;

        }

        .main {
            border:1px solid black;
    background-image: linear-gradient(to right, lightgrey, lightblue);
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    display: flex;
    flex-direction: column; /* Added to align items vertically */
    align-items: center; /* Added to center items horizontally */
    padding: 20px;
    width: 50%;
    justify-content: center;
    border-radius: 10px;
    box-shadow:
        inset 0 -3em 3em white,
        0 0 0 0px white,
        0.3em 0.1em 1em white;
    margin: auto; /* Added to center the div */
}


        .div1 {
            padding: 15px;
            width: 100%;
        }


        input {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);

        }
        .text {
            color: red;


        }
        .login{
            background-color: gray;
            color: white;
        }

    </style>
</head>

<body>

    <div class="containers">
        <!---messages--->
        @if($message = Session::get('success'))
        <div class="alert alert-success alert-block" id="alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{{$message}}</strong>
        </div>
        @endif
        @if($message = Session::get('error'))
        <div class="alert alert-danger alert-block" id="alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{{$message}}</strong>
        </div>
        @endif
        <div class="card">
            <div class="main">
                <div class='blob'></div>
                <div class="div1">
                    <form method="POST" action="{{route('user.verify')}}" enctype="multipart/form-data">
                        @csrf
                        <h1 class="text-center">Login</h1>
                        <!--employee email input-->
                        <div class="form-group">
                            <label>Email :</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter Email">
                            @if($errors->has('email'))
                            <span class="text">{{$errors->first('email')}}</span>
                            @endif
                        </div>
                        <!--employee password input-->
                        <div class="form-group">
                            <label>Password :</label>
                            <input type="password" placeholder="Enter Password" name="password" class="form-control">
                            @if($errors->has('password'))
                            <span class="text">{{$errors->first('password')}}</span>
                            @endif
                        </div>
                        <button type="submit" class="btn login">Login</button>
                        <div class="signup-link">
                            Not a member? <a href="{{route('user.register')}}">Signup now</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>