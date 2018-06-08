<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Transformers\CardTransformer;
use App\Models\Card;
use App\Models\Category;
use Auth;
use App\Http\Requests\Api\CardRequest;

class CardController extends Controller
{
    // 该用户所有卡牌
    public function showList()
    {
        $user = $this->user();
        return $this->response->collection($user->cards, new CardTransformer());
    }

    // 该用户指定分组的所有卡牌
    public function showByCategory($id)
    {
        $category = Category::find($id);

        if(!($category->user_id == $this->user()->id)) {
          return $this->response->errorUnauthorized('分组不存在!');
        }

        return $this->response->collection($category->cards, new CardTransformer());
    }

    // 新建卡片
    public function create(CardRequest $request, Card $card)
    {
        $user = $this->user();
        if(!$user->categories->find($request->category_id)) {
          return $this->response->errorUnauthorized('分组不存在!');
        }

        $card->front = $request->front;
        $card->behind = $request->behind;
        $card->category_id = $request->category_id;
        $card->user_id = $user->id;
        $card->save();

        return $this->response->item($card, new CardTransformer())->setStatusCode(201);
    }

    // 编辑卡片
    public function edit(CardRequest $request)
    {
        $user = $this->user();
        if(!$card = $user->cards->find($request->card_id))
        {
          return $this->response->errorUnauthorized('卡片不存在!');
        }

        if(!$user->categories->find($request->category_id)) {
          return $this->response->errorUnauthorized('分组不存在!');
        }

        $card->front = $request->front;
        $card->behind = $request->behind;
        $card->category_id = $request->category_id;
        $card->user_id = $user->id;

        $card->save();

        return $this->response->noContent()->setStatusCode(200);
    }

    // 删除卡片
    public function delete($card)
    {
        $user = $this->user();
        if(!$card = $user->cards->find($card))
        {
          return $this->response->errorUnauthorized('卡片不存在!');
        }

        $card->delete();

        return $this->response->noContent()->setStatusCode(200);
    }
}
