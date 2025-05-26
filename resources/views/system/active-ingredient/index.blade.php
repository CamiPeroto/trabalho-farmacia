@extends('templates.index')


@section('content')
    <div class="container container-padding">
        <h3 class="row">Princípio Ativo</h3>
        <div class="row">
            <div class="col-12">
                <table class="table custom-table shadow">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Descrição</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>John</td>
                            <td>Doe</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="line mt-5"></div>
@endsection
