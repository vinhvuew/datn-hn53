<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatAIController extends Controller
{
    public function index()
    {
        return view('client.chatai.index');
    }

    public function send(Request $request)
    {
        $message = $request->input('message');
    
        // Prompt thông minh: phân biệt 2 loại câu hỏi
        $prompt = <<<EOT
    Bạn là trợ lý AI hỗ trợ khách hàng mua sắm. Có 2 loại câu hỏi:
    1. Câu hỏi về sản phẩm trong hệ thống (ví dụ: giày nike màu đỏ dưới 1 triệu)
    2. Câu hỏi ngoài hệ thống (ví dụ: giày nike của nước nào, nên chọn giày gì để chạy bộ...)
    
    👉 Với câu hỏi về sản phẩm trong hệ thống, hãy trả về JSON thuần theo định dạng:
    {
      "type": "product_search",
      "product_name": "Tên sản phẩm hoặc rỗng",
      "color": "Màu sắc hoặc rỗng",
      "size": "Kích thước hoặc rỗng",
      "min_price": số nguyên hoặc null,
      "max_price": số nguyên hoặc null
    }
    
    👉 Với các câu hỏi ngoài hệ thống, hãy trả về định dạng:
    {
      "type": "general_question",
      "answer": "Trả lời câu hỏi tự nhiên tại đây"
    }
    
    Chỉ trả về đúng định dạng JSON như trên, không thêm bất kỳ nội dung nào khác.
    
    Câu hỏi: "$message"
    EOT;
    
        $apiKey = env('GEMINI_API_KEY');
        $url = "https://generativelanguage.googleapis.com/v1/models/gemini-1.5-pro:generateContent?key={$apiKey}";
    
        $res = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post($url, [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $prompt]
                    ]
                ]
            ]
        ]);
    
        if (!$res->successful()) {
            return response()->json([
                'reply' => '❌ Lỗi gọi AI',
                'status' => $res->status(),
                'error_message' => $res->body()
            ]);
        }
    
        $dataText = $res->json()['candidates'][0]['content']['parts'][0]['text'] ?? '';
        $dataText = trim(preg_replace('/^```json|```$/m', '', $dataText));
    
        try {
            $parsed = json_decode($dataText, true, 512, JSON_THROW_ON_ERROR);
        } catch (\Throwable $e) {
            Log::error('Không thể parse JSON từ AI: ' . $dataText);
            return response()->json(['reply' => '❌ AI không hiểu yêu cầu.']);
        }
    
        // Nếu là câu hỏi kiến thức ngoài hệ thống
        if (($parsed['type'] ?? '') === 'general_question') {
            return response()->json(['reply' => '💬 ' . nl2br(e($parsed['answer']))]);
        }
    
        // Nếu là tìm kiếm sản phẩm
        if (($parsed['type'] ?? '') !== 'product_search') {
            return response()->json(['reply' => '❌ Câu hỏi không hợp lệ.']);
        }
    
        // Tìm sản phẩm trong DB
        $query = Product::with(['variants.attributes.attributeValue'])->where('is_active', 1);
    
        if (!empty($parsed['product_name'])) {
            $query->where('name', 'like', '%' . $parsed['product_name'] . '%');
        }
    
        if (!empty($parsed['min_price'])) {
            $query->where(function ($q) use ($parsed) {
                $q->where('base_price', '>=', $parsed['min_price'])
                  ->orWhere('price_sale', '>=', $parsed['min_price']);
            });
        }
    
        if (!empty($parsed['max_price'])) {
            $query->where(function ($q) use ($parsed) {
                $q->where('base_price', '<=', $parsed['max_price'])
                  ->orWhere('price_sale', '<=', $parsed['max_price']);
            });
        }
    
        $products = $query->get();
    
        // Lọc theo màu và size
        if (!empty($parsed['color']) || !empty($parsed['size'])) {
            $products = $products->filter(function ($product) use ($parsed) {
                return $product->variants->contains(function ($variant) use ($parsed) {
                    $values = $variant->attributes->map(function ($attr) {
                        return strtolower($attr->attributeValue->value);
                    })->toArray();
    
                    $matchColor = empty($parsed['color']) || collect($values)->contains(strtolower($parsed['color']));
                    $matchSize = empty($parsed['size']) || collect($values)->contains(strtolower($parsed['size']));
    
                    return $matchColor && $matchSize;
                });
            });
        }
    
        if ($products->isEmpty()) {
            return response()->json(['reply' => '❌ Không tìm thấy sản phẩm phù hợp.']);
        }
    
        // Tạo HTML trả về
        $html = "<div><b>🎯 Kết quả:</b></div>";
        foreach ($products as $p) {
            $price = $p->price_sale ?? $p->base_price;
            $imageUrl = asset('storage/' . $p->img_thumbnail);
            $productUrl = url('/product/' . $p->slug);
    
            $html .= "
            <div class='product-card' style='border:1px solid #ddd; padding:10px; margin:10px 0; border-radius:5px; color: black;'>
                <img src='{$imageUrl}' width='100' style='border-radius:5px;'><br>
                <b>{$p->name}</b><br>
                <span>Giá: " . number_format($price, 0, ',', '.') . "đ</span><br>
                <span>{$p->description}</span><br>
                <a href='{$productUrl}' class='btn' style='background:#007bff; color:white; padding:4px 8px; text-decoration:none; border-radius:4px;'>Xem chi tiết</a>
            </div>";
        }
    
        return response()->json(['reply' => $html]);
    }
    
}
