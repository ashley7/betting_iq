@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                
                <div class="card-header">{{ __('Dashboard') }}</div>

                   <div class="card-body">

                    <h4>List of my ticket</h4>

                    <table class="table">

                        <th>Date</th> <th>Name</th> <th>Phone</th> <th>Email</th> <th>Status</th> <th>Tickets</th>
                        @foreach($user_tags as $tags)
                         @if(App\UserTag::gamecode($tags->tag)->count() > 0)
                          <tr>
                              <td>{{$tags->created_at}}</td>
                              <td>{{$tags->users->name}}</td>
                              <td>{{$tags->users->phone_number}}</td>
                              <td>{{$tags->users->email}}</td>
                              <td>{{$tags->paid}}</td>
                              <td><a href="/tickets/tickets_{{$tags->tag}}.pdf">Ticket</a></td>
                          </tr>
                          @endif
                        @endforeach                        
                    </table>                  
                   
                   </div>


                </div>
            </div>

        </div>
    </div>
</div>

@endsection
