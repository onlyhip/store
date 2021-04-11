<?php

    include_once '../lib/database.php'; 
    include_once '../helper/format.php';
?>


<?php
    class Product
    {

        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function insert_product($data,$files){
            $productName = $this->fm->validation($data['productName']);
            $brand = $this->fm->validation($data['brand']);
            $category = $this->fm->validation($data['category']);
            $description = $this->fm->validation($data['description']);
            $price = $this->fm->validation($data['price']);
            $type = $this->fm->validation($data['type']);
    
            $permited  = array('jpg', 'jpeg', 'png', 'gif');
			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;

            if($productName=="" || $brand=="" || $category=="" || $description=="" || $price=="" || $type=="" || $file_name ==""){
				$alert = "<span class='error'>Fields must be not empty</span>";
				return $alert;
			}else{
				move_uploaded_file($file_temp,$uploaded_image);
				$query = "INSERT INTO tbl_product(productName,cateId,brandId,description,type,price,image) VALUES('$productName','$category','$brand','$description','$type','$price','$unique_image')";
				$result = $this->db->insert($query);
				if($result){
					$alert = "<span class='success'>Insert Product Successfully</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Insert Product Not Success</span>";
					return $alert;
				}
			}
        }

        public function show_category(){
            $query = "SELECT * FROM tbl_category ORDER BY catId DESC";
            $result = $this->db->select($query);

            return $result;
        }

        public function getCatById($id){
            $query = "SELECT * FROM tbl_category WHERE catId = '$id'";
            $result = $this->db->select($query);

            return $result;

        }

        public function update_category($catName,$id){
            $catName = $this->fm->validation($catName);
   
            $catName = mysqli_real_escape_string($this->db->link,$catName);
            $id = mysqli_real_escape_string($this->db->link,$id);


            if(empty($catName)){
                $alert = "<span class='error'>Category must be not empty</span>";
                return $alert;
            }else{
                $query = "UPDATE tbl_category SET catName = '$catName' WHERE catId = '$id'";
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class='success'>Update Category Successfully</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Update Category Not Success</span>";
                    return $alert;       
                }
              
            }
            
        }

        public function del_category($id){
            $query = "DELETE FROM tbl_category WHERE catId = '$id'";
            $result = $this->db->delete($query);

            if($result){
                $alert = "<span class='success'>Delete Category Successfully</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>Delete Category Not Success</span>";
                return $alert;       
            }
        }

    }    
?>