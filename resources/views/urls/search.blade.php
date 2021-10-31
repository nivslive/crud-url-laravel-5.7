@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Itens</h1>
            <p>{{ Session::get('message') }}</p>

            
            <form class="" action="" method="POST">

				<div class="form-group">
					
					<div class="col-md-12">
						<label for="nome">Digite a URL do Site</label>
						<input id="textinput" name="nome" type="text" placeholder="" class="form-control input-md">
						<span class="help-block">{{ ($errors->has('name')) ? $errors->first('name') : '' }}</span>  

                          <input type="checkbox" id="hifen" name="hifen" value="hifen">
                             <label for="hifen">Exceto Hifens</label>
                            <input type="checkbox" id="number" name="number" value="number">
                           <label for="number">Exceto Numeros</label><br>
					</div>



                    <span>Quantidade de Caracteres</span><br>
                    <label for="quantidade">Minimo</label>
						<input style="display:flex" id="filtro_minimo" name="filtro_minimo" type="text" placeholder="" class="form-control input-md">

                    <label for="quantidade"> Máximo </label>

                    <input id="textinput" name="filtro_maximo" type="text" placeholder="" class="form-control input-md">
               
</select>
				</div>
			
				<p><br>
					<br>
				</p>
				
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="submit"  value="Buscar">
                <a href="{{route('home')}}">Voltar. </a>
			</form>

            <table class="table table-bordered table-hover table-condensed">
                <thead>
                  
                         <tr>
                            <th>ID</th>
                            <th>Url</th>
                            <th>Descrição</th>
                            <th>Opções</th>
                          </tr>
                
                </thead>
                <tbody>

                    


            @if(!empty($urls))
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
            @endif




                </tbody>
            </table>
            
        </div>
    </div>
</div>
@endsection