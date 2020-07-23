<?php include("inc/header.php") ?>

<style>
    .division {
        width: 50%;
        float: left;
    }

    .tblone {
        width: 500px;
        margin: 0 auto;
        border: 2px solid #ddd;
    }

    .tblone tr td {
        text-align: justify;
    }

    .tbl_tow {
        margin-right: 14px;
        margin-top: 12px;

        width: 60%;
        float: right;
        text-align: left;
        /* margin-top: 30px; */
        border: 2px solid #ddd;
        padding-left: 5px;
    }

    .tbl_tow tr td {
        text-align: justify;
        padding: 5px 10px;
    }

    .total-div {
        border-bottom: 3px solid black;
    }

    .order-now {
        padding-bottom: 30px;
    }

    .order-now a {
        width: 200px;
        margin: 20px auto 0;
        text-align: center;
        padding: 5px;
        font-size: 30px;
        display: block;
        background: #ff0000;
        color: #fff;
        border-radius: 10px;
    }
</style>


<?php
if (isset($_GET['orderId']) && $_GET['orderId'] == 'order') {

    $customerId = Session::get('customerID');
    $insertOrder=$ct->orderProduct($customerId);
    $deleteCart=$ct->delCustomer();
    header("Location:success.php");
}


?>



<?php
$loggedIn = Session::get("customerLogin");
if ($loggedIn == false) {
    header('Location:login.php');
}
?>


<div class="main">
    <div class="content">

        <div class="section group">
            <div class="division">
                <table class="tblone">
                    <tr>
                        <th width="20%">Product </th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                    </tr>

                    <?php
                    $getCart = $ct->getCartProducts();
                    $grandTotal = 0;
                    if ($getCart) {
                        while ($result = $getCart->fetch_assoc()) {


                    ?>
                            <tr>
                                <td><?php echo $result['productName']; ?></td>
                                <td><?php echo $result['price']; ?></td>
                                <td><?php echo $result['quantity']; ?></td>
                                <td>Tk. <?php
                                        $total = $result['price'] * $result['quantity'];
                                        echo $total
                                        ?>
                                </td>
                                <?php $grandTotal = $grandTotal + $total ?>

                            </tr>


                    <?php         }
                    }
                    ?>

                </table>


                <?php
                $sId = session_id();
                $cartInHeader = $ct->cartHintinHeadder($sId);
                if (isset($cartInHeader)) {
                ?>

                    <table class="tbl_tow">
                        <tr>
                            <th>Sub Total </th>
                            <td>:</td>
                            <td>TK.<?php echo $grandTotal; ?> </td>
                        </tr>
                        <tr>
                            <th>Total Quantity </th>
                            <td>:</td>
                            <td><?php echo $cartInHeader['totalQuantity'];  ?> </td>
                        </tr>


                        <tr class="total-div">
                            <th>VAT(10%) </th>
                            <td>:</td>
                            <td>TK. <?php echo ($grandTotal * (10 / 100)); ?> </td>
                        </tr>


                        <tr class="total-">
                            <th style="font-weight: bold; color:blue;">Grand Total</th>
                            <td style="font-weight: bold; ">:</td>
                            <td style="font-weight: bold;color:blue;">TK. <?php echo ($grandTotal + ($grandTotal * (10 / 100))); ?> </td>
                        </tr>
                    </table>
                <?php } ?>

            </div>



            <div class="division">
                <?php
                $id = Session::get("customerID");
                $getData = $customer->getCustomerData($id);
                if ($getData) {
                    while ($result = $getData->fetch_assoc()) {

                ?>

                        <table class="tblone">
                            <tr>
                                <td colspan="3">
                                    <h2>Your Personal Details</h2>
                                </td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td>:</td>
                                <td><?php echo $result['name']; ?></td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>:</td>
                                <td><?php echo $result['address']; ?></td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td>:</td>
                                <td><?php echo $result['city']; ?></td>
                            </tr>
                            <tr>
                                <td>Country</td>
                                <td>:</td>
                                <td><?php echo $result['country']; ?></td>
                            </tr>
                            <tr>
                                <td>Zip-Code</td>
                                <td>:</td>
                                <td><?php echo $result['zip']; ?></td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td>:</td>
                                <td><?php echo $result['phone']; ?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td><?php echo $result['email']; ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td> <a href="profileupdate.php">Update Details</a></td>

                            </tr>

                        </table>
                <?php }
                } ?>
            </div>

        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="order-now">
    <a href="?orderId=order">Order Now</a>
</div>
</div>
<?php include("inc/footer.php") ?>