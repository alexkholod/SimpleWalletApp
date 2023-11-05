<?php

namespace App\Http\Controllers;

use App\Models\Wallet;

class WalletController extends Controller
{
    public function allWallets()
    {
        return view('wallets', ['data' => Wallet::all()]);
    }
}
