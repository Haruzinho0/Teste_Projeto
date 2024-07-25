<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-yellow-500 dark:text-yellow-500 leading-tight">
            {{ __('Criar Avaliação') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#2d2d2d] overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-yellow-500 dark:text-yellow-500">
                    <h2>Informações da Avaliação</h2>
                    <form action="{{ route('avaliacao.store', $aluno->id) }}" method="POST">
                        @csrf
                        <div class="form-group flex flex-wrap">
                            <div class="w-full sm:w-1/2">
                                <label for="avaliador">Avaliador*</label>
                                <input type="text" id="avaliador" name="avaliador" value="{{ old('avaliador') }}" class="text-black">
                                @error('avaliador')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="w-full sm:w-1/2">
                                <label for="data">Data*</label>
                                <input type="date" id="data" name="data" class="text-black" value="{{ old('data') }}">
                                @error('data')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group flex flex-wrap">
                            <div class="w-full sm:w-1/2">
                                <label for="altura">Altura*</label>
                                <input type="number" step="0.01" id="altura" name="altura" value="{{ old('altura') }}" class="text-black">
                                @error('altura')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="w-full sm:w-1/2">
                                <label for="idade">Idade*</label>
                                <input type="number" id="idade" name="idade" value="{{ old('idade') }}" class="text-black">
                                @error('idade')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group flex flex-wrap">
                            <div class="w-full sm:w-1/2">
                                <label for="peso">Peso*</label>
                                <input type="number" step="0.1" id="peso" name="peso" value="{{ old('peso') }}" class="text-black">
                                @error('peso')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="w-full sm:w-1/2">
                                <label for="porcentagem_gordura">% Gordura*</label>
                                <input type="number" step="0.1" id="porcentagem_gordura" name="porcentagem_gordura" value="{{ old('porcentagem_gordura') }}" class="text-black">
                                @error('porcentagem_gordura')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <h3>Parte Gordura</h3>
                        <div class="form-group flex flex-wrap">
                            @foreach(['braco_direito_gordura' => 'Braço Direito', 'braco_esquerdo_gordura' => 'Braço Esquerdo', 'perna_direita_gordura' => 'Perna Direita', 'perna_esquerda_gordura' => 'Perna Esquerda', 'tronco_gordura' => 'Tronco'] as $field => $label)
                                <div class="w-full sm:w-1/2">
                                    <label for="{{ $field }}">{{ $label }}*</label>
                                    <input type="number" step="0.1" id="{{ $field }}" name="{{ $field }}" value="{{ old($field) }}" class="text-black">
                                    @error($field)
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endforeach
                        </div>

                        <h3>Parte Massa Muscular</h3>
                        <div class="form-group flex flex-wrap">
                            @foreach(['massa_muscular' => 'Massa Muscular', 'braco_direito_muscular' => 'Braço Direito', 'braco_esquerdo_muscular' => 'Braço Esquerdo', 'perna_direita_muscular' => 'Perna Direita', 'perna_esquerda_muscular' => 'Perna Esquerda', 'tronco_muscular' => 'Tronco'] as $field => $label)
                                <div class="w-full sm:w-1/2">
                                    <label for="{{ $field }}">{{ $label }}*</label>
                                    <input type="number" step="0.1" id="{{ $field }}" name="{{ $field }}" value="{{ old($field) }}" class="text-black">
                                    @error($field)
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endforeach
                        </div>

                        <h3>Escala Constituição</h3>
                        <div class="form-group flex flex-wrap">
                            @foreach(['massa_ossea' => 'Massa Óssea', 'gordura_visceral' => 'Gordura Visceral', 'porcentagem_agua' => '% Água', 'taxa_metabolica_basal' => 'Taxa Metabólica Basal', 'idade_metabolica' => 'Idade Metabólica'] as $field => $label)
                                <div class="w-full sm:w-1/2">
                                    <label for="{{ $field }}">{{ $label }}*</label>
                                    <input type="number" step="0.1" id="{{ $field }}" name="{{ $field }}" value="{{ old($field) }}" class="text-black">
                                    @error($field)
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endforeach
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
                                if ((event.charCode < 48 || event.charCode > 57) && ![32, 40, 41, 45, 43].includes(event.charCode)) {
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
