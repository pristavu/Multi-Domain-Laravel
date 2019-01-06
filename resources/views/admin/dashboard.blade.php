@extends('layouts.admin')

@section('title', 'Application Dashboard')

@section('content')

    <div class="page-header">
        <div class="page-title">Application Dashboard</div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card p-3">
                <div class="table-responsive-sm">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Site</th>
                            <th scope="col">Domain</th>
                            <th scope="col">Date Created</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sites as $site)
                        <tr>
                            <th scope="row">{{ $site->id }}</th>
                            <td>{{ $site->company_name }}</td>
                            <td>{{ $site->domain }}</td>
                            <td>{{ $site->created_at }}</td>
                            <td nowrap="">
                                <button type="button" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button type="button" class="btn btn-outline-danger btn-sm">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>



            </div>
        </div>
    </div>

@endsection