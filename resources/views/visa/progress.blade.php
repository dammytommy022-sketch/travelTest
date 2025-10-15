@include('admin.layouts.nav')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 col-md-12 order-1">
                <div class="card">
                    <div class="card-body">
                        <h5>Visa & VOA Applications Progress</h5>
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Token</th>
                                        <th>Email</th>
                                        <th>Destination/Type</th>
                                        <th>Application Type</th>
                                        <th>Status</th>
                                        <th>Visa Document</th>
                                        <th>Action</th>
                                        <th>Last Updated</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($applications as $app)
                                        <tr>
                                            <td>{{ $app->token }}</td>
                                            <td>{{ $app->email }}</td>
                                            <td>{{ $app->visa_to }}</td>
                                            <td>
                                                <span class="badge {{ $app->type === 'Visa' ? 'bg-primary' : 'bg-secondary' }}">
                                                    {{ $app->type }}
                                                </span>
                                            </td>
                                            <td>{{ $app->status }}</td>
                                            
                                            <td>
                                                @if ($app->visa_document_path)
                                                    <a href="{{ $app->visa_document_path }}" target="_blank" class="btn btn-sm btn-info">View</a>
                                                @else
                                                    <span>No document uploaded</span>
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.update-visa-progress', $app->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="type" value="{{ $app->type }}">
                                                    <div class="input-group">
                                                        <select name="status" class="form-select form-select-sm" required>
                                                            <option value="Pending" {{ $app->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                                            <option value="In Progress" {{ $app->status === 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                                            <option value="Approved" {{ $app->status === 'Approved' ? 'selected' : '' }}>Approved</option>
                                                            <option value="Issued" {{ $app->status === 'Issued' ? 'selected' : '' }}>Issued</option>
                                                            <option value="Rejected" {{ $app->status === 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                                        </select>
                                                        <input type="file" name="visa_document" class="form-control form-control-sm" accept=".pdf" />
                                                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                                    </div>
                                                    @error('status')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                    @error('visa_document')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </form>
                                            </td>
                                            <td>{{ $app->status_updated_at ? $app->status_updated_at->format('Y-m-d H:i') : 'N/A' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.layouts.footer')