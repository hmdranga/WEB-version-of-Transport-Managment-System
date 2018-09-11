$(document).ready(loadAllExpenses);
$(document).ready(loadAllRegNo);
$(document).ready(loadAllTyps);

function loadAllExpenses(){

    var ajaxConfig = {
        method: "GET",
        url:"api/expense.php?action=all",
        async: true
    };

    $.ajax(ajaxConfig).done(function(response){
        response.forEach(function (expense){
            var html = "<tr>" +
                "<td>" + expense.regNo + "</td>" +
                "<td>" + expense.date+ "</td>" +
                "<td>" + expense.exId + "</td>" +
                "<td>" + expense.amount + "</td>" +
                "<td>" + expense.description + "</td>" +
                '<td class="recycle"><i class="fa fa-2x fa-trash"></i></td>' +
                "</tr>";

            $("#tblExpenses tbody").append(html);

            $(".recycle").off();
            $(".recycle").click(function(){

                var vehicleRegNo = ($(this).parents("tr").find("td:first-child").text());
                var exId = ($(this).parents("tr").find("td:nth-child(3)").text());

                if (confirm("Are you sure that you want to delete?")){

                    $.ajax({
                        method:"DELETE",
                        url:"api/expense.php?id=" + vehicleRegNo + "&exid=" + exId,
                        async: true
                    }).done(function(response){
                        if (response){
                            alert("expense has been successfully deleted");
                            $("#tblExpenses tbody tr").remove();
                            loadAllExpenses();
                        } else{
                            alert("Failed to delete the expense");
                        }
                    });

                }

            });
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

function loadAllTyps() {
    var ajaxConfig = {
        method: "GET",
        url:"api/expenceTypes.php?action=all",
        async: true
    };

    $.ajax(ajaxConfig).done(function(response){
        response.forEach(function (typeId) {
            var html =
                '<option value="' + typeId.exId + '">' + typeId.exId + '</option>';
            $("#cmbTypeId").append(html);

            var exID = typeId.exId;

            //console.log(dName);

            $("#cmbTypeId").click(function () {
                    // console.log(dName);

                    if ($("#cmbTypeId :selected").text()==exID ){
                        console.log(typeId.type);
                        $("#txtType").val(typeId.type);

                    }

                }

            );

        });
    });
}





var addnew = false;
var update = false;

$("#btnAddNewExpense").click(addNewExpense);

function addNewExpense() {
    console.log("clicked addnew expense button");
    addnew=true;
    update=false;
    $("#btnSaveExpense").text("Save New Expense");
    $("#txtExpenseDate").val(null);
    $("#txtDescription").val(null);
    $("#cmbRegNo").val(null);
    $("#txtAmount").val(null);
    $("#cmbTypeId").val(null);
    $("#txtType").val(null);
}

$(document).on("click","#tblExpenses tbody tr", function () {
    addnew=false;
    update= true;
    $("#btnSaveExpense").text("Update Expense");
    $("#cmbRegNo").val($(this).find("td:nth-child(1)").text());
    $("#txtExpenseDate").val($(this).find("td:nth-child(2)").text());
    $("#cmbTypeId").val($(this).find("td:nth-child(3)").text());
    $("#txtAmount").val($(this).find("td:nth-child(4)").text());
    $("#txtDescription").val($(this).find("td:nth-child(5)").text());

});


$("#btnSaveExpense").click(saveExpense);

function saveExpense() {
    if(addnew == true) {   //when add new button clicked run the function related to add new
        var ajaxConfig = {
            method: "POST",
            url: "api/expense.php",
            data: $("#tblExpenses").serialize() + "&action=save",
            async: true
        }
        console.log(ajaxConfig);

        $.ajax(ajaxConfig).done(function (response) {
            if (response) {
                $("#tblExpenses tbody tr").remove();
                loadAllExpenses();
            } else {
                alert("Failed to save the Expense");
            }
        })


    }else if(update == true){

        var ajaxConfig = {
            method:"POST",
            url:"api/expense.php",
            data:$("#tblExpenses").serialize()+ "&action=update",
            async:true
        }
        console.log("update");
        console.log(ajaxConfig);
        $.ajax(ajaxConfig).done(function (response) {
            if (response){
                console.log(response);
                $("#tblExpenses tbody tr").remove();
                loadAllExpenses();
            }else{
                alert("Failed to update the Expense");
            }
        });


    }else{ // when somone didn't click add new button or related to do update function
        alert("if you want to :-" +

            "   Add new : click add new button," +

            "   Update  : select the existing row from table.");
    }
}