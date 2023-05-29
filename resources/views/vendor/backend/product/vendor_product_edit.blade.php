@extends('vendor.vendor_dashboard')
@section('vendor')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<div class="page-content">

				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Gestion Produit</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Editer votre Produit</li>
							</ol>
						</nav>
					</div>

				</div>
				<!--end breadcrumb-->

<div class="card">
  <div class="card-body p-4">
	  <h5 class="card-title">Editer le Produit</h5>
	  <hr/>

<form id="myForm" method="post" action="{{ route('vendor.update.product') }}"  >
			@csrf

		<input type="hidden" name="id" value="{{ $products->id }}">

       <div class="form-body mt-4">
	    <div class="row">
		   <div class="col-lg-8">
           <div class="border border-3 p-4 rounded">


			<div class="form-group mb-3">
				<label for="inputProductTitle" class="form-label">Nom du Produit</label>
				<input type="text" name="product_name" class="form-control" id="inputProductTitle" value="{{ $products->product_name }}">
			  </div>

            <div class="mb-3">
				<label for="inputProductTitle" class="form-label">Etiquettes</label>
				<input type="text" name="product_tags" class="form-control visually-hidden" data-role="tagsinput" value="{{ $products->product_tags }}">
			  </div>

			  <div class="mb-3">
				<label for="inputProductTitle" class="form-label">Taille</label>
				<input type="text" name="product_size" class="form-control visually-hidden" data-role="tagsinput" value="{{ $products->product_size }} ">
			  </div>

			  <div class="mb-3">
				<label for="inputProductTitle" class="form-label">Format</label>
				<input type="text" name="product_format" class="form-control visually-hidden" data-role="tagsinput" value="{{ $products->product_format }} ">
			  </div>

			  <div class="mb-3">
				<label for="inputProductTitle" class="form-label">Couleur</label>
				<input type="text" name="product_color" class="form-control visually-hidden" data-role="tagsinput" value="{{ $products->product_color }}">
			  </div>



			  <div class="form-group mb-3">
				<label for="inputProductDescription" class="form-label">Courte description</label>
				<textarea name="short_descp" class="form-control" id="inputProductDescription" rows="3">
        {{ $products->short_descp }}
				</textarea>
			  </div>

			   <div class="mb-3">
				<label for="inputProductDescription" class="form-label">Longue description</label>
				<textarea id="mytextarea" name="long_descp">
				 {!! $products->long_descp !!}</textarea>
			  </div>






            </div>
		   </div>
		   <div class="col-lg-4">
			<div class="border border-3 p-4 rounded">
              <div class="row g-3">

				<div class="form-group col-md-6">
					<label for="inputPrice" class="form-label">Prix</label>
					<input type="text" name="selling_price" class="form-control" id="inputPrice" value="{{ $products->selling_price }}">
				  </div>
				  <div class="col-md-6">
					<label for="inputCompareatprice" class="form-label">Réduction </label>
					<input type="text" name="discount_price" class="form-control" id="inputCompareatprice" value="{{ $products->discount_price }}">
				  </div>
				  <div class="form-group col-md-6">
					<label for="inputCostPerPrice" class="form-label"> Code</label>
					<input type="text" name="product_code" class="form-control" id="inputCostPerPrice" value="{{ $products->product_code }}">
				  </div>
				  <div class="form-group col-md-6">
					<label for="inputStarPoints" class="form-label"> Quantité</label>
					<input type="text" name="product_qty" class="form-control" id="inputStarPoints" value="{{ $products->product_qty }}">
				  </div>


				  <div class="form-group col-12">
					<label for="inputProductType" class="form-label">Marque</label>
					<select name="brand_id" class="form-select" id="inputProductType">
						<option></option>
						@foreach($brands as $brand)
 	<option value="{{ $brand->id }}" {{ $brand->id == $products->brand_id ? 'selected' : '' }} >{{ $brand->brand_name }}</option>
						 @endforeach
					  </select>
				  </div>

				  <div class="form-group col-12">
					<label for="inputVendor" class="form-label"> Categorie</label>
					<select name="category_id" class="form-select" id="inputVendor">
						<option></option>
						@foreach($categories as $cat)
						<option value="{{ $cat->id }}" {{ $cat->id == $products->category_id ? 'selected' : '' }}>{{ $cat->category_name }}</option>
						 @endforeach
					  </select>
				  </div>

				  <div class="form-group col-12">
					<label for="inputCollection" class="form-label"> SubCategorie</label>
					<select name="subcategory_id" class="form-select" id="inputCollection">
						<option></option>
						@foreach($subcategory as $subcat)
						<option value="{{ $subcat->id }}" {{ $subcat->id == $products->subcategory_id ? 'selected' : '' }}>{{ $subcat->subcategory_name }}</option>
						 @endforeach

					  </select>
				  </div>





				  <div class="col-12">

	 <div class="row g-3">

	 <div class="col-md-6">
    <div class="form-check">
 <input class="form-check-input" name="hot_deals" type="checkbox" value="1" id="flexCheckDefault" {{ $products->hot_deals == 1 ? 'checked' : '' }} >
			<label class="form-check-label" for="flexCheckDefault"> Bonnes affaires</label>
		</div>
	</div>

	<div class="col-md-6">
    <div class="form-check">
			<input class="form-check-input" name="featured" type="checkbox" value="1" id="flexCheckDefault" {{ $products->featured == 1 ? 'checked' : '' }}>
			<label class="form-check-label" for="flexCheckDefault">A La une</label>
		</div>
	</div>




