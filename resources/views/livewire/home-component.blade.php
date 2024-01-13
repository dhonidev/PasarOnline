
<main id="main">
    <div class="container">

        <!--MAIN SLIDE-->
        <div class="wrap-main-slide">
            <div class="slide-carousel owl-carousel style-nav-1" data-items="1" data-loop="1" data-nav="true" data-dots="false">
                @forelse ($sliders as $slid)
                    <div class="item-slide">
                        <img src="{{asset('assets/images/sliders')}}/{{$slid->image}}" alt="" class="img-slide">
                        <div class="slide-info slide-1">
                            <h2 class="f-title">Kid Smart <b>{{$slid->title}}</b></h2>
                            <span class="subtitle">{{$slid->subtitle}}</span>
                            <p class="sale-info">Only price: <span class="price">${{$slid->price}}</span></p>
                            <a href="{{$slid->link}}" class="btn-link">Shop Now</a>
                        </div>
                    </div>
                @empty
                    
                @endforelse
            </div>
        </div>

        <!--BANNER-->
        <div class="wrap-banner style-twin-default">
            <div class="banner-item">
                <a href="#" class="link-banner banner-effect-1">
                    <figure><img src="{{asset('assets/images/home-1-banner-1.jpg')}}" alt="" width="580" height="190"></figure>
                </a>
            </div>
            <div class="banner-item">
                <a href="#" class="link-banner banner-effect-1">
                    <figure><img src="{{asset('assets/images/home-1-banner-2.jpg')}}" alt="" width="580" height="190"></figure>
                </a>
            </div>
        </div>

        <!--On Sale-->
        @if ($sproducts->count() > 0 && $sale->sts == 1 && $sale->sale_date > Carbon\Carbon::now())
            <div class="wrap-show-advance-info-box style-1 has-countdown">
                <h3 class="title-box">On Sale</h3>
                <div class="wrap-countdown mercado-countdown" data-expire="{{Carbon\Carbon::parse($sale->sale_date)->format('Y/m/d h:m:s')}}"></div>
                <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container " data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>
                    
                    @forelse ($sproducts as $sprod)
                        <div class="product product-style-2 equal-elem ">
                            <div class="product-thumnail">
                                <a href="{{ route('product.details', ['slug'=>$sprod->slug]) }}" title="{{$sprod->name}}">
                                    <figure>
                                        <img src="{{asset('assets/images/products')}}/{{$sprod->image}}" width="800" height="800" alt="{{$sprod->name}}">
                                    </figure>
                                </a>
                                <div class="group-flash">
                                    <span class="flash-item sale-label">sale</span>
                                </div>
                                <div class="wrap-btn">
                                    <a href="#" class="function-link">quick view</a>
                                </div>
                            </div>
                            <div class="product-info">
                                <a href="{{ route('product.details', ['slug'=>$sprod->slug]) }}" class="product-name"><span>{{$sprod->name}} [White]</span></a>
                                <div class="wrap-price"><span class="product-price">${{$sprod->regular_price}}</span></div>
                            </div>
                        </div>
                    @empty
                        
                    @endforelse

                </div>
            </div>
        @endif

        <!--Latest Products-->
        <div class="wrap-show-advance-info-box style-1">
            <h3 class="title-box">Latest Products</h3>
            <div class="wrap-top-banner">
                <a href="#" class="link-banner banner-effect-2">
                    <figure><img src="{{asset('assets/images/digital-electronic-banner.jpg')}}" width="1170" height="240" alt=""></figure>
                </a>
            </div>
            <div class="wrap-products">
                <div class="wrap-product-tab tab-style-1">						
                    <div class="tab-contents">
                        <div class="tab-content-item active" id="digital_1a">
                            <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}' >

                                @forelse ($lproducts as $lprod)
                                    <div class="product product-style-2 equal-elem ">
                                        <div class="product-thumnail">
                                            <a href="{{ route('product.details', ['slug'=>$lprod->slug]) }}" title="{{$lprod->name}}">
                                                <figure><img src="{{asset('assets/images/products')}}/{{$lprod->image}}" width="800" height="800" alt="{{$lprod->name}}"></figure>
                                            </a>
                                            <div class="group-flash">
                                                <span class="flash-item new-label">new</span>
                                            </div>
                                            <div class="wrap-btn">
                                                <a href="{{ route('product.details', ['slug'=>$lprod->slug]) }}" class="function-link">quick view</a>
                                            </div>
                                        </div>
                                        <div class="product-info">
                                            <a href="{{ route('product.details', ['slug'=>$lprod->slug]) }}" class="product-name"><span>{{$lprod->name}}</span></a>
                                            <div class="wrap-price"><span class="product-price">${{$lprod->regular_price}}</span></div>
                                        </div>
                                    </div>
                                @empty
                                    
                                @endforelse

                            </div>
                        </div>							
                    </div>
                </div>
            </div>
        </div>

        <!--Product Categories-->
        <div class="wrap-show-advance-info-box style-1">
            <h3 class="title-box">Product Categories</h3>
            <div class="wrap-top-banner">
                <a href="#" class="link-banner banner-effect-2">
                    <figure><img src="{{asset('assets/images/fashion-accesories-banner.jpg')}}" width="1170" height="240" alt=""></figure>
                </a>
            </div>
            <div class="wrap-products">
                <div class="wrap-product-tab tab-style-1">
                    <div class="tab-control">
                        @forelse ($categories as $key=>$cat)
                            <a href="#category_{{$cat->id}}" class="tab-control-item {{$key==0 ? 'active':''}}">{{$cat->name}}</a>
                        @empty
                            
                        @endforelse
                    </div>
                    <div class="tab-contents">
                        @forelse ($categories as $key=>$cat)
                            <div class="tab-content-item  {{$key==0 ? 'active':''}}" id="category_{{$cat->id}}">
                                <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}' >
                                @php
                                    $c_prods =  DB::table('products')->where('category_id',$cat->id)->get()->take($no_of_products);
                                @endphp
                                @forelse ($c_prods as $cprod)
                                    <div class="product product-style-2 equal-elem ">
                                        <div class="product-thumnail">
                                            <a href="{{ route('product.details', ['slug'=>$cprod->slug]) }}" title="{{$cprod->name}}">
                                                <figure><img src="{{asset('assets/images/products')}}/{{$cprod->image}}" width="800" height="800" alt="{{$cprod->name}}"></figure>
                                            </a>
                                            <div class="group-flash">
                                                <span class="flash-item new-label">new</span>
                                            </div>
                                            <div class="wrap-btn">
                                                <a href="#" class="function-link">quick view</a>
                                            </div>
                                        </div>
                                        <div class="product-info">
                                            <a href="{{ route('product.details', ['slug'=>$cprod->slug]) }}" class="product-name"><span>{{$cprod->name}}</span></a>
                                            <div class="wrap-price"><span class="product-price">${{$cprod->regular_price}}</span></div>
                                        </div>
                                    </div>
                                @empty
                                
                                @endforelse
                                
                                </div>
                            </div>
                        @empty
                        
                        @endforelse

                    </div>
                </div>
            </div>
        </div>			

    </div>

</main>