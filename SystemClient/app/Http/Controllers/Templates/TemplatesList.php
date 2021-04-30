<?php
namespace App\Http\Controllers\Templates;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\HttpResponse;
use App\Http\Controllers\Helpers\TemplateVariables;
use App\Models\Template;
use Illuminate\Http\Request;

class TemplatesList extends Controller
{

    public function index()
    {

        $templates = Template::get();
        $variables = TemplateVariables::VARIABLES;

        return view('SmsTemplates.templatesList', compact('templates', 'variables'));
    }



    public function addTemplate(Request $request)
    {

        if(!array_key_exists('name', $request->all()))
        {
            $message = 'Please provide tamplate name.';
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }

        if(!array_key_exists('content', $request->all()))
        {
            $message = 'Please provide message text';
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }

        try
        {
            Template::create([
                'name'      => $request->all()['name'],
                'content'   => $request->all()['content']
            ]);
            $message = 'Template created successfully.';
            $response = HttpResponse::success($message);
            return back()->with(['message' => $response]);
        }
        catch(\Throwable $exception)
        {
            $message = 'Something went wrong. Please try again.';
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }
    }

    public function editTemplate(Request $request)
    {
        try
        {
            Template::where('id', $request->get('id'))->update(
                [
                    'name' => $request->get('name'),
                    'content' => $request->get('content')
                ]
            );
            $message = 'Template updated successfully.';
            $response = HttpResponse::success($message);
            return back()->with(['message' => $response]);
        }
        catch (\Throwable $exception)
        {
            $message = 'Something went wrong. Please try again.';
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }

    }

    public function deleteTemplate(Request $request)
    {

        $name = $request->get('templateName');

        try
        {
            Template::where('name', $name)->delete();

            $message = 'Template successfully deleted.';
            $response = HttpResponse::success($message);
            return back()->with(['message' => $response]);
        }
        catch (\Throwable $exception)
        {
            $message = "Couldn't delete template.";
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }
    }
}
