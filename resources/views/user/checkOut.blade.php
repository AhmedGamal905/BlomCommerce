@extends('user.layout.app')

@section('content')
<form method="POST" action="{{ route('checkout.index') }}">
    @csrf
    <div class="col-xl-8">
        <div class="card mb-3">
            <div class="card-header bg-body-tertiary">
                <div class="row flex-between-center">
                    <div class="col-sm-auto">
                        <h5 class="mb-2 mb-sm-0">Your Shipping Address</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="col-12 mb-3">
                    <label class="form-label" for="product-title">{{ __('Name') }}:</label>
                    <input class="form-control" id="product-title" type="text" name="name" value="{{ old('name') }}" placeholder="{{ __('Name') }}" required />
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label" for="product-price">{{ __('Phone Number') }}:</label>
                    <input class="form-control" id="product-price" type="text" name="phone" value="{{ old('phone') }}" placeholder="{{ __('+20123456789') }}" required />
                    @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label" for="product-description">{{ __('Building Number') }}:</label>
                    <input class="form-control" id="product-description" type="text" name="building_number" value="{{ old('building_number') }}" placeholder="{{ __('Building Number') }}" required />
                    @error('building_number')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label" for="product-price">{{ __('Street Name') }}:</label>
                    <input class="form-control" id="product-price" type="text" name="street_name" value="{{ old('street_name') }}" placeholder="{{ __('Street Name') }}" required />
                    @error('street_name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label" for="product-title">{{ __('City') }}:</label>
                    <input class="form-control" id="product-title" type="text" name="city" value="{{ old('city') }}" placeholder="{{ __('City') }}" required />
                    @error('city')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label" for="product-description">{{ __('Postcode') }}:</label>
                    <input class="form-control" id="product-description" type="text" name="postcode" value="{{ old('postcode') }}" placeholder="{{ __('Postcode') }}" required />
                    @error('postcode')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-body-tertiary">
                    <h5 class="mb-0">Payment Method</h5>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-check mb-0">
                            <input class="form-check-input" type="radio" value="" id="credit-card" checked="checked" name="payment-method" />
                            <label class="form-check-label mb-2 fs-8" for="credit-card">Credit Card
                            </label>
                        </div>
                        <div class="row gx-0 ps-2 mb-4">
                            <div class="col-sm-8 px-3">
                                <div class="mb-3">
                                    <label class="form-label ls text-uppercase text-600 fw-semi-bold mb-0" for="inputNumber">Card Number</label>
                                    <input class="form-control" id="inputNumber" type="text" placeholder="•••• •••• •••• ••••" />
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <label class="form-label ls text-uppercase text-600 fw-semi-bold mb-0">Exp Date</label>
                                        <input class="form-control" type="text" placeholder="mm/yyyy" />
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label ls text-uppercase text-600 fw-semi-bold mb-0">CVV<a class="d-inline-block" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Card verification value"><span class="fa fa-question-circle ms-2"></span></a></label>
                                        <input class="form-control" type="text" placeholder="123" maxlength="3" pattern="[0-9]{3}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 ps-3 text-center pt-2 d-none d-sm-block">
                                <div class="rounded-1 p-2 mt-3 bg-100">
                                    <div class="text-uppercase fs-11 fw-bold">We Accept</div><img src="{{ asset('dashboard/public/assets/img/icons/icon-payment-methods-grid.png') }}" alt="" width="120" />
                                </div>
                            </div>
                        </div>
                        <div class="form-check d-flex align-items-center">
                            <input class="form-check-input" type="radio" value="" id="cash" name="payment-method" />
                            <label class="form-check-label mb-0 ms-2" for="paypal">Cash on delivery</label>
                        </div>
                        <div class="row">
                            <div class="col-md-5 col-xl-12 col-xxl-5 ps-lg-4 ps-xl-2 ps-xxl-5 text-center text-md-start text-xl-center text-xxl-start">
                                <div class="border-bottom border-dashed d-block d-md-none d-xl-block d-xxl-none my-4"></div>
                                <div class="fs-7 fw-semi-bold">All Total: <span class="text-primary">{{ $totalPrice }}</span></div>
                                <button class="btn btn-success mt-3 px-5" type="submit">Confirm &amp; Pay</button>
                                <p class="fs-10 mt-3 mb-0">By clicking <strong>Confirm & Pay </strong>button you agree to the <a href="#!">Terms &amp; Conditions</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection