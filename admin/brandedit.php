<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include "../classes/Brand.php" ?>


<?php
if (!isset($_GET['brandid']) || $_GET['brandid'] == NULL) {
    echo " <script> window.location ='brandlist.php'; </script>";
} else {
    // $id = $_GET['brandid'];
    $id=preg_replace('/[^-a-zA-Z0-9]/','',$_GET['brandid']);

}



?>
<?php
$bd = new Brand();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $brandname = $_POST['brandname'];
    $updateBrand = $bd->brandUpdatebyId($brandname, $id);
}

?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Brand</h2>
        <div class="block copyblock">

            <?php
            if (isset($updateBrand)) {
                echo $updateBrand;
            }

            ?>
            <?php
            $getbrand = $bd->getBrandByID($id);
            if ($getbrand) {
                while ($result = $getbrand->fetch_assoc()) {



            ?>
                    <form action="" method="post">
                        <table class="form">
                            <tr>
                                <td>
                                    <input type="text" name="brandname" value="<?php echo $result['name']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input class="btn-design" type="submit" name="submit" Value="Save" />
                                </td>
                                <td>
                                    <a class="btn-design " href="brandlist.php"> Back</a>
                                </td>
                            </tr>
                        </table>
                    </form>

            <?php      }
            } ?>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>