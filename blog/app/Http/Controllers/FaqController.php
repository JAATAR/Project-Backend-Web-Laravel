<?php

namespace App\Http\Controllers;
use APP\Models\FaqItems;
use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function showFaqPage()
    {


        $categories = FaqCategory::leftJoin('faq_items', 'faq_categories.categoryId', '=', 'faq_items.categoryId')
            ->select(
                'faq_categories.categoryId',
                'faq_categories.categoryName',
                'faq_items.itemId',
                'faq_items.question',
                'faq_items.answer',

            );


        return view('faq.Faq-page', compact('categories'));

    }


    public function createCategory()
    {


        return view('faq.create-category');
    }


    public function storeCategory(Request $request)
    {

        $request->validate([
            'categoryName' => 'required|string',
        ]);

        $faqCategory = new FaqCategory();
        $faqCategory->categoryName = $request->categoryName;
        $faqCategory->save();


        return redirect()->route('faq.faqPage')->with('success', 'Category was made successfully');

    }

    public function createItem(FaqCategory $category)
    {


        return view('faq.create-item', compact('category'));


    }


    public function storeItem(Request $request, FaqCategory $category)
    {
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);



        $faqItem = new FaqItems();
        $faqItem->categoryId = $category->categoryId;
        $faqItem->question = $request->question;
        $faqItem->answer = $request->answer;
        $faqItem->save();

        return redirect()->route('faq.faqPage')->with('success', 'Question and Answer added successfully');
    }

    public function deleteCategory(FaqCategory $category)
    {
        //first delete the items within the category because of foreign key constraints
        $category->faqItems()->delete();

        //now delete the category
        $category->delete();

        return redirect()->back()->with('success', 'FAQ Category deleted successfully.');

    }


    public function deleteItem(FaqItems $item)
    {

        $item->delete();


        return redirect()->back()->with('success', 'FAQ Item deleted successfully.');

    }

}
