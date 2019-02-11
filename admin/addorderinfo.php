<?php include_once("header.php"); ?>
<br>
<h1> Add New Order Info :- </h1>
<br>
<?php
$username = isset($_SESSION["username"]) ? $_SESSION["username"] : "";
$cartid = isset($_SESSION["cartid"]) ? $_SESSION["cartid"] : "";
$orderdate = isset($_SESSION["orderdate"]) ? $_SESSION["orderdate"] : "";
$shippingdate = isset($_SESSION["shippingdate"]) ? $_SESSION["shippingdate"] : "";
$orderstatus = isset($_SESSION["orderstatus"]) ? $_SESSION["orderstatus"] : "";
$shippingaddress = isset($_SESSION["shippingaddress"]) ? $_SESSION["shippingaddress"] : "";
$paymentdetails = isset($_SESSION["paymentdetails"]) ? $_SESSION["paymentdetails"] : "";
?>
<form method="post" action="insertorderinfo.php">
    <div class="row form-group">
        <div class="col-md-2">
            <label for="username"> Enter Username : </label>
        </div>        
        <div class="col-md-10">
            <select class="form-control" name="username" id="username">
                <option value="">Choose Username</option>
                <?php
                require_once("../api/OpenConnection.php");
                $query = "select username from logininfo";
                $result = mysqli_query($con, $query);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_row($result)) {
                        list($username) = $row;
                        echo '<option value="' . $username . '">';
                        echo $username;
                        echo '</option>';
                    }
                    mysqli_free_result($result);
                }
                ?>
            </select>

        </div>
    </div>
        <div class="row form-group">
            <div class="col-md-2">
                <label for="cartid"> Enter Cart ID : </label>
            </div>   
            <div class="col-md-10">
                <select class="form-control" name="cartid" id="cartid">
                    <option value="">Choose Cart</option>
                    <?php
                    require_once("../api/OpenConnection.php");
                    $query = "select cartid from cartinfo";
                    $result = mysqli_query($con, $query);
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_row($result)) {
                            list($cartid) = $row;
                            echo '<option value="' . $cartid . '">';
                            echo $cartid;
                            echo '</option>';
                        }
                        mysqli_free_result($result);
                    }
                    ?>
                </select>
            </div>
        </div>
            <div class="row form-group">
                <div class="col-md-2">
                    <label for="orderdate"> Enter Order Date : </label>
                </div>
                <div class="col-md-10">
                    <input type="datetime" class="form-control" name="orderdate" id="orderdate"  value="<?php echo $orderdate; ?>">
                </div>        
            </div>

            <div class="row form-group">
                <div class="col-md-2">
                    <label for="shippingdate"> Enter Shipping Date : </label>
                </div>
                <div class="col-md-10">
                    <input type="datetime" class="form-control" name="shippingdate" id="shippingdate"  value="<?php echo $shippingdate; ?>">
                </div>        
            </div>

            <div class="row form-group">
                <div class="col-md-2">
                    <label for="orderstatus"> Enter Order Status : </label>
                </div>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="orderstatus" id="orderstatus"  value="<?php echo $orderstatus; ?>">
                </div>        
            </div>

            <div class="row form-group">
                <div class="col-md-2">
                    <label for="shippingaddress"> Enter Shipping Address: </label>
                </div>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="shippingaddress" id="orderdate"  value="<?php echo $shippingaddress; ?>">
                </div>        
            </div>

            <div class="row form-group">
                <div class="col-md-2">
                    <label for="paymentdetails"> Enter Payment Details: </label>
                </div>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="paymentdatails" id="paymentdetails"  value="<?php echo $paymentdetails; ?>">
                </div>        
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-primary btn-block" type="submit">Add Order Info</button>
                </div>
            </div>
            </form>
            <br>
            <?php
            if (isset($_SESSION["message"])) {
                $alert_class_name = "alert-success";
                if (isset($_SESSION["error"])) {
                    unset($_SESSION["error"]);
                    $alert_class_name = "alert-danger";
                }
                ?>
                <div class="alert <?php echo $alert_class_name; ?>">
                    <?php
                    echo $_SESSION["message"];
                    ?>
                </div>
                <?php
                unset($_SESSION["message"]);
            }
            unset($_SESSION["username"]);
            unset($_SESSION["cartid"]);
            unset($_SESSION["orderdate"]);
            unset($_SESSION["shippingdate"]);
            unset($_SESSION["orderstatus"]);
            unset($_SESSION["shippingaddress"]);
            unset($_SESSION["paymentdetails"]);
            ?>
            <?php include_once("footer.php"); ?>