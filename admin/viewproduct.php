<?php
include_once("header.php");
require_once("../api/OpenConnection.php");
?>
<br>
<h1> Product Information : </h1>
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
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Sub Category ID</th>
            <th>Company ID</th>
            <th>Price</th>
            <th>Description</th>
            <th>Discount</th>
            <th colspan="2">Operations</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "select productid, productname , subcategoryid ,companyid, price, description, discount ";
        $query .= " from productinfo";
        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row["productid"] . '</td>';
                echo '<td>' . $row["productname"] . '</td>';
                echo '<td>' . $row["subcategoryid"] . '</td>';
                echo '<td>' . $row["companyid"] . '</td>';
                echo '<td>' . $row["price"] . '</td>';
                echo '<td>' . $row["description"] . '</td>';
                echo '<td>' . $row["discount"] . '</td>';
                echo '<td>';
                echo '<a class="btn btn-primary" href="deleteproduct.php?productid=';
                echo urlencode($row["productid"]) . '" onclick="return confirm(\'Are You To Remove This Record\')">Delete This Product</a>';
                echo '</td>';
                echo '<td>';
                $functions = "setData('" . addslashes($row["productid"]) . "','" . addslashes($row["productname"]) . "','" . addslashes($row["subcategoryid"]) . "','" . addslashes($row["companyid"]) . "','" . addslashes($row["price"]) . "','" . urlencode($row["description"]) . "','" . addslashes($row["discount"]) . "')";
                echo '<button onclick="' . $functions . '" data-toggle="modal" data-target="#myModal" class="btn btn-primary">Edit This Record</button>';
                echo '</td>';
                echo '</tr>';
            }
            mysqli_free_result($result);
        } else {
            echo '<tr><td colspan="5" align="center">';
            echo 'There is no Product Details Saved in System';
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
                <h4 class="modal-title">Update Product Details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form method="post" action="updateproduct.php">
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label for="productname"> Enter Product Name : </label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="productname" id="productname" value="<?php echo $productname; ?>">
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
                            <input type="number" class="form-control" name="price" id="price" value="<?php echo $price; ?>">
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

                    <div class="row form-group">
                        <div class="col-md-2">
                            <label for="discount"> Enter Discount : </label>
                        </div>
                        <div class="col-md-10">
                            <input type="number" class="form-control" name="discount" id="discount" value="<?php echo $discount; ?>">
                        </div>        
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary btn-block" type="submit">Add Product Details</button>
                        </div>
                    </div>
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
    function setData(pid,pname,scid, coid, price, desc, disc) {
        $("#productid").val(decodeURI(pid.replace(/\+/g, ' ')));
        $("#productname").val(decodeURI(pname.replace(/\+/g, ' ')));
        $("#subcategoryid").val(decodeURI(scid.replace(/\+/g, ' ')));
        $("#companyid").val(decodeURI(coid.replace(/\+/g, ' ')));
        $("#price").val(decodeURI(price.replace(/\+/g, ' ')));
        $("#description").val(decodeURI(desc.replace(/\+/g, ' ')));
        $("#subcategoryid").val(decodeURI(disc.replace(/\+/g, ' ')));
    }
</script>
<?php
require_once("../api/CloseConnection.php");
?>