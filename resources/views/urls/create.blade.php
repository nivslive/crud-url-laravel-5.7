@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  <h4>Criar Url</h4>
                </div>
                <div class="card-body">
                  @if ($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif



                  <form action="{{route('url_store')}}" method="post">
                     @csrf
                    <div class="form-group">
                      <label for="url">Url: </label>
                      <input class="form-control" name="name" type="text" value="">

                      <label for="url">Descrição: </label>
                      <textarea name="description" class="form-control" rows="8" cols="80"></textarea>
                      <hr>

                      <button class="btn btn-primary" type="submit" name="button"><span class="fa fa-save"></span> Salvar </button>


                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>


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
@endsection
