<?php include("inc/header.php") ?>

<?php
$login = Session::get("customerLogin");
if ($login == false) {
    header('Location:login.php');
}



?>
<style>
    .not-found h2 {
        font-size: 100px;
        line-height: 130px;
        text-align: center;
    }

    .not-found h2 span {
        display: block;
        color: red;
        font-size: 170px;
    }
</style>

<div class="main">
    <div class="content">
        <div class="section group">
            <div class="order">
                <h2>Your Order Details</h2>

                <table class="tblone">
                    <tr>
                        <th>No.</th>
                        <th>Product Name</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>

                    <?php
                    $getorder = $ct->getOrderProducts();
                    // var_dump($getorder);
                    // // die();
                    $grandTotal = 0;
                    $i = 0;
                    if ($getorder) {
                        while ($result = $getorder->fetch_assoc()) {
                            $i++;

                    ?>
                            <tr>
                                <td> <?php echo $i; ?></td>
                                <td><?php echo $result['productName']; ?></td>
                                <td><img src="admin/<?php echo $result['image']; ?>" alt="" /></td>
                                <td> $<?php echo $result['price']; ?></td>
                                <td><?php echo $result['quantity']; ?></td>

                                <td>$<?php
                                        $total = $result['price'] * $result['quantity'];
                                        echo $total ?>
                                </td>
                                <td><?php echo $fm->formatDate($result['date']); ?></td>


                                <td><?php if ($result['status'] == "0") {
                                        echo "Pending";
                                    ?>
                                <td>N/A</td>
                            <?php  } else {
                                        echo "Deliverd";
                            ?>
                                <td><a onclick="return confirm('Are you Sure to Remove!!')" href="?removeProduct=<?php echo $result['cartId']; ?>">X</a></td>
                            <?php  } ?></td>


                            </tr>


                    <?php         }
                    }
                    ?>





                    <?php
                    $sId = session_id();
                    $cartInHeader = $ct->cartHintinHeadder($sId);
                    // if (isset($cartInHeader)) {
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include("inc/footer.php") ?>