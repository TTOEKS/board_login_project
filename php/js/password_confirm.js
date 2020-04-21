// This javascript function do disabled submit button when password empty or diffrenct betwwen password and password confirm
// Program ID: password_confirm.js

// set document objects
const signup_form = document.querySelector("form");
const input_password = signup_form.querySelector("#pwd"),
    password_confirm = signup_form.querySelector('#pwd_confirm'),
    submit_signup = signup_form.querySelector("#submit_signup"),
    password_status = signup_form.querySelector("#password_status");


function disabled_submit() {
    // if password or password confirm blank are empty disabled submit button
    if (input_password.value == "" | password_confirm.value == "") {
        submit_signup.disabled = true;
        password_status.innerHTML = "패스워드가 기입해주세요.";

    }
}

disabled_submit();

// if input password and password confirm are different
password_confirm.onkeyup = function() {
    if (input_password.value != password_confirm.value) {
        submit_signup.disabled = true;
        password_status.innerHTML = "패스워드가 다릅니다.";
    } else {
        submit_signup.disabled = false;
        password_status.innerHTML = "";
    }
}