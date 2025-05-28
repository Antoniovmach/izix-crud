<!DOCTYPE html>
<html>
<head>
    <title>Crear Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header">
            <h3>Crear nuevo usuario</h3>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Errores:</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

    <form method="POST" action="{{ url('/api/user') }}"> 
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Rol (opcional):</label>
                    <input type="text" class="form-control" id="role" name="role">
                </div>

                <div class="mb-3">
                    <label for="loyalty_points" class="form-label">Puntos de fidelidad (opcional):</label>
                    <input type="number" class="form-control" id="loyalty_points" name="loyalty_points">
                </div>

                <button type="submit" class="btn btn-primary">Crear usuario</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
