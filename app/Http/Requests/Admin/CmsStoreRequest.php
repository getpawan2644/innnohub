<?php

namespace App\Http\Requests\Admin;

use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Http\FormRequest;
use CommonHelper;

class CmsStoreRequest extends FormRequest
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
//		$trans = [];
//		foreach(CommonHelper::getLanguages() as  $language=>$locale){
//			$trans = $trans + [
//				$locale . '.meta_keyword' => 'nullable',
//                $locale . '.meta_desc' => 'nullable',
//				$locale . '.title' => 'required',
//				//$locale . '.url' => "required|unique:cms_translations,url,{$this->id},cms_id,locale,$locale",
//				$locale . '.url' => "required|unique:cms_translations,url,".$this->{$locale}['id'],
//				$locale . '.content' => 'required',
//			];
//		}
        //dd($this->page_name);
        $rules = [
            'page_type' => 'required',
            'status' => 'nullable',
            'page_name' => 'required|alpha_dash|unique:cms,page_name,'.$this->id,
            '%meta_keyword%' => 'nullable',
            '%meta_desc%' => 'nullable',
            '%title%' => 'required',
            '%url%' => "required|unique:cms_translations,url,{$this->id},cms_id|alpha_dash",
            '%content%' => 'required',
        ];
        return RuleFactory::make($rules);
    }


	public function messages()
    {
		$messages = [];
        $messages1 = ['page_type.required' => 'This is a required field.'];
        $messages1 = ['page_name.alpha_dash' => 'Only underscore and dash allow in this field.'];
		foreach(CommonHelper::getLanguages() as  $language=>$locale){
			$messages = $messages + [
				$locale . '.title.required' => 'Url is a required field',
				$locale . '.url.required' => 'Url is a required field',
				$locale . '.url.unique' => 'This url has already been taken',
				$locale . '.url.alpha_dash' => 'Only underscore and dash allow in URL.',
				$locale . '.content.required' => 'This is a required field',
			];
		}

        return $messages+$messages1;
    }
}
