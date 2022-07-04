<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DB;
use Auth;
use App\Helpers\Helper as Helper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use App\Visio_installed;
use App\trouble;


class TroubleController extends Controller
{

    public function index()
    {
        $troubles = trouble::all();


        return view('tbs.index', compact(['troubles']));
    }

    public function create()
    {

        $troubles = trouble::all();

        $troubles = DB::table('troubles')
            ->select('id', 'troubles.id')
            ->get();

        return view('/create', compact(['troubles']));

    }

    public function store(Request $request)
    {
        $troubles = trouble::all();

        $request->validate([


            'department' =>'required',
            'problem'  => 'required',
            'solution'  => 'required',
            'request_by'  => 'required',
            'assist_by' => 'required',
        ]);

        $troubles = new trouble([
            /** 'id' => $request->get('id'),**/
            'department' => $request->get('department'),
            'problem' => $request->get('problem'),
            'solution' => $request->get('solution'),
            'request_by' => $request->get('request_by'),
            'assist_by' => $request->get('assist_by')
        ]);

        $troubles->save();

        return view('/create', compact(['troubles']));


    }

    public function show($id)
    {
        //
    }

    public function edit ($id)
    {


        $trouble = DB::table('troubles')
            ->where('troubles.id', '=', $id)
            ->get();

        return view('tbs/edit', compact(['trouble']));
    }




    public function update(Request $request, $id)
    {
        $request->validate([
            'department'=>'required',
            'problem'=>'required',
            'solution'=>'required',
            'request_by'=>'required',
            'assist_by'=>'required'
        ]);


        $troubles = trouble::find($id);

        $troubles->department = $request->get('department');
        $troubles->problem = $request->get('problem');
        $troubles->solution = $request->get('solution');
        $troubles->request_by = $request->get('request_by');
        $troubles->assist_by = Auth::user()->username;
        $troubles->save();


        // DB::table('logs')->insert(
        //   ['user_id' => Auth::user()->id,'form' => 'Update Troubleshooting Details','query' => $trouble,'created_at'=>now()]
        // );


        return view('/index', compact(['troubles']));
    }

    public function details ($id)
    {
        $trouble = DB::table('troubles')
            ->where('troubles.id', '=', $id)
            ->get();

        return view('tbs/details', compact(['trouble']));
    }

    public function destroy($id)
    {

        // $troubles = DB::find($id);
        // $troubles->delete();

        DB::destroy('delete from troubles where id = ?', [$id]);
        // Session::flash('message', 'Successfully Deleted Trouble Log!');
        return view('/index', compact(['troubles']));


    }


    public function search(Request $request)
    {
        // Get the search value from the request
        $search = $request->input('search');

        $trouble = Trouble::query()
            ->where('problem', 'LIKE', "%{$search}%")
            ->orWhere('solution', 'LIKE', "%{$search}%")
            ->get();

        // Return the search view with the resluts compacted
        // return view('search', compact('troubles'));
    }

}
