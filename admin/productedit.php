<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/Category.php' ?>
<?php include '../classes/Brand.php' ?>
<?php include '../classes/Product.php' ?>


<?php
$cat = new Category();
$brand = new Brand();
$product = new Product();
?>

<?php
if (!isset($_GET['proid']) || $_GET['proid'] == NULL) {
    echo " <script> window.location ='productlist.php'; </script>";
} else {
    // $id = $_GET['brandid'];
    $id = preg_replace('/[^-a-zA-Z0-9]/', '', $_GET['proid']);
}
?>




<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $updateProduct = $product->productUpdate($_POST, $_FILES,$id);
}

?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Product</h2>
        <div class="block">
            <?php
            if (isset($updateProduct)) {
                echo $updateProduct;
            }
            ?>

            <?php
            $getproduct = $product->getProductById($id);
            if ($getproduct) {
                while ($data = $getproduct->fetch_assoc()) {

            ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <table class="form">

                            <tr>
                                <td>
                                    <label>Name</label>
                                </td>
                                <td>
                                    <input type="text" name="productname" value="<?php echo $data['productname']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Category</label>
                                </td>
                                <td>
                                    <select id="select" name="catid">
                                        <option>Select Category</option>

                                        <?php

                                        $getcat = $cat->getallcat();
                                        if ($getcat) {
                                            while ($result = $getcat->fetch_assoc()) {

                                        ?>
                                                <option <?php
                                                        if ($data['catid'] == $result['catid']) {
                                                        ?> selected="selected" <?php } ?> value="<?php echo $result['catid']; ?>">

                                                    <?php echo $result['catname']; ?> </option>
                                        <?php }
                                        } ?>

                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Brand</label>
                                </td>
                                <td>
                                    <select id="select" name="brandid">
                                        <option selected>Select Brand</option>

                                        <?php

                                        $getbrand = $brand->getallbrand();
                                        if ($getbrand) {
                                            while ($result = $getbrand->fetch_assoc()) {
                                        ?>
                                                <option <?php if ($data['brandid'] == $result['brandid']) { ?> selected="selected" <?php } ?> value="<?php echo $result['brandid'] ?>"> <?php echo $result['name'] ?> </option>
                                        <?php }
                                        } ?>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Description</label>
                                </td>
                                <td>
                                    <textarea class="tinymce" name="body"><?php echo $data['body']; ?> </textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Price</label>
                                </td>
                                <td>
                                    <input type="text" name="price" value="<?php echo $data['price']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Upload Image</label>
                                </td>
                                <td>
                                    <img height="40px" width="80px" src="<?php echo $data['image']; ?>" alt=""> <br />
                                    <input name="image" type="file" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Product Type</label>
                                </td>
                                <td>
                                    <select id="type" name="type">
                                        <option selected>Select Type</option>


                                        <?php if ($data['type'] == "0") { ?>
                                            <option selected="selected" value="0">Featured</option>
                                            <option value="1">Genarel</option>
                                        <?php } else { ?>
                                            <option selected="selected" value="1">Genarel</option>
                                            <option value="0">Featured</option>
                                        <?php  } ?>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="Update" />
                                </td>
                            </tr>
                        </table>
                    </form>

            <?php     }
            } ?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php'; ?>