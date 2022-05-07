<?php

namespace App\Http\Controllers;

use App\Recipe;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RecipeController extends Controller
{

    public function recipelist(){
        $recipeData = User::join('recipes','recipes.createdby','=','users.id')->orderby('recipes.id','DESC')
            ->get(['recipes.id','recipes.date','recipes.description','recipes.picurl','recipes.ingredients','recipes.instructions','users.name']);

        return response()->json(['recipeData' => $recipeData], 200);
    }

    public function recipedetails($id){
        $recipeData = User::join('recipes','recipes.createdby','=','users.id')->where('recipes.id','=',$id)
            ->get(['recipes.id','recipes.date','recipes.description','recipes.picurl','recipes.ingredients','recipes.instructions','users.name']);

        //$recipeData = Recipe::where('id',$id)->first();
    //return $recipeData = User::with('recipe')->get();
        return response()->json(['recipeData' => $recipeData], 200);
    }

    public function addrecipe(Request $request){
        $recipeRes = Recipe::create([
            'date'=> Carbon::today()->format('Y-m-d'),
            'description'=> $request->description,
            'picurl'=> 'photo.jpg',//$request->picurl,
            'ingredients'=> $request->ingredients,
            'instructions'=> $request->instruction,
            'createdby'=> auth()->user()->id,
        ]);
        return response()->json(['recipeData' => $recipeRes], 200);
    }

    public function index(){
        $recipes = Recipe::All();
        $data = array(
            'recipes'=>$recipes,
        );
        return view('admin.recipes.index')->with($data);
    }

    public function show(Request $request, $id){
        $recipes = Recipe::where('id',$id)->first();
        $data = array(
            'recipes'=>$recipes,
        );
        return view('admin.recipes.show')->with($data);
    }

    public function destroy($id)
    {
        if (request()->ajax()) {
            try {
                $can_be_deleted = true;
                $error_msg = '';

                //Check if any routing has been done
               //do logic here
               $req = Recipe::where('id', $id)->first();

                if ($can_be_deleted) {
                    if (!empty($req)) {
                        DB::beginTransaction();
                        //Delete Query  details
                        Recipe::where('id', $id)->delete();

                        DB::commit();

                        $output = ['success' => true,
                                'msg' => "Recipe Deleted Successfully"
                            ];
                    }else{
                        $output = ['success' => false,
                                'msg' => "Could not be deleted, Child record exist."
                            ];
                    }
                } else {
                    $output = ['success' => false,
                                'msg' => $error_msg
                            ];
                }
            } catch (\Exception $e) {
                DB::rollBack();
                \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());

                $output = ['success' => false,
                                'msg' => "Something Went Wrong"
                            ];
            }
            return $output;
        }
    }

}
