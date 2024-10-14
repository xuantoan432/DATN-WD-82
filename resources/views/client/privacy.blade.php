@extends('client.layouts.master')

@section('title')
   Cart
@endsection

@section('content')

@include('client.components.breadcrumbs')

<section class="product-cart product footer-padding">
    <div class="container">
        <div class="cart-section">
            <table>
                <tbody>
                    <tr class="table-row table-top-row">
                        <td class="table-wrapper wrapper-product">
                            <h5 class="table-heading">PRODUCT</h5>
                        </td>
                        <td class="table-wrapper">
                            <div class="table-wrapper-center">
                                <h5 class="table-heading">PRICE</h5>
                            </div>
                        </td>
                        <td class="table-wrapper">
                            <div class="table-wrapper-center">
                                <h5 class="table-heading">QUANTITY</h5>
                            </div>
                        </td>
                        <td class="table-wrapper wrapper-total">
                            <div class="table-wrapper-center">
                                <h5 class="table-heading">TOTAL</h5>
                            </div>
                        </td>
                        <td class="table-wrapper">
                            <div class="table-wrapper-center">
                                <h5 class="table-heading">ACTION</h5>
                            </div>
                        </td>
                    </tr>
                    <tr class="table-row ticket-row">
                        <td class="table-wrapper wrapper-product">
                            <div class="wrapper">
                                <div class="wrapper-img">
                                    <img src="/theme/client/assets/images/homepage-one/product-img/product-img-1.webp" alt="img">
                                </div>
                                <div class="wrapper-content">
                                    <h5 class="heading">Classic Oxford Shirt</h5>
                                </div>
                            </div>
                        </td>
                        <td class="table-wrapper">
                            <div class="table-wrapper-center">
                                <h5 class="heading">$10.00</h5>
                            </div>
                        </td>
                        <td class="table-wrapper">
                            <div class="table-wrapper-center">
                                <div class="quantity">
                                    <span class="minus">
                                        -
                                    </span>
                                    <span class="number">1</span>
                                    <span class="plus">
                                        +
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td class="table-wrapper wrapper-total">
                            <div class="table-wrapper-center">
                                <h5 class="heading">$60.00</h5>
                            </div>
                        </td>
                        <td class="table-wrapper">
                            <div class="table-wrapper-center">
                                <span>
                                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M9.7 0.3C9.3 -0.1 8.7 -0.1 8.3 0.3L5 3.6L1.7 0.3C1.3 -0.1 0.7 -0.1 0.3 0.3C-0.1 0.7 -0.1 1.3 0.3 1.7L3.6 5L0.3 8.3C-0.1 8.7 -0.1 9.3 0.3 9.7C0.7 10.1 1.3 10.1 1.7 9.7L5 6.4L8.3 9.7C8.7 10.1 9.3 10.1 9.7 9.7C10.1 9.3 10.1 8.7 9.7 8.3L6.4 5L9.7 1.7C10.1 1.3 10.1 0.7 9.7 0.3Z"
                                            fill="#AAAAAA"></path>
                                    </svg>
                                </span>
                            </div>
                        </td>
                    </tr>
                    <tr class="table-row ticket-row">
                        <td class="table-wrapper wrapper-product">
                            <div class="wrapper">
                                <div class="wrapper-img">
                                    <img src="/theme/client/assets/images/homepage-one/product-img/product-img-2.webp" alt="img">
                                </div>
                                <div class="wrapper-content">
                                    <h5 class="heading"> black Shirt</h5>
                                </div>
                            </div>
                        </td>
                        <td class="table-wrapper">
                            <div class="table-wrapper-center">
                                <h5 class="heading">$05.00</h5>
                            </div>
                        </td>
                        <td class="table-wrapper">
                            <div class="table-wrapper-center">
                                <div class="quantity">
                                    <span class="minus">
                                        -
                                    </span>
                                    <span class="number">1</span>
                                    <span class="plus">
                                        +
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td class="table-wrapper wrapper-total">
                            <div class="table-wrapper-center">
                                <h5 class="heading">$10.00</h5>
                            </div>
                        </td>
                        <td class="table-wrapper ">
                            <div class="table-wrapper-center">
                                <span>
                                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M9.7 0.3C9.3 -0.1 8.7 -0.1 8.3 0.3L5 3.6L1.7 0.3C1.3 -0.1 0.7 -0.1 0.3 0.3C-0.1 0.7 -0.1 1.3 0.3 1.7L3.6 5L0.3 8.3C-0.1 8.7 -0.1 9.3 0.3 9.7C0.7 10.1 1.3 10.1 1.7 9.7L5 6.4L8.3 9.7C8.7 10.1 9.3 10.1 9.7 9.7C10.1 9.3 10.1 8.7 9.7 8.3L6.4 5L9.7 1.7C10.1 1.3 10.1 0.7 9.7 0.3Z"
                                            fill="#AAAAAA"></path>
                                    </svg>
                                </span>
                            </div>
                        </td>
                    </tr>
                    <tr class="table-row ticket-row">
                        <td class="table-wrapper wrapper-product">
                            <div class="wrapper">
                                <div class="wrapper-img">
                                    <img src="/theme/client/assets/images/homepage-one/product-img/product-img-3.webp" alt="img">
                                </div>
                                <div class="wrapper-content">
                                    <h5 class="heading">Blue Party Shirt</h5>
                                </div>
                            </div>
                        </td>
                        <td class="table-wrapper">
                            <div class="table-wrapper-center">
                                <h5 class="heading">$30.00</h5>
                            </div>
                        </td>
                        <td class="table-wrapper">
                            <div class="table-wrapper-center">
                                <div class="quantity">
                                    <span class="minus">
                                        -
                                    </span>
                                    <span class="number">1</span>
                                    <span class="plus">
                                        +
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td class="table-wrapper wrapper-total">
                            <div class="table-wrapper-center">
                                <h5 class="heading">$50.00</h5>
                            </div>
                        </td>
                        <td class="table-wrapper">
                            <div class="table-wrapper-center">
                                <span>
                                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M9.7 0.3C9.3 -0.1 8.7 -0.1 8.3 0.3L5 3.6L1.7 0.3C1.3 -0.1 0.7 -0.1 0.3 0.3C-0.1 0.7 -0.1 1.3 0.3 1.7L3.6 5L0.3 8.3C-0.1 8.7 -0.1 9.3 0.3 9.7C0.7 10.1 1.3 10.1 1.7 9.7L5 6.4L8.3 9.7C8.7 10.1 9.3 10.1 9.7 9.7C10.1 9.3 10.1 8.7 9.7 8.3L6.4 5L9.7 1.7C10.1 1.3 10.1 0.7 9.7 0.3Z"
                                            fill="#AAAAAA"></path>
                                    </svg>
                                </span>
                            </div>
                        </td>
                    </tr>
                    <tr class="table-row ticket-row">
                        <td class="table-wrapper wrapper-product">
                            <div class="wrapper">
                                <div class="wrapper-img">
                                    <img src="/theme/client/assets/images/homepage-one/product-img/product-img-4.webp" alt="img">
                                </div>
                                <div class="wrapper-content">
                                    <h5 class="heading">Red Party Dress</h5>
                                </div>
                            </div>
                        </td>
                        <td class="table-wrapper">
                            <div class="table-wrapper-center">
                                <h5 class="heading">$20.00</h5>
                            </div>
                        </td>
                        <td class="table-wrapper">
                            <div class="table-wrapper-center">
                                <div class="quantity">
                                    <span class="minus">
                                        -
                                    </span>
                                    <span class="number">1</span>
                                    <span class="plus">
                                        +
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td class="table-wrapper wrapper-total">
                            <div class="table-wrapper-center">
                                <h5 class="heading">$40.00</h5>
                            </div>
                        </td>
                        <td class="table-wrapper">
                            <div class="table-wrapper-center">
                                <span>
                                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M9.7 0.3C9.3 -0.1 8.7 -0.1 8.3 0.3L5 3.6L1.7 0.3C1.3 -0.1 0.7 -0.1 0.3 0.3C-0.1 0.7 -0.1 1.3 0.3 1.7L3.6 5L0.3 8.3C-0.1 8.7 -0.1 9.3 0.3 9.7C0.7 10.1 1.3 10.1 1.7 9.7L5 6.4L8.3 9.7C8.7 10.1 9.3 10.1 9.7 9.7C10.1 9.3 10.1 8.7 9.7 8.3L6.4 5L9.7 1.7C10.1 1.3 10.1 0.7 9.7 0.3Z"
                                            fill="#AAAAAA"></path>
                                    </svg>
                                </span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="wishlist-btn cart-btn">
            <a href="empty-cart.html" class="clean-btn">Clear Cart</a>
            <a href="#" class="shop-btn update-btn">Update Cart</a>
            <a href="checkout.html" class="shop-btn">Proceed to Checkout</a>
        </div>
    </div>
