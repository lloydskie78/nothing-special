

@include('includes.productTopNav')
<aside class="prodlist" id="listShow">
    @foreach($search_results as $product)
        <a class='product_box hvr-grow' data-fancybox href='{{asset("assets/img/products/$product->imageFile")}}' data-feature='{!! nl2br($product->details) !!}' data-idProduct={{$product->idProduct}}>
            <div class='prdctimagecontainer'><img src='{{asset("assets/img/products/$product->imageFile")}}' onerror='imgError(this);'></div>
            <hr>
            <p class='prod_details'> {!! nl2br($product->details) !!}</p>
        </a>
    @endforeach
</aside>
<div class="pager-style"><div class="turn-page" id="pager"></div></div>