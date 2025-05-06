<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Location;
use App\Models\ShopLogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SellerUserProfileController extends Controller
{
    public function update(Request $request, Shop $shop)
{
    try {
        $shop = Shop::with(['user', 'location'])
            ->where('manage_id', auth()->id())
            ->firstOrFail();

            $request->validate([
                'shop_name' => 'nullable|string|max:255', // shop_name is not required
                'shop_description' => 'nullable|string', // shop_description is nullable
                'shop_logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // shop_logo is nullable
                'first_name' => 'required|string|max:255', // first_name is required
                'last_name' => 'required|string|max:255', // last_name is required
                'email' => 'required|email', // email is required
                'phone_number' => 'required|string|max:20', // phone_number is required
                'region' => 'nullable|string', // region is required
                'province' => 'nullable|string', // province is required
                'city' => 'nullable|string', // city is required
                'barangay' => 'nullable|string', // barangay is required
                'street' => 'nullable|string', // street is nullable
                'current_password' => 'nullable|string', // current_password is nullable
                'new_password' => 'nullable|string|min:8|confirmed', // new_password is nullable
            ]);
            

        // ✅ Update or Replace Shop Logo
        if ($request->hasFile('shop_logo')) {
            // Delete old logo image if exists
            if ($shop->shopLogo && $shop->shopLogo->logo_path) {
                Storage::delete('public/' . $shop->shopLogo->logo_path); // Delete old logo from storage
            }

            // Store the new logo image
            $path = $request->file('shop_logo')->store('shop_logos', 'public'); // Store in the 'shop_logos' folder

            // If shop logo already exists, update it, otherwise create a new ShopLogo record
            if ($shop->shopLogo) {
                $shop->shopLogo->update([
                    'logo_path' => $path
                ]);
            } else {
                $logo = new ShopLogo();
                $logo->logo_path = $path;
                $logo->save();

                // Associate the new logo with the shop
                $shop->shop_logo_id = $logo->id;
            }
        }

        // ✅ Update existing Location
        if ($shop->location) {
            $shop->location->update([
                'region' => $request->region,
                'province' => $request->province,
                'city' => $request->city,
                'barangay' => $request->barangay,
                'street' => $request->street,
                'latitude' => $request->latitude ?? 0,
                'longitude' => $request->longitude ?? 0,
            ]);
        }

        // ✅ Update Shop main fields
        $shop->update([
            'shop_name' => $request->shop_name,
            'shop_description' => $request->shop_description,
        ]);

        // ✅ Update Manager Info
        $user = $shop->user;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;

        // ✅ Handle Password Change
        if ($request->filled('current_password') && $request->filled('new_password')) {
            if (Hash::check($request->current_password, $user->password)) {
                $user->password = Hash::make($request->new_password);
            } else {
                return back()->withErrors(['current_password' => 'Current password is incorrect']);
            }
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully.');

    } catch (ModelNotFoundException $e) {
        \Log::error('Model not found: ' . $e->getMessage());
        return back()->with('error', 'Requested data not found.');
    } catch (\Exception $e) {
        \Log::error('Update failed: ' . $e->getMessage());
        return back()->with('error', 'Something went wrong.');
    }
}


}
