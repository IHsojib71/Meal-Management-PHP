<?php
session_start();
include 'user_auth.php';
error_reporting(0);
include 'connection.php';

global $state, $con, $today;
$today = date('d M Y');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Meal Management</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/style.css">
    <!-- jquery cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<body onload="getTime(), get_dashboard();">
    <header class="user_info">


        <span>Today : <?php echo $today; ?></span>
        <span id="time"></span>

        <span id="user_profile"> <strong>
                <?php
                session_start();
                echo $_SESSION['current_user'];

                ?>
            </strong>
            <a href="logout.php">Logout</a>

        </span>
    </header>

    <div class="user_info">

    </div>
    <div class="sidenav">

        <a href="#" onclick="get_dashboard();">Dashboard</a>
        <a href="#" onclick="add_meal();">Add Meal</a>
        <a href="#" onclick="meal_list();">Meal List</a>
        <a href="#" onclick="add_cost();">Add Cost</a>
        <a href="#" onclick="cost_list();">Cost List</a>
        <a href="#" onclick="monthly_report();">Monthly Report</a>
        <br><br><br><br><br><br>
        <a href="#" onclick="how_to_use()">How To Use</a>
        <a href="#" onclick="about_developer();">About Developer</a>



    </div>

    <div class="content" id="main_content">


        <!-- this will refill dynamically -->

    </div>

    <script src="scripts/index.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

<?php

