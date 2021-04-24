$(document).ready(function() {
    checkInputs()
})

function checkInputs() {
    $("#email").blur(checkEmail)
    $("#email").addClass("css-border")
    $("#password").blur(checkPassword)
    $("#password").addClass("css-border")

    let reg_email = /^[\w]+[\w\d\.\_\-]*\@[\w]+(\.[\w]+)?(\.[a-z]{2,3})$/
    let reg_password = /^(?=.*[a-zšđčćž])(?=.*[A-ZŠĐČĆŽ])(?=.*\d).{8,32}$/

    function checkEmail() {
        let btn = $("#btnLogin")
        let email = $("#email").val()
        if (!reg_email.test(email)) {
            $("#email").addClass("not-correct-border")
            btn.prop("disabled", true)
        } else {
            $("#email").removeClass("not-correct-border")
            btn.prop("disabled", false)
        }
    }

    function checkPassword() {
        let btn = $("#btnLogin")
        let password = $("#password").val()
        if (!reg_password.test(password)) {
            $("#password").addClass("not-correct-border")
            btn.prop("disabled", true)
        } else {
            $("#password").removeClass("not-correct-border")
            btn.prop("disabled", false)
        }
    }
}