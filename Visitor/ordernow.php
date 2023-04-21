<?php
session_start();
$custid=base64_decode($_REQUEST['custid']);
$amount=base64_decode($_REQUEST['am']);
$orderid= $_SESSION['username']."ORDS" . rand(10000,99999999);
?>
<html>
  <head>
  	 <title>Order Now</title>
  </head>
  <body>
       <div class="child2">
          <h3>Order Details:</h3>
          <h3><?php  echo $custid ?></h3>
          <h4 style="color:red;"><?php echo $orderid;  ?></h4>
          <!-- <p><span>Product:</span><span>XXXmobile</span></p>
          <p><span>color:</span> BLUE</p> -->
          <h2 style="color:cornflowerblue;"><span>Amount:</span> Rs.<?php echo $amount;  ?></h2>

          <form method="post" action="PaytmKit/pgRedirect.php">
               <input type="hidden" id="ORDER_ID" tabindex="1" maxlength="20" size="20"
            name="ORDER_ID" autocomplete="off"
            value="<?php echo $orderid;  ?>">

               <input type="hidden" id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="<?php echo $custid;  ?>">
               <input type="hidden" id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail">

               <input type="hidden" id="CHANNEL_ID" tabindex="4" maxlength="12" size="12" name="CHANNEL_ID" autocomplete="off" value="WEB">

            <input type="hidden" title="TXN_AMOUNT" tabindex="10" type="text" name="TXN_AMOUNT" value="<?php  echo $amount;  ?>">
            <input value="CheckOut" type="submit" class="btn">
          </form>
       </div>
    </div>
  </body>
</html>
