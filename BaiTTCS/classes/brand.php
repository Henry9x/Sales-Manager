<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	/**
	 * 
	 */
	class brand
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function insert_brand($brandName){

			$brandName = $this->fm->validation($brandName);
			$brandName = mysqli_real_escape_string($this->db->link, $brandName);
			
			if(empty($brandName)){
				$alert = "<span class='error'>Brand must be not empty</span>";
				return $alert;
			}else{
				$query = "INSERT INTO brand(brandName) VALUES('$brandName')";
				$result = $this->db->insert($query);
				if($result){
					$alert = "<span class='success'>Bạn đã thêm thương hiệu thành công</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Lỗi khi bạn thêm thương hiệu </span>";
					return $alert;
				}
			}
		}
		public function show_brand(){
			$query = "SELECT * FROM brand order by brandId desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function getbrandbyId($id){
			$query = "SELECT * FROM brand where brandId = '$id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function update_brand($brandName,$id){

			$brandName = $this->fm->validation($brandName);
			$brandName = mysqli_real_escape_string($this->db->link, $brandName);
			$id = mysqli_real_escape_string($this->db->link, $id);

			if(empty($brandName)){
				$alert = "<span class='error'>Nhãn hiệu không được để trống</span>";
				return $alert;
			}else{
				$query = "UPDATE brand SET brandName = '$brandName' WHERE brandId = '$id'";
				$result = $this->db->update($query);
				if($result){
					$alert = "<span class='success'>Đã cập nhật thương hiệu thành công</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Cập nhật thương hiệu không thành công</span>";
					return $alert;
				}
			}

		}
		public function del_brand($id){
			$query = "DELETE FROM brand where brandId = '$id'";
			$result = $this->db->delete($query);
			if($result){
				$alert = "<span class='success'>Đã xóa thương hiệu thành công</span>";
				return $alert;
			}else{
				$alert = "<span class='error'>Thương hiệu bị xóa không thành công</span>";
				return $alert;
			}
			
		}
	}
?>