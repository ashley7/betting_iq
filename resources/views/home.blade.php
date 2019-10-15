@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                
                <div class="card-header">{{ __('Dashboard') }}</div>

                   <div class="card-body">

                    <h4>List of my ticket</h4>
                      
                      <br><br>                 

                    <table class="table">

                        <th>Date</th> <th>Name</th> <th>Phone</th> <th>Email</th> <th>Status</th> <th>Tickets</th>
                        @foreach($user_tags as $tags)
                        <?php 

                          $number_of_tickets = App\UserTag::gamecode($tags->tag)->count();

                         ?>
                         @if($number_of_tickets > 0)
                          <tr>
                              <td>{{$tags->created_at}}</td>
                              <td>{{$tags->users->name}}</td>
                              <td>{{$tags->users->phone_number}}</td>
                              <td>{{$tags->users->email}}</td>
                              <td>{{$tags->paid}}</td>
                              @if(\Auth::user()->email == "admin@betiq.pro")
                               <td><a href="/ticket_details/{{$tags->tag}}">Ticket</a></td>
                               @else

                                @if($tags->paid == "paid" || $number_of_tickets < 3)
                                  <td><a href="/ticket_details/{{$tags->tag}}">Ticket</a></td>
                                  @else

                                   <td></td>
                                   
                                  @endif

                              @endif
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


