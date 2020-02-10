function login(){
    var email = document.getElementById("NAME").value;
    var pass = document.getElementById("PASS").value;
    var payload = { email : email, password : pass };
    $.ajax({
        url: 'https://api.uppsalasystemvetare.se/api/login.php',
        dataType: 'json',
        type: 'post',
        data: payload,
        success: function successLogin(data, status, xhr){
            var payload = { ID : data.user_id, RANK : data.rank };
            $.ajax({
                url: 'include/models/login_process.php',
                dataType: 'json',
                type: 'post',
                data: payload
            });
        },
        error: failedLogin
    });
    setTimeout(function(){ window.location.href = "admin.php"; }, 500);
}

function failedLogin(){
    alert("Fel användarnamn eller lösenord");
}
