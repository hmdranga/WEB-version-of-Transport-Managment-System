$(document).ready(loadAllTrips());
$(document).ready(loadAllDNIC());
$(document).ready(loadAllRegNo());
function loadAllTrips(){

    var ajaxConfig = {
        method: "GET",
        url:"api/trips.php?action=all",
        async: true
    };

    $.ajax(ajaxConfig).done(function(response){
        response.forEach(function (trip){
            var html = "<tr>" +
                "<td>" + trip.id + "</td>" +
                "<td>" + trip.date + "</td>" +
                "<td>" + trip.start + "</td>" +
                "<td>" + trip.end + "</td>" +
                "<td>" + trip.nic + "</td>" +
                "<td>" + trip.regNo + "</td>" +
                '<td class="recycle"><i class="fa fa-2x fa-trash"></i></td>' +
                "</tr>";

            $("#tblTrip tbody").append(html);

            $(".recycle").off();
            $(".recycle").click(function(){

                var tripID = ($(this).parents("tr").find("td:first-child").text());

                if (confirm("Are you sure that you want to delete?")){

                    $.ajax({
                        method:"DELETE",
                        url:"api/trips.php?id=" + tripID,
                        async: true
                    }).done(function(response){
                        if (response){
                            alert("Trip has been successfully deleted");
                            $("#tblTrip tbody tr").remove();

                            loadAllTrips();
                        } else{
                            alert("Failed to delete the trip");
                        }
                    });
                }
            });
        });
    });
}


function loadAllDNIC() {
    var ajaxConfig = {
        method: "GET",
        url:"api/drivers.php?action=all",
        async: true
    };

    $.ajax(ajaxConfig).done(function(response){
        response.forEach(function (driverID) {
                var html =
                    '<option value="' + driverID.nic + '">' + driverID.nic + '</option>';
                $("#cmbDNIC").append(html);

                var dName = driverID.nic;

              //console.log(dName);

                $("#cmbDNIC").click(function () {
                   // console.log(dName);

                    if ($("#cmbDNIC :selected").text()==dName ){
                        // console.log(driverID.name);
                        $("#txtDName").val(driverID.name);

                    }

                    }

            );

        });
    });
}


function loadAllRegNo() {
    var ajaxConfig = {
        method: "GET",
        url:"api/vehicle.php?action=all",
        async: true
    };

    $.ajax(ajaxConfig).done(function(response){
        response.forEach(function (vehicleReg) {
            var html=
                '<option value="'+vehicleReg.regNo+'">'+ vehicleReg.regNo+'</option>';
            $("#cmbRegNo").append(html);

        });
    });
}


var addnew = false;
var update = false;

$("#btnAddNewTrip").click(addNewTrip);

function addNewTrip() {
    // console.log("clicked addnew button");
    // $("#lblTripId").hide();
    // $("#txtTripID").hide();
    addnew=true;
    update=false;
    $("#btnSaveTrip").text("Save New Trip");
    $("#txtTripID").val(null);
    $("#txtTripDate").val(null);
    $("#cmbDNIC").val(null);
    $("#txtDName").val(null);
    $("#cmbRegNo").val(null);
    $("#txtStartKm").val(null);
    $("#txtEndKm").val(null);
}
//when table row clicked fill the fields and update variable true
$(document).on("click","#tblTrip tbody tr", function (){
    // $("#lblTripId").show();
    // $("#txtTripID").show();
    addnew=false;
    update= true;
    $("#btnSaveTrip").text("Update Trip");
    $("#txtTripID").val($(this).find("td:nth-child(1)").text());
    $("#txtTripDate").val($(this).find("td:nth-child(2)").text());
    $("#txtStartKm").val($(this).find("td:nth-child(3)").text());
    $("#txtEndKm").val($(this).find("td:nth-child(4)").text());
    $("#cmbDNIC").val($(this).find("td:nth-child(5)").text());
    $("#cmbRegNo").val($(this).find("td:nth-child(6)").text());


});


$("#btnSaveTrip").click(function () {
    //console.log("clicked ");
    saveTrip();
});

function saveTrip() {

    if(addnew == true) {   //when add new button clicked run the function related to add new
        var ajaxConfig = {
            method: "POST",
            url: "api/trips.php",
            data: $("#tripForm").serialize() + "&action=save",
            async: true
        }
        // console.log(ajaxConfig);


        $.ajax(ajaxConfig).done(function (response) {
            //console.log("ddddddddddddddddd "+response);
            if (response) {

                $("#tblTrip tbody tr").remove();
                loadAllTrips();
            } else {
                alert("Failed to save the Trip");
            }
        });


    }else if(update == true){
            console.log("update 1ta aawa")
        var ajaxConfig = {
            method:"POST",
            url:"api/trips.php",
            data:$("#tripForm").serialize()+ "&action=update",
            async:true
        }
        //console.log("update true");
      // console.log(ajaxConfig);

        $.ajax(ajaxConfig).done(function (response) {

            if (response){
                console.log("update 1 thue nam");
                $("#tblTrip tbody tr").remove();
                loadAllTrips();
            }else{
                alert("Failed to update the Trip");
            }
        });


    }else{ // when somone didn't click add new button or related to do update function
        alert("if you want to :-" +

            "   Add new : click add new button," +

            "   Update  : select the existing row from table.");
    }
}