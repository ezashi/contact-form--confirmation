<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'gender' => ['required'],
            'email' => ['required', 'email', 'max:255'],
            'tel1' => ['required', 'max:5'],
            'tel2' => ['required', 'max:5'],
            'tel3' => ['required', 'max:5'],
            'address' => ['required', 'string', 'max:255'],
            'category_id' => ['required'],
            'detail' => ['required', 'string', 'max:120'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'last_name.required' => '姓を入力してください',
            'first_name.required' => '名を入力してください',
            'gender.required' => '性別を選択してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスはメール形式で入力してください',
            'tel1.required' => '電話番号を入力してください',
            'tel1.max' => '電話番号は5桁までの数字で入力してください',
            'tel2.required' => '電話番号を入力してください',
            'tel2.max' => '電話番号は5桁までの数字で入力してください',
            'tel3.required' => '電話番号を入力してください',
            'tel3.max' => '電話番号は5桁までの数字で入力してください',
            'address.required' => '住所を入力してください',
            'category_id.required' => 'お問い合わせの種類を選択してください',
            'detail.required' => 'お問い合わせ内容を入力してください',
            'detail.max' => 'お問合せ内容は120文字以内で入力してください',
        ];
    }

    // バリデーションの前に実行されるメソッド。
    // 電話番号の各部分を結合して 'tel' フィールドを作成する。
    protected function prepareForValidation()
    {
        $this->merge([
            'tel' => $this->tel1 . $this->tel2 . $this->tel3,
        ]);
    }

    // バリデーション後に追加のバリデーションロジックを実行するメソッド。
    // 電話番号のいずれかの部分にエラーがある場合、'tel' フィールドにエラーメッセージを追加する。
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->has('tel1') || $validator->errors()->has('tel2') || $validator->errors()->has('tel3')) {
                $validator->errors()->add('tel', '電話番号を入力してください');
            }
        });
    }
}