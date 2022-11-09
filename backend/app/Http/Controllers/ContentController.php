<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContentController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
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

    $user = auth()->user();

    $content = new Content();
    $content->img_path = $pict_url;
    $content->title = $request->title;
    $content->description = $request->description;
    $content->user_id = $user->id;
    $content->save();

    return response()->json(['message' => 'content created'], 200);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Content  $content
   * @return \Illuminate\Http\Response
   */
  public function show(Content $content)
  {
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
      'img_path' => 'required|image',
      'title' => 'required|string',
      'description' => 'required|string',
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

    $user = auth()->user();

    $content->update([
      'img_path' => $pict_url,
      'title' => $request->title,
      'description' => $request->description,
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
