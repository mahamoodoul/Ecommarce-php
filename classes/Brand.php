<?php
$filepath=realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/FormatData.php');

?>


<?php

class Brand
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new FormatData();
    }

    public function brandinsert($brand)
    {
        $brandname = $this->fm->validation($brand);

        $brandname = mysqli_real_escape_string($this->db->link, $brandname);

        if (empty($brandname)) {
            $msg = "<span class='error'>Brand field must  not be empty</span>";
            return $msg;
        } else {
            $query = "INSERT INTO tbl_brand (name) VALUES ('$brandname') ";
            $brandInsert = $this->db->insert($query);
            if ($brandInsert) {
                $msg = "<span class='success'>Brand Data succesfully inserted </span>";
                return $msg;
            } else {
                $msg = "<span class='error'> BRand Data did not entered succesfully inserted</span>";
                return $msg;
            }
        }
    }

    public function getallbrand()
    {
        $query = "SELECT * FROM tbl_brand ORDER BY brandid DESC";
        $result = $this->db->select($query);
        return $result;
    }


    public function getBrandByID($id)
    {
        $query = "SELECT * FROM tbl_brand WHERE brandid = '$id' ";
        $result = $this->db->select($query);
        return $result;
    }
    public function brandUpdatebyId($brandname, $id)
    {
        $brandname = $this->fm->validation($brandname);
        $brandname = mysqli_real_escape_string($this->db->link, $brandname);
        if (empty($brandname)) {
            $msg = "<span class='error'>Brand field must  not be empty</span>";
            return $msg;
        } else {
            $query = "UPDATE tbl_brand
                        SET 
                        name= '$brandname'
                        WHERE brandid='$id'
                        ";
            $updaterow = $this->db->update($query);
            if ($updaterow) {
                $msg = "<span class='success'>Brand Data succesfully updated </span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Brand Data did not updated  </span>";
                return $msg;
            }
        }
    }


    public function delbrandById($id)
    {
        $query = "DELETE FROM tbl_brand WHERE brandid='$id'";
        $deldata = $this->db->delete($query);
        if ($deldata) {
            $msg = "<span class='error'>Brand Data Deleted Succesfully </span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Brand Data did not deleted </span>";
            return $msg;
        }
    }
}

?>