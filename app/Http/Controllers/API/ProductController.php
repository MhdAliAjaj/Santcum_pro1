<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Product;
use Validator;
use App\Http\Resources\ProductResource;
use Illuminate\Http\JsonResponse;
class ProductController extends BaseController
{
  
   
  /**
     * @OA\Get(
     *     path="/api/products",
     *     operationId="GetProducts",
     *     tags={"Products"},
     *     summary="get products all",
     *     description="Get all products Endpoint",
     *     
     *     @OA\Response(
     *         response="201",
     *         description="User Register Successfully",
     *         @OA\JsonContent()
     *     ),
     *    
     * )
     */
        
    public function index()
    {
        $products = Product::all();
        return $this->sendResponse(ProductResource::collection($products), 'Products retrieved successfully.');
    }
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    
    public function store(Request $request)
    {
        $input = $request->all();
        // $validator = Validator::make($input, [
        //     'name' => 'required',
        //     'detail' => 'required'
        // ]);
        
        // if($validator->fails()){
        //     return $this->sendError('Validation Error.', $validator->errors());       
        // }
        $product = Product::create($input);
        
        return $this->sendResponse(new ProductResource($product), 'Product created successfully.');
    } 
    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    
    public function show($id)
    {
        $product = Product::find($id);
        if (is_null($product)) {
            return $this->sendError('Product not found.');
        }
        return $this->sendResponse(new ProductResource($product), 'Product retrieved successfully.');
    }
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Product $product)
    {
        $input = $request->all();
        // $validator = Validator::make($input, [
        //     'name' => 'required',
        //     'detail' => 'required'
        // ]);
        // if($validator->fails()){
        //     return $this->sendError('Validation Error.', $validator->errors());       
        // }
        $product->name = $input['name'];
        $product->detail = $input['detail'];
        $product->save();
        
        return $this->sendResponse(new ProductResource($product), 'Product updated successfully.');
    }
    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        
        $product = Product::find($id);
  
        if (is_null($product)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Product is not found!',
            ], 200);
        }

        Product::destroy($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Product is deleted successfully.'
            ], 200);
    }
}