<?php
$filepath=realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/FormatData.php');

?>

<?php

class Category
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new FormatData();
    }

    public function catInsert($catname)
    {
        $catname = $this->fm->validation($catname);

        $catname = mysqli_real_escape_string($this->db->link, $catname);

        if (empty($catname)) {
            $msg = "<span class='error'>Category field must  not be empty</span>";
            return $msg;
        } else {
            $query = "INSERT INTO tb_category (catname) VALUES ('$catname') ";
            $catinsert = $this->db->insert($query);
            if ($catinsert) {
                $msg = "<span class='success'>Data succesfully inserted </span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Data did not entered succesfully inserted</span>";
                return $msg;
            }
        }
    }

    public function getallcat()
    {
        $query = "SELECT * FROM tb_category ORDER BY catid DESC";
        $result = $this->db->select($query);
        return $result;
    }


    public function getcatByID($id)
    {
        $query = "SELECT * FROM tb_category WHERE catid = '$id' ";
        $result = $this->db->select($query);
        return $result;
    }
    public function catUpdatebyId($catname, $id)
    {
        $catname = $this->fm->validation($catname);
        $catname = mysqli_real_escape_string($this->db->link, $catname);
        if (empty($catname)) {
            $msg = "<span class='error'>Category field must  not be empty</span>";
            return $msg;
        } else {
            $query = "UPDATE tb_category
                        SET 
                        catname= '$catname'
                        WHERE catid='$id'
                        ";
            $updaterow = $this->db->update($query);
            if ($updaterow) {
                $msg = "<span class='success'>Data succesfully updated </span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Data did not updated  </span>";
                return $msg;
            }
        }
    }


    public function delcatById($id)
    {
        $query = "DELETE FROM tb_category WHERE catid='$id'";
        $deldata = $this->db->delete($query);
        if ($deldata) {
            $msg = "<span class='error'>Data Deleted Succesfully </span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Data did not deleted </span>";
            return $msg;
        }
    }

    public function getCategoryProductsById($id){
        $query = "SELECT * FROM tbl_product WHERE catid='$id' ORDER BY catid DESC limit 8";
        $result = $this->db->select($query);
        return $result;
    }



}
?>