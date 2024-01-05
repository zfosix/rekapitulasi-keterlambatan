<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Login Rekapitulasi Keterlambatan</title>
    <style>
        /* Custom Styling */
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap');

        body {
            background: url(images/bg.png);
            background-size: cover;
            font-family: 'nunito', sans-serif;
            font-weight: 600;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            position: relative;
        }

        .box {
            width: 450px;
            height: 500px;
            background: #fff;
            backdrop-filter: blur(20px);
            border-radius: 30px;
            padding: 40px;
            box-shadow: 2px 2px 15px 2px rgba(0, 0, 0, 0.1),
                -2px -0px 15px 2px rgba(0, 0, 0, 0.1);
            z-index: 10;
        }

        .wrapper {
            position: absolute;
            width: 455px;
            height: 500px;
            border-radius: 30px;
            background: rgba(255, 255, 255, 0.53);
            box-shadow: 2px 2px 15px 2px rgba(0, 0, 0, 0.115),
                -2px -0px 15px 2px rgba(0, 0, 0, 0.054);
            transform: rotate(5deg);
        }

        .header {
            margin-bottom: 50px;
        }

        .header header {
            display: flex;
            justify-content: right;
        }

        header img {
            width: 25px;
        }

        .header p {
            font-size: 25px;
            font-weight: 800;
            margin-top: 10px;
        }

        .input-box {
            display: flex;
            flex-direction: column;
            margin: 10px 0;
            position: relative;
        }

        i {
            font-size: 22px;
            position: absolute;
            top: 35px;
            right: 12px;
            color: #595b5e;
        }

        input {
            height: 40px;
            border: 2px solid rgb(153, 157, 158);
            border-radius: 7px;
            margin: 7px 0;
            outline: none;
        }

        .input-field {
            font-weight: 500;
            padding: 0 10px;
            font-size: 17px;
            color: #333;
            background: transparent;
            transition: all .3s ease-in-out;
        }

        .input-field:focus {
            border: 2px solid rgb(89, 53, 180);
        }

        .input-field:focus~i {
            color: rgb(89, 53, 180);
        }

        .input-submit {
            margin-top: 20px;
            background: #1e263a;
            border: none;
            color: #fff;
            cursor: pointer;
            transition: all .3s ease-in-out;
        }

        .input-submit:hover {
            background: #122b71;
        }

        .bottom {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            margin-top: 25px;
        }

        .bottom span a {
            color: #727374;
            text-decoration: none;
        }

        .bottom span a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="box">
            <div class="header">
                <header><img src="{{ asset('image/logowikrama.png') }}" alt="wikrama"></header>
                <p>Log In to Rekapitulasi SMK Wikrama Bogor</p>
            </div>
            <form action="{{ route('login.auth') }}" method="POST">
                @csrf
                @if (Session::get('failed'))
                    <div class="alert alert-danger">{{ Session::get('failed') }}</div>
                @endif
                @if (Session::get('logout'))
                    <div class="alert alert-primary">{{ Session::get('logout') }}</div>
                @endif
                @if (Session::get('canAccess'))
                    <div class="alert alert-danger">{{ Session::get('canAccess') }}</div>
                @endif
                <div class="form-group input-box">
                    <label for="email">Email</label>
                    <input type="email" class="form-control input-field" id="email" name="email" required>
                    <i class="bx bx-envelope mt-2"></i>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group input-box">
                    <label for="pass">Password</label>
                    <input type="password" class="form-control input-field" id="pass" name="password" required>
                    <i class="bx bx-lock mt-2"></i>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group input-box">
                    <button type="submit" class="btn btn-primary input-submit">Login</button>
                </div>
            </form>
        </div>
        <div class="wrapper"></div>
    </div>

</body>

</html>
