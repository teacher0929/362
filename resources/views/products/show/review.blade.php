<div class="row justify-content-center">
    <div class="col-12 col-sm-10 col-md-8 col-lg-6">
        @foreach($product->reviews as $review)
            <div class="bg-{{ $review->statusColor() }}-subtle rounded-4 p-3 mb-3">
                <div class="row g-2">
                    <div class="col-auto">
                        @foreach(range(1, 5) as $i)
                            @if(intval($review->rating) >= $i)
                                <i class="bi-star-fill text-warning"></i>
                            @else
                                <i class="bi-star text-warning"></i>
                            @endif
                        @endforeach
                    </div>
                    <div class="col-auto">
                        <i class="bi-person-circle text-secondary"></i>
                        {{ $review->user->name }}
                    </div>
                    <div class="col text-end">
                        @if(auth()->check() && auth()->id() == $review->user_id)
                            <div class="fw-semibold text-{{ $review->statusColor() }}-emphasis">
                                {{ $review->statusName() }}
                            </div>
                        @endif
                    </div>
                    <div class="col-12">
                        {{ $review->comment }}
                    </div>
                </div>
            </div>
        @endforeach

        <div class="bg-white rounded-4 border p-3">
            <form method="POST" action="{{ route('reviews.store', $product->slug) }}">
                @csrf

                <div class="mb-3">
                    <div class="text-center" id="stars">
                        <button type="button" class="btn btn-link btn-sm" value="1">
                            <i class="bi-star fs-5 text-warning"></i>
                        </button>
                        <button type="button" class="btn btn-link btn-sm" value="2">
                            <i class="bi-star fs-5 text-warning"></i>
                        </button>
                        <button type="button" class="btn btn-link btn-sm" value="3">
                            <i class="bi-star fs-5 text-warning"></i>
                        </button>
                        <button type="button" class="btn btn-link btn-sm" value="4">
                            <i class="bi-star fs-5 text-warning"></i>
                        </button>
                        <button type="button" class="btn btn-link btn-sm" value="5">
                            <i class="bi-star fs-5 text-warning"></i>
                        </button>
                    </div>
                    <label for="rating" class="form-label d-none">Rating</label>
                    <input type="number" min="1" max="5" class="form-control @error('rating') is-invalid @enderror d-none" id="rating" name="rating" required autofocus>
                    @error('rating')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                    <script>
                        let stars = document.querySelectorAll('#stars button');
                        let rating = document.getElementById('rating');

                        for (const star of stars) {
                            star.addEventListener('click', function () {
                                if (rating.value === this.value) {
                                    rating.value = 0;
                                } else {
                                    rating.value = this.value;
                                }

                                for (const btn of stars) {
                                    if (parseInt(btn.value) <= parseInt(rating.value)) {
                                        btn.firstElementChild.classList.add('bi-star-fill');
                                        btn.firstElementChild.classList.remove('bi-star');
                                    } else {
                                        btn.firstElementChild.classList.add('bi-star');
                                        btn.firstElementChild.classList.remove('bi-star-fill');
                                    }
                                }
                            });
                        }
                    </script>
                </div>

                <div class="mb-3">
                    <label for="comment" class="form-label">Comment</label>
                    <input type="text" maxlength="255" class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment" required>
                    @error('comment')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-dark w-100">Add review</button>
            </form>
        </div>
    </div>
</div>
