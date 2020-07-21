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
</style>
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
        <div class="clear"></div>
    </div>
</div>
</div>
<?php include("inc/footer.php") ?>