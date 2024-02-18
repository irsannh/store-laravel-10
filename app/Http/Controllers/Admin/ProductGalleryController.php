<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\ProductGallery;
use App\Models\Product;

use App\Http\Requests\Admin\ProductGalleryRequest;

use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ProductGalleryController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query = ProductGallery::with(['product']);

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" 
                                    type="button" id="action' .  $item->id . '"
                                        data-toggle="dropdown" 
                                        aria-haspopup="true"
                                        aria-expanded="false">
                                        Aksi
                                </button>
                                <div class="dropdown-menu" aria-labelledby="action' .  $item->id . '">
                                    <form action="' . route('product-gallery.destroy', $item->id) . '" method="POST">
                                        ' . method_field('delete') . csrf_field() . '
                                        <button type="submit" class="dropdown-item text-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                    </div>';
                })
                ->editColumn('photo', function ($item) {
                    return $item->photo ? '<img src="' . Storage::url($item->photo) . '" style="max-height: 80px;"/>' : '';
                })
                ->rawColumns(['action','photo'])
                ->make();
        }

        return view('pages.admin.product-gallery.index');
    }

    public function create()
    {
        $products = Product::all();
        
        return view('pages.admin.product-gallery.create',[
            'products' => $products
        ]);
    }

    public function store(ProductGalleryRequest $request)
    {
        $data = $request->all();

        $data['photo'] = $request->file('photo')->store('assets/product', 'public');

        ProductGallery::create($data);

        return redirect()->route('product-gallery.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function update(ProductGalleryRequest $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $item = ProductGallery::findorFail($id);
        $item->delete();

        return redirect()->route('product-gallery.index');

    }
}