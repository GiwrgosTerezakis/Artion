@extends('layouts.app')


@section('content')

    <a id="BackFromApi" href="http://local.artion.com/">
        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-skip-backward-fill" fill="black" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M.5 3.5A.5.5 0 0 0 0 4v8a.5.5 0 0 0 1 0V4a.5.5 0 0 0-.5-.5z"/>
            <path d="M.904 8.697l6.363 3.692c.54.313 1.233-.066 1.233-.697V4.308c0-.63-.692-1.01-1.233-.696L.904 7.304a.802.802 0 0 0 0 1.393z"/>
            <path d="M8.404 8.697l6.363 3.692c.54.313 1.233-.066 1.233-.697V4.308c0-.63-.693-1.01-1.233-.696L8.404 7.304a.802.802 0 0 0 0 1.393z"/>
        </svg>


    </a>
    <div class="container">

        <!-- The Modal -->
        <div class="modal" id="myModal1">
            <div class="modal-dialog">
                <div id="apimodal" class="modal-content">

                    <!-- Modal body -->
                    <div class="modal-body">
                        <table id="api">
                            <thead>
                            <tr>
                                <th> #</th>
                                <th> TITLE</th>
                                <th> TEXT</th>
                                <th> AUTHOR</th>
                                <th> >1000VIEWS</th>
                                <th> DATE_POSTED</th>
                            </tr>
                            </thead>
                        </table>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" id="DestroyTable" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <section class="search-sec">
        <div class="container">
            <div class="Title-Api">
                <h1> Api Search </h1>
            </div>

            <form id="submitdataform">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-12 p-0">


                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                <select class="form-control search-slt" id="year">
                                    <option value="" disabled selected> Post's year </option>

                                    <option>
                                      2017
                                    </option>

                                    <option>
                                      2018
                                    </option>

                                    <option>
                                      2019
                                    </option>

                                    <option>
                                       2020
                                    </option>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                <select class="form-control search-slt" id="numberPosts">

                                    <option value="" disabled selected>Search Limit</option>

                                    <option>
                                       10
                                    </option>

                                    <option>
                                       20
                                    </option>

                                    <option>
                                       40
                                    </option>

                                    <option>
                                       50
                                    </option>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                <button type="button" data-toggle="modal" data-target="#myModal1" id="submitbtn" class="btn btn-danger wrn-btn">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="custom-control custom-switch">
                    <input name="views" type="checkbox" class="custom-control-input" id="views" >
                    <label class="custom-control-label" for="views">Post have more than 1000 views</label>
                </div>
            </form>
        </div>
    </section>





@endsection

@section('scripts')


    <script>


        $("#submitbtn").click(function (event) {
            event.preventDefault();


            if( $('input[name="views"]:checked').length > 0){
                val = 1;
            }else{val=0;}

            let year = $('#year').val();
            if (!year) {
                year = 2020;

            }
            let numberPosts = $('#numberPosts').val();
            if (!numberPosts) {

                numberPosts = 50;
            }
            console.log(year);
            var table = $('#api').DataTable({
                processing: true,
                serverSide: true,
                ajax: "api/data/" + val + "/" + year + "/" + numberPosts,
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'text', name: 'text'},
                    {data: 'author', name: 'author'},
                    {data: 'views', name: 'views'},
                    {data: 'date_posted', name: 'date_posted'},
                ]
            });
        });


        $("#DestroyTable").click(function (event) {
            var table = $('#api').DataTable();
            event.preventDefault();
            table.destroy();

        });
    </script>

@endsection
