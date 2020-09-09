<div class="tab-pane fade show active" id="reviews" role="tabpanel">
    <div class="tab-single review-panel">
        <div class="row">
            <div class="col-12">
                <div class="ratting-main">

                    <div class="avg-ratting">

                        <span>Latest Reviews</span>
                    </div>

                    <!-- Single Rating -->
                    @forelse($product->reviewed as $review)
                        <div class="single-rating">
                            <div class="rating-author">
                                <img src="{{ url('img/user.png') }}" alt="#">
                            </div>
                            <div class="rating-des">
                                <h6>{{ $review->name }}</h6>
                                <span class="text-muted"><i>{{ date('F d, Y', $review->time) }}</i></span>
                                <p>{{ $review->info }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="p-3 bg-dark">
                            <h5 class="text-muted">No Reviews</h5>
                        </div>
                    @endforelse
                    <!--/ End Single Rating -->

                </div>
                <!-- Review -->
                <div class="comment-review">
                    <div class="add-review">
                        <h5>Add A Review</h5>
                        <p>Your email address will not be published. Required fields are marked</p>
                    </div>
                    <h4>Your Review</h4>

                </div>
                <!--/ End Review -->
                <!-- Form -->
                <?php
                $randa = random_int(0, 6);
                $randb = random_int(4, 9);
                $summed = $randa + $randb;
                ?>
                <form class="form" method="post" action="{{ route('review.product', $product->uuid) }}">
                    {{ csrf_field() }}

                    <input type="hidden" class="" value="{{ encrypt($summed) }}" name="summed">
                    <div class="row">

                        @auth("customer")
                            <input type="hidden" name="name" required="required" placeholder="" value="{{ $person->name }}">
                            <input type="hidden" name="email" required="required" placeholder="" value="{{ $person->email }}">

                        @else
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label>Your Name<span>*</span></label>
                                    <input type="text" name="name" required="required" placeholder="" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label>Your Email<span>*</span></label>
                                    <input type="email" name="email" required="required" placeholder="" autocomplete="off">
                                </div>
                            </div>
                        @endauth

                        <div class="col-lg-12 col-12">
                            <div class="form-group">
                                <label>Write a review<span>*</span></label>
                                <textarea name="info" rows="3" placeholder="" ></textarea>
                            </div>
                        </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label>Verify <span>*</span> <i>({{ $randa ." + ".$randb }} = ? ) </i></label>
                                    <input name="verify" class="verify" type="text" placeholder="Your Answer" required autocomplete="off">
                                </div>
                            </div>
                        <div class="col-lg-12 col-12">
                            <div class="form-group button5">
                                <button type="submit" class="btn">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>

                <br>
                @include('layouts.notice')
                <!--/ End Form -->
            </div>
        </div>
    </div>
</div>