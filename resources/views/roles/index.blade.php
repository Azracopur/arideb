<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roller</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2>Kullanıcı Rolleri</h2>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @foreach($users as $user)
        <h4>{{ $user->name }} {{ $user->surname ?? '' }} ({{ $user->email }})</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Rol Adı</th>
                    <th>Açıklama</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->description }}</td>
                        <td>
                            <!-- Kullanıcıya Rol Atama Formu -->
                            <form action="{{ route('roles.assign', ['userId' => $user->id]) }}" method="POST" style="display: inline;">
                                @csrf
                                <input type="hidden" name="role_id" value="{{ $role->id }}">
                                <button type="submit" class="btn btn-success btn-sm">Rol Ata</button>
                            </form>

                            <!-- Kullanıcıdan Rol Çıkarma Formu -->
                            <form action="{{ route('roles.remove', ['userId' => $user->id, 'roleId' => $role->id]) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Rol Kaldır</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <hr>
    @endforeach

    <a href="{{ route('home') }}" class="btn btn-primary">Ana Sayfaya Dön</a>
</div>

<script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>
