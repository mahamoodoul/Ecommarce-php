<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include "../classes/Brand.php" ?>


<?php
$bd = new Brand();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $brand = $_POST['brand'];
    $insertBrand = $bd->brandinsert($brand);
}

?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Brand Category</h2>
        <div class="block copyblock">

            <?php
            if (isset($insertBrand)) {
                echo $insertBrand;
            }

            ?>
            <form action="brandadd.php" method="post">
                <table class="form">
                    <tr>
                        <td>
                            <input type="text" name="brand" placeholder="Enter Brand Name..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>