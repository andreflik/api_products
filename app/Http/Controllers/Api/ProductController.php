<?php

namespace App\Http\Controllers\Api;

use App\API\ApIError;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;

class ProductController extends Controller
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function index() {
        
        return response()->json($this->product->paginate(10));
    }

    public function show($id) {

        $product = $this->product->find($id);
        
        if(! $product) return response()->json(['data' => ['msg' => 'Produto não encontrado']]);

        $data = ['data' =>  $product];
        return response()->json($data);
    }

    public function store(Request $request) {

        try {
            $productData = $request->all();
            $this->product->create($productData);

            return response()->json(['msg' => 'Produto criando com sucesso !'], 201);
        }
        catch(\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiError::errorMessage($e->getMessage(), 1010, 500));
            }
            return response()->json(ApiError::errorMessage('Houve um erro ao criar', 1010, 500));
        }
        
    }
        public function update(Request $request, $id) {

            try {
                $productData = $request->all();
                $product = $this->product->find($id);
                $product->update($productData);

                return response()->json(['msg' => 'Produto atualizado com sucesso !'], 201);
            }
            catch(\Exception $e) {
                if (config('app.debug')) {
                    return response()->json(ApiError::errorMessage($e->getMessage(), 1011, 500));
                }
                return response()->json(ApiError::errorMessage('Houve um erro ao atualizar', 1011, 500));
            }
            
        }
        public function delete(Product $id) {
            try {
                $id->delete();
                return response()->json(['data' => ['msg' => 'Produto ' . $id->name . ' removido com sucesso !']], 200);
            }
            catch (\Exception $e) {
                if (config('app.debug')) {
                    return response()->json(ApiError::errorMessage($e->getMessage(), 1012));
                }
                return response()->json(ApiError::errorMessage('Houve um erro ao remover o produto', 1012));
            }
        }
}
