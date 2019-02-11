<?php include_once("header.php"); ?>
<br>
<h1> Add New Cart Info :- </h1>
<br>
<?php
$username = isset($_SESSION["username"]) ? $_SESSION["username"] : "";
$cartdate = isset($_SESSION["cartdate"]) ? $_SESSION["cartdate"] : "";
$isorder = isset($_SESSION["isorder"]) ? $_SESSION["isorder"] : "";
?>
<form method="post" action="insertcartinfo.php">
    <div class="row form-group">
        <div class="col-md-2">
            <label for="username"> Enter Username : </label>
        </div>
        <div class="col-md-10">
            <input type="text" class="form-control" name="username" id="username" value="<?php echo $username;?>">
        </div>        
    </div>
    <div class="row form-group">
        <div class="col-md-2">
            <label for="cartdate"> Cart Date : </label>
        </div>
        <div class="col-md-10">
            <input type="date" class="form-control" name="cartdate" id="cartdate" value="<?php echo $cartdate;?>">
        </div>      
    </div>
    <div class="row form-group">
        <div class="col-md-2">
            <label for="isorder"> Enter Isorder : </label>
        </div>
        <div class="col-md-10">
            <input type="text" class="form-control" name="isorder" id="description"  value="<?php echo $isorder;?>">
        </div>        
    </div>
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-primary btn-block" type="submit">Add Cart Info</button>
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
unset($_SESSION["username"]);
unset($_SESSION["cartdate"]);
unset($_SESSION["isorder"]);
?>
<?php include_once("footer.php"); ?>