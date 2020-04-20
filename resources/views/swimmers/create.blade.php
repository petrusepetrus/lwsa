@extends('layouts.layout')
@section('pageTitle', 'Swimmer Details')
@section('content')

    <div class="container">
        <div class="py-5 text-left">
            <h2>Swimmer Details</h2>
        </div>

        <form class="needs-validation" novalidate method="POST" action="/swimmers/">
            @csrf


            <div class="card">
                <div class="card-body">
                    <h4 class="mb-3">Swimmer</h4>

                    <div class="form-row mb-3">
                        <div class="col-xs-4">
                            <label for="first-name">First name</label>
                            <input type="text" class="form-control " id="first-name"
                                   name="first-name"
                                   placeholder=""
                                   required
                                   value="{{old('first-name')}}">

                            <div class="invalid-feedback">
                                First name is required.
                            </div>
                        </div>

                        <div class="col-xs-4">
                            <label for="last-name">Last name</label>
                            <input type="text" class="form-control " id="last-name"
                                   name="last-name"
                                   placeholder=""
                                   required
                                   value="{{old('last-name')}}">
                            <div class="invalid-feedback">
                                Last name is required.
                            </div>
                        </div>


                        <div class="col-xs-4">
                            <label for="full-name">Full name</label>
                            <input type="text" class="form-control " id="full-name"
                                   name="full-name"
                                   placeholder="" ]
                                   disabled
                                   value="{{old('first-name')}} {{old('last-name')}}">
                        </div>
                    </div>

                    <div class="form-row mb-3">
                        <div class="col-xs-3">
                            <label for="date-of-birth">Date of Birth</label>
                            <input type="date" class="form-control " id="date-of-birth"
                                   name="date-of-birth"
                                   placeholder=""
                                   required
                                   value="{{old('date-of-birth')}}"
                            >
                            <div class="invalid-feedback">
                                Date of birth is required.
                            </div>
                        </div>

                        <div class="col-xs-1">
                            <label for="gender">Gender</label>
                            <select class="form-control" name="gender" required>

                                <option value="M">M
                                </option>
                                <option value="F">F
                                </option>


                            </select>
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>

                        <div class="col-xs-4" id="mobile-block-element" name="mobile-block-element">
                            <label for="mobile-phone">Mobile phone</label>
                            <input type="text" class="form-control " id="mobile-phone"
                                   name="mobile-phone"
                                   placeholder="Mobile"
                                   required
                                   value="{{old('mobile-phone')}}"
                            >
                            <div class="invalid-feedback">
                                Mobile phone required for adult swimmers
                            </div>
                        </div>

                        <div class="col-xs-4" id="email-block-element" name="email-block-element">
                            <label for="email">email</label>
                            <input type="email" class="form-control " id="email" name="email"
                                   placeholder="email"
                                   required
                                   value="{{old('email')}}"
                            >
                            <div class="invalid-feedback">
                                Email required for adult swimmers
                            </div>
                        </div>
                    </div>

                    <div class="form-row mb-3">
                        <div class="col-xs-4">
                            <input class="form-control form-check-input" type="checkbox"
                                   value="1"
                                   id="adult-swimmer"
                                   name="adult-swimmer"
                                   @if(old('adult-swimmer')==1)
                                   checked
                                    @endif
                            >

                            <label class="form-check-label" for="adult-swimmer">
                                Adult Swimmer</label>
                        </div>

                    </div>
                </div>
            </div>
            <div class="card" id="contact-block-element" id="contact-block-element" style="display:none ">
                <div class="card-body">
                    <h4 class="mb-3">Contact</h4>

                    <div class="form-row mb-3">
                        <div class="col-xs-4">
                            <label for="contact-first-name">First name</label>
                            <input type="text" class="form-control " id="contact-first-name"
                                   name="contact-first-name"
                                   placeholder=""

                                   value="{{old('contact-first-name')}}">

                            <div class="invalid-feedback">
                                First name is .
                            </div>
                        </div>

                        <div class="col-xs-4">
                            <label for="contact-last-name">Last name</label>
                            <input type="text" class="form-control " id="contact-last-name"
                                   name="contact-last-name"
                                   placeholder=""

                                   value="{{old('contact-last-name')}}">
                            <div class="invalid-feedback">
                                Last name is .
                            </div>
                        </div>


                        <div class="col-xs-4">
                            <label for="contact-full-name">Full name</label>
                            <input type="text" class="form-control " id="contact-full-name"
                                   name="contact-full-name"
                                   placeholder="" ]
                                   disabled
                                   value="{{old('contact-first-name')}} {{old('contact-last-name')}}">
                        </div>
                    </div>

                    <div class="form-row mb-3">
                        <div class="col-xs-3">
                            <label for="contact-date-of-birth">Date of Birth</label>
                            <input type="date" class="form-control " id="contact-date-of-birth"
                                   name="contact-date-of-birth"
                                   placeholder=""

                                   value="{{old('contact-date-of-birth')}}"
                            >
                            <div class="invalid-feedback">
                                Date of birth is .
                            </div>
                        </div>

                        <div class="col-xs-1">
                            <label for="contact-gender">Gender</label>
                            <select class="form-control" name="contact-gender">

                                <option value="M">M
                                </option>
                                <option value="F">F
                                </option>


                            </select>
                            <div class="invalid-feedback">
                                Valid last name is .
                            </div>
                        </div>

                        <div class="col-xs-4" id="mobile-block-element" name="mobile-block-element">
                            <label for="contact-mobile-phone">Mobile phone</label>
                            <input type="text" class="form-control " id="contact-mobile-phone"
                                   name="contact-mobile-phone"
                                   placeholder="Mobile"

                                   value="{{old('mobile-phone')}}"
                            >
                            <div class="invalid-feedback">
                                Mobile phone for adult swimmers
                            </div>
                        </div>

                        <div class="col-xs-4" id="email-block-element" name="email-block-element">
                            <label for="contact-email">email</label>
                            <input type="email" class="form-control " id="contact-email" name="contact-email"
                                   placeholder="email"

                                   value="{{old('contact-email')}}"
                            >
                            <div class="invalid-feedback">
                                Email for adult swimmers
                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div>
                        <div class="form-row col-xs-4 mb-3">
                            <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
                        </div>
                    </div>
                    <div>
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error}}</div>
                        @endforeach
                    </div>

                </div>
        </form>

        @include('layouts\partials\alerts')


        <script type="text/javascript">
            (function () {
                'use strict';
                window.addEventListener('load', function () {
                    // Fetch all the forms we want to apply custom Bootstrap validation styles to
                    var forms = document.getElementsByClassName('needs-validation');
                    // Loop over them and prevent submission
                    var validation = Array.prototype.filter.call(forms, function (form) {
                        form.addEventListener('submit', function (event) {

                            if (form.checkValidity() === false) {
                                event.preventDefault();
                                event.stopPropagation();
                            } else {
                                if (document.getElementById("adult-swimmer").checked === false) {
                                    document.getElementById("contact-block-element").style.display="block";
                                    document.getElementById("contact-first-name").setAttribute("required", "");
                                    document.getElementById("contact-last-name").setAttribute("required", "");
                                    document.getElementById("contact-date-of-birth").setAttribute("required", "");
                                    document.getElementById("contact-gender").setAttribute("required", "");
                                    document.getElementById("contact-mobile-phone").setAttribute("required", "");
                                    document.getElementById("contact-email").setAttribute("required", "");

                                    event.preventDefault();
                                    event.stopPropagation();

                                }
                            }
                            form.classList.add('was-validated');
                        }, false);
                    });
                }, false);

            })();

            $(document).ready(function () {


                document.getElementById("mobile-block-element").style.visibility = "visible";
                var checkbox = document.querySelector("input[name=adult-swimmer]");

                if (checkbox.checked) {
                    document.getElementById("email-block-element").style.visibility = "visible";
                    document.getElementById("mobile-block-element").style.visibility = "visible";
                    document.getElementById("email").setAttribute("required", "");
                    document.getElementById("mobile-phone").setAttribute("required", "");
                } else {
                    document.getElementById("email-block-element").style.visibility = "hidden";
                    document.getElementById("mobile-block-element").style.visibility = "hidden";
                    document.getElementById("email").removeAttribute("required");
                    document.getElementById("mobile-phone").removeAttribute("required");
                }
                checkbox.addEventListener('change', function () {
                    if (this.checked) {
                        document.getElementById("email-block-element").style.visibility = "visible";
                        document.getElementById("mobile-block-element").style.visibility = "visible";
                        document.getElementById("email").setAttribute("required", "");
                        document.getElementById("mobile-phone").setAttribute("required", "");
                    } else {
                        document.getElementById("email-block-element").style.visibility = "hidden";
                        document.getElementById("mobile-block-element").style.visibility = "hidden";
                        document.getElementById("email").removeAttribute("required");
                        document.getElementById("mobile-phone").removeAttribute("required");
                    }
                });


            });
        </script>

@endsection