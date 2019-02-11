<?php include_once("header.php"); ?>
<br>
<h1> Add New Photo :- </h1>
<br>
<?php
$photoname = isset($_SESSION["photoname"]) ? $_SESSION["photoname"] : "";
$productid = isset($_SESSION["productid"]) ? $_SESSION["productid"] : "";
?>
<form method="post" action="insertphoto.php" enctype="multipart/form-data">
    <div class="row form-group">
        <div class="col-md-2">
            <label for="photoname"> Enter Photoname: </label>
        </div>
        <div class="col-md-10">
            <input type="file" class="form-control" name="photoname" id="photoname">
        </div>        
    </div>  
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
                        echo $productid . " [ " . $productname . " ]" ;
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
            <button class="btn btn-primary btn-block" name="action" type="submit">Add Photo Details</button>
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
unset($_SESSION["photoname"]);
unset($_SESSION["productid"]);
?>
<?php include_once("footer.php"); ?>