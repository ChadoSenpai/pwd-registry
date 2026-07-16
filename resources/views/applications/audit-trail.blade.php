@extends('layouts.app')

@section('page_title', 'Audit Trail')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div class="d-flex align-items-center gap-2">
            <div class="d-inline-flex align-items-center justify-content-center bg-info bg-opacity-10 rounded-circle" style="width: 32px; height: 32px;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-info">
                    <path d="M12 20h9"/>
                    <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/>
                </svg>
            </div>
            <h3 class="mb-0">Audit Trail</h3>
        </div>
        <a href="{{ route('applications.archive') }}" class="btn btn-outline-secondary d-flex align-items-center gap-2">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
            Back to Archive
        </a>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title mb-0">Audit Trail Log</h3>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>Description</th>
                            <th>Registrant</th>
                            <th>Time</th>
                            <th>User</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($auditTrail as $entry)
                            <tr>
                                <td class="fw-semibold">{{ $entry->action }}</td>
                                <td>{{ $entry->label ?? '-' }}</td>
                                <td>{{ $entry->registrant_name ?? ($entry->application?->registrant?->full_name ?? '-') }}</td>
                                <td>{{ $entry->created_at->format('M d, Y h:i A') }}</td>
                                <td>{{ $entry->user?->name ?? 'System' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">No audit activity recorded yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {{ $auditTrail->links() }}
        </div>
    </div>
@endsection
