@props(['review', 'reviews', 'isChild' => false])
<div class="wrapper">
    <div class="wrapper-aurthor">
        <div class="wrapper-info">
            <div class="aurthor-img">
                @if ($review->user->avatar)
                    <img src="{{ \Storage::url($review->user->avatar) }}"
                         alt="Avatar" width="40" height="40"
                         style="border-radius: 50%;">
                @else
                    <img src="{{ asset('theme/client/assets/images/logos/avatar.jpg') }}" alt="Default Avatar"
                         width="40" height="40" style="border-radius: 50%;">
                @endif
            </div>
            <div class="author-details">
                <h5>{{ $review->user->name }}</h5>
                <p>{{ \Carbon\Carbon::parse($review->created_at)->format('d/m/Y') }}</p>
            </div>
        </div>

        <!-- Chỉ hiển thị ratings nếu không phải bình luận con -->
        @if(!isset($isChild) || !$isChild)
            <div class="ratings">
                <span class="text-warning">
                    @for ($i = 0; $i < 5; $i++)
                        @if ($i < $review->star )
                            <i class="fa-solid fa-star"></i>
                        @else
                            <i class="fa-regular fa-star"></i>
                        @endif
                    @endfor
                </span>
                <span>({{ $review->star }}.0)</span>
            </div>
        @endif
    </div>
    <div class="wrapper-description">
        <p class="wrapper-details">{{ $review->content }}</p>
    </div>

    <!-- Hiển thị các bình luận con nếu có -->
    @if(isset($reviews[$review->id]))
        <div class="nested-comments">
            @foreach($reviews[$review->id] as $childReview)
                <!-- Đặt biến $isChild = true cho bình luận con -->
                <x-comment :review="$childReview" :reviews="$reviews" :isChild="true"/>
            @endforeach
        </div>
    @endif
</div>
