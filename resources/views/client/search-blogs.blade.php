@extends('client.layouts.master')

@section('title')
    Kết quả tìm kiếm bài viết
@endsection

@section('content')
    @include('client.components.breadcrumbs')
    <section class="latest product footer-padding">
        <div class="container">
            <div class="blog-section latest-section">
                <div class="row g-5">
                    <h5 class="text-center">Kết quả tìm kiếm cho: {{ request('key') }} </h5>
                    @if ($searchPost->isEmpty())
                        <p>Không tìm thấy bài viết nào.</p>
                    @else
                        @foreach ($searchPost as $search)
                            @php
                                $date_one = $search->created_at;
                                $date_day = date('d', strtotime($date_one));
                                $date_M = date('m', strtotime($date_one));
                                $date_Y = date('Y', strtotime($date_one));
                                $date = $date_day . '/' . $date_M . '/' . $date_Y;
                            @endphp
                            <div class="col-lg-4 col-sm-6">
                                <div class="blogs-wrapper product-wrapper" data-aos="fade-up">
                                    <div class="wrapper-img">
                                        <img src="{{ Storage::url($search->thumbnail) }}" alt="img">
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
                                                    @if ($search->user->hasRole(1))
                                                        Admin
                                                    @elseif ($search->user->hasRole(2))
                                                        Seller {{ $search->user->name }}
                                                    @else
                                                        Không rõ vai trò
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="comments wrapper-item">
                                                <span class="icon">
                                                    <svg width="16" height="15" viewBox="0 0 16 15" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M3.73587 12.2092C3.29657 12.1112 2.8914 11.9493 2.52887 11.698C1.55219 11.0206 1.02333 10.0834 1.01053 8.89479C0.989208 7.06292 0.993473 5.23105 1.00627 3.39919C1.02333 1.68235 2.23885 0.297797 3.94059 0.0379278C4.11119 0.0123668 4.29032 0.00384653 4.46518 0.00384653C7.1564 0.00384653 9.84761 -0.000413627 12.5388 0.00384653C14.2064 0.00810668 15.5712 1.10723 15.9167 2.73034C15.9679 2.97317 15.9892 3.22452 15.9892 3.47587C15.9935 5.25236 15.9977 7.0331 15.9935 8.80958C15.9892 10.5136 14.8632 11.8939 13.2042 12.2134C12.9696 12.2603 12.7307 12.2688 12.4919 12.2688C11.2934 12.2731 10.0992 12.2731 8.90078 12.2688C8.77283 12.2688 8.66621 12.2986 8.55958 12.3711C7.33126 13.1933 6.10294 14.0112 4.87462 14.8334C4.71682 14.9399 4.55048 15.0166 4.35429 14.9953C3.9875 14.957 3.7444 14.6843 3.74013 14.3009C3.73587 13.6747 3.74013 13.0442 3.74013 12.4179C3.73587 12.354 3.73587 12.2901 3.73587 12.2092ZM5.09214 13.0442C5.16891 12.9973 5.21582 12.9632 5.26274 12.9334C6.17971 12.3242 7.09669 11.715 8.0094 11.0973C8.20559 10.9652 8.40178 10.9098 8.63635 10.9098C9.94144 10.9141 11.2423 10.9141 12.5474 10.9098C13.7416 10.9056 14.6329 10.0109 14.6329 8.81384C14.6329 7.02458 14.6329 5.23531 14.6329 3.44605C14.6329 2.26173 13.7373 1.36284 12.5516 1.36284C9.85614 1.36284 7.1564 1.36284 4.46092 1.36284C3.27098 1.36284 2.37533 2.26173 2.37533 3.45457C2.37533 5.23957 2.37533 7.02032 2.37533 8.80532C2.37533 9.97261 3.20701 10.8459 4.37562 10.9056C4.84903 10.9311 5.09214 11.1825 5.0964 11.6554C5.09214 12.1069 5.09214 12.5543 5.09214 13.0442Z"
                                                            fill="#AE1C9A" />
                                                        <path
                                                            d="M8.48293 5.45638C7.13519 5.45638 5.79171 5.45638 4.44397 5.45638C3.93644 5.45638 3.60377 4.99628 3.77437 4.54044C3.87673 4.26353 4.08998 4.12295 4.38 4.09313C4.43118 4.08887 4.48662 4.08887 4.5378 4.08887C7.17784 4.08887 9.81361 4.08887 12.4536 4.08887C12.5688 4.08887 12.6882 4.09739 12.7991 4.13147C13.1147 4.22945 13.2981 4.5447 13.2512 4.88552C13.2085 5.19651 12.9271 5.44786 12.5944 5.45212C12.2105 5.46064 11.8267 5.45212 11.4471 5.45212C10.4619 5.45638 9.47241 5.45638 8.48293 5.45638Z"
                                                            fill="#AE1C9A" />
                                                        <path
                                                            d="M8.483 8.17895C7.58735 8.17895 6.69597 8.18321 5.80458 8.17895C5.3269 8.17469 5.01129 7.78701 5.11792 7.3397C5.18189 7.05853 5.42926 6.84552 5.71928 6.82848C5.76193 6.82422 5.80458 6.82422 5.84723 6.82422C7.61721 6.82422 9.39145 6.82422 11.1614 6.82422C11.5581 6.82422 11.8268 7.02871 11.895 7.37378C11.976 7.78275 11.6818 8.16617 11.2638 8.17895C10.8885 8.19173 10.5089 8.18321 10.1293 8.18321C9.57911 8.17895 9.03319 8.17895 8.483 8.17895Z"
                                                            fill="#AE1C9A" />
                                                    </svg>
                                                </span>
                                                <span class="text">
                                                    {{ $date }}
                                                </span>

                                            </div>
                                        </div>
                                        <a href="blogs-details.html"
                                            class="about-details wrapper-details">{{ $search->title }}
                                        </a>
                                        <div class="divider"></div>
                                        <a href="#" class="shop-btn">
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
                    @endif




                </div>
            </div>
        </div>
    </section>

@endsection
