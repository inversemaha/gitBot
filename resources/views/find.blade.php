@extends('layouts.master')
@section('content')

    <div class="container">

        <div class="row section-title justify-content-center text-center">
            <div class="col-md-9 col-lg-8 col-xl-7">
                <h3 class="display-4">Git Bot</h3>
            </div>
        </div>
        <div class="col-md-10 col-lg-9 col-xl-8">
            <form class="form-inline" action="/search/" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-2">
                    <label for="username">User Name</label>
                    <input type="text" class="form-control-plaintext" name="name" placeholder="UserName">
                </div>
                <button type="submit" class="form-control" class="btn btn-primary mb-2">Extrac</button>
            </form>
        </div>
        <div class="row">
            @php($i=1)
            @foreach($userDetails as $res)
            <div class="card" style="width: 18rem;">
                <img src="#" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{$res->name}}</h5>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card-header">
                    Repository List
                </div>
                <div class="card-body">
                        <table class="table" >
                            @foreach ($res as $name)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$name->repo_name}}</td>
                            </tr>
                            @endforeach
                        </table>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
@endsection
