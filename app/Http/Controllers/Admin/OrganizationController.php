<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Models\Org;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $organizations = Org::orderBy('id','desc')->get()->paginate(5);
        $organizations = Org::orderBy('id','desc')->get();//->paginate(5);

        return view('organizations.index', compact('organizations'));

        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('organizations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|unique:organizations,name',
        ],[
            'name'=>'The Organization Name is required',
            'name.unique'=>'The name has already been taken.'
        ]);
        
        Org::create($request->post());

        return redirect()->route('organizations.index')->with('success','Organization has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Organizations  $organizations
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $organization = Org::find($id);
        return view('organizations.show',compact('organization'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Organizations  $organizations
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $organization = Org::find($id);
        return view('organizations.edit',compact('organization'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Organizations  $organizations
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
        ],[
            'name'=>'The Organization Name is required'
        ]);

        $organizations = Org::find($id);
        
        $organizations->fill($request->post())->save();

        return redirect()->route('organizations.index')->with('success','Organization Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Organizations  $organizations
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = Org::where('id',$id)->delete();
        return redirect()->route('organizations.index')->with('success','Organization has been deleted successfully');
    }

    public function getOrganizations(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = Org::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Org::select('count(*) as allcount')->where('name', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = Org::orderBy($columnName,$columnSortOrder)
            ->where('name', 'like', '%' .$searchValue . '%')
            ->select('*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();
        $sno = $start+1;
        foreach($records as $record){
            $id = $record->id;
            $name = $record->name;
            $editLink = route("organizations.edit",$record->id);
            $deleteLink = route("organizations.destroy", $record->id);
            $action = "<a class='btn btn-primary' href=".$editLink.">Edit</a> &nbsp; <a class='btn btn-danger' onclick=\"return confirm('Are you sure?')\" href=".$deleteLink.">Delete</a>";

            $data_arr[] = array(
                "id" => $id,
                "name" => $name,
                "action"    => $action
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        ); 

        echo json_encode($response);
        exit;
    }
}
