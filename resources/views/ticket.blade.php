@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card-header"><h2>STEP 1: Enter all your single ticket games</h2></div>
          <br>
            <div class="card">              

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
 
                   

                    <!-- <form method="POST" action="{{route('ticket.store')}}"> -->
                       
                        <label>Game code</label>
                        <input type="text" id="codes" class="form-control" placeholder="e.g 1002">

                        <label>Bet Type</label>
                        <input type="text" id="bet_type" class="form-control" placeholder="e.g X">                        
                        <label>Odd</label>
                        <input type="number" step="any" id="odd" min="1" class="form-control" placeholder="e.g 1.7">
                     
                        <br>
                        <button id="btnsave" class="btn btn-primary">Save</button>

                        <a href="{{route('process_ticket.create')}}" class="btn btn-success" style="float: right;">Next</a>
                    <!-- </form> -->
                    <br>
                    <p id="display"></p>
                    <p id="result"></p>

                    <br><br>                    
                     <table id="content" class="table table-hover" border="2">
                        <thead>
                            <tr>
                                <th>Game code</th>
                                <th>Type</th>
                                <th>Odd</th>                                 
                             </tr>
                        </thead>
                        <tbody id="emp">
                        </tbody>
                    </table>
 
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{asset('js/jquery-1.12.4.js')}}"></script>
    <script type="text/javascript">

          load_table();
        
          $("#btnsave").click(function() {
          $("#btnsave").attr("disabled", true);
          $('#btnsave').text("Processing ...");

            $.ajax({
                    type: "POST",
                    url: "{{ route('games.store') }}",
                data: {
                     game_odd: $("#odd").val(),                         
                     game_type: $("#bet_type").val(),                         
                     game_code: $("#codes").val(),                         
                    _token: "{{Session::token()}}"
                },
                success: function(result){

                  $('#display').text("");
                  $('#btnsave').text("Add new game");
                  $('#result').text(result);
                  $("#btnsave").attr("disabled", false);

                  $("#odd").val(" ")
                  $("#bet_type").val(" ")
                  $("#codes").val(" ")
                  $("#emp > tr").remove();
                  load_table();

                }
              })

        });

          function load_table(){
              $.ajax({ 
                url : "{{route('games.index')}}",
                type : 'GET',
                dataType : 'JSON',
                success : function(data) {                    
                    $(data).each(
                      function() {
                          $('tbody#emp').append(
                            '<tr> <td>' + this.game_code+ '</td><td>'+ this.game_type+ '</td><td>' + this.game_odd+ '</td>'+' </tr>')
                      });
                },
                error : function(data) {} 
              });
          }
    </script>
@endpush
