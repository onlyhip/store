<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	/**
	 * 
	 */
	class customer
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		
		public function insert_customers($data){
			$name = mysqli_real_escape_string($this->db->link, $data['name']);
			$city = mysqli_real_escape_string($this->db->link, $data['city']);
			$email = mysqli_real_escape_string($this->db->link, $data['email']);
			$address = mysqli_real_escape_string($this->db->link, $data['address']);
			$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
			$password = mysqli_real_escape_string($this->db->link, md5($data['password']));
			if($name=="" || $city=="" || $email=="" || $address=="" || $phone =="" || $password ==""){
				$alert = "<p><span class='error'>Fields must be not empty</span></p>";
				return $alert;
			}else{
				$check_email = "SELECT * FROM tbl_customer WHERE email='$email' LIMIT 1";
				$result_check = $this->db->select($check_email);
				if($result_check){
					$alert = "<p><span class='error'>Email Already Existed ! Please Enter Another Email</span></p>";
					return $alert;
				}else{
					$query = "INSERT INTO tbl_customer(name,city,email,address,phone,password) VALUES('$name','$city','$email','$address','$phone','$password')";
					$result = $this->db->insert($query);
					if($result){
						$alert = "<p><span class='success'>Customer Created Successfully</span></p>";
						return $alert;
					}else{
						$alert = "<p><span class='error'>Customer Created Not Successfully</span></p>";
						return $alert;
					}
				}
			}
		}
		public function login_customers($data){
			$email = mysqli_real_escape_string($this->db->link, $data['email']);
			$password = mysqli_real_escape_string($this->db->link, md5($data['password']));
			if($email=='' || $password==''){
				$alert = "<p><span class='error'>Password and Email must be not empty</span></p>";
				return $alert;
			}else{
				$check_login = "SELECT * FROM tbl_customer WHERE email='$email' AND password='$password'";
				$result_check = $this->db->select($check_login);
				if($result_check){

					$value = $result_check->fetch_assoc();
					Session::set('customer_login',true);
					Session::set('customer_id',$value['id']);
					Session::set('customer_name',$value['name']);
					$alert = "<p><span><a class ='error' href='index.php'>Đến trang chủ để mua hàng</a></span></p> <p><span class ='error'><a href='cart.php?id=live'>Đến giỏ hàng để thanh toán</a></span></p>";
					return $alert;
				}else{
					$alert = "<p><span class='error'>Email or Password doesn't match</span></p>";
					return $alert;
				}
			}
		}
		public function show_customers($id){
			$query = "SELECT * FROM tbl_customer WHERE id='$id'";
			$result = $this->db->select($query);
			return $result;
		}
		public function update_customers($data, $id){
			$name = mysqli_real_escape_string($this->db->link, $data['name']);
			$city = mysqli_real_escape_string($this->db->link, $data['city']);
			$email = mysqli_real_escape_string($this->db->link, $data['email']);
			$address = mysqli_real_escape_string($this->db->link, $data['address']);
			$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
			
			if($name=="" || $email=="" || $address=="" || $phone ==""){
				$alert = "<p><span class='error'>Fields must be not empty</span></p>";
				return $alert;
			}else{
				$query = "UPDATE tbl_customer SET name='$name',city = '$city',email='$email',address='$address',phone='$phone' WHERE id ='$id'";
				$result = $this->db->insert($query);
				if($result){
						$alert = "<p><span class='success'>Customer Updated Successfully</span></p>";
						return $alert;
				}else{
						$alert = "<p><span class='error'>Customer Updated Not Successfully</span></p>";
						return $alert;
				}
				
			}
		}
		
		


	}
?>