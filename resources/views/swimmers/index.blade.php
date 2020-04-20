@extends('layouts.layout')
@section('content')

    <div class="container">
        <div class="text-center">
            <h2>Swimmers</h2>
        </div>

        <div class="row">

            <div class="container">
                <div class="form-group form-control">
                    <a class="btn btn-primary btn-md" href="{{ URL::to('swimmers/create')}}">Add a New Swimmer</a>
                    <span class="float-right">
                    <label>Find an Existing Swimmer</label>
                    <input type="text" class="form-controller" id="search" name="search"
                           placeholder="&#xF002; Search"></input>
                    </span>
                </div>

                <div class="table-responsive-sm">
                    <table class="table-sm table-striped">
                        <thead id="table-headers">
                        <tr>
                            <th>Swimmer ID</th>
                            <th>Contact ID</th>
                            <th>Swimmer Name</th>
                            <th>Status</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Parent Name</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($swimmers as $swimmer)

                            <tr>
                                <td>{{$swimmer->swimmer_id}}</td>
                                <td>{{$swimmer->swimmer_contact_id}}</td>
                                <td>{{$swimmer->swimmer_full_name}}</td>
                                <td>{{$swimmer->swimmer_status}}</td>
                                <!-- if the swimmer is marked as an adult swimmer retrieve their mobil and email, otherwise use the parets -->
                                @if($swimmer->swimmer_adult_swimmer == 1)
                                    <td>{{$swimmer->swimmer_mobile}}</td>
                                    <td>{{$swimmer->swimmer_email}}</td>
                                    <td></td>
                                @else
                                    <td>{{$swimmer->parent_mobile}}</td>
                                    <td>{{$swimmer->parent_email}}</td>
                                    <td>{{$swimmer->parent_full_name}}</td>

                                @endif

                                <td><a class="btn btn-primary btn-sm"
                                       href="{{ URL::to('swimmers/' .$swimmer->swimmer_id)}}"><span
                                                class="fas fa-search" aria-hidden="true"></span></a></td>
                                <td><a class="btn btn-success btn-sm"
                                       href="{{ URL::to('swimmers/' .$swimmer->swimmer_id).'/edit/' }}"><span
                                                class="fas fa-edit" aria-hidden="true"></span></a></td>
                                <td><a class="btn btn-danger btn-sm"
                                       href="{{ URL::to('swimmers/' .$swimmer->swimmer_id).'/delete/' }}"><span
                                                class="fas fa-trash" aria-hidden="true"></span></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div id="nav-links">
                        {{ $swimmers->links() }}
                    </div>

                    @include('layouts\partials\alerts')
                </div>

            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {

            if ($('#search').val() === "") {
                //alert(data);
                $('#nav-links').show();
            } else {
                //alert($('#search').val());
                $('#nav-links').hide();
            }
        });

        $('#search').on('keyup', function () {
            $value = $(this).val();
            $.ajax({
                type: 'get',
                url: '{{URL::to('swimmers/search')}}',
                data: {'search': $value},
                success: function (data) {
                    if ($('#search').val() === "") {
                        //alert(data);
                        $('#nav-links').show();
                    } else {
                        //alert($('#search').val());
                        $('#nav-links').hide();
                        if (data === "") {
                            $('#table-headers').hide();
                            $('tbody').html('<h3>No swimmers found</h3>');
                        } else {
                            $('#table-headers').show();
                            $('tbody').html(data);
                        }

                    }
                }
            });
        });

    </script>
    <script type="text/javascript">
        $.ajaxSetup({headers: {'csrftoken': '{{ csrf_token() }}'}});
    </script>

@endsection