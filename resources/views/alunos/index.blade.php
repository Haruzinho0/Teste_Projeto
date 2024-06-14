<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-yellow-500 dark:text-yellow-500 leading-tight">
            {{ __('Lista de Alunos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#2d2d2d] overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-yellow-500 dark:text-yellow-500">
                    <div class="pesquisar">
                        <form action="{{ route('alunos.index') }}" method="GET" class="search-form">
                            <div class="status-filters">
                                <input type="checkbox" id="ativo" name="status[]" value="Ativo" {{ in_array('Ativo', Request::input('status', [])) ? 'checked' : '' }} class="status-checkbox">
                                <label for="ativo" class="status-label">Ativo</label>
                                <input type="checkbox" id="inativo" name="status[]" value="Inativo" {{ in_array('Inativo', Request::input('status', [])) ? 'checked' : '' }}
                                    class="status-checkbox">
                                <label for="inativo" class="status-label">Inativo</label>
                                <input type="checkbox" id="pendente" name="status[]" value="Pendente" {{ in_array('Pendente', Request::input('status', [])) ? 'checked' : '' }}
                                    class="status-checkbox">
                                <label for="pendente" class="status-label">Pendente</label>
                                <input type="checkbox" id="removido" name="status[]" value="Removido" {{ in_array('Removido', Request::input('status', [])) ? 'checked' : '' }}
                                    class="status-checkbox">
                                <label for="removido" class="status-label">Removido</label>
                            </div>
                            <div class="pesquisar">
    <input type="text" id="termoPesquisa" name="termo" placeholder="Pesquisar por nome" value="{{ Request::input('termo') }}" class="search-box text-black">
    <input type="text" id="cpfPesquisa" name="cpf" placeholder="Pesquisar por CPF" value="{{ Request::input('cpf') }}" class="search-box text-black">
</div>
                            <div class="form-actions">
                                <button type="submit" class="button-pesquisar">Pesquisar</button>
                                <a href="{{ route('alunos.index') }}" class="limpar-pesquisa">Limpar Pesquisa</a>
                            </div>
                        </form>
                    </div>

                    @if(isset($alunos) && count($alunos) > 0)
                        <div id="listaAlunosContainer">
                            <h2 class="header-yellow">Lista de Alunos</h2>
                            <ul>
                                @foreach($alunos as $aluno)
                                    <div class="aluno {{ $aluno->status == 'Removido' ? 'aluno-removido' : '' }}">
                                        <a href="{{ route('alunos.show', $aluno->id) }}">
                                        
                                            <div class="aluno-info">
                                                <p class="text-yellow">
                                                    Nome: {{ $aluno->nome }} Idade: {{ $aluno->idade }}
                                                    Sexo: {{ $aluno->sexo }} Status: {{ $aluno->status }}
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <p class="text-yellow">Nenhum aluno encontrado.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Script para formatação de campos e validações -->
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Aplica Cleave.js ao campo de CPF para formatar automaticamente
            new Cleave('#cpfPesquisa', {
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
        });
    </script>
</x-app-layout>
