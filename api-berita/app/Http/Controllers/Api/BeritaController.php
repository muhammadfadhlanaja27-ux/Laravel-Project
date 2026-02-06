<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;

class BeritaController extends Controller
{
    public function index() {
    return Berita::all();
    }

    public function store(Request $request) {
        return Berita::create($request->all());
    }

    public function show($id) {
        return Berita::find($id);
    }

    public function update(Request $request, $id) {
        $berita = Berita::find($id);
        $berita->update($request->all());
        return $berita;
    }

    public function destroy($id) {
        return Berita::destroy($id);
    }
}
