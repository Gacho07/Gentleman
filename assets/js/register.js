$(document).ready(function () {
    $("#btnRegister").click(function () {
        let first_name = $("#tbFirstName").val()
        let last_name = $("#tbLastName").val()
        let email = $("#tbEmail").val()
        let password = $("#tbPassword").val()

        let reg_first_last_name = /^[A-ZŠĐČĆŽ][a-zšđčćž]{2,14}(\s[A-ZŠĐČĆŽ][a-zšđčćž]{2,14})*$/
        let reg_email = /^[\w]+[\w\d\.\_\-]*\@[\w]+(\.[\w]+)?(\.[a-z]{2,3})$/
        let reg_password = /^(?=.*[a-zšđčćž])(?=.*[A-ZŠĐČĆŽ])(?=.*\d).{8,32}$/

        let errors = []

        if (!reg_first_last_name.test(first_name)) {
            errors.push("First name is not in good format.")
        }
        if (!reg_first_last_name.test(last_name)) {
            errors.push("Last name is not in good format.")
        }
        if (!reg_email.test(email)) {
            errors.push("Email is not in good format.")
        }
        if (!reg_password.test(password)) {
            errors.push("Password is not in good format.")
        }

        if (errors.length) {
            let print = "<ol>"
            for (let error of errors) {
                print += `<li>${error}</li>`
            }
            print += "</ol>"
            $("#feedback").html(print)
        } else {
            $.ajax({
                url: "models/register.php",
                method: "POST",
                dataType: "json",
                data: {
                    first_name: first_name,
                    last_name: last_name,
                    email: email,
                    password: password,
                    send: true
                },
                success: function () {
                    $("#feedback").html("<h1 class='text-success'>Successfully registered!</h1>")
                },
                error: function (xhr, status, statusTxt) {
                    console.log(xhr.status)
                    console.log(xhr)
                    console.log(statusTxt)
                }
            })
        }
    })
})