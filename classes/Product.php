<?php
$filepath=realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/FormatData.php');

?>


<?php

class Product
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new FormatData();
    }

    public function productInsert($data, $file)
    {

        // var_dump($file);
        // var_dump($data);
        // die();
        $productname = $this->fm->validation($data['productname']);
        $catid = $this->fm->validation($data['catid']);
        $brandid = $this->fm->validation($data['brandid']);
        // $body = $this->fm->validation($data['body']);
        $price = $this->fm->validation($data['price']);
        // $type = $this->fm->validation($data['type']);

        $productname = mysqli_real_escape_string($this->db->link, $productname);
        $catid = mysqli_real_escape_string($this->db->link, $catid);
        $brandid = mysqli_real_escape_string($this->db->link, $brandid);
        $body = mysqli_real_escape_string($this->db->link, $data['body']);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);

        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        if (empty($productname) || empty($catid) || empty($brandid) || empty($body) || empty($price) || $type == null  || empty($file_name)) {

            $msg = "<span class='error'>Product field must  not be empty</span>";
            return $msg;
        } elseif ($file_size > 1048567) {
            $msg = "<span class='error'>Image Size should be less then 1MB!</span>";
            return $msg;
        } elseif (in_array($file_ext, $permited) === false) {
            $msg = "<span class='error'>You can upload only:-"
                . implode(', ', $permited) . "</span>";
            return $msg;
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tbl_product(productname,catid,brandid,body,price,image,type) 
                         VALUES('$productname','$catid','$brandid','$body','$price','$uploaded_image','$type')";
            $product_insert = $this->db->insert($query);
            if ($product_insert) {
                $msg = "<span class='success'>Product Inserted Successfully.</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Product Not Inserted !</span>";
                return $msg;
            }
        }
    }



    public function getAllProduct()
    {

        $query = "SELECT tbl_product.*,tb_category.catname,tbl_brand.name
                 FROM tbl_product
                 INNER JOIN tb_category
                 ON tbl_product.catid=tb_category.catid
                 INNER JOIN tbl_brand
                 ON tbl_product.brandid =tbl_brand.brandid
                 ORDER BY tbl_product.productid DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function getProductById($id)
    {
        $query = "SELECT * FROM tbl_product WHERE productid = '$id' ";
        $result = $this->db->select($query);
        return $result;
    }

    public function productUpdate($data, $file, $id)
    {
        $productname = $this->fm->validation($data['productname']);
        $catid = $this->fm->validation($data['catid']);
        $brandid = $this->fm->validation($data['brandid']);
        // $body = $this->fm->validation($data['body']);
        $price = $this->fm->validation($data['price']);
        // $type = $this->fm->validation($data['type']);

        $productname = mysqli_real_escape_string($this->db->link, $productname);
        $catid = mysqli_real_escape_string($this->db->link, $catid);
        $brandid = mysqli_real_escape_string($this->db->link, $brandid);
        $body = mysqli_real_escape_string($this->db->link, $data['body']);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);

        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        if (empty($productname) || empty($catid) || empty($brandid) || empty($body) || empty($price) || $type == null) {

            $msg = "<span class='error'>Product field must  not be empty</span>";
            return $msg;
        } else {


            if (!empty($file_name)) {           //there is a file  --- !empty 


                if ($file_size > 1048567) {
                    echo "<span class='error'>Image Size should be less then 1MB! </span>";
                } elseif (in_array($file_ext, $permited) === false) {
                    echo "<span class='error'>You can upload only:-"
                        . implode(', ', $permited) . "</span>";
                } else {
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query = "UPDATE tbl_product
                     SET
                     productname='$productname ',
                     catid=' $catid',
                     brandid=' $brandid',
                     body='$body',
                     price=' $price',
                     image='$uploaded_image ',
                     type='$type'
                     WHERE productid='$id' ";

                    $updated_row = $this->db->update($query);
                    if ($updated_row) {
                        $msg = "<span class='success'>Product Updated Successfully. </span>";
                        return $msg;
                    } else {
                        $msg = "<span class='error'>Product Did Not Updated !</span>";
                        return $msg;
                    }
                }
            } else {

                $query = "UPDATE tbl_product
                SET
                productname='$productname ',
                catid=' $catid',
                brandid=' $brandid',
                body='$body',
                price=' $price',
                type='$type'
                WHERE productid='$id' ";

                $updated_row = $this->db->update($query);
                if ($updated_row) {
                    $msg = "<span class='success'>Product Updated Successfully. </span>";
                    return $msg;
                } else {
                    $msg = "<span class='error'>Product Did Not Updated !</span>";
                    return $msg;
                }
            }
        }
    }

    public function delProduct($id)
    {

        $query = "DELETE FROM tbl_product WHERE productid='$id'";
        $deldata = $this->db->delete($query);
        if ($deldata) {
            $msg = "<span class='error'>Data Deleted Succesfully </span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Data did not deleted </span>";
            return $msg;
        }
    }

    public function getFeatureProduct(){
        $query = "SELECT * FROM tbl_product WHERE type = '0' ORDER BY productid DESC LIMIT 8 ";
        $result = $this->db->select($query);
        return $result;
    }


    public function getNewProduct(){
        $query = "SELECT * FROM tbl_product ORDER BY productid DESC LIMIT 4 ";
        $result = $this->db->select($query);
        return $result;
    }

    public function getSingleProducts($id){

        $query="SELECT product.*,category.catname,brand.name
                FROM tbl_product as product,tb_category as category, tbl_brand as brand
                WHERE product.catid=category.catid AND
                      product.brandid=brand.brandid AND
                      product.productid='$id'
                ";
        $result=$this->db->select($query);
        return $result;

    }
}
