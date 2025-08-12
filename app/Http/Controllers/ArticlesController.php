<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articles;
use Illuminate\Http\RedirectResponse;



class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('permission:articles.index')->only(['index']);
        $this->middleware('permission:articles.create')->only(['create', 'store']);
        $this->middleware('permission:articles.edit')->only(['edit', 'update']);
        $this->middleware('permission:articles.delete')->only(['destroy']);
    }


    public function home()
    {
        return view('admin.dashboard');
    }


    public function index()
    {
        $datos = Articles::all();
        return view(('admin.listArticles'), compact('datos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.createArticles');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'         => ['required', 'string', 'max:255'],
            'url_img'      => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'category'     => ['required', 'string', 'max:255'],
            'price'        => ['required', 'integer', 'min:0']
        ]);


        //hasFile verifica si hay un archivo valido 
        if ($request->hasFile('url_img')) {
            $validated['url_img'] = $request->file('url_img')->store('articles', 'public');
        }

        Articles::create([
            'name'        => $request->input('name'),
            'url_img'     => $validated['url_img'],
            'category'    => $request->input('category'),
            'price'       => $request->input('price')
        ]);

        return redirect()->route('admin.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Articles $articles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $datos = Articles::findOrfail($id);
        return view('admin.editArticles', compact('datos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $datos = Articles::findOrfail($id);


        $request->validate([
            'name'         => ['required', 'string', 'max:255'],
            'url_img'      => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'category'     => ['required', 'string', 'max:255'],
            'price'        => ['required', 'integer', 'min:0']
        ]);

        if ($request->hasFile('url_img')) {
            // Opcional: eliminar imagen anterior
            if ($datos->url_img && \Storage::disk('public')->exists($datos->url_img)) {
                \Storage::disk('public')->delete($datos->url_img);
            }
            $imagenPath = $request->file('url_img')->store('articles', 'public');
            $datos->url_img = $imagenPath;
        }

        $datos->name        =  $request->input('name');
        $datos->category    =  $request->input('category');
        $datos->price       =  $request->input('price');
        $datos->save();

        return redirect()->route(('admin.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $datos = Articles::findOrFail($id);

        if ($datos->url_img && \Storage::disk('public')->exists($datos->url_img)) {
            \Storage::disk('public')->delete($datos->url_img);
        }

        $datos->delete();

        return redirect()->route('admin.index');
    }

}


