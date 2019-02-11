<?php
include_once("header.php");
require_once("../api/OpenConnection.php");
?>
<br>
<h1> Sub Category Information : </h1>
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
?>
<table class="table table-hover table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>Sub Category ID</th>
            <th>Category ID</th>
            <th>Sub Category Name</th>
            <th>Description</th>
            <th colspan="2">Operations</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "select subcategoryid , categoryid ,subcategoryname , description ";
        $query .= " from subcategoryinfo";
        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row["subcategoryid"] . '</td>';
                echo '<td>' . $row["categoryid"] . '</td>';
                echo '<td>' . $row["subcategoryname"] . '</td>';
                echo '<td>' . $row["description"] . '</td>';
                echo '<td>';
                echo '<a class="btn btn-primary" href="deletesubcategory.php?subcategoryid=';
                echo urlencode($row["subcategoryid"]) . '" onclick="return confirm(\'Are You To Remove This Record\')">Delete This Sub Category</a>';
                echo '</td>';
                echo '<td>';
                $functions = "setData('" . addslashes($row["subcategoryid"]) . "','" .($row["categoryid"]) . "','" . addslashes($row["subcategoryname"]) . "','" . urlencode($row["description"]) . "')";
                echo '<button onclick="' . $functions . '" data-toggle="modal" data-target="#myModal" class="btn btn-primary">Edit This Record</button>';
                echo '</td>';
                echo '</tr>';
            }
            mysqli_free_result($result);
        } else {
            echo '<tr><td colspan="5" align="center">';
            echo 'There is no Sub Category Details Saved in System';
            echo '</td></tr>';
        }
        ?>
    </tbody>
</table>
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Update Sub Category Details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form method="post" action="updatesubcategory.php">
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
            <label for="subcategoryname"> Enter Sub Category Name : </label>
        </div>
        <div class="col-md-10">
            <input type="text" class="form-control" name="subcategoryname" id="subcategoryname" value="<?php echo $subcategoryname; ?>">
        </div>        
    </div>
    <div class="row form-group">
        <div class="col-md-2">
            <label for="description"> Enter Description : </label>
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
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<?php include_once("footer.php"); ?>
<script>
    function setData(scid, cid, scname, desc) {
        $("#subcategoryid").val(decodeURI(scid.replace(/\+/g, ' ')));
        $("#categoryid").val(decodeURI(cid.replace(/\+/g, ' ')));
        $("#subcategoryname").val(decodeURI(scname.replace(/\+/g, ' ')));
        $("#description").val(decodeURI(desc.replace(/\+/g, ' ')));
    }
</script>
<?php
require_once("../api/CloseConnection.php");
?>