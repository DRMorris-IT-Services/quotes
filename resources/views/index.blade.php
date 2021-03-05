
@extends('layouts.app')

@section('content')

    <div class="content">
        <div class="container">
        @if (session('status'))
    <div class="alert alert-success" role="alert">
    {{ session('status') }}
    </div>
    @endif

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="home-tab" href="{{route('quotes')}}" role="tab" aria-controls="home" aria-selected="true"><b>Home</b></a>
                </li>
                
                <li class="nav-item">
                  <a class="nav-link bg-success text-white" id="profile-tab" href="{{route('quotes.new')}}" role="tab" aria-controls="profile" aria-selected="false"><b>New Quote</b></a>
                </li>
                
              </ul>

            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header"><h3>{{ __('Quotes') }}</h3></div>
        
                        <div class="card-body">
                            <div class="row">
       
                                <div class="col-md-12">
                                   
                                                <table class="table">
                                                    <thead class=" text-primary">
                                                        <tr>
                                                            <th>Client</th>
                                                            <th>Quote Date</th>
                                                            <th>Due Date</th>
                                                            <th>Net</th>
                                                            <th>Tax</th>
                                                            <th>Total</th>
                                                            <th>Status</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($quotes as $i)
                                                        <tr>
                                                            <td>@foreach($client as $c) @if($i->client_id == $c->client_id) {{$c->company}} @endif @endforeach</td>
                                                            <td>{{date('d/m/y', strtotime($i->quote_date))}}</td>
                                                            <td>{{date('d/m/y', strtotime($i->quote_due))}}</td>
                                                            <td>{{number_format($i->net_total,2,',','.')}}</td>
                                                            <td>{{number_format($i->tax_total,2,',','.')}}</td>
                                                            <td>{{number_format($i->grand_total,2,',','.')}}</td>
                                                            <td>{{$i->status}}</td>
                                                            <td>
                                                           <a href="{{route('quotes.download',['id' => $i->quote_id])}}"> <button class="btn btn-sm btn-outline-primary fa fa-download"></button></a>
                                                            <a href="{{route('quotes.view',['id' => $i->quote_id])}}"><button class="btn btn-sm btn-outline-success fa fa-eye"></button></a>
                                                            <a href="{{route('quotes.edit',['id' => $i->quote_id])}}"><button class="btn btn-sm btn-outline-warning fa fa-edit"></button></a>
                                                            
                                                            <button class="btn btn-sm btn-outline-danger fa fa-trash"data-toggle="modal" data-target="#invoice_del{{$i->id}}"></button>
                    
                                                            <!-- MODAL DELETE INVOICE -->
                                                            <form class="col-md-12" action="{{ route('quotes.del',['id' => $i->quote_id]) }}" method="POST" enctype="multipart/form-data">
                                                                                    @csrf
                                                                                    @method('PUT')
                                                                    
                                                                    <div class="modal fade" id="invoice_del{{$i->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                                        <div class="modal-content">
                                                                        <div class="modal-header bg-danger text-white">
                                                                            <h5 class="modal-title" id="exampleModalLongTitle">REMOVE Quotation??</h5>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                        
                                                                        <h3><i class="fa fa-warning" ></i> WARNING!!</h3>
                                                                        <h5>You are going to remove this quotation, are you sure?</h5>
                                                                        <h5>This action can <b><u>NOT BE UNDONE!</u></b></h5>
                                                                            
                                                                        </div>
                                                                        <div class="modal-footer card-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-danger">DELETE</button>
                                                                        </div>
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                                    </form>
                    
                                                                    <!-- END MODAL FOR DELETE CLIENT --> 
                    
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                    
                                                </table>
                                       
                            </div>
        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
   
    


@endsection