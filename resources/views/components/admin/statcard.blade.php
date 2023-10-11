@props(['product','quantity'])
<div class="row mb-1 myCard " style="border-bottom: 1px solid rgba(128, 128, 128, 0.134);height: 4rem;">

    <div class="col-2 col-sm-3 position-relative d-flex justify-content-center" style="height: 4rem" >
        <img src="{{'storage/'.$product->imgpath}}" style="height: 100%;"/>
    </div>
    <div class="col overflow-hidden">
        <nobr>{{$product->name}}</nobr>
    </div>
    <div class="col text-center">
        {{$quantity}}
    </div>
</div>