@extends('layouts.site')

@section('title', 'Welcome!')

@section('content')


<div class="jumbotron jumbotron-fluid mt-5">
    <div class="container">
        <h1 class="display-4">Welcome to {{ site()->company_name }}</h1>
        <p class="lead">The site content goes here.</p>
        <hr class="my-4">
        <p>This is a demo project built on Laravel Framework.</p>        
    </div>
</div>
@endsection