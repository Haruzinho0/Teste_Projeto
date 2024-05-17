<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\Status;
use App\Rules\CPF;

class AlunoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Verifique se há um termo de pesquisa enviado via POST
        if ($request->has('termo')) {
            $termo = $request->input('termo');
            
            // Filtrar os alunos com base no termo de pesquisa e ordená-los por ordem alfabética
            $alunos = Aluno::where('nome', 'LIKE', "%$termo%")
                           ->whereHas('status', function ($query) {
                               $query->where('descricao', '!=', 'excluido');
                           })
                           ->orderBy('nome')
                           ->get();
        } else {
            // Se não houver termo de pesquisa, obtenha todos os alunos ordenados por ordem alfabética
            $alunos = Aluno::whereHas('status', function ($query) {
                                $query->where('descricao', '!=', 'excluido');
                            })
                            ->orderBy('nome')
                            ->get();
        }
        
        // Renderize a view 'alunos' e passe os resultados da pesquisa
        return view('alunos', compact('alunos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('alunos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => ['required', 'string', new CPF],
            'rg' => 'nullable|string|max:255',
            'telefone' => 'nullable|string|max:20',
            'sexo' => 'required|in:M,F,Outro',
            'data_nascimento' => 'required|date',
            'endereco' => 'nullable|string',
        ], [
            'nome.required' => 'O campo nome é obrigatório.',
            'cpf.required' => 'O campo CPF é obrigatório.',
            'sexo.required' => 'O campo sexo é obrigatório.',
            'data_nascimento.required' => 'O campo data de nascimento é obrigatório.',
        ]);

        // Buscar o status 'inativo'
        $statusInativo = Status::where('descricao', 'inativo')->first();

        // Verificar se existe um aluno com o mesmo CPF e se ele não está excluído
        $alunoExistente = Aluno::where('cpf', $request->cpf)->first();

if ($alunoExistente) {
    // Verificar se o aluno existe e está marcado como excluído
    if ($alunoExistente->status_id === 4) {
        // Permitir a criação de um novo aluno
        Aluno::create([
            'nome' => $request->input('nome'),
            'cpf' => $request->input('cpf'),
            'rg' => $request->input('rg'),
            'telefone' => $request->input('telefone'),
            'sexo' => $request->input('sexo'),
            'data_nascimento' => $request->input('data_nascimento'),
            'endereco' => $request->input('endereco'),
            'status_id' => $statusInativo->id,
        ]);
        return redirect()->route('alunos.index')->with('success', 'Aluno cadastrado com sucesso.');
    } else {
        // Se o aluno existe e não está marcado como excluído, exibir um erro
        return back()->withErrors(['cpf' => 'Já existe uma conta cadastrada com este CPF e não está excluída.']);
    }

} else {
    // Se não houver aluno com o mesmo CPF, criar o novo aluno normalmente
    Aluno::create([
        'nome' => $request->input('nome'),
        'cpf' => $request->input('cpf'),
        'rg' => $request->input('rg'),
        'telefone' => $request->input('telefone'),
        'sexo' => $request->input('sexo'),
        'data_nascimento' => $request->input('data_nascimento'),
        'endereco' => $request->input('endereco'),
        'status_id' => $statusInativo->id,
    ]);
    return redirect()->route('alunos.index')->with('success', 'Aluno cadastrado com sucesso.');
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(Aluno $aluno)
    {
        return view('alunos.show', compact('aluno'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:alunos,cpf,' . $id,
            'rg' => 'nullable|string|max:255',
            'telefone' => 'nullable|string|max:20',
            'sexo' => 'required|in:M,F,Outro',
            'data_nascimento' => 'required|date',
            'endereco' => 'nullable|string',
        ]);

        $aluno = Aluno::findOrFail($id);

        // Atualiza os dados do aluno
        $aluno->nome = $request->input('nome');
        $aluno->cpf = $request->input('cpf');
        $aluno->rg = $request->input('rg');
        $aluno->telefone = $request->input('telefone');
        $aluno->sexo = $request->input('sexo');
        $aluno->data_nascimento = $request->input('data_nascimento');
        $aluno->endereco = $request->input('endereco');
        // Atualize os outros campos, se necessário

        // Salva as alterações no banco de dados
        $aluno->save();
        return redirect()->route('alunos.show', $aluno->id)->with('success', 'Perfil do aluno atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Encontre o aluno pelo ID
        $aluno = Aluno::findOrFail($id);
        
        // Buscar o status 'excluido'
        $statusExcluido = Status::where('descricao', 'excluido')->first();
        
        // Atualizar o status do aluno para 'excluido'
        $aluno->status_id = $statusExcluido->id;
        $aluno->save();
        
        // Redirecione de volta para a lista de alunos
        return redirect()->route('alunos.index')->with('success', 'Aluno excluído com sucesso.');
    }

    public function search(Request $request)
    {
        $termo = $request->input('termo');
    
        // Realize a pesquisa de alunos com base no termo de pesquisa
        $alunos = Aluno::where('nome', 'LIKE', "%{$termo}%")
                       ->whereHas('status', function ($query) {
                           $query->where('descricao', '!=', 'excluido');
                       })
                       ->get();
    
        // Carregue a visão parcial com os resultados da pesquisa
        return view('alunos.index', compact('alunos'));
    }
}
