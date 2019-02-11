<?php include_once("header.php"); ?>
<br>
<h1> Welcome To Admin Section </h1>

<?php include_once("footer.php"); ?>
<?php
$query = "select companyid , companyname from companyinfo";
$result = mysqli_query($con, $query);
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<li><a href="#">' . $row["companyname"] . '</a></li>';
    }
}
?>

<?php
$query = "select productid,productname,price,description, ";
$query .= " ifnull( (select concat(photoid,'.',extname) from productphoto ";
$query .= " where productphoto.productid = productinfo.productid limit 1 ),'nophoto.jpg') as photoname ";
$query .= " from productinfo ";
$query .= " order by rand() limit 4";
$result = mysqli_query($con, $query);
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $img_path = "gad_photos/" . $row["photoname"];
        ?>
        <li class = "span3">
            <div class = "thumbnail">
                <i class = "tag"></i>
                <a href = "product_details.php?productid=<?php echo $row["productid"]; ?>"><img src = "<?php echo $img_path; ?>" width = "160px" height = "160px" alt = ""></a>
                <div class = "caption">
                    <h5><?php echo $row["productname"];
        ?></h5>
                    <h4><a class = "btn" href = "product_details.html">VIEW</a> <span class = "pull-right">Rs.<?php echo $row["price"];
        ?></span></h4>
                </div>
            </div>
        </li>
        <?php
    }
}
?>

<ul class = "thumbnails">
    <?php
    $query = "select productid,productname,price,description, ";
    $query .= " ifnull( (select concat(photoid,'.',extname) from productphoto ";
    $query .= " where productphoto.productid = productinfo.productid limit 1 ),'nophoto.jpg') as photoname ";
    $query .= " from productinfo ";
    $query .= " order by rand() limit 6";
    $result = mysqli_query($con, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $img_path = "gad_photos/" . $row["photoname"];
            ?>
            <li class="span3">
                <div class="thumbnail">
                    <a  href="product_details.php?productid=<?php echo $row["productid"]; ?>"><img src="<?php echo $img_path; ?>" width="160px" height="160px" alt=""/></a>
                    <div class="caption">
                        <h5><?php echo $row["productname"]; ?></h5>
                        <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">Rs.<?php echo $row["price"] ?></a></h4>
                    </div>
                </div>
            </li>
            <?php
        }
    }
    ?>                            
</ul>        