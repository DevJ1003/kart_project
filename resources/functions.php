<?php

$upload_directory = "uploads";


/* Helper Functions */


function last_id()
{
    global $connection;
    return mysqli_insert_id($connection);
}



function set_message($msg)
{

    if (!empty($msg)) {

        $_SESSION['message'] = $msg;
    } else {

        $msg = "";
    }
}



function display_message()
{

    if (isset($_SESSION['message'])) {

        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}



function redirect($location)
{

    header("Location: $location");
}


function query($sql)
{

    global $connection;

    return mysqli_query($connection, $sql);
}


function confirm($result)
{

    global $connection;

    if (!$result) {

        die("QUERY FAILED" . mysqli_error($connection));
    }
}


function escape_string($string)
{

    global $connection;

    return mysqli_real_escape_string($connection, $string);
}


function fetch_array($result)
{

    return mysqli_fetch_array($result);
}






/************************************ FRONT END FUNCTIONS *************************************/


/* Get Products */


function get_products()
{

    $query = query("SELECT * FROM products WHERE product_quantity >= 1");
    confirm($query);

    $rows = mysqli_num_rows($query);

    if (isset($_GET['page'])) {


        $page = preg_replace('#[^0-9]#', '', $_GET['page']);
    } else {

        $page = 1;
    }

    $perpage = 6;
    $lastpage = ceil($rows / $perpage);

    if ($page < 1) {

        $page = 1;
    } elseif ($page > $lastpage) {

        $page = $lastpage;
    }



    $middleNumbers = '';

    $sub1 = $page - 1;
    $sub2 = $page - 2;
    $add1 = $page + 1;
    $add2 = $page + 2;

    if ($page == 1) {


        $middleNumbers .= '<li class="page-item active"><a>' . $page . '</a></li>';
        $middleNumbers .= '<li class="page-item"><a class="page-link" href=" ' . $_SERVER['PHP_SELF'] . '?page=' . $add1 . ' ">' . $add1 . '</a></li>';
    } elseif ($page == $lastpage) {


        $middleNumbers .= '<li class="page-item active"><a>' . $page . '</a></li>';
        $middleNumbers .= '<li class="page-item"><a class="page-link" href=" ' . $_SERVER['PHP_SELF'] . '?page=' . $sub1 . ' ">' . $sub1 . '</a></li>';
    } elseif ($page > 2 && $page < ($lastpage - 1)) {


        $middleNumbers .= '<li class="page-item"><a class="page-link" href=" ' . $_SERVER['PHP_SELF'] . '?page=' . $sub2 . ' ">' . $sub2 . '</a></li>';
        $middleNumbers .= '<li class="page-item"><a class="page-link" href=" ' . $_SERVER['PHP_SELF'] . '?page=' . $sub1 . ' ">' . $sub1 . '</a></li>';
        $middleNumbers .= '<li class="page-item active"><a>' . $page . '</a></li>';
        $middleNumbers .= '<li class="page-item"><a class="page-link" href=" ' . $_SERVER['PHP_SELF'] . '?page=' . $add1 . ' ">' . $add1 . '</a></li>';
        $middleNumbers .= '<li class="page-item"><a class="page-link" href=" ' . $_SERVER['PHP_SELF'] . '?page=' . $add2 . ' ">' . $add2 . '</a></li>';
    } elseif ($page > 1 && $page < $lastpage) {

        $middleNumbers .= '<li class="page-item"><a class="page-link" href=" ' . $_SERVER['PHP_SELF'] . '?page=' . $sub1 . ' ">' . $sub1 . '</a></li>';
        $middleNumbers .= '<li class="page-item active"><a>' . $page . '</a></li>';
        $middleNumbers .= '<li class="page-item"><a class="page-link" href=" ' . $_SERVER['PHP_SELF'] . '?page=' . $add1 . ' ">' . $add1 . '</a></li>';
    }


    $limit = 'LIMIT ' . ($page - 1) * $perpage . ',' . $perpage;


    $query2 = query("SELECT * FROM products WHERE product_quantity >= 1 " . $limit);
    confirm($query2);

    $outputPagination = "";

    if ($page != 1) {

        $prev = $page - 1;
        $outputPagination .= '<li class="page-item"><a class="page-link" href=" ' . $_SERVER['PHP_SELF'] . '?page= ' . $prev . '">Back</a></li>';
    }

    $outputPagination .= $middleNumbers;

    if ($page != $lastpage) {

        $next = $page + 1;
        $outputPagination .= '<li class="page-item"><a class="page-link" href=" ' . $_SERVER['PHP_SELF'] . '?page= ' . $next . '">Next</a></li>';
    }


    while ($row = fetch_array($query2)) {

        $product_image = display_image($row['product_image']);
        $product = <<<DELIMETER

        <div class="col-sm-4 col-lg-4 col-md-4">
        <div class="thumbnail">
            <a href="item.php?id={$row['product_id']}"><img style="height:120px;" src="../resources/{$product_image}" alt=""></a>
            <div class="caption">
                <h4 class="pull-right">&#8377;{$row['product_price']}</h4>
                <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
                </h4>
                <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
                <a class="btn btn-primary" target="_blank" href="../resources/cart.php?add={$row['product_id']}">Add to Cart <span class="glyphicon glyphicon-shopping-cart"></span></a>
            </div>
        </div>
        </div>
DELIMETER;

        echo $product;
    }

    if ($lastpage != 1) {

        echo "<div class='text-center' style='clear: both;' >Page $page of $lastpage !</div>";
    }
    echo "<div class='text-center' style='clear: both;' ><ul class='pagination'>{$outputPagination}</ul></div>";
}









function get_categories()
{

    $query = query("SELECT * FROM categories");
    confirm($query);


    while ($row = fetch_array($query)) {

        $categories_links = <<<DELIMETER

        <a href='category.php?id={$row['cat_id']}' class='list-group-item'>{$row['cat_title']}</a>

DELIMETER;

        echo $categories_links;
    }
}









function get_products_in_cat_page()
{

    $query = query("SELECT * FROM products WHERE product_category_id = " . escape_string($_GET['id']) . " AND product_quantity >= 1 ");
    confirm($query);

    while ($row = fetch_array($query)) {

        $product_image = display_image($row['product_image']);
        $product = <<<DELIMETER

        <div class="col-md-3 col-sm-6 hero-feature">
            <div class="thumbnail">
            <a href="item.php?id={$row['product_id']}"><img style="height:120px;" src="../resources/{$product_image}" alt=""></a>
                <div class="caption">
                    <h3>{$row['product_title']}</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    <p>
                        <a href="../resources/cart.php?add={$row['product_id']}" class="btn btn-primary">Add to Cart <span class="glyphicon glyphicon-shopping-cart"></span></a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More<span class="glyphicon glyphicon-triangle-right"></span></a>
                    </p>
                </div>
            </div>
        </div>

DELIMETER;

        echo $product;
    }
}








function get_products_in_shop_page()
{

    $query = query("SELECT * FROM products WHERE product_quantity >= 1");
    confirm($query);

    while ($row = fetch_array($query)) {

        $product_image = display_image($row['product_image']);
        $product = <<<DELIMETER

        <div class="col-md-3 col-sm-6 hero-feature">
            <div class="thumbnail">
            <a href="item.php?id={$row['product_id']}"><img style="height:120px;" src="../resources/{$product_image}" alt=""></a>
                <div class="caption">
                    <h3>{$row['product_title']}</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    <p>
                        <a href="../resources/cart.php?add={$row['product_id']}" class="btn btn-primary">Add to Cart <span class="glyphicon glyphicon-shopping-cart"></span></a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More<span class="glyphicon glyphicon-triangle-right"></span></a>
                    </p>
                </div>
            </div>
        </div>

DELIMETER;

        echo $product;
    }
}




/******************************** HOMEPAGE LOGIN-ADMIN LINK FUCNTION ********************************/




function IsLoggedIn()
{
    if (isset($_SESSION['username'])) {

        return true;
    } else {

        return false;
    }
}


function show_login_admin_link()
{

    if (IsLoggedIn()) {

        $admin = <<<DELIMETER

<li>
    <a href="admin"><span class="glyphicon glyphicon-user"></span> Admin</a>
</li>

DELIMETER;

        echo $admin;
    } else {


        $login = <<<DELIMETER

<li>
    <a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a>
</li>

DELIMETER;

        echo $login;
    }
}




/******************************** END OF HOMEPAGE LOGIN-ADMIN LINK FUCNTION ********************************/












/******************************************** DASHBOARD PAGE COUNT FUCNTIONS *********************************/



function recordCount($table)
{

    global $connection;

    $query = "SELECT * FROM " . $table;

    $select_all_product = mysqli_query($connection, $query);

    $result = 0;

    $result = mysqli_num_rows($select_all_product);
    confirm($result);


    return $result;
}








/******************************************** END OF DASHBOARD PAGE COUNT FUCNTIONS *********************************/







function login_user()
{

    if (isset($_POST['submit'])) {

        $username = escape_string($_POST['username']);
        $password = escape_string($_POST['password']);

        $query = query("SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}' ");
        confirm($query);


        if (mysqli_num_rows($query) == 0) {

            set_message("Your Username or Password is wrong !");
            redirect("login.php");
        } else {
            $_SESSION['username'] = $username;
            redirect("admin");
        }
    }
}






function send_message()
{

    if (isset($_POST['submit'])) {

        $to        = "someexample@gmail.com";
        $from_name = $_POST['name'];
        $email     = $_POST['email'];
        $subject   = $_POST['subject'];
        $message   = $_POST['message'];

        $headers = "From: {$from_name} {$email} ";

        $result = mail($to, $subject, $message, $headers);

        if (!$result) {

            set_message("Sorry , we could not send your message !");
            redirect("contact.php");
        } else {

            set_message("Yes , your message has been sent !");
            redirect("contact.php");
        }
    }
}







/************************************ BACK END FUNCTIONS *************************************/


function get_user_name()
{
    if (isset($_SESSION['username'])) {

        return $_SESSION['username'];
    }
}


function display_orders()
{

    $query = query("SELECT * FROM orders");
    confirm($query);

    while ($row = fetch_array($query)) {

        $orders = <<<DELIMETER

<tr>
    <td>{$row['order_id']}</td>
    <td>{$row['order_amount']}</td>
    <td>{$row['order_transaction']}</td>
    <td>{$row['order_currency']}</td>
    <td>{$row['order_status']}</td>
    <td><a class="btn btn-danger" href="../../resources/templates/back/delete_order.php?id={$row['order_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
</tr>

DELIMETER;

        echo $orders;
    }
}







/************************************* ADMIN PRODUCTS PAGE *******************************************/


function display_image($picture)
{

    global $upload_directory;

    return $upload_directory . DS . $picture;
}






function get_products_in_admin()
{

    $query = query("SELECT * FROM products");
    confirm($query);

    while ($row = fetch_array($query)) {


        $category = show_product_category_title($row['product_category_id']);
        $product_image = display_image($row['product_image']);

        $product = <<<DELIMETER

<tr>
    <td>{$row['product_id']}</td>
    <td>{$row['product_title']}<br>
    <a href="index.php?edit_product&id={$row['product_id']}"><img width="150" src="../../resources/{$product_image}" alt=""></a>
    </td>
    <td>{$category}</td>
    <td>{$row['product_price']}</td>
    <td>{$row['product_quantity']}</td>
    <td>
    <div class="col-xs-6 col-md-3 product_delete">
    <a class="btn btn-danger" href="../../resources/templates/back/delete_product.php?id={$row['product_id']}"><span class="glyphicon glyphicon-remove"></span></a>
    </td>
</tr>
    
DELIMETER;

        echo $product;
    }
}





/****************************** ADD PRODUCTS IN ADMIN **********************************/



function show_product_category_title($product_category_id)
{

    $category_query = query("SELECT * FROM categories WHERE cat_id = '{$product_category_id}' ");
    confirm($category_query);

    while ($category_row = fetch_array($category_query)) {

        return $category_row['cat_title'];
    }
}






function add_products()
{

    if (isset($_POST['publish'])) {

        $product_title       = escape_string($_POST['product_title']);
        $product_category_id = escape_string($_POST['product_category_id']);
        $product_price       = escape_string($_POST['product_price']);
        $product_description = escape_string($_POST['product_description']);
        $short_desc          = escape_string($_POST['short_desc']);
        $product_quantity    = escape_string($_POST['product_quantity']);
        $product_image       = escape_string($_FILES['file']['name']);
        $image_temp_location = escape_string($_FILES['file']['tmp_name']);


        move_uploaded_file($image_temp_location, UPLOAD_DIRECTORY . DS . $product_image);

        $query = query("INSERT INTO products( product_title , product_category_id , product_price , product_description , short_desc , product_quantity , product_image)
                VALUES('{$product_title}' , '{$product_category_id}' , '{$product_price}' , '{$product_description}' , '{$short_desc}' , '{$product_quantity}' , '{$product_image}') ");


        $last_id = last_id();
        confirm($query);
        set_message("New Product with id {$last_id} was added!");
        redirect("index.php?products");


        var_dump($product_category_id);
        die();
    }
}







function get_categories_add_product_page()
{

    $query = query("SELECT * FROM categories");
    confirm($query);


    while ($row = fetch_array($query)) {
        // if ($row['cat_id'] == $product_category_id) {
        //     <option value="{$row['cat_id']}" selected>{$row['cat_title']}</option>   

        // }else{
        //     <option value="{$row['cat_id']}">{$row['cat_title']}</option>   

        // }
        $categories_options = <<<DELIMETER

            
            <option value="{$row['cat_id']}">{$row['cat_title']}</option>   

        DELIMETER;

        echo $categories_options;
    }
}






/************************************* UPDATE PRODUCTS - ADMIN *********************************/



function update_products()
{

    if (isset($_POST['update'])) {

        $product_title       = escape_string($_POST['product_title']);
        $product_category_id = escape_string($_POST['product_category_id']);
        $product_price       = escape_string($_POST['product_price']);
        $product_description = escape_string($_POST['product_description']);
        $short_desc          = escape_string($_POST['short_desc']);
        $product_quantity    = escape_string($_POST['product_quantity']);
        $product_image       = escape_string($_FILES['file']['name']);
        $image_temp_location = escape_string($_FILES['file']['tmp_name']);


        if (empty($product_image)) {

            $get_pic = query("SELECT product_image FROM products WHERE product_id =" . escape_string($_GET['id']) . "");
            confirm($get_pic);

            while ($pic = fetch_array($get_pic)) {

                $product_image = $pic['product_image'];
            }
        }


        move_uploaded_file($image_temp_location, UPLOAD_DIRECTORY . DS . $product_image);


        $query = "UPDATE products SET ";
        $query .= "product_title            = '{$product_title}'         , ";
        $query .= "product_category_id      = '{$product_category_id}'   , ";
        $query .= "product_price            = '{$product_price}'         , ";
        $query .= "product_description      = '{$product_description}'   , ";
        $query .= "short_desc               = '{$short_desc}'            , ";
        $query .= "product_quantity         = '{$product_quantity}'      , ";
        $query .= "product_image            = '{$product_image}'           ";
        $query .= "WHERE product_id=" . escape_string($_GET['id']);


        $send_update_query = query($query);
        confirm($send_update_query);
        set_message("Product has been updated!");
        redirect("index.php?products");
    }
}





/***************************************** CATEGORIES IN ADMIN ***************************************/



function show_categories_in_admin()
{

    $query = query("SELECT * FROM categories");
    confirm($query);


    while ($row = fetch_array($query)) {


        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        $category = <<<DELIMETER

            <tr>
                <td>{$cat_id}</td>  
                <td>{$cat_title}</td>
                <td>
                    <a class="btn btn-danger" href="../../resources/templates/back/delete_category.php?id={$row['cat_id']}"><span class="glyphicon glyphicon-remove"></span></a>
                </td>
            </tr>

DELIMETER;

        echo $category;
    }
}




function add_category()
{

    if (isset($_POST['add_category'])) {

        $cat_title = escape_string($_POST['cat_title']);


        if (empty($cat_title) || $cat_title == " ") {

            set_message("This Field cannot be empty !");
        } else {

            $query = query("INSERT INTO categories(cat_title) VALUES('{$cat_title}') ");
            confirm($query);

            set_message("Category created !");
        }

        redirect("index.php?categories");
    }
}





/**************************************** USER ADMIN  ***************************************/



function display_user()
{

    $query = query("SELECT * FROM users");
    confirm($query);


    while ($row = fetch_array($query)) {

        $user_id = $row['user_id'];
        $username = $row['username'];
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $email = $row['email'];

        $user_image = display_image($row['user_image']);

        $admin_user = <<<DELIMETER

        <tr>
        <td>{$user_id}</td>
        <td>{$username}<br>
        <a><img width="150" src="../../resources/{$user_image}" alt=""></a>
        </td>
        <td>{$firstname}</td>
        <td>{$lastname}</td>
        <td>{$email}</td>
        <td>
        <a class="btn btn-danger" href="../../resources/templates/back/delete_user.php?id={$row['user_id']}"><span class="glyphicon glyphicon-remove"></span></a>
        </td>
    </tr>

DELIMETER;

        echo $admin_user;
    }
}




function add_user()
{

    if (isset($_POST['add_user'])) {

        $username = escape_string($_POST['username']);
        $firstname = escape_string($_POST['firstname']);
        $lastname = escape_string($_POST['lastname']);
        $email = escape_string($_POST['email']);
        $password = escape_string($_POST['password']);
        $user_image       = escape_string($_FILES['file']['name']);
        $image_temp_location = escape_string($_FILES['file']['tmp_name']);

        move_uploaded_file($image_temp_location, UPLOAD_DIRECTORY . DS . $user_image);


        $query = query("INSERT INTO users(username , firstname , lastname , email , user_image , password) VALUES('{$username}' , '{$firstname}' , '{$lastname}' , '{$email}' , '{$user_image}' , '{$password}') ");
        confirm($query);

        set_message("User created !");
        redirect("index.php?users");
    }
}





/************************************ REPORTS - ADMIN  *******************************/



function get_report()
{

    $query = query("SELECT * FROM reports");
    confirm($query);

    while ($row = fetch_array($query)) {

        $report_id = $row['report_id'];
        $product_id = $row['product_id'];
        $product_title = $row['product_title'];
        $order_id = $row['order_id'];
        $product_price = $row['product_price'];
        $product_quantity = $row['product_quantity'];

        $report = <<<DELIMETER

<tr>
    <td>{$row['report_id']}</td>
    <td>{$row['product_id']}</td>
    <td>{$row['product_title']}</td>
    <td>{$row['order_id']}</td>
    <td>{$row['product_price']}</td>
    <td>{$row['product_quantity']}</td>
    <td><a class="btn btn-danger" href="../../resources/templates/back/delete_report.php?id={$row['report_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
</tr>
    
DELIMETER;

        echo $report;
    }
}






/************************************* SLIDER FUNCTIONS **********************************/




function add_slides()
{

    if (isset($_POST['add_slide'])) {

        $slide_title = escape_string($_POST['slide_title']);
        $slide_image       = escape_string($_FILES['file']['name']);
        $slide_image_temp_location = escape_string($_FILES['file']['tmp_name']);


        if (empty($slide_title) || empty($slide_image)) {

            set_message("Fields cannot be empty !");
        } else {

            move_uploaded_file($slide_image_temp_location, UPLOAD_DIRECTORY . DS . $slide_image);

            $query = query("INSERT INTO slides( slide_title , slide_image ) VALUES( '{$slide_title}' , '{$slide_image}' )");
            confirm($query);

            set_message("New Slide banner added !");
            redirect("index.php?slides");
        }
    }
}





function get_current_slide_in_admin()
{

    $query = query("SELECT * FROM slides ORDER BY slide_id DESC LIMIT 1");
    confirm($query);

    while ($row = fetch_array($query)) {

        $slide_image = display_image($row['slide_image']);

        $slide_active_admin = <<<DELIMETER

       
            <img style="height:400px;"  class="img-responsive" src="../../resources/{$slide_image}" alt="">
      

        DELIMETER;

        echo $slide_active_admin;
    }
}





function get_slides()
{

    $query = query("SELECT * FROM slides LIMIT 2");
    confirm($query);

    while ($row = fetch_array($query)) {

        $slide_image = display_image($row['slide_image']);

        $slides = <<<DELIMETER

        <div class="item">
            <img style="height:400px;" class="slide-image" src="../resources/{$slide_image}" alt="">
        </div>

        DELIMETER;

        echo $slides;
    }
}








function get_active_slide()
{

    $query = query("SELECT * FROM slides ORDER BY slide_id DESC LIMIT 1");
    confirm($query);

    while ($row = fetch_array($query)) {

        $slide_image = display_image($row['slide_image']);

        $slide_active = <<<DELIMETER

        <div class="item active">
            <img style="height:400px;" class="slide-image" src="../resources/{$slide_image}" alt="">
        </div>

        DELIMETER;

        echo $slide_active;
    }
}






function display_slide()
{

    $query = query("SELECT * FROM slides");
    confirm($query);

    while ($row = fetch_array($query)) {

        $slide_id = $row['slide_id'];
        $slide_title = $row['slide_title'];
        $slide_image = $row['slide_image'];

        $slide_image = display_image($row['slide_image']);

        $slide_admin = <<<DELIMETER

        <tr>
        <td>{$slide_id}</td>
        <td>{$slide_title}</td>
        <td>
        <a><img width="150" src="../../resources/{$slide_image}" alt=""></a>
        </td>
        <td>
        <div class="col-xs-6 col-md-3 image_container">
        <a class="btn btn-danger" href="../../resources/templates/back/delete_slide.php?id={$row['slide_id']}"><span class="glyphicon glyphicon-remove"></span></a>
        </div>
        </td>
    </tr>

DELIMETER;

        echo $slide_admin;
    }
}






/********************************************** ADMIN ORDER TABLE FUCNTION ***********************************/





function display_admin_orders()
{

    $query = query("SELECT * FROM orders");
    confirm($query);

    while ($row = fetch_array($query)) {

        $orders = <<<DELIMETER

<tr>
    <td>{$row['order_id']}</td>
    <td>{$row['order_amount']}</td>
    <td>{$row['order_transaction']}</td>
    <td>{$row['order_currency']}</td>
    <td>{$row['order_status']}</td>
</tr>

DELIMETER;

        echo $orders;
    }
}
