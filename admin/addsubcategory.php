<?php include_once("header.php"); ?>
<br>
<h1> Add New Sub Category Details :- </h1>
<br>
<?php
$subcategoryid = isset($_SESSION["subcategoryid"]) ? $_SESSION["subcategoryid"] : "";
$categoryid = isset($_SESSION["categoryid"]) ? $_SESSION["categoryid"] : "";
$subcategoryname = isset($_SESSION["subcategoryname"]) ? $_SESSION["subcategoryname"] : "";
$description = isset($_SESSION["description"]) ? $_SESSION["description"] : "";
?>
<form method="post" action="insertsubcategory.php">
    <div class="row form-group">
        <div class="col-md-2">
            <label for="subcategoryid"> Enter Sub Category ID: </label>
        </div>
        <div class="col-md-10">
            <input type="text" class="form-control" name="subcategoryid" id="subcategoryid" value="<?php echo $subcategoryid; ?>">
        </div>        
    </div>
    <div class="row form-group">
        <div class="col-md-2">
            <label for="categoryid"> Enter Category ID : </label>
        </div>

        <div class="col-md-10">
            <select class="form-control" name="categoryid" id="categoryid">
                <option value="">Choose Any Category</option>
                <?php
                require_once("../api/OpenConnection.php");
                $query = "select categoryid,categoryname from categoryinfo";
                $result = mysqli_query($con, $query);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_row($result)) {
                        list($categoryid, $categoryname) = $row;
                        echo '<option value="' . $categoryid . '">';
                        echo $categoryid . " [ " . $categoryname . " ]";
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
            <label for="subcategoryname"> Enter Sub Category Name: </label>
        </div>
        <div class="col-md-10">
            <input type="text" class="form-control" name="subcategoryname" id="subcategoryname" value="<?php echo $subcategoryname; ?>">
        </div>        
    </div>
    <div class="row form-group">
        <div class="col-md-2">
            <label for="description"> Enter Description: </label>
        </div>
        <div class="col-md-10">
            <input type="text" class="form-control" name="description" id="description"  value="<?php echo $description; ?>">
        </div>        
    </div>
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-primary btn-block" type="submit">Add Sub Category Details</button>
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
unset($_SESSION["subcategoryid"]);
unset($_SESSION["categoryid"]);
unset($_SESSION["subcategoryname"]);
unset($_SESSION["description"]);
?>
<?php include_once("footer.php"); ?>