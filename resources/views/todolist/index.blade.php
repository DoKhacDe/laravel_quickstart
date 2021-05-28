    @extends('layouts.master')
    @section('content')
    <div class="container-fluied">
        <div class="content">
            <div class="menu-left">           
            </div>
            <div class="content-right">
                <h4>Daily work </h4>
                <a href="/todolist/create">Add new</a><br>
                @if (Session::get('success'))
                <div class="alert alert-danger">
                    {{ Session::get('success') }}
                </div>
                @endif
                @if (Session::get('fail'))
                <div class="alert alert-success">
                    {{ Session::get('fail') }}
                </div>
                @endif
            <table class="table table-hover">
                <tr style="background: #99FFCC;">
                    <td>Title</td>
                    <td>Status</td>
                    <td>Edit</td>
                    <td>Delete</td>
                </tr>
               @foreach($req as $res)
                <tr>
                    <td>
                    @if($res->completed)
                        <span style="text-decoration: line-through; color:red">{{ $res->title }}</span>
                    @else
                    {{ $res->title }}
                    @endif
                    </td>
                    <td><a href="{{ asset('/' . $res->id). '/todolist/completed' }}">Completed</a></td>
                    <td><a href="{{ asset('/' . $res->id). '/todolist/edit' }}">Edit</a></td>
                    <td><a href="{{ asset('/' . $res->id). '/todolist/delete' }}">Delete</a></td>
                </tr>
               @endforeach
            </table>
            </div>
        </div>
    </div>
@endsection
