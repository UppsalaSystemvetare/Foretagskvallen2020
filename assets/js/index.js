jQuery(function($) {

    /*
    
    Implementerad funktionalitet:
    1.  En välkomst-"overlay" i form av en 'modal' från bootstrap som visar ett välkomstmeddelande
        och promptar användaren att fylla i namn. Kan ej klickas ner utan att ange giltigt namn.

    2. Namnet visas högst upp.

    3. En sorterbar draggable med index för respektive företag
    
    
    Att göra:
        Php-sessions: Kom ihåg namnet och hindra popupen från att dyka upp vid refresh.
        Exportera den valda listordningen till databasen
    */



    
    
    
    var nameinput = $("#InputName"); //textfältet för namn
    var contbutton = $("#contbutton"); //gå vidare-knappen
    var name = "";  //namn-variabel till databasen och front-end
    
    contbutton.prop("disabled", checkInputs()); //gå vidare-knappen låst som default
    $('#Modal').modal('show'); //popup-fönstret visas som default,

    $('#Modal').modal({
        keyboard: false
      })


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
 
    // om 'Gå vidare'-knappen trycks in döljs fönstret, name-variabeln tilldelas värdet från textfältet, namnet visas för användaren.
    $('#contbutton').click(function(){
        $('#Modal').modal('hide');
        name = $("#InputName").val();
        $('#nametag').html(name);

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

});







