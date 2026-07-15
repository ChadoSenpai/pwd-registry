@extends('layouts.app')
@section('page_title', 'Applications')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="row g-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Application Queue</h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Application No.</th>
                                    <th>Registrant</th>
                                    <th>Type</th>
                                    <th>Submitted</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($applications as $application)
                                    <tr>
                                        <td>{{ $application->application_number }}</td>
                                        <td>{{ $application->registrant->last_name }},
                                            {{ $application->registrant->first_name }}</td>
                                        <td class="text-capitalize">{{ $application->type }}</td>
                                        <td>{{ optional($application->submitted_at)->format('M d, Y') ?? '—' }}</td>
                                        <td><span
                                                class="badge text-bg-{{ $application->status === 'approved' ? 'success' : ($application->status === 'pending' ? 'warning' : 'secondary') }} text-capitalize">{{ str_replace('_', ' ', $application->status) }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a class="btn btn-sm btn-outline-primary"
                                                    href="{{ route('applications.show', $application) }}">Review</a>
                                                <form method="POST"
                                                    action="{{ route('applications.destroy', $application) }}"
                                                    onsubmit="return confirm('Archive this application?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-outline-danger">Archive</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">No applications found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">{{ $applications->links() }}</div>
            </div>
        </div>
    </div>
@endsection
