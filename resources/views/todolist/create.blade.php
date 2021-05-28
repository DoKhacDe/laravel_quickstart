@extends('layouts.master')
    @section('content')
    <div class="contaner">
        <div class="row">
            <div class="addnew">
                <h3>Addnew</h3>
                <form action="/todolist/upload" method="post"> 
                    @csrf
                        <input type="text" name="title" ><input type="submit" value="Add"><br>
                        <span class="text-danger">@error('title'){{ $message }} @enderror</span> 
                    </form>
                    <br>
                    <a href="/todolist/index">Back</a>
            </div>
        </div>
    </div>
    @endsection