@php
$categories = App\Models\Category::orderBy('category_name','ASC')->get();
@endphp


<section class="popular-categories section-padding">
        <div class="container wow animate__animated animate__fadeIn">
            <div class="section-title">
                <div class="title">
<<<<<<< HEAD
                    <h3>Catégories</h3>
=======
                    <h3>Les Catégories Les plus Visitées</h3>
>>>>>>> e12420512f7332e2cee091ed8927a5fbf16b63d4

                </div>
                <div class="slider-arrow slider-arrow-2 flex-right carausel-10-columns-arrow" id="carausel-10-columns-arrows"></div>
            </div>
            <div class="carausel-10-columns-cover position-relative">
                <div class="carausel-10-columns" id="carausel-10-columns">

                    @foreach($categories as $category)
                    <div class="card-2 bg-9 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                        <figure class="img-hover-scale overflow-hidden">
<a href="{{ url('product/category/'.$category->id.'/'.$category->category_slug) }}"><img src="{{ asset($category->category_image ) }}" alt="" /></a>
                        </figure>
                        <h6><a href="{{ url('product/category/'.$category->id.'/'.$category->category_slug) }}">{{ $category->category_name }}</a></h6>

    @php
    $products = App\Models\Product::where('category_id',$category->id)->get();
    @endphp

<<<<<<< HEAD
                        <span>{{ count($products) }} items</span>
=======
                        <span>{{ count($products) }} articles</span>
>>>>>>> e12420512f7332e2cee091ed8927a5fbf16b63d4
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
