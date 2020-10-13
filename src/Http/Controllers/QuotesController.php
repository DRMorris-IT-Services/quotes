<?php

namespace duncanrmorris\quotes\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

use duncanrmorris\quotes\App\quotes;
use duncanrmorris\quotes\App\quotes_lines;
use duncanrmorris\quotes\App\clients;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PDF;

class QuotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(quotes $quotes)
    {
        //

        $client = clients::join('quotes::quotes','clients.client_id', '=', 'quotes.client_id')
        ->select('clients.company','quote_id','quotes.client_id')->get();

       return view('quotes::quotes',['quotes' => $quotes->orderby('quote_date','DESC')->paginate(15), 'client' => $client]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $today = date('Y-m-d');
        $due = date('Y-m-d', strtotime($today. ' + 30 days'));
        $quote_id = Str::random(60);
        
        quotes::create([
            'quote_id' => $quote_id,
            'quote_date' => $today,
            'quote_due' => $due,
            'status' => "Pending Review",
        ]);

        quotes_lines::create([
            'quote_id' => $quote_id,
        ]);

        return redirect("quotes/edit/$quote_id");
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
     * @param  \App\quotes  $quotes
     * @return \Illuminate\Http\Response
     */
    public function show(quotes $quotes, quotes_lines $quotes_lines, clients $clients, $id)
    {
        //
        $client = clients::join('quotes','clients.client_id', '=', 'quotes.client_id')
        ->where('quote_id',$id)->get();
        
        return view('quotes::view', ['quotes' => $quotes->where('quote_id',$id)->get(), 'quote_lines' => $quotes_lines->where('quote_id',$id)->get(), 'id' => $id, 'clients' => $clients->orderby('company','asc')->get(), 'client' => $client]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\quotes  $quotes
     * @return \Illuminate\Http\Response
     */
    public function edit(quotes $quotes, quotes_lines $quotes_lines, clients $clients, $id)
    {
        //

        $client = clients::join('quotes','clients.client_id', '=', 'quotes.client_id')
        ->select('clients.company','clients.client_id')->where('quote_id',$id)->get();

        $total_net = quotes_lines::where('quote_id', $id)->sum('line_net');
        $total_tax = quotes_lines::where('quote_id', $id)->sum('line_tax');
        $grand_total = quotes_lines::where('quote_id', $id)->sum('line_total');

        
        return view('quotes::edit', ['quotes' => $quotes->where('quote_id',$id)->get(), 'quote_lines' => $quotes_lines->where('quote_id',$id)->get(),
        'total_net' => $total_net, 'total_tax' => $total_tax, 'grand_total' => $grand_total, 'clients' => $clients->orderby('company','asc')->get(), 'client' => $client]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\quotes  $quotes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, quotes $quotes, $id)
    {
        //

        quotes::where('quote_id',$id)
            ->update([
            'client_id' => $request['client'],
            'quote_date' => $request['quote_date'],
            'quote_due' => $request['due_date'],
            'status' => $request['status'],
            
            ]);

            return back()->withStatus(__('Quotation successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\quotes  $quotes
     * @return \Illuminate\Http\Response
     */
    public function destroy(quotes $quotes, quotes_lines $quotes_lines, $id)
    {
        //

        quotes::where('quote_id',$id)
        ->delete();

        quotes_lines::where('quote_id',$id)
        ->delete();

        return back()->withdelete(__('Quotation successfully removed.'));
    }

    public function downloadPDF($id) {
        //$show = invoices::where('invoice_id',$id)->get();

        $show = clients::join('quotes','clients.client_id', '=', 'quotes.client_id')->where('quote_id',$id)->get();
        $lines = quotes_lines::where('quote_id',$id)->get();
        $name = $show[0]['company'];
        $inv_date = $show[0]['quote_date'];

       $pdf = PDF::loadView('quotes::pdf', ['quotes' => $show, 'lines' => $lines]);
        
       return $pdf->download("quotation $name $inv_date.pdf");

      // return view('invoices.pdf',['invoice' => $show, 'lines' => $lines]);

    }
}
