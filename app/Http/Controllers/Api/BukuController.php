<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Buku::orderBy('judul', 'asc')->get();
        return response()->json([
            'status' => TRUE,
            'message' => 'Data retrieved Successfully',
            'data' => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Buku;

        $rules = [
            'judul' => 'required',
            'pengarang' => 'required',
            'tanggal_publikasi' => 'required|date',
        ];

        $validator = FacadesValidator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => FALSE,
                'message' => 'Add data failed',
                'data' => $validator->errors()
            ]);
        }

        $data->judul = $request->judul;
        $data->pengarang = $request->pengarang;
        $data->tanggal_publikasi = $request->tanggal_publikasi;

        $post = $data->save();

        return response()->json([
            'status' => TRUE,
            'message' => 'Add Data successfully',
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Buku::find($id);
        if ($data) {
            return response()->json([
                'status' => TRUE,
                'message' => 'Get Data By Id Successfully',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => FALSE,
                'message' => 'Get Data By Id Failed',
                // 'data' => $data
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Buku::find($id);
        if (empty($data)) {
            return response()->json([
                'status' => FALSE,
                'message' => 'Resource Not Found',
            ], 404);
        }
        $rules = [
            'judul' => 'required',
            'pengarang' => 'required',
            'tanggal_publikasi' => 'required|date',
        ];

        $validator = FacadesValidator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => FALSE,
                'message' => 'Update Data Failed',
                'data' => $validator->errors()
            ]);
        }

        $data->judul = $request->judul;
        $data->pengarang = $request->pengarang;
        $data->tanggal_publikasi = $request->tanggal_publikasi;

        $post = $data->save();

        return response()->json([
            'status' => TRUE,
            'message' => 'Update Data Successfully',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Buku::find($id);
        if (empty($data)) {
            return response()->json([
                'status' => FALSE,
                'message' => 'Resource Not Found',
            ], 404);
        }


        $post = $data->delete();

        return response()->json([
            'status' => TRUE,
            'message' => 'Delete Data Successfully',
        ], 200);
    }
}
