<?php

namespace App\Http\Controllers;
use APP\Models\FaqItems;
use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqController extends Controller
{
public function faq_page()
{

    return view('faq.faq_page');
}
public function add_category(Request $request)
{
    $user = Auth()->user();

$faq_category = new FaqCategory();
$faq_category -> title = $request->title;
$faq_category ->question = $request->question;
$faq_category->answer = $request->answer;

$faq_category  ->save();
return redirect()->back()->with('message','Category saved successfully');

}
public function show_faq()
{
$faq_category = FaqCategory::all();


return view('faq.show_faq',compact('faq_category'));
}

public function delete_faq($id)
{

    $faq_category = FaqCategory::find($id);
    $faq_category->delete();
    return redirect()->back()->with('message', 'FAQ item deleted successfully');
}
public function edit_faq($id)
{
$faq_category = FaqCategory::find($id);
return view('faq.edit_faq',compact('faq_category'));

}
public function update_faq(Request $request,$id)
{
$data = FaqCategory::find($id);
$data ->title = $request->title;
$data ->question = $request->question;
$data->answer = $request->answer;

$data->save();

return redirect()->back()->with('message','FAQ successfully updated');

}


}
