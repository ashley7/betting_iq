@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">              

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h1>BET ODDS</h1>

                    <form method="POST" action="{{route('ticket.store')}}">
                        @csrf
                        <label>Enter your Odds here</label>
                        <input type="text" name="odds" class="form-control" placeholder="e.g 101,102,4098,234,4312">

                        <label>If I loose </label>
                        <input type="text" name="safeguards" class="form-control" placeholder="n matches">

                        <label>Amount</label>
                        <input type="text" name="amount" class="form-control number">
                        <br>
                        <button type="submit" class="btn btn-primary">Process</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

<script src="{{asset('js/jquery-1.12.4.js')}}"></script>

 <script type="text/javascript">  
    $('input.number').keyup(function(event) {
      // skip for arrow keys
      if(event.which >= 37 && event.which <= 40) return;

      // format number
      $(this).val(function(index, value) {
        return value
        .replace(/\D/g, "")
        .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        ;
      });
    });
</script>

@endpush