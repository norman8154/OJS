@extends('admin.layout.master')

@section('title')
    <title>Add student ID</title>
    @show

    @section('content')

    <div class="container">
        <div class="form-upload">
            <form action = "/admin/addid" method="POST" enctype="multipart/form-data">
	        <input type = "hidden" name = "_token" value="{{csrf_token()}}"/>
                <textarea type="name" name="IDs" rows="10" cols="30" class="form-control" placeholder="Input student IDs."></textarea>
                <input type = "file" name = "uploadfile"></br>
                <button class="btn btn-lg btn-primary btn-block "  type="submit">submit</button>
            </form>
        </div> <!-- /container -->
    <div/> <!-- /container -->


@endsection



