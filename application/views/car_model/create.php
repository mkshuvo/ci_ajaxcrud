<form id="createCarModel" name="createCarModel" method="POST">
	<div class="modal-body">
		<div class="form-group">
			<label for="name">Name</label>
			<input type="text" class="form-control" id="name" name="name" placeholder="Name">
			<span class="nameError"></span>
		</div>

		<div class="form-group">
			<label for="color">Color</label>
			<input type="text" class="form-control" id="color" name="color" placeholder="Color">
			<span class="colorError"></span>
		</div>

		<div class="form-group">
			<label for="transmission">Transmission</label>
			<select name="transmission" class="form-control" id="transmission">
				<option value="Automatic">Automatic</option>
				<option value="Manual">Manual</option>
			</select>
		</div>

		<div class="form-group">
			<label for="price">Price</label>
			<input type="text" class="form-control" id="price" name="price" placeholder="Price">
			<span class="priceError"></span>
		</div>

	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		<button type="submit" id="SubmitButton" class="btn btn-primary">Save Car</button>
	</div >
</form>
