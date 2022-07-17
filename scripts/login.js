// jquery for active menu

$(document).ready(function(){
$("a").click(function(){
    $("a").removeClass("active");
    $(this).addClass("active");
});
});
// end active menu
function get_login_form(){
   let url = 'login.php?state=login';
   $.post(url, function (x) {
    let res_arr = x.split('@!#@');
    document.getElementById("main_login").innerHTML = res_arr[1];
});
}
function login_query(){
    let frm = document.login_form;
    let user = frm.username.value;
    let pass = frm.password.value;
    let data ={
        user,
        pass
    }
    let url = 'login.php?state=userlogin';
    $.post(url,data, function (x) {
    let res_arr = x.split('@!#@');
    if(res_arr[1]=='1'){
        window.location.href="index.php";
    }
    if(res_arr[1]=='2'){
        document.getElementById("login_msg").textContent = res_arr[2]; 
    }
    
});
}

function get_signup_form(){
    let url = 'login.php?state=signup';
    $.post(url, function (x) {
     let res_arr = x.split('@!#@');
     document.getElementById("main_login").innerHTML = res_arr[1];
 });
 }

 function signup_query(){
    let frm = document.signup_form;
    let user_fname = frm.fullname.value;
    let user_name = frm.username.value;
    let user_pass = frm.password.value;
    let user_mobile = frm.mobile.value;
    if(user_fname==""){
        alert("Please Write Your Full Name!");
        return false;
    }
    if(user_name==""){
        alert("Please Write Username!");
        return false;
    }
    if(user_pass==""){
        alert("Please Write Password!");
        return false;
    }
    if(user_mobile==""){
        alert("Please Write Mobile Number!");
        return false;
    }
    let data ={
        user_fname,
        user_name,
        user_pass,
        user_mobile
    };
    let url = 'login.php?state=userSignup';
    $.post(url,data, function (x) {
    let res_arr = x.split('@!#@');
    document.getElementById("sign_up_msg").textContent=res_arr[1];
    setTimeout(()=>{
        get_login_form();
    },1000)
   
});
}

function about_developer(){
    let url = 'login.php?state=developer_details';
    $.post(url, function (x) {
     let res_arr = x.split('@!#@');
     document.getElementById("main_login").innerHTML = res_arr[1];
 });
 }