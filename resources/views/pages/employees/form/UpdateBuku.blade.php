 @extends('layouts.employees')
 @section('content_admin')
     <div class="w-full p-6">
         <div class="card">
             <form method="post" action="{{ route('book.put',$book->id) }}" id="inputField" enctype="multipart/form-data">
                 @csrf
                 @method('PUT')
                 <label class="form-control w-full">
                     <div class="label">
                         <span class="label-text">Judul Buku</span>
                     </div>
                     <input type="text" name="title" id="title" value="{{ $book->title }}"
                         class="input input-bordered w-full" required />
                     @error('title')
                         <small class="mt-2 text-danger">{{ $message }}</small>
                     @enderror
                 </label>
                 <label class="form-control w-full">
                     <div class="label">
                         <span class="label-text">Penulis</span>
                     </div>
                     <input type="text" name="author" id="author" class="input input-bordered w-full"
                         value="{{ $book->author }}" required />
                     @error('author')
                         <small class="mt-2 text-danger">{{ $message }}</small>
                     @enderror
                 </label>
                 <label class="form-control w-full">
                     <div class="label">
                         <span class="label-text">Penerbit</span>
                     </div>
                     <input type="text" name="publisher" id="publisher" class="input input-bordered w-full"
                         value="{{ $book->publisher }}" required />
                     @error('publisher')
                         <small class="mt-2 text-danger">{{ $message }}</small>
                     @enderror
                 </label>
                 <label class="form-control w-full">
                     <div class="label">
                         <span class="label-text">No Inventaris</span>
                     </div>
                     <input type="text" name="no_inventaris" id="no_inventaris" class="input input-bordered w-full"
                         value="{{ $book->no_inventaris }}" required />
                     @error('no_inventaris')
                         <small class="mt-2 text-danger">{{ $message }}</small>
                     @enderror
                 </label>
                 <label class="form-control w-full">
                     <div class="label">
                         <span class="label-text">Description</span>
                     </div>
                     <input type="text" name="description" id="description" class="input input-bordered w-full"
                         value="{{ $book->description }}" required />
                     @error('description')
                         <small class="mt-2 text-danger">{{ $message }}</small>
                     @enderror
                 </label>
                 <label class="form-control w-full">
                     <div class="label">
                         <span class="label-text">Tahun Terbit</span>
                     </div>
                     <input type="text" name="year_published" id="year_published" class="input input-bordered w-full"
                         value="{{ $book->year_published }}" required />
                     @error('year_published')
                         <small class="mt-2 text-danger">{{ $message }}</small>
                     @enderror
                 </label>
                 <label class="form-control w-full mt-3">
                     <div class="label">
                         <span class="label-text">QR Book</span>
                     </div>
                     <div class="flex items-center" id="item_qr">
                         <input type="text" id="inputcode" name="inputcode" class=" input input-bordered flex-grow mr-2"
                             value="{{ $book->code }}" />
                         <input type="hidden" id="code" name="code" value="{{ $book->code }}" />
                         <i class='bx bx-qr' id="btn_scan" style='font-size: 3em;'></i>
                     </div>
                     <div id="reader" width="600px"></div>
                     <a class="link link-success" id="btn_back">Back</a>
                     @error('code')
                         <small class="mt-2 text-danger">{{ $message }}</small>
                     @enderror
                 </label>
                 <div class="mt-1 ">
                     <div class="label">
                         <span class="label-text">
                             Kategori Buku
                         </span>
                     </div>
                     @foreach ($categories as $item)
                         <label class="inline-flex items-center mr-4">
                             <input type="checkbox" class="form-checkbox" id="{{ $item->id }}" name="items[]"
                                 value="{{ $item->id }}" @if (in_array($item->id, $bookCategories)) checked @endif>
                             <span class="ml-2">{{ $item->name }}</span>
                         </label>
                     @endforeach
                     @error('items')
                         <div class="alert alert-danger">{{ $message }}</div>
                     @enderror
                 </div>
                 <label class="form-control w-full mt-4">
                     <input type="file" id="img" name="img" class="file-input file-input-bordered w-full"
                         accept="image/jpeg, image/png" />
                     @error('img')
                         <div class="alert alert-danger mt-2">{{ $message }}</div>
                     @enderror
                     <img id="previewImage" src="{{ asset('storage/sampul/' . $book->img) }}" alt="Preview Image"
                         class="mt-2" width="200">
                 </label>
                 <div class="modal-action">
                     <button class="btn btn-accent" type="submit">Submit</button>
                     <a class="btn" href="{{ route('employees.book') }}">Close</a>
                 </div>
             </form>
         </div>
     </div>

     <script>
         var previewImage_Post = document.getElementById('previewImage');
         var inputImage_post = document.getElementById('img');
         var inputcode = document.getElementById("inputcode");
         var reader = document.getElementById("reader");
         var item_qr = document.getElementById("item_qr");
         var btn_scan = document.getElementById("btn_scan");
         var btn_back = document.getElementById("btn_back");
         var code = document.getElementById("code");
         readerHide()

         btn_scan.addEventListener('click', function() {
             clearqr();
         });

         btn_back.addEventListener('click', function() {
             readerHide()
         });

         inputImage_post.addEventListener('change', function(event_post) {
             var file = event_post.target.files[0];
             if (file) {
                 previewImage_Post.src = URL.createObjectURL(event_post.target.files[0]);
                 previewImage_Post.classList.remove('hidden');
             } else {
                 previewImage_Post.classList.add('hidden');
             }
         });

         function onScanSuccess(decodedText, decodedResult) {
             inputcode.value = decodedText;
             code.value = decodedText;
             readerHide()
             inputcode.disabled = true;
         }


         function onScanFailure(error) {
             clearqr();
         }

         // Buat instance Html5QrcodeScanner
         let html5QrcodeScanner = new Html5QrcodeScanner(
             "reader", {
                 fps: 10,
                 qrbox: {
                     width: 250,
                     height: 250
                 }
             },
             /* verbose= */
             false);

         // Render Html5QrcodeScanner
         html5QrcodeScanner.render(onScanSuccess, onScanFailure);

         function clearqr() {
             item_qr.classList.add('hidden');
             reader.style.display = 'block';
             btn_back.classList.remove('hidden');
         }

         function readerHide() {
             item_qr.classList.remove('hidden');
             reader.style.display = 'none';
             btn_back.classList.add('hidden');
             inputcode.disabled = false;
         }


         $(document).ready(function() {
             @if ($errors->any())
                 modal.showModal();
             @endif
         });
     </script>
 @endsection
