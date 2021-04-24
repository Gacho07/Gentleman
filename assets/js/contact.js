$("#sendMessage").click(function () {
    let first_name = $("#userFirstName").val()
    let last_name = $("#userLastName").val()
    let email = $("#userEmail").val()
    let message = $("#userMessage").val()

    let reg_first_last_name = /^[A-ZŠĐČĆŽ][a-zšđčćž]{2,14}(\s[A-ZŠĐČĆŽ][a-zšđčćž]{2,14})*$/
    let reg_email = /^[\w]+[\w\d\.\_\-]*\@[\w]+(\.[\w]+)?(\.[a-z]{2,3})$/

    let errors = []

    if (!reg_first_last_name.test(first_name)) {
        errors.push("First name is not in good format.")
    }
    if (!reg_first_last_name.test(last_name)) {
        errors.push("Last name is not in good format.")
    }
    if (!reg_email.test(email)) {
        errors.push("Email must be in valid format.")
    }
    if (message == "") {
        errors.push("You must enter message.")
    }

    if (errors.length) {
        let print = "";
        for (let i = 0; i < errors.length; i++) {
            print += errors[i] + "<br/>"
        }
        $("#contact-validation").html(print)
    } else {
        $.ajax({
            url: "models/sending_email.php",
            method: "POST",
            data: {
                first_name: first_name,
                last_name: last_name,
                email: email,
                message: message,
                send: true
            },
            success: function (data, status, xhr) {
                if (xhr.status == 201) {
                    $("#userFirstName").val("")
                    $("#userLastName").val("")
                    $("#userEmail").val("")
                    $("#userMessage").val("")
                    $("#contact-validation").html("<h2>You have successfully send message.</h2>")
                }
            },
            error: function (xhr, status, statusTxt) {
                console.log(xhr.status)
                console.log(xhr)
            }
        })
    }
})