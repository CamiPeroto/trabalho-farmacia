@extends('templates.index')


@section('content')
    <h3 class="text-red-900">Princípio Ativo</h3>
    <table class="table">
        <thead>
            <tr class="table-row-header">
                <th class="table-header">ID</th>
                <th class="table-header">Nome</th>
                <th class="table-header hidden lg:table-cell">Descrição</th>

            </tr>
        </thead>
        <tbody>
            <tr class="table-row-body">
                <td class="table-body">1</td>
                <td class="table-body">Dipirona</td>
                <td class="table-body hidden lg:table-cell">Antitérmico e Analgésico</td>
            </tr>
            <tr class="table-row-body">
                <td class="table-body">2</td>
                <td class="table-body">Dipirona</td>
                <td class="table-body hidden lg:table-cell">Antitérmico e Analgésico</td>
            </tr>

        </tbody>
    </table>
@endsection
