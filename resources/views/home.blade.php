@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  <a href="{{route('url_create')}}" class="btn btn-primary float-right" type="button" name="button">Criar <span class="fa fa-plus"> </span></a>
                  <h4>Urls
                    @if(count($urls))
                    ({{count($urls)}})
                    @endif
                  </h4>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                      @if(!count($urls))
                      <div class="text-center">
                        <h5>não há urls cadastradas</h5>
                      </div>
                      @else
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Url</th>
                            <th>Descrição</th>
                            <th>Opções</th>
                          </tr>
                        </thead>
                        <tbody>
                        <a href="{{route('url_search')}}" class="btn btn-primary m-2">Procurar</a> <a href="{{route('url_deleteAll')}}" class="btn btn-danger m-2" onclick="return confirm('ATENÇÃO! VOCÊ ESTÁ PRESTES À DELETAR TODAS AS URLS. Tem certeza?')">Deletar todos</a>
                          @foreach($urls as $url)
                          <tr>
                            <td>{{$url->id}}</td>
                            <td>{{$url->name}}</td>
                            <td>{{$url->description}}</td>
                            <td>
                              <form action="{{route('url_delete')}}" method="post">
                                @csrf
                                <input type="hidden" name="url_id" value="{{$url->id}}">


                                <a href="{{$url->name}}" target="_blank" ><button class="btn btn-primary"type="button" name="button"><span class="fa fa-eye"><span></button></a>
                                <button class="btn btn-warning"type="button" name="button"><span class="fa fa-pen"></span></button>
                                <button class="btn btn-danger" type="submit" name="button" onclick="return confirm('Tem certeza que deseja deletar esta URL?')"><span class="fa fa-trash"></span></button>

                              </form>

                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                      @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
