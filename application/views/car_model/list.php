<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<!-- Optional JavaScript -->


	<title>Ajax Crud</title>
</head>

<body>
	<div class="header">
		<div class="container">
			<h3>
				Ajax CodeIgniter CRUD
			</h3>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h3>Car Models</h3>
			</div>
			<div class="col-md-6 text-right"><a href="javascript:void();" class="btn btn-primary text-right" onclick="showModel()">Create</a></div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<table class="table table striped" id="carModelList">
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Color</th>
						<th>Transmission</th>
						<th>Price</th>
						<th>Created Date</th>
						<th>Updated Date</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
					<?php if (!empty($rows)) { ?>
						<?php foreach ($rows as $row) {
							$vrow = $row;
							$this->load->view('car_model/car_row.php', array("vrow" => $vrow));
						}
						?>
					<?php } else {  ?>
						<tr>
							<td>Record not found.</td>
						</tr>
					<?php }  ?>
				</table>
			</div>
		</div>
	</div>
	<div class="modal fade" id="createCar" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Create Model</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div id="response"></div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="ajaxResponseModal" role=" dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Create Model</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>

			</div>
		</div>
	</div>
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<script>
		function showModel() {
			$("#createCar").modal("show");
			$.ajax({
				url: '<?php echo base_url('CarModel/showCreateForm'); ?>',
				type: 'POST',
				data: {},
				dataType: 'json',
				success: function(response) {
					console.log(response);
					$("#response").html(response["html"]);
				}
			})
		}
		$("body").on("submit", "#createCarModel", function(e) {
			e.preventDefault();

			$.ajax({
				url: '<?php echo base_url('CarModel/saveModel'); ?>',
				type: 'POST',
				data: $(this).serializeArray(),
				dataType: 'json',
				success: function(response) {

					if (response['status'] == 0) {
						if (response["name"] != "") {
							$(".nameError").html(response["name"]).addClass('invalid-feedback d-block');
							$("#name").addClass('is-invalid');
						} else {
							$(".nameError").html("").removeClass('invalid-feedback d-block');
							$("#name").removeClass('is-invalid');
						}

						if (response["color"] != "") {
							$(".colorError").html(response["color"]).addClass('invalid-feedback  d-block');
							$("#color").addClass('is-invalid');
						} else {
							$(".colorError").html("").removeClass('invalid-feedback d-block');
							$("#color").removeClass('is-invalid');
						}

						if (response["price"] != "") {
							$(".priceError").html(response["price"]).addClass('invalid-feedback  d-block');
							$("#price").addClass('is-invalid');
						} else {
							$(".priceError").html("").removeClass('invalid-feedback d-block');
							$("#price").removeClass('is-invalid');
						}
					} else {
						$("#createCar").modal("hide");
						$("#ajaxResponseModal").modal("show");
						$("#ajaxResponseModal .modal-body").html(response['message']);

						$(".nameError").html("").removeClass('invalid-feedback d-block');
						$("#name").removeClass('is-invalid');

						$(".colorError").html("").removeClass('invalid-feedback d-block');
						$("#color").removeClass('is-invalid');

						$(".priceError").html("").removeClass('invalid-feedback d-block');
						$("#price").removeClass('is-invalid');

						$("#carModelList").append(response["rowHtml"]);
					}
				}
			})
		});
	</script>
</body>

</html>
