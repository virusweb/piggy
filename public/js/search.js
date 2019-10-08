$(document).ready(function() {
    $(".typeahead").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "../autocomplete",
                data: {
                    term: request.term
                },
                dataType: "json",
                success: function(data) {
                    var resp = $.map(data, function(obj) {
                        return obj.name;
                    });
                    response(resp);
                }
            });
        },
        minLength: 1
    });
});

function getAccount(bankid) {
  $.ajax({
    type:"POST",
    url: "../getaccountno",
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    data: {bank:bankid},
    success: function(result) {
      $('#acc').val(result);
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) { 
      swal("Error!", "Something went wrong", "error");
    }   
  });
}

$('.datetimepicker').datetimepicker({
    icons: {
        time: "fa fa-clock-o",
        date: "fa fa-calendar",
        up: "fa fa-chevron-up",
        down: "fa fa-chevron-down",
        previous: 'fa fa-chevron-left',
        next: 'fa fa-chevron-right',
        today: 'fa fa-screenshot',
        clear: 'fa fa-trash',
        close: 'fa fa-remove'
    }
});