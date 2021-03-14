@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'quotes'
])

@section('content')
@foreach ($quotes as $inv)

    <div class="content">
        <div class="container">
        @if (session('status'))
    <div class="alert alert-success" role="alert">
    {{ session('status') }}
    </div>
    @endif

    <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" href="{{route('quotes')}}" role="tab" aria-controls="home" aria-selected="true"><b><i class="fa fa-list"></i> Home</b></a>
  </li>
  
  <li class="nav-item">
    <a class="nav-link bg-warning text-white" id="profile-tab" href="{{route('quotes.edit',['id' => $inv->quote_id])}}" role="tab" aria-controls="profile" aria-selected="false"><b><i class="fa fa-edit"></i> Edit Quote</b></a>
  </li>
  
  
</ul>


    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Quotation') }}</div>

                <div class="card-body">
                    <div class="row">

        
                        <div class="col-md-4">
                               
                                        <h5>Client</h5>
                                        
                                        @foreach ($client as $c) 
                                        {{ $c->company }} <br>
                                        {{ $c->address }} <br>
                                        {{ $c->town }} <br>
                                        {{ $c->county }} <br>
                                        {{ $c->postcode }} <br>
                                        {{ $c->country }} <br>
                                        <br>
                                        Tax ID: {{ $c->vat_no }}
                                        <br>
                                        @endforeach
                                        
                                    
                            </div>
                
                        <div class="col-md-4 ">
                               
                                        <h5>Dates</h5>
                                    
                                        <h6>Quote Date: {{ date('d/m/y', strtotime($inv->quote_date)) }}</h6>
                                        <h6>Quote Due: {{ date('d/m/y', strtotime($inv->quote_due)) }}</h6>
                                        <h6>Created On: {{ date('d/m/y H:i', strtotime($inv->created_at)) }}</h6>
                                        <h6>Updated On: {{ date('d/m/y H:i', strtotime($inv->updated_at)) }}</h6>
                                    
                            </div>
                
                            <div class="col-md-4 ">
                              
                                        <h5>Status</h5>
                                        
                                        <h6>{{ $inv->status}}</h6>
                                    
                            </div>
                
                        </div>
                        <br><br>
                
                        <div class="row">
                        <div class="col-md-12 ">
                                
                                        <h5>Quotation Items</h5>
                                    
                
                                        <table class="table">
                                            <thead>
                                        <tr>
                                        <th>Qty</th>
                                        <th>Description</th>
                                        <th>Unit Price</th>
                                        <th>Net Total</th>
                                        <th>Tax </th>
                                        <th>Tax Exempt</th>
                                        <th>Gross Total</th>
                                        </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($quote_lines as $ln)
                                            
                                            <tr>
                                            <td width="100px">{{$ln->qty}}</td>
                                            <td>{{$ln->description}}</td>
                                            <td width="150px">{{$ln->line_price}}</td>
                                            <td width="150px">{{$ln->line_net}}</td>
                                            <td width="150px">{{$ln->line_tax}}</td>
                                            <td width="80px">@if($ln->line_tax_exempt == "on") Yes @else No @endif</td>
                                            <td width="150px">{{$ln->line_total}}</td>
                                            </tr>
                                            
                                            @endforeach
                                            </tbody>
                                        </table>
                                        
                                        
                                   
                            </div>
                
                        </div>
                
                        <br><br>
                
                        <div class="row justify-content-end">
                            <div class="col-md-3 ">
                                
                                        <h5 class="card-title">Totals</h5>
                                        
                                
                                        <h6>Total Net: {{ number_format($inv->net_total,2,',','.')}}&euro;</h6>
                                        <h6>Total Tax: {{ number_format($inv->tax_total,2,',','.')}}&euro;</h6>
                                        <h6>Grand Total: {{ number_format($inv->grand_total,2,',','.')}}&euro;</h6>
                                        
                                    
                            </div>
                        </div>


                </div>
            </div>
        </div>
    </div>
</div>


        

@endforeach
@endsection

