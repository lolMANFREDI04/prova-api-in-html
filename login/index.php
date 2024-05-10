<?php 
    include("connection.php");
    include("login.php")
?>
    
<html>
    <style>
        body{
            background-color: blueviolet;
        }

        #form{
            background-color: rgb(255, 255, 255);
            width:25%;
            border-radius: 4px;
            margin:120px auto;
            padding:50px;
            box-shadow: 10px 10px 5px rgb(82, 11, 77);
        }

        #btn{
            color:rgb(255, 255, 255);
            background-color: rgb(108, 22, 189);
            padding:10px;
            font-size: large;
            border-radius: 10px;
        }

        @media screen and (max-width: 570px) {
            #form {
            width: 65%;
            margin-left:none;
            padding:40px;
            }
        }
    </style>
    <head>
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="/css" href="style.css">
    </head>
    
    <body>
        
        <div id="form">
            <h1>Login Form</h1>
            <form name="form" action="login.php" onsubmit="return isvalid()" method="POST">
                <label>Email: </label>
                <input type="text" id="email" name="email"></br></br>
                <label>Password: </label>
                <input type="password" id="pass" name="pass"></br></br>
                <input type="submit" id="btn" value="Login" name = "submit"/>
            </form>
            <p>Don't have an account? <a href="http://localhost/proviaml/register/index.php">Register here</a></p>
        </div>
        <script>
            function isvalid(){
                var email = document.form.email.value;
                var pass = document.form.pass.value;
                if(email.length=="" && pass.length==""){
                    alert(" Email and password field is empty!!!");
                    return false;
                }
                else if(email.length==""){
                    alert(" Email field is empty!!!");
                    return false;
                }
                else if(pass.length==""){
                    alert(" Password field is empty!!!");
                    return false;
                }
                
            }
        </script>
    </body>
</html>