$state = $_REQUEST['state'];
switch ($state) {
    case 'add_meal_form':
        echo '@#$';
        add_meal_form();
        echo '@#$';
        break;
    case 'add_meal_to_db':
        $selected_user = $_REQUEST['selected_user'];
        $selected_user_name = $_REQUEST['selected_user_name'];
        $selected_date = $_REQUEST['selected_date'];
        $selected_breakfast = $_REQUEST['selected_breakfast'];
        $selected_lunch = $_REQUEST['selected_lunch'];
        $selected_dinner = $_REQUEST['selected_dinner'];
        $remarks = $_REQUEST['selected_remarks'];
        $sql = "INSERT INTO meal_tbl(user_id,user_name,date,breakfast,lunch,dinner,remarks,entrytime) VALUES
                ('$selected_user',
                '$selected_user_name',
                '$selected_date',
                '$selected_breakfast',
                '$selected_lunch',
                '$selected_dinner',
                '$remarks',
                '$today')";
        $r = mysqli_query($con, $sql);
        if ($r) {
            echo '@#$Successfully Added Meal!@#$';
        } else {
            echo '@#$Something Wrong!@#$';
        }
        break;
    case 'show_meal_list':
        echo '@#$';
        show_meal_list();
        echo '@#$';
        break;
        case 'show_cost_list':
            echo '@#$';
            show_cost_list();
            echo '@#$';
            break;
    case 'filters':

        $filter = " id!='' ";
        $month_filter = isset($_REQUEST['month']) ? $_REQUEST['month'] : "";
        $year_filter = isset($_REQUEST['year']) ? $_REQUEST['year'] : "";
        $user_filter = isset($_REQUEST['user']) ? $_REQUEST['user'] : "";
        if ($month_filter != "") {
            $filter .= " AND MONTH(date)='$month_filter' ";
        }
        if ($year_filter != "") {
            $filter .= " AND YEAR(date)='$year_filter' ";
        }
        if ($user_filter != "") {
            $filter .= " AND user_id='$user_filter' ";
        }

        echo '@#$';
        show_meal_list();
        meal_list_table();
        echo '@#$';
        break;
        case 'cost_filters':

            $filter = " id!='' ";
            $month_filter = isset($_REQUEST['month']) ? $_REQUEST['month'] : "";
            $year_filter = isset($_REQUEST['year']) ? $_REQUEST['year'] : "";
            $user_filter = isset($_REQUEST['user']) ? $_REQUEST['user'] : "";
            if ($month_filter != "") {
                $filter .= " AND MONTH(date)='$month_filter' ";
            }
            if ($year_filter != "") {
                $filter .= " AND YEAR(date)='$year_filter' ";
            }
            if ($user_filter != "") {
                $filter .= " AND costby_userid='$user_filter' ";
            }
    
            echo '@#$';
            show_cost_list();
            cost_list_table();
            echo '@#$';
            break;

            case 'report_filters':

                $filter = " id!='' ";
                $month_filter = isset($_REQUEST['month']) ? $_REQUEST['month'] : "";
                $year_filter = isset($_REQUEST['year']) ? $_REQUEST['year'] : "";
                $user_filter = isset($_REQUEST['user']) ? $_REQUEST['user'] : "";
                if ($month_filter != "") {
                    $filter .= " AND MONTH(date)='$month_filter' ";
                }
                if ($year_filter != "") {
                    $filter .= " AND YEAR(date)='$year_filter' ";
                }
                if ($user_filter != "") {
                    $filter .= " AND costby_userid='$user_filter' ";
                }

                $filter_meal = " id!=''";
                $month_filter = isset($_REQUEST['month']) ? $_REQUEST['month'] : "";
                $year_filter = isset($_REQUEST['year']) ? $_REQUEST['year'] : "";
                $user_filter = isset($_REQUEST['user']) ? $_REQUEST['user'] : "";
                if ($month_filter != "") {
                    $filter_meal .= " AND MONTH(date)='$month_filter' ";
                }
                if ($year_filter != "") {
                    $filter_meal .= " AND YEAR(date)='$year_filter' ";
                }
                if ($user_filter != "") {
                    $filter_meal .= " AND costby_userid='$user_filter' ";
                }
        
                echo '@#$';
                show_cost_list();
                cost_list_table();
                echo '@#$';
                break;
    case 'get_details_byID':

        $user_n = $_REQUEST['user_n'];

        $q = "select user_name, breakfast, lunch, dinner, remarks, entrytime FROM meal_tbl WHERE user_id = $user_n";

        echo '@#$' . $q . '@#$';
        break;
    case 'show_dashboard':
        session_start();
        echo '@#$';
        home_dashboard();
        echo '@#$';
        break;
    case 'add_cost_form':

        echo '@#$';
        add_cost_form();
        echo '@#$';
        break;
    case 'add_cost_to_db':

        $selected_user = $_REQUEST['selected_user'];
        $selected_user_name = $_REQUEST['selected_user_name'];
        $selected_amount = $_REQUEST['selected_amount'];
        $selected_date = $_REQUEST['selected_date'];
        $remarks = $_REQUEST['selected_remarks'];
        $sql = "INSERT INTO cost_tbl(costby_userid,costby_name,amount,date,remark,entrytime) VALUES
                ('$selected_user',
                '$selected_user_name',
                '$selected_amount',
                '$selected_date',
                '$remarks',
                '$today')";
        //   echo $sql;
        $r = mysqli_query($con, $sql);
        echo $sql;
        if ($r) {
            echo '@#$Successfully Added Cost!@#$';
        } else {
            echo '@#$Something Wrong!@#$';
        }

        break;

    case 'how_to':
        echo '@!#@';
        how_to_use_details();
        echo '@!#@';
        break;
    case 'developer_details':
        echo '@!#@';
        about();
        echo '@!#@';
        break;
    case 'show_report':
            echo '@!#@';
            show_monthly_report();
            echo '@!#@';
            break;
}
function add_meal_form()
{
?>
    <h1>Add Meal</h1>
    <form name="add_meal_form" action="" method="post" enctype="multipart/form-data">
        <select name="add_meal_select_user" id="add_meal_select_user">
            <option value="">Select Person</option>
            <?php
            global $con;
            $sql = "SELECT id, fullname FROM users WHERE id!=''";
            $r = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_assoc($r)) {
            ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['fullname'] ?></option>

            <?php }
            ?>
        </select>
        <br><br>
        <input type="date" name="add_meal_date" placeholder="Date">
        <br><br>
        <fieldset>
            <legend>Meal Entry</legend>
            <div class="meal_entry">
                <input type="checkbox" id="add_meal_breakfast" name="add_meal_breakfast" value="1">
                <label for="add_meal_breakfast">Breakfast</label><br><br>
                <input type="checkbox" id="add_meal_lunch" name="add_meal_lunch" value="1">
                <label for="add_meal_lunch">Lunch</label><br><br>
                <input type="checkbox" id="add_meal_dinner" name="add_meal_dinner" value="1">
                <label for="add_meal_dinner">Dinner</label><br><br>
            </div>

        </fieldset>
        <br>
        <textarea name="add_meal_remark" id="add_meal_remark" cols="30" rows="10" placeholder="Remark"></textarea>
        <br><br>
        <input type="button" name="add_meal_btn" id="add_meal_btn" value="Add Meal" onclick="add_meal_to_db();">

    </form>

<?php
}

