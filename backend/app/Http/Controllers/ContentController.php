<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContentController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $content = Content::join('users', 'users.id', '=', 'contents.user_id')
      ->select('contents.*', 'users.nama as user_nama')
      ->get();

    return $content;
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'img_path' => 'required|image',
      'title' => 'required|string',
      'description' => 'required|string',
      'category' => 'required|string',
      'user_id' => 'integer',

    ]);

    if ($validator->fails()) {
      return response()->json(['message' => 'invalid credentials'], 401);
    }

    $pict = $request->file('img_path');
    if ($pict) {
      $pict_url = $pict->store('uploads');
      $pict->move(public_path('uploads'), $pict_url);
    }

    $user = User::where('remember_token', $request->token)->get();

    $content = new Content();
    $content->img_path = explode('/', $pict_url)[1];
    $content->title = $request->title;
    $content->description = $request->description;
    $content->category = $request->category;
    $content->user_id = $user[0]->id;
    $content->save();

    return response()->json(['message' => 'content created'], 200);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Content  $content
   * @return \Illuminate\Http\Response
   */
  public function showByUserId($id, Request $request)
  {
    $user = User::where('id', $id)->get();
    $content = Content::where('user_id', $user[0]->id)->get();
    return response()->json($content, 200);
  }

  public function show($id)
  {
    $content = Content::where('id', $id)->get();
    return response()->json($content, 200);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Content  $content
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Content $content)
  {
    $validator = Validator::make($request->all(), [
      // 'img_path' => 'required|image',
      // 'title' => 'required|string',
      // 'description' => 'required|string',
      // 'category' => 'required|string',
      // 'user_id' => 'integer',
    ]);

    if ($validator->fails()) {
      return response()->json(['message' => 'invalid credentials'], 401);
    }


    $pict = $request->file('img_path');
    if ($pict) {
      $pict_url = $pict->store('uploads');
      $pict->move(public_path('uploads'), $pict_url);
    }

    $user = User::where('remember_token', $request->token)->get();

    $content->update([
      'img_path' => explode('/', $pict_url)[1],
      'title' => $request->title,
      'description' => $request->description,
      'category' => $request->category,
      'user_id' => $user->id,
    ]);

    return response()->json(['message' => 'content updated'], 200);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Content  $content
   * @return \Illuminate\Http\Response
   */
  public function destroy(Content $content)
  {
    $content->delete();
    return response()->json(['message' => 'content deleted'], 200);
  }
}
