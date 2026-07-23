<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo - Acervo Via Pública</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

    <nav class="bg-indigo-900 text-white p-4 shadow-md">
        <div class="w-full mx-auto flex justify-between items-center">
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

    <div class="flex flex-1">
        <aside class="w-64 bg-slate-900 text-slate-300 flex flex-col p-4 space-y-2 shadow-inner">
            <span class="text-xs font-semibold text-slate-500 uppercase px-3 mb-2">Gerenciamento</span>
            <a href="?route=admin/authors" class="flex items-center px-3 py-2 rounded-md hover:bg-slate-800 hover:text-white transition-colors">Autores</a>
            <a href="#" class="flex items-center px-3 py-2 rounded-md hover:bg-slate-800 hover:text-white transition-colors">Livros</a>
        </aside>

        <main class="flex-1 p-8">
            <?php if (isset($success)): ?>
                <div id="success-alert" class="flex mb-5 items-center justify-between rounded-lg border border-green-300 bg-green-100 px-4 py-3 text-green-800">
                    <span><?= $success ?></span>

                    <button
                        type="button"
                        class="ml-4 text-green-700 hover:text-green-900"
                        onclick="document.getElementById('success-alert').remove()"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            <?php elseif (isset($error)): ?>
                <div id="error-alert" class="flex mb-5 items-center justify-between rounded-lg border border-red-300 bg-red-100 px-4 py-3 text-red-800">
                    <span><?= $error ?></span>

                    <button
                        type="button"
                        class="ml-4 text-red-700 hover:text-red-900"
                        onclick="document.getElementById('error-alert').remove()"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            <?php endif; ?>

            <?php 
                $action = $_GET['action'] ?? 'list';
                if ($action === 'list'): 
            ?>
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-gray-800">Autores</h2>
                        <a href="?route=admin/authors&action=create" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium shadow transition-colors">
                            Cadastrar Autor
                        </a>
                    </div>
                    <div class="border-4 border-dashed border-gray-200 rounded-lg h-48 flex items-center justify-center text-gray-400">
                        Listagem de autores
                    </div>
                </div>
            <?php elseif ($action === 'create'): ?>
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Cadastrar Autor</h2>
                    
                    <form action="?route=admin/authors/create&action=create" method="POST" enctype="multipart/form-data" class="space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nome do Autor</label>
                            <input type="text" name="name" id="name" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="biography" class="block text-sm font-medium text-gray-700">Biografia</label>
                            <textarea name="biography" id="biography" rows="4" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                        </div>
                        <div>
                            <label for="photo" class="block text-sm font-medium text-gray-700">Foto do Autor (Opcional)</label>
                            <input type="file" name="photo" id="photo" accept="image/*" class="mt-1 block w-fit text-sm text-gray-500 ile:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        </div>
                        <div class="flex justify-end space-x-3 pt-4">
                            <a href="?route=admin/authors" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">Cancelar</a>
                            <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">Salvar</button>
                        </div>
                    </form>
                </div>
            <?php endif; ?>
        </main>
    </div>
    
</body>

</html>