function show_meal_list()
{
?>
    <h1>Meal List</h1>
    <form name="filter_meal_list_form" action="" method="post">
        <select style="width:220px;" name="month_filter" id="month_filter">
            <option value="">Select Month</option>
            <option value="01">January</option>
            <option value="02">February</option>
            <option value="03">March</option>
            <option value="04">April</option>
            <option value="05">May</option>
            <option value="06">June</option>
            <option value="07">July</option>
            <option value="08">August</option>
            <option value="09">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
        </select>
        <select style="width:220px;" name="year_filter" id="year_filter">
            <option value="">Select Year</option>
            <?php
            $current_year = date('Y');
            for ($i = $current_year - 3; $i <= $current_year; $i++) {
            ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>

            <?php   }  ?>

        </select>
        <select style="width:220px;" name="user_filter" id="user_filter">
            <option value="">Select Person</option>
            <?php
            global $con;
            $sql = "SELECT DISTINCT user_id, user_name FROM meal_tbl where id!=''";
            $r = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($r)) {
            ?>
                <option value="<?php echo $row['user_id']; ?>"><?php echo $row['user_name']; ?></option>

            <?php   }  ?>
        </select>

        <input type="button" name="filter_btn" id="filter_btn" value="Filter" onclick="do_filter();">
    </form>
    <br>



<?php }

function meal_list_table()
{
?>

    <table border="1" style="width: 90%;border-collapse:collapse;">
        <tr style="background-color: green;color:white;">
            <th>S.N.</th>
            <th>Name</th>
            <th>Total Breakfast</th>
            <th>Total Lunch</th>
            <th>Total Dinner</th>
            <th>Action</th>
        </tr>
        <?php
        global $filter, $con;
        $q = "SELECT user_name, SUM(breakfast) as breakfast, SUM(lunch) as lunch, SUM(dinner) as dinner FROM meal_tbl WHERE $filter GROUP BY user_name";
        // echo $q;
        $res = mysqli_query($con, $q);


        $count = 0;
        while ($com = mysqli_fetch_assoc($res)) {
            $count++;
        ?>
            <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $com['user_name']; ?></td>
                <td><?php echo $com['breakfast']; ?></td>
                <td><?php echo $com['lunch']; ?></td>
                <td><?php echo $com['dinner']; ?></td>
                <td>
                    <?php $user_name = $com['lunch']; ?>
                    <button onclick="get_details(<?= $user_name; ?>)">Details</button>
                    <!-- <button class="details_btn" onclick="get_details(<?php echo $com['user_name'];  ?>)"><a href="#openModal">Details</a></button> -->

                    <div id="openModal" class="modalDialog">
                        <div> <a href="#close" title="Close" class="close">X</a>

                            <h2>Details</h2>
                        </div>

                </td>
            </tr>

        <?php    }  ?>


    </table>
<?php  }

function show_cost_list(){
   ?>
     <h1>Cost List</h1>
    <form name="filter_meal_list_form" action="" method="post">
        <select style="width:220px;" name="month_filter" id="month_filter">
            <option value="">Select Month</option>
            <option value="01">January</option>
            <option value="02">February</option>
            <option value="03">March</option>
            <option value="04">April</option>
            <option value="05">May</option>
            <option value="06">June</option>
            <option value="07">July</option>
            <option value="08">August</option>
            <option value="09">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
        </select>
        <select style="width:220px;" name="year_filter" id="year_filter">
            <option value="">Select Year</option>
            <?php
            $current_year = date('Y');
            for ($i = $current_year - 3; $i <= $current_year; $i++) {
            ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>

            <?php   }  ?>

        </select>
        <select style="width:220px;" name="user_filter" id="user_filter">
            <option value="">Select Person</option>
            <?php
            global $con;
            $sql = "SELECT DISTINCT user_id, user_name FROM meal_tbl where id!=''";
            $r = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($r)) {
            ?>
                <option value="<?php echo $row['user_id']; ?>"><?php echo $row['user_name']; ?></option>

            <?php   }  ?>
        </select>

        <input type="button" name="filter_btn" id="filter_btn" value="Filter" onclick="cost_filter();">
    </form>
    <br>
<?php }
function cost_list_table(){
    ?>
     <table border="1" style="width: 90%;border-collapse:collapse;">
        <tr style="background-color: green;color:white;">
            <th>S.N.</th>
            <th>Name</th>
            <th>Total Cost</th>
        
          
        </tr>
        <?php
        global $filter, $con;
        $q = "SELECT costby_name,SUM(amount) as amount FROM cost_tbl WHERE $filter GROUP BY costby_name";
        // echo $q;
        $res = mysqli_query($con, $q);


        $count = 0;
        while ($com = mysqli_fetch_assoc($res)) {
            $count++;
        ?>
            <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $com['costby_name']; ?></td>
                <td><?php echo $com['amount']; ?></td>
               
            </tr>

        <?php    }  ?>


    </table>

<?php }

