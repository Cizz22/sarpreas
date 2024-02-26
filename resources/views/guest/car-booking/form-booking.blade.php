<x-guest-layout>
    <!-- component -->
    <div class="min-h-screen p-6 bg-gray-100 flex items-center justify-center">
        <div class="container max-w-screen-lg mx-auto">
            <div>
                <h2 class="font-semibold text-xl text-gray-600">Form Peminjaman Mobil</h2>
                <p class="text-gray-500 mb-6">Sebelum mengisi, silahkan baca aturan peminjaman disini</p>

                <form method="POST" action="{{ route('peminjaman.form.submit') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-3">
                            <div class="text-gray-600">
                                <p class="font-medium text-lg">Informasi Instansi/Organisasi/Departement</p>
                                <p>Silahkan isi </p>
                            </div>

                            <div class="sm:col-span-2">
                                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                                    <div class="md:col-span-5">
                                        <label for="full_name">Nama</label>
                                        <input type="text" name="org_name" id="full_name"
                                            class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" />
                                    </div>
                                </div>

                                @error('org_name')
                                    <p class="text-red-500 text-xs italic mt-4">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <hr>

                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-3">
                            <div class="text-gray-600">
                                <p class="font-medium text-lg">Informasi Personal Penanggung Jawab</p>
                                <p>Silahkan isi informasi penganggung jawab</p>
                            </div>

                            <div class="sm:col-span-2">
                                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                                    <div class="md:col-span-5">
                                        <label for="full_name">Nama Lengkap</label>
                                        <input type="text" name="full_name" id="full_name"
                                            class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" />
                                    </div>
                                    @error('full_name')
                                        <p class="text-red-500 text-xs italic mt-4">
                                            {{ $message }}
                                        </p>
                                    @enderror


                                    <div class="md:col-span-5">
                                        <label for="email">Alamat email</label>
                                        <input type="text" name="email" id="email"
                                            class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value=""
                                            placeholder="email@domain.com" />
                                    </div>

                                    @error('email')
                                        <p class="text-red-500 text-xs italic mt-4">
                                            {{ $message }}
                                        </p>
                                    @enderror

                                    <div class="md:col-span-5">
                                        <label for="email">Nomor Handphone (Whatsapp)</label>
                                        <input type="text" name="no_hp" id="email"
                                            class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value=""
                                            placeholder="08*********" />
                                    </div>

                                    @error('no_hp')
                                        <p class="text-red-500 text-xs italic mt-4">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                    {{--
                <div class="md:col-span-2">
                  <label for="country">Country / region</label>
                  <div class="h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                    <input name="country" id="country" placeholder="Country" class="px-4 appearance-none outline-none text-gray-800 w-full bg-transparent" value="" />
                    <button tabindex="-1" class="cursor-pointer outline-none focus:outline-none transition-all text-gray-300 hover:text-red-600">
                      <svg class="w-4 h-4 mx-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                      </svg>
                    </button>
                    <button tabindex="-1" for="show_more" class="cursor-pointer outline-none focus:outline-none border-l border-gray-200 transition-all text-gray-300 hover:text-blue-600">
                      <svg class="w-4 h-4 mx-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"></polyline></svg>
                    </button>
                  </div>
                </div>

                <div class="md:col-span-2">
                  <label for="state">State / province</label>
                  <div class="h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                    <input name="state" id="state" placeholder="State" class="px-4 appearance-none outline-none text-gray-800 w-full bg-transparent" value="" />
                    <button tabindex="-1" class="cursor-pointer outline-none focus:outline-none transition-all text-gray-300 hover:text-red-600">
                      <svg class="w-4 h-4 mx-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                      </svg>
                    </button>
                    <button tabindex="-1" for="show_more" class="cursor-pointer outline-none focus:outline-none border-l border-gray-200 transition-all text-gray-300 hover:text-blue-600">
                      <svg class="w-4 h-4 mx-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"></polyline></svg>
                    </button>
                  </div>
                </div>

                <div class="md:col-span-1">
                  <label for="zipcode">Zipcode</label>
                  <input type="text" name="zipcode" id="zipcode" class="transition-all flex items-center h-10 border mt-1 rounded px-4 w-full bg-gray-50" placeholder="" value="" />
                </div>

                <div class="md:col-span-5">
                  <div class="inline-flex items-center">
                    <input type="checkbox" name="billing_same" id="billing_same" class="form-checkbox" />
                    <label for="billing_same" class="ml-2">My billing address is different than above.</label>
                  </div>
                </div>

                <div class="md:col-span-2">
                  <label for="soda">How many soda pops?</label>
                  <div class="h-10 w-28 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                    <button tabindex="-1" for="show_more" class="cursor-pointer outline-none focus:outline-none border-r border-gray-200 transition-all text-gray-500 hover:text-blue-600">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                      </svg>
                    </button>
                    <input name="soda" id="soda" placeholder="0" class="px-2 text-center appearance-none outline-none text-gray-800 w-full bg-transparent" value="0" />
                    <button tabindex="-1" for="show_more" class="cursor-pointer outline-none focus:outline-none border-l border-gray-200 transition-all text-gray-500 hover:text-blue-600">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2 fill-current" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                      </svg>
                    </button>
                  </div>
                </div> --}}



                                </div>
                            </div>

                        </div>

                        <hr>

                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-3">
                            <div class="text-gray-600">
                                <p class="font-medium text-lg">Informasi Kendaraan</p>
                                <p>Silahkan isi </p>
                            </div>
                            <input type="hidden" value="{{ $selectedCar->id }}" name="car_id">

                            <div class="sm:col-span-2">
                                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                                    <div class="md:col-span-5">
                                        <label for="full_name">Nama </label>
                                        <input type="text" name="car_name" id="full_name"
                                            class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                            value="{{ $selectedCar->name }}" disabled />
                                    </div>
                                </div>
                                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                                    <div class="md:col-span-5">
                                        <label for="full_name">Jenis </label>
                                        <input type="text" name="car_type" id="full_name"
                                            class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                            value="{{ $selectedCar->vehicle_type }}" disabled />
                                    </div>
                                </div>
                                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                                    <div class="md:col-span-5">
                                        <label for="full_name">Kapasitas</label>
                                        <input type="text" name="car_capacity" id="full_name"
                                            class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                            value="{{ $selectedCar->capacity }}" disabled />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-3">
                            <div class="text-gray-600">
                                <p class="font-medium text-lg">Informasi Peminjaman</p>
                                <p>Silahkan isi </p>
                            </div>

                            <div class="sm:col-span-2">
                                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                                    <div class="md:col-span-5">
                                        <label for="full_name">Tanggal Peminjaman</label>
                                        <input type="date" name="booking_date" id="full_name"
                                            class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" />
                                    </div>

                                    @error('booking_date')
                                        <p class="text-red-500 text-xs italic mt-4">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                                    <div class="md:col-span-5">
                                        <label for="full_name">Waktu mulai pinjam</label>
                                        <input type="time" name="start_date" id="full_name"
                                            class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" />
                                    </div>

                                    @error('start_date')
                                        <p class="text-red-500 text-xs italic mt-4">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                                    <div class="md:col-span-5">
                                        <label for="full_name">Waktu selesai pinjam</label>
                                        <input type="time" name="end_date" id="full_name"
                                            class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" />
                                    </div>

                                    @error('end_date')
                                        <p class="text-red-500 text-xs italic mt-4">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                                    <div class="md:col-span-5">
                                        <label for="full_name">Alasan Peminjaman</label>
                                        <textarea id="postContent" name="reason" rows="4"
                                            class="bg-gray-50 w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm
      sm:leading-5 resize-none focus:outline-none focus:border-blue-500"></textarea>
                                    </div>
                                    @error('reason')
                                        <p class="text-red-500 text-xs italic mt-4">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                                    <div class="md:col-span-5">
                                        <label for="full_name">Dokumen Pendukung</label>
                                        <div
                                            class="relative border-2 rounded-md px-4 py-3 bg-white flex items-center justify-between hover:border-blue-500 transition duration-150 ease-in-out">
                                            <input type="file" id="fileAttachment" name="supporting_documents"
                                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                                onchange="previewFile()">

                                            <div class="flex items-center" style="display: flex;" id="fileInfo">
                                                <svg class="w-6 h-6 text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                </svg>
                                                <span class="ml-2 text-sm text-gray-600">Choose a file</span>
                                            </div>
                                            <span class="text-sm text-gray-500">Max file size: 5MB</span>
                                        </div>
                                        <div style="display: none;" id="filePreview">
                                            <a href="#" id="fileLink" class="ml-2 text-sm text-blue-600"></a>
                                        </div>
                                    </div>
                                </div>


                                <div class="md:col-span-5 mt-3 text-right">
                                    <div class="inline-flex items-end">
                                        <button type="submit"
                                            class="flex justify-center items-center bg-blue-500 hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue text-white py-2 px-4 rounded-md transition duration-300 gap-2">
                                            Submit <svg xmlns="http://www.w3.org/2000/svg" width="19"
                                                height="19" viewBox="0 0 24 24" id="send" fill="#fff">
                                                <path fill="none" d="M0 0h24v24H0V0z"></path>
                                                <path
                                                    d="M3.4 20.4l17.45-7.48c.81-.35.81-1.49 0-1.84L3.4 3.6c-.66-.29-1.39.2-1.39.91L2 9.12c0 .5.37.93.87.99L17 12 2.87 13.88c-.5.07-.87.5-.87 1l.01 4.61c0 .71.73 1.2 1.39.91z">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>

            <a href="https://www.buymeacoffee.com/dgauderman" target="_blank"
                class="md:absolute bottom-0 right-0 p-4 float-right">
                <img src="https://www.buymeacoffee.com/assets/img/guidelines/logo-mark-3.svg" alt="Buy Me A Coffee"
                    class="transition-all rounded-full w-14 -rotate-45 hover:shadow-sm shadow-lg ring hover:ring-4 ring-white">
            </a>
        </div>
    </div>

    <script>
        function previewFile() {
            const fileInput = document.getElementById('fileAttachment');
            const filePreview = document.getElementById('filePreview');
            const fileInfo = document.getElementById('filePreview');
            const fileLink = document.getElementById('fileLink')

            if (fileInput.files && fileInput.files[0]) {
                const fileName = fileInput.files[0].name;
                fileInfo.style.display = 'none';
                filePreview.style.display = 'flex';

                fileLink.href = URL.createObjectURL(fileInput.files[0]);
                fileLink.download = fileName;
                fileLink.innerHTML = fileName;
            }
        }
    </script>


</x-guest-layout>
