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

$(function () {
    $('#start_date').datetimepicker({
      format: 'DD/MM/YYYY',
      maxDate : new Date(),
      icons: {
        next: "fa fa-chevron-right",
        previous: "fa fa-chevron-left"
      }
    });

    $('#end_date').datetimepicker({
      format: 'DD/MM/YYYY',
      icons: {
        next: "fa fa-chevron-right",
        previous: "fa fa-chevron-left"
      }
    });
});

function setMindate(value) {
  var from = value.split("/");
  var f = new Date( parseInt(from[2]) + 1, from[1] - 1, from[0])
  $("#end_date").datetimepicker("minDate",f); 
}

function getMatrityAmount(){
  var amount = $("#input-amount").val();
  
  var startdate = $("#start_date").val().split('/');
      newstartdate = startdate[0]+"-"+startdate[1]+"-"+startdate[2];
      newstartdate = new Date(startdate[1]+"-"+startdate[0]+"-"+startdate[2]);

  var enddate = $("#end_date").val().split('/');
      newenddate = enddate[0]+"-"+enddate[1]+"-"+enddate[2];
      newenddate = new Date(enddate[1]+"-"+enddate[0]+"-"+enddate[2]);

  var intrest = Number($("#intrest-rate").val());

  // get differences in units
  var seconds = Math.floor((newenddate - newstartdate)/1000);
  var minutes = Math.floor(seconds/60);
  var hours = Math.floor(minutes/60);
  var days = Math.floor(hours/24);
  var years = Number(Math.floor(days/365));

  if(years > 0)  
  var maturityamount = (((amount/100)*intrest) * years);

  if(maturityamount){
    var total = Number(maturityamount)+ Number(amount);
    $("#maturity_amount").val(total);
  }
}

function getConfirm() {
  swal({
      title: 'Are you sure want to delete ?', 
      dangerMode: true,
      buttons: true,
    }).then((isConfirm) => {
        $('#deleteFD').submit();
    })
}