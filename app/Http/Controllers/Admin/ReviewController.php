<?php

namespace App\Http\Controllers\Admin;

use App\Branch;
use App\Http\Controllers\Controller;
use App\Review;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ReviewController extends Controller
{

    public function index()
    {

        if (!Gate::denies('review_access')) {

            $review = Review::with(['user:id,name', 'branch:id,name'])->orderBy('id', "desc")->get();

        } elseif (!Gate::denies('branch_review_access')) {
            $master = Branch::all();
            $branch = array();
            foreach ($master as $value) {
                if (is_array($value['manager']) && in_array(Auth::id(), $value['manager'])) {
                    array_push($branch, $value['id']);
                }
            }

            $review = Review::with(['user:id,name', 'branch:id,name'])->whereIn('branch_id', $branch)->orderBy('id', "desc")->get();
        } else {

            abort_if(true, Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        return view('admin.review.index', compact('review'));
    }
    public function delete(Review $id)
    {
        $id->delete();
        return back()->withStatus(__('Review deleted successfully.'));

    }
    public function store(Request $request)
    {

        $request->validate([
            'branch_id' => 'bail|required',
            'booking_id' => 'bail|required',
            'star' => 'bail|required|numeric|min:1|max:5',
        ]);
        $reqData = $request->all();
        $reqData['user_id'] = Auth::user()->id;
        Review::create($reqData);
        return response()->json(['msg' => 'Thanks for review', 'data' => null, 'success' => true], 200);
    }
}
