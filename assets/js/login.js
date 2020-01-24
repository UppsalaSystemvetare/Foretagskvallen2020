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
            window.location.href = "admin.php";
        },
        error: failedLogin
    });
}

function successLogin(data, status, xhr){
    alert(status);
    alert(data);
    var payload = { ID : "1"};
    $.ajax({
        url: '../include/models/login_process.php',
        dataType: 'json',
        type: 'post',
        data: payload
    });
}

function failedLogin(){
    alert("Fel användarnamn eller lösenord");
}