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
                                @foreach(['Ativo', 'Inativo', 'Pendente', 'Removido'] as $status)
                                    <input type="checkbox" id="{{ strtolower($status) }}" name="status[]" value="{{ $status }}" {{ in_array($status, Request::input('status', [])) ? 'checked' : '' }} class="status-checkbox">
                                    <label for="{{ strtolower($status) }}" class="status-label">{{ $status }}</label>
                                @endforeach
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

                    @if(isset($alunos) && $alunos->count() > 0)
                        <div id="listaAlunosContainer">
                            <h2 class="header-yellow">Lista de Alunos</h2>
                            <table class="min-w-full bg-[#2d2d2d]">
                                <thead>
                                    <tr>
                                        <th class="px-5 py-3 text-left text-xs text-yellow-500 uppercase tracking-wider">Nome</th>
                                        <th class="px-5 py-3 text-left text-xs text-yellow-500 uppercase tracking-wider">Idade</th>
                                        <th class="px-5 py-3 text-left text-xs text-yellow-500 uppercase tracking-wider">Sexo</th>
                                        <th class="px-5 py-3 text-left text-xs text-yellow-500 uppercase tracking-wider">Status</th>
                                        <th class="px-5 py-3 text-left text-xs text-yellow-500 uppercase tracking-wider">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($alunos as $aluno)
                                        <tr class="bg-[#3d3d3d] {{ $aluno->status == 'Removido' ? 'aluno-removido' : '' }}">
                                            <td class="px-5 py-4 text-yellow-500 whitespace-nowrap">{{ $aluno->nome }}</td>
                                            <td class="px-5 py-4 text-yellow-500 whitespace-nowrap">{{ $aluno->idade }}</td>
                                            <td class="px-5 py-4 text-yellow-500 whitespace-nowrap">{{ $aluno->sexo }}</td>
                                            <td class="px-5 py-4 text-yellow-500 whitespace-nowrap">{{ $aluno->status }}</td>
                                            <td class="px-5 py-4 text-yellow-500 whitespace-nowrap">
                                                <a href="{{ route('alunos.show', $aluno->id) }}" class="text-blue-500 hover:text-blue-700">Ver</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
            new Cleave('#cpfPesquisa', {
                delimiters: ['.', '.', '-'],
                blocks: [3, 3, 3, 2],
                numericOnly: true
            });
        });
    </script>
</x-app-layout>
