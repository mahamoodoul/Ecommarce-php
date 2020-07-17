<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include "../classes/Category.php" ?>


<?php
if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
    echo " <script> window.location ='catlist.php'; </script>";
} else {
    $id = $_GET['catid'];
}



?>
<?php
$cat = new Category();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $catname = $_POST['catname'];
    $updateCat = $cat->catUpdatebyId($catname, $id);
}

?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Category</h2>
        <div class="block copyblock">

            <?php
            if (isset($updateCat)) {
                echo $updateCat;
            }

            ?>
            <?php
            $getcat = $cat->getcatByID($id);
            if ($getcat) {
                while ($result = $getcat->fetch_assoc()) {



            ?>
                    <form action="" method="post">
                        <table class="form">
                            <tr>
                                <td>
                                    <input type="text" name="catname" value="<?php echo $result['catname']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input class="btn-design" type="submit" name="submit" Value="Save" />
                                </td>
                                <td>
                                    <a class="btn-design " href="catlist.php"> Back</a>
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