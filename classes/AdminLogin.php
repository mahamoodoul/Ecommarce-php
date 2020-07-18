<?php
include "../lib/Session.php";
Session::checkLogin();
include_once '../lib/Database.php';
include_once '../helpers/FormatData.php';

?>

<?php
class AdminLogin
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new FormatData();
    }

    public function adminlogin($username, $password)
    {
        $adminuser = $this->fm->validation($username);
        $adminpass = $this->fm->validation($password);

        $adminuser = mysqli_real_escape_string($this->db->link, $adminuser);
        $adminpass = mysqli_real_escape_string($this->db->link, $adminpass);

        if(empty($adminuser) || empty($adminpass)){
            $loginmsg="Username and passwor must not be empty";
            return $loginmsg;
        }else{
            $query="SELECT * FROM tbl_user WHERE username ='$adminuser' AND password = '$password'";
            $result=$this->db->select($query);
            if($result !=false){
                $value=$result->fetch_assoc();
                Session::set("adminlogin",true);
                Session::set("adminid",$value['id']);
                Session::set("adminuser",$value['username']);
                Session::set("adminname",$value['name']);
                header("Location:dashboard.php");
            }
            else{
                $loginmsg="Username and passwor did not match";
                return $loginmsg;
            }
        }
        
    }

}

?>