@extends('employees.layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title }}</h1>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show col-lg-5" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="col-lg-5 mb-5">
        <form method="POST" action="/employees/{{ $employee->id }}" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="jenis_karyawan" class="form-label">Jenis Karyawan</label>
                <select class="form-select form-select-sm @error('jenis_karyawan') is-invalid @enderror" aria-label=".form-select-sm example" id="jenis_karyawan" name="jenis_karyawan">
                    <option>Pilih Jenis Karyawan</option>
                    <option value="Kontrak" @if($employee->jenis_karyawan == 'Kontrak') selected @endif>Kontrak</option>
                    <option value="Tetap" @if($employee->jenis_karyawan == 'Tetap') selected @endif>Tetap</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="nrk" class="form-label">Nomor Registrasi Karyawan</label>
                <input type="text" class="form-control" id="nrk" name="nrk" value="" placeholder="Nomor Urut Otomatis" disabled>
                @error('nrk')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Karyawan</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $employee->nama) }}" required autofocus>
                @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select class="form-select form-select-sm @error('jenis_kelamin') is-invalid @enderror" aria-label=".form-select-sm example" id="jenis_kelamin" name="jenis_kelamin">
                    <option>Pilih Jenis Kelamin</option>
                    <option value="Laki-laki" @if($employee->jenis_kelamin == 'Laki-laki') selected @endif>Laki-Laki</option>
                    <option value="Perempuan" @if($employee->jenis_kelamin == 'Perempuan') selected @endif>Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $employee->tanggal_lahir) }}" autofocus>
                @error('tanggal_lahir')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Foto</label>
                @if ($employee->image)
                    <img src="{{ asset('storage/' . $employee->image) }}" class="img-preview d-block img-fluid mb-3 col-sm-5">
                @else
                    <img class="img-preview img-fluid mb-3 col-sm-5">
                @endif
                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
                @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>

    <script>
        // Image
        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection