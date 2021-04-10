<?php
namespace App\Http\Controllers\Templates;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\AjaxRequestHelper;
use App\Http\Controllers\Helpers\AjaxResponse;
use App\Models\Template;
use Illuminate\Http\Request;

class TemplatesList extends Controller
{

    public function index()
    {

        $templates = Template::all();
        return view('SmsTemplates.templatesList', compact('templates'));
    }



    public function addTemplate(Request $request)
    {

        $params = AjaxRequestHelper::makeArray($request->get('params'));



        if(!array_key_exists('name', $params))
        {
            return AjaxResponse::error('Please provide tamplate name.');
        }

        if(!array_key_exists('content', $params))
        {
            return AjaxResponse::error('Please provide message text');
        }

        try
        {
            Template::create([
                'name'      => $params['name'],
                'content'   => $params['content']
            ]);
            return AjaxResponse::success('Template created successfully.');
        }
        catch(\Throwable $exception)
        {
            return AjaxResponse::error('Something went wrong. Please try again.');
        }



    }
}
