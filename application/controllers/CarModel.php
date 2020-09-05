<?php
class CarModel extends CI_Controller
{
	public function index()
	{
		$this->load->model('Car_model');
		$rows = $this->Car_model->getAllCars();
		$this->load->view('car_model/list.php', array('rows' => $rows));
	}
	function showCreateForm() {
		$html = $this->load->view('car_model/create.php','',true);
		$response['html'] = $html;
		echo json_encode($response);
	}
	public function saveModel()
	{
		$this->load->model('Car_model');

		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('color', 'Color', 'required');
		$this->form_validation->set_rules('price', 'Price', 'required');
		if ($this->form_validation->run() == true) {
			//save enteries to DB
			$formArray = array();
			$formArray['name'] = $this->input->post('name');
			$formArray['color'] = $this->input->post('color');
			$formArray['transmission'] = $this->input->post('transmission');
			$formArray['price'] = $this->input->post('price');
			$formArray['created_at'] = date('Y-m-d H:i:s');
			$id = $this->Car_model->create($formArray);

			$row = $this->Car_model->getRow($id);
			$rowHtml = $this->load->view('car_model/car_row', array('vrow' => $row));
			$response['rowHtml'] = $rowHtml;
			$response['status'] = 1;
			$response['message'] = "<div class=\"alert alert-success\">Record has been inserted successfully</div>";
		} else {
			$response['status'] = 0;
			$response['name'] = strip_tags(form_error('name'));
			$response['color'] = strip_tags(form_error('color'));
			$response['price'] = strip_tags(form_error('price'));
		}
		echo json_encode($response);
	}
}
/* End of file Controllername.php */
