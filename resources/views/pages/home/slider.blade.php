<!-- Slider Area -->
<div class="kids-winter">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-xs-12 kids">
                <div class="kids-st">
                    <div class="owl-carousel owl-theme owl-cate v2 js-owl-cate-hp1">

                        <?php $posi = 0 ?>
                        @forelse($sliders as $slider)

                            @if($slider->is_url)
                                <a href="{{ empty($slider->slider_url)?route('view.products'):$slider->slider_url}}" target="_blank">
                                    <img src="{{ $slider->image }}" alt="" style="height: 500px">
                                </a>
                            @else
                                    <div class="shop-now hp1">
                                        <img src="{{ $slider->image }}" alt="" style="height: 500px">
                                        {!! $slider->main_text !!}
                                        @if(!empty($slider->more_text))
                                            {!! $slider->more_text !!}
                                        @endif

                                        @if($slider->button)

                                            <a href="{{ !empty($slider->button_url)?$slider->button_url:route('view.products') }}">
                                                {{ !empty($slider->button_text)?$slider->button_text:'SHOP NOW!' }}
                                            </a>

                                        @endif


                                    </div>
                            @endif

                            <?php $posi+=1 ?>
                        @empty
                                <div class="shop-now hp1">
                                    <img src="{{ url('template/slider1.jpg') }}" alt="" style="height: 500px">
                                    <h4>Kids Winter <span>Jacket,<br>
                                            Coat & Sweater</span></h4>
                                    <p>It is a long established fact that a reader will be distracted by the<br>
                                        readable content of a page when looking at its layout</p>
                                    <a href="#">Shop now</a>
                                </div>
                                <img src="{{ url('template/slider2.jpg') }}" alt="" style="height: 500px">
                        @endforelse


                    </div>
                </div>
            </div>
            {{--<div class="col-md-4 col-sm-12 col-xs-12 ">
                <div class="backpack img81" style="height: 100%">
                    <a href="{{ route('view.products') }}" class="hover-images"><img src="{{ url('images/bg-mix.gif') }}" alt="" style="width: 100%">
                        <div class="pos text-center" style="width: 80%">
                            <span>{{ date('F') }}</span>
                            <h4 class="st-font ">Sales!!!</h4>
                        </div>
                    </a>

                </div>

            </div>
            --}}
        </div>
    </div>
</div>