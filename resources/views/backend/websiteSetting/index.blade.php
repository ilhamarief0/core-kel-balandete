@extends('backend.layouts.app')
@section('content')
                <div id="Content" class="relative flex flex-col flex-1 gap-6 p-6 pb-[30px] w-full shrink-0">
                    <div id="Header" class="flex items-center justify-between">
                        <div class="flex flex-col gap-2">
                            <div class="flex gap-1 items-center leading-5 text-desa-secondary">
                                <p class="last-of-type:text-desa-dark-green last-of-type:font-semibold capitalize ">Profile Kelurahan</p>
                                <span>/</span>
                                <p class="last-of-type:text-desa-dark-green last-of-type:font-semibold capitalize ">Edit Profile Kelurahan</p>
                            </div>
                            <h1 class="font-semibold text-2xl">Edit Profile Kelurahan</h1>
                        </div>
                    </div>
                    <form action="{{ route('backend.websiteSetting.update', ['websiteSetting' => $setting->id]) }}" method="PUT" enctype="multipart/form-data" class="capitalize">
                      @csrf
                        <div class="shrink-0 rounded-3xl p-6 bg-white flex flex-col gap-6 h-fit">
                            <section id="Photos" class="flex justify-between">
                                <h2 class="font-medium leading-5 text-desa-secondary flex h-[100px] items-center w-[calc(424/904*100%)]">Logo Kelurahan</h2>
                                <div class="photo-input-container flex flex-col gap-6 flex-1">
                                    <div class="photo-form group/parent flex items-center justify-between">
                                        <div class="Photo-Preview flex itce justify-center w-[120px] h-[100px] rounded-2xl overflow-hidden bg-desa-foreshadow">
                                            <img class="Photo size-full object-cover" src="{{ asset('assets/backend/images/thumbnails/thumbnail-bansos-preview.svg') }}" alt="image"/>
                                        </div>
                                        <div class="relative">
                                            <input required type="file" name="" class="photo-input absolute opacity-0 left-0 top-0 size-0 -z-10" />
                                            <div class="action flex gap-3">
                                                <button type="button" class="Upload-btn relative flex items-center py-4 px-6 rounded-2xl bg-desa-black gap-[10px]">
                                                    <img src="{{ asset('assets/backend/images/icons/send-square-white.svg') }}" alt="icon" class="size-6 shrink-0" />
                                                    <p class="font-medium leading-5 text-white">Upload</p>
                                                </button>
                                                <button type="button" class="delete size-14 rounded-2xl p-4 bg-desa-red items-center hidden justify-center group-[&.new]/parent:flex" onclick="deletePhotoForm(this)">
                                                    <img src="{{ asset('assets/backend/images/icons/trash-white.svg') }}" class="flex size-6 shrink-0" alt="icon">
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <hr class="border-desa-background" />
                            <section id="Nama-Desa" class="flex items-center justify-between">
                                <p class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]">Nama Website</p>
                                <div class="flex flex-col gap-3 flex-1 shrink-0">
                                    <label class="relative group peer w-full">
                                        <input type="text" placeholder="Ketik nama kelurahan" value="{{ $setting->website_name }}" class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-12 gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300">
                                        <div class="absolute transform -translate-y-1/2 top-1/2 left-4 flex size-6 shrink-0">
                                            <img src="{{ asset('assets/backend/images/icons/building-4-secondary-green.svg') }}" class="size-6 hidden group-has-[:placeholder-shown]:flex" alt="icon">
                                            <img src="{{ asset('assets/backend/images/icons/building-4-black.svg') }}" class="size-6 flex group-has-[:placeholder-shown]:hidden" alt="icon">
                                        </div>
                                    </label>
                                </div>
                            </section>
                            <hr class="border-desa-background" />
                              <section id="Lokasi" class="flex items-center justify-between">
                                  <p class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]">
                                      Lokasi Desa
                                  </p>
                                  <div class="flex flex-col gap-3 flex-1 shrink-0">
                                      <textarea
                                          name="website_address"
                                          id="website_address"
                                          placeholder="Ketik alamat desa"
                                          rows="6"
                                          class="appearance-none outline-none w-full rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-4 gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300"
                                      >{{ old('website_address', $setting->website_address ?? '') }}</textarea>
                                  </div>
                              </section>
                            <hr class="border-desa-background" />
                            <section id="Kepala-Desa" class="flex items-center justify-between">
                                <p class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]">Nama Kepala Desa</p>
                                <div class="flex flex-col gap-3 flex-1 shrink-0">
                                    <label class="relative group peer w-full">
                                        <input type="text" placeholder="Pilih Kepala Desa" class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-12 gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300">
                                        <div class="absolute transform -translate-y-1/2 top-1/2 left-4 flex size-6 shrink-0">
                                            <img src="{{ asset('assets/backend/images/icons/user-square-secondary-green.svg') }}" class="size-6 hidden group-has-[:placeholder-shown]:flex" alt="icon">
                                            <img src="{{ asset('assets/backend/images/icons/user-square-black.svg') }}" class="size-6 flex group-has-[:placeholder-shown]:hidden" alt="icon">
                                        </div>
                                    </label>
                                </div>
                            </section>
                            <hr class="border-desa-background" />
                            <section id="Luas-Pertanian" class="flex items-center justify-between">
                                <p class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]">Luas Pertanian Desa</p>
                                <div class="flex flex-col gap-3 flex-1 shrink-0">
                                    <label class="relative group peer w-full">
                                        <input type="number" placeholder="Masukan total luas pertanian" class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-12 pr-[98px] gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300">
                                        <div class="absolute transform -translate-y-1/2 top-1/2 left-4 flex size-6 shrink-0">
                                            <img src="{{ asset('assets/backend/images/icons/tree-secondary-green.svg') }}" class="size-6 hidden group-has-[:placeholder-shown]:flex" alt="icon">
                                            <img src="{{ asset('assets/backend/images/icons/tree-black.svg') }}" class="size-6 flex group-has-[:placeholder-shown]:hidden" alt="icon">
                                        </div>
                                        <div class="absolute transform -translate-y-1/2 top-1/2 right-4 flex shrink-0 gap-6">
                                            <div class="w-px h-6 border border-desa-background"></div>
                                            <span class="font-medium leading-5 text-desa-black group-has-[:placeholder-shown]:text-desa-secondary normal-case">m<sup>2</sup></span>
                                        </div>
                                    </label>
                                </div>
                            </section>
                            <hr class="border-desa-background" />
                            <section id="Luas-Area" class="flex items-center justify-between">
                                <p class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]">Luas Area Desa</p>
                                <div class="flex flex-col gap-3 flex-1 shrink-0">
                                    <label class="relative group peer w-full">
                                        <input type="number" placeholder="Masukan total luas area" class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-12 pr-[98px] gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300">
                                        <div class="absolute transform -translate-y-1/2 top-1/2 left-4 flex size-6 shrink-0">
                                            <img src="{{ asset('assets/backend/images/icons/grid-5-secondary-green.svg') }}" class="size-6 hidden group-has-[:placeholder-shown]:flex" alt="icon">
                                            <img src="{{ asset('assets/backend/images/icons/grid-5-black.svg') }}" class="size-6 flex group-has-[:placeholder-shown]:hidden" alt="icon">
                                        </div>
                                        <div class="absolute transform -translate-y-1/2 top-1/2 right-4 flex shrink-0 gap-6">
                                            <div class="w-px h-6 border border-desa-background"></div>
                                            <span class="font-medium leading-5 text-desa-black group-has-[:placeholder-shown]:text-desa-secondary normal-case">m<sup>2</sup></span>
                                        </div>
                                    </label>
                                </div>
                            </section>
                            <hr class="border-desa-background" />
                            <section id="Jumlah Penduduk" class="flex items-center justify-between">
                                <p class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]">Jumlah Penduduk Desa</p>
                                <div class="flex flex-col gap-3 flex-1 shrink-0">
                                    <label class="relative group peer w-full">
                                        <input type="number" placeholder="Masukan total penduduk desa" class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-12 gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300">
                                        <div class="absolute transform -translate-y-1/2 top-1/2 left-4 flex size-6 shrink-0">
                                            <img src="{{ asset('assets/backend/images/icons/profile-2user-secondary-green.svg') }}" class="size-6 hidden group-has-[:placeholder-shown]:flex" alt="icon">
                                            <img src="{{ asset('assets/backend/images/icons/profile-2user-black.svg') }}" class="size-6 flex group-has-[:placeholder-shown]:hidden" alt="icon">
                                        </div>
                                    </label>
                                </div>
                            </section>
                            <hr class="border-desa-background" />
                            <section id="Deskripsi" class="flex items-center justify-between">
                                <p class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]">Deskripsi Tentang Desa</p>
                                <div class="flex flex-col gap-3 flex-1 shrink-0">
                                    <textarea name="" id="" value="{{ $setting->website_description }}" placeholder="Jelaskan lebih detail tentang desa terkait" rows="6" class="appearance-none outline-none w-full rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-4 gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300">{{ old('website_address', $setting->website_description ?? '') }}</textarea>
                                </div>
                            </section>
                            <hr class="border-desa-background w-[calc(100%+48px)] -mx-6" />
                            <section id="Buttons" class="flex items-center justify-end gap-4">
                                <a href="kd-event-desa.html">
                                    <div class="py-[18px] rounded-2xl bg-desa-red w-[180px] text-center flex justify-center font-medium text-white">Batal, Tidak jadi</div>
                                </a>
                                <button id="submitButton" type="submit" class="py-[18px] rounded-2xl disabled:bg-desa-grey w-[180px] text-center flex justify-center font-medium text-white bg-desa-dark-green transition-all duration-300">Save Changes</button>
                            </section>
                        </div>
                    </form>
                </div>
@endsection
