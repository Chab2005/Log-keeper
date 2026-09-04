@extends('layout.app')

@section('content')

    <x-not-found
        title="Entry not found"
        message="This log entry doesn't exist, or it may have been deleted."
        :link-url="url('/')"
        link-label="Back to all projects"
    />

@endsection
