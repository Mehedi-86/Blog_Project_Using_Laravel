<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')
    <title>Reports Against {{ $user->name }}</title>

    <!-- SweetAlert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
        .title-wrapper {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 30px;
        }

        .title_deg {
            font-size: 32px;
            font-weight: 700;
            color: #fff;
            background: linear-gradient(to right, #6A0DAD, #8E24AA);
            padding: 10px 20px;
            border-radius: 10px;
            text-align: center;
            margin: 0;
            width: 100%;
        }

        .back-button {
            position: absolute;
            left: 10px;
            padding: 8px 14px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 6px;
            color: #fff;
            text-decoration: none;
        }

        .back-button:hover {
            color: #fff;
        }

        .back-button i {
            margin-right: 6px;
        }

        .table_deg {
            width: 90%;
            margin: 0 auto;
            border-collapse: separate;
            border-spacing: 0;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .table_deg th, .table_deg td {
            text-align: center;
            padding: 12px 15px;
            vertical-align: middle;
        }

        .table_deg thead {
            background-color: #6A0DAD;
            color: #fff;
        }

        .table_deg tbody tr:nth-child(odd) {
            background-color: #141414;
        }

        .table_deg tbody tr:nth-child(even) {
            background-color: #0f1b2a;
        }

        .table_deg tbody tr:hover {
            color: #fff;
        }

        .btn {
            padding: 6px 14px;
            font-size: 14px;
            font-weight: 700;
            border-radius: 8px;
            cursor: pointer;
            border: 1px solid transparent;
            transition: all 0.3s ease, transform 0.2s ease;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .btn:hover {
            transform: translateY(-2px) scale(1.02);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .btn-visit {
            background-color: #28a745;
            color: #fff;
            border-color: #28a745;
        }

        .btn-visit:hover {
            background-color: #218838;
            border-color: #1e7e34;
            color: #fff !important; 
        }

        .badge-reason {
            background-color: #dc3545;
            font-size: 16px;
            padding: 5px 8px;
            border-radius: 8px;
            color: white;
            font-weight: 600;
        }

        .badge-reason:hover {
            transform: scale(1.05);
            background-color: #bd2130;
        }

        .clear-btn {
            background: linear-gradient(to right, #6e0dd0, #b83280);
            color: #fff;
            border: none;
            padding: 12px 26px;
            font-size: 16px;
            font-weight: 700; /* Bold text */
            border-radius: 12px;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(110, 13, 208, 0.3);
            transition: background 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
        }

        .clear-btn:hover {
            background: linear-gradient(to right, #5a0bb5, #a3266d);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(110, 13, 208, 0.5);
        }

    </style>
</head>

<body>
    @include('admin.header')

    <div class="d-flex align-items-stretch">
        @include('admin.sidebar')

        <div class="page-content">
            <div class="title-wrapper">
                <a href="{{ route('admin.manage.users') }}" class="back-button">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
                <h1 class="title_deg">Reports Against {{ $user->name }}</h1>
            </div>
           
            <table class="table_deg table table-bordered">
                <thead>
                    <tr>
                        <th>Reported By</th>
                        <th>Post</th>
                        <th>Reason</th>
                        <th>Reported At</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reports as $report)
                        <tr>
                            <td>{{ $report->reportedBy->name ?? 'N/A' }}</td>
                            <td>
                                @if($report->post)
                                    <a href="{{ route('admin.post.details', $report->post->id) }}" class="btn btn-visit">Visit Post</a>
                                @else
                                    <span class="text-muted fst-italic">Deleted</span>
                                @endif
                            </td>
                            <td><span class="badge-reason">{{ $report->report_type }}</span></td>
                            <td>{{ $report->created_at->format('d M Y, h:i A') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-muted text-center py-4">No reports found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            @if($reports->count() > 0)
                <div class="text-center mt-5">
                    <form action="{{ route('admin.clear.reports', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to clear all reports for this user?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="clear-btn">
                            <i class="fas fa-trash-alt me-2"></i> Clear All Reports
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>

    @include('admin.footer')
</body>
</html>
