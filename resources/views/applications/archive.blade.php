@extends('layouts.app')
@section('page_title', 'Archived Applications')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div class="d-flex align-items-center gap-2">
            <div class="d-inline-flex align-items-center justify-content-center bg-warning bg-opacity-10 rounded-circle" style="width: 32px; height: 32px;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-warning">
                    <polyline points="3 6 5 6 21 6"/>
                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                </svg>
            </div>
            <h3 class="mb-0">Archived Applications</h3>
        </div>
        <a href="{{ route('applications.index') }}" class="btn btn-outline-secondary d-flex align-items-center gap-2">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
            Back to Queue
        </a>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title mb-0">Archived Applications List</h3>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Application No.</th>
                            <th>Registrant</th>
                            <th>Type</th>
                            <th>Archived At</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($applications as $application)
                            <tr>
                                <td class="fw-semibold">{{ $application->application_number }}</td>
                                <td>{{ $application->registrant->last_name ?? '—' }},
                                    {{ $application->registrant->first_name ?? '—' }}</td>
                                <td class="text-capitalize">{{ $application->type }}</td>
                                <td>{{ optional($application->deleted_at)->format('M d, Y h:i A') ?? '—' }}</td>
                                <td>
                                    <form method="POST" action="{{ route('applications.restore', $application) }}"
                                        onsubmit="return confirm('Restore this application?')">
                                        @csrf
                                        <button class="btn btn-sm btn-outline-success d-flex align-items-center gap-2">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <polyline points="1 4 1 10 7 10"/>
                                                <path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"/>
                                            </svg>
                                            Restore
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">No archived applications found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">{{ $applications->links() }}</div>
    </div>

@endsection
