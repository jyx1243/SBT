<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\Location;

class LocationController extends Controller
{
    public function store(Request $request, $optionId)
    {
        $location = new Location;
        $location->option_id = $optionId;
        $location->zone_id = $request->input('zone');
        $location->layer = $request->input('layer');
        $location->col = $request->input('col');
        $location->row = $request->input('row');
        $location->save();

        if ($request->has('defaultLocation')) {
            $option = Option::find($optionId);
            $option->default_location_id = $location->id;
            $option->save();
        }

        return back()->with('status', '位置新增成功');
    }

    public function destroy($optionId, $locationId)
    {
        $location = Location::find($locationId);
        $option = Option::find($optionId);
        if ($option->default_location_id == $location->id) {
            $option->default_location_id = null;
            $option->save();
        }
        $location->delete();

        return back()->with('status', '位置刪除成功');
    }
}
