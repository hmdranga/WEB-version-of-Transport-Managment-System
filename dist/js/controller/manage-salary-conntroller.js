$("#cmbDNIC").click(loadAllSalaries);
var countkm=0;

//
//
//
// function gettblval(){
//
//     // if($("#cmbDNIC :selected").text()==){
//     //
//     // }
//
//
//
//
// }
//

$(document).ready(getTotalKm);
function getTotalKm() {
    var sdate = $("#txtFromDate").val();
    var sid = $("#cmbDNIC").val();
    console.log("comes to get all function");
    var ajaxConfig = {
        method: "GET",
        url:"api/salaries.php?action=countKm&dateid="+sdate +"&nicid="+sid ,
        async: true
    };
    console.log(ajaxConfig);
    $.ajax(ajaxConfig).done(function (response) {
        response.forEach(function (kilo) {

            countkm=kilo.TOTAL;
            //tblkm=countkm;

            console.log(countkm);

        });

    });


}
var tblkm = countkm;


$(document).ready(loadAllSalaries);
$(document).ready(loadAllDNIC);

function loadAllSalaries(){

    var ajaxConfig = {
        method: "GET",
        url:"api/salaries.php?action=all",
        async: true
    };

    $.ajax(ajaxConfig).done(function(response){
        response.forEach(function (salary){
            var html = "<tr>" +
                "<td>" + salary.sId + "</td>" +
                "<td>" + salary.nic + "</td>" +
                "<td>" + salary.sDate + "</td>" +
                "<td>" + salary.amountPerKm + "</td>" +
                "<td>" + salary.totalKm + "</td>" +
                "<td>" + salary.earn + "</td>" +
                "<td>" + salary.bonus + "</td>" +
                "<td>" + salary.total + "</td>" +
                '<td class="recycle"><i class="fa fa-2x fa-trash"></i></td>' +
                "</tr>";

            $("#tblSalary tbody").append(html);

            $(".recycle").off();
            $(".recycle").click(function(){

                var salaryId = ($(this).parents("tr").find("td:first-child").text());

                if (confirm("Are you sure that you want to delete?")){

                    $.ajax({
                        method:"DELETE",
                        url:"api/salaries.php?id=" + salaryId,
                        async: true
                    }).done(function(response){
                        if (response){
                            alert("Salary record has been successfully deleted");
                            $("#tblSalary tbody tr").remove();
                            loadAllSalaries();
                        } else{
                            alert("Failed to delete the Salary Record");
                        }
                    });

                }

            });
        });
        
        response.forEach(function (dnic) {
           var nic=dnic.nic;

            if($("#cmbDNIC :selected").text()==nic){
                $("#tblSalary tbody tr").remove();

                var html = "<tr>" +
                    "<td>" + dnic.sId + "</td>" +
                    "<td>" + dnic.nic + "</td>" +
                    "<td>" + dnic.sDate + "</td>" +
                    "<td>" + dnic.amountPerKm + "</td>" +
                    "<td>" + dnic.totalKm + "</td>" +
                    "<td>" + dnic.earn + "</td>" +
                    "<td>" + dnic.bonus + "</td>" +
                    "<td>" + dnic.total + "</td>" +
                    '<td class="recycle"><i class="fa fa-2x fa-trash"></i></td>' +
                    "</tr>";

                $("#tblSalary tbody").append(html);



            }
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

            //var dName = driverID.nic;

            //console.log(dName);

            $("#cmbDNIC").click(function () {
                    // console.log(dName);

                    if ($("#cmbDNIC :selected").text()== driverID.nic){
                        //console.log(driverID.name);
                        $("#txtDName").val(driverID.name);

                    }

                }

            );

        });
    });
}



var addnew = false;
var update = false;

$("#btnAddNewSalary").click(addNewSalary);

function addNewSalary() {

    //console.log("clicked addnew button");
    addnew=true;
    update=false;
    $("#btnSaveSalary").text("Save New Payment");
    // $("#txtSalaryID").hide();
    // $("#lblSalaryId").hide();
    $("#txtFromDate").val(null);
    $("#cmbDNIC").val(null);
    $("#txtBonus").val(null);
    $("#txtDName").val(null);
    $("#txtAmountPerKm").val(null);
}
$(document).on("click","#tblSalary tbody tr", function () {
    addnew=false;
    update= true;
    $("#btnSaveSalary").text("Update Salary Record");
    $("#txtSalaryID").show();
    $("#txtSalaryID").val($(this).find("td:nth-child(1)").text());
    $("#txtFromDate").val($(this).find("td:nth-child(3)").text());
    $("#cmbDNIC").val($(this).find("td:nth-child(2)").text());
    $("#txtBonus").val($(this).find("td:nth-child(1)").text());
    $("#txtDName").val($(this).find("td:nth-child(1)").text());
    $("#txtAmountPerKm").val($(this).find("td:nth-child(4)").text());
});

$("#btnSaveSalary").click(saveSalary);

function saveSalary() {

    if(addnew == true) {   //when add new button clicked run the function related to add new
        getTotalKm();
        console.log (tblkm);

        var amountperkm = parseFloat($("#txtAmountPerKm").val());
        var bonus =parseFloat($("#txtBonus").val());


        var ajaxConfig = {
            method: "POST",
            url: "api/salaries.php",
            data:{

        //         $action = $_POST["action"];
        // $sId = $_POST["txtSalaryID"];
        // $sDate =$_POST["txtFromDate"];//2018-02-12; //
        // $totalKm = $_POST["totalkm"];
        // $bonus = $_POST["txtBonus"];
        // $amountPerKm = $_POST["txtAmountPerKm"];
        // $earn = $_POST["earn"];
        // $total = $_POST["txtTotal"];
        // $nic = $_POST["cmbDNIC"];


                totalkm:tblkm,
                earn:amountperkm*tblkm,
                total:(amountperkm*tblkm)+bonus,



            },
            //$("#salaryForm").serialize() + "&action=save",
            async: true
        }
        console.log(ajaxConfig);

        $.ajax(ajaxConfig).done(function (response) {

            console.log("aaaaaaaaaaaaaa"+response);
            if (response) {
                $("#tblSalary tbody tr").remove();
                loadAllSalaries();
            } else {
                alert("Failed to save the Salary Record");
            }
        });


    }else if(update == true){

        var ajaxConfig = {
            method:"POST",
            url:"api/salaries.php",
            data:$("#salaryForm").serialize()+ "&action=update",
            async:true
        }

        console.log(ajaxConfig);
        $.ajax(ajaxConfig).done(function (response) {
            if (response){
                $("#tblSalary tbody tr").remove();
                loadAllSalaries();
            }else{
                alert("Failed to update the Salary Record");
            }
        });


    }else{ // when somone didn't click add new button or related to do update function
        alert("if you want to :-" +

            "   Add new : click add new button," +

            "   Update  : select the existing row from table.");
    }
}