</section>
<section class="product privacy footer-padding">
    <div class="container">
        <div class="privacy-section">
            <div class="policy">
                <h5 class="intro-heading">1. What Are Privacy Policy ?</h5>
                <p class="policy-details">Terms and conditions typically have a short description of your privacy
                    policy or a statement
                    declaring that using the site means expressing consent to the way you handle and process
                    personal data. It has survived not only five centuries but also the on leap into electronic
                    typesetting, remaining essentially unchanged. It wasn’t popularised in the 1960s with the
                    release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop
                    publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type
                    specimen book.</p>
            </div>
            <div class="policy">
                <h5 class="intro-heading">2. Ecommerce Terms and Conditions Examples</h5>
                <p class="policy-details">While it’s not legally required for ecommerce websites to have a terms and
                    conditions agreement, adding one will help protect your online business.As terms and conditions
                    are legally enforceable rules, they allow you to set standards for how users interact with your
                    site. Here are some of the major benefits of including terms and conditions on your ecommerce
                    site:
                    <span class="policy-inner-text">
                        It has survived not only five centuries but also the on leap into electronic typesetting,
                        remaining essentially unchanged. It wasn’t popularised in the 1960s with the release of
                        Letraset
                        sheets containing Lorem Ipsum passages, andei more recently with desktop.
                    </span>
                </p>
                <div class="policy-features">
                    <h5 class="intro-heading">Features :</h5>
                    <ul>
                        <li>
                            <p>slim body with metal cover</p>
                        </li>
                        <li>
                            <p>latest Intel Core i5-1135G7 processor (4 cores / 8 threads)</p>
                        </li>
                        <li>
                            <p>8GB DDR4 RAM and fast 512GB PCIe SSD</p>
                        </li>
                        <li>
                            <p>NVIDIA GeForce MX350 2GB GDDR5 graphics card backlit keyboard, touchpad with gesture
                                support</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="policy">
                <h5 class="intro-heading">3. Ecommerce Terms and Conditions Template [Free]</h5>
                <p class="policy-details">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
                    printer took a galley of type and scrambled it to make a type specimen book. It has survived not
                    only five centuries but also the on leap into electronic typesetting, remaining essentially
                    unchanged. It wasn’t popularised in the 1960s with the release of Letraset sheets containing
                    Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker
                    including versions of Lorem Ipsum to make a type specimen book. five centuries but also the on
                    leap into electronic typesetting, remaining essentially unchanged. It wasn’t popularised in the
                    1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently
                    with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make
                    a type specimen book.
                </p>
            </div>
            <div class="policy">
                <h5 class="intro-heading">4. What to Include in Terms and Conditions for Online Stores</h5>
                <p class="policy-details">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
                    printer took a galley of type and scrambled it to make a type specimen book. It has survived not
                    only five centuries but also the on leap into electronic typesetting, remaining essentially
                    unchanged. It wasn’t popularised in the 1960s with the release of Letraset sheets containing
                    Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker
                    including versions of Lorem Ipsum to make a type specimen book.
                    <span class="policy-inner-text">
                        five centuries but also the on leap into electronic typesetting, remaining essentially
                        unchanged. It wasn’t popularised in the 1960s with the release of Letraset sheets containing
                        Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus
                        PageMaker including versions of Lorem Ipsum to make a type specimen book. It wasn’t
                        popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
                        passages, andei more recently with desktop publishing software like Aldus PageMaker
                        including versions of Lorem Ipsum to make a type specimen book.
                    </span>
                </p>
            </div>
            <div class="policy">
                <h5 class="intro-heading">05.Pricing and Payment Terms</h5>
                <p class="policy-details">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
                    printer took a galley of type and scrambled it to make a type specimen book. It has survived not
                    only five centuries but also the on leap into electronic typesetting, remaining essentially
                    unchanged. It wasn’t popularised in the 1960s with the release of Letraset sheets containing
                    Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker
                    including versions of Lorem Ipsum to make a type specimen book.
                    <span class="policy-inner-text">
                        five centuries but also the on leap into electronic typesetting, remaining essentially
                        unchanged. It wasn’t popularised in the 1960s with the release of Letraset sheets containing
                        Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus
                        PageMaker including versions of Lorem Ipsum to make a type specimen book. It wasn’t
                        popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
                        passages, andei more recently with desktop publishing software like Aldus PageMaker
                        including versions of Lorem Ipsum to make a type specimen book.
                    </span>
                    <span class="policy-inner-text">
                        It has survived not only five centuries but also the on leap into electronic typesetting,
                        remaining essentially unchanged. It wasn’t popularised in the 1960s with the release of
                        Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing
                        software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen
                        book.
                    </span>
                </p>
            </div>
        </div>
    </div>
</section>

@endsection

