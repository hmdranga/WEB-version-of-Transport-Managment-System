$(document).ready(loadAllDrivers());

function loadAllDrivers(){

    var ajaxConfig = {
        method: "GET",
        url:"api/drivers.php?action=all",
        async: true
    };

    $.ajax(ajaxConfig).done(function(response){
        response.forEach(function (driver){
            var html = "<tr>" +
                "<td>" + driver.nic + "</td>" +
                "<td>" + driver.name + "</td>" +
                "<td>" + driver.address + "</td>" +
                "<td>" + driver.contactNo + "</td>" +
                "<td>" + driver.drivingLicenceNo + "</td>" +
                '<td class="recycle"><i class="fa fa-2x fa-trash"></i></td>' +
                "</tr>";

            $("#tblDriver tbody").append(html);

            $(".recycle").off();
            $(".recycle").click(function(){

                var driverNic = ($(this).parents("tr").find("td:first-child").text());

                if (confirm("Are you sure that you want to delete?")){

                    $.ajax({
                        method:"DELETE",
                        url:"api/drivers.php?id=" + driverNic,
                        async: true
                    }).done(function(response){
                        if (response){
                            alert("driver has been successfully deleted");
                            $("#tblDriver tbody tr").remove();

                            loadAllDrivers();
                        } else{
                            alert("Failed to delete the driver");
                        }
                    });
                }
            });
        });
    });
}

var addnew = false;
var update = false;

$("#btnAddNew").click(addNewDriver);

function addNewDriver() {
    console.log("clicked addnew button");
    addnew=true;
    update=false;
    $("#btnSaveDriver").text("Save New Driver");
    $("#txtNic").val(null);
    $("#txtDName").val(null);
    $("#txtAddress").val(null);
    $("#txtContactNo").val(null);
    $("#txtDLN").val(null);
}

$(document).on("click","#tblDriver tbody tr", function () {
    addnew=false;
    update= true;
    $("#btnSaveDriver").text("Update Driver");
    $("#txtNic").val($(this).find("td:nth-child(1)").text());
    $("#txtDName").val($(this).find("td:nth-child(2)").text());
    $("#txtAddress").val($(this).find("td:nth-child(3)").text());
    $("#txtContactNo").val($(this).find("td:nth-child(4)").text());
    $("#txtDLN").val($(this).find("td:nth-child(5)").text());

});


$("#btnSaveDriver").click(saveDriver);

function saveDriver() {
    if(addnew == true) {   //when add new button clicked run the function related to add new
        var ajaxConfig = {
            method: "POST",
            url: "api/drivers.php",
            data: $("#driverForm").serialize() + "&action=save",
            async: true
        }
        console.log(ajaxConfig);

        $.ajax(ajaxConfig).done(function (response) {
            if (response) {
                $("#tblDriver tbody tr").remove();
                loadAllDrivers();
            } else {
                alert("Failed to save the Driver");
            }
        })


    }else if(update == true){

        var ajaxConfig = {
            method:"POST",
            url:"api/drivers.php",
            data:$("#driverForm").serialize()+ "&action=update",
            async:true
        }
        console.log("update");
        console.log(ajaxConfig);
        $.ajax(ajaxConfig).done(function (response) {
            if (response){
                console.log(response);
                $("#tblDriver tbody tr").remove();
                loadAllDrivers();
            }else{
                alert("Failed to update the Driver");
            }
        });


    }else{ // when somone didn't click add new button or related to do update function
        alert("if you want to :-" +

            "   Add new : click add new button," +

            "   Update  : select the existing row from table.");
    }
}