$(document).ready(function() {
    $( ".typeahead" ).autocomplete({
        source: function(request, response) {
            $.ajax({
            url: "../autocomplete",
            data: {term : request.term},
            dataType: "json",
            success: function(data){
               var resp = $.map(data,function(obj){
                  return obj.name;
               }); 
              response(resp);
            }
        });
    },
    minLength: 1
 });
});