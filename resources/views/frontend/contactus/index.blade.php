@extends('frontend.layouts.app')
@section('content')
  <div id="Contact" class="container max-w-[1130px] mx-auto flex flex-wrap xl:flex-nowrap justify-between gap-[50px] relative z-10">
    <div class="flex flex-col mt-20 gap-[50px]">
      <div class="breadcrumb flex items-center gap-[30px]">
        <p class="text-cp-light-grey last-of-type:text-cp-black last-of-type:font-semibold">Home</p>
        <span class="text-cp-light-grey">/</span>
        <p class="text-cp-light-grey last-of-type:text-cp-black last-of-type:font-semibold">Product</p>
        <span class="text-cp-light-grey">/</span>
        <p class="text-cp-light-grey last-of-type:text-cp-black last-of-type:font-semibold">Appointment</p>
      </div>
      <h1 class="font-extrabold text-4xl leading-[45px]">We Help You to Build Awesome Project</h1>
      <div class="flex flex-col gap-5">
        <div class="flex items-center gap-[10px]">
          <div class="w-6 h-6 flex shrink-0">
            <img src="{{ asset('assets/frontend/icons/global.svg') }}" alt="icon">
          </div>
          <p class="text-cp-dark-blue font-semibold">Jl. Pendidikan No.49 Balandete</p>
        </div>
        <div class="flex items-center gap-[10px]">
          <div class="w-6 h-6 flex shrink-0">
            <img src="{{ asset('assets/frontend/icons/call.svg') }}" alt="icon">
          </div>
          <p class="text-cp-dark-blue font-semibold">082244156660</p>
        </div>
        <div class="flex items-center gap-[10px]">
          <div class="w-6 h-6 flex shrink-0">
            <img src="{{ asset('assets/frontend/icons/monitor-mobbile.svg') }}" alt="icon">
          </div>
          <p class="text-cp-dark-blue font-semibold">balandeteku.com</p>
        </div>
      </div>
    </div>
    <form action="{{ route('contactus.submit') }}" method="POST" enctype="multipart/form-data" class="flex flex-col p-[30px] rounded-[20px] gap-[18px] bg-white shadow-[0_10px_30px_0_#D1D4DF40] w-full md:w-[700px] shrink-0">
      @csrf
      <div class="flex items-center gap-[18px]">
        <div class="flex flex-col gap-2 w-full">
          <p class="font-semibold">Nama Lengkap</p>
          <div class="flex items-center gap-[10px] p-[14px_20px] border border-[#E8EAF2] focus-within:border-cp-dark-blue transition-all duration-300 rounded-xl bg-white">
            <div class="w-[18px] h-[18px] flex shrink-0">
              <img src="{{ asset('assets/frontend/icons/profile.svg') }}" alt="icon">
            </div>
            <input type="text" name="name" class="appearance-none outline-none bg-white placeholder:font-normal placeholder:text-cp-black font-semibold w-full" placeholder="Masukan Nama Lengkap Anda" required>
          </div>
        </div>
      </div>
      <div class="flex items-center gap-[18px]">
        <div class="flex flex-col gap-2 w-full">
          <p class="font-semibold">Nomor Hp Anda</p>
          <div class="flex items-center gap-[10px] p-[14px_20px] border border-[#E8EAF2] focus-within:border-cp-dark-blue transition-all duration-300 rounded-xl bg-white">
            <div class="w-[18px] h-[18px] flex shrink-0">
              <img src="{{ asset('assets/frontend/icons/call-black.svg') }}" alt="icon">
            </div>
            <input type="tel" name="phone" class="appearance-none outline-none bg-white placeholder:font-normal placeholder:text-cp-black font-semibold w-full" placeholder="Masukan Nomor HP Anda" required>
          </div>
        </div>
      </div>
      <div class="flex flex-col md:flex-row items-center gap-[18px]"> 
        <div class="flex flex-col gap-2 w-full">
          <p class="font-semibold">Kategori Laporan</p>
          <div class="flex items-center gap-[10px] p-[14px_20px] border border-[#E8EAF2] focus-within:border-cp-dark-blue transition-all duration-300 rounded-xl bg-white">
            <div class="w-[18px] h-[18px] flex shrink-0">
              <img src="{{ asset('assets/frontend/icons/building-4-black.svg') }}" alt="icon">
            </div>
            <select name="category" class="appearance-none outline-none w-full invalid:font-normal font-semibold px-[10px] -mx-[10px]" required>
              <option value="" hidden>Kategori Laporan</option>
              <option value="Infrastruktur">Infrastruktur</option>
              <option value="Pelayanan">Pelayanan</option>
            </select>
          </div>
        </div>
        <div class="flex flex-col gap-2 w-full">
          <p class="font-semibold">Bukti Laporan</p>
          <label for="file_input" class="cursor-pointer flex items-center gap-[10px] p-[14px_20px] border border-[#E8EAF2] focus-within:border-cp-dark-blue transition-all duration-300 rounded-xl bg-white">
            {{-- <div class="w-[18px] h-[18px] flex shrink-0">
              <img src="{{ asset('assets/frontend/icons/image-add.svg') }}" alt="icon">
            </div> --}}
            <span id="file_name_display" class="font-normal text-gray-500 truncate">Unggah Bukti (Opsional)</span>
            <input id="file_input" name="report_proof" type="file" class="hidden" accept="image/*">
          </label>
        </div>
      </div>
      <div class="flex flex-col gap-2 w-full">
        <p class="font-semibold">Keluhan Anda</p>
        <div class="flex gap-[10px] p-[14px_20px] border border-[#E8EAF2] focus-within:border-cp-dark-blue transition-all duration-300 rounded-xl bg-white">
          <div class="w-[18px] h-[18px] flex shrink-0 mt-[3px]">
            <img src="{{ asset('assets/frontend/icons/message-text.svg') }}" alt="icon">
          </div>
          <textarea name="message" rows="6" class="appearance-none outline-none bg-white placeholder:font-normal placeholder:text-cp-black font-semibold w-full resize-none" placeholder="Masukan Keluhan Anda"></textarea>
        </div>
      </div>
      <button type="submit" class="bg-cp-dark-blue p-5 w-full rounded-xl hover:shadow-[0_12px_30px_0_#312ECB66] transition-all duration-300 font-bold text-white">Kirim Laporan</button>
    </form>
  </div>

  <script>
    const fileInput = document.getElementById('file_input');
    const fileNameDisplay = document.getElementById('file_name_display');

    fileInput.addEventListener('change', function() {
        if (this.files.length > 0) {
            fileNameDisplay.textContent = this.files[0].name;
        } else {
            fileNameDisplay.textContent = 'Unggah Bukti (Opsional)';
        }
    });
  </script>
@endsection
