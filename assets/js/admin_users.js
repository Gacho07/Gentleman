if (window.location.href == url + "index.php?page=users" || window.location.href == url + "index.php?page=users#") {
    $(document).ready(function () {
        printUsersTable()
    })

    function printUsersTable() {
        $.ajax({
            url: "models/users/get_all_users.php",
            method: "POST",
            dataType: "json",
            success: function (data) {
                makeUsersTable(data)
            },
            error: function (xhr, status, statusTxt) {
                console.log(xhr.status)
                console.log(xhr)
            }
        })
    }

    function makeUsersTable(data) {
        let html = ""
        let num = 1
        html = `
    <table class="table table-hover table-bordered table-striped">
        <thead>
            <th>Order <br/> Number</th>            
            <th>First Name</th>            
            <th>Last Name</th>            
            <th>Email</th>   
            <th>Role</th>                 
            <th>Registration Date</th>            
            <th>Setup</th>
        </thead>
        <tbody>`
        for (let i of data) {
            html += `
            <tr>
                <td>${num++}</td>
                <td>${i.first_name}</td>
                <td>${i.last_name}</td>
                <td>${i.email}</td>
                <td>${i.role_name}</td>
                <td>${i.registration_date}</td>
                <td>
                    <a href="#" class="btn btn-danger btn-delete-user" data-id="${i.user_id}">Delete</a>
                    <a href="#" class="btn btn-primary btn-update-user" data-id="${i.user_id}">Update</a>
                </td>
            </tr>
            `
        }
        `</tbody>
    </table>`
        $("#users-table").html(html)
    }

    $(".update-user").hide()

    $(document).on("click", ".btn-update-user", function (e) {
        e.preventDefault()
        $(".update-user").show(800)

        let id_user = $(this).data("id")

        $.ajax({
            url: "models/users/get_user.php",
            method: "POST",
            dataType: "json",
            data: {
                id: id_user
            },
            success: function (data) {
                $("#tbHiddenId").val(data.user_id)
                $("#tbFirstName").val(data.first_name)
                $("#tbLastName").val(data.last_name)
                $("#tbEmail").val(data.email)
                $("#ddlRole").val(data.role_id)
                let datetime_array = data.registration_date.split(" ")
                $("#tbRegDate").val(datetime_array[0])
            },
            error: function (xhr, status, statusTxt) {
                console.log(xhr)
                console.log(xhr.status)
            }
        })
    })

    $(document).on("click", ".btn-delete-user", function (e) {
        e.preventDefault()

        let id_user = $(this).data("id")

        $.ajax({
            url: "models/users/delete.php",
            method: "POST",
            dataType: "json",
            data: {
                id: id_user
            },
            success: function () {
                printUsersTable()
            },
            error: function (xhr, status, statusTxt) {
                console.log(xhr.status)
                console.log(xhr)
            }
        })
    })
}
