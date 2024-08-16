@extends('web.master')
@section('content')

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Checkout</h1>
</div>
<!-- Single Page Header End -->


<!-- Checkout Page Start -->
@php $sub_total = 0 @endphp
@foreach((array) session('cart') as $id => $details)
    @php
        $sub_total += $details['price'] * $details['quantity'];
     @endphp
@endforeach


<div class="container-fluid py-5">
    <div class="container py-5">
        <h1 class="mb-4">Billing details</h1>
        <form id="checkout-form" action="{{route('web-place-order')}}" method="POST">
            @csrf
            <div class="row g-5">
                <div class="col-md-12 col-lg-6 col-xl-7">
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="form-item w-100">
                                <label class="form-label my-3">First Name<sup>*</sup></label>
                                <input name="firstname" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-item w-100">
                                <label class="form-label my-3">Last Name<sup>*</sup></label>
                                <input name="lastname" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <!-- <div class="form-item">
                        <label class="form-label my-3">Company Name<sup>*</sup></label>
                        <input type="text" class="form-control">
                    </div> -->
                    <div class="form-item">
                        <label class="form-label my-3">Address <sup>*</sup></label>
                        <input name="address" type="text" class="form-control" placeholder="House Number Street Name">
                    </div>
                    <!-- <div class="form-item">
                        <label class="form-label my-3">Town/City<sup>*</sup></label>
                        <input type="text" class="form-control">
                    </div> -->
                    <!-- <div class="form-item">
                        <label class="form-label my-3">Country<sup>*</sup></label>
                        <input type="text" class="form-control">
                    </div> -->
                    <!-- <div class="form-item">
                        <label class="form-label my-3">Postcode/Zip<sup>*</sup></label>
                        <input type="text" class="form-control">
                    </div> -->
                    <div class="form-item">
                        <label class="form-label my-3">Mobile<sup>*</sup></label>

                        <input name="contact" type="tel" class="form-control">
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Email Address<sup>*</sup></label>
                        <input name="email" type="email" class="form-control">
                    </div>
                    <!-- <div class="form-check my-3">
                        <input type="checkbox" class="form-check-input" id="Account-1" name="Accounts" value="Accounts">
                        <label class="form-check-label" for="Account-1">Create an account?</label>
                    </div> -->
                    <hr>
                    <!-- <div class="form-check my-3">
                        <input class="form-check-input" type="checkbox" id="Address-1" name="Address" value="Address">
                        <label class="form-check-label" for="Address-1">Ship to a different address?</label>
                    </div> -->
                    <div class="form-item">
                        <textarea name="notes" class="form-control" spellcheck="false" cols="30" rows="11"
                            placeholder="Oreder Notes (Optional)"></textarea>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-5">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Products</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>

                                <!-- <tr>
                                    <th scope="row">
                                        <div class="d-flex align-items-center mt-2">
                                            <img src="img/vegetable-item-2.jpg" class="img-fluid rounded-circle"
                                                style="width: 90px; height: 90px;" alt="">
                                        </div>
                                    </th>
                                    <td class="py-5">Awesome Brocoli</td>
                                    <td class="py-5">$69.00</td>
                                    <td class="py-5">2</td>
                                    <td class="py-5">$138.00</td>
                                </tr> -->

                                @foreach ((array) session('cart') as $id => $details)
                                    <tr>
                                        <th scope="row">
                                            <div class="d-flex align-items-center mt-2">
                                                <img src="{{asset('uploads/products/' . $details['image'])}}"
                                                    class="img-fluid rounded-circle" style="width: 90px; height: 90px;"
                                                    alt="">
                                            </div>
                                        </th>
                                        <!-- <td class="py-5">Potatoes</td> -->
                                        <td class="py-5">{{$details['name']}}</td>
                                        <!-- <td class="py-5">$69.00</td> -->
                                        <td class="py-5">{{$details['price']}}</td>
                                        <!-- <td class="py-5">2</td> -->
                                        <td class="py-5">{{$details['quantity']}}</td>
                                        <!-- <td class="py-5">$138.00</td> -->
                                        <td class="py-5">{{$details['quantity'] * $details['price']}}</td>
                                    </tr>
                                @endforeach



                                <!-- <tr>
                                    <th scope="row">
                                        <div class="d-flex align-items-center mt-2">
                                            <img src="img/vegetable-item-3.png" class="img-fluid rounded-circle"
                                                style="width: 90px; height: 90px;" alt="">
                                        </div>
                                    </th>
                                    <td class="py-5">Big Banana</td>
                                    <td class="py-5">$69.00</td>
                                    <td class="py-5">2</td>
                                    <td class="py-5">$138.00</td>
                                </tr>

                                <tr>
                                    <th scope="row">
                                    </th>
                                    <td class="py-5"></td>
                                    <td class="py-5"></td>
                                    <td class="py-5">
                                        <p class="mb-0 text-dark py-3">Subtotal</p>
                                    </td>
                                    <td class="py-5">
                                        <div class="py-3 border-bottom border-top">
                                            <p class="mb-0 text-dark">$414.00</p>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th scope="row">
                                    </th>
                                    <td class="py-5">
                                        <p class="mb-0 text-dark py-4">Shipping</p>
                                    </td>
                                    <td colspan="3" class="py-5">
                                        <div class="form-check text-start">
                                            <input type="checkbox" class="form-check-input bg-primary border-0"
                                                id="Shipping-1" name="Shipping-1" value="Shipping">
                                            <label class="form-check-label" for="Shipping-1">Free Shipping</label>
                                        </div>
                                        <div class="form-check text-start">
                                            <input type="checkbox" class="form-check-input bg-primary border-0"
                                                id="Shipping-2" name="Shipping-1" value="Shipping">
                                            <label class="form-check-label" for="Shipping-2">Flat rate: $15.00</label>
                                        </div>
                                        <div class="form-check text-start">
                                            <input type="checkbox" class="form-check-input bg-primary border-0"
                                                id="Shipping-3" name="Shipping-1" value="Shipping">
                                            <label class="form-check-label" for="Shipping-3">Local Pickup: $8.00</label>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th scope="row">
                                    </th>
                                    <td class="py-5">
                                        <p class="mb-0 text-dark text-uppercase py-3">TOTAL</p>
                                    </td>
                                    <td class="py-5"></td>
                                    <td class="py-5"></td>
                                    <td class="py-5">
                                        <div class="py-3 border-bottom border-top">
                                            <p class="mb-0 text-dark">$135.00</p>
                                        </div>
                                    </td>
                                </tr> -->

                            </tbody>
                        </table>
                    </div>
                    <!-- <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                        <div class="col-12">
                             <div class="form-check text-start my-3">
                                <input type="checkbox" class="form-check-input bg-primary border-0" id="Transfer-1"
                                    name="Transfer" value="Transfer">
                                <label class="form-check-label" for="Transfer-1">Direct Bank Transfer</label>
                            </div>
                            <p class="text-start text-dark">Make your payment directly into our bank account. Please use
                                your Order ID as the payment reference. Your order will not be shipped until the funds
                                have cleared in our account.</p>
                        </div>
                    </div> -->
                    <!-- <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                        <div class="col-12">
                            <div class="form-check text-start my-3">
                                <input type="checkbox" class="form-check-input bg-primary border-0" id="Payments-1"
                                    name="Payments" value="Payments">
                                <label class="form-check-label" for="Payments-1">Check Payments</label>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                        <div class="col-12">
                            <div class="form-check text-start my-3">
                                <input type="checkbox" class="form-check-input bg-primary border-0" id="Delivery-1"
                                    name="Delivery" value="Delivery">
                                <label class="form-check-label" for="Delivery-1">Cash On Delivery</label>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                        <div class="col-12">
                            <div class="form-check text-start my-3">
                                <input type="checkbox" class="form-check-input bg-primary border-0" id="Paypal-1"
                                    name="Paypal" value="Paypal">
                                <label class="form-check-label" for="Paypal-1">Paypal</label>
                            </div>
                        </div>
                    </div> -->
                    <div class="row g-4 justify-content-end">
                        <div class="col-8"></div>
                        <div class="col">
                            <div class="bg-light rounded">
                                <div class="p-4">
                                    <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                                    <div class="d-flex justify-content-between mb-4">
                                        <h5 class="mb-0 me-4">Subtotal:</h5>
                                        <!-- <p class="mb-0">$96.00</p> -->
                                        <p class="mb-0">{{$sub_total}}</p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <h5 class="mb-0 me-4">Tax</h5>
                                        <div class="">
                                            <!-- <p class="mb-0">Flat rate: $3.00</p> -->
                                            @php
                                                $tax = $sub_total * 18 / 100;
                                                $total = $sub_total + $tax;
                                             @endphp
                                            <p class="mb-0">{{$tax}}</p>
                                        </div>
                                    </div>
                                    <!-- <p class="mb-0 text-end">Shipping to Ukraine.</p> -->
                                </div>
                                <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                                    <h5 class="mb-0 ps-4 me-4">Total</h5>
                                    <!-- <p class="mb-0 pe-4">$99.00</p> -->
                                    <p class="mb-0 pe-4">{{$total}}</p>
                                </div>
                                <!-- <a href="{{route('web-checkout')}}"
                                    class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4"
                                    type="button">Proceed Checkout</a> -->
                            </div>
                        </div>
                    </div>
                    <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                        <button onclick="submitCheckoutForm()" type="button"
                            class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">
                            Place Order
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Checkout Page End -->



<script>
    function submitCheckoutForm() {
        document.getElementById('checkout-form').submit();
    }
</script>
@endsection
