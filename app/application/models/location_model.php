<?php
class Location_model extends App_Model {
	
	public function __construct()
	{
		parent::__construct();
		$this->_table = "location";
	}
	
	public function getLocation($lat, $long)
	{
		$this->db->select();
		$this->db->where('latitude', $lat);
		$this->db->where('longitude', $long);
		$query = $this->db->get($this->_table);
		$result = $query->result();
		if (isset($result[0])) {
			return $result[0];
		}
		return false;
	}
}
?>
