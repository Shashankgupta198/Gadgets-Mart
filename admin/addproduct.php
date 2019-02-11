<?php include_once("header.php"); ?>
<br>
<h1> Add New Product Details :- </h1>
<br>
<?php
$productname = isset($_SESSION["productname"]) ? $_SESSION["productname"] : "";
$subcategoryid = isset($_SESSION["subcategoryid"]) ? $_SESSION["subcategoryid"] : "";
$companyid = isset($_SESSION["companyid"]) ? $_SESSION["companyid"] : "";
$price = isset($_SESSION["price"]) ? $_SESSION["price"] : "";
$description = isset($_SESSION["description"]) ? $_SESSION["description"] : "";
$discount = isset($_SESSION["discount"]) ? $_SESSION["discount"] : "";
?>
<form method="post" action="insertproduct.php">
    <div class="row form-group">
        <div class="col-md-2">
            <label for="productname"> Enter Product Name : </label>
        </div>
        <div class="col-md-10">
            <input type="text" class="form-control" name="productname" id="productname" value="<?php echo $productname;?>">
        </div>        
    </div>  
    <div class="row form-group">
        <div class="col-md-2">
            <label for="subcategoryid"> Enter Sub Category ID: </label>
        </div>

        <div class="col-md-10">
            <select class="form-control" name="subcategoryid" id="subcategoryid">
                <option value="">Choose Any Sub Category</option>
                <?php
                require_once("../api/OpenConnection.php");
                $query = "select subcategoryid,subcategoryname from subcategoryinfo";
                $result = mysqli_query($con, $query);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_row($result)) {
                        list($subcategoryid, $subcategoryname) = $row;
                        echo '<option value="' . $subcategoryid . '">';
                        echo $subcategoryname . " [ " . $subcategoryname . " ]";
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
            <label for="companyid"> Enter Company ID : </label>
        </div>
        <div class="col-md-10">
            <select class="form-control" name="companyid" id="companyid">
                <option value="">Choose Any Company</option>
                <?php
                require_once("../api/OpenConnection.php");
                $query = "select companyid,companyname from companyinfo";
                $result = mysqli_query($con, $query);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_row($result)) {
                        list($companyid, $companyname) = $row;
                        echo '<option value="' . $companyid . '">';
                        echo $companyid . " [ " . $companyname . " ]";
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
            <label for="price"> Enter Price : </label>
        </div>
        <div class="col-md-10">
            <input type="text" class="form-control" name="price" id="price" value="<?php echo $price;?>">
        </div>        
    </div>
    <div class="row form-group">
        <div class="col-md-2">
            <label for="description"> Enter Description : </label>
        </div>
        <div class="col-md-10">
            <input type="text" class="form-control" name="description" id="description"  value="<?php echo $description;?>">
        </div>        
    </div>
    
    <div class="row form-group">
        <div class="col-md-2">
            <label for="discount"> Enter Discount : </label>
        </div>
        <div class="col-md-10">
            <input type="text" class="form-control" name="discount" id="discount" value="<?php echo $discount;?>">
        </div>        
    </div>
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-primary btn-block" type="submit">Add Product Details</button>
        </div>
    </div>
</form>
<br>
<?php
if (isset($_SESSION["message"])) {
    $alert_class_name = "alert-success";
    if(isset($_SESSION["error"])){
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
unset($_SESSION["productname"]);
unset($_SESSION["subcategoryid"]);
unset($_SESSION["companyid"]);
unset($_SESSION["price"]);
unset($_SESSION["description"]);
unset($_SESSION["discount"]);
?>
<?php include_once("footer.php"); ?>