function home_dashboard()
{
    global $con;
    // month_number
    $current_month = date('m');
    $current_m = date('M');
    $current_y = date('Y');
    $s = "SELECT COUNT(id) as total_user from users";
    $res = mysqli_query($con, $s);
    $total_users = mysqli_fetch_row($res);

    $sm = "SELECT SUM(breakfast+lunch+dinner) AS meals FROM meal_tbl WHERE MONTH(date) ='$current_month' AND YEAR(date)='$current_y'";
    $res = mysqli_query($con, $sm);
    $total_meal = mysqli_fetch_assoc($res);
    
    $sc = "SELECT SUM(amount) AS costs FROM cost_tbl WHERE MONTH(date) ='$current_month' AND YEAR(date)='$current_y'";
    $res = mysqli_query($con, $sc);
    $total_cost = mysqli_fetch_assoc($res);
?>
    <h1 style="color:green;">Welcome to meal management!</h1>
    <div class="card">
       
        <div class="card_container">
            <h1>Summary For <?php echo $current_m." ".$current_y; ?></h1>
            <table border="1" style="width: 90%;border-collapse:collapse;">
                <thead>
                    <tr>
                        <th>Total Users</th>
                        <th>Total Meal</th>
                        <th>Total Cost</th>
                        <th>Meal Rate</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td><?php echo $total_users[0]; ?></td>
                    <td><?php echo $total_meal['meals']; ?></td>
                    <td><?php echo $total_cost['costs']." "."Taka"; ?></td>
                    <td><?php echo round($total_cost['costs']/$total_meal['meals']); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


<?php }
function add_cost_form()
{
?>
    <form action="" method="post" name="add_cost_frm">
        <h1>Add Cost</h1>
        <select name="add_cost_select_user" id="add_cost_select_user">
            <option value="">Cost By</option>
            <?php
            global $con;
            $sql = "SELECT id, fullname FROM users WHERE id!=''";
            $r = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_assoc($r)) {
            ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['fullname'] ?></option>

            <?php }
            ?>
        </select>
        <br><br>
        <input type="date" name="add_cost_date" placeholder="Date">
        <br><br>
        <input type="text" name="cost_amount" id="cost_amount" placeholder="Amount">
        <br><br>
        <textarea name="add_cost_remark" id="add_cost_remark" cols="30" rows="10" placeholder="Remark"></textarea>
        <br><br>
        <input type="button" name="add_cost_btn" id="add_cost_btn" value="Add Cost" onclick="add_cost_to_db();">

    </form>
<?php }
function show_monthly_report(){
    ?>
     <h1>Monthly Report</h1>
    <form name="filter_meal_list_form" action="" method="post">
        <select style="width:220px;" name="month_filter" id="month_filter">
            <option value="">Select Month</option>
            <option value="01">January</option>
            <option value="02">February</option>
            <option value="03">March</option>
            <option value="04">April</option>
            <option value="05">May</option>
            <option value="06">June</option>
            <option value="07">July</option>
            <option value="08">August</option>
            <option value="09">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
        </select>
        <select style="width:220px;" name="year_filter" id="year_filter">
            <option value="">Select Year</option>
            <?php
            $current_year = date('Y');
            for ($i = $current_year - 3; $i <= $current_year; $i++) {
            ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>

            <?php   }  ?>

        </select>
        <select style="width:220px;" name="user_filter" id="user_filter">
            <option value="">Select Person</option>
            <?php
            global $con;
            $sql = "SELECT DISTINCT user_id, user_name FROM meal_tbl where id!=''";
            $r = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($r)) {
            ?>
                <option value="<?php echo $row['user_id']; ?>"><?php echo $row['user_name']; ?></option>

            <?php   }  ?>
        </select>

        <input type="button" name="filter_btn" id="filter_btn" value="Filter" onclick="monthly_report_filter();">
    </form>
    <br>
<?php }
function about()
{
?>

    <div class="card">
        <img src="images/ismail_hossain.png" alt="Ismail Hossain">
        <div class="card_container">
            <h4><b>Md Ismail Hossain</b></h4>
            <p>Full Stack Developer</p>
            <p>Email: ihsojib43@gmail.com</p>
            <p></p>
            <a href="https://www.facebook.com/think.sojib/" target="_blank"><button>Facebook</button></a>
            <a href="https://www.linkedin.com/in/ihsojib-7a849a154/" target="_blank"><button>Linkedin</button></a>
        </div>
    </div>

<?php }
function how_to_use_details()
{
?>
     <div class="card">
       
        <div class="card_container">
            <h1>Upcoming!</h1>
        </div>
    </div>
<?php }
?>




</html>