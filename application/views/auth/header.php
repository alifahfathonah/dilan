<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>D I L A N</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url('asset'); ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('asset'); ?>/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
            background: url(<?php echo base_url() . 'asset/dist/img/image.jpg'; ?>);
            background-size: cover;
            background-position: center;
            font-family: sans-serif;
        }

        .login-box {
            width: 320px;
            height: 360px;
            background: rgba(0, 0, 0, 0.5);
            color: #fff;
            top: 50%;
            left: 50%;
            position: absolute;
            transform: translate(-50%, -50%);
            box-sizing: border-box;
            padding: 15px 10px;
            border-radius: 5%;

        }

        .avatar {
            width: 100px;
            height: 100px;
            border-radius: 15%;
            position: absolute;
            top: -110px;
            left: calc(50% - 50px);
        }

        h1 {
            margin: 0;
            padding: 0 0 20px;
            text-align: center;
            font-size: 22px;
        }

        .login-box p {
            margin: 0;
            padding: 0;
            font-weight: bold;
        }

        .login-box input {
            width: 100%;
            margin-bottom: 20px;
        }

        .login-box input[type="email"],
        input[type="password"] {
            border: none;
            border-bottom: 1px solid #fff;
            background: transparent;
            outline: none;
            height: 40px;
            color: #fff;
            font-size: 16px;
        }

        .login-box input[type="submit"] {
            border: none;
            outline: none;
            height: 40px;
            background: #1c8adb;
            color: #fff;
            font-size: 18px;
            border-radius: 20px;
        }

        .login-box input[type="submit"]:hover {
            cursor: pointer;
            background: #39dc79;
            color: #000;
        }

        .login-box a {
            text-decoration: none;
            font-size: 14px;
            color: #fff;
        }

        .login-box a:hover {
            color: #39dc79;
        }
    </style>
</head>