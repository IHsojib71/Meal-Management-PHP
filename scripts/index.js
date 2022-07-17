// jquery for active menu

$(document).ready(function(){
    $("a").click(function(){
        $("a").removeClass("active");
        $(this).addClass("active");
    });
    });
    // end active menu
// live clock
function getTime(){
    let date = new Date();
    let hour =date.getHours();
    let min =date.getMinutes();
    let sec =date.getSeconds();
    let ampm = hour >= 12 ? 'pm' : 'am'; //getting am pm before setting 12 hours format
    hour = hour > 12 ? hour -12 :hour; // 12 hour formatting
    hour=checkTen(hour);
    min=checkTen(min);
    sec=checkTen(sec);
    document.getElementById("time").innerText=hour+":"+min+":"+sec+" "+ampm;
    setTimeout(getTime,1000);
}
function checkTen(a){
    a<10?a="0"+a:a=a; //adding 0 before if any number is below 10 like 9-> 09
    return a;
}
function get_dashboard () { 
    let url = 'index.php?state=show_dashboard';
    $.post(url,function (x){
        let arr = x.split('@#$');
        document.getElementById("main_content").innerHTML=arr[1];
    })
 }

function add_meal(){
    let url = 'index.php?state=add_meal_form';
    $.post(url,function (x){
        let arr = x.split('@#$');
        document.getElementById("main_content").innerHTML=arr[1];
    })
}
function add_meal_to_db(){ 
    let url = 'index.php?state=add_meal_to_db';
    let form = document.add_meal_form;
    let selected_user = form.add_meal_select_user.value;
    if(selected_user==""){
        alert("Please Select A Person!");
        return false;
    }
    let selected_user_name = $("#add_meal_select_user option:selected").text();
    let selected_date = form.add_meal_date.value;
    if(selected_date==""){
        alert("Please Select Date!");
        return false;
    }
    let selected_breakfast = "";
    let selected_lunch = "";
    let selected_dinner = "";
    if(form.add_meal_breakfast.checked){
        selected_breakfast =form.add_meal_breakfast.value
    }
    if(form.add_meal_lunch.checked){
        selected_lunch =form.add_meal_lunch.value
    }
    if(form.add_meal_dinner.checked){
        selected_dinner =form.add_meal_dinner.value
    }
    if(selected_breakfast=="" && selected_lunch=="" && selected_dinner==""){
        alert("Please Select At Least One Meal Entry!");
        return false;
    }
    let selected_remarks = form.add_meal_remark.value;
    let data ={
        selected_user,
        selected_user_name,
        selected_date,
        selected_breakfast,
        selected_lunch,
        selected_dinner,
        selected_remarks

    }
    $.post(url,data,function (x){
        let arr = x.split('@#$');
       alert(innerHTML=arr[1]);
       form.reset();
    })
 }
 function meal_list(){
    let url = 'index.php?state=show_meal_list';
    $.post(url,function (x){
        let arr = x.split('@#$');
        document.getElementById("main_content").innerHTML=arr[1];
    })
 }
 function cost_list(){
    let url = 'index.php?state=show_cost_list';
    $.post(url,function (x){
        let arr = x.split('@#$');
        document.getElementById("main_content").innerHTML=arr[1];
    })
 }
function do_filter(){
    let form =  document.filter_meal_list_form;
    let month = form.month_filter.value;  
    let year = form.year_filter.value;  
    let user = form.user_filter.value;  
    if(month=="" && year=="" && user==""){
        alert("Please Select At Least One Filter!");
        return false;
    }
    let url ='index.php?state=filters';
    let filter_data ={
        month,
        year,
        user     
     }
    $.post(url,filter_data,function (x){
        let arr = x.split('@#$');
        document.getElementById("main_content").innerHTML=arr[1];
    })
 }
 function cost_filter(){
    let form =  document.filter_meal_list_form;
    let month = form.month_filter.value;  
    let year = form.year_filter.value;  
    let user = form.user_filter.value;  
    if(month=="" && year=="" && user==""){
        alert("Please Select At Least One Filter!");
        return false;
    }
    let url ='index.php?state=cost_filters';
    let filter_data ={
        month,
        year,
        user     
     }
    $.post(url,filter_data,function (x){
        let arr = x.split('@#$');
        document.getElementById("main_content").innerHTML=arr[1];
    })
 }

 function monthly_report_filter(){
    let form =  document.filter_meal_list_form;
    let month = form.month_filter.value;  
    let year = form.year_filter.value;  
    let user = form.user_filter.value;  
    if(month=="" && year=="" && user==""){
        alert("Please Select At Least One Filter!");
        return false;
    }
    let url ='index.php?state=report_filters';
    let filter_data ={
        month,
        year,
        user     
     }
    $.post(url,filter_data,function (x){
        let arr = x.split('@#$');
        document.getElementById("main_content").innerHTML=arr[1];
    })
 }
 function get_details(ref){
   
    alert(ref);
    // let url ='index.php?state=get_details_byID&user_n='+user_n;
    // $.post(url,function (x){
    //     let arr = x.split('@#$');
    //     // document.getElementById("main_content").innerHTML=arr[1];
    //     alert(arr[1]);
    // })
 }

 function add_cost(){
    let url = 'index.php?state=add_cost_form';
    $.post(url,function (x){
        let arr = x.split('@#$');
        document.getElementById("main_content").innerHTML=arr[1];
    })
 }

 function add_cost_to_db(){ 
    let url = 'index.php?state=add_cost_to_db';
    let form = document.add_cost_frm;
    let selected_user = form.add_cost_select_user.value;
    if(selected_user==""){
        alert("Please Select A Person!");
        return false;
    }
    let selected_user_name = $("#add_cost_select_user option:selected").text();
    let selected_date = form.add_cost_date.value;
    let selected_amount = form.cost_amount.value;
    if(selected_date==""){
        alert("Please Select Date!");
        return false;
    }
    if(form.cost_amount.value==""){
        alert("Please Enter Amount!");
    }

    let selected_remarks = form.add_cost_remark.value;
    let data ={
        selected_user,
        selected_user_name,
        selected_amount,
        selected_date,
        selected_remarks

    }
    $.post(url,data,function (x){
        let arr = x.split('@#$');
       alert(innerHTML=arr[1]);
       form.reset();
    })
 }

 function how_to_use(){
    let url = 'index.php?state=how_to';
    $.post(url, function (x) {
     let res_arr = x.split('@!#@');
     document.getElementById("main_content").innerHTML = res_arr[1];
 });
 }
 function monthly_report(){
    let url = 'index.php?state=show_report';
    $.post(url, function (x) {
     let res_arr = x.split('@!#@');
     document.getElementById("main_content").innerHTML = res_arr[1];
 });
}
function about_developer(){
    let url = 'login.php?state=developer_details';
    $.post(url, function (x) {
     let res_arr = x.split('@!#@');
     document.getElementById("main_content").innerHTML = res_arr[1];
 });
 }
 