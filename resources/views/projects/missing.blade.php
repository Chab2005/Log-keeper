@extends('layout.app')

@section('content')

    <x-not-found
        title="Project not found"
        message="This project doesn't exist, or it may have been deleted."
        :link-url="url('/')"
        link-label="Back to all projects"
    />

@endsection
