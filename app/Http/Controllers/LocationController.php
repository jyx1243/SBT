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
        $location->zone_id = $request->input('newZone');
        $location->layer = $request->input('newLayer');
        $location->col = $request->input('newCol');
        $location->row = $request->input('newRow');
        $location->save();

        if ($request->has('newDefaultLocation')) {
            $option = Option::find($optionId);
            $option->default_location_id = $location->id;
            $option->save();
        }

        return redirect()->route('product.edit', $optionId);
    }

    public function destroy($optionId, $locationId)
    {
        $location = Location::find($locationId);
        if ($location->option->default_location_id == $locationId) {
            $location->option->default_location_id = null;
            $location->option->save();
        }
        $location->delete();

        return redirect()->route('product.edit', $optionId);
    }
}
