<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Aluno</title>
    <link href="{{ asset('css/alunos.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Cabeçalho -->
    <header>
        <h1>Perfil do Aluno</h1>
        <nav>
            <ul>
                @include('components.navbar')
            </ul>
        </nav>
    </header>

    <!-- Conteúdo -->
    <div class="container">
        <h2>Informações do Aluno</h2>
        <form action="{{ route('alunos.update', $aluno->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="{{ $aluno->nome }}" readonly>
            </div>
            <div class="form-group">
                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" value="{{ $aluno->cpf }}" readonly>
            </div>
            <div class="form-group">
                <label for="rg">RG:</label>
                <input type="text" id="rg" name="rg" value="{{ $aluno->rg }}" readonly>
            </div>
            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="text" id="telefone" name="telefone" value="{{ $aluno->telefone }}" readonly>
            </div>
            <div class="form-group">
                <label for="sexo">Sexo:</label>
                <input type="text" id="sexo" name="sexo" value="{{ $aluno->sexo }}" readonly>
            </div>
            <div class="form-group">
                <label for="data_nascimento">Data de Nascimento:</label>
                <input type="date" id="data_nascimento" name="data_nascimento" value="{{ $aluno->data_nascimento }}" readonly>
            </div>
            <div class="form-group">
                <label for="endereco">Endereço:</label>
                <input type="text" id="endereco" name="endereco" value="{{ $aluno->endereco }}" readonly>
            </div>
            <!-- Mostrar o status do aluno -->
            <div class="form-group">
                <label for="status">Status:</label>
                <input type="text" id="status" name="status" value="{{ $aluno->status->descricao }}" readonly>
            </div>
            <!-- Botão de Ação -->
            <div class="actions">
                <button type="button" onclick="habilitarEdicao()">Editar</button>
                <button type="submit" id="btnSalvar" style="display: none;">Salvar</button>
            </div>
        </form>
        <form action="{{ route('alunos.destroy', $aluno->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Excluir</button>
        </form>
    </div>

    <!-- Script para habilitar edição dos campos -->
    <script>
        function habilitarEdicao() {
            var campos = document.querySelectorAll('input[type="text"]');
            campos.forEach(function (campo) {
                campo.removeAttribute('readonly');
            });
            document.getElementById('btnSalvar').style.display = 'block';
        }
    </script>
</body>
</html>
