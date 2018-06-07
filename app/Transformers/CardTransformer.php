<?php

namespace App\Transformers;

use App\Models\Card;
use League\Fractal\TransformerAbstract;

class CardTransformer extends TransformerAbstract
{
    public function transform(Card $card)
    {
        return [
          'id' => $card->id,
          'front' => $card->front,
          'behind' => $card->behind,
        ];
    }
}
