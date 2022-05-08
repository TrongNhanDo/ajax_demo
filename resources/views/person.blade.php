<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>AJAX DEMO</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<meta name="csrf_token" content="{{ csrf_token() }}" />
	<style>
		h1,h3{
			text-align: center;
		}
		hr{
			width: 50%;
			margin: auto;
			padding-bottom: 30px;
		}
		table{
			width: 50%;
			margin: auto;
		}
		table,th,td{
			border: 1px solid black;
		}
		th,td{
			padding: 5px 10px
		}
		input{
			margin-bottom: 15px;
		}
	</style>
</head>
<body>
	<h1>DEMO PROJECT USE AJAX</h1>
	<hr>
	<!-- Button trigger modal -->
	<h3>
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_add">
 			Add new person
		</button>
	</h3>
	<table>
		<thead>
			<th>ID</th>
			<th>Name</th>
			<th>Age</th>
			<th colspan="2">Action</th>
		</thead>
		<tbody>
		</tbody>
	</table>

	<!--Add Modal -->
	<div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Add new person</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<label for="name">Name:</label>
					<input type="text" name="name" id="name" class="form form-control">
					 
					<label for="age">Age:</label>
					<input type="text" name="age" id="age" class="form form-control"> 
				</div>
				<div class="modal-footer">
					<button type="button" id="close_add" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary add">Add</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Edit modal -->
	<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit person</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<label for="id_ed">ID:</label>
					<input type="text" name="id_ed" id="id_ed" class="form form-control" readonly>  

					<label for="name_ed">Name:</label>
					<input type="text" name="name_ed" id="name_ed" class="form form-control">
					 
					<label for="age_ed">Age:</label>
					<input type="text" name="age_ed" id="age_ed" class="form form-control"> 
				</div>
				<div class="modal-footer">
					<button type="button" id="close_edit" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary save">Save</button>
				</div>
			</div>
		</div>
	</div>
	<script>
		const _token = $('meta[name="csrf_token"]').attr('content');
		$(document).ready(function(){
			load_data();
			function load_data(){
				$.ajax({
					type: 'get',
					url: '/person',
					data: {
						_token: _token
					},
					dataType: 'json',
					success: function(data){
						$("tbody").html("");
						$("tbody").append(data);
					}
				});
			}
			//detail
			$(document).on('click','.edit',function(e){
				e.preventDefault();
				$.ajax({
					type: 'get',
					url: '/person/'+ $(this).val(),
					dataType: 'json',
					data: {
						_token: _token
					},
					success: function(data){
						$('#id_ed').val(data['id']);
						$('#name_ed').val(data['name']);
						$('#age_ed').val(data['age']);
					}
				})
			});
			// update 
			$(document).on('click','.save',function(e){
				e.preventDefault();
				$.ajax({
					type: 'put',
					url: '/person/'+ $("#id_ed").val(),
					dataType: 'json',
					data: {
						name: $('#name_ed').val(),
						age: $("#age_ed").val(),
						_token: _token
					},
					success: function(data){
						if(data == 'success'){
							alert('Update success!');
							load_data();
							$("#close_edit").click();
						}else{
							alert('Update fail!');
						}
					}
				});
			});
			// add 
			$(document).on('click','.add',function(e){
				e.preventDefault();
				$.ajax({
					type: 'post',
					url: '/person',
					dataType: 'json',
					data: {
						name: $('#name').val(),
						age: $("#age").val(),
						_token: _token
					},
					success: function(data){
						if(data == 'success'){
							alert('Add success!');
							load_data();
							$('#name').val("");
							$('#age').val("");
							$("#close_add").click();
						}else{
							alert('Add fail!');
						}
					}
				});
			});
			//delete 
			$(document).on('click','.delete',function(e){
				e.preventDefault();
				if(confirm('Are you sure you want to delete?')){
					$.ajax({
						type: 'delete',
						url: '/person/'+$(this).val(),
						dataType: 'json',
						data: {
							_token: _token
						},
						success: function(data){
							if(data == 'success'){
								alert('Delete success!');
								load_data();
							}else{
								alert('Delete fail!');
							}
						}
					});
				}
			});
		});
	</script>
</body>
</html>