@extends('layouts.app')

@section('content')
@foreach ($quotes as $inv)

    <div class="content">
        <div class="container">
        @include('quotes::layouts.alerts')

    <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" href="{{route('quotes')}}" role="tab" aria-controls="home" aria-selected="true">Home</a>
  </li>

  <li class="nav-item">
    <a class="nav-link" id="home-tab"  href="{{route('quotes.ln.new',['id' => $inv->quote_id])}}" role="tab" aria-controls="home" aria-selected="true">New Line Item</a>
  </li>
    </ul>

 
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3>Update Quote - Ref: {{$inv->quote_ref}}</h3></div>
    
                    <div class="card-body">

                        <form  action="{{ route('quotes.update',['id' => $inv->quote_id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')  
                    
                            <div class="row">
                    
                            
                            <div class="col-md-4">
                                    
                                            <h5 class="card-title">Client</h5>
                                            
                                    
                                            
                                           <select class="form-control" name="client" onchange="submit()">
                                           @foreach ($client as $c)<option value="{{$c->client_id}}">{{ $c->company }}</option>@endforeach
                                           <option></option>
                                           @foreach ($clients as $cl)
                                            <option value="{{$cl->client_id}}">{{$cl->company}}</option>
                                           @endforeach
                                            </select>
                                                
                                        
                                </div>
                    
                            <div class="col-md-4">
                                    
                                            <h5>Dates</h5>
                                            
                                        
                                            <h6>Quote Date: <input type="text" class="form-control" name="quote_date" value="{{$inv->quote_date}}" onchange="submit()"></h6>
                                            <h6>Quote Due: <input type="text" class="form-control" name="due_date" value="{{$inv->quote_due}}" onchange="submit()"></h6>
                                            <h6>Created On: {{ $inv->created_at }}</h6>
                                            <h6>Updated On: {{ $inv->updated_at }}</h6>
                                            
                                </div>
                    
                                <div class="col-md-4">
                                    
                                            <h5>Status</h5>
                                       
                                            <select class="form-control" name="status" onchange="submit()">
                                            <option>{{ $inv->status}}</option>
                                            <option>--------</option>
                                            <option>Sent</option>
                                            <option>In Negotiations</option>
                                            <option>Approved</option>
                                            <option>Lost</option>
                                            </select>
                                            
                                        
                                </div>
                    </form>
                    
                            </div>
                    
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
                                                <form class="col-md-12" action="{{ route('quotes.ln.update',['id' => $ln->id, 'iid' => $inv->quote_id]) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')  
                                                <tr>
                                                <td width="100px"><input type="text" id="qty" class="form-control" name="qty" value="{{$ln->qty}}" onchange="submit()"></td>
                                                <td><input type="text" class="form-control" name="description" value="{{$ln->description}}" onchange="submit()"></td>
                                                <td width="150px"><input type="text" id="price" class="form-control" name="price" value="{{$ln->line_price}}" onchange="submit()" ></td>
                                                <td width="150px"><input type="text" id="net" class="form-control" name="net" value="{{$ln->line_net}}" onchange="submit()"></td>
                                                <td width="150px"><input type="text" id="tax" class="form-control" name="tax" value="{{$ln->line_tax}}" onchange="submit()"></td>
                                                <td width="80px">@if($ln->line_tax_exempt == "on")<input type="checkbox" class="form-control" name="no-tax" onchange="submit()" checked>@else <input type="checkbox" class="form-control" name="no-tax" onchange="submit()">@endif</td>
                                                <td width="150px"><input type="text" id="totalPrice" class="form-control col-12" name="total" value="{{$ln->line_total}}" onchange="submit()"></td>
                                                </tr>
                                                </form>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            
                                            
                                       
                                </div>
                    
                            </div>
                    
                            <div class="row justify-content-end">
                                <div class="col-md-3">
                                    
                                            <h5>Totals</h5>
                                        
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

