<!DOCTYPE html>
<html>
<head>
    @include('admin.css')

    <!-- SweetAlert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
        .title_deg {
            font-size: 32px;
            font-weight: 700;
            color: #fff;
            background: linear-gradient(to right, #6A0DAD, #8E24AA);
            padding: 10px;
            text-align: center;
            border-radius: 10px;
            margin-bottom: 30px;
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
            cursor: pointer;
        }

        .img_deg {
            height: 100px; /* slightly larger */
            width: 100px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #ddd;
            display: block;
            margin: 0 auto; /* center horizontally */
        }

        .img_deg:hover {
            transform: scale(1.1) rotate(2deg);
            border-color: #32CD32;  /* Change border color on hover */
            box-shadow: 0 0 10px rgba(106, 13, 173, 0.5); /* Optional glow */
            filter: brightness(1.1);
        }

        .btn {
            padding: 6px 14px;
            font-size: 14px;
            font-weight: 700 !important;
            border-radius: 8px;
            cursor: pointer;
            border: 1px solid transparent;
            transition: all 0.3s ease, transform 0.2s ease;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        /* Button hover effects (applies to all buttons) */
        .btn:hover {
            transform: translateY(-2px) scale(1.02);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        /* Success button */
        .btn-success {
            background-color: #28a745;
            color: #fff;
            border-color: #28a745;
        }
        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        /* Danger button */
        .btn-danger {
            background-color: #dc3545;
            color: #fff;
            border-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

    </style>
</head>

<body>
    @include('admin.header')

    <div class="d-flex align-items-stretch">
        @include('admin.sidebar')

        <div class="page-content">
            <h1 class="title_deg">Manage Users</h1>

            @if(session()->has('message'))
                <div class="alert alert-{{ session()->get('type', 'info') }}">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{ session()->get('message') }}
                </div>
            @endif

            <table class="table_deg table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Profile Picture</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if ($user->profile_picture)
                                <img src="{{ asset('storage/' . $user->profile_picture) }}" class="img_deg">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>
                        <td>
                            @if ($user->is_banned)
                                <form action="{{ route('admin.unban.user', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to unban this user?');">
                                    @csrf
                                    <button type="submit" class="btn btn-success ">Unban</button>
                                </form>
                            @else
                                <form action="{{ route('admin.ban.user', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to ban this user?');">
                                    @csrf
                                    <button type="submit" class="btn btn-danger ">Ban</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('admin.footer')
</body>
</html>
