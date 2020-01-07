<?php 

    $active='Account';
    include("includes/header.php");

?>
   
   <div id="content"><!-- #content Begin -->
       <div class="container"><!-- container Begin -->
           <div class="col-md-12"><!-- col-md-12 Begin -->
               
               <ul class="breadcrumb"><!-- breadcrumb Begin -->
                   <li>
                       <a href="index.php">Home</a>
                   </li>
                   <li>
                       <?php
                        if(!isset($_SESSION['customer_email'])){
               
               echo 'login';
               
           }else{
               echo 'payment';
                
               
           }
                      ?> 
                       
                   </li>
               </ul><!-- breadcrumb Finish -->
               
           </div><!-- col-md-12 Finish -->
           
           <div class="col-md-3"><!-- col-md-3 Begin -->
   
   <?php 
    
    include("includes/sidebar.php");
    
    ?>
               
           </div><!-- col-md-3 Finish -->
           
           <div class="col-md-9"><!-- col-md-9 Begin -->
           
           <?php 
           
           if(!isset($_SESSION['customer_email'])){
               
               include("customer/customer_login.php");
               
           }else{ ?>
               
        <div class="box"><!-- box Begin -->
   
   <?php 
    
     
    
    $session_email = $_SESSION['customer_email'];
    
    $select_customer = "select * from customers where customer_email='$session_email'";
    
    $run_customer = mysqli_query($con,$select_customer);
    
    $row_customer = mysqli_fetch_array($run_customer);
    
    $customer_id = $row_customer['customer_id'];
    
    ?>
    
    <h1 class="text-center">Payment</h1>  
    
     <p class="lead text-center"><!-- lead text-center Begin -->
         
            <h3> Mobile Banking <br> </h3>
         <h5> 
            We accept Bkash ,Rocket & Tcash <br> 
               Bkash : 01521330951 <br>
               Rocket : 01521330951 <br>
               Tcash : 01521330951 <br>
               counter : 1 <br>
               
             </h5> 
    
            <h3> Cash on delivery <br> </h3>
    <h5>
           You can pay to our delivery person while recieving goods</h5>
        
         
     </p><!-- lead text-center Finish -->
     
<h3><center><font color="red">You must confirm payment from My Account -> My Orders to confirm your order</font></center></h3>


<?php 

$customer_session = $_SESSION['customer_email'];

$get_customer = "select * from customers where customer_email='$customer_session'";

$run_customer = mysqli_query($con,$get_customer);

$row_customer = mysqli_fetch_array($run_customer);

$customer_id = $row_customer['customer_id'];

$customer_name = $row_customer['customer_name'];

$customer_email = $row_customer['customer_email'];

$customer_country = $row_customer['customer_country'];

$customer_city = $row_customer['customer_city'];

$customer_contact = $row_customer['customer_contact'];

$customer_address = $row_customer['customer_address'];

$customer_image = $row_customer['customer_image'];

?>

<h1 align="center"> Delivery Address </h1>

<form action="checkout.php" method="post" enctype="multipart/form-data"><!-- form Begin -->
    
  
    
    <div class="form-group"><!-- form-group Begin -->
        
        <label>  Country: </label>
        
        <input type="text" name="c_country" class="form-control" value="<?php echo $customer_country; ?>" required>
        
    </div><!-- form-group Finish -->
    
    <div class="form-group"><!-- form-group Begin -->
        
        <label>  City: </label>
        
        <input type="text" name="c_city" class="form-control" value="<?php echo $customer_city; ?>" required>
        
    </div><!-- form-group Finish -->
    
        
    <div class="form-group"><!-- form-group Begin -->
        
        <label> Detail Address: </label>
        
        <input type="text" name="c_address" class="form-control" value="<?php echo $customer_address; ?>" required>
        
    </div><!-- form-group Finish -->
    
     <div class="form-group"><!-- form-group Begin -->
        <label> Contact No: </label>
        
        <input type="text" name="c_contact" class="form-control" value="<?php echo $customer_contact; ?>" required>
        
    </div><!-- form-group Finish -->
    
    
    <div class="text-center"><!-- text-center Begin -->
        
        <button name="order" class="btn btn-primary"><!-- btn btn-primary Begin -->
            
            <i class="fa fa-user-md"></i> Place Order
            
        </button><!-- btn btn-primary inish -->
        
    </div><!-- text-center Finish -->
    
</form><!-- form Finish -->

</div><!-- box Finish -->
           
<?php 

               
if(isset($_POST['order'])){
    
    
      $session_email = $_SESSION['customer_email'];
    
    $select_customer = "select * from customers where customer_email='$session_email'";
    
    $run_customer = mysqli_query($con,$select_customer);
    
    $row_customer = mysqli_fetch_array($run_customer);
    
    $customer_id = $row_customer['customer_id'];

    $c_country = $_POST['c_country'];
    
    $c_city = $_POST['c_city'];
    
    $c_address = $_POST['c_address'];
    
    $c_contact = $_POST['c_contact'];
    
    $ip_add = getRealIpUser();

    $status = "pending";

    $invoice_no = mt_rand();
    
    $update_customer = "INSERT INTO delivery_address (customer_id,invoice_no,customer_country,customer_city,customer_address, customer_contact) VALUES ('$customer_id', '$invoice_no', '$c_country', '$c_city', '$c_address', '$c_contact')";
    
    
    
  //  echo "$update_customer";
    $run_customer = mysqli_query($con,$update_customer);
    
    
    
    
$select_cart = "select * from cart where ip_add='$ip_add'";

$run_cart = mysqli_query($con,$select_cart);
    $no_items = 0;
    $total_qty = 0;
    $pro_size = 0; 
    $total=0;
while($row_cart = mysqli_fetch_array($run_cart)){
    $no_items = $no_items + 1;
    $pro_id = $row_cart['p_id'];
    
    $pro_qty = $row_cart['qty'];
     $total_qty =  $total_qty + $pro_qty;
    $pro_size = $row_cart['size']; 
    
    
        $v="select * from products where product_id='$pro_id' ";
       
        $query = mysqli_query($db,$v);
       
          $stock = 0;
        while($row_pro=mysqli_fetch_array($query)){
                                 
                                    $stock =(int) $row_pro['stock'];
        }
    
    $stock = $stock - (int)$total_qty;
    $stock = (string)$stock;
    
   //echo "<script>alert('$stock')</script>";
    $update = "update products set stock = '$stock' where product_id = '$pro_id' ";
    $run_update = mysqli_query($db,$update);
    
    
    
   
    
    $get_products = "select * from products where product_id='$pro_id'";
    
    $run_products = mysqli_query($con,$get_products);
    
    while($row_products = mysqli_fetch_array($run_products)){
        
        $sub_total = $row_products['product_price']*$pro_qty;
        $total= $total_pric + $sub_total ;
        
        $insert_pending_order = "insert into pending_orders (customer_id,invoice_no,product_id,qty,size,order_status) values ('$customer_id','$invoice_no','$pro_id','$pro_qty','$pro_size','$status')";
        
        $run_pending_order = mysqli_query($con,$insert_pending_order);
        
        
    }
    
}
    $insert_customer_order = "insert into customer_orders (customer_id,due_amount,invoice_no,qty,size,order_date,order_status) values ('$customer_id','$total','$invoice_no','$total_qty','$no_items',NOW(),'$status')";
        
        $run_customer_order = mysqli_query($con,$insert_customer_order);
        
        
        
        $delete_cart = "delete from cart where ip_add='$ip_add'";
        
        $run_delete = mysqli_query($con,$delete_cart);
        
        
        echo "<script>alert('Your orders has been submitted, Thanks')</script>";
        
        echo "<script>window.open('customer/my_account.php?my_orders','_self')</script>";
    
}

?>

    
       
        
               
        <?       
           }
           
           ?>
           
           </div><!-- col-md-9 Finish -->
           
       </div><!-- container Finish -->
   </div><!-- #content Finish -->
   
   <?php 

    include("includes/footer.php");
}
    ?>
    
    <script src="js/jquery-331.min.js"></script>
    <script src="js/bootstrap-337.min.js"></script>
    
    
