@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            
                            <th scope="col">Messsage</th>
                            <th scope="col">envoyé par</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            @foreach ($messages as $message )
                            <h6> envoyé par </h6>
                            <td>{{$message->content}}</td>
                            <td>{{getBuyerName($message->buyer_id)}}</td>
                        @endforeach
                            
                            
                          </tr>
                          
                        </tbody>
                      </table>

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
