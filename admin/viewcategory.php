<?php
include_once("header.php");
require_once("../api/OpenConnection.php");
?>
<br>
<h1> Category Information : </h1>
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
            <th>Category ID</th>
            <th>Category Name</th>
            <th>Description</th>
            <th colspan="2">Operations</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "select categoryid ,categoryname , description ";
        $query .= " from categoryinfo";
        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row["categoryid"] . '</td>';
                echo '<td>' . $row["categoryname"] . '</td>';
                echo '<td>' . $row["description"] . '</td>';
                echo '<td>';
                echo '<a class="btn btn-primary" href="deletecategory.php?categoryid=';
                echo urlencode($row["categoryid"]) . '" onclick="return confirm(\'Are You To Remove This Record\')">Delete This Category</a>';
                echo '</td>';
                echo '<td>';
                $functions = "setData('" . addslashes($row["categoryid"]) . "','" . addslashes($row["categoryname"]) . "','" . urlencode($row["description"]) . "')";
                echo '<button onclick="' . $functions . '" data-toggle="modal" data-target="#myModal" class="btn btn-primary">Edit This Record</button>';
                echo '</td>';
                echo '</tr>';
            }
            mysqli_free_result($result);
        } else {
            echo '<tr><td colspan="5" align="center">';
            echo 'There is no Category Details Saved in System';
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
                <h4 class="modal-title">Update Category Details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form method="post" action="updatecategory.php">
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label for="categoryid"> Enter Category ID : </label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="categoryid" id="categoryid" value="<?php echo $categoryid; ?>">
                        </div>        
                    </div>
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label for="categoryname"> Enter Category Name : </label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="categoryname" id="categoryname" value="<?php echo $categoryname; ?>">
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
                            <button class="btn btn-primary btn-block" type="submit">Add Category Details</button>
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
    function setData(cid, cname, desc) {
        $("#categoryid").val(decodeURI(cid.replace(/\+/g, ' ')));
        $("#categoryname").val(decodeURI(cname.replace(/\+/g, ' ')));
        $("#description").val(decodeURI(desc.replace(/\+/g, ' ')));
    }
</script>
<?php
require_once("../api/CloseConnection.php");
?>