'use strict';

$(document).ready(function () {
    $(document).on("click", ".edit",function () {
        var userId = $(this).data("id");
        $.ajax({
            type: "POST",
            method: "POST",
            url: "../../private/admin_process.php",
            data: {
                userId: userId,
                submit: "getEditModal"
            },
            success: function (data) {
                $(".modal-body").empty();
                var ACCEPTED="", BLOCKED="";
                console.log(data['status']);
                if (data['status'] == 'ACCEPTED'){ACCEPTED = "selected";}
                else{BLOCKED = "selected";}
                $(".modal-body").append("<form><input id='nameInput' type=\"text\" value='" + data['name'] + "' class=\"form-control\"><br>" +
                    "<input id='idInput' type=\"hidden\" value='" + data['id'] + "' class=\"form-control\">" +
                    "<input id='emailInput' type=\"text\" value='" + data['email'] + "' class=\"form-control\"><br>" +
                    "<input id='phone_numberInput' type=\"text\" value='" + data['phone_number'] + "' class=\"form-control\"><br>" +
                    "<input id='birthdateInput' type=\"date\" value='" + data['birthdate'] + "' class=\"form-control\"><br>" +
                    "<select id='status' class='form-control'>" +
                    "<option value='ACCEPTED'" + ACCEPTED + ">ACCEPTED</option>" +
                    "<option value='BLOCKED' " + BLOCKED + ">BLOCKED</option>" +
                    "</select></form>");
                $("#exampleModal").modal('show');

            }

        });
    });

    var deletedId;

    $(document).on("click", ".delete",function () {
        $("#exampleModal").modal('show');
        $(".modal-body").html('you sure?');
        $('#exampleModalLabel').text("Delete User");
        $('#saveChanges').css('display' , 'none');
        $('#delete').css('display' , 'block');
        deletedId = $(this).data("id");
    });

    $(document).on("click", "#delete", function () {
        $.ajax({
            type: "POST",
            method: "POST",
            url: "../../private/admin_process.php",
            data: {
                deletedId: deletedId,
                submit: "deleteUser"
            },
            success: function (data) {
                succFun();
            }
        })

    });
    $(document).on("click", "#saveChanges", function () {
        var id = $("#idInput").val(),
            name = $("#nameInput").val(),
            email = $("#emailInput").val(),
            phone_number = $("#phone_numberInput").val(),
            birthdate = $("#birthdateInput").val(),
            status = $("#status").val();
        $.ajax({
            type: "POST",
            method: "POST",
            url: "../../private/admin_process.php",
            data: {
                id: id,
                name: name,
                email: email,
                phone_number: phone_number,
                birthdate: birthdate,
                status: status,
                submit: "updateUser"
            },
            success: function (data) {
                succFun();
            }
        });


    });
    function succFun() {
        $("#exampleModal").modal('hide');
        $("#exampleModal").removeClass('fade');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
        $('#freshItems').load(window.location.href + " #freshItems");
        $("body").css('padding-right' , '0px');
    }



    /*****************************************/



    var start = 0,
        entries = 10,
        sortingBy = "id",
        sortingType = "ASC",
        statusFilter = "all",
        searchFilter = "",
        count,
        totalRecords = $("#totalRecords").val();


    function ajaxRequest() {

        $.ajax({
            type: "POST",
            method: "POST",
            url: "../../private/admin_process.php",
            data: {
                start: start,
                entries: entries,
                sortingBy: sortingBy,
                sortingType: sortingType,
                statusFilter: statusFilter,
                searchFilter: searchFilter,
                submit: "filters"
            },
            success: function (data) {

                count = (data.match(/<tr>/g) || []).length;
                if (parseInt(count) < 1){
                    //start = start - entries;
                    return false
                } else {
                    $('tbody').empty();
                    $("#tableData").html(data)
                }
            }
        })
    }

    /**************** pagination ******************/
    $("#searchInput").keyup(function () {
        $('tbody').empty();
        searchFilter = $("#searchInput").val();
        ajaxRequest();
    });

    $("#id, #name, #birthdate").on("click", function () {
        $("th").css("color", "white");
        $(this).css('color', "red");
        sortingBy = $(this).text();
        ajaxRequest();
    });
    $(".fa-arrow-up, .fa-arrow-down").on("click", function () {
        if ($(this).css('font-size') == "40px"){
            return false;
        } else {
            $(".fa-arrow-up, .fa-arrow-down").css({
                'font-size': "16px",
                "color": "black"
            });
            $(this).css({
                'font-size': "40px",
                "color": "red"
            });
        }

        sortingType = $(this).hasClass('fa-arrow-up') == true ? 'ASC' : 'DESC';
        ajaxRequest();
    });

    $("#entries, #statusFilter").on("change", function () {
        start = 0,
        entries = $("#entries").val() == "all" ? totalRecords : $("#entries").val(),
        statusFilter = $("#statusFilter").val();
        ajaxRequest();
    });

    $(".pagination li.next-page , .pagination li.pre-page").on("click", function () {

        entries = parseInt($("#entries").val());
        if ($(this).hasClass('next-page'))
        {
            if (count < 1){
                return false;
            }
            start = start + entries;
        } else {
            if ((start-entries) < 0){
                return false;
            }
            start = start - entries;
        }
        ajaxRequest()
    });




});
