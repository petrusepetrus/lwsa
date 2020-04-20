@extends('layouts.layout')
@section('content')

    <div class="container">
        <div class="text-center">
            <h2>Swimmers Search</h2>
        </div>

        <div class="row">

            <div class="container">
                <div class="form-group form-control">
                    <a class="btn btn-primary btn-md" href="{{ URL::to('swimmers/create')}}">Add a New Swimmer</a>
                    <span class="float-right">
                    <label>Find an Existing Swimmer</label>
                    <input type="text" class="form-controller" id="search" name="search"></input>
                    </span>
                </div>

                <div class="table-responsive-sm">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Swimmer ID</th>
                            <th>Contact ID</th>
                            <th>Swimmer Name</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Parent Name</th>

                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <template>
                            <div>
                                <input type="text" v-model="swimmers">
                                <ul v-if="results.length > 0">
                                    <li v-for="result in results" :key="result.id" v-text="result.name"></li>
                                </ul>
                            </div>
                        </template>
                    </table>

                    @include('layouts\partials\alerts')
                </div>

            </div>
        </div>
    </div>
    <script>
        export default {
            data() {
                return {
                    keywords: null,
                    results: []
                };
            },

            watch: {
                keywords(after, before) {
                    this.fetch();
                }
            },

            methods: {
                fetch() {
                    axios.get('/api/swimmers/search', { params: { keywords: this.keywords } })
                        .then(response => this.results = response.data)
                        .catch(error => {});
                }
            }
        }
    </script>
    <script>
        export default{
            data(){
                return {
                    query: '',
                    results: []
                }
            },
            methods: {
                autoComplete(){
                    this.results = [];
                    if(this.query.length > 0){
                        axios.get('/api/swimmers/search',{params: {query: this.query}}).then(response => {
                            this.results = response.data;
                        });
                    }
                }
            }
        }
    </script>
    <!--
    <script type="text/javascript">
    //    $('#search').on('keyup', function () {
    //        $value = $(this).val();
    //        $.ajax({
    //            type: 'get',
    //            url: '{{URL::to('swimmers/search')}}',
    //            data: {'search': $value},
    //           success: function (data) {
    //                $('tbody').html(data);
    //            }
    //        });
    //    })
    </script>
    -->
    <script type="text/javascript">
        $.ajaxSetup({headers: {'csrftoken': '{{ csrf_token() }}'}});
    </script>
    <script type="text/javascript">
        var app = new Vue({
            export default{
                data() {
                    return {
                        query: '',
                        results: []
                    }
                },
                methods: {
                    autoComplete() {
                        this.results = [];
                        if (this.query.length > 2) {
                            axios.get('/api/swimmers/search', {params: {query: this.query}}).then(response => {
                                this.results = response.data;
                            });
                        }
                    }
                }
            }
        })
    </script>
@endsection