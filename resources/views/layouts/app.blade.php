<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfume Vault - Laravel Edition</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --color-dark: #291C0E;
            --color-medium: #6E473B;
            --color-accent: #A78D78;
            --color-soft: #BEB5A9;
            --color-bg: #E1D4C2;
        }
        body { background-color: var(--color-bg); color: var(--color-dark); font-family: 'Segoe UI', sans-serif; padding: 20px; }
        .main-container { background-color: #FFFFFF; border-radius: 28px; box-shadow: 0 10px 30px rgba(41, 28, 14, 0.08); min-height: 90vh; display: flex; overflow: hidden; }
        .sidebar { width: 240px; background-color: #FAFAFA; border-right: 1px solid var(--color-soft); padding: 30px 20px; display: flex; flex-direction: column; }
        .sidebar-brand { font-size: 1.2rem; font-weight: 800; color: var(--color-dark); margin-bottom: 40px; }
        .sidebar-menu { list-style: none; padding: 0; margin: 0; flex-grow: 1; }
        .sidebar-menu a { display: flex; align-items: center; gap: 12px; padding: 12px 16px; color: var(--color-medium); text-decoration: none; font-weight: 600; border-radius: 12px; }
        .sidebar-menu a:hover, .sidebar-menu a.active { background-color: var(--color-bg); color: var(--color-dark); }
        .content-area { flex-grow: 1; padding: 35px 40px; background-color: #FFFFFF; overflow-y: auto; }
        .btn-custom-main { background-color: var(--color-dark); color: #FFFFFF; border-radius: 12px; padding: 10px 20px; font-weight: 600; border: none; text-decoration: none; }
        .btn-custom-main:hover { background-color: var(--color-medium); color: #FFFFFF; }
    </style>
</head>
<body>
<div class="main-container">
    <div class="sidebar">
        <div class="sidebar-brand">
            <i class="fa-solid fa-bottle-droplet" style="color: var(--color-medium);"></i> Pitch.Perfume
        </div>
        <ul class="sidebar-menu">
            <li><a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="fa-solid fa-chart-pie"></i> Dashboard</a></li>
            <li><a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.*') ? 'active' : '' }}"><i class="fa-solid fa-box"></i> Katalog Produk</a></li>
            <li><a href="{{ route('stock.index') }}" class="{{ request()->routeIs('stock.*') ? 'active' : '' }}"><i class="fa-solid fa-right-left"></i> Mutasi Stok</a></li>
        </ul>
    </div>
    <div class="content-area">
        @yield('content')
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>