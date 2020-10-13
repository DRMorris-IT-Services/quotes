
@extends('layouts.app')

@section('content')

    <div class="content">
    
   
    <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" href="{{route('quotes')}}" role="tab" aria-controls="home" aria-selected="true">Home</a>
  </li>
  @if (AUTH::user()->quotes_add == "on")
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" href="{{route('quotes.new')}}" role="tab" aria-controls="profile" aria-selected="false">New Quote</a>
  </li>
  @endif
</ul>

        <div class="row">
       
            <div class="col-md-12 text-white">
               
                        <h2>Quotations</h2>
                    
                        <br>
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
                                        
                                        <button class="btn btn-sm btn-outline-danger"data-toggle="modal" data-target="#invoice_del{{$i->id}}"><i class="fa fa-trash"></i></button>

                                        <!-- MODAL DELETE INVOICE -->
                                        <form class="col-md-12" action="{{ route('quotes.del',['id' => $i->quote_id]) }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                
                                                <div class="modal fade" id="invoice_del{{$i->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                    <div class="modal-header bg-dark text-white">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">REMOVE Quotation??</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-dark">
                                                    
                                                    <h3><i class="fa fa-warning" ></i> WARNING!!</h3>
                                                    <h5>You are going to remove this quotation, are you sure?</h5>
                                                    <h5>This action can <b><u>NOT BE UNDONE!</u></b></h5>
                                                        
                                                    </div>
                                                    <div class="modal-footer bg-dark text-white">
                                                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-outline-danger">DELETE</button>
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

@endsection