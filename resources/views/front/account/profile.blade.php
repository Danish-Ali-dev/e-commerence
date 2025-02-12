@extends('front.layouts.app')

@section('content')
    <main>
        <section class="section-5 pt-3 pb-3 mb-3 bg-white">
            <div class="container">
                <div class="light-font">
                    <ol class="breadcrumb primary-color mb-0">
                        <li class="breadcrumb-item"><a class="white-text" href="#">My Account</a></li>
                        <li class="breadcrumb-item">Settings</li>
                    </ol>
                </div>
            </div>
        </section>

        <section class=" section-11 ">
            <div class="container  mt-5">
                <div class="row">
                    <div class="col-md-12">
                        @include('front.account.common.message')
                    </div>
                    <div class="col-md-3">
                        @include('front.account.common.sidebar')
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="h5 mb-0 pt-2 pb-2">Personal Information</h2>
                            </div>
                            <div class="card-body p-4">
                                <div class="row">
                                    <form action="" method="POST" name="profileForm" id="profileForm">
                                        <div class="mb-3">
                                            <label for="name">Name</label>
                                            <input type="text" value="{{ $user->name }}" name="name" id="name"
                                                placeholder="Enter Your Name" class="form-control">
                                            <p></p>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email">Email</label>
                                            <input type="text" value="{{ $user->email }}" name="email" id="email"
                                                placeholder="Enter Your Email" class="form-control">
                                            <p></p>
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone">Phone</label>
                                            <input type="text" value="{{ $user->phone }}" name="phone" id="phone"
                                                placeholder="Enter Your Phone" class="form-control">
                                            <p></p>
                                        </div>
                                        <div class="d-flex">
                                            <button class="btn btn-dark">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-5">
                            <div class="card-header">
                                <h2 class="h5 mb-0 pt-2 pb-2">Address Information</h2>
                            </div>
                            <div class="card-body p-4">
                                <div class="row">
                                    <form action="" method="POST" name="addressForm" id="addressForm">
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="first_name">First Name</label>
                                                <input type="text"
                                                    value="{{ !empty($address) ? $address->first_name : '' }}"
                                                    name="first_name" id="first_name" placeholder="First Name"
                                                    class="form-control">
                                                <p></p>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="name">Last Name</label>
                                                <input type="text"
                                                    value="{{ !empty($address) ? $address->last_name : '' }}" name="last_name"
                                                    id="last_name" placeholder="Last Name" class="form-control">
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="email">Email</label>
                                                <input type="email"
                                                    value="{{ !empty($address) ? $address->email : '' }}"
                                                    name="email" id="email" placeholder="Email"
                                                    class="form-control">
                                                <p></p>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="mobile">Mobile</label>
                                                <input type="text"
                                                    value="{{ !empty($address) ? $address->mobile : '' }}" name="mobile"
                                                    id="mobile" placeholder="Mobile" class="form-control">
                                                <p></p>
                                            </div> 
                                        </div>     
                                        <div class="mb-3">
                                            <label for="country">Country</label>
                                            <select name="country" id="country" class="form-control">
                                                <option value="">Select Country</option>
                                                @if ($countries->isNotEmpty())
                                                    @foreach ($countries as $country)
                                                        <option {{ (!empty($address) && $address->country_id == $country->id) ? 'selected' : '' }} value="{{ $country->id }}">{{ $country->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <p></p>
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone">Address</label>
                                            <textarea name="address" id="address" class="form-control" cols="30" rows="5"
                                                placeholder="Enter Your Address">{{ !empty($address) ? $address->address : '' }}</textarea>
                                            <p></p>
                                        </div>

                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="appartment">Appartment</label>
                                                <input type="text"
                                                    value="{{ !empty($address) ? $address->apartment : '' }}"
                                                    name="appartment" id="appartment" placeholder="Appartment"
                                                    class="form-control">
                                                <p></p>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="name">City</label>
                                                <input type="text"
                                                    value="{{ !empty($address) ? $address->city : '' }}" name="city"
                                                    id="city" placeholder="City" class="form-control">
                                                <p></p>
                                            </div> 
                                        </div>                                       
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="state">State</label>
                                                <input type="text"
                                                    value="{{ !empty($address) ? $address->state : '' }}"
                                                    name="state" id="state" placeholder="State"
                                                    class="form-control">
                                                <p></p>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="zip">Zip</label>
                                                <input type="text"
                                                    value="{{ !empty($address) ? $address->zip : '' }}" name="zip"
                                                    id="zip" placeholder="Zip" class="form-control">
                                                <p></p>
                                            </div> 
                                        </div>                                       
                                        <div class="d-flex">
                                            <button class="btn btn-dark">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('customJs')
    <script>
        $('#profileForm').submit(function(event) {
            event.preventDefault();
            $.ajax({
                url: "{{ route('account.updateAddress') }}",
                method: 'POST',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response) {
                    let errors = response.errors;
                    if (response.status == true) {
                        $("#profileForm #name").removeClass("is-invalid").siblings('p').removeClass(
                            'invalid-feedback').html("");
                        $("#profileForm #email").removeClass("is-invalid").siblings('p').removeClass(
                            'invalid-feedback').html("");
                        $("#profileForm #phone").removeClass("is-invalid").siblings('p').removeClass(
                            'invalid-feedback').html("");
                        window.location.href = "{{ route('account.profile') }}";
                    } else {
                        if (errors.name) {
                            $("#profileForm #name").addClass("is-invalid").siblings('p').addClass('invalid-feedback')
                                .html(errors.name);
                        } else {
                            $("#profileForm #name").removeClass("is-invalid").siblings('p').removeClass(
                                'invalid-feedback').html("");

                        }
                        if (errors.email) {
                            $("#profileForm #email").addClass("is-invalid").siblings('p').addClass(
                                'invalid-feedback').html(errors.email);
                        } else {
                            $("#profileForm #email").removeClass("is-invalid").siblings('p').removeClass(
                                'invalid-feedback').html("");

                        }
                        if (errors.phone) {
                            $("#profileForm #phone").addClass("is-invalid").siblings('p').addClass(
                                'invalid-feedback').html(errors.phone);
                        } else {
                            $("#profileForm #phone").removeClass("is-invalid").siblings('p').removeClass(
                                'invalid-feedback').html("");

                        }
                    }
                }
            });
        });

        $('#addressForm').submit(function(event) {
            event.preventDefault();
            $.ajax({
                url: "{{ route('account.updateAddress') }}",
                method: 'POST',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response) {
                    let errors = response.errors;
                    if (response.status == true) {
                        $("#first_name").removeClass("is-invalid").siblings('p').removeClass(
                            'invalid-feedback').html("");
                        $("#last_name").removeClass("is-invalid").siblings('p').removeClass(
                            'invalid-feedback').html("");
                        $("#addressForm #email").removeClass("is-invalid").siblings('p').removeClass(
                            'invalid-feedback').html("");
                        $("#mobile").removeClass("is-invalid").siblings('p').removeClass(
                            'invalid-feedback').html("");
                        $("#country").removeClass("is-invalid").siblings('p').removeClass(
                            'invalid-feedback').html("");
                        $("#address").removeClass("is-invalid").siblings('p').removeClass(
                            'invalid-feedback').html("");
                        $("#apparatment").removeClass("is-invalid").siblings('p').removeClass(
                            'invalid-feedback').html("");
                        $("#city").removeClass("is-invalid").siblings('p').removeClass(
                            'invalid-feedback').html("");
                        $("#state").removeClass("is-invalid").siblings('p').removeClass(
                            'invalid-feedback').html("");
                        $("#zip").removeClass("is-invalid").siblings('p').removeClass(
                            'invalid-feedback').html("");
                        window.location.href = "{{ route('account.profile') }}";
                    } else {
                        if (errors.first_name) {
                            $("#first_name").addClass("is-invalid").siblings('p').addClass('invalid-feedback')
                                .html(errors.first_name);
                        } else {
                            $("#first_name").removeClass("is-invalid").siblings('p').removeClass(
                                'invalid-feedback').html("");
                        }

                        if (errors.last_name) {
                            $("#last_name").addClass("is-invalid").siblings('p').addClass('invalid-feedback')
                                .html(errors.last_name);
                        } else {
                            $("#last_name").removeClass("is-invalid").siblings('p').removeClass(
                                'invalid-feedback').html("");
                        }

                        if (errors.email) {
                            $("#addressForm #email").addClass("is-invalid").siblings('p').addClass(
                                'invalid-feedback').html(errors.email);
                        } else {
                            $("#addressForm #email").removeClass("is-invalid").siblings('p').removeClass(
                                'invalid-feedback').html("");

                        }

                        if (errors.mobile) {
                            $("#mobile").addClass("is-invalid").siblings('p').addClass(
                                'invalid-feedback').html(errors.mobile);
                        } else {
                            $("#mobile").removeClass("is-invalid").siblings('p').removeClass(
                                'invalid-feedback').html("");

                        }

                        if (errors.country) {
                            $("#country").addClass("is-invalid").siblings('p').addClass(
                                'invalid-feedback').html(errors.country);
                        } else {
                            $("#country").removeClass("is-invalid").siblings('p').removeClass(
                                'invalid-feedback').html("");
                        }

                        if (errors.address) {
                            $("#address").addClass("is-invalid").siblings('p').addClass(
                                'invalid-feedback').html(errors.address);
                        } else {
                            $("#address").removeClass("is-invalid").siblings('p').removeClass(
                                'invalid-feedback').html("");
                        }
                        if (errors.apparatment) {
                            $("#apparatment").addClass("is-invalid").siblings('p').addClass(
                                'invalid-feedback').html(errors.apparatment);
                        } else {
                            $("#apparatment").removeClass("is-invalid").siblings('p').removeClass(
                                'invalid-feedback').html("");
                        }
                        if (errors.city) {
                            $("#city").addClass("is-invalid").siblings('p').addClass(
                                'invalid-feedback').html(errors.city);
                        } else {
                            $("#city").removeClass("is-invalid").siblings('p').removeClass(
                                'invalid-feedback').html("");
                        }

                        if (errors.state) {
                            $("#state").addClass("is-invalid").siblings('p').addClass(
                                'invalid-feedback').html(errors.state);
                        } else {
                            $("#state").removeClass("is-invalid").siblings('p').removeClass(
                                'invalid-feedback').html("");
                        }

                        if (errors.zip) {
                            $("#zip").addClass("is-invalid").siblings('p').addClass(
                                'invalid-feedback').html(errors.zip);
                        } else {
                            $("#zip").removeClass("is-invalid").siblings('p').removeClass(
                                'invalid-feedback').html("");
                        }
                    }
                }
            });
        });

    </script>
@endsection
