<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Transformers\CategoryTransformer;
use App\Models\Category;
use App\Models\Card;
use Auth;
use App\Http\Requests\Api\CategoryRequest;

class CategoryController extends Controller
{

     // 当前登录用户的所有分组
     public function showList()
     {
        $user = $this->user();
        return $this->response->collection($user->categories, new CategoryTransformer());
     }

     // 添加分组
     public function create(CategoryRequest $request,Category $category)
     {
        $user = $this->user();

        $category->name = $request->name;
        $category->introduction = $request->introduction;
        $category->user_id = $user->id;
        $category->save();

        return $this->response->created();
     }

     // 编辑分组
     public function edit(CategoryRequest $request)
     {
        $user = $this->user();

        if(!$category = $user->categories->find($request->category_id))
        {
          return $this->response->errorUnauthorized('分组不存在!');
        }

        $category->name = $request->name;
        $category->introduction = $request->introduction;
        $category->user_id = $user->id;

        $category->save();

        return $this->response->noContent()->setStatusCode(200);
     }

     // 删除分组
     public function delete($category)
     {
        $user = $this->user();

        if(!$category = $user->categories->find($category)) {
          return $this->response->errorUnauthorized('分组不存在!');
        }

        $card = $category->cards->pluck('id');


        foreach($card as $id){
           $delete = Card::find($id);
           $delete->delete();
        }

        $category->delete();

        return $this->response->noContent()->setStatusCode(200);
     }
}
