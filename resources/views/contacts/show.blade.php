@extends('layouts.layout')
@section('pageTitle', 'Contact Details')
@section('content')

    <div class="container">
        <div class="py-5 text-left">
            <h2>Contact Details</h2>
        </div>

        <div class="row">
            @foreach($contacts as $contact)
            <div class="col-md-8">
                    <div>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-3">Contact</h4>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="contactID">contact ID</label>
                                        <input type="text" class="form-control" id="contactID" placeholder=""
                                               value="{{$contact->id}}" readonly>
                                        <div class="invalid-feedback">

                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="first-name">First name</label>
                                        <input type="text" class="form-control" id="first-name" placeholder=""
                                               value="{{$contact->first_name}}" readonly>
                                        <div class="invalid-feedback">
                                            Valid first name is required.
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="last-name">Last name</label>
                                        <input type="text" class="form-control" id="last-name" placeholder=""
                                               value="{{$contact->last_name}}" readonly>
                                        <div class="invalid-feedback">
                                            Valid last name is required.
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="full-name">Full name</label>
                                        <input type="text" class="form-control" id="full-name" placeholder=""
                                               value="{{$contact->first_name}} {{$contact->last_name}}"
                                               readonly>
                                        <div class="invalid-feedback">
                                            Valid last name is required.
                                        </div>
                                    </div>


                                    <div class="col-md-6 mb-3">
                                        <label for="mobile">Mobile phone</label>
                                        <input type="text" class="form-control" id="mobile-phone"
                                               placeholder="Mobile"
                                               value="{{$contact->mobile}}" readonly>
                                        <div class="invalid-feedback">
                                            Valid last name is required.
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email">email</label>
                                        <input type="text" class="form-control" id="email" placeholder="email"
                                               value="{{$contact->email}}" readonly>

                                        <div class="invalid-feedback">
                                            Please enter a valid email address for shipping updates.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                @include('layouts\partials\alerts')

            </div>
        </div>

@endforeach
  </div>




@endsection