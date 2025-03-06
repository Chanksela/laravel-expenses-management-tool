@extends('layouts.app')
@section('title', 'Edit Transactions')
@section('content')

    <h1>Edit User</h1>

    @if (session('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('user.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="first_name">First Name</label>
            <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $user->first_name) }}">
        </div>

        <div>
            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}">
        </div>

        <button type="submit">Update</button>
    </form>
@endsection
