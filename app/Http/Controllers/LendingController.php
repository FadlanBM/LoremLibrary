<?php

namespace App\Http\Controllers;

use App\Models\Lendings;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LendingController extends Controller
{
    public function index()
    {
        $lendings = Lendings::where('status', 'true')->get();
        if ($lendings->isNotEmpty()) {
            $borrower = $lendings->first()->borrower;
        } else {
            $borrower = null;
        }
        return view('pages.employees.AddLendings', ['lendings' => $lendings, 'borrower' => $borrower]);
    }

    public function showvalidasilendings($id)
    {
        $lending = Lendings::where('code', $id)->first();

        if ($lending) {
            if ($lending && $lending->status == 'false') {
                $lending->load('listlending', 'borrower');

                $listBooks = $lending->listlending;

                $borrower = $lending->borrower;

                if ($borrower) {
                    return view('pages.employees.ValidasiLanding', [
                        'listBooks' => $listBooks,
                        'lending' => $lending,
                        'borrower' => $borrower,
                    ]);
                } else {
                    return redirect()->route('lending.index')->with('error', 'Data peminjam tidak ditemukan');
                }
            } else {
                return redirect()->route('lending.index')->with('error', 'Data peminjam sudah active');
            }
        } else {
            return redirect()->route('lending.index')->with('error', 'Peminjaman tidak ditemukan');
        }
    }
    public function showInputvalidasilendings(Request $request)
    {
        $lending = Lendings::where('code', $request->codeadd)->first();

        if ($lending) {
            if ($lending && $lending->status == 'false') {
                $lending->load('listlending', 'borrower');

                $listBooks = $lending->listlending;

                $borrower = $lending->borrower;

                if ($borrower) {
                    return view('pages.employees.ValidasiLanding', [
                        'listBooks' => $listBooks,
                        'lending' => $lending,
                        'borrower' => $borrower,
                    ]);
                } else {
                    return redirect()->route('lending.index')->with('error', 'Data peminjam tidak ditemukan');
                }
            } else {
                return redirect()->route('lending.index')->with('error', 'Data peminjam sudah active');
            }
        } else {
            return redirect()->route('lending.index')->with('error', 'Peminjaman tidak ditemukan');
        }
    }

    public function getlendings($id)
    {
        $lending = Lendings::where('code', $id)->first();   

        if ($lending) {
            $lending->load('listlending', 'borrower');

            $listBooks = $lending->listlending;

            $borrower = $lending->borrower;

            if ($borrower) {
                return view('pages.employees.ShowDataLanding', [
                    'listBooks' => $listBooks,
                    'lending' => $lending,
                    'borrower' => $borrower,
                ]);
            } else {
                return view('pages.employees.AddLendings')->with('error', 'Data peminjam tidak ditemukan');
            }
        } else {
            return view('pages.employees.AddLendings')->with('error', 'Peminjaman tidak ditemukan');
        }
    }

    public function validateLending($id)
    {
        try {
            $lending = Lendings::findOrFail($id);
            $lending->status = 'true';
            $lending->save();
            return redirect()->route('lending.index')->with('success', 'Berhasil validasi peminjam');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal validasi peminjam: ' . $e->getMessage());
        }
    }

    public function returnLending($id)
    {
        $lending = Lendings::where('code', $id)->first();
        if ($lending) {
            if ($lending && $lending->date_last == null) {
                $lending->date_last = Carbon::now()->format('Y-m-d H:i:s');
                $lending->save();
                return redirect()->route('lending.index')->with('success', 'Berhasil Mengembalikan peminjam');
            } else {
                return redirect()->route('lending.index')->with('error', 'Data peminjam sudah dikembalikan');
            }
        } else {
            return redirect()->route('lending.index')->with('error', 'Gagal menemukan data peminjam');
        }
    }

    public function returnInputLending(Request $request)
    {
        $lending = Lendings::where('code', $request->codereturn)->first();
        if ($lending) {
            if ($lending && $lending->date_last == null) {
                $lending->date_last = Carbon::now()->format('Y-m-d H:i:s');
                $lending->save();
                return redirect()->route('lending.index')->with('success', 'Berhasil Mengembalikan peminjam');
            } else {
                return redirect()->route('lending.index')->with('error', 'Data peminjam sudah dikembalikan');
            }
        } else {
            return redirect()->route('lending.index')->with('error', 'Gagal menemukan data peminjam');
        }
    }
}
