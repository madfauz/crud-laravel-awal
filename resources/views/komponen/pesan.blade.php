{{-- menampilkan pesan sukses dari mahasiswa controller store --}}
@if (Session::has('success'))
    <div class="pt-3">
        <div class="alert alert-success">
          {{Session::get('success')}}
        </div>          
    </div>
@endif


 {{-- $errors adalah variabel global akan dieksekusi bila terjadi error saat proses input form  --}}
 @if ($errors->any())
 <div class="pt-3">
     <div class="alert alert-danger">
         <ul>
             @foreach ($errors->all() as $item)
                 <li>{{$item}}</li>
             @endforeach
         </ul>
     </div>
 </div>
@endif