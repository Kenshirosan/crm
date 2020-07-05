@extends('master')

@section('title')
    Create users
@endsection

@section('content')
    @can('see_user')
        <users-list></users-list>
    @endcan

    @can('edit_user')
        <address-form></address-form>
    @endcan
@endsection
