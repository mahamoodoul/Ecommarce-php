<?php include("inc/header.php") ?>

<style>
    .payment {
        width: 500px;
        min-height: 200px;
        text-align: center;
        border: 1px solid #ddd;
        margin: 0 auto;
        padding: 50px;
    }

    .payment h2 {
        border-bottom: 1px solid #ddd;
        margin-bottom: 40px;
        padding-bottom: 10px;
    }

    .payment a {
        background: #ff0000 none repeat scroll 0 0;
        border-radius: 3px;
        color: #fff;
        font-size: 25px;
        padding: 5px 30px;

    }

    .back a {
        width: 160px;
        margin: 5px auto 0;
        color: white;
        font-size: 25px;
        padding: 7px 0;
        text-align: center;
        display: block;
        background: #555;
        border: 1px solid #333;
        border-radius: 4px;
        margin-top: 30px;

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
            <div class="payment">
                <h2>Choose a Payment option</h2>
                <a href="paymentoffline.php">Offline Payment</a>
                <a href="online.php">Online Payment</a>
                <div class="back">
                    <a href="cart.php">Previous</a>
                </div>
            </div>

        </div>
        <div class="clear"></div>
    </div>
</div>
</div>
<?php include("inc/footer.php") ?>