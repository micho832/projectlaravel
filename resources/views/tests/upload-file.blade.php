@extends('common.master')

@section('title')
    Upload File
@endsection


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                @include('common.errors')
                <div class="card shadow">
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="custom-file">
                                <input name="file" type="file" class="custom-file-input">

                                <label for="" class="custom-file-label">Choose File</label>
                            </div>
                            <div class="text-center mt-2">
                                <button class="btn btn-success" type="submit">
                                    Upload
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
