@extends('backend.layouts.app')
@section('content')
    <div id="Content" class="relative flex flex-col flex-1 gap-6 p-6 pb-[30px] w-full shrink-0">
        <div id="Header" class="flex items-center justify-between">
            <div class="flex flex-col gap-2">
                <div class="flex gap-1 items-center leading-5 text-desa-secondary">
                    <p class="capitalize">Kepala Rumah</p>
                    <span>/</span>
                    <p class="font-semibold capitalize text-desa-dark-green">Edit Kepala Rumah</p>
                </div>
                <h1 class="font-semibold text-2xl">Edit Kepala Rumah: {{ $user->name }}</h1>
            </div>
        </div>
        @if ($errors->any())
            <div class="flex flex-col gap-2 p-4 rounded-2xl bg-desa-red/10">
                @foreach ($errors->all() as $error)
                    <p class="font-medium text-desa-red">{{ $error }}</p>
                @endforeach
            </div>
        @endif
        {{-- Menggunakan route update dan method PUT --}}
        <form action="{{ route('backend.users.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="capitalize">
            @csrf
            @method('PUT') {{-- Penting untuk metode UPDATE --}}

            <div class="shrink-0 rounded-3xl p-6 bg-white flex flex-col gap-6 h-fit">
                <section id="Photo-Profile" class="flex items-center justify-between">
                    <h2 class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]">Profile User</h2>
                    <div class="flex-1">
                        <div class="flex items-center justify-between">
                            <div id="Photo-Preview" class="flex items-center justify-center size-[100px] rounded-full overflow-hidden bg-desa-foreshadow">
                                {{-- Menampilkan gambar yang sudah ada atau placeholder --}}
                                <img id="Photo" src="{{ $user->image ? asset('storage/' . $user->image) : asset('assets/backend/images/photos/kk-preview.png') }}" alt="image" class="size-full object-cover" />
                            </div>
                            <div>
                                <input id="File" type="file" name="image" class="hidden" accept="image/*" />
                                <button id="Upload" type="button" class="relative flex items-center py-4 px-6 rounded-2xl bg-desa-black gap-[10px]">
                                    <img src="{{ asset('assets/backend/images/icons/send-square-white.svg') }}" alt="icon" class="size-6 shrink-0" />
                                    <p class="font-medium leading-5 text-white">Upload</p>
                                </button>
                            </div>
                        </div>
                        @error('image')
                            <p class="text-sm text-desa-red mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </section>
                <hr class="border-desa-background" />
                <section id="Role-User" class="flex items-center justify-between">
                    <p class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]">Role User</p>
                    <div class="flex-1">
                      <div class="flex gap-6 shrink-0">
                            @foreach ($roles as $roleItem) {{-- Menggunakan $roles karena mungkin ada banyak --}}
                                <label class="group flex w-full items-center h-14 rounded-2xl p-4 ring-[1.5px] ring-desa-background gap-2 has-[:checked]:ring-desa-dark-green transition-setup">
                                    <input type="radio"
                                           name="user_role"
                                           value="{{ $roleItem->name }}"
                                           class="flex size-[18px] shrink-0 accent-desa-secondary checked:accent-desa-dark-green transition-setup"
                                           {{ old('user_role', $user->roles->first()->name ?? '') == $roleItem->name ? 'checked' : '' }}>
                                    <span class="font-medium leading-5 text-desa-secondary w-full group-has-[:checked]:text-desa-dark-green transition-setup">
                                        {{ $roleItem->name }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                        @error('user_role')
                            <p class="text-sm text-desa-red mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </section>
                <hr class="border-desa-background" />
                <section id="Nama-Users" class="flex items-center justify-between">
                    <p class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]">Nama Users</p>
                    <div class="flex flex-col gap-1 flex-1 shrink-0">
                        <label class="relative group peer w-full">
                            {{-- Menggunakan old() sebagai fallback, jika tidak ada, gunakan $user->name --}}
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="Masukan nama lengkap"  class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-12 gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300">
                            <div class="absolute transform -translate-y-1/2 top-1/2 left-4 flex size-6 shrink-0">
                                <img src="{{ asset('assets/backend/images/icons/user-secondary-green.svg') }}" class="size-6 hidden group-has-[:placeholder-shown]:flex" alt="icon">
                                <img src="{{ asset('assets/backend/images/icons/user-black.svg') }}" class="size-6 flex group-has-[:placeholder-shown]:hidden" alt="icon">
                            </div>
                            {{-- Anda mungkin perlu logika JS untuk kelas valid ini, atau Laravel Livewire/Alpine.js --}}
                            <img src="{{ asset('assets/backend/images/icons/Checklist-dark-green-fill.svg') }}" class="absolute transform -translate-y-1/2 top-1/2 right-4 size-6 shrink-0 hidden group-[.valid]:flex" alt="icon">
                        </label>
                        @error('name')
                            <p class="text-sm text-desa-red">{{ $message }}</p>
                        @enderror
                    </div>
                </section>
                <hr class="border-desa-background w-[calc(100%+48px)] -mx-6" />
                <p class="font-medium leading-5">Akun Dashboard</p>
                <section id="Email" class="flex items-center justify-between">
                    <p class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]">Email</p>
                    <div class="flex flex-col gap-1 flex-1 shrink-0">
                        <label class="relative group peer w-full">
                            {{-- Menggunakan old() sebagai fallback, jika tidak ada, gunakan $user->email --}}
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Masukan Email" class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-12 gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300">
                            <div class="absolute transform -translate-y-1/2 top-1/2 left-4 flex size-6 shrink-0">
                                <img src="{{ asset('assets/backend/images/icons/sms-secondary-green.svg') }}" class="size-6 hidden group-has-[:placeholder-shown]:flex" alt="icon">
                                <img src="{{ asset('assets/backend/images/icons/sms-black.svg') }}" class="size-6 flex group-has-[:placeholder-shown]:hidden" alt="icon">
                            </div>
                        </label>
                         @error('email')
                            <p class="text-sm text-desa-red">{{ $message }}</p>
                        @enderror
                    </div>
                </section>
                <hr class="border-desa-background" />
                <section id="Passwords" class="flex items-center justify-between">
                    <p class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]">Password (Kosongkan jika tidak ingin mengubah)</p>
                    <div class="flex flex-col gap-1 flex-1 shrink-0">
                        <label class="relative group peer w-full">
                            {{-- Password tidak boleh diisi dengan old() atau nilai asli dari user untuk keamanan --}}
                            <input type="password" name="password" placeholder="Masukan Password Baru" class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-12 gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300 tracking-[4px] placeholder:tracking-normal">
                            <div class="absolute transform -translate-y-1/2 top-1/2 left-4 flex size-6 shrink-0">
                                <img src="{{ asset('assets/backend/images/icons/key-secondary-green.svg') }}" class="size-6 hidden group-has-[:placeholder-shown]:flex" alt="icon">
                                <img src="{{ asset('assets/backend/images/icons/key-black.svg') }}" class="size-6 flex group-has-[:placeholder-shown]:hidden" alt="icon">
                            </div>
                        </label>
                        @error('password')
                            <p class="text-sm text-desa-red">{{ $message }}</p>
                        @enderror
                    </div>
                </section>
                 <hr class="border-desa-background" />
                <section id="Passwords-confirmation" class="flex items-center justify-between">
                    <p class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]">Konfirmasi Password Baru</p>
                    <div class="flex flex-col gap-3 flex-1 shrink-0">
                        <label class="relative group peer w-full">
                            <input type="password" name="password_confirmation" placeholder="Konfirmasi Password Baru" class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-12 gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300 tracking-[4px] placeholder:tracking-normal">
                            <div class="absolute transform -translate-y-1/2 top-1/2 left-4 flex size-6 shrink-0">
                                <img src="{{ asset('assets/backend/images/icons/key-secondary-green.svg') }}" class="size-6 hidden group-has-[:placeholder-shown]:flex" alt="icon">
                                <img src="{{ asset('assets/backend/images/icons/key-black.svg') }}" class="size-6 flex group-has-[:placeholder-shown]:hidden" alt="icon">
                            </div>
                        </label>
                    </div>
                </section>
                <hr class="border-desa-background" />
                <section id="Buttons" class="flex items-center justify-end gap-4">
                    <a href="{{ route('backend.users.index') }}" class="py-[18px] rounded-2xl bg-desa-red w-[180px] text-center flex justify-center font-medium text-white">Batal</a>
                    <button id="submitButton" type="submit" class="py-[18px] rounded-2xl disabled:bg-desa-grey w-[180px] text-center flex justify-center font-medium text-white bg-desa-dark-green transition-all duration-300">Update User</button>
                </section>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script>
    document.getElementById('Upload').addEventListener('click', function() {
        document.getElementById('File').click();
    });

    document.getElementById('File').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('Photo').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
