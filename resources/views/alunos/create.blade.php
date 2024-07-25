<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-yellow-500 dark:text-yellow-500 leading-tight">
            {{ __('Criar Conta') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#2d2d2d] overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-yellow-500 dark:text-yellow-500">
                    <h2>Informações do Aluno</h2>
                    <form action="{{ route('alunos.store') }}" method="POST">
                        @csrf
                        <div class="form-group flex flex-wrap">
                            <div class="w-full sm:w-1/2">
                                <label for="nome">Nome*</label>
                                <input type="text" id="nome" name="nome" value="{{ old('nome') }}" class="text-black">
                                @error('nome')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="w-full sm:w-1/2">
                                <label for="cpf">CPF*</label>
                                <input type="text" id="cpf" name="cpf" maxlength="14" placeholder="123.456.789-00"
                                    value="{{ old('cpf') }}" class="text-black">
                                @error('cpf')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group flex flex-wrap">
                            <div class="w-full sm:w-1/2">
                                <label for="rg">RG</label>
                                <input type="text" id="rg" name="rg" value="{{ old('rg') }}" class="text-black">
                                @error('rg')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="w-full sm:w-1/2">
                                <label for="telefone">Telefone</label>
                                <input type="text" id="telefone" name="telefone" value="{{ old('telefone') }}"
                                    class="text-black">
                                @error('telefone')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group flex flex-wrap">
                            <div class="w-full sm:w-1/2">
                                <label for="sexo">Sexo</label>
                                <select id="sexo" name="sexo" class="text-black">
                                    <option value="M" {{ old('sexo') == 'M' ? 'selected' : '' }}>Masculino</option>
                                    <option value="F" {{ old('sexo') == 'F' ? 'selected' : '' }}>Feminino</option>
                                    <option value="Outro" {{ old('sexo') == 'Outro' ? 'selected' : '' }}>Outro</option>
                                </select>
                                @error('sexo')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="w-full sm:w-1/2">
                                <label for="data_nascimento">Data de Nascimento*</label>
                                <input type="date" id="data_nascimento" name="data_nascimento" class="text-black"
                                    max="{{ date('Y-m-d') }}" value="{{ old('data_nascimento') }}">
                                @error('data_nascimento')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group flex flex-wrap">
                            <div class="w-full">
                                <label for="endereco">Endereço</label>
                                <input type="text" id="endereco" name="endereco" value="{{ old('endereco') }}"
                                    class="text-black">
                                @error('endereco')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group flex flex-wrap">
                            <div class="w-full">
                                <button type="submit" class="button-salvar">Salvar</button>
                            </div>
                        </div>
                    </form>
                    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

                    <!-- Inclui a biblioteca Cleave.js -->
                    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            new Cleave('#cpf', {
                                delimiters: ['.', '.', '-'],
                                blocks: [3, 3, 3, 2],
                                numericOnly: true
                            });

                            document.getElementById('rg').addEventListener('keypress', function (event) {
                                if (event.charCode < 48 || event.charCode > 57) {
                                    event.preventDefault();
                                }
                            });

                            document.getElementById('telefone').addEventListener('keypress', function (event) {
                                const allowedChars = [32, 40, 41, 45, 43];
                                if ((event.charCode < 48 || event.charCode > 57) && !allowedChars.includes(event.charCode)) {
                                    event.preventDefault();
                                }
                            });

                            document.getElementById('nome').addEventListener('keypress', function (event) {
                                const charCode = event.charCode;
                                if (!(charCode >= 48 && charCode <= 57) &&  // Números (0-9)
                                    !(charCode >= 65 && charCode <= 90) &&  // Letras maiúsculas (A-Z)
                                    !(charCode >= 97 && charCode <= 122) && // Letras minúsculas (a-z)
                                    charCode !== 32) {                      // Espaço
                                    event.preventDefault();
                                }
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
