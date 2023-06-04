<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\ShipRegion;
use App\Models\ShipVille;
use App\Models\ShipQuartier;

class ShippingAreaController extends Controller
{
    public function AllRegion()
    {
        $region = ShipRegion::latest()->get();
        return view('backend.ship.region.region_all', compact('region'));
    } // End Method

    public function AddRegion()
    {

        return view('backend.ship.region.region_add');
    } // End Method

    public function StoreRegion(Request $request)
    {

        ShipRegion::insert([
            'region_name' => strtoupper($request->region_name),

        ]);

        $notification = array(
            'message' => 'ShipRegion Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.region')->with($notification);

    } // End Method

    public function EditRegion($id)
    {

        $region = ShipRegion::findOrFail($id);
        return view('backend.ship.region.region_edit', compact('region'));

    } // End Method

    public function UpdateRegion(Request $request)
    {

        $region_id = $request->id;

        ShipRegion::findOrFail($region_id)->update([
            'region_name' => $request->region_name,

        ]);

        $notification = array(
            'message' => 'ShipRegion Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.region')->with($notification);


    } // End Method

    public function DeleteRegion($id)
    {

        ShipRegion::findOrFail($id)->delete();

        $notification = array(
            'message' => 'ShipRegion Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


    } // End Method

    //////////// Ville VRUD /////////////

    public function AllVille()
    {
        $ville = ShipVille::latest()->get();
        // Passing ville in our ville_all file by the compact method
        return view('backend.ship.ville.ville_all', compact('ville'));
    } // End Method

    public function AddVille()
    {

        $region = ShipRegion::orderBy('region_name', 'ASC')->get();
        return view('backend.ship.ville.ville_add', compact('region'));
    } // End Method

    public function StoreVille(Request $request)
    {

        ShipVille::insert([
            'region_id' => $request->region_id,
            'ville_name' => $request->ville_name,

        ]);

        $notification = array(
            'message' => 'ShipVille Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.ville')->with($notification);

    } // End Method

    public function EditVille($id)
    {
        $region = ShipRegion::orderBy('region_name', 'ASC')->get();

        $ville = ShipVille::findOrFail($id);
        return view('backend.ship.ville.ville_edit', compact('ville', 'region'));

    } // End Method

    public function UpdateVille(Request $request)
    {

        $ville_id = $request->id;

        ShipVille::findOrFail($ville_id)->update([
            'region_id' => $request->region_id,
            'ville_name' => $request->ville_name,

        ]);

        $notification = array(
            'message' => 'ShipVille Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.ville')->with($notification);


    } // End Method

    public function DeleteVille($id)
    {

        ShipVille::findOrFail($id)->delete();

        $notification = array(
            'message' => 'ShipVille Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Method

    //////////// Quartier VRUD /////////////

    public function AllQuartier()
    {
        $quartier = ShipQuartier::latest()->get();
        // Passing quartier in our quartier_all file by the compact method
        return view('backend.ship.quartier.quartier_all', compact('quartier'));
    } // End Method

    public function AddQuartier()
    {
        $region = ShipRegion::orderBy('region_name', 'ASC')->get();
        $ville = ShipVille::orderBy('ville_name', 'ASC')->get();
        return view('backend.ship.quartier.quartier_add', compact('region', 'ville'));
    } // End Method

    public function GetVille($region_id)
    {
        $dist = ShipVille::where('region_id', $region_id)->orderBy('ville_name', 'ASC')->get();
        return json_encode($dist);

    } // End Method

    public function StoreQuartier(Request $request)
    {

        ShipQuartier::insert([
            'region_id' => $request->region_id,
            'ville_id' => $request->ville_id,
            'quartier_name' => $request->quartier_name,
        ]);

        $notification = array(
            'message' => 'ShipQuartier Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.quartier')->with($notification);

    } // End Method

    public function EditQuartier($id)
    {
        $region = ShipRegion::orderBy('region_name', 'ASC')->get();
        $ville = ShipVille::orderBy('ville_name', 'ASC')->get();
        $quartier = ShipQuartier::findOrFail($id);
        return view('backend.ship.quartier.quartier_edit', compact('region', 'ville', 'quartier'));
    } // End Method

    public function UpdateQuartier(Request $request)
    {

        $quartier_id = $request->id;

        ShipQuartier::findOrFail($quartier_id)->update([
            'region_id' => $request->region_id,
            'ville_id' => $request->ville_id,
            'quartier_name' => $request->quartier_name,
        ]);

        $notification = array(
            'message' => 'ShipQuartier Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.quartier')->with($notification);


    } // End Method

    public function DeleteQuartier($id)
    {

        ShipQuartier::findOrFail($id)->delete();

        $notification = array(
            'message' => 'ShipQuartier Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


    } // End Method




}
