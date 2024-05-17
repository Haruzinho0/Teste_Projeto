<form action="{{ route('alunos.store') }}" method="POST">
    @csrf
    <header>
        <h1>Cadastro de Aluno</h1>
        <nav>
            <ul>
                @include('components.navbar')
            </ul>
        </nav>
    </header>
    <div>
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="{{ old('nome') }}" required>
        @error('nome')
            <span>{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" maxlength="14" placeholder="123.456.789-00" onkeypress="formatCPF(this)" required>
        @error('cpf')
            <span>{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="rg">RG:</label>
        <input type="text" id="rg" name="rg">
        @error('rg')
            <span>{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone">
        @error('telefone')
            <span>{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="sexo">Sexo:</label>
        <select id="sexo" name="sexo" required>
            <option value="M">Masculino</option>
            <option value="F">Feminino</option>
            <option value="Outro">Outro</option>
        </select>
        @error('sexo')
            <span>{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="date" id="data_nascimento" name="data_nascimento" required>
        @error('data_nascimento')
            <span>{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco">
        @error('endereco')
            <span>{{ $message }}</span>
        @enderror
    </div>
    <div>
        <button type="submit">Salvar</button>
    </div>
</form>

<script>
    function formatCPF(cpfInput) {
        let cpf = cpfInput.value.replace(/\D/g, '');
        cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
        cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
        cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
        cpfInput.value = cpf;
    }
</script>
