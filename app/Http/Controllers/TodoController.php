<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //db de ki verileri buraya göndermek için kullanıyoruz
        $todos = Todo::all();
        return view('index', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //aldığımız değerleri veri tabanına kaydediyoruz
        //dd($request->all());

        $request->validate([
            'title' => 'required',
            'description' => 'required|min:5'
        ],[
            'title.required' => 'Başlık alanı zorunludur',
            'description.required' => 'Açıklama alanı zorunludur',
            'description.min' => 'Açıklama en az 5 karakter olmalıdır'
        ]);

        $is_create=Todo::create([
            'title' => $request->title,
            'description' => $request->description
        ]);
        if($is_create){
            return redirect()->route('index')->with('success', 'Todo başarıyla oluşturuldu');
        }
        return redirect()->route('index')->with('error', 'Todo oluşturulamadı');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //id alıp todo bulmak gerekiyor
        $todo = Todo::find($id);
        return view('show', compact('todo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //id alıp todo bulmak gerekiyor
        $todo = Todo::find($id);
        return view('edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //id güncellenecek veriyi bulmak için
        $request->validate([
            'title' => 'required',
            'description' => 'required|min:5'
        ],[
            'title.required' => 'Başlık alanı zorunludur',
            'description.required' => 'Açıklama alanı zorunludur',
            'description.min' => 'Açıklama en az 5 karakter olmalıdır'
        ]);
        $todo = Todo::find($id);
        $is_success=$todo->update([
            'title' => $request->title,
            'description' => $request->description,
            'completed' => $request->completed
        ]);
        if($is_success){
            return redirect()->route('index')->with('success', 'Todo başarıyla güncellendi');
        }
        return redirect()->route('index')->with('error', 'Todo güncellenemedi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $todo = Todo::find($id);
        $is_deleted=$todo->delete();
        if($is_deleted){
            return redirect()->route('index')->with('success', 'Todo başarıyla silindi');
        }
        return redirect()->route('index')->with('error', 'Todo silinemedi');
    }
}
