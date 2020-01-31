var nameinput;
var contbutton;
var name;

function checkPopup(){
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
}

jQuery(function($) {
    var panelList = $('#draggablePanelList');
    panelList.sortable({
        // Only make the .panel-heading child elements support dragging.
        // Omit this to make then entire <li>...</li> draggable.
        handle: '.panel-heading', 
        update: function() {
            $('.panel', panelList).each(function(index, elem) {
                var $listItem = $(elem),
                    newIndex = $listItem.index();

                // Persist the new indices.
            });
        }
    });
});


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

function HideNamePopUp(){
    $('#Modal').modal('hide'); 
}







