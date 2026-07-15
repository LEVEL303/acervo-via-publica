<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo - Acervo Via Pública</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

    <nav class="bg-indigo-900 text-white p-4 shadow-md">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">Acervo Via Pública — Admin</h1>
            
            <div class="flex items-center space-x-4">
                <div>
                    <?= htmlspecialchars($_SESSION['admin_name'] ?? '') ?>
                </div>

                <a href="?route=logout" 
                   onclick="return confirm('Deseja realmente sair do painel administrativo?');" 
                   class="bg-red-600 hover:bg-red-700 px-3 py-2 rounded text-sm font-medium transition-colors">
                    Sair do Painel
                </a>
            </div>
        </div>
    </nav>
    
</body>

</html>