@extends('layouts.layout')
@section('pageTitle', 'Swimmer Details')
@section('content')

    <div class="container">
        <div class="py-5 text-left">
            <h2>Swimmer Details</h2>
        </div>


        @foreach($swimmers as $swimmer)
            <form class="form" method="POST" action="/swimmers/{{$swimmer->id}}">
                @csrf
                @method('PUT')

                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-3">Swimmer ID {{$swimmer->id}}</h4>

                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <label for="first-name">First name</label>
                                <input type="text" class="form-control " id="first-name"
                                       name="first-name"
                                       placeholder=""
                                       required
                                       value="{{$swimmer->swimmerContact->first_name}}">
                            </div>
                            <div class="invalid-feedback">
                            </div>


                            <div class="col-sm-4">
                                <label for="last-name">Last name</label>
                                <input type="text" class="form-control " id="last-name"
                                       name="last-name"
                                       placeholder=""
                                       value="{{$swimmer->swimmerContact->last_name}}">
                                <div class="invalid-feedback">

                                    Valid last name is required.
                                </div>
                            </div>


                            <div class="col-sm-4">
                                <label for="full-name">Full name</label>
                                <input type="text" class="form-control " id="full-name"
                                       name="full-name"
                                       placeholder="" ]
                                       disabled
                                       value="{{$swimmer->swimmerContact->first_name}} {{$swimmer->swimmerContact->last_name}}">
                                <div class="invalid-feedback">
                                    Valid last name is required.
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <label for="date-of-birth">Date of Birth</label>
                                <input type="date" class="form-control " id="date-of-birth"
                                       name="date-of-birth"
                                       placeholder=""
                                       value="{{old('date-of-birth',$swimmer->swimmerContact->date_of_birth)}}">
                                <div class="invalid-feedback">
                                    Valid last name is required.
                                </div>
                            </div>

                            <div class="col-sm-1">
                                <label for="gender">Gender</label>
                                <select class="form-control" name="gender">

                                    <option value="M"
                                            {{$swimmer->swimmerContact->sex == "M" ? 'selected="selected"' : '' }}}>M
                                    </option>
                                    <option value="F"
                                            {{$swimmer->swimmerContact->sex == "F" ? 'selected="selected"' : '' }}}>F
                                    </option>


                                </select>
                                <div class="invalid-feedback">
                                    Valid last name is required.
                                </div>
                            </div>

                            <div class="col-sm-4" id="mobile-block-element" name="mobile-block-element">
                                <label for="mobile-phone">Mobile phone</label>
                                <input type="text" class="form-control " id="mobile-phone"
                                       name="mobile-phone"
                                       placeholder="Mobile"
                                       value="{{old('mobile-phone',$swimmer->swimmerContact->mobile)}}">
                                <div class="invalid-feedback">
                                    Valid last name is required.
                                </div>
                            </div>

                            <div class="col-sm-4" id="email-block-element" name="email-block-element">
                                <label for="email">email</label>
                                <input type="email" class="form-control " id="email" name="email"
                                       placeholder="email"
                                       value="{{old('email',$swimmer->swimmerContact->email)}}">
                                <div class="invalid-feedback">

                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <input class="form-control form-check-input" type="checkbox"
                                       value="1"
                                       id="adult-swimmer"
                                       name="adult-swimmer"
                                       @if($swimmer->adult_swimmer ==1 or old('adult-swimmer')==1)
                                       checked
                                        @endif
                                >

                                <label class="form-check-label" for="adult-swimmer">
                                    Adult Swimmer</label>
                            </div>

                         </div>

                        <div class="row col-sm-4 mb-3">
                            <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
                        </div>
                    </div>

                    <div>
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error}}</div>
                        @endforeach
                    </div>


                @endforeach

            </form>

            @include('layouts\partials\alerts')

            <div>
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a href="#contacts" class="nav-link active" data-toggle="tab">Contacts</a>
                            </li>
                            <li class="nav-item">
                                <a href="#classes" class="nav-link" data-toggle="tab">Classes</a>
                            </li>
                            <li class="nav-item">
                                <a href="#awards" class="nav-link" data-toggle="tab">Awards</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="contacts">
                                <table class="table-sm table-striped">
                                    <thead id="table-headers">
                                    <tr>

                                        <th>Contact ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Relationship</th>
                                    </tr>
                                    </thead>


                                    @foreach($swimmer->swimmerContact->parentContacts as $swimmerParent)
                                        <tr>
                                            <td>{{$swimmerParent->id}}</td>
                                            <td>{{$swimmerParent->full_name}}</td>
                                            <td>{{$swimmerParent->email}}</td>
                                            <td>{{$swimmerParent->mobile}}</td>
                                            <td>{{$swimmerParent->relationship_type}}</td>
                                            <td><a class="btn btn-primary btn-sm"
                                                   href="{{ URL::to('contacts/' .$swimmerParent->id)}}"><span
                                                            class="fas fa-search" aria-hidden="true"></span></a></td>
                                            <td><a class="btn btn-success btn-sm"
                                                   href="{{ URL::to('contacts/' .$swimmerParent->id).'/edit/' }}"><span
                                                            class="fas fa-edit" aria-hidden="true"></span></a></td>
                                            <td><a class="btn btn-danger btn-sm"
                                                   href="{{ URL::to('contacts/' .$swimmerParent->id).'/delete/' }}"><span
                                                            class="fas fa-trash" aria-hidden="true"></span></a></td>

                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                            <div class="tab-pane fade" id="classes">
                                <table class="table-sm table-striped">
                                    <thead id="table-headers">
                                    <tr>

                                        <th>Class</th>

                                    </tr>
                                    </thead>

                                    @foreach($swimmer->swimClass as $swimClassDetail)
                                        <tr>
                                            <td>{{$swimClassDetail->class_identifier}}</td>
                                            <td><a class="btn btn-primary btn-sm"
                                                   href="{{ URL::to('classes/' .$swimClassDetail->id)}}"><span
                                                            class="fas fa-search" aria-hidden="true"></span></a></td>
                                            <td><a class="btn btn-success btn-sm"
                                                   href="{{ URL::to('swimmers/' .$swimClassDetail->id).'/edit/' }}"><span
                                                            class="fas fa-edit" aria-hidden="true"></span></a></td>
                                            <td><a class="btn btn-danger btn-sm"
                                                   href="{{ URL::to('swimmers/' .$swimClassDetail->id).'/delete/' }}"><span
                                                            class="fas fa-trash" aria-hidden="true"></span></a></td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                            <div class="tab-pane fade" id="awards">
                                <p>Messages tab content ...</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


    </div>

    <script type="text/javascript">
        $(document).ready(function () {


            document.getElementById("mobile-block-element").style.visibility = "visible";
            var checkbox = document.querySelector("input[name=adult-swimmer]");

            if (checkbox.checked) {
                document.getElementById("email-block-element").style.visibility = "visible";
                document.getElementById("mobile-block-element").style.visibility = "visible";
            } else {
                document.getElementById("email-block-element").style.visibility = "hidden";
                document.getElementById("mobile-block-element").style.visibility = "hidden";
            }
            checkbox.addEventListener('change', function () {
                if (this.checked) {
                    document.getElementById("email-block-element").style.visibility = "visible";
                    document.getElementById("mobile-block-element").style.visibility = "visible";
                } else {
                    document.getElementById("email-block-element").style.visibility = "hidden";
                    document.getElementById("mobile-block-element").style.visibility = "hidden";
                }
            });

        });
    </script>

@endsection