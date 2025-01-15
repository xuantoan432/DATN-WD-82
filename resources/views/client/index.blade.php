@extends('client.layouts.master')

@section('title')
    Trang chủ
@endsection

@section('banner')
    <section id="hero" class="hero">
        <div class="swiper hero-swiper">
            <div class="swiper-wrapper hero-wrapper">
                @foreach ($bannerHero as $banner)
                    <div class="swiper-slide"
                        style="background: url('{{ \Storage::url($banner->banner_image) }}') no-repeat center/cover">
                        <a href="{{ $banner->banner_link }}">
                            <div class="container">
                                <div class="col-lg-6">
                                    <div class="wrapper-section" data-aos="fade-up">
                                        <div class="wrapper-info">
                                            <h5 class="wrapper-subtitle">{{ $banner->banner_text }}
                                            </h5>
                                            <h1 class="wrapper-details">{{ $banner->banner_title }}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>
@endsection



@section('content')
    <section class="product fashion-style">
        <div class="container">
            <div class="style-section">
                <div class="row gy-4 gx-5 gy-lg-0">
                    @foreach ($bannersub1 as $banner)
                        <a href="{{ $banner->banner_link }}" class="col-lg-6">
                            <div class="product-wrapper wrapper-one" data-aos="fade-right" 
                                style="background: url('{{ \Storage::url($banner->banner_image) }}') no-repeat center/cover">
                                <div class="wrapper-info">
                                    <span class="wrapper-subtitle">{{ $banner->banner_text }}</span>
                                    <h4 class="wrapper-details" style="width: 260px;">
                                        {{ $banner->banner_title }}
                                    </h4>
                                     
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>


    <section class="product-category">
        <div class="container">
            <div class="section-title">
                <h5>Danh mục</h5>
                <a href="{{ route('home.shop') }}" class="view">Xem tất cả</a>
            </div>
            <div class="category-section pb-5">
                @foreach ($categories as $category)
                    <a href="{{ route('home.shop', ['categories_id[]' => $category->id]) }}" class="product-wrapper"
                        data-aos="fade-right" data-aos-duration="100">
                        <div class="wrapper-img">
                            <img src="{{ \Storage::url($category->icon) }}" alt="dress">
                        </div>
                        <div class="wrapper-info">
                            <p class="wrapper-details">{{ $category->name }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="product arrival">
        <div class="container">
            <div class="section-title">
                <h5>Hàng mới về</h5>
                <a href="{{ route('home.shop') }}" class="view">Xem tất cả</a>
            </div>
            <div class="arrival-section">
                <div class="row g-5">
                    @foreach ($new_products as $np)
                        @include('client.components.product', [
                            'class' => 'col-lg-3 col-md-6',
                            'product' => $np,
                        ])
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Flash sale-->

    <section class="product flash-sale">
        <div class="container">
            <div class="section-title">
                <h5>Flash Sale</h5>
                <div class="countdown-section">
                    <div class="countdown-items">
                        <span id="day" class="number" style="color: red;">0</span>
                        <span class="text">Days</span>
                    </div>
                    <div class="countdown-items">
                        <span id="hour" class="number" style="color: skyblue;">0</span>
                        <span class="text">Hours</span>
                    </div>
                    <div class="countdown-items">
                        <span id="minute" class="number" style="color: green;">0</span>
                        <span class="text">Minutes</span>
                    </div>
                    <div class="countdown-items">
                        <span id="second" class="number" style="color: red;">0</span>
                        <span class="text">Seconds</span>
                    </div>
                </div>
                <a href="{{ route('home.shop') }}" class="view">Xem tất cả</a>
            </div>
            <div class="flash-sale-section">
                <div class="row g-5">
                    @foreach ($sale_products as $sp)
                        @include('client.components.product', [
                            'class' => 'col-lg-3 col-md-6',
                            'product' => $sp,
                        ])
                    @endforeach
                </div>
            </div>
        </div>
    </section>



    <section class="product top-selling">
        <div class="container">
            <div class="section-title">
                <h5>Bán chạy nhất</h5>
                <a href="{{ route('home.shop') }}" class="view">Xem tất cả</a>
            </div>
            <div class="top-selling-section">
                <div class="row g-5">
                    @foreach ($sell_products as $sell)
                        @include('client.components.product-sell', ['product' => $sell])
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection

@section('best-sell')
    <section class="product best-seller">
        <div class="container">
            <div class="best-selling-section">
                <div class="best-selling-items">
                    <div class="product-wrapper">
                        <div class="wrapper-img">
                            <span>
                                <svg width="94" height="82" viewBox="0 0 94 82" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M58.256 40.0336L70.0806 40.0336L46.9682 -2.64059e-05L29.516 30.2262C35.3719 40.3689 41.2279 50.5174 47.0898 60.663L47.2738 60.9804L70.3506 60.9804L76.2304 71.1617L64.5332 71.1617L53.1476 71.1617L59.0955 81.4616C70.7333 81.4615 82.3652 81.4615 94 81.4615L76.1799 50.5945C68.3393 50.5945 60.5016 50.5945 52.661 50.5945L41.1212 30.6059L46.9653 20.4751L58.256 40.0336Z"
                                        fill="white" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M35.3604 60.9805L29.4777 71.1647L17.7865 71.1647L23.6662 60.9805L29.6498 50.6243L26.7099 45.5307L23.7344 40.3808L23.5327 40.7308L0.0108757 81.4646L11.8356 81.4646L23.5327 81.4646L35.1586 81.4646L41.1036 71.1647L41.3053 70.8176L35.6303 60.9805L35.3604 60.9805Z"
                                        fill="#F11921" />
                                </svg>
                            </span>
                        </div>
                        <div class="wrapper-info">
                            <a href="seller-sidebar.html" class="wrapper-details">Jansjina</a>
                        </div>
                    </div>
                    <div class="product-wrapper">
                        <div class="wrapper-img">
                            <span>
                                <svg width="96" height="68" viewBox="0 0 96 68" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M37.6636 5.93245C36.5229 5.77892 35.3657 5.84745 34.2721 6.14269C32.1462 6.71663 30.2372 8.08416 29.054 10.139L6.98447 48.4492H6.97742C5.80135 50.504 5.56801 52.8636 6.14073 55.0153C6.70873 57.1386 8.06393 59.04 10.0673 60.228C12.278 61.3169 14.7173 61.5412 16.8974 60.9531C18.9644 60.3957 20.7933 59.0942 21.9411 57.1102L31.6961 40.1636L35.0593 45.9904L26.9871 60.0178C25.0121 63.4402 21.901 65.6627 18.4058 66.6122C14.8729 67.5617 10.9299 67.1862 7.38515 65.41L7.13531 65.2848L7.06462 65.2423V65.2282H7.06934C3.70376 63.2158 1.43882 60.0437 0.496078 56.5245C-0.460804 52.9486 -0.0601474 48.9947 1.93139 45.5298V45.5157L24.001 7.20555C25.309 4.94284 27.1379 3.16663 29.2497 1.95261H29.245C32.6954 -0.0455656 36.6384 -0.463614 40.209 0.485873C43.7867 1.44953 46.9991 3.7548 48.9907 7.20555L58.9719 24.5301L58.9884 24.5018L60.9588 21.0794L62.3517 18.6631L68.9791 7.15117C70.9589 3.72877 74.0817 1.47792 77.584 0.528429C81.124 -0.43523 85.0717 -0.0856881 88.6141 1.6881L88.871 1.81329L88.937 1.86998H88.9323C92.2955 3.88232 94.5604 7.05433 95.5055 10.5736C96.46 14.1495 96.0594 18.1057 94.0702 21.5683V21.5824L71.4774 60.7878C69.5613 64.1133 66.5044 66.3902 63.0846 67.3964L63.0964 67.4672C61.8426 67.8026 60.5699 67.9703 59.3043 67.9987H59.2665H59.1793H59.0898H59.0497C58.0952 68.0128 57.1359 67.9136 56.1838 67.7341L56.1202 67.72L56.0612 67.7058L55.9481 67.6774H55.941L55.8185 67.6491C55.5734 67.5924 55.3353 67.5381 55.0926 67.4814C51.5856 66.5178 48.4675 64.281 46.4853 60.8444L39.8579 49.3325L38.465 46.9163L36.4994 43.4939H36.4946L32.5045 36.5782H32.4998L28.1231 28.9918C27.3241 27.6077 26.9093 26.1008 26.8386 24.6057C26.7726 23.0539 27.079 21.5045 27.7201 20.1063L27.7672 19.9953L27.845 19.8701L28.1561 19.3245H28.1608C28.6393 18.5001 29.2096 17.7727 29.8507 17.1586C30.5247 16.5303 31.2766 15.9847 32.0826 15.5809H32.0944C32.7732 15.2313 33.4826 14.9644 34.2132 14.7825V14.7683C34.9344 14.6006 35.6956 14.5038 36.4758 14.5038H36.497C37.4492 14.5038 38.3707 14.6432 39.2333 14.8959C40.1006 15.1604 40.9467 15.5525 41.7386 16.0697C42.3656 16.4736 42.9477 16.9649 43.4686 17.5082C43.98 18.0538 44.4372 18.6537 44.8214 19.3245L45.1349 19.8701L45.182 19.9551L45.2598 20.1228C45.9008 21.5211 46.2072 23.0563 46.1389 24.6081C46.0729 26.1032 45.6557 27.6124 44.8591 28.9941L41.3026 35.1705L37.9347 29.3153L39.8084 26.0583C40.1242 25.5268 40.2868 24.9269 40.3151 24.3553C40.3387 23.7814 40.2373 23.2098 40.0181 22.6784L39.7707 22.2603C39.6151 21.9816 39.4383 21.7431 39.2451 21.5352C39.0306 21.325 38.8044 21.1313 38.5616 20.9754C38.2623 20.7794 37.9229 20.6259 37.5646 20.5149C37.1993 20.4039 36.8364 20.3472 36.4946 20.3472H36.4852C36.2047 20.3472 35.9078 20.3897 35.6085 20.4582H35.5967C35.3044 20.5267 35.0216 20.6401 34.7529 20.7652L34.76 20.7794C34.4348 20.9471 34.1354 21.1573 33.8715 21.4077C33.6099 21.6604 33.3836 21.9391 33.2045 22.2462V22.2603L32.9782 22.6524C32.7449 23.1838 32.6412 23.7696 32.6648 24.3577C32.6883 24.9316 32.8533 25.5316 33.1668 26.0606L36.0846 31.1175L39.8602 37.6694L43.0184 43.1467L43.042 43.1183L51.5313 57.859C52.7168 59.9139 54.6235 61.2956 56.7494 61.8553L57.1124 61.938L57.1477 61.9522H57.1642L57.2184 61.9663H57.2231L57.2703 61.9805H57.2986H57.3245L57.3764 61.9947L57.4282 62.0088H57.4541L57.4824 62.023H57.5272H57.5343C57.7605 62.0655 57.9915 62.0939 58.2201 62.1081L58.3733 62.1222H58.3804L58.4534 62.1364H58.4841H58.5312H58.5359H58.5925H58.609L58.6443 62.1506H58.6868H58.6985H58.7527H58.7622C59.2218 62.1648 59.6861 62.1364 60.1433 62.0797C60.5062 62.023 60.8621 61.9545 61.2086 61.8553C63.3321 61.2956 65.2412 59.9139 66.4267 57.859L89.0147 18.6537H89.0195C90.2026 16.5988 90.4312 14.2393 89.8561 12.0876C89.2929 9.97841 87.9353 8.06288 85.932 6.87484C83.7307 5.80018 81.2984 5.58999 79.1136 6.18991C77.0254 6.74969 75.1777 8.06288 74.0252 10.0611L62.3493 30.3475L58.5736 36.8853L55.6606 41.9421C55.3424 42.4877 55.1774 43.0734 55.1538 43.6616C55.1303 44.2355 55.2387 44.8212 55.4697 45.3527L55.6959 45.7566V45.7707C55.8774 46.0778 56.0989 46.3589 56.3605 46.6092C56.6245 46.8619 56.9262 47.0698 57.2491 47.2375H57.2444C57.5083 47.3769 57.7912 47.4737 58.0881 47.5445H58.1022C58.3969 47.6295 58.6938 47.6697 58.9767 47.6697H58.9814C59.3231 47.6555 59.6861 47.5988 60.0537 47.4878C60.4143 47.391 60.7537 47.2375 61.053 47.0415C61.2934 46.8738 61.522 46.6919 61.7318 46.4675C61.9274 46.2573 62.1065 46.0211 62.2621 45.7542L62.5096 45.322C62.7241 44.8047 62.8254 44.2331 62.8018 43.6592C62.7783 43.0734 62.6133 42.4853 62.3022 41.9397L60.4214 38.685L63.7917 32.844L67.3482 39.0062C68.1448 40.3903 68.5643 41.8996 68.6256 43.4065C68.6963 44.9441 68.3899 46.4935 67.7465 47.8917L67.6734 48.0453L67.6216 48.1421L67.3081 48.6853C66.924 49.3419 66.4715 49.9419 65.9577 50.4875C65.4391 51.0331 64.857 51.522 64.2254 51.9259C63.4382 52.4431 62.5921 52.8328 61.72 53.0997C60.8598 53.3501 59.9359 53.4918 58.9884 53.5036H58.9672C58.1871 53.4894 57.4258 53.4068 56.7047 53.2249C55.974 53.0431 55.2623 52.7785 54.5835 52.429H54.5717C53.768 52.0109 53.0115 51.4795 52.3374 50.8371C51.694 50.2206 51.1236 49.4955 50.6499 48.6712L50.6452 48.6853L50.3341 48.1421L50.2539 48.0028L50.2044 47.9059C49.5634 46.4958 49.257 44.9582 49.3253 43.4065C49.3913 41.8972 49.8061 40.388 50.6051 39.0062L54.9818 31.4198L54.9889 31.434L55.5946 30.3876L43.9329 10.1437C42.7474 8.08889 40.8383 6.7213 38.7148 6.14736C38.3777 6.0458 38.0219 5.97496 37.6636 5.93245Z"
                                        fill="#9B51E0" />
                                </svg>
                            </span>
                        </div>
                        <div class="wrapper-info">
                            <a href="seller-sidebar.html" class="wrapper-details">Graoishta</a>
                        </div>
                    </div>
                    <div class="product-wrapper">
                        <div class="wrapper-img">
                            <span>
                                <svg width="76" height="76" viewBox="0 0 76 76" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M37.9118 67.6006L35.4435 70.0668L33.7605 71.7591L35.8762 73.8727L37.9989 76L40.1215 73.8727L42.2372 71.7591L37.9966 67.5204L37.9118 67.6006ZM2.12033 40.1193L29.5175 67.5204L31.2005 65.8282L33.6689 63.362L33.7559 63.2727L8.48363 37.9966L37.9989 8.47956L67.5141 37.9966L54.8791 50.6346L37.9989 33.7579L33.7582 37.9989L54.8768 59.1233H54.8791L59.1198 54.8824L73.8774 40.1216L76 37.9989L73.8774 35.8784L40.1238 2.11817L38.0011 0L35.8785 2.11817L2.12033 35.8761L0 37.9966L2.12033 40.1193Z"
                                        fill="#FEBF1C" />
                                </svg>
                            </span>
                        </div>
                        <div class="wrapper-info">
                            <a href="seller-sidebar.html" class="wrapper-details">Toaksiua</a>
                        </div>
                    </div>
                    <div class="product-wrapper">
                        <div class="wrapper-img">
                            <span>
                                <svg width="76" height="79" viewBox="0 0 76 79" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M65.4838 78.9945H53.3666H42.8559V68.4116V60.2487H27.9269H22.6334V49.6659H42.8559H47.7403H48.1112H53.3666V60.2487V68.4116H65.4865V62.6496V40.496V25.3693L42.8559 12.2237V0.0027465L54.373 6.6894L76 19.2534V40.4987V44.3785V62.6551V68.4171V79H65.4838V78.9945ZM10.5135 25.3666L22.6334 18.3232V22.3649V28.5165V39.0829H27.8888H28.2597H33.1441H53.3666V28.5165H48.0758H33.1441V22.3649V12.2209C33.1441 8.14634 33.1441 4.07183 33.1441 0C29.6396 2.04414 26.1351 4.07457 22.6334 6.10225L21.6297 6.68665L0 19.2479V40.4932V44.373V62.6496V78.9945H10.5135V62.6496V40.496V25.3666Z"
                                        fill="#3AB57F" />
                                </svg>
                            </span>
                        </div>
                        <div class="wrapper-info">
                            <a href="seller-sidebar.html" class="wrapper-details">Rouaop</a>
                        </div>
                    </div>
                    <div class="product-wrapper">
                        <div class="wrapper-img">
                            <span>
                                <svg width="78" height="79" viewBox="0 0 78 79" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M35.2249 0C44.9888 0.0598183 53.8176 4.04043 60.2181 10.4464C66.6758 16.9041 70.6727 25.8225 70.6727 35.6735C70.6727 36.8399 70.6156 37.9982 70.5041 39.1402H62.9697C63.1056 38.0064 63.1791 36.8481 63.1791 35.6735C63.1791 27.8889 60.0278 20.8494 54.9296 15.7458C49.8804 10.6993 42.9143 7.55613 35.2276 7.49903V0H35.2249Z"
                                        fill="#98C73A" />
                                    <path
                                        d="M0 39.143C0.932622 30.9071 4.66586 23.5168 10.229 17.951C16.6322 11.5477 25.4608 7.56433 35.2248 7.50452V15.0008C27.5381 15.0634 20.5721 18.2011 15.5202 23.2558C11.322 27.4539 8.44521 32.979 7.55881 39.143H0Z"
                                        fill="#CC4645" />
                                    <path
                                        d="M78.0001 39.1429C77.0729 47.3816 73.3451 54.7691 67.7793 60.3322C61.376 66.7328 52.5474 70.7216 42.7861 70.7868V63.2851C50.4728 63.228 57.4361 60.0848 62.4881 55.0356C66.6862 50.832 69.563 45.3124 70.4494 39.1429H78.0001Z"
                                        fill="#F4C257" />
                                    <path
                                        d="M7.33292 42.6124C7.33292 41.4378 7.38997 40.2849 7.4933 39.1429H15.0358C14.8917 40.2795 14.8264 41.4351 14.8264 42.6124C14.8264 50.3942 17.9778 57.4365 23.076 62.5374C28.1279 67.5866 35.0831 70.7243 42.7806 70.7868V78.2831C33.0166 78.2206 24.188 74.2454 17.7766 67.8285C11.3216 61.379 7.33292 52.4607 7.33292 42.6124Z"
                                        fill="#2491EB" />
                                </svg>
                            </span>
                        </div>
                        <div class="wrapper-info">
                            <a href="seller-sidebar.html" class="wrapper-details">Goloasx</a>
                        </div>
                    </div>
                    <div class="product-wrapper">
                        <div class="wrapper-img">
                            <span>
                                <svg width="64" height="78" viewBox="0 0 64 78" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M32.0036 0C35.1725 0 38.2322 0.457315 41.1247 1.31632V11.8374V34.0093C40.2203 38.1035 36.5593 41.1814 32.1831 41.1814H33.8463H32.0036C30.8035 41.1814 29.6082 40.9661 28.4978 40.5087C27.397 40.0514 26.4079 39.3641 25.5641 38.5197C24.7156 37.6752 24.0294 36.6734 23.5712 35.57C23.1081 34.4545 22.8826 33.281 22.8826 32.0784C22.8826 30.8903 23.1081 29.7022 23.5615 28.6157C24.0246 27.4978 24.7131 26.496 25.5617 25.6516L25.6053 25.608C27.2443 23.9481 29.5282 22.9028 32.0521 22.9028C32.4352 22.9028 32.811 22.9318 33.1844 22.9753H33.4171V19.3554V10.567V9.96685L33.4656 9.98138C32.9831 9.93783 32.491 9.92331 31.9988 9.92331C19.5029 9.92331 9.37079 20.0426 9.37079 32.5115C9.37079 44.9804 19.5029 55.0972 31.9988 55.0972C44.4948 55.0972 54.6268 44.978 54.6268 32.5115C54.6268 31.1226 54.4983 29.7627 54.2607 28.4464V9.6378V9.00623C60.2638 14.8039 64 22.9342 64 31.938C64 52.3629 44.3081 64.1712 31.9988 78C19.6895 64.1737 0 52.3654 0 31.938C0.00484903 14.2982 14.3362 0 32.0036 0Z"
                                        fill="#F58124" />
                                </svg>
                            </span>
                        </div>
                        <div class="wrapper-info">
                            <a href="seller-sidebar.html" class="wrapper-details">Lkasafiak</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="product weekly-sale">
        <div class="container">
            <div class="section-title">
                <h5>Nổi bật trong tuần</h5>
                <a href="{{ route('home.shop') }}" class="view">Xem tất cả</a>
            </div>
            <div class="weekly-sale-section">
                <div class="row g-5">
                    @foreach ($best_sell as $bs)
                        @include('client.components.product', [
                            'class' => 'col-lg-3 col-md-6',
                            'product' => $bs,
                        ])
                    @endforeach
                </div>
            </div>
            <div class="style-section">
                <div class="row gy-4 gx-5 gy-lg-0">
                    @foreach ($bannersub2 as $banner)
                        <a href="{{ $banner->banner_link }}" class="col-lg-6">
                            <div class="product-wrapper wrapper-one" data-aos="fade-right"
                                style="background: url('{{ \Storage::url($banner->banner_image) }}') no-repeat center/cover">
                                <div class="wrapper-info">
                                    <span class="wrapper-subtitle">{{ $banner->banner_text }}</span>
                                    <h4 class="wrapper-details" style="width: 260px;">
                                        {{ $banner->banner_title }}
                                    </h4>
                                    
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection

@section('flash-sale')
    <section class="product best-product">
        <div class="container">
            <div class="section-title">
                <h5>Có thể bạn sẽ thích</h5>
                <a href="{{ route('home.shop') }}" class="view">Xem tất cả</a>
            </div>
            <div class="best-product-section">
                <div class="row g-4">
                    @foreach ($flash_sale as $fs)
                        @include('client.components.product', [
                            'class' => 'col-xl-2 col-md-4',
                            'product' => $fs,
                            'hideBtn' => true,
                        ])
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Cài đặt thời gian kết thúc flash sale
            const flashSaleEndTime = new Date("2025-01-31T23:59:59")
        .getTime(); // Thay đổi thời gian kết thúc tại đây

            // Cập nhật mỗi giây
            const countdownTimer = setInterval(() => {
                const now = new Date().getTime();
                const timeLeft = flashSaleEndTime - now;

                // Tính toán ngày, giờ, phút, giây
                const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

                document.getElementById('day').textContent = days;
                document.getElementById('hour').textContent = hours;
                document.getElementById('minute').textContent = minutes;
                document.getElementById('second').textContent = seconds;

                // Dừng đếm ngược khi hết thời gian
                if (timeLeft < 0) {
                    clearInterval(countdownTimer);
                    document.querySelector('.countdown-section').innerHTML =
                        `<span class="expired">Flash Sale Ended!</span>`;
                }
            }, 1000);
        });
    </script>
    @vite(['resources/js/client/product-detail.js', 'resources/js/client/chat-seller.js'])
@endsection
