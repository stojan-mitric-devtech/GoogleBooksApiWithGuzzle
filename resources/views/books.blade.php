<html>
<head>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script type="text/javascript">

        $(document).ready(function() {

            $("#isbn").on('change', function(){
                if($("#isbn").val().length > 0 ){
                    $("#bookName").prop("disabled", true);
                }
                else {
                    $("#bookName").prop("disabled", false);
                }
            });

            $("#bookName").on('change', function(){
                if($("#bookName").val().length > 0){
                    $("#isbn").prop("disabled", true);
                }
                else {
                    $("#isbn").prop("disabled", false);
                }
            });
        });


    </script>

</head>
<body>
@extends('layouts.master')

@section('title')
    Books
@endsection

@section('content')
    <div class="row">
        <div class="col-6">

            <form action="books" method="post">
                <div class="form-group">

                    <label for="isbn">ISBN of book</label>
                    <input class="form-control" type="text" name="isbn" id="isbn">

                    <label for="bookName">Name of book</label>
                    <input class="form-control" type="text" name="bookName" id="bookName">

                    <input type="hidden" value="{{Session::token()}}" name="_token">

                    </br>

                    <input class=" btn btn-primary btn-md" type="submit" value="Find book">
                </div>
            </form>

        </div>
    </div>
@endsection


</body>
</html>