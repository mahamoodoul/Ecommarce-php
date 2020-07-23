<?php include("inc/header.php") ?>

<style>
    .psuccess {
        width: 500px;
        min-height: 200px;
        text-align: center;
        border: 1px solid #ddd;
        margin: 0 auto;
        padding: 20px;
    }

    .psuccess h2 {
        border-bottom: 1px solid #ddd;
        margin-bottom: 20px;
        padding-bottom: 10px;
    }

    .psuccess p {
        line-height: 25px;

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
            <div class="psuccess">
                <h2>Success</h2>
                <?php
                $cusid = Session::get("customerID");
                $gettotal = $ct->getTotal($cusid);
                $sum = 0;
                if ($gettotal) {

                    while ($result = $gettotal->fetch_assoc()) {
                        $price = $result['price'];
                        $sum = $sum + $price;
                    }
                }

                ?>
                <p>Total Payable Amount(Including Vat) :$
                    <?php
                   
                        $vat = $sum * 0.1;
                        $total = $sum + $vat;
                        echo $total;
                    ?>
                </p>
                <p>Thanks for being with us.we received your order.Here is your Order Details
                    <a href="orderdetails.php">Visit Here</a>
                </p>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
</div>
</div>
<?php include("inc/footer.php") ?>