@extends('layout.app')

@section('content')

    <section class="log-detail-header">
        <div class="log-detail-header__meta">
            <span class="log-detail-header__timestamp">{{ $entry['timestamp'] }}</span>
            <span class="log-detail-header__dot"></span>
            <div class="log-detail-header__tags">
                @foreach ($entry['tags'] as $tag)
                    <span class="log-detail-header__tag">#{{ $tag }}</span>
                @endforeach
            </div>
        </div>

        <h1 class="log-detail-header__title">{{ $entry['title'] }}</h1>

        <div class="log-detail-header__actions">
            <a href="{{ route('logs.edit', $entry['id']) }}" class="log-detail-header__button log-detail-header__button--edit">
                Edit
            </a>

            <form method="POST" action="{{ route('logs.delete', $entry['id']) }}" class="log-detail-header__form">
                @csrf
                <button type="submit" class="log-detail-header__button log-detail-header__button--delete">
                    Delete
                </button>
            </form>
        </div>
    </section>

    <section class="log-detail-body">
        <x-log-section heading="Summary" :text="$entry['summary']" />
        <x-log-section heading="Description" :text="$entry['description']" />
    </section>

@endsection
