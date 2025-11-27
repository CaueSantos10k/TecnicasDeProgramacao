<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ShowTickets - Venda de Ingressos</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #8b5cf6;
            --secondary-color: #ec4899;
            --dark-bg: #0f172a;
            --card-bg: #1e293b;
        }
        
        body {
            background: linear-gradient(135deg, var(--dark-bg) 0%, #1a1f35 100%);
            color: #e2e8f0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
        }

        .navbar {
            background: linear-gradient(90deg, var(--dark-bg) 0%, #1a1f35 100%);
            box-shadow: 0 4px 20px rgba(139, 92, 246, 0.15);
            border-bottom: 2px solid var(--primary-color);
        }

        .navbar-brand {
            font-size: 1.8rem;
            font-weight: 700;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .navbar-brand i {
            margin-right: 0.5rem;
        }

        .dropdown-menu {
            background: var(--card-bg);
            border: 1px solid rgba(139, 92, 246, 0.3);
        }

        .dropdown-item {
            color: #e2e8f0;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background: linear-gradient(90deg, rgba(139, 92, 246, 0.2), rgba(236, 72, 153, 0.2));
            color: var(--primary-color);
            padding-left: 1.5rem;
        }

        .container {
            margin-top: 2rem;
        }

        h1 {
            font-weight: 700;
            color: #fff;
            margin-bottom: 1.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .table {
            background: var(--card-bg);
            border: 1px solid rgba(139, 92, 246, 0.2);
            border-radius: 0.5rem;
            overflow: hidden;
        }

        .table thead {
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        }

        .table-dark {
            background: rgba(139, 92, 246, 0.1);
        }

        .table td, .table th {
            border-color: rgba(139, 92, 246, 0.2);
            vertical-align: middle;
        }

        .btn-primary {
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(139, 92, 246, 0.3);
        }

        .btn-warning {
            background: #f59e0b;
            border: none;
            color: #fff;
            transition: all 0.3s ease;
        }

        .btn-warning:hover {
            background: #d97706;
            transform: translateY(-2px);
        }

        .btn-danger {
            background: #ef4444;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            background: #dc2626;
            transform: translateY(-2px);
        }

        .form-control, .form-select {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(139, 92, 246, 0.3);
            color: #e2e8f0;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(139, 92, 246, 0.25);
            color: #e2e8f0;
        }

        .form-select option {
            background: #1e293b;
            color: #000;
        }

        .form-label {
            color: #cbd5e1;
            font-weight: 500;
        }

        .welcome-section {
            text-align: center;
            padding: 3rem 1rem;
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.1), rgba(236, 72, 153, 0.1));
            border-radius: 1rem;
            border: 1px solid rgba(139, 92, 246, 0.2);
            margin-bottom: 2rem;
        }

        .welcome-section h2 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .welcome-section p {
            font-size: 1.1rem;
            color: #cbd5e1;
        }

        .footer {
            text-align: center;
            padding: 2rem;
            margin-top: 3rem;
            border-top: 1px solid rgba(139, 92, 246, 0.2);
            color: #64748b;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <?php require_once 'config.php'; ?>
    <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <i class="bi bi-ticket-perforated"></i>ShowTickets
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">
                            <i class="bi bi-house-door"></i> Home
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-calendar-event"></i> Shows
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="?page=cadastrar-show"><i class="bi bi-plus-circle"></i> Cadastrar</a></li>
                            <li><a class="dropdown-item" href="?page=listar-show"><i class="bi bi-list-ul"></i> Listar</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-tag"></i> Tipos de Ingresso
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="?page=cadastrar-tipo"><i class="bi bi-plus-circle"></i> Cadastrar</a></li>
                            <li><a class="dropdown-item" href="?page=listar-tipo"><i class="bi bi-list-ul"></i> Listar</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-ticket"></i> Ingressos
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="?page=cadastrar-ingresso"><i class="bi bi-plus-circle"></i> Cadastrar</a></li>
                            <li><a class="dropdown-item" href="?page=listar-ingresso"><i class="bi bi-list-ul"></i> Listar</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person"></i> Clientes
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="?page=cadastrar-cliente"><i class="bi bi-plus-circle"></i> Cadastrar</a></li>
                            <li><a class="dropdown-item" href="?page=listar-cliente"><i class="bi bi-list-ul"></i> Listar</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-cash-coin"></i> Vendas
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="?page=cadastrar-venda"><i class="bi bi-plus-circle"></i> Cadastrar</a></li>
                            <li><a class="dropdown-item" href="?page=listar-venda"><i class="bi bi-list-ul"></i> Listar</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-3">
        <div class="row">
            <div class="col">
                <?php
                    $page = $_REQUEST['page'] ?? '';
                    switch ($page) {
                        case 'cadastrar-show':
                            include('editar-show.php');
                            break;
                        case 'listar-show':
                            include('listar-show.php');
                            break;
                        case 'editar-show':
                            include('editar-show.php');
                            break;

                        case 'cadastrar-tipo':
                            include('editar-tipo.php');
                            break;
                        case 'listar-tipo':
                            include('listar-tipo.php');
                            break;
                        case 'editar-tipo':
                            include('editar-tipo.php');
                            break;

                        case 'cadastrar-ingresso':
                            include('editar-ingresso.php');
                            break;
                        case 'listar-ingresso':
                            include('listar-ingresso.php');
                            break;
                        case 'editar-ingresso':
                            include('editar-ingresso.php');
                            break;

                        case 'cadastrar-cliente':
                            include('editar-cliente.php');
                            break;
                        case 'listar-cliente':
                            include('listar-cliente.php');
                            break;
                        case 'editar-cliente':
                            include('editar-cliente.php');
                            break;

                        case 'cadastrar-venda':
                            include('editar-venda.php');
                            break;
                        case 'listar-venda':
                            include('listar-venda.php');
                            break;
                        case 'editar-venda':
                            include('editar-venda.php');
                            break;

                        default:
                            echo '<h1>Bem-vindo ao ShowTickets</h1>';
                            echo '<p>Sistema de venda de ingressos para shows.</p>';
                    }
                ?>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>&copy; 2025 ShowTickets - Sistema de Venda de Ingressos | Desenvolvido por <i> Cauê Silva</i></p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
