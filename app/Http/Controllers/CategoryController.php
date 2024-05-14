<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category; // Add this line

class CategoryController extends Controller
{
    // fonction qui permet d'afficher la liste de categories

    public function index (){
        // variable categories qui contient tt les donnees de Category et on va trsmettre les donnes a la page index.bladephp
        //pour utilisé les donnes
        $categories = Category::all();
                return view ('admin.categories.index',compact('categories'));
    }



    // fonction qui permet d'ajouter une categorie dans la base
    public function store(Request $request){
        $request -> validate([
        'name'=>'required',
        'description'=>'required',
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;

       if($category->save()) {
        return redirect()->back();
       }
       else{
        echo "erreur";
       }
    }

    public function destroy($id)
    {
        // Find the category with the given ID
        $category = Category::find($id);

        // Check if the category exists
        if ($category) {
            // Delete the category
            $category->delete();

            // Redirect back after deletion
            return redirect()->back()->with('success', 'Category deleted successfully');
        } else {
            // Category not found
            return redirect()->back()->with('error', 'Category not found');
        }
    }

   public function update(Request $request)
    {
        $request -> validate([
            'id'=>'required',
            'name'=>'required',
            'description'=>'required',
            ]);
        $category = Category::find($request->id);
        $category->name=$request->name;
        $category->description=$request->description;
        $category->save();
        return redirect()->back();
    }

    /*public function update(Request $request, $id)
    {

        dd($request);
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        $category = Category::find($id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        return redirect()->back()->with('success', 'Category deleted successfully');
    }*/

}
