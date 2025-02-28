@extends('client.layouts.master')

@section('title')
    Blogs
@endsection

@section('content')
    @include('client.components.breadcrumbs')

    <section class="latest product footer-padding">
        <div class="container">
            <div class="blog-section latest-section">
                <div class="row g-5">
                    @foreach ($posts as $post)
                        @php
                            $date_one = $post->created_at;
                            $date_day = date('d', strtotime($date_one));
                            $date_M = date('m', strtotime($date_one));
                            $date_Y = date('Y', strtotime($date_one));
                            $date = $date_day . '/' . $date_M . '/' . $date_Y;
                        @endphp
                        <div class="col-lg-4 col-sm-6">
                            <div class="blogs-wrapper product-wrapper" data-aos="fade-up">
                                <div class="wrapper-img">
                                    <img src="{{ Storage::url($post->thumbnail) }}" alt="img">
                                </div>
                                <div class="wrapper-info">
                                    <div class="wrapper-data">
                                        <div class="admin wrapper-item">
                                            <span class="icon">
                                                <svg width="12" height="15" viewBox="0 0 12 15" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M1.761 14.9996C1.55973 14.9336 1.35152 14.8896 1.16065 14.7978C0.397206 14.4272 -0.02963 13.6273 0.00160193 12.743C0.0397743 11.6936 0.275749 10.7103 0.765049 9.7966C1.42439 8.56373 2.36829 7.65741 3.59327 7.07767C3.67309 7.04098 3.7529 7.00428 3.85007 6.95658C2.68061 5.9512 2.17396 4.67062 2.43422 3.10017C2.58691 2.18285 3.03804 1.42698 3.72514 0.847238C5.24163 -0.42967 7.34458 -0.216852 8.60773 1.1738C9.36424 2.00673 9.70779 3.01211 9.61757 4.16426C9.52734 5.31642 9.01375 6.23374 8.14619 6.94924C8.33359 7.04098 8.50363 7.11436 8.6702 7.20609C10.1485 8.006 11.1618 9.24254 11.6997 10.9011C11.9253 11.5945 12.0328 12.3137 11.9912 13.0476C11.9357 14.0163 11.2243 14.8235 10.3151 14.9703C10.2908 14.974 10.2665 14.9886 10.2387 14.9996C7.41051 14.9996 4.58575 14.9996 1.761 14.9996ZM6.00507 13.8475C7.30293 13.8475 8.60079 13.8401 9.89518 13.8512C10.5684 13.8548 10.9571 13.3338 10.9015 12.7577C10.8807 12.5486 10.8773 12.3394 10.846 12.1303C10.6309 10.6185 9.92294 9.41133 8.72225 8.5784C7.17106 7.50331 5.50883 7.3602 3.84313 8.23349C2.05944 9.16916 1.15718 10.7506 1.09125 12.8568C1.08778 13.0072 1.12595 13.1723 1.18494 13.3044C1.36193 13.6934 1.68466 13.8438 2.08026 13.8438C3.392 13.8475 4.70027 13.8475 6.00507 13.8475ZM5.99119 6.53462C7.38969 6.54196 8.53833 5.33843 8.54527 3.85238C8.55221 2.37733 7.41745 1.16647 6.00507 1.15179C4.62046 1.13344 3.45794 2.35531 3.45099 3.8377C3.44405 5.31275 4.58922 6.52728 5.99119 6.53462Z"
                                                        fill="#AE1C9A" />
                                                </svg>
                                            </span>
                                            <span class="text">
                                                <b>Viết bởi: </b>
                                                @if ($post->user->hasRole(1))
                                                    Admin {{ $post->user->name }}
                                                @elseif ($post->user->hasRole(2))
                                                    Seller {{ $post->user->name }}
                                                @else
                                                    Không rõ vai trò
                                                @endif
                                            </span>
                                        </div>
                                        <div class="comments wrapper-item">
                                            <span class="icon">
                                                <span class="icon">
                                                    <svg width="16" height="15" viewBox="0 0 16 15" fill="#ae1c9a"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M0 2.81801C0.0698925 2.59859 0.108016 2.36327 0.212854 2.15974C0.571847 1.44423 1.16593 1.06263 1.9697 1.01811C2.19526 1.00539 2.424 1.01493 2.66544 1.01493C2.66544 0.852747 2.66544 0.700105 2.66544 0.550643C2.66544 0.229459 2.87512 0.00367645 3.17058 0.000496408C3.46603 0.000496408 3.67571 0.226279 3.67889 0.547463C3.67889 0.700105 3.67889 0.849567 3.67889 1.00857C4.44135 1.00857 5.1911 1.00857 5.9631 1.00857C5.9631 0.840027 5.95674 0.668305 5.9631 0.496583C5.97581 0.146778 6.30621 -0.0821846 6.63343 0.0291168C6.83358 0.0958976 6.97018 0.28034 6.97654 0.499763C6.98289 0.665125 6.97654 0.830487 6.97654 1.00539C7.74536 1.00539 8.50782 1.00539 9.28617 1.00539C9.28617 0.836847 9.27981 0.665125 9.28617 0.493402C9.30523 0.0958976 9.72776 -0.129885 10.0613 0.0799974C10.217 0.178579 10.2933 0.32168 10.2996 0.502943C10.3028 0.668305 10.2996 0.830487 10.2996 1.01493C10.4489 1.01493 10.5919 1.01811 10.7317 1.01493C11.0494 1.00857 11.3639 1.03083 11.6657 1.14531C12.4218 1.42515 12.9682 2.15974 12.9809 2.96747C12.9968 3.95647 12.9873 4.94864 12.9841 5.93763C12.9841 6.23019 12.7586 6.44962 12.479 6.44962C12.1931 6.44962 11.9738 6.22701 11.9738 5.92809C11.9707 4.98998 11.9738 4.04869 11.9738 3.11057C11.9738 2.67491 11.7959 2.34101 11.3988 2.14384C11.2845 2.0866 11.151 2.05162 11.0239 2.04526C10.7889 2.02936 10.5506 2.04208 10.2996 2.04208C10.2996 2.19472 10.2996 2.34737 10.2996 2.49683C10.2964 2.82755 10.0868 3.05651 9.78494 3.05333C9.48949 3.05015 9.28617 2.82437 9.28299 2.50001C9.28299 2.35373 9.28299 2.20426 9.28299 2.04844C8.51417 2.04844 7.75171 2.04844 6.97336 2.04844C6.97336 2.18836 6.97336 2.32511 6.97336 2.46503C6.97336 2.82119 6.77639 3.05333 6.46823 3.05333C6.16007 3.05651 5.95992 2.82437 5.95674 2.46821C5.95674 2.32829 5.95674 2.19154 5.95674 2.04526C5.19428 2.04526 4.44453 2.04526 3.67253 2.04526C3.67253 2.2138 3.67888 2.38553 3.67253 2.55407C3.65982 2.90387 3.32942 3.13284 3.00538 3.02471C2.80205 2.95793 2.66544 2.77031 2.66227 2.54135C2.65909 2.37917 2.66227 2.2138 2.66227 2.02618C2.36364 2.04208 2.07136 2.023 1.79497 2.07706C1.34066 2.15338 1.04203 2.55089 1.01662 3.02471C1.01344 3.05969 1.01662 3.09149 1.01662 3.12648C1.01662 5.71503 1.01662 8.30676 1.01662 10.8953C1.01662 11.3342 1.18817 11.6808 1.59164 11.8716C1.74731 11.9447 1.93157 11.9765 2.1063 11.9797C3.35484 11.9892 4.60019 11.9861 5.84873 11.9829C6.01393 11.9829 6.16007 12.0179 6.27761 12.1387C6.52224 12.3868 6.44599 12.8002 6.13148 12.9496C6.09335 12.9687 6.05523 12.9846 6.01711 13.0005C4.6129 13.0005 3.2087 13.0005 1.8045 13.0005C1.78543 12.9941 1.76637 12.9814 1.74731 12.9782C1.0325 12.8638 0.514663 12.479 0.203324 11.8302C0.108016 11.6331 0.0698925 11.4105 0.00317693 11.1974C0 8.40534 0 5.61327 0 2.81801Z">
                                                        </path>
                                                        <path
                                                            d="M9.6676 13.0009C9.3785 12.9278 9.07987 12.8833 8.8003 12.7815C7.48188 12.2981 6.64952 10.8385 6.89414 9.45837C7.11018 8.24042 7.80592 7.39771 8.97821 7.01928C10.1823 6.62814 11.2688 6.91434 12.1456 7.82701C12.9525 8.66972 13.194 9.69688 12.8541 10.8099C12.4919 11.996 11.6595 12.7116 10.4364 12.9532C10.3506 12.9691 10.2617 12.985 10.1759 13.0009C10.0044 13.0009 9.83598 13.0009 9.6676 13.0009ZM11.9741 9.92584C11.9741 8.79374 11.0432 7.86835 9.91541 7.87153C8.78759 7.87471 7.86946 8.79692 7.86628 9.92266C7.86311 11.0548 8.78759 11.9833 9.91858 11.9833C11.0496 11.9865 11.9772 11.0579 11.9741 9.92584Z">
                                                        </path>
                                                        <path
                                                            d="M3.67754 5.334C3.67754 5.61385 3.44562 5.84281 3.16605 5.83963C2.88648 5.83645 2.66092 5.6043 2.6641 5.32446C2.66727 5.05098 2.89601 4.8252 3.16923 4.8252C3.4488 4.8252 3.67754 5.05416 3.67754 5.334Z">
                                                        </path>
                                                        <path
                                                            d="M5.38258 5.83941C5.10301 5.84259 4.87427 5.61045 4.87109 5.33378C4.87109 5.05394 5.10301 4.82498 5.3794 4.82816C5.65262 4.83134 5.87818 5.05394 5.88453 5.32742C5.89089 5.60409 5.66215 5.83941 5.38258 5.83941Z">
                                                        </path>
                                                        <path
                                                            d="M8.0916 5.33696C8.0916 5.61681 7.85968 5.84577 7.58011 5.84259C7.30054 5.83941 7.07498 5.60727 7.07816 5.32742C7.08451 5.05394 7.31007 4.82816 7.58329 4.82816C7.86604 4.82498 8.09478 5.05712 8.0916 5.33696Z">
                                                        </path>
                                                        <path
                                                            d="M9.79737 5.83868C9.5178 5.83868 9.28906 5.60972 9.28906 5.32988C9.28906 5.05003 9.52098 4.82107 9.80055 4.82425C10.0738 4.82743 10.2993 5.05321 10.3025 5.3267C10.3057 5.60654 10.0769 5.83868 9.79737 5.83868Z">
                                                        </path>
                                                        <path
                                                            d="M3.16615 7.03519C3.44572 7.03201 3.67763 7.26097 3.67763 7.54082C3.67763 7.82066 3.44889 8.04962 3.16932 8.04962C2.89611 8.04962 2.66737 7.82384 2.66419 7.55036C2.65784 7.27051 2.88658 7.03837 3.16615 7.03519Z">
                                                        </path>
                                                        <path
                                                            d="M5.38331 8.04937C5.10374 8.05255 4.875 7.82041 4.875 7.54374C4.875 7.2639 5.10692 7.03494 5.38649 7.03812C5.6597 7.0413 5.88526 7.2639 5.88844 7.53738C5.89162 7.81405 5.66288 8.04619 5.38331 8.04937Z">
                                                        </path>
                                                        <path
                                                            d="M3.6778 9.76057C3.67144 10.0404 3.43635 10.263 3.15678 10.2567C2.87721 10.2503 2.65483 10.0118 2.66436 9.73195C2.67389 9.45846 2.9058 9.23904 3.17902 9.24222C3.45541 9.24858 3.68415 9.4839 3.6778 9.76057Z">
                                                        </path>
                                                        <path
                                                            d="M5.3794 10.2596C5.09983 10.2596 4.87109 10.0306 4.87109 9.75078C4.87109 9.47093 5.10301 9.24197 5.38258 9.24515C5.6558 9.24833 5.88136 9.47411 5.88453 9.7476C5.88771 10.0274 5.65897 10.2564 5.3794 10.2596Z">
                                                        </path>
                                                        <path
                                                            d="M10.4276 9.42294C10.5292 9.42294 10.6087 9.41976 10.6881 9.42294C10.9613 9.44202 11.1678 9.66462 11.1646 9.93492C11.1614 10.1989 10.9549 10.4215 10.6849 10.431C10.418 10.4405 10.1512 10.4405 9.88749 10.431C9.63016 10.4215 9.42366 10.2148 9.4173 9.954C9.40777 9.59148 9.40777 9.22577 9.4173 8.86325C9.42366 8.58659 9.64922 8.37988 9.91926 8.37988C10.1893 8.37988 10.4117 8.58977 10.4244 8.86325C10.4339 9.04451 10.4276 9.22577 10.4276 9.42294Z">
                                                        </path>
                                                    </svg>
                                                </span>
                                                <span class="text">
                                                    {{ $date }}
                                                </span>

                                        </div>
                                    </div>
                                    <a href="{{ route('posts.detail', $post->id) }}"
                                        class="about-details wrapper-details">{{ $post->title }}
                                    </a>
                                    <div class="divider"></div>
                                    <a href="{{ route('posts.detail', $post->id) }}" class="shop-btn">
                                        Xem chi tiết
                                        <span>
                                            <svg width="16" height="11" viewBox="0 0 16 11" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M12.6227 4.38176C12.5587 4.38176 12.4989 4.38176 12.4349 4.38176C8.56302 4.38176 4.69114 4.38176 0.819254 4.38176C0.7168 4.38176 0.614347 4.37785 0.516163 4.40129C0.195996 4.4677 -0.0302552 4.76459 0.00389589 5.05758C0.0423159 5.37791 0.302718 5.60839 0.644229 5.62793C0.712532 5.63183 0.780834 5.63183 0.853405 5.63183C4.71248 5.63183 8.57583 5.63183 12.4349 5.63183C12.4989 5.63183 12.5587 5.63183 12.6654 5.63183C12.5971 5.69824 12.5587 5.73731 12.516 5.77637C11.3805 6.8194 10.2407 7.86243 9.10517 8.90546C8.82342 9.16329 8.79354 9.51878 9.0326 9.77661C9.27166 10.0383 9.68574 10.0774 9.98029 9.86646C10.0272 9.8352 10.0657 9.79614 10.1084 9.75707C11.6494 8.34684 13.1905 6.93269 14.7273 5.51855C15.0987 5.17868 15.0987 4.83882 14.7273 4.49895C13.1777 3.077 11.6238 1.65504 10.0742 0.229172C9.8693 0.0416615 9.63878 -0.0481874 9.35276 0.0260357C8.88319 0.147137 8.70389 0.670605 9.00698 1.01437C9.0454 1.06125 9.09236 1.10032 9.13932 1.14329C10.2663 2.1746 11.389 3.20982 12.5203 4.24113C12.563 4.28019 12.6185 4.29972 12.6654 4.33098C12.6483 4.34269 12.6355 4.36223 12.6227 4.38176Z"
                                                    fill="#AE1C9A" />
                                            </svg>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="mt-5" style="font-size: 15px">
                {{$posts->links()}}
            </div>
        </div>
    </section>
@endsection
