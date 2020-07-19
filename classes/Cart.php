<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/Database.php');
include_once($filepath . '/../helpers/FormatData.php');

?>


<?php

class Cart
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new FormatData();
    }

    public function addToCart($quantity, $id)
    {

        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $productId = mysqli_real_escape_string($this->db->link, $id);
        $sId = session_id();

        $squery = "select * from tbl_product where productid='$id'";
        $result = $this->db->select($squery)->fetch_assoc();
        $productName = $result['productname'];
        $price = $result['price'];
        $image = $result['image'];

        $checkQuantity = "select * from tbl_cart where productId='$id' and sId='$sId'";
        $hasQuantity = $this->db->select($checkQuantity);

        if ($hasQuantity) {
            $quantityCheck = $hasQuantity->fetch_assoc();
            $existQuantity = $quantityCheck['quantity'];
            $newQuantity = $existQuantity + $quantity;

            $updatequery = "UPDATE tbl_cart
                    SET 
                    quantity= '$newQuantity'
                    WHERE productId='$productId'";
            $updateQuantity = $this->db->update($updatequery);
            if ($updateQuantity) {
                header('Location:cart.php');
            } else {
                header('Location:404.php');
            }
        } else {

            $queryInsert = "INSERT INTO tbl_cart(sId,productId,productName,price,quantity,image) 
            VALUES('$sId','$productId','$productName','$price','$quantity','$image')";
            $insertCart = $this->db->insert($queryInsert);
            if ($insertCart) {
                header('Location:cart.php');
            } else {
                header('Location:404.php');
            }
        }
    }

    public function getCartProducts()
    {
        $sId = session_id();
        $query = "select * from tbl_cart where sId='$sId'";
        $result = $this->db->select($query);
        return $result;
    }
    public function updateCartQuantity($cartId, $quantity)
    {
        $cartId = mysqli_real_escape_string($this->db->link, $cartId);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        if ($quantity >= 1) {

            $quantityUpdate = "UPDATE tbl_cart
            SET 
            quantity= '$quantity'
            WHERE cartId='$cartId'";
            $updatedQuantity = $this->db->update($quantityUpdate);
            if ($updatedQuantity) {
                $msg = "<span class='success'>Quantity Updated  </span>";
                header('Location:cart.php');
                return $msg;
            } else {
                $msg = "<span class='error'>Quantity did not Updated  </span>";
                return $msg;
            }
        } else {

            $msg = "<span class='error'>please select at least one quantity </span>";
            return $msg;
        }
    }

    public function delCartProduct($id)
    {
        $query = "DELETE FROM tbl_cart WHERE cartId='$id'";
        $delCartData = $this->db->delete($query);
        if ($delCartData) {
            $msg = '<span style="margin-left:570px;" class="error" >Removed this product item from cart </span>';
            header('Location:cart.php');
            return $msg;
        } else {
            $msg = "<span style='margin-left:30px;' class='error'>Product did not removed  </span>";
            return $msg;
        }
    }


    public function cartHintinHeadder($sId)
    {
        $cartInfo = "select * from tbl_cart where sId='$sId'";
        $cartInfoDetails = $this->db->select($cartInfo);


        if ($cartInfoDetails) {
            $total = 0;
            $grandtotal = 0;
            $productCout = 0;
            $totalQuantity = 0;
            while ($data = $cartInfoDetails->fetch_assoc()) {
                $productCout++;
                $totalQuantity = $totalQuantity + $data['quantity'];
                $total = $data['price'] * $data['quantity'];
                $grandtotal = $grandtotal + $total;
            }
            $cartData = array();
            $cartData['count'] = $productCout;
            $cartData['grandTotal'] = $grandtotal;
            $cartData['totalQuantity'] = $totalQuantity;
            return $cartData;
        }
    }
}
