@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Edition Quartier </div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Editer Quartier </li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">

					</div>
				</div>
				<!--end breadcrumb-->
				<div class="container">
					<div class="main-body">
						<div class="row">

<div class="col-lg-10">
	<div class="card">
		<div class="card-body">

 <form id="myForm" method="post" action="{{ route('update.quartier') }}"   >
			@csrf

            <input type="hidden" name="id"  value="{{ $quartier->id }} "  />


			<div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Region </h6>
				</div>
				<div class="form-group col-sm-9 text-secondary">
	 	<select name="region_id" class="form-select mb-3" aria-label="Default select example">
			 <option selected="">Dérouler le menu</option>

			 @foreach($region as $item)
		 	<option value="{{ $item->id }}" {{ $item->id == $quartier->region_id ? 'selected' : '' }}>{{ $item->region_name }}</option>
		 	@endforeach

								</select>
				</div>
			</div>

			<div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Ville </h6>
				</div>
				<div class="form-group col-sm-9 text-secondary">
	 	<select name="ville_id" class="form-select mb-3" aria-label="Default select example">
			 <option selected="">Dérouler le menu</option>

			 @foreach($ville as $item)
		 	<option value="{{ $item->id }}" {{ $item->id == $quartier->ville_id ? 'selected' : '' }}>{{ $item->ville_name }}</option>
		 	@endforeach

								</select>
				</div>
			</div>




           <div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">Quartier </h6>
				</div>
				<div class="form-group col-sm-9 text-secondary">
					<input type="text" name="quartier_name" class="form-control" value="{{ $quartier->quartier_name }} " />
				</div>
			</div>




			<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-sm-9 text-secondary">
					<input type="submit" class="btn btn-primary px-4" value="Sauvegarder" />
				</div>
			</div>
		</div>

		</form>



	</div>




							</div>
						</div>
					</div>
				</div>
			</div>




<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                quartier_name: {
                    required : true,
                },
            },
            messages :{
                quartier_name: {
                    required : 'Please Enter Quartier Name',
                },
            },
            errorElement : 'span',
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });

</script>








@endsection
