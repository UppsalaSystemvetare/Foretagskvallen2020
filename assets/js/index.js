var nameinput;
var contbutton;
var name;

function init(){
    nameinput = $("#InputName"); //textfältet för namn
    contbutton = $("#contbutton"); //gå vidare-knappen
    name = "";  //namn-variabel till databasen och front-end
    displayname = $("#nametag").html();

    if(!displayname || displayname === 0){
        contbutton.prop("disabled", checkInputs()); //gå vidare-knappen låst som default
            
        $('#Modal').modal('hide'); //popup-fönstret visas om namn inte är satt
        
        $('#Modal').modal({
            keyboard: false
        });
    }
    
    $("#draggablePanelList").sortable();

}

// om 'Gå vidare'-knappen trycks in döljs fönstret, name-variabeln tilldelas värdet från textfältet, namnet visas för användaren.
$('#contbutton').click(function(){
    $('#Modal').modal('hide');
    name = $("#InputName").val();
    $('#nametag').html(name);
    SetNameSession(name);
})

//Varje knapptryck: kolla om gå vidare-knappen ska fortsätta vara låst med checkInputs()
$("#InputName").keyup(function(){
    contbutton.prop("disabled", checkInputs());
})

//False om följande är sant: (innehåller whitespace && första tecknet och sista tecknet är inte whitespace && textinput är längre än 5)
function checkInputs(){
        return !((/\s/.test(nameinput.val())) && 
                    !(/\s/.test(nameinput.val()[nameinput.val().length -1])) &&
                    !(/\s/.test(nameinput.val()[0])) &&
                    (nameinput.val().length > 5));
}

// Sätter session med användarens namn
function SetNameSession(nameval) {
    var payload = { name: nameval };
    $.post(
        "include/models/set_name.php",
        payload,
        function successLogin(data, status, xhr){
            // window.location.href = "index.php";
        }
    );
}

// uppdaterar använderens val av företag.
function updateUserChoice(){
    var payload = readFromList();
    $.post(
        "include/models/update_user_choices.php",
        payload,
        function successUpdate(data, status, xhr){
            if(status === "success"){
                $('#AlertModal').modal('show');
            }
        }
    );
}

// Läsar av ordningen från listan med företag.
function readFromList(){
    var nameval = $("#nametag").html();
    var ul = document.getElementById("draggablePanelList");
    var items = ul.getElementsByTagName("li");
    var choices = "";
    for (var i = 0; i < items.length; ++i) {
        choices += items[i].firstChild.id
    }
    return { name: nameval, order: choices };
}





