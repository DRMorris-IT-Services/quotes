<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

use App\quotes;
use App\quotes_lines;
use Illuminate\Http\Request;

class QuotesLinesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        quotes_lines::create([
            'quote_id' => $id,
        ]);

        return back()->withstatus(__('Quotation Line successfully added.'));
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\quotes_lines  $quotes_lines
     * @return \Illuminate\Http\Response
     */
    public function show(quotes_lines $quotes_lines)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\quotes_lines  $quotes_lines
     * @return \Illuminate\Http\Response
     */
    public function edit(quotes_lines $quotes_lines)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\quotes_lines  $quotes_lines
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, quotes_lines $quotes_lines, $id, $iid)
    {
        //

        $qty =  $request['qty'];
        $price = $request['price'];

        $net = $qty * $price;
        if($request['no-tax'] == "on")
        {
            $tax = 0;
        }else{
        $tax = $net * 0.19;
        }
        $total = $net + $tax;

        quotes_lines::where('id',$id)
            ->update([
            'qty' => $request['qty'],
            'description' => $request['description'],
            'line_price' => $request['price'],
            'line_net' => $net,
            'line_tax' => $tax,
            'line_tax_exempt' => $request['no-tax'],
            'line_total' => $total,
            
            ]);

            $total_net = quotes_lines::where('quote_id', $iid)->sum('line_net');
            $total_tax = quotes_lines::where('quote_id', $iid)->sum('line_tax');
            $grand_total = quotes_lines::where('quote_id', $iid)->sum('line_total');

            quotes::where('quote_id',$iid)
            ->update([
            'net_total' => $total_net,
            'tax_total' => $total_tax,
            'grand_total' => $grand_total,
            ]);

            return back()->withStatus(__('Quotation Line successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\quotes_lines  $quotes_lines
     * @return \Illuminate\Http\Response
     */
    public function destroy(quotes_lines $quotes_lines, $id)
    {
        //
        quotes_lines::where('id',$id)
        ->delete();

        return back()->withdelete(__('Quotation Line successfully removed.'));
    }
}
