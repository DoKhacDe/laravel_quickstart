@extends('layouts.master')
    @section('content')
    <div class="contaner">
        <div class="row">
            <div class="edit">
                <h3>Edit</h3>
                <form action="/todolist/update" method="post"> 
                    @csrf
                        <input type="text" name="title" value="{{ $todo->title }}">
                        <input type="number" name="id" style="display: none;" value="{{ $todo->id }}">
                        <input type="submit" value="Add"><br>
                        <span class="text-danger">@error('title'){{ $message }} @enderror</span> 
                    </form>
                    <br>
                    <a href="/todolist/index">Back</a>
            </div>
        </div>
    </div>
@endsection