@extends('client.layouts.master')

@section('title')
   Compaire
@endsection

@section('content')

@include('client.components.breadcrumbs')

<section class="product-cart product product-compair footer-padding">
    <div class="container">
        <div class="cart-section">
            <table>
                <tbody>
                    <tr class="cart-top">
                        <td class=" cart-item cart-grey-bg vertical-cart">
                            <div class="wrapper-title">
                                <h5 class="comment-title">Product Comparison</h5>
                                <p class="paragraph">Select products to see the differences and similarities between
                                    them</p>
                            </div>
                        </td>
                        <td class="cart-center cart-item">
                            <div class="wrapper-data">
                                <div class="search">
                                    <input type="text">
                                    <span>
                                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M11.0821 12.2955C10.0273 13.0961 8.71195 13.5712 7.2856 13.5712C3.81416 13.5712 1 10.757 1 7.2856C1 3.81416 3.81416 1 7.2856 1C10.757 1 13.5712 3.81416 13.5712 7.2856C13.5712 8.97024 12.9085 10.5001 11.8295 11.6286L11.6368 11.436L10.9297 12.1431L11.0821 12.2955ZM11.795 13.0084C10.5546 13.9871 8.98829 14.5712 7.2856 14.5712C3.26187 14.5712 0 11.3093 0 7.2856C0 3.26187 3.26187 0 7.2856 0C11.3093 0 14.5712 3.26187 14.5712 7.2856C14.5712 9.24638 13.7966 11.0263 12.5367 12.3359L16.4939 16.293L15.7868 17.0001L11.795 13.0084Z">
                                            </path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="wrapper">
                                    <div class="wrapper-img">
                                        <img src="/themes/client/assets/images/homepage-one/product-img/product-img-1.webp" alt>
                                    </div>
                                    <div class="wrapper-content">
                                        <h5 class="wrapper-details">Leather</h5>
                                        <div class="price">
                                            <span class="new-price">$6.99</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="cart-center cart-item">
                            <div class="wrapper-data">
                                <div class="search">
                                    <input type="text">
                                    <span>
                                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M11.0821 12.2955C10.0273 13.0961 8.71195 13.5712 7.2856 13.5712C3.81416 13.5712 1 10.757 1 7.2856C1 3.81416 3.81416 1 7.2856 1C10.757 1 13.5712 3.81416 13.5712 7.2856C13.5712 8.97024 12.9085 10.5001 11.8295 11.6286L11.6368 11.436L10.9297 12.1431L11.0821 12.2955ZM11.795 13.0084C10.5546 13.9871 8.98829 14.5712 7.2856 14.5712C3.26187 14.5712 0 11.3093 0 7.2856C0 3.26187 3.26187 0 7.2856 0C11.3093 0 14.5712 3.26187 14.5712 7.2856C14.5712 9.24638 13.7966 11.0263 12.5367 12.3359L16.4939 16.293L15.7868 17.0001L11.795 13.0084Z">
                                            </path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="wrapper">
                                    <div class="wrapper-img">
                                        <img src="/themes/client/assets/images/homepage-one/product-img/product-img-2.webp" alt>
                                    </div>
                                    <div class="wrapper-content">
                                        <h5 class="wrapper-details">Bags</h5>
                                        <div class="price">
                                            <span class="new-price">$8.99</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="cart-center cart-item">
                            <div class="wrapper-data">
                                <div class="search">
                                    <input type="text">
                                    <span>
                                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M11.0821 12.2955C10.0273 13.0961 8.71195 13.5712 7.2856 13.5712C3.81416 13.5712 1 10.757 1 7.2856C1 3.81416 3.81416 1 7.2856 1C10.757 1 13.5712 3.81416 13.5712 7.2856C13.5712 8.97024 12.9085 10.5001 11.8295 11.6286L11.6368 11.436L10.9297 12.1431L11.0821 12.2955ZM11.795 13.0084C10.5546 13.9871 8.98829 14.5712 7.2856 14.5712C3.26187 14.5712 0 11.3093 0 7.2856C0 3.26187 3.26187 0 7.2856 0C11.3093 0 14.5712 3.26187 14.5712 7.2856C14.5712 9.24638 13.7966 11.0263 12.5367 12.3359L16.4939 16.293L15.7868 17.0001L11.795 13.0084Z">
                                            </path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="wrapper">
                                    <div class="wrapper-img">
                                        <img src="/themes/client/assets/images/homepage-one/product-img/product-img-3.webp" alt>
                                    </div>
                                    <div class="wrapper-content">
                                        <h5 class="wrapper-details">Shoe</h5>
                                        <div class="price">
                                            <span class="new-price">$10.99</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="cart-top cart-bottom ">
                        <td class=" cart-item cart-grey-bg">
                            <div class="wrapper-title">
                                <h5 class="comment-title">Star Rating</h5>
                            </div>
                        </td>
                        <td class=" cart-item">
                            <div class="wrapper-data">
                                <div class="ratings">
                                    <span>
                                        <svg width="90" height="18" viewBox="0 0 90 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M9 0L11.0206 6.21885H17.5595L12.2694 10.0623L14.2901 16.2812L9 12.4377L3.70993 16.2812L5.73056 10.0623L0.440492 6.21885H6.97937L9 0Z"
                                                fill="#FFA800" />
                                            <path
                                                d="M27 0L29.0206 6.21885H35.5595L30.2694 10.0623L32.2901 16.2812L27 12.4377L21.7099 16.2812L23.7306 10.0623L18.4405 6.21885H24.9794L27 0Z"
                                                fill="#FFA800" />
                                            <path
                                                d="M45 0L47.0206 6.21885H53.5595L48.2694 10.0623L50.2901 16.2812L45 12.4377L39.7099 16.2812L41.7306 10.0623L36.4405 6.21885H42.9794L45 0Z"
                                                fill="#FFA800" />
                                            <path
                                                d="M63 0L65.0206 6.21885H71.5595L66.2694 10.0623L68.2901 16.2812L63 12.4377L57.7099 16.2812L59.7306 10.0623L54.4405 6.21885H60.9794L63 0Z"
                                                fill="#FFA800" />
                                            <path
                                                d="M81 0L83.0206 6.21885H89.5595L84.2694 10.0623L86.2901 16.2812L81 12.4377L75.7099 16.2812L77.7306 10.0623L72.4405 6.21885H78.9794L81 0Z"
                                                fill="#FFA800" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td class="cart-item">
                            <div class="wrapper-data">
                                <div class="ratings">
                                    <span>
                                        <svg width="90" height="18" viewBox="0 0 90 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M9 0L11.0206 6.21885H17.5595L12.2694 10.0623L14.2901 16.2812L9 12.4377L3.70993 16.2812L5.73056 10.0623L0.440492 6.21885H6.97937L9 0Z"
                                                fill="#FFA800" />
                                            <path
                                                d="M27 0L29.0206 6.21885H35.5595L30.2694 10.0623L32.2901 16.2812L27 12.4377L21.7099 16.2812L23.7306 10.0623L18.4405 6.21885H24.9794L27 0Z"
                                                fill="#FFA800" />
                                            <path
                                                d="M45 0L47.0206 6.21885H53.5595L48.2694 10.0623L50.2901 16.2812L45 12.4377L39.7099 16.2812L41.7306 10.0623L36.4405 6.21885H42.9794L45 0Z"
                                                fill="#FFA800" />
                                            <path
                                                d="M63 0L65.0206 6.21885H71.5595L66.2694 10.0623L68.2901 16.2812L63 12.4377L57.7099 16.2812L59.7306 10.0623L54.4405 6.21885H60.9794L63 0Z"
                                                fill="#FFA800" />
                                            <path
                                                d="M81 0L83.0206 6.21885H89.5595L84.2694 10.0623L86.2901 16.2812L81 12.4377L75.7099 16.2812L77.7306 10.0623L72.4405 6.21885H78.9794L81 0Z"
                                                fill="#FFA800" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td class="cart-item">
                            <div class="wrapper-data">
                                <div class="ratings">
                                    <span>
                                        <svg width="90" height="18" viewBox="0 0 90 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M9 0L11.0206 6.21885H17.5595L12.2694 10.0623L14.2901 16.2812L9 12.4377L3.70993 16.2812L5.73056 10.0623L0.440492 6.21885H6.97937L9 0Z"
                                                fill="#FFA800" />
                                            <path
                                                d="M27 0L29.0206 6.21885H35.5595L30.2694 10.0623L32.2901 16.2812L27 12.4377L21.7099 16.2812L23.7306 10.0623L18.4405 6.21885H24.9794L27 0Z"
                                                fill="#FFA800" />
                                            <path
                                                d="M45 0L47.0206 6.21885H53.5595L48.2694 10.0623L50.2901 16.2812L45 12.4377L39.7099 16.2812L41.7306 10.0623L36.4405 6.21885H42.9794L45 0Z"
                                                fill="#FFA800" />
                                            <path
                                                d="M63 0L65.0206 6.21885H71.5595L66.2694 10.0623L68.2901 16.2812L63 12.4377L57.7099 16.2812L59.7306 10.0623L54.4405 6.21885H60.9794L63 0Z"
                                                fill="#FFA800" />
                                            <path
                                                d="M81 0L83.0206 6.21885H89.5595L84.2694 10.0623L86.2901 16.2812L81 12.4377L75.7099 16.2812L77.7306 10.0623L72.4405 6.21885H78.9794L81 0Z"
                                                fill="#FFA800" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="cart-top cart-bottom ">
                        <td class=" cart-item cart-grey-bg">
                            <div class="wrapper-title">
                                <h5 class="comment-title">Availability</h5>
                            </div>
                        </td>
                        <td class=" cart-item">
                            <div class="wrapper-data">
                                <p class="stock">In Stock</p>
                            </div>
                        </td>
                        <td class=" cart-item">
                            <div class="wrapper-data">
                                <p class="stock">In Stock</p>
                            </div>
                        </td>
                        <td class=" cart-item">
                            <div class="wrapper-data">
                                <p class="stock">In Stock</p>
                            </div>
                        </td>
                    </tr>
                    <tr class="cart-top cart-bottom ">
                        <td class=" cart-item cart-grey-bg">
                            <div class="wrapper-title">
                                <h5 class="comment-title">Specification</h5>
                            </div>
                        </td>
                        <td class=" cart-item">
                            <div class="wrapper-data">
                                <p>N/A</p>
                            </div>
                        </td>
                        <td class=" cart-item">
                            <div class="wrapper-data">
                                <p>N/A</p>
                            </div>
                        </td>
                        <td class=" cart-item">
                            <div class="wrapper-data">
                                <p>N/A</p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

@endsection

