



function getUsers() {
    $.ajax({
        type: 'GET', //Obtiene los atletas por rama
        url: '/contract/users',
        success: function(data) {

            $("input.child").toArray().forEach(element => {
                autocomplete(document.getElementById("myInput"), data);
            });

        },
        error: function() {
            console.log(data);
        }
    });
}

