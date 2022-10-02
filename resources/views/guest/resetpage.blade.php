 @extends('layout.layout')
 @section('title', 'Reset Page')

 @section('content')

     <div class="row my-5">
         <div class="col-sm-4"></div>
         <div class="col-sm-4 text-center">
             <h4 class="my-3 text-secondary">Password Reset</h4>
             <form action="{{ route('finalreset') }}" method="post">
                 @csrf
                 <input type="password" name="password"
                     class="form-control my-2 shadow-none @error('password') border-danger @enderror" id=""
                     placeholder="Password">
                 <input type="password" name="password_confirmation"
                     class="form-control my-2 shadow-none @error('password') border-danger @enderror" id=""
                     placeholder="Repeat Password">

                 <input class="btn btn-primary btn-sm shadow-none" type="submit" value="Submit">
             </form>
         </div>
         @if (session('msge'))
             <p class="text-secondary text-center my-3">{{ session('msge') }} </p>
         @endif
         <div class="col-sm-4"></div>
     </div>
 @endsection
