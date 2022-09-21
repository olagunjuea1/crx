$(document).ready(function() {
    $(".input_checkbox").click(function() {
        var checkBoxes = $(this).prev("input[type='checkbox']");
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
        
        var inputid = $(this).prev("input[type='checkbox']").attr("id"); 
        var filterinpid = inputid.replace("activityLog", '');
        if ($(this).prev("input[type='checkbox']").is(":checked")) {
          var val = 'active';
        }
        else{
          var val = 'inactive';
        }
        $.ajax({
          url: "inc/__function.php",
          method: "POST",
          beforeSend: function () {
            $("#loader_checker").removeClass("hiddenX");
          },
          complete: function () {
            $("#loader_checker").addClass("hiddenX");
          },
          data: {'settings':'settings', filterinpid, val},
          success: function (e) {
            console.log(e)
          }
        });
    });               
});