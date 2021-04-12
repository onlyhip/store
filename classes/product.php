<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
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

	public function insert_product($data, $files)
	{
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
		$unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
		$uploaded_image = "uploads/" . $unique_image;

		if ($productName == "" || $brand == "" || $category == "" || $description == "" || $price == "" || $type == "" || $file_name == "") {
			$alert = "<span class='error'>Fields must be not empty</span>";
			return $alert;
		} else {
			move_uploaded_file($file_temp, $uploaded_image);
			$query = "INSERT INTO tbl_product(productName,catId,brandId,description,type,price,image) VALUES('$productName','$category','$brand','$description','$type','$price','$unique_image')";
			$result = $this->db->insert($query);
			if ($result) {
				$alert = "<span class='success'>Insert Product Successfully</span>";
				return $alert;
			} else {
				$alert = "<span class='error'>Insert Product Not Success</span>";
				return $alert;
			}
		}
	}

	public function show_product()
	{

		$query = "

			SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName 

			FROM tbl_product 
                INNER JOIN tbl_category 
                    ON tbl_product.catId = tbl_category.catId 
			            INNER JOIN tbl_brand 
                            ON tbl_product.brandId = tbl_brand.brandId 
			ORDER BY tbl_product.productId DESC";


		$result = $this->db->select($query);
		return $result;
	}


	public function getproductbyId($id)
	{
		$query = "SELECT * FROM tbl_product where productId = '$id'";
		$result = $this->db->select($query);
		return $result;
	}

	public function update_product($data, $files, $id)
	{


		$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
		$brand = mysqli_real_escape_string($this->db->link, $data['brand']);
		$category = mysqli_real_escape_string($this->db->link, $data['category']);
		$description = mysqli_real_escape_string($this->db->link, $data['description']);
		$price = mysqli_real_escape_string($this->db->link, $data['price']);
		$type = mysqli_real_escape_string($this->db->link, $data['type']);

		$permited  = array('jpg', 'jpeg', 'png', 'gif');

		$file_name = $_FILES['image']['name'];
		$file_size = $_FILES['image']['size'];
		$file_temp = $_FILES['image']['tmp_name'];

		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		// $file_current = strtolower(current($div));
		$unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
		$uploaded_image = "uploads/" . $unique_image;


		if ($productName == "" || $brand == "" || $category == "" || $description == "" || $price == "" || $type == "") {
			$alert = "<span class='error'>Fields must be not empty</span>";
			return $alert;
		} else {
			if (!empty($file_name)) {
				//Nếu người dùng chọn ảnh
				if ($file_size > 20480) {

					$alert = "<span class='success'>Image Size should be less then 2MB!</span>";
					return $alert;
				} elseif (in_array($file_ext, $permited) === false) {
					// echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";	
					$alert = "<span class='success'>You can upload only:-" . implode(', ', $permited) . "</span>";
					return $alert;
				}
				move_uploaded_file($file_temp, $uploaded_image);
				$query = "UPDATE tbl_product SET
					productName = '$productName',
					brandId = '$brand',
					catId = '$category', 
					type = '$type', 
					price = '$price', 
					image = '$unique_image',
					description = '$description'
					WHERE productId = '$id'";
			} else {
				//Nếu người dùng không chọn ảnh
				$query = "UPDATE tbl_product SET

					productName = '$productName',
					brandId = '$brand',
					catId = '$category', 
					type = '$type', 
					price = '$price', 
					
					description = '$description'

					WHERE productId = '$id'";
			}
			$result = $this->db->update($query);
			if ($result) {
				$alert = "<span class='success'>Product Updated Successfully</span>";
				return $alert;
			} else {
				$alert = "<span class='error'>Product Updated Not Success</span>";
				return $alert;
			}
		}
	}


	public function del_product($id)
	{
		$query = "DELETE FROM tbl_product where productId = '$id'";
		$result = $this->db->delete($query);
		if ($result) {
			$alert = "<span class='success'>Product Deleted Successfully</span>";
			return $alert;
		} else {
			$alert = "<span class='error'>Product Deleted Not Success</span>";
			return $alert;
		}
	}

	public function getproduct_feathered()
	{
		$query = "SELECT * FROM tbl_product where type = '0' order by RAND() LIMIT 8 ";
		$result = $this->db->select($query);
		return $result;
	}

	public function getproduct_new()
	{
		$limit = 4;
		if (!isset($_GET['trang'])) {
			$page = 1;
		} else {
			$page = $_GET['trang'];
		}
		$range = ($page - 1) * $limit;
		$query = "SELECT * FROM tbl_product order by productId desc LIMIT $range,$limit";
		$result = $this->db->select($query);
		return $result;
	}
	public function get_all_product()
	{
		$query = "SELECT * FROM tbl_product";
		$result = $this->db->select($query);
		return $result;
	}
	public function get_details($id)
	{
		$query = "

			SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName 

				FROM tbl_product 
					INNER JOIN tbl_category 
						ON tbl_product.catId = tbl_category.catId 
							INNER JOIN tbl_brand 
								ON tbl_product.brandId = tbl_brand.brandId 
									WHERE tbl_product.productId = '$id'

			";

		$result = $this->db->select($query);
		return $result;
	}
}
?>