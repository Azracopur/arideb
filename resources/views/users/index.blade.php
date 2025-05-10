<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcılar</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2>Kullanıcılar</h2>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Users Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Adı</th>
                <th>Email</th>
                <th>Telefon</th>
                <th>Doğum Tarihi</th>
                <th>Roller</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }} {{ $user->surname }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->birthday ? \Carbon\Carbon::parse($user->birthday)->format('d/m/Y') : 'N/A' }}</td>
                    <td>
                        <!-- Kullanıcının Rollerini Göster -->
                        @foreach($user->roles as $role)
                            <span class="badge badge-primary">{{ $role->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        <!-- Kullanıcıya Rol Ata ve Kaldır -->
                        <a href="{{ route('roles.index', ['userId' => $user->id]) }}" class="btn btn-info btn-sm">Rolleri Yönet</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('home') }}" class="btn btn-primary">Ana Sayfaya Dön</a>
</div>

<script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>
