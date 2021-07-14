@extends('layouts.app')
@section('title', "Post")

@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card border-dark">
            <div class="card-header border-dark lead">
               Post
            </div>

            <div class="card-body">
               <h3><b>{{ $data->title }}</b></h3>
               <p>{{ $data->description }}</p>
               @if(auth()->user()-> id == $data->user_id)
               <a href="{{ route('edit', $data->id) }}" class="btn btn-link text-dark btn-sm">Edit</a>
               <a href="{{ route('delete/{id}', $data->id) }}" class="btn btn-link btn-sm text-danger">Delete</a>
               @endif
            </div>
      </div>
   </div>
</div>
<script>
   function deleteConfirmation(id) {
       Swal.fire({
           icon: 'warning',
           title: 'Delete post?',
           text: 'This action is irreversible?',
           showCancelButton: true,
           confirmButtonText: 'Delete',
           cancelButtonText: 'Cancel',
           reverseButtons: true
       }).then(function(e){
           if (e.value === true) {
           var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

           $.ajax({
               type: 'POST',
               url: "post/delete/" + id,
               data: {_token: CSRF_TOKEN},
               dataType: 'JSON',
               complete: () => {
                   Swal.fire({
                       text: "Your post was deleted successfully!",
                       title: 'Deleted',
                       type: "success",
                       showConfirmButton: false,
                       timer: 5000,
                       icon: 'success'
                   });
                   setTimeout(function (){
                       window.location.replace('/post')
                   }, 3000);
               }
           });

           } else {
               e.dismiss;
           }

   }, function (dismiss) {
       return false;
   })
}
</script>
@endsection