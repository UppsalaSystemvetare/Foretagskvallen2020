<?php
include("include/html/default.php");
?>
    <body class="login-body">
    
        <div class="foretag-wrapper">
            <div class="container login-wrapper">
                <h1>Login</h1>
                    <div class="form-group">
                        <input id="NAME" type="email" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" placeholder="email">
                    </div>
                    <div class="form-group">
                        <input id="PASS" type="password" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" placeholder="password">  
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" value="Submit" onclick="login()">Logga in</button>
                    </div>
                </form> 
            </div>
        </div>
    </body>
    <script src="assets/js/login.js"></script>
</html>