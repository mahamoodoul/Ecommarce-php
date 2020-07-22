<?php include("inc/header.php") ?>

<style>
    .tblone {
        width: 550px;
        margin: 0 auto;
        border: 2px solid #ddd;
    }

    .tblone tr td {
        text-align: justify;
    }

    .tblone input[type="text"] {
        width: 400px;
        padding: 5px;
        font-size: 15px;
    }

    .update-btn {
        margin-left: 60px;
        width: 100px;
        height: 30px;
        border-radius: 15px !important;
        border: 1px solid darkcyan;
    }

    
</style>


<?php
$cusId = Session::get("customerID");
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $updateCustomer = $customer->customerUpdate($_POST, $cusId);
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
            <?php
            $id = Session::get("customerID");
            $getData = $customer->getCustomerData($id);
            if ($getData) {
                while ($result = $getData->fetch_assoc()) {

            ?>
                    <form action="" method="POST">

                        <table class="tblone">

                            <?php
                            if (isset($updateCustomer)) {
                                echo "<tr><td colspan='2'>" . $updateCustomer . "</td> </tr>";
                            }
                            ?>
                            <tr>
                                <td colspan="2">
                                    <h2>Update Personal Details</h2>
                                </td>
                            </tr>
                            <tr>
                                <td>Name</td>

                                <td> <input value="<?php echo $result['name']; ?>" type="text" name="name" id=""></td>
                            </tr>
                            <tr>
                                <td>Address</td>

                                <td> <input value="<?php echo $result['address']; ?>" type="text" name="address" id=""></td>
                            </tr>
                            <tr>
                                <td>City</td>

                                <td> <input value="<?php echo $result['city']; ?>" type="text" name="city" id=""></td>
                            </tr>
                            <tr>
                                <td>Country</td>

                                <td> <input value="<?php echo $result['country']; ?>" type="text" name="country" id=""></td>
                            </tr>
                            <tr>
                                <td>Zip-Code</td>

                                <td> <input value="<?php echo $result['zip']; ?>" type="text" name="zip" id=""></td>
                            </tr>
                            <tr>
                                <td>Phone</td>

                                <td> <input value="<?php echo $result['phone']; ?>" type="text" name="phone" id=""></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td> <input value="<?php echo $result['email']; ?>" type="text" name="email" id=""></td>
                            </tr>


                            <tr class="margin-btn">
                                <td></td>
                                <td>
                                    <?php
                                    $cartCheck = $ct->checkCart();
                                    if ($cartCheck) {
                                    ?>
                                        <button class="update-btn"><a href="payment.php">Back</a></button>

                                    <?php } else { ?>
                                        <button class="update-btn"><a href="profile.php">Back</a></button>
                                    <?php } ?>
                                    <input class="update-btn" type="submit" name="submit" value="Update"></td>



                            </tr>

                        </table>
                    </form>
            <?php }
            } ?>

        </div>

        <div class="clear"></div>
    </div>
</div>

</div>
<?php include("inc/footer.php") ?>