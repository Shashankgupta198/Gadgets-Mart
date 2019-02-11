<?php include_once("header.php"); ?>
<br>
<h1> Add New Cart Item :- </h1>
<br>
<?php
$productid = isset($_SESSION["productid"]) ? $_SESSION["productid"] : "";
$quantity = isset($_SESSION["quantity"]) ? $_SESSION["quantity"] : "";
$price = isset($_SESSION["price"]) ? $_SESSION["price"] : "";
$cartid = isset($_SESSION["cartid"]) ? $_SESSION["cartid"] : "";
?>
<form method="post" action="insertcartitem.php">
    <div class="row form-group">
        <div class="col-md-2">
            <label for="productid"> Enter Product ID : </label>
        </div>
        <div class="col-md-10">
            <select class="form-control" name="productid" id="productid">
                <option value="">Choose Product ID</option>
                <?php
                require_once("../api/OpenConnection.php");
                $query = "select productid, productname from productinfo";
                $result = mysqli_query($con, $query);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_row($result)) {
                        list($productid, $productname) = $row;
                        echo '<option value="' . $productid . '">';
                        echo $productid . " [ " . $productname . " ]";
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
            <label for="quantity"> Enter Quantity : </label>
        </div>
        <div class="col-md-10">
            <input type="text" class="form-control" name="quantity" id="quantity" value="<?php echo $quantity; ?>">
        </div>      
    </div>
    <div class="row form-group">
        <div class="col-md-2">
            <label for="price"> Enter Price : </label>
        </div>
        <div class="col-md-10">
            <input type="text" class="form-control" name="price" id="price"  value="<?php echo $price; ?>">
        </div>        
    </div>
    
    <div class="row form-group">
        <div class="col-md-2">
            <label for="cartid"> Enter Cart ID : </label>
        </div>
        <div class="col-md-10">
            <select class="form-control" name="productid" id="productid">
                <option value="">Choose Cart ID</option>
                <?php
                require_once("../api/OpenConnection.php");
                $query = "select cartid from cartinfo";
                $result = mysqli_query($con, $query);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_row($result)) {
                        list($cartid) = $row;
                        echo '<option value="' . $cartid . '">';
                        echo $cartid ;
                        echo '</option>';
                    }
                    mysqli_free_result($result);
                }
                ?>
            </select>
        </div>        
    </div>
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-primary btn-block" type="submit">Add Cart Item</button>
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
unset($_SESSION["productid"]);
unset($_SESSION["quantity"]);
unset($_SESSION["price"]);
unset($_SESSION["cartid"]);
?>
<?php include_once("footer.php"); ?>