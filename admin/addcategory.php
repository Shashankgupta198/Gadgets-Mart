<?php include_once("header.php"); ?>
<br>
<h1> Add New Category Details :- </h1>
<br>
<?php
$categoryid = isset($_SESSION["categoryid"]) ? $_SESSION["categoryid"] : "";
$categoryname = isset($_SESSION["categoryname"]) ? $_SESSION["categoryname"] : "";
$description = isset($_SESSION["description"]) ? $_SESSION["description"] : "";
?>
<form method="post" action="insertcategory.php">
    <div class="row form-group">
        <div class="col-md-2">
            <label for="categoryid"> Enter Category ID : </label>
        </div>
        <div class="col-md-10">
            <input type="text" class="form-control" name="categoryid" id="categoryid" value="<?php echo $categoryid;?>">
        </div>        
    </div>
    <div class="row form-group">
        <div class="col-md-2">
            <label for="categoryname"> Enter Category Name : </label>
        </div>
        <div class="col-md-10">
            <input type="text" class="form-control" name="categoryname" id="categoryname" value="<?php echo $categoryname;?>">
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
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-primary btn-block" type="submit">Add Category Details</button>
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
unset($_SESSION["categoryid"]);
unset($_SESSION["categoryname"]);
unset($_SESSION["description"]);
?>
<?php include_once("footer.php"); ?>