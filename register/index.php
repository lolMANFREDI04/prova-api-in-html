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
        <title>Registration</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="/css" href="style.css">
    </head>
    
    <body>
        
        <div id="form">
            <h1>Registration Form</h1>
            <form name="registerForm" action="register.php" onsubmit="return isValid()" method="POST">
                <label>Email: </label>
                <input type="email" id="email" name="email"></br></br>
                <label>Username: </label>
                <input type="text" id="username" name="username"></br></br>
                <label>Password: </label>
                <input type="password" id="pass" name="pass"></br></br>
                <label>Confirm Password: </label>
                <input type="password" id="confirmPass" name="confirmPass"></br></br>
                <input type="submit" id="btn" value="Register" name="submit"/>
            </form>
            <p>Already have an account? <a href="http://localhost/proviaml/login/index.php">Login here</a></p>
        </div>

        <script>
            function isValid(){
                var email = document.registerForm.email.value;
                var username= document.registerForm.username.value;
                var pass = document.registerForm.pass.value;
                var confirmPass = document.registerForm.confirmPass.value;

                if(email.length == "" || pass.length == "" || confirmPass.length == ""){
                    alert("Please fill in all fields!");
                    return false;
                }
                else if(email.length==""){
                    alert(" Email field is empty!!!");
                    return false;
                }
                else if(username.length==""){
                    alert(" Email field is empty!!!");
                    return false;
                }
                else if(pass.length==""){
                    alert(" Password field is empty!!!");
                    return false;
                }
                else if(pass != confirmPass){
                    alert("Passwords do not match!");
                    return false;
                }
                else if (pass.length < 8 || !/[A-Z]/.test(pass) || !/[a-z]/.test(pass) || !/\W/.test(pass)) {
                    alert("Password must be at least 8 characters long and contain uppercase, lowercase, and special characters!");
                    return false;
                }
            }
        </script>
    </body>
</html>
