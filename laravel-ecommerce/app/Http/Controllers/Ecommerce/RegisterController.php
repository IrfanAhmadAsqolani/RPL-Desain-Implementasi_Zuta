<?php

namespace App\Http\Controllers\Ecommerce;
// menginput beberapa plugin dan controller yang diperlukan
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
use App\Province;
use App\Mail\CustomerRegisterMail;
use Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    // deklarasi fungsi registerForm
    public function registerForm()
    {
        // if condition untuk route dashboard yg mengharuskan pengguna sudah terautentikasi dengan menggunakan guard()
        if (auth()->guard('customer')->check()) return redirect(route('customer.dashboard'));

        $provinces = Province::orderBy('created_at', 'DESC')->get();
        return view('ecommerce.register', compact('provinces'));
    }


    public function register(Request $request){
        // deklarasi variable dan tipe data yang digunakan
        $this->validate($request, [ // pada bagian ini request divalidasi terlebih dahulu sudah sesuai dengan type datanya atau tidak
            'customer_name' => 'required|string|max:100',
            'customer_phone' => 'required',
            'email' => 'required|email',
            'customer_address' => 'required|string',
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:cities,id',
            'district_id' => 'required|exists:districts,id'
        ]);

        // create user 
        try {
            if (!auth()->guard('customer')->check()) {
                $password = Str::random(8); 
                $customer = Customer::create([
                    'name' => $request->customer_name,
                    'email' => $request->email,
                    'password' => $password, 
                    'phone_number' => $request->customer_phone,
                    'address' => $request->customer_address,
                    'district_id' => $request->district_id,
                    'activate_token' => Str::random(30),
                    'status' => false
                ]);
            }

            if (!auth()->guard('customer')->check()) {
                Mail::to($request->email)->send(new CustomerRegisterMail($customer, $password));
            }
            // jika berhasil terkirim ke server, maka akan mengembalikan output seperti berikut
            return redirect()->back()->with(['success' => 'Registrasi Member Berhasil']);

        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
