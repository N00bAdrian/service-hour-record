$(document).ready(function(){
  //$('.js-example-basic-single').select2();

  // $(document).getElementById("date").valueAsDate = new Date()

  //var $j = jQuery.noConflict();

  //$j( "#date" ).datepicker( "setDate", new Date());

  $("#submit").click(function(event){
    event.preventDefault();
    var app = $("#applicant").val();
    var date = $("#date").val();
    var hours = $("#hours").val();
    var docent = $("#docent").val();
    var errstring = "";
    var datearr = date.split("/");
    var checkdate = new Date(date);
    var today = new Date();
    

    $.ajax({
      url:"getsid.php",
      type: "POST",
      data: "id=testdata",
      dataType: 'json',
      cache: false,
      success: function(sid){
        var fdata=$("#input").serialize();

        /*console.log(app);
        console.log(date);
        console.log(hours);
        console.log(docent);*/

        if(app=="" || $.isNumeric(app) == true){
          errstring+="Enter a valid applicant\n";
        }

        if(date=="" || checkdate>today){
          errstring+="Enter a valid date\n";
        }

        if(hours=="" || $.isNumeric(hours) == false){
          errstring+="Enter a valid number of hours\n";
        }

        if($.inArray(docent,sid) == -1){
          errstring += "Enter the correct id\n";
        }

        if(errstring==""){
          $.ajax({
            url:"submit.php",
            method: "POST",
            data: fdata,
            success:function(result){
              $('#recent')[0].contentWindow.location.reload(true);
              $('#person')[0].contentWindow.location.reload(true);
              return false;
              $('#docent').val.select();
            },
            fail:function(result){
              alert("Fail");
            }
          });
        }else{
          errstring = "You have the following errors:\n"+errstring;
          alert(errstring);
        }
        
            
        
      },
      fail: function(sid){
        alert("Error fetching sid");
      }
    });

  });

  $(".clear").click(function(){
    var dataString = "rid=" + $(this).attr("value");
    //console.log(dataString);

    $.ajax({
      type:"POST",
      url:"clear.php",
      data:dataString,
      success:function(result){
        location.reload(true);
        return false;
      }


    });
  });

  $('#exportall').click(function(){
    window.location = "exportall.php";
    });

  $('#exporttotal').click(function(){
    window.location = "exporttotal.php";
    });

  $('#exportmvmt').click(function(){
    window.location= "exportmvmt.php";
  });

  $("#bronze").click(function(){
    $("#mvmttable").src = "bronze.php";
  });

  $("#silver").click(function(e){
    e.preventDefault();

    $('#mvmttable').attr("src",$(this).attr("value"));
  });

  $("#gold").click(function(){
    $("#mvmttable").src="gold.php";
  });

  $("#exportbronze").click(function(){
    window.location = "exportbronze.php";
  });

  $("#exportsilver").click(function(){
    window.location = "exportsilver.php";
  });

  $("#exportsilver").click(function(){
    window.location = "exportgold.php";
  });
});
