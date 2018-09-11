$(document).ready(loadAllExpenceType());

function loadAllExpenceType(){

    var ajaxConfig = {
        method: "GET",
        url:"api/expenceTypes.php?action=all",
        async: true
    };

    $.ajax(ajaxConfig).done(function(response){
        response.forEach(function (type){
            var html = "<tr>" +
                "<td>" + type.exId + "</td>" +
                "<td>" + type.type + "</td>" +
                '<td class="recycle"><i class="fa fa-2x fa-trash"></i></td>' +
                "</tr>";

            $("#tblExpenceType tbody").append(html);

            $(".recycle").off();
            $(".recycle").click(function(){

                var typeid = ($(this).parents("tr").find("td:first-child").text());

                if (confirm("Are you sure that you want to delete?")){

                    $.ajax({
                        method:"DELETE",
                        url:"api/expenceTypes.php?id=" + typeid,
                        async: true
                    }).done(function(response){
                        if (response){
                            alert("type has been successfully deleted");
                            $("#tblExpenceType tbody tr").remove();

                            loadAllExpenceType();
                        } else{
                            alert("Failed to delete the expense type");
                        }
                    });
                }
            });
        });
    });
}


$("#btnSaveExpenceType").click(saveExpenceType);

function saveExpenceType() {
    //when add new button clicked run the function related to add new
    var ajaxConfig = {
        method: "POST",
        url: "api/expenceTypes.php",
        data: $("#expenceTypeForm").serialize() + "&action=save",
        async: true
    }
    //console.log(ajaxConfig);

    $.ajax(ajaxConfig).done(function (response) {
        if (response) {
            $("#tblExpenceType tbody tr").remove();
            loadAllExpenceType();
        } else {
            alert("Failed to save the Expense Type");
        }
    });
}








// var addnew = false;
// var update = false;
//
// $("#btnAddNew").click(addNewDriver);
//
// function addNewDriver() {
//     console.log("clicked addnew button");
//     addnew = true;
//     update = false;
// }




//
// $("#btnSaveDriver").click(saveDriver);
//
// function saveDriver() {
//     if(addnew == true) {   //when add new button clicked run the function related to add new
//         var ajaxConfig = {
//             method: "POST",
//             url: "api/expenceTypes.php",
//             data: $("#expenceTypeForm").serialize() + "&action=save",
//             async: true
//         }
//         console.log(ajaxConfig);
//
//         $.ajax(ajaxConfig).done(function (response) {
//             if (response) {
//                 $("#tblExpenceType tbody tr").remove();
//                 loadAllExpenceType();
//             } else {
//                 alert("Failed to save the Expense Type");
//             }
//         });
//
//
//     }else if(update == true){
//
//         var ajaxConfig = {
//             method:"POST",
//             url:"api/drivers.php",
//             data:$("#driverForm").serialize()+ "&action=update",
//             async:true
//         }
//         console.log("update");
//         console.log(ajaxConfig);
//         $.ajax(ajaxConfig).done(function (response) {
//             if (response){
//                 console.log(response);
//                 $("#tblDriver tbody tr").remove();
//                 loadAllDrivers();
//             }else{
//                 alert("Failed to update the Driver");
//             }
//         });
//
//
//     }else{ // when somone didn't click add new button or related to do update function
//         alert("if you want to :-" +
//
//             "   Add new : click add new button," +
//
//             "   Update  : select the existing row from table.");
//     }
// }