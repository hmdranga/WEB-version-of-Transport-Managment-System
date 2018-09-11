$(document).ready(loadAllVehicles);

function loadAllVehicles(){

    var ajaxConfig = {
        method: "GET",
        url:"api/vehicle.php?action=all",
        async: true
    };

    $.ajax(ajaxConfig).done(function(response){
        response.forEach(function (vehicle){
            var html = "<tr>" +
                "<td>" + vehicle.regNo + "</td>" +
                "<td>" + vehicle.brand + "</td>" +
                "<td>" + vehicle.colour + "</td>" +
                "<td>" + vehicle.boughtDate + "</td>" +
                '<td class="recycle"><i class="fa fa-2x fa-trash"></i></td>' +
                "</tr>";

            $("#tblVehicle tbody").append(html);

            $(".recycle").off();
            $(".recycle").click(function(){

                var vehicleRegNo = ($(this).parents("tr").find("td:first-child").text());

                if (confirm("Are you sure that you want to delete?")){

                    $.ajax({
                        method:"DELETE",
                        url:"api/vehicle.php?id=" + vehicleRegNo,
                        async: true
                    }).done(function(response){
                       if (response){
                           alert("vehicle has been successfully deleted");
                           $("#tblVehicle tbody tr").remove();
                           loadAllVehicles();
                       } else{
                           alert("Failed to delete the vehicle");
                       }
                    });

                }

            });
       });
    });
}

var addnew = false;
var update = false;

$("#btnAddNew").click(addNewVehicle);

function addNewVehicle() {
    console.log("clicked addnew button");
    addnew=true;
    update=false;
    $("#btnSaveVehicle").text("Save New Vehicle");
    $("#txtRegNo").val(null);
    $("#txtBrand").val(null);
    $("#color").val("Select Color");
    $("#txtDate").val(null);
}
$(document).on("click","#tblVehicle tbody tr", function () {
    addnew=false;
    update= true;
    $("#btnSaveVehicle").text("Update Vehicle");
    $("#txtRegNo").val($(this).find("td:nth-child(1)").text());
    $("#txtBrand").val($(this).find("td:nth-child(2)").text());
    $("#color").val($(this).find("td:nth-child(3)").text());
    $("#txtDate").val($(this).find("td:nth-child(4)").text());

});

$("#btnSaveVehicle").click(saveVehicle);

function saveVehicle() {
    if(addnew == true) {   //when add new button clicked run the function related to add new
        var ajaxConfig = {
            method: "POST",
            url: "api/vehicle.php",
            data: $("#vehicleForm").serialize() + "&action=save",
            async: true
        }
        console.log(ajaxConfig);

        $.ajax(ajaxConfig).done(function (response) {
            if (response) {
                $("#tblVehicle tbody tr").remove();
                loadAllVehicles();
            } else {
                alert("Failed to save the Vehicle");
            }
        })


    }else if(update == true){

        var ajaxConfig = {
            method:"POST",
            url:"api/vehicle.php",
            data:$("#vehicleForm").serialize()+ "&action=update",
            async:true
        }

        console.log(ajaxConfig);
        $.ajax(ajaxConfig).done(function (response) {
            if (response){
                $("#tblVehicle tbody tr").remove();
                loadAllVehicles();
            }else{
                alert("Failed to update the Vehicle");
            }
        })


    }else{ // when somone didn't click add new button or related to do update function
        alert("if you want to :-" +

            "   Add new : click add new button," +

            "   Update  : select the existing row from table.");
    }
}



