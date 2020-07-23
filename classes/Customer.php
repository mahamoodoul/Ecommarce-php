<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/Database.php');
include_once($filepath . '/../helpers/FormatData.php');

?>

<?php

class Customer
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new FormatData();
    }

    public function customerREgistration($data)
    {

        $name = $this->fm->validation($data['name']);
        $address = $this->fm->validation($data['address']);
        $city = $this->fm->validation($data['city']);
        $country = $this->fm->validation($data['country']);
        $zip = $this->fm->validation($data['code']);
        $phone = $this->fm->validation($data['phone']);
        $email = $this->fm->validation($data['email']);
        // $password = $this->fm->validation($data['password']);

        $name = mysqli_real_escape_string($this->db->link, $name);
        $address = mysqli_real_escape_string($this->db->link, $address);
        $city = mysqli_real_escape_string($this->db->link, $city);
        $country = mysqli_real_escape_string($this->db->link, $country);
        $zip = mysqli_real_escape_string($this->db->link, $zip);
        $phone = mysqli_real_escape_string($this->db->link, $phone);
        $email = mysqli_real_escape_string($this->db->link, $email);
        $password = mysqli_real_escape_string($this->db->link, ($data['password']));

        if (empty($name) || empty($address) || empty($city) || empty($country) || empty($zip) || empty($phone)  || empty($email) || empty($password)) {

            $msg = "<span class='error'>Field must  not be empty</span>";
            return $msg;
        }
        // var_dump($email);
        // var_dump($country);
        // var_dump($password);
        // die();

        $mailQuery = "select * from tbl_customer where email='$email' limit 1";
        $mailCheck = $this->db->select($mailQuery);
        if ($mailCheck != false) {
            $msg = "<span class='error'>Email Already exist</span>";
            return $msg;
        } else {
            $query = "INSERT INTO tbl_customer(name,address,city,country,zip,phone,email,password) 
            VALUES('$name','$address','$city','$country','$zip','$phone','$email','$password')";
            $customerCreate = $this->db->insert($query);
            if ($customerCreate) {
                $msg = "<span class='success'>Account has been created Successfully.</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Something went wrong!</span>";
                return $msg;
            }
        }
    }

    public function customerLoigin($data)
    {
        $email = $this->fm->validation($data['email']);
        $password = $this->fm->validation($data['password']);
        $email = mysqli_real_escape_string($this->db->link, $email);
        $password = mysqli_real_escape_string($this->db->link, ($data['password']));
        if (empty($email) || empty($password)) {
            $msg = "<span class='error'>Field must not be empty</span>";
            return $msg;
        }
        // var_dump($email);
        // var_dump($password);
        // die();
        $query = "select * from tbl_customer where email='$email' and password='$password' ";
        $checkUser = $this->db->select($query);
        // var_dump($checkUser);
        // die();
        if ($checkUser != false) {
            $value = $checkUser->fetch_assoc();
            Session::set("customerLogin", true);
            Session::set("customerID", $value['id']);
            Session::set("customerName", $value['name']);
            header('Location:order.php');
        } else {
            $msg = "<span class='error'>Email & Password did not match</span>";
            return $msg;
        }
    }

    public function getCustomerData($id)
    {
        $query = "select * from tbl_customer where id='$id' ";
        $checkUserData = $this->db->select($query);
        return $checkUserData;
    }

    public function customerUpdate($data, $cusId)
    {
    
        $name = $this->fm->validation($data['name']);
        $address = $this->fm->validation($data['address']);
        $city = $this->fm->validation($data['city']);
        $country = $this->fm->validation($data['country']);
        $zip = $this->fm->validation($data['zip']);
        $phone = $this->fm->validation($data['phone']);
        $email = $this->fm->validation($data['email']);

        $name = mysqli_real_escape_string($this->db->link, $name);
        $address = mysqli_real_escape_string($this->db->link, $address);
        $city = mysqli_real_escape_string($this->db->link, $city);
        $country = mysqli_real_escape_string($this->db->link, $country);
        $zip = mysqli_real_escape_string($this->db->link, $zip);
        $phone = mysqli_real_escape_string($this->db->link, $phone);
        $email = mysqli_real_escape_string($this->db->link, $email);

        if (empty($name) || empty($address) || empty($city) || empty($country) || empty($zip) || empty($phone)  || empty($email)) {

            $msg = "<span  class='error'>Field must  not be empty</span>";
            return $msg;
        }

        $query = "UPDATE tbl_customer SET
                  name='$name',
                  address='$address',
                  city='$city',
                  country='$country',
                  zip='$zip',
                  phone='$phone',
                  email='$email' 
                  WHERE id='$cusId' ";
        $customerUpdate = $this->db->update($query);
        if ($customerUpdate) {
            $msg = "<span  class='success'>Details Updated Successfully.</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Something went wrong!</span>";
            return $msg;
        }
    }


   
}
