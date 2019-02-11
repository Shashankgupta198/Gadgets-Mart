<?php include_once("header.php"); ?>
<br>
<h1> Add New Company Details :- </h1>
<br>
<?php
$companyid = isset($_SESSION["companyid"]) ? $_SESSION["companyid"] : "";
$companyname = isset($_SESSION["companyname"]) ? $_SESSION["companyname"] : "";
$description = isset($_SESSION["description"]) ? $_SESSION["description"] : "";
?>
<form method="post" action="insertcompany.php">
    <div class="row form-group">
        <div class="col-md-2">
            <label for="companyid"> Enter Company ID : </label>
        </div>
        <div class="col-md-10">
            <input type="text" class="form-control" name="companyid" id="companyid" value="<?php echo $companyid;?>">
        </div>        
    </div>
    <div class="row form-group">
        <div class="col-md-2">
            <label for="companyname"> Enter Company Name: </label>
        </div>
        <div class="col-md-10">
            <input type="text" class="form-control" name="companyname" id="companyname" value="<?php echo $companyname;?>">
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
            <button class="btn btn-primary btn-block" type="submit">Add Company Details</button>
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
unset($_SESSION["companyid"]);
unset($_SESSION["companyname"]);
unset($_SESSION["description"]);
?>
<?php include_once("footer.php"); ?>