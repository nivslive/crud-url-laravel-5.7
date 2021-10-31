<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Url;
use Illuminate\Support\Facades\DB;

class UrlsController extends Controller
{
    public function create(){
      return view('urls.create');
    }

    public function store(Request $request){
      $validator = Validator::make($request->all(), [
           'name' => 'required|url',
       ]);

       if ($validator->fails()) {
           return redirect('url-create')
                       ->withErrors($validator)
                       ->withInput();
       }
       $url = new Url;
       $url->name = $request->name;
       $url->description = $request->description;
       $url->save();
       return redirect('/home')->with('status', 'Url '.$url->name.' criada com sucesso');;
    }


    public function delete(Request $request){
      $validator = Validator::make($request->all(),[
         'url_id'=>'required',
      ]);

      if($validator->fails()){
        return redirect('/home')
                      ->withErrors($validator)
                      ->withInput();
      }



      $url = Url::find($request->url_id);

      $url_name = $url->name;

      $url->delete();
      return redirect('/home')->with('status', 'Url '.$url_name.' apagada com sucesso');;
    }

    public function deleteAll(Url $url) 
    {
      $url->truncate();
      return redirect('produtos')->with('status', 'Todos os produtos foram apagados com sucesso!');
    }









    public function search(Request $request, Url $url)
    {
        $query = Url::query();


        #filtro por name
        if ($request->has('name')) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }
        

        #filtro para hifens
        if ($request->has('hifen')) {
            $query->where('name', 'not regexp', "[\d\-]");
        }


        #filtro para numeros
        if ($request->has('number')) {
            $query->where('name', 'not regexp', "\d+"); 
        }
        


        #se foi selecionado o filtro


   if($request->has('filtro_minimo')){
                    $filtro_minimo =  $request->input('filtro_minimo');
                    $query->where(DB::raw('LENGTH(name)'), '>' , "$filtro_minimo");
                }

    if($request->has('filtro_maximo')){
        $filtro_maximo =  $request->input('filtro_maximo');
        $query->where(DB::raw('LENGTH(name)'), '<' , "$filtro_maximo");}
 


        $query->paginate();
        
        $urls = $query->paginate();





        return view('urls.search',['urls' => $urls]);
    }

}