<div class="col-md-6">
    <div class="form-check">
			<input class="form-check-input" name="special_offer" type="checkbox" value="1" id="flexCheckDefault" {{ $products->special_offer == 1 ? 'checked' : '' }}>
			<label class="form-check-label" for="flexCheckDefault">Offres Speciales</label>
		</div>
	</div>


	<div class="col-md-6">
    <div class="form-check">
			<input class="form-check-input" name="special_deals" type="checkbox" value="1" id="flexCheckDefault" {{ $products->special_deals == 1 ? 'checked' : '' }}>
			<label class="form-check-label" for="flexCheckDefault">Special Deals</label>
		</div>
	</div>



		</div> <!-- // end row  -->

				  </div>

<hr>


				  <div class="col-12">
					  <div class="d-grid">
	 	<input type="submit" class="btn btn-primary px-4" value="Sauvegarder" />

					  </div>
				  </div>
			  </div>
		  </div>
		  </div>
	   </div><!--end row-->
	</div>
  </div>

</form>

</div>

			</div>


<!-- /// Main Image Thumbnail Update ////// -->

<div class="page-content">
	<h6 class="mb-0 text-uppercase">mettre à jour l'image principale </h6>
	<hr>
<div class="card">
<form method="post" action="{{ route('vendor.update.product.thumbnail') }}" enctype="multipart/form-data" >
			@csrf

	<input type="hidden" name="id" value="{{ $products->id }}">
	<input type="hidden" name="old_img" value="{{ $products->product_thumbnail }}">

	<div class="card-body">
		<div class="mb-3">
			<label for="formFile" class="form-label">Choisir l'image principale </label>
			<input name="product_thumbnail" class="form-control" type="file" id="formFile">
		</div>


		<div class="mb-3">
			<label for="formFile" class="form-label"> </label>
			 <img src="{{ asset($products->product_thumbnail) }}" style="width:100px; height:100px">
		</div>

<input type="submit" class="btn btn-primary px-4" value="Sauvegarder" />

			 </div>

			</form>

			    </div>
			</div>


<!-- /// End Main Image Thumbnail Update ////// -->

<!-- /// Update Multi Image  ////// -->

<div class="page-content">
	<h6 class="mb-0 text-uppercase">Mise à jour Multi Image </h6>
	<hr>
