@extends('layouts.productMaster')
@section('bg-img',asset('assets/img/banner/Products.jpg'))
@section('product-cat')
    <h2 class="b-b p-b">Categories <span><a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a></span>
    </h2>
@endsection



@section('product-content')

@include('includes.productTopNav')

  @if(count($products) > 0)
  <!-- {{$products}} -->
            @foreach($products as $product)

            <div style = 'float:left;width:50%; '>
                <img 
                src='{{asset("assets/img/products/$product->imageFile")}}' alt="{{$product->details}}"
                onerror="if (this.src != '{{asset('assets/img/error.png')}}') 
                this.src = '{{asset('assets/img/error.png')}}';"
                id = 'pbproduct'
                >
            </div>

            <div style = 'float:right;width:50%; ' >
                <aside>
                    <span class = 'textspacing'>
                        Ratings:
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </span>
                            <?php
                        echo preg_replace('/[ \t]+/', ' ', preg_replace('/[\r\n]+/', "\n", $product->details));
                                ?>

                    <span class = 'textspacing'>
                    Quantity : <input required type="number" value="1" min="1" max="100"/> inventory of the item
                    </span>
                </aside>
            </div>

            <span class = 'textspacing'>
                <button>Buy Now</button>
                <button>Add to Cart</button>
            </span>

            @endforeach
@endif

<span class = 'textspacing'>
    ask a question
      <input type="text" class="form-control" id="txtquestion">
</span>

@endsection


<style>
.checked {
  color: orange;
}

.textspacing {
    display: block;
    padding-bottom: 10px;
}

#pbproduct{
    width: 400px;
    height: 400px;
}

 #mySidenav{
    display: none;
}

#lblproduct{
    display: none;
}

.col-10{
    width: 100%;
}

.product-container{
    width: 100%;
}


</style>

@push('custom-scripts')
<script>
      $("#bgimgcontainer").hide();
      alert('hello product profile');
      $("[type='number']").keypress(function (evt) {
    evt.preventDefault();
});
</script>
@endpush
