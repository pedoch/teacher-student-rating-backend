<?php

namespace App\Http\Controllers\frontend;

use App\FnewArrivalBoard;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class newArrivalController extends Controller
{
    public function updateBillBoard(Request $request){
        $data = $request->all();
        if($request->hasFile('image')) {
            $file = $request->File('image');
            //Get filename with extension
            $fileNameToStoreWithExt = $file[0]->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($fileNameToStoreWithExt, PATHINFO_FILENAME);
            //Get just ext
            $extension = $file[0]->getClientOriginalExtension();
            //File to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            //Upload Image
            $path = $file[0]->storeAs('clientAssets', $fileNameToStore);
            $file[0]->move('storage/image/clientAssets',$fileNameToStore);
            $previous = FnewArrivalBoard::where('id', $data['id'])->first()->image;
            $this->deleteImage($previous);
            FnewArrivalBoard::where('id', $data['id'])->update([
                'title'=> $data['title'],
                'info' => $data['info'],
                'image' => $path
            ]);
            return response()->json('updatedd');
        }
        FnewArrivalBoard::where('id', $data['id'])->update([
            'title'=> $data['title'],
            'info' => $data['info']
        ]);
        return response()->json('updated');
    }
    public function fetchNewArrivalBoard(){
        $board = FnewArrivalBoard::all();
        return response()->json($board);
    }
    private function deleteImage($path){
        $__dir = '/storage/image/';
        $image_path = public_path().$__dir.$path;
//        unlink($image_path);
    }
}
