@extends('client.profile.layout')
@section('main-content')
    <div class="payment-section">
        <div class="wrapper">
            <div class="wrapper-item">
                <div class="wrapper-img">
                    <img src="assets/images/homepage-one/payment-img-1.png" alt="payment">
                </div>
                <div class="wrapper-content">
                    <h5 class="heading">Dutch Bangl Bank Lmtd</h5>
                    <p class="paragraph">Bank **********5535</p>
                    <p class="verified">Verified</p>
                </div>
            </div>
            <a href="#" class="shop-btn">Manage</a>
        </div>
        <hr>
        <div class="wrapper">
            <div class="wrapper-item">
                <div class="wrapper-img">
                    <img src="assets/images/homepage-one/payment-img-2.png" alt="payment">
                </div>
                <div class="wrapper-content">
                    <h5 class="heading">Master Card</h5>
                    <p class="paragraph">Bank **********5535</p>
                    <p class="verified">Verified</p>
                </div>
            </div>
            <a href="#" class="shop-btn">Manage</a>
        </div>
        <hr>
        <div class="wrapper">
            <div class="wrapper-item">
                <div class="wrapper-img">
                    <img src="assets/images/homepage-one/payment-img-3.png" alt="payment">
                </div>
                <div class="wrapper-content">
                    <h5 class="heading">Paypal Account</h5>
                    <p class="paragraph">Bank **********5535</p>
                    <p class="verified">Verified</p>
                </div>
            </div>
            <a href="#" class="shop-btn">Manage</a>
        </div>
        <hr>
        <div class="wrapper">
            <div class="wrapper-item">
                <div class="wrapper-img">
                    <img src="assets/images/homepage-one/payment-img-4.png" alt="payment">
                </div>
                <div class="wrapper-content">
                    <h5 class="heading">Visa Card</h5>
                    <p class="paragraph">Bank **********5535</p>
                    <p class="verified">Verified</p>
                </div>
            </div>
            <a href="#" class="shop-btn">Manage</a>
        </div>
        <hr>
        <div class="wrapper-btn">
            <a href="#" class="shop-btn" onclick="modalAction('.cart')">Add Cart</a>

            <div class="modal-wrapper cart">
                <div onclick="modalAction('.cart')" class="anywhere-away"></div>

                <div class="login-section account-section modal-main">
                    <div class="review-form">
                        <div class="review-content">
                            <h5 class="comment-title">Add New Card</h5>
                            <div class="close-btn">
                                <img src="assets/images/homepage-one/close-btn.png"
                                     onclick="modalAction('.cart')" alt="close-btn">
                            </div>
                        </div>
                        <div class="review-form-name address-form">
                            <label for="cnumber" class="form-label">Card Number*</label>
                            <input type="number" id="cnumber" class="form-control"
                                   placeholder="*** *** ***">
                        </div>
                        <div class="review-form-name address-form">
                            <label for="holdername" class="form-label">Card Holder Name*</label>
                            <input type="text" id="holdername" class="form-control"
                                   placeholder="Demo Name">
                        </div>
                        <div class=" account-inner-form">
                            <div class="review-form-name">
                                <label for="expirydate" class="form-label">Expiry Date*</label>
                                <input type="date" id="expirydate" class="form-control">
                            </div>
                            <div class="review-form-name">
                                <label for="cvv" class="form-label">CVV*</label>
                                <input type="number" id="cvv" class="form-control"
                                       placeholder="21232">
                            </div>
                        </div>
                        <div class="login-btn text-center">
                            <a href="#" onclick="modalAction('.cart')" class="shop-btn">Add
                                Card</a>
                        </div>
                    </div>
                </div>

            </div>
            <a href="#" class="shop-btn bank-btn" onclick="modalAction('.bank')">Add
                Bank</a>

            <div class="modal-wrapper bank">
                <div onclick="modalAction('.bank')" class="anywhere-away"></div>

                <div class="login-section account-section modal-main">
                    <div class="review-form">
                        <div class="review-content">
                            <h5 class="comment-title">Add Bank Account</h5>
                            <div class="close-btn">
                                <img src="assets/images/homepage-one/close-btn.png"
                                     onclick="modalAction('.bank')" alt="close-btn">
                            </div>
                        </div>
                        <div class="review-form-name address-form">
                            <label for="accountnumber" class="form-label">Account
                                Number*</label>
                            <input type="number" id="accountnumber" class="form-control"
                                   placeholder="*** *** ***">
                        </div>
                        <div class="review-form-name address-form">
                            <label for="accountholdername" class="form-label">Card Holder
                                Name*</label>
                            <input type="text" id="accountholdername" class="form-control"
                                   placeholder="Demo Name">
                        </div>
                        <div class=" account-inner-form">
                            <div class="review-form-name">
                                <label for="branchname" class="form-label">Branch*</label>
                                <input type="text" id="branchname" class="form-control"
                                       placeholder="Demo Branch">
                            </div>
                            <div class="review-form-name">
                                <label for="ipscode" class="form-label">IPSC Code</label>
                                <input type="number" id="ipscode" class="form-control"
                                       placeholder="21232">
                            </div>
                        </div>
                        <div class="login-btn text-center">
                            <a href="#" onclick="modalAction('.bank')" class="shop-btn">Add
                                Bank
                                Account</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
