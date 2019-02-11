<?php
include_once("header.php");
require_once("../api/OpenConnection.php");
?>
<br>
<h1> Company Information : </h1>
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
            <th>Company ID</th>
            <th>Company Name</th>
            <th>Description</th>
            <th colspan="2">Operations</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "select companyid ,companyname , description ";
        $query .= " from companyinfo";
        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row["companyid"] . '</td>';
                echo '<td>' . $row["companyname"] . '</td>';
                echo '<td>' . $row["description"] . '</td>';
                echo '<td>';
                echo '<a class="btn btn-primary" href="deletecompany.php?companyid=';
                echo urlencode($row["companyid"]) . '" onclick="return confirm(\'Are You To Remove This Record\')">Delete This Company</a>';
                echo '</td>';
                echo '<td>';
                $functions = "setData('" . addslashes($row["companyid"]) . "','" . addslashes($row["companyname"]) . "','" . urlencode($row["description"]) . "')";
                echo '<button onclick="' . $functions . '" data-toggle="modal" data-target="#myModal" class="btn btn-primary">Edit This Record</button>';
                echo '</td>';
                echo '</tr>';
            }
            mysqli_free_result($result);
        } else {
            echo '<tr><td colspan="5" align="center">';
            echo 'There is no Company Details Saved in System';
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
                <h4 class="modal-title">Update Company Details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form method="post" action="updatecompany.php">
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label for="companyid"> Enter Company ID : </label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="companyid" id="companyid" value="<?php echo $companyid; ?>">
                        </div>        
                    </div>
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label for="companyname"> Enter Company Name: </label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="companyname" id="companyname" value="<?php echo $companyname; ?>">
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
                            <button class="btn btn-primary btn-block" type="submit">Add Company Details</button>
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
    function setData(coid, coname, desc) {
        $("#companyid").val(decodeURI(coid.replace(/\+/g, ' ')));
        $("#companyname").val(decodeURI(coname.replace(/\+/g, ' ')));
        $("#description").val(decodeURI(desc.replace(/\+/g, ' ')));
    }
</script>
<?php
require_once("../api/CloseConnection.php");
?>