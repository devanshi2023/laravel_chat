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
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css' />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css' />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css" />
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
            background-image: linear-gradient(to right, lightgrey);
            justify-content: center;
            display: flex;
            padding-top: 20px;
            color: black;
            border: none;
            height: 100%;
            width: 100%;
            padding: 160px;
        }

        .main {
            border:1px solid black;
            background-image: linear-gradient(to right, lightgrey, lightblue);
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            display: flex;
            padding: 20px;
            border-radius: 10px;
            box-shadow:
                inset 0 -3em 3em white,
                0 0 0 0px white,
                0.3em 0.1em 1em white;

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
        .register{
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
                <div class="div1">
                    <form method="POST" action="{{route('user.add')}}" enctype="multipart/form-data">
                        @csrf
                        <h1 class="text-center">Registration</h1>
                        <!--employee name input-->
                        <div class="form-group">
                            <label>Name :</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Enter Name">
                            @if($errors->has('name'))
                            <span class="text">{{$errors->first('name')}}</span>
                            @endif
                        </div>
                        <!--employee email input-->
                        <div class="form-group">
                            <label>Email :</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter Email">
                            @if($errors->has('email'))
                            <span class="text">{{$errors->first('email')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Profile :</label>
                            <input type="file" id="uploadImage" name="image" class="form-control">
                            @if($errors->has('image'))
                            <span class="text">{{$errors->first('image')}}</span>
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
                        <button type="submit" class="btn register">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>