<?php

class Car_model extends CI_Model
{
	public function create($formArray)
	{
		$this->db->insert('car_models', $formArray);
		return $id = $this->db->insert_id();
	}
	public function getAllCars()
	{
		$result = $this->db->order_by('id', 'ASC')
			->get('car_models')->result_array();

		return $result;
	}
	public function getRow($id)
	{
		$this->db->where('id',$id);
        $row = $this->db->get('car_models')->row_array();
        // SELECT * FROM car_models WHERE id = $id
        return $row;
	}
}

/* End of file ModelName.php */
