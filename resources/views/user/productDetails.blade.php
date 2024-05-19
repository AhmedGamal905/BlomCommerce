   @extends('user.layout.app')

   @section('content')
   <div class="card">
       <div class="card-body">
           <div class="row">
               <div class="col-lg-6 mb-4 mb-lg-0">
                   <div class="product-slider" id="galleryTop">
                       <div class="swiper theme-slider position-lg-absolute all-0" data-swiper='{"autoHeight":true,"spaceBetween":5,"loop":true,"loopedSlides":5,"thumb":{"spaceBetween":5,"slidesPerView":5,"loop":true,"freeMode":true,"grabCursor":true,"loopedSlides":5,"centeredSlides":true,"slideToClickedSlide":true,"watchSlidesVisibility":true,"watchSlidesProgress":true,"parent":"#galleryTop"},"slideToClickedSlide":true}'>
                           <div class="swiper-wrapper h-100">
                               @if ($product->hasMedia('product_images'))
                               @foreach ($product->getMedia('product_images') as $image)
                               <div class="swiper-slide h-100">
                                   <img class="rounded-1 object-fit-cover h-100 w-100" src="{{ $image->getUrl() }}" alt="{{ $product->title }}" />
                               </div>
                               @endforeach
                               @else
                               <p class="text-center my-auto">No image available</p>
                               @endif
                           </div>
                           <div class="swiper-nav">
                               <div class="swiper-button-next swiper-button-white"></div>
                               <div class="swiper-button-prev swiper-button-white"></div>
                           </div>
                       </div>
                   </div>
               </div>
               <div class="col-lg-6">
                   <div class="bottom-container" style="height: 100px;"></div>
                   <h5>{{$product->title}}</h5><a class="fs-10 mb-2 d-block" href="#!">Computer &amp; Accessories</a>
                   <div class="fs-11 mb-3 d-inline-block text-decoration-none"><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star-half-alt text-warning star-icon"></span><span class="ms-1 text-600">(8)</span>
                   </div>
                   <p class="fs-10">{{$product->description}}</p>
                   <h4 class="d-flex align-items-center">${{$product->price}}</h4>
                   <p class="fs-10 mb-1"> <span>Shipping Cost: </span><strong>Free</strong></p>
                   <p class="fs-10">Stock: <strong class="text-success">Available</strong></p>
                   <form action="{{ route('cart.add') }}" method="POST">
                       @csrf
                       <div class="row">
                           <div class="col-auto pe-0">
                               <div class="input-group input-group-sm" data-quantity="data-quantity">
                                   <button type="button" class="btn btn-sm btn-outline-secondary border border-300" data-field="input-quantity" data-type="minus">-</button>
                                   <input name="quantity" class="form-control text-center input-quantity input-spin-none" type="number" min="1" value="1" aria-label="Amount (to the nearest dollar)" style="max-width: 50px" />
                                   <button type="button" class="btn btn-sm btn-outline-secondary border border-300" data-field="input-quantity" data-type="plus">+</button>
                               </div>
                           </div>
                           <div class="col-auto px-2 px-md-3">
                               <input type="hidden" name="product_id" value="{{$product->id}}" />
                               <button type="submit" class="btn btn-sm btn-primary"><span class="fas fa-cart-plus me-sm-2"></span><span class="d-none d-sm-inline-block">Add To Cart</span></button>
                           </div>
                       </div>
                   </form>
                   <div class="bottom-container" style="height: 100px;"></div>
               </div>
           </div>
           <div class="bottom-container" style="height: 50px;"></div>
       </div>
   </div>
   @endsection