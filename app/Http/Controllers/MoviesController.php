<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\MoviesCollection;
use App\Http\Resources\MoviesResource;
use Validator;
use App\Movie;
use App\Category;
use App\User;
use Auth;

class MoviesController extends Controller
{
    public function index()
    {
        return new MoviesCollection(MoviesResource::collection(Movie::all()));
    }

    public function show($id)
    {
        $movie = Movie::find($id);
        if (!$movie) {
            return response()->json([
                'error' => 404,
                'message' => 'Not found'
            ], 404);
        } else {
            return new MoviesResource($movie);
        }
    }

    public function showAdded()
    {
        $user = Auth::user();
        if($user!=null){
            if ($user->can('store',Movie::class)) {
                $movie = Movie::where('user_id',$user->id)->orderBy('created_at','desc')->get();
                if (!$movie) {
                    return response()->json([
                        'error' => 404,
                        'message' => 'Not found'
                    ], 404);
                } else {
                    return new MoviesCollection(MoviesResource::collection($movie));
                }
            }else{
              return response()->json([
                  'message' => "You are not authorized",
              ],401);
            }
        }else{
          return response()->json([
              'message' => "You are not authorized",
          ],401);
        }
    }

    public function showByCategory($id)
    {
        $movie = Movie::where('category_id',$id)->orderBy('created_at','desc')->get();
        if (!$movie) {
            return response()->json([
                'error' => 404,
                'message' => 'Not found'
            ], 404);
        } else {
            return new MoviesCollection(MoviesResource::collection($movie));
        }

    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if($user!=null){
          if ($user->can('store',Movie::class)) {
            $validator = Validator::make($request->all(), [
              'name' => 'required',
              'year' => 'required|integer',
              'category_id' => 'required|integer'
            ]);
            if ($validator->fails()) {
                return response()->json(['error'=>$validator->errors(), 'message' => 'Failed to store result', 'status' => false], 401);
            }

            $movie = new Movie([
                'user_id' => $user->id,
                'name' => $request->name,
                'year' => $request->year,
                'category_id' => $request->category_id,
                'description' => $request->description,
            ]);
            $movie->save();

            return response()->json([
                'id' => $movie->id,
                'created_at' => $movie->created_at
            ]);
          }else{
            return response()->json([
                'message' => "You are not authorized",
            ],401);
          }
        }else{
          return response()->json([
              'message' => "You are not authorized",
          ],401);
        }
    }

    public function update(Request $request, $id)
    {

      $movie = Movie::find($id);
      if (!$movie || $movie->id != $id) {
          return response()->json([
              'error' => 404,
              'message' => 'not found'
          ]);
      }

      $user = Auth::user();
      if($user!=null){
        if ($user->can('updateAndDelete',$movie)) {
          $validator = Validator::make($request->all(), [
            'name' => 'required',
            'year' => 'required|integer',
            'category_id' => 'required|integer'
          ]);
          if ($validator->fails()) {
              return response()->json(['error'=>$validator->errors(), 'message' => 'Failed to store result', 'status' => false], 401);
          }

          $movie->update($request->all());
          return response()->json([
              'id' => $movie->id,
              'created_at' => $movie->updated_at
          ]);

        }else{
          return response()->json([
              'message' => "You are not authorized",
          ],401);
        }
      }else{
        return response()->json([
            'message' => "You are not authorized",
        ],401);
      }
    }

    public function delete(Request $request, $id)
    {

      $movie = Movie::find($id);
      if (!$movie || $movie->id != $id) {
          return response()->json([
              'error' => 404,
              'message' => 'not found'
          ],404);
      }

      $user = Auth::user();
      if($user!=null){
          if ($user->can('updateAndDelete',$movie)) {
            $movie->delete();
            return response()->json(["message"=>"Movie is deleted"]);
          }else{
            return response()->json([
                'message' => "You are not authorized",
            ],401);
          }
      }else{
        return response()->json([
            'message' => "You are not authorized",
        ],401);
      }
    }
}
