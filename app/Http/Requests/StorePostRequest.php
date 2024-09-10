<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
                'name' => 'required|string|max:255',
                'location' => 'nullable|string|max:255',
                'is_approved' => 'required|boolean',
                'category_id' => 'required|string|exists:categories,_id',
                'content' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Tên bài viết là bắt buộc.',
            'name.string' => 'Tên bài viết phải là một chuỗi văn bản.',
            'name.max' => 'Tên bài viết không được vượt quá 255 ký tự.',
            'location.string' => 'Vị trí phải là một chuỗi văn bản.',
            'location.max' => 'Vị trí không được vượt quá 255 ký tự.',
            'is_approved.required' => 'Trạng thái phê duyệt là bắt buộc.',
            'is_approved.boolean' => 'Trạng thái phê duyệt phải là đúng hoặc sai.',
            'category_id.required' => 'Danh mục bài viết là bắt buộc.',
            'category_id.string' => 'Danh mục bài viết phải là một chuỗi văn bản.',
            'category_id.exists' => 'Danh mục bài viết không tồn tại.',
            'content.required' => 'Nội dung bài viết là bắt buộc.',
            'content.string' => 'Nội dung bài viết phải là một chuỗi văn bản.',
            'image.image' => 'Ảnh phải là một hình ảnh.',
            'image.mimes' => 'Ảnh phải có định dạng jpeg, png, jpg hoặc gif.',
            'image.max' => 'Ảnh không được vượt quá 2MB.',
            'images.*.image' => 'Mỗi ảnh phải là một hình ảnh.',
           
           
        ];
    }
}
