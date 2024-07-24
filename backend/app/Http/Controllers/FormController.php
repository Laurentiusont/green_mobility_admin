<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Revolution\Google\Sheets\Facades\Sheets;
use Yajra\DataTables\Facades\DataTables;

class FormController extends Controller
{
    public function result($guid)
    {
        $data = Form::where('guid', '=', $guid)->first();
        $values = Sheets::spreadsheet($data->url_spreadsheet)->sheet('Sheet1')->get();
        $headers = $values->pull(0);
        $collection = Sheets::collection($headers, $values);
        $data = array_values($collection->toArray());
        $dataTable = DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
        return ResponseController::getResponse($data, 200, 'Success');
    }
    public function insertData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'description' => 'required|string',
            'url_form' => 'required|string',
            'url_spreadsheet' => 'nullable|string',
            'category' => 'required',
        ], MessagesController::messages());

        if ($validator->fails()) {
            return ResponseController::getResponse(null, 422, $validator->errors()->first());
        }
        $data = Form::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'url_form' => $request['url_form'],
            'url_spreadsheet' => $request['url_spreadsheet'],
            'user_guid' => auth('api')->user()->guid,
            'category' => $request['category'],
        ]);

        return ResponseController::getResponse($data, 200, 'Success');
    }

    public function showData()
    {
        $data = Form::with('user_form')->get();
        if (!isset($data)) {
            return ResponseController::getResponse(null, 400, "Data not found");
        }
        $dataTable = DataTables::of($data)
            ->addIndexColumn()
            ->make(true);

        return $dataTable;
    }

    public function getData($guid)
    {
        $data = Form::where('guid', '=', $guid)->with('user_form')->first();
        return ResponseController::getResponse($data, 200, 'Success');
    }
    public function updateData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'guid' => 'required|string|max:36',
            'name' => 'required|string|max:100',
            'description' => 'required|string',
            'url_form' => 'required|string',
            'url_spreadsheet' => 'nullable|string',
            'category' => 'required',
        ], MessagesController::messages());

        if ($validator->fails()) {
            return ResponseController::getResponse(null, 422, $validator->errors()->first());
        }

        $data = Form::where('guid', '=', $request['guid'])->first();

        if (!isset($data)) {
            return ResponseController::getResponse(null, 400, "Data not found");
        }
        /// UPDATE DATA
        $data->name = $request['name'];
        $data->description = $request['description'];
        $data->url_form = $request['url_form'];
        $data->url_spreadsheet = $request['url_spreadsheet'];
        $data->category = $request['category'];
        $data->save();

        return ResponseController::getResponse($data, 200, 'Success');
    }
    public function deleteData($guid)
    {
        $data = Form::where('guid', '=', $guid)->first();

        if (!isset($data)) {
            return ResponseController::getResponse(null, 400, "Data not found");
        }

        $data->delete();

        return ResponseController::getResponse(null, 200, 'Success');
    }
}