<div class="card">
<div class="card-body">
	<table class="table mb-0 table-striped">
		<thead>
			<tr>
				<th scope="col">#Sl</th>
				<th scope="col">Image</th>
				<th scope="col">Changer Image </th>
				<th scope="col">Supprimer </th>
			</tr>
		</thead>
		<tbody>

 <form method="post" action="{{ route('vendor.update.product.multiimage') }}" enctype="multipart/form-data" >
			@csrf

	@foreach($multiImgs as $key => $img)
	<tr>
		<th scope="row">{{ $key+1 }}</th>
		<td> <img src="{{ asset($img->photo_name) }}" style="width:70; height: 40px;"> </td>
		<td> <input type="file" class="form-group" name="multi_img[{{ $img->id }}]"> </td>
		<td>
	<input type="submit" class="btn btn-primary px-4" value="Mettre à jour " />
	<a href="{{ route('vendor.product.multiimg.delete',$img->id) }}" class="btn btn-danger" id="delete" > Supprimer </a>
		</td>
	</tr>
	@endforeach

		</form>
		</tbody>
	</table>
</div>
</div>
</div>

<!-- /// End Update Multi Image  ////// -->





<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                product_name: {
                    required : true,
                },
                 short_descp: {
                    required : true,
                },
                 product_thumbnail: {
                    required : true,
                },
                 multi_img: {
                    required : true,
                },
                 selling_price: {
                    required : true,
                },
                 product_code: {
                    required : true,
                },
                 product_qty: {
                    required : true,
                },
                 brand_id: {
                    required : true,
                },
                 category_id: {
                    required : true,
                },
                 subcategory_id: {
                    required : true,
                },
            },
            messages :{
                product_name: {
                    required : 'Bien vouloir renseigner le nom du Produit',
                },
                short_descp: {
                    required : 'Bien vouloir renseigner une courte description',
                },
                product_thumbnail: {
                    required : 'Bien vouloir choisir une image',
                },
                multi_img: {
                    required : 'Bien vouloir choisir des images',
                },
                selling_price: {
                    required : 'Bien vouloir renseigner le prix de vente',
                },
                product_code: {
                    required : 'Bien vouloir renseigner le code',
                },
                 product_qty: {
                    required : 'Bien vouloir renseigner la Quantité',
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



<script type="text/javascript">
	function mainThamUrl(input){
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e){
				$('#mainThmb').attr('src',e.target.result).width(80).height(80);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}
</script>


<script>

  $(document).ready(function(){
   $('#multiImg').on('change', function(){ //on file input change
      if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
      {
          var data = $(this)[0].files; //this file data

          $.each(data, function(index, file){ //loop though each file
              if(/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file.type)){ //check supported file type
                  var fRead = new FileReader(); //new filereader
                  fRead.onload = (function(file){ //trigger function on successful read
                  return function(e) {
                      var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(100)
                  .height(80); //create image element
                      $('#preview_img').append(img); //append image to output element
                  };
                  })(file);
                  fRead.readAsDataURL(file); //URL representing the file's data.
              }
          });

      }else{
          alert("Your browser doesn't support File API!"); //if File API is absent
      }
   });
  });

  </script>



  <script type="text/javascript">

  		$(document).ready(function(){
  			$('select[name="category_id"]').on('change', function(){
  				var category_id = $(this).val();
  				if (category_id) {
  					$.ajax({
  						url: "{{ url('/subcategory/ajax') }}/"+category_id,
  						type: "GET",
  						dataType:"json",
  						success:function(data){
  							$('select[name="subcategory_id"]').html('');
  							var d =$('select[name="subcategory_id"]').empty();
  							$.each(data, function(key, value){
  								$('select[name="subcategory_id"]').append('<option value="'+ value.id + '">' + value.subcategory_name + '</option>');
  							});
  						},

  					});
  				} else {
  					alert('danger');
  				}
  			});
  		});

  </script>


@endsection
