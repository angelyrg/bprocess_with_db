<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 404</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
        }
        .container{
            max-width: 1140px;
            margin-right: auto;
            margin-left: auto;
            padding-right: 15px;
            padding-left: 15px;
            box-sizing: border-box;
            overflow: hidden;
        }
        .container-404{
            width: 100%;
            height: 100vh;
            color: #434343;
        }

        .container-404 h1{
            font-size: 5em;
            color: #057689;
            font-weight: 800;
            margin-bottom: 1rem;
            text-transform: uppercase;
        }
        .container-404 h5{
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .btn-bitel{            
            transition: 0.5s;
            color: white;
            background: #057689;
            border-radius: 25px 25px 25px 0px !important;
            text-decoration: none;
            display: inline-block;
            font-weight: 400;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            border: 1px solid transparent;
            padding: 0.375rem 2rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #fff;
        }
        
        .btn-bitel:hover{
            background: white;
            border-color: #057689;
            color: #057689;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="container-404">
            <h1>404</h1>
            <h5>Page not found</h5>
            <p>The page you are looking for doesn't exist or an other error ocurred.</p>
            <p></p>
            <a href="/home" class="btn btn-bitel">Go back</a>    
        </div>
    </div>
</body>
</html>