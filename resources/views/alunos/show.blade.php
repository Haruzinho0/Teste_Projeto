<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-yellow-500 dark:text-yellow-500 leading-tight">
            {{ __('Perfil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.6.0/cleave.min.js"></script>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-[#2d2d2d] overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-yellow-500 dark:text-yellow-500">
                        <h2>Informações do Aluno</h2>

                        <!-- Exibir mensagens de sucesso e aviso -->
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('warning'))
                            <div class="alert alert-warning">
                                {{ session('warning') }}
                            </div>
                        @endif

                        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
                        <form id="formEditarAluno" action="{{ route('alunos.update', $aluno->id) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <!-- Campos do formulário -->
                            <div class="form-group flex flex-wrap">
                                <div class="w-full sm:w-1/2">
                                    <label for="nome">Nome*</label>
                                    <input type="text" id="nome" name="nome" value="{{ old('nome', $aluno->nome) }}"
                                        class="text-black" readonly disabled>
                                    @error('nome')
                                        <br>
                                        <span class="error-message">{{ $message }}</span>
                                        </br>
                                    @enderror
                                </div>
                                <div class="w-full sm:w-1/2">
                                    <label for="cpf">CPF*</label>
                                    <input type="text" id="cpf" name="cpf" value="{{ old('cpf', $aluno->cpf) }}"
                                        class="text-black" maxlength="14" readonly disabled>
                                    @error('cpf')
                                        <br>
                                        <span class="error-message">{{ $message }}</span>
                                        </br>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group flex flex-wrap">
                                <div class="w-full sm:w-1/2">
                                    <label for="rg">RG</label>
                                    <input type="text" id="rg" name="rg" value="{{ old('rg', $aluno->rg) }}"
                                        class="text-black" pattern="[0-9]*" inputmode="numeric" readonly disabled>
                                    @error('rg')
                                        <br>
                                        <span class="error-message">{{ $message }}</span>
                                        </br>
                                    @enderror
                                </div>
                                <div class="w-full sm:w-1/2">
                                    <label for="telefone">Telefone</label>
                                    <input type="text" id="telefone" name="telefone"
                                        value="{{ old('telefone', $aluno->telefone) }}" class="text-black"
                                        pattern="[0-9]*" inputmode="numeric" readonly disabled>
                                    @error('telefone')
                                        <br>
                                        <span class="error-message">{{ $message }}</span>
                                        </br>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group flex flex-wrap">
                                <div class="w-full sm:w-1/2">
                                    <label for="sexo">Sexo</label>
                                    <input type="text" id="sexo" name="sexo" value="{{ old('sexo', $aluno->sexo) }}"
                                        class="text-black" readonly disabled>
                                    @error('sexo')
                                        <br>
                                        <span class="error-message">{{ $message }}</span>
                                        </br>
                                    @enderror
                                </div>
                                <div class="w-full sm:w-1/2">
                                    <label for="data_nascimento">Data de Nascimento*</label>
                                    <input type="date" id="data_nascimento" name="data_nascimento"
                                        value="{{ old('data_nascimento', $aluno->data_nascimento) }}" class="text-black"
                                        readonly disabled>
                                    @error('data_nascimento')
                                        <br>
                                        <span class="error-message">{{ $message }}</span>
                                        </br>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group flex flex-wrap">
                                <div class="w-full">
                                    <label for="endereco">Endereço</label>
                                    <input type="text" id="endereco" name="endereco"
                                        value="{{ old('endereco', $aluno->endereco) }}" class="text-black" readonly
                                        disabled>
                                    @error('endereco')
                                        <br>
                                        <span class="error-message">{{ $message }}</span>
                                        </br>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group flex flex-wrap">
                                <div class="w-full">
                                    <label for="status">Status</label>
                                    <select id="status" name="status" class="text-black" disabled>
                                        <option value="Ativo" {{ old('status', $aluno->status) === 'Ativo' ? 'selected' : '' }}>Ativo</option>
                                        <option value="Inativo" {{ old('status', $aluno->status) === 'Inativo' ? 'selected' : '' }}>Inativo</option>
                                        <option value="Pendente" {{ old('status', $aluno->status) === 'Pendente' ? 'selected' : '' }}>Pendente</option>
                                        <option value="Removido" {{ old('status', $aluno->status) === 'Removido' ? 'selected' : '' }}>Removido</option>
                                    </select>
                                    @error('status')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Botões de ação -->
                            <div class="form-group flex flex-wrap">
                                <button type="button" onclick="habilitarEdicao()"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-md mr-2 mb-2 hover:bg-blue-700">Editar</button>
                                <button type="submit" id="btnSalvar" style="display: none;"
                                    class="px-4 py-2 bg-green-600 text-white rounded-md mr-2 mb-2 hover:bg-green-700">Salvar</button>
                                <button type="button" id="btnCancelar" style="display: none;" onclick="cancelarEdicao()"
                                    class="px-4 py-2 bg-red-600 text-white rounded-md mr-2 mb-2 hover:bg-red-700">Cancelar</button>
                            </div>

                        </form>


                        <!-- Formulário para remover aluno -->
                        @if($aluno->status !== 'Removido')
                            <form id="formRemoverAluno" action="{{ route('alunos.remove', $aluno->id) }}" method="POST"
                                class="mt-10">
                                @csrf
                                @method('DELETE')
                                <button type="submit" id="btnRemover"
                                    class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Remover</button>
                            </form>

                        @endif




                        <!-- Script para formatação de campos e validações -->

                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                // Aplica Cleave.js ao campo de CPF para formatar automaticamente
                                new Cleave('#cpf', {
                                    delimiters: ['.', '.', '-'],
                                    blocks: [3, 3, 3, 2],
                                    numericOnly: true
                                });

                                // Adiciona evento keypress para o campo de RG (apenas números)
                                document.getElementById('rg').addEventListener('keypress', function (event) {
                                    if (event.charCode < 48 || event.charCode > 57) {
                                        event.preventDefault();
                                    }
                                });

                                // Adiciona evento keypress para o campo de telefone (apenas números e caracteres especiais permitidos)
                                document.getElementById('telefone').addEventListener('keypress', function (event) {
                                    if ((event.charCode < 48 || event.charCode > 57) && event.charCode !== 32 && event.charCode !== 40 && event.charCode !== 41 && event.charCode !== 45 && event.charCode !== 43) {
                                        event.preventDefault();
                                    }
                                });

                                // Verifica a data de nascimento
                                document.getElementById('data_nascimento').addEventListener('change', function () {
                                    var dataNascimento = new Date(this.value);
                                    var dataAtual = new Date();
                                    if (dataNascimento > dataAtual) {
                                        alert('A data de nascimento não pode ser no futuro.');
                                        this.value = ''; // Limpa o campo
                                    }
                                });

                                // Desabilita o botão de remover se o status for 'Removido'
                                var status = document.getElementById('status').value;
                                if (status === 'Removido') {
                                    document.getElementById('btnRemover').disabled = true;
                                }
                                // Reativar edição e campos em caso de erro
                                verificarErrosEhabilitarEdicao();

                            });

                            function verificarErrosEhabilitarEdicao() {
                                var errorMessages = document.querySelectorAll('.error-message');
                                if (errorMessages.length > 0) {
                                    habilitarEdicao();
                                }
                            }




                            // Objeto para armazenar os valores originais dos campos
                            var valoresOriginais = {};

                            function habilitarEdicao() {
                                var campos = document.querySelectorAll('input[type="text"], input[type="date"], select');
                                campos.forEach(function (campo) {
                                    // Armazena o valor original do campo
                                    valoresOriginais[campo.id] = campo.value;
                                    campo.removeAttribute('readonly');
                                    campo.removeAttribute('disabled');
                                });
                                document.getElementById('btnSalvar').style.display = 'block';
                                document.getElementById('btnCancelar').style.display = 'inline-block';
                            }

                            function cancelarEdicao() {
                                var campos = document.querySelectorAll('input[type="text"], input[type="date"], select');
                                campos.forEach(function (campo) {
                                    // Restaura o valor original do campo
                                    campo.value = valoresOriginais[campo.id] || '';
                                    campo.setAttribute('readonly', true);
                                    campo.setAttribute('disabled', true);
                                });
                                document.getElementById('btnSalvar').style.display = 'none';
                                document.getElementById('btnCancelar').style.display = 'none';